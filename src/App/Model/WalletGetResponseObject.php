<?php

namespace App\Model;

use App\Core\AbstractRequestObject;
use JsonSerializable;

class WalletGetResponseObject extends AbstractRequestObject implements JsonSerializable
{
    public const FIELD_WALLET = 'wallet';
    public const FIELD_IS_SUCCESSFUL = 'isSuccessful';

    protected bool $isSuccessful;
    protected Wallet $wallet;

    public function getWallet(): Wallet
    {
        return $this->wallet;
    }

    public function setWallet(Wallet $wallet): WalletGetResponseObject
    {
        $this->wallet = $wallet;

        return $this;
    }

    public function setIsSuccessful(bool $isSuccessful): WalletGetResponseObject
    {
        $this->isSuccessful = $isSuccessful;

        return $this;
    }

    public function getIsSuccessful(): bool
    {
        return $this->isSuccessful;
    }

    public function jsonSerialize(): array
    {
        if ($this->isSuccessful) {
            return [
                self::FIELD_WALLET => $this->getWallet()->jsonSerialize(),
                self::FIELD_IS_SUCCESSFUL => $this->getIsSuccessful(),
            ];
        }

        return [
            self::FIELD_IS_SUCCESSFUL => $this->getIsSuccessful(),
        ];
    }
}
