<?php

namespace App\Controllers;

use App\Currencies\Currency;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Rdehnhardt\ExchangeRate\Exchange;

class ExchangeController extends Controller
{
    /**
     * @param ServerRequestInterface $request
     * @param ResponseInterface $response
     * @param array $args
     * @return ResponseInterface
     * @throws \InvalidArgumentException
     */
    public function process(ServerRequestInterface $request, ResponseInterface $response, array $args = [])
    {
        try {
            $from = Currency::factory($args['from']);
            $to = Currency::factory($args['to']);

            return $this->response([
                'from' => $from->symbol($args['amount']),
                'to' => $to->symbol($this->getExchange($args)),
            ]);
        } catch (\Exception $exception) {
            return $this->responseException($exception);
        }
    }

    /**
     * @param array $args
     * @return int
     * @throws \Rdehnhardt\ExchangeRate\Excaptions\NotFoundException
     */
    private function getExchange(array $args)
    {
        if (!array_key_exists('rate', $args)) {
            return (new Exchange())->rate($args['amount'], $args['from'], $args['to']);
        }

        return (new Exchange())->rate($args['amount'], $args['from'], $args['to'], $args['rate']);
    }
}