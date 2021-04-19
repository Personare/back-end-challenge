const request = require('request');

request("http://localhost/back-end-challenge/?de=BRL&para=EUR&valor=2071.90&cotacao=5.75", {json: true}, (error, res, data) => {
    
    if (error) {
        return  console.log(error)
    };

    if (!error && res.statusCode == 200) {
        console.log(data["simbolo"] + data["resultado"]);
    };
});


