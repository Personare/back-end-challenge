import { type ConvertCurrency } from '../../domain/usecases/convert-price'
import { MissingParamError } from '../errors/missing-param-error'
import { badRequest } from '../helper/http-helper'
import { type Controller } from '../protocols/controller'
import { type HttpRequest, type HttpResponse } from '../protocols/http'

export class CotacaoController implements Controller {
  private readonly convertCurrency: ConvertCurrency
  constructor (convertCurrency: ConvertCurrency) {
    this.convertCurrency = convertCurrency
  }

  async handle (httpRequest: HttpRequest): Promise<HttpResponse> {
    const { symbol } = httpRequest.params
    if (!symbol) {
      return badRequest(new MissingParamError('cotacao'))
    }

    const resultConvert = await this.convertCurrency.convert(symbol)

    return {
      body: resultConvert,
      statusCode: 200
    }
  }
}
