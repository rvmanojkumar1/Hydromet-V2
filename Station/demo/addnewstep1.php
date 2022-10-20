
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
include_once('database.php'); 


//session_start();


if(isset($_GET['addstation'])=="addstation")
{
    $_SESSION["stntypename"]="";
}

if (isset($_GET['station_full_name'])) {
$_SESSION['edit_stn_name']=$_GET['station_full_name'];
}
if (isset($_GET['addstationError'])) {
 $_SESSION['addstationError']=$_GET['addstationError'];
 $_SESSION['stationErrorDelete']=trim($_SESSION['addstationError']);

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Station</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <!-- Optional Bootstrap theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

   
 
    <script src="js/jquery-1.8.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="../dist/jquery.wizardadd1.js"></script>

  

    <link href="../dist/jquery.wizard.css" rel="stylesheet">
   
    <style type="text/css">
   
      .sidebar-nav {
        padding: 9px 0;
      }

	  [data-wizard-init] {
		margin: auto;
		width: 90%;
	  }
    </style>
    <script type="text/javascript">
function cancel()
{
window.location.href='\\HydrometV2\\stations.php#stationtypes'
}
 function stntype()
 {
    var stntypename=document.getElementById("stntypename").value;
    if (stntypename=="") {
 //alert('Please Select Type!')
 $('#myModal').modal('show');

      return;
    }
window.location.href='addnew.php?stntypename='+stntypename;

 }

</script>


</head>
<body>
<div class="container">
  
  <!-- Trigger the modal with a button -->
  

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog" style="margin-top: 15%;">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        
     
       <center><h4>Please Select Type!</h4></center>   
     
        <div class="modal-footer">
        <center>
                    <button type="button" class="btn btn-success" data-dismiss="modal">OK</button>

        </center>
        </div>
      </div>
      
    </div>
  </div>
<br><br>
  <div class="panel panel-primary" style="width:90%;margin: 0 auto;"  >
         <div class="panel-heading" style="background-color:#4A7BDF;color:white"><center>
         <b style="font-size:15px;font-family: arial">Add/Edit Station</b></center></div>
  <div class="panel-body">
    

    <div class="container-fluid">
		<div data-wizard-init>
		  <ul class="steps">
			<li data-step="1" class="active">Step-1</li>
			<li data-step="2">Step-2</li>
			<li data-step="3">Step-3</li>
		

		  </ul>

		</div>
    
</div>
			 
			 <center>

 <div class="content">
                                         <div class="alert alert-info" style="font-family:Arial;">
  <b>In Which Station Type You want to Create Station ?</b>
</div>
</div>

    <frm name="form11" action="addnew.php" method="get">
      
  <select name="stntypename" id="stntypename" style="width:300px" class="form-control"  style="height:35px" required <?php if (isset( $_GET['stntypename'])) echo 'disabled';?>>

     <option value="" disabled selected>Select your option</option>
     <?php 
       $sql_query="SELECT \"StationType\" FROM \"tblStationType\"";
  $result_set=pg_query($sql_query);
  if(pg_num_rows($result_set)>0)
  {
        while($row=pg_fetch_row($result_set))
    {

?>

<option value='<?php echo $row[0]?>' <?php if (isset( $_GET['stntypename']) ){ if($_GET['stntypename']==$row[0]) echo 'selected';}?>><?php echo $row[0]?></option>

<?php

    }
}
    ?>

  

</select>
<br>
<button type="submit" name="next" onclick="stntype()" class="btn btn-primary">Next</button> 
<input type="button" name="cancel" class="btn btn-danger" onclick="cancel()" value="Cancel"/>

      </form></center></div></div></body></html>
	  
	  
	  
	   
  
	
	
	</div>
	</div>
	</div>
	</div>
	</div>
	
	
	

							<?php
								//include("../../includes/footer.php");
							?>
							<?php
								//include("../../includes/link2.php");
							?>
</body>
</html>
