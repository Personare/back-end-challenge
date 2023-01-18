const express = require("express");

const routes = require("./routes");

const app = express();

app.use(routes);

const PORT = 3000;
app.listen(PORT, console.log(`Running on http://localhost:${PORT}`));
