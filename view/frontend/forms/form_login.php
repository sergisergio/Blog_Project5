<section>
    <div class="box">
        <h2 class="section-title text-center">Connexion</h2>
        <p></p>
        <div class="divide30"></div>
        <div class="form-container">
            <div class="response alert"></div>
            <?php if(isset($_SESSION['flash'])): ?>
                <?php foreach($_SESSION['flash'] as $type => $message): ?>
                    <div class="text-center alert alert-<?= $type; ?>">
                        <?= $message; ?>
                    </div>
                <?php endforeach; ?>
                <?php unset($_SESSION['flash']); ?>
            <?php endif; ?>
            <form action="index.php?action=login" method="post">
                <fieldset>
                    <div class="row">
                        <div class="col-md-offset-3 col-md-6 col-sm-12">
                            <div class="form-row text-input-row name-field">
                                <label>Pseudo</label>
                                <input type="text" name="pseudo" class="text-input defaultText required" /> </div>
                            <div class="form-row text-input-row subject-field">
                                <label>Mot de passe</label> <a class="pull-right" href="index.php?action=forgetPasswordPage"> (Mot de passe oublié ?)</a>
                                <input type="password" name="passe" class="text-input defaultText" /> </div>
                            <div class="form-row">
                                <input style="width: 5%;" type="checkbox" name="remember" value="1" />
                                <label class="">Se souvenir de moi</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-6">
                            <div class="button-row pull-right">
                                <input type="submit" value="Envoyer" name="submit" class="btn btn-submit bm0" /> </div>
                        </div>
                        <div class="col-sm-6 col-xs-6 lp5">
                            <div class="button-row pull-left">
                                <input type="reset" value="Effacer" name="reset" class="btn btn-submit bm0" /> </div>
                        </div>
                        <input type="hidden" name="v_error" id="v-error" value="Required" />
                        <input type="hidden" name="v_email" id="v-email" value="Enter a valid email" /> </div>
                </fieldset>
            </form>
        </div>
    </div>
</section>