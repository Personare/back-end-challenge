<?php

namespace App\Controllers;

use App\Currencies\Currency;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

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
                'to' => $to->symbol($args['amount']),
            ]);
        } catch (\Exception $exception) {
            return $this->responseException($exception);
        }
    }
}