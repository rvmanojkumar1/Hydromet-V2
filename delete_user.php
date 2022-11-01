<?php
include_once 'database.php';
include_once 'adminheader.php';
if (!isset($_POST["users"])) {
        echo "<script>alert('Please Select User!');window.location.href='deleteuser.php';</script>";
        return;
    }
$rowCount = count($_POST["users"]);
    if($rowCount > 0) {
        pg_query('UPDATE "tblloginandregister" SET enabled = false');
        pg_query('UPDATE "tblAlarmType2User" SET enabled = false');
    }
    for($i=0;$i<$rowCount;$i++) {
        // pg_query("DELETE FROM \"tblloginandregister\" WHERE \"Username\" ='" . $_POST["users"][$i] . "'");
        // pg_query("DELETE FROM \"tblAlarmType2User\" WHERE \"Username\" ='" . $_POST["users"][$i] . "'");
        pg_query("UPDATE \"tblloginandregister\" SET enabled = true WHERE \"Username\" = '" . $_POST["users"][$i] . "'");
        pg_query("UPDATE \"tblAlarmType2User\" SET enabled = true WHERE \"Username\" = '" . $_POST["users"][$i] . "'");
    }
header("Location:deleteuser.php");
?>