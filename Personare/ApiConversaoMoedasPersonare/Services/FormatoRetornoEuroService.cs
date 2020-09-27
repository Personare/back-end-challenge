using ApiConversaoMoedasPersonare.Enums;
using ApiConversaoMoedasPersonare.Interface;
using ApiConversaoMoedasPersonare.Model;
using System;
using System.Collections.Generic;
using System.Globalization;
using System.Linq;
using System.Threading.Tasks;

namespace ApiConversaoMoedasPersonare.Services
{
    /// <summary>
    /// Formato de retorno para as conversões para moeda Euro (EUR)
    /// </summary>
    public class FormatoRetornoEuroService : IFormatoRetorno
    {
        public string Simbolo { get { return "€"; } }
        public EnumTipoConversao TipoConversao { get { return EnumTipoConversao.EUR; } }
    }
}
