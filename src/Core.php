<?php
/**
 * File Core.php Load Services
 *
 * PHP Version 8.1
 *
 * @category Initialize_Project
 * @package  Personare\BackEndChallenge
 * @author   Emanuel Souza <emanuel.inacios@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     http://localhost:8080/
 */

namespace Personare\BackEndChallenge;
use Personare\BackEndChallenge\Services\ExchangeService;

/**
 * Core Load Services
 *
 * @category Initialize_Project
 * @package  Personare\BackEndChallenge
 * @author   Emanuel Souza <emanuel.inacios@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     http://localhost:8080/
 */
class Core
{
    
    /**
     * __construct
     *
     * @return void
     */
    function __construct()
    {
        $this->loadServices();
    }
    
    /**
     * LoadServices initialize Services
     *
     * @return void
     */
    public function loadServices() : void
    {
        $serviceExchange = new ExchangeService();
    }

}

