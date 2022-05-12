<?php

namespace App\Model;

class Transaction implements \JsonSerializable
{
    public const DATE_FORMAT_CREATE_AT = 'Y-m-d H:i:s';

    public const FIELD_ID = 'id';
    public const FIELD_WALLET_ID = 'wallet_id';
    public const FIELD_AMOUNT = 'amount';
    public const FIELD_TYPE = 'type';
    public const FIELD_REASON = 'reason';
    public const FIELD_CREATE_AT = 'create_at';

    private ?string $id;
    private string $wallet_id;
    private string $amount;
    private string $type;
    private string $reason;
    private string $createAt;

    public function __construct(array $params)
    {
        $this->id = $params[self::FIELD_ID] ?? null;
        $this->wallet_id = $params[self::FIELD_WALLET_ID];
        $this->amount = $params[self::FIELD_AMOUNT];
        $this->type = $params[self::FIELD_TYPE];
        $this->reason = $params[self::FIELD_REASON];
        $this->createAt = $params[self::FIELD_CREATE_AT];
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWalletId(): int
    {
        return $this->wallet_id;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getReason(): string
    {
        return $this->reason;
    }

    public function getCreateAt(): string
    {
        return $this->createAt;
    }

    public function jsonSerialize(): array
    {
        return [
            self::FIELD_ID => $this->getId(),
            self::FIELD_WALLET_ID => $this->getWalletId(),
            self::FIELD_AMOUNT => $this->getAmount(),
            self::FIELD_TYPE => $this->getType(),
            self::FIELD_REASON => $this->getReason(),
            self::FIELD_CREATE_AT => $this->getCreateAt()
        ];
    }
}
