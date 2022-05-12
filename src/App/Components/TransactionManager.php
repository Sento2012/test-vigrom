<?php

namespace App\Components;

use App\Model\Transaction;
use App\Model\TransactionCreateRequestObject;
use App\Model\TransactionCreateResponseObject;
use App\Model\Wallet;
use App\Repository\TransactionProvider;
use App\Repository\WalletProvider;
use Illuminate\Database\Capsule\Manager as Capsule;

class TransactionManager implements TransactionManagerInterface
{
    private WalletProvider $walletProvider;
    private TransactionProvider $transactionProvider;
    private BalanceCalculator $balanceCalculator;

    public function __construct(
        WalletProvider $walletProvider,
        TransactionProvider $transactionProvider,
        BalanceCalculator $balanceCalculator
    ) {
        $this->walletProvider = $walletProvider;
        $this->transactionProvider = $transactionProvider;
        $this->balanceCalculator = $balanceCalculator;
    }

    public function addTransaction(
        TransactionCreateRequestObject $transactionCreateRequestObject
    ): TransactionCreateResponseObject {
        $wallet = $this->walletProvider->getWalletById($transactionCreateRequestObject->getWalletId());
        if (!$wallet) {
            return $this->createFailedTransactionCreateResponseObject();
        }
        if (!$this->executeWalletTransaction($wallet, $transactionCreateRequestObject)) {
            return $this->createFailedTransactionCreateResponseObject();
        }

        return $this->createSuccessTransactionCreateResponseObject();
    }

    protected function createFailedTransactionCreateResponseObject(): TransactionCreateResponseObject
    {
        return (new TransactionCreateResponseObject())
            ->setIsSuccessful(false);
    }

    protected function createSuccessTransactionCreateResponseObject(): TransactionCreateResponseObject
    {
        return (new TransactionCreateResponseObject())
            ->setIsSuccessful(true);
    }

    protected function createTransactionModelFromTransactionCreateRequestObject(
        TransactionCreateRequestObject $transactionCreateRequestObject
    ): Transaction {
        return new Transaction([
            Transaction::FIELD_WALLET_ID => $transactionCreateRequestObject->getWalletId(),
            Transaction::FIELD_TYPE => $transactionCreateRequestObject->getType(),
            Transaction::FIELD_AMOUNT => $transactionCreateRequestObject->getAmount(),
            Transaction::FIELD_REASON => $transactionCreateRequestObject->getReason(),
        ]);
    }

    protected function executeWalletTransaction(
        Wallet $wallet,
        TransactionCreateRequestObject $transactionCreateRequestObject
    ): bool {
        try {
            Capsule::beginTransaction();
            $this->transactionProvider->addTransaction(
                $this->createTransactionModelFromTransactionCreateRequestObject($transactionCreateRequestObject)
            );
            $wallet->setBalance($this->balanceCalculator->getNewBalance($transactionCreateRequestObject, $wallet));
            $this->walletProvider->updateWallet($wallet);
            Capsule::commit();
        } catch (\Exception $e){
            Capsule::rollback();
            return false;
        }

        return true;
    }
}