<?php

/* ************************* RESUME *************************************

1 . Récupérer tous les commentaires
2 . Récupérer un seul commentaire
3 . Ajouter un commentaire
4 . Supprimer un commentaire
5 . Modifier un commentaire
************************************************************************/

/* Je crée un emplacement pour éviter les conflits avec d'autres développeurs */
namespace Philippe\Blog\Model;

/* Je fais appel à la classe parent */
require_once("model/Manager.php");

/* Je crée une classe Commentmanager qui hérite de la classe Manager */
class CommentManager extends Manager
{
/* **********************************************************************
*              1 . RECUPERER TOUS LES COMMENTAIRES                      *
************************************************************************/
	public function getComments($postId)
	{
		/* A revoir */
		$db = $this->dbConnect();
		$comments = $db->prepare('SELECT id, author, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr, DATE_FORMAT(last_updated, \'%d/%m/%Y à %Hh%imin%ss\') AS last_updated_fr 
			FROM Comments 
			WHERE post_id = ?
			ORDER BY creation_date 
				DESC LIMIT 0, 5');
		$comments->execute(array($postId));
		
		return $comments;
	}
/* **********************************************************************
*              2 . RECUPERER UN SEUL COMMENTAIRE                        *
************************************************************************/
	public function getComment($commentId){

		/* A revoir */
		$db = $this->dbConnect();
		/* Fonction prepare à revoir */
		 $req = $db->prepare('SELECT id, post_id, author, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr, DATE_FORMAT(last_updated, \'%d/%m/%Y à %Hh%imin%ss\') AS last_updated_fr 
		 	FROM Comments 
		 	WHERE id = ?');

		 /* Fonction execute à revoir */
        $req->execute(array($commentId));

        /* Fonction fetch à revoir */
        $comment = $req->fetch();

        return $comment;
		}
/* **********************************************************************
*                  3 . AJOUTER UN  COMMENTAIRE                          *
************************************************************************/
	public function postComment($postId, $author, $content){

		/* A revoir */
		$db = $this->dbConnect();
		/* Fonction prepare à revoir */
		$comments = $db->prepare('INSERT INTO Comments(post_id, author, content, creation_date) VALUES(?, ?, ?, NOW())');
		/* Fonction execute à revoir */
		$affectedLines = $comments->execute(array($postId, $author, $content));

        return $affectedLines;
	}
/* **********************************************************************
*                     4 . SUPPRIMER UN  COMMENTAIRE                     *   
************************************************************************/
	public function deleteCommentRequest($commentId){

		/* A revoir */
		$db = $this->dbConnect();

		$comments = $db->prepare('DELETE FROM Comments WHERE id = ?');

		$affectedComment = $comments->execute(array($commentId));

		return $affectedComment;
	}
/* **********************************************************************
*                  5 . MODIFIER UN  COMMENTAIRE                         *
************************************************************************/
	public function modifyComment($commentId, $author, $content)
    {

    	/* A revoir */
        $db = $this->dbConnect();
        /* Fonction prepare à revoir */
        $comments = $db->prepare('UPDATE Comments SET author = ?, content = ?, last_updated = NOW() WHERE  id = ?');
        /* Fonction execute à revoir */
        $affectedLines = $comments->execute(array($author, $content, $commentId));

        return $affectedLines;
    }
}