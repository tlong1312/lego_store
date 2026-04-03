<?php
date_default_timezone_set('Asia/Ho_Chi_Minh');
session_start();

spl_autoload_register(function ($class_name) {
    $paths = ['./config/', './controllers/', './models/'];
    foreach ($paths as $path) {
        $file = $path . $class_name . '.php';
        if(file_exists($file)) {
            require_once $file;
            return ;
        }
    }
});

$controllerName = isset($_GET['controller']) ? $_GET['controller'] : 'home';
$actionName = isset($_GET['action']) ? $_GET['action'] : 'index';

$controllerClass = ucfirst($controllerName) . 'Controller';

if (class_exists($controllerClass)) {
    $controller = new $controllerClass();

    if(method_exists($controller, $actionName)) {
        $controller->$actionName();
    }else {
        echo "Lỗi 404: Không tìm thấy Action '$actionName'!";
    }
}else {
    echo "Lỗi 404: Không tìm thấy Controller '$controllerClass'!";
}
?>