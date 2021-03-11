<?php
spl_autoload_register();

use application\core\Validation;
use application\core\User;

class Controller_Register extends Controller {

	function action_index() {
		$user = new User();

		if ($user->init()) {
			$this->view->redirect('/home');
		}

		$this->view->generate('register_view.php', 'template_view.php', $data);
	}

	function action_submit() {
		$email = $_POST['email'];
    $password = $_POST['password'];
    $rePassword = $_POST['rePassword'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $middleName = $_POST['middleName'];

		try {
			// Валидация
			$validate = new Validation();

			if (!$validate->isLength($firstName)) {
				throw new Exception('<b>Имя</b> должно быть больше 2-х и меньше 20-ти символов.');
			}

			if (!$validate->isLength($lastName)) {
				throw new Exception('<b>Фамилия</b> должна быть больше 2-х и меньше 20-ти символов.');
			}

			if (!$validate->isLength($middleName)) {
				throw new Exception('<b>Отчество</b> должно быть больше 2-х и меньше 20-ти символов.');
			}

			if (!$validate->isCyrillic($firstName)) {
				throw new Exception('<b>Имя</b> должна быть только на кирилице.');
			}

			if (!$validate->isCyrillic($lastName)) {
				throw new Exception('<b>Фамилия</b> должна быть только на кирилице.');
			}

			if (!$validate->isCyrillic($middleName)) {
				throw new Exception('<b>Отчество</b> должна быть только на кирилице.');
			}

			if (!$validate->isLength($password, 4, 255)) {
				throw new Exception('<b>Пароль</b> должен быть больше 4-х символов.');
			}

			$validate->validateEmail($email);
		  $validate->isPasswordEqual($password, $rePassword);

			// Регистрация
			$newUser = new User();

			$newUser->Registration($email, $password, array(
				 'firstName' => $firstName,
				 'lastName' => $lastName,
				 'middleName' => $middleName
			));

			$this->view->redirect('/register', "Регистрация прошла успешно!");

	 }catch(Exception $e) {
		 $this->view->redirect('/register', $e->getMessage());
	 }
	}

}
