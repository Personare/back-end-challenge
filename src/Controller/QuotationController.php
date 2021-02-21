<?php

namespace Src\Controller;

use Src\Classes\Quotation as Quotation;

class QuotationController {

	private $userQuotation;
	private $quotationsPath;
	private $quotationEntity;

	public function __construct($userQuotation, $quotationsPath){
		$this->userQuotation = $userQuotation;
		$this->quotationEntity = new Quotation($quotationsPath);
	}

	/**
	 * process the HTTP request
	 * @return json
	 */
	public function processRequest(){

		if($this->validateQuotations($this->userQuotation)){
			$response = $this->fromToQuotation($this->userQuotation);
		}
		else{
			$response = $this->unprocessableQuotationsResponse();
		}

		return $response;
	}


	/**
	 * make the conversion and return the HTTP response
	 * @param  string $quotations
	 * @return array
	 */
	private function fromToQuotation($quotations){
		$converted = $this->quotationEntity->convert($quotations);
		$response['status_code_header'] = 'HTTP/1.1 200 OK';
		$response['body'] = json_encode($converted);
		return $response;

	}


	/**
	 * check if the quotations from the request are valid
	 * @param  string $quotations
	 * @return boolean
	 */
	private function validateQuotations($quotations){
		$quotationsAvailable = $this->quotationEntity->getQuotationsNames();
		if(in_array($quotations, $quotationsAvailable)){
			return true;
		}
		else{
			return false;
		}
	}


	/**
	 * 422 HTTP response for invalid quotations
	 * @return array
	 */
	private function unprocessableQuotationsResponse()
	{
		$response['status_code_header'] = 'HTTP/1.1 422 Unprocessable Quotations';
		$response['body'] = json_encode([
			'error' => 'Invalid quotations'
		]);
		return $response;
	}


	/**
	 * 404 HTTP response
	 * @return array
	 */
	private function notFoundResponse()
	{
		$response['status_code_header'] = 'HTTP/1.1 404 Not Found';
		$response['body'] = null;
		return $response;
	}

}

