<?php

namespace Blast\JsonError;

use Blast\JsonError\Middleware\DebugJsonErrorMiddleware;
use Blast\JsonError\Middleware\DebugJsonErrorMiddlewareFactory;

class ConfigProvider
{
    public function __invoke()
    {
        return [
            'dependencies' => [
                'factories' => [
                    DebugJsonErrorMiddleware::class => DebugJsonErrorMiddlewareFactory::class,
                ],
            ],
        ];
    }
}
