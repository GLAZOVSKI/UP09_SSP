<?php
namespace application\models;

use application\core\Model;

class Model_News extends Model {

	public function get_data() {
		return Model::getRecords("SELECT * FROM `news`");
	}

	public function delete_record($id) {
		return Model::delete("DELETE FROM `news` WHERE `id` = $id");
	}

	public function update_record($table, $data = array(), $id) {
		return Model::update($table, $data, $id);
	}

	public function create_record($table, $data = array()) {
		return Model::create($table, $data);
	}
}
