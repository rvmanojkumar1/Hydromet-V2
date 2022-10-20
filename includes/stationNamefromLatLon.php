<?php
include ('database.php');

$lat=$_GET['lat'];
$lon=$_GET['lon'];
//Given lat is taken into variable $lat and
//Given lon is taken into variable $lon

//$sql="select \"StationFullName\" from \"tblStationLocation\" where \"lat\"='$lat' and \"lon\"='$lon'";
//$sql="SELECT \"StationFullName\" FROM \"tblStationLocation\" WHERE ST_Distance_Sphere(geom, ST_MakePoint($lon,$lat)) <=1 * 100";
$sql="SELECT \"StationFullName\" FROM \"tblStationLocation\" ORDER BY ST_Distance(geom,ST_GeomFromText('POINT($lon $lat)', 4326))";
//we select StationFullName from the table "tblStationLocation" order by the point of longitude and latitude given

//echo $sql;
$result=pg_query("$sql");
//the result of the above query is saved into $result

$row=pg_fetch_array($result);
//The result data in the $result is fetched into array and is saved into the variable $row

$stn_name=$row[0];

echo $stn_name;


?>