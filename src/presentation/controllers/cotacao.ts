import { MissingParamError } from '../errors/missing-param-error'
import { badRequest } from '../helper/http-helper'
import { type Controller } from '../protocols/controller'
import { type HttpRequest, type HttpResponse } from '../protocols/http'

export class CotacaoController implements Controller {
  async handle (httpRequest: HttpRequest): Promise<HttpResponse> {
    const { cotacao } = httpRequest.params
    if (!cotacao) {
      return badRequest(new MissingParamError('cotacao'))
    }

    return {
      body: 'any_value',
      statusCode: 200
    }
  }
}
