<?php

namespace Blast\Test\JsonError\Middleware;

use Blast\JsonError\Middleware\JsonErrorMiddleware;
use Exception;
use PHPUnit_Framework_TestCase;
use Zend\Diactoros\Response;
use Zend\Diactoros\ServerRequest;

class GetStatusCodeTraitTest extends PHPUnit_Framework_TestCase
{
    public function testReadsStatusCodeFromException()
    {
        $middleware = new JsonErrorMiddleware();
        $response = $middleware(new Exception("error", 502), new ServerRequest(), new Response(), function () {});
        $this->assertEquals(502, $response->getStatusCode());
    }

    public function testIgnoresExceptionCodeIfItDoestNotMatchHttpErrorCode()
    {
        $middleware = new JsonErrorMiddleware();
        $response = $middleware(new Exception("error", 1000), new ServerRequest(), new Response(), function () {});
        $this->assertEquals(500, $response->getStatusCode());
    }

    public function testReadsStatusCodeFromPreviousResponse()
    {
        $middleware = new JsonErrorMiddleware();
        $originalResponse = (new Response())->withStatus(522);
        $response = $middleware(new Exception(), new ServerRequest(), $originalResponse, function () {});
        $this->assertEquals(522, $response->getStatusCode());
    }

    public function testIgnoresPreviousResponseCodeIfItDoestNotMatchHttpErrorCode()
    {
        $middleware = new JsonErrorMiddleware();
        $originalResponse = (new Response())->withStatus(200);
        $response = $middleware(new Exception(), new ServerRequest(), $originalResponse, function () {});
        $this->assertEquals(500, $response->getStatusCode());
    }
}
