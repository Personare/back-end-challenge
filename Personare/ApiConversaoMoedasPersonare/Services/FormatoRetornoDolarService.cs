using ApiConversaoMoedasPersonare.Enums;
using ApiConversaoMoedasPersonare.Interface;
using ApiConversaoMoedasPersonare.Model;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

namespace ApiConversaoMoedasPersonare.Services
{
    /// <summary>
    /// Formato de retorno para as conversões para moeda Dólar (USD)
    /// </summary>
    public class FormatoRetornoDolarService : IFormatoRetorno
    {
        public string Simbolo { get { return "$"; } }
        public EnumTipoConversao TipoConversao { get { return EnumTipoConversao.USD; } }
    }
}
