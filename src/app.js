const express = require('express');
const morgan = require('morgan');
const bodyParser = require('body-parser');
const routes = require('./routes')

class App {
    constructor() {
        this.server = express();
        this.middlewares();
        this.routes();
    }

    middlewares() {
        this.server.use(bodyParser.json());
        this.server.use(morgan('combined'));
    }

    routes() {
        this.server.use(routes);
    }
}

module.exports = new App().server
