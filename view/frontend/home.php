<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <meta prefix="og: http://ogp.me/ns#" property="og:title" content="Philippe Traon | Développeur web" />
        <meta prefix="og: http://ogp.me/ns#" property="og:type" content="article" />
        <meta prefix="og: http://ogp.me/ns#" property="og:url" content="http://philippetraon.com/?42" />
        <meta prefix="og: http://ogp.me/ns#" property="og:image" content="http://philippetraon.com/public/images/ogimage.png" />
        <meta property="og:image:width" content="180" />
        <link rel="icon" type="image/ico" href="public/images/Philippe.ico" />
        <title>Philippe Traon - Développeur web</title>
        <!-- Bootstrap core CSS -->
        <link href="public/css/bootstrap.min.css" rel="stylesheet">
        <link href="public/css/plugins.css" rel="stylesheet">
        <link href="public/css/prettify.css" rel="stylesheet">
        <link href="public/style.css" rel="stylesheet">
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
        <link href="public/css/color/green.css" rel="stylesheet">
        <link href='http://fonts.googleapis.com/css?family=Raleway:400,800,700,600,500,300' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Libre+Baskerville:400,400italic' rel='stylesheet' type='text/css'>
        <link href="public/type/fontello.css" rel="stylesheet">
        <link href="public/type/budicons.css" rel="stylesheet">
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="style/js/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
          <![endif]-->
    </head>
    <body class="full-layout">
        <div id="preloader">
            <div id="status">
                <div class="loadcircle"></div>
            </div>
        </div>
        <div class="body-wrapper">
                        <?php require "includes/nav.php"; ?>
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
                <?php require "includes/section1_portfolio.php"; ?>
                <?php require "includes/section2_about.php"; ?>
                <?php require "includes/section3_skills.php"; ?>
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
                                <?php require "forms/form_contact.php"; ?>
                        </div>
                    </div>
                </section>
                <?php require "includes/footer.php"; ?>
            </div>
        </div>
        <script src="public/js/jquery.min.js"></script>
        <script src="public/js/bootstrap.min.js"></script>
        <script src="public/js/jquery.popconfirm.js"></script>
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
            $(".popconfirm").popConfirm();
            $("[data-toggle='confirmation']").popConfirm({
                title: "Certain ?",
                content: "Dernière chance !",
                placement: "left",
                yesBtn: 'Oui',
              noBtn: 'Non'
            });
        </script>
    </body>
</html>