<?php

namespace MoneyConverter\Domain\Service;

use MoneyConverter\Domain\Repository\ExchangeRepositoryInterface;
use MoneyConverter\Domain\Service\ExchangeService;
use MoneyConverter\Domain\ValueObject\Currency;


class ExchangeAPIService {
	private $exchangeService;
	private $fromCurrency;
	private $toCurrency;
	private $amount;

	public function __construct(ExchangeRepositoryInterface $exchangeRepository) {
		$this->setHeaders();

		if (!$this->isArgsValid()) {
			$this->responseJSON(['error' => 'Arguments not valid'], 400);
		}

		$this->fromCurrency = new Currency($_GET['from']);
		$this->toCurrency = new Currency($_GET['to']);
		$this->amount = str_replace(',', '.', $_GET['amount']);
		$this->amount = number_format($this->amount, 3);
		$this->exchangeService = new ExchangeService($exchangeRepository);
	}

	/**
     * Set the headers
     *
     * @header Access-Control-Allow-Orgin
     * @header Access-Control-Allow-Methods
     * @header Cache-Control
     * @header Last-Modified
     * @header Expires
     * @header Pragma
     * @header Content-Type
    **/
    private function setHeaders() {
    	// Not be cached by the client browser or any proxy caches
        header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
        header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        // Enable CORS and Methods
        header("Access-Control-Allow-Orgin: *");
        header("Access-Control-Allow-Methods: GET");
        // Outputting a JSON
        header("Content-Type: application/json; charset=utf-8");
    }

	/**
     * Send a response HTTP in Json format
     *
     * @param Array $data
     * @param Number $status
    **/
    private function responseJSON($data, $status = 200) {
        header($_SERVER["SERVER_PROTOCOL"] . " " . $status . " " . $this->responseStatus($status));
        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        exit;
    }

    /**
     * Request status code
     * 
     * For now we use four status.
    **/
    private function responseStatus($code) {
        $status = array(  
            200 => 'OK',
            404 => 'Not Found',   
            405 => 'Method Not Allowed',
            500 => 'Internal Server Error',
        ); 

        return ($status[$code]) ? $status[$code] : $status[500]; 
    }

    private function isArgsValid($allowedArgs=['from', 'to', 'amount']) {
    	foreach ($allowedArgs as $arg) {
			if(!array_key_exists($arg, $_GET)) {
				return false;
			}
        }
		return true;
    }

    /**
     * Run
    **/
    public function run() {
        switch ($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $convertedMoney = $this->exchangeService->convert($this->fromCurrency, $this->toCurrency, $this->amount);;
                break;
            default:
                return $this->responseJSON('Invalid Method', 405);
                break;
        }

        $reponseData = array(
        	'symbol' => $convertedMoney->currency()->symbol(),
        	'amount' => $convertedMoney->amount()
        );

        return $this->responseJSON($reponseData);
    }
}

?>