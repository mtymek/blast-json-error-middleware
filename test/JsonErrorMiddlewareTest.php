<?php

namespace Blast\Test\JsonErrorMiddleware;

use Blast\JsonErrorMiddleware\JsonErrorMiddleware;
use Blast\Test\JsonErrorMiddleware\Asset\ExceptionDelegate;
use Exception;
use PHPUnit_Framework_TestCase;
use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequest;

class JsonErrorMiddlewareTest extends PHPUnit_Framework_TestCase
{
    public function testReturnsJsonWithErrorMessage()
    {
        $middleware = new JsonErrorMiddleware();
        $response = $middleware->process(new ServerRequest(), new ExceptionDelegate());
        $this->assertEquals('"An error has occurred."', $response->getBody()->__toString());
    }
}
