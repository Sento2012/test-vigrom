<?php

namespace App\Components;

use App\Model\TransactionCreateRequestObject;
use App\Model\TransactionCreateResponseObject;

interface TransactionManagerInterface
{
    /**
     * Specification:
     * - Add transaction.
     *
     * @param TransactionCreateRequestObject $transactionCreateRequestObject
     *
     * @return TransactionCreateResponseObject
     */
    public function addTransaction(
        TransactionCreateRequestObject $transactionCreateRequestObject
    ): TransactionCreateResponseObject;
}