<?php

namespace test;

class Loader
{
    protected static $_libdir = 'lib';

    public static function init()
    {
        return spl_autoload_register(array(__CLASS__, 'includeClass'));
    }

    public static function includeClass($class)
    {
        $file = PROJECTROOT . '/' . self::$_libdir . '/' . strtr($class, '_\\', '//') . '.php';
        if(is_file($file)){
            require_once($file);
        }else{
            throw new \Exception("class not found ".$file);
        }
        
    }
}

function S($class)
{
    $class = __NAMESPACE__ . '\\' . $class;
    return $class::getInstance();
}
