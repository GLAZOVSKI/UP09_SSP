<?php
use application\core\User;

class Controller_Account extends Controller {

	function action_index() {
		$user = new User();
		
		if (!$user->is_auth()) {
			$this->view->redirect('/login', 'Войдите в аккаунт.');
		}

		$this->view->generate('account_view.php', 'template_view.php');
	}
}
