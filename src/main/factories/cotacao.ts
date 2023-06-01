import { Prices } from '../../infra/prices'
import { CotacaoController } from '../../presentation/controllers/cotacao'

export const makeCotacaoController = (): CotacaoController => {
  const convertPrice = new Prices()
  return new CotacaoController(convertPrice)
}
