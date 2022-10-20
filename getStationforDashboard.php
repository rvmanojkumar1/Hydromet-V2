<?php
include_once "database.php";

$data=array();


$stn_type_table= $_GET['Stations'];//$row_type[0];

	$result_set=pg_query("select \"Station_Full_Name\",\"Station_Shef_Code\" from \"$stn_type_table\"");

 	while ( $row=pg_fetch_array($result_set)) {

$data[]=$row[1];

 }
 echo json_encode($data);
?>