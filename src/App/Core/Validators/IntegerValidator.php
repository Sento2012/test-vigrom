<?php

namespace App\Core\Validators;

class IntegerValidator implements ValidatorInterface
{
    public function validate($variable): bool
    {
        return is_int($variable);
    }
}
