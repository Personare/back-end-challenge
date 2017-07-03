<?php 

namespace MoneyConvert; 

class Conversor 
{
	protected $from; 
	protected $base; 
	
	/**
	 * URL base para a API externa fixer.io
	 */
	protected $API_EXTERNAL_URL = "http://api.fixer.io/latest?base="; 
	
	/**
	* Para fins de teste, quando o "test_mode" está habilitado, a classe utiliza apenas as cotações 
	* default pré definidas, não utilizando a API externa.
	*/
	protected $test_mode = false; 

	public function __construct($from, $base, $test_mode=false)
	{
		if (!$from || !$base) 
			return false;
		
		$this->from = $from;
		$this->base = $base;

		if (is_bool($test_mode))
			$this->test_mode = $test_mode; 
	}

	/**
	 * Função que obtém a cotação atual sob a moeda informada pelo usuário. A cotação obtida pode ser Real ou Default. 
	 * @return double
	 */
	public function getQuotation()
	{
		
		if (($quot = $this->getQuotationFromExternalApi($this->from, $this->base))
			&& !$this->test_mode) {
			return $quot;  	
		} elseif ($quot = $this->getQuotationFromDefault($this->from, $this->base)) {
			return $quot;
		} else {
			return false; 
		}
	}

	/**
	 * Função que multiplica o valor passado pelo usuário pelo valor de cotação obtido. 
	 * @param numeric $value 
	 * @return double
	 */
	public function getConvertedNumber($value)
	{
		if (!$value && !is_numeric($value))
			return false; 

		$quotation = $this->getQuotation();
		return $value * $quotation; 
	}

	/**
	 * Fixa valores padrão para cotação de algumas moedas (requeridas para o desafio personare) e retorna-os dependendo da entrada do usuário. 
	 * @return double || bool
	 */
	public function getQuotationFromDefault()
	{
		
		$quotation = [
			'BRL-USD' => 3.29,
			'USD-BRL' => 0.30,
			'BRL-EUR' => 3.76,
			'EUR-BRL' => 0.26,
		];

		return isset($quotation[$this->from."-".$this->base]) ? $quotation[$this->from."-".$this->base] : false;  
	}
	
	/**
	 * Função criada para obter a cotação atual da moeda de uma API externa interessante, chamada fixer. 
	 * É utilizada apenas quando o "test_mode" está desabilitado. 
	 * @return double || bool
	 */
	public function getQuotationFromExternalApi() 
	{
		$content = file_get_contents($this->API_EXTERNAL_URL . $this->base); 
		 
		if (!$content) 
			return false; 
		
		$content = json_decode($content); 
 
		return !empty($content->rates->{$this->from}) ? $content->rates->{$this->from} : false; 		
	}
}