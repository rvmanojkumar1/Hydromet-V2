
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
<?php
if (isset($_GET['Message'])) {
echo "<script>alert('Alarm has been created successfully!');</script>";
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
<br><br>
 

      <div class="panel panel-primary" style="width:90%;margin: 0 auto;"  >
         <div class="panel-heading" style="background-color:#4A7BDF;color:white"><center><b style="font-size:15px;font-family: arial">Add Alarm</b></center></div>
  <div class="panel-body">
    <div class="container-fluid">
		<div data-wizard-init>
		  <ul class="steps">
			<li data-step="1" class="active">Step 1</li>
			
			  <li data-step="2" >Step 2</li>
            
            <li data-step="3">Step 3</li>
		  </ul>
		  </div>
		  <div class="steps-content">
			<div data-step="1">
			<form action="NewAlarmStep2.php">
			  <div align="center">
<h4> 
<b>Please Enter Alarm Name</b>
</h4>
</div>

			  <div align="center">
<table>
	<tr>
		<td>
			  <input type="text" id="alarm1" name="alarmname" placeholder="Enter Alarm Name" Required style="width: 300px; height: 40px;" class="form-control"/>
			  <br>
		</td>
		</tr>
		<tr>
		<td>
    <center>
		
                   <input type="submit" name="btnNext"  class="btn btn-primary"  value="Next" >
                    <a href="../../alarm.php" class="btn btn-danger">Cancel </a>
                   </center>
		</td>
	</tr>
</table>
                  
                     </div>

            
               
               </form> 
			</div>
			
		  </div>
		</div>
     </div>
    </div>
    
    <!--/.fluid-container-->
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
