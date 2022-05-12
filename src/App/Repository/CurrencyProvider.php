<?php

namespace App\Repository;

use App\Model\Currency;

class CurrencyProvider extends BaseDatabase
{
    protected function getTable(): string
    {
        return 'currency_rates';
    }

    public function getCurrencyByName(string $name): ?Currency
    {
        $currency = $this->getOneByField($name, Currency::FIELD_CURRENCY);
        if ($currency) {
            return new Currency($currency);
        }

        return null;
    }
}