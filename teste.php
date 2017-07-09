<?php
require_once ("ConversionsDao.php");

$from       = $_GET["from"];
$to         = $_GET["to"];
$value      = $_GET["value"];
$quotation  = $_GET["quotation"];

$conversionsDao = new ConversionsDao();
$conversionsValue = json_encode($conversionsDao->conversionsValue($from,$to,$value,$quotation));
print_r($conversionsValue);

//http://localhost/back-end-challenge/teste.php?from=BRL&to=USD&value=875.23&quotation=2.68