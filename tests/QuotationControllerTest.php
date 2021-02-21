<?php

namespace Src\Test;

require dirname(dirname(__FILE__)).'/vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use Src\Classes\Quotation as Quotation;
use Src\Controller\QuotationController as QuotationController;

class QuotationControllerTest extends TestCase
{
    public function setUp(){
        $this->userQuotation = 'BRL-USD';
        $this->quotationsPath = dirname(dirname(__FILE__)).'/quotations.json';
        $this->quotationController = new QuotationController($this->userQuotation, $this->quotationsPath);
    }


    public function tearDown(){
        unset($this->userQuotation);
        unset($this->quotationsPath);
        unset($this->quotationControllerEntity);
    }


    public function testValidProcessRequest(){

        $output = "The method processRequest doesn't return same response";
        $converted['converted'] = '$'." ".'0,18';
        $input['status_code_header'] = 'HTTP/1.1 200 OK';
        $input['body'] = json_encode($converted);

        $this->assertEquals($input, $this->quotationController->processRequest(), $output);
    }


    public function testValidateQuotations(){
        $possibleQuotations = ["BRL-USD", "USD-BRL", "BRL-EUR", "EUR-BRL"];
        $Quotation = $this->getMockBuilder('Src\Classes\Quotation')->setConstructorArgs([$this->quotationsPath])->setMethods(['getQuotationsNames'])->getMock();
        $Quotation->method('getQuotationsNames')->will($this->returnValue($possibleQuotations));

        $obj = $this->quotationController;
        $output = "The method validateQuotations doesn't return true";

        $this->assertTrue($this->invokeMethod($obj, 'validateQuotations', ['BRL-USD']), $output);
    }


    public function testFromToQuotation(){
        $converted['converted'] = '$'." ".'0,18';
        $Quotation = $this->getMockBuilder('Src\Classes\Quotation')->setConstructorArgs([$this->quotationsPath])->setMethods(['convert'])->getMock();
        $Quotation->method('convert')->will($this->returnValue($converted));

        $obj = $this->quotationController;

        $input['status_code_header'] = 'HTTP/1.1 200 OK';
        $input['body'] = json_encode($converted);
        $output = "The method fromToQuotation doesn't return same array";

        $this->assertEquals($input, $this->invokeMethod($obj, 'fromToQuotation', [$this->userQuotation]), $output);
    }


    public function testNotFoundResponse(){
        $obj = $this->quotationController;

        $input['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $input['body'] = null;
        $output = "The method notFoundResponse doesn't return same array";

        $this->assertEquals($input, $this->invokeMethod($obj, 'notFoundResponse'), $output);
    }


    public function testUnprocessableQuotationsResponse(){
        $obj = $this->quotationController;

        $input['status_code_header'] = 'HTTP/1.1 422 Unprocessable Quotations';
        $input['body'] = json_encode([
            'error' => 'Invalid quotations'
        ]);
        $output = "The method unprocessableQuotationsResponse doesn't return same array";

        $this->assertEquals($input, $this->invokeMethod($obj, 'unprocessableQuotationsResponse'), $output);
    }


    /**
    * Call protected/private method of a class.
    *
    * @param object &$object Instantiated object that we will run method on
    * @param string $methodName Method name to call
    * @param array  $parameters Array of parameters to pass into method
    *
    * @return mixed Method return
    */
    public function invokeMethod(&$object, $methodName, array $parameters = array())
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }
}
