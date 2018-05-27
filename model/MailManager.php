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
class MailManager extends Manager
{
    /* ************ 1 . RECUPERER TOUS LES ARTICLES *******************/
    function Mailer($from, $to, $subject, $body)
    {

        $this->from = $from;
        $this->to = $to;
		$this->subject = $subject;
        $this->body = $body;

    }
}