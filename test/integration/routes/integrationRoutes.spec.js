// import { healthController } from "../../../src/controllers/healthController"
const Helper = require("../../helpers/Controllers.helper")
const urlInvalid = "/abc";
const urlExchange = "/exchange";

const helper = new Helper();

describe("Invalid endpoint", () => {

    it("Invalid API endpoint", async () => {
        const { body } = await helper.apiServer.get(`${urlInvalid}`);

        expect(body).toHaveProperty("message");
    });

    it("Exchange API endpoint invalid params", async () => {

        const { body } = await helper.apiServer.get(`${urlExchange}`)

        expect(body).toHaveProperty("message");
    })

    it("Exchange API endpoint invalid values", async () => {

        const { body } = await helper.apiServer.get(`${urlExchange}`).query({ from: 'BRL', to: 'USD', value: 'a', tax: 2 })

        expect(body).toHaveProperty("message");
    })

    it("Exchange API endpoint sucess", async () => {

        const { body } = await helper.apiServer.get(`${urlExchange}`).query({ from: 'BRL', to: 'USD', value: 100, tax: 2 })

        expect(body).toHaveProperty("formatedValue");
    })

});
