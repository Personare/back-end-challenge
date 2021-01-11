function validateQuery(fields) {
    return (req, res, next) => {
        let missingParams = "";
        let invalidTypes = "";
        for (const field of fields) {
            if (!checkParamPresent(req, field.name)) {
                missingParams += `[${field.name}] `;
            } else if (!checkParamType(req, field.name, field.type)) {
                invalidTypes += `[${field.name}] `;
            }
        }
        
        if (missingParams != "") {
            return res.status(400).send({ message: 'Required query params missing! ' + missingParams});
        }
        else if (invalidTypes != "") {
            return res.status(400).send({ message: 'Invalid params types! ' + invalidTypes});
        }

        next();
    };
}

function checkParamPresent(reqParam, objParam) {
    return (reqParam.query[objParam])
}

function checkParamType(reqParam, objParamName, objParamType) {
    let reqParamValue = reqParam.query[objParamName];

    if (objParamType == "number") {
        return (!isNaN(reqParamValue))
    }

    return (typeof reqParamValue === objParamType);
}

module.exports = {validateQuery}

