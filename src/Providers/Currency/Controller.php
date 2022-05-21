<?php
/**
 * File Controller.php /Providers/Currency
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

use Personare\BackEndChallenge\Entites\Currency;
use Personare\BackEndChallenge\Providers\Currency\Validated;
use Personare\BackEndChallenge\Providers\Currency\Calculate;
use Personare\BackEndChallenge\Providers\Currency\Response;

/**
 * Controller manage requests
 *
 * @category Providers_Currency
 * @package  Personare_BackEndChallenge
 * @author   Emanuel Souza <emanuel.inacios@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     http://localhost:8080/
 */
class Controller
{

    protected array $calcuted;
    
    /**
     * Receiver request
     *
     * @param string $request from services
     * 
     * @return void
     */
    public function receiver( string $request ) : void
    {
        $validated = $this->validated($request);

        if (( isset($validated[ 'error' ]) ) && ( $validated[ 'error' ] ) ) :
            $this->sendResponse(400, $validated[ 'message' ]);
        endif;

        $calcuted = $this->calculate($validated[ 'validatedRequest' ]);
    }
    
    /**
     * Validated request
     *
     * @param string $request to validated
     * 
     * @return array
     */
    protected function validated( string $request ) : array
    {
        $validated = new Validated();
        $results = $validated->validateRequest($request);  
        
        return $results;
    }
    
    /**
     * Calculate request
     *
     * @param mixed $request to calculted amount and rate
     * 
     * @return void
     */
    protected function calculate( array $request ) : void
    {
        $calcuted = new Calculate();
        $currency = $calcuted->calculeRequest($request);

        $response = [
            'valorConvertido' => $currency->getAmount(),
            'simboloMoeda' => $currency->getSymbol()
        ];

        $this->sendResponse(200, $response);
    }
    
    /**
     * SendResponse to prepare responsa to api
     *
     * @param int   $code    to set header response
     * @param array $message to print body's response
     * 
     * @return void
     */
    public function sendResponse( int $code, array $message ) : void
    {
        $response = new Response($code, $message);
        $response->sendResponse();
    }

}