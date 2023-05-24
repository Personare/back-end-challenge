import { MissingParamError } from '../errors/missing-param-error'
import { CotacaoController } from './cotacao'

interface SutType {
  sut: CotacaoController
}
const makeSut = (): SutType => {
  const sut = new CotacaoController()
  return { sut }
}

describe('Cotacao controller', () => {
  test('should return 400 if no value is provided', async () => {
    const { sut } = makeSut()
    const httpRequest = {
      params: {
        cotacao: ''
      }
    }

    const httpResponse = await sut.handle(httpRequest)
    expect(httpResponse.body).toEqual(new MissingParamError('cotacao'))
    expect(httpResponse.statusCode).toBe(400)
  })

  test('should return 200 if value is provided', async () => {
    const { sut } = makeSut()
    const httpRequest = {
      params: {
        cotacao: 'any_value'
      }
    }

    const httpResponse = await sut.handle(httpRequest)
    expect(httpResponse.body).toBe('any_value')
    expect(httpResponse.statusCode).toBe(200)
  })
})
