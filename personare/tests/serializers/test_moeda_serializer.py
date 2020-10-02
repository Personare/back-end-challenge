import datetime
import json
import uuid

import pytest

from personare.serializers import moeda_serializer as srs
from personare.domain.moeda import Moeda


def test_serialize_domain_moeda():

    moeda = Moeda(
        valor=200,
        tipo='Real',
      
    )

    expected_json = """
        {
            "valor": 200,
            "tipo": "Real"

        }
    """
    expected_json = expected_json.replace("\n", "")

    json_moeda = json.dumps(moeda, cls=srs.MoedaEncoder)

    assert json.loads(json_moeda) == json.loads(expected_json)


def test_serialize_domain_moeda_wrong_type():
    with pytest.raises(TypeError):
        json.dumps(datetime.datetime.now(), cls=srs.MoedaEncoder)