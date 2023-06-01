import { type Router } from 'express'
import { adaptRoute } from '../adapters/express-routes-adapter'
import { makeCotacaoController } from '../factories/cotacao'

export default (router: Router): void => {
    /**
* @swagger
* /cotacao:
*   get:
*     summary: Retrieve a list of JSONPlaceholder users
*     description: Retrieve a list of users from JSONPlaceholder. Can be used to populate a list of fake users when prototyping or testing an API.
*/
    router.get(
        '/cotacao/:baseCurrency/:targetCurrency',
        adaptRoute(makeCotacaoController())
    )
}

