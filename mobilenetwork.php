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

	<script type="text/javascript">
		function addnewnetwork(){
			window.location.href = 'addmobilenetwork.php';
		}
		function editmobile(id){
			window.location.href='editmobilenetwork.php?id='+id;
		}
		function deletemobile(id){
			window.location.href='deletenetwork.php?id='+id;
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
                   		<center><b style="font-size:15px;font-family: arial;">Mobile Networks</b></center>
                   	</div>
                   	<div class="panel-body">
                   		<!-- <h4 style="text-align: center;font-size: 18px!important;">Add new Group</h4> -->
                   		<br>
                   		<button class="btn btn-primary" style="float: right;" onclick="addnewnetwork()">Add New Network</button>
                   		<br>
                   		<br>
                   		<div class="container" style="width: 100%;">
                   			<table id="myTable" class="table table-responsive table-bordered table-hover" align="center">
                   				<thead>
                   					<tr>
                   						<td style="background-color:#539CCC;color:white;text-align:center;font-weight: bold;">Network Name</td>
                   						<td style="background-color:#539CCC;color:white;text-align:center;font-weight: bold;">At</td>
                   						<td style="background-color:#539CCC;color:white;text-align:center;font-weight: bold;">Network Description</td>
                   						<td style="background-color:#539CCC;color:white;text-align:center;font-weight: bold;">Edit</td>
                   						<td style="background-color:#539CCC;color:white;text-align:center;font-weight: bold;">Delete</td>
                   					</tr>
                   				</thead>
                   				<tbody>
                   					<?php
                   						$sqlquery=pg_query("SELECT DISTINCT \"Id\", \"Network\", \"At\", \"Desc\" FROM \"tblNetwork\"");
                   						if(pg_num_rows($sqlquery)>0){
                   							while ($row=pg_fetch_array($sqlquery)) {
                   								?>
                   									<tr>
                   										<td><?php echo $row[1];?></td>
                   										<td><?php echo $row[2];?></td>
                   										<td><?php echo $row[3];?></td>
                   										<td><button class="btn btn-primary" onclick="editmobile('<?php echo $row[0]; ?>')">Edit Network</button></td>
                   										<td><button class="btn btn-danger" onclick="deletemobile('<?php echo $row[0]; ?>')"><i class="fas fa-trash-alt" aria-hidden="true"></i> Delete Network</button></td>
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