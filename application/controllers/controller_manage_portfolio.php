<?php
use application\core\User;
use application\models\Model_User;
use application\models\Model_Portfolio;

class Controller_Manage_Portfolio extends Controller {

	function __construct() {
		$this->model = new Model_User();
		$this->modelPortfolio = new Model_Portfolio();
		$this->view = new View();
	}

	function action_index() {
		$user = new User();
		$userID = $user->getID();

		if ($user->is_auth()) {
			if ($this->model->is_admin($userID)) {
				$data = $this->modelPortfolio->get_data();
				$this->view->generate('manage_portfolio_view.php', 'template_view.php', $data);
				return true;
			}
		}

		$this->view->redirect('/');
	}

	function action_delete() {
		$user = new User();
		$userID = $user->getID();

		if ($user->is_auth()) {
			if ($this->model->is_admin($userID)) {
				$postID = (int)$_POST['id'];

				$this->modelPortfolio->delete_record($postID);
				$this->view->redirect('/manage_portfolio');
				return true;
			}
		}

		$this->view->redirect('/');
	}
}
