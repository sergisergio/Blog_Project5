<?php

namespace Philippe\Blog\Model;
require_once "model/Manager.php";
class SecurityManager extends Manager
{
    public function checkBruteForce($ip)
    {
        $dbProjet5 = $this->dbConnect();
		$search = $dbProjet5->prepare(" SELECT * FROM connexion WHERE ip = ? ");
		$count = $search->execute(array($ip));
		$count = $search->rowCount();
		return $count;
	}

	public function registerAttempt($ip) {
		$dbProjet5 = $this->dbConnect();

		$req = $dbProjet5->prepare('INSERT INTO connexion(ip) VALUES(?)');
		$req->execute(array($ip));
	}
}