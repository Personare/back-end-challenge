<?php

declare(strict_types=1);

namespace CurrencyConverter;

class ResponseHandler
{
    private $response;
    private $status_code;

    public function buildResponse($response, $status_code): void
    {
        $this->response = $response;
        $this->status_code = $status_code;
    }

    public function buildException($message, $status_code): void
    {
        $this->buildResponse(array('error' => $message), $status_code);
    }

    public function output(): void
    {
        $this->header();

        echo json_encode($this->response);
    }

    protected function header(): void
    {
        header('Content-Type: application/json; charset=utf-8');

        http_response_code($this->status_code);
    }
}
