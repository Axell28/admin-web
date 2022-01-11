<?php

require_once __DIR__ . '/core/config.php';
require_once __DIR__ . '/core/conexion.php';
require_once __DIR__ . '/core/funciones.php';
require_once __DIR__ . '/core/controller.php';

$uri = isset($_GET['uri']) ? $_GET['uri'] : 'index';
$uri = rtrim($uri, '/');
$uri = explode('/', $uri);

if ($uri[0] == 'admin') {
    $controller = isset($uri[1]) ? $uri[1] : 'login';
    $controller = ucwords($controller);
    $fileController = DIROOT . "/controllers/{$controller}Controller.php";
    if (file_exists($fileController)) {
        require_once $fileController;
        $controller = new $controller;
        $method = isset($uri[2]) ? $uri[2] : 'index';
        $params = null;
        if (method_exists($controller, $method) || method_exists($controller, '__call')) {
            if (isset($uri[3])) {
                for ($i = 3; $i < count($uri); $i++) :
                    $params[] = $uri[$i];
                endfor;
            }
            $controller->{$method}($params);
        } else {
            die('Error:: Method does not exist.');
        }
    } else {
        die('Error:: Controller does not exist.');
    }
} else {
    $fileView = DIROOT . "/views/web/{$uri[0]}.php";
    if (file_exists($fileView)) {
        include_once $fileView;
    } else {
        die('Error 404 => This page does not exist');
    }
}
