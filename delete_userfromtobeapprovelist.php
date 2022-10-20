<?php
include_once 'database.php';
include_once 'adminheader.php';
if (!isset($_POST["users"])) {
echo "<script>alert('Please Select User!');window.location.href='approveuser.php';</script>";
return;
}
$rowCount = count($_POST["users"]);
for($i=0;$i<$rowCount;$i++) {
pg_query("DELETE FROM \"tblloginandregister\" WHERE \"Username\" ='" . $_POST["users"][$i] . "'");
}
header("Location:approveuser.php");
?>