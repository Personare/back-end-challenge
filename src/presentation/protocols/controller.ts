import type { HttpRequest, HttpResponse } from './http'

export interface Controller {
  handle: (httpRequest: HttpRequest, httpResponse: HttpResponse) => Promise<HttpResponse>
}
