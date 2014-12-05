<?php

namespace test\controllers;
use test\Controller;
use test\Response;

class Index extends Controller
{
	public function index()
	{
		Response::answer($this->tpl->get('index'));
	}
}
