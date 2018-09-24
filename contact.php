<?php session_start();

//Define Variables


$name="";
$email="";
$message="";
$success="";

$name_error="";
$email_error="";
$message_error="";
$captcha_error="";

$FormVaild = True; 



if(isset($_POST['submit'])){


	if(empty($_POST["name"])) {
		$name_error = "Name is required";
		$FormVaild = False; 
	} else {
		$name=test_input($_POST["name"]);
		//check is name only contains letters and whitespace
		if(!preg_match("/^[a-zA-Z ]*$/", $name)){
			$name_error="Only Letters allowed";
			$FormVaild = False; 
		}
	}

	if(empty($_POST["email"])) {
		$email_error = "Email is required";
		$FormVaild = False; 
	} else {
		$email=test_input($_POST["email"]);
		//check is email is well formed
				if(!filter_var($email,FILTER_VALIDATE_EMAIL))
				{
					$email_error="Invalid email format";
					$FormVaild = False; 
				}
			}


	if(empty($_POST["message"])) {
			$message_error = "Please enter a message";
			$FormVaild = False; 
		} else {
			$message=test_input($_POST["message"]);	
		}


////Captcha Code

		//include_once $_SERVER['DOCUMENT_ROOT'] . '/test/securimage/securimage.php';
		include_once $_SERVER['DOCUMENT_ROOT'] . '/securimage/securimage.php';

		$securimage = new Securimage();


		if ($securimage->check($_POST['captcha_code']) == false) {
		  // the code was incorrect
		  // you should handle the error so that the form processor doesn't continue

	
		 $FormVaild = False; 
		 $captcha_error= "The code entered was incorrect";
		 
		}



if($FormVaild == True ) {




$name=$_POST['name'];
$email=$_POST['email'];
$message=$_POST['message'];

  //send mail 
 $to='info@socratessolutions.ie';
 $subject='Socrates Website Query';
 $body='<html>
 <body>
 <h3>Socrates Website Contact Form:</h3>
 <hr>

 <p> Name : '.$name.'</p>
 <br>

 <p> Email : '.$email.'</p>

 <p> Message : '.$message.'</p>

 </body>

 </html>';

 $headers  ="From:".$name."<".$email.">\r\n";
 $headers .="reply-To:".$email."\r\n";
 $headers .="NINE-Version: 1.0\r\n";
 $headers .="Content-type: text/html; charset=utf-8";



//confirmation mail
 //$user=$email;
 //$usersubject = "Socrates Website Query Confirmation";
 //$userheaders = "From: ruairimufc@gmail.com\n";
 //$usermessage = "Thank you for contacting Socrates. We will be in touch.";



//sending process
 $send=mail($to, $subject, $body, $headers);
 //$confirm=mail($user, $usersubject, $userheaders,$usermessage );

 if($send){
 
  $success="Thank you for contacting Socrates. We will be in touch";
  $name = $email = $message='';
 }

 else{
  echo "Failed";

}

}

}


function test_input($data) {
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}


