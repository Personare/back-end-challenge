<?php

class CurrencyValidationDataTest extends TestCase
{
    
    public function testPingApi()
    {
        $this->get('/');
        
        $this->assertEquals(
            $this->response->getContent(), $this->app->version()
            );
    }
    
    public function testValidateCurrencyFromExists()
    {
        $this->get('/api/v1/from/Real/to/Dolar/value/20000')
            ->seeJson([
                'error' => 'Currency Real not found!',
            ], true);
    }
    
    public function testValidateCurrencyFromNotExists()
    {
        $this->get('/api/v1/from/Real2/to/Dolar/value/20000')
            ->seeJson([
                'error' => 'Currency Real2 not found!',
            ]);
    }
    
    public function testValidateCurrencyToExists()
    {
        $this->get('/api/v1/from/Real/to/Dolar/value/20000')
            ->seeJson([
                'error' => 'Currency Dolar not found!',
            ], true);
    }
    
    public function testValidateCurrencyToNotExists()
    {
        $this->get('/api/v1/from/Real/to/Dolar2/value/20000')
            ->seeJson([
                'error' => 'Currency Dolar2 not found!',
            ]);
    }
    
    public function testValidateCurrencyFromOrToIsReal()
    {
        $this->get('/api/v1/from/Euro/to/Dolar/value/20000')
            ->seeJson([
                'error' => 'The origin or destination currency should be Real!',
            ]);
    }
    
    public function testValidateDifferentCurrencies()
    {
        $this->get('/api/v1/from/Real/to/Real/value/20000')
            ->seeJson([
                'error' => 'The origin and destination currencies can not be the same!',
            ]);
    }
    
    public function testValidateValueNotNumeric()
    {
        $this->get('/api/v1/from/Real/to/Dolar/value/teste')
            ->seeJson([
                'error' => 'The value should be numeric!',
            ]);
    }
    
    public function testValidateValueNotPositive()
    {
        $this->get('/api/v1/from/Real/to/Dolar/value/-2000')
            ->seeJson([
                'error' => 'The value should be positive!',
            ]);
    }

}
