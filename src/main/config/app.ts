import express from 'express'
import setUpMiddlewares from '../config/middlewares'
import routes from '../config/routes'

const app = express()
setUpMiddlewares(app)
routes(app)
export default app
