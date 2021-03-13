<?php
use application\models\Model_User;
use application\core\User;

class Controller_Manage_Account extends Controller {

	function __construct() {
		$this->model = new Model_User();
		$this->view = new View();
	}

	function checkUser() { // Проверка пользователя на администратора
		$user = new User();
		$userID = $user->getID();

		if ($user->is_auth()) {
			if ($this->model->is_admin($userID)) {
				return true;
			}
		}

		return false;
	}

	function action_index() {
		if ($this->checkUser()) {
			$data = $this->model->get_all_users();
			$this->view->generate('manage_account_view.php', 'template_view.php', $data);
		}else {
			$this->view->redirect('/');
		}

		return true;
	}

	function action_block() {
		if ($this->checkUser()) {
			$user = new User();

			$userID = (int)$_POST['id'];

			if ($user->getID() != $userID) {
				$data = array(
					'blocked' => 1
				);

				$this->model->update('users', $data, $userID);
				$this->view->redirect('/manage_account');
			}else {
				$this->view->redirect('/manage_account', 'Вы не можете заблокировать сами себя.');
			}
		}else {
			$this->view->redirect('/');
		}

		return true;
	}

	function action_un_block() {
		if ($this->checkUser()) {
			$userID = (int)$_POST['id'];

			$data = array(
				'blocked' => 0
			);

			$this->model->update('users', $data, $userID);
			$this->view->redirect('/manage_account');
		}else {
			$this->view->redirect('/');
		}

		return true;
	}

	function action_add_admin() {
		if ($this->checkUser()) {
			$userID = (int)$_POST['id'];

			$data = array(
				'admin' => 1
			);

			$this->model->update('users', $data, $userID);
			$this->view->redirect('/manage_account');
		}else {
			$this->view->redirect('/');
		}

		return true;
	}

	function action_remove_admin() {
		if ($this->checkUser()) {
			$user = new User();

			$userID = (int)$_POST['id'];

			if ($user->getID() != $userID) {
				$data = array(
					'admin' => 0
				);

				$this->model->update('users', $data, $userID);
				$this->view->redirect('/manage_account');
			}else {
				$this->view->redirect('/manage_account', 'Вы не можете забрать права у себя.');
			}
		}else {
			$this->view->redirect('/');
		}

		return true;
	}

	function action_delete_user() {
		if ($this->checkUser()) {
			$user = new User();

			$userID = (int)$_POST['id'];

			if ($user->getID() != $userID) {

				$this->model->delete_user($userID);
				$this->view->redirect('/manage_account');
			}else {
				$this->view->redirect('/manage_account', 'Вы не можете удалить сами себя.');
			}
		}else {
			$this->view->redirect('/');
		}

		return true;
	}
}
