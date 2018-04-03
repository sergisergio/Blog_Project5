<section id="contact">
    <div class="box">
        <h2 class="section-title text-center">Inscription</h2>
        <p></p>
                    
        <div class="divide30"></div>
            <div class="form-container">
                <div class="response alert alert-success"></div>
                    <form class="forms" action="#" method="post">
                        <fieldset>
                            <div class="row">
                                <div class="col-md-offset-3 col-md-6 col-sm-12">
                                    <div class="form-row text-input-row name-field">
                                        <label>Pseudo</label>
                                        <input type="text" name="pseudo" class="text-input defaultText required" /> 
                                    </div>
                                    <div class="form-row text-input-row email-field">
                                        <label>Email</label>
                                        <input type="text" name="email" class="text-input defaultText required email" /> 
                                    </div>
                                    <div class="form-row text-input-row subject-field">
                                        <label>Mot de passe</label>
                                        <input type="password" name="passe" class="text-input defaultText" /> 
                                    </div>
                                    <div class="form-row text-input-row subject-field">
                                        <label>Confirmer votre mot de passe</label>
                                        <input type="password" name="passe2" class="text-input defaultText" /> 
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
                    <!-- /.form-container -->
    </div>
                <!-- /.box -->
</section>
            <!-- /#contact -->