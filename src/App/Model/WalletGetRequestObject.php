<?php

namespace App\Model;

use App\Core\AbstractRequestObject;
use JsonSerializable;
use Symfony\Component\HttpFoundation\Request;

class WalletGetRequestObject extends AbstractRequestObject implements JsonSerializable
{
    public const FIELD_ID = 'id';

    protected ?int $id = null;

    public function __construct(Request $request)
    {
        $this->id = $request->attributes->get(static::FIELD_ID);

    }

    protected function rules(): array
    {
        return [
            'id' => [
                AbstractRequestObject::VALIDATOR_TYPE => AbstractRequestObject::TYPE_INT,
                AbstractRequestObject::VALIDATOR_NOT_NULL => true,
            ],
        ];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function jsonSerialize(): array
    {
        return [
            self::FIELD_ID => $this->getId(),
        ];
    }
}
