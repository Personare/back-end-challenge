import { type ConvertCurrency } from '../../domain/usecases/convert-price'
import { MissingParamError } from '../errors/missing-param-error'
import { badRequest, serverError } from '../helper/http-helper'
import { type Controller } from '../protocols/controller'
import { type HttpRequest, type HttpResponse } from '../protocols/http'

export class CotacaoController implements Controller {
    private readonly convertCurrency: ConvertCurrency
    constructor(convertCurrency: ConvertCurrency) {
        this.convertCurrency = convertCurrency
    }

    // Responsible to received the req, to handle and call forward
    async handle(httpRequest: HttpRequest): Promise<HttpResponse> {
        try {
            const { baseCurrency, targetCurrency } = httpRequest.params
            const requiredFields = ['BRL', 'USD', 'EUR']
            if (
                !requiredFields.includes(baseCurrency) ||
                !requiredFields.includes(targetCurrency)
            ) {
                return badRequest(
                    new MissingParamError(
                        'The currency must be one of this: USD, EUR or BRL'
                    )
                )
            }

            const resultConvert = await this.convertCurrency.convert({
                baseCurrency,
                targetCurrency
            })

            return {
                body: resultConvert,
                statusCode: 200
            }
        } catch (error) {
            console.error(error)
            return serverError()
        }
    }
}
