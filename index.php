<!DOCTYPE html>
<html>
    <?php
    include_once './templates/header.php';

    $t_pieces = t(array("main_title", "main_desc"),$dbhost,$dbname,$dbuser,$dbpassword);
    $title = $t_pieces["main_title"];
    $description = $t_pieces["main_desc"];
    ?>
    <body>
        <?php include_once './templates/top-navbar.php';?>
        <!-- Masthead -->
        <?php include_once './templates/frontpage/frontpage-masthead.php';?>
        <!-- Why -->
        <?php include_once './templates/frontpage/frontpage-why.php';?>
        <!-- Activities -->
        <?php include_once './templates/frontpage/frontpage-activities.php';?>   
        <!-- Statistics -->
        <?php include_once './templates/frontpage/frontpage-stats.php';?>
        <!-- Unique -->    
        <?php include_once './templates/frontpage/frontpage-unique.php';?>
        <!-- Footer -->
        <?php include_once './templates/footer.php';?>
    </body>
</html>
