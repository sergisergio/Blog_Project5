<section id="contact">
	<div class="box">
	<h2 class="section-title text-center">Mot de passe oublié</h2>
    <p></p>
        <div class="divide30"></div>
        <div class="form-container">
            <div class="response alert"></div>
            <form action="index.php?action=forgetPassword" method="POST">
    	<div class="col-md-offset-3 col-md-6 col-sm-12">
        	<div class="form-group">
            	<label for="">Email</label>
            	<input type="email" name="email" class="form-control"/>
        	</div>
    	</div>
        <div class="col-md-offset-3 col-md-6 col-sm-12">
        <button type="submit" class="btn btn-primary">Envoyer</button>
        </div>
        <input type="hidden" name="v_error" id="v-error" value="Required" />
        <input type="hidden" name="v_email" id="v-email" value="Enter a valid email" />
    </form>
</div>
</div>
</section>