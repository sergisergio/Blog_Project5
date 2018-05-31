<?php
/* ************************* SUM UP *************************************
1 . GET ALL COMMENTS.
2 . GET ONLY ONE COMMENT.
3 . ADD A COMMENT.
4 . DELETE A COMMENT.
5 . MODIFY A COMMENT.
6 . VIEW COMS NOT YET VALIDATED.
7 . VALIDATE A COMMENT.
8 . COUNT VALIDATED COMMENTS.
9 . COUNT NOT YET VALIDATED COMMENTS.
10. GET USER BY COMMENT.
************************* END SUM UP ***********************************/
namespace Philippe\Blog\Model;
require_once "model/Manager.php";
use \Philippe\Blog\Model\Entities\CommentEntity;
use \Philippe\Blog\Model\Entities\UserEntity;
class CommentManager extends Manager
{
/* *********** 1 . GET ALL COMMENTS *********************/
    public function getComments($postId)
    {
        $dbProjet5 = $this->dbConnect();
        $comments = $dbProjet5->prepare(
            'SELECT c.id, c.post_id, u.pseudo AS author, c.content, c.validation, DATE_FORMAT(c.creation_date, \'%d/%m/%Y à %Hh%i\') AS creation_date_fr, DATE_FORMAT(c.last_updated, \'%d/%m/%Y à %Hh%i\') AS last_updated_fr 
			FROM Comments c
            INNER JOIN Users u ON u.id = c.author
			WHERE c.post_id = :id
			AND c.validation = 1
			ORDER BY creation_date'
        );
        $comments->bindParam(':id', $postId);
        $comments->execute();
        $comment = [];
        while ($data = $comments->fetch()) {
           $comment[] = new CommentEntity($data);
        }
        $comments->closeCursor();
        return $comment;
    }
/* *********** 2 . GET ONLY ONE COMMENT *****************/
    public function getComment($commentId)
    {
        $dbProjet5 = $this->dbConnect();
        $req = $dbProjet5->prepare(
            'SELECT c.id, c.post_id, u.pseudo AS author, c.content, c.validation, DATE_FORMAT(c.creation_date, \'%d/%m/%Y à %Hh%i\') AS creation_date_fr, DATE_FORMAT(c.last_updated, \'%d/%m/%Y à %Hh%i\') AS last_updated_fr 
		 	FROM Comments c
            INNER JOIN Users u ON u.id = c.author
		 	WHERE c.id = :id'
        );
        $req->bindParam(':id', $commentId);
        $req->execute();
        $data = $req->fetch();
        $comment = new CommentEntity($data);
        return $comment;
    }
/* *********** 3 . ADD A COMMENT ************************/
    public function postComment($postId, $author, $content)
    {
        $dbProjet5 = $this->dbConnect();
        $comments = $dbProjet5->prepare('INSERT INTO Comments (post_id, author, content, validation, creation_date) VALUES(:id, :author, :content, 0, NOW())');
        $comments->bindParam(':id', $postId);
        $comments->bindParam(':author', $author);
        $comments->bindParam(':content', $content);
        $affectedLines = $comments->execute();
        return $affectedLines;
    }
/* *********** 4 . DELETE A COMMENT *********************/
    public function deleteCommentRequest($commentId)
    {
        $dbProjet5 = $this->dbConnect();
        $comments = $dbProjet5->prepare('DELETE FROM Comments WHERE id = :id');
        $comments->bindParam(':id', $commentId);
        $affectedComment = $comments->execute();
        return $affectedComment;
    }
/* *********** 5 . MODIFY A COMMENT *********************/
    public function modifyCommentRequest($commentId, $author, $content)
    {
        $dbProjet5 = $this->dbConnect();
        $comments = $dbProjet5->prepare('UPDATE Comments SET author = :author, content = :content, validation = 0, last_updated = NOW() WHERE  id = :id');
        $comments->bindParam(':author', $author);
        $comments->bindParam(':content', $content);
        $comments->bindParam(':id', $commentId);
        $affectedLines = $comments->execute();
        return $affectedLines;
    }
/* *********** 6 . VIEW COMS NOT YET VALIDATED **********/
    public function submittedCommentRequest()
    {
        $dbProjet5 = $this->dbConnect();
        $submittedcomments = $dbProjet5->prepare(
            'SELECT c.id, u.pseudo AS author, p.title AS post_id, c.content, DATE_FORMAT(c.creation_date, \'%d/%m/%Y à %Hh%i\') AS creation_date_fr, DATE_FORMAT(c.last_updated, \'%d/%m/%Y à %Hh%i\') AS last_updated_fr, c.validation
			FROM Comments c
            INNER JOIN Users u ON u.id = c.author
            INNER JOIN Posts p ON p.id = c.post_id
			WHERE c.validation = 0
			ORDER BY c.creation_date'
        );
        $submittedcomments->execute(array());
        $submittedComment = [];
        while ($data = $submittedcomments->fetch())
            {
                $submittedComment[] = new CommentEntity($data);
            }
        $submittedcomments->closeCursor();
        return $submittedComment;
    }
/* *********** 7 . VALIDATE A COMMENT *******************/
    public function validateCommentRequest($commentId)
    {
        $dbProjet5 = $this->dbConnect();
        $validatecomment = $dbProjet5->prepare('UPDATE Comments SET validation = 1 WHERE  id = :id');
        $validatecomment->bindParam(':id', $commentId);
        $validated = $validatecomment->execute();
        return $validated;
    }
/* *********** 8 . COUNT VALIDATED COMMENTS *************/
    public function countCommentRequest($postId)
    {
        $dbProjet5 = $this->dbConnect();
        $count = $dbProjet5->prepare("SELECT id FROM Comments WHERE post_id = :id AND validation = 1 ");
        $count->bindParam(':id', $postId);
        $nbCount = $count->execute();
        $nbCount = $count->rowCount();
        return $nbCount;
    }
/* *********** 9 . COUNT NOT YET VALIDATED COMMENTS *****/
    public function countCommentBackRequest()
    {
        $dbProjet5 = $this->dbConnect();
        $count = $dbProjet5->query("SELECT id FROM Comments WHERE validation = 0 ");
        $nbCount = $count->rowCount();
        return $nbCount;
    }
/* ********** 10 . GET USER BY COMMENT ******************/
    public function getUserByCommentRequest($commentAuthor)
    {
        $dbProjet5 = $this->dbConnect();
        $userRequest = $dbProjet5->prepare("SELECT * FROM Users WHERE pseudo = :pseudo ");
        $userRequest->bindParam(':pseudo', $commentAuthor);
        $userRequest->execute();
        $data = $userRequest->fetch();
        $user = new UserEntity($data);
        return $user;
    }
}
