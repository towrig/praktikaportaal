
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

    <title>Praktikavahenduste keskkond | <?php echo $title; ?></title>

    <!-- Font Awesome Icons -->
    <link href="<?php echo $wwwroot; ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!--
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    -->

    <!-- Google Fonts -->
   <!-- 
    <link href="https://fonts.googleapis.com/css?family=Merriweather+Sans:400,700" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic' rel='stylesheet' type='text/css'>
    -->
    
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,300i,400,400i,500,500i,700,700i,900,900i&display=swap" rel="stylesheet">


    <!-- Plugin CSS -->
    <!--<link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">-->

    <!-- Theme CSS - Includes Bootstrap -->
    <link href="<?php echo $wwwroot; ?>css/creative.min.css" rel="stylesheet">

    <!-- Theme CSS - Includes Bootstrap -->
    <link href="<?php echo $wwwroot; ?>css/custom.css" rel="stylesheet">
    
     <link rel="stylesheet" href="<?php echo $wwwroot; ?>vendor/ui/jquery-ui.min.css">

</head>
