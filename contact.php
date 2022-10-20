
<?php
if(isset($_POST['submit']))
{
$name =	$_POST['name'];
$email =$_POST['email'];
$subject =$_POST['subject'];
$comments =$_POST['comments'];
$to = 'gisfy@gmail.com';
$headers = "From: $name<$email>";
$message = "Name:$name\n\n Email: $email\n\n Subject: $subject\n\n Comments: $comments\n\n";
if (mail($to,$subject,$message,$headers))
{
	echo "mail sent";
}	
else
{
	echo "try again";
}
}
?>
<!DOCTYPE php>

<head>
							<?php
								include("includes/link.php");
							?>
</head>
<body class="cnt-home">  
							<?php
								include("includes/header.php");
							?>



<!-- ==================================  start ==================================== -->





<div class="body-content" >
	<div class="container" style="height:100%;">
    <div class="contact-page">
		<div class="row">
			
				<div class="col-md-12 contact-map outer-bottom-vs">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d224346.61368048817!2d77.06889969034492!3d28.52721814399746!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390cfd5b347eb62d%3A0x52c2b7494e204dce!2sNew+Delhi%2C+Delhi!5e0!3m2!1sen!2sin!4v1493650101982" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
				</div>
				<div class="col-md-9 contact-form">
				
				
	<div class="col-md-12 contact-title">
		<h4>Contact Form</h4>
	</div>
	<form class="register-form" role="form" method="POST">
	<div class="col-md-4 ">
		
			<div class="form-group">
		    <label class="info-title" for="exampleInputName">Your Name <span>*</span></label>
		    <input type="text" class="form-control unicase-form-control text-input" name="name" id="exampleInputName" placeholder="">
		  </div>
		
	</div>
	<div class="col-md-4">
		
			<div class="form-group">
		    <label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
		    <input type="email" class="form-control unicase-form-control text-input" name="email" id="exampleInputEmail1" placeholder="">
		  </div>
		
	</div>
	<div class="col-md-4">
		
			<div class="form-group">
		    <label class="info-title" for="exampleInputTitle">Title <span>*</span></label>
		    <input type="text" class="form-control unicase-form-control text-input" name="subject" id="exampleInputTitle" placeholder="Title">
		  </div>
	
	</div>
	<div class="col-md-12">
		
			<div class="form-group">
		    <label class="info-title" for="exampleInputComments">Your Comments <span>*</span></label>
		    <textarea class="form-control unicase-form-control" name="comments" id="exampleInputComments"></textarea>
		  </div>
		
	</div>
	<div class="col-md-12 outer-bottom-small m-t-20">
		<button type="submit" name="submit" class="btn-upper btn btn-primary checkout-page-button">Send Message</button>
	</div>
	<br><br>
	</form>
</div>
<div class="col-md-3 contact-info">
	<div class="contact-title">
		<h4>Information</h4>
	</div>
	<div class="clearfix address">
		<span class="contact-i"><i class="fa fa-map-marker"></i></span>
		<span class="contact-span">Gisfy Pvt ltd,Noida 201301 (U.P), India</span>
	</div>
	<div class="clearfix phone-no">
		<span class="contact-i"><i class="fa fa-mobile"></i></span>
		<span class="contact-span">+(91)9971777963<br>+(91)9971777963</span>
	</div>
	<div class="clearfix email">
		<span class="contact-i"><i class="fa fa-envelope"></i></span>
		<span class="contact-span"><a href="#">www.gisfy.co.in</a></span>
	</div>
</div>			</div><!-- /.contact-page -->
		</div><!-- /.row -->
		
		</div><!-- /.logo-slider-inner -->
</div>
<!-- ==================================  End ==================================== -->
							
							
							<?php
								//include("includes/footer.php");
							?>
							<?php
								//include("includes/link2.php");
							?>


	




</body>
</html>