?>
	

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <link rel="icon" href="./soc_fav.ico" type="image/x-icon" />
        <link rel="shortcut icon" href="./soc_fav.ico" type="image/x-icon" />
		<title>Contact - Socrates Solutions</title>

		<!-- Google font -->
		<link href="https://fonts.googleapis.com/css?family=Lato:700%7CMontserrat:400,600" rel="stylesheet">

		<!-- Bootstrap -->
		<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css"/>

		<!-- Font Awesome Icon -->
		<link rel="stylesheet" href="css/font-awesome.min.css">

		<!-- Custom stlylesheet -->
		<link type="text/css" rel="stylesheet" href="css/style.css"/>

		 <!--font awesome 5-->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.1/css/all.css" integrity="sha384-O8whS3fhG2OnA5Kas0Y9l3cfpmYjapjI0E4theH4iuMD+pLhbf6JI0jIMfYcK3yZ" crossorigin="anonymous">

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
        <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
        <link rel="icon" href="/favicon.ico" type="image/x-icon">
    </head>
	<body>

		<!-- Header -->
		<header id="header">
			<div class="container">

				<div class="navbar-header">
					<!-- Logo -->
					<div class="navbar-brand">
						<a class="logo" href="index.html">
							<img src="./img/logo-alt.png" alt="logo">
						</a>
					</div>
					<!-- /Logo -->

					<!-- Mobile toggle -->
					<button class="navbar-toggle">
						<span></span>
					</button>
					<!-- /Mobile toggle -->
				</div>

				<!-- Navigation -->
				<nav id="nav">
                <ul class="main-menu nav navbar-nav navbar-right">
                    <li><a href="index.html">Home</a></li>
                    <li><a href="meet_the_team.html">Meet the Team</a></li>
                    <li><a href="courses.html">Courses</a></li>
                    <li><a href="survey.html">Survey</a></li>
                    <li><a href="contact.html">Contact</a></li>
                </ul>
            </nav>
				<!-- /Navigation -->

			</div>
		</header>
		<!-- /Header -->

		<!-- Hero-area -->
		<div class="hero-area section">

			<!-- Backgound Image -->
			<div class="bg-image bg-parallax overlay" style="background-image:url(./img/page-background.jpg)"></div>
			<!-- /Backgound Image -->

			<div class="container">
				<div class="row">
					<div class="col-md-10 col-md-offset-1 text-center">
						<ul class="hero-area-tree">
							<li><a href="index.html">Home</a></li>
							<li>Contact</li>
						</ul>
						<h1 class="white-text">Get In Touch</h1>

					</div>
				</div>
			</div>

		</div>
		<!-- /Hero-area -->

		<!-- Contact -->
		<div id="contact" class="section">

			<!-- container -->
			<div class="container">

				<!-- row -->
				<div class="row">

					<!-- contact form -->
					<div class="col-md-6">
						<div class="contact-form">
							<span  style=" color: #63b549; font-size: 20px; font-weight: bold;"><?= $success ?></span>
							<h4>Send A Message</h4>
							<p>Please complete the form below and one of our team will repsond to your query</p>
							<form name="Contact_Form" method="post" action="">

							<!--
								<input class="input" type="text" name="name" placeholder="Name">
								<input class="input" type="email" name="email" placeholder="Email">
								<input class="input" type="text" name="subject" placeholder="Subject">
								<textarea class="input" name="message" placeholder="Please Enter your Message"></textarea>
								<button class="main-button icon-button pull-right">Send Message</button> -->

								<span  style="color:#AA0004;"><?= $name_error ?></span>
								<input class="input" type="text" name="name" placeholder="Name" value="<?= $name ?>">
								
								<span  style="color:#AA0004;"><?= $email_error ?></span>
                                <input  class="input" type="email" name="email" placeholder="Email" value="<?= $email ?>">
                                
                                <span  style="color:#AA0004;"><?= $message_error ?></span>
								<textarea class="input" name="message" placeholder="Please Enter your Message" value="<?= $message ?>"></textarea>
								

								

								<img id="captcha" src="./securimage/securimage_show.php" alt="CAPTCHA Image"  style="margin-bottom: 10px;" />

								<input type="text" name="captcha_code" size="10" maxlength="6" placeholder="Please Enter the code above" class="input" />
								<span  style="color:#AA0004;"><?= $captcha_error ?></span>
								<br>


							<a href="#" onclick="document.getElementById('captcha').src = './securimage/securimage_show.php?' + Math.random(); return false">[ Request  A Different Image ]</a>


							<br />

								<input  class="main-button icon-button pull-right" type="submit" name="submit" value="Send Message">

								
							</form>

						</div>
					</div>
					<!-- /contact form -->

					<!-- contact information -->
					<div class="col-md-5 col-md-offset-1">
						<h4>Contact Information</h4>
						<ul class="contact-details">
							<li><i class="fa fa-envelope"></i><a href="mailto:tommaher@socratessolutions.ie">tommaher@socratessolutions.ie</a></li>
                            <li><i class="fa fa-envelope"></i><a href="mailto:jameskearney@socratessolutions.ie">jameskearney@socratessolutions.ie</a></li>
                            <li><i class="fa fa-envelope"></i><a href="mailto:PaulComiskey@SocratesSolutions.ie">PaulComiskey@SocratesSolutions.ie</a></li>
							<li style="color: #374050;font-weight: 700;"><i class="fa fa-phone"></i>087 6836011</li>
							
						</ul>

						<!-- contact map -->
						<!--<div id="contact-map"></div>-->
						<!-- /contact map -->

					</div>
					<!-- contact information -->

				</div>
				<!-- /row -->

			</div>
			<!-- /container -->

		</div>
		<!-- /Contact -->

		<!-- Footer -->
		<footer id="footer" class="section">

            <!-- container -->
            <div class="container">

                <!-- row -->
                <div class="row">

                    <!-- footer logo -->
                    <div class="col-md-6">
                        <div class="footer-logo">
                            <a class="logo" href="index.html">
                                <img src="./img/logo.png" alt="logo">
                            </a>
                        </div>
                    </div>
                    <!-- footer logo -->
                    <!-- footer nav -->
                    <div class="col-md-6">
                        <ul class="footer-nav">
                            <li><a href="index.html">Home</a></li>
                            <li><a href="meet_the_team.html">Meet The team</a></li>
                            <li><a href="courses.html">Courses</a></li>
                            <li><a href="survey.html">Survey</a></li>
                            <li><a href="contact.html">Contact</a></li>
                        </ul>
                    </div>
                    <!-- /footer nav -->

                </div>
                <!-- /row -->
                <!-- row -->
                <div id="bottom-footer" class="row">


                    <div class="col-md-4 col-md-push-8">

                        <p><a class="main-button icon-button" href="privacy_policy.html" style="font-size:13px;">Privacy Policy</a> </p>
                    </div>
                    <!-- /social -->
                    <!-- copyright -->
                    <div class="col-md-8 col-md-pull-4">
                        <div class="footer-copyright">
                            <span>&copy; Copyright 2018. All Rights Reserved. | This template is made by <a href="https://colorlib.com">Colorlib</a></span>
                            <br />
                            <span style="font-size:13px;">Supported by LEO Westmeath - <a target="_blank" href="pdf/LEO.pdf">click here</a> for more information</span>

                        </div>
                    </div>
                    <!-- /copyright -->

                </div>
                <!-- row -->

            </div>
            <!-- /container -->

        </footer>
		<!-- /Footer -->

		<!-- preloader -->
		
		<!-- /preloader -->


		<!-- jQuery Plugins -->
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
		<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
		<script type="text/javascript" src="js/google-map.js"></script>
		<script type="text/javascript" src="js/main.js"></script>

	</body>
</html>
