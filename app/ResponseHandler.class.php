<?php

namespace CurrencyConverter;

class ResponseHandler
{
    public function printConversion($response)
    {
        header('Content-Type: application/json; charset=utf-8');

        http_response_code(200);

        echo json_encode($response);

        exit;
    }

    public function printException($message, $status_code)
    {
        header('Content-Type: application/json; charset=utf-8');

        http_response_code($status_code);

        echo json_encode(array('error' => $message));

        exit;
    }
}
