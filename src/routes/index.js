const { Router } = require("express");

const convertRoutes = require("./convert.routes")

const routes = Router();

routes.use("/convert", convertRoutes);

module.exports = routes;
