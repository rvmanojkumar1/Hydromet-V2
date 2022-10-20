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
	                    <li style="background-color:#0000ff"><a href="usergroups.php" style="display: block;color: #fff;padding: 8px 16px;text-decoration: none;"  ><img src="assets/images/approve.png" width="25" height="25" > &nbsp;&nbsp;User Groups</a></a></li>
	                    <li><a href="deleteuser.php" style="display: block;color: #000;padding: 8px 16px;text-decoration: none;" ><img src="assets/images/deleteuser.png" width="25" height="25" > &nbsp;&nbsp;Delete User</a></li>
	                    <li ><a href="changepassword.php" style="display: block;color: #000;padding: 8px 16px;text-decoration: none;" ><img src="assets/images/changepassword.ico" width="25" height="25" > &nbsp;&nbsp;Change Password</a></li>
	                    <li><a href="updateprofile.php" style="display: block;color: #000;padding: 8px 16px;color: #000;text-decoration: none;"  ><img src="assets/images/updateprofile.png" width="25" height="25" > &nbsp;&nbsp;<span>Update Profile</span></a></li>
	                </ul>
	            </div>       
			</div>
	 		<div class="col-md-10">
	            <div class="panel panel-primary" style="width:100%;margin: 30px auto;"  >
                  	<div class="panel-heading" style="background-color:#4A7BDF;color:white">
                   		<center><b style="font-size:15px;font-family: arial;" id="gpname"><?php $gn=$_GET['groupname'];echo $gn; ?></b></center>
                   	</div>
                   	<div class="panel-body">
                   		<a href="usergroups.php" class="btn btn-Primary"><i class="fa fa-arrow-left"></i> Back</a>
                   		<br>
                   		<br>
                   		<div class="container" style="width: 100%;">
                   			
                   			
							<div align="center">
								<br>
								<form method="Post" action="">
									<table align="center" style="width:90%" class="w3-table-all">
										<tr class="listheader">
											<th style="background-color:#539CCC;color:white;text-align:center">Username</td>
											<th style="background-color:#539CCC;color:white;text-align:center">Email</td>
											<th style="background-color:#539CCC;color:white;text-align:center">Organization</td>
											<th style="background-color:#539CCC;color:white;text-align:center">Office No.</td>
											<th style="background-color:#539CCC;color:white;text-align:center">Mobile No.</td>
											<th style="background-color:#539CCC;color:white;text-align:center">Communication Way</td>
										</tr>
										<?php
											// AND \"GroupName\"='$grpname'
											$grpname=$_GET['groupname'];

											$result = pg_query("SELECT \"Username\",\"Email\",\"GroupName\",\"organization\",\"officeno\",\"mobileno\",\"GroupCommunicationWay\" FROM \"tblloginandregister\" where \"approved\"='1'");
											$i=0;
											while($row = pg_fetch_array($result)) 
											{
												if($i%2==0)
												$classname="evenRow";
												else
												$classname="oddRow";

												$checknames=$row["GroupName"];
												$array=explode(",", $checknames);
												for($n=0;$n<count($array);$n++){
													if($array[$n]==$grpname){
														$com_way=$row["GroupCommunicationWay"];
														?>
															<tr class="<?php if(isset($classname)) echo $classname;?>">
																<td style="text-align:center"><?php echo $row["Username"]; ?></td>
																<td style="text-align:center"><?php echo $row["Email"]; ?></td>
																<td style="text-align:center"><?php echo $row["organization"]; ?></td>
																<td style="text-align:center"><?php echo $row["officeno"]; ?></td>
																<td style="text-align:center"><?php echo $row["mobileno"]; ?></td>
																<td>
										                          	<select name='<?php echo $row["Username"]; ?>' disabled style="width: 100%;">
										                            	<option value="Email" <?php if($com_way=="Email") echo "selected"; ?>> Email </option>
										                            	<option value="SMS"  <?php if($com_way=="SMS") echo "selected"; ?>>SMS</option>
										                            	<option value="Both"  <?php if($com_way=="Both") echo "selected"; ?>>Both</option>
										                          	</select>
										                        </td>
															</tr>
														<?php
													}
												}
												
												$i++;
											}
										?>
									</table>
									<br>
									
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