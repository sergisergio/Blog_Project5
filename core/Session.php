<?php

namespace Philippe\Blog\Core;

class Session
{
    public function launchSession($user)
    {
        $_SESSION['pseudo'] = $user->getPseudo();
        $_SESSION['id'] = $user->getId();
        $_SESSION['prenom'] = $user->getFirstName();
        $_SESSION['nom'] = $user->getlastName();
        $_SESSION['email'] = $user->getEmail();
        $_SESSION['password'] = $user->getPassword();
        $_SESSION['autorisation'] = $user->getAuthorization1();
        $_SESSION['avatar'] = $user->getAvatar();
        $_SESSION['registration'] = $user->getRegistrationDate();
        $_SESSION['is_active'] = $user->getIsActive();
        $_SESSION['description'] = $user->getDescription();
        header('Location: index.php?action=blog');
        exit();
    }
    public function stopSession()
    {
        unset($_SESSION);
        session_destroy();
        header('Location: index.php?action=blog');
    }

    public function responseBruteForce()
    {
        $_SESSION['flash']['danger'] = '4 tentatives ont été effectuées : veuillez contacter l\'administrateur pour vous reconnecter !';
        errors();
        exit();
    }

    public function errorPseudo1()
    {
        $_SESSION['flash']['danger'] = 'Ce pseudo est déjà pris !';
        signupPage();
        exit();
    }

    public function errorPseudo2()
    {
        $_SESSION['flash']['danger'] = 'Votre pseudo n\'est pas valide (caractères alphanumériques et underscore permis... !';
        signupPage();
        exit();
    }

    public function errorEmail1()
    {
        $_SESSION['flash']['danger'] = 'Cet email est déjà utilisé !';
        signupPage();
        exit();
    }

    public function errorEmail2()
    {
        $_SESSION['flash']['danger'] = 'Votre email n\'est pas valide !';
        signupPage();
        exit();
    }

    public function errorPassword()
    {
        $_SESSION['flash']['danger'] = 'Vous devez entrer un mot de passe valide !';
        signupPage();
        exit();
    }

    public function emptyContents()
    {
        $_SESSION['flash']['danger'] = 'Vous devez remplir tous les champs !';
        signupPage();
        exit();
    }

    public function badRequest()
    {
        $_SESSION['flash']['danger'] = 'Inscription impossible !';
        signupPage();
        exit();
    }

    public function registerSuccess()
    {
        $_SESSION['flash']['success'] = 'Un mail de confirmation vous a été envoyé pour valider votre compte';
        loginPage();
        exit();
    }

    public function activateAccount()
    {
        $_SESSION['flash']['success'] = 'Vous devez activer votre compte via le lien de confirmation dans le mail envoyé !';
        loginPage();
        exit();
    }

    public function errorPassword2()
    {
        $_SESSION['flash']['danger'] = 'Mauvais identifiant ou mot de passe !';
        loginPage();
        exit();
    }

    public function emptyContents2()
    {
        $_SESSION['flash']['danger'] = 'Vous devez remplir tous les champs !';
        loginPage();
        exit();
    }

    public function registerSuccess2()
    {
        $_SESSION['flash']['success'] = 'Votre inscription a bien été prise en compte ! Vous pouvez vous connecter !';
        loginPage();
        exit();
    }

    public function errorToken()
    {
        $_SESSION['flash']['danger'] = 'Ce token n est plus valide ! Veuillez réessayer ! !';
        signupPage();
        exit();
    }

    public function registerFailure()
    {
        $_SESSION['flash']['danger'] = 'Echec de l\'inscription ! Veuillez réessayer sinon contactez l\'administrateur';
        signupPage();
        exit();
    }

    public function noIdPost()
    {
        $_SESSION['flash']['danger'] = 'Aucun id ne correspond à ce billet !';
        errors();
        exit();
    }

    public function addedComment($postId)
    {
        $_SESSION['flash']['success'] = 'Votre commentaire sera validé dans les plus brefs délais !';
        header('Location: index.php?action=blogpost&id=' . $postId . '#comments');
        exit();
    }

    public function needsRegister($postId)
    {
        $_SESSION['flash']['danger'] = 'Vous devez être inscrit pour ajouter un commentaire !';
        header('Location: index.php?action=blogpost&id=' . $postId . '#comments');
        exit();
    }

