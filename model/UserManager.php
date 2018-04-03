<?php

/* Je crée un emplacement pour éviter les conflits avec d'autres développeurs */
namespace Philippe\Blog\Model;

/* Je fais appel à la classe parent */
require_once("model/Manager.php");

/* Je crée une classe Postmanager qui hérite de la classe Manager */
class UserManager extends Manager
{
	
									/* **********************************************************************
                                    *                      RECUPERER TOUS LES MEMBRES                       *
                                    ************************************************************************/
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

									/* **********************************************************************
                                    *                      RECUPERER UN SEUL MEMBRE                         *
                                    ************************************************************************/
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

									/* **********************************************************************
                                    *                           MODIFIER UN MEMBRE                         	*
                                    ************************************************************************/
	public function modifyuser(){

		/* A revoir */
		$db = $this->dbConnect();

		/* Fonction prepare à revoir */
		$post = $db->prepare('UPDATE Post SET title = ?, intro = ?, member_pseudo = ?, content = ?, creation_date = NOW() WHERE id = ?');

		$affectedPost = $post->execute(array($title, $intro, $memberPseudo, $content, $postId));
		
		return $affectedPost;

	
	}
	
									/* **********************************************************************
                                    *                           SUPPRIMER UN MEMBRE                         *
                                    ************************************************************************/
	public function deleteUser($postId){

		

	}
}