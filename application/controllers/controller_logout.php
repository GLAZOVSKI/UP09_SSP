<?php
use application\core\User;

class Controller_Logout extends Controller {

	function action_index() {
		$user = new User();
		$user->logout();
		
		$this->view->redirect('/');
	}
}
