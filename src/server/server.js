const http = require('http');
const app = require('../app')
const port = process.env.PORT || 1805

try {
    console.log(`Iniciando servidor na porta ${port}`);
    const server = http.createServer(app);
    server.listen(port);
    console.log(`Servidor iniciado na porta ${port}`);
} catch (error) {
    console.error(error);
    process.exit(1);
}
