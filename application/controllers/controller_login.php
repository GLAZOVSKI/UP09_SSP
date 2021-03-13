<?php
use application\core\User;

class Controller_Login extends Controller {

	function action_index() {
		$user = new User();
		$user->init();

		if ($user->init()) {
			$this->view->redirect('/home');
		}

		$this->view->generate('login_view.php', 'template_view.php');
	}

	function action_auth() {
		$email = $_POST['email'];
		$password = $_POST['password'];

		if (isset($email) && isset($password)) {
			$login = new User();

			if ($login->auth($email, $password) === true) {
				$this->view->redirect('/account');
			}elseif ($login->auth($email, $password) === 'blocked') {
				$this->view->redirect('/login', 'Вы заблокированы.');
			}else {
				$this->view->redirect('/login', 'Неверный логин или пароль.');
			}
		}
	}
}
