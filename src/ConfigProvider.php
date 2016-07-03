<?php

namespace Blast\JsonError;

use Blast\JsonError\Middleware\DebugJsonErrorMiddleware;
use Zend\ServiceManager\Factory\InvokableFactory;

class ConfigProvider
{
    public function __invoke()
    {
        return [
            'dependencies' => [
                'factories' => [
                    DebugJsonErrorMiddleware::class => InvokableFactory::class,
                ],
            ],
        ];
    }
}
