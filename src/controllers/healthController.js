class HealthController {

    async get(req, res, next) {
        res.status(200).send({ status: 'OK' });
    }
}

module.exports = new HealthController();
