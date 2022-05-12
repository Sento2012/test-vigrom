<?php

namespace App\Model;

class Wallet implements \JsonSerializable
{
    public const FIELD_ID = 'id';
    public const FIELD_USER_ID = 'user_id';
    public const FIELD_CURRENCY = 'currency';
    public const FIELD_BALANCE = 'balance';

    private string $id;
    private string $user_id;
    private int $currency;
    private float $balance;

    public function __construct(array $params)
    {
        $this->id = $params[self::FIELD_ID];
        $this->user_id = $params[self::FIELD_USER_ID];
        $this->currency = $params[self::FIELD_CURRENCY];
        $this->balance = $params[self::FIELD_BALANCE];
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getUserId(): string
    {
        return $this->user_id;
    }

    public function getCurrency(): int
    {
        return $this->currency;
    }

    public function setBalance(float $balance): Wallet
    {
        $this->balance = $balance;

        return $this;
    }

    public function getBalance(): float
    {
        return $this->balance;
    }

    public function jsonSerialize(): array
    {
        return [
            self::FIELD_ID => $this->getId(),
            self::FIELD_USER_ID => $this->getUserId(),
            self::FIELD_CURRENCY => $this->getCurrency(),
            self::FIELD_BALANCE => $this->getBalance(),
        ];
    }
}
