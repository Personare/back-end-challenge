using System;
using System.Collections.Generic;
using System.Linq;
using System.Runtime.Serialization;
using System.Threading.Tasks;

namespace ApiConversaoMoedasPersonare.Exceptions
{
    [Serializable]
    public class ConverterException : Exception
    {
        public ConverterException() : base("Não foi possível realizar a conversão. Detalhes: {0}")
        {
        }

        public ConverterException(string message) : base(String.Format("Não foi possível realizar a conversão. Detalhes: {0}", message))
        {
        }

        public ConverterException(string message, Exception innerException) : base(message, innerException)
        {
        }

        protected ConverterException(SerializationInfo info, StreamingContext context) : base(info, context)
        {
        }
    }
}
