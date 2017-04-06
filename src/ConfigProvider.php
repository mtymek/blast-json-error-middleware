<?php

namespace Blast\JsonErrorMiddleware;

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
