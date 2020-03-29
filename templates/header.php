
<?php 
    // Load config.php in header.php for once only
    $CFG = new stdClass();
    $CFG->docroot = dirname(dirname(__FILE__)) . DIRECTORY_SEPARATOR;
    if (!is_readable($CFG->docroot . 'config.php')) {
        // If it is not readable then exit.
        exit;
    }
    require($CFG->docroot . 'config.php');
    $CFG = (object)array_merge((array)$cfg, (array)$CFG);
    $wwwroot = $CFG->wwwroot;

    $dbhost = $CFG->dbhost;
    $dbname = $CFG->dbname;
    $dbuser = $CFG->dbuser;
    $dbpassword = $CFG->dbpasswd;

?>
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <!-- Robots tag for blocking searcg engine web crawlers -->
    <meta name="robots" content="noindex">

    <title><?php echo $title; ?> Futulab</title>
    <meta property="og:title" content="<?php echo $title; ?> Futulab" />
    <meta property="og:type" content="website" />
    <?php
      $url =  "//{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
      $escaped_url = htmlspecialchars( $url, ENT_QUOTES, 'UTF-8' );
    ?>
    <meta property="og:url" content="http:<?php echo htmlspecialchars( $escaped_url, ENT_QUOTES, 'UTF-8' );?>" />
    <meta property="og:description" content="<?php echo $description; ?>">

    <meta property="og:image" content="<?php echo $wwwroot; ?>img/fb.png" />
    <meta property="og:image:type" content="image/png" />
    <meta property="og:image:width" content="930" />
    <meta property="og:image:height" content="452" />
    <meta property="og:image:alt" content="Futulab - Tulevik algab Sinust!" />

    <?php include './../functions.php'; ?>

    <?php
      $isanalytics = '["analytics"]';
      if(isset($_COOKIE['cookieControlPrefs']) && $_COOKIE['cookieControlPrefs'] == $isanalytics) {
         echo "<script>window['ga-disable-UA-155263552-1'] = false;</script>";
      } else {
        echo "<script>window['ga-disable-UA-155263552-1'] = true;</script>";
      }
    ?>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-155263552-1"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'UA-155263552-1', { 'anonymize_ip': true, 'cookie_prefix': 'futulab' });
    </script>

    <!-- Font Awesome Icons -->
    <link href="<?php echo $wwwroot; ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,300i,400,400i,500,500i,700,700i,900,900i&display=swap" rel="stylesheet">


    <!-- Plugin CSS -->
    <!--<link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">-->
    <!-- For profile img crop -->
    <link href="https://unpkg.com/cropperjs/dist/cropper.css" rel="stylesheet"/>
    <!-- AOS library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Theme CSS - Includes Bootstrap -->
    <link href="<?php echo $wwwroot; ?>css/creative.min.css" rel="stylesheet">

    <!-- Theme CSS - Includes Bootstrap -->
    <link href="<?php echo $wwwroot; ?>css/custom.css" rel="stylesheet">
    
    <link rel="stylesheet" href="<?php echo $wwwroot; ?>vendor/ui/jquery-ui.min.css">
    <link rel="stylesheet" href="<?php echo $wwwroot; ?>js/trumbowyg/ui/trumbowyg.min.css">

</head>
