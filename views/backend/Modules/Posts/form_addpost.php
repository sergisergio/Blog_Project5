<div class="form-container">
    <div class="response alert"></div>
        <?php include 'views/frontend/modules/responseAlert/responseAlert.php'; ?>
<form action="index.php?action=addpost" method="post" enctype="multipart/form-data">
    <div>
        <label for="title">Titre</label><br />
        <input type="text" id="title" name="title" value="" />
    </div>
    <div>
        <label for="chapo">Chapô</label><br />
        <input type="text" id="chapo" name="chapo" value="" />
    </div>
    <div>
        <label for="content">Article</label><br />
        <textarea type="text" id="content" name="content" value=""></textarea>
    </div>
    <div class="divide20"></div>
    <div class="divide20"></div>
    <div>
        <label style="display: block;text-align: center;margin: 0 auto;" for="content">Ajouter une image (facultatif) </label><br />
         <input style="text-align: center;margin: 0 auto;" type="file" name="file_extension" />
    </div>
    <div class="divide20"></div>
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <label for="category">Choisir une catégorie (facultatif)</label><br />
            <select name="category">
            <?php
                foreach ($categories as $c)
                {
           
                echo "<option value='".$c->getCategory_id()."'>".$c->getCategory()."</option>";
            
                }
            ?>
            </select>
        </div>
        
    </div>
    <div class="divide40"></div>
    <div>
        <input class="btn btn-default" type="submit" style="width: 100px;display: block; margin: 0 auto;"/>
    </div>
    <div>
        <input type="hidden" name="token" id="token" value="<?= $csrfAddPostToken; ?>" />
    </div>
</form>
</div>