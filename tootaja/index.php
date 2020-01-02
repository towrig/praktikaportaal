<!DOCTYPE html>
<html lang="en">
<?php $title="Praktikapakkumised"; include_once './../templates/header.php';?>
<body id="page-top" class="practiceoffers">
    <?php include_once './../templates/top-navbar.php';?>
    <div id="main"></div>
    <div id="page-content">
      <section class="page-section">
        <div class="container">
          <div class="row">
            <div class="col-lg-12">
               <h1 class="text-uppercase font-weight-bold mt-5 mb-3">Praktikapakkumised</h1>
            </div>
            <div class="col-lg-4">
              <p class="font-weight-light mb-5">Otsid praktikanti, töötajat või meeskonda? Lisa oma pakkumine või projektiidee juba täna!</p>
              <a href="#" class="text-uppercase font-weight-bold">Vaata rohkem siit!</a>
            </div> <!-- .col-->
            <div class="col-lg-2">
              <a href="../editor" id="formToggler" class="toggleMenu text-uppercase">Lisa pakkumine<!--<span class="tooltip_mark" data-toggle="tooltip" data-placement="right" title="Esitatud pakkumised aeguvad lõpptähtaja möödumisel">?</span>--></a>
            </div>
        <!--<div class="col-lg-3">
          <a href="../team" id="formToggler" class="toggleMenu btn-lg">ESITA PROJEKT<span class="tooltip_mark" data-toggle="tooltip" data-placement="right" title="Esitatud pakkumised aeguvad lõpptähtaja möödumisel">?</span></a>
        </div>-->
            <div class="col-lg-12">
              <h5 class="text-uppercase text-center font-weight-bold mt-3">Aktiivsed pakkumised</h5>
            </div>
          </div> <!-- .row -->
        </div> <!-- .container -->
      </section>

	
	<section id="profiles">
		<div class="container">
			<div class="row">
                <!--<div class="col-md-12 text-center">
                    <h2>Praktika- ja tööpakkumised</h2>
                </div>-->
                <div id="carouselPager" class="carousel slide">
                  <div class="carousel-inner">
                    <div class="carousel-item active">                    
                    <?php

                        try {
                            $conn = new PDO('mysql:host='.$dbhost.';dbname='.$dbname, $dbuser , $dbpassword);
                            // set the PDO error mode to exception
                            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $query = $conn->prepare('SELECT heading,description,validationcode,picturepath,work_location,datetime_uploaded FROM WorkPosts WHERE isvalidated = ?'); 
                            $query->execute(array(1));
                            $data = $query -> fetchAll();
                            $j = 0;
                            $max_per_page = 5;
                            $pages = 1;
                            $queue = false;
                            foreach($data as $row){
                                //currently unused cols: name,email,phone,tasks,experience,work_type,other,logopath
                                $heading = $row["heading"];
                                $description = $row["description"];
                                $validationcode = $row["validationcode"];
                                $picurl = "../userdata/pictures/".$row["picturepath"];

                                $location = $row["work_location"];
                                $uploaded = date('d\<\b\r\>M\<\b\r\>Y', strtotime($row["datetime_uploaded"]));;
                                
                                if($queue){
                                    echo '</div><div class="carousel-item">';
                                    $queue = false;
                                    $pages++;
                                }

                                $bigstring = '<div class="col-lg-12">
                                                <div class="row">
                                                  <div class="col-lg-1 text-uppercase font-weight-bold">
                                                    <p>'.$uploaded.'</p>
                                                  </div>
                                                    <div class="col-lg-2 work-banner-crop">
                                                      <img src="'.$picurl.'" alt="Ettevõtte logo">
                                                    </div>
                                                    <div class="col-lg-4">
                                                        <a href="../tootaja/kuulutus?c='.$validationcode.'">
                                                          <h6 class="text-uppercase font-weight-bold mt-0">'.$heading.'</h6>
                                                        </a>
                                                        <p class="m-0 p-0 card-text font-weight-light">'.$description.'</p>                                                          
                                                    </div>
                                                  <div class="col-lg-3">
                                                    <p class="m-0 p-0 font-weight-light"><b>Pakkuja:</b> PUUDU</p>
                                                    <p class="m-0 p-0 font-weight-light"><b>Asukoht:</b> '.$location.'</p>
                                                    <p class="m-0 p-0 font-weight-light"><b>Tähtaeg:</b> PUUDU</p>
                                                  </div>
                                                  <div class="col-lg-2 text-center apply">
                                                    <a class="text-uppercase font-weight-bold" href="../tootaja/kuulutus?c='.$validationcode.'">Kandideeri</a>
                                                    <p>Vaatamisi <span class="views font-weight-bold">PUUDU</span></p>
                                                  </div>
                                                </div>
                                                <hr>
                                              </div>';

                                echo $bigstring;
                                $j++;
                                if ($j == $max_per_page){
                                    $j = 0;
                                    $queue = true;
                                }
                            }

                        } catch(PDOException $e){
                            echo "Connection failed: " . $e->getMessage();
                        }
                    ?>
                    </div>
                  </div>
                </div>
                <nav aria-label="Pager">
                  <ul class="pagination justify-content-center">
                    <li class="page-item" data-index="prev">
                      <a class="page-link" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                        <span class="sr-only">Previous</span>
                      </a>
                    </li>
                    <?php
                      for($i=0; $i < $pages; $i++){
                          echo '<li class="page-item '.($i == 0 ? "active" : "").'" data-index="'.$i.'"><a class="page-link">'.($i+1).'</a></li>';
                      }
                    ?>
                    <li class="page-item" data-index="next">
                      <a class="page-link" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                        <span class="sr-only">Next</span>
                      </a>
                    </li>
                  </ul>
                </nav>

            </div>
		</div>
	</section>
	
	</div>

    <div id="main">
    </div>

    <!-- modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    	<div class="modal-dialog" role="document">
	    	<div class="modal-content">

	    		<div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLongTitle">Tudengi info</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
		      	</div>
			    <div class="modal-body">
			    	<div class="row">

			    		<div class="col-md-4">
			    			<div class="modal-image-container">
			    				<div class="modal-image"></div>
			    			</div>
			    		</div>
			    		<div class="col-md-8">
			    			<div class="modal-student-info">
			    				
			    			</div>
			    		</div>

			    		<div class="col-md-12 modal-student-description">
			    			<p>Soovitud praktika/töö valdkond:</p>
			    			<p class="modal-work diff-text"></p>
			    			<p>Tugevused/oskused:</p>
			    			<p class="modal-skills diff-text"></p>
			    			<p>Kogemused:</p>
			    			<p class="modal-experience diff-text"></p>
			    			<p>Soovitud asukoht:</p>
			    			<p class="modal-location diff-text"></p>
			    			<p>*Sotsmeedia link*</p>
			    		</div>
			    	</div>
			    </div>

	    	</div>
	    </div>
	</div>

    <!-- Footer -->
    <?php include_once './../templates/footer.php';?>

    <script type="text/javascript">
    	$(document).ready(function(){

    		$('.js-modal').on('click', openModal);
          
            $('[data-toggle="tooltip"]').tooltip();

    		$("#category").change(function(){

    			if($("#category").val() == "date"){
    				$("#date_order").show();
    				$("#locations").hide();
    			}else{
    				$("#date_order").hide();
    				$("#locations").show();
    			}
    		});
            
            $('.pagination .page-item').on('click', paginatorClick);
            $('#carouselPager').carousel({
                interval: false,
                wrap: false
            });
            $('#carouselPager').on('slide.bs.carousel', function(e){
                $('.pagination .page-item').eq(e.from+1).toggleClass('active');
                $('.pagination .page-item').eq(e.to+1).toggleClass('active');
            })

    	});
        
        function paginatorClick(e){
            console.log('moving');
            var carousel = $('#carouselPager');
            var target = $(e.currentTarget);
            var index = target.data('index');
            carousel.carousel(index);
        }

    	function openModal(e){
    		var target = $(e.currentTarget);
    		var modal = $('.modal').first();

    		var name = target.data('name');
    		var pic = target.data('pic');
    		var degree = target.data('degree');
    		var skills = target.data('skills');
    		var exp = target.data('experience');
    		var work = target.data('work');
    		var loc = target.data('loc');
    		var email = target.data('email');

    		$('.modal-image').css('background-image', 'url('+pic+')');
    		$('.modal-student-info').empty();
    		$('.modal-student-info').append("<p>"+name+"</p><p>"+degree+"</p><a href=mailto:"+email+">"+email+"</a>");
    		$('.modal-work').text(work);
    		$('.modal-skills').text(skills);
    		$('.modal-experience').text(exp);
    		$('.modal-location').text(loc);

    		modal.modal('show');
    		
    	}
    </script>

</body>

</html>
