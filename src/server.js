require("express-async-errors");

const AppError = require("./utils/AppError");
const express = require("express");

const routes = require("./routes");

const app = express();

app.use(routes);

app.use((err, req, res, nxt) => {
    if (err instanceof AppError) {
        return res.status(err.statusCode).json({
            status: "error",
            message: err.message
        });
    }

    console.error(err);

    return res.status(500).json({
        status: "error",
        message: "Internal server error"
    });
});

const PORT = 3000;
app.listen(PORT, console.log(`Running on http://localhost:${PORT}`));
