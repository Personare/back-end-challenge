import { type Request, type Response } from 'express'
import { type Controller } from '../../presentation/protocols/controller'
import { type HttpRequest } from '../../presentation/protocols/http'

// Create an adapter to received a controller and call it with correct type of express params.
export const adaptRoute = (controller: Controller) => {
  return async (req: Request, res: Response) => {
    const httpRequest: HttpRequest = {
      body: req.body,
      params: req.params
    }
    const httpResponse = await controller.handle(httpRequest)
    res.status(httpResponse.statusCode).send(httpResponse.body)
  }
}
