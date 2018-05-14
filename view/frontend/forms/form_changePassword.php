<section id="contact">
    <div class="box">
        <h2 class="section-title text-center">réinitialiser le mot de passe</h2>
        <p></p><div class="divide30"></div>
        <div class="form-container">
            <div class="response alert"></div>
            <form action="index.php?action=changePassword" method="post">
                <fieldset>
                    <div class="row">
                        <div class="col-md-offset-3 col-md-6 col-sm-12">
                            <div class="form-row text-input-row subject-field">
                                <label>Nouveau mot de passe</label>
                                <input type="password" placeholder="Votre mot de passe" name="passe" class="text-input defaultText" />
                            </div>
                            <div class="form-row text-input-row subject-field">
                                <label>Confirmer votre nouveau mot de passe</label>
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
                        <input type="hidden" name="userId" value="<?= $_GET['id'] ?>"/> 
                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</section>