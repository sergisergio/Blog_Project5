<form action="index.php?action=modifyUser&amp;id=<?= $req['id'] ?>" method="post">
    <div>
        <label for="pseudo">Pseudo</label><br />
        <input type="text" id="pseudo" name="pseudo" value="<?= htmlspecialchars($req['pseudo']) ?>" />
    </div>
    <div>
        <label for="first_name">Prénom</label><br />
        <input type="text" id="first_name" name="first_name" value="<?= htmlspecialchars($req['first_name']) ?>" />
    </div>
    <div>
        <label for="name">Nom</label><br />
        <input type="text" id="name" name="last_name" value="<?= htmlspecialchars($req['last_name']) ?>" />
    </div>
    <div>
        <label for="password">Mot de passe</label><br />
        <input type="password" id="password" name="password" value="<?= htmlspecialchars($req['password']) ?>" />
    </div>
    <div>
        <label for="email">email</label><br />
        <input type="email" id="email" name="email" value="<?= htmlspecialchars($req['email']) ?>" />
    </div>
    <div>
        <label for="authorization">Autorisation</label><br />
        <input type="text" id="authorization" name="authorization" value="<?= htmlspecialchars($req['authorization']) ?>" />
    </div>
    <div>
        <label for="avatar">Avatar</label><br />
        <input type="text" id="avatar" name="avatar" value="<?= htmlspecialchars($req['avatar']) ?>" />
    </div>
    <div>
        <input type="submit" />
    </div>
</form>