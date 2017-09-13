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

            return $this->response(['from' => $from->symbol(1)]);
        } catch (\Exception $exception) {
            return $this->responseException($exception);
        }
    }
}