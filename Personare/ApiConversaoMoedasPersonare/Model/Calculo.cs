using ApiConversaoMoedasPersonare.Services;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

namespace ApiConversaoMoedasPersonare.Model
{
    /// <summary>
    /// Classe que acolhe as informações de conversão
    /// </summary>
    public class Converter
    {
        public double Valor { get; set; }
        public double Taxa { get; set; }

        /// <summary>
        /// Valida os dados da classe Converter
        /// </summary>
        public void Validate()
        {
            ValorParaConverterService.Validate(Valor);
            TaxaConversaoService.Validate(Taxa);

        }
        /// <summary>
        /// Valida se os dados são válidos
        /// </summary>
        /// <returns></returns>
        public bool IsValid()
        {
            return ValorParaConverterService.IsValid(Valor) && TaxaConversaoService.IsValid(Taxa);
        }
    }
}
