<?php
use application\core\User;
use application\models\Model_User;


class Controller_Account extends Controller {

	function __construct() {
		$this->model = new Model_User();
		$this->view = new View();
	}

	function action_index() {
		$user = new User();

		if (!$user->is_auth()) {
			$this->view->redirect('/login', 'Войдите в аккаунт.');
		}

		$userID = $user->getID();
		$userName = $this->model->getRecords("SELECT `firstName` FROM `users` WHERE `id` = $userID LIMIT 1")[0]['firstName'];

		$data = array(
			'admin' => $this->model->is_admin($userID),
			'userName' => $userName
		);

		$this->view->generate('account_view.php', 'template_view.php', $data);
	}
}
