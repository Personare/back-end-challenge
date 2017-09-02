<?php

namespace App\Providers;

use InvalidArgumentException;
use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\ServiceProvider\BootableServiceProviderInterface;
use PDO;

/**
 * Class DatabaseServiceProvider
 * @package App\Providers
 */
class DatabaseServiceProvider extends AbstractServiceProvider implements BootableServiceProviderInterface
{
    /**
     * Method will be invoked on registration of a service provider implementing
     * this interface. Provides ability for eager loading of Service Providers.
     *
     * @throws InvalidArgumentException
     */
    public function boot()
    {
        $this->getContainer()->add(PDO::class, function () {
            extract($this->getDsn(), EXTR_SKIP);

            $con = new PDO("mysql:host=$host;port={$port};dbname=$database", $username, $password, $options);
            $con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            return $con;
        });
    }

    /**
     * Use the register method to register items with the container via the
     * protected $this->container property or the `getContainer` method
     * from the ContainerAwareTrait.
     */
    public function register()
    {
    }

    /**
     * Return associative array for DSN Connection
     *
     * @return array
     */
    private function getDsn(): array
    {
        return [
            'host' => getenv('MYSQL_HOST'),
            'database' => getenv('MYSQL_DATABASE'),
            'password' => getenv('MYSQL_PASSWORD'),
            'username' => getenv('MYSQL_USER'),
            'port' => getenv('MYSQL_PORT'),
            'options' => [
                PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'
            ]
        ];
    }
}