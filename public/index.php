<?php
session_start();

$scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME'] ?? ''));
$scriptDir = rtrim($scriptDir, '/');// retire un '/'éventuel pour eviter les doubles '//
$baseUrl = preg_replace('#/public$#', '', $scriptDir);
$baseUrl = $baseUrl ?: '';

if (!defined('BASE_URL')) {
    define('BASE_URL', $baseUrl);
}

if (!function_exists('url')) {
    function url(string $path = ''): string {
        $path = ltrim($path, '/');
        if ($path === '') {
            return BASE_URL . '/';
        }

        if (str_starts_with($path, 'assets/')) {
            return BASE_URL . '/' . $path;
        }

        return BASE_URL . '/?url=' . rawurlencode($path);
    }
}

spl_autoload_register(function ($class) {
    $controllersPath = __DIR__ . "/../controllers/$class.php";
    $modelsPath = __DIR__ . "/../models/$class.php";

    if (file_exists($controllersPath)) {
        require $controllersPath;
    } elseif (file_exists($modelsPath)) {
        require $modelsPath;
    }
});

$url = $_GET['url'] ?? 'home';
$url = rtrim($url, '/');
$url = explode('/', $url);

$controllerName = ucfirst($url[0]) . 'Controller';
$action = $url[1] ?? 'index';
$params = array_slice($url, 2);

$routeMap = [
    'login' => ['AuthController', 'login'],
    'doLogin' => ['AuthController', 'doLogin'],
    'register' => ['AuthController', 'register'],
    'doRegister' => ['AuthController', 'doRegister'],
    'logout' => ['AuthController', 'logout'],
    'home' => ['HomeController', 'index'],
    'profil' => ['UserController', 'index'],
    'annonces' => ['AnnonceController', 'index'],
    'messages' => ['MessageController', 'index'],
];

if (isset($routeMap[$url[0]])) {
    [$controllerName, $action] = $routeMap[$url[0]];
    $params = array_slice($url, 1);
}

if (!file_exists(__DIR__ . "/../controllers/$controllerName.php")) {
    http_response_code(404);
    echo "404 - Page non trouvée";
    exit;
}

$controller = new $controllerName();
if (!method_exists($controller, $action)) {
    http_response_code(404);
    echo "404 - Action non trouvée";
    exit;
}

call_user_func_array([$controller, $action], $params);