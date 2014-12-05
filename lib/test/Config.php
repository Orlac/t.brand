<?php

namespace test;

class Config extends Singleton
{
	protected $_cfgdir = 'cfg';
	protected $_config = array();
	protected $_name;

	// public function __construct()
	// {
	// 	$this->_use('default');
	// }

	public function set($name)
	{
		$this->_use('default');
		$this->_use($name, true);
		$this->_name = $name;
	}


	public function getIsConfigDir($action)
	{
		$name = "{$this->_name}-$action";
		return $this->_check_use($name);
	}

	public function apply($name)
	{
		$name = "{$this->_name}-$name";
		$this->_use($name, true);
	}

	public function applyAny( array $dirs)
	{
		$name = array_shift($dirs);

		if($name){
			$name = "{$this->_name}-$name";
			if($this->_check_use($name)){
				$this->_use($name, true);
				return true;
			}
		}
		return false;
	}

	public function __get($name)
	{
		if( !isset($this->_config[$name]) )
		{
			throw new \Exception("Config option `$name' is invalid");
		}

		return $this->_config[$name];
	}

    protected function _check_use($name)
	{
		$name = $this->_filter_usename($name);
		$filename = $this->_filter_filename($name);
		if( !is_readable($filename) )
		{
			return false;
		}
		return true;
	}

	protected function _filter_usename($name)
	{
		$name = preg_replace('#[^\w-.]#', '', $name);
		return $name;
	}

	protected function _filter_filename($name)
	{
		return PROJECTROOT . "/{$this->_cfgdir}/$name.php";
	}		

	protected function _use($name, $incremental = false)
	{
		if( !$this->_check_use($name) )
		{
			throw new \Exception("Config `$name' is invalid");
		}

		$name = $this->_filter_usename($name);
		$filename = $this->_filter_filename($name);

		$this->_config = $incremental
			? array_merge($this->_config, include($filename))
			: include($filename);
	}
}
