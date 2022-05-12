<?php

namespace App\Core\Validators;

class IntegerValidator implements ValidatorInterface
{
    public function validate($variable): bool
    {
        print_r($variable);
        print_r(is_int($variable));
        return is_int($variable);
    }
}
