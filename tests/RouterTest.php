<?php
namespace QuotationConverter;

use \PHPUnit\Framework\TestCase;
use \QuotationConverter\Router;

class RouterTest extends TestCase{
    private $router;

    public function setUp()
    {
        $this->router = new Router('POST', '^/test$');
    }

    public function testRouterCanBeCreated()
    {
        $this->assertInstanceOf(Router::class, $this->router);
    }

    public function testRouterShouldHaveMethodPathAndCallback()
    {
        $this->assertClassHasAttribute('method', Router::class);
        $this->assertClassHasAttribute('path', Router::class);
        $this->assertClassHasAttribute('callback', Router::class);
    }

    public function testMethodAttributeShouldBeOneOfTheExistingHTTPMEthods()
    {
        $this->assertContains($this->router->getMethod(), ['GET', 'POST', 'PUT', 'DELETE', 'HEAD', 'OPTIONS']);
    }

    public function testShouldThrowAExceptionIfMethodIsInvalid()
    {
        $this->expectException(\InvalidArgumentException::class);
        $router = new Router('X', '^/test$');
    }

    public function testShouldThrowAExceptionIfPathIsNotARegex()
    {
        $this->expectException(\InvalidArgumentException::class);
        $router = new Router('GET', '/test');
    }

}
