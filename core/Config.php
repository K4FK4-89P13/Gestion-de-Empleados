<?php
/**
 * Clase Coonfig, esta clase se encarga de gestionar la creación
 * y obtención de configuraciones.
 *
 * Para usar la Clase configuración se declara primero como
 * $config = Config::singleton();
 *
 * Para asignar una variable 
 * $config->set('nombreConfiguracion' , 'configuracion');
 *
 * Para obtener una variable $config->get('nombreConfiguracion');
 */
class Config
{
    /**
     * Se declaran las variables privadas $vars e $instance
     */
    private $vars;
    private static $instance;
 
    /**
     * Constructor de la Clase, al utilizar singleton
     * cada vez que se llama se declaran y se suman a las
     * variables ya creadas (incremental).
     */
    private function __construct()
    {
        $this->vars = array();
    }
 
    /**
     * Función que guarda o más bien crea una nueva variable
     */
    public function set($name, $value)
    {
        if(!isset($this->vars[$name]))
        {
            $this->vars[$name] = $value;
        }
    }
 
    /**
     * La función get se encarga de devolver la variable deseada.
     */
    public function get($name)
    {
        if(isset($this->vars[$name]))
        {
            return $this->vars[$name];
        }
    }
    
    /**
     * La clase singleton mantiene una única instancia de la clase
     * lo que significa un mayor rendimiento a la hora de llamarla
     */
    public static function singleton()
    {
        if (!isset(self::$instance)) {
            $c = __CLASS__;
            self::$instance = new $c;
        }
 
        return self::$instance;
    }
}
?>