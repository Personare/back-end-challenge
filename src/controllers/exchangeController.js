const exchange = require('../models/exchange')
const currencyService = require('../service/currencyService')
const formatService = require('../service/formatService')

class ExchangeController {
    async get(req, res, next) {
        try {
            const { from, to, value, tax } = req.query;

            let fromCurrency;
            let toCurrency;

            fromCurrency = await currencyService.getByCode(from);
            toCurrency = await currencyService.getByCode(to);

            if (!fromCurrency || !toCurrency) {
                let invalidCode = "";
                if (!fromCurrency) {
                    invalidCode += `[${from}] `
                }
                if (!toCurrency) {
                    invalidCode += `[${to}]`
                }
                const message = 'Cannot exchange currency ' + invalidCode;
                return res.status(400).send({ message: message });
            }

            let formated = formatService.formatCash(fromCurrency, toCurrency, value, tax)

            return res.send(formated);
        } catch (error) {
            console.error(`${error}`);
            res.status(500).send({ message: 'Unable to process your request!' });
        }
    }
}

module.exports = new ExchangeController()
