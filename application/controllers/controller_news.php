<?php
use application\models\Model_News;
use application\core\User;

class Controller_News extends Controller {

	function __construct() {
		$this->model = new Model_News();
		$this->view = new View();
	}

	function action_index() {
		$user =  new User();

		$data = array(
			'news' => $this->model->get_data(),
			'comments' => $this->model->get_comments(),
			'thisUserID' => null,
		);

		if ($user->is_auth()) {
			$data['thisUserID'] = $user->getID();
		}

		$this->view->generate('news_view.php', 'template_view.php', $data);
	}

	function action_delete_comment() {
		$user =  new User();

		if ($user->is_auth()) {
			$userID = (int)$user->getID();
			$commentID = (int)$_POST['id'];

			$this->model->delete_comment($commentID, $userID);
			$this->view->redirect('/news', 'Комментарий удален.');
		}else {
			$this->view->redirect('/news');
		}

		return true;
	}

	function action_add_comment() {
		$user =  new User();

		if ($user->is_auth()) {
			$userID = (int)$user->getID();
			$newsID = (int)$_POST['id'];
			$comment = htmlspecialchars($_POST['comment']);

			if (!empty($comment)) {
				$data = array(
					'userID' => $userID,
					'newsID' => $newsID,
					'comment' => $comment
				);

				$this->model->create_comment('comments', $data);
			}else {
				$this->view->redirect('/news', 'Заполните все поля.');
			}
		}

		$this->view->redirect('/news', 'Комментарий добавлен.');
		return true;
	}
}
