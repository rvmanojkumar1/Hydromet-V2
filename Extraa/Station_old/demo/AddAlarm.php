<?php
include_once ('database.php');


function changeNumber($temp)
{

}

$AlarmType="";
$AlarmName="";
if(isset($_POST['AlarmType']))
{
    $AlarmType=$_POST['AlarmType'];
    $AlarmName=$_POST['alarm_name'];
    //Given AlarmType is taken into variable $AlarmType and
//Given alarm_name is taken into variable $alarm_name

pg_query("insert into \"tblAlarmType\"(\"AlarmType\") values('$AlarmName')");
//inserted into table "tbleAlarmType" when Add Alarm is selected

}

pg_query("delete from \"tblAlarmType\" where \"AlarmType\"='$AlarmName'");
//Deleted from table "tbleAlarmType" when delete Alarm is selected matching with the AlarmType
pg_query("delete from \"tblAlarm2Sensor\" where \"AlarmType\"='$AlarmType' and \"AlarmName\"='$AlarmName'");
//Deleted from table "tblAlarm2Sensor" when delete Alarm is selected matching with the AlarmType and AlarmName
pg_query("delete from \"tblAlarmType2User\" where \"AlarmType\"='$AlarmType' and \"AlarmName\"='$AlarmName'");
//Deleted from table "tblAlarmType2User" when delete Alarm is selected matching with AlarmType and AlarmName



   




$range=$_POST['range'];
$rangeTo=$_POST['rangeTo'];
//Given range is taken into variable $range and
//Given rangeTo is taken into variable $rangeTo

//$description=$_POST['description']; 
 $AlarmEmail=$_POST['alarm'];
 //Given alarm is taken into variable $AlarmEmail
