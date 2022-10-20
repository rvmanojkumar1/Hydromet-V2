<?php
include_once "database.php";


$allusers='';
$dashboard_type='';
$allStations='';
$dashboard_name='';
$allSensorList='';
$no_of_records='1';
$design_code='';
$allcapacity_list='';
$capacity_types='';
$ids='';
//if (isset($_POST["Stations"])) {

	$allStations= $_POST["Stations"];


//}

if (isset($_POST["dashboard_type"])) 
{
$dashboard_type=$_POST["dashboard_type"];
}
if (isset($_POST["dashboard_name"])) {

$dashboard_name= $_POST["dashboard_name"];
pg_query("delete from \"DefineDashboard\" where \"Dashboard\"='$dashboard_name'");
}



if (isset($_POST["Sensors"])) {
$allSensorList =$_POST["Sensors"];

}

if (isset($_POST["no_of_record"])) {
	if (trim($_POST["no_of_record"])!='') 
$no_of_records=$_POST["no_of_record"];


}

if (isset($_POST["users"])) {
$users=$_POST["users"];
foreach ($users as  $value) {
	$allusers.=$value.";";
}
}
if (isset($_POST["capacity_list"])) {
$allcapacity_list =$_POST["capacity_list"];

}

if (isset($_POST["capacity_type"])) {

	$capacity_types=$_POST["capacity_type"];
}
if (isset($_POST["design_code"])) {

	$design_code=trim($_POST["design_code"]);
}
if (isset($_POST["ids"])) {

	$ids=trim($_POST["ids"]);
}


	$sql="INSERT INTO \"DefineDashboard\"(\"Station_Full_Name\", \"Dashboard\", \"Sensors\", \"no_of_records\", \"Users\",\"Capacity\", \"CapacityType\",\"DashboardType\",\"design_code\") VALUES ('$allStations', '$dashboard_name', '$allSensorList', '$no_of_records','$allusers','$allcapacity_list','$capacity_types','$dashboard_type','$design_code')";
	pg_query($sql);
	$sql="update tag_ids set tag_id='$ids'";
pg_query($sql);

header('Location: admindashboard.php?inserted=1');   

?>