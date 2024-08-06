<?php
    // Erros não amigaveis

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    // Time Zone e Localização
    date_default_timezone_set('America/Sao_Paulo');
    setlocale(LC_TIME,'pt_BR','pt_BR.utf-8','portuguese');

    // Constantes Gerais
    define('DAILY_TIME', 60 * 60 * 8);
    
    // Pastas
    define('MODEL_PATH', realpath(dirname(__FILE__) . '/../models'));
    define('VIEW_PATH', realpath(dirname(__FILE__) . '/../views'));
    define('TEMPLATE_PATH', realpath(dirname(__FILE__) . '/../views/template'));
    define('CONTROLLER_PATH', realpath(dirname(__FILE__) . '/../controllers'));
    define('EXCEPTION_PATH', realpath(dirname(__FILE__) . '/../exceptions'));

    // Arquivos
    require_once(realpath(dirname(__FILE__) . '/database.php'));
    require_once(realpath(dirname(__FILE__) . '/loader.php'));
    require_once(realpath(dirname(__FILE__) . '/session.php'));
    require_once(realpath(dirname(__FILE__) . '/date_utils.php'));
    require_once(MODEL_PATH . '/Model.php');
    require_once(MODEL_PATH . '/User.php');
    require_once(EXCEPTION_PATH . '/AppException.php');
    require_once(EXCEPTION_PATH . '/ValidationException.php');
?>