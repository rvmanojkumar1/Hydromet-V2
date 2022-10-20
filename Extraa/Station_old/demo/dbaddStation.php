<?php
include_once 'database.php';
$stntype;
$stnImages="";

if(isset($_SESSION["stntypename"]) && isset($_POST['Station_Shef_Code']))
{


		$lat=trim($_POST["Latitude"]);

		$lon=trim($_POST["Longitude"]);
		$stn_shef=trim($_POST['Station_Shef_Code']);
		$stn_name=trim($_POST['Station_Full_Name']);
		$temp_lat=explode(" ", $lat);
		$temp_lon=explode(" ", $lon);
		$sql="";
		try
		{
$lat1=DMS2Decimal($temp_lat[0],$temp_lat[1],$temp_lat[2],$temp_lat[3]);
$lon1=DMS2Decimal($temp_lon[0],$temp_lon[1],$temp_lon[2],$temp_lon[3]);
if (isset($temp_lat[3])) {
	
	$sql="insert into \"tblStationLocation\" (\"geom\",\"lat\",\"lon\",\"StationShefCode\",\"StationFullName\") values(ST_SetSRID(ST_MakePoint($lon1,$lat1),4326),'$lat','$lon','$stn_shef','$stn_name')";
	
}
else
{
	if ($lat!="0"&&$lon!="0") {
		# code...
	
	$sql="insert into \"tblStationLocation\" (\"geom\",\"lat\",\"lon\",\"StationShefCode\",\"StationFullName\") values(ST_SetSRID(ST_MakePoint($lon,$lat),4326),'$lat','$lon','$stn_shef','$stn_name')";
	}
}
	//echo $sql;

}catch(Exception $ex){
	
$sql="insert into \"tblStationLocation\" (\"geom\",\"lat\",\"lon\",\"StationShefCode\",\"StationFullName\") values(ST_SetSRID(ST_MakePoint($lon,$lat),4326),'$lat','$lon','$stn_shef','$stn_name')";

}


	    pg_query("delete from  \"tblStationLocation\" where \"StationShefCode\"='$stn_shef'");


	

	pg_query($sql);	
		//echo "stn ".$_SESSION["stntypename"];

if (isset($_POST["numberofphoto"]))
{
	
	$numberofphoto=$_POST["numberofphoto"];
define("DOC_ROOT", $_SERVER['DOCUMENT_ROOT']."/");
define("uploaddir", DOC_ROOT."HydrometV2/StationImages/");

	for ($i=0; $i <= $numberofphoto ; $i++) { 
		
	
if (isset($_FILES["photos_".$i]))
    {
	

$uploadfile =  basename($_FILES["photos_".$i]['name']);
if($uploadfile!='')
{
$stnImages.=$uploadfile.";";
}

move_uploaded_file($_FILES["photos_".$i]['tmp_name'], uploaddir.$uploadfile) ;
	

  }
  }
}

	$table=trim($_SESSION["stntypename"]);
  $stntype=trim($_SESSION["stntypename"]);
  $stn=trim($_POST['Station_Shef_Code']);
$table=str_replace(" ", "_",$table);

$stn_shef=trim($_POST['Station_Shef_Code']);


 $stn_result_rows=  pg_query("select * from \"$table\" where  \"Station_Shef_Code\"='$stn_shef'");
 //echo  "select * from \"$table\" where \"Station_Full_Name\"='$stn' or \"Station_Shef_Code\"='$stn_shef'";

 if(pg_num_rows($stn_result_rows)==0)
 {
$i=0;
 $stn_result_r=  pg_query("select * from \"$table\" where \"Station_Shef_Code\"='$stn_shef'");

 if (isset($stn_result_r)) {
 if (pg_num_rows($stn_result_r)>0) {
 echo "<script>alert('Station already exists!');window.history.back();</script>";
 return;
 }

 }

	   $sql_query="SELECT \"StationField\" FROM \"DefineStations\" WHERE \"StationTypeName\"='$table'";
  $result_set=pg_query($sql_query);
  if(pg_num_rows($result_set)>0)
  {
    $_SESSION['Sensor_Station_Full_Name']=trim($_POST['Station_Full_Name']);
  	
      if (isset($_POST["Station_Shef_Code"]))
$val= trim($_POST["Station_Shef_Code"]);
if ($i==0) 
{
pg_query("insert into \"$table\"(\"Station_Shef_Code\",\"Images\") values('$val','$stnImages')");
$_SESSION["keyval"]=$val;
//echo "insert into \"$table\"(\"$fname\",\"Images\") values('$val','$stnImages')<br><br>";
$i++;
}
     while($row=pg_fetch_row($result_set))
    { 
    	    	$fname=str_replace(' ', '_',$row[0]);

 if ($i!=0)
 {
 	$keyval=trim($_SESSION['keyval']);
 	$keyfield=trim($_SESSION["keyfield"]);
 	$val= trim($_POST[$fname]);

 	if ("Station_Shef_Code"!=trim($fname))
 	{
	pg_query("update \"$table\" set \"$fname\"='$val' WHERE \"Station_Shef_Code\"='$keyval'");
//echo "update \"$table\" set \"$fname\"='$val' WHERE \"Station_Shef_Code\"='$keyval'<BR>";
}

}

}
$SHEFF='false';
	$CSV='false';
	$XML='false';
	
	if(isset($_POST['SHEFF']))
	{
		$SHEFF='true';
	}
	if(isset($_POST['CSV']))
	{
		$CSV='true';
	}
	if(isset($_POST['XML']))
	{
		$XML='true';
	}
	
		pg_query("update \"$table\" set \"SHEFF\"='$SHEFF',\"CSV\"='$CSV',\"XML\"='$XML'  WHERE \"Station_Shef_Code\"='$stn'");
  	
  	}
	
	

  }

else
{

     $sql_query="SELECT \"StationField\" FROM \"DefineStations\" WHERE \"StationTypeName\"='$table'";
  $result_set=pg_query($sql_query);
  if(pg_num_rows($result_set)>0)
  {
    $_SESSION['Sensor_Station_Full_Name']=trim($_POST['Station_Full_Name']);
	
         while($row=pg_fetch_row($result_set))
    {
     $fname=str_replace(' ', '_',$row[0]);
      if (isset($_POST["$fname"]))
$val= trim($_POST["$fname"]);
if (trim($fname)!="Station_Shef_Code")
  pg_query("update \"$table\" set \"$fname\"='$val' WHERE \"Station_Shef_Code\"='$stn'");
    }
	
	$SHEFF='false';
	$CSV='false';
	$XML='false';
	
	if(isset($_POST['SHEFF']))
	{
		$SHEFF='true';
	}
	if(isset($_POST['CSV']))
	{
		$CSV='true';
	}
	if(isset($_POST['XML']))
	{
		$XML='true';
	}
	$old_images="";
	try
	{
	$result_s=pg_query("select \"Images\" from \"$table\"   WHERE \"Station_Shef_Code\"='$stn'");
	
	if($result_s!=null)
	{
		 if(pg_num_rows($result_s)>0)
  {
	  $row=pg_fetch_array($result_s);
	  $old_images=$row['Images'];
  }
		
	}
	}catch(Exception $e)
	{
	}
	$stnImages=$old_images.$stnImages;
		pg_query("update \"$table\" set \"SHEFF\"='$SHEFF',\"CSV\"='$CSV',\"XML\"='$XML',\"Images\"='$stnImages'  WHERE \"Station_Shef_Code\"='$stn'");


  }
  	
  
}

  
}
	

