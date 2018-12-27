<?php

namespace PersonareExchange\Interfaces\Util;

class Responses
{
    public function responseJSON($data, $status = 200)
    {
        header('Content-Type: application/json');
        http_response_code($status);
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        exit;
    }
}
