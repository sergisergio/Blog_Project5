<?php $title = 'Mot de passe oublié'; ?>
    <?php ob_start(); ?>

        <body class="full-layout">
            <div class="body-wrapper">
                <?php include "includes/nav.php"; ?>
                    <!-- /#home -->
                    <div class="container">
                        <div class="divide30"></div>
                        <div class="divide30"></div>
                        <div class="divide30"></div>
                        <div class="box">
                        <h1>Mot de passe oublié</h1>
                        <form action="" method="POST">
                            <div class="form-group">
                                <label for="">Email</label>
                                <input type="email" name="email" class="form-control" /> </div>
                            <button type="submit" class="btn btn-primary">Envoyer</button>
                        </form>
                        </div>
                    </div>
                    <!-- /.container -->
            </div>
            <!-- /.body-wrapper -->
            <?php include "includes/foot.php"; ?>
        </body>
        <?php $content = ob_get_clean(); ?>
            <?php require('template.php'); ?>