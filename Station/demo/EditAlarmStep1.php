	<?php
								include("includes/link.php");
							?>

							<?php
								include("includes/adminheader.php");
							?>
<?php
include_once 'database.php';


if(isset($_GET['stntype']))
{
  $var=$_GET['stntype'];
  $_SESSION['AlarmType']=$var;

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>jQuery Wizard ByGiro Plugin demo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js/jquery-1.8.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="../dist/jquery.wizard3.js"></script>


    <link href="../dist/jquery.wizard.css" rel="stylesheet">
    <script type="text/javascript">
    function AlarmData()
    {
    	var stn = document.getElementById("alarm1").value; 
    	
    		window.location.href='NewAlarmStep2.php?alarmname='+stn;
    		
    	
    }
    </script>
    <style type="text/css">
     
      .sidebar-nav {
        padding: 9px 0;
      }

	  [data-wizard-init] {
		margin: auto;
		width: 90%;
	  }
    </style>
</head>
<body>
<br>
<br>
<div class="panel panel-primary" style="width:90%;margin: 0 auto;"  >
         <div class="panel-heading" style="background-color:#4A7BDF;color:white"><center><b style="font-size:15px;font-family: arial">Edit Alarm</b></center></div>
  <div class="panel-body">
    <div class="container-fluid">
		<div data-wizard-init>
		  <ul class="steps">
			<li data-step="1">Step 1</li>
			
			
		  </ul>
		  </div>
		  <div class="steps-content">
			<div data-step="1">
			<form action="EditAlarmStep2.php">
			  <div>
        <center>
          <h4> 
<b>Selected Alarm</b>
</h4>
        </center>

</div>

			  <div align="center">
<table width="100%">
	<tr>
		<td align="center">
			 <h3 class="alert alert-info" style="width: 100%;" > <?php 
if(isset($_GET['stntype'])){
  echo $_GET['stntype'];
}
else 
{
  if(isset($_SESSION['AlarmType']))
  {
    $st=$_SESSION['AlarmType'];
    echo $st;
  }
}
       ?></h3>
		</td>
		</tr>
		<tr>
		<td align="center">
 
			<input type="submit" name="btnNext"  class="btn btn-primary"  value="Next" >
           <a href="../../alarm.php" class="btn btn-danger">Cancel </a>    
                   

		</td>
	</tr>
</table>
                  
                     </div>

            
               
               </form> 
			</div>
			
		  </div>
		</div>
    </div>
    <!--/.fluid-container-->
</body>
</html>
