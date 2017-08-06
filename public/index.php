<?php
//error_reporting(E_ALL);
//ini_set('display_errors', 1);
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
//require '../src/db-config/connect.php';

//Load environmental variables
$dotenv = new Dotenv\Dotenv(__DIR__ . '/..');
$dotenv->load();

//require_once "../src/routes/customers.php";

$app = new \Slim\App;
$container = $app->getContainer();

$app->get('/hello/{name}', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    $response->getBody()->write("Hello, $name");

    return $response;
});

require_once "../src/routes/routes.php";
$app->run();