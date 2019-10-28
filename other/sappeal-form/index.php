<?php
	$success = false;
	if(!empty($_POST)){
		$q1 = $_POST["age"];
		$q2 = $_POST["gender"];
		$q3 = implode(",", $_POST["what-do-you-understand-under-sexual-appeal"]);
		$q4 = $_POST["have-you-noticed-the-use-of-sexual-appeal-in-advertising"];
		$q5 = $_POST["how-often-do-you-see-sexual-appeal-in-advertisements-in-your-home-country"];
		$q6 = implode(",", $_POST["in-what-area-have-you-most-noticed-the-sexual-appeal"]);
		$q7 = $_POST["does-sexual-appeal-in-advertising-attracts-your-attention-to-the-product-or-service-being-advertised"];
		$q8 = $_POST["does-sexual-appeal-affect-your-behavior-in-any-way"];
		$q9 = implode(",", $_POST["what-kind-of-effect-does-sexual-appeal-have-on-you"]);
		$q10 = $_POST["would-you-buy-such-product-or-service-which-advertisement-contains-sexual-appeal"];
		$q11 = $_POST["using-sexual-appeal-is-a-good-way-to-promote-a-product/service"];
		$q12 = $_POST["sexuality-is-an-intimate-subject-and-should-not-be-publicly-displayed"];

		$p1_multiple = $_POST["pic-like-1"].','.$_POST["pic-appropriate-1"].','.$_POST["pic-sex-1"];
		$p1_choice = $_POST["pic-choose-1"];
		$p2_multiple = $_POST["pic-like-2"].','.$_POST["pic-appropriate-2"].','.$_POST["pic-sex-2"];
		$p2_choice = $_POST["pic-choose-2"];
		$p3_multiple = $_POST["pic-like-3"].','.$_POST["pic-appropriate-3"].','.$_POST["pic-sex-3"];
		$p3_choice = $_POST["pic-choose-3"];
		$p4_multiple = $_POST["pic-like-4"].','.$_POST["pic-appropriate-4"].','.$_POST["pic-sex-4"];
		$p4_choice = $_POST["pic-choose-4"];

		try {
			$conn = new PDO('mysql:host=localhost;dbname=china_data', 'root', 'Kilud123');
			// set the PDO error mode to exception
			$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			//echo "Connected to PDO successfully"; 
			$query = $conn->prepare('INSERT INTO Data(q1,q2,q3,q4,q5,q6,q7,q8,q9,q10,q11,q12,p1_multiple,p1_choice,p2_multiple,p2_choice,p3_multiple,p3_choice,p4_multiple,p4_choice) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);');
			$query->execute(array($q1,$q2,$q3,$q4,$q5,$q6,$q7,$q8,$q9,$q10,$q11,$q12,$p1_multiple,$p1_choice,$p2_multiple,$p2_choice,$p3_multiple,$p3_choice,$p4_multiple,$p4_choice));
			$success = true;
		}
		catch(PDOException $e){
			$error_code = $e->getCode();
			echo "Connection failed (code: $error_code): " . $e->getMessage();
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title>UT Sex appeal form</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
</head>
<body>

	<div class="main py-5">
		<div class="container">
			<div class="row">
				<p>Dear questionnaire respondent!<br><br>
				What do you think about advertisements that express sexuality? What kind of feelings such ads create and how it affects behaviour for the purchase?<br><br>
				My name is Annaliisa Heinsalu and I study economics at University of Tartu which is located in Estonia. I invite you to participate in a survey to find out the effectiveness of sexual appeal in different cultures. The study looks at the cultures of North-East Asia (China) and Northern Europe (Estonia). This questionnaire is aimed at Chinese people aged 18-45, helping to identify Chinese attitudes towards ads with sexual image.<br><br>
				The questionnaire consists of simple closed questions that take about 5 minutes to complete. The survey is anonymous and the data collected is only used in a generalized form in the context of this study.<br><br>
				Thank you for your time and answers!
				</p>
			</div>
		</div>
	</div>

	<div class="alert alert-success" role="alert" style="display: none;">
		Thank you for participating!
	</div>

	<div class="form-container bg-light">
		<div class="container">
		
			<div class="row">
				
				<div class="col-md-8">
					<form target="_self" method="post">
					  <div class="form-group">
					    <label for="age">Your age</label> 
					    <input id="age" name="age" placeholder="Enter age" type="text" required="required" class="form-control">
					  </div>
					  <div class="form-group">
					    <label>Your gender</label> 
					    <div>
					      <div class="custom-control custom-radio custom-control-inline">
					        <input name="gender" id="gender_0" type="radio" required="required" class="custom-control-input" value="male"> 
					        <label for="gender_0" class="custom-control-label">Male</label>
					      </div>
					      <div class="custom-control custom-radio custom-control-inline">
					        <input name="gender" id="gender_1" type="radio" required="required" class="custom-control-input" value="female"> 
					        <label for="gender_1" class="custom-control-label">Female</label>
					      </div>
					    </div>
					  </div>
					  <div class="form-group">
					    <label>What do you understand under sexual appeal?</label> 
					    <div>
					      <div class="custom-controls-stacked">
					        <div class="custom-control custom-checkbox">
					          <input name="what-do-you-understand-under-sexual-appeal[]" id="what-do-you-understand-under-sexual-appeal_0" type="checkbox" class="custom-control-input" value="being flirtatious"> 
					          <label for="what-do-you-understand-under-sexual-appeal_0" class="custom-control-label">Being flirtatious</label>
					        </div>
					      </div>
					      <div class="custom-controls-stacked">
					        <div class="custom-control custom-checkbox">
					          <input name="what-do-you-understand-under-sexual-appeal[]" id="what-do-you-understand-under-sexual-appeal_1" type="checkbox" class="custom-control-input" value="kissing"> 
					          <label for="what-do-you-understand-under-sexual-appeal_1" class="custom-control-label">Kissing</label>
					        </div>
					      </div>
					      <div class="custom-controls-stacked">
					        <div class="custom-control custom-checkbox">
					          <input name="what-do-you-understand-under-sexual-appeal[]" id="what-do-you-understand-under-sexual-appeal_2" type="checkbox" class="custom-control-input" value="hugging"> 
					          <label for="what-do-you-understand-under-sexual-appeal_2" class="custom-control-label">Hugging</label>
					        </div>
					      </div>
					      <div class="custom-controls-stacked">
					        <div class="custom-control custom-checkbox">
					          <input name="what-do-you-understand-under-sexual-appeal[]" id="what-do-you-understand-under-sexual-appeal_3" type="checkbox" class="custom-control-input" value="any contact with the opposite sex"> 
					          <label for="what-do-you-understand-under-sexual-appeal_3" class="custom-control-label">Any contact with the opposite sex</label>
					        </div>
					      </div>
					      <div class="custom-controls-stacked">
					        <div class="custom-control custom-checkbox">
					          <input name="what-do-you-understand-under-sexual-appeal[]" id="what-do-you-understand-under-sexual-appeal_4" type="checkbox" class="custom-control-input" value="sensual body language"> 
					          <label for="what-do-you-understand-under-sexual-appeal_4" class="custom-control-label">Sensual body language</label>
					        </div>
					      </div>
					      <div class="custom-controls-stacked">
					        <div class="custom-control custom-checkbox">
					          <input name="what-do-you-understand-under-sexual-appeal[]" id="what-do-you-understand-under-sexual-appeal_5" type="checkbox" class="custom-control-input" value="any level of nudity"> 
					          <label for="what-do-you-understand-under-sexual-appeal_5" class="custom-control-label">Any level of nudity</label>
					        </div>
					      </div>
					      <div class="custom-controls-stacked">
					        <div class="custom-control custom-checkbox">
					          <input name="what-do-you-understand-under-sexual-appeal[]" id="what-do-you-understand-under-sexual-appeal_6" type="checkbox" class="custom-control-input" value="sexually suggestive or provocative dressing manner"> 
					          <label for="what-do-you-understand-under-sexual-appeal_6" class="custom-control-label">Sexually suggestive or provocative dressing manner</label>
					        </div>
					      </div>
					      <div class="custom-controls-stacked">
					        <div class="custom-control custom-checkbox">
					          <input name="what-do-you-understand-under-sexual-appeal[]" id="what-do-you-understand-under-sexual-appeal_7" type="checkbox" class="custom-control-input" value="exposure of sensitive body parts"> 
					          <label for="what-do-you-understand-under-sexual-appeal_7" class="custom-control-label">Exposure of sensitive body parts</label>
					        </div>
					      </div>
					    </div>
					  </div>
					  <div class="form-group">
					    <label>Have you noticed the use of sexual appeal in advertising?</label> 
					    <div>
					      <div class="custom-control custom-radio custom-control-inline">
					        <input name="have-you-noticed-the-use-of-sexual-appeal-in-advertising" id="have-you-noticed-the-use-of-sexual-appeal-in-advertising_0" type="radio" class="custom-control-input" value="yes" required="required"> 
					        <label for="have-you-noticed-the-use-of-sexual-appeal-in-advertising_0" class="custom-control-label">Yes</label>
					      </div>
					      <div class="custom-control custom-radio custom-control-inline">
					        <input name="have-you-noticed-the-use-of-sexual-appeal-in-advertising" id="have-you-noticed-the-use-of-sexual-appeal-in-advertising_1" type="radio" class="custom-control-input" value="no" required="required"> 
					        <label for="have-you-noticed-the-use-of-sexual-appeal-in-advertising_1" class="custom-control-label">No</label>
					      </div>
					    </div>
					  </div>
					  <div class="form-group">
					    <label>How often do you see sexual appeal in advertisements in your home country?</label> 
					    <div>
					      <div class="custom-controls-stacked">
					        <div class="custom-control custom-radio">
					          <input name="how-often-do-you-see-sexual-appeal-in-advertisements-in-your-home-country" id="how-often-do-you-see-sexual-appeal-in-advertisements-in-your-home-country_0" type="radio" required="required" class="custom-control-input" value="not-at-all"> 
					          <label for="how-often-do-you-see-sexual-appeal-in-advertisements-in-your-home-country_0" class="custom-control-label">Not at all</label>
					        </div>
					      </div>
					      <div class="custom-controls-stacked">
					        <div class="custom-control custom-radio">
					          <input name="how-often-do-you-see-sexual-appeal-in-advertisements-in-your-home-country" id="how-often-do-you-see-sexual-appeal-in-advertisements-in-your-home-country_1" type="radio" required="required" class="custom-control-input" value="rarely"> 
					          <label for="how-often-do-you-see-sexual-appeal-in-advertisements-in-your-home-country_1" class="custom-control-label">Rarely</label>
					        </div>
					      </div>
					      <div class="custom-controls-stacked">
					        <div class="custom-control custom-radio">
					          <input name="how-often-do-you-see-sexual-appeal-in-advertisements-in-your-home-country" id="how-often-do-you-see-sexual-appeal-in-advertisements-in-your-home-country_2" type="radio" required="required" class="custom-control-input" value="often"> 
					          <label for="how-often-do-you-see-sexual-appeal-in-advertisements-in-your-home-country_2" class="custom-control-label">Often</label>
					        </div>
					      </div>
					      <div class="custom-controls-stacked">
					        <div class="custom-control custom-radio">
					          <input name="how-often-do-you-see-sexual-appeal-in-advertisements-in-your-home-country" id="how-often-do-you-see-sexual-appeal-in-advertisements-in-your-home-country_3" type="radio" required="required" class="custom-control-input" value="very-often"> 
					          <label for="how-often-do-you-see-sexual-appeal-in-advertisements-in-your-home-country_3" class="custom-control-label">Very often</label>
					        </div>
					      </div>
					    </div>
					  </div>
					  <div class="form-group">
					    <label>In what area have you most noticed the sexual appeal?</label> 
					    <div>
					      <div class="custom-controls-stacked">
					        <div class="custom-control custom-checkbox">
					          <input name="in-what-area-have-you-most-noticed-the-sexual-appeal[]" id="in-what-area-have-you-most-noticed-the-sexual-appeal_0" type="checkbox" class="custom-control-input" value="food"> 
					          <label for="in-what-area-have-you-most-noticed-the-sexual-appeal_0" class="custom-control-label">Food</label>
					        </div>
					      </div>
					      <div class="custom-controls-stacked">
					        <div class="custom-control custom-checkbox">
					          <input name="in-what-area-have-you-most-noticed-the-sexual-appeal[]" id="in-what-area-have-you-most-noticed-the-sexual-appeal_1" type="checkbox" class="custom-control-input" value="tobacco"> 
					          <label for="in-what-area-have-you-most-noticed-the-sexual-appeal_1" class="custom-control-label">Tobacco</label>
					        </div>
					      </div>
					      <div class="custom-controls-stacked">
					        <div class="custom-control custom-checkbox">
					          <input name="in-what-area-have-you-most-noticed-the-sexual-appeal[]" id="in-what-area-have-you-most-noticed-the-sexual-appeal_2" type="checkbox" class="custom-control-input" value="alcohol"> 
					          <label for="in-what-area-have-you-most-noticed-the-sexual-appeal_2" class="custom-control-label">Alcohol</label>
					        </div>
					      </div>
					      <div class="custom-controls-stacked">
					        <div class="custom-control custom-checkbox">
					          <input name="in-what-area-have-you-most-noticed-the-sexual-appeal[]" id="in-what-area-have-you-most-noticed-the-sexual-appeal_3" type="checkbox" class="custom-control-input" value="cosmetics"> 
					          <label for="in-what-area-have-you-most-noticed-the-sexual-appeal_3" class="custom-control-label">Clothing</label>
					        </div>
					      </div>
					      <div class="custom-controls-stacked">
					        <div class="custom-control custom-checkbox">
					          <input name="in-what-area-have-you-most-noticed-the-sexual-appeal[]" id="in-what-area-have-you-most-noticed-the-sexual-appeal_4" type="checkbox" class="custom-control-input" value="fragrance"> 
					          <label for="in-what-area-have-you-most-noticed-the-sexual-appeal_4" class="custom-control-label">Fragrance</label>
					        </div>
					      </div>
					      <div class="custom-controls-stacked">
					        <div class="custom-control custom-checkbox">
					          <input name="in-what-area-have-you-most-noticed-the-sexual-appeal[]" id="in-what-area-have-you-most-noticed-the-sexual-appeal_5" type="checkbox" class="custom-control-input" value="watches"> 
					          <label for="in-what-area-have-you-most-noticed-the-sexual-appeal_5" class="custom-control-label">Watches</label>
					        </div>
					      </div>
					      <div class="custom-controls-stacked">
					        <div class="custom-control custom-checkbox">
					          <input name="in-what-area-have-you-most-noticed-the-sexual-appeal[]" id="in-what-area-have-you-most-noticed-the-sexual-appeal_6" type="checkbox" class="custom-control-input" value="cars"> 
					          <label for="in-what-area-have-you-most-noticed-the-sexual-appeal_6" class="custom-control-label">Cars</label>
					        </div>
					      </div>
					    </div>
					  </div>
					  <div class="form-group">
					    <label>Does sexual appeal in advertising attracts your attention to the product or service being advertised?</label> 
					    <div>
					      <div class="custom-control custom-radio custom-control-inline">
					        <input name="does-sexual-appeal-in-advertising-attracts-your-attention-to-the-product-or-service-being-advertised" id="does-sexual-appeal-in-advertising-attracts-your-attention-to-the-product-or-service-being-advertised_0" type="radio" class="custom-control-input" value="yes" required="required"> 
					        <label for="does-sexual-appeal-in-advertising-attracts-your-attention-to-the-product-or-service-being-advertised_0" class="custom-control-label">Yes</label>
					      </div>
					      <div class="custom-control custom-radio custom-control-inline">
					        <input name="does-sexual-appeal-in-advertising-attracts-your-attention-to-the-product-or-service-being-advertised" id="does-sexual-appeal-in-advertising-attracts-your-attention-to-the-product-or-service-being-advertised_1" type="radio" class="custom-control-input" value="no" required="required"> 
					        <label for="does-sexual-appeal-in-advertising-attracts-your-attention-to-the-product-or-service-being-advertised_1" class="custom-control-label">No</label>
					      </div>
					    </div>
					  </div>
					  <div class="form-group">
					    <label>Does sexual appeal affect your behavior in any way?</label> 
					    <div>
					      <div class="custom-control custom-radio custom-control-inline">
					        <input name="does-sexual-appeal-affect-your-behavior-in-any-way" id="does-sexual-appeal-affect-your-behavior-in-any-way_0" type="radio" class="custom-control-input" value="yes" required="required"> 
					        <label for="does-sexual-appeal-affect-your-behavior-in-any-way_0" class="custom-control-label">Yes</label>
					      </div>
					      <div class="custom-control custom-radio custom-control-inline">
					        <input name="does-sexual-appeal-affect-your-behavior-in-any-way" id="does-sexual-appeal-affect-your-behavior-in-any-way_1" type="radio" class="custom-control-input" value="no" required="required"> 
					        <label for="does-sexual-appeal-affect-your-behavior-in-any-way_1" class="custom-control-label">No</label>
					      </div>
					    </div>
					  </div>
					  <div class="form-group">
					    <label>What kind of effect does sexual appeal have on you?</label> 
					    <div>
					      <div class="custom-controls-stacked">
					        <div class="custom-control custom-checkbox">
					          <input name="what-kind-of-effect-does-sexual-appeal-have-on-you[]" id="what-kind-of-effect-does-sexual-appeal-have-on-you_0" type="checkbox" class="custom-control-input" value="it-makes-me-feel-sexy"> 
					          <label for="what-kind-of-effect-does-sexual-appeal-have-on-you_0" class="custom-control-label">It makes me feel sexy</label>
					        </div>
					      </div>
					      <div class="custom-controls-stacked">
					        <div class="custom-control custom-checkbox">
					          <input name="what-kind-of-effect-does-sexual-appeal-have-on-you[]" id="what-kind-of-effect-does-sexual-appeal-have-on-you_1" type="checkbox" class="custom-control-input" value="it-makes-me-want-to-look-like-a-model-in-advertising"> 
					          <label for="what-kind-of-effect-does-sexual-appeal-have-on-you_1" class="custom-control-label">It makes me want to look like a model in advertising</label>
					        </div>
					      </div>
					      <div class="custom-controls-stacked">
					        <div class="custom-control custom-checkbox">
					          <input name="what-kind-of-effect-does-sexual-appeal-have-on-you[]" id="what-kind-of-effect-does-sexual-appeal-have-on-you_2" type="checkbox" class="custom-control-input" value="it-makes-me-want-the-product-being-advertised"> 
					          <label for="what-kind-of-effect-does-sexual-appeal-have-on-you_2" class="custom-control-label">It makes me want the product being advertised</label>
					        </div>
					      </div>
					      <div class="custom-controls-stacked">
					        <div class="custom-control custom-checkbox">
					          <input name="what-kind-of-effect-does-sexual-appeal-have-on-you[]" id="what-kind-of-effect-does-sexual-appeal-have-on-you_3" type="checkbox" class="custom-control-input" value="It gives me a positive emotion"> 
					          <label for="what-kind-of-effect-does-sexual-appeal-have-on-you_3" class="custom-control-label">It gives me a positive emotion</label>
					        </div>
					      </div>
					      <div class="custom-controls-stacked">
					        <div class="custom-control custom-checkbox">
					          <input name="what-kind-of-effect-does-sexual-appeal-have-on-you[]" id="what-kind-of-effect-does-sexual-appeal-have-on-you_4" type="checkbox" class="custom-control-input" value="it-draws-my-attention"> 
					          <label for="what-kind-of-effect-does-sexual-appeal-have-on-you_4" class="custom-control-label">It draws my attention</label>
					        </div>
					      </div>
					      <div class="custom-controls-stacked">
					        <div class="custom-control custom-checkbox">
					          <input name="what-kind-of-effect-does-sexual-appeal-have-on-you[]" id="what-kind-of-effect-does-sexual-appeal-have-on-you_5" type="checkbox" class="custom-control-input" value="it-makes-me-feel-unsexy"> 
					          <label for="what-kind-of-effect-does-sexual-appeal-have-on-you_5" class="custom-control-label">It makes me feel unsexy</label>
					        </div>
					      </div>
					      <div class="custom-controls-stacked">
					        <div class="custom-control custom-checkbox">
					          <input name="what-kind-of-effect-does-sexual-appeal-have-on-you[]" id="what-kind-of-effect-does-sexual-appeal-have-on-you_6" type="checkbox" class="custom-control-input" value="it-causes-me-embarrassment-and-discomfort"> 
					          <label for="what-kind-of-effect-does-sexual-appeal-have-on-you_6" class="custom-control-label">It causes me embarrassment and discomfort</label>
					        </div>
					      </div>
					      <div class="custom-controls-stacked">
					        <div class="custom-control custom-checkbox">
					          <input name="what-kind-of-effect-does-sexual-appeal-have-on-you[]" id="what-kind-of-effect-does-sexual-appeal-have-on-you_7" type="checkbox" class="custom-control-input" value="it-makes-me-despise-the-product-being-advertised"> 
					          <label for="what-kind-of-effect-does-sexual-appeal-have-on-you_7" class="custom-control-label">It makes me despise the product being advertised</label>
					        </div>
					      </div>
					      <div class="custom-controls-stacked">
					        <div class="custom-control custom-checkbox">
					          <input name="what-kind-of-effect-does-sexual-appeal-have-on-you[]" id="what-kind-of-effect-does-sexual-appeal-have-on-you_8" type="checkbox" class="custom-control-input" value="it-gives-me-a-negative-emotion"> 
					          <label for="what-kind-of-effect-does-sexual-appeal-have-on-you_8" class="custom-control-label">It gives me a negative emotion</label>
					        </div>
					      </div>
					      <div class="custom-controls-stacked">
					        <div class="custom-control custom-checkbox">
					          <input name="what-kind-of-effect-does-sexual-appeal-have-on-you[]" id="what-kind-of-effect-does-sexual-appeal-have-on-you_9" type="checkbox" class="custom-control-input" value="no-effect"> 
					          <label for="what-kind-of-effect-does-sexual-appeal-have-on-you_9" class="custom-control-label">No effect</label>
					        </div>
					      </div>
					    </div>
					  </div>
					  <div class="form-group">
					    <label>Would you buy such product or service which advertisement contains sexual appeal?</label> 
					    <div>
					      <div class="custom-controls-stacked">
					        <div class="custom-control custom-radio">
					          <input name="would-you-buy-such-product-or-service-which-advertisement-contains-sexual-appeal" id="would-you-buy-such-product-or-service-which-advertisement-contains-sexual-appeal_0" type="radio" required="required" class="custom-control-input" value="def-wont"> 
					          <label for="would-you-buy-such-product-or-service-which-advertisement-contains-sexual-appeal_0" class="custom-control-label">Definitely won't</label>
					        </div>
					      </div>
					      <div class="custom-controls-stacked">
					        <div class="custom-control custom-radio">
					          <input name="would-you-buy-such-product-or-service-which-advertisement-contains-sexual-appeal" id="would-you-buy-such-product-or-service-which-advertisement-contains-sexual-appeal_1" type="radio" required="required" class="custom-control-input" value="prob-wont"> 
					          <label for="would-you-buy-such-product-or-service-which-advertisement-contains-sexual-appeal_1" class="custom-control-label">Probably won't</label>
					        </div>
					      </div>
					      <div class="custom-controls-stacked">
					        <div class="custom-control custom-radio">
					          <input name="would-you-buy-such-product-or-service-which-advertisement-contains-sexual-appeal" id="would-you-buy-such-product-or-service-which-advertisement-contains-sexual-appeal_2" type="radio" required="required" class="custom-control-input" value="prob-will"> 
					          <label for="would-you-buy-such-product-or-service-which-advertisement-contains-sexual-appeal_2" class="custom-control-label">Probably will</label>
					        </div>
					      </div>
					      <div class="custom-controls-stacked">
					        <div class="custom-control custom-radio">
					          <input name="would-you-buy-such-product-or-service-which-advertisement-contains-sexual-appeal" id="would-you-buy-such-product-or-service-which-advertisement-contains-sexual-appeal_3" type="radio" required="required" class="custom-control-input" value="def-will"> 
					          <label for="would-you-buy-such-product-or-service-which-advertisement-contains-sexual-appeal_3" class="custom-control-label">Definitely will</label>
					        </div>
					      </div>
					    </div>
					  </div>
					  <div class="form-group">
					    <label>Using sexual appeal is a good way to promote a product/service.</label> 
					    <div>
					      <div class="custom-controls-stacked">
					        <div class="custom-control custom-radio">
					          <input name="using-sexual-appeal-is-a-good-way-to-promote-a-product/service" id="using-sexual-appeal-is-a-good-way-to-promote-a-product/service_0" type="radio" class="custom-control-input" value="strongly-disagree" required="required"> 
					          <label for="using-sexual-appeal-is-a-good-way-to-promote-a-product/service_0" class="custom-control-label">Strongly disagree</label>
					        </div>
					      </div>
					      <div class="custom-controls-stacked">
					        <div class="custom-control custom-radio">
					          <input name="using-sexual-appeal-is-a-good-way-to-promote-a-product/service" id="using-sexual-appeal-is-a-good-way-to-promote-a-product/service_1" type="radio" class="custom-control-input" value="disagree" required="required"> 
					          <label for="using-sexual-appeal-is-a-good-way-to-promote-a-product/service_1" class="custom-control-label">Disagree</label>
					        </div>
					      </div>
					      <div class="custom-controls-stacked">
					        <div class="custom-control custom-radio">
					          <input name="using-sexual-appeal-is-a-good-way-to-promote-a-product/service" id="using-sexual-appeal-is-a-good-way-to-promote-a-product/service_2" type="radio" class="custom-control-input" value="agree" required="required"> 
					          <label for="using-sexual-appeal-is-a-good-way-to-promote-a-product/service_2" class="custom-control-label">Agree</label>
					        </div>
					      </div>
					      <div class="custom-controls-stacked">
					        <div class="custom-control custom-radio">
					          <input name="using-sexual-appeal-is-a-good-way-to-promote-a-product/service" id="using-sexual-appeal-is-a-good-way-to-promote-a-product/service_3" type="radio" required="required" class="custom-control-input" value="strongly-agree"> 
					          <label for="using-sexual-appeal-is-a-good-way-to-promote-a-product/service_3" class="custom-control-label">Strongly agree</label>
					        </div>
					      </div>
					    </div>
					  </div>
					  <div class="form-group">
					    <label>Sexuality is an intimate subject and should not be publicly displayed.</label> 
					    <div>
					      <div class="custom-controls-stacked">
					        <div class="custom-control custom-radio">
					          <input name="sexuality-is-an-intimate-subject-and-should-not-be-publicly-displayed" id="sexuality-is-an-intimate-subject-and-should-not-be-publicly-displayed_0" type="radio" required="required" class="custom-control-input" value="strongly-disagree"> 
					          <label for="sexuality-is-an-intimate-subject-and-should-not-be-publicly-displayed_0" class="custom-control-label">Strongly disagree</label>
					        </div>
					      </div>
					      <div class="custom-controls-stacked">
					        <div class="custom-control custom-radio">
					          <input name="sexuality-is-an-intimate-subject-and-should-not-be-publicly-displayed" id="sexuality-is-an-intimate-subject-and-should-not-be-publicly-displayed_1" type="radio" required="required" class="custom-control-input" value="disagree"> 
					          <label for="sexuality-is-an-intimate-subject-and-should-not-be-publicly-displayed_1" class="custom-control-label">Disagree</label>
					        </div>
					      </div>
					      <div class="custom-controls-stacked">
					        <div class="custom-control custom-radio">
					          <input name="sexuality-is-an-intimate-subject-and-should-not-be-publicly-displayed" id="sexuality-is-an-intimate-subject-and-should-not-be-publicly-displayed_2" type="radio" required="required" class="custom-control-input" value="agree"> 
					          <label for="sexuality-is-an-intimate-subject-and-should-not-be-publicly-displayed_2" class="custom-control-label">Agree</label>
					        </div>
					      </div>
					      <div class="custom-controls-stacked">
					        <div class="custom-control custom-radio">
					          <input name="sexuality-is-an-intimate-subject-and-should-not-be-publicly-displayed" id="sexuality-is-an-intimate-subject-and-should-not-be-publicly-displayed_3" type="radio" required="required" class="custom-control-input" value="strongly-agree"> 
					          <label for="sexuality-is-an-intimate-subject-and-should-not-be-publicly-displayed_3" class="custom-control-label">Strongly agree</label>
					        </div>
					      </div>
					    </div>
					  </div> 

					  <!-- pictures -->
					  <h2 class="my-3">Picture assesment part:</h2>

					  <div class="form-group my-5 border rounded"> <!-- picture template -->

					  	<div style="width: 100%; text-align: center;">
					  		<span>1.</span>
					  		<img src="img/pic_1.jpg">
					  	</div>
					  	<div style="width: 100%; text-align: center;">
						  	<div style="width: 100%; text-align: center;">
						  		<span style="padding-right: 20px">I dislike this ad</span>
						  		<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="pic-like-1" id="pic-like-1-1" value="1" required="required">
								  <label class="form-check-label" for="pic-like-1-1">1</label>
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="pic-like-1" id="pic-like-1-2" value="2" required="required">
								  <label class="form-check-label" for="pic-like-1-2">2</label>
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="pic-like-1" id="pic-like-1-3" value="3" required="required">
								  <label class="form-check-label" for="pic-like-1-3">3</label>
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="pic-like-1" id="pic-like-1-4" value="4" required="required">
								  <label class="form-check-label" for="pic-like-1-4">4</label>
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="pic-like-1" id="pic-like-1-5" value="5" required="required">
								  <label class="form-check-label" for="pic-like-1-5">5</label>
								</div>
								<span style="padding-left: 20px">I like this ad</span>
						  	</div>

						  	<div style="width: 100%; text-align: center;">
						  		<span style="padding-right: 20px">It is inappropriate</span>
						  		<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="pic-appropriate-1" id="pic-appropriate-1-1" value="1" required="required">
								  <label class="form-check-label" for="pic-appropriate-1-1">1</label>
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="pic-appropriate-1" id="pic-appropriate-1-2" value="2" required="required">
								  <label class="form-check-label" for="pic-appropriate-1-2">2</label>
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="pic-appropriate-1" id="pic-appropriate-1-3" value="3" required="required">
								  <label class="form-check-label" for="pic-appropriate-1-3">3</label>
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="pic-appropriate-1" id="pic-appropriate-1-4" value="4" required="required">
								  <label class="form-check-label" for="pic-appropriate-1-4">4</label>
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="pic-appropriate-1" id="pic-appropriate-1-5" value="5" required="required">
								  <label class="form-check-label" for="pic-appropriate-1-5">5</label>
								</div>
								<span style="padding-left: 20px">It is appropriate</span>
						  	</div>

						  	<div style="width: 100%; text-align: center;">
						  		<span style="padding-right: 20px">Not sexual at all</span>
						  		<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="pic-sex-1" id="pic-sex-1-1" value="1" required="required">
								  <label class="form-check-label" for="pic-sex-1-1">1</label>
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="pic-sex-1" id="pic-sex-1-2" value="2" required="required">
								  <label class="form-check-label" for="pic-sex-1-2">2</label>
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="pic-sex-1" id="pic-sex-1-3" value="3" required="required">
								  <label class="form-check-label" for="pic-sex-1-3">3</label>
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="pic-sex-1" id="pic-sex-1-4" value="4" required="required">
								  <label class="form-check-label" for="pic-sex-1-4">4</label>
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="pic-sex-1" id="pic-sex-1-5" value="5" required="required">
								  <label class="form-check-label" for="pic-sex-1-5">5</label>
								</div>
								<span style="padding-left: 20px">Extremely sexual</span>
						  	</div>
						</div>
					  </div>

					  <div class="form-group row my-5 align-items-center border rounded">
					  	<div class="col-md-2">
					  		<label>1. I prefer this style of advertising:</label>
					  	</div>
					  	<div class="col-md-5" style="text-align: center;">
					  		<img src="img/pic_1.jpg" class="img-fluid">
						  	<div class="form-check form-check-inline">
							  <input class="form-check-input position-static" type="radio" name="pic-choose-1" id="pic-choose-1-1" value="1" required="required">
							</div>
						</div>
						<div class="col-md-5" style="text-align: center;">
							<img src="img/pic_2.jpg" class="img-fluid">
							<div class="form-check form-check-inline">
							  <input class="form-check-input position-static" type="radio" name="pic-choose-1" id="pic-choose-1-2" value="5" required="required">
							</div>
						</div>

					  </div>

					  <div class="form-group my-5 border rounded"> <!-- picture template -->

					  	<div style="width: 100%; text-align: center;">
					  		<span>2.</span>
					  		<img src="img/pic_3.jpg">
					  	</div>
					  	<div style="width: 100%; text-align: center;">
						  	<div style="width: 100%; text-align: center;">
						  		<span style="padding-right: 20px">I dislike this ad</span>
						  		<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="pic-like-2" id="pic-like-2-1" value="1" required="required">
								  <label class="form-check-label" for="pic-like-2-1">1</label>
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="pic-like-2" id="pic-like-2-2" value="2" required="required">
								  <label class="form-check-label" for="pic-like-2-2">2</label>
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="pic-like-2" id="pic-like-2-3" value="3" required="required">
								  <label class="form-check-label" for="pic-like-2-3">3</label>
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="pic-like-2" id="pic-like-2-4" value="4" required="required">
								  <label class="form-check-label" for="pic-like-2-4">4</label>
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="pic-like-2" id="pic-like-2-5" value="5" required="required">
								  <label class="form-check-label" for="pic-like-2-5">5</label>
								</div>
								<span style="padding-left: 20px">I like this ad</span>
						  	</div>

						  	<div style="width: 100%; text-align: center;">
						  		<span style="padding-right: 20px">It is inappropriate</span>
						  		<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="pic-appropriate-2" id="pic-appropriate-2-1" value="1" required="required">
								  <label class="form-check-label" for="pic-appropriate-2-1">1</label>
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="pic-appropriate-2" id="pic-appropriate-2-2" value="2" required="required">
								  <label class="form-check-label" for="pic-appropriate-2-2">2</label>
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="pic-appropriate-2" id="pic-appropriate-2-3" value="3" required="required">
								  <label class="form-check-label" for="pic-appropriate-2-3">3</label>
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="pic-appropriate-2" id="pic-appropriate-2-4" value="4" required="required">
								  <label class="form-check-label" for="pic-appropriate-2-4">4</label>
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="pic-appropriate-2" id="pic-appropriate-2-5" value="5" required="required">
								  <label class="form-check-label" for="pic-appropriate-2-5">5</label>
								</div>
								<span style="padding-left: 20px">It is appropriate</span>
						  	</div>

						  	<div style="width: 100%; text-align: center;">
						  		<span style="padding-right: 20px">Not sexual at all</span>
						  		<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="pic-sex-2" id="pic-sex-2-1" value="1" required="required">
								  <label class="form-check-label" for="pic-sex-2-1">1</label>
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="pic-sex-2" id="pic-sex-2-2" value="2" required="required">
								  <label class="form-check-label" for="pic-sex-2-2">2</label>
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="pic-sex-2" id="pic-sex-2-3" value="3" required="required">
								  <label class="form-check-label" for="pic-sex-2-3">3</label>
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="pic-sex-2" id="pic-sex-2-4" value="4" required="required">
								  <label class="form-check-label" for="pic-sex-2-4">4</label>
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="pic-sex-2" id="pic-sex-2-5" value="5" required="required">
								  <label class="form-check-label" for="pic-sex-2-5">5</label>
								</div>
								<span style="padding-left: 20px">Extremely sexual</span>
						  	</div>
						</div>
					  </div>

					  <div class="form-group row my-5 align-items-center border rounded">
					  	<div class="col-md-2">
					  		<label>2. I prefer this style of advertising:</label>
					  	</div>
					  	<div class="col-md-5" style="text-align: center;">
					  		<img src="img/pic_3.jpg" class="img-fluid">
						  	<div class="form-check form-check-inline">
							  <input class="form-check-input position-static" type="radio" name="pic-choose-2" id="pic-choose-2-1" value="1" required="required">
							</div>
						</div>
						<div class="col-md-5" style="text-align: center;">
							<img src="img/pic_4.jpg" class="img-fluid">
							<div class="form-check form-check-inline">
							  <input class="form-check-input position-static" type="radio" name="pic-choose-2" id="pic-choose-2-2" value="5" required="required">
							</div>
						</div>

					  </div>
					  <!-- done til here-->

					  <div class="form-group my-5 border rounded"> <!-- picture template -->

					  	<div style="width: 100%; text-align: center;">
					  		<span>3.</span>
					  		<img src="img/pic_5.png">
					  	</div>
					  	<div style="width: 100%; text-align: center;">
						  	<div style="width: 100%; text-align: center;">
						  		<span style="padding-right: 20px">I dislike this ad</span>
						  		<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="pic-like-3" id="pic-like-3-1" value="1" required="required">
								  <label class="form-check-label" for="pic-like-3-1">1</label>
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="pic-like-3" id="pic-like-3-2" value="2" required="required">
								  <label class="form-check-label" for="pic-like-3-2">2</label>
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="pic-like-3" id="pic-like-3-3" value="3" required="required">
								  <label class="form-check-label" for="pic-like-3-3">3</label>
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="pic-like-3" id="pic-like-3-4" value="4" required="required">
								  <label class="form-check-label" for="pic-like-3-4">4</label>
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="pic-like-3" id="pic-like-3-5" value="5" required="required">
								  <label class="form-check-label" for="pic-like-3-5">5</label>
								</div>
								<span style="padding-left: 20px">I like this ad</span>
						  	</div>

						  	<div style="width: 100%; text-align: center;">
						  		<span style="padding-right: 20px">It is inappropriate</span>
						  		<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="pic-appropriate-3" id="pic-appropriate-3-1" value="1" required="required">
								  <label class="form-check-label" for="pic-appropriate-3-1">1</label>
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="pic-appropriate-3" id="pic-appropriate-3-2" value="2" required="required">
								  <label class="form-check-label" for="pic-appropriate-3-2">2</label>
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="pic-appropriate-3" id="pic-appropriate-3-3" value="3" required="required">
								  <label class="form-check-label" for="pic-appropriate-3-3">3</label>
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="pic-appropriate-3" id="pic-appropriate-3-4" value="4" required="required">
								  <label class="form-check-label" for="pic-appropriate-3-4">4</label>
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="pic-appropriate-3" id="pic-appropriate-3-5" value="5" required="required">
								  <label class="form-check-label" for="pic-appropriate-3-5">5</label>
								</div>
								<span style="padding-left: 20px">It is appropriate</span>
						  	</div>

						  	<div style="width: 100%; text-align: center;">
						  		<span style="padding-right: 20px">Not sexual at all</span>
						  		<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="pic-sex-3" id="pic-sex-3-1" value="1" required="required">
								  <label class="form-check-label" for="pic-sex-3-1">1</label>
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="pic-sex-3" id="pic-sex-3-2" value="2" required="required">
								  <label class="form-check-label" for="pic-sex-3-2">2</label>
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="pic-sex-3" id="pic-sex-3-3" value="3" required="required">
								  <label class="form-check-label" for="pic-sex-3-3">3</label>
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="pic-sex-3" id="pic-sex-3-4" value="4" required="required">
								  <label class="form-check-label" for="pic-sex-3-4">4</label>
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="pic-sex-3" id="pic-sex-3-5" value="5" required="required">
								  <label class="form-check-label" for="pic-sex-3-5">5</label>
								</div>
								<span style="padding-left: 20px">Extremely sexual</span>
						  	</div>
						</div>
					  </div>

					  <div class="form-group row my-5 align-items-center border rounded">
					  	<div class="col-md-2">
					  		<label>3. I prefer this style of advertising:</label>
					  	</div>
					  	<div class="col-md-5" style="text-align: center;">
					  		<img src="img/pic_5.png" class="img-fluid">
						  	<div class="form-check form-check-inline">
							  <input class="form-check-input position-static" type="radio" name="pic-choose-3" id="pic-choose-3-1" value="1" required="required">
							</div>
						</div>
						<div class="col-md-5" style="text-align: center;">
							<img src="img/pic_6.jpg" class="img-fluid">
							<div class="form-check form-check-inline">
							  <input class="form-check-input position-static" type="radio" name="pic-choose-3" id="pic-choose-3-2" value="5" required="required">
							</div>
						</div>

					  </div>

					  <div class="form-group my-5 border rounded"> <!-- picture template -->

					  	<div style="width: 100%; text-align: center;">
					  		<span>4.</span>
					  		<img src="img/pic_7.jpg">
					  	</div>
					  	<div style="width: 100%; text-align: center;">
						  	<div style="width: 100%; text-align: center;">
						  		<span style="padding-right: 20px">I dislike this ad</span>
						  		<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="pic-like-4" id="pic-like-4-1" value="1" required="required">
								  <label class="form-check-label" for="pic-like-4-1">1</label>
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="pic-like-4" id="pic-like-4-2" value="2" required="required">
								  <label class="form-check-label" for="pic-like-4-2">2</label>
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="pic-like-4" id="pic-like-4-3" value="3" required="required">
								  <label class="form-check-label" for="pic-like-4-3">3</label>
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="pic-like-4" id="pic-like-4-4" value="4" required="required">
								  <label class="form-check-label" for="pic-like-4-4">4</label>
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="pic-like-4" id="pic-like-4-5" value="5" required="required">
								  <label class="form-check-label" for="pic-like-4-5">5</label>
								</div>
								<span style="padding-left: 20px">I like this ad</span>
						  	</div>

						  	<div style="width: 100%; text-align: center;">
						  		<span style="padding-right: 20px">It is inappropriate</span>
						  		<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="pic-appropriate-4" id="pic-appropriate-4-1" value="1" required="required">
								  <label class="form-check-label" for="pic-appropriate-4-1">1</label>
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="pic-appropriate-4" id="pic-appropriate-4-2" value="2" required="required">
								  <label class="form-check-label" for="pic-appropriate-4-2">2</label>
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="pic-appropriate-4" id="pic-appropriate-4-3" value="3" required="required">
								  <label class="form-check-label" for="pic-appropriate-4-3">3</label>
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="pic-appropriate-4" id="pic-appropriate-4-4" value="4" required="required">
								  <label class="form-check-label" for="pic-appropriate-4-4">4</label>
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="pic-appropriate-4" id="pic-appropriate-4-5" value="5" required="required">
								  <label class="form-check-label" for="pic-appropriate-4-5">5</label>
								</div>
								<span style="padding-left: 20px">It is appropriate</span>
						  	</div>

						  	<div style="width: 100%; text-align: center;">
						  		<span style="padding-right: 20px">Not sexual at all</span>
						  		<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="pic-sex-4" id="pic-sex-4-1" value="1" required="required">
								  <label class="form-check-label" for="pic-sex-2-1">1</label>
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="pic-sex-4" id="pic-sex-4-2" value="2" required="required">
								  <label class="form-check-label" for="pic-sex-2-2">2</label>
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="pic-sex-4" id="pic-sex-4-3" value="3" required="required">
								  <label class="form-check-label" for="pic-sex-2-3">3</label>
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="pic-sex-4" id="pic-sex-4-4" value="4" required="required">
								  <label class="form-check-label" for="pic-sex-2-4">4</label>
								</div>
								<div class="form-check form-check-inline">
								  <input class="form-check-input" type="radio" name="pic-sex-4" id="pic-sex-4-5" value="5" required="required">
								  <label class="form-check-label" for="pic-sex-2-5">5</label>
								</div>
								<span style="padding-left: 20px">Extremely sexual</span>
						  	</div>
						</div>
					  </div>

					  <div class="form-group row my-5 align-items-center border rounded">
					  	<div class="col-md-2">
					  		<label>2. I prefer this style of advertising:</label>
					  	</div>
					  	<div class="col-md-5" style="text-align: center;">
					  		<img src="img/pic_7.jpg" class="img-fluid">
						  	<div class="form-check form-check-inline">
							  <input class="form-check-input position-static" type="radio" name="pic-choose-4" id="pic-choose-4-1" value="1" required="required">
							</div>
						</div>
						<div class="col-md-5" style="text-align: center;">
							<img src="img/pic_8.jpg" class="img-fluid">
							<div class="form-check form-check-inline">
							  <input class="form-check-input position-static" type="radio" name="pic-choose-4" id="pic-choose-4-2" value="5" required="required">
							</div>
						</div>
					  </div>

					  <div class="form-group">
					    <button name="submit" type="submit" class="btn btn-primary">Submit</button>
					  </div>
					</form>
				</div>

			</div>

		</div>
	</div>

	<script src="js/jquery-3.3.1.min.js"></script>
	<script type="javascript">
		$(document).ready(function(){

			var completed = <?php echo $success; ?>;
			if(completed == 1){
				$('.alert').css('display','block');
				$('.form-container').css('display', 'none');
			}

		});
	</script>

</body>
</html>