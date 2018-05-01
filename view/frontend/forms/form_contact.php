<form class="forms" action="contact/form-handler.php" method="post">
    <fieldset>
        <div class="row">
            <div class="col-md-6 col-sm-12">
                <div class="form-row text-input-row name-field">
                    <label>Nom</label>
                    <input type="text" name="name" class="text-input defaultText required" /> 
                </div>
                <div class="form-row text-input-row email-field">
                    <label>Email</label>
                    <input type="text" name="email" class="text-input defaultText required email" /> 
                </div>
                <div class="form-row text-input-row subject-field">
                    <label>Objet</label>
                    <input type="text" name="subject" class="text-input defaultText" /> 
                </div>
            </div>
            <div class="col-md-6 col-sm-12 lp5">
                <div class="form-row text-area-row">
                    <label>Message</label>
                    <textarea name="message" class="text-area required"></textarea>
                </div>
                <div class="form-row hidden-row">
                    <input type="hidden" name="hidden" value="" /> 
                </div>
                <div class="nocomment">
                    <label for="nocomment">Laisser le champ libre</label>
                    <input id="nocomment" value="" name="nocomment" /> 
                </div>
            </div>
            <div class="col-sm-6">
                <div class="button-row pull-right">
                    <input type="submit" value="Envoyer" name="submit" class="btn btn-submit bm0" /> 
                </div>
            </div>
            <div class="col-sm-6 lp5">
                <div class="button-row pull-left">
                    <input type="reset" value="Effacer" name="reset" class="btn btn-submit bm0" /> 
                </div>
            </div>
            <input type="hidden" name="v_error" id="v-error" value="Required" />
            <input type="hidden" name="v_email" id="v-email" value="Enter a valid email" /> 
        </div>
    </fieldset>
</form>