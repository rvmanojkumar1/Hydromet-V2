<?php
include_once "database.php";

$station=$_GET["Stations"];

$station=str_replace(" ", "_", $station);
 $stn_type_set=pg_query("SELECT \"StationField\" FROM \"DefineStations\" where \"StationTypeName\"='$station'");
 $station_Field=array();
  if(pg_num_rows($stn_type_set)>0)
 {
	  while($station_Field_set=pg_fetch_array($stn_type_set))
	  {
 $station_Field[]=$station_Field_set[0];
	  }
	  echo json_encode($station_Field);
	}

?>