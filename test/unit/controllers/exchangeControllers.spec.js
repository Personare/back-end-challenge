const { response } = require('express');
const sinon = require('sinon');
const exchangeController = require('../../../src/controllers/exchangeController');
const ExchangeController = require('../../../src/controllers/exchangeController')
const currencyService = require('../../../src/service/currencyService')

const flushPromises = () => new Promise(setImmediate);

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

const mockRes = () => {
    const res = {};
    res.status = jest.fn().mockReturnValue(res);
    res.json = jest.fn().mockReturnValue(res);
    return res;
}

describe('Controller: exchange', () => {
    // afterEach(() => {
    //     sinon.restore();
    // });

    it('Sucess EUR -> BRL', async () => {
        sinon.stub();

        const mReq = { query: { from: "EUR", to: "BRL", value: 100, tax: 7 } };
        const mRes = { status: sinon.stub(), send: sinon.stub() };

        await exchangeController.get(mReq, mRes);

        const retMock = { symbol: 'R$', value: '700.00', formatedValue: 'R$700.00' };

        sinon.assert.calledWith(mRes.send, retMock)
    });

    it('Sucess EUR -> USD', async () => {
        sinon.stub();

        const mReq = { query: { from: "EUR", to: "USD", value: 489.5, tax: 1.2 } };
        const mRes = { status: sinon.stub(), send: sinon.stub() };

        await exchangeController.get(mReq, mRes);

        const retMock = { symbol: '$', value: '587.40', formatedValue: '$587.40' };

        sinon.assert.calledWith(mRes.send, retMock)
    });

    it('Sucess USD -> EUR', async () => {
        sinon.stub();

        const mReq = { query: { from: "USD", to: "EUR", value: 648, tax: 0.8 } };
        const mRes = { status: sinon.stub(), send: sinon.stub() };

        await exchangeController.get(mReq, mRes);

        const retMock = { symbol: '€', value: '518.40', formatedValue: '€518.40' };

        sinon.assert.calledWith(mRes.send, retMock)
    });

    it('Sucess USD -> BRL', async () => {
        sinon.stub();

        const mReq = { query: { from: "USD", to: "BRL", value: 0.5, tax: 100.6 } };
        const mRes = { status: sinon.stub(), send: sinon.stub() };

        await exchangeController.get(mReq, mRes);

        const retMock = { symbol: 'R$', value: '50.30', formatedValue: 'R$50.30' };

        sinon.assert.calledWith(mRes.send, retMock)
    });

    it('Sucess BRL -> EUR', async () => {
        sinon.stub();

        const mReq = { query: { from: "BRL", to: "EUR", value: 6579.48, tax: 0.15 } };
        const mRes = { status: sinon.stub(), send: sinon.stub() };

        await exchangeController.get(mReq, mRes);

        const retMock = { symbol: '€', value: '986.92', formatedValue: '€986.92' };

        sinon.assert.calledWith(mRes.send, retMock)
    });

    it('Sucess BRL -> USD', async () => {
        sinon.stub();

        const mReq = { query: { from: "BRL", to: "USD", value: 1094.69, tax: 0.19 } };
        const mRes = { status: sinon.stub(), send: sinon.stub() };

        await exchangeController.get(mReq, mRes);

        const retMock = { symbol: '$', value: '207.99', formatedValue: '$207.99' };

        sinon.assert.calledWith(mRes.send, retMock)
    });

    it('Sucess same USD -> USD', async () => {
        sinon.stub();

        const mReq = { query: { from: "USD", to: "USD", value: 1094.69, tax: 2 } };
        const mRes = { status: sinon.stub(), send: sinon.stub() };

        await exchangeController.get(mReq, mRes);

        const retMock = { symbol: '$', value: '1094.69', formatedValue: '$1094.69' };

        sinon.assert.calledWith(mRes.send, retMock)
    });

    it('Error 400 BRLa -> USDa', async () => {

        const mReq = { query: { from: "BRLa", to: "USDa", value: 125.69, tax: 0.59 } };
        const mRes = { send: sinon.spy(), status: sinon.stub() };

        mRes.status.withArgs(400).returns(mRes);

        await exchangeController.get(mReq, mRes);

        const retMock = { message: 'Cannot exchange currency [BRLa] [USDa]' }

        sinon.assert.calledWith(mRes.send, retMock)
    });

    it('Error 400 QWE -> USD', async () => {

        const mReq = { query: { from: "QWE", to: "USD", value: 125.69, tax: 0.59 } };
        const mRes = { send: sinon.spy(), status: sinon.stub() };

        mRes.status.withArgs(400).returns(mRes);

        await exchangeController.get(mReq, mRes);

        const retMock = { message: 'Cannot exchange currency [QWE] ' }

        sinon.assert.calledWith(mRes.send, retMock)
    });

    it('Error 400 USD -> QWE', async () => {

        const mReq = { query: { from: "USD", to: "QWE", value: 125.69, tax: 0.59 } };
        const mRes = { send: sinon.spy(), status: sinon.stub() };

        mRes.status.withArgs(400).returns(mRes);

        await exchangeController.get(mReq, mRes);

        const retMock = { message: 'Cannot exchange currency [QWE]' }

        sinon.assert.calledWith(mRes.send, retMock)
    });

    it('Error 500 missing query in request', async () => {

        const mReq = { };
        const mRes = { send: sinon.spy(), status: sinon.stub() };

        mRes.status.withArgs(500).returns(mRes);

        await exchangeController.get(mReq, mRes);

        const retMock = { message: 'Unable to process your request!' }

        sinon.assert.calledWith(mRes.send, retMock)
    });
    
});
