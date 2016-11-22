<?php
namespace Api\Cotacao;

/**
 * Classe responsável por receber as cotações  atualizadas
 * de um servidor Web
 * 
 * https://economia.awesomeapi.com.br/json/all
 * 
 * @author Andre Eppinghaus
 *        
 */
class Cotacao
{
    private $url ;
    private $cotacao; 
    /**
     * Define o servidor
     * @param string $servidor
     */
    public function __construct($servidor=null)
    {
        if (empty($servidor)) {
            $this->url = "https://economia.awesomeapi.com.br/json/all";
        }else {
            $this->url = $servidor;
        }
        
    }
    /**
     * Pega a cotacao das moedas em um servidor
     * 
     * @return object
     */
    private function getCotacao() {

        if($this->cotacao != null ) {
            return $this->cotacao;
        }
        
        $curl = curl_init($this->url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        
        $curl_response = curl_exec($curl);
        
        if ($curl_response === false) {
            $info = curl_getinfo($curl);
            curl_close($curl);
            die('error occured during curl exec. Additioanl info: ' . var_export($info));
        }
        curl_close($curl);
        $this->cotacao = json_decode($curl_response);
        if (isset($decoded->response->status) && $decoded->response->status == 'ERROR') {
            die('error occured: ' . $decoded->response->errormessage);
        }
       
       return $this->cotacao;      
    }
    
    /**
     * Retorna o valor máximo do dolar
     * @return float
     */
    public function getDolar() {
        $cotacao = $this->getCotacao();
        
       if (empty($cotacao)) {
           throw new \InvalidArgumentException('Servidor de cotação não acessível');
       }
        return $cotacao->USD->high;
    }
    
    /**
     * Retorna o valor máximo do Euro
     * @return float
     */
    public function getEuro() {
        $cotacao = $this->getCotacao();
        if (empty($cotacao)) {
            throw new \InvalidArgumentException('Servidor de cotação não acessível');
        }
        return $cotacao->EUR->high;
    }
    
}

