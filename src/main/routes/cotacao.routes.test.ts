import request from 'supertest'
import app from '../config/app'

describe('Cotacao routes', () => {
  test('should integrate with cotacao routes and return rates success', async () => {
    await request(app).post('/api/cotacao/:symbol').expect(200)
  })
})
