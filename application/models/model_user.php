<?php
namespace application\models;

use application\core\Model;

class Model_User extends Model {

  public function is_admin($id) {
    return Model::issetRecord("SELECT count(*) FROM `users` WHERE `id` = $id AND `admin` = 1 LIMIT 1");
  }

  public function get_all_users() {
    return Model::getRecords("SELECT * FROM `users`");
  }

  public function update($table, $data = array(), $id) {
    return Model::update($table, $data, $id);
  }

  public function delete_user($id) {
    return Model::delete("DELETE FROM `users` WHERE `id` = $id");
  }

}
