<?php
include ('database.php');

$stn=$_GET['stn'];
//$stn is the input selected station

$sql="SELECT \"lat\",lon FROM \"tblStationLocation\" where \"StationFullName\"='$stn'";
//we select lat and lon from the table "tblStationLoation" with the matching condition where StationFullName = $stn
//echo $sql;
$result=pg_query("$sql");

$row=pg_fetch_array($result);

$latlon=$row[0]."#".$row[1];

//echo $latlon;


?>