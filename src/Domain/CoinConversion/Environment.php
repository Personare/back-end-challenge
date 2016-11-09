<?php
namespace CoinConversion;

interface Environment
{
    /**
     * @param string $key
     * @return string
     */
    public function get($key);
}
