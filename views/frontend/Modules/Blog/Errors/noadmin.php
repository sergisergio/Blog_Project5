<?php $title = 'Zone interdite'; ?>
    <?php ob_start(); ?>
                <div class="container">
                    <section>
                        <div class="blog box mgbottom2 row">
                            <div class="col-md-12">
                                <?php require 'views/frontend/Modules/Blog/Top/top.php' ?>
                            </div>
                        </div>
                        <div class="box">
                            <p></p>
                            <div class="divide30"></div>
                            <div class="form-container">
                            <div class="alert alert-danger" style="font-weight: bold; text-align:center;">Vous n'avez pas les droits pour accéder à cette page...</div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <a href="index.php" class="btn btn-default btn-lg pull-right" role="button">Accueil</a>
                                </div>
                                <div class="col-md-6">
                                    <a href="index.php?action=blog" class="btn btn-default btn-lg pull-left" role="button">Blog</a>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
        </div>
<?php $content = ob_get_clean(); ?>
<?php require 'views/frontend/templates/template.php'; ?>