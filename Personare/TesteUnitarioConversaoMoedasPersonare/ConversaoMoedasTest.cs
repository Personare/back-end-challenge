using ApiConversaoMoedasPersonare.Enums;
using ApiConversaoMoedasPersonare.Exceptions;
using ApiConversaoMoedasPersonare.Factories;
using ApiConversaoMoedasPersonare.Interface;
using ApiConversaoMoedasPersonare.Model;
using ApiConversaoMoedasPersonare.Services;
using NUnit.Framework;
using System;

namespace TesteUnitarioConversaoMoedasPersonare
{
    public class ConversaoMoedasTest
    {
        private ConversaoMoedaService _ConversaoMoedaRealService, _ConversaoMoedaEuroService, _ConversaoMoedaDolarService;
        private IFormatoRetorno _FormatoRetornoReal, _FormatoRetornoDolar, _FormatoRetornoEuro;

        [SetUp]
        public void Setup()
        {
            _FormatoRetornoReal = FactoryFormatoRetorno.Criar(EnumTipoConversao.BRL.ToString());
            _ConversaoMoedaRealService = new ConversaoMoedaService(FactoryConversao.Criar(_FormatoRetornoReal.TipoConversao));

            _FormatoRetornoDolar = FactoryFormatoRetorno.Criar(EnumTipoConversao.USD.ToString());
            _ConversaoMoedaDolarService = new ConversaoMoedaService(FactoryConversao.Criar(_FormatoRetornoDolar.TipoConversao));

            _FormatoRetornoEuro = FactoryFormatoRetorno.Criar(EnumTipoConversao.EUR.ToString());
            _ConversaoMoedaEuroService = new ConversaoMoedaService(FactoryConversao.Criar(_FormatoRetornoEuro.TipoConversao));
        }

        [TestCase(-200.50, 9)]
        public void TesteDeValorInicialMenorQueZeroConversaoDolarParaReal(double p_valor, double p_taxa)
        {
            var ex = Assert.Throws<ConverterException>(() => _ConversaoMoedaRealService.Converter(new Converter() { Valor = p_valor, Taxa = p_taxa }));
            Assert.That(ex.Message, Is.EqualTo(new ConverterException(new ValorParaConverterMenorIgualAZeroException().Message).Message));
        }

        [TestCase(200.50, -9)]
        public void TesteDeTaxaMenorQueZeroConversaoDolarParaReal(double p_valor, double p_taxa)
        {
            var ex = Assert.Throws<ConverterException>(() => _ConversaoMoedaRealService.Converter(new Converter() { Valor = p_valor, Taxa = p_taxa }));
            Assert.That(ex.Message, Is.EqualTo(new ConverterException(new TaxaConversaoMenorIgualAZeroException().Message).Message));
        }

        [TestCase(-200.50, 9)]
        public void TesteDeValorInicialMenorQueZeroConversaoRealParaDolar(double p_valor, double p_taxa)
        {
            var ex = Assert.Throws<ConverterException>(() => _ConversaoMoedaDolarService.Converter(new Converter() { Valor = p_valor, Taxa = p_taxa }));
            Assert.That(ex.Message, Is.EqualTo(new ConverterException(new ValorParaConverterMenorIgualAZeroException().Message).Message));
        }

        [TestCase(200.50, -9)]
        public void TesteDeTaxaMenorQueZeroConversaoRealParaDolar(double p_valor, double p_taxa)
        {
            var ex = Assert.Throws<ConverterException>(() => _ConversaoMoedaDolarService.Converter(new Converter() { Valor = p_valor, Taxa = p_taxa }));
            Assert.That(ex.Message, Is.EqualTo(new ConverterException(new TaxaConversaoMenorIgualAZeroException().Message).Message));
        }

        [TestCase(-200.50, 9)]
        public void TesteDeValorInicialMenorQueZeroConversaoRealParaEuro(double p_valor, double p_taxa)
        {
            var ex = Assert.Throws<ConverterException>(() => _ConversaoMoedaEuroService.Converter(new Converter() { Valor = p_valor, Taxa = p_taxa }));
            Assert.That(ex.Message, Is.EqualTo(new ConverterException(new ValorParaConverterMenorIgualAZeroException().Message).Message));
        }

        [TestCase(200.50, -9)]
        public void TesteDeTaxaMenorQueZeroConversaoRealParaEuro(double p_valor, double p_taxa)
        {
            var ex = Assert.Throws<ConverterException>(() => _ConversaoMoedaEuroService.Converter(new Converter() { Valor = p_valor, Taxa = p_taxa }));
            Assert.That(ex.Message, Is.EqualTo(new ConverterException(new TaxaConversaoMenorIgualAZeroException().Message).Message));
        }

        [TestCase("EURO")]
        [TestCase("euro")]
        [TestCase("DOLAR")]
        [TestCase("dolar")]
        [TestCase("REAL")]
        [TestCase("real")]
        [TestCase("ARS")]
        [TestCase("LTC")]
        [TestCase("ltc")]        
        public void TesteDeTipoConversaoNaoSuportado(string p_tipoConversao)
        {
            var ex = Assert.Throws<TipoConversaoNaosuportadoException>(() => FactoryFormatoRetorno.Criar(p_tipoConversao));
            Assert.That(ex.Message, Is.EqualTo(new TipoConversaoNaosuportadoException().Message));
        }

