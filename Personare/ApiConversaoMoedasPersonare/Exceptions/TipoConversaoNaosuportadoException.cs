using System;
using System.Collections.Generic;
using System.Linq;
using System.Runtime.Serialization;
using System.Threading.Tasks;

namespace ApiConversaoMoedasPersonare.Exceptions
{
    /// <summary>
    /// Classe de exceção quando o tipo de conversão informado não é suportado pela API
    /// </summary>
    [Serializable]    
    public class TipoConversaoNaosuportadoException : Exception
    {
        public TipoConversaoNaosuportadoException() : base("Valor do parâmetro \"p_tipoConversao\" não é suportado.")
        {
        }

        public TipoConversaoNaosuportadoException(string message) : base(message)
        {
        }

        public TipoConversaoNaosuportadoException(string message, Exception innerException) : base(message, innerException)
        {
        }

        protected TipoConversaoNaosuportadoException(SerializationInfo info, StreamingContext context) : base(info, context)
        {
        }
    }
}
