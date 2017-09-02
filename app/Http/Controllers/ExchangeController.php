<?php

namespace App\Http\Controllers;

use Domain\Services\Currencies\GetCurrencyByIso;
use Domain\Services\ExchangeRate;
use Domain\ValueObject\Money;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

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
     * ExchangeController constructor.
     * @param ExchangeRate $exchangeRate
     * @param GetCurrencyByIso $getCurrencyByIso
     */
    public function __construct(ExchangeRate $exchangeRate, GetCurrencyByIso $getCurrencyByIso)
    {
        $this->getCurrencyByIso = $getCurrencyByIso;
        $this->exchangeRate = $exchangeRate;
    }

    /**
     * @param ServerRequestInterface $request
     * @param $response
     * @param $args
     * @return \Zend\Diactoros\Response\JsonResponse
     * @throws \InvalidArgumentException
     */
    public function index(ServerRequestInterface $request, ResponseInterface $response, $args)
    {
        $fromCurrency = $this->getCurrencyByIso->from($args['from']);
        $toCurrency = $this->getCurrencyByIso->from($args['to']);

        if ($fromCurrency && $toCurrency) {
            $this->exchangeRate->value($args['value'])->rate($args['rate']);

            $from = new Money($args['value'], $fromCurrency);
            $to = new Money($this->exchangeRate->convertion(), $toCurrency);

            return $this->response([
                'data' => [
                    strtoupper($args['from']) => (string) $from,
                    strtoupper($args['to']) => (string) $to
                ]
            ]);
        }

        return $this->responseNotFound();
    }
}