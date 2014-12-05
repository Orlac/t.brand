<?php

namespace test;

class Template extends Singleton
{
	private $_tpldir = 'tpl';
	private $_glob = array();

	public function show($name, $args = array())
	{
		$name = PROJECTROOT . "/{$this->_tpldir}/$name.php";

		if( !is_readable($name) )
		{
			throw new \Exception("Template file `$name' isn't exists or isn't readable");
		}

		$glob = $this->_glob;

		require($name);
	}

	public function get($name, $args = array())
	{
		ob_start();
		$this->show($name, $args);
		$result = ob_get_contents();
		ob_end_clean();

		return $result;
	}

	public function setGlob($name, $value)
	{
		$this->_glob[$name] = $value;
	}

	public function getGlob($name)
	{
		return isset($this->_glob[$name]) ? $this->_glob[$name] : null;
	}
}
