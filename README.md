# Back-End-Challenge Personare | Lucas Dantas

I made the implementation trying to avoid frameworks, using mostly standard libs for the requests handlers and logs. 

The server uses the HTTPServer class from the http.server lib to keep the serving loop, this class allow to apply custom responses for each request method inheriting the BaseHTTPRequestHandler also from the http.server.

Since the objective was simply to create an api for currency exchange, the operation will be made using the base path. (Ex: meusite.com). Only the POST method will return the conversion, all other methods (except for head) will return an error

### Input Examples:

```
{
    input_currency:"BRL",
    output_currency:"EUR",
    amount:1
}
```

### Output Examples:

```
{
    "amount": 0.19, 
    "currency": "EUR"
}
```

### Requisition example using javascript's fetch api:

```
fetch("http://localhost:8000/",{
    method:"POST", 
    body:JSON.stringify({
        input_currency:"BRL",
        output_currency:"EUR",
        amount:1,
        rate:0.22
    }),
    headers:{
         "Content-Type":"application/json"   
    }
}).then(resp => resp.json()).then(json => console.log(json.amount))
// 0.22
```

The input_currency and output_currency will only accept the following: "USD", "BRL", "EUR". If the rate is not informed, the predefined rates will be used

## Running the application
- install the dependencios from the requirements.txt
- update the settings.py with the exchange rate and the server address (if needed)
- execute `python main.py` on the terminal or cmd

## Testing the application
I'm using the `pytest` module for the tests. The tests are focused on the exchange method, and can be run with the following command on the root directory:

`python -m pytest tests`

