import { ServerError } from '../errors/server-error'
import { type HttpResponse } from '../protocols/http'

// Making helpers to facilitate the returns
export const badRequest = (error: Error): HttpResponse => {
    return {
        body: error,
        statusCode: 400
    }
}

export const serverError = (): HttpResponse => ({
    body: new ServerError(),
    statusCode: 500
})
