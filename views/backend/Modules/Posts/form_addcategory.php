<div class="form-container">
    <div class="response alert"></div>
<form action="index.php?action=addcategory" method="post">
    <div class="row">
    <div class="col-md-offset-3 col-md-6 col-sm-12">
        <label for="category">Ajouter une catégorie</label><br />
        <input type="text" id="category" name="category" value="">
    </div>
    </div>
    <div>
        <input class="btn btn-default" type="submit" style="width: 100px;display: block; margin: 0 auto;"/>
    </div>
    <div>
        <input type="hidden" name="token" id="token" value="<?= $csrfAddCategoryToken; ?>" />
    </div>
</form>
</div>