<!DOCTYPE html>
<?php
$t_pieces = t(array("manual_title","manual_h1","manual1.1","manual1.2","manual1.3","manual1.4","manual_h2","manual2",
    "manual2_li1","manual2_li2","manual2_li3","manual2_li4","manual2.1","manual2.1_li1","manual2.1_li2","manual2.1_li3","manual2.1_li4",
    "manual2.1_li5","manual2.1_li6","manual3","manual4","manual2.2","manual2.2.1","manual2.3","manual2.3.1","manual2.4",
    "manual2.4.1","manual_h3","manual3.1","manual3.2","manual3.3","manual3.4","manual3.5","manual_h4","manual4.1","manual4.2",
    "manual4.3","manual4.4","manual_h5","manual5.1","manual5.2"),$dbhost,$dbname,$dbuser,$dbpassword);
?>

<section id="privicy" class="page-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="text-uppercase font-weight-bold mb-3 mt-5 mb-3" data-aos="fade-right"><?php echo $t_pieces["manual_title"];?></h1>
            </div>
            <div class="col-lg-12" data-aos="fade-right">
                <div data-aos="fade-down">
                    <h5 class="text-uppercase font-weight-bold my-3"><?php echo $t_pieces["manual_h1"];?></h5>
                    <p><?php echo $t_pieces["manual1.1"];?></p>
                    <p><?php echo $t_pieces["manual1.2"];?></p>
                    <p><?php echo $t_pieces["manual1.3"];?></p>
                    <p><?php echo $t_pieces["manual1.4"];?></p>

                </div>
                <div data-aos="fade-down">
                    <h5 class="text-uppercase font-weight-bold mb-3 mt-5"><?php echo $t_pieces["manual_h2"];?></h5>
                    <p><?php echo $t_pieces["manual2"];?></p>
                    <ul>
                        <li><?php echo $t_pieces["manual2_li1"];?></li>
                        <li><?php echo $t_pieces["manual2_li2"];?></li>
                        <li><?php echo $t_pieces["manual2_li3"];?></li>
                        <li><?php echo $t_pieces["manual2_li4"];?></li>
                    </ul>
                </div>

                <div data-aos="fade-down">
                    <p><?php echo $t_pieces["manual2.1"];?></p>
                    <ul>
                        <li><?php echo $t_pieces["manual2.1_li1"];?></li>
                        <li><?php echo $t_pieces["manual2.1_li2"];?></li>
                        <li><?php echo $t_pieces["manual2.1_li3"];?></li>
                        <li><?php echo $t_pieces["manual2.1_li4"];?></li>
                        <li><?php echo $t_pieces["manual2.1_li5"];?></li>
                        <li><?php echo $t_pieces["manual2.1_li6"];?></li>

                    </ul>
                    <p><?php echo $t_pieces["manual3"];?></p>
                    <p><?php echo $t_pieces["manual4"];?></p>
                </div>

                <div data-aos="fade-down">
                    <p><?php echo $t_pieces["manual2.2"];?></p>

                    <p><?php echo $t_pieces["manual2.2.1"];?></p>
                </div>
                <div data-aos="fade-down">

                    <p><?php echo $t_pieces["manual2.3"];?></p>

                    <p><?php echo $t_pieces["manual2.3.1"];?></p>
                </div>
                <div data-aos="fade-down">
                    <p><?php echo $t_pieces["manual2.4"];?></p>

                    <p><?php echo $t_pieces["manual2.4.1"];?></p>
                </div>


                <div data-aos="fade-down">
                    <h5 class="text-uppercase font-weight-bold mb-3 mt-5"><?php echo $t_pieces["manual_h3"];?></h5>
                    <p><?php echo $t_pieces["manual3.1"];?></p>
                    <p><?php echo $t_pieces["manual3.2"];?></p>
                    <p><?php echo $t_pieces["manual3.3"];?></p>
                    <p><?php echo $t_pieces["manual3.4"];?></p>
                    <p><?php echo $t_pieces["manual3.5"];?></p>
                </div>

                <div data-aos="fade-down">
                    <h5 class="text-uppercase font-weight-bold mb-3 mt-5"><?php echo $t_pieces["manual_h4"];?></h5>
                    <p><?php echo $t_pieces["manual4.1"];?></p>
                    <p><?php echo $t_pieces["manual4.2"];?></p>
                    <p><?php echo $t_pieces["manual4.3"];?></p>
                    <p><?php echo $t_pieces["manual4.4"];?></p>
                </div>

                <div data-aos="fade-down">

                    <h5 class="text-uppercase font-weight-bold mb-3 mt-5"><?php echo $t_pieces["manual_h5"];?></h5>
                    <p><?php echo $t_pieces["manual5.1"];?></p>
                    <p><?php echo $t_pieces["manual5.2"];?></p>
                </div>
            </div>
        </div>
    </div>
</section>
