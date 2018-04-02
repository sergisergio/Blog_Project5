<?php

/* Je crée un emplacement pour éviter les conflits avec d'autres développeurs */
namespace Philippe\Blog\Model;

/* Je fais appel à la classe parent */
require_once("model/Manager.php");

/* Je crée une classe Commentmanager qui hérite de la classe Manager */
class CommentManager extends Manager
{
	
									/* **********************************************************************
                                    *                  RECUPERER TOUS LES COMMENTAIRES                      *
                                    ************************************************************************/

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

									/* **********************************************************************
                                    *                  RECUPERER UN SEUL COMMENTAIRE                        *
                                    ************************************************************************/

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

									/* **********************************************************************
                                    *                      AJOUTER UN  COMMENTAIRE                          *
                                    ************************************************************************/

	public function postComment($postId, $memberPseudo, $content){

		/* A revoir */
		$db = $this->dbConnect();
		/* Fonction prepare à revoir */
		$comments = $db->prepare('INSERT INTO Comment(post_id, member_pseudo, content, creation_date) VALUES(?, ?, ?, NOW())');
		/* Fonction execute à revoir */
		$affectedLines = $comments->execute(array($postId, $memberPseudo, $content));

        return $affectedLines;
	}

									/* **********************************************************************
                                    *                      SUPPRIMER UN  COMMENTAIRE                        *
                                    ************************************************************************/
	public function deleteComment($commentId){

		/* A revoir */
		$db = $this->dbConnect();

		$comments = $db->prepare('DELETE FROM Comment WHERE id = ?');

		$affectedComment = $comments->execute(array($commentId));

		return $affectedComment;
	}
									/* **********************************************************************
                                    *                      MODIFIER UN  COMMENTAIRE                         *
                                    ************************************************************************/
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