using System;
using System.Collections.Generic;
using System.Linq;
using System.Runtime.Serialization;
using System.Threading.Tasks;

namespace ApiConversaoMoedasPersonare.Exceptions
{
    /// <summary>
    /// Classe de exceção que indica se a taxa é menor ou igual que zero
    /// </summary>
    [Serializable]
    public class TaxaConversaoMenorIgualAZeroException : Exception
    {
        public TaxaConversaoMenorIgualAZeroException() : base("Valor do parâmetro \"p_taxaConversao\" menor ou igual a zero.")
        {
        }

        public TaxaConversaoMenorIgualAZeroException(string message) : base(message)
        {
        }

        public TaxaConversaoMenorIgualAZeroException(string message, Exception innerException) : base(message, innerException)
        {
        }

        protected TaxaConversaoMenorIgualAZeroException(SerializationInfo info, StreamingContext context) : base(info, context)
        {
        }
    }
}
