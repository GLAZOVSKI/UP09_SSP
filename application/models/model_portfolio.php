<?php
namespace application\models;

use application\core\Model;

class Model_Portfolio extends Model {

	public function get_data() {
		return Model::getRecords("SELECT * FROM `portfolio`");
	}

	public function delete_record($id) {
		return Model::delete("DELETE FROM `portfolio` WHERE `id` = $id");
	}

	public function update_record($table, $data = array(), $id) {
		return Model::update($table, $data, $id);
	}

	public function create_record($table, $data = array()) {
		return Model::create($table, $data);
	}
}
