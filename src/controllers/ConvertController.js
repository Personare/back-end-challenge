const ConvertShowService = require("../services/ConvertShowService");

class ConvertController {
    async show(req, res) {
        let { from, to, amount } = req.query;

        const convertShowService = new ConvertShowService();

        const result = await convertShowService.execute({ from, to, amount });

        return res.json(result);
    }
}

module.exports = ConvertController;
