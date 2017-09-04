<?php

namespace App\Http\Controllers;

use App\Services\Rates;
use Domain\Services\Currencies\GetCurrencyByIso;
use Domain\Services\ExchangeRate;
use Domain\ValueObject\Money;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;

/**
 * Class ExchangeController
 * @package App\Http\Controllers
 */
class ExchangeController extends Controller
{
    /**
     * @var ExchangeRate
     */
    private $exchangeRate;

    /**
     * @var GetCurrencyByIso
     */
    private $getCurrencyByIso;

    /**
     * @var Rates
     */
    private $rates;

    /**
     * ExchangeController constructor.
     * @param ExchangeRate $exchangeRate
     * @param GetCurrencyByIso $getCurrencyByIso
     * @param Rates $rates
     */
    public function __construct(ExchangeRate $exchangeRate, GetCurrencyByIso $getCurrencyByIso, Rates $rates)
    {
        $this->getCurrencyByIso = $getCurrencyByIso;
        $this->exchangeRate = $exchangeRate;
        $this->rates = $rates;
    }

    /**
     * @param ServerRequestInterface $request
     * @param $response
     * @param $args
     * @return \Zend\Diactoros\Response\JsonResponse
     * @throws \RuntimeException
     * @throws \InvalidArgumentException
     */
    public function index(ServerRequestInterface $request, ResponseInterface $response, $args): JsonResponse
    {
        $fromCurrency = $this->getCurrencyByIso->from($args['from']);
        $toCurrency = $this->getCurrencyByIso->from($args['to']);

        if ($fromCurrency && $toCurrency) {
            $this->exchangeRate->value($args['value']);
            $this->exchangeRate->rate($this->getRate($args));

            $from = new Money($args['value'], $fromCurrency);
            $to = new Money($this->exchangeRate->convertion(), $toCurrency);

            return $this->response([
                'data' => [
                    strtoupper($args['from']) => (string)$from,
                    strtoupper($args['to']) => (string)$to
                ]
            ]);
        }

        return $this->responseNotFound();
    }

    /**
     * @param $args
     * @return float
     * @throws \RuntimeException
     */
    private function getRate($args): float
    {
        if (array_key_exists('rate', $args)) {
            return $args['rate'];
        }

        return $this->rates->get($args['from'], $args['to']);
    }
}