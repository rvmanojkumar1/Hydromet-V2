<?php
include 'database.php';
$sensor=$_POST['sensor'];
$year=date("y");

$result_stn=pg_query("select \"StationFullName\",\"StationShefCode\" from \"tblStationLocation\"");
//All the stationFullName and the StationShefCode is selected from the table "tblStationLocation" and are sent to variable $result

  pg_query("update \"tblStationLocation\" set \"CurrentValue\"=''");
  // In the Table "tblStationLocation" all current values are set to ' '

while ($row_stn=pg_fetch_array($result_stn))
	//while the $result_stn is fetched into the array into the $row_stn the loop continues
{

$result_sen=pg_query("select \"SHEF\",\"SensorType\" from \"SensorValues\" WHERE \"Sensor\"='$sensor' and \"StationFullName\"='$row_stn[0]'");
//All the Shef column data is selected from the SensorValues with a condition matching the selected sensor and stationFullName


if (pg_num_rows($result_sen)>0) {
//if the number of rows for the $result_sen variable are > 0 

$row_sen=pg_fetch_array($result_sen);
//From the query we fetch $result_sen into array to variable $row_sen

$valuecol;
if(trim($row_sen[1])=="Real")
	//if $row_sen[1]==Real
	$valuecol="Value";
else
$valuecol="VirtualValue";
$result_sen_id=pg_query("select \"HydroMetParamsTypeId\" from \"tblHydroMetParamsType\" where \"HydroMetShefCode\"='$row_sen[0]'");
//The HydroMetParamsTypeId is been selected from the table "tblHydroMetParamsType" matching the condition "HydroShefCode"= data of $row_sen[0]

//echo "$valuecol";
if (pg_num_rows($result_sen_id)>0) {
	//if the number of rows for the $result_sen_id variable are > 0 


$row_sen_id=pg_fetch_array($result_sen_id);
//From the query we fetch $result_sen_id into array to variable $row_sen_id

$tableName="tblStation_$row_stn[1]_$year";
if($tableName=='tblStation_SF10_18')

{
	//echo "SELECT  distinct on (\"HydroMetParamsTypeId\") \"HydroMetParamsTypeId\",\"Year\", \"Month\", \"Day\", \"Hour\", \"Minute\", \"Second\",  \"Value\",  \"Interval\", \"VirtualValue\", sensortype, \"Flag\", \"AlarmFlag\" FROM \"'".$tableName."'\" where \"HydroMetParamsTypeId\"='$row_sen_id[0]'  order by \"HydroMetParamsTypeId\",('20'||\"Year\"::text ||'-'|| \"Month\"::text ||'-'|| \"Day\" ::text ||' '|| \"Hour\"::text || ':' || \"Minute\" ::text || ':' || \"Second\")::timestamp desc";
}
//In the following the query we select the time stamp from the various tables and with a condition given below

$result_val=pg_query("SELECT  distinct on (\"HydroMetParamsTypeId\") \"HydroMetParamsTypeId\",\"Year\", \"Month\", \"Day\", \"Hour\", \"Minute\", \"Second\",  \"$valuecol\",  \"Interval\", sensortype, \"Flag\", \"AlarmFlag\" FROM \"'".$tableName."'\" where \"HydroMetParamsTypeId\"='$row_sen_id[0]'  order by \"HydroMetParamsTypeId\",('20'||\"Year\"::text ||'-'|| \"Month\"::text ||'-'|| \"Day\" ::text ||' '|| \"Hour\"::text || ':' || \"Minute\" ::text || ':' || \"Second\")::timestamp desc");
//echo pg_num_rows($result_val)."--".$row_stn[0];

if (pg_num_rows($result_val)>0) {
	
$row_data=pg_fetch_array($result_val);
//From the query we fetch $result_val into array to variable $row_data

$value=$row_data[$valuecol];
//$value1=$row_data['VirtualValue'];
//$value2=$row_data['sensortype'];


	pg_query("update \"tblStationLocation\" set \"CurrentValue\"='$value' where \"StationFullName\"='$row_stn[0]'");
	// In the Table "tblStationLocation" all current values are set to $value where the condition stationFullName is matched
}
}
}
else
{
	pg_query("update \"tblStationLocation\" set \"CurrentValue\"='' where \"StationFullName\"='$row_stn[0]'");
	// In the Table "tblStationLocation" all current values are set to ' ' where the condition stationFullName is matched
}

}

?>