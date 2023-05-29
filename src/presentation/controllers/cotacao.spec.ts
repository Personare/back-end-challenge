import { type CurrencyModel } from '../../domain/models/currency'
import { type ConvertCurrency, type Currency } from '../../domain/usecases/convert-price'
import { MissingParamError } from '../errors/missing-param-error'
import { ServerError } from '../errors/server-error'
import { CotacaoController } from './cotacao'

const makeConvertCurrency = (): ConvertCurrency => {
  class CurrencyStub implements ConvertCurrency {
    async convert (currency: Currency): Promise<CurrencyModel> {
      const fakeCurrency = {
        currency: 'any_currency',
        price: 'any_price',
        updatedAt: 'any_date'
      }
      return await new Promise(resolve => resolve(fakeCurrency))
    }
  }
  return new CurrencyStub()
}
interface SutType {
  sut: CotacaoController
  currencyStub: ConvertCurrency
}
const makeSut = (): SutType => {
  const currencyStub = makeConvertCurrency()
  const sut = new CotacaoController(currencyStub)
  return { currencyStub, sut }
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

  test('should calls convert with correct values', async () => {
    const { sut, currencyStub } = makeSut()
    const convertSpy = jest.spyOn(currencyStub, 'convert')
    const httpRequest = {
      params: {
        symbol: 'any_symbol'
      }
    }

    await sut.handle(httpRequest)
    expect(convertSpy).toHaveBeenCalledWith('any_symbol')
  })

  test('should return 500 if convert throws exception', async () => {
    const { sut, currencyStub } = makeSut()
    const httpRequest = {
      params: {
        symbol: 'any_symbol'
      }
    }

    jest.spyOn(currencyStub, 'convert').mockImplementationOnce(async () => {
      return new Promise((resolve, reject) => reject(new Error()))
    })

    const httpResponse = await sut.handle(httpRequest)
    expect(httpResponse.statusCode).toBe(500)
    expect(httpResponse?.body).toEqual(new ServerError())
  })

  test('should return 200 if value is provided', async () => {
    const { sut } = makeSut()
    const httpRequest = {
      params: {
        symbol: 'any_symbol'
      }
    }

    const httpResponse = await sut.handle(httpRequest)
    expect(httpResponse.body).toEqual({
      currency: 'any_currency',
      price: 'any_price',
      updatedAt: 'any_date'
    })
    expect(httpResponse.statusCode).toBe(200)
  })
})
