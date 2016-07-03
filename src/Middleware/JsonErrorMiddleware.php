<?php

namespace Blast\JsonError\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;

class JsonErrorMiddleware
{
    use GetStatusCodeTrait;

    public function __invoke($error, ServerRequestInterface $request, ResponseInterface $response, callable $next)
    {
        return new JsonResponse(
            "An error has occurred.",
            $this->getStatusCode($error, $response)
        );
    }
}
