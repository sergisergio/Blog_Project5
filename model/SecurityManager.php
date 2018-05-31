<?php

namespace Philippe\Blog\Model;
require_once "model/Manager.php";
class SecurityManager extends Manager
{
    public function checkBruteForce($ip)
    {
        $dbProjet5 = $this->dbConnect();
		$search = $dbProjet5->prepare(" SELECT * FROM connexion WHERE ip = :ip ");
		$search->bindParam(':id', $ip);
		$count = $search->execute();
		$count = $search->rowCount();
		return $count;
	}

	public function registerAttempt($ip) {
		$dbProjet5 = $this->dbConnect();
		$req = $dbProjet5->prepare('INSERT INTO connexion(ip) VALUES(:ip)');
		$req->bindParam(':id', $ip);
		$req->execute();
	}

	public function checkCSRF() {
		if (!isset($_SESSION['csrf_token'])) {
			$_SESSION['csrf_token'] = md5(time()*rand(1, 1000));
		}
	}
}