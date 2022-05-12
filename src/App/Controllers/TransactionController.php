<?php

namespace App\Controllers;

use App\Components\TransactionManager;
use App\Core\BaseController;
use App\Model\TransactionCreateRequestObject;
use Symfony\Component\HttpFoundation\Request;

class TransactionController extends BaseController
{
    /**
     * @Route("/transaction", methods={"POST"})
     */
    public function post(Request $request): array
    {
        $transactionCreateRequestObject = (new TransactionCreateRequestObject($request));
        if (!$transactionCreateRequestObject->validate()) {
            return ['status' => BaseController::STATUS_FAIL];
        }

        $localTime = $this->containerBuilder
            ->get(TransactionManager::class)->addTransaction($transactionCreateRequestObject);

        if ($localTime) {
            return [
                'status' => BaseController::STATUS_OK,
                'time' => $localTime,
            ];
        }

        return ['status' => BaseController::STATUS_FAIL];
    }
}