<section id="contact">
                <div class="box">
                    <h2 class="section-title">Me contacter</h2>
                    <p></p>
                    <div class="divide20"></div>
                    <div class="row text-center services-2">
                        <div class="col-md-3 col-sm-12"> <i class="budicon-map"></i>
                            <p>17 Place Saint-Pierre
                                <br /> 75018 PARIS</p>
                        </div>
                        <div class="col-md-3 col-sm-12"> <i class="budicon-telephone"></i>
                            <p>01 42 76 03 81</p>
                        </div>
                        <div class="col-md-3 col-sm-12"> <i class="budicon-mobile"></i>
                            <p>06 47 51 22 85</p>
                        </div>
                        <div class="col-md-3 col-sm-12"> <i class="budicon-mail"></i>
                            <p> <a class="nocolor" href="mailto:#">contact@philippetraon.com</a> </p>
                        </div>
                    </div>
                    <!-- /.services-2 -->
                    <div class="divide30"></div>
                    <div class="form-container">
                        <div class="response alert alert-success"></div>
                        <form class="forms" action="contact/form-handler.php" method="post">
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12">
                                        <div class="form-row text-input-row name-field">
                                            <label>Nom</label>
                                            <input type="text" name="name" class="text-input defaultText required" /> </div>
                                        <div class="form-row text-input-row email-field">
                                            <label>Email</label>
                                            <input type="text" name="email" class="text-input defaultText required email" /> </div>
                                        <div class="form-row text-input-row subject-field">
                                            <label>Objet</label>
                                            <input type="text" name="subject" class="text-input defaultText" /> </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12 lp5">
                                        <div class="form-row text-area-row">
                                            <label>Message</label>
                                            <textarea name="message" class="text-area required"></textarea>
                                        </div>
                                        <div class="form-row hidden-row">
                                            <input type="hidden" name="hidden" value="" /> </div>
                                        <div class="nocomment">
                                            <label for="nocomment">Laisser le champ libre</label>
                                            <input id="nocomment" value="" name="nocomment" /> </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="button-row pull-right">
                                            <input type="submit" value="Envoyer" name="submit" class="btn btn-submit bm0" /> </div>
                                    </div>
                                    <div class="col-sm-6 lp5">
                                        <div class="button-row pull-left">
                                            <input type="reset" value="Effacer" name="reset" class="btn btn-submit bm0" /> </div>
                                    </div>
                                    <input type="hidden" name="v_error" id="v-error" value="Required" />
                                    <input type="hidden" name="v_email" id="v-email" value="Enter a valid email" /> </div>
                            </fieldset>
                        </form>
                    </div>
                    <!-- /.form-container -->
                </div>
                <!-- /.box -->
            </section>
            <!-- /#contact -->