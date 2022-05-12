<?php

namespace App\Core;

use Symfony\Component\DependencyInjection\ContainerBuilder;

abstract class BaseController
{
    public const STATUS_OK = 'ok';
    public const STATUS_FAIL = 'fail';

    protected ?ContainerBuilder $containerBuilder;

    public function __construct(?ContainerBuilder $containerBuilder = null)
    {
        $this->containerBuilder = $containerBuilder;
    }
}
