<form action="index.php?action=addpost" method="post">
    <div>
        <label for="title">Titre</label><br />
        <input type="text" id="title" name="title" value="" />
    </div>

    <div>
        <label for="intro">Intro</label><br />
        <input type="text" id="intro" name="intro" value="" />
    </div>

    <!--<div>
        <label for="member_pseudo">Auteur</label><br />
        <input type="text" id="member_pseudo" name="author" value="" />
    </div>-->

    <div>
        <label for="content">Article</label><br />
        <textarea type="text" id="content" name="content" value=""></textarea>
    </div>

    <div>
        <input type="submit" />
    </div>
</form>