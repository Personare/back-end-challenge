const ConversorApplication = require('../../back-end-challenge.Application/application/conversor-application');

class ConversorController {
    constructor() {
        this.application = new ConversorApplication();
    }

    converterParaReal(req, res, next){
        try {
            const { valor, cotacao } = req.body;
            
            if(!valor || !cotacao) return res.status(400).json({ mensagem: 'Parâmetros inválidos.'})
            
            const resposta = this.application.converterMoedaParaReal(valor, cotacao);

            res.status(200).json(resposta);
        }
        catch(e) {
            next(e);
        }
    }

    converterParaDolar(req, res, next){
        try {
            const { valor, cotacao } = req.body;
            
            if(!valor || !cotacao) return res.status(400).json({ mensagem: 'Parâmetros inválidos.'})
            
            const resposta = this.application.converterRealParaDolar(valor, cotacao);

            res.status(200).json(resposta);
        }
        catch(e) {
            next(e);
        }
    }

    converterParaEuro(req, res, next){
        try {
            const { valor, cotacao } = req.body;
            
            if(!valor || !cotacao) return res.status(400).json({ mensagem: 'Parâmetros inválidos.'})
            
            const resposta = this.application.converterRealParaEuro(valor, cotacao);

            res.status(200).json(resposta);
        }
        catch(e) {
           next(e);
        }
    }
}

module.exports = ConversorController;