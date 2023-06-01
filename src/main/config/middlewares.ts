import { type Express } from 'express'
import { bodyParser, cors } from '../middlewares'

// Middlewares Factory
export default (app: Express): void => {
    app.use(bodyParser)
    app.use(cors)
}
