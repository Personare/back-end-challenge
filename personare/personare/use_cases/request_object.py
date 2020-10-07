import collections

from personare.shared import request_object as req


class ConverteRequestObject(req.ValidRequestObject):
    
    def __init__(self, *args):
        pass
        
    @classmethod
    def converte(self):
        invalid_req = req.InvalidRequestObject()

        if invalid_req.has_errors():
            return invalid_req

        return ConverteRequestObject(req.ValidRequestObject)