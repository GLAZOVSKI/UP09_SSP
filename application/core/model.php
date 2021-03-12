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
}
