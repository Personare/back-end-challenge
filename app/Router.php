<?php

namespace App;

use League\Container\Container;
use League\Route\RouteCollection;
use League\Route\Strategy\JsonStrategy;
use Zend\Diactoros\Response;
use Zend\Diactoros\Response\SapiEmitter;
use Zend\Diactoros\ServerRequestFactory;

class Router
{
    /**
     * @var Container
     */
    private $container;

    /**
     * @var RouteCollection
     */
    private $collection;

    /**
     * Router constructor.
     * @throws \InvalidArgumentException
     */
    public function __construct()
    {
        $this->container = new Container;
        $this->container->share('response', Response::class);
        $this->container->share('emitter', SapiEmitter::class);
        $this->container->share('request', function () {
            return ServerRequestFactory::fromGlobals(
                $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
            );
        });

        $this->collection = new RouteCollection($this->container);
        $this->collection->setStrategy(new JsonStrategy);
    }

    /**
     * @return RouteCollection
     */
    public function collection()
    {
        return $this->collection;
    }

    /**
     * @throws \Psr\Container\ContainerExceptionInterface
     */
    public function dispatch()
    {
        $response = $this->collection->dispatch(
            $this->container->get('request'),
            $this->container->get('response')
        );

        $this->container->get('emitter')->emit($response);
    }
}