<?php

namespace Blast\JsonErrorMiddleware;

use Interop\Http\ServerMiddleware\DelegateInterface;
use Interop\Http\ServerMiddleware\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Throwable;
use Zend\Diactoros\Response\JsonResponse;

class JsonErrorMiddleware implements MiddlewareInterface
{
    use GetStatusCodeTrait;

    public function process(ServerRequestInterface $request, DelegateInterface $delegate)
    {
        try {
            return $delegate->process($request);
        } catch (Throwable $throwable) {
            return new JsonResponse(
                "An error has occurred.",
                $this->getStatusCode($throwable)
            );
        }
    }
}
