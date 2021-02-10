const { expect } = require('chai');
const sinon = require('sinon');
const ConversorMoedaService = require('../../service/conversor-moeda-service');
let conversorMoedaService;

describe('Domain - ConversorMoedaService', () => {
    before(() => {
        conversorMoedaService = new ConversorMoedaService();
    })

    describe('converterMoedaParaReal', () => {
        it('Deve converter com símbolo da moeda real', (done) => {
            const valor = 1;
            const cotacao = 1;
            
            const conversao = conversorMoedaService.converterMoedaParaReal(valor, cotacao);

            expect(conversao.moeda).equal('R$');
            done();
        });

        it('Deve converter com cotação alta', (done) => {
            const valor = 10;
            const cotacao = 10;
            
            const conversao = conversorMoedaService.converterMoedaParaReal(valor, cotacao);

            expect(conversao.valor).equal(100);
            done();
        });

        it('Deve converter com cotação baixa', (done) => {
            const valor = 10;
            const cotacao = 0.1;
            
            const conversao = conversorMoedaService.converterMoedaParaReal(valor, cotacao);

            expect(conversao.valor).equal(1);
            done();
        });
    });

    describe('converterRealParaDolar', () => {
        it('Deve converter com símbolo da moeda dólar', (done) => {
            const valor = 1;
            const cotacao = 1;
            
            const conversao = conversorMoedaService.converterRealParaDolar(valor, cotacao);

            expect(conversao.moeda).equal('$');
            done();
        });

        it('Deve converter com cotação alta', (done) => {
            const valor = 10;
            const cotacao = 10;
            
            const conversao = conversorMoedaService.converterRealParaDolar(valor, cotacao);

            expect(conversao.valor).equal(1);
            done();
        });

        it('Deve converter com cotação baixa', (done) => {
            const valor = 10;
            const cotacao = 0.1;
            
            const conversao = conversorMoedaService.converterRealParaDolar(valor, cotacao);

            expect(conversao.valor).equal(100);
            done();
        });
    });

    describe('converterRealParaEuro', () => {
        it('Deve converter com símbolo da moeda euro', (done) => {
            const valor = 1;
            const cotacao = 1;
            
            const conversao = conversorMoedaService.converterRealParaEuro(valor, cotacao);

            expect(conversao.moeda).equal('€');
            done();
        });

        it('Deve converter com cotação alta', (done) => {
            const valor = 10;
            const cotacao = 10;
            
            const conversao = conversorMoedaService.converterRealParaEuro(valor, cotacao);

            expect(conversao.valor).equal(1);
            done();
        });

        it('Deve converter com cotação baixa', (done) => {
            const valor = 10;
            const cotacao = 0.1;
            
            const conversao = conversorMoedaService.converterRealParaEuro(valor, cotacao);

            expect(conversao.valor).equal(100);
            done();
        });
    });
});