if(isset($_POST['sensor1']) || isset($_POST['sensor2']) || isset($_POST['sensor3']) || isset($_POST['sensor4']) || isset($_POST['sensor5']) || isset($_POST['sensor6']) || isset($_POST['sensor7']) || isset($_POST['sensor8']) || isset($_POST['sensor9']) || isset($_POST['sensor10']))
{
$stntype=trim($_SESSION["stntypename"]);
$stnname=trim($_SESSION['Sensor_Station_Full_Name']);
//echo $stntype;
$del=trim($_SESSION['edit_stn_name']);
pg_query("delete from \"SensorValues\" where \"StationTypeName\"='$stntype' and \"StationFullName\"='$del'");
pg_query("delete from \"SensorValues\" where \"StationTypeName\"='$stntype' and \"StationFullName\"='$stnname'");
if(isset($_POST['sensor1']) && $stntype!="")
{
		

	$sensor1 =$_POST['sensor1'];
	$shef1='';
	$csv1='';
	$xml1='';

	if(isset($_POST['shef1']))
	$shef1=$_POST['shef1'];
	if(isset($_POST['csv1']))

	$csv1=$_POST['csv1'];
		if(isset($_POST['xml1']))
$xml1=$_POST['xml1'];

$unit1='';
$interval1='';
$Multiplier1='';
$Adder1='';
$sensorfile1='';
$sensortype1='';
$processtype1='';
	if(isset($_POST['sensortype1']))
$sensortype1=$_POST['sensortype1'];

	if(isset($_POST['sensorfile1']))
$sensorfile1=$_POST['sensorfile1'];

if (isset($_POST['Units1'])) 
$unit1=$_POST['Units1'];
if (isset($_POST['Interval1'])) 
$interval1=$_POST['Interval1'];

if (isset($_POST['Multiplier1'])) 
$Multiplier1=$_POST['Multiplier1'];

if (isset($_POST['Adder1'])) 
$Adder1=$_POST['Adder1'];
if (isset($_POST['processtype1'])) 
$processtype1=$_POST['processtype1'];

$expression='';
if (isset($_POST['expression1'])) 
$expression=$_POST['expression1'];

	  $sql_query="INSERT into \"SensorValues\"(\"StationTypeName\",\"StationFullName\",\"Sensor\",\"SHEF\",\"Multiple\",\"Addition\",\"SensorType\",\"Units\",\"Interval\",\"ProcessType\",\"SourceFile\",\"Expression\") Values('$stntype','$stnname','$sensor1','$shef1','$Multiplier1','$Adder1','$sensortype1','$unit1','$interval1','$processtype1','$sensorfile1','$expression')";

 pg_query($sql_query);

$stn_table= str_replace(" ","_", $stnname);
 pg_query("update $stn_table set \"SHEF\"='$shef1' where \"FileName\"='$sensorfile1'");

}

if(isset($_POST['sensor2']) && $stntype!="")
{
		

	$sensor1 =$_POST['sensor2'];
	$shef1='';
	$csv1='';
	$xml1='';
	if(isset($_POST['shef2']))
	$shef1=$_POST['shef2'];
	if(isset($_POST['csv2']))

	$csv1=$_POST['csv2'];
		if(isset($_POST['xml2']))
$xml1=$_POST['xml2'];

$unit1='';
$interval1='';
$Multiplier1='';
$Adder1='';
$sensorfile1='';
$sensortype1='';
$processtype1='';
	if(isset($_POST['sensortype2']))
$sensortype1=$_POST['sensortype2'];

	if(isset($_POST['sensorfile2']))
$sensorfile1=$_POST['sensorfile2'];

if (isset($_POST['Units2'])) 
$unit1=$_POST['Units2'];
if (isset($_POST['Interval2'])) 
$interval1=$_POST['Interval2'];

if (isset($_POST['Multiplier2'])) 
$Multiplier1=$_POST['Multiplier2'];

if (isset($_POST['Adder2'])) 
$Adder1=$_POST['Adder2'];
if (isset($_POST['processtype2'])) 
$processtype1=$_POST['processtype2'];
$expression='';
if (isset($_POST['expression2'])) 
$expression=$_POST['expression2'];

	  $sql_query="INSERT into \"SensorValues\"(\"StationTypeName\",\"StationFullName\",\"Sensor\",\"SHEF\",\"Multiple\",\"Addition\",\"SensorType\",\"Units\",\"Interval\",\"ProcessType\",\"SourceFile\",\"Expression\") Values('$stntype','$stnname','$sensor1','$shef1','$Multiplier1','$Adder1','$sensortype1','$unit1','$interval1','$processtype1','$sensorfile1','$expression')";
 pg_query($sql_query);
 $stn_table= str_replace(" ","_", $stnname);
 pg_query("update $stn_table set \"SHEF\"='$shef1' where \"FileName\"='$sensorfile1'");
}
if(isset($_POST['sensor3']) && $stntype!="")
{
		

	$sensor1 =$_POST['sensor3'];
	$shef1='';
	$csv1='';
	$xml1='';
	if(isset($_POST['shef3']))
	$shef1=$_POST['shef3'];
	if(isset($_POST['csv3']))

	$csv1=$_POST['csv3'];
		if(isset($_POST['xml3']))
$xml1=$_POST['xml3'];

$unit1='';
$interval1='';
$Multiplier1='';
$Adder1='';
$sensorfile1='';
$sensortype1='';
$processtype1='';
	if(isset($_POST['sensortype3']))
$sensortype1=$_POST['sensortype3'];

	if(isset($_POST['sensorfile3']))
$sensorfile1=$_POST['sensorfile3'];

if (isset($_POST['Units3'])) 
$unit1=$_POST['Units3'];
if (isset($_POST['Interval3'])) 
$interval1=$_POST['Interval3'];

if (isset($_POST['Multiplier3'])) 
$Multiplier1=$_POST['Multiplier3'];

if (isset($_POST['Adder3'])) 
$Adder1=$_POST['Adder3'];
if (isset($_POST['processtype3'])) 
$processtype1=$_POST['processtype3'];
$expression='';
if (isset($_POST['expression3'])) 
$expression=$_POST['expression3'];

	  $sql_query="INSERT into \"SensorValues\"(\"StationTypeName\",\"StationFullName\",\"Sensor\",\"SHEF\",\"Multiple\",\"Addition\",\"SensorType\",\"Units\",\"Interval\",\"ProcessType\",\"SourceFile\",\"Expression\") Values('$stntype','$stnname','$sensor1','$shef1','$Multiplier1','$Adder1','$sensortype1','$unit1','$interval1','$processtype1','$sensorfile1','$expression')";
 pg_query($sql_query);
 $stn_table= str_replace(" ","_", $stnname);
 pg_query("update $stn_table set \"SHEF\"='$shef1' where \"FileName\"='$sensorfile1'");
}
if(isset($_POST['sensor4']) && $stntype!="")
{
		

	$sensor1 =$_POST['sensor4'];
	$shef1='';
	$csv1='';
	$xml1='';
	if(isset($_POST['shef4']))
	$shef1=$_POST['shef4'];
	if(isset($_POST['csv4']))

	$csv1=$_POST['csv4'];
		if(isset($_POST['xml4']))
$xml1=$_POST['xml4'];

$unit1='';
$interval1='';
$Multiplier1='';
$Adder1='';
$sensorfile1='';
$sensortype1='';
$processtype1='';
	if(isset($_POST['sensortype4']))
$sensortype1=$_POST['sensortype4'];

	if(isset($_POST['sensorfile4']))
$sensorfile1=$_POST['sensorfile4'];

if (isset($_POST['Units4'])) 
$unit1=$_POST['Units4'];
if (isset($_POST['Interval4'])) 
$interval1=$_POST['Interval4'];

if (isset($_POST['Multiplier4'])) 
$Multiplier1=$_POST['Multiplier4'];

if (isset($_POST['Adder4'])) 
$Adder1=$_POST['Adder4'];
if (isset($_POST['processtype4'])) 
$processtype1=$_POST['processtype4'];
$expression='';
if (isset($_POST['expression4'])) 
$expression=$_POST['expression4'];

	  $sql_query="INSERT into \"SensorValues\"(\"StationTypeName\",\"StationFullName\",\"Sensor\",\"SHEF\",\"Multiple\",\"Addition\",\"SensorType\",\"Units\",\"Interval\",\"ProcessType\",\"SourceFile\",\"Expression\") Values('$stntype','$stnname','$sensor1','$shef1','$Multiplier1','$Adder1','$sensortype1','$unit1','$interval1','$processtype1','$sensorfile1','$expression')";
 pg_query($sql_query);
 $stn_table= str_replace(" ","_", $stnname);
 pg_query("update $stn_table set \"SHEF\"='$shef1' where \"FileName\"='$sensorfile1'");
}
if(isset($_POST['sensor5']) && $stntype!="")
{
		

	$sensor1 =$_POST['sensor5'];
	$shef1='';
	$csv1='';
	$xml1='';
	if(isset($_POST['shef5']))
	$shef1=$_POST['shef5'];
	if(isset($_POST['csv5']))

	$csv1=$_POST['csv5'];
		if(isset($_POST['xml5']))
$xml1=$_POST['xml5'];
$unit1='';
$interval1='';
$Multiplier1='';
$Adder1='';
$sensorfile1='';
$sensortype1='';
$processtype1='';
	if(isset($_POST['sensortype5']))
$sensortype1=$_POST['sensortype5'];

	if(isset($_POST['sensorfile5']))
$sensorfile1=$_POST['sensorfile5'];

if (isset($_POST['Units5'])) 
$unit1=$_POST['Units5'];
if (isset($_POST['Interval5'])) 
$interval1=$_POST['Interval5'];

if (isset($_POST['Multiplier5'])) 
$Multiplier1=$_POST['Multiplier5'];

if (isset($_POST['Adder5'])) 
$Adder1=$_POST['Adder5'];
if (isset($_POST['processtype5'])) 
$processtype1=$_POST['processtype5'];
$expression='';
if (isset($_POST['expression5'])) 
$expression=$_POST['expression5'];

	  $sql_query="INSERT into \"SensorValues\"(\"StationTypeName\",\"StationFullName\",\"Sensor\",\"SHEF\",\"Multiple\",\"Addition\",\"SensorType\",\"Units\",\"Interval\",\"ProcessType\",\"SourceFile\",\"Expression\") Values('$stntype','$stnname','$sensor1','$shef1','$Multiplier1','$Adder1','$sensortype1','$unit1','$interval1','$processtype1','$sensorfile1','$expression')";
 pg_query($sql_query);
 $stn_table= str_replace(" ","_", $stnname);
 pg_query("update $stn_table set \"SHEF\"='$shef1' where \"FileName\"='$sensorfile1'");
}


if(isset($_POST['sensor6']) && $stntype!="")
{
		

	$sensor1 =$_POST['sensor6'];
	$shef1='';
	$csv1='';
	$xml1='';
	if(isset($_POST['shef6']))
	$shef1=$_POST['shef6'];
	if(isset($_POST['csv6']))

	$csv1=$_POST['csv6'];
		if(isset($_POST['xml6']))
$xml1=$_POST['xml6'];
$unit1='';
$interval1='';
$Multiplier1='';
$Adder1='';
$sensorfile1='';
$sensortype1='';
$processtype1='';
	if(isset($_POST['sensortype6']))
$sensortype1=$_POST['sensortype6'];

	if(isset($_POST['sensorfile6']))
$sensorfile1=$_POST['sensorfile6'];

if (isset($_POST['Units6'])) 
$unit1=$_POST['Units6'];
if (isset($_POST['Interval6'])) 
$interval1=$_POST['Interval6'];

if (isset($_POST['Multiplier6'])) 
$Multiplier1=$_POST['Multiplier6'];

if (isset($_POST['Adder6'])) 
$Adder1=$_POST['Adder6'];
if (isset($_POST['processtype6'])) 
$processtype1=$_POST['processtype6'];
$expression='';
if (isset($_POST['expression6'])) 
$expression=$_POST['expression6'];

	  $sql_query="INSERT into \"SensorValues\"(\"StationTypeName\",\"StationFullName\",\"Sensor\",\"SHEF\",\"Multiple\",\"Addition\",\"SensorType\",\"Units\",\"Interval\",\"ProcessType\",\"SourceFile\",\"Expression\") Values('$stntype','$stnname','$sensor1','$shef1','$Multiplier1','$Adder1','$sensortype1','$unit1','$interval1','$processtype1','$sensorfile1','$expression')";
 pg_query($sql_query);
 $stn_table= str_replace(" ","_", $stnname);
 pg_query("update $stn_table set \"SHEF\"='$shef1' where \"FileName\"='$sensorfile1'");
}
if(isset($_POST['sensor7']) && $stntype!="")
{
		

	$sensor1 =$_POST['sensor7'];
	$shef1='';
	$csv1='';
	$xml1='';
	if(isset($_POST['shef7']))
	$shef1=$_POST['shef7'];
	if(isset($_POST['csv7']))

	$csv1=$_POST['csv7'];
		if(isset($_POST['xml7']))
$xml1=$_POST['xml7'];
$unit1='';
$interval1='';
$Multiplier1='';
$Adder1='';
$sensorfile1='';
$sensortype1='';
$processtype1='';
	if(isset($_POST['sensortype7']))
$sensortype1=$_POST['sensortype7'];

	if(isset($_POST['sensorfile7']))
$sensorfile1=$_POST['sensorfile7'];

if (isset($_POST['Units7'])) 
$unit1=$_POST['Units7'];
if (isset($_POST['Interval7'])) 
$interval1=$_POST['Interval7'];

if (isset($_POST['Multiplier7'])) 
$Multiplier1=$_POST['Multiplier7'];

if (isset($_POST['Adder7'])) 
$Adder1=$_POST['Adder7'];
if (isset($_POST['processtype7'])) 
$processtype1=$_POST['processtype7'];
$expression='';
if (isset($_POST['expression7'])) 
$expression=$_POST['expression7'];

	  $sql_query="INSERT into \"SensorValues\"(\"StationTypeName\",\"StationFullName\",\"Sensor\",\"SHEF\",\"Multiple\",\"Addition\",\"SensorType\",\"Units\",\"Interval\",\"ProcessType\",\"SourceFile\",\"Expression\") Values('$stntype','$stnname','$sensor1','$shef1','$Multiplier1','$Adder1','$sensortype1','$unit1','$interval1','$processtype1','$sensorfile1','$expression')";
 pg_query($sql_query);
 $stn_table= str_replace(" ","_", $stnname);
 pg_query("update $stn_table set \"SHEF\"='$shef1' where \"FileName\"='$sensorfile1'");
}

if(isset($_POST['sensor8']) && $stntype!="")
{
		

	$sensor1 =$_POST['sensor8'];
	$shef1='';
	$csv1='';
	$xml1='';
	if(isset($_POST['shef8']))
	$shef1=$_POST['shef8'];
	if(isset($_POST['csv8']))

	$csv1=$_POST['csv8'];
		if(isset($_POST['xml8']))
$xml1=$_POST['xml8'];
	  $unit1='';
$interval1='';
$Multiplier1='';
$Adder1='';
$sensorfile1='';
$sensortype1='';
$processtype1='';
	if(isset($_POST['sensortype8']))
$sensortype1=$_POST['sensortype8'];

	if(isset($_POST['sensorfile8']))
$sensorfile1=$_POST['sensorfile8'];

if (isset($_POST['Units8'])) 
$unit1=$_POST['Units8'];
if (isset($_POST['Interval8'])) 
$interval1=$_POST['Interval8'];

if (isset($_POST['Multiplier8'])) 
$Multiplier1=$_POST['Multiplier8'];

if (isset($_POST['Adder8'])) 
$Adder1=$_POST['Adder8'];
if (isset($_POST['processtype8'])) 
$processtype1=$_POST['processtype8'];

$expression='';
if (isset($_POST['expression8'])) 
$expression=$_POST['expression8'];

	  $sql_query="INSERT into \"SensorValues\"(\"StationTypeName\",\"StationFullName\",\"Sensor\",\"SHEF\",\"Multiple\",\"Addition\",\"SensorType\",\"Units\",\"Interval\",\"ProcessType\",\"SourceFile\",\"Expression\") Values('$stntype','$stnname','$sensor1','$shef1','$Multiplier1','$Adder1','$sensortype1','$unit1','$interval1','$processtype1','$sensorfile1','$expression')";
 pg_query($sql_query);
 $stn_table= str_replace(" ","_", $stnname);
 pg_query("update $stn_table set \"SHEF\"='$shef1' where \"FileName\"='$sensorfile1'");
}
if(isset($_POST['sensor9']) && $stntype!="")
{
		

	$sensor1 =$_POST['sensor9'];
	$shef1='';
	$csv1='';
	$xml1='';
	if(isset($_POST['shef9']))
	$shef1=$_POST['shef9'];
	if(isset($_POST['csv9']))

	$csv1=$_POST['csv9'];
		if(isset($_POST['xml9']))
$xml1=$_POST['xml9'];
	 $unit1='';
$interval1='';
$Multiplier1='';
$Adder1='';
$sensorfile1='';
$sensortype1='';
$processtype1='';
	if(isset($_POST['sensortype9']))
$sensortype1=$_POST['sensortype9'];

	if(isset($_POST['sensorfile9']))
$sensorfile1=$_POST['sensorfile9'];

if (isset($_POST['Units9'])) 
$unit1=$_POST['Units9'];
if (isset($_POST['Interval9'])) 
$interval1=$_POST['Interval9'];

if (isset($_POST['Multiplier9'])) 
$Multiplier1=$_POST['Multiplier9'];

if (isset($_POST['Adder9'])) 
$Adder1=$_POST['Adder9'];
if (isset($_POST['processtype9'])) 
$processtype1=$_POST['processtype9'];

	$expression='';
if (isset($_POST['expression9'])) 
$expression=$_POST['expression9'];

	  $sql_query="INSERT into \"SensorValues\"(\"StationTypeName\",\"StationFullName\",\"Sensor\",\"SHEF\",\"Multiple\",\"Addition\",\"SensorType\",\"Units\",\"Interval\",\"ProcessType\",\"SourceFile\",\"Expression\") Values('$stntype','$stnname','$sensor1','$shef1','$Multiplier1','$Adder1','$sensortype1','$unit1','$interval1','$processtype1','$sensorfile1','$expression')";
 pg_query($sql_query);
 $stn_table= str_replace(" ","_", $stnname);
 pg_query("update $stn_table set \"SHEF\"='$shef1' where \"FileName\"='$sensorfile1'");
}
if(isset($_POST['sensor10']) && $stntype!="")
{
		

	$sensor1 =$_POST['sensor10'];
	$shef1='';
	$csv1='';
	$xml1='';
	if(isset($_POST['shef10']))
	$shef1=$_POST['shef10'];
	if(isset($_POST['csv10']))

	$csv1=$_POST['csv10'];
		if(isset($_POST['xml10']))
$xml1=$_POST['xml10'];

	 $unit1='';
$interval1='';
$Multiplier1='';
$Adder1='';
$sensorfile1='';
$sensortype1='';
$processtype1='';
	if(isset($_POST['sensortype10']))
$sensortype1=$_POST['sensortype10'];

	if(isset($_POST['sensorfile10']))
$sensorfile1=$_POST['sensorfile10'];

if (isset($_POST['Units10'])) 
$unit1=$_POST['Units10'];
if (isset($_POST['Interval10'])) 
$interval1=$_POST['Interval10'];

if (isset($_POST['Multiplier10'])) 
$Multiplier1=$_POST['Multiplier10'];

if (isset($_POST['Adder10'])) 
$Adder1=$_POST['Adder10'];
if (isset($_POST['processtype10'])) 
$processtype1=$_POST['processtype10'];

$expression='';
if (isset($_POST['expression10'])) 
$expression=$_POST['expression10'];

	  $sql_query="INSERT into \"SensorValues\"(\"StationTypeName\",\"StationFullName\",\"Sensor\",\"SHEF\",\"Multiple\",\"Addition\",\"SensorType\",\"Units\",\"Interval\",\"ProcessType\",\"SourceFile\",\"Expression\") Values('$stntype','$stnname','$sensor1','$shef1','$Multiplier1','$Adder1','$sensortype1','$unit1','$interval1','$processtype1','$sensorfile1','$expression')";
 pg_query($sql_query);
 $stn_table= str_replace(" ","_", $stnname);
 pg_query("update $stn_table set \"SHEF\"='$shef1' where \"FileName\"='$sensorfile1'");
}





if(isset($_POST['sensor11']) && $stntype!="")
{
		

	$sensor1 =$_POST['sensor11'];
	$shef1='';
	$csv1='';
	$xml1='';
	if(isset($_POST['shef11']))
	$shef1=$_POST['shef11'];
	if(isset($_POST['csv11']))

	$csv1=$_POST['csv11'];
		if(isset($_POST['xml11']))
$xml1=$_POST['xml11'];

	 $unit1='';
$interval1='';
$Multiplier1='';
$Adder1='';
$sensorfile1='';
$sensortype1='';
$processtype1='';
	if(isset($_POST['sensortype11']))
$sensortype1=$_POST['sensortype11'];

	if(isset($_POST['sensorfile11']))
$sensorfile1=$_POST['sensorfile11'];

if (isset($_POST['Units11'])) 
$unit1=$_POST['Units11'];
if (isset($_POST['Interval11'])) 
$interval1=$_POST['Interval11'];

if (isset($_POST['Multiplier11'])) 
$Multiplier1=$_POST['Multiplier11'];

if (isset($_POST['Adder11'])) 
$Adder1=$_POST['Adder11'];
if (isset($_POST['processtype11'])) 
$processtype1=$_POST['processtype11'];

$expression='';
if (isset($_POST['expression11'])) 
$expression=$_POST['expression11'];

	  $sql_query="INSERT into \"SensorValues\"(\"StationTypeName\",\"StationFullName\",\"Sensor\",\"SHEF\",\"Multiple\",\"Addition\",\"SensorType\",\"Units\",\"Interval\",\"ProcessType\",\"SourceFile\",\"Expression\") Values('$stntype','$stnname','$sensor1','$shef1','$Multiplier1','$Adder1','$sensortype1','$unit1','$interval1','$processtype1','$sensorfile1','$expression')";
 pg_query($sql_query);
 $stn_table= str_replace(" ","_", $stnname);
 pg_query("update $stn_table set \"SHEF\"='$shef1' where \"FileName\"='$sensorfile1'");
}






if(isset($_POST['sensor12']) && $stntype!="")
{
		

	$sensor1 =$_POST['sensor12'];
	$shef1='';
	$csv1='';
	$xml1='';
	if(isset($_POST['shef12']))
	$shef1=$_POST['shef12'];
	if(isset($_POST['csv12']))

	$csv1=$_POST['csv12'];
		if(isset($_POST['xml12']))
$xml1=$_POST['xml12'];

	 $unit1='';
$interval1='';
$Multiplier1='';
$Adder1='';
$sensorfile1='';
$sensortype1='';
$processtype1='';
	if(isset($_POST['sensortype12']))
$sensortype1=$_POST['sensortype12'];

	if(isset($_POST['sensorfile12']))
$sensorfile1=$_POST['sensorfile12'];

if (isset($_POST['Units12'])) 
$unit1=$_POST['Units12'];
if (isset($_POST['Interval12'])) 
$interval1=$_POST['Interval12'];

if (isset($_POST['Multiplier12'])) 
$Multiplier1=$_POST['Multiplier12'];

if (isset($_POST['Adder12'])) 
$Adder1=$_POST['Adder12'];
if (isset($_POST['processtype12'])) 
$processtype1=$_POST['processtype12'];

$expression='';
if (isset($_POST['expression12'])) 
$expression=$_POST['expression12'];

	  $sql_query="INSERT into \"SensorValues\"(\"StationTypeName\",\"StationFullName\",\"Sensor\",\"SHEF\",\"Multiple\",\"Addition\",\"SensorType\",\"Units\",\"Interval\",\"ProcessType\",\"SourceFile\",\"Expression\") Values('$stntype','$stnname','$sensor1','$shef1','$Multiplier1','$Adder1','$sensortype1','$unit1','$interval1','$processtype1','$sensorfile1','$expression')";
 pg_query($sql_query);
 $stn_table= str_replace(" ","_", $stnname);
 pg_query("update $stn_table set \"SHEF\"='$shef1' where \"FileName\"='$sensorfile1'");
}



if(isset($_POST['sensor13']) && $stntype!="")
{
		

	$sensor1 =$_POST['sensor13'];
	$shef1='';
	$csv1='';
	$xml1='';
	if(isset($_POST['shef13']))
	$shef1=$_POST['shef13'];
	if(isset($_POST['csv13']))

	$csv1=$_POST['csv13'];
		if(isset($_POST['xml13']))
$xml1=$_POST['xml13'];

	 $unit1='';
$interval1='';
$Multiplier1='';
$Adder1='';
$sensorfile1='';
$sensortype1='';
$processtype1='';
	if(isset($_POST['sensortype13']))
$sensortype1=$_POST['sensortype10'];

	if(isset($_POST['sensorfile13']))
$sensorfile1=$_POST['sensorfile13'];

if (isset($_POST['Units13'])) 
$unit1=$_POST['Units13'];
if (isset($_POST['Interval13'])) 
$interval1=$_POST['Interval13'];

if (isset($_POST['Multiplier13'])) 
$Multiplier1=$_POST['Multiplier13'];

if (isset($_POST['Adder13'])) 
$Adder1=$_POST['Adder13'];
if (isset($_POST['processtype13'])) 
$processtype1=$_POST['processtype13'];

$expression='';
if (isset($_POST['expression13'])) 
$expression=$_POST['expression13'];

	  $sql_query="INSERT into \"SensorValues\"(\"StationTypeName\",\"StationFullName\",\"Sensor\",\"SHEF\",\"Multiple\",\"Addition\",\"SensorType\",\"Units\",\"Interval\",\"ProcessType\",\"SourceFile\",\"Expression\") Values('$stntype','$stnname','$sensor1','$shef1','$Multiplier1','$Adder1','$sensortype1','$unit1','$interval1','$processtype1','$sensorfile1','$expression')";
 pg_query($sql_query);
 $stn_table= str_replace(" ","_", $stnname);
 pg_query("update $stn_table set \"SHEF\"='$shef1' where \"FileName\"='$sensorfile1'");
}


if(isset($_POST['sensor14']) && $stntype!="")
{
		

	$sensor1 =$_POST['sensor14'];
	$shef1='';
	$csv1='';
	$xml1='';
	if(isset($_POST['shef14']))
	$shef1=$_POST['shef14'];
	if(isset($_POST['csv14']))

	$csv1=$_POST['csv14'];
		if(isset($_POST['xml14']))
$xml1=$_POST['xml14'];

	 $unit1='';
$interval1='';
$Multiplier1='';
$Adder1='';
$sensorfile1='';
$sensortype1='';
$processtype1='';
	if(isset($_POST['sensortype14']))
$sensortype1=$_POST['sensortype14'];

	if(isset($_POST['sensorfile14']))
$sensorfile1=$_POST['sensorfile14'];

if (isset($_POST['Units14'])) 
$unit1=$_POST['Units14'];
if (isset($_POST['Interval14'])) 
$interval1=$_POST['Interval14'];

if (isset($_POST['Multiplier14'])) 
$Multiplier1=$_POST['Multiplier14'];

if (isset($_POST['Adder14'])) 
$Adder1=$_POST['Adder14'];
if (isset($_POST['processtype14'])) 
$processtype1=$_POST['processtype14'];

$expression='';
if (isset($_POST['expression14'])) 
$expression=$_POST['expression14'];

	  $sql_query="INSERT into \"SensorValues\"(\"StationTypeName\",\"StationFullName\",\"Sensor\",\"SHEF\",\"Multiple\",\"Addition\",\"SensorType\",\"Units\",\"Interval\",\"ProcessType\",\"SourceFile\",\"Expression\") Values('$stntype','$stnname','$sensor1','$shef1','$Multiplier1','$Adder1','$sensortype1','$unit1','$interval1','$processtype1','$sensorfile1','$expression')";
 pg_query($sql_query);
 $stn_table= str_replace(" ","_", $stnname);
 pg_query("update $stn_table set \"SHEF\"='$shef1' where \"FileName\"='$sensorfile1'");
}



if(isset($_POST['sensor15']) && $stntype!="")
{
		

	$sensor1 =$_POST['sensor15'];
	$shef1='';
	$csv1='';
	$xml1='';
	if(isset($_POST['shef15']))
	$shef1=$_POST['shef15'];
	if(isset($_POST['csv15']))

	$csv1=$_POST['csv15'];
		if(isset($_POST['xml15']))
$xml1=$_POST['xml15'];

	 $unit1='';
$interval1='';
$Multiplier1='';
$Adder1='';
$sensorfile1='';
$sensortype1='';
$processtype1='';
	if(isset($_POST['sensortype15']))
$sensortype1=$_POST['sensortype15'];

	if(isset($_POST['sensorfile15']))
$sensorfile1=$_POST['sensorfile15'];

if (isset($_POST['Units15'])) 
$unit1=$_POST['Units15'];
if (isset($_POST['Interval15'])) 
$interval1=$_POST['Interval15'];

if (isset($_POST['Multiplier15'])) 
$Multiplier1=$_POST['Multiplier15'];

if (isset($_POST['Adder15'])) 
$Adder1=$_POST['Adder15'];
if (isset($_POST['processtype15'])) 
$processtype1=$_POST['processtype15'];

$expression='';
if (isset($_POST['expression15'])) 
$expression=$_POST['expression15'];

	  $sql_query="INSERT into \"SensorValues\"(\"StationTypeName\",\"StationFullName\",\"Sensor\",\"SHEF\",\"Multiple\",\"Addition\",\"SensorType\",\"Units\",\"Interval\",\"ProcessType\",\"SourceFile\",\"Expression\") Values('$stntype','$stnname','$sensor1','$shef1','$Multiplier1','$Adder1','$sensortype1','$unit1','$interval1','$processtype1','$sensorfile1','$expression')";
 pg_query($sql_query);
 $stn_table= str_replace(" ","_", $stnname);
 pg_query("update $stn_table set \"SHEF\"='$shef1' where \"FileName\"='$sensorfile1'");
}

?>


 <script>
window.location.href='/HydrometV2/stations.php?check=true#stationtypes';
</script>



<?php


		  $_SESSION["stntypename"]=null;
$_SESSION['edit_stn_name']=null;  


}

 if (isset($_SESSION['stationErrorDelete'])) {
  $stnerrordelete=$_SESSION['stationErrorDelete'];
    $sql_query="DELETE FROM \"tblStationErrror\" WHERE \"Station_Shef_Code\"='$stnerrordelete'";
  pg_query($sql_query);
  }


?>
<?php
function DMS2Decimal($degrees , $minutes , $seconds , $direction ) {
   //converts DMS coordinates to decimal
   //returns false on bad inputs, decimal on success
    
   //direction must be n, s, e or w, case-insensitive
   $d = strtolower($direction);
   $ok = array('n', 's', 'e', 'w');
    
   //degrees must be integer between 0 and 180
   if(!is_numeric($degrees) || $degrees < 0 || $degrees > 180) {
      $decimal = false;
   }
   //minutes must be integer or float between 0 and 59
   elseif(!is_numeric($minutes) || $minutes < 0 || $minutes > 59) {
      $decimal = false;
   }
   //seconds must be integer or float between 0 and 59
   elseif(!is_numeric($seconds) || $seconds < 0 || $seconds > 59) {
      $decimal = false;
   }
   elseif(!in_array($d, $ok)) {
      $decimal = false;
   }
   else {
      //inputs clean, calculate
      $decimal = $degrees + ($minutes / 60) + ($seconds / 3600);
       
      //reverse for south or west coordinates; north is assumed
      if($d == 's' || $d == 'w') {
         $decimal *= -1;
      }
   }
    
   return $decimal;
}
?>