using Microsoft.AspNetCore.Hosting;
using Microsoft.AspNetCore.TestHost;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Net.Http;
using System.Threading.Tasks;

namespace TesteIntegracaoConversaoMoedasPersonare.Contexto
{
    public class Contexto
    {
        public HttpClient Client { get; set; }
        private TestServer _server;
        public Contexto()
        {
            _server = new TestServer(new WebHostBuilder().UseStartup<ApiConversaoMoedasPersonare.Startup>());
            Client = _server.CreateClient();
        }
    }
}
