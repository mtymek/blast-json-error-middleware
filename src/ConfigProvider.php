<?php

namespace Blast\JsonError;

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
