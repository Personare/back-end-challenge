<?php

require_once('lib/CustomExceptions.php');


/**
 * Quotation Conversor Class
 *
 * This class object get and convert currency quotations. 
 *
 * @author      Leonardo Baêta
 *
 * @param   string  $currencyFrom
 *                  Currency symbol that will be from reference 
 * @param   string  $currencyTo
 *                  Currency symbol that will be to reference
 * @param   float   $amountFrom
 *                  Amount to be converted with quotation
 */
class QuotationConversor {
    private $requestArgs = [];
    private $currencyFrom;
    private $currencyTo;
    private $amountFrom;

    public function __construct($currencyFrom, $currencyTo, $amountFrom) {
        $this->currencyFrom = $currencyFrom;
        $this->currencyTo = $currencyTo;
        $this->amountFrom = $amountFrom;
        $this->quotation = $this->getQuotation();
    }

    /**
     * Get requested quotation data
     */
    private function getQuotation(){
        if($this->currencyFrom == $this->currencyTo){
            return array($this->currencyFrom, $this->currencyTo, 1);
        }

    	$quotationList = $this->getQuotationsFromJson();
        $requestedQuotation = array_filter($quotationList, array($this, 'filterQuotationFromObject'), ARRAY_FILTER_USE_BOTH);
        if(empty($requestedQuotation)){
            throw new QuotationNotFoundException('Nenhuma cotação foi encontrada de acordo com os parâmetros enviados.');
        }

        return current($requestedQuotation);
    }

    /**
     * Get all quotation data from a JSON file
     *
     * @return  string[]
     */
    private function getQuotationsFromJson(){
       return json_decode(file_get_contents('data.json'), false)->data;
    }

    /**
     * Filter to get only the requested data needed
     *
     * @param   string[]    $value
     * @return  string[]
     */
    private function filterQuotationFromObject($value){
        return 
            ($value[0] == $this->currencyFrom && $value[1] == $this->currencyTo) || 
            ($value[1] == $this->currencyFrom && $value[0] == $this->currencyTo);
    }

    /**
     * CurrencyTo getter
     *
     * @return  string
     */
    public function getCurrencyTo(){
        return $this->currencyTo;
    }

    /**
     * Calculate and get converted value by input quotation and amount.
     *
     * @return  float
     */
    public function getConvertedValue(){
        if($this->currencyTo == $this->quotation[1]){
            $convertedValue = $this->amountFrom * $this->quotation[2];
        } else {
            $convertedValue = $this->amountFrom / $this->quotation[2];
        }
        return number_format((float)$convertedValue, 2);
    }
}

?>