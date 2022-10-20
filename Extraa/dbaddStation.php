<?php
include_once 'database.php';

if(isset($_POST['stntypetable']))
{
	$table=$_POST['stntypetable'];
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
   $_SESSION["stntypename"]="";	
echo "<script>alert('Station has been created successfully!')</script>";
  	}
}

?>