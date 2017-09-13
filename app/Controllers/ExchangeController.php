<?php

namespace App\Controllers;

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
        return $this->response(['message' => 'ok']);
    }
}