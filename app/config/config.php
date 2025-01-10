<?php

/**
 * En caso que no tome el directorio de la aplicación,
 * en esta linea se vuelve a definir
 */
defined('APP_PATH') || define('APP_PATH', realpath('.'));


/**
 * Se agregan las distintas configuraciones que se requiera, 
 * estas son algunas básicas, en breve su descripción
 */

define('BASE_URL', 'http://localhost/asistencia_personal'); // Página web base a la que pertenece
define('HOST', 'localhost'); // Dirección de la Base de Datos
define('USERNAME', 'root'); // usuario de la Base de Datos
define('PASSWORD', 'admin'); // Contraseña de la base de datos
define('DBNAME', 'asistenciapersonal'); // Nombre de la base de datos
?>
