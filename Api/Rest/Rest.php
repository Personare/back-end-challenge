<?php
namespace Api\Rest;

/**
 *
 * Servidor restfull 
 * Esta classe trata do controle do servidor rest
 * @author Andre Eppinghaus
 *        
 */
class Rest
{
    private $server, $parametros;

    /**
     * @param array $_SERVER
     * @throws InvalidArgumentException
     */
    public function __construct($server)
    {
       $this->server = $server;
    }
    /**
     * Verifica se os parametros de conexão foram passados 
     * corretamente 
     * @throws \Exception
     * @return boolean
     */
    public function isValid()
    {
    
        $server = $this->server;
        
        //Make sure that it is a POST request.
        if(strcasecmp($server['REQUEST_METHOD'], 'POST') != 0){
            throw new \Exception('O método de Request deve ser POST');
        }
    
        //Make sure that the content type of the POST request has been set to application/json
        $contentType = isset($server["CONTENT_TYPE"]) ? trim($server["CONTENT_TYPE"]) : '';
        if(strcasecmp($contentType, 'application/json') != 0){
            throw new \Exception('O Content-Type deve ser: application/json');
        }
    
        //Receive the RAW post data.
        $content = trim(file_get_contents("php://input"));
    
        //Attempt to decode the incoming RAW post data from JSON.
        $decoded = json_decode($content, true);
    
        //If json_decode failed, the JSON is invalid.
        if(!is_array($decoded)){
            throw new \Exception('JSON inválido');
        }
    
        $this->parametros = $decoded;
        return true;
      
    }
    /**
     * Retorna os parâmetros validados
     * @return mixed
     */
    public function getParametros() { 
        return $this->parametros;
    }
        
}

