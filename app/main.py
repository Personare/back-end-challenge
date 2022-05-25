import sys
import settings

from converter import *
from server import *
from http.server import HTTPServer

def main():
    try:
        currency_map = {
            CurrencyTypes.USD : Currency(settings.DOLAR_RATE),
            CurrencyTypes.EUR : Currency(settings.EURO_RATE),
            CurrencyTypes.BRL : Currency(settings.REAL_RATE),
        }

        c = CurrencyConverter(currency_map)

        ServerHandler.currency_converter = c
        ServerHandler.logger = logger

        # Initialize the server
        server = HTTPServer((settings.SERVER_ADDRESS, settings.SERVER_PORT), ServerHandler)
        server.serve_forever()
    except KeyboardInterrupt:
        logger.info("user has stopped application")
    finally:
        logger.warning("application shutting down")

if __name__=='__main__':
    main()