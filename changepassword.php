
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



$result = pg_query("SELECT \"Username\",\"Email\",\"UserType\" FROM \"tblloginandregister\" where \"approved\"='1'");
?>

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>User Management</title>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script> 
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js" type="text/javascript"></script> 
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>



 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous" />
<link rel="stylesheet" href="styles.css" type="text/css" />
<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />
<style>



/* Change the link color on hover */
li a:hover {
    background-color: #555;
    color: white;
}
li a:active{
background-color: #0000ff;
    color: white;
}

*{
  font-family: arial;
}
</style>


 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous" />

<body >
<div style="width:100%;margin:auto">
<div style="width: 25%; color: #bbb;float:left;clear:both;">
<br>
<ul style="list-style-type: none;margin: 0;padding: 0;width:200px;background-color: #f1f1f1;">
    <li ><a href="NewRegistration.php"style="display: block;color: #000;padding: 8px 16px;text-decoration: none;" ><img src="assets/images/adduser.ico" width="25" height="25" > &nbsp;&nbsp;Add User</a></li>
    <li><a href="approveuser.php" style="display: block;color: #000;padding: 8px 16px;text-decoration: none;"><img src="assets/images/approve.png" width="25" height="25" > &nbsp;&nbsp;Approve User</a></li>
    <li><a href="usergroups.php" style="display: block;color: #000;padding: 8px 16px;text-decoration: none;"  ><img src="assets/images/users.png" width="25" height="25" > &nbsp;&nbsp;User Groups</a></a></li>
    <li><a href="deleteuser.php" style="display: block;color: #000;padding: 8px 16px;text-decoration: none;"><img src="assets/images/deleteuser.png" width="25" height="25" > &nbsp;&nbsp;Delete User</a></li>
    <li style="background-color:#0000ff"><a href="changepassword.php" style="display: block;color: #000;padding: 8px 16px;text-decoration: none;"><img src="assets/images/changepassword.ico" width="25" height="25" > &nbsp;&nbsp;<span style="color:white">Change Password</span></a></li>
    <li><a href="updateprofile.php" style="display: block;color: #000;padding: 8px 16px;text-decoration: none;"><img src="assets/images/updateprofile.png" width="25" height="25" > &nbsp;&nbsp;Update Profile</a></li>
    <li ><a href="mobilenetwork.php" style="display: block;color: #000;padding: 8px 16px;text-decoration: none;"><img src="assets/images/settings.png" width="25" height="25" > &nbsp;&nbsp;Mobile Networks</a></li>
</ul>
			
</div>

<link rel="stylesheet" type="text/css" href="styles.css" />
<script language="javascript" type="text/javascript">
function setPasswordChange(){
	if(confirm("Are You sure you want to change password?"))
	{
		document.frmUser.action="changepassword.php";
	
		document.frmUser.submit();
	}
}


</script>
<br>
<div style="width:75%;margin:auto">
 <div class="panel panel-primary" style="width:90%;margin: 0 auto;"  >
         <div class="panel-heading" style="background-color:#4A7BDF;color:white"><center><b style="font-size:15px;font-family: arial;">Change Password</b></center></div>
  <div class="panel-body">

<form name="frmUser" method="post" action="" >
<br>


<div style="width:60%;margin: 0 auto ; background-color: white ;">
<table style="width: 100%" action="changepassword.php">

<tr  >
                    <td style="padding:5px;" ><b >User Name :</b></td>
                    <td style="padding:5px;">

 <select name="Username" id="Username" style="width:300px;height:35px" Class="form-control"  Required  oninvalid="this.setCustomValidity('Please Select User!')" oninput="setCustomValidity('')">

     <option value="" disabled selected>Select your option</option>
	 <?php 
	 if(pg_num_rows($result)>0)
	 {
	 $row=pg_fetch_all($result);
	 
	 foreach($row as $r)
	 {
	 ?>
	 <option value='<?php echo $r["Username"]; ?>' > <?php echo $r["Username"] ?> </option>

<?php
	 }
	 }
	 ?>
	 </select>
                    </td>
                </tr>
<tr >
                    <td style="padding:5px;"><b >Previous password :</b></td>
                    <td style="padding:5px;">
                       <input type="password" name="PreviousPassword" style="width:300px" Class="form-control" Required  oninvalid="this.setCustomValidity('Please Enter Current Password!')" oninput="setCustomValidity('')">
                         </td>
                </tr>
          
                <tr>
                    <td style="padding:5px;"><b >New password :</b></td>
                    <td style="padding:5px;">
                       <input type="password" name="newpassword" style="width:300px" Class="form-control"
                       Required  oninvalid="this.setCustomValidity('Please Enter New Password!')" oninput="setCustomValidity('')">
                         </td>
                </tr>
                <tr>
                    <td style="padding:5px;"><b >Confirm  password :</b></td>
                    <td style="padding:5px;">
                         <input type="password" name="confrmpassword" style="width:300px" Class="form-control" Required  oninvalid="this.setCustomValidity('Please Confirm Password!')" oninput="setCustomValidity('')">
                        <br />
                        
                    </td>
                </tr>         
    

</table>
       <?php include_once 'ChangePwd.php'; ?>
<center>
<input type="submit" class="btn btn-success" style="margin: 0 auto;" name="update" value="Change"   />
</center>
</form>
</div>

</div>
</div>

</div>
</div>

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
							//	include("includes/link2.php");
							?>
</body>
</html>