const express = require('express');
const helmet = require('helmet');
const bodyParser = require('body-parser');
const fs = require('fs');
const server = express();
const swaggerUi = require('swagger-ui-express');
const YAML = require('yamljs');
const swaggerDocument = YAML.load(`${__dirname}/doc/swagger.yaml`);

server.use('/docs', swaggerUi.serve);
server.get('/docs', swaggerUi.setup(swaggerDocument));

server.use(helmet());
server.use(bodyParser.urlencoded({ extended: false }))
server.use(bodyParser.json())

server.get('/', (req, res, next) => {
    res.status(200).json({ mensagem: 'back-end-challenge rodando. Acesse a documentacao em http://localhost:8090/docs' });
})

fs.readdirSync(`${__dirname}/route`).forEach((route) => {
    console.log(`Importando rotas: ${route}`);
    server.use(require(`./route/${route}`));
});

server.use('*', (req, res) => {
    console.log(`Endpoint ${req.method} - ${req.baseUrl} não encontrado.`);
    res.status(404).json({ mensagem: '404 - Não encontrado' });
});

server.use((error, req, res, next) => {
    console.log(`Erro no endpoint ${req.method} - ${req.url}\n`, error);
    res.status(500).json({ mensagem: '500 - Erro interno no servidor' });
});

module.exports = server.listen(8090, () => {
    console.log('back-end-challenge rodando na porta 8090')
});