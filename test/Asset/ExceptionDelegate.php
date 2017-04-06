<?php

namespace Blast\Test\JsonError\Asset;

use Exception;
use Interop\Http\ServerMiddleware\DelegateInterface;
use Psr\Http\Message\ServerRequestInterface;
use Throwable;

class ExceptionDelegate implements DelegateInterface
{
    /** @var Throwable */
    private $exception;

    public function __construct(Throwable $exception = null)
    {
        if (null === $this->exception) {
            $this->exception = new Exception("Error message");
        }
        $this->exception = $exception;
    }

    public function process(ServerRequestInterface $request)
    {
        throw $this->exception;
    }
}
