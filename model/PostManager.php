<?php
/* ************************* RESUME *************************************
1 . RECUPERER TOUS LES ARTICLES.
2 . RECUPERER UN SEUL ARTICLE.
3 . AJOUTER UN ARTICLE.
4 . MODIFIER UN ARTICLE.
5 . EFFACER UN ARTICLE.
6 . COMPTER LE NOMBRE DE POSTS.
************************** FIN RESUME **********************************/
namespace Philippe\Blog\Model;
require_once "model/Manager.php";
class PostManager extends Manager
{
    
    /* ************ 1 . RECUPERER TOUS LES ARTICLES *******************/
    public function getPosts($start, $postsPerPage)
    {
        $dbProjet5 = $this->dbConnect();
        $req = $dbProjet5->query(
            'SELECT p.id, p.title, p.chapo, p.intro, p.content, u.pseudo AS author, p.file_extension, DATE_FORMAT(p.creation_date, \'%d/%m/%Y à %Hh%i\') AS creation_date_fr, DATE_FORMAT(p.last_updated, \'%d/%m/%Y à %Hh%i\') AS last_updated_fr 
			FROM Posts p
            INNER JOIN Users u ON u.id = p.author
			ORDER BY creation_date DESC LIMIT '.$start.', '.$postsPerPage
        );
        return $req;
    }
    /* ************ 2 . RECUPERER UN SEUL ARTICLE *********************/
    public function getPost($postId)
    {
        $dbProjet5 = $this->dbConnect();
        $req = $dbProjet5->prepare(
            'SELECT p.id, p.title, p.chapo, p.intro, p.content, u.pseudo AS author, p.file_extension, DATE_FORMAT(p.creation_date, \'%d/%m/%Y à %Hh%i\') AS creation_date_fr, DATE_FORMAT(p.last_updated, \'%d/%m/%Y à %Hh%i\') AS last_updated_fr 
			FROM Posts p
            INNER JOIN Users u ON u.id = p.author
			WHERE p.id = ?'
        );

        $req->execute(array($postId));
        $post = $req->fetch();
        return $post;
    }
    /* ************ 3 . AJOUTER UN ARTICLE ****************************/
    public function addPostRequest($title, $chapo, $author, $content, $image)
    {
        $dbProjet5 = $this->dbConnect();
        $post = $dbProjet5->prepare('INSERT INTO Posts(title, chapo, intro, author, content, file_extension, creation_date) VALUES(?, ?, ?, ?, ?, ?, NOW()) ');
        $affectedPost = $post->execute(array($title, $chapo, substr($content, 0, 600), $author, $content, $image));
        return $affectedPost;
    }
    /* ************ 4 . MODIFIER UN ARTICLE ***************************/
    public function modifyPostRequest($postId, $title, $chapo, $author, $content)
    {
        $dbProjet5 = $this->dbConnect();
        $post = $dbProjet5->prepare('UPDATE Posts SET title = ?, intro = ?, chapo = ?, author = ?, content = ?, last_updated = NOW() WHERE id = ?');
        $affectedPost = $post->execute(array($title, substr($content, 0, 600), $chapo, $author, $content, $postId));
        return $affectedPost;
    }
    /* ************ 5 . EFFACER UN ARTICLE ****************************/
    public function deletePostRequest($postId)
    {
        $dbProjet5 = $this->dbConnect();
        $post = $dbProjet5->prepare('DELETE FROM Posts WHERE id = ?');
        $affectedPost = $post->execute(array($postId));
        return $affectedPost;
    }
    /* ************ 6 . COMPTER LE NOMBRE DE POSTS ********************/
    public function countPosts()
    {
        $dbProjet5 = $this->dbConnect();
        $postsTotalReq  = $dbProjet5->query('SELECT id FROM Posts');
        $postsTotal = $postsTotalReq->rowCount();
        return $postsTotal;
    }
    /* ************ 7 . COUNT SEARCH RESULTS **************************/

    public function countSearchRequest($search){

        $dbProjet5 = $this->dbConnect();

        $countSearchResults  = $dbProjet5->query("SELECT id, title, chapo, content FROM Posts WHERE content LIKE '%$search%' ");

        return $countSearchResults;
    }
    /* ************ 8 . SEARCH RESULTS *******************************/

    public function searchRequest($search){

        $dbProjet5 = $this->dbConnect();

        $results  = $dbProjet5->prepare(" SELECT id, title, chapo, content FROM Posts WHERE content LIKE '%$search%' ORDER BY id DESC ");
        $results->execute();
        return $results;
    }
}