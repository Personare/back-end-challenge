using ApiConversaoMoedasPersonare.Exceptions;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

namespace ApiConversaoMoedasPersonare.Services
{
    /// <summary>
    /// Classe que valida se o campo taxa está dentro dos padrões esperados
    /// </summary>
    public class TaxaConversaoService
    {
        /// <summary>
        /// Valida se dado á válido
        /// </summary>
        /// <param name="p_taxaConversao">Taxa</param>
        /// <returns></returns>
        public static bool IsValid(double p_taxaConversao)
        {
            return (p_taxaConversao > 0);
        }

        /// <summary>
        /// Valida se as informações são válidas
        /// </summary>
        /// <param name="p_taxaConversao">Taxa de Conversão</param>
        public static void Validate(double p_taxaConversao)
        {
            if (p_taxaConversao <= 0)
                throw new TaxaConversaoMenorIgualAZeroException();
        }
    }
}
