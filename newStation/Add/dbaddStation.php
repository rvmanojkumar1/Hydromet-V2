<?php
include_once 'database.php';
$stntype;
if(isset($_POST['stntypetable']))
{
	$table=$_POST['stntypetable'];
  $stntype=$_POST['stntypetable'];
$table=str_replace(" ", "_",$table);

$i=0;

$_SESSION["keyval"];
$_SESSION["keyfield"];
	   $sql_query="SELECT \"StationField\" FROM \"DefineStations\" WHERE \"StationTypeName\"='$table'";
  $result_set=pg_query($sql_query);
  if(pg_num_rows($result_set)>0)
  {
  	     while($row=pg_fetch_row($result_set))
    { 
    	$fname=str_replace(' ', '_',$row[0]);
$val= $_POST["$fname"];
if ($i==0) 
{
pg_query("insert into \"$table\"(\"$fname\") values('$val')");
$_SESSION["keyval"]=$val;
$_SESSION["keyfield"]=$fname;

$i++;
}
else if ($i!=0)
 {
 	$keyval=$_SESSION['keyval'];
 	$keyfield=$_SESSION["keyfield"];
	pg_query("update \"$table\" set \"$fname\"='$val' WHERE \"$keyfield\"='$keyval'");

}

}
  	
echo "<script>alert('Station has been created successfully!')</script>";
  	}

}

if(isset($_POST['chekedsensor']))
{
$checkbox1=$_POST['chekedsensor'];
$sensors="";
global $stntype ;//=$_POST['stntypetable'];
$stnname=$_POST['Station_Full_Name'];
foreach($checkbox1 as $chk1)  
   {  
    $sql_query="SELECT \"HydroMetParamsName\" FROM tblhydrometparamstype WHERE \"HydroMetParamsTypeId\"='$chk1'";

  $mul=$_POST[str_replace(' ', '_',$row[0])];
  $Addition=$_POST['A'.str_replace(' ', '_',$row[0])];

         $result_set=pg_query($sql_query);
  if(pg_num_rows($result_set)>0)
  {
    try
    {
    $row=pg_fetch_row($result_set);
    
      $sql_query="INSERT into \"SensorValues\"(\"StationTypeName\",\"StationFullName\",\"Multiple\",\"Addition\",\"Sensor\") Values('$stntype','$stnname','$mul','$Addition',' $row[0]')";

 pg_query($sql_query);
echo "<script>alert($stntype)</script>";
echo "<script>alert($stnname)</script>";
}catch(Exception $ex)
{
echo "<script>alert($ex)</script>";
}
   } 
   
  }
  echo "<script>alert('Sensor values added successfully!')</script>";
}
?>