<?php

class ExchangeCest
{
    public function tryNumbersAsCurrency( \ApiTester $I ) : void
    {
        $I->sendGET('/2/10/USD/5');
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();           
    }

    public function tryCommaParameters( \ApiTester $I ) : void
    {
        $I->sendGET('/1,699/BRL/USD/5.9666');
        $I->seeResponseCodeIs(400);
        $I->seeResponseIsJson();   
    }

    public function mustPassedIntegerParameters( \ApiTester $I ) : void
    {
        $I->sendGET('/10/EUR/USD/5');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'valorConvertido' => 50,
            'simboloMoeda' => '$',
        ]);
    }

    public function mustPassedDoubleParameters( \ApiTester $I ) : void
    {
        $I->sendGET('/10/USD/BRL/2.5');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'valorConvertido' => 25,
            'simboloMoeda' => 'R$',
        ]);
    }

    public function mustPassedDoubleParametersAndResults( \ApiTester $I ) : void
    {
        $I->sendGET('/7.3/BRL/EUR/0.9');
        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'valorConvertido' => 6.57,
            'simboloMoeda' => '€',
        ]);
    }

}
