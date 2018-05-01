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
    <!--<link rel="shortcut icon" href="#">-->
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
    <style>
        .tooltip {
            position: relative;
            float: right;
        }
        
        .tooltip > .tooltip-inner {
            background-color: #eebf3f;
            padding: 3px 15px;
            color: rgb(23, 44, 66);
            font-weight: bold;
            font-size: 13px;
        }
        
        .popOver + .tooltip > .tooltip-arrow {
            border-left: 5px solid transparent;
            border-right: 5px solid transparent;
            border-top: 5px solid #eebf3f;
        }
        
        .progress {
            border-radius: 0;
            overflow: visible;
            border: 1px solid #9cbc68;
            background: #000;
        }
        
        .progress-bar {
            background-color: #9cbc68 !important;
            -webkit-transition: width 1.5s ease-in-out !important;
            transition: width 1.5s ease-in-out !important;
        }
        .popover-title {
            background: #9cbc68;
            text-align: center;
        }
        .popover-content {
            padding: 9px 14px;
            color: #111;
            text-align: center;
        }
        .popover-content .btn {
            color: #111 !important;
            border: 1px solid #111;
        }
        input {
            background-color: rgba(30,30,31,0.85);
        }
    </style>
</head>

        <?= $content ?>
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
    <script>
        ////////// Simple usage //////////
        $(".popconfirm").popConfirm();

        ///////// Complete usage //////////

        // (example jquery click event)
        //$('#important_action').click(function() {
            //alert('You clicked, and valided this button !');
        //});

        // Full featured example
        $("[data-toggle='confirmation']").popConfirm({
            title: "Certain ?",
            content: "Dernière chance !",
            placement: "left",
            yesBtn: 'Oui',
          noBtn: 'Non'// (top, right, bottom, left)
        });
    </script>
</body>
</html>