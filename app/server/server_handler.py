import cgi
import json
from http.server import BaseHTTPRequestHandler
from converter import CurrencyTypes, CurrencyConverter

class ServerHandler(BaseHTTPRequestHandler):
    """
    ServerHandler implements the class BaseHTTPRequestHandler 
    to handle the incoming requests 
    """
    currency_converter = None 
    logger = None

    def log_message(self, format, *args):
        self.logger.info("Request Info: {} - - [{}] {}".format(
            self.address_string(),
            self.log_date_time_string(),
            format%args,
            ))

    def _set_headers(self):
        """
        basic headers to be used on all methods operations
        """
        self.send_response(200)
        self.send_header('Content-type', 'application/json')
        # this shouldn't be done in production
        #self.send_header('Access-Control-Allow-Origin', '*')
        self.end_headers()
        
    def do_HEAD(self):
        self._set_headers()

    def do_GET(self):
        # simple response as json just to avoid the default error page
        get_response = {
            "error":"only the post method is allowed"
        }
        # must apply the default headers to all responses
        self._set_headers()
        # write the json response to the body
        self.wfile.write(json.dumps(get_response).encode())

    def do_POST(self):
        """
        STEPS:
        - validate the headers
        - desserialize the json as a CurrencyRequest instance
        - validate the received data based on the request model
        - make the conversion based on the inputs
        - return the converted value based on the response model
        """
        content_type, pdict = cgi.parse_header(self.headers.get('content-type'))
        
        # only json content will be accepted
        if content_type != 'application/json':
            self.send_response(400)
            self.end_headers()
            return

        # read the body with the convert properties
        length = int(self.headers.get('content-length'))
        convert_request_json = json.loads(self.rfile.read(length))     
        # from_json method will take a json and apply the fields to a ConvertRequest instance
        convert_request = ConvertRequest.from_json(convert_request_json)

        # validate the request fields
        if not convert_request.validate():
            self.send_response(422)
            self.end_headers()
            return

        # get the converted value based on the current currency_converter map
        converted = self.currency_converter.convert(
            convert_request.input_currency,
            convert_request.output_currency, 
            convert_request.amount,
            convert_request.rate
            )

        # mount the response
        converted_response = ConvertResponse(converted, convert_request.output_currency)

        # log the operation result
        self.logger.info("Input Currency: {0}, Initial Amount: {1}, Output Currency: {2}, Converted Value: {3}".format(
            convert_request.input_currency,
            convert_request.amount,
            convert_request.output_currency,
            converted
            ))

        # must apply the default headers to all responses
        self._set_headers()
        # write the json response to the body
        self.wfile.write(json.dumps(converted_response.__dict__).encode())

			
class ConvertRequest:
    
    def __init__(self, input_currency, output_currency, amount, rate = 0):
        self.input_currency = input_currency
        self.output_currency = output_currency
        self.amount = amount
        self.rate = rate

    def from_json(json_info):
        return ConvertRequest(
            json_info["input_currency"], 
            json_info["output_currency"], 
            json_info["amount"],
            json_info["rate"],
            )
 
    def validate(self):
        """
        will validate the ConvertRequest attributes
        """
        input_currency = CurrencyTypes.from_string(self.input_currency)
        output_currency = CurrencyTypes.from_string(self.output_currency)

        if input_currency == CurrencyTypes.INVALID:
            return False

        if output_currency == CurrencyTypes.INVALID:
            return False

        if input_currency == output_currency:
            return False

        if self.amount <= 0:
            return False

        # the input and output currency are valid, are not the same 
        # and the amount is greater than zero
        return True

class ConvertResponse:
    """
    ConvertResponse contains the fields to be returned in the converting response
    """
    def __init__(self, amount=0, currency=""):
        self.amount = amount # the value to be converted
        self.currency = currency # the string representing the wanted currency