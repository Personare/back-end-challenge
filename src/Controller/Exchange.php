<?php declare(strict_types = 1);

namespace App\Controller;

use App\Entity\Currency\Factory;
use App\Service\Exchange as Service;
use App\Util\Responses;

class Exchange
{
    protected Service $service;

    protected Responses $responses;

    public function __construct(Service $service, Responses $response)
    {
        $this->service = $service;
        $this->responses = $response;
    }

    public function restApi(): void
    {
        try {
            $request = $this->parseRequest();

            $convertedData = $this->service
                ->setFrom(Factory::create($request['from']))
                ->setTo(Factory::create($request['to']))
                ->getConvertedData($request['value'], $request['rate']);

            $this->responses->responseJSON($convertedData, 200);
        } catch (\InvalidArgumentException $e) {
            $this->responses->responseJSON(
                [
                    'message' => $e->getMessage(),
                ],
                400,
            );
        } catch (\Throwable $e) {
            $this->responses->responseJSON(
                [
                    'message' => 'A API está instavel no momento, tente mais tarde!',
                ],
                500,
            );
        }
    }

    /** @return array{value: float, from: string, to: string, rate: float} */
    private function parseRequest(): array
    {
        // phpcs:ignore SlevomatCodingStandard.Variables.DisallowSuperGlobalVariable
        $requestUri = explode('/', $_SERVER['REQUEST_URI']);

        if (!isset($requestUri[1]) || 'exchange' !== $requestUri[1]) {
            throw new \InvalidArgumentException('Método não implementado!');
        }

        if (!isset($requestUri[2])) {
            throw new \InvalidArgumentException('Valor não informado!');
        }

        if (!isset($requestUri[3])) {
            throw new \InvalidArgumentException('Não informada a moeda de origem!');
        }

        if (!isset($requestUri[4])) {
            throw new \InvalidArgumentException('Não informada a moeda de destino!');
        }

        if (!isset($requestUri[5])) {
            throw new \InvalidArgumentException(
                'Taxa de conversão não foi informada!',
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
