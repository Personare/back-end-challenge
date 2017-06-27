<?php

declare(strict_types=1);

namespace CurrencyConverter;

class TestCase extends \PHPUnit\Framework\TestCase
{
    public function invokeMethod(&$object, $method_name, array $parameters = array())
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($method_name);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }

    public function getPropertyValue(&$object, $property_name)
    {
        $reflection = new \ReflectionClass(get_class($object));
        $property = $reflection->getProperty($property_name);
        $property->setAccessible(true);

        return $property->getValue($object);
    }
}
