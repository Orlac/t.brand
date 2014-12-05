<?php

namespace test\controllers;
use test\Controller;
use test\Response;

class unsubscribe extends Controller
{
	public function index()
	{
		if( $this->req->get('yes') )
		{
			$this->_unsubscribe();
			Response::redirect('/');
		}

		Response::answer($this->tpl->get('unsubscribe'));
	}
}
