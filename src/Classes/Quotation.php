<?php

namespace Src\Classes;

use BadMethodCallException;

class Quotation{

	private $allQuotations = "";

	public function __construct($quotationsPath){
		$this->loadAllQuotations($quotationsPath);
	}


	/**
	 * load all the quotations from a file
	 * @param  string $quotationsPath json file
	 * @return boolean
	 */
	public function loadAllQuotations($quotationsPath){
		if(!file_exists($quotationsPath)){
			throw new BadMethodCallException("Invalid quotations file");
		}
		$this->allQuotations = json_decode(file_get_contents($quotationsPath), true);
		return true;
	}


	/**
	 * get all quotations loaded
	 * @return array
	 */
	public function getAllQuotations(){
		return $this->allQuotations;
	}


	/**
	 * get all quotations names
	 * @return array
	 */
	public function getQuotationsNames(){
		return array_keys($this->allQuotations);
	}


	/**
	 * get a quotation symbol
	 * @param  string $quotation
	 * @return string
	 */
	public function getQuotationSymbol($quotation){
		return $this->getAllQuotations()[$quotation]['symbol'];
	}


	/**
	 * make the converted message
	 * @param  string $currencies
	 * @return array
	 */
	public function convert($currencies){
		$converted = [];
		$converted['converted'] = $this->allQuotations[$currencies]['symbol']." ".$this->allQuotations[$currencies]['value'];
		return $converted;
	}
}

?>
