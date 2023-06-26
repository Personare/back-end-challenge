import request from 'supertest'
import app from '../config/app'

describe('Cotacao routes', () => {
    test('should integrate with cotacao routes and return rates success', async () => {
        const base = 'EUR'
        const target = 'USD'
        await request(app).get(`/api/cotacao/${base}/${target}`).expect(200)
    })
})
