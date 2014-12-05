<?php

namespace test;

class Request extends Singleton
{
    protected $_dirs = null;

    protected function _initDirs()
    {
        if( !is_null($this->_dirs) )
        {
            return;
        }

        $q = $_SERVER['REQUEST_URI'];
        if( ($argsStartPos = strpos($q, '?')) !== false )
        {
            $q = substr($q, 0, $argsStartPos);
        }

        $this->_dirs = preg_split("#/#", $q, -1, PREG_SPLIT_NO_EMPTY);
    }

    public function getDirs()
    {
		$this->_initDirs();
        return $this->_dirs;
    }

    public function getDir($n, $default = null)
    {
		$this->_initDirs();
        return isset($this->_dirs[$n]) ? $this->_dirs[$n] : $default;
    }

    public function get($name, $default = null)
    {
        return isset($_GET[$name]) ? $_GET[$name] : $default;
    }

    public function post($name, $default)
    {
        return isset($_POST[$name]) ? $_POST[$name] : $default;
    }

    public function cookie($name, $default)
    {
        return isset($_COOKIE[$name]) ? $_COOKIE[$name] : $default;
    }
}
