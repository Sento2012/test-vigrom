<?php

namespace App\Core\Validators;

class StringValidator implements ValidatorInterface
{
    public function validate($variable): bool
    {
        return is_string($variable);
    }
}
