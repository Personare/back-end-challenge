<?php

namespace Tests;

use PHPUnit\Framework\TestCase;
use App\Application;

class TestBase extends TestCase
{
    /**
     * @var Application
     */
    private $app;

    /**
     * @return Application
     */
    public function app(): \App\Application
    {
        if (!$this->app) {
            $this->app = new Application();
        }

        return $this->app;
    }
}