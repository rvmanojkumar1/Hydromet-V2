	<?php
								include("includes/link.php");
							?>

							<?php
								include("includes/adminheader.php");
							?>
<?php
include_once ('database.php');
function changeNumber($temp)
{

}


   
if(isset($_SESSION['typeE'] )) 
{
  $temp=trim($_SESSION['typeE'] );
  if($temp=="Threshold_Value")
  {
  $y=trim($_SESSION['SensorE'] );
$sensor_name=$_SESSION['SensorE'];
  $sql_query1="select \"ID\" from \"SensorValues\" where  \"Sensor\"='$y' ";
  $varId=pg_query($sql_query1);
  $q111=(int)$varId;
  try
{
	$stn_shefcode=trim($_SESSION['stn_shefcode']);
	 $typeE=trim($_SESSION['typeE']);
  $a1=trim($_SESSION['AlarmType'] );
  $a2=trim($_SESSION['Station_Full_Name1'] );
  $a3=trim($_SESSION['txtmin1'] );
  $a4=trim($_SESSION['ThresholdValueMax1'] );
  $a5=trim($_SESSION['ThresholdPercentageMin1'] );
  $a6=trim($_SESSION['ThresholdPercentageMax1'] );
  echo trim($_SESSION['Station_Full_Name1'] )."";

  $var22="UPDATE  \"tblAlarm2Sensor\"  SET \"MinVal\"= '$a3',\"MaxVal\"='$a4',\"RateMin\"='$a5',\"RateMax\"='$a6',\"Station_Full_Name\"='$a2',\"SensorName\"='$sensor_name',\"Type\"='$typeE',\"Station_Shef_Code\"='$stn_shefcode' WHERE \"AlarmType\"= '$a1'";

  pg_query($var22);
}
catch (Exception $e){}

}
if($temp=="Rate_of_Change")
{
   $y=trim($_SESSION['SensorE'] );
 
  $sql_query1="select \"ID\" from \"SensorValues\" where  \"Sensor\"='$y' ";
  $varId=pg_query($sql_query1);
 
 try
 {
 $a1=trim($_SESSION['AlarmType'] );
  $a2=trim($_SESSION['Station_Full_Name1'] );
$sensor_name=trim($_SESSION['SensorE']);
$stn_shefcode=trim($_SESSION['stn_shefcode']);
 $c=trim($_SESSION['ROIMin1'] );
$d=trim($_SESSION['ROIMax1'] );
$e=trim($_SESSION['ROIPMin1'] );
 $f=trim($_SESSION['ROIPMax1'] );
$g=trim($_SESSION['ROITime1'] );
$typ=trim($_SESSION['typeE'] );
if($g=="")
{
  
$g=(int)"0";
}
else
{
  $g=(int)$g;

}

$q2="UPDATE  \"tblAlarm2Sensor\"  SET \"MinVal\"= '$c',\"MaxVal\"='$d',\"RateMin\"='$e',\"RateMax\"='$f',\"Time\"='$g',\"Type\"='$typ',\"Station_Full_Name\"='$a2',\"SensorName\"='$sensor_name',\"Station_Shef_Code\"='$stn_shefcode' WHERE \"AlarmType\"= '$a1'";
pg_query($q2);
 }
 catch (Exception $e) {}
}


  if(isset($_GET['users']))
  {
$a1=$_SESSION['AlarmType'];
$rowCount = $_GET["users"];
foreach ($rowCount as  $value1) {

$var12="select \"Username\",\"AlarmType\" from \"tblAlarmType2User\" where \"Username\"='$value1' and \"AlarmType\"='$a1'";
$ds=pg_query($var12);
$ddd=pg_fetch_array($ds);
if(pg_num_rows($ds)==0)
{
   $t=$_GET[$value1] ;
  $query2="INSERT into \"tblAlarmType2User\" (\"AlarmType\",\"Username\",\"communicationway\") VALUES ('$a1','$value1','$t')";
 $rsu = pg_query($query2);
if ($rsu) {
echo('inserted');
}
}
else
{
   $t=$_GET[$value1];
   $db="update \"tblAlarmType2User\" set \"Username\"='$value1',\"communicationway\"='$t' where \"AlarmType\"='$a1' and \"Username\"='$value1'";
   $rsu1 = pg_query($db);
if ($rsu1) {
}
}
}
 }
 ?>
 <script>
 window.location.href="\\HydrometV2\\alarm.php?Message1=popup";
</script>
<?php
}
?>


