// const axios = require('axios')

// const baseURL = 'http://localhost:3001/Currency';

// class CurrencyService {
//     async getByCode(cod) {
//         try {
//             const response = await axios.get(`${baseURL}?code=${cod}`);
//             if (response.data) {
//                 const currency = {
//                     code: response.data[0].code,
//                     symbol: response.data[0].symbol,
//                     digits: response.data[0].digits,
//                     number: response.data[0].number
//                 }
//                 return currency
//             }
//             else {
//                 return []
//             }
//         } catch (error) {
//             throw error;
//         }
//     }
// }

//Possivel trocar os dados fixos por um banco de dados onde contenham todas as informações no formato ISO 4217
//Buscando pelo seu codigo

const currencyBRL = {
    "code": "BRL",
    "number": 986,
    "digits": 2,
    "symbol": "R$"
}

const currencyEUR = {
    "code": "EUR",
    "number": 978,
    "digits": 2,
    "symbol": "€"
}
const currencyUSD = {
    "code": "USD",
    "number": 840,
    "digits": 2,
    "symbol": "$"
}

class CurrencyService{
    async getByCode(cod) {
        switch (cod) {
            case "BRL":
                return currencyBRL;
            case "EUR":
                return currencyEUR;
            case "USD":
                return currencyUSD;
        
            default:
                return undefined;
        }
    }
}

module.exports = new CurrencyService()
