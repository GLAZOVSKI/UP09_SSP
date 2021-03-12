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
}
