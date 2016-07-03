<?php

namespace Blast\Test\JsonError\Middleware;

use Blast\JsonError\Middleware\DebugJsonErrorMiddleware;
use Exception;
use PHPUnit_Framework_TestCase;
use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequest;

class DebugJsonErrorMiddlewareTest extends PHPUnit_Framework_TestCase
{
    public function testReturnsJsonWithExceptionInformation()
    {
        $exception = new Exception("Error");
        $middleware = new DebugJsonErrorMiddleware(true, dirname(dirname(__DIR__)));
        $response = $middleware($exception, new ServerRequest(), new Response(), function () {});
        $json = json_decode($response->getBody()->__toString(), true);
        $this->assertEquals('test/Middleware/DebugJsonErrorMiddlewareTest.php:16', $json['error']['file']);
    }
}
