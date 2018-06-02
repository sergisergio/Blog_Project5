<?php $title = 'Zone interdite'; ?>
    <?php ob_start(); ?>
                <div class="container">
                    <section>
                        <div class="blog box mgbottom2 row">
                            <div class="col-md-12">
                                <!-- INCLUDE TOP -->
                                <?php require 'view/frontend/includes/top.php' ?>
                                <!-- END INCLUDE TOP -->
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
                                    <btn class="btn btn-default pull-right"><a href="index.php">Accueil</a></btn>
                                </div>
                                <div class="col-md-6">
                                    <btn class="btn btn-default pull-left"><a href="index.php?action=blog">blog</a></btn>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
        </div>
<?php $content = ob_get_clean(); ?>
<?php require 'view/frontend/templates/template.php'; ?>