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

        $path = $this->getPath();

        if (!in_array($_SERVER['REQUEST_METHOD'], (array) $this->method)) {
            return;
        }

        $matches = null;
        $regex = '/' . str_replace('/', '\/', $this->path) . '/';
        if (!preg_match_all($regex, $path, $matches)) {
            return;
        }

        if (empty($matches)) {
            $callback();
        } else {
            $params = array();
            foreach ($matches as $k => $v) {
                if (!is_numeric($k) && !isset($v[1])) {
                    $params[$k] = $v[0];
                }
            }
            $callback($params);
        }

        return;
    }

    private function isValidHttpMethod(string $method) : bool
    {
        return in_array($method, ['GET', 'POST', 'PUT', 'DELETE', 'HEAD', 'OPTIONS']);
    }

    private function isValidPath($path) : bool
    {
        $matches = null;
        return preg_match_all('/(^\^\/.+\$$)/', $path, $matches, PREG_UNMATCHED_AS_NULL) > 0;
    }

    private function getPath()
    {
        $path = parse_url($_SERVER['REQUEST_URI'])['path'];
        $scriptName = $this->getScriptName();

        $len = strlen($scriptName);
        if ($len > 0 && $scriptName !== '/') {
            $path = substr($path, $len);
        }

        return $path;

    }

    private function getScriptName()
    {
        $scriptName = dirname(dirname($_SERVER['SCRIPT_NAME']));
        $scriptName = str_replace('\\', '/', $scriptName);

        return $scriptName;
    }

}
