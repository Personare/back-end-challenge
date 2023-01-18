const AppError = require("../utils/AppError");
const axios = require('axios');

const API_KEY = "BsHTajCuI9se8UaGXiy2XbOyTHFcB1Zl";

const CURRENCY_SYMBOLS = {
    "BRL": "R$",
    "USD": "$",
    "EUR": "€"
}

class ConvertController {
    async show(req, res) {
        let { from, to, amount } = req.query;

        if (!from || !to || !amount){
            throw new AppError("Os parâmetros 'from', 'to' e 'amount' são obrigatórios!");
        }

        from = from.toUpperCase();
        to = to.toUpperCase();

        if (!CURRENCY_SYMBOLS.hasOwnProperty(from) || !CURRENCY_SYMBOLS.hasOwnProperty(to)){
            throw new AppError("Moeda não permitida.");
        }

        const response = await axios.get(`https://api.apilayer.com/exchangerates_data/convert?from=${from}&to=${to}&amount=${amount}`, { 
            headers: { 'apikey': API_KEY }
        });

        const { result } = response.data;

        res.json({ value: result, symbol: CURRENCY_SYMBOLS[to] })
    }
}

module.exports = ConvertController;
