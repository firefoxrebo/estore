<?php
namespace PHPMVC\LIB;

class AutoLoad
{
    public static function autoload($className)
    {
        $className = str_replace('PHPMVC', '', $className);
        $className = str_replace('\\', '/', $className);
        $className = $className . '.php';
        $className = strtolower($className);
        if(file_exists(APP_PATH . $className)) {
            require_once APP_PATH . $className;
        }
    }
}
spl_autoload_register(__NAMESPACE__ . '\AutoLoad::autoload');