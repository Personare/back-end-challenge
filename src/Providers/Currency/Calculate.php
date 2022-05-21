<?php
/**
 * File Calculate.php /Providers/Currency
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

/**
 * Calculate results of conversion
 *
 * @category Providers_Currency
 * @package  Personare_BackEndChallenge
 * @author   Emanuel Souza <emanuel.inacios@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     http://localhost:8080/
 */
class Calculate
{

    protected array $acceptableCurrency = [
        'BRL' => 'R$',
        'USD' => '$',
        'EUR' => '€'
    ];
    
    /**
     * CalculeRequest
     *
     * @param array $request to get data
     * 
     * @return mixed object
     */
    public function calculeRequest( array $request ) : object
    {
        
        $calculated = floatval($request[2] * $request[5]);
        $symbol = $this->acceptableCurrency[ $request[4] ];
        $currency = new Currency($calculated, $symbol);

        return $currency;
    }

}