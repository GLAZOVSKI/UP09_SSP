<?php
namespace application\models;

use application\core\Model;

class Model_News extends Model {

	public function get_data() {
		return Model::getRecords("SELECT * FROM `news`");
	}

	public function delete_record($id) {
		Model::delete("DELETE FROM `news` WHERE `id` = $id");
		Model::delete("DELETE FROM `comments` WHERE `newsID` = $id");
		return true;
	}

	public function update_record($table, $data = array(), $id) {
		return Model::update($table, $data, $id);
	}

	public function create_record($table, $data = array()) {
		return Model::create($table, $data);
	}

	public function get_comments() {
		return Model::getRecords("SELECT `comments`.id as id, `comments`.comment,
			`users`.firstName as name, `comments`.newsID, `comments`.userID
			FROM `comments` LEFT JOIN `users` ON `comments`.userID = `users`.id");
	}

	public function delete_comment($id, $userID) {
		return Model::delete("DELETE FROM `comments` WHERE `userID` = $userID && `id` = $id");
	}

	public function admin_delete_comment($id) {
		return Model::delete("DELETE FROM `comments` WHERE `id` = $id");
	}

	public function create_comment($table, $data = array()) {
		return Model::create($table, $data);
	}
}
