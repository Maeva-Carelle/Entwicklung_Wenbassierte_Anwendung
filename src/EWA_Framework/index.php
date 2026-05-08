<?php
declare(strict_types=1);

require_once 'App/Core/Router.php';
require_once 'App/Core/DebugHelper.php';

// Routing light:
// .htaccess rewrites "/something" to "index.php?url=something"
$router = new Router();

try {
    switch ($router->getRoute()) {
        case '':
        case 'index':
            require_once 'App/Controller/IndexController.php';
            $controller = new IndexController();
            break;
        case 'about':
            require_once 'App/Controller/AboutController.php';
            $controller = new AboutController();
            break;

        default:
            http_response_code(404);
            echo '<h1>404 - Page not found</h1>';
            exit;
    }

    if (!isset($controller)) {
        http_response_code(404);
        throw new Exception('No controller selected for this route.');
    }

    $controller->handleRequest();
} catch (Exception $e) {
    header('Content-type: text/html; charset=UTF-8');
    echo '<h1>Unexpected error occurred</h1>';
    echo "<p>" . htmlspecialchars($e->getMessage()) . "</p>";
}
