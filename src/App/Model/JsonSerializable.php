<?php

namespace App\Model;

interface JsonSerializable
{
    public function jsonSerialize(): array;
}
