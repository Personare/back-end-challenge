const ConversorMoedaService = require('../../back-end-challenge.Domain/service/conversor-moeda-service');

class ConversorApplication {
    constructor() {}

    converterMoedaParaReal(valor, cotacao) {
        const conversorMoedaService = new ConversorMoedaService();
        return conversorMoedaService.converterMoedaParaReal(valor, cotacao);
    }

    converterRealParaDolar(valor, cotacao) {
        const conversorMoedaService = new ConversorMoedaService();
        return conversorMoedaService.converterRealParaDolar(valor, cotacao);
    }

    converterRealParaEuro(valor, cotacao) {
        const conversorMoedaService = new ConversorMoedaService();
        return conversorMoedaService.converterRealParaEuro(valor, cotacao);
    }
}

module.exports = ConversorApplication;