<!DOCTYPE html>
<?php
$t_pieces = t(array("privacy_title","privacy1","privacy2","privacy3","privacy_h1","privacy1_li1","privacy1_li2", "privacy1_li3","privacy1_li4","privacy_h2","privacy2.1","privacy2_li1","privacy2_li2","privacy2_li3", "privacy2_li4","privacy2.2","privacy_h3","privacy3.1","privacy3.2","privacy_h4","privacy4.1", "privacy_h5","privacy5.1","privacy5_li1","privacy5_li2",
    "privacy5.2","privacy5.3","privacy_h6", "privacy6.1", "privacy6_th1", "privacy6_li1", "privacy6_li2", "privacy6.2","privacy6.3","privacy6.4", "privacy6_th2", "privacy6_th3","privacy6_tr1.1","privacy6_tr1.2","privacy6_tr1.3","privacy6_tr2.1","privacy6_tr2.2","privacy6_tr2.3","privacy6_tr3.1","privacy6_tr3.2","privacy6_tr3.3","privacy6_tr4.1",
    "privacy6_tr4.2","privacy6_tr4.3","privacy6_tr5.1","privacy6_tr5.2","privacy6_tr5.3","privacy6_tr6.1", "privacy6_tr6.2","privacy6_tr6.3","privacy_h7","privacy7.1","privacy_h8","privacy8.1","privacy8.2"),$dbhost,$dbname,$dbuser,$dbpassword);
?>

<section id="privicy" class="page-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="text-uppercase font-weight-bold mb-3 mt-5 mb-3" data-aos="fade-right"><?php echo $t_pieces["privacy_title"];?></h1>
            </div>
            <div class="col-lg-12" data-aos="fade-right">
                <div data-aos="fade-down">
                    <p><?php echo $t_pieces["privacy1"];?></p>
                    <p><?php echo $t_pieces["privacy2"];?></p>
                    <p><?php echo $t_pieces["privacy3"];?></p>
                </div>
                <div data-aos="fade-down">
                    <h5 class="text-uppercase font-weight-bold mb-3 mt-5"><?php echo $t_pieces["privacy_h1"];?></h5>
                    <ul>
                        <li><?php echo $t_pieces["privacy1_li1"];?></li>
                        <li><?php echo $t_pieces["privacy1_li2"];?></li>
                        <li><?php echo $t_pieces["privacy1_li3"];?></li>
                        <li><?php echo $t_pieces["privacy1_li4"];?></li>
                    </ul>
                </div>

                <div data-aos="fade-down">
                    <h5 class="text-uppercase font-weight-bold mb-3 mt-5"><?php echo $t_pieces["privacy_h2"];?></h5>
                    <p><?php echo $t_pieces["privacy2.1"];?></p>
                    <ul>
                        <li><?php echo $t_pieces["privacy2_li1"];?></li>
                        <li><?php echo $t_pieces["privacy2_li2"];?></li>
                        <li><?php echo $t_pieces["privacy2_li3"];?></li>
                        <li><?php echo $t_pieces["privacy2_li4"];?></li>
                    </ul>
                    <p><?php echo $t_pieces["privacy2.2"];?></p>
                </div>

                <div data-aos="fade-down">
                    <h5 class="text-uppercase font-weight-bold mb-3 mt-5"><?php echo $t_pieces["privacy_h3"];?></h5>
                    <p><?php echo $t_pieces["privacy3.1"];?></p>
                    <p><?php echo $t_pieces["privacy3.2"];?></p>
                </div>

                <div data-aos="fade-down">
                    <h5 class="text-uppercase font-weight-bold mb-3 mt-5"><?php echo $t_pieces["privacy_h4"];?></h5>
                    <p><?php echo $t_pieces["privacy4.1"];?></p>
                </div>

                <div data-aos="fade-down">
                    <h5 class="text-uppercase font-weight-bold mb-3 mt-5"><?php echo $t_pieces["privacy_h5"];?></h5>
                    <p><?php echo $t_pieces["privacy5.1"];?></p>
                    <ul>
                        <li><?php echo $t_pieces["privacy5_li1"];?></li>
                        <li><?php echo $t_pieces["privacy5_li2"];?></li>
                    </ul>
                    <p><?php echo $t_pieces["privacy5.2"];?></p>
                    <p><?php echo $t_pieces["privacy5.3"];?></p>
                </div>

                <div data-aos="fade-down">
                    <h5 class="text-uppercase font-weight-bold mb-3 mt-5"><?php echo $t_pieces["privacy_h6"];?></h5>
                    <p><?php echo $t_pieces["privacy6.1"];?></p>
                    <ul>
                        <li><?php echo $t_pieces["privacy6_li1"];?></li>
                        <li><?php echo $t_pieces["privacy6_li2"];?></li>
                    </ul>
                    <p><?php echo $t_pieces["privacy6.2"];?></p>
                    <p><?php echo $t_pieces["privacy6.3"];?></p>
                    <p><?php echo $t_pieces["privacy6.4"];?></p>
                </div>
                <div data-aos="fade-down">
                    <h6 class="text-uppercase font-weight-bold my-3"><?php echo $t_pieces["privacy_h6.1"];?></h6>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tbody>
                            <thead class="thead-light ">
                            <tr>
                                <th scope="col"><?php echo $t_pieces["privacy6_th1"];?></th>
                                <th scope="col"><?php echo $t_pieces["privacy6_th2"];?></th>
                                <th scope="col"><?php echo $t_pieces["privacy6_th3"];?></th>
                            </tr>
                            </thead>
                            <tr>
                                <th scope="row"><?php echo $t_pieces["privacy6_tr1.1"];?></th>
                                <td><?php echo $t_pieces["privacy6_tr1.2"];?></td>
                                <td><?php echo $t_pieces["privacy6_tr1.3"];?></td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo $t_pieces["privacy6_tr2.1"];?></th>
                                <td><?php echo $t_pieces["privacy6_tr2.2"];?></td>
                                <td><?php echo $t_pieces["privacy6_tr2.3"];?></td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo $t_pieces["privacy6_tr3.1"];?></th>
                                <td><?php echo $t_pieces["privacy6_tr3.2"];?></td>
                                <td><?php echo $t_pieces["privacy6_tr3.3"];?></td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo $t_pieces["privacy6_tr4.1"];?></th>
                                <td><?php echo $t_pieces["privacy6_tr4.2"];?></td>
                                <td><?php echo $t_pieces["privacy6_tr4.3"];?></td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo $t_pieces["privacy6_tr5.1"];?></th>
                                <td><?php echo $t_pieces["privacy6_tr5.2"];?>
                                </td>
                                <td><?php echo $t_pieces["privacy6_tr5.3"];?>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row"><?php echo $t_pieces["privacy6_tr6.1"];?></th>
                                <td><?php echo $t_pieces["privacy6_tr6.2"];?></td>
                                <td><?php echo $t_pieces["privacy6_tr6.3"];?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div data-aos="fade-down">
                        <h5 class="text-uppercase font-weight-bold mb-3 mt-5"><?php echo $t_pieces["privacy_h7"];?></h5>
                        <p><?php echo $t_pieces["privacy7.1"];?></p>
                    </div>

                    <div data-aos="fade-down">
                        <h5 class="text-uppercase font-weight-bold mb-3 mt-5"><?php echo $t_pieces["privacy_h8"];?></h5>
                        <p><?php echo $t_pieces["privacy8.1"];?></p>
                        <p><?php echo $t_pieces["privacy8.2"];?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
