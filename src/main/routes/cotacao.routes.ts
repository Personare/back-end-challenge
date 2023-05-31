import { type Router } from 'express'

export default (router: Router): void => {
  router.post('/cotacao/:symbol', (req, res) => {
    res.json({ test: 'test' })
  })
}
