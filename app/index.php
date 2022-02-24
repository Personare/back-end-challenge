<?php
require_once "./vendor/autoload.php";

use App\Application\Controllers\ExchangeController;
use App\Core\UseCase\ExchangeCurrencyUseCase;
use App\Infra\Repository\PostgresRepository;


$request = parse_url($_SERVER['REQUEST_URI']);

if ($_SERVER['REQUEST_METHOD'] === 'GET' && $request['path'] === '/api') {

    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");

    try {
        $repo = new PostgresRepository();
        $useCase = new ExchangeCurrencyUseCase($repo);
        $controller = new ExchangeController($useCase);

        echo $controller->handle($_GET);
    } catch (\Exception $th) {

        http_response_code($th->getCode());
        echo json_encode(["Error" => $th->getMessage()]);
    }
} else {

    http_response_code(404);
    echo json_encode('Request Method not Accepted');
}
