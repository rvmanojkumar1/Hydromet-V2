<?php
include_once "database.php";
include_once 'includes/editCompany.php';
session_start();
$data=array();

$company=$_SESSION["company"];


$result=pg_query("SELECT  \"StationType\" FROM \"tblStationType\"");
$searchTerm = $_GET['term'];
$searchTermU=strtoupper($searchTerm);
$searchTermL=strtolower($searchTerm);

while ( $row_type=pg_fetch_array($result)) {

$stn_type_table=$row_type[0];
	
	if($company=='Hydromet'){
	$result_set=pg_query("select \"Station_Full_Name\",\"Station_Shef_Code\" from \"".str_replace(' ','_', $row_type['StationType']) ."\" where \"Station_Full_Name\" like '%$searchTerm%' OR \"Station_Full_Name\" like '%$searchTermU%' OR \"Station_Full_Name\" like '%$searchTermL%' OR \"Station_Shef_Code\" like '%$searchTerm%' OR \"Station_Shef_Code\" like '%$searchTermU%'  OR \"Station_Shef_Code\" like '%$searchTermL%'");
	}
	else{
		$result_set=pg_query("select DISTINCT \"Station_Full_Name\",\"Station_Shef_Code\" from \"".str_replace(' ','_', $row_type['StationType']) ."\" join \"tblCompany2Station\" on \"Station_Shef_Code\"= \"Station\" where (\"Station_Full_Name\" ilike '%$searchTerm%' OR \"Station_Full_Name\" ilike '%$searchTermU%' OR \"Station_Full_Name\" ilike '%$searchTermL%' OR \"Station_Shef_Code\" ilike '%$searchTerm%' OR \"Station_Shef_Code\" ilike '%$searchTermU%'  OR \"Station_Shef_Code\" ilike '%$searchTermL%') and  \"Company\"='$company' ");
	}
 	while ($row=pg_fetch_array($result_set)) {

$data[]=$row[0];
 	}

 }
 echo json_encode($data);
?>