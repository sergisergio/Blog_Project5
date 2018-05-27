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
9 . COMPTER NOMBRE DE COMMENTAIRES NON VALIDES.
************************* FIN RESUME ***********************************/
namespace Philippe\Blog\Model;
require_once "model/Manager.php";
class CommentManager extends Manager
{
    protected $id;
    protected $post_id;
    protected $author;
    protected $content;
    protected $creation_date;
    protected $last_updated;
    protected $validation;

    /*
     * Méthode de construction
     */
    public function __construct(array $data) 
      {
        $this->hydrate($data);
      }

    /*
     * Methode d'hydratation
     */
    public function hydrate(array $data) {
        foreach ($data as $key => $value) {
            $method = 'set'.ucfirst($key);
            
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    public function setId($id)
      {
        $this->id = $id;
      }
    public function getId()
      {
        return $this->id;
      }
    public function setPostId($post_id)
      {
        $this->post_id = $post_id;
      }
    public function getPostId()
      {
        return $this->post_id;
      }
    public function setAuthor($author)
      {
        $this->author = $author;
      }
    public function getAuthor()
      {
        return $this->author;
      }
    public function setContent($content)
      {
        $this->content = $content;
      }
    public function getContent()
      {
        return $this->content;
      }
    public function setCreationDate($creation_date)
      {
        $this->creation_date = $creation_date;
      }
    public function getCreationDate()
      {
        return $this->creation_date;
      }
    public function setLastUpdated($last_updated)
      {
        $this->last_updated = $last_updated;
      }
    public function getLastUpdated()
      {
        return $this->last_updated;
      }
    public function setValidation($validation)
      {
        $this->validation = $validation;
      }
    public function getValidation()
      {
        return $this->validation;
      }
    /* *********** 1 . RECUPERER TOUS LES COMMENTAIRES *********************/
    public function getComments($postId)
    {
        $dbProjet5 = $this->dbConnect();
        $comments = $dbProjet5->prepare(
            'SELECT c.id, u.pseudo AS author, c.content, DATE_FORMAT(c.creation_date, \'%d/%m/%Y à %Hh%i\') AS creation_date_fr, DATE_FORMAT(c.last_updated, \'%d/%m/%Y à %Hh%i\') AS last_updated_fr 
			FROM Comments c
            INNER JOIN Users u ON u.id = c.author
			WHERE c.post_id = ?
			AND c.validation = 1
			ORDER BY creation_date'
        );
        $comments->execute(array($postId));
        return $comments;
    }
    /* *********** 2 . RECUPERER UN SEUL COMMENTAIRE ***********************/
    public function getComment($commentId)
    {
        $dbProjet5 = $this->dbConnect();
        $req = $dbProjet5->prepare(
            'SELECT c.id, c.post_id, u.pseudo AS author, c.content, DATE_FORMAT(c.creation_date, \'%d/%m/%Y à %Hh%i\') AS creation_date_fr, DATE_FORMAT(c.last_updated, \'%d/%m/%Y à %Hh%i\') AS last_updated_fr 
		 	FROM Comments c
            INNER JOIN Users u ON u.id = c.author
		 	WHERE c.id = ?'
        );
        $req->execute(array($commentId));
        $comment = $req->fetch();
        return $comment;
    }
    /* *********** 3 . AJOUTER UN COMMENTAIRE ******************************/
    public function postComment($postId, $author, $content)
    {
        $dbProjet5 = $this->dbConnect();
        $comments = $dbProjet5->prepare('INSERT INTO Comments (post_id, author, content, validation, creation_date) VALUES(?, ?, ?, 0, NOW())');
        $affectedLines = $comments->execute(array($postId, $author, $content));
        return $affectedLines;
    }
    /* *********** 4 . SUPPRIMER UN COMMENTAIRE ****************************/
    public function deleteCommentRequest($commentId)
    {
        $dbProjet5 = $this->dbConnect();
        $comments = $dbProjet5->prepare('DELETE FROM Comments WHERE id = ?');
        $affectedComment = $comments->execute(array($commentId));
        return $affectedComment;
    }
    /* *********** 5 . MODIFIER UN COMMENTAIRE *****************************/
    public function modifyCommentRequest($commentId, $author, $content)
    {
        $dbProjet5 = $this->dbConnect();
        $comments = $dbProjet5->prepare('UPDATE Comments SET author = ?, content = ?, validation = 0, last_updated = NOW() WHERE  id = ?');
        $affectedLines = $comments->execute(array($author, $content, $commentId));
        return $affectedLines;
    }
    /* *********** 6 . AFFICHER LES COMMENTAIRES NON VALIDES ***************/
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
        return $submittedcomments;
    }
    /* *********** 7 . VALIDER UN COMMENTAIRE *****************************/
    public function validateCommentRequest($commentId)
    {
        $dbProjet5 = $this->dbConnect();
        $validatecomment = $dbProjet5->prepare('UPDATE Comments SET validation = 1 WHERE  id = ?');
        $validated = $validatecomment->execute(array($commentId));
        return $validated;
    }
    /* *********** 8 . COMPTER NOMBRE DE COMMENTAIRES **********************/
    public function countCommentRequest($postId)
    {
        $dbProjet5 = $this->dbConnect();
        $count = $dbProjet5->query("SELECT id FROM Comments WHERE post_id = '$postId' AND validation = 1 ");
        $nbCount = $count->rowCount();
        return $nbCount;
    }
    /* *********** 9 . COMPTER NOMBRE DE COMMENTAIRES NON VALIDES *********/
    public function countCommentBackRequest()
    {
        $dbProjet5 = $this->dbConnect();
        $count = $dbProjet5->query("SELECT id FROM Comments WHERE validation = 0 ");
        $nbCount = $count->rowCount();
        return $nbCount;
    }
}