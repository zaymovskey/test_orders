<?php
declare(strict_types=1);

use App\Controller\AddOrderController;
use App\Controller\CreateOrderController;
use App\Controller\OrdersListController;
use App\OrderMapper;
use App\ProductMapper;
use League\Route\Router;
use Laminas\HttpHandlerRunner\Emitter\SapiEmitter;
use Laminas\Diactoros\ServerRequestFactory;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use App\Twig\AssetExtension;

require_once __DIR__ . '/../bootstrap.php';

$request = ServerRequestFactory::fromGlobals(
    $_SERVER, $_GET, $_POST, $_COOKIE, $_FILES
);

$config = include 'config/database.php';

try {
    $connection = new PDO($config['dsn'], $config['username'], $config['password']);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (PDOException $exception) {
    echo 'Database error: ' . $exception->getMessage();
    die;
}

$productMapper = new ProductMapper($connection);
$orderMapper = new OrderMapper($connection);

$router = new Router;
$loader = new FilesystemLoader('templates');
$twig = new Environment($loader);
$twig->addExtension(new AssetExtension());

$router->map('GET', '/orders', (new OrdersListController($twig, $orderMapper)));
$router->map('GET', '/create_order',  (new CreateOrderController($twig, $productMapper)));
$router->map('POST', '/add_order', (new AddOrderController($orderMapper)));

$response = $router->dispatch($request);

(new SapiEmitter)->emit($response);