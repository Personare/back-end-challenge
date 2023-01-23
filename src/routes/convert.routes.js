const { Router } = require("express");

const ConvertController = require("../controllers/ConvertController");

const convertRoutes = Router();

const convertController = new ConvertController();

convertRoutes.get("/", convertController.show);

module.exports = convertRoutes;