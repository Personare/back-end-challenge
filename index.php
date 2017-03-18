<?php

/**
 * Quotation Conversor API
 *
 * Converts currency quotations. 
 *
 * @author      Leonardo Baêta
 *
 * Request Examples:    ?from=BRL&to=USD&amount=200.67
 *                      ?from=USD&to=BRL&amount=100
 *                      ?from=EUR&to=BRL&amount=37.45
 *                      ?from=BRL&to=EUR&amount=9
 */

require_once('lib/Conversor.class.php');
require_once('lib/Request.class.php');
require_once('lib/Response.class.php');

require_once('lib/CustomExceptions.php');


try {
    $request = new RequestConversor();
    $args = $request->getArgs();
    $conversor = new QuotationConversor($args['from'], $args['to'], $args['amount']);
    $convertedValue = $conversor->getConvertedValue();
} catch (QuotationNotFoundException $e) {
    $response = new Response(array('error'=>$e->getMessage()));
    $response->printJson(400);
} catch (InvalidConversorParametersException $e) {
    $response = new Response(array('error'=>$e->getMessage()));
    $response->printJson(400);
} catch (Exception $e) {
    $response = new Response(array('error'=>'Ocorreu um erro no servidor.'));
    $response->printJson(500);
}

$responseItems = array(
	"currency" => $conversor->getCurrencyTo(),
	"amount" => $conversor->getConvertedValue()
);

$response = new Response($responseItems);
$response->printJson();

?>

