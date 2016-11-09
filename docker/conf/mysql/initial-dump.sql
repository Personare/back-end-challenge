CREATE TABLE quotations
(
    currency_from   VARCHAR(3) NOT NULL,
    currency_to     VARCHAR(3) NOT NULL,
    quotation_value DECIMAL(10, 7)
);
CREATE UNIQUE INDEX quotations_currency_from_currency_to_index
    ON quotations (currency_from, currency_to);

INSERT INTO quotations VALUES ('BRL', 'USD', 0.311013);
