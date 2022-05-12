<?php

namespace App\Core\Validators;

interface ValidatorInterface
{
    public function validate($variable): bool;
}
