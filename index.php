<!DOCTYPE html>
<html>
    <?php
      $title="Tulevik algab Sinust! |";
      $description = "Futulab toob kokku üliõpilase, ülikooli ja organisatsiooni kogemused ja oskused, et olla parim tulevikutegija!";
      include_once './templates/header.php';
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
