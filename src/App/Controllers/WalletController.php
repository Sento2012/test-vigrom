<?php

namespace App\Controllers;

use App\Components\WalletManager;
use App\Core\BaseController;
use App\Model\WalletGetRequestObject;
use Symfony\Component\HttpFoundation\Request;

class WalletController extends BaseController
{
    /**
     * @Route("/wallet/{id}", methods={"GET"})
     */
    public function get(Request $request): array
    {
        $walletGetRequestObject = (new WalletGetRequestObject($request));
        if (!$walletGetRequestObject->validate()) {
            return ['status' => BaseController::STATUS_FAIL];
        }

        $walletGetResponseObject = $this->containerBuilder
            ->get(WalletManager::class)->getWallet($walletGetRequestObject);

        return $walletGetResponseObject->jsonSerialize();
    }
}