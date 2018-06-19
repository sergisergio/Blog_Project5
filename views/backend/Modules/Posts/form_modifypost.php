<div class="form-container">
    <div class="response alert"></div>
        <?php include 'views/frontend/Modules/ResponseAlert/responseAlert.php'; ?>
        <?php      
            $csrfModifyPostToken = md5(time()*rand(1, 1000));       
        ?>
<form action="index.php?action=modifyPost&amp;id=<?php echo $post->getId() ?>" method="post">
    <div>
        <label for="title">Titre</label><br />
        <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($post->getTitle()) ?>" />
    </div>
    <div class="divide20"></div>
    <div>
        <label for="chapo">Chapô</label><br />
        <input type="text" id="chapo" name="chapo" value="<?php echo htmlspecialchars($post->getChapo()) ?>" />
    </div>
    <div class="divide20"></div>
    <div>
        <label for="content">Article</label><br />

        <textarea id="content" name="content"><?php echo htmlspecialchars($post->getContent()) ?></textarea>
    </div>
    <div class="divide40"></div>
    <div>
        <input class="btn btn-default" type="submit" style="width: 100px;display: block; margin: 0 auto;"/>
    </div>
    <div>
        <input type="hidden" name="token" id="token" value="<?= $csrfModifyPostToken; ?>" />
    </div>
</form>
</div>
