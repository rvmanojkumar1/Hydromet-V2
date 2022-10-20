
<!DOCTYPE php>

<head>
							<?php
								include("includes/link.php");
							?>
</head>

<body class="cnt-home">  
							<?php
								include("includes/adminheader.php");
							?>
   	
	<div class="body-content outer-top-xs" id="top-banner-and-menu">
  <div class="container-fluid">
    <div class="row"> 

     <div class="col-xs-12 col-sm-12 col-md-12 sidebar"> 
	 <div style="height:100%">

	
	<?php
include_once 'database.php';

?>

      <style>


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



  
li a {
    display: block;
    color: #000;
    padding: 8px 16px;
    text-decoration: none;
}

/* Change the link color on hover */
li a:hover {
    background-color: #555;
    color: white;
}
li a:active{
background-color: #0000ff;
    color: white;
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
     <script type="text/javascript">
        function ShowImagePreview(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#profile_pic').prop('src', e.target.result)
                        .width(130)
                        .height(150);
                };
                reader.readAsDataURL(input.files[0]);
                }
            }
    </script>

<script type="text/javascript">
function vali()
{ var valid=true;
    document.getElementById('errorconfirm_password').innerHTML="";
     if ($("#register_password").val()!=$("#confirm_password").val()) {

    document.getElementById('errorconfirm_password').innerHTML="Password mis-match!";  
    valid= false;
}
 else{
document.getElementById('errorconfirm_password').innerHTML="";
}
return valid;
}
function validate(e)
{
   var valid=true;
document.getElementById('errorUsername').innerHTML=""; 
document.getElementById('erroremail').innerHTML="";
document.getElementById('errorregister_password').innerHTML="";


document.getElementById('errororganization').innerHTML="";

document.getElementById('errordesignation').innerHTML="";
document.getElementById('errormobileno').innerHTML="";

document.getElementById('errorconfirm_password').innerHTML
var sEmail = $('#email').val();
if ($("#register_username").val()=="")
 {
 
document.getElementById('errorUsername').innerHTML="Please Enter Username!";  

valid= false;
}
 
if (sEmail=="") {

        document.getElementById('erroremail').innerHTML="Please Enter Email id!";  
valid= false;
}

else if (!validateEmail(sEmail)) {
    document.getElementById('erroremail').innerHTML="Invalid email id!";  
  


valid= false;
}

if ($("#register_password").val()=="")
 {
   
document.getElementById('errorregister_password').innerHTML="Please Enter Password!";  

valid= false;
}
if ($("#confirm_password").val()=="")
 {
   
document.getElementById('errorconfirm_password').innerHTML="Confirm Password!";  

valid= false;
}
 if ($("#register_password").val()!=$("#confirm_password").val()) {

    document.getElementById('errorconfirm_password').innerHTML="Password mis-match!";  
    valid= false;
}

if ($("#organization").val()=="")
 {
   
document.getElementById('errororganization').innerHTML="Please Enter Organization!";  

valid= false;
}

if ($("#designation").val()=="")
 {
   
document.getElementById('errordesignation').innerHTML="Please Enter Designation!";  

valid= false;
}

if ($("#mobileno").val()=="")
 {
   
document.getElementById('errormobileno').innerHTML="Please Enter Mobile Number!";  

valid= false;
}
return valid;
}
function validateEmail(sEmail) {
var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
if (filter.test(sEmail)) {
return true;
}
else {
return false;
}
}


</script>

  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script> 
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js" type="text/javascript"></script> 


<link rel="stylesheet" type="text/css" href="bootstrap/css/bootsap.css">

 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous" />
<link rel="stylesheet" href="style.css" type="text/css" />
<body >
<div style="width:100%;margin:auto">
<div style="width: 25%; color: #bbb;float:left;clear:both;">
<ul class="side" style="  list-style-type: none;margin: 0; padding: 0;width: 200px; background-color: #f1f1f1;" >
    <li style="background-color:#0000ff"><a href="NewRegistration.php" ><img src="assets/images/adduser.ico" width="25" height="25" > &nbsp;&nbsp;<span style="color:white">Add User</span></a></li>
    <li><a href="approveuser.php" ><img src="assets/images/approve.png" width="25" height="25" > &nbsp;&nbsp;Approve User</a></li>
    <li><a href="deleteuser.php" ><img src="assets/images/deleteuser.png" width="25" height="25" > &nbsp;&nbsp;Delete User</a></li>
    <li ><a href="changepassword.php"><img src="assets/images/changepassword.ico" width="25" height="25" > &nbsp;&nbsp;Change Password</a></li>
    <li ><a href="updateprofile.php" ><img src="assets/images/updateprofile.png" width="25" height="25" > &nbsp;&nbsp;Update Profile</a></li>
</ul>
			
</div>
<div style="width:75%;margin:auto">

  <div class="panel panel-primary" style="width:70%;margin: 0 auto;"  >
         <div class="panel-heading" style="background-color:#4A7BDF;color:white"><center><b style="font-size:15px;font-family: arial;">Add User</b></center></div>
  <div class="panel-body">
