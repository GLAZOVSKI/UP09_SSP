<?php
namespace application\models;

use application\core\Model;

class Model_User extends Model {

  public function is_admin($id) {
    return Model::issetRecord("SELECT count(*) FROM `users` WHERE `id` = $id AND `admin` = 1 LIMIT 1");
  }

}
