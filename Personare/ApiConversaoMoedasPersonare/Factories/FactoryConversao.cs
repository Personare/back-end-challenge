using ApiConversaoMoedasPersonare.Enums;
using ApiConversaoMoedasPersonare.Exceptions;
using ApiConversaoMoedasPersonare.Interface;
using ApiConversaoMoedasPersonare.Services;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

namespace ApiConversaoMoedasPersonare.Factories
{
    /// <summary>
    /// Factory que realiza a conversão de moedas de acordo com o formato informado
    /// </summary>
    public class FactoryConversao
    {
        public static IConverter Criar(EnumTipoConversao p_tipoConversao)
        {
            if (p_tipoConversao == EnumTipoConversao.BRL)            
               return new ConverterParaRealService();
            else if (p_tipoConversao == EnumTipoConversao.EUR)                
               return new ConverterParaEuroService();
            else if (p_tipoConversao == EnumTipoConversao.USD)
               return new ConverterParaDolarService();

            throw new TipoConversaoNaosuportadoException();
        }
    }
}
