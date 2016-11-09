CREATE TABLE quotations
(
    currency_from   VARCHAR(3) NOT NULL,
    currency_to     VARCHAR(3) NOT NULL,
    quotation_value DECIMAL(10, 7)
);
CREATE UNIQUE INDEX quotations_currency_from_currency_to_index
    ON quotations (currency_from, currency_to);

INSERT INTO quotations (currency_from, currency_to, quotation_value) VALUES ('BRL', 'EUR', 0.2840561);
INSERT INTO quotations (currency_from, currency_to, quotation_value) VALUES ('BRL', 'USD', 0.3110130);
INSERT INTO quotations (currency_from, currency_to, quotation_value) VALUES ('EUR', 'BRL', 3.5258520);
INSERT INTO quotations (currency_from, currency_to, quotation_value) VALUES ('USD', 'BRL', 3.2152997);
