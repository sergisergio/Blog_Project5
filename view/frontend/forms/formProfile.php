<form action="index.php?action=modifyProfile&amp;id=<?php echo $_SESSION['id'] ?>" method="post" enctype="multipart/form-data">
    <div>
        <label for="content">Ajouter un avatar (1M max: jpg, jpeg, gif, png)</label><br />
        <input style="text-align: center;margin: 0 auto;" type="file" name="avatar" />
    </div>
    <div>
        <label for="first_name">Prénom</label><br />
        <input type="text" id="first_name" name="first_name" value="<?php echo $post->getFirstName() ?>" />
    </div>
    <div>
        <label for="name">Nom</label><br />
        <input type="text" id="name" name="name" value="<?php echo $post->getLastname() ?>" />
    </div>

    <div>
        <label for="email">Email</label><br />
        <input type="text" id="email" name="email" value="<?php echo $post->getEmail() ?>" />
    </div>
    <div>
        <label for="description">Description (max : 600 caractères)</label><br />
        <textarea type="text" id="description" name="description" /><?php echo $post->getDescription() ?></textarea>
    </div>
    <div class="text-center">
        <input  class="btn btn-default validate" type="submit" />
    </div>
        <input type="hidden" name="userId" value="<?php echo $_SESSION['id'] ?>"/> 
</form>