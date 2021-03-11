<?php
namespace application\core;

use application\core\DB;
use Exception;
use PDO;
use PDOException;
use application\core\functions;

class User {
  use DB;

  private $dbh;
  private $tableName = 'users';
  private $secretKey = 'ZRMm8NeiZRV3b6EssE4G';

  public function __construct() {
    try {
      $this->dbh = new PDO("mysql:dbname={$this->dbName}; host={$this->host}; port={$this->port}", $this->user, $this->password);
    }catch (PDOException $e) {
      echo "<pre>".$e."</pre>";
    }
  }

  public function registration($email, $password, $other = []) {
      if($this->userExist($email)) {
        $passwordSalt = Functions::randString(64);
        $passwordHash = hash('sha256', "{$password}{$this->secretKey}{$passwordSalt}");

        if(count($other) == 0) {
          $newUser = $this->dbh->prepare("INSERT INTO `{$this->tableName}`
              (`email`, `password`, `passwordSalt`) VALUES(:email, :password, :passwordSalt)");
        }else {
          $keys = array_keys($other);
          $columns = implode(',',$keys);
          $colVals = implode(',:', $keys);

          $newUser = $this->dbh->prepare("INSERT INTO `{$this->tableName}`
            (`email`, `password`, `passwordSalt`, $columns) VALUES(:email, :password, :passwordSalt, :$colVals)");

          foreach ($other as $key => $value) {
            $value = htmlspecialchars($value);
            $newUser->bindValue(":$key",  $value);
          }
        }

        $newUser->bindValue(':email', $email);
        $newUser->bindValue(':password', $passwordHash);
        $newUser->bindValue(':passwordSalt', $passwordSalt);
        $newUser->execute();

        return true;
      }else {
        throw new Exception('Пользователь c такиим Email зарегестрирован.');
      }
  }

  public function userExist($email) {
      $res = $this->dbh->prepare("SELECT * FROM `{$this->tableName}` WHERE `email` = :email LIMIT 1");
      $res->bindValue(':email', $email);
      $res->execute();

      return $res->rowCount() == 0 ? true : false;
  }
}
