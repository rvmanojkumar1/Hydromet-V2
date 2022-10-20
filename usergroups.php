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

	<script type="text/javascript">
		function addnewgroup(){
			window.location.href = 'addnewgroup.php';
		}
		function getusersingroup(groupname){
			window.location.href = 'getusersingroup.php?groupname='+groupname;
		}
		function editusersingroup(groupname){
			window.location.href = 'editusersingroup.php?groupname='+groupname;
		}
		function deletegroup(groupname){
			window.location.href = 'deletegroup.php?groupname='+groupname;
		}
	</script>
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
	                    <li style="background-color:#0000ff"><a href="usergroups.php" style="display: block;color: #fff;padding: 8px 16px;text-decoration: none;"  ><img src="assets/images/users.png" width="25" height="25" > &nbsp;&nbsp;User Groups</a></a></li>
	                    <li><a href="deleteuser.php" style="display: block;color: #000;padding: 8px 16px;text-decoration: none;" ><img src="assets/images/deleteuser.png" width="25" height="25" > &nbsp;&nbsp;Delete User</a></li>
	                    <li ><a href="changepassword.php" style="display: block;color: #000;padding: 8px 16px;text-decoration: none;" ><img src="assets/images/changepassword.ico" width="25" height="25" > &nbsp;&nbsp;Change Password</a></li>
	                    <li><a href="updateprofile.php" style="display: block;color: #000;padding: 8px 16px;color: #000;text-decoration: none;"  ><img src="assets/images/updateprofile.png" width="25" height="25" > &nbsp;&nbsp;<span>Update Profile</span></a></li>
	                    <li ><a href="mobilenetwork.php" style="display: block;color: #000;padding: 8px 16px;text-decoration: none;"><img src="assets/images/settings.png" width="25" height="25" > &nbsp;&nbsp;Mobile Networks</a></li>
	                </ul>
	            </div>       
			</div>
	 		<div class="col-md-10">
	            <div class="panel panel-primary" style="width:100%;margin: 30px auto;"  >
                  	<div class="panel-heading" style="background-color:#4A7BDF;color:white">
                   		<center><b style="font-size:15px;font-family: arial;">User Groups</b></center>
                   	</div>
                   	<div class="panel-body">
                   		<!-- <h2 style="text-align: center;">List of Groups</h2> -->
                   		
                   		<div class="container" style="width: 100%;">
                   			<button class="btn btn-primary" style="float: right;" onclick="addnewgroup()">Add New Group</button>
                   			<br>
                   			<br>
                   			<table id="myTable" class="table table-responsive table-bordered table-hover" align="center">
                   				<thead>
                   					<tr>
                   						<td style="background-color:#539CCC;color:white;text-align:center;font-weight: bold;">Group Name</td>
                   						<td style="background-color:#539CCC;color:white;text-align:center;font-weight: bold;">View Group Users</td>
                   						<td style="background-color:#539CCC;color:white;text-align:center;font-weight: bold;">Edit Group Users</td>
                   						<td style="background-color:#539CCC;color:white;text-align:center;font-weight: bold;">Delete Group</td>
                   					</tr>
                   				</thead>
                   				<tbody>
                   					<?php
                   						$sqlquery=pg_query("SELECT DISTINCT \"GroupName\" FROM \"tblloginandregister\" WHERE \"approved\"='1' and \"GroupName\"!=''");
                   						$arr=array();
                   						if(pg_num_rows($sqlquery)>0){
                   							while ($row=pg_fetch_array($sqlquery)) {
                   								$ray=explode(",", $row[0]);
                   								for($h=0;$h<count($ray);$h++){
                   									array_push($arr,$ray[0]);
                   								}
                   							}
                   							
                   							$array=array_unique($arr);
                   							
                   							sort($array);
                   							
                   							for($k=0;$k<count($array);$k++){
                   								?>
                   									<tr>
                   										<td><?php echo $array[$k];?></td>
                   										<td><button class="btn btn-success" onclick="getusersingroup('<?php echo $array[$k]; ?>')">View Group Users</button></td>
                   										<td><button class="btn btn-primary" onclick="editusersingroup('<?php echo $array[$k]; ?>')">Edit Group</button></td>
                   										<td><button class="btn btn-danger" onclick="deletegroup('<?php echo $array[$k]; ?>')"><i class="fas fa-trash-alt" aria-hidden="true"></i> Delete Group</button></td>
                   									</tr>
                   								<?php
                   							}
                   						}

                   					?>
                   				</tbody>
                   			</table>
                   		</div>
                   	</div>
                </div>
	 		</div>
	 	</div>
	</div>
</body>
</html>