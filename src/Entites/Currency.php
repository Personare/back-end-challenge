<?php
/**
 * File Currency.php /Entites
 *
 * PHP Version 8.0
 *
 * @category Entites
 * @package  Personare_BackEndChallenge
 * @author   Emanuel Souza <emanuel.inacios@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     http://localhost:8080/
 */

namespace Personare\BackEndChallenge\Entites;

/**
 * Currency Entity
 *
 * @category Entites
 * @package  Personare_BackEndChallenge
 * @author   Emanuel Souza <emanuel.inacios@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     http://localhost:8080/
 */
class Currency
{

    protected float $amount;
    protected string $symbol;
    
    /**
     * __construct
     *
     * @param mixed $amount of currency
     * @param mixed $symbol of currency
     * 
     * @return void
     */
    function __construct( float $amount, string $symbol )
    {
        $this->amount = $amount;
        $this->symbol = $symbol;
    }
    
    /**
     * GetSymbol
     *
     * @return string
     */
    function getSymbol() : string
    {
        return $this->symbol;
    }
    
    /**
     * GetAmount
     *
     * @return float
     */
    function getAmount() : float
    {
        return $this->amount;
    }
}