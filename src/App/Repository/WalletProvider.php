<?php

namespace App\Repository;

use App\Model\Wallet;

class WalletProvider extends BaseDatabase
{
    protected function getTable(): string
    {
        return 'wallets';
    }

    public function getWalletById(int $id): ?Wallet
    {
        $city = $this->getOneByField($id, Wallet::FIELD_ID);
        if ($city) {
            return new Wallet($city);
        }

        return null;
    }

    public function updateWallet(Wallet $wallet): bool
    {
        return $this->updateRecord($wallet->jsonSerialize());
    }
}