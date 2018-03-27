<?php

namespace Philippe\Blog\Model;

class Manager
{
	protected function dbConnect()
	{
		$db = new \PDO('mysql:host=localhost;dbname=Project5;charset=utf8', 'root', 'root');
		return $db;
	}
}