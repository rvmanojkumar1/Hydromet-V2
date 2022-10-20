
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

if(isset($_GET['Year']) && isset($_GET['Month']) && isset($_GET['Day']) && isset($_GET['Hour']) && isset( $_GET['Minute']) && isset($_GET['Second']) && isset($_GET['value']) )
{
  // variables for input data
  $table="'".$_GET['tablename']."'";
  $Year = $_GET['Year'];
  $Month = $_GET['Month'];
  $Day = $_GET['Day'];
   $Hour = $_GET['Hour'];
   $Minute = $_GET['Minute'];
  $Second = $_GET['Second'];
   $Value = $_GET['value'];
   $FY=$_GET['FY'];
    $FM=$_GET['FM'];
     $FD=$_GET['FD'];
      $TY=$_GET['TY'];
       $TM=$_GET['TM'];
        $TD=$_GET['TD'];
         $PARAMS=$_GET['PARAMS'];
          $Station = $_GET['Station'];
          
        

  $ReadingId = '';//$_POST['id'];

  $sql_query = "UPDATE \"$table\" SET \"Year\"='$Year',\"Month\"='$Month',\"Day\"='$Day',\"Hour\"='$Hour',\"Minute\" ='$Minute',\"Second\" ='$Second', \"Value\" ='$Value' WHERE \"ReadingId\"=".$_GET['editId'];
  // sql query for update data into database
  
  // sql query execution function
if(pg_query($sql_query))
  {

   $FY= $_GET['FY'];

    $FM=$_GET['FM'];
    $FD= $_GET['FD'];
          $TD=$_GET['TY'];
       $TM= $_GET['TM'];
        $TD= $_GET['TD'];
$PARAM=$_GET['PARAMS'];
$STN=$_GET['Station'];


if ($_GET['hours2']!="") {
  
$hours=$_GET['hours2'];
echo "<script>alert('Data has been updated Successfully!'); 
window.location.href='EditValues.php?FY=$FY&FM=$FM&FD=$FD&TY=$TY&TM=$TM&TD=$TD&PARAMS=$PARAM&station=$STN&hours2=$hours&hours=$hours';</script>";
}
else
{
 
  echo "<script>alert('Data has been updated Successfully!'); 
window.location.href='EditValues.php?FY=$FY&FM=$FM&FD=$FD&TY=$TY&TM=$TM&TD=$TD&PARAMS=$PARAM&station=$STN';</script>";
}

  }   


  else
  {
    ?>
    <script type="text/javascript">
    alert('Error occured while Updating Sensor');
    </script>
    <?php
    
  }
  // sql query execution function
  }

?>


<script>
function cancel1()
{ 
 var FY= <?php if (isset($_GET['FY'])) echo($_GET["FY"])?>;
 var FM=<?php if (isset($_GET['FM'])) echo($_GET["FM"])?>;
 var FD=<?php if (isset($_GET['FD'])) echo($_GET["FD"])?>;
 var TY=<?php if (isset($_GET['TY'])) echo($_GET["TY"])?>;
var TM= <?php if (isset($_GET['TM'])) echo($_GET["TM"])?>;
var TD=<?php if  (isset($_GET['TD'])) echo($_GET["TD"])?>; 

var hours2=<?php if(isset($_GET['hours2'])) echo $_GET["hours2"]; else echo '""';?>; 

 var r = confirm("Do you want to cancel?");


  if (r == true)
 {
if (hours2!="") 
{
  
  window.location.href='EditValues.php?FY='+FY+ "&FM="+FM+"&FD="+FD+"&TY="+TY+"&TM="+TM+"&TD="+TD+"&PARAMS=<?php echo ($_GET['PARAMS']) ?>"+"&station=<?php echo ($_GET['Station']) ?>&hours2="+hours2+'&hours='+hours2;

}
else
{
     window.location.href='EditValues.php?FY='+FY+ "&FM="+FM+"&FD="+FD+"&TY="+TY+"&TM="+TM+"&TD="+TD+"&PARAMS=<?php echo ($_GET['PARAMS']) ?>"+"&station=<?php echo ($_GET['Station']) ?>";

}
  
}
}


var YOUR_MESSAGE_STRING_CONST = "Your confirm message?";
      $('#btnDelete').on('click', function(e){
        confirmDialog(YOUR_MESSAGE_STRING_CONST, function(){
          //My code to delete
        });
      });

        function confirmDialog(message, onConfirm){
          var fClose = function(){
          modal.modal("hide");
          };
          var modal = $("#confirmModal");
          modal.modal("show");
          $("#confirmMessage").empty().append(message);
          $("#confirmOk").one('click', onConfirm);
          $("#confirmOk").one('click', fClose);
          $("#confirmCancel").one("click", fClose);
        }
</script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script> 
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js" type="text/javascript"></script> 
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>



 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous" />
 
               
   <style type="text/css">
   	.pad
   	{
   		padding: 5px;
   	}
   	.span1
   	{
   		color: red;
   		

   	}
   	hr {
    display: block;
    height: 1px;
    border: 0;
    border-top: 1px solid #ccc;
    margin: 1em 0;
    padding: 0;
}
   </style>
   <script type="text/javascript">
     function resetb()
     {

      document.getElementById('EditStartDate').value="";
       document.getElementById('EditEndDate').value="";
        document.getElementById('hours').value="";
  
     }

   </script>
