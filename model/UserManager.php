<?php

/* Je crée un emplacement pour éviter les conflits avec d'autres développeurs */
namespace Philippe\Blog\Model;

/* Je fais appel à la classe parent */
require_once("model/Manager.php");

/* Je crée une classe Postmanager qui hérite de la classe Manager */
class UserManager extends Manager
{
	/* Je crée une fonction qui va récupérer tous les articles */
	public function getUsers()
	{
		/* A revoir */
		$db = $this->dbConnect();

		/* Fonction query à revoir */
		$req = $db->query('SELECT * 
			FROM Member 
			ORDER BY pseudo ASC LIMIT 0, 15');
		return $req;
	}

	/* Je crée une fonction qui va récupérer un seul article en fonction de son identifiant */
	public function getUser($postId){

		/* A revoir */
		$db = $this->dbConnect();

		/* Fonction prepare à revoir */
		$req = $db->prepare('SELECT id, title, intro, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr, DATE_FORMAT(last_updated, \'%d/%m/%Y à %Hh%imin%ss\') AS last_updated_fr 
			FROM Post 
			WHERE id = ?
			');

		/* Fonction execute à revoir */
		$req->execute(array($postId));
		/* Fonction fetch à revoir */
		$post = $req->fetch();
		return $post;
	}

	
	/* Je crée une fonction qui me permettre de modifier un article */
	public function modifyuser(){

	
	}
	/* Je crée une fonction qui me permettre de modifier un article */
	public function deleteUser($postId){

		

	}

	

}