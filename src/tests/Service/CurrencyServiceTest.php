<?php

use App\Domain\Currency\Real;
use App\Http\Controllers\CurrencyController;
use App\Services\CurrencyService;

class CurrencyServiceTest extends TestCase
{
    protected $baseUrl = 'https://localhost:8000/currency';

    public function testCurrencyFail()
    {
        $this->get('/100/brl/euro');
        $this->assertEquals(403, $this->response->status());
    }

    public function testCurrencyCustomRate()
    {
        $this->get('/100/brl/eur/6.2');
        $this->assertEquals(200, $this->response->status());
    }

    public function testCurrencyExternalRate()
    {
        $this->get('/100/brl/eur/');
        $this->assertEquals(200, $this->response->status());
    }
}