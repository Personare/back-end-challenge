<?php

/**
 * Response Class
 *
 * This class can return response appropriately to client.
 *
 * @author      Leonardo Baêta
 *
 * @param   string[]    $responseItems
 *                      List with items to response.
 */
class Response {

    private $responseItems;
    
    public function __construct($responseItems) {
        $this->responseItems = $responseItems;
    }

    /**
     * Prints items in JSON format.
     *
     * @return  string[]    $httpCode
     *                      Http Code that can be returned. default=200
     */
    public function printJson($httpCode = 200) {
        header('Content-Type:application/json; charset=utf-8');
        header('HTTP/1.1 ' . $httpCode);
        print json_encode($this->responseItems);
        exit();
    }
}

?>