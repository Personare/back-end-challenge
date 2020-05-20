<?php declare(strict_types = 1);

namespace App\Controller;

use App\Entity\Currency\Factory;
use App\Service\Exchange as Service;
use App\Service\HttpResponse\IResponse;

class Exchange
{
    protected Service $service;

    protected IResponse $response;

    public function __construct(Service $service, IResponse $response)
    {
        $this->service = $service;
        $this->response = $response;
    }

    public function restApi(): void
    {
        try {
            $request = $this->parseRequest();

            $convertedData = $this->service
                ->setFrom(Factory::create($request['from']))
                ->setTo(Factory::create($request['to']))
                ->getConvertedData($request['value'], $request['rate']);

            echo $this->response->getResponse($convertedData, 200);
        } catch (\InvalidArgumentException $e) {
            echo $this->response->getResponse(
                [
                    'message' => $e->getMessage(),
                ],
                400,
            );
        } catch (\Throwable $e) {
            echo $this->response->getResponse(
                [
                    'message' => 'A API está instável no momento, tente mais tarde!',
                ],
                500,
            );
        }
    }

    /** @return array<int, string> */
    protected function getRequestUri(): array
    {
        // phpcs:ignore SlevomatCodingStandard.Variables.DisallowSuperGlobalVariable
        return explode('/', $_SERVER['REQUEST_URI']);
    }

    /** @return array{value: float, from: string, to: string, rate: float} */
    private function parseRequest(): array
    {
        $requestUri = $this->getRequestUri();

        if (!isset($requestUri[1]) || 'exchange' !== $requestUri[1]) {
            throw new \InvalidArgumentException('Método disponível: /exchange');
        }

        if (!isset($requestUri[2])) {
            throw new \InvalidArgumentException('Informe um valor ex.: /exchange/10');
        }

        if (!isset($requestUri[3])) {
            throw new \InvalidArgumentException('Informe a moeda de origem ex.: /exchange/10/BRL');
        }

        if (!isset($requestUri[4])) {
            throw new \InvalidArgumentException('Informe a moeda de destino ex.: /exchange/10/BRL/USD');
        }

        if (!isset($requestUri[5])) {
            throw new \InvalidArgumentException(
                'Informe a taxa de conversão ex.: /exchange/10/BRL/USD/6.78',
            );
        }

        return [
            'value' => (float) $requestUri[2],
            'from' => $requestUri[3],
            'to' => $requestUri[4],
            'rate' => (float) $requestUri[5],
        ];
    }
}
