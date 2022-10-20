<?php
session_start();

include_once 'database.php';
include_once 'editcompany.php';

$company=$_SESSION["company"];

 $settings=pg_fetch_array(pg_query("select \"DateFormat\",\"DecimalPlaces\" from \"tblLogo\""));
 //From the query it selects date format and also the number of decimal places for the value

 // echo "select \"DateFormat\",\"DecimalPlaces\" from \"tblLogo\"";
 //echo "select \"CurrentValue\",lat,lon,\"StationShefCode\",\"AlarmFlag\" from \"tblStationLocation\"";
//for all stations $result=pg_query("select \"CurrentValue\",lat,lon,\"StationShefCode\",\"AlarmFlag\" from \"tblStationLocation\"");
//for specific station $result=pg_query("select DISTINCT \"CurrentValue\",lat,lon,\"StationShefCode\",\"AlarmFlag\" from \"tblStationLocation\", \"tblCompany2Station\" where \"StationShefCode\" = \"Station\" and \"Company\" = 'Sutter'");
if($company=='Hydromet'){

  $result=pg_query("select \"CurrentValue\",\"lat\",\"lon\",\"StationShefCode\",\"AlarmFlag\" from \"tblStationLocation\"");
}
else{

	$result=pg_query("select DISTINCT \"CurrentValue\",lat,lon,\"StationShefCode\",\"AlarmFlag\" from \"tblStationLocation\", \"tblCompany2Station\" where \"StationShefCode\" = \"Station\" and \"Company\" = '$company' order by \"StationShefCode\"");
}
$output=[];
//This query selects the data of current value along with the shef code with respective to the lat and lon of the station

//echo pg_num_rows($result);
while ($row=pg_fetch_array($result)) {
	// In the condition we fetch the result of $result query into $row as array
	$str.=$row[0]."--";
if($row[0]!=" ")
{
if (trim($row[0])!="") {
	
  $output[]=number_format(floatval($row[0]),$settings[1],'.','')."#".$row[1]."#".$row[2]."#".$row[3]."#".$row[4];
  //The data is set with the setting selected and in row array after each array element '#' is been added like after row[0]#row[1]....
  
}else{
   // $output[]=$row[0]."#".$row[1]."#".$row[2]."#".$row[3]."#".$row[4];
   }
}
}
//echo $str;
echo json_encode($output);

 
//json_encode
?>