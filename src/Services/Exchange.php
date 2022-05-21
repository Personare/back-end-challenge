<?php
/**
 * File Services.php /Services
 *
 * PHP Version 8.0
 *
 * @category Services
 * @package  Personare_BackEndChallenge
 * @author   Emanuel Souza <emanuel.inacios@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     http://localhost:8080/
 */

namespace Personare\BackEndChallenge\Services;
use Personare\BackEndChallenge\Providers\Currency\Controller;

/**
 * Service Exchange route
 *
 * @category Services
 * @package  Personare_BackEndChallenge
 * @author   Emanuel Souza <emanuel.inacios@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     http://localhost:8080/
 */
class Exchange
{

    protected const ROUTE = 'exchange/';
    
    /**
     * __construct
     *
     * @return void
     */
    function __construct()
    {
        $this->handleRequest($_SERVER['REQUEST_URI']);
    }
    
    /**
     * HandleRequest
     *
     * @param string $request to verify router
     * 
     * @return void
     */
    function handleRequest( string $request ) : void
    {
        $currencyController = new Controller();

        if (strpos($request, self::ROUTE) !== false ) :
            $currencyController->receiver($request);
        endif;

        $currencyController->sendResponse(400, 'Wrong Route');
    }

}