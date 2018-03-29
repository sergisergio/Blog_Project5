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
    </style>
</head>

        <?= $content ?>
    
</html>