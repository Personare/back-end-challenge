<?php

namespace App\Providers;

use InvalidArgumentException;
use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;
use Zend\Diactoros\Response;

/**
 * Class ResponseServiceProvider
 * @package App\Providers
 */
class ResponseServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{
    /**
     * Method will be invoked on registration of a service provider implementing
     * this interface. Provides ability for eager loading of Service Providers.
     *
     * @throws InvalidArgumentException
     */
    public function boot()
    {
        $this->getContainer()->share('response', Response::class);
    }

    /**
     * Use the register method to register items with the container via the
     * protected $this->container property or the `getContainer` method
     * from the ContainerAwareTrait.
     */
    public function register()
    {
    }
}