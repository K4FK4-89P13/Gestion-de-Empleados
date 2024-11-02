<?php
session_start();
define('APP_PATH', realpath('..'));

try {
    require_once APP_PATH . '/core/Core.php';
    require_once APP_PATH . '/core/Controller.php';
    require_once APP_PATH . '/core/Model.php';
    
    $config = include APP_PATH . '/app/config/config.php';
    //echo realpath('..');
    $init = new Core();

} catch (Exception $e) {
    echo $e->getMessage() . '<br>';
    echo "<pre>{$e->getTraceAsString()}</pre>";
}



/* $ruta = $init->get_url();
print_r($ruta); */