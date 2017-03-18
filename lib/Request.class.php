<?php

require_once('lib/CustomExceptions.php');


/**
 * Request Class
 *
 * This is a superclass that can retrieve input parameters from HTTP Requests.
 *
 * @author      Leonardo Baêta
 */
class Request {
	protected $requestArgs = [];

    public function __construct() {
        $this->setArgs();
    }

    /**
     * Get all arguments retrieved from http request.
     *
     * @return  string[]
     */
    public function getArgs() {
        return $this->requestArgs;
    }

    /**
     * Set all arguments retrieved from http request, get or post mode.
     */
    public function setArgs() {
        if($_SERVER['REQUEST_METHOD'] == 'GET'){
            $this->requestArgs = $_GET;
        } elseif ($_SERVER['REQUEST_METHOD'] == 'POST'){
            $this->requestArgs = $_POST;
        }
    }
}


/**
 * Request Conversor Class
 *
 * This class can retrieve HTTP Requests and validate with Conversor module business logic.
 *
 * @author      Leonardo Baêta
 */
class RequestConversor extends Request {

    public function __construct() {
        parent::__construct();
        $this->validateInput();
    }

    /**
     *  Validate input arguments requested with Conversor business logic.
     */
	protected function validateInput() {
        $requiredInputs = ['from', 'to', 'amount'];

        $inputKeys = array_keys($this->requestArgs);

        foreach($requiredInputs as $requiredInput){
            if(!in_array($requiredInput, array_keys($this->requestArgs))){
                throw new InvalidConversorParametersException('Os parämetros enviados estão incorretos.');
            }            
        }
	}
}

?>