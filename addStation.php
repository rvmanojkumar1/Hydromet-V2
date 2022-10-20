<?php
include_once 'database.php';
include_once 'adminheader.php';
session_start();

if(isset($_GET['delete_id']))
{
  $id=$_GET['delete_id'];
	//$sql_query="DELETE FROM \"tblStationType\" WHERE \"StationType\"='$id'";
//	pg_query($sql_query);
	header("Location: $_SERVER[PHP_SELF]");
}
if(isset($_GET['addstation'])=="addstation")
{


	$_SESSION["stntypename"]="";
}

?>





<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script> 
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js" type="text/javascript"></script> 
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">

 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous" />



<script type="text/javascript">
function cancel()
{
window.location.href='stations.php'
}
 function stntype()
 {
 	var stntypename=document.getElementById("stntypename").value;
window.location.href='addStation.php?stntypename='+stntypename;
 }

</script>
<center>
  <div class="panel panel-primary" style="width:90%"  >
         <div class="panel-heading" style="background-color:#4A7BDF;color:white"><b style="font-size:20px">Add Station</b></div>
  <div class="panel-body">

 	 <div class="content">
                                         <div class="alert alert-info" style="font-family:Arial;">
  <b>In Which Station Type You want to Create Station ?</b>
</div>
</div>
<div class="col-sm-4"></div>

<div class="col-sm-4">
	<from action="addStation.php">
  <select name="stntypename" id="stntypename" class="dropdown form-control" style="height:35px" Required  oninvalid="this.setCustomValidity('Please Select Station Type!')" oninput="setCustomValidity('')">

  	 <option value="" disabled selected>Select your option</option>
  	 <?php 
  	   $sql_query="SELECT \"StationType\" FROM \"tblStationType\"";
  $result_set=pg_query($sql_query);
  if(pg_num_rows($result_set)>0)
  {
        while($row=pg_fetch_row($result_set))
    {

?>

<option value='<?php echo $row[0]?>' <?php if($_SESSION['stntypename']==$row[0]) echo 'selected';?>><?php echo $row[0]?></option>

<?php

    }
}
    ?>

  

</select>
</form>
<br>
<button type="submit" name="stntypename" class="btn btn-primary" onClick="stntype()" >Continue</button>
<button type="submit" name="Cancel" onClick="cancel()" class="btn btn-danger">Cancel</button>

</div>

  	</div>
  	<br><br>
<div class="col-sm-12">
	<br>

<form action='addStation.php' method="post">
	<table style="width:100%" >
<tr>

<?php

if(isset($_GET['stntypename']))
{
$stntypename=	$_GET['stntypename'];
$_SESSION["stntypename"]=$stntypename;
       // var selectedText = filedtype.options[filedtype.selectedIndex].innerHTML;
     $i=0;
      
	   $sql_query="SELECT \"StationField\" FROM \"DefineStations\" WHERE \"StationTypeName\"='$stntypename'";
  $result_set=pg_query($sql_query);
  if(pg_num_rows($result_set)>0)
  {
  	?>
  		 <div class="content">
                                         <div class="alert alert-info" style="font-family:Arial;">
  <b>Fill The Station Details!</b>
</div>
</div>
  	<?php
        while($row=pg_fetch_row($result_set))
    { 
$stationfiled=$row[0];
$i++;
?>
<td style='padding:5px'><label><?php echo $row[0]; ?></label></td><td style='padding:5px'><input type='text' class='form-control' name='<?php echo str_replace(" ", "_",$row[0]); ?>'/></td>
<?php
if ($i==3) {
?>
</tr><tr>
<?php
$i=0;
}
 }
  ?>
</tr><tr> <td><input type="hidden" name="stntypetable" value='<?php echo $stntypename;?>'></td>
  </tr>	</table><br><br>
<button type='submit' name='Submit' class='btn btn-primary'>Submit</button>
<button type='submit' onClick='cancel' name='Cancel'class='btn btn-danger' >Cancel</button>
  <?php
}
}
include_once 'dbaddStation.php';

?>


</form>
</div>
  </div>
</div>
</div>

</div>
<div class='col-sm-12'>
<?php
include_once 'footer.php';

?>
</div>
</center>
