<?php

class CurrencyConversionTest extends TestCase
{
    public function testValidateRealToDolar()
    {
        $this->get('/api/v1/from/Real/to/Dolar/value/20000')
        ->seeJson([
            'value' => '5,167.96',
            'symbol' => 'US$',
            'formatted' => 'US$ 5,167.96',
        ]);
    }
    
    public function testValidateDolarToReal()
    {
        $this->get('/api/v1/from/Dolar/to/Real/value/20000')
        ->seeJson([
            'value' => '77.400,00',
            'symbol' => 'R$',
            'formatted' => 'R$ 77.400,00',
        ]);
    }
    
    public function testValidateRealToEuro()
    {
        $this->get('/api/v1/from/Real/to/Euro/value/20000')
        ->seeJson([
            'value' => '4,535.15',
            'symbol' => 'EUR',
            'formatted' => 'EUR 4,535.15',
        ]);
    }
    
    public function testValidateEuroToReal()
    {
        $this->get('/api/v1/from/Euro/to/Real/value/20000')
        ->seeJson([
            'value' => '88.200,00',
            'symbol' => 'R$',
            'formatted' => 'R$ 88.200,00',
        ]);
    }
}