if (trim($AlarmType)=="single") {
//if $Alarm Type is Single.

      $set_change=$_POST['set_change'];
      //Given set_change is taken into variable $set_change and

    $Deadband=$_POST['deadband'];
//Given Deadband is taken into variable $Deadband

$SearchStation=$_POST['SearchStation'];
//Given SearchStation is taken into variable $SearchStation

    $Sensors=$_POST['Sensors'];
    //Given Sensors is taken into variable $Sensors

    $type=$_POST['type'];
    //Given type is taken into variable $type

    $Threshold=$_POST['Threshold'];
    //Given Threshold is taken into variable $Threshold
     $Time="0";
    if (trim($_POST['Time'])!="") {
    $Time=$_POST['Time'];
    //Given Time is taken into variable $Time
    }
   
$shef_code= getStationShef(trim($SearchStation));
//Calls the function getStationShef to get the shef code for the variable $SearchStation

$sen_shef= getSensorShef(trim($Sensors),trim($SearchStation));
//Calls the function getStationShef to get the shef code for the variable $SearchStation and $Sensor

$q2="insert into \"tblAlarm2Sensor\"(\"AlarmType\",\"Station_Full_Name\",\"AlarmName\",\"Time\",\"Type\",\"SensorName\",\"Value\",\"change\",\"range\",\"Station_Shef_Code\",\"Sensor_Shef_Code\",\"AlarmEmail\",\"Deadband\",\"RangeTo\") values('$AlarmType','$SearchStation','$AlarmName','$Time','$type','$Sensors','$Threshold','$set_change','$range','$shef_code','$sen_shef','$AlarmEmail',' $Deadband','$rangeTo')";
//The query to insert the data into the table "tblAlarm2Sensor" is stored into the variable $q2

//echo $q2;
pg_query($q2);
//Query execution

}
else
{
  $SearchStation=unserialize($_POST['SearchStation']);
  //Given SearchStation is taken into variable $SearchStation by unserializing the data in it

    $set_change=unserialize($_POST['set_change']);
    //Given set_change is taken into variable $set_change by unserializing the data in it

$SearchStation=unserialize($_POST['SearchStation']);
//Given SearchStation is taken into variable $SearchStation by unserializing the data in it

    $Sensors=unserialize($_POST['Sensors']);
    //Given Sensors is taken into variable $Sensors by unserializing the data in it

    $type=unserialize($_POST['type']);
    //Given type is taken into variable $type by unserializing the data in it

    $Threshold=unserialize($_POST['Threshold']);
    //Given Threshold is taken into variable $Threshold by unserializing the data in it

     $Time;
    if (isset($_POST['Time'])) {
      //If Time is posted
    $Time=unserialize($_POST['Time']);
    //Given Time is taken into variable $Time by unserializing the data in it

    //var_dump($Time);

    }

  for ($i=0;$i<count($SearchStation);$i++) {
    //for the count of $SearchStation the for loop continues
$T="0";
if (isset($Time[$i])&&trim($Time[$i])!="") {
  //if $Time[$i] is set and is not NULL
$T=$Time[$i];
//$Time[$i] is set to varible $T
}
$shef_code= getStationShef(trim($SearchStation[$i]));
//Calls the function getStationShef to get the shef code for the variable $SearchStation

$sen_shef= getSensorShef(trim($Sensors[$i]),trim($SearchStation[$i]));
//Calls the function getStationShef to get the shef code for the variable $SearchStation and $Sensor

$q2="insert into \"tblAlarm2Sensor\"(\"AlarmType\",\"Station_Full_Name\",\"AlarmName\",\"Time\",\"Type\",\"SensorName\",\"Value\",\"change\",\"range\",\"Station_Shef_Code\",\"Sensor_Shef_Code\",\"AlarmEmail\",\"RangeTo\") values('$AlarmType','$SearchStation[$i]','$AlarmName','$T','$type[$i]','$Sensors[$i]','$Threshold[$i]','$set_change[$i]','$range','$shef_code','$sen_shef','$AlarmEmail','$rangeTo')";
//The query to insert the data into the table "tblAlarm2Sensor" is stored into the variable $q2

//echo "<br><br>".$q2;
pg_query($q2);

}
}
  if(isset($_POST['users'] ))
    //if User is posted
  {
$AlarmName=trim($AlarmName);
//$AlarmName is trimmed and is set to same variable

$AlarmType=trim($AlarmType);
//$AlarmType is trimmed and is set to same variable

$rowCount = $_POST["users"] ;
////User is posted into $rowCount
foreach ($rowCount as  $value1) {
  $t=$_POST[$value1];
  $query2="INSERT into \"tblAlarmType2User\" (\"AlarmType\",\"Username\",\"communicationway\",\"AlarmName\") VALUES ('$AlarmType','$value1','$t','$AlarmName')";
  //insert query to insert data into the table "tblAlarmType2User" 
 $rsu = pg_query($query2);
 //executes query
if ($rsu) {
//echo('inserted');
}
}


}

function getSensorShef($sensor_name,$stn)
{
  $sensor_name=trim($sensor_name);
  $stn=trim($stn);
  $result_set=pg_query("select \"SHEF\" from \"SensorValues\" where \"Sensor\"='$sensor_name' and \"StationFullName\"='$stn'");
  //we select "SHEF" from the table "SensorValues" with the matching conditions 
$row_types=pg_fetch_array($result_set);
//the result of $result_set is fetched into the array and stored into the variable $row_types

return $row_types[0];
}
function getStationShef($shef)
{
  $stn_name="";
  $stn_types_set=pg_query("select \"StationType\" from \"tblStationType\"");
  //select StationType from the table "tblStationType" and the reuslt is set to $stn_types_set
while ($row_types=pg_fetch_array($stn_types_set)) {
$table=str_replace(" ", "_", $row_types[0]);
 $stn_set= pg_query("select \"Station_Shef_Code\" from \"$table\" where \"Station_Full_Name\"='$shef'");
 //we select "Station_shef_code" from table stationtype with matching the condition

 if (pg_num_rows($stn_set)>0) {
  //if the number of rows of the result in variable $stn_set > 0

   # code...
 $row=pg_fetch_array($stn_set);
 //fetch array from $stn_set into the variable $row
 
$stn_name=$row[0];
 }

}

 return $stn_name;
}
//header("Location:\\HydrometV2\\alarm.php");
header("Location:\\HydrometV2\\alarm.php?Message=popup");

?>


