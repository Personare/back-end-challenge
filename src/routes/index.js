const express = require('express');
const healthRouter = require('./healthRouter')
const defaultRouter = require('./defaultRouter')
const exchangeRouter = require('./exchangeRouter')

const router = express.Router();

router.use('/health', healthRouter);
router.use('/exchange', exchangeRouter)
router.use(defaultRouter)

module.exports = router;
