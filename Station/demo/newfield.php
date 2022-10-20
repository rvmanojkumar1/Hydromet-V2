
<?php
include_once 'database.php';
session_start();
if (isset($_GET['fieldname']))
 {
$StationType=   $_SESSION["StationType"];
 $fieldname=    $_GET['fieldname'];
 $fieldtype=    $_GET['fieldtype'];
// $require="No";

$require=       $_GET['filedrequire'];


//$sql_query2="SELECT * FROM \"DefineStations\" where \"StationTypeName\"='$StationType' and \"StationField\"='$fieldname'";
   $data=$_SESSION["keyfield"];

$sql_query2="SELECT * FROM \"DefineStations\" where \"id\"='$data'";

    $result_set2=pg_query($sql_query2);

  echo pg_num_rows($result_set2);
   echo $StationType;
    echo $fieldname;
    if(pg_num_rows($result_set2)<1)
    {
   if (isset($_GET['comboboxvalues'])) {
     $comboboxvalues=   $_GET['comboboxvalues'];

    pg_query("insert into \"DefineStations\"(\"StationTypeName\",\"StationField\",\"FieldType\",\"ComboxValues\",\"Required\") values('$StationType','$fieldname','$fieldtype','$comboboxvalues','$require')");
pg_query("alter table \"".str_replace(' ', '_',$StationType)."\"add \"".str_replace(' ', '_',$fieldname)."\" text");
$_SESSION["keyfield"]="";

 }
 else{

    pg_query("insert into \"DefineStations\"(\"StationTypeName\",\"StationField\",\"FieldType\",\"Required\") values('$StationType','$fieldname','$fieldtype','$require')");
 pg_query("alter table \"".str_replace(' ', '_',$StationType)."\"add \"".str_replace(' ', '_',$fieldname)."\" text");
$_SESSION["keyfield"]="";

 }
}
else
{

 if (isset($_GET['comboboxvalues'])) 
 {
   $data=$_SESSION["keyfield"];
    $comboboxvalues= $_GET['comboboxvalues'];

   pg_query("update \"DefineStations\" set \"StationField\"='$fieldname',\"FieldType\"='$fieldtype',\"ComboxValues\"='$comboboxvalues',\"Required\"='$require' where  \"id\"='$data'");
 pg_query("alter table \"".str_replace(' ', '_',$StationType)."\"add \"".str_replace(' ', '_',$fieldname)."\" text");

   $_SESSION["keyfield"]="";
//pg_query("alter table \"".str_replace(' ', '_',$StationType)."\" RENAME COLUMN \"".str_replace(' ', '_',$data)."\" to \"".str_replace(' ', '_',$fieldname)."\" text");
 }
 else{
  $data=$_SESSION["keyfield"];

   pg_query("update \"DefineStations\" set \"StationField\"='$fieldname',\"FieldType\"='$fieldtype',\"Required\"='$require' where  \"id\"='$data'");
  //pg_query("alter table \"".str_replace(' ', '_',$StationType)."\" RENAME COLUMN \"".str_replace(' ', '_',$data)."\" to \"".str_replace(' ', '_',$fieldname)."\" text");
 pg_query("alter table \"".str_replace(' ', '_',$StationType)."\"add \"".str_replace(' ', '_',$fieldname)."\" text");

  $_SESSION["keyfield"]="";
 }
}
header("Location: newStation.php");
}
?>