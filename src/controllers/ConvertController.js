const AppError = require("../utils/AppError")

class ConvertController {
    show(req, res) {
        const { from, to, amount } = req.query;

        if (!from || !to || !amount){
            throw new AppError("Os parâmetros 'from', 'to' e 'amount' são obrigatórios!");
        }

        res.json({ from, to, amount })
    }
}

module.exports = ConvertController;
