<?php

namespace Personare\Exchange\Web\Util;

trait ResponseTrait
{
    function json($object, $status = 200)
    {
        header('Content-Type: application/json');

        http_response_code($status);
        echo json_encode($object, JSON_UNESCAPED_UNICODE);
        exit;
    }

    function jsonError($errors, $status = 400)
    {
        header('Content-Type: application/json');

        http_response_code($status);
        echo json_encode(['errors' => $errors], JSON_UNESCAPED_UNICODE);
        exit;
    }
}
