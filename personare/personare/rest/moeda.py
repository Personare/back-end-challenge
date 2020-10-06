import json
from flask import Blueprint, Response

from personare.use_cases import request_object as req
from personare.repository import moedasrepo as mr
from personare.use_cases import convert_moeda_use_case as uc
from personare.serializers import moeda_serializer as mer

blueprint = Blueprint('conversor', __name__)


@blueprint.route('/conversao', methods=['GET'])
def moeda():
    request_object = req.ConverteRequestObject.converte({})

    repo = mr.MoedasRepo()
    use_case = uc.CovertMoedaUseCase(repo)

    response = use_case.execute(request_object)

    return Response(json.dumps(response.value, cls=mer.MoedaEncoder),
                    mimetype='application/json',
                    status=200)
