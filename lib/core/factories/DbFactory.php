<?php 
namespace Philippe\Blog\Lib\Core\Factories;
use Philippe\Blog\Lib\Core\Database\DbConfig;
use \PDO;
class DbFactory {
	private $config;
  public function __construct() {
  	$this->config = new DbConfig;
  }
  	
  public function getPdo() {
      $db =  new PDO('mysql:host='.$this->config->getConfig()['host'].';dbname='.$this->config->getConfig()['dbname'], 
      $this->config->getConfig()['user'], $this->config->getConfig()['pass']);
      $db->exec("SET CHARACTER SET utf8");
      return $db;
  }
}