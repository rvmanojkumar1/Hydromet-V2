<?php
						       include_once 'database.php';
						


$name= trim($_POST["company_name"]);

$phoneno= trim($_POST["company_phone_no"]);
$email= trim($_POST["company_email"]);
$address= trim($_POST["company_address"]);

pg_query("delete from \"tblCompany\" where \"Name\"='$name'");
pg_query("delete from \"tblCompany2Station\" where \"Company\"='$name'");

pg_query("insert into \"tblCompany\" (\"Name\",\"phone_no\",\"email\",\"address\") VALUES('$name','$phoneno','$email','$address')");


$station_list= $_POST["station_list"];

foreach ($station_list as $key => $value) 
{
	pg_query("insert into \"tblCompany2Station\" (\"Company\",\"Station\") values('$name','$value')");
	  
}








header("Location:\\HydrometV2\\Company.php?Message=popup");




							?>