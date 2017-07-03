<?php 

use PHPUnit\Framework\TestCase;
use MoneyConvert\Conversor; 

class ConversorTest extends TestCase
{
    
    /**
     * @dataProvider baseProvider
     */
    public function testQuotation($from, $base)
    {
        $conversor = new Conversor($from, $base); 
        
        $this->assertTrue(
            is_numeric($conversor->getQuotation()),
            "Nao conseguiu recuperar a cotacao de {$from} para {$base}"
        ); 
    }

    /**
     * @dataProvider valueProvider
     */
    public function testConvertValues($from, $base, $value, $result)
    {
        $conversor = new Conversor($from, $base, true); 

        $this->assertEquals(
            $conversor->getConvertedNumber($value),
            $result,
            "Nao conseguiu converter de {$from} para {$base}"
        );
    }
    
    public function baseProvider()
    {
        return [
            ['BRL', 'USD'],
            ['USD', 'BRL'], 
            ['BRL', 'EUR'],
            ['EUR', 'BRL'] 
        ];
    }

    public function valueProvider()
    {
        return [
            ['BRL', 'USD', 5,   16.45],
            ['USD', 'BRL', 6,   1.80],
            ['BRL', 'EUR', 10,  37.60],
            ['EUR', 'BRL', 7,   1.82]
        ];
    }
}