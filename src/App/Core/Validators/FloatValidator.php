<?php

namespace App\Core\Validators;

class FloatValidator implements ValidatorInterface
{
    public function validate($variable): bool
    {
        return is_numeric($variable);
    }
}
