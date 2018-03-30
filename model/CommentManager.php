<?php

namespace Philippe\Blog\Model;

require_once("model/Manager.php");

class CommentManager extends Manager
{
	public function getComments($postId)
	{
		$db = $this->dbConnect();
		$comments = $db->prepare('SELECT id, member_pseudo, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr 
			FROM Comment 
			WHERE post_id = ?
			ORDER BY creation_date DESC LIMIT 0, 5');
		$comments->execute(array($postId));
		return $comments;
	}

	public function getComment($commentId){
		$db = $this->dbConnect();
		 $req = $db->prepare('SELECT id, post_id, member_pseudo, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM Comment WHERE id = ?');
        $req->execute(array($commentId));
        $comment = $req->fetch();

        return $comment;
		
	}

	public function postComment($postId, $memberPseudo, $content){
		$db = $this->dbConnect();
		$comments = $db->prepare('INSERT INTO Comment(post_id, member_pseudo, content, creation_date) VALUES(?, ?, ?, NOW())');
		$affectedLines = $comments->execute(array($postId, $memberPseudo, $content));

        return $affectedLines;
	}

	public function deleteComment(){
		$db = $this->dbConnect();
	}
	public function modifyComment($commentId, $memberPseudo, $content)
    {
        $db = $this->dbConnect();
        $comments = $db->prepare('UPDATE Comment SET member_pseudo = ?, content = ?, creation_date = NOW() WHERE  id = ?');
        $affectedLines = $comments->execute(array($memberPseudo, $content, $commentId));

        return $affectedLines;
    }
}