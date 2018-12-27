<?php
namespace PersonareExchange\Interfaces\Http;

use PersonareExchange\Interfaces\Util\Responses;
use PersonareExchange\Domain\Services\ExchangeService;

class ExchangeController
{
    private $exchangeService;
    private $response;

    public function __construct(ExchangeService $exchangeService, Responses $response)
    {
        $this->exchangeService = $exchangeService;
        $this->response = $response;
    }

    public function convert()
    {
        try {
            $convertedValue = $this->exchangeService->convert($_GET['from'], $_GET['to'], $_GET['amount']);
            return $this->response->responseJSON($convertedValue);
        } catch (\Throwable $ex) {
            return $this->response->responseJSON($ex, 500);
        }
    }
}
