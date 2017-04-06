<?php

namespace Blast\JsonError;

use Exception;
use Throwable;

trait GetStatusCodeTrait
{
    /**
     * Determine status code from an error and/or response.
     *
     * If the error is an exception with a code between 400 and 599, returns
     * the exception code.
     *
     * @param mixed $error
     * @return int
     */
    private function getStatusCode(Throwable $error)
    {
        if ($error instanceof Exception
            && ($error->getCode() >= 400 && $error->getCode() < 600)
        ) {
            return $error->getCode();
        }

        return 500;
    }
}
