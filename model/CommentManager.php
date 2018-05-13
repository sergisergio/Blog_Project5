<?php

/* ************************* RESUME *************************************

1 . RECUPERER TOUS LES COMMENTAIRES.
2 . RECUPERER UN SEUL COMMENTAIRE.
3 . AJOUTER UN COMMENTAIRE.
4 . SUPPRIMER UN COMMENTAIRE.
5 . MODIFIER UN COMMENTAIRE.
6 . AFFICHER LES COMMENTAIRES A VALIDER.
7 . VALIDER UN  COMMENTAIRE.
8 . COMPTER NOMBRE DE COMMENTAIRES.

************************* FIN RESUME ***********************************/

namespace Philippe\Blog\Model;
require_once("model/Manager.php");

class CommentManager extends Manager
{
/* *********** 1 . RECUPERER TOUS LES COMMENTAIRES *********************/
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

/* *********** 2 . RECUPERER UN SEUL COMMENTAIRE ***********************/
	public function getComment($commentId){

		$db = $this->dbConnect();
		
		 $req = $db->prepare('SELECT c.id, c.post_id, u.pseudo AS author, c.content, DATE_FORMAT(c.creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr, DATE_FORMAT(c.last_updated, \'%d/%m/%Y à %Hh%imin%ss\') AS last_updated_fr 
		 	FROM Comments c
            INNER JOIN Users u ON u.id = c.author
		 	WHERE c.id = ?');

        $req->execute(array($commentId));
		$comment = $req->fetch();

        return $comment;
		}

/* *********** 3 . AJOUTER UN COMMENTAIRE ******************************/
	public function postComment($postId, $author, $content){

		$db = $this->dbConnect();
		
		$comments = $db->prepare('INSERT INTO Comments (post_id, author, content, validation, creation_date) VALUES(?, ?, ?, 0, NOW())');
		
		$affectedLines = $comments->execute(array($postId, $author, $content));

        return $affectedLines;
	}

/* *********** 4 . SUPPRIMER UN COMMENTAIRE ****************************/
	public function deleteCommentRequest($commentId){

		$db = $this->dbConnect();

		$comments = $db->prepare('DELETE FROM Comments WHERE id = ?');

		$affectedComment = $comments->execute(array($commentId));

		return $affectedComment;
	}

/* *********** 5 . MODIFIER UN COMMENTAIRE *****************************/
	public function modifyCommentRequest($commentId, $author, $content)
    {

        $db = $this->dbConnect();
        
        $comments = $db->prepare('UPDATE Comments SET author = ?, content = ?, validation = 0, last_updated = NOW() WHERE  id = ?');
        
        $affectedLines = $comments->execute(array($author, $content, $commentId));

        return $affectedLines;
    }

/* *********** 6 . AFFICHER LES COMMENTAIRES NON VALIDES ***************/
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

/* *********** 7 . VALIDER UN  COMMENTAIRE *****************************/
	public function validateCommentRequest($commentId)
    {
		$db = $this->dbConnect();
        
        $validatecomment = $db->prepare('UPDATE Comments SET validation = 1 WHERE  id = ?');
        
        $validated = $validatecomment->execute(array($commentId));

        return $validated;
    }

/* *********** 8 . COMPTER NOMBRE DE COMMENTAIRES **********************/
	public function countCommentRequest($postId)
    {

        $db = $this->dbConnect();
        
        $count = $db->query("SELECT id FROM Comments WHERE post_id = '$postId' AND validation = 1 ");
    	$nbCount = $count->rowCount();
        return $nbCount;
    }

/* *********** 9 . COMPTER NOMBRE DE COMMENTAIRES NON VALIDES *********/
	public function countCommentBackRequest()
    {

        $db = $this->dbConnect();
        
        $count = $db->query("SELECT id FROM Comments WHERE validation = 0 ");
    	$nbCount = $count->rowCount();
        return $nbCount;
    }

/* *********** 10 . GET USER PAR COMMENTAIRE *********************/
	public function getUserByCommentRequest($commentId)
    {
		$db = $this->dbConnect();
        
        $userRequest = $db->prepare("SELECT u.pseudo, u.description, u.first_name, u.last_name, u.email, u.avatar, u.registration_date, u.authorization FROM Users u INNER JOIN Comments c ON c.author = u.id ");
    	$userRequest->execute(array($commentId));
    	$user = $userRequest->fetch();
        return $user;
    }
}