        [TestCase("BRL")]
        [TestCase("brl")]
        public void TesteDeTipoConversaoSuportadoBRL(string p_tipoConversao)
        {
            EnumTipoConversao enumTipoConversao;
            Enum.TryParse(p_tipoConversao.ToUpper(), out enumTipoConversao);

            Assert.AreEqual(enumTipoConversao, EnumTipoConversao.BRL);
        }

        [TestCase("EUR")]
        [TestCase("eur")]
        public void TesteDeTipoConversaoSuportadoEUR(string p_tipoConversao)
        {
            EnumTipoConversao enumTipoConversao;
            Enum.TryParse(p_tipoConversao.ToUpper(), out enumTipoConversao);

            Assert.AreEqual(enumTipoConversao, EnumTipoConversao.EUR);
        }

        [TestCase("USD")]
        [TestCase("usd")]
        public void TesteDeTipoConversaoSuportadoUSD(string p_tipoConversao)
        {
            EnumTipoConversao enumTipoConversao;
            Enum.TryParse(p_tipoConversao.ToUpper(), out enumTipoConversao);

            Assert.AreEqual(enumTipoConversao, EnumTipoConversao.USD);
        }

        [TestCase(120.5, 5.63)]
        public void TestarConversaoDolarParaRealEntradaMaiorQueZero(double p_valor, double p_taxa)
        {
            var retornoValorConvertido = _ConversaoMoedaRealService.Converter(new Converter() { Valor = p_valor, Taxa = p_taxa });
            Assert.AreEqual(retornoValorConvertido, 678.415);
            Assert.AreEqual(_FormatoRetornoReal.Simbolo, "R$");
            Assert.AreNotEqual(_FormatoRetornoDolar.Simbolo, "R$");
            Assert.AreNotEqual(_FormatoRetornoEuro.Simbolo, "R$");
        }

        [TestCase(135.90, 0.18)]
        public void TestarConversaoRealParaDolarEntradaMaiorQueZero(double p_valor, double p_taxa)
        {
            var retornoValorConvertido = _ConversaoMoedaDolarService.Converter(new Converter() { Valor = p_valor, Taxa = p_taxa });
            Assert.AreEqual(retornoValorConvertido, 24.462);
            Assert.AreEqual(_FormatoRetornoDolar.Simbolo, "$");
            Assert.AreNotEqual(_FormatoRetornoReal.Simbolo, "$");
            Assert.AreNotEqual(_FormatoRetornoEuro.Simbolo, "$");
        }

        [TestCase(50.5, 0.86)]
        public void TestarConversaoDolarParaEuroEntradaMaiorQueZero(double p_valor, double p_taxa)
        {
            var retornoValorConvertido = _ConversaoMoedaEuroService.Converter(new Converter() { Valor = p_valor, Taxa = p_taxa });
            Assert.AreEqual(retornoValorConvertido, 43.43);
            Assert.AreEqual(_FormatoRetornoEuro.Simbolo, "€");
            Assert.AreNotEqual(_FormatoRetornoReal.Simbolo, "€");
            Assert.AreNotEqual(_FormatoRetornoDolar.Simbolo, "€");
        }

        [TestCase(25, 1.16)]
        public void TestarConversaoEuroParaDolarEntradaMaiorQueZero(double p_valor, double p_taxa)
        {
            var retornoValorConvertido = _ConversaoMoedaDolarService.Converter(new Converter() { Valor = p_valor, Taxa = p_taxa });
            Assert.AreEqual(retornoValorConvertido, 28.999999999999996d);
            Assert.AreEqual(_FormatoRetornoDolar.Simbolo, "$");
            Assert.AreNotEqual(_FormatoRetornoReal.Simbolo, "$");
            Assert.AreNotEqual(_FormatoRetornoEuro.Simbolo, "$");
        }

        [TestCase(85.5, 0.15)]
        public void TestarConversaoRealParaEuroEntradaMaiorQueZero(double p_valor, double p_taxa)
        {
            var retornoValorConvertido = _ConversaoMoedaEuroService.Converter(new Converter() { Valor = p_valor, Taxa = p_taxa });
            Assert.AreEqual(retornoValorConvertido, 12.825);
            Assert.AreEqual(_FormatoRetornoEuro.Simbolo, "€");
        }

        [TestCase(25, 6.47)]
        public void TestarConversaoEuroParaRealEntradaMaiorQueZero(double p_valor, double p_taxa)
        {
            var retornoValorConvertido = _ConversaoMoedaRealService.Converter(new Converter() { Valor = p_valor, Taxa = p_taxa });
            Assert.AreEqual(retornoValorConvertido, 161.75);
            Assert.AreEqual(_FormatoRetornoReal.Simbolo, "R$");
            Assert.AreNotEqual(_FormatoRetornoDolar.Simbolo, "R$");
            Assert.AreNotEqual(_FormatoRetornoEuro.Simbolo, "R$");
        }
    }
}