using ApiConversaoMoedasPersonare.Interface;
using ApiConversaoMoedasPersonare.Model;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

namespace ApiConversaoMoedasPersonare.Services
{
    /// <summary>
    /// Classe que realiza a conversão para Dólar(USD)
    /// </summary>
    public class ConverterParaDolarService : IConverter
    {
        /// <summary>
        /// Realiza a conversão
        /// </summary>
        /// <param name="p_converter">Classe que contém as informações de conversão</param>
        /// <returns></returns>
        double IConverter.Converter(Converter p_converter)
        {
            p_converter.Validate();
            return p_converter.Valor * p_converter.Taxa;
        }
    }
}