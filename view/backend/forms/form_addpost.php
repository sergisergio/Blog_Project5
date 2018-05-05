<form action="index.php?action=addpost" method="post" enctype="multipart/form-data">
    <div>
        <label for="title">Titre</label><br />
        <input type="text" id="title" name="title" value="" />
    </div>

    <div>
        <label for="content">Article</label><br />
        <textarea type="text" id="content" name="content" value=""></textarea>
    </div>

    <div>
        <label for="content">Ajouter une image (facultatif) </label><br />
         <input style="text-align: center;margin: 0 auto;" type="file" name="file_extension" />
    </div>

    <div>
        <input class="btn btn-default" type="submit" style="width: 100px;display: block; margin: 0 auto;"/>
    </div>
</form>