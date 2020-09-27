using ApiConversaoMoedasPersonare.Exceptions;
using ApiConversaoMoedasPersonare.Interface;
using ApiConversaoMoedasPersonare.Model;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

namespace ApiConversaoMoedasPersonare.Services
{
    /// <summary>
    /// Classe responsável por realizar as conversões das mais diversas moedas
    /// </summary>
    public class ConversaoMoedaService
    {
        IConverter _calculo;
        public ConversaoMoedaService(IConverter p_calculo)
        {
            _calculo = p_calculo;
        }

        /// <summary>
        /// Realiza a conversão conforme o tipo de conversão
        /// </summary>
        /// <param name="p_calculo"></param>
        /// <returns></returns>
        public double Converter(Converter p_calculo)
        {
            try
            {
                return _calculo.Converter(p_calculo);
            }
            catch (Exception ex)
            {
                throw new ConverterException(ex.Message);
            }
        }
    }
}
