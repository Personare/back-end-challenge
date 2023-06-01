import request from 'supertest'
import app from '../config/app'
import { noCache } from "./no-cache";

describe('NoCache middleware', () => {
    test('should set no cache', async () => {
        app.get('/test_no_cache', noCache, (req, res) => {
            res.send(req.body)
        })
        await request(app)
            .get('/test_no_cache')
            .expect('cache-control', 'no-store, no-cache, must-revalidate, proxy-revalidate')
            .expect('expires', '0')
            .expect('surrogate-control', 'no-store')
    })
})
