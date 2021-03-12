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
			$data = $this->modelPortfolio->get_data();
			$this->view->generate('manage_portfolio_view.php', 'template_view.php', $data);
			return true;
		}

		$this->view->redirect('/');
	}

	function action_delete() { // Удалить запись
		if ($this->checkUser()) {
			$postID = (int)$_POST['id'];

			$this->modelPortfolio->delete_record($postID);
			$this->view->redirect('/manage_portfolio');
			return true;
		}

		$this->view->redirect('/');
	}

	function action_edit() { // Изменить запись
		if ($this->checkUser()) {
			$postID = (int)$_POST['id'];

			$data = array();

			if (!empty($_POST['year'])) {
				$data['year'] = $_POST['year'];
			}

			if (!empty($_POST['site'])) {
				$data['site'] = $_POST['site'];
			}

			if (!empty($_POST['description'])) {
				$data['description'] = $_POST['description'];
			}

			if (empty($data)) {
				$this->view->redirect('/manage_portfolio');
				return true;
			}

			$this->modelPortfolio->update_record('portfolio', $data, $postID);

			$this->view->redirect('/manage_portfolio');
			return true;
		}

		$this->view->redirect('/');
	}

	function action_add() { // Создать запись
		if ($this->checkUser()) {
			if (!empty($_POST['year']) && !empty($_POST['site']) && !empty($_POST['description'])) {

				$data = array(
					'year' => $_POST['year'],
					'site' => $_POST['site'],
					'description' => $_POST['description']
				);

				$this->modelPortfolio->create_record('portfolio', $data);
				$this->view->redirect('/manage_portfolio');

				return true;
			}

			$this->view->redirect('/manage_portfolio', 'Заполните все поля.');
			return true;
		}
	}
}
