const AppError = require("../utils/AppError");
const ConvertShowService = require("./ConvertShowService")

describe("ConvertShowService", () => {
    let convertShowService = null;

    beforeEach(() => {
        convertShowService = new ConvertShowService();
    });
    
    it("currency should be converted", async () => {
        const data = {
            from: "USD",
            to: "BRL",
            amount: "1"
        }
    
        const result = await convertShowService.execute(data);
    
        expect(result).toHaveProperty("value");
        expect(result).toHaveProperty("symbol");
    }, 10000);

    it("currency should not be converted if there aren't all parameters", async () => {
        const data = {
            from: "USD",
            amount: "1"
        }

        await expect(convertShowService.execute(data)).rejects.toEqual(new AppError("Os parâmetros 'from', 'to' e 'amount' são obrigatórios!"));
    });

    it("currency should not be converted if try a not allowed currency", async () => {
        const data = {
            from: "JPY",
            to: "BRL",
            amount: "1"
        }

        await expect(convertShowService.execute(data)).rejects.toEqual(new AppError("Moeda não permitida."));
    });
})
