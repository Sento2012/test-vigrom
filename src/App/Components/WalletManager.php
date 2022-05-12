<?php

namespace App\Components;

use App\Model\Wallet;
use App\Model\WalletGetRequestObject;
use App\Model\WalletGetResponseObject;
use App\Repository\WalletProvider;

class WalletManager implements WalletManagerInterface
{
    private WalletProvider $walletProvider;

    public function __construct(WalletProvider $walletProvider)
    {
        $this->walletProvider = $walletProvider;
    }

    public function getWallet(
        WalletGetRequestObject $walletGetRequestObject
    ): WalletGetResponseObject {
        $wallet = $this->walletProvider->getWalletById($walletGetRequestObject->getId());
        if (!$wallet) {
            return $this->createFailedWalletGetResponseObject();
        }

        return $this->createSuccessWalletGetResponseObject($wallet);
    }

    protected function createFailedWalletGetResponseObject(): WalletGetResponseObject
    {
        return (new WalletGetResponseObject())
            ->setIsSuccessful(false);
    }

    protected function createSuccessWalletGetResponseObject(Wallet $wallet): WalletGetResponseObject
    {
        return (new WalletGetResponseObject())
            ->setIsSuccessful(true)
            ->setWallet($wallet);
    }
}