import { Prices } from '../../infra/prices'
import { CotacaoController } from '../../presentation/controllers/cotacao'

// Factory to unnecessary make a lot of instances in the routes file
export const makeCotacaoController = (): CotacaoController => {
  const convertPrice = new Prices()
  return new CotacaoController(convertPrice)
}
