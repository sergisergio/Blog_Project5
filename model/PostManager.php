<?php

/* Je crée un emplacement pour éviter les conflits avec d'autres développeurs */
namespace Philippe\Blog\Model;

/* Je fais appel à la classe parent */
require_once("model/Manager.php");

/* Je crée une classe Postmanager qui hérite de la classe Manager */
class PostManager extends Manager
{
									/* **********************************************************************
                                    *                        RECUPERER TOUS LES ARTICLES                    *
                                    ************************************************************************/
	public function getPosts()
	{
		/* A revoir */
		$db = $this->dbConnect();

		/* Fonction query à revoir */
		$req = $db->query('SELECT id, title, intro, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr, DATE_FORMAT(last_updated, \'%d/%m/%Y à %Hh%imin%ss\') AS last_updated_fr 
			FROM Post 
			ORDER BY creation_date DESC LIMIT 0, 5');
		return $req;
	}

									/* **********************************************************************
                                    *                        RECUPERER UN SEUL ARTICLE                      *
                                    ************************************************************************/
	public function getPost($postId){

		/* A revoir */
		$db = $this->dbConnect();

		/* Fonction prepare à revoir */
		$req = $db->prepare('SELECT id, title, intro, content, member_pseudo, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr, DATE_FORMAT(last_updated, \'%d/%m/%Y à %Hh%imin%ss\') AS last_updated_fr 
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
                                    *                        AJOUTER UN ARTICLE                      		*
                                    ************************************************************************/
	public function addPost($title, $intro, $memberPseudo, $content){

		/* A revoir */
		$db = $this->dbConnect();

		/* Fonction prepare à revoir */
		$post = $db->prepare('INSERT INTO Post(title, intro, member_pseudo, content, creation_date) VALUES(?, ?, ?, ?, NOW()) ');

		$affectedPost = $post->execute(array($title, $intro, $memberPseudo, $content));
		
		return $affectedPost;
	}
	
									/* **********************************************************************
                                    *                        MODIFIER UN ARTICLE                      		*
                                    ************************************************************************/
	public function modifyPost($postId, $title, $intro, $memberPseudo, $content){

		/* A revoir */
		$db = $this->dbConnect();

		/* Fonction prepare à revoir */
		$post = $db->prepare('UPDATE Post SET title = ?, intro = ?, member_pseudo = ?, content = ?, creation_date = NOW() WHERE id = ?');

		$affectedPost = $post->execute(array($title, $intro, $memberPseudo, $content, $postId));
		
		return $affectedPost;
	}

									/* **********************************************************************
                                    *                        EFFACER UN ARTICLE                      		*
                                    ************************************************************************/
	public function deletePost($postId){

		/* A revoir */
		$db = $this->dbConnect();

		/* Fonction prepare à revoir */
		$post = $db->prepare('DELETE FROM Post WHERE id = ?');

		$affectedPost = $post->execute(array($postId));
		
		return $affectedPost;
	}
}