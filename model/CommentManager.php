<?php

/* Je crée un emplacement pour éviter les conflits avec d'autres développeurs */
namespace Philippe\Blog\Model;

/* Je fais appel à la classe parent */
require_once("model/Manager.php");

/* Je crée une classe Commentmanager qui hérite de la classe Manager */
class CommentManager extends Manager
{
	/* Je crée une fonction qui va récupérer tous les commentaires */
	public function getComments($postId)
	{
		/* A revoir */
		$db = $this->dbConnect();
		$comments = $db->prepare('SELECT id, member_pseudo, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr 
			FROM Comment 
			WHERE post_id = ?
			ORDER BY creation_date DESC LIMIT 0, 5');
		$comments->execute(array($postId));
		
		return $comments;
	}

	/* Je crée une fonction qui va récupérer un commentaire en fonction de son identifiant */
	public function getComment($commentId){

		/* A revoir */
		$db = $this->dbConnect();
		/* Fonction prepare à revoir */
		 $req = $db->prepare('SELECT id, post_id, member_pseudo, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM Comment WHERE id = ?');

		 /* Fonction execute à revoir */
        $req->execute(array($commentId));

        /* Fonction fetch à revoir */
        $comment = $req->fetch();

        return $comment;
		
	}

	/* Je crée une fonction qui va envoyer un commentaire dans la base de données */
	public function postComment($postId, $memberPseudo, $content){

		/* A revoir */
		$db = $this->dbConnect();
		/* Fonction prepare à revoir */
		$comments = $db->prepare('INSERT INTO Comment(post_id, member_pseudo, content, creation_date) VALUES(?, ?, ?, NOW())');
		/* Fonction execute à revoir */
		$affectedLines = $comments->execute(array($postId, $memberPseudo, $content));

        return $affectedLines;
	}

	public function deleteComment(){

		/* A revoir */
		$db = $this->dbConnect();
	}
	public function modifyComment($commentId, $memberPseudo, $content)
    {

    	/* A revoir */
        $db = $this->dbConnect();
        /* Fonction prepare à revoir */
        $comments = $db->prepare('UPDATE Comment SET member_pseudo = ?, content = ?, creation_date = NOW() WHERE  id = ?');
        /* Fonction execute à revoir */
        $affectedLines = $comments->execute(array($memberPseudo, $content, $commentId));

        return $affectedLines;
    }
}