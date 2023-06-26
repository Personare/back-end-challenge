import express from 'express'
import setUpMiddlewares from '../config/middlewares'
import setUpSwagger from '../config/swagger'
import setUpRoutes from '../config/routes'

const app = express()
setUpSwagger(app)
setUpMiddlewares(app)
setUpRoutes(app)
export default app
