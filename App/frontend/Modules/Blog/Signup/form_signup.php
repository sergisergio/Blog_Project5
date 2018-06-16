<section style="margin-bottom: 0px;">
    <div class="box">
        <h2 class="section-title text-center">Inscription</h2>
        <p></p>
        <div class="divide30"></div>
        <div class="form-container">
            <div class="response alert"></div>
            <?php require 'App/frontend/Modules/ResponseAlert/responseAlert.php'; ?> 
            <?php      
                $csrfSignupToken = md5(time()*rand(1, 1000));       
            ?>
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
                        <input type="hidden" name="token" id="token" value="<?= $csrfSignupToken; ?>" />
                        <input type="hidden" name="v_error" id="v-error" value="Required" />
                        <input type="hidden" name="v_email" id="v-email" value="Enter a valid email" /> 
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</section>
<section>
    <div class="box">
        <h3 class="section-title text-center">Conseils</h3>
        <div class="divide30"></div>
        <div class="row">
            <div class="col-md-offset-3 col-md-6 col-sm-12">
                <ul>
                    <li>- Eviter les mots de passe simples ( prénom, date, etc...)</li>
                    <li>- Ne pas divulguer ou noter son mot de passe.</li>
                    <li>- Utiliser un mot de passe différent pour chaque site.</li>
                    <li>- Changer régulièrement son mot de passe.</li>
                    <li>- Se déconnecter avant de quitter le site.</li>
                    <li>- Les mots de passe sont chiffrés et ne sont pas stockés en clair..</li>
                </ul>
            </div>
        </div>
    </div>
</section>