**API DE CONVERSÃO DE MOEDA**
----

## Documentação
  Conversor de moeda do desafio de back-end para vaga de emprego na empresa Personare. O conversor deve ser uma API que faz a conversão de 3 moedas BRL,USD e EUR, mostrando o valor convertido e o simbolo da moeda.

## Requirementos

* PHP ^7.4.21
* Composer ^2.1.3 <br>

## Instalação
  Fazer downloade e instalar o editor de codigo de sua preferencia, o utilizado para criar esse foi o VSCODE. `https://code.visualstudio.com/sha/download?build=stable&os=win32-x64-user`
  Fazer downloade do PHP e instalar no seu computador. `https://windows.php.net/downloads/releases/php-7.4.21-nts-Win32-vc15-x64.zip`
  Fazer downloade do composer e instalar no seu compuutador. `https://getcomposer.org/Composer-Setup.exe`

## Setup
  
  Dentro do seu edito de codigo ou estando dentro da pasta do projeto digite: `composer install` , para instalar as dependencias necessarias do projeto. <br>

## Usage

  `php -S localhost:8000 -t src/`, Copie esse codigo e cole no seu terminal e dei um enter, para subir a aplicação, e certifique-se de que a porta 8000 esteja livre, caso não esteja utilize outra. <br>

* **URL**

  localhost:8000/?from=&to=&value=

* **Parametro para as buscas utilizado:**

  `GET`

*  **URL Parametros:**

   `from=[string]` <br>
   `to=[string]` <br>
   `value=[float]` <br>

## Erros da Aplicação
* **Sucesso:**

  * **Code:** 200 SUCCESS <br>
    **Content:** `{ original_value: "$ 3.45", converted_value: "R$ 6.90", rate: "2.00" }`. Irá aparecer assim caso esteja tudo rodando certo.
 
* **Error:**

  * **Code:** 400 BAD REQUEST <br>
    **Content:** `{"error":"Por favor na URL coloque ?from=<moeda>&to=<moeda>&value=<valor> com uma barra antes, apenas substitua a onde tem <moeda><moeda><valor> e dei enter ^^"}`. Este erro apenas irá aparecer se for colocado na barra do navegador apenas isso, por exemplo: `localhost:23153`.

  OR

  * **Code:** 404 NOT FOUND <br>
    **Content:** `{"error":"Essa API apenas tem 3 moedas, quer mais? da um google"}`. Este erro irá aparecer caso seja colocado uma moeda que não exista no arquivo rates.json.

  OR

  * **Code:** 404 NOT FOUND <br>
    **Content:** `{ error: "Não tem simbolo para essa moeda....'USD'." }`. Este erro ira aparecer caso a api não encontre o simbolo da moeda.

  OR

  * **Code:** 500 INTERNAL SERVER ERROR <br>

## Verificar os Testes da aplicação

  `vendor/bin/phpunit --testdox tests/`, Para verificar se os testes estão tudo certo e so copiar esse codigo e colocar no terminal, o phpunit vai verificar os testes da pasta test e vai vai marcar com um x se o teste passou, caso não tenha passado ficá desmarcado, caso você queira incluir novos testes, sempre rode esse codigo para verificar se ele passou ou não.<br>

## FrameWork utilizado.
  O framework utilizado foi o PHPunit para fazer a verificação da integridade dos testes.<br>

## Erros de codigo.
  Quando e utilizado a moeda EUR, o simbolo do euro pode acabar não aparecendo da forma correta.
