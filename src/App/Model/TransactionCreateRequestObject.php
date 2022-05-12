<?php

namespace App\Model;

use App\Core\AbstractRequestObject;
use JsonSerializable;
use Symfony\Component\HttpFoundation\Request;

class TransactionCreateRequestObject extends AbstractRequestObject implements JsonSerializable
{
    public const TYPE_DEBIT = 'debit';
    public const TYPE_CREDIT = 'credit';

    public const REASON_STOCK = 'stock';
    public const REASON_REFUND = 'refund';

    public const FIELD_WALLET_ID = 'wallet_id';
    public const FIELD_TYPE = 'type';
    public const FIELD_CURRENCY = 'currency';
    public const FIELD_REASON = 'reason';
    public const FIELD_AMOUNT = 'amount';

    protected ?int $wallet_id = null;
    protected ?string $type = null;
    protected ?string $currency = null;
    protected ?string $reason = null;
    protected ?string $amount = null;

    public function __construct(Request $request)
    {
        $this->wallet_id = $request->request->get(static::FIELD_WALLET_ID);
        $this->type = $request->request->get(static::FIELD_TYPE);
        $this->currency = $request->request->get(static::FIELD_CURRENCY);
        $this->reason = $request->request->get(static::FIELD_REASON);
        $this->amount = $request->request->get(static::FIELD_AMOUNT);

    }

    protected function rules(): array
    {
        return [
            'wallet_id' => [
                AbstractRequestObject::VALIDATOR_TYPE => AbstractRequestObject::TYPE_INT,
                AbstractRequestObject::VALIDATOR_NOT_NULL => true,
            ],
            'type' => [
                AbstractRequestObject::VALIDATOR_TYPE => AbstractRequestObject::TYPE_STRING,
                AbstractRequestObject::VALIDATOR_NOT_NULL => true,
                AbstractRequestObject::VALIDATOR_AVAILABLE_VALUES => [static::TYPE_DEBIT, static::TYPE_CREDIT],
            ],
            'currency' => [
                AbstractRequestObject::VALIDATOR_TYPE => AbstractRequestObject::TYPE_STRING,
                AbstractRequestObject::VALIDATOR_NOT_NULL => true,
            ],
            'reason' => [
                AbstractRequestObject::VALIDATOR_TYPE => AbstractRequestObject::TYPE_STRING,
                AbstractRequestObject::VALIDATOR_NOT_NULL => true,
                AbstractRequestObject::VALIDATOR_AVAILABLE_VALUES => [static::REASON_REFUND, static::REASON_STOCK],
            ],
            'amount' => [
                AbstractRequestObject::VALIDATOR_TYPE => AbstractRequestObject::TYPE_FLOAT,
                AbstractRequestObject::VALIDATOR_NOT_NULL => true,
            ],
        ];
    }

    public function getWalletId(): int
    {
        return $this->wallet_id;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getReason(): string
    {
        return $this->reason;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function setAmount(float $amount): TransactionCreateRequestObject
    {
        $this->amount = $amount;

        return $this;
    }

    public function jsonSerialize(): array
    {
        return [
            self::FIELD_AMOUNT => $this->getAmount(),
            self::FIELD_REASON => $this->getReason(),
            self::FIELD_CURRENCY => $this->getCurrency(),
            self::FIELD_TYPE => $this->getType(),
            self::FIELD_WALLET_ID => $this->getWalletId(),
        ];
    }
}
