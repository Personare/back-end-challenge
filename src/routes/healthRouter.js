const express = require('express');
const healthController = require('../controllers/healthController');

const router = express.Router();

router.get('/', (req, res, next) => healthController.get(req, res, next));

module.exports = router;
