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
    <meta prefix="og: http://ogp.me/ns#" property="og:image" content="http://philippetraon.com/Web/images/ogimage.png" />
    <meta property="og:image:width" content="180" />
    <link rel="icon" type="image/ico" href="Web/images/Philippe.ico" />
    <title>Philippe Traon - Développeur web</title>
    <!-- Bootstrap core CSS -->
    <link href="Web/css/bootstrap.min.css" rel="stylesheet">
    <link href="Web/css/plugins.css" rel="stylesheet">
    <link href="Web/css/prettify.css" rel="stylesheet">
    <link href="Web/style.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="Web/css/color/green.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,800,700,600,500,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Libre+Baskerville:400,400italic' rel='stylesheet' type='text/css'>
    <link href="Web/type/fontello.css" rel="stylesheet">
    <link href="Web/type/budicons.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="style/js/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
      <![endif]-->
</head>

        <?php echo $content ?>
    <script src="Web/js/jquery.min.js"></script>
    <script src="Web/js/bootstrap.min.js"></script>
    <script src="Web/js/jquery.popconfirm.js"></script>
    <script src="Web/js/jquery.themepunch.tools.min.js"></script>
    <script src="Web/js/classie.js"></script>
    <script src="Web/js/plugins.js"></script>
    <!--<script src="public/js/scripts.js"></script>-->
    <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=duwupb31ji27dizkt7ys8otbzxe9i7o5tszs4iafqoxxp09h"></script>

    <script>
        $.backstretch(["Web/images/art/react2.png"]);
    </script>
    <!--<script>
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
    </script>-->
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
            placement: "top",
            yesBtn: 'Oui',
          noBtn: 'Non'// (top, right, bottom, left)
        });
    </script>
    <script type="text/javascript">
        tinymce.init({
            selector: "textarea",
            plugins: [
                "advlist autolink lists link image charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste"
            ],
            toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image"
        });
    </script>
</body>
</html>