from flask import Flask

from personare.rest import moeda
from personare.settings import DevConfig


def create_app(config_object=DevConfig):
    app = Flask(__name__)
    app.config.from_object(config_object)
    app.register_blueprint(moeda.blueprint)
    return app