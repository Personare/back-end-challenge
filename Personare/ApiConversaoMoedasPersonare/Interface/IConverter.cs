using ApiConversaoMoedasPersonare.Model;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;

namespace ApiConversaoMoedasPersonare.Interface
{
    public interface IConverter
    {
        double Converter(Converter p_calculo);
    }
}
