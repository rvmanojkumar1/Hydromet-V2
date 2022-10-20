
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
  $(document).ready(function(){
  $("#btnNext").click(function(){
  	var type = $("#AlarmType option:selected" ).val(); 
  	var name=$("#alarm_name").val();
    	if (type.trim()=="single") {
    		window.location.href='AlarmSingle.php?AlarmType='+type+'&alarm_name='+name;
    	}
    	else
    	{
    		    		window.location.href='AlarmMulti.php?AlarmType='+type+'&alarm_name='+name;

    	}
  } );
    	});
    		
    	

    </script>
    <style type="text/css">
     
      .sidebar-nav {
        padding: 9px 0;
      }

	  [data-wizard-init] {
		margin: auto;
		width: 90%;
	  }
	  td
	  {
	  	padding: 5px;
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
			  <div align="center">


</div>

			  <div align="center">
			  <br>
			  <form action="AlarmSingle.php">
			  <?php 
			  	 $result;
if (isset($_GET['AlarmName'])) {
	# code...

			  $AlarmName=$_GET['AlarmName'];

			 $result=pg_fetch_array(pg_query("select \"AlarmType\" from \"tblAlarm2Sensor\" where \"AlarmName\"='$AlarmName'"));
			 }
			  ?>
<table>
	<tr>
	<td><b> Alarm Type</b>
</td>
		<td>
			 <select style="width: 300px;" name="AlarmType" id="AlarmType" class="form-control" required="">
<option value="single" <?php if (isset($result[0])) { if(trim($result[0])=="single") echo 'selected';  } ?> >Single</option>
<option value="multiple"  <?php if (isset($result[0])) { if(trim($result[0])=="multiple") echo 'selected';  } ?>>Multiple</option>

			  </select>
		</td>
		</tr>
		<tr>
<td> <b>Alarm Name</b> </td>
<td>
<input style="width: 300px;"  type="text" name="alarm_name"  id="alarm_name" class="form-control" value="<?php if (isset($AlarmName)) {
	echo "$AlarmName";
} ?>" required/> 
</td>

		</tr>
		<tr>
		<td colspan="4">
		<br>
    <center>
		
                   <input type="button" name="btnNext" id="btnNext"  class="btn btn-primary"  value="Next" >
                    <a href="../../alarm.php" class="btn btn-danger">Cancel </a>
                   </center>
		</td>
	</tr>
</table>
             </form>     
                     </div>

            
               
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
								include("includes/link2.php");
							?>
</body>
</html>
