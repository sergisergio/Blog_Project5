<?php

/* ************************* RESUME *************************************

1 . Récupérer tous les commentaires
2 . Récupérer un seul commentaire
3 . Ajouter un commentaire
4 . Supprimer un commentaire
5 . Modifier un commentaire
6 . Valider un commentaire
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
		$comments = $db->prepare('SELECT c.id, u.pseudo AS author, c.content, DATE_FORMAT(c.creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr, DATE_FORMAT(c.last_updated, \'%d/%m/%Y à %Hh%imin%ss\') AS last_updated_fr 
			FROM Comments c
            INNER JOIN Users u ON u.id = c.author
			WHERE c.post_id = ?
			AND c.validation = 1
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
		 $req = $db->prepare('SELECT c.id, c.post_id, u.pseudo AS author, c.content, DATE_FORMAT(c.creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr, DATE_FORMAT(c.last_updated, \'%d/%m/%Y à %Hh%imin%ss\') AS last_updated_fr 
		 	FROM Comments c
            INNER JOIN Users u ON u.id = c.author
		 	WHERE c.id = ?');

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
		$comments = $db->prepare('INSERT INTO Comments (post_id, author, content, validation, creation_date) VALUES(?, ?, ?, 0, NOW())');
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
	public function modifyCommentRequest($commentId, $author, $content)
    {

    	/* A revoir */
        $db = $this->dbConnect();
        /* Fonction prepare à revoir */
        $comments = $db->prepare('UPDATE Comments SET author = ?, content = ?, validation = 0, last_updated = NOW() WHERE  id = ?');
        /* Fonction execute à revoir */
        $affectedLines = $comments->execute(array($author, $content, $commentId));

        return $affectedLines;
    }
/* **********************************************************************
*             6 . AFFICHER LES COMMENTAIRES NON VALIDES                 *
************************************************************************/
	public function submittedCommentRequest()
    {
		$db = $this->dbConnect();
		$submittedcomments = $db->prepare('SELECT c.id, u.pseudo AS author, p.title AS post_id, c.content, DATE_FORMAT(c.creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr, DATE_FORMAT(c.last_updated, \'%d/%m/%Y à %Hh%imin%ss\') AS last_updated_fr, c.validation
			FROM Comments c
            INNER JOIN Users u ON u.id = c.author
            INNER JOIN Posts p ON p.id = c.post_id
			WHERE c.validation = 0
			ORDER BY c.creation_date');
		$submittedcomments->execute(array());
		
		return $submittedcomments;
    }

/* **********************************************************************
*                  5 . VALIDER UN  COMMENTAIRE                          *
************************************************************************/
	public function validateCommentRequest($commentId)
    {

    	/* A revoir */
        $db = $this->dbConnect();
        /* Fonction prepare à revoir */
        $validatecomment = $db->prepare('UPDATE Comments SET validation = 1 WHERE  id = ?');
        /* Fonction execute à revoir */
        $validated = $validatecomment->execute(array($commentId));

        return $validated;
    }
/* **********************************************************************
*                  5 . COMPTER NOMBRE DE COMMENTAIRES                   *
************************************************************************/
	public function countCommentRequest()
    {

    	/* A revoir */
        $db = $this->dbConnect();
        /* Fonction prepare à revoir */
        $countcomment = $db->prepare('SELECT COUNT(*) FROM Comments c INNER JOIN Posts p ON c.post_id = p.id GROUP BY p.id');
        /* Fonction execute à revoir */
        $count = $countcomment->execute(array());

        return $count;
    }

}