<?php

namespace Handler;

use ErrorException;
use Throwable;

class ErrorHandler
{
    /**
     * @param Throwable $exception
     * @return void
     */
    public static function handleException(Throwable $exception): void
    {
        http_response_code(500);

        echo json_encode([
            "code" => $exception->getCode(),
            "message" => $exception->getMessage(),
            "file" => $exception->getFile(),
            "line" => $exception->getLine()
        ]);
    }

    /**
     * @throws ErrorException
     */
    public static function handleError(
        int    $errNo,
        string $errStr,
        string $errFile,
        int    $errLine
    ): bool
    {
        throw new ErrorException($errStr, 0, $errNo, $errFile, $errLine);
    }
}