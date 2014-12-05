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
        require_once(PROJECTROOT . '/' . self::$_libdir . '/' . strtr($class, '_\\', '//') . '.php');
    }
}

function S($class)
{
    $class = __NAMESPACE__ . '\\' . $class;
    return $class::getInstance();
}
