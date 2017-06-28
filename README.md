[![Build Status](https://travis-ci.org/fellipecastro/back-end-challenge.svg?branch=master)](https://travis-ci.org/fellipecastro/back-end-challenge)

**Currency Converter**
----
  Calculate currency exchange rates.

## API documentation

* **URL**

  /?from=&to=&value=

* **Method:**

  `GET`

*  **URL Params**

   **Required:**

   `from=[string]` <br>
   `to=[string]` <br>
   `value=[float]` <br>

* **Success Response:**

  * **Code:** 200 SUCCESS <br>
    **Content:** `{ original_value: "$ 3.45", converted_value: "R$ 6.90", rate: "2.00" }`
 
* **Error Response:**

  * **Code:** 400 BAD REQUEST <br>
    **Content:** `{ error: "Valid parameters are: 'from', 'to' and 'value'." }`

  OR

  * **Code:** 404 NOT FOUND <br>
    **Content:** `{ error: "No rate available for the given currencies." }`

  OR

  * **Code:** 404 NOT FOUND <br>
    **Content:** `{ error: "No symbol available for currency 'BRL'." }`

  OR

  * **Code:** 500 INTERNAL SERVER ERROR <br>

* **Sample Call:**

  ```curl -i -H "Accept: application/json" -H "Content-Type: application/json" -X GET http://currency-converter.fellipecastro.com/\?from\=USD\&to\=BRL\&value\=3.45```

## Requirements

* PHP 7.1.6
* Composer 1.4.2

## Setup

  ```composer install```

## Usage

  ```php -S 0.0.0.0:8000 -t src/```

## Test

  ```vendor/bin/phpunit --testdox tests/```

## Source code check

  ```vendor/bin/phpcs --standard=PSR2 src/ tests/```

## Interactive shell

  ```php -a```
