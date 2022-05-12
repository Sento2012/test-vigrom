<?php

namespace App\Repository;

use App\Model\Transaction;

class TransactionProvider extends BaseDatabase
{
    protected function getTable(): string
    {
        return 'transactions';
    }

    public function addTransaction(Transaction $transaction): bool
    {
        return $this->addRecord($transaction->jsonSerialize());
    }
}