<?php

use \PHPUnit\Framework\TestCase;
require_once('src/Router.php');

class RouterTest extends TestCase{
    private $router;

    public function setUp()
    {
        $this->router = new Router();
    }

    public function testRouterCanBeCreated()
    {

        $this->assertInstanceOf(Router::class, $this->router);
    }
}
