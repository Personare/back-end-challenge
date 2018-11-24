<?php

namespace QuotationConverter;
class Router {
    private $method;
    private $path;
    private $callback;

    public function __construct(string $method, string $path)
    {
        if($this->isValidHTTPMethod($method) && $this->isValidPath($path)){
            $this->method = $method;
            $this->path = $path;
        }else{
            throw new \InvalidArgumentException('Invalid method');
        }
    }

    public function getMethod() : string
    {
        return $this->method;
    }

    public function execute($callback) : void
    {

    }

    private function isValidHttpMethod(string $method) : bool
    {
        return in_array($method, ['GET', 'POST', 'PUT', 'DELETE', 'HEAD', 'OPTIONS']);
    }

    private function isValidPath($path) : bool
    {
        return preg_match_all('/(^\^\/.+\$$)/', $path, $matches, PREG_UNMATCHED_AS_NULL) > 0;
    }



}
