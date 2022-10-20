<!DOCTYPE php>
<html>
<head>
	<?php
		include_once 'database.php';
		include("includes/link.php");
	?>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

	<title>User Management</title>

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script> 

	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js" type="text/javascript"></script> 

 	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

 	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous" />

    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

	<link rel="stylesheet" href="styles.css" type="text/css" />

	<meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0" />

	<script src="Station/dist/jquery.wizard3.js"></script>

    <link href="Station/dist/jquery.wizard.css" rel="stylesheet">

	<style>

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
		    font-size: 14px!important;
		}
		body{
			font-size: 14px!important;
		}
	</style>

	
</head>
<body class="cnt-home">
	<?php
		include("includes/adminheader.php");
	?>

	
  	<div class="container-fluid">
    	<div class="row"> 
    		<div class="col-md-2">
	            <div style="color: #bbb;clear:both;font-family: arial;">
	                <br>
	                <ul style="list-style-type: none;margin: 0;padding: 0;width:200px;background-color: #f1f1f1;">
	                    <li ><a href="NewRegistration.php" style="display: block;color: #000;padding: 8px 16px;text-decoration: none;"  ><img src="assets/images/adduser.ico" width="25" height="25" > &nbsp;&nbsp;Add User</a></li>
	                    <li><a href="approveuser.php" style="display: block;color: #000;padding: 8px 16px;text-decoration: none;"  ><img src="assets/images/approve.png" width="25" height="25" > &nbsp;&nbsp;Approve User</a></li>
	                    <li><a href="usergroups.php" style="display: block;color: #000;padding: 8px 16px;text-decoration: none;"  ><img src="assets/images/approve.png" width="25" height="25" > &nbsp;&nbsp;User Groups</a></a></li>
	                    <li><a href="deleteuser.php" style="display: block;color: #000;padding: 8px 16px;text-decoration: none;" ><img src="assets/images/deleteuser.png" width="25" height="25" > &nbsp;&nbsp;Delete User</a></li>
	                    <li ><a href="changepassword.php" style="display: block;color: #000;padding: 8px 16px;text-decoration: none;" ><img src="assets/images/changepassword.ico" width="25" height="25" > &nbsp;&nbsp;Change Password</a></li>
	                    <li><a href="updateprofile.php" style="display: block;color: #000;padding: 8px 16px;color: #000;text-decoration: none;"  ><img src="assets/images/updateprofile.png" width="25" height="25" > &nbsp;&nbsp;<span>Update Profile</span></a></li>
	                    <li style="background-color:#0000ff"><a href="mobilenetwork.php" style="display: block;color: #fff;padding: 8px 16px;text-decoration: none;"><img src="assets/images/settings.png" width="25" height="25" > &nbsp;&nbsp;Mobile Networks</a></li>
	                </ul>
	            </div>       
			</div>
	 		<div class="col-md-10">
	            <div class="panel panel-primary" style="width:100%;margin: 30px auto;"  >
                  	<div class="panel-heading" style="background-color:#4A7BDF;color:white">
                   		<center><b style="font-size:15px;font-family: arial;">Add New Mobile Networks</b></center>
                   	</div>
                   	<div class="panel-body">
                   		<!-- <h4 style="text-align: center;font-size: 18px!important;">Add new Group</h4> -->
                   		<br>
                   		<!-- <button class="btn btn-primary" style="float: right;" onclick="addnewgroup()">Add New Group</button>
                   		<br>
                   		<br> -->
                   		<div class="container" style="width: 100%;">
                   			
							<div align="center">
								<br>
								<form method="Post" action="">
									<table>
										<tr>
											<td>Mobile Network Name</td>
										</tr>
										<tr>
											<td><input style="width: 300px;"  type="text" name="mobilenetwork"  id="mobilenetwork" class="form-control" value="" required/></td>
										</tr>

										<tr style="margin-top: 2%;">
											<td>At</td>
										</tr>
										<tr>
											<td><input style="width: 300px;"  type="text" name="mobilenetworkat"  id="mobilenetworkat" class="form-control" value="" /></td>
										</tr>
										<tr style="margin-top: 2%;">
											<td>Description</td>
										</tr>
										<tr>
											<td><input style="width: 300px;"  type="text" name="mobilenetworkdesc"  id="mobilenetworkdesc" class="form-control" value="" /></td>
										</tr>
									</table>
									<br>
									<center>
										<input type="submit" name="nextstep" class="btn btn-primary" value="Submit" id="nextstep">
										<a href="mobilenetwork.php" class="btn btn-danger">Cancel</a>
									</center>
								</form>
								<?php
									// echo "Hello";
									if(isset($_POST['nextstep'])){
										$network=$_POST['mobilenetwork'];
										$desc=$_POST['mobilenetworkdesc'];
										$at=$_POST['mobilenetworkat'];

										$sql=pg_query("INSERT INTO public.\"tblNetwork\"(\"Network\", \"Desc\", \"At\") VALUES ('$network', '$desc', '$at') returning \"Id\";");

										if(pg_num_rows($sql)>0){
											?>
												<script type="text/javascript">
													window.location.href='mobilenetwork.php';
												</script>
											<?php
										}
										else{
											?>
												<script type="text/javascript">
													console.log("Something Went Wrong!!");
													window.location.href='mobilenetwork.php';
												</script>
											<?php
										}
									}
								?>
							</div>
                   		</div>
                   	</div>
                </div>
	 		</div>
	 	</div>
	</div>
</body>
</html>