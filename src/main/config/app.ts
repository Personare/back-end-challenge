import express from 'express'
import setUpMiddlewares from '../config/middlewares'

const app = express()
setUpMiddlewares(app)
export default app
