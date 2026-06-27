<?php
declare(strict_types=1);

require_once 'App/Core/Router.php';
require_once 'App/Core/DebugHelper.php';
require_once 'App/Core/BaseModel.php';

$router = new Router();

try {
    switch ($router->getRoute()) {

        case '':
        case 'order':
            require_once 'App/Controller/OrderController.php';
            $controller = new OrderController();
            break;

        case 'baker':
            require_once 'App/Controller/BakerController.php';
            $controller = new BakerController();
            break;

        case 'driver':
            require_once 'App/Controller/DriverController.php';
            $controller = new DriverController();
            break;

        case 'customer':
            require_once 'App/Controller/CustomerController.php';
            $controller = new CustomerController();
            break;

        case 'api':
            require_once 'App/Controller/ApiController.php';
            $controller = new ApiController();
            break;

        default:
            http_response_code(404);
            require_once 'App/View/404.view.php';
            exit;
    }

    $controller->handleRequest();

} catch (Exception $e) {
    http_response_code(500);
    echo "<h1>Unexpected error occurred</h1>";
    echo "<p>" . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "</p>";
}