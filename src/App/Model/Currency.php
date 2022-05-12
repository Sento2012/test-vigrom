<?php

namespace App\Model;

class Currency implements \JsonSerializable
{
    public const FIELD_ID = 'id';
    public const FIELD_CURRENCY = 'currency';
    public const FIELD_RATE = 'rate';

    private string $id;
    private string $currency;
    private string $rate;

    public function __construct(array $params)
    {
        $this->id = $params[self::FIELD_ID];
        $this->currency = $params[self::FIELD_CURRENCY];
        $this->rate = $params[self::FIELD_RATE];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getRate(): float
    {
        return $this->rate;
    }

    public function jsonSerialize(): array
    {
        return [
            self::FIELD_ID => $this->getId(),
            self::FIELD_CURRENCY => $this->getCurrency(),
            self::FIELD_RATE => $this->getRate(),
        ];
    }
}
