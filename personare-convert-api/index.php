<?php 

	include 'vendor/autoload.php'; 
	include 'helpers/message.php'; 


	if (empty($_GET['from']) 
		|| empty($_GET['to']) 
		|| empty($_GET['value'])) {

		echo messageFailure("Algum parâmetro está incorreto ou faltando. Obrigatórios: &from=&to=&value=");
	}

	$from 	= $_GET['from']; 
	$to 	= $_GET['to']; 
	$value	= $_GET['value']; 

	$conversor = new MoneyConvert\Conversor($from, $to, true); 

	if (!$conversor)
		echo messageFailure("Erro ao tentar converter os valores.");
	

	$converted = $conversor->getConvertedNumber($value);

	if (!$converted) 
		echo messageFailure("Essa conversão não é suportada por essa API.");

	echo messageSuccess("Convertido com sucesso!", $converted);
