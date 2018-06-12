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
        session_start();
        setcookie('pseudo', null, -1);
        setcookie('password', null, -1);
        unset($_SESSION);
        session_destroy();
        header('Location: index.php?action=blog');
    }

    /*public function responseBruteForce()
    {
        $_SESSION['flash']['danger'] = '4 tentatives ont été effectuées : veuillez contacter l\'administrateur pour vous reconnecter !';
        errors();
    }*/
    /*public function errorPseudo1()
    {
        $_SESSION['flash']['danger'] = 'Ce pseudo est déjà pris !';
        signupPage();
    }*/

    /*public function errorPseudo2()
    {
        $_SESSION['flash']['danger'] = 'Votre pseudo n\'est pas valide (caractères alphanumériques et underscore permis... !';
        signupPage();
    }*/

    /*public function errorEmail1()
    {
        $_SESSION['flash']['danger'] = 'Cet email est déjà utilisé !';
        signupPage();
    }*/

    /*public function errorEmail2()
    {
        $_SESSION['flash']['danger'] = 'Votre email n\'est pas valide !';
        signupPage();
    }*/

    /*public function errorPassword()
    {
        $_SESSION['flash']['danger'] = 'Vous devez entrer un mot de passe valide !';
        signupPage();
    }*/

    /*public function errorLengthPassword()
    {
        $_SESSION['flash']['danger'] = 'Votre mot de passe doit faire entre 6 et 50 caractères !';
        signupPage();
    }*/

    /*public function emptyContents()
    {
        $_SESSION['flash']['danger'] = 'Vous devez remplir tous les champs !';
        signupPage();
    }*/

    /*public function badRequest()
    {
        $_SESSION['flash']['danger'] = 'Inscription impossible !';
        signupPage();
    }*/

    /*public function registerSuccess()
    {
        $_SESSION['flash']['success'] = 'Un mail de confirmation vous a été envoyé pour valider votre compte';
        loginPage();
    }*/

    /*public function activateAccount()
    {
        $_SESSION['flash']['success'] = 'Vous devez activer votre compte via le lien de confirmation dans le mail envoyé !';
        loginPage();
    }*/

    /*public function errorPassword2()
    {
        $_SESSION['flash']['danger'] = 'Mauvais identifiant ou mot de passe !';
        loginPage();
    }*/

    /*public function emptyContents2()
    {
        $_SESSION['flash']['danger'] = 'Vous devez remplir tous les champs !';
        loginPage();
    }*/

    /*public function registerSuccess2()
    {
        $_SESSION['flash']['success'] = 'Votre inscription a bien été prise en compte ! Vous pouvez vous connecter !';
        loginPage();
    }*/

    /*public function errorToken()
    {
        $_SESSION['flash']['danger'] = 'Ce token n est plus valide ! Veuillez réessayer ! !';
        signupPage();
    }*/

    /*public function registerFailure()
    {
        $_SESSION['flash']['danger'] = 'Echec de l\'inscription ! Veuillez réessayer sinon contactez l\'administrateur';
        signupPage();
    }*/

    /*public function noIdPost()
    {
        $_SESSION['flash']['danger'] = 'Aucun id ne correspond à ce billet !';
        errors();
    }*/

    /*public function addedComment($postId)
    {
        $_SESSION['flash']['success'] = 'Votre commentaire sera validé dans les plus brefs délais !';
        header('Location: index.php?action=blogpost&id=' . $postId . '#comments');
        exit();
    }*/

    /*public function needsRegister($postId)
    {
        $_SESSION['flash']['danger'] = 'Vous devez être inscrit pour ajouter un commentaire !';
        header('Location: index.php?action=blogpost&id=' . $postId . '#comments');
        exit();
    }*/

    /*public function csrfAddPost($postId)
    {
        $_SESSION['flash']['danger'] = 'Erreur de vérification !';
        header('Location: index.php?action=blogpost&id=' . $postId . '#comments');
        exit();
    }*/

    /*public function emptyContent($commentId)
    {
        $_SESSION['flash']['danger'] = 'Le champ est vide !';
        header('Location: index.php?action=modifyCommentPage&id=' . $commentId);
        exit();
    }*/

    /*public function noIdComment()
    {
        $_SESSION['flash']['danger'] = 'Cet identifiant ne correspond à aucun commentaire !';
        errors();
    }*/

    /*public function noRightsComments()
    {
        $_SESSION['flash']['danger'] = 'Vous pouvez seulement modifier vos propres commentaires !';
        errors();
    }*/

    /*public function emptyContentsAdmin()
    {
        $_SESSION['flash']['danger'] = 'Un ou plusieurs champs ne sont pas remplis !';
        errors();
    }*/

    /*public function modifyCommentError($commentId)
    {
        $_SESSION['flash']['danger'] = 'Impossible de modifier le commentaire !';
        header('Location: index.php?action=modifyCommentPage&id=' . $commentId);
        exit();
    }*/

    /*public function csrfModifyCommentError($commentId)
    {
        $_SESSION['flash']['danger'] = 'Erreur de vérification !';
        header('Location: index.php?action=modifyCommentPage&id=' . $commentId);
    }*/

    /*public function noIdPostAdmin()
    {
        $_SESSION['flash']['danger'] = 'Aucun id ne correspond à cet article !';
        managePosts();
    }*/

    /*public function noIdCommentAdmin()
    {
        $_SESSION['flash']['danger'] = 'Aucun id ne correspond à ce commentaire !';
        manageComments();
    }*/

    /*public function addedPost()
    {
        $_SESSION['flash']['success'] = 'L\'article a bien été ajouté !';
        managePosts();
    }*/

    /*public function nonAddedPost()
    {
        $_SESSION['flash']['danger'] = 'impossible d\'ajouter l\'article !';
        managePosts();
    }*/

    /*public function csrfPost()
    {
        $_SESSION['flash']['danger'] = 'Erreur de vérification !';
        header('Location: index.php?action=manage_posts');
        exit();
    }*/

    /*public function modifiedPost()
    {
        $_SESSION['flash']['success'] = 'L\'article a bien été modifié !';
        header('Location: index.php?action=manage_posts');
        exit();
    }*/

    /*public function nonModifiedPost($postId)
    {
        $_SESSION['flash']['danger'] = 'Impossible de modifier l\'article';
        modifyPostPage($postId);
    }*/

    /*public function csrfModifyPost($postId)
    {
        $_SESSION['flash']['danger'] = 'Erreur de vérification !';
        modifyPostPage($postId);
    }*/

    /*public function emptyContentModifiedPost($postId)
    {
        $_SESSION['flash']['danger'] = 'Veuillez remplir les champs !';
        modifyPostPage($postId);
    }*/

    /*public function noIdModifiedPost($postId)
    {
        $_SESSION['flash']['danger'] = 'Pas d\'identifiant d\'article envoyé !';
        modifyPostPage($postId);
    }*/

    /*public function deletedPost()
    {
        $_SESSION['flash']['success'] = 'L\'article a bien été supprimé !';
        header('Location: index.php?action=manage_posts');
    }*/

    /*public function nonDeletedPost()
    {
        $_SESSION['flash']['danger'] = 'Impossible de supprimer l\'article';
        header('Location: index.php?action=manage_posts');
    }*/

    /*public function nonValidatedComment()
    {
        $_SESSION['flash']['danger'] = 'Impossible de valider le commentaire';
        header('Location: index.php?action=manage_comments');
        exit();
    }*/

    /*public function validatedComment()
    {
        $_SESSION['flash']['success'] = 'Le commentaire a bien été validé !';
        header('Location: index.php?action=manage_comments');
        exit();
    }*/

    /*public function adminDeletedComment()
    {
        $_SESSION['flash']['success'] = 'Le commentaire a bien été supprimé !';
        header('Location: index.php?action=manage_comments');
        exit();
    }*/

    /*public function adminNonDeletedComment()
    {
        $_SESSION['flash']['danger'] = 'Impossible de supprimer le commentaire !';
        header('Location: index.php?action=manage_comments');
        exit();
    }*/

    /*public function nonDeletedComment($postId)
    {
        $_SESSION['flash']['danger'] = 'Impossible de supprimer le commentaire !';
        header('Location: index.php?action=blogpost&id=' . $postId . '#comments');
        exit();
    }*/

    /*public function deletedComment($postId)
    {
        $_SESSION['flash']['success'] = 'Le commentaire a bien été supprimé !';
        header('Location: index.php?action=blogpost&id=' . $postId . '#comments');
        exit();
    }*/

    /*public function csrfDeleteComment($postId)
    {
        $_SESSION['flash']['danger'] = 'Erreur de vérification !';
        header('Location: index.php?action=blogpost&id=' . $postId . '#comments');
        exit();
    }*/

    /*public function errorForgetPassword()
    {
        $_SESSION['flash']['danger'] = 'Une erreur est survenue !';
        loginPage();
    }*/

    /*public function mailForgetPassword()
    {
        $_SESSION['flash']['success'] = 'Vous allez recevoir un email pour réinitialiser votre mot de passe !';
        loginPage();
    }*/

    /*public function emptyMail()
    {
        $_SESSION['flash']['danger'] = 'Veuillez renseigner un email !';
        forgetPasswordPage();
    }*/

    /*public function nonMail()
    {
        $_SESSION['flash']['danger'] = 'Cet email n\'est pas valide !';
        loginPage();
    }*/

    /*public function tokenPassword()
    {
        $_SESSION['flash']['danger'] = 'Aucun id ou token ne coresspond à cet email, veuillez réessayer !';
        forgetPasswordPage();
    }*/

    /*public function changedPassword()
    {
        $_SESSION['flash']['success'] = 'Le mot de passe a bien été réinitialisé !';
        loginPage();
    }*/

    /*public function emptyPassword()
    {
        $_SESSION['flash']['danger'] = 'Veuillez entrer un mot de passe !';
        forgetPasswordPage();
    }*/

    /*public function loginCsrfError()
    {
        $_SESSION['flash']['danger'] = 'Erreur de vérification !';
        loginPage();
    }*/

    /*public function deletePostCsrfError()
    {
        $_SESSION['flash']['danger'] = 'Erreur de vérification !';
        managePosts();
    }*/

    /*public function forgetCsrfError()
    {
        $_SESSION['flash']['danger'] = 'Erreur de vérification !';
        forgetPasswordPage();
    }*/

    /*public function forgetTokenError()
    {
        $_SESSION['flash']['danger'] = 'Ce token n\' est plus valide ! Veuillez réessayer !';
        forgetPasswordPage();
    }*/

    /*public function changeCsrfError()
    {
        $_SESSION['flash']['danger'] = 'Erreur de vérification !';
        loginPage();
    }*/

    /*public function validateCommentCsrfError()
    {
        $_SESSION['flash']['danger'] = 'Erreur de vérification !';
        manageComments();
    }*/

    /*public function adminDeleteCommentCsrfError()
    {
        $_SESSION['flash']['danger'] = 'Erreur de vérification !';
        manageComments();
    }*/

    /*public function emptyModifyProfile()
    {
        $_SESSION['flash']['danger'] = 'Tous les champs ne sont pas remplis !';
        profilePage($_SESSION['id']);
    }*/

    /*public function csrfModifyProfile()
    {
        $_SESSION['flash']['danger'] = 'Erreur de vérification !';
        profilePage($_SESSION['id']);
    }*/

    /*public function successModifyProfile()
    {
        $_SESSION['flash']['success'] = 'Modification effectuée !';
        profilePage($_SESSION['id']);
    }*/

    /*public function errorModifyProfile()
    {
        $_SESSION['flash']['danger'] = 'Impossible de modifier le profil !';
        profilePage($_SESSION['id']);
    }*/

    /*public function errorDeleteAccount()
    {
        $_SESSION['flash']['danger'] = 'Aucun id ne correspond à cet utilisateur !';
        profilePage();
    }*/

    /*public function csrfDeleteAccount()
    {
        $_SESSION['flash']['danger'] = 'Erreur de vérification !';
        profilePage();
    }*/

    /*public function errorDeleteAccount2()
    {
        $_SESSION['flash']['danger'] = 'Impossible de supprimer le profil !';
        profilePage();
    }*/

    /*public function csrfRegister()
    {
        $_SESSION['flash']['danger'] = 'Erreur de vérification !';
        loginPage();
    }*/

    /*public function giveAdminRightsCsrfError()
    {
        $_SESSION['flash']['danger'] = 'Erreur de vérification !';
        manageUsers();
    }*/

    /*public function cancelAdminRightsCsrfError()
    {
        $_SESSION['flash']['danger'] = 'Erreur de vérification !';
        manageUsers();
    }*/

    /*public function deleteUserCsrfError()
    {
        $_SESSION['flash']['danger'] = 'Erreur de vérification !';
        manageUsers();
    }*/

    /*public function nonAddedCategory()
    {
        $_SESSION['flash']['danger'] = 'Impossible d\'ajouter cette catégorie !';
        managePosts();
    }*/

    /*public function addedCategory()
    {
        $_SESSION['flash']['success'] = 'La catégorie a bien été ajoutée !';
        managePosts();
    }*/

    /*public function emptyCategory()
    {
        $_SESSION['flash']['danger'] = 'Le champ est vide !';
        managePosts();
    }*/
}