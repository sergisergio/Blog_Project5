<form action="index.php?action=modifyProfile&amp;id=<?= $_SESSION['id'] ?>" method="post" enctype="multipart/form-data">
    <div>
        <label>Ajouter ou modifier mon avatar (1M max: jpg, jpeg, gif, png)</label><br />
        <input style="text-align: center;margin: 0 auto;" type="file" name="avatar" />
    </div>
    <div>
        <label for="first_name">Prénom</label><br />
        <input type="text" id="first_name" name="first_name" value="<?= $post->getFirst_name() ?>" />
    </div>
    <div>
        <label for="name">Nom</label><br />
        <input type="text" id="name" name="name" value="<?= $post->getLast_name() ?>" />
    </div>

    <div>
        <label for="email">Email</label><br />
        <input type="text" id="email" name="email" value="<?= $post->getEmail() ?>" />
    </div>
    <div>
        <label for="description">Description (max : 600 caractères)</label><br />
        <textarea id="description" name="description" ><?= $post->getDescription() ?></textarea>
    </div>
    <div class="text-center">
        <input  class="btn btn-default validate" type="submit" />
    </div>
        <input type="hidden" name="token" id="token" value="<?= $csrfProfileToken; ?>" />
        <input type="hidden" name="userId" value="<?= $_SESSION['id'] ?>"/> 
</form>