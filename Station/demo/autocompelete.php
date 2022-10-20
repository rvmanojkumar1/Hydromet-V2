<?php
include_once "database.php";

$data=array();
$result=pg_query("SELECT  \"StationType\" FROM \"tblStationType\"");
$searchTerm = $_GET['term'];
$searchTermU=strtoupper($searchTerm);
$searchTermL=strtolower($searchTerm);
while ( $row_type=pg_fetch_array($result)) {

$stn_type_table=$row_type[0];
	$result_set=pg_query("select \"Station_Full_Name\",\"Station_Shef_Code\" from \"".str_replace(' ','_', $row_type['StationType']) ."\" where \"Station_Full_Name\" like '%$searchTerm%' OR \"Station_Full_Name\" like '%$searchTermU%' OR \"Station_Full_Name\" like '%$searchTermL%' OR \"Station_Shef_Code\" like '%$searchTerm%' OR \"Station_Shef_Code\" like '%$searchTermU%'  OR \"Station_Shef_Code\" like '%$searchTermL%'");
 	while ( $row=pg_fetch_array($result_set)) {

$data[]=$row[0];
 	}

 }
 echo json_encode($data);
?>