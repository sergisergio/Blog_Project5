<?php $title = 'Mon portfolio'; ?>
<?php ob_start(); ?>

            <section id="home" class="naked">
                <div class="fullscreenbanner-container revolution">
                    <div class="fullscreenbanner">
                        <ul>
                            <li data-transition="fade">
                                <h1 class="tp-caption caption large sfb" data-x="center" data-y="center" data-voffset="-25" data-speed="900" data-start="1000" data-endspeed="100" data-easing="Sine.easeOut">Philippe Traon</h1>
                                <div class="tp-caption small tp-fade fadeout tp-resizeme" data-x="center" data-y="center" data-voffset="25" data-speed="100" data-start="1500" data-easing="Power4.easeOut" data-splitin="chars" data-splitout="chars" data-elementdelay="0.03" data-endelementdelay="0" data-endspeed="100" data-endeasing="Power1.easeOut" style="z-index: 3; max-width: auto; max-height: auto; white-space: nowrap;">Développeur web</div>
                                <div class="tp-caption small tp-fade fadeout tp-resizeme" data-x="center" data-y="center" data-voffset="75" data-speed="100" data-start="1500" data-easing="Power4.easeOut" data-splitin="chars" data-splitout="chars" data-elementdelay="0.03" data-endelementdelay="0" data-endspeed="100" data-endeasing="Power1.easeOut" style="z-index: 3; max-width: auto; max-height: auto; white-space: nowrap;">PHP / Symfony</div>
                                <div class="arrow smooth"><a href="#portfolio"><i class="icon-down-open-big"></i></a></div>
                            </li>
                        </ul>
                        <div class="tp-bannertimer"></div>
                    </div>
                </div>
            </section>
            <div class="container">
                <?php include "includes/section1_portfolio.php"; ?>
                <?php include "includes/section2_about.php"; ?>
                <?php include "includes/section3_skills.php"; ?>
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
                        <div class="divide30"></div>
                        <div class="form-container">
                            <div class="response alert alert-success"></div>
                                <?php include "forms/form_contact.php"; ?>
                        </div>
                    </div>
                </section>
                <?php include "includes/footer.php"; ?>
            </div>
        </div>
<?php $content = ob_get_clean(); ?>
<?php if(isset($_SESSION['pseudo']) && $_SESSION['color'] == 'aqua'): ?>
    <?php require('view/frontend/colortemplates/aquatemplate.php'); ?>
<?php elseif(isset($_SESSION['pseudo']) && $_SESSION['color'] == 'blue'): ?>
    <?php require('view/frontend/colortemplates/bluetemplate.php'); ?>
<?php elseif(isset($_SESSION['pseudo']) && $_SESSION['color'] == 'gray'): ?>
    <?php require('view/frontend/colortemplates/graytemplate.php'); ?>
<?php elseif(isset($_SESSION['pseudo']) && $_SESSION['color'] == 'orange'): ?>
    <?php require('view/frontend/colortemplates/orangetemplate.php'); ?>
<?php elseif(isset($_SESSION['pseudo']) && $_SESSION['color'] == 'pink'): ?>
    <?php require('view/frontend/colortemplates/pinktemplate.php'); ?>
<?php elseif(isset($_SESSION['pseudo']) && $_SESSION['color'] == 'aqua'): ?>
    <?php require('view/frontend/colortemplates/aquatemplate.php'); ?>
<?php elseif(isset($_SESSION['pseudo']) && $_SESSION['color'] == 'red'): ?>
    <?php require('view/frontend/colortemplates/redtemplate.php'); ?>
<?php elseif(isset($_SESSION['pseudo']) && $_SESSION['color'] == 'yellow'): ?>
    <?php require('view/frontend/colortemplates/yellowtemplate.php'); ?>
<?php else: ?>
    <?php require('template.php'); ?>
<?php endif; ?>