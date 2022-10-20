
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
//include_once database.php";

//session_start();

 if (isset($_SESSION["StationType"])&&isset($_GET['edit_id'])) {
 $erow="";

    $stnname=   $_SESSION["StationType"];
    $eid=$_GET['edit_id'];
    $sql_query="SELECT \"StationField\",\"FieldType\",\"ComboxValues\" FROM \"DefineStations\" where \"StationTypeName\"='$stnname' and \"StationField\"='$eid'";
    $result_set=pg_query($sql_query);
$erow=pg_fetch_array($result_set);
$_SESSION["keyfield"]= $erow['StationField'];

}
else
{
  $_SESSION["keyfield"]="";
}

if (isset($_GET['addnew'])=="addnew")
 {
  $_SESSION["StationType"]="";
}
if (isset($_GET['stntype']))
 {
    $tblname=$_GET['stntype'];
    $tblname=str_replace(" ", "_",$tblname);
    pg_query("create table if not exists \"$tblname\"(\"Station_Full_Name\" text,\"Station_Shef_Code\" text)");
    $sql_query="SELECT * FROM \"DefineStations\" where \"StationTypeName\"='$tblname' and \"StationField\"='Station Full Name'";
    $result_set=pg_query($sql_query);
    if(pg_num_rows($result_set)==0)
    {
    
        pg_query("insert into \"DefineStations\"(\"StationTypeName\",\"StationField\",\"FieldType\") values('$tblname','Station Full Name','Text')");
        pg_query("insert into \"DefineStations\"(\"StationTypeName\",\"StationField\",\"FieldType\") values('$tblname','Station Shef Code','Text')");


}
  $sql_query="SELECT * FROM \"tblStationType\" where \"StationType\"='$tblname'";
  $result_set=pg_query($sql_query);
  if(pg_num_rows($result_set)==0)
  {
pg_query("insert into \"tblStationType\"(\"StationType\") values('$tblname')");
}
$_SESSION["StationType"] = $tblname;
    
}


if(isset($_GET['delete_id']))
{
    $StationType=   $_SESSION['StationType'];
    $id= $_GET['delete_id'];
    $sql_query="DELETE FROM \"DefineStations\" WHERE \"StationTypeName\"='$StationType' and \"StationField\"='$id'";
    pg_query($sql_query);
pg_query("ALTER TABLE \"".str_replace(' ', '_',$StationType)."\" DROP COLUMN \"".str_replace(' ', '_',$id)."\"");
    header("Location: $_SERVER[PHP_SELF]");
}
if (isset($_GET['fieldname']))
 {
$StationType=   trim($_SESSION["StationType"]);
 $fieldname=    trim($_GET['fieldname']);
 $fieldtype=    trim($_GET['fieldtype']);

$sql_query="SELECT * FROM \"DefineStations\" where \"StationTypeName\"='$StationType' and \"StationField\"='$fieldname'";
    $result_set=pg_query($sql_query);
    if(pg_num_rows($result_set)==0)
    {
    

 if (isset($_GET['comboboxvalues'])) {
     $comboboxvalues=  trim($_GET['comboboxvalues']);
    pg_query("insert into \"DefineStations\"(\"StationTypeName\",\"StationField\",\"FieldType\",\"ComboxValues\") values('$StationType','$fieldname','$fieldtype','$comboboxvalues')");
pg_query("alter table \"".str_replace(' ', '_',$StationType)."\"add \"".str_replace(' ', '_',$fieldname)."\" text");
 }
 else{
    pg_query("insert into \"DefineStations\"(\"StationTypeName\",\"StationField\",\"FieldType\") values('$StationType','$fieldname','$fieldtype')");
 pg_query("alter table \"".str_replace(' ', '_',$StationType)."\"add \"".str_replace(' ', '_',$fieldname)."\" text");

// echo "$StationType";
 }
}
else
{
 if (isset($_GET['comboboxvalues'])) 
 {
   $data=$_SESSION["keyfield"];
    $comboboxvalues= $_GET['comboboxvalues'];

   pg_query("update \"DefineStations\" set \"StationField\"='$fieldname',\"FieldType\"='$fieldtype',\"ComboxValues\"='$comboboxvalues' where \"StationTypeName\"='$StationType' and \"StationField\"='$data'");

//pg_query("alter table \"".str_replace(' ', '_',$StationType)."\" RENAME COLUMN \"".str_replace(' ', '_',$data)."\" to \"".str_replace(' ', '_',$fieldname)."\" text");
 }
 else{
  $data=$_SESSION["keyfield"];

   pg_query("update \"DefineStations\" set \"StationField\"='$fieldname',\"FieldType\"='$fieldtype' where \"StationTypeName\"='$StationType' and \"StationField\"='$data'");
  //pg_query("alter table \"".str_replace(' ', '_',$StationType)."\" RENAME COLUMN \"".str_replace(' ', '_',$data)."\" to \"".str_replace(' ', '_',$fieldname)."\" text");

 }
}
  header("Location: newStation.php");
}

?>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <!-- Optional Bootstrap theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

    <!-- Include Bootstrap CSS -->
 
    <script src="js/jquery-1.8.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="../dist/jquery.wizard1.js"></script>

  
   
    <link href="../dist/jquery.wizard.css" rel="stylesheet">
 <br><br>

      <div class="panel panel-primary" style="width:90%;margin: 0 auto;"  >
         <div class="panel-heading" style="background-color:#4A7BDF;color:white"><center><b style="font-size:15px;">Add/Edit Station type</b></center></div>
  <div class="panel-body">
 <div data-wizard-init>
      <ul class="steps">
      <li data-step="1">Step 1</li>
      <li data-step="2">Step 2</li>
   
    

      </ul></div>
      <br>
  <div  id="stn">
      <center>
                      <div class="content">
                                         <div class="alert alert-info" style="font-family:Arial;">
 <p><b> Please Enter Station Type</b></p>
</div>
</div>
    

<label style="font-weight: bold;">Station Type Name</label>
<form name="stncreateform" action="newStation.php">
<input type="text" name="stntype" id="stntype" style="height: 30px;width: 300px" style="width:300px" placeholder="Station Type Name" value="<?php if (isset($_SESSION['StationType'])) 
{
	$_SESSION['StationType_show']=trim($_SESSION['StationType']);
} if (isset($_SESSION['StationType_show'])) { echo $_SESSION['StationType_show']; }?>" <?php if (isset($_SESSION['StationType_show'])) { if($_SESSION['StationType_show']!="") echo 'disabled';$_SESSION['StationType_show']=""; }?> class="form-control" Required  oninvalid="this.setCustomValidity('Please Enter Station type Name!')" oninput="setCustomValidity('')"/> 
<br>
<button class="btn btn-primary" type="submit">Next</button>
<button type="button" onclick="cancel()" class="btn btn-danger" >Cancel</button>
</form>
<center>
</div>
</div>
  </div>
  <script type="text/javascript">
    function cancel()
    {
       window.location.href="/HydrometV2/stations.php";
    }

  </script>
  
  
  
  
	
	
	</div>
	</div>
	</div>
	</div>
	</div>
	
	
	

							<?php
							//	include("includes/footer.php");
							?>
							<?php
							//	include("includes/link2.php");
							?>
</body>
</html>
