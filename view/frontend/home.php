<?php $title = 'Mon portfolio'; ?>
<?php ob_start(); ?>
    <body class="full-layout">
        <!--<div id="preloader"><div id="status"><div class="loadcircle"></div></div></div>-->
        <div class="body-wrapper">
            <?php include "includes/nav.php"; ?>
                <section id="home" class="naked">
                    <div class="fullscreenbanner-container revolution">
                        <div class="fullscreenbanner">
                            <ul>
                                <li data-transition="fade"> <!--<img src="public/images/dummy.png" alt="slidebg1" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="repeat" display="none;">-->
                                    <h1 class="tp-caption caption large sfb" data-x="center" data-y="center" data-voffset="-25" data-speed="900" data-start="1000" data-endspeed="100" data-easing="Sine.easeOut">Philippe Traon</h1>
                                    <div class="tp-caption small tp-fade fadeout tp-resizeme" data-x="center" data-y="center" data-voffset="25" data-speed="100" data-start="1500" data-easing="Power4.easeOut" data-splitin="chars" data-splitout="chars" data-elementdelay="0.03" data-endelementdelay="0" data-endspeed="100" data-endeasing="Power1.easeOut" style="z-index: 3; max-width: auto; max-height: auto; white-space: nowrap;">Développeur web</div>
                                    <div class="tp-caption small tp-fade fadeout tp-resizeme" data-x="center" data-y="center" data-voffset="75" data-speed="100" data-start="1500" data-easing="Power4.easeOut" data-splitin="chars" data-splitout="chars" data-elementdelay="0.03" data-endelementdelay="0" data-endspeed="100" data-endeasing="Power1.easeOut" style="z-index: 3; max-width: auto; max-height: auto; white-space: nowrap;">PHP / Symfony</div>
                                    <div class="arrow smooth"><a href="#portfolio"><i class="icon-down-open-big"></i></a></div>
                                </li>
                            </ul>
                            <div class="tp-bannertimer"></div>
                        </div>
                        <!-- /.fullscreenbanner -->
                    </div>
                    <!-- /.revolution -->
                </section>
                    <!-- /#home -->
                    <div class="container">
                        <?php include "includes/section1_portfolio.php"; ?>
                            <?php include "includes/section2_about.php"; ?>
                                <?php include "includes/section3_skills.php"; ?>
                                    <?php include "includes/section4_contact.php"; ?>
                                        <?php include "includes/footer.php"; ?>
                    </div>
                    <!-- /.container -->
        </div>
        <!-- /.body-wrapper -->
        
        <script src="public/js/jquery.min.js"></script>
    <script src="public/js/bootstrap.min.js"></script>
    <script src="public/js/jquery.themepunch.tools.min.js"></script>
    <script src="public/js/classie.js"></script>
    <script src="public/js/plugins.js"></script>
    <script src="public/js/scripts.js"></script>
    <script>
        $.backstretch(["public/images/art/react2.png"]);
    </script>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip({
                trigger: 'manual'
            }).tooltip('show');
        });
        $(window).scroll(function () {
            if ($(window).scrollTop() > 2600) { // scroll down abit and get the action   
                $(".progress-bar").each(function () {
                    each_bar_width = $(this).attr('aria-valuenow');
                    $(this).width(each_bar_width + '%');
                });
            }
        });
    </script>
    <script>
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o), m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');
        ga('create', 'UA-101090553-1', 'auto');
        ga('send', 'pageview');
    </script>
</body>
    <?php $content = ob_get_clean(); ?>

    <?php require('template.php'); ?>