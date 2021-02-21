<?php

namespace Src\Test;

require dirname(dirname(__FILE__)).'/vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use Src\Classes\Quotation;

class QuotationTest extends TestCase
{

    public function setUp(){
        $this->quotationsPath = dirname(dirname(__FILE__)).'/quotations.json';
        $this->quotation = new Quotation($this->quotationsPath);
    }


    public function tearDown(){
        unset($this->quotationsPath);
        unset($this->quotation);
    }


    public function testLoadAllQuotations(){
        $output = "The method loadAllQuotations doesn't return true";

        $this->assertTrue($this->quotation->LoadAllQuotations($this->quotationsPath), $output);
    }


    public function testGetAllQuotations(){
         $input = json_decode(file_get_contents($this->quotationsPath), true);
        $output = "The method getAllQuotations doesn't return the same decoded json.";

        $this->assertEquals($input, $this->quotation->getAllQuotations(), $output);
    }


    public function testLoadAllQuotationsExcpetion(){
        $this->expectException('BadMethodCallException');
        $this->quotation->LoadAllQuotations('InvalidFile.json');
    }


    public function testQuotationsNames(){
        $input = ["BRL-USD", "USD-BRL", "BRL-EUR", "EUR-BRL"];
        $output = "The method getQuotationsNames doesn't return ".'["BRL-USD", "USD-BRL", "BRL-EUR", "EUR-BRL"]';

        $this->assertEquals($input, $this->quotation->getQuotationsNames(), $output);
    }


    public function testQuotationSymbol(){
        $input = "$";
        $userQuotation = "BRL-USD";
        $output = "The method getQuotationsNames doesn't return "."$";

        $this->assertEquals($input, $this->quotation->getQuotationSymbol($userQuotation), $output);
    }


    public function testConvert(){
        $input = ["converted" => "$ 0,18"];
        $userQuotation = "BRL-USD";
        $output = "The method convert doesn't return "."$ 0,18";

        $this->assertEquals($input, $this->quotation->convert($userQuotation), $output);
    }
}
?>
