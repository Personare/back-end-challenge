const express = require('express');
const exchangeController = require('../controllers/exchangeController');
const validate = require('../middleware/validateQuery');

// const requiredParams = ["from", "to", "value", "tax"];
const requiredParams = [
    {
        name: "from",
        type: "string"
    },{
        name: "to",
        type: "string"
    },{
        name: "value",
        type: "number"
    },{
        name: "tax",
        type: "number"
    },
];
const router = express.Router();

router.get('/', validate.validateQuery(requiredParams), (req, res, next) => exchangeController.get(req, res, next));

module.exports = router;
