const express = require('express');

const router = express.Router();

router.use((req, res, next) => {
    const error = new Error(`Route doesn't exist`);
    error.status = 404;
    next(error);
});

router.use((error, req, res, next) => {
    res.status(error.status || 500);
    return res.send({
            message: error.message
    });
});

module.exports = router;
