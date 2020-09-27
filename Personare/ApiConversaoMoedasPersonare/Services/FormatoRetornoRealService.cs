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
    /// Formato de retorno para as conversões para moeda Real (BRL)
    /// </summary>
    public class FormatoRetornoRealService : IFormatoRetorno
    {
        public string Simbolo { get { return "R$"; } }
        public EnumTipoConversao TipoConversao { get { return EnumTipoConversao.BRL; } }
    }
}
