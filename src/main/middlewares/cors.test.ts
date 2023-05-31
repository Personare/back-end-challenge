import request from 'supertest'
import app from '../config/app'

describe('Cors middleware', () => {
  test('should integrate with cors and enable it', async () => {
    app.get('/test_cors', (req, res) => {
      res.send(req.body)
    })
    await request(app)
      .get('/test_cors')
      .expect('access-control-allow-origin', '*')
      .expect('access-control-allow-method', '*')
      .expect('access-control-allow-headers', '*')
  })
})
