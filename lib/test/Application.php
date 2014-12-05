<?php

namespace test;

class Application extends Singleton
{
	protected $_controllersdir = 'controllers';

	public function run()
	{
		$dirs = (array) S('Request')->getDirs();
		if( S('Config')->applyAny($dirs) )
		{
			array_shift($dirs);
		}

		if( !count($dirs) )
		{
			$dirs[] = S('Config')->defaultClass;
		}
		$class = array_shift($dirs);

		if( !count($dirs) )
		{
			$dirs[] = S('Config')->defaultAction;
		}
		$action = array_shift($dirs);
		
		if( !preg_match('#^\w+$#', $class) || !preg_match('#^\w+$#', $action) )
		{
			Response::headerForbidden();
		}

		$class = __NAMESPACE__ . '\\' . $this->_controllersdir . '\\' . $class;
		try{
			$controller = new $class;
		}catch(\Exception $e){
			Response::headerNotFound();	
		}
		
		$controller = new $class;
		
		if( !method_exists($controller, $action) )
		{
			Response::headerNotFound();
		}

		call_user_func_array(array($controller, $action), $dirs);
	}
}
