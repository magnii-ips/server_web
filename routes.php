<?php
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestUri = trim($requestUri, '/');

$routes = [
    '' => [\App\Controllers\MainController::class, 'index'],
    'index.php' => [\App\Controllers\MainController::class, 'index'],
    'articles' => [\App\Controllers\ArticleController::class, 'index'],
    'articles/create' => [\App\Controllers\ArticleController::class, 'create'],
    'calculator' => [\App\Controllers\CalculatorController::class, 'index'],
    'login' => [\App\Controllers\AuthController::class, 'login'],
    'register' => [\App\Controllers\AuthController::class, 'register'],
    'logout' => [\App\Controllers\AuthController::class, 'logout'],
    'bye' => [\App\Controllers\MainController::class, 'bye'],
];

// Маршрут /articles/{id}
if (preg_match('~^articles/(\d+)$~', $requestUri, $matches)) {
    $controller = new \App\Controllers\ArticleController();
    $controller->view((int)$matches[1]);
    exit;
}

// Маршрут /articles/{id}/edit
if (preg_match('~^articles/(\d+)/edit$~', $requestUri, $matches)) {
    $controller = new \App\Controllers\ArticleController();
    $controller->edit((int)$matches[1]);
    exit;
}

// Маршрут /articles/{id}/delete
if (preg_match('~^articles/(\d+)/delete$~', $requestUri, $matches)) {
    $controller = new \App\Controllers\ArticleController();
    $controller->delete((int)$matches[1]);
    exit;
}

// Маршрут /bye/{name}
if (preg_match('~^bye/(.+)$~', $requestUri, $matches)) {
    $controller = new \App\Controllers\MainController();
    $controller->bye(urldecode($matches[1]));
    exit;
}

if (isset($routes[$requestUri])) {
    [$controllerClass, $action] = $routes[$requestUri];
    $controller = new $controllerClass();
    $controller->$action();
    exit;
}

http_response_code(404);
echo '<h1>404 - Страница не найдена</h1><p><a href="/">На главную</a></p>';