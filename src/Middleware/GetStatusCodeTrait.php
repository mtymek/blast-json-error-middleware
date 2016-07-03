<?php


namespace Blast\JsonError\Middleware;

use Exception;
use Psr\Http\Message\ResponseInterface;

trait GetStatusCodeTrait
{
    /**
     * Determine status code from an error and/or response.
     *
     * If the error is an exception with a code between 400 and 599, returns
     * the exception code.
     *
     * Otherwise, retrieves the code from the response; if not present, or
     * less than 400 or greater than 599, returns 500; otherwise, returns it.
     *
     * @param mixed $error
     * @param ResponseInterface $response
     * @return int
     */
    private function getStatusCode($error, ResponseInterface $response)
    {
        if ($error instanceof Exception
            && ($error->getCode() >= 400 && $error->getCode() < 600)
        ) {
            return $error->getCode();
        }

        $status = $response->getStatusCode();
        if (! $status || $status < 400 || $status >= 600) {
            $status = 500;
        }
        return $status;
    }
}
