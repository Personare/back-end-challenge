const euro = '€';
const dolar = '$';
const real = 'R$';

class ConversorMoedaService {
    constructor() {}

    converterMoedaParaReal(valor, cotacao) {
        return {
            valor: valor * cotacao,
            moeda: real
        };
    }
    
    converterRealParaDolar(valor, cotacao) {
        return {
            valor: valor / cotacao,
            moeda: dolar
        };
    }

    converterRealParaEuro(valor, cotacao) {
        return {
            valor: valor / cotacao,
            moeda: euro
        };
    }
}

module.exports = ConversorMoedaService;