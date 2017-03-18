<?php
require_once('lib/Conversor.class.php');
require_once('lib/Request.class.php');
require_once('lib/Response.class.php');

require_once('lib/CustomExceptions.php');


class ConversorTest extends PHPUnit_Framework_TestCase {

    /* Unit tests */

    public function invokeMethod(&$object, $methodName, array $parameters = array()) {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }

    private function mockHttpRequest($validRequest=true){
    	$_SERVER['REQUEST_METHOD'] = 'GET';
    	if($validRequest){
            $_GET = array('from'=>'USD', 'to'=>'BRL', 'amount' => '20');
        } else {
            $_GET = array('from'=>'USD', 'anything' => 'foo');
        }
    }

    public function testRequestConversorCanGetParams() {
		$this->mockHttpRequest(true);

    	$request = new RequestConversor();
    	$args = $request->getArgs();

        $this->assertTrue(count($args) === 3);
    }

    /**
     * @expectedException  InvalidConversorParametersException
     */
    public function testRequestConversorWithInvalidParamsMustThrowException() {
        $this->mockHttpRequest(false);

        $request = new RequestConversor();
        $args = $request->getArgs();
    }

    public function testConversorCanGetConvertedValue() {
        $conversor = new QuotationConversor('BRL', 'USD', 20);
        $convertedValue = $conversor->getConvertedValue();
        $this->assertTrue(is_numeric($convertedValue));
    }

    /**
     * @expectedException  QuotationNotFoundException
     */
    public function testConversorWithInvalidValuesMustThrowException() {
        $conversor = new QuotationConversor('BAR', 'FOO', 20);
        $convertedValue = $conversor->getConvertedValue();
    }

    public function testGetQuotationsDataFromJson() {
        $conversor = new QuotationConversor('BRL', 'USD', 20);
        $data = $this->invokeMethod($conversor, 'getQuotationsFromJson', array());
        $this->assertTrue(is_array($data) && !empty($data));
    }

}

?>