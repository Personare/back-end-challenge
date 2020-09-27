using System;
using System.Collections.Generic;
using System.Linq;
using System.Runtime.Serialization;
using System.Threading.Tasks;

namespace ApiConversaoMoedasPersonare.Exceptions
{
    /// <summary>
    /// Classe de exceção que indica se o Valor para converter é menor ou igual que zero
    /// </summary>
    [Serializable]
    public class ValorParaConverterMenorIgualAZeroException : Exception
    {
        public ValorParaConverterMenorIgualAZeroException() : base("Valor do parâmetro \"p_valorParaConverter\" menor ou igual a zero.")
        {
        }

        public ValorParaConverterMenorIgualAZeroException(string message) : base(message)
        {
        }

        public ValorParaConverterMenorIgualAZeroException(string message, Exception innerException) : base(message, innerException)
        {
        }

        protected ValorParaConverterMenorIgualAZeroException(SerializationInfo info, StreamingContext context) : base(info, context)
        {
        }
    }
}
