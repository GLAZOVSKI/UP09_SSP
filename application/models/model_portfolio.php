<?php
namespace application\models;

use application\core\Model;

class Model_Portfolio extends Model {

	public function get_data() {
		return Model::getRecords("SELECT * FROM `portfolio`");
	}
}
