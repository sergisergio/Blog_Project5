<?php $title = 'Erreur'; ?>
    <?php ob_start(); ?>
                <div class="container">
                    <section>
                        <div class="blog box mgbottom2 row">
                            <div class="col-md-12">
                                <?php include 'views/frontend/modules/blog/top/top.php' ?>
                            </div>
                        </div>
                        <div class="box">
                            <p></p>
                            <div class="divide30"></div>
                            <div class="form-container">
                                <?php include 'views/frontend/modules/responseAlert/responseAlert.php'; ?>
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
<?php include 'views/frontend/templates/template.php'; ?>