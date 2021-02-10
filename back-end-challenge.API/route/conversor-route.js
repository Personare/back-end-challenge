const router = require('express').Router();
const Controller = require('../controller/conversor-controller');

router.post('/api/conversor/real', (req, res, next) => new Controller().converterParaReal(req, res, next));

router.post('/api/conversor/dolar', (req, res, next) => new Controller().converterParaDolar(req, res, next));

router.post('/api/conversor/euro', (req, res, next) => new Controller().converterParaEuro(req, res, next));

module.exports = router;