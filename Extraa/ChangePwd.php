<?php

if(isset($_POST['Username'])&&isset($_POST['PreviousPassword']))
{
$user=$_POST['Username'];

	$passw=$_POST['PreviousPassword'];
	$pwd = hash("sha256", $passw);


$pass=$_POST['newpassword'];
$NewPwd = hash("sha256", $pass);

$cpass=$_POST['confrmpassword'];
$newConfirmPwd= hash("sha256", $cpass);

$checkPwd=pg_query("select * from \"tblloginandregister\" where \"Username\"='$user'");
if(pg_num_rows($checkPwd)>0)
{
	$dbpwd=pg_fetch_array($checkPwd);
	if($dbpwd["Login_password"]===$pwd)
	{
	pg_query("update \"tblloginandregister\" set \"Login_password\"='$NewPwd',\"Confirm_password\"='$newConfirmPwd' where \"Username\"='$user'");
   echo	'<script>alert("Password changed!!")</script>';
	}
	else
	{
		echo "<script>alert('Current Password is incorrect');</script>";
	}
}
//header("Location:changepassword.php");
}
?>