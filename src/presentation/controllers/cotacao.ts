import { type ConvertCurrency } from '../../domain/usecases/convert-price'
import { MissingParamError } from '../errors/missing-param-error'
import { ServerError } from '../errors/server-error'
import { badRequest } from '../helper/http-helper'
import { type Controller } from '../protocols/controller'
import { type HttpRequest, type HttpResponse } from '../protocols/http'

export class CotacaoController implements Controller {
  private readonly convertCurrency: ConvertCurrency
  constructor (convertCurrency: ConvertCurrency) {
    this.convertCurrency = convertCurrency
  }

  async handle(httpRequest: HttpRequest): Promise<HttpResponse> {
    try {
      const { symbol } = httpRequest.params
      if (!symbol || symbol.length !== 3) {
        return badRequest(new MissingParamError('symbol'))
      }

      const resultConvert = await this.convertCurrency.convert(symbol)

      return {
        body: resultConvert,
        statusCode: 200
      }
    } catch (error) {
      console.log(error)
      return {
        statusCode: 500,
        body: new ServerError()
      }
    }
  }
}
