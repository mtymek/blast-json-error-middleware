<?php

namespace Blast\Test\JsonError;

use Blast\JsonError\DebugJsonErrorMiddleware;
use Blast\Test\JsonError\Asset\ExceptionDelegate;
use Exception;
use PHPUnit_Framework_TestCase;
use Zend\Diactoros\ServerRequest;

class DebugJsonErrorMiddlewareTest extends PHPUnit_Framework_TestCase
{
    public function testReturnsJsonWithExceptionInformation()
    {
        $exception = new Exception("Error");
        $middleware = new DebugJsonErrorMiddleware(true, dirname(__DIR__));
        $response = $middleware->process(new ServerRequest(), new ExceptionDelegate($exception));
        $json = json_decode($response->getBody()->__toString(), true);
        $this->assertEquals('test/DebugJsonErrorMiddlewareTest.php:15', $json['error']['file']);
    }
}
