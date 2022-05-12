<?php

namespace App\Components;

use App\Model\TransactionCreateRequestObject;
use App\Model\Wallet;
use App\Repository\CurrencyProvider;

class BalanceCalculator
{
    private CurrencyProvider $currencyProvider;

    public function __construct(CurrencyProvider $currencyProvider)
    {
        $this->currencyProvider = $currencyProvider;
    }

    public function getNewBalance(
        TransactionCreateRequestObject $transactionCreateRequestObject,
        Wallet $wallet
    ): float {
        $currency = $this->currencyProvider->getCurrencyByName($transactionCreateRequestObject->getCurrency());
        if ($wallet->getCurrency() !== $currency->getId()) {
            $transactionCreateRequestObject->setAmount(
                $transactionCreateRequestObject->getAmount() * $currency->getRate()
            );
        }
        if ($transactionCreateRequestObject->getType() === TransactionCreateRequestObject::TYPE_DEBIT) {
            return $wallet->getBalance() + $transactionCreateRequestObject->getAmount();
        }

        return $wallet->getBalance() - $transactionCreateRequestObject->getAmount();
    }
}