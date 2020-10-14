<?php

namespace App\Controller;

use App\Service\CurrencyService;
use App\Http\Response\Interfaces\ResponseInterface;
use App\Domain\Currency\Factories\CurrencyFactory;

use InvalidArgumentException;

class ApiController
{
    protected CurrencyService $service;
    protected ResponseInterface $response;

    public function __construct(CurrencyService $service, ResponseInterface $response)
    {
        $this->service = $service;
        $this->response = $response;
    }

    protected function getRequestUri() : array
    {
        return explode('/', $_SERVER['REQUEST_URI']);
    }

    private function validateRequest(): array
    {
        $requestUri = $this->getRequestUri();

        if (!isset($requestUri[1]) || 'currency' != $requestUri[1]) {
            throw new InvalidArgumentException('Wrong params. Use /currency');
        }

        if (!isset($requestUri[2])) {
            throw new InvalidArgumentException('Please inform currency amount. 
                ex: /currency/100'
            );
        }

        if (!isset($requestUri[3])) {
            throw new InvalidArgumentException('Invalid currency. 
                Avaliability: /currency/100/BRL|USD|EUR'
            );
        }

        if (!isset($requestUri[4])) {
            throw new InvalidArgumentException('Invalid currency. 
                Avaliability: 
                    /currency/100/BRL/USD|EUR, 
                    /currency/100/USD/BRL, 
                    /currency/100/EUR/BRL'
                );
        }

        if (!isset($requestUri[5])) {
            throw new InvalidArgumentException('Please inform rate conversion. 
                ex: /currency/100/BRL/USD/5.77'
            );
        }

        return [
            'value' => (float) $requestUri[2],
            'from'  => strtoupper($requestUri[3]),
            'to'    => strtoupper($requestUri[4]),
            'rate'  => (float) $requestUri[5]
        ];
    }

    public function personareApi(): void
    {
        try {
            $request = $this->validateRequest();

            $response = $this->service->setFrom(CurrencyFactory::create($request['from']))
                ->setTo(CurrencyFactory::create($request['to']))
                ->getConversion($request['value'], $request['rate']);

            print $this->response->getResponse($response, 200);

        } catch (InvalidArgumentException $e) {
            print $this->response->getResponse(['message' => $e->getMessage()], 400);
        }
    }
}
