using AutoFixture;
using AutoFixture.AutoNSubstitute;
using AutoFixture.Xunit2;
using Microsoft.AspNetCore.Mvc.ModelBinding;

namespace CurrencyConverter.UnitTests.FixtureConfiguration;

public class AutoNSubstituteDataAttribute : AutoDataAttribute
{
    public AutoNSubstituteDataAttribute() : base(FixtureFactory) { }

    public AutoNSubstituteDataAttribute(Func<IFixture> fixture) : base(fixture) { }

    public static IFixture FixtureFactory()
    {
        var fixture = new Fixture().Customize(new AutoNSubstituteCustomization { ConfigureMembers = true });

        fixture.Customize<BindingInfo>(cfg => cfg.OmitAutoProperties());

        return fixture;
    }
}
