import { type CurrencyModel } from '../../domain/models/currency'
import {
  type ConvertCurrency,
  type Currency
} from '../../domain/usecases/convert-price'
import { MissingParamError } from '../errors/missing-param-error'
import { ServerError } from '../errors/server-error'
import { CotacaoController } from './cotacao'

const makeConvertCurrency = (): ConvertCurrency => {
  class CurrencyStub implements ConvertCurrency {
    async convert(currency: Currency): Promise<CurrencyModel> {
      const fakeCurrency = {
        base: 'any_base',
        target: 'any_target',
        conversion_rate: 'any_value',
        date: 'any_date'
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
  test('should return 400 if value provided is different to USD, EUR or BRL', async () => {
    const { sut } = makeSut()
    const httpRequest = {
      params: {
        baseCurrency: 'USD',
        targetCurrency: 'fd'
      }
    }

    const httpResponsePromise = await sut.handle(httpRequest)
    expect(httpResponsePromise.body).toEqual(
      new MissingParamError('The currency must be one of this: USD, EUR or BRL')
    )
    expect(httpResponsePromise.statusCode).toBe(400)
  })

  test('should calls convert with correct values', async () => {
    const { sut, currencyStub } = makeSut()
    const convertSpy = jest.spyOn(currencyStub, 'convert')
    const httpRequest = {
      params: {
        baseCurrency: 'USD',
        targetCurrency: 'EUR'
      }
    }

    await sut.handle(httpRequest)
    expect(convertSpy).toHaveBeenCalledWith(httpRequest.params)
  })

  test('should return 500 if convert throws exception', async () => {
    const { sut, currencyStub } = makeSut()
    jest.spyOn(currencyStub, 'convert').mockImplementationOnce(() => {
      throw new Error()
    })

    const httpRequest = {
      params: {
        baseCurrency: 'USD',
        targetCurrency: 'EUR'
      }
    }

    const httpResponsePromise = await sut.handle(httpRequest)
    expect(httpResponsePromise?.statusCode).toBe(500)
    expect(httpResponsePromise?.body).toEqual(new ServerError())
  })

  test('should return 200 if value is provided', async () => {
    const { sut } = makeSut()
    const httpRequest = {
      params: {
        baseCurrency: 'USD',
        targetCurrency: 'EUR'
      }
    }

    const httpResponsePromise = await sut.handle(httpRequest)
    expect(httpResponsePromise.body).toEqual({
      base: 'any_base',
      target: 'any_target',
      conversion_rate: 'any_value',
      date: 'any_date'
    })
    expect(httpResponsePromise.statusCode).toBe(200)
  })
})
