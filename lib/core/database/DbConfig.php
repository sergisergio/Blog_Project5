<?php
namespace Philippe\BlogLib\Core\Database;
class DbConfig {
	
	private $dbConfig;
	public function __construct() {
		$this->loadConfigFile();
	}
	private function loadConfigFile() {
		$this->dbConfig = require __DIR__ . '../../../../config/DbLogin.php';
			
	}
	public function getConfig() {
		return $this->dbConfig;
	}
}