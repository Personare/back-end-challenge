# Currency
Translate currency units between BRL - USD and BRL - EUR.

## Table of Contents
- [Installation](#installation)
- [Usage](#usage)


## <a name="installation"></a> Installation
There are some installation ways. You can choose the best way for you.

### Git
Clone the repo into your project:
```bash
$ git clone https://github.com/enriquerene/style-objects.git
```

### Zip
Dowload the package and uncpack it into your project:
[Dowload ZIP](https://github.com/enriquerene/style-objects/archive/main.zip)

## <a name="usage"></a> Usage
You can import as module:
```python
from currency import Currency
"""
JSON object used from https://economia.awesomeapi.com.br/all/USD-BRL,EUR-BRL
"""
curr_map = JSON_object_from_awesomeapi.com.br
curr = Currency(curr_map)
brl = '1,00'
print('EUR$ %' % curr.toEUR(brl) )
eur = '1,00'
print('R$ %' % curr.fromEUR(eur) )
```

