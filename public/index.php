<?php
    // Carrega as configurações gerais
    require_once(dirname(__FILE__,2) . '/src/config/config.php');

    // Carrega os módulos
    $uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

    if($uri === '/' || $uri === '' || $uri === '/index.php') {
        $uri = '/day_records.php';
    }

    require_once(CONTROLLER_PATH ."{$uri}");
?>