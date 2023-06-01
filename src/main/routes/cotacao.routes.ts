import { type Router } from 'express'
import { adaptRoute } from '../adapters/express-routes-adapter'
import { makeCotacaoController } from '../factories/cotacao'

export default (router: Router): void => {
    router.get(
        '/cotacao/:baseCurrency/:targetCurrency',
        adaptRoute(makeCotacaoController())
    )
}
