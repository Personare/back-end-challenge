<?php

namespace QuotationConverter;
class Router {
    private $method;
    private $path;
    private $callback;

    public function __construct(string $method, string $path, $callback)
    {
        if($this->isValidHTTPMethod($method)){
            $this->method = $method;
            $this->path = $path;
            $this->callback = $callback;
        }else{
            throw new \InvalidArgumentException('Invalid method');
        }
    }

    public function getMethod() : string
    {
        return $this->method;
    }

    public function execute() : void
    {

    }

    private function isValidHttpMethod(string $method) : bool
    {
        return in_array($method, ['GET', 'POST', 'PUT', 'DELETE', 'HEAD', 'OPTIONS']);
    }



}
