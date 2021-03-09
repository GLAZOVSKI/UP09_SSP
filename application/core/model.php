<?php
class Model {
	private $host = 'localhost';
	private $port = '';
	private $user = 'root';
	private $password = 'root';
	private $dbName = 'SSP';

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
}
