	<?php
								include("includes/link.php");
							?>

							<?php
								include("includes/adminheader.php");
								//error_reporting(0);

							?>

<?php
include_once 'database.php';
include_once 'dbaddStation.php';
set_time_limit(5000);
if(isset($_POST['shef1']))
{
$shef2=$_POST['shef1'];
// $shef1 data is posted into $shef2

$result = pg_query("SELECT \"HydroMetShefCode\" FROM \"tblHydroMetParamsType\" where \"HydroMetShefCode\"='$shef2' ");
//result of the query is updated into the variable $result


if(pg_num_rows($result)== 0) {
	$sql_query="INSERT into \"tblHydroMetParamsType\"(\"HydroMetShefCode\") Values('$shef2')";
	//query for inserting into the table "tblHydroMetParamsType" is added to $sql_query
		  pg_query($sql_query);
    
} else {
    	  
}
}

if(isset($_POST['shef2']))
{
$shef2=$_POST['shef2'];
// $shef2 data is posted into $shef2

$result = pg_query("SELECT \"HydroMetShefCode\" FROM \"tblHydroMetParamsType\" where \"HydroMetShefCode\"='$shef2' ");
//result of the query is updated into the variable $result

if(pg_num_rows($result)== 0) {
	$sql_query="INSERT into \"tblHydroMetParamsType\"(\"HydroMetShefCode\") Values('$shef2')";
	//query for inserting into the table "tblHydroMetParamsType" is added to $sql_query
		  pg_query($sql_query);
    
} else {
    	  
}
}
if(isset($_POST['shef3']))
{
$shef3=$_POST['shef3'];
// $shef3 data is posted into $shef3

$result = pg_query("SELECT \"HydroMetShefCode\" FROM \"tblHydroMetParamsType\" where \"HydroMetShefCode\"='$shef3'");
//result of the query is updated into the variable $result

if(pg_num_rows($result)== 0) {
     $sql_query="INSERT into \"tblHydroMetParamsType\"(\"HydroMetShefCode\") Values('$shef3')";
     //query for inserting into the table "tblHydroMetParamsType" is added to $sql_query

		  pg_query($sql_query);
} else {
    	 
}
}
if(isset($_POST['shef4']))
{
$shef4=$_POST['shef4'];
// $shef4 data is posted into $shef4

$result = pg_query("SELECT \"HydroMetShefCode\" FROM \"tblHydroMetParamsType\" where \"HydroMetShefCode\"='$shef4' ");
	//result of the query is updated into the variable $result

if(pg_num_rows($result)== 0) {
     $sql_query="INSERT into \"tblHydroMetParamsType\"(\"HydroMetShefCode\") Values('$shef4')";
     //query for inserting into the table "tblHydroMetParamsType" is added to $sql_query
		  pg_query($sql_query);
} else {
    	 
}
}
if(isset($_POST['shef5']))
{
$shef5=$_POST['shef5'];
// $shef5 data is posted into $shef5

$result = pg_query("SELECT \"HydroMetShefCode\" FROM \"tblHydroMetParamsType\" where \"HydroMetShefCode\"='$shef5' ");
//result of the query is updated into the variable $result

if(pg_num_rows($result)== 0) {
     $sql_query="INSERT into \"tblHydroMetParamsType\"(\"HydroMetShefCode\") Values('$shef5')";
		  pg_query($sql_query);
		   //query for inserting into the table "tblHydroMetParamsType" is added to $sql_query
} else {
    	 
}
}

if(isset($_POST['shef6']))
{
$shef5=$_POST['shef6'];
// $shef6 data is posted into $shef5

$result = pg_query("SELECT \"HydroMetShefCode\" FROM \"tblHydroMetParamsType\" where \"HydroMetShefCode\"='$shef5' ");
//result of the query is updated into the variable $result


if(pg_num_rows($result)== 0) {
     $sql_query="INSERT into \"tblHydroMetParamsType\"(\"HydroMetShefCode\") Values('$shef5')";
      //query for inserting into the table "tblHydroMetParamsType" is added to $sql_query
		  pg_query($sql_query);
} else {
    	 
}
}
if(isset($_POST['shef7']))
{
$shef5=$_POST['shef7'];
// $shef7 data is posted into $shef5
$result = pg_query("SELECT \"HydroMetShefCode\" FROM \"tblHydroMetParamsType\" where \"HydroMetShefCode\"='$shef5' ");
//result of the query is updated into the variable $result


if(pg_num_rows($result)== 0) {
     $sql_query="INSERT into \"tblHydroMetParamsType\"(\"HydroMetShefCode\") Values('$shef5')";
      //query for inserting into the table "tblHydroMetParamsType" is added to $sql_query
		  pg_query($sql_query);
} else {
    	 
}
}
if(isset($_POST['shef8']))
{
$shef5=$_POST['shef8'];
// $shef8 data is posted into $shef5

$result = pg_query("SELECT \"HydroMetShefCode\" FROM \"tblHydroMetParamsType\" where \"HydroMetShefCode\"='$shef5' ");
//result of the query is updated into the variable $result

if(pg_num_rows($result)== 0) {
     $sql_query="INSERT into \"tblHydroMetParamsType\"(\"HydroMetShefCode\") Values('$shef5')";
      //query for inserting into the table "tblHydroMetParamsType" is added to $sql_query
		  pg_query($sql_query);
} else {
    	 
}
}if(isset($_POST['shef9']))
{
$shef5=$_POST['shef9'];
// $shef9 data is posted into $shef5
$result = pg_query("SELECT \"HydroMetShefCode\" FROM \"tblHydroMetParamsType\" where \"HydroMetShefCode\"='$shef5' ");
//result of the query is updated into the variable $result

if(pg_num_rows($result)== 0) {
     $sql_query="INSERT into \"tblHydroMetParamsType\"(\"HydroMetShefCode\") Values('$shef5')";
     //query for inserting into the table "tblHydroMetParamsType" is added to $sql_query

		  pg_query($sql_query);
} else {
    	 
}
}
if(isset($_POST['shef10']))
{
$shef5=$_POST['shef10'];
// $shef10 data is posted into $shef5
$result = pg_query("SELECT \"HydroMetShefCode\" FROM \"tblHydroMetParamsType\" where \"HydroMetShefCode\"='$shef5' ");
//result of the query is updated into the variable $result

if(pg_num_rows($result)== 0) {
     $sql_query="INSERT into \"tblHydroMetParamsType\"(\"HydroMetShefCode\") Values('$shef5')";
     //query for inserting into the table "tblHydroMetParamsType" is added to $sql_query
		  pg_query($sql_query);
} else {
    	 
}
}
if(isset($_POST['shef11']))
{
$shef5=$_POST['shef11'];
// $shef11 data is posted into $shef5
$result = pg_query("SELECT \"HydroMetShefCode\" FROM \"tblHydroMetParamsType\" where \"HydroMetShefCode\"='$shef5' ");
//result of the query is updated into the variable $result

if(pg_num_rows($result)== 0) {
     $sql_query="INSERT into \"tblHydroMetParamsType\"(\"HydroMetShefCode\") Values('$shef5')";
     //query for inserting into the table "tblHydroMetParamsType" is added to $sql_query
		  pg_query($sql_query);
} else {
    	 
}
}
if(isset($_POST['shef12']))
{
$shef5=$_POST['shef12'];
// $shef12 data is posted into $shef5
$result = pg_query("SELECT \"HydroMetShefCode\" FROM \"tblHydroMetParamsType\" where \"HydroMetShefCode\"='$shef5' ");
//result of the query is updated into the variable $result

if(pg_num_rows($result)== 0) {
     $sql_query="INSERT into \"tblHydroMetParamsType\"(\"HydroMetShefCode\") Values('$shef5')";
     //query for inserting into the table "tblHydroMetParamsType" is added to $sql_query
		  pg_query($sql_query);
} else {
    	 
}
}
if(isset($_POST['shef13']))
{
$shef5=$_POST['shef13'];
// $shef13 data is posted into $shef5
$result = pg_query("SELECT \"HydroMetShefCode\" FROM \"tblHydroMetParamsType\" where \"HydroMetShefCode\"='$shef5' ");
//result of the query is updated into the variable $result

if(pg_num_rows($result)== 0) {
     $sql_query="INSERT into \"tblHydroMetParamsType\"(\"HydroMetShefCode\") Values('$shef5')";
     //query for inserting into the table "tblHydroMetParamsType" is added to $sql_query
		  pg_query($sql_query);
} else {
    	 
}
}
if(isset($_POST['shef14']))
{
$shef5=$_POST['shef14'];
// $shef14 data is posted into $shef5
$result = pg_query("SELECT \"HydroMetShefCode\" FROM \"tblHydroMetParamsType\" where \"HydroMetShefCode\"='$shef5' ");
//result of the query is updated into the variable $result

if(pg_num_rows($result)== 0) {
     $sql_query="INSERT into \"tblHydroMetParamsType\"(\"HydroMetShefCode\") Values('$shef5')";
     //query for inserting into the table "tblHydroMetParamsType" is added to $sql_query
		  pg_query($sql_query);
} else {
    	 
}
}
if(isset($_POST['shef15']))
{
$shef5=$_POST['shef15'];
// $shef15 data is posted into $shef5
$result = pg_query("SELECT \"HydroMetShefCode\" FROM \"tblHydroMetParamsType\" where \"HydroMetShefCode\"='$shef5' ");
//result of the query is updated into the variable $result

if(pg_num_rows($result)== 0) {
     $sql_query="INSERT into \"tblHydroMetParamsType\"(\"HydroMetShefCode\") Values('$shef5')";
     //query for inserting into the table "tblHydroMetParamsType" is added to $sql_query
		  pg_query($sql_query);
} else {
    	 
}
}
?>

<?php

$Station_Full_Name='';
$Station_Shef_Code='';
$Ogiznalfilename='';
 $Station_Full_Name=trim($_POST['Station_Full_Name']);
//Given Station_Full_Name is taken into variable $Station_Full_Name and
$Station_Shef_Code=trim($_POST['Station_Shef_Code']);
//Given Station_Shef_Code is taken into variable $Station_Shef_Code 

