using AutoMapper;
using CurrencyConverter.Api.AutoMapper;
using CurrencyConverter.Api.Contracts.Request;
using CurrencyConverter.Api.Validators;
using CurrencyConverter.Domain.Services.Factories;
using CurrencyConverter.Domain.Services.Factories.Interfaces;
using CurrencyConverter.Domain.Services.Orchestrators;
using CurrencyConverter.Domain.Services.Orchestrators.Interfaces;
using CurrencyConverter.Domain.ValueObjects;
using FluentValidation;
using FluentValidation.AspNetCore;

var builder = WebApplication.CreateBuilder(args);

// Add services to the container.

builder.Services.AddControllers().AddFluentValidation();

// Learn more about configuring Swagger/OpenAPI at https://aka.ms/aspnetcore/swashbuckle
builder.Services.AddEndpointsApiExplorer();
builder.Services.AddSwaggerGen();

builder.Services.AddTransient<IValidator<CurrencyConverterRequestModel>, CurrencyConverterModelValidator>();

builder.Services.AddTransient<ICurrency, Dolar>();
builder.Services.AddTransient<ICurrency, Euro>();
builder.Services.AddTransient<ICurrency, Real>();

builder.Services.AddTransient<IAmountFactory, AmountFactory>();

builder.Services.AddTransient<ICurrencyConverterOrchestrator>(resolver =>
{
    var currencyList = resolver.GetServices<ICurrency>();

    var amountFactory = resolver.GetService<IAmountFactory>();

    return new CurrencyConverterOrchestrator(currencyList, amountFactory);
});

builder.Services.AddAutoMapper(cfg =>
{
    cfg.AddProfile<AmountProfile>();
    cfg.AddProfile<CurrencyModelProfile>();
});

var app = builder.Build();

// Configure the HTTP request pipeline.
if (app.Environment.IsDevelopment())
{
    app.UseSwagger();
    app.UseSwaggerUI();
}

app.UseHttpsRedirection();

app.UseHttpLogging();

app.UseAuthorization();

app.MapControllers();

app.Run();
