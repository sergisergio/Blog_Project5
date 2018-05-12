<section>
    <div class="box">
        <h2 class="section-title text-center">Inscription</h2>
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
            <form action="index.php?action=addUser" method="post">
                <fieldset>
                    <div class="row">
                        <div class="col-md-offset-3 col-md-6 col-sm-12">
                            <div class="form-row text-input-row name-field">
                                <label>Pseudo</label>
                                <input type="text" placeholder="Votre pseudo" name="pseudo" class="text-input defaultText " /> 
                            </div>
                            <div class="form-row text-input-row email-field">
                                <label>Email</label>
                                <input type="text" placeholder="Votre e-mail" name="email" class="text-input defaultText  email" /> 
                            </div>
                            <div class="form-row text-input-row subject-field">
                                <label>Mot de passe</label>
                                <input type="password" placeholder="Votre mot de passe" name="passe" class="text-input defaultText" />
                            </div>
                            <div class="form-row text-input-row subject-field">
                                <label>Confirmer votre mot de passe</label>
                                <input type="password" placeholder="Confirmez votre mot de passe" name="passe2" class="text-input defaultText" /> 
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-6">
                            <div class="button-row pull-right">
                                <input type="submit" value="Envoyer" name="submit" class="btn btn-submit bm0" /> 
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-6 lp5">
                            <div class="button-row pull-left">
                                <input type="reset" value="Effacer" name="reset" class="btn btn-submit bm0" /> 
                            </div>
                        </div>
                        <input type="hidden" name="v_error" id="v-error" value="Required" />
                        <input type="hidden" name="v_email" id="v-email" value="Enter a valid email" /> 
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</section>