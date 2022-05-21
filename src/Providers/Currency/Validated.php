<?php
/**
 * File Validated.php /Providers/Currency
 *
 * PHP Version 8.1
 *
 * @category Providers_Currency
 * @package  Personare_BackEndChallenge
 * @author   Emanuel Souza <emanuel.inacios@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     http://localhost:8080/
 */

namespace Personare\BackEndChallenge\Providers\Currency;

/**
 * Validated request
 *
 * @category Providers_Currency
 * @package  Personare_BackEndChallenge
 * @author   Emanuel Souza <emanuel.inacios@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     http://localhost:8080/
 */
class Validated
{

    protected bool $error = false;
    protected array $message;
    protected array $request;
    protected array $acceptableCurrency = [
        'BRL',
        'USD',
        'EUR'
    ];
    
    /**
     * ValidateRequest
     *
     * @param mixed $request to split and verify
     * 
     * @return array sendResults functions
     */
    public function validateRequest( string $request ) : array
    {
        $this->request = preg_split("/\//", $request);

        if (! $this->validateNumberParameters() ) :
            return $this->sendResults();
        endif;

        if (! $this->checkTypesRequest() ) :
            return $this->sendResults();
        endif;

        if (! $this->checkAcceptableCurrency() ) :
            return $this->sendResults();
        endif;

        return $this->sendResults();
    }
    
    /**
     * ValidateNumberParameters
     *
     * @return bool ? parameters
     */
    protected function validateNumberParameters() : bool
    {
        if (sizeof($this->request) < 6 ) :
            $this->error = true;
            $this->message = [
                'errorItem' => 'Number Parameters',
                'message' => 'Must have minimun 4 parameters'
            ];

            return false;
        endif;

        return true;
    }
    
    /**
     * CheckTypesRequest
     *
     * @return bool ? types parameters
     */
    protected function checkTypesRequest() : bool
    {
        $error = '';

        if (! is_numeric($this->request[2]) || ( $this->request[2] < 0 ) ) :
            $error = "Parameter 1 Request must be number and greater than 0";
        endif;

        if (! is_string($this->request[3]) || strlen($this->request[3]) <> 3 ) :
            $error = $error . "- Parameter 2 Request must be type of coin";
        endif;

        if (! is_string($this->request[4]) || strlen($this->request[4]) <> 3 ) :
            $error = $error . "- Parameter 3 Request must be type of coin";
        endif;

        if (! is_numeric($this->request[5]) || ( $this->request[5] < 0 ) ) :
            $error = $error . "- Parameter 4 Request must be number greater than 0";
        endif;

        if (! empty($error) ) :
            $this->error = true;
            $this->message = [
                'errorItem' => 'Parameter',
                'message' => $error 
            ];
            return false;
        endif;

        return true;
    }

    /**
     * CheckAcceptableCurrency
     *
     * @return bool ? acceptable currency
     */
    protected function checkAcceptableCurrency() : bool
    {
        if (! in_array($this->request[3], $this->acceptableCurrency) ) :
            $this->error = true;
            $this->message = [
                'errorItem' => 'Currency',
                'message' => 'Parameter 3 Request must be acceptable currency'
            ];

            return false;
        endif;

        if (! in_array($this->request[4], $this->acceptableCurrency) ) :
            $this->error = true;
            $this->message = [
                'errorItem' => 'Currency',
                'message' => 'Parameter 4 Request must be acceptable currency'
            ];
            return false;
        endif;

        return true;
    }
    
    /**
     * SendResults
     *
     * @return array error & validate | message
     */
    protected function sendResults() : array
    {
        if ($this->error == true ) :
            return [
                'error'   => true,
                'message' => $this->message
            ];
        endif;


        return [ 
            'error'            => false,
            'validatedRequest' => $this->request
        ];
    }
    
}