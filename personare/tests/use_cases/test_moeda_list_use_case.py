import pytest
from unittest import mock

from personare.domain.moeda import Moeda
from personare.use_cases import moeda_use_case as uc


@pytest.fixture
def domain_moeda():
    real = Moeda(
        valor=200,
        tipo='Real',
    )

    dolar = Moeda(
        valor=200,
        tipo='Dolar',
    )

    euro = Moeda(
        valor=100,
        tipo='Euro',
    )

    return [real, dolar, euro]


def test_moeda_list_without_parameters(domain_moeda):
    repo = mock.Mock()
    repo.list.return_value = domain_moeda

    moeda_list_use_case = uc.MoedaListUseCase(repo)
    result = moeda_list_use_case.execute()

    repo.list.assert_called_with()
    assert result == domain_moeda