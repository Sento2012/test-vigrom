<?php

namespace App\Controllers;

use App\Components\SyncManager;
use App\Core\BaseController;

class CliController extends BaseController
{
    public function sync(): void
    {
        $this->containerBuilder->get(SyncManager::class)->sync();
    }
}