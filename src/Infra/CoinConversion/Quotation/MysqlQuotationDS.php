<?php
namespace CoinConversion\Quotation;

use CoinConversion\Currency\Currency;
use CoinConversion\Currency\CurrencyFactory;
use CoinConversion\Environment;
use PDO;

class MysqlQuotationDS implements QuotationDS
{
    /** @var PDO */
    private $pdo;

    /**
     * @param Environment $environment
     */
    public function __construct($environment)
    {
        $dsn = "mysql:" .
            "host={$environment->get('MYSQL_HOSTNAME')};" .
            "dbname={$environment->get('MYSQL_DATABASE')};" .
            "charset=utf8mb4";
        $this->pdo = new PDO(
            $dsn,
            $environment->get('MYSQL_USERNAME'),
            $environment->get('MYSQL_PASSWORD')
        );
    }

    /**
     * @param Currency $from
     * @param Currency $to
     * @return Quotation
     */
    public function getQuotation(Currency $from, Currency $to)
    {
        $row = $this->pdo
            ->query("SELECT * FROM `quotations` 
                        WHERE `currency_from` = '{$from->getId()}' 
                            AND `currency_to` = '{$to->getId()}' LIMIT 1")
            ->fetch(PDO::FETCH_OBJ);

        if (!empty($row)) {
            return $this->hydrate($row);
        } else {
            return null;
        }
    }

    /**
     * @param Currency $from
     * @param Currency $to
     * @param float $quotationValue
     */
    public function persist(Currency $from, Currency $to, $quotationValue)
    {
        $stmt = $this->pdo->prepare("INSERT INTO quotations VALUE(:currency_from, :currency_to, :quotation_value)");
        $stmt->bindValue('currency_from', $from->getId());
        $stmt->bindValue('currency_to', $to->getId());
        $stmt->bindValue('quotation_value', $quotationValue);
        $stmt->execute();
    }

    /**
     * Remove all rows and reset auto increment id.
     */
    public function truncate()
    {
        $this->pdo->query("TRUNCATE TABLE quotations");
    }

    /**
     * @param \stdClass $row
     * @return Quotation
     */
    private function hydrate(\stdClass $row)
    {
        return new Quotation(
            CurrencyFactory::build($row->currency_from),
            CurrencyFactory::build($row->currency_to),
            $row->quotation_value
        );
    }
}
