using ApiConversaoMoedasPersonare.Exceptions;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

namespace ApiConversaoMoedasPersonare.Services
{
    /// <summary>
    /// Classe que valida se o campo Valor está dentro dos padrões esperados
    /// </summary>
    public class ValorParaConverterService
    {
        /// <summary>
        /// Valida se dado á válido
        /// </summary>
        /// <param name="p_valorParaConverter">Valor para Converter</param>
        /// <returns></returns>
        public static bool IsValid(double p_valorParaConverter)
        {
            return (p_valorParaConverter > 0);
        }

        /// <summary>
        /// Valida se as informações são válidas
        /// </summary>
        /// <param name="p_valorParaConverter">Valor para Converter</param>
        public static void Validate(double p_valorParaConverter)
        {
            if (p_valorParaConverter <= 0)
                throw new ValorParaConverterMenorIgualAZeroException();
        }
    }
}
