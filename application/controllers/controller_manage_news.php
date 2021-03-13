<?php
use application\core\User;
use application\models\Model_User;
use application\models\Model_News;

class Controller_Manage_News extends Controller {

	function __construct() {
		$this->model = new Model_User();
		$this->modelNews = new Model_News();
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
			$user =  new User();

			$data = array(
				'news' => $this->modelNews->get_data(),
				'comments' => $this->modelNews->get_comments(),
			);

			$this->view->generate('manage_news_view.php', 'template_view.php', $data);
			return true;
		}

		$this->view->redirect('/');
	}

	function action_delete() { // Удалить запись
		if ($this->checkUser()) {
			$postID = (int)$_POST['id'];

			$this->modelNews->delete_record($postID);
			$this->view->redirect('/manage_news', 'Запись удалена.');
			return true;
		}

		$this->view->redirect('/');
	}

	function action_edit() { // Изменить запись
		if ($this->checkUser()) {
			$postID = (int)$_POST['id'];

			$data = array();

			if (!empty($_POST['title'])) {
				$data['title'] = $_POST['title'];
			}

			if (!empty($_POST['description'])) {
				$data['description'] = $_POST['description'];
			}

			if (empty($data)) {
				$this->view->redirect('/manage_news');
				return true;
			}

			$this->modelNews->update_record('news', $data, $postID);

			$this->view->redirect('/manage_news', 'Запись изменена.');
			return true;
		}

		$this->view->redirect('/');
	}

	function action_add() { // Создать запись
		if ($this->checkUser()) {
			if (!empty($_POST['title']) && !empty($_POST['description'])) {

				$data = array(
					'title' => $_POST['title'],
					'description' => $_POST['description']
				);

				$this->modelNews->create_record('news', $data);
				$this->view->redirect('/manage_news');

				return true;
			}

			$this->view->redirect('/manage_news', 'Заполните все поля.');
			return true;
		}
	}

	function action_delete_comment() {
			if ($this->checkUser()) {
				$commentID = (int)$_POST['id'];

				$this->modelNews->admin_delete_comment($commentID);
				$this->view->redirect('/manage_news', 'Комментарий удален.');

				return true;
			}
	}
}
