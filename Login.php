<?php
session_start();
?>

<!DOCTYPE html>

<html >
<head >
    <title></title>

 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script> 
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js" type="text/javascript"></script> 


<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">

 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous" />

    <style>

        body {
    padding-top: 90px;
}
.panel-login {
	border-color: #ccc;
	-webkit-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
	-moz-box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
	box-shadow: 0px 2px 3px 0px rgba(0,0,0,0.2);
}
.panel-login>.panel-heading {
	color: #00415d;
	background-color: #fff;
	border-color: #fff;
	text-align:center;
}
.panel-login>.panel-heading a{
	text-decoration: none;
	color: #666;
	font-weight: bold;
	font-size: 15px;
	-webkit-transition: all 0.1s linear;
	-moz-transition: all 0.1s linear;
	transition: all 0.1s linear;
}
.panel-login>.panel-heading a.active{
	color: #029f5b;
	font-size: 18px;
}
.panel-login>.panel-heading hr{
	margin-top: 10px;
	margin-bottom: 0px;
	clear: both;
	border: 0;
	height: 1px;
	background-image: -webkit-linear-gradient(left,rgba(0, 0, 0, 0),rgba(0, 0, 0, 0.15),rgba(0, 0, 0, 0));
	background-image: -moz-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
	background-image: -ms-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
	background-image: -o-linear-gradient(left,rgba(0,0,0,0),rgba(0,0,0,0.15),rgba(0,0,0,0));
}
.panel-login input[type="text"],.panel-login input[type="email"],.panel-login input[type="password"] {
	height: 45px;
	border: 1px solid #ddd;
	font-size: 16px;
	-webkit-transition: all 0.1s linear;
	-moz-transition: all 0.1s linear;
	transition: all 0.1s linear;
}
.panel-login input:hover,
.panel-login input:focus {
	outline:none;
	-webkit-box-shadow: none;
	-moz-box-shadow: none;
	box-shadow: none;
	border-color: #ccc;
}
.btn-login {
	background-color: #59B2E0;
	outline: none;
	color: #fff;
	font-size: 14px;
	height: auto;
	font-weight: normal;
	padding: 14px 0;
	text-transform: uppercase;
	border-color: #59B2E6;
}
.btn-login:hover,
.btn-login:focus {
	color: #fff;
	background-color: #53A3CD;
	border-color: #53A3CD;
}
.forgot-password {
	text-decoration: underline;
	color: #888;
}
.forgot-password:hover,
.forgot-password:focus {
	text-decoration: underline;
	color: #666;
}

.btn-register {
	background-color: #1CB94E;
	outline: none;
	color: #fff;
	font-size: 14px;
	height: auto;
	font-weight: normal;
	padding: 14px 0;
	text-transform: uppercase;
	border-color: #1CB94A;
}
.btn-register:hover,
.btn-register:focus {
	color: #fff;
	background-color: #1CA347;
	border-color: #1CA347;
}


    </style>

     <style>

        .wine,
.wineHottracked,
.winePressed {
 
    color: Black!important;
    border: 0!important;
    padding: 0!important;
    width: 90px;
    height: 30px;
}
.wineHottracked {
    background-position: -92px 0px!important;
    color: Black!important;
}
.winePressed {
    background-position: -184px 0px!important;
    color: #DCB7C8!important;
}


    </style>
</head>

<body style="background-color:#D8DAF5" background="body1.jpg">
   
<div class="container" style="margin-top:5.5%">
    	<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-6">
								<a href="#" class="active" id="login-form-link">Login</a>
							</div>
							<div class="col-xs-6">
								<a href="register.php" id="register-form-link">Register</a>
							</div>
						</div>
						<hr/>
					</div>
					<div class="panel-body">
						<div class="row" style="">
							<div class="col-lg-12" >
                                
								<form  method="post" role="form" action="Login.php">
                                    <div id="login_form" style="display:block">
									<div class="form-group">
										 <input type="text" name="username" class="form-control" Required  oninvalid="this.setCustomValidity('Please Enter Username!')" oninput="setCustomValidity('')" placeholder="Username"/>
								</div>
									<div class="form-group">
										<input type="password" name="password" Class="form-control" Required  oninvalid="this.setCustomValidity('Please Enter Password!')" oninput="setCustomValidity('')" placeholder="Password"/>
                                        
                                        
									</div>
                                  
									<div >
										<div class="row">
											<div class="col-sm-12">
												<center>   


<?php

include ('database.php');

 if (isset($_POST['username'])&&isset($_POST['password']))
    {

           $Username=$_POST["username"];
			$passw=$_POST['password'];
	$password = encrypt_decrypt("encrypt", $passw);
//echo "select * from tblloginandregister where \"Username\"='$Username' and \"Login_password\"='$password'";

        $result=pg_query($con,"select * from tblloginandregister where \"Username\"='$Username' and \"Login_password\"='$password'");

        $row=pg_fetch_array($result);

        if ($row>0) {

        	if ($row["approved"]=="0") 
        	{

echo " <div class='alert alert-danger' id='errormsg'  style='width:50%'>
                                    <strong>Error!</strong>   <p ID='msg3' > You are not approved by admin!</p> </div>  ";

        	
        	}
        	elseif ($row["approved"]=="1"&&$row['UserType']==='Admin') {
$_SESSION['username']=$row["Username"];

 	echo "<script>window.location.href = 'stations.php'</script>";
        	}
        		elseif ($row["approved"]=="1"&&$row['UserType']==='Normal') {
$_SESSION['username']=$row["Username"];
//$_SESSION['adminname']=$row["adminname"];

 	echo "<script>window.location.href = 'Index.php'</script>";
        	}
        	
        }
        else
        {
        	echo " <div class='alert alert-danger' id='errormsg'  style='width:50%'>
                                    <strong>Error!</strong>   <p ID='msg3' >Wrong Username or Password!</p> </div>  ";

        

        }
    }?>
												            
                                               <br /> 
                                                <input type="submit" value="Log In" ID="login_submit"  Class="btn-lg btn-info" />
   </center>

											</div>
										</div>
									</div>
                                        <br />
									<div class="form-group">
										<div class="row">
											<div class="col-lg-12">
												<div class="text-center">
                                                     <a  id="forgotpassword"   class="forgot-password" style="font-size:medium;" href="forgotpassword.php">Forgot Password ?</a>
												
												</div>
											</div>
										</div>
									</div>
                                 </div>
							

                                 
                                 </form>
								</div>
                                  
                                   
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

  

</body>
</html>
<?php 

function encrypt_decrypt($action, $string){ 
    $output = false; 

    $encrypt_method = "AES-256-CBC"; 
    $secret_key = 'This is my secret key'; 
    $secret_iv = 'This is my secret iv'; 

    // hash 
    $key = hash('sha256', $secret_key); 
     
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning 
    $iv = substr(hash('sha256', $secret_iv), 0, 16); 

    if( $action == 'encrypt' ) { 
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv); 
        $output = base64_encode($output); 
    } 
    else if( $action == 'decrypt' ){ 
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    } 

    return $output; 
}
?>