    public function emptyContent($commentId)
    {
        $_SESSION['flash']['danger'] = 'Le champ est vide !';
        header('Location: index.php?action=modifyCommentPage&id=' . $_GET['id']);
        exit();
    }

    public function noIdComment()
    {
        $_SESSION['flash']['danger'] = 'Cet identifiant ne correspond à aucun commentaire !';
        errors();
        exit();
    }

    public function noRightsComments()
    {
        $_SESSION['flash']['danger'] = 'Vous pouvez seulement modifier vos propres commentaires !';
        errors();
        exit();
    }

    public function emptyContentsAdmin()
    {
        $_SESSION['flash']['danger'] = 'Vous pouvez seulement modifier vos propres commentaires !';
        errors();
        exit();
    }

    public function modifyCommentError($commentId)
    {
        $_SESSION['flash']['danger'] = 'Impossible de modifier le commentaire !';
        header('Location: index.php?action=modifyCommentPage&id=' . $commentId);
        exit();
    }

    public function noIdPostAdmin()
    {
        $_SESSION['flash']['danger'] = 'Aucun id ne correspond à cet article !';
        managePosts();
        exit();
    }

    public function noIdCommentAdmin()
    {
        $_SESSION['flash']['danger'] = 'Aucun id ne correspond à ce commentaire !';
        manageComments();
        exit();
    }

    public function addedPost()
    {
        $_SESSION['flash']['success'] = 'L\'article a bien été ajouté !';
        header('Location: index.php?action=manage_posts');
        exit();
    }

    public function nonAddedPost()
    {
        $_SESSION['flash']['danger'] = 'impossible d\'ajouter l\'article !';
        header('Location: index.php?action=manage_posts');
        exit();
    }

    public function modifiedPost()
    {
        $_SESSION['flash']['success'] = 'L\'article a bien été modifié !';
        header('Location: index.php?action=manage_posts');
        exit();
    }

    public function nonModifiedPost($postId)
    {
        $_SESSION['flash']['danger'] = 'Impossible de modifier l\'article';
        modifyPostPage($postId);
        exit();
    }

    public function emptyContentModifiedPost($postId)
    {
        $_SESSION['flash']['danger'] = 'Veuillez remplir les champs !';
        modifyPostPage($postId);
        exit();
    }

    public function noIdModifiedPost($postId)
    {
        $_SESSION['flash']['danger'] = 'Pas d\'identifiant d\'article envoyé !';
        modifyPostPage($postId);
        exit();
    }

    public function deletedPost()
    {
        $_SESSION['flash']['success'] = 'L\'article a bien été supprimé !';
        header('Location: index.php?action=manage_posts');
        exit();
    }

    public function nonDeletedPost()
    {
        $_SESSION['flash']['danger'] = 'Impossible de supprimer l\'article';
        header('Location: index.php?action=manage_posts');
        exit();
    }

    public function nonValidatedComment()
    {
        $_SESSION['flash']['danger'] = 'Impossible de valider le commentaire';
        header('Location: index.php?action=manage_comments');
        exit();
    }

    public function validatedComment()
    {
        $_SESSION['flash']['success'] = 'Le commentaire a bien été validé !';
        header('Location: index.php?action=manage_comments');
        exit();
    }

    public function adminDeletedComment()
    {
        $_SESSION['flash']['success'] = 'Le commentaire a bien été supprimé !';
        header('Location: index.php?action=manage_comments');
        exit();
    }

    public function adminNonDeletedComment()
    {
        $_SESSION['flash']['danger'] = 'Impossible de supprimer le commentaire !';
        header('Location: index.php?action=manage_comments');
        exit();
    }

    public function nonDeletedComment($postId)
    {
        $_SESSION['flash']['danger'] = 'Impossible de supprimer le commentaire !';
        header('Location: index.php?action=blogpost&id=' . $postId . '#comments');
        exit();
    }

    public function deletedComment($postId)
    {
        $_SESSION['flash']['success'] = 'Le commentaire a bien été supprimé !';
        header('Location: index.php?action=blogpost&id=' . $postId . '#comments');
        exit();
    }
}