<?php

namespace App;

use League\Container\Container;
use League\Container\ReflectionContainer;
use League\Route\RouteCollection;
use League\Route\Strategy\JsonStrategy;
use Psr\Container\ContainerExceptionInterface;

/**
 * Class Application
 * @package App
 */
class Application extends Container
{
    /**
     * @var RouteCollection
     */
    private $router;

    /**
     * Application constructor.
     * @param null $providers
     * @param null $inflectors
     * @param null $definitionFactory
     * @throws ContainerExceptionInterface
     */
    public function __construct($providers = null, $inflectors = null, $definitionFactory = null)
    {
        parent::__construct($providers, $inflectors, $definitionFactory);

        $this->delegate(new ReflectionContainer);
        $this->registerServiceProviders();
        $this->registerRoutes();
    }

    /**
     * @param string $path
     * @return string
     */
    public function path(string $path = ''): string
    {
        return __DIR__ . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }

    /**
     * Configure container service providers
     */
    private function registerServiceProviders()
    {
        foreach (glob($this->path('Providers/*.php')) as $file) {
            $this->addServiceProvider('App\\Providers\\' . basename($file, '.php'));
        }
    }

    /**
     * Map application routes
     * @throws ContainerExceptionInterface
     */
    private function registerRoutes()
    {
        $this->router = new RouteCollection($this);
        $this->router->setStrategy(new JsonStrategy);

        foreach (glob($this->path('Http/Routes/*.php')) as $file) {
            $this->get('App\\Http\\Routes\\' . basename($file, '.php'))->map($this->router);
        }
    }

    /**
     * Run the application
     *
     * @throws ContainerExceptionInterface
     */
    public function run()
    {
        $response = $this->router->dispatch(
            $this->get('request'),
            $this->get('response')
        );

        $this->get('emitter')->emit($response);
    }
}