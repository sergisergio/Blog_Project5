<?php

/* ************************* RESUME *************************************

1 . Récupérer tous les articles
2 . Récupérer un seul article
3 . Ajouter un article
4 . Modifier un article
5 . Effacer un article
************************************************************************/
/* Je crée un emplacement pour éviter les conflits avec d'autres développeurs */
namespace Philippe\Blog\Model;

/* Je fais appel à la classe parent */
require_once("model/Manager.php");

/* Je crée une classe Postmanager qui hérite de la classe Manager */
class PostManager extends Manager
{
/* **********************************************************************
*                    1 . RECUPERER TOUS LES ARTICLES                    *
************************************************************************/
	public function getPosts()
	{
		/* A revoir */
		$db = $this->dbConnect();

		/* Fonction query à revoir */
		$req = $db->query('SELECT id, title, intro, content, author, file_extension, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr, DATE_FORMAT(last_updated, \'%d/%m/%Y à %Hh%imin%ss\') AS last_updated_fr 
			FROM Posts
			ORDER BY creation_date DESC LIMIT 5');
		return $req;
	}
/* **********************************************************************
*                    2 . RECUPERER UN SEUL ARTICLE                      *
************************************************************************/
	public function getPost($postId){

		/* A revoir */
		$db = $this->dbConnect();

		/* Fonction prepare à revoir */
		$req = $db->prepare('SELECT id, title, intro, content, author, file_extension, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr, DATE_FORMAT(last_updated, \'%d/%m/%Y à %Hh%imin%ss\') AS last_updated_fr 
			FROM Posts 
			WHERE id = ?
			');

		/* Fonction execute à revoir */
		$req->execute(array($postId));
		/* Fonction fetch à revoir */
		$post = $req->fetch();
		return $post;
	}
/* **********************************************************************
*                     3 . AJOUTER UN ARTICLE                      		*
************************************************************************/
	public function addPostRequest($title, $intro, $author, $content){

		/* A revoir */
		$db = $this->dbConnect();

		/* Fonction prepare à revoir */
		$post = $db->prepare('INSERT INTO Posts(title, intro, author, content, creation_date) VALUES(?, ?, ?, ?, NOW()) ');

		$affectedPost = $post->execute(array($title, $intro, $author, $content));
		
		return $affectedPost;
	}
/* **********************************************************************
*                     4 . MODIFIER UN ARTICLE                      		*
************************************************************************/
	public function modifyPostRequest($postId, $title, $intro, $author, $content){

		/* A revoir */
		$db = $this->dbConnect();

		/* Fonction prepare à revoir */
		$post = $db->prepare('UPDATE Posts SET title = ?, intro = ?, author = ?, content = ?, creation_date = NOW() WHERE id = ?');

		$affectedPost = $post->execute(array($title, $intro, $author, $content, $postId));
		
		return $affectedPost;
	}

/* **********************************************************************
*                      5 . EFFACER UN ARTICLE                      		*
************************************************************************/
	public function deletePostRequest($postId){

		/* A revoir */
		$db = $this->dbConnect();

		/* Fonction prepare à revoir */
		$post = $db->prepare('DELETE FROM Posts WHERE id = ?');

		$affectedPost = $post->execute(array($postId));
		
		return $affectedPost;
	}
}