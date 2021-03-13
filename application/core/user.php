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
  private $cookie = null; // Куки с id user
  private $session  = null; // Сессия с id user
  private $loggedIn = false; // Вошел в систему

  private $staticPages = array( // Страницы на которые запрещено авторизированым юзерам
    '/register',
    '/login'
  );

  public function __construct() {
    session_start();

    try {
      $this->dbh = new PDO("mysql:dbname={$this->dbName}; host={$this->host}; port={$this->port}", $this->user, $this->password);
      $this->cookie = isset($_COOKIE['sysLogin']) ? $_COOKIE['sysLogin'] : false;
      $this->session = isset($_SESSION['userID']) ? $_SESSION['userID'] : false;

      $hashUserID = hash('sha256', "{$this->secretKey}{$this->session}{$this->secretKey}");

      $this->loggedIn = $this->cookie == $hashUserID ? true : false;

    }catch (PDOException $e) {
      echo "<pre>".$e."</pre>";
    }
  }

  public function init() { // Если пользователь залогинен и находиться на одной из указанных страниц
    return $this->loggedIn && in_array($_SERVER['REQUEST_URI'], $this->staticPages);
  }

  public function is_auth() { // Проверка авторизации
    return $this->loggedIn;
  }

  public function getID():int {
    return $this->session;
  }

  public function registration($email, $password, $other = []) {
      if($this->userExist($email)) {
        $passwordSalt = Functions::randString(20);
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

  public function auth($email, $password) {
    if (!$this->userExist($email)) {
      $userData = $this->dbh->prepare("SELECT `id`, `password`, `passwordSalt` FROM `users` WHERE email = :email");
      $userData->bindValue(":email", $email);
      $userData->execute();

      $row = $userData->fetch(PDO::FETCH_ASSOC);

      $userID  = $row['id'];
      $userPass = $row['password'];
      $passwordSalt = $row['passwordSalt'];

      $saltedPass = hash('sha256', "{$password}{$this->secretKey}{$passwordSalt}");

      if ($userPass == $saltedPass) {
        $_SESSION['userID'] = $userID;
        setcookie("sysLogin", hash("sha256", $this->secretKey.$userID.$this->secretKey), time()+3600*99*500, "/");

        return true;
      }else {
        return false;
      }
    }
  }

  public function logout(){
    $this->cookie = null;
    $this->session = null;
    $this->loggedIn = false;

    setcookie("sysLogin", "", time()-3600*99*600, "/");
    unset($_SESSION['userID']);

    return true;
  }

}
