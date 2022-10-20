<?php
include_once "database.php";
session_start();
$data=array();

$username=trim($_SESSION['username']);

$result=pg_query("select \"organization\" from \"tblloginandregister\" where \"Username\"='$username'");
	$row=pg_fetch_array($result);
$company=$row[0];

$searchTerm = $_GET['term'];
$searchTermU=strtoupper($searchTerm);
$searchTermL=strtolower($searchTerm);
if ($_GET['type']=="Climate") 
{
$table="Climate";
}
if ($_GET['type']=="Rain") {
$table="Rainfall";
}
if ($_GET['type']=="Reservoir") {
$table="Reservoir";
}
if ($_GET['type']=="River") {
$table="River_gauge";
}



	$result_set=pg_query("select \"Station_Full_Name\",\"Station_Shef_Code\" from \"$table\" join \"tblCompany2Station\" on \"Station_Shef_Code\"= \"Station\" where (\"Station_Full_Name\" like '%$searchTerm%' OR \"Station_Full_Name\" like '%$searchTermU%' OR \"Station_Full_Name\" like '%$searchTermL%' OR \"Station_Shef_Code\" like '%$searchTerm%' OR \"Station_Shef_Code\" like '%$searchTermU%'  OR \"Station_Shef_Code\" like '%$searchTermL%') and  \"Company\"='$company' ");


 	while ($row=pg_fetch_array($result_set)) {

$data[]=$row[0];
 	}

 echo json_encode($data);
?>