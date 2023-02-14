# Desafio Back-end Personare
> Desafio para os futuros back-end's do [@Personare](https://github.com/Personare)

## Antes de começar
* Escolha uma linguagem de programação que domina;
* Escolha um banco de dados que melhor se encaixa no desafio;

## Calculo do número do ano pessoal
Desenvolva uma API que calcule o número do ano pessoal e retorne a interpretação deste resultado, você deverá armazenar as interpretações em um banco de dados de sua escolha.
* Artigo ensinando [como calcular o número do ano pessoal](https://www.personare.com.br/conteudo/como-calcular-ano-pessoal-m6523)
* Artigo com as [interpretações de cada resultado](https://www.personare.com.br/conteudo/cores-para-ano-novo-m7576)

* Payload do request:
```json
{
    "currentYear": 2023,
    "birthDate": "2022-07-09"
}
```

* Payload de resposta:
```json
{
    "personalNumber": 9,
    "color": "golden",
    "colorInterpretationText": "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque eleifend tellus volutpat mauris molestie, non tincidunt arcu ornare. Etiam fermentum nisl eu lobortis ornare. Nunc ligula ipsum, hendrerit sed felis vitae, euismod blandit risus. Nullam consequat viverra mauris, quis bibendum urna suscipit nec. Nam imperdiet mattis sapien mollis iaculis. Nunc tempor pulvinar vestibulum. Quisque vulputate, sem in hendrerit consequat, mi tortor commodo lorem, nec tincidunt magna ex id libero. Phasellus ut ante arcu. Nam a consectetur lacus, ut consectetur dolor."
}
```

## O que valorizamos
* Uma boa documentação
* Conhecimento de padrões de projeto
* Código limpo
* Uma boa arquitetura
* Tratativa de erros
* Cuidado com itens de segurança
* Testes automatizados

## Como entregar o desafio
* **Não** abra um PR para este repositório.
* **Não** fork este repositório.
* Envie seu código para um **Repositório privado do GitHub** e adicione `@personare-code-challenge` como colaborador deste repositório. A conta `@personare-code-challenge` será usada para baixar seu código e revisa-lo.
* Envie um email para `code-challenge@personare.com.br` com o link do seu repositório.