if (isset($_POST['numberoffiles'])) {
$total=$_POST['numberoffiles'];
//Given numberoffiles is taken into variable $total 

for ($z=0; $z <=$total ; $z++) { 
//for $total lesst than $z the loop continue

$ext="";

$uploadedStatus = 0;
if ( isset($_FILES["myexcel$z"])) {
	$ext = pathinfo($_FILES["myexcel$z"]["name"], PATHINFO_EXTENSION);
	if($ext=="csv" || $ext=="xlsx")
	{
	$storagename="";
	if($ext=="csv")
	{
		
			
				$storagename = "myexcel.csv";
				//$storagename is set to "myexcel.csv"
		
	}
	if($ext=="xlsx")
		{
		$storagename = "myexcel.xlsx";
		//$storagename is set to "myexcel.xlsx"
		}

//if there was an error uploading the file

if ($_FILES["myexcel$z"]["error"] > 0) {


}

else {

if (file_exists($_FILES["myexcel$z"]["name"])) {

unlink($_FILES["myexcel$z"]["name"]);

}

$stn_table=str_replace(" ", "_", $Station_Full_Name);
$Ogiznalfilename=$_FILES["myexcel$z"]["name"];

pg_query("create table if not exists $stn_table(\"X\" text,\"Y\" text,\"Station_Full_Name\" text,\"Station_Shef_Code\" text,\"FileName\" text,\"SHEF\" text)");
//creates table with the station_name if the table doesnt exist

pg_query("delete from $stn_table where \"FileName\"='$Ogiznalfilename'");
//deletes data from the table "$stn_table"

move_uploaded_file($_FILES["myexcel$z"]["tmp_name"],  $storagename);
//uploaded file is moved with the name given in $storagename
$uploadedStatus = 1;

}

}} else {

}






	if($ext=="xlsx")
	{
$databasetable = "tbltemp";
$stn_table= str_replace(' ', '_',$_POST['Station_Full_Name']);
/************************ YOUR DATABASE CONNECTION END HERE  ****************************/


set_include_path(get_include_path() . PATH_SEPARATOR . 'Classes/');
include 'PHPExcel/IOFactory.php';

// This is the file path to be uploaded.
$inputFileName = 'myexcel.xlsx'; 

try {
	$objPHPExcel = PHPExcel_IOFactory::load($inputFileName);
} catch(Exception $e) {
	die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
	//when error caused
}



$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);
$arrayCount = count($allDataInSheet);  // Here get total count of row in that Excel sheet


for($i=2;$i<=$arrayCount;$i++){
$userName = trim($allDataInSheet[$i]["A"]);
$userMobile = trim($allDataInSheet[$i]["B"]);

$insertTable= pg_query("insert into $stn_table (\"X\", \"Y\",\"Station_Full_Name\",\"Station_Shef_Code\",\"FileName\") values('".$userName."', '".$userMobile."','$Station_Full_Name','$Station_Shef_Code','$Ogiznalfilename');");
// insert data into the table $stn_table
}
	unlink("myexcel.xlsx");

	}
	if($ext=="csv")
	{
		$stn_table= str_replace(' ', '_',$_POST['Station_Full_Name']);
		// replaces data in for the Station_Full_Name ' ' with '_'
	$filename="myexcel.csv";




		$file = fopen($filename, "r");


$count = 0;                                     
while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE)
	//while $emapData for the fgetcsv function is false
{

    $count++;   

    if($count>1){                                 
pg_query("insert into $stn_table (\"X\", \"Y\",\"Station_Full_Name\",\"Station_Shef_Code\",\"FileName\") values('$emapData[0]', '$emapData[1]','$Station_Full_Name','$Station_Shef_Code','$Ogiznalfilename');");  
//isnert data into the table "$stn_table"
  }                                            
}
	}
	

}
}
if(isset($_POST['numberofphoto']))
{

	$stationfullnameforimg=$_POST["Station_Full_Name"];
	//echo $stationfullnameforimg;
	define("Rootfloder", $_SERVER['DOCUMENT_ROOT']."/");//root folder path
	define("uploadimagedir", "Images/StationImages/");//upload image path
	//$uploadimagedir = 'Images/StationImages/';
	$uploadfilepath = uploadimagedir.basename($_FILES['stationImageinput']['name']);
	$name = $_POST['stationImageinput'];//image loccation to the database
	//post data from stationImageinput to $name
    $chetrue=move_uploaded_file($_FILES['stationImageinput']['tmp_name'], $uploadfilepath);
	$query = "update \"tblStationLocation\" set \"PIC\"='$uploadfilepath' WHERE \"StationFullName\"='$stationfullnameforimg'";
	//upload image location to the database
	$result = pg_query($query);
	//echo $Station_Full_Name;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add Station</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <!-- Optional Bootstrap theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

    <!-- Include Bootstrap CSS -->
 
    <script src="js/jquery-1.8.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="../dist/jquery.wizardaddfinal.js"></script>

  
    <link href="../dist/jquery.wizard.css" rel="stylesheet">
   
    <style type="text/css">
    
      .sidebar-nav {
        padding: 9px 0;
      }

	  [data-wizard-init] {
		margin: auto;
		width: 90%;
	  }
	  
	th{
		
		background-color:#539CCC;
		color:white;
		text-align: center;
	}
    </style>
    <script type="text/javascript">
function cancel()
{
window.location.href='\\HydrometV2\\stations.php'
}
 function stntype()
 {
 	
document.form3.submit();
 }

</script>
<?php
$result=pg_query("select \"HydroMetShefCode\" from \"tblHydroMetParamsType\"");
//query select data from the table "tblHydroMetParamsType"


?>
<script type="text/javascript">



	function changedisable1(i,e)
	{


var processtype=e.options[e.selectedIndex].value;
if (processtype=="Rating") 
	//if procecsstype == Rating
{
	//the elements are being set property of disabling and enabling them
document.getElementsByName('Multiplier'+i)[0].disabled=true;
document.getElementsByName('Adder'+i)[0].disabled=true;
document.getElementsByName('expression'+i)[0].disabled=true;
document.getElementsByName('sensorfile'+i)[0].disabled=false;

}
	if (processtype=="Linear")
	//if procecsstype == Linear
{
	//the elements are being set property of disabling and enabling them
document.getElementsByName('Multiplier'+i)[0].disabled=false;
document.getElementsByName('Adder'+i)[0].disabled=false;
document.getElementsByName('expression'+i)[0].disabled=true;

document.getElementsByName('sensorfile'+i)[0].disabled=true;

	 }
	 if (processtype=="Expression") 
	 //if procecsstype == Expression
{
	//the elements are being set property of disabling and enabling them
document.getElementsByName('Multiplier'+i)[0].disabled=true;
document.getElementsByName('Adder'+i)[0].disabled=true;
document.getElementsByName('expression'+i)[0].disabled=false;
document.getElementsByName('sensorfile'+i)[0].disabled=true;
	 }

	 if (processtype=="Unselect") {
	 	//if procecsstype == Expression
var elements=e.options;
 e.options[0].disabled = false;;
    for(var ii = 0; ii < elements.length; ii++){
      elements[ii].selected = false;
    }
     e.options[0].disabled = true;
	//the elements are being set property of disabling and enabling them
document.getElementsByName('Multiplier'+i)[0].disabled=true;
document.getElementsByName('Adder'+i)[0].disabled=true;
document.getElementsByName('sensorfile'+i)[0].disabled=true;

    }

	}


	function changedisable2(i,e)
	{


var processtype=e.options[e.selectedIndex].value;
if (processtype=="Virtual") 
	//if procecsstype == Virtual
{ 
	//the elements are being set property of disabling and enabling them
document.getElementsByName('processtype'+i)[0].disabled=false;	


}
	if (processtype=="Real")
		//if procecsstype == Real
	 {
	 	//the elements are being set property of disabling and enabling them
	 	document.getElementsByName('processtype'+i)[0].disabled=true;


	 }

	 if (processtype=="Unselect") {
	 	//if procecsstype == Unselect
var elements=e.options;
 e.options[0].disabled = false;;
    for(var ii = 0; ii < elements.length; ii++){
      elements[ii].selected = false;
    }
   e.options[0].disabled= true;
   //the elements are being set property of disabling and enabling them
   	document.getElementsByName('processtype'+i)[0].disabled=true;
   	document.getElementsByName('Multiplier'+i)[0].disabled=true;
document.getElementsByName('Adder'+i)[0].disabled=true;
document.getElementsByName('sensorfile'+i)[0].disabled=true;
    }

	}

	function unSelect(id)
	{
		//the elements are being set property of disabling and enabling them
		if (document.getElementsByName(id)[0].options[document.getElementsByName(id)[0].selectedIndex].value=="Unselect") {
var elements=document.getElementsByName(id)[0].options;
  document.getElementsByName(id)[0].options[0].disabled = false;;
    for(var i = 0; i < elements.length; i++){
      elements[i].selected = false;
    }
    document.getElementsByName(id)[0].options[0].disabled = true;
    }
	}
</script>
</head>
<body>
	<input type="hidden" name="MAX_FILE_SIZE" value="10000000">
<br>
<br>
 <div class="panel panel-primary" style="width:90%;margin: 0 auto;"  >
         <div class="panel-heading" style="background-color:#4A7BDF;color:white"><center>
         <b style="font-size:15px;font-family: arial">Add/Edit Station</b></center></div>
  <div class="panel-body">
    

    <div class="container-fluid">
		<div data-wizard-init>
		  <ul class="steps">
			<li data-step="1">Step-1</li>
			<li data-step="2">Step-2</li>
			<li data-step="3" class='active'>Step-3</li>
		

		  </ul>
		  </div>
		  </div>
		
		
			 <div id="body">
    <div id="content">
        <center>
            <form name="form3" class="myform" method="post" action="addnewfinalstep.php" id="form3">
			<br>
			<?php 
			if(isset($_SESSION["stntypename"]) && isset( $_SESSION["edit_stn_name"]))
			{
			
			$stntype=trim($_SESSION["stntypename"]);
			//Session data of stntypename is set to $stntype

   $stn=trim($_SESSION['edit_stn_name']);
   //Session data of edit_stn_name is set to $stn
	
				    $sql_query="select \"Sensor\",\"SensorType\",\"SHEF\",\"Units\",\"Interval\",\"ProcessType\",\"Multiple\",\"Addition\",\"SourceFile\",\"Expression\" from \"SensorValues\" where  \"StationTypeName\"='$stntype' and \"StationFullName\"='$stn'";
				   
				  // query to select the columns from table "SensorValues" with matching condition with StationsTypeName and StationFullName


	$result_set=pg_query($sql_query);
	$data_row=array();
	$i=0;
	while($data=pg_fetch_array($result_set))
	{
		//while the $result_set is fetched into the array into the $data the loop continues
		try
		{
				if(isset($data['Sensor']))
					//if $data['Sensor'] have data
				{
	$data_row[$i]=$data['Sensor'];$i++;
				}
				else{
					$data_row[$i]="";
					$i++;
				}
		if(isset($data['SensorType']))
			//if $data['SensorType'] have data
		{
		$data_row[$i]=$data['SensorType'];

		$i++;
		}else{
					$data_row[$i]="";
					$i++;
				}
		if(isset($data['SHEF']))
			//if $data['SHEF'] have data
		{
		$data_row[$i]=$data['SHEF'];
		$i++;
		}else{
					$data_row[$i]="";
					$i++;
				}
	
	if(isset($data['Units']))
					//if $data['Units'] have data
	{
			$data_row[$i]=$data['Units'];	$i++;
	}else{
					$data_row[$i]="";
					$i++;
				}
if(isset($data['Interval']))
				//if $data['Interval'] have data
	{
			$data_row[$i]=$data['Interval'];	$i++;
	}else{
					$data_row[$i]="";
					$i++;
				}
	if(isset($data['ProcessType']))
		//if $data['ProcessType'] have data
	{
			$data_row[$i]=$data['ProcessType'];	$i++;
	}else{
					$data_row[$i]="";
					$i++;
				}
	if(isset($data['Multiple']))
		//if $data['Multiple'] have data
	{
			$data_row[$i]=$data['Multiple'];	$i++;
	}else{
					$data_row[$i]="";
					$i++;
				}

	if(isset($data['Addition']))
		//if $data['Addition'] have data
	{
			$data_row[$i]=$data['Addition'];	$i++;
	}else{
					$data_row[$i]="";
					$i++;
				}

	if(isset($data['SourceFile']))
		//if $data['SourceFile'] have data
	{
			$data_row[$i]=$data['SourceFile'];	$i++;
	}
else{
					$data_row[$i]="";
					$i++;
				}

if(isset($data['Expression']))
	//if $data['Expression'] have data
	{
			$data_row[$i]=$data['Expression'];	$i++;
	}
else{
					$data_row[$i]="";
					$i++;
				}



		}catch(Exception  $ex)
		{
		}

// echo "<script>alert('var_dump($data)')</script>";
	}
      
	
			}
			?>
			
			<table class="table" style="width:100%">
			
			<tr> <th colspan = 10>  <center>Sensor for Station: <?php echo $_POST['Station_Full_Name']."/".$_POST['Station_Shef_Code']; ?></center></th>  </tr>

			<tr>
				<!-- Tbale heads -->
			<th>Sensor Name</th>
			<th>Sensor Type (V/R)</th>
			<th>SHEF CODE</th>
			<th>Units</th>
			<th>Interval</th>
			<th>Process (Linear/Rating)</th>
			<th>Multiplier </th>
	        <th>Adder</th>
			<th>Table Source</th>
<th>Expression</th>
			</tr>
			<tr>
			<td>
			<select  class='form-control' name="sensor1" onchange="unSelect('sensor1')">
			  <option disabled selected>Select your option</option>
			  			  <option  value="Unselect">Unselect</option>
			   <?php $sql_query="SELECT \"SensorName\" FROM \"tblHydrometSensor\" order by \"SensorName\"";
    $result_set=pg_query($sql_query);
    //select sensorName from the table "tblHydrometSensor"
	 if(pg_num_rows($result_set)>0)
	 	//if the number of rows for the $result_set variable are > 0 
    {
        while($row=pg_fetch_row($result_set))
        	//while the $result_set is fetched into the array into the $row the loop continues
        {
	?>
			<option value='<?php echo "$row[0]"?>' <?php if(isset($data_row[0])){if($data_row[0]==$row[0]) echo 'selected';} ?>><?php echo "$row[0]"?></option>
		<?php 
	}}
		?>
			</select>
			</td>
					<td>
			<select  class='form-control' name="sensortype1" onchange="changedisable2('1',this)">
				  <option  disabled  selected>Select your option</option>
<option  value="Unselect">Unselect</option>
			<option  value="Virtual" <?php if(isset($data_row[1])){if($data_row[1]=='Virtual') echo 'selected';} ?>> Virtual </option>
			<option value="Real" <?php if(isset($data_row[1])){if($data_row[1]=='Real') echo 'selected';} ?>> Real </option>
			</select>
			</td>
			<td>
			<input type='text' name='shef1' class='form-control' value="<?php if(isset($data_row[2])) echo $data_row[2]; ?>">
			</td>
				<td>
									<input type='text' name='Units1' class='form-control' value="<?php if(isset($data_row[3])) echo $data_row[3]; ?>">

			</td>
			<td>
						<input type='text' name='Interval1' class='form-control' value="<?php if(isset($data_row[4])) echo $data_row[4]; ?>">

			</td>
			<td>
			<select  class='form-control' name="processtype1" disabled="" onchange="changedisable1('1',this)">
						  <option  disabled  selected>Select your option</option>
<option  value="Unselect">Unselect</option>

		<option  value="Linear" <?php if(isset($data_row[5])){if($data_row[5]=='Linear') echo 'selected';} ?>> Linear </option>
			<option value="Rating" <?php if(isset($data_row[5])){if($data_row[5]=='Rating') echo 'selected';} ?>> Rating </option>
	<option value="Expression" <?php if(isset($data_row[5])){if($data_row[5]=='Expression') echo 'selected';} ?>> Expression </option>
			</select>
			</td>
			<td>
						<input type='text' name='Multiplier1' disabled="" class='form-control' value="<?php if(isset($data_row[6])) echo $data_row[6]; ?>">

			</td>
			<td>
						<input type='text' name='Adder1' disabled="" class='form-control' value="<?php if(isset($data_row[7])) echo $data_row[7]; ?>">

			</td>
					<td>
			<select  class='form-control' name="sensorfile1" disabled="" onchange="unSelect('sensorfile1')">
			  <option disabled selected>Select your option</option>
			  			  <option  value="Unselect">Unselect</option>
			   <?php 
			   $stn_table=str_replace(" ", "_", $_POST['Station_Full_Name']);
			   $sql_query="SELECT distinct \"FileName\" FROM $stn_table";
    $result_set=pg_query($sql_query);
	 if(pg_num_rows($result_set)>0)
	 	//if the number of rows for the $result_set variable are > 0 
    {
        while($row=pg_fetch_row($result_set))
        {
	?>
			<option value='<?php echo "$row[0]"?>' <?php if(isset($data_row[8])){if($data_row[8]==$row[0]) echo 'selected';} ?>><?php echo "$row[0]"?></option>
		<?php 
	}}
		?>
			</select>
			</td>
			<td>
				<input type='text' name='expression1' disabled="" class='form-control' value="<?php if(isset($data_row[9])) echo $data_row[9]; ?>">
			</td>
			</tr>
			
			
			
			
			<tr>
			<td>
			<select  class='form-control' name="sensor2" onchange="unSelect('sensor2')">
			  <option disabled selected>Select your option</option>
			  			  <option  value="Unselect">Unselect</option>
			   <?php $sql_query="SELECT \"SensorName\" FROM \"tblHydrometSensor\" order by \"SensorName\"";
    $result_set=pg_query($sql_query);
	 if(pg_num_rows($result_set)>0)
	 	//if the number of rows for the $result_set variable are > 0 
    {
        while($row=pg_fetch_row($result_set))
        {
	?>
			<option value='<?php echo "$row[0]"?>' <?php if(isset($data_row[10])){if($data_row[10]==$row[0]) echo 'selected';} ?>><?php echo "$row[0]"?> </option>
		<?php 
	}}
		?>
			</select>
			</td>
						<td>
			<select  class='form-control' name="sensortype2" onchange="changedisable2('2',this)">
				  <option  disabled  selected>Select your option</option>
<option  value="Unselect">Unselect</option>
		<option  value="Virtual" <?php if(isset($data_row[11])){if($data_row[11]=='Virtual') echo 'selected';} ?>> Virtual </option>
			<option value="Real" <?php if(isset($data_row[11])){if($data_row[11]=='Real') echo 'selected';} ?>> Real </option>
			</select>
			</td>

			<td>
									<input type='text' name='shef2' class='form-control' value="<?php if(isset($data_row[12])) echo $data_row[12]; ?>">

			</td>
				<td>
									<input type='text' name='Units2' class='form-control' value="<?php if(isset($data_row[13])) echo $data_row[13]; ?>">

			</td>
			<td>
						<input type='text' name='Interval2' class='form-control' value="<?php if(isset($data_row[14])) echo $data_row[14]; ?>">

			</td>
			<td>
			<select  class='form-control' name="processtype2" disabled="" onchange="changedisable1('2',this)">
						  <option  disabled  selected>Select your option</option>
<option  value="Unselect">Unselect</option>
		<option  value="Linear" <?php if(isset($data_row[15])){if($data_row[15]=='Linear') echo 'selected';} ?>> Linear </option>
			<option value="Rating" <?php if(isset($data_row[15])){if($data_row[15]=='Rating') echo 'selected';} ?>> Rating </option>
			<option value="Expression" <?php if(isset($data_row[15])){if($data_row[15]=='Expression') echo 'selected';} ?>> Expression </option>
			</select>
			</td>

			<td>
									<input type='text' name='Multiplier2' disabled="" class='form-control' value="<?php if(isset($data_row[16])) echo $data_row[16]; ?>">

			</td>
			<td>
						<input type='text' name='Adder2' disabled="" class='form-control' value="<?php if(isset($data_row[17])) echo $data_row[17]; ?>">

			</td>
					<td>
			<select  class='form-control' name="sensorfile2" disabled="" onchange="unSelect('sensorfile2')">
			  <option disabled selected>Select your option</option>
			  			  <option  value="Unselect">Unselect</option>
			   <?php  $stn_table=str_replace(" ", "_", $_POST['Station_Full_Name']);
			   $sql_query="SELECT distinct \"FileName\" FROM $stn_table";
    $result_set=pg_query($sql_query);
	 if(pg_num_rows($result_set)>0)
    {
        while($row=pg_fetch_row($result_set))
        {
	?>
			<option value='<?php echo "$row[0]"?>' <?php if(isset($data_row[18])){if($data_row[18]==$row[0]) echo 'selected';} ?>><?php echo "$row[0]"?></option>
		<?php 
	}}
		?>
			</select>
			</td>
				<td>
				<input type='text' name='expression2' disabled="" class='form-control' value="<?php if(isset($data_row[19])) echo $data_row[19]; ?>">
			</td>
			</tr>
			
			
			
			
			
			
			
			
			
			
			
			
			
			<tr>
			<td>
			<select  class='form-control' name="sensor3" onchange="unSelect('sensor3')">
			  <option disabled selected>Select your option</option>
			  			  <option  value="Unselect">Unselect</option>

			   <?php $sql_query="SELECT \"SensorName\" FROM \"tblHydrometSensor\" order by \"SensorName\"";
    $result_set=pg_query($sql_query);
	 if(pg_num_rows($result_set)>0)
    {
        while($row=pg_fetch_row($result_set))
        {
	?>
			<option value='<?php echo "$row[0]"?>' <?php if(isset($data_row[20])){if($data_row[20]==$row[0]) echo 'selected';} ?>><?php echo "$row[0]"?></option>
		<?php 
	}}
		?>
			</select>
			</td>
					<td>
			<select  class='form-control' name="sensortype3" onchange="changedisable2('3',this)">
				  <option  disabled  selected>Select your option</option>
<option  value="Unselect">Unselect</option>
			  <option  value="Virtual" <?php if(isset($data_row[21])){if($data_row[21]=='Virtual') echo 'selected';} ?>> Virtual </option>
			<option value="Real" <?php if(isset($data_row[21])){if($data_row[21]=='Real') echo 'selected';} ?>> Real </option>
			</select>
			</td>
			<td>
						<input type='text' name='shef3' class='form-control' value="<?php if(isset($data_row[22])) echo $data_row[22]; ?>">

			</td>
				<td>
									<input type='text' name='Units3' class='form-control' value="<?php if(isset($data_row[23])) echo $data_row[23]; ?>">

			</td>
			<td>
						<input type='text' name='Interval3' class='form-control' value="<?php if(isset($data_row[24])) echo $data_row[24]; ?>">

			</td>
			<td>
			<select  class='form-control' name="processtype3" disabled="" onchange="changedisable1('3',this)">
						  <option  disabled  selected>Select your option</option>
<option  value="Unselect">Unselect</option>
			<option  value="Linear" <?php if(isset($data_row[25])){if($data_row[25]=='Linear') echo 'selected';} ?>> Linear </option>
			<option value="Rating" <?php if(isset($data_row[25])){if($data_row[25]=='Rating') echo 'selected';} ?>> Rating </option>
			<option value="Expression" <?php if(isset($data_row[25])){if($data_row[25]=='Expression') echo 'selected';} ?>> Expression </option>
			</select>
			</td>
			<td>
						<input type='text' name='Multiplier3' disabled="" class='form-control' value="<?php if(isset($data_row[26])) echo $data_row[26]; ?>">

			</td>
			<td>
						<input type='text' name='Adder3' disabled="" class='form-control' value="<?php if(isset($data_row[27])) echo $data_row[27]; ?>">

			</td>
						<td>
			<select  class='form-control' name="sensorfile3" disabled="" onchange="unSelect('sensorfile3')">
			  <option disabled selected>Select your option</option>
			  			  <option  value="Unselect">Unselect</option>
			   <?php 
			    $stn_table=str_replace(" ", "_", $_POST['Station_Full_Name']);
			   $sql_query="SELECT distinct \"FileName\" FROM $stn_table";
    $result_set=pg_query($sql_query);
	 if(pg_num_rows($result_set)>0)
    {
        while($row=pg_fetch_row($result_set))
        {
	?>
			<option value='<?php echo "$row[0]"?>' <?php if(isset($data_row[28])){if($data_row[28]==$row[0]) echo 'selected';} ?>><?php echo "$row[0]"?></option>
		<?php 
	}}
		?>
			</select>
			</td>
				<td>
				<input type='text' name='expression3' disabled="" class='form-control' value="<?php if(isset($data_row[29])) echo $data_row[29]; ?>">
			</td>
			</tr>
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			<tr>
			<td>
			<select  class='form-control' name="sensor4" onchange="unSelect('sensor4')">
			  <option disabled selected>Select your option</option>
			  			  <option  value="Unselect">Unselect</option>
			   <?php $sql_query="SELECT \"SensorName\" FROM \"tblHydrometSensor\" order by \"SensorName\"";
    $result_set=pg_query($sql_query);
	 if(pg_num_rows($result_set)>0)
    {
        while($row=pg_fetch_row($result_set))
        {
	?>
			<option value='<?php echo "$row[0]"?>' <?php if(isset($data_row[30])){if($data_row[30]==$row[0]) echo 'selected';} ?>><?php echo "$row[0]"?></option>
		<?php 
	}}
		?>
			</select>
			</td>
						<td>
			<select  class='form-control' name="sensortype4" onchange="changedisable2('4',this)">
					  <option  disabled  selected>Select your option</option>
<option  value="Unselect">Unselect</option>
		<option  value="Virtual" <?php if(isset($data_row[31])){if($data_row[31]=='Virtual') echo 'selected';} ?>> Virtual </option>
			<option value="Real" <?php if(isset($data_row[31])){if($data_row[31]=='Real') echo 'selected';} ?>> Real </option>
			</select>
			</td>
			
			<td>
						<input type='text' name='shef4' class='form-control' value="<?php if(isset($data_row[32])) echo $data_row[32]; ?>">

			</td>
				<td>
									<input type='text' name='Units4' class='form-control' value="<?php if(isset($data_row[33])) echo $data_row[33]; ?>">

			</td>
			<td>
						<input type='text' name='Interval4' class='form-control' value="<?php if(isset($data_row[34])) echo $data_row[34]; ?>">

			</td>
			<td>
			<select  class='form-control' name="processtype4" disabled="" onchange="changedisable1('4',this)">
						  <option  disabled  selected>Select your option</option>
<option  value="Unselect">Unselect</option>
			<option  value="Linear" <?php if(isset($data_row[35])){if($data_row[35]=='Linear') echo 'selected';} ?>> Linear </option>
			<option value="Rating" <?php if(isset($data_row[35])){if($data_row[35]=='Rating') echo 'selected';} ?>> Rating </option>
			<option value="Expression" <?php if(isset($data_row[35])){if($data_row[35]=='Expression') echo 'selected';} ?>> Expression </option>
			</select>
			</td>
			<td>
						<input type='text' name='Multiplier4' disabled="" class='form-control' value="<?php if(isset($data_row[36])) echo $data_row[36]; ?>">

			</td>
			<td>
						<input type='text' name='Adder4' disabled="" class='form-control' value="<?php if(isset($data_row[37])) echo $data_row[37]; ?>">

			</td>
			
						<td>
			<select  class='form-control' name="sensorfile4" disabled="" onchange="unSelect('sensorfile4')">
			  <option disabled selected>Select your option</option>
			  			  <option  value="Unselect">Unselect</option>
			   <?php 
			    $stn_table=str_replace(" ", "_", $_POST['Station_Full_Name']);
			   $sql_query="SELECT distinct \"FileName\" FROM $stn_table";
    $result_set=pg_query($sql_query);
	 if(pg_num_rows($result_set)>0)
    {
        while($row=pg_fetch_row($result_set))
        {
	?>
			<option value='<?php echo "$row[0]"?>' <?php if(isset($data_row[38])){if($data_row[38]==$row[0]) echo 'selected';} ?>><?php echo "$row[0]"?></option>
		<?php 
	}}
		?>
			</select>
			</td>
				<td>
				<input type='text' name='expression4' disabled="" class='form-control' value="<?php if(isset($data_row[39])) echo $data_row[39]; ?>">
			</td>
			</tr>
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			<tr>
			<td>
			<select  class='form-control' name="sensor5" onchange="unSelect('sensor5')">
			  <option disabled selected>Select your option</option>
			  			  <option  value="Unselect">Unselect</option>
			   <?php $sql_query="SELECT \"SensorName\" FROM \"tblHydrometSensor\" order by \"SensorName\"";
    $result_set=pg_query($sql_query);
	 if(pg_num_rows($result_set)>0)
    {
        while($row=pg_fetch_row($result_set))
        {
	?>
			<option value='<?php echo "$row[0]"?>' <?php if(isset($data_row[40])){if($data_row[40]==$row[0]) echo 'selected';} ?>><?php echo "$row[0]"?></option>
		<?php 
	}}
		?>
			</select>
			</td>
						<td>
			<select  class='form-control' name="sensortype5" onchange="changedisable2('5',this)">
						  <option  disabled  selected>Select your option</option>
<option  value="Unselect">Unselect</option>
			<option  value="Virtual" <?php if(isset($data_row[41])){if($data_row[41]=='Virtual') echo 'selected';} ?>> Virtual </option>
			<option value="Real" <?php if(isset($data_row[41])){if($data_row[41]=='Real') echo 'selected';} ?>> Real </option>
			</select>
			</td>

			<td>						<input type='text' name='shef5' class='form-control' value="<?php if(isset($data_row[42])) echo $data_row[42]; ?>">

			</td>
				<td>
									<input type='text' name='Units5' class='form-control' value="<?php if(isset($data_row[43])) echo $data_row[43]; ?>">

			</td>
			<td>
						<input type='text' name='Interval5' class='form-control' value="<?php if(isset($data_row[44])) echo $data_row[44]; ?>">

			</td>
			<td>
			<select  class='form-control' name="processtype5" disabled="" onchange="changedisable1('5',this)">
						  <option  disabled  selected>Select your option</option>
<option  value="Unselect">Unselect</option>
			<option  value="Linear" <?php if(isset($data_row[45])){if($data_row[45]=='Linear') echo 'selected';} ?>> Linear </option>
			<option value="Rating" <?php if(isset($data_row[45])){if($data_row[45]=='Rating') echo 'selected';} ?>> Rating </option>
			<option value="Expression" <?php if(isset($data_row[45])){if($data_row[45]=='Expression') echo 'selected';} ?>> Expression </option>
			</select>
			</td>
			
			<td>
						<input type='text' name='Multiplier5' disabled="" class='form-control' value="<?php if(isset($data_row[46])) echo $data_row[46]; ?>">

			</td>
			<td>
						<input type='text' name='Adder5' disabled="" class='form-control' value="<?php if(isset($data_row[47])) echo $data_row[47]; ?>">

			</td>
						<td>
			<select  class='form-control' name="sensorfile5" disabled="" onchange="unSelect('sensorfile5')">
			  <option disabled selected>Select your option</option>
			  			  <option  value="Unselect">Unselect</option>
			   <?php 
			    $stn_table=str_replace(" ", "_", $_POST['Station_Full_Name']);
			   $sql_query="SELECT distinct \"FileName\" FROM $stn_table";
    $result_set=pg_query($sql_query);
	 if(pg_num_rows($result_set)>0)
    {
        while($row=pg_fetch_row($result_set))
        {
	?>
			<option value='<?php echo "$row[0]"?>' <?php if(isset($data_row[48])){if($data_row[48]==$row[0]) echo 'selected';} ?>><?php echo "$row[0]"?></option>
		<?php 
	}}
		?>
			</select>
			</td>
				<td>
				<input type='text' name='expression5' disabled="" class='form-control' value="<?php if(isset($data_row[49])) echo $data_row[49]; ?>">
			</td>
			</tr>
			
			
			
			
			
			
			
			
			
			
			
			
			
			<tr>
						<td>
			<select  class='form-control' name="sensor6" onchange="unSelect('sensor6')">
			  <option disabled selected>Select your option</option>
			  			  <option  value="Unselect">Unselect</option>
			   <?php $sql_query="SELECT \"SensorName\" FROM \"tblHydrometSensor\" order by \"SensorName\"";
    $result_set=pg_query($sql_query);
	 if(pg_num_rows($result_set)>0)
    {
        while($row=pg_fetch_row($result_set))
        {
	?>
			<option value='<?php echo "$row[0]"?>' <?php if(isset($data_row[50])){if($data_row[50]==$row[0]) echo 'selected';} ?>><?php echo "$row[0]"?></option>
		<?php 
	}}
		?>
			</select>
			</td>
			<td>
			<select  class='form-control' name="sensortype6" onchange="changedisable2('6',this)">
						  <option  disabled  selected>Select your option</option>
<option  value="Unselect">Unselect</option>
			 <option  value="Virtual" <?php if(isset($data_row[51])){if($data_row[51]=='Virtual') echo 'selected';} ?>> Virtual </option>
			<option value="Real" <?php if(isset($data_row[51])){if($data_row[51]=='Real') echo 'selected';} ?>> Real </option>
			</select>
			</td>
			<td>
						<input type='text' name='shef6' class='form-control' value="<?php if(isset($data_row[52])) echo $data_row[52]; ?>">

			</td>
			
				<td>
									<input type='text' name='Units6' class='form-control' value="<?php if(isset($data_row[53])) echo $data_row[53]; ?>">

			</td>
			<td>
						<input type='text' name='Interval6' class='form-control' value="<?php if(isset($data_row[54])) echo $data_row[54]; ?>">

			</td>
			<td>
			<select  class='form-control' name="processtype6" disabled="" onchange="changedisable1('6',this)">
						  <option  disabled  selected>Select your option</option>
<option  value="Unselect">Unselect</option>
			<option  value="Linear" <?php if(isset($data_row[55])){if($data_row[55]=='Linear') echo 'selected';} ?>> Linear </option>
			<option value="Rating" <?php if(isset($data_row[55])){if($data_row[55]=='Rating') echo 'selected';} ?>> Rating </option>
			<option value="Expression" <?php if(isset($data_row[55])){if($data_row[55]=='Expression') echo 'selected';} ?>> Expression </option>
			</select>
			</td>
			<td>
						<input type='text' name='Multiplier6' disabled="" class='form-control' value="<?php if(isset($data_row[56])) echo $data_row[56]; ?>">

			</td>
			<td>
						<input type='text' name='Adder6' disabled="" class='form-control' value="<?php if(isset($data_row[57])) echo $data_row[57]; ?>">

			</td>
						<td>
			<select  class='form-control' name="sensorfile6" disabled="" onchange="unSelect('sensorfile6')">
			  <option disabled selected>Select your option</option>
			  			  <option  value="Unselect">Unselect</option>
			   <?php 
			    $stn_table=str_replace(" ", "_", $_POST['Station_Full_Name']);
			   $sql_query="SELECT distinct \"FileName\" FROM $stn_table";
    $result_set=pg_query($sql_query);
	 if(pg_num_rows($result_set)>0)
    {
        while($row=pg_fetch_row($result_set))
        {
	?>
			<option value='<?php echo "$row[0]"?>' <?php if(isset($data_row[58])){if($data_row[58]==$row[0]) echo 'selected';} ?>><?php echo "$row[0]"?></option>
		<?php 
	}}
		?>
			</select>
			</td>
				<td>
				<input type='text' name='expression6' disabled="" class='form-control' value="<?php if(isset($data_row[59])) echo $data_row[59]; ?>">
			</td>
			</tr>
			
			
			
			
			
			
			
			
			
			
			
			
			
			<tr>
						<td>
			<select  class='form-control' name="sensor7" onchange="unSelect('sensor7')">
			  <option disabled selected>Select your option</option>
			  			  <option  value="Unselect">Unselect</option>
			   <?php $sql_query="SELECT \"SensorName\" FROM \"tblHydrometSensor\" order by \"SensorName\"";
    $result_set=pg_query($sql_query);
	 if(pg_num_rows($result_set)>0)
    {
        while($row=pg_fetch_row($result_set))
        {
	?>
			<option value='<?php echo "$row[0]"?>' <?php if(isset($data_row[60])){if($data_row[60]==$row[0]) echo 'selected';} ?>><?php echo "$row[0]"?></option>
		<?php 
	}}
		?>
			</select>
			</td>
			<td>
			<select  class='form-control' name="sensortype7" onchange="changedisable2('7',this)">
				  <option  disabled  selected>Select your option</option>
<option  value="Unselect">Unselect</option>
	<option  value="Virtual" <?php if(isset($data_row[61])){if($data_row[61]=='Virtual') echo 'selected';} ?>> Virtual </option>
			<option value="Real" <?php if(isset($data_row[61])){if($data_row[61]=='Real') echo 'selected';} ?>> Real </option>
			</select>
			</td>
			<td>
						<input type='text' name='shef7' class='form-control' value="<?php if(isset($data_row[62])) echo $data_row[62]; ?>">

			</td>
				<td>
									<input type='text' name='Units7' class='form-control' value="<?php if(isset($data_row[63])) echo $data_row[63]; ?>">

			</td>
			<td>
						<input type='text' name='Interval7' class='form-control' value="<?php if(isset($data_row[64])) echo $data_row[64]; ?>">

			</td>
			<td>
			<select  class='form-control' name="processtype7" disabled="" onchange="changedisable1('7',this)">
						  <option  disabled  selected>Select your option</option>
<option  value="Unselect">Unselect</option>
			<option  value="Linear" <?php if(isset($data_row[65])){if($data_row[65]=='Linear') echo 'selected';} ?>> Linear </option>
			<option value="Rating" <?php if(isset($data_row[65])){if($data_row[65]=='Rating') echo 'selected';} ?>> Rating </option>
			<option value="Expression" <?php if(isset($data_row[65])){if($data_row[65]=='Expression') echo 'selected';} ?>> Expression </option>
			</select>
			</td>
			<td>
						<input type='text' name='Multiplier7' disabled="" class='form-control' value="<?php if(isset($data_row[66])) echo $data_row[66]; ?>">

			</td>
			<td>
						<input type='text' name='Adder7' disabled="" class='form-control' value="<?php if(isset($data_row[67])) echo $data_row[67]; ?>">

			</td>
						<td>
			<select  class='form-control' name="sensorfile7" disabled="" onchange="unSelect('sensorfile7')">
			  <option disabled selected>Select your option</option>
			  			  <option  value="Unselect">Unselect</option>
			   <?php 
			    $stn_table=str_replace(" ", "_", $_POST['Station_Full_Name']);
			   $sql_query="SELECT distinct \"FileName\" FROM $stn_table";
    $result_set=pg_query($sql_query);
	 if(pg_num_rows($result_set)>0)
    {
        while($row=pg_fetch_row($result_set))
        {
	?>
			<option value='<?php echo "$row[0]"?>' <?php if(isset($data_row[68])){if($data_row[68]==$row[0]) echo 'selected';} ?>><?php echo "$row[0]"?></option>
		<?php 
	}}
		?>
			</select>
			</td>
				<td>
				<input type='text' name='expression7' disabled="" class='form-control' value="<?php if(isset($data_row[69])) echo $data_row[69]; ?>">
			</td>
			</tr>
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			<tr>
						<td>
			<select  class='form-control' name="sensor8" onchange="unSelect('sensor8')">
			  <option disabled selected>Select your option</option>
			  			  <option  value="Unselect">Unselect</option>
			   <?php $sql_query="SELECT \"SensorName\" FROM \"tblHydrometSensor\" order by \"SensorName\"";
    $result_set=pg_query($sql_query);
	 if(pg_num_rows($result_set)>0)
    {
        while($row=pg_fetch_row($result_set))
        {
	?>
			<option value='<?php echo "$row[0]"?>' <?php if(isset($data_row[70])){if($data_row[70]==$row[0]) echo 'selected';} ?>><?php echo "$row[0]"?></option>
		<?php 
	}}
		?>
			</select>
			</td>
			<td>
			<select  class='form-control' name="sensortype8" onchange="changedisable2('8',this)">
						  <option  disabled  selected>Select your option</option>
<option  value="Unselect">Unselect</option>
			<option  value="Virtual" <?php if(isset($data_row[71])){if($data_row[71]=='Virtual') echo 'selected';} ?>> Virtual </option>
			<option value="Real" <?php if(isset($data_row[71])){if($data_row[71]=='Real') echo 'selected';} ?>> Real </option>
			</select>
			</td>
			<td>
						<input type='text' name='shef8' class='form-control' value="<?php if(isset($data_row[72])) echo $data_row[72]; ?>">

			</td>
				<td>
									<input type='text' name='Units8' class='form-control' value="<?php if(isset($data_row[73])) echo $data_row[73]; ?>">

			</td>
			<td>
						<input type='text' name='Interval8' class='form-control' value="<?php if(isset($data_row[74])) echo $data_row[74]; ?>">

			</td>
			<td>
			<select  class='form-control' name="processtype8" disabled="" onchange="changedisable1('8',this)">
						  <option  disabled  selected>Select your option</option>
<option  value="Unselect">Unselect</option>
			 <option  value="Linear" <?php if(isset($data_row[75])){if($data_row[75]=='Linear') echo 'selected';} ?>> Linear </option>
			<option value="Rating" <?php if(isset($data_row[75])){if($data_row[75]=='Rating') echo 'selected';} ?>> Rating </option>
			<option value="Expression" <?php if(isset($data_row[75])){if($data_row[75]=='Expression') echo 'selected';} ?>> Expression </option>
			</select>
			</td>
			<td>
						<input type='text' name='Multiplier8' disabled="" class='form-control' value="<?php if(isset($data_row[76])) echo $data_row[76]; ?>">

			</td>
			<td>
						<input type='text' name='Adder8' disabled="" class='form-control' value="<?php if(isset($data_row[77])) echo $data_row[77]; ?>">

			</td>
						<td>
			<select  class='form-control' name="sensorfile8" disabled="" onchange="unSelect('sensorfile8')">
			  <option disabled selected>Select your option</option>
			  			  <option  value="Unselect">Unselect</option>
			   <?php 
			    $stn_table=str_replace(" ", "_", $_POST['Station_Full_Name']);
			   $sql_query="SELECT distinct \"FileName\" FROM $stn_table";
    $result_set=pg_query($sql_query);
	 if(pg_num_rows($result_set)>0)
    {
        while($row=pg_fetch_row($result_set))
        {
	?>
			<option value='<?php echo "$row[0]"?>' <?php if(isset($data_row[78])){if($data_row[78]==$row[0]) echo 'selected';} ?>><?php echo "$row[0]"?></option>
		<?php 
	}}
		?>
			</select>
			</td>
				<td>
				<input type='text' name='expression8' disabled="" class='form-control' value="<?php if(isset($data_row[79])) echo $data_row[79]; ?>">
			</td>
			</tr>
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			<tr>
						<td>
			<select  class='form-control' name="sensor9" onchange="unSelect('sensor9')">
			  <option disabled selected>Select your option</option>
			  			  <option  value="Unselect">Unselect</option>
			   <?php $sql_query="SELECT \"SensorName\" FROM \"tblHydrometSensor\" order by \"SensorName\"";
    $result_set=pg_query($sql_query);
	 if(pg_num_rows($result_set)>0)
    {
        while($row=pg_fetch_row($result_set))
        {
	?>
			<option value='<?php echo "$row[0]"?>' <?php if(isset($data_row[80])){if($data_row[80]==$row[0]) echo 'selected';} ?>><?php echo "$row[0]"?></option>
		<?php 
	}}
		?>
			</select>
			</td>
			<td>
			<select  class='form-control' name="sensortype9" onchange="changedisable2('9',this)">
						  <option  disabled  selected>Select your option</option>
<option  value="Unselect">Unselect</option>
		<option  value="Virtual" <?php if(isset($data_row[81])){if($data_row[81]=='Virtual') echo 'selected';} ?>> Virtual </option>
			<option value="Real" <?php if(isset($data_row[81])){if($data_row[81]=='Real') echo 'selected';} ?>> Real </option>
			</select>
			</td>
			<td>
						<input type='text' name='shef9' class='form-control' value="<?php if(isset($data_row[82])) echo $data_row[82]; ?>">

			</td>
				<td>
									<input type='text' name='Units9' class='form-control' value="<?php if(isset($data_row[83])) echo $data_row[83]; ?>">

			</td>
			<td>
						<input type='text' name='Interval9' class='form-control' value="<?php if(isset($data_row[84])) echo $data_row[84]; ?>">

			</td>
			<td>
			<select  class='form-control' name="processtype9" disabled="" onchange="changedisable1('9',this)">
						  <option  disabled  selected>Select your option</option>
<option  value="Unselect">Unselect</option>
<option  value="Linear" <?php if(isset($data_row[85])){if($data_row[85]=='Linear') echo 'selected';} ?>> Linear </option>
			<option value="Rating" <?php if(isset($data_row[85])){if($data_row[85]=='Rating') echo 'selected';} ?>> Rating </option>
			<option value="Expression" <?php if(isset($data_row[85])){if($data_row[85]=='Expression') echo 'selected';} ?>> Expression </option>
			</select>
			</td>
			<td>
						<input type='text' name='Multiplier9' disabled="" class='form-control' value="<?php if(isset($data_row[86])) echo $data_row[86]; ?>">

			</td>
			<td>
						<input type='text' name='Adder9' disabled="" class='form-control' value="<?php if(isset($data_row[87])) echo $data_row[87]; ?>">

			</td>
						<td>
			<select  class='form-control' name="sensorfile9" disabled="" onchange="unSelect('sensorfile9')">
			  <option disabled selected>Select your option</option>
			  			  <option  value="Unselect">Unselect</option>
			   <?php  $stn_table=str_replace(" ", "_", $_POST['Station_Full_Name']);
			   $sql_query="SELECT distinct \"FileName\" FROM $stn_table";
    $result_set=pg_query($sql_query);
	 if(pg_num_rows($result_set)>0)
    {
        while($row=pg_fetch_row($result_set))
        {
	?>
			<option value='<?php echo "$row[0]"?>' <?php if(isset($data_row[88])){if($data_row[88]==$row[0]) echo 'selected';} ?>><?php echo "$row[0]"?></option>
		<?php 
	}}
		?>
			</select>
			</td>
				<td>
				<input type='text' name='expression9' disabled="" class='form-control' value="<?php if(isset($data_row[89])) echo $data_row[89]; ?>">
			</td>
			</tr>
			
		
			<tr>
						<td>
			<select  class='form-control' name="sensor10" onchange="unSelect('sensor10')">
			  <option disabled selected>Select your option</option>
			  			  <option  value="Unselect">Unselect</option>
			   <?php $sql_query="SELECT \"SensorName\" FROM \"tblHydrometSensor\" order by \"SensorName\"";
    $result_set=pg_query($sql_query);
	 if(pg_num_rows($result_set)>0)
    {
        while($row=pg_fetch_row($result_set))
        {
	?>
			<option value='<?php echo "$row[0]"?>' <?php if(isset($data_row[90])){if($data_row[90]==$row[0]) echo 'selected';} ?>><?php echo "$row[0]"?></option>
		<?php 
	}}
		?>
			</select>
			</td>
			<td>
			<select  class='form-control' name="sensortype10" onchange="changedisable2('10',this)">
			  			  <option  disabled  selected>Select your option</option>
<option  value="Unselect">Unselect</option>
		<option  value="Virtual" <?php if(isset($data_row[91])){if($data_row[91]=='Virtual') echo 'selected';} ?>> Virtual </option>
			<option value="Real" <?php if(isset($data_row[91])){if($data_row[91]=='Real') echo 'selected';} ?>> Real </option>
			</select>
			</td>
			<td>
						<input type='text' name='shef10' class='form-control' value="<?php if(isset($data_row[92])) echo $data_row[92]; ?>">

			</td>
				<td>
									<input type='text' name='Units10' class='form-control' value="<?php if(isset($data_row[93])) echo $data_row[93]; ?>">

			</td>
			<td>
						<input type='text' name='Interval10' class='form-control' value="<?php if(isset($data_row[94])) echo $data_row[94]; ?>">

			</td>
			<td>
			<select  class='form-control' name="processtype10" disabled="" onchange="changedisable1('10',this)">
						  <option  disabled  selected>Select your option</option>
<option  value="Unselect">Unselect</option>
			 <option  value="Linear" <?php if(isset($data_row[95])){if($data_row[95]=='Linear') echo 'selected';} ?>> Linear </option>
			<option value="Rating" <?php if(isset($data_row[95])){if($data_row[95]=='Rating') echo 'selected';} ?>> Rating </option>
			<option value="Expression" <?php if(isset($data_row[95])){if($data_row[95]=='Expression') echo 'selected';} ?>> Expression </option>
			</select>
			</td>
			<td>
						<input type='text' name='Multiplier10' disabled="" class='form-control' value="<?php if(isset($data_row[96])) echo $data_row[96]; ?>">

			</td>
			<td>
						<input type='text' name='Adder10' disabled="" class='form-control' value="<?php if(isset($data_row[97])) echo $data_row[97]; ?>">

			</td>
						<td>
			<select  class='form-control' name="sensorfile10" disabled="" onchange="unSelect('sensorfile10')">
			  <option disabled selected>Select your option</option>
			  			  <option  value="Unselect">Unselect</option>
			   <?php 
			    $stn_table=str_replace(" ", "_", $_POST['Station_Full_Name']);
			   $sql_query="SELECT distinct \"FileName\" FROM $stn_table";
    $result_set=pg_query($sql_query);
	 if(pg_num_rows($result_set)>0)
    {
        while($row=pg_fetch_row($result_set))
        {
	?>
			<option value='<?php echo "$row[0]"?>' <?php if(isset($data_row[98])){if($data_row[98]==$row[0]) echo 'selected';} ?>><?php echo "$row[0]"?></option>
		<?php 
	}}
		?>
			</select>
			</td>
				<td>
				<input type='text' name='expression10' disabled="" class='form-control' value="<?php if(isset($data_row[99])) echo $data_row[99]; ?>">
			</td>
			</tr>














	<tr>
						<td>
			<select  class='form-control' name="sensor11" onchange="unSelect('sensor11')">
			  <option disabled selected>Select your option</option>
			  			  <option  value="Unselect">Unselect</option>
			   <?php $sql_query="SELECT \"SensorName\" FROM \"tblHydrometSensor\" order by \"SensorName\"";
    $result_set=pg_query($sql_query);
	 if(pg_num_rows($result_set)>0)
    {
        while($row=pg_fetch_row($result_set))
        {
	?>
			<option value='<?php echo "$row[0]"?>' <?php if(isset($data_row[100])){if($data_row[100]==$row[0]) echo 'selected';} ?>><?php echo "$row[0]"?></option>
		<?php 
	}}
		?>
			</select>
			</td>
			<td>
			<select  class='form-control' name="sensortype11" onchange="changedisable2('11',this)">
			  			  <option  disabled  selected>Select your option</option>
<option  value="Unselect">Unselect</option>
		<option  value="Virtual" <?php if(isset($data_row[101])){if($data_row[101]=='Virtual') echo 'selected';} ?>> Virtual </option>
			<option value="Real" <?php if(isset($data_row[101])){if($data_row[101]=='Real') echo 'selected';} ?>> Real </option>
			</select>
			</td>
			<td>
						<input type='text' name='shef11' class='form-control' value="<?php if(isset($data_row[102])) echo $data_row[102]; ?>">

			</td>
				<td>
									<input type='text' name='Units11' class='form-control' value="<?php if(isset($data_row[103])) echo $data_row[103]; ?>">

			</td>
			<td>
						<input type='text' name='Interval11' class='form-control' value="<?php if(isset($data_row[104])) echo $data_row[104]; ?>">

			</td>
			<td>
			<select  class='form-control' name="processtype11" disabled="" onchange="changedisable1('11',this)">
						  <option  disabled  selected>Select your option</option>
<option  value="Unselect">Unselect</option>
			 <option  value="Linear" <?php if(isset($data_row[105])){if($data_row[105]=='Linear') echo 'selected';} ?>> Linear </option>
			<option value="Rating" <?php if(isset($data_row[105])){if($data_row[105]=='Rating') echo 'selected';} ?>> Rating </option>
			<option value="Expression" <?php if(isset($data_row[105])){if($data_row[105]=='Expression') echo 'selected';} ?>> Expression </option>
			</select>
			</td>
			<td>
						<input type='text' name='Multiplier11' disabled="" class='form-control' value="<?php if(isset($data_row[106])) echo $data_row[106]; ?>">

			</td>
			<td>
						<input type='text' name='Adder11' disabled="" class='form-control' value="<?php if(isset($data_row[107])) echo $data_row[107]; ?>">

			</td>
						<td>
			<select  class='form-control' name="sensorfile11" disabled="" onchange="unSelect('sensorfile11')">
			  <option disabled selected>Select your option</option>
			  			  <option  value="Unselect">Unselect</option>
			   <?php 
			    $stn_table=str_replace(" ", "_", $_POST['Station_Full_Name']);
			   $sql_query="SELECT distinct \"FileName\" FROM $stn_table";
    $result_set=pg_query($sql_query);
	 if(pg_num_rows($result_set)>0)
    {
        while($row=pg_fetch_row($result_set))
        {
	?>
			<option value='<?php echo "$row[0]"?>' <?php if(isset($data_row[108])){if($data_row[108]==$row[0]) echo 'selected';} ?>><?php echo "$row[0]"?></option>
		<?php 
	}}
		?>
			</select>
			</td>
				<td>
				<input type='text' name='expression11' disabled="" class='form-control' value="<?php if(isset($data_row[109])) echo $data_row[109]; ?>">
			</td>
			</tr>

	<tr>
						<td>
			<select  class='form-control' name="sensor12" onchange="unSelect('sensor12')">
			  <option disabled selected>Select your option</option>
			  			  <option  value="Unselect">Unselect</option>
			   <?php $sql_query="SELECT \"SensorName\" FROM \"tblHydrometSensor\" order by \"SensorName\"";
    $result_set=pg_query($sql_query);
	 if(pg_num_rows($result_set)>0)
    {
        while($row=pg_fetch_row($result_set))
        {
	?>
			<option value='<?php echo "$row[0]"?>' <?php if(isset($data_row[110])){if($data_row[110]==$row[0]) echo 'selected';} ?>><?php echo "$row[0]"?></option>
		<?php 
	}}
		?>
			</select>
			</td>
			<td>
			<select  class='form-control' name="sensortype12" onchange="changedisable2('12',this)">
			  			  <option  disabled  selected>Select your option</option>
<option  value="Unselect">Unselect</option>
		<option  value="Virtual" <?php if(isset($data_row[111])){if($data_row[111]=='Virtual') echo 'selected';} ?>> Virtual </option>
			<option value="Real" <?php if(isset($data_row[111])){if($data_row[111]=='Real') echo 'selected';} ?>> Real </option>
			</select>
			</td>
			<td>
						<input type='text' name='shef12' class='form-control' value="<?php if(isset($data_row[112])) echo $data_row[112]; ?>">

			</td>
				<td>
									<input type='text' name='Units12' class='form-control' value="<?php if(isset($data_row[113])) echo $data_row[113]; ?>">

			</td>
			<td>
						<input type='text' name='Interval12' class='form-control' value="<?php if(isset($data_row[114])) echo $data_row[114]; ?>">

			</td>
			<td>
			<select  class='form-control' name="processtype12" disabled="" onchange="changedisable1('12',this)">
						  <option  disabled  selected>Select your option</option>
<option  value="Unselect">Unselect</option>
			 <option  value="Linear" <?php if(isset($data_row[115])){if($data_row[115]=='Linear') echo 'selected';} ?>> Linear </option>
			<option value="Rating" <?php if(isset($data_row[115])){if($data_row[115]=='Rating') echo 'selected';} ?>> Rating </option>
			<option value="Expression" <?php if(isset($data_row[115])){if($data_row[115]=='Expression') echo 'selected';} ?>> Expression </option>
			</select>
			</td>
			<td>
						<input type='text' name='Multiplier12' disabled="" class='form-control' value="<?php if(isset($data_row[116])) echo $data_row[116]; ?>">

			</td>
			<td>
						<input type='text' name='Adder12' disabled="" class='form-control' value="<?php if(isset($data_row[117])) echo $data_row[117]; ?>">

			</td>
						<td>
			<select  class='form-control' name="sensorfile12" disabled="" onchange="unSelect('sensorfile12')">
			  <option disabled selected>Select your option</option>
			  			  <option  value="Unselect">Unselect</option>
			   <?php 
			    $stn_table=str_replace(" ", "_", $_POST['Station_Full_Name']);
			   $sql_query="SELECT distinct \"FileName\" FROM $stn_table";
    $result_set=pg_query($sql_query);
	 if(pg_num_rows($result_set)>0)
    {
        while($row=pg_fetch_row($result_set))
        {
	?>
			<option value='<?php echo "$row[0]"?>' <?php if(isset($data_row[118])){if($data_row[118]==$row[0]) echo 'selected';} ?>><?php echo "$row[0]"?></option>
		<?php 
	}}
		?>
			</select>
			</td>
				<td>
				<input type='text' name='expression12' disabled="" class='form-control' value="<?php if(isset($data_row[119])) echo $data_row[119]; ?>">
			</td>
			</tr>


	<tr>
						<td>
			<select  class='form-control' name="sensor13" onchange="unSelect('sensor13')">
			  <option disabled selected>Select your option</option>
			  			  <option  value="Unselect">Unselect</option>
			   <?php $sql_query="SELECT \"SensorName\" FROM \"tblHydrometSensor\" order by \"SensorName\"";
    $result_set=pg_query($sql_query);
	 if(pg_num_rows($result_set)>0)
    {
        while($row=pg_fetch_row($result_set))
        {
	?>
			<option value='<?php echo "$row[0]"?>' <?php if(isset($data_row[120])){if($data_row[120]==$row[0]) echo 'selected';} ?>><?php echo "$row[0]"?></option>
		<?php 
	}}
		?>
			</select>
			</td>
			<td>
			<select  class='form-control' name="sensortype13" onchange="changedisable2('13',this)">
			  			  <option  disabled  selected>Select your option</option>
<option  value="Unselect">Unselect</option>
		<option  value="Virtual" <?php if(isset($data_row[121])){if($data_row[121]=='Virtual') echo 'selected';} ?>> Virtual </option>
			<option value="Real" <?php if(isset($data_row[121])){if($data_row[121]=='Real') echo 'selected';} ?>> Real </option>
			</select>
			</td>
			<td>
						<input type='text' name='shef13' class='form-control' value="<?php if(isset($data_row[122])) echo $data_row[122]; ?>">

			</td>
				<td>
									<input type='text' name='Units13' class='form-control' value="<?php if(isset($data_row[123])) echo $data_row[123]; ?>">

			</td>
			<td>
						<input type='text' name='Interval13' class='form-control' value="<?php if(isset($data_row[124])) echo $data_row[124]; ?>">

			</td>
			<td>
			<select  class='form-control' name="processtype13" disabled="" onchange="changedisable1('13',this)">
						  <option  disabled  selected>Select your option</option>
<option  value="Unselect">Unselect</option>
			 <option  value="Linear" <?php if(isset($data_row[125])){if($data_row[125]=='Linear') echo 'selected';} ?>> Linear </option>
			<option value="Rating" <?php if(isset($data_row[125])){if($data_row[125]=='Rating') echo 'selected';} ?>> Rating </option>
			<option value="Expression" <?php if(isset($data_row[125])){if($data_row[125]=='Expression') echo 'selected';} ?>> Expression </option>
			</select>
			</td>
			<td>
						<input type='text' name='Multiplier13' disabled="" class='form-control' value="<?php if(isset($data_row[126])) echo $data_row[126]; ?>">

			</td>
			<td>
						<input type='text' name='Adder13' disabled="" class='form-control' value="<?php if(isset($data_row[127])) echo $data_row[127]; ?>">

			</td>
						<td>
			<select  class='form-control' name="sensorfile13" disabled="" onchange="unSelect('sensorfile13')">
			  <option disabled selected>Select your option</option>
			  			  <option  value="Unselect">Unselect</option>
			   <?php 
			    $stn_table=str_replace(" ", "_", $_POST['Station_Full_Name']);
			   $sql_query="SELECT distinct \"FileName\" FROM $stn_table";
    $result_set=pg_query($sql_query);
	 if(pg_num_rows($result_set)>0)
    {
        while($row=pg_fetch_row($result_set))
        {
	?>
			<option value='<?php echo "$row[0]"?>' <?php if(isset($data_row[128])){if($data_row[128]==$row[0]) echo 'selected';} ?>><?php echo "$row[0]"?></option>
		<?php 
	}}
		?>
			</select>
			</td>
				<td>
				<input type='text' name='expression13' disabled="" class='form-control' value="<?php if(isset($data_row[129])) echo $data_row[129]; ?>">
			</td>
			</tr>





	<tr>
						<td>
			<select  class='form-control' name="sensor14" onchange="unSelect('sensor14')">
			  <option disabled selected>Select your option</option>
			  			  <option  value="Unselect">Unselect</option>
			   <?php $sql_query="SELECT \"SensorName\" FROM \"tblHydrometSensor\" order by \"SensorName\"";
    $result_set=pg_query($sql_query);
	 if(pg_num_rows($result_set)>0)
    {
        while($row=pg_fetch_row($result_set))
        {
	?>
			<option value='<?php echo "$row[0]"?>' <?php if(isset($data_row[130])){if($data_row[130]==$row[0]) echo 'selected';} ?>><?php echo "$row[0]"?></option>
		<?php 
	}}
		?>
			</select>
			</td>
			<td>
			<select  class='form-control' name="sensortype14" onchange="changedisable2('14',this)">
			  			  <option  disabled  selected>Select your option</option>
<option  value="Unselect">Unselect</option>
		<option  value="Virtual" <?php if(isset($data_row[131])){if($data_row[131]=='Virtual') echo 'selected';} ?>> Virtual </option>
			<option value="Real" <?php if(isset($data_row[131])){if($data_row[131]=='Real') echo 'selected';} ?>> Real </option>
			</select>
			</td>
			<td>
						<input type='text' name='shef14' class='form-control' value="<?php if(isset($data_row[132])) echo $data_row[132]; ?>">

			</td>
				<td>
									<input type='text' name='Units14' class='form-control' value="<?php if(isset($data_row[133])) echo $data_row[133]; ?>">

			</td>
			<td>
						<input type='text' name='Interval14' class='form-control' value="<?php if(isset($data_row[134])) echo $data_row[134]; ?>">

			</td>
			<td>
			<select  class='form-control' name="processtype14" disabled="" onchange="changedisable1('14',this)">
						  <option  disabled  selected>Select your option</option>
<option  value="Unselect">Unselect</option>
			 <option  value="Linear" <?php if(isset($data_row[135])){if($data_row[135]=='Linear') echo 'selected';} ?>> Linear </option>
			<option value="Rating" <?php if(isset($data_row[135])){if($data_row[135]=='Rating') echo 'selected';} ?>> Rating </option>
			<option value="Expression" <?php if(isset($data_row[135])){if($data_row[135]=='Expression') echo 'selected';} ?>> Expression </option>
			</select>
			</td>
			<td>
						<input type='text' name='Multiplier14' disabled="" class='form-control' value="<?php if(isset($data_row[136])) echo $data_row[136]; ?>">

			</td>
			<td>
						<input type='text' name='Adder14' disabled="" class='form-control' value="<?php if(isset($data_row[137])) echo $data_row[137]; ?>">

			</td>
						<td>
			<select  class='form-control' name="sensorfile14" disabled="" onchange="unSelect('sensorfile14')">
			  <option disabled selected>Select your option</option>
			  			  <option  value="Unselect">Unselect</option>
			   <?php 
			    $stn_table=str_replace(" ", "_", $_POST['Station_Full_Name']);
			   $sql_query="SELECT distinct \"FileName\" FROM $stn_table";
    $result_set=pg_query($sql_query);
	 if(pg_num_rows($result_set)>0)
    {
        while($row=pg_fetch_row($result_set))
        {
	?>
			<option value='<?php echo "$row[0]"?>' <?php if(isset($data_row[138])){if($data_row[138]==$row[0]) echo 'selected';} ?>><?php echo "$row[0]"?></option>
		<?php 
	}}
		?>
			</select>
			</td>
				<td>
				<input type='text' name='expression14' disabled="" class='form-control' value="<?php if(isset($data_row[139])) echo $data_row[139]; ?>">
			</td>
			</tr>






	<tr>
						<td>
			<select  class='form-control' name="sensor15" onchange="unSelect('sensor15')">
			  <option disabled selected>Select your option</option>
			  			  <option  value="Unselect">Unselect</option>
			   <?php $sql_query="SELECT \"SensorName\" FROM \"tblHydrometSensor\" order by \"SensorName\"";
    $result_set=pg_query($sql_query);
	 if(pg_num_rows($result_set)>0)
    {
        while($row=pg_fetch_row($result_set))
        {
	?>
			<option value='<?php echo "$row[0]"?>' <?php if(isset($data_row[140])){if($data_row[140]==$row[0]) echo 'selected';} ?>><?php echo "$row[0]"?></option>
		<?php 
	}}
		?>
			</select>
			</td>
			<td>
			<select  class='form-control' name="sensortype15" onchange="changedisable2('15',this)">
			  			  <option  disabled  selected>Select your option</option>
<option  value="Unselect">Unselect</option>
		<option  value="Virtual" <?php if(isset($data_row[141])){if($data_row[141]=='Virtual') echo 'selected';} ?>> Virtual </option>
			<option value="Real" <?php if(isset($data_row[141])){if($data_row[141]=='Real') echo 'selected';} ?>> Real </option>
			</select>
			</td>
			<td>
						<input type='text' name='shef15' class='form-control' value="<?php if(isset($data_row[142])) echo $data_row[142]; ?>">

			</td>
				<td>
									<input type='text' name='Units15' class='form-control' value="<?php if(isset($data_row[143])) echo $data_row[143]; ?>">

			</td>
			<td>
						<input type='text' name='Interval15' class='form-control' value="<?php if(isset($data_row[144])) echo $data_row[144]; ?>">

			</td>
			<td>
			<select  class='form-control' name="processtype15" disabled="" onchange="changedisable1('15',this)">
						  <option  disabled  selected>Select your option</option>
<option  value="Unselect">Unselect</option>
			 <option  value="Linear" <?php if(isset($data_row[145])){if($data_row[145]=='Linear') echo 'selected';} ?>> Linear </option>
			<option value="Rating" <?php if(isset($data_row[145])){if($data_row[145]=='Rating') echo 'selected';} ?>> Rating </option>
			<option value="Expression" <?php if(isset($data_row[145])){if($data_row[145]=='Expression') echo 'selected';} ?>> Expression </option>
			</select>
			</td>
			<td>
						<input type='text' name='Multiplier15' disabled="" class='form-control' value="<?php if(isset($data_row[146])) echo $data_row[146]; ?>">

			</td>
			<td>
						<input type='text' name='Adder15' disabled="" class='form-control' value="<?php if(isset($data_row[147])) echo $data_row[147]; ?>">

			</td>
						<td>
			<select  class='form-control' name="sensorfile15" disabled="" onchange="unSelect('sensorfile15')">
			  <option disabled selected>Select your option</option>
			  			  <option  value="Unselect">Unselect</option>
			   <?php 
			    $stn_table=str_replace(" ", "_", $_POST['Station_Full_Name']);
			   $sql_query="SELECT distinct \"FileName\" FROM $stn_table";
    $result_set=pg_query($sql_query);
	 if(pg_num_rows($result_set)>0)
    {
        while($row=pg_fetch_row($result_set))
        {
	?>
			<option value='<?php echo "$row[0]"?>' <?php if(isset($data_row[148])){if($data_row[148]==$row[0]) echo 'selected';} ?>><?php echo "$row[0]"?></option>
		<?php 
	}}
		?>
			</select>
			</td>
				<td>
				<input type='text' name='expression15' disabled="" class='form-control' value="<?php if(isset($data_row[149])) echo $data_row[149]; ?>">
			</td>
			</tr>


			</table>
			
			
			
			</br>
		

			
   
    <input type="button" name="previous" class="btn btn-default" onclick=" window.history.back();" value="Previous">
    <button type="submit" name="next" onclick="stntype()" class="btn btn-success">Finish</button> 
<button type="button" name="cancel" class="btn btn-danger" onclick="window.location.href='\\HydrometV2\\stations.php#stationtypes'">Cancel</button>
</form>
</center>
    </div>
</div>

	<?php
	echo "<script>
		for (var i = 1; i <= 10; i++) {

	var e=document.getElementsByName('processtype'+i)[0];
var e2=document.getElementsByName('sensortype'+i)[0];
	var processtype=e.options[e.selectedIndex].value;
var SensorType=e2.options[e2.selectedIndex].value;
if (processtype=='Rating') 
{
document.getElementsByName('Multiplier'+i)[0].disabled=true;
document.getElementsByName('Adder'+i)[0].disabled=true;
document.getElementsByName('sensorfile'+i)[0].disabled=false;
document.getElementsByName('expression'+i)[0].disabled=true;

}
	if (processtype=='Linear')
	 {
document.getElementsByName('Multiplier'+i)[0].disabled=false;
document.getElementsByName('Adder'+i)[0].disabled=false;
document.getElementsByName('expression'+i)[0].disabled=true;

document.getElementsByName('sensorfile'+i)[0].disabled=true;

	 }
	 if (processtype=='Expression') 
	 {
document.getElementsByName('Multiplier'+i)[0].disabled=true;
document.getElementsByName('Adder'+i)[0].disabled=true;
document.getElementsByName('expression'+i)[0].disabled=false;
document.getElementsByName('sensorfile'+i)[0].disabled=true;
	 }
	if (SensorType=='Virtual') 
{ 
document.getElementsByName('processtype'+i)[0].disabled=false;	


}
	if (SensorType=='Real')
	 {
	 	document.getElementsByName('processtype'+i)[0].disabled=true;


	 }
	}

	</script>";
	?>