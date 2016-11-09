<?php
namespace CoinConversion\Environment;

use CoinConversion\Environment;

class LocalEnvironment implements Environment
{
    /**
     * @param string $key
     * @return string
     */
    public function get($key)
    {
        return getenv($key);
    }
}
