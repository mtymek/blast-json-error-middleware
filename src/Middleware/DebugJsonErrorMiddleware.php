<?php

namespace Blast\JsonError\Middleware;

use Exception;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Whoops\Exception\Inspector;
use Zend\Diactoros\Response\JsonResponse;

class DebugJsonErrorMiddleware
{
    use GetStatusCodeTrait;

    /** @var string */
    private $baseDir;

    private $stripBaseDir = false;

    public function __construct($stripBaseDir = false, $baseDir = null)
    {
        if ($stripBaseDir) {
            if (null == $baseDir) {
                $this->baseDir = getcwd();
            } else {
                $this->baseDir = $baseDir;
            }
        }
        $this->stripBaseDir = $stripBaseDir;
    }


    public function __invoke($error, ServerRequestInterface $request, ResponseInterface $response, callable $next)
    {
        $data = [
            'type'    => get_class($error),
            'message' => $error->getMessage(),
            'file'    => $this->formatDir($error->getFile()) . ':' . $error->getLine()
        ];

        $inspector = new Inspector($error);

        $frameData = [];
        foreach ($inspector->getFrames() as $frame) {
            $frameData[] = [
                'file'     => $this->formatDir($frame->getFile()) . ':' . $frame->getLine(),
                'method'   => $frame->getClass() . '::' . $frame->getFunction()
            ];
        }
        $data['trace'] = $frameData;

        return new JsonResponse(
            ['error' => $data],
            $this->getStatusCode($error, $response)
        );
    }

    private function formatDir($dir)
    {
        if (!$this->stripBaseDir) {
            return $dir;
        }
        if (strpos($dir, $this->baseDir) !== 0) {
            return $dir;
        }

        return ltrim(str_replace($this->baseDir, '', $dir), '/');
    }
}
