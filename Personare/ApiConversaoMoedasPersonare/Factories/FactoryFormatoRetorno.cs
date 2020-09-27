using ApiConversaoMoedasPersonare.Enums;
using ApiConversaoMoedasPersonare.Exceptions;
using ApiConversaoMoedasPersonare.Interface;
using ApiConversaoMoedasPersonare.Services;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Reflection.Metadata.Ecma335;
using System.Threading.Tasks;

namespace ApiConversaoMoedasPersonare.Factories
{
    /// <summary>
    /// Factory que constroi o Formato de retorno da API conforme o tipo de conversão
    /// </summary>
    public class FactoryFormatoRetorno
    {
        public static IFormatoRetorno Criar(string p_tipoConversao)
        {
            EnumTipoConversao enumTipoConversao;
            Enum.TryParse(p_tipoConversao.ToUpper(), out enumTipoConversao);

            if (enumTipoConversao == EnumTipoConversao.BRL)
                return new FormatoRetornoRealService();

            if (enumTipoConversao == EnumTipoConversao.USD)
                return new FormatoRetornoDolarService();

            if (enumTipoConversao == EnumTipoConversao.EUR)
                return new FormatoRetornoEuroService();

            throw new TipoConversaoNaosuportadoException();
        }
    }
}
