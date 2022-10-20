
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
if(isset($_POST['cancel']))
{
	header("Location: sensors.php");
}
if(isset($_POST['save']))
{
	// variables for input data
	$SensorName = $_POST['SensorName'];
//	$HydroMetParamsTypeId = $_POST['HydroMetParamsTypeId'];
	$Desc = $_POST['Desc'];
	// variables for input data
	$HydroMetShefCode='';//$_POST['HydroMetShefCode'];
	// sql query for inserting data into database	
	$sql=pg_query("SELECT \"SensorName\" FROM \"tblHydrometSensor\" Where \"SensorName\"='$SensorName'");
	$sql_query = "INSERT INTO \"tblHydrometSensor\"(\"SensorName\",\"Description\",\"Caliberation\",\"Values\") VALUES('$SensorName','$Desc','1','0')";
	// sql query for inserting data into database
	// sql query execution function
	if(pg_num_rows($sql)==0)
	{
	if(pg_query($sql_query))
	{
//myAlert('Sensor has been added Successfully!');
		?>
		<script type="text/javascript">
		// $('#myModal').modal('show');

		alert('Sensor has been added Successfully! ');
		window.location.href='sensors.php';
		</script>
		<?php
	}
	else
	{
		?>
		<script type="text/javascript">
		alert('error occured while adding Sensor');
		</script>
		<?php
	}
	}
	else{
		?>
		<script type="text/javascript">
		alert('Sorry! Sensor is Exist ');
		window.location.href='sensors.php';
		</script>
		<?php
	}
	// sql query execution function
}
?>
<script>
function cancel1()
{	
var r = confirm("Do you want to cancel?");
if (r == true) {
			window.location.href='sensors.php';
}


}
</script>

<script>
        $(function () {
            $("#dialog").dialog({
                open: function (event, ui) {
                    $(this).parent().css('position', 'fixed');
                }
            });
        });
    </script>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Hydromet Sensor Management</title>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script> 
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js" type="text/javascript"></script> 



 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous" />
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>
<br>
<center>
 <div class="panel panel-primary" style="width:90%"  >
         <div class="panel-heading" style="background-color:#4A7BDF;color:white"><b style="font-size:20px">Add Sensors</b></div>
  <div class="panel-body">

<div id="body">
	<div id="content">
    <form method="post">
    <table align="center" style="margin: 0 auto;width: 300px" class="w3-table-all">
   
    <tr>
    <td><input type="text" pattern="[a-zA-Z0-9\s]+" class="form-control" name="SensorName" placeholder="Sensor Name" required /></td>
    </tr>
	  <tr>
    </tr>
   <!-- <tr>
    <td><input type="number" class="form-control" name="HydroMetParamsTypeId" placeholder="HydroMetParamsType Id" required /></td>
    </tr>-->
    <tr>
    <td><input type="text" class="form-control" name="Desc" placeholder="Description"  /></td>
    </tr>
    <tr>
    <td><button type="submit" class="btn btn-primary" name="save"><strong>Save</strong></button>
  <button type="button" class="btn btn-danger" onClick="cancel1()" formnovalidate><strong>Cancel</strong></button>

    </td>
    </tr>
    </table>
    </form>
    </div>
</div>
    </div>
</div>
</center>
</body>
</html>




	</div>
	</div>
	</div>
	</div>
	</div>
	
	
	

							
</body>
</html>
