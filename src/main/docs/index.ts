import { cotacaoPath } from './paths/cotacao'
import { badRequest, cotacaoSchema } from "./schemas/cotacao";

export default {
    openapi: "3.0.0",
    info: {
      title: "Personare Backend Challenge API",
      description:
      "This is a simple currency exchange API made with Express and documented with Swagger",
      version: "1.0.0",
      contact: {
        name: "Backend Challenge from",
        url: "https://personare.com.br",
        email: "wellington.pereira@al.forsoft.org.br",
      },
    },
    license: {
        name: 'GPL-3.0-or-later',
        url: 'https://spdx.org/licenses/GPL-3.0-or-later.html'
    },
    servers: [
      {
          url: "http://localhost:5050/api",
          description: 'Development server'
      }
    ],
    tags: [{
        name: 'Currency Rates'
    }],
    paths: {
        '/cotacao/{baseCurrency}/{targetCurrency}': cotacaoPath
    },
    schemas: {
        cotacaoSchema,
        badRequest
    }
//   apis: ["./routes.ts"],
};
