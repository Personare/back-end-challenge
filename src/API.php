<?php
/**
 * @package Source
 * @category Model
 */

/**
 * Classe API
 * 
 * Classe genérica para leitura de dados em formato JSON por file-get ou CURL
 *
 * @todo 
 *
 * @author Eduardo Dotto Martucci <eduardo.martucci@gmail.com>
 * @copyright Copyright (c) 2021 Pesonare
 */

class API{
    
    private $tipo;
    private $url;
    
    function __construct($tipo){
        $this->setTipo($tipo);
    }
    
    function getTipo() {
        return $this->tipo;
    }

    function getUrl() {
        return $this->url;
    }

    function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    function setUrl($url) {
        $this->url = $url;
    }
    
    /**
     * Metodo getJson
     *
     * @param string $url string contendo a url a ser consultada através da função file-get
     *
     * @return json dados da consulta realizada via fileGet() ou CURL()
     *
     * <code>
     * <?php
     * $api = new API("curl");
     * $url = https://economia.awesomeapi.com.br/EUR-BRL/1
     * $json = $api->getJson($url);
     * print_r($json);
     * ?>
     * </code>
     *
     * @version 1.0
     * @author Eduardo Dotto Martucci <eduardo.martucci@gmail.com>
     * @copyright Copyright (c) 2021 Personare
     */
    
    public function getJson($url){
        try {

            if($this->getTipo() == "file-get"){
                return $this->fileGet($url);
            }

            if($this->getTipo() == "curl"){
                return $this->CURL($url);
            }

            if($this->getTipo() != "curl" && $this->getTipo() != "file-get"){
                throw new Exception('Tipo de leitura de dados da API não definido');
                //echo "Tipo de leitura de dados não definido";
            }

        } catch (Exception $e) {
            
            echo 'Exceção capturada: ',  $e->getMessage(), "\n";
            //echo $e->xdebug_message;
            exit();

        }
        
    }
    
    
    /**
     * Metodo File Get
     *
     * @param string $url string contendo a url a ser consultada através da função file-get
     *
     * @return json dados da consulta realizado via file-get()
     *
     * <code>
     * <?php
     * $api = new API("file-get");
     * $url = "https://economia.awesomeapi.com.br/EUR-BRL/1";
     * $this->fileGet($url)
     * ?>
     * </code>
     *
     * @version 1.0
     * @author Eduardo Dotto Martucci <eduardo.martucci@gmail.com>
     * @copyright Copyright (c) 2021 Personare
     */
    
    public function fileGet($url){
       return json_decode(file_get_contents($url));
    }
    
    /**
     * Metodo CURL
     *
     * @param string $url string contendo a url a ser consultada através da função curl
     *
     * @return json dados da consulta realizado via CURL()
     *
     * <code>
     * <?php
     * $api = new API("curl");
     * $url = https://economia.awesomeapi.com.br/EUR-BRL/1
     * $this->fileGet($url)
     * ?>
     * </code>
     *
     * @version 1.0
     * @author Eduardo Dotto Martucci <eduardo.martucci@gmail.com>
     * @copyright Copyright (c) 2021 Personare
     */
    public function CURL($url){
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        return json_decode(curl_exec($curl));
    }
   


}    
