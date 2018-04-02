<?php $title = 'Gestion des membres'; ?>
<?php ob_start(); ?>

    <body class="full-layout">
        <!--<div id="preloader"><div id="status"><div class="loadcircle"></div></div></div>-->
        <div class="body-wrapper">
            <?php include "view/frontend/includes/nav.php"; ?>
                <!-- /#home -->
                <div class="container">
                    
                                <?php include "includes/management.php"; ?>

                                <h2 class="text-center">Gestion des membres</h2>
                
                        <div class="post box">
            <div class="row">
                    <h2 class="text-center">Modifier un membre</h2>


                    <form action="index.php?action=modifiedUser&amp;id=<?= $post['id'] ?>" method="post">

                    <form action="" method="post">
                        <div>
                            <label for="pseudo">Pseudo</label><br />
                            <input type="text" id="pseudo" name="pseudo" value="<?= htmlspecialchars($post['pseudo']) ?>" />
                        </div>

                        <div>
                            <label for="first_name">Prénom</label><br />
                            <input type="text" id="first_name" name="first_name" value="<?= htmlspecialchars($post['first_name']) ?>" />
                        </div>

                        <div>
                            <label for="name">Nom</label><br />
                            <input type="text" id="name" name="name" value="<?= htmlspecialchars($post['name']) ?>" />
                        </div>

                        <div>
                            <label for="password">Mot de passe</label><br />
                            <input type="password" id="password" name="password" value="<?= htmlspecialchars($post['password']) ?>" />
                        </div>

                        <div>
                            <label for="email">email</label><br />
                            <input type="email" id="email" name="email" value="<?= htmlspecialchars($post['email']) ?>" />
                        </div>

                        <div>
                            <label for="authorization">Autorisation</label><br />

                            <input type="text" id="authorization" name="authorization" value="<?= htmlspecialchars($post['authorization']) ?>" />

                        </div>

                        <div>
                            <input type="submit" />
                        </div>
                    </form>

                    

            </div>
        </div>
                    
                                                   
                </div>
                <!-- /.container -->
        </div>
        <!-- /.body-wrapper -->
        <?php include "view/frontend/includes/foot.php"; ?>
    </body>

    <?php $content = ob_get_clean(); ?>

    <?php require('template.php'); ?>