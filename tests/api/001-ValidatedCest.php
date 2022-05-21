<?php

class ValidatedCest
{

    public function tryStatus( \ApiTester $I ) : void
    {
        $I->sendGET('/');
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }

    public function tryWrongRoute( \ApiTester $I ) : void
    {
        $I->sendGET('0121AA/');
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }

    public function tryOneNumber( \ApiTester $I ) : void
    {
        $I->sendGET('/5');
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }

    public function tryTwoNumbers( \ApiTester $I ) : void
    {
        $I->sendGET('/5/10');
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }

    public function tryOneCurrency( \ApiTester $I ) : void
    {
        $I->sendGET('/BR');
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }

    public function tryOneCurrencyLowerCase( \ApiTester $I ) : void
    {
        $I->sendGET('/br');
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }    

    public function tryTwoCurrency( \ApiTester $I ) : void
    {
        $I->sendGET('/BR/USD/');
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }

    public function tryTwoCurrencyLowerCase( \ApiTester $I ) : void
    {
        $I->sendGET('/br/usd');
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }

    public function tryOneCurrencyOneNumber( \ApiTester $I ) : void
    {
        $I->sendGET('/BR/10');
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }

    public function tryTwoCurrencyOneNumber( \ApiTester $I ) : void
    {
        $I->sendGET('/BR/10/USD/');
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }

    public function tryOneNumberTwoCurrency( \ApiTester $I ) : void
    {
        $I->sendGET('/10/USD/BR');
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }    

    public function tryTwoCurrencyTwoNumbers( \ApiTester $I ) : void
    {
        $I->sendGET('/BR/10/USD/10');
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }

    public function tryTwoNumbersTwoCurrency( \ApiTester $I ) : void
    {
        $I->sendGET('/10/BR/10/USD');
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }

    public function tryTwoCurrencyTwoNumbersLowerCase( \ApiTester $I ) : void
    {
        $I->sendGET('/BR/10/usd/10');
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }

    public function tryWrongCurrencyTwoNumbers( \ApiTester $I ) : void
    {
        $I->sendGET('/T/10/USD/10');
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();
    }

}
