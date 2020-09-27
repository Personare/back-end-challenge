using ApiConversaoMoedasPersonare.Enums;
using ApiConversaoMoedasPersonare.Model;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

namespace ApiConversaoMoedasPersonare.Interface
{
    public interface IFormatoRetorno
    {
        string Simbolo { get; }
        EnumTipoConversao TipoConversao { get; }
    }
}
