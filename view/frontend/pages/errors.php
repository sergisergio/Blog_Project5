<?php $title = 'Erreur'; ?>
    <?php ob_start(); ?>

                <div class="container">
                    <section>
                        <div class="blog box mgbottom2 row">
                            <div class="col-md-12">
                                <!-- INCLUDE TOP -->
                                <?php include 'view/frontend/includes/top.php' ?>
                                <!-- END INCLUDE TOP -->
                            </div>
                        </div>
                        <div class="box">
                            <p></p>
                            <div class="divide30"></div>
                            <div class="form-container">
                                <!-- RESPONSE -->
                                <?php include 'view/frontend/includes/responseAlert.php'; ?>
                                <!-- END RESPONSE -->
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