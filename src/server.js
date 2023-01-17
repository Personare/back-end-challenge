const express = require("express");
const app = express();

app.get("/hello", (req, res) => {
    res.send("Hello world!");
});

const PORT = 3000;
app.listen(PORT, console.log(`Running on http://localhost:${PORT}`));