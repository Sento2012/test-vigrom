<?php

namespace App\Model;

use App\Core\AbstractRequestObject;
use JsonSerializable;

class TransactionCreateResponseObject extends AbstractRequestObject implements JsonSerializable
{
    public const FIELD_IS_SUCCESSFUL = 'isSuccessful';

    protected bool $isSuccessful;

    public function setIsSuccessful(bool $isSuccessful): TransactionCreateResponseObject
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
        return [
            self::FIELD_IS_SUCCESSFUL => $this->getIsSuccessful(),
        ];
    }
}
