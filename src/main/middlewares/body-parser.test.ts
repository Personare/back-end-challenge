import request from 'supertest'
import app from '../config/app'

describe('Body parser middleware', () => {
    test('should integrate with body parser from express and parse body as json', async () => {
        app.post('/test_body_parser', (req, res) => {
            res.send(req.body)
        })
        await request(app)
            .post('/test_body_parser')
            .send({ name: 'test' })
            .expect({ name: 'test' })
    })
})