<form id="form1" action="NewRegistration.php" enctype="multipart/form-data" method="post">

    <div id="register_form">
     <div class="row">
    
      <div class="col-sm-8">
									<div class="form-group">
										 <input type="text" placeholder="Username" Class="form-control" id="register_username"   name="register_username" Required  oninvalid="this.setCustomValidity('Please Enter Username!')" oninput="setCustomValidity('')" / >
                                       <p id="errorUsername" style="color:#C0392B"></p>
                                            
									</div>
									<div class="form-group">
										<input type="email" title="Invalid Email Id!" placeholder="Email" Class="form-control"  id="email" name="email" Required  oninvalid="this.setCustomValidity('Please Enter Email!')" oninput="setCustomValidity('')" />
                                             <p id="erroremail" style="color:#C0392B"></p>                                              

									</div>
									<div class="form-group">
										 <input type="password" Placeholder="Password" Class="form-control" id="register_password"  name="register_password" Required  oninvalid="this.setCustomValidity('Please Enter Password!')" oninput="setCustomValidity('')" />
                                             <p id="errorregister_password" style="color:#C0392B"></p>     
									</div>
          <div class="form-group">
                                         <input type="password" placeholder="Confirm Password" id="confirm_password" Class="form-control"  name="confirm_password" Required  oninvalid="this.setCustomValidity('Please Confirm-Password!')" oninput="setCustomValidity('')" onchange="return vali();"/>
                                            <p id="errorconfirm_password" style="color:#C0392B"></p>    
									</div>
          </div>


         <div class="col-sm-4">
             <div class="form-group">


             <img  Style="width:130px;height:150px;background-color:gainsboro;" id="profile_pic" Class="img-thumbnail" src="blankImage.png"/>
     
          <input type="file"  name="pic" onChange="ShowImagePreview(this);" Style="width:130px;"/>  

            </div>
             </div>
             </div> 
             <div class="row">
              <div class="col-sm-12" > 
         <div class="col-sm-12">

									
        <div class="form-group">
             <input name="organization" type="text" Class="form-control" id="organization" placeholder="Organization" Required  oninvalid="this.setCustomValidity('Please Enter Organization!')" oninput="setCustomValidity('')"/>
                 
                                            <p id="errororganization" style="color:#C0392B"></p>    

            </div>
          <div class="form-group">
                <input  type="text" name="designation" Class="form-control" id="designation" placeholder="Designation" Required  oninvalid="this.setCustomValidity('Please Enter Designation!')" oninput="setCustomValidity('')"/>
                      <p id="errordesignation" style="color:#C0392B"></p>   

            </div>
          <div class="form-group">
              <input  type="text" name="officeno"  Class="form-control" id="officeno"  placeholder="Office No">
 <p id="errorofficeno" style="color:#C0392B"></p> 
     
            </div>
          <div class="form-group">
               <input  type="text" name="mobileno" Class="form-control" id="mobileno" placeholder="Mobile No" pattern="[0-9]{10}" title="Invalid Mobile Number!" Required  oninvalid="this.setCustomValidity('Please Enter Mobile No!')" oninput="setCustomValidity('')">
                  <p id="errormobileno" style="color:#C0392B"></p> 

            </div>


          
                     <div class="form-group">
                        <select name="UserType" Class="form-control" id="UserType" placeholder="Account Type" style="height:40px" Required  oninvalid="this.setCustomValidity('Please Select Type!')" oninput="setCustomValidity('')">
                         
                                <option  Value="Normal" >Normal</option>
                                <option Value="Admin" >Admin</option>

                           
                        </select>
 <p id="errorUserType" style="color:#C0392B"></p> 
                </div>
                <center>
<?php

                    
include_once('database.php');
 

 if (isset($_POST['register_username']))
    {

        $Username=$_POST["register_username"];
$Email=$_POST["email"];
$Login_password=$_POST["register_password"];
$Confirm_password=$_POST["confirm_password"];

$organization=$_POST["organization"];
$degisnation=$_POST["designation"];
$officeno=$_POST["officeno"];
$mobileno=$_POST["mobileno"];

$communicationway="";
$UserType=$_POST["UserType"];
 if (isset($_FILES["pic"]))
    {
 $pic=basename($_FILES["pic"]["name"]);
}
$result= pg_query($con,"insert into tblloginandregister(\"Username\",\"Email\",\"Login_password\",\"Confirm_password\",\"approved\",\"organization\",\"degisnation\",\"officeno\",\"mobileno\",\"pic\",\"communicationway\",\"UserType\") values('$Username','$Email','$Login_password','$Confirm_password','1','$organization','$degisnation','$officeno','$mobileno','$pic','$communicationway','$UserType')");

if ($result) {
 if (isset($_FILES["pic"]))
    {
    $uploaddir = 'profile_pic/';
$uploadfile =  basename($_FILES["pic"]["name"]);

move_uploaded_file($_FILES["pic"]["tmp_name"], $uploadfile);

  }
    echo "

                                                    <div class='alert alert-success' id='msgsuccess' style='width:50%''>
                               <strong >Success!</strong>  <p ID='msg2' >User has been Registered Successfully!</p>

                                                    </div>";
}
else
{
echo " <div class='alert alert-danger' id='errormsg'  style='width:50%'>
                                    <strong>Error!</strong>   <p ID='msg3' > Username or Email id already exists    </p> </div>  ";
}
}

?>

           
         
                                              
                                                   
                                               
                            <Input type="submit" value="Register Now" id="register_btn"   name="register_btn"   Class="btn-lg btn-info" onClick="return vali();"/>
                          
                                                     </center>
											
										</div>
									</div>
                  </div>
                  </div>
                              

    </form>
      </div>
     </div>
     </div>
     </div>
     <?php
include_once 'footer.php';

?>
</body>
</html>

	
	
	
	
	
	
	
	
	
	</div>
	</div>
	</div>
	</div>
	</div>
	
	
	

							<?php
							//include("includes/footer.php");
							?>
							<?php
								//include("includes/link2.php");
							?>
</body>
</html>