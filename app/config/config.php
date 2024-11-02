<?php

/**
 * En caso que no tome el directorio de la aplicación,
 * en esta linea se vuelve a definir
 */
defined('APP_PATH') || define('APP_PATH', realpath('.'));

/**
 * Se importa la clase Config desde las librerías Base,
 * y se generan las variables de configuración
 */
require_once(APP_PATH . '/core/Config.php');
$config = Config::singleton();

/**
 * Se agregan las distintas configuraciones que se requiera, 
 * estas son algunas básicas, en breve su descripción
 */

$config->set('controllersDir', APP_PATH . '/app/controllers/'); //Directorio de los controladores
$config->set('modelsDir', APP_PATH . '/app/models/'); // Directorio de los Modelos
$config->set('viewsDir', APP_PATH . '/app/views/'); // Directorio de las vistas
$config->set('baseDir', APP_PATH . '/app/base/'); // Directorio de las librerías base
$config->set('configDir', APP_PATH . '/app/config/'); //Directorio de Configuraciones y cargadores
$config->set('baseUri', '/'); // Directorio raíz de la aplicación
$config->set('baseUrl', 'http://localhost/asistencia_personal'); // Página web base a la que pertenece
define('BASE_URL', 'http://localhost/asistencia_personal');
 
$config->set('adapter', 'mysql'); // Driver de base de datos (puede cambiar a los drives que se mencionan en config/loader.php)
$config->set('host', 'localhost'); // Dirección del servidor de la Base de datos
$config->set('username', 'root'); // Usuario de la Base de datos
$config->set('password', ''); // Contraseña de la base de datos
$config->set('dbname', 'tabla'); // Nombre de la base de datos
$config->set('charset', 'utf8'); // Codificación de la base de datos
//phnx
return $config;
?>
