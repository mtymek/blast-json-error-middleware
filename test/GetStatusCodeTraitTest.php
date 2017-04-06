<?php

namespace Blast\Test\JsonError;

use Blast\JsonError\JsonErrorMiddleware;
use Blast\Test\JsonError\Asset\ExceptionDelegate;
use Exception;
use PHPUnit_Framework_TestCase;
use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequest;

class GetStatusCodeTraitTest extends PHPUnit_Framework_TestCase
{
    public function testReadsStatusCodeFromException()
    {
        $middleware = new JsonErrorMiddleware();
        $response = $middleware->process(new ServerRequest(), new ExceptionDelegate(new Exception("E", 502)));
        $this->assertEquals(502, $response->getStatusCode());
    }

    public function testIgnoresExceptionCodeIfItDoestNotMatchHttpErrorCode()
    {
        $middleware = new JsonErrorMiddleware();
        $response = $middleware->process(new ServerRequest(), new ExceptionDelegate(new Exception("E", 1000)));
        $this->assertEquals(500, $response->getStatusCode());
    }
}