<script>
function val() {
d = document.getElementById("selectgraph").value;
if (d.trim()=="multiple") {
  window.location.href='GraphMultiple2.php';
}

if (d.trim()=="multiple2") {
  window.location.href='SingleGraphMultiSensor.php';
}
if (d.trim()=="single") {
  window.location.href='Graph.php';
}
if (d.trim()=="multiple3") {
  window.location.href='GraphMultiple.php';
}
}
</script>
<?php
$fetched_row;

if(isset($_GET['edit_id'])&& isset($_GET['tablename']))
{
    $table="'".$_GET['tablename']."'";

  $sql_query="SELECT \"Year\",\"Month\",\"Day\",\"Hour\",\"Minute\",\"Second\",\"Value\" FROM \"$table\" WHERE \"ReadingId\"='".$_GET['edit_id']."'";
  $result_set=pg_query($sql_query);

  $fetched_row=pg_fetch_array($result_set);

}

?>
   <form method="get">
 
<center>
   <br> 
  <div class="panel panel-primary" style="width:90%"  >
         <div class="panel-heading" style="background-color:#4A7BDF;color:white"><b style="font-size:20px">Edit Station</b></div>
  <div class="panel-body">
<div id="body">
  <div id="content">
    <form method="post">
    <table align="center" style="margin: 0 auto;width: 100%" class="table">
    <tr><td><label>Year</label></td><td><label>Month</label></td><td><label>Day</label></td></tr>
    <tr>
    <td><input type="Number" min="0"    required name="Year" class="form-control" placeholder="Year" value="<?php if(isset($fetched_row['Year'])) echo $fetched_row['Year']; ?>" /></td>
   <td><input type="Number" min="0" required name="Month" class="form-control" placeholder="Month" value="<?php if(isset($fetched_row['Month']))  echo $fetched_row['Month']; ?>" /></td>
   <td><input type="Number" min="0" required name="Day" class="form-control" placeholder="Day" value="<?php if(isset($fetched_row['Day']))  echo $fetched_row['Day']; ?>" /></td>
   </tr>
       <tr><td><label>Hour</label></td><td><label>Minute</label></td><td><label>Second</label></td></tr>

  <tr>
    <td><input type="Number" min="0" required name="Hour" class="form-control" placeholder="Hour" value="<?php if(isset($fetched_row['Hour']))  echo $fetched_row['Hour']; ?>" /></td>
    <td><input type="Number" min="0" required name="Minute" class="form-control" placeholder="Minute" value="<?php if(isset($fetched_row['Minute']))  echo $fetched_row['Minute']; ?>" /></td>
    <td><input type="Number" min="0" required name="Second" class="form-control" placeholder="Second" value="<?php if(isset($fetched_row['Second']))  echo $fetched_row['Second']; ?>" /></td>
  </tr>
   <tr><td><label>Value</label></td></tr>
   <tr>
   <!-- <td><input type="text" name="SensorName" class="form-control"  placeholder="Sensor Name" value="<?php //if(isset($fetched_row['SensorName'])) // echo $fetched_row['SensorName']; ?>" /></td>-->
    <td><input type="Number" step="any" required name="value" class="form-control" placeholder="Value" value="<?php if(isset($fetched_row['Value']))  echo $fetched_row['Value']; ?>" /></td>
  
  </tr>
   
   
    <tr>
    <td>
    <input type="hidden" name="editId" value="<?php if(isset($_GET['edit_id']))
{ echo $_GET['edit_id'];} ?>">
<input type="hidden" name="tablename"   value="<?php if(isset($_GET['tablename']))
{ echo $_GET['tablename'];} ?>">
    <input type="hidden" name="FY" value="<?php if(isset($_GET['FY']))
{ echo $_GET["FY"];} ?>">

  <input type="hidden" name="FM" value="<?php if(isset($_GET['FM']))
{ echo $_GET["FM"];} ?>">

  <input type="hidden" name="FD" value="<?php if(isset($_GET['FD']))
{ echo $_GET["FD"];} ?>">
<input type="hidden" name="TY" value="<?php if(isset($_GET['TY']))
{ echo $_GET["TY"];} ?>">
<input type="hidden" name="TM" value="<?php if(isset($_GET['TM']))
{ echo $_GET["TM"];} ?>">
<input type="hidden" name="TD" value="<?php if(isset($_GET['TD']))
{ echo $_GET["TD"];} ?>">      
<input type="hidden" name="PARAMS" value="<?php if(isset($_GET['PARAMS']))
{ echo $_GET["PARAMS"];} ?>"> 
<input type="hidden" name="Station" value="<?php if(isset($_GET['Station']))
{ echo $_GET['Station'];} ?>">           
<input type="hidden" name="hours2" value="<?php if(isset($_GET['hours2']))
{ echo $_GET['hours2'];} ?>">    

  <button type="button2" class="btn btn-primary" data-toggle="modal" id="btnalert" name="update"><strong>Update</strong></button>
  
        <button type="button" onClick="cancel1()" class="btn btn-danger"name="cancel" formnovalidate><strong>Cancel</strong></button>
    </td>
    </tr>
    </table>
    </form>
    </div>
</div>
</div>
</div>
</div>
</center>


 
</form>


	

	
	
	</div>
	</div>
	</div>
	</div>
	</div>
	
</body>
</html>