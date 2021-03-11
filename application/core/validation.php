<?php
namespace application\core;

use Exception;

class Validation {

    public function validateEmail($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) return true;
        throw new Exception('Некорректный Email.');
    }

    public function isCyrillic($str) {
        if  (!preg_match("/[^а-я]+/miu", $str)) return true;
        return false;
    }

    public function isLength($str, $min = 2, $max = 20) {
        $len = mb_strlen($str);
        if ($len >= $min && $len <= $max) return true;
        return false;
    }

    public function isPasswordEqual($pass1, $pass2) {
        if ($pass1 == $pass2) return true;
        throw new Exception('Пароли не совпадают.');
    }

}
