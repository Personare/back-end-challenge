using FluentAssertions;
using NUnit.Framework;
using System.Net;
using System.Threading.Tasks;
using TesteIntegracaoConversaoMoedasPersonare.Contexto;
using Xunit;

namespace TesteIntegradoConversaoMoedasPersonare
{
    public class ConversaoMoedasTest
    {
        private Contexto _contexto;
        private const string ENDERECO_API = "ConversaoMoedas";

        [SetUp]
        public void Setup()
        {
            _contexto = new Contexto();
        }

        [TestCase(120.5, 5.63, "BRL")]
        [TestCase(120.5,5.63,"brl")]
        [TestCase(120.5,5.63, "Brl")]
        public async Task TestaFuncionamentoDolarParaReal(double p_valor, double p_taxa, string p_tipoConversao)
        {
            var response = await _contexto.Client.GetAsync(string.Format("/{0}/{1}/{2}/{3}", ENDERECO_API, p_valor, p_taxa, p_tipoConversao));
            response.EnsureSuccessStatusCode();
            response.StatusCode.Should().Be(HttpStatusCode.OK);
        }

        [TestCase(25, 6.47, "BRL")]
        [TestCase(25, 6.47, "brl")]
        [TestCase(25, 6.47, "Brl")]
        public async Task TestaFuncionamentoEuroParaReal(double p_valor, double p_taxa, string p_tipoConversao)
        {
            var response = await _contexto.Client.GetAsync(string.Format("/{0}/{1}/{2}/{3}", ENDERECO_API, p_valor, p_taxa, p_tipoConversao));
            response.EnsureSuccessStatusCode();
            response.StatusCode.Should().Be(HttpStatusCode.OK);
        }

        [TestCase(135.90, 0.18, "USD")]
        [TestCase(135.90, 0.18, "usd")]
        [TestCase(135.90, 0.18, "uSd")]
        public async Task TestaFuncionamentoRealParaDolar(double p_valor, double p_taxa, string p_tipoConversao)
        {
            var response = await _contexto.Client.GetAsync(string.Format("/{0}/{1}/{2}/{3}", ENDERECO_API, p_valor, p_taxa, p_tipoConversao));
            response.EnsureSuccessStatusCode();
            response.StatusCode.Should().Be(HttpStatusCode.OK);
        }

        [TestCase(25, 1.16, "USD")]
        [TestCase(25, 1.16, "usd")]
        [TestCase(25, 1.16, "uSd")]
        public async Task TestaFuncionamentoEuroParaDolar(double p_valor, double p_taxa, string p_tipoConversao)
        {
            var response = await _contexto.Client.GetAsync(string.Format("/{0}/{1}/{2}/{3}", ENDERECO_API, p_valor, p_taxa, p_tipoConversao));
            response.EnsureSuccessStatusCode();
            response.StatusCode.Should().Be(HttpStatusCode.OK);
        }

        [TestCase(50.5, 0.86, "EUR")]
        [TestCase(50.5, 0.86, "eur")]
        [TestCase(50.5, 0.86, "euR")]
        public async Task TestaFuncionamentoDolarParaEuro(double p_valor, double p_taxa, string p_tipoConversao)
        {
            var response = await _contexto.Client.GetAsync(string.Format("/{0}/{1}/{2}/{3}", ENDERECO_API, p_valor, p_taxa, p_tipoConversao));
            response.EnsureSuccessStatusCode();
            response.StatusCode.Should().Be(HttpStatusCode.OK);
        }

        [TestCase(85.5, 0.15, "EUR")]
        [TestCase(85.5, 0.15, "eur")]
        [TestCase(85.5, 0.15, "euR")]
        public async Task TestaFuncionamentoRealParaEuro(double p_valor, double p_taxa, string p_tipoConversao)
        {
            var response = await _contexto.Client.GetAsync(string.Format("/{0}/{1}/{2}/{3}", ENDERECO_API, p_valor, p_taxa, p_tipoConversao));
            response.EnsureSuccessStatusCode();
            response.StatusCode.Should().Be(HttpStatusCode.OK);
        }

        [TestCase("ConversaoMoeda")]
        [TestCase("conversaomoeda")]
        [TestCase("AConversaoDeMoeda")]
        public async Task TestaChamadaErrada(string p_enderecoApi)
        {
            var response = await _contexto.Client.GetAsync(string.Format("/{0}", p_enderecoApi));
            response.StatusCode.Should().Be(HttpStatusCode.NotFound);
        }

        [TestCase(85.5, 1.2, "EUR")]
        [TestCase(85.5, 1.2, "eur")]
        [TestCase(85.5, 1.2, "euR")]
        public async Task TestaChamadaParametrosTrocados(double p_valor, double p_taxa, string p_tipoConversao)
        {
            var response = await _contexto.Client.GetAsync(string.Format("/{0}/{1}/{2}/{3}", ENDERECO_API, p_valor, p_tipoConversao, p_taxa));
            response.StatusCode.Should().Be(HttpStatusCode.BadRequest);
        }
    }
}