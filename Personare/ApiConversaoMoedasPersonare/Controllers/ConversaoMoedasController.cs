using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using ApiConversaoMoedasPersonare.Factories;
using ApiConversaoMoedasPersonare.Model;
using ApiConversaoMoedasPersonare.Services;
using Microsoft.AspNetCore.Mvc;
using Microsoft.Extensions.Logging;

namespace ApiConversaoMoedasPersonare.Controllers
{
    [ApiController]
    [Route("[controller]")]
    public class ConversaoMoedasController : ControllerBase
    {
        /// <summary>
        /// Realiza a conversão de moedas, com valor inicial de valor a ser convertido, taxa de conversão e o tipo de conversão
        /// GET /ConversaoMoedas
        /// </summary>
        /// <param name="p_valor">Valor inicial para converter</param>
        /// <param name="p_taxa">Taxa de conversão</param>
        /// <param name="p_converterPara">Tipo de conversão</param>
        /// <returns></returns>        
        [HttpGet("{p_valor}/{p_taxa}/{p_converterPara}")]
        public ActionResult<Retorno> Get([FromRoute] double p_valor, double p_taxa, string p_converterPara)
        {
            var formatoRetorno = FactoryFormatoRetorno.Criar(p_converterPara);

            return new Retorno()
            {
                Simbolo = formatoRetorno.Simbolo,
                ValorConvertido = new ConversaoMoedaService(FactoryConversao.Criar(formatoRetorno.TipoConversao)
                ).Converter(new Converter() { Valor = p_valor, Taxa = p_taxa })
            };
        }
    }
}
