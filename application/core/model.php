<?php
namespace application\core;
spl_autoload_register();

use application\core\DB;
use PDO;

class Model {
	use DB;

	private $dph;

	public function __construct() {
		try {
				$this->dbh = new PDO("mysql:dbname={$this->dbName}; host={$this->host}; port={$this->port}", $this->user, $this->password);
		}catch (PDOException $e) {
				echo "<pre>".$e."</pre>";
		}
	}

	public function getRecords($query) {
		return $this->dbh->query($query)->fetchAll();
	}

	public function issetRecord($query):bool {
		return $this->dbh->query($query)->fetchColumn();
	}

	public function delete($query):bool {
		return $this->dbh->query($query)->fetchColumn();
	}

	public function update($table, $data = array(), $id) {
		if (is_array($data)) {
			$columns = "";

			foreach ($data as $key => $value) {
				$columns .= "`$key` = :$key, ";
			}

			$columns = substr($columns, 0, -2); // Удалить последнюю запятую

			$sql = $this->dbh->prepare("UPDATE `{$table}` SET {$columns} WHERE `id` = :id");
			$sql->bindValue(":id", $id);

			foreach ($data as $key => $value) {
				$value = htmlspecialchars($value);
				$sql->bindValue(":$key", $value);
			}

			$sql->execute();
		}

		return true;
	}

	public function create($table, $data = array()){
		if (is_array($data)) {
			$keys = array_keys($data);
			$columns = implode(",", $keys);
			$colVals = implode(",:", $keys);

			$sql = $this->dbh->prepare("INSERT INTO `{$table}` ($columns) VALUES(:$colVals)");

			foreach ($data as $key => $value) {
				$value = htmlspecialchars($value);
				$sql->bindValue(":$key", $value);
			}

			$sql->execute();
		}

		return true;
	}
}
