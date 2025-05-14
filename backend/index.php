<?php
include 'cors.php';

header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

require_once 'config.php';
require_once 'database.php';
require_once 'routes.php';

$method = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['REQUEST_URI'];

$routeFound = false;

foreach ($routes as $route => $callback) {
    if ($path === $route && $_SERVER['REQUEST_METHOD'] === $callback['method']) {
        $routeFound = true;
        call_user_func($callback['handler']);
        break;
    }
}

if (!$routeFound) {
    http_response_code(404);
    echo json_encode(["message" => "Route not found"]);
}
?>