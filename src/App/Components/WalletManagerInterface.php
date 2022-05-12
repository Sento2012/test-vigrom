<?php

namespace App\Components;

use App\Model\WalletGetRequestObject;
use App\Model\WalletGetResponseObject;

interface WalletManagerInterface
{
    /**
     * Specification:
     * - Get information about wallet.
     *
     * @param WalletGetRequestObject $walletGetRequestObject
     *
     * @return WalletGetResponseObject
     */
    public function getWallet(
        WalletGetRequestObject $walletGetRequestObject
    ): WalletGetResponseObject;
}