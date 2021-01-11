// import { healthController } from "../../../src/controllers/healthController"
const Helper = require("../../Helpers/Controllers.helper")
const urlHealth = "/health";

const helper = new Helper();

describe("healthCheck endpoint", () => {

    it("HealthCheck API endpoint", async () => {
        const { body } = await helper.apiServer.get(`${urlHealth}`);

        expect(body).toHaveProperty("status");
    });

});
