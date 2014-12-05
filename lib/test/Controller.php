<?php

namespace test;

class Controller
{
	protected $tpl;
	protected $req;

	public function __construct()
	{
		$this->tpl = S('Template');
		$this->req = S('Request');
		$action = $this->req->getDir(0);

		if( ($action == 'brand1') || ($action == 'brand2') )
		{
			$this->tpl->setGlob('baseurl', "/$action");
		}
		else
		{
			$this->tpl->setGlob('baseurl', '');
		}

		session_start();

		$this->_performChecks();
	}

	protected function _subscribe()
	{
		$_SESSION['subs'] = 1;
	}

	protected function _unsubscribe()
	{
		$_SESSION['subs'] = 0;
	}

	private function _isSubscribed()
	{
		return isset($_SESSION['subs']) ? $_SESSION['subs'] : 0;
	}

	private function _performChecks()
	{
		$action = S('Request')->getDir(0);
		if( $action == 'brand1' )
		{
			$action = S('Request')->getDir(1);
		}

		if( !$this->_isSubscribed() && ($action != 'subscribe') )
		{
			Response::redirect('/subscribe');
		}
	}
}
