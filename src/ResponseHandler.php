<?php

declare(strict_types=1);

namespace CurrencyConverter;

class ResponseHandler
{
    public static function print($response, $status_code): void
    {
        header('Content-Type: application/json; charset=utf-8');

        http_response_code($status_code);

        echo json_encode($response);
    }

    public static function printException($message, $status_code): void
    {
        self::print(array('error' => $message), $status_code);
    }
}
