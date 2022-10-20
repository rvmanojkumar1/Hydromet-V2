	<?php
								include("includes/link.php");
							?>

							<?php
								include("includes/adminheader.php");
							?>
							

<?php
include_once 'database.php';

//session_start();

if(isset($_GET['delete_id']))
  //if delete_is is given
{
  $id=$_GET['delete_id'];
    //$sql_query="DELETE FROM \"tblStationType\" WHERE \"StationType\"='$id'";
//  pg_query($sql_query);
    header("Location: $_SERVER[PHP_SELF]");
}
if(isset($_GET['addstation'])=="addstation")
  //if addstation is equal to addstation data
{
    $_SESSION["stntypename"]="";
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
    <script src="../dist/jquery.wizard.js"></script>

  
    <link href="../dist/jquery.wizard.css" rel="stylesheet">

   
    <style type="text/css">
    
      .sidebar-nav {
        padding: 9px 0;
      }

	  [data-wizard-init] {
		margin: auto;
		width: 90%;
	  }
    </style>
	<script type="text/javascript">
var i=1;
	function addmore()
	{
		
		var photo_area_img=document.getElementById('photo_area_img');
    // The data into the variable photo_area_img is set by calling the id photo_area_img

		var photo_area_uploader=document.getElementById('photo_area_uploader');
    // The data into the variable photo_area_uploader is set by calling the id photo_area_uploader

		photo_area_img.innerHTML+="<td style='padding=20px'><img id='image"+i+"' src='noimage.gif' name='image' style='width: 130px;height: 150px'></td>";

		   //   photo_area_uploader.innerHTML+=
		       var td = document.createElement('TD');
		       td.innerHTML="<input type='file' accept='image/*'' name='photos_"+i+"' style='width: 130px;' onchange='preview_image(event)'>";

		   photo_area_uploader.appendChild(td);
		  document.getElementById('numberofphoto').value=i; 
	      i++;
	}
function preview_image(event) 
{

	 var name = event.target.name.split("_");
	
 var reader = new FileReader();

 reader.onload = function()
 {
  var output = document.getElementById("image"+name[1]);
  output.src = reader.result;
 }
 reader.readAsDataURL(event.target.files[0]);
}

function uploadimage(input) 
{
       if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#image0').prop('src', e.target.result);
                };
                //image is uploaded into the source (i.e target folder)
                reader.readAsDataURL(input.files[0]);
                }
//document.getElementById('numberofphoto').value=i; 
}
</script>
    <script type="text/javascript">

function cancel()
{

window.location.href='\\HydrometV2\\stations.php'
//This function is headed to station.php
}

 function stntype()
 {
   // var stntypename=document.getElementById("stntypename").value;
document.form2.submit();
 }

 function setRequired(file)
 {

   var ext = $("#myexcel").val().split('.').pop();
   //from csv file, the data is split by '.'

   if(ext.trim()=="csv")
   //if data is from '.csv'
 {

	var d=document.getElementById('myexcel').value;
  //document data is called by id	myexcel
	
	document.getElementById('id2').innerHTML=d;	
  //here the data called by the id 'id2' from the data in d

   }
   else if(ext.trim() =="xlsx")
    //if data is from '.xlsx'
   { 
   var d=document.getElementById('myexcel').value;	
	  //document data is called by id  myexcel
	
		document.getElementById('id2').innerHTML=d;	
   //here the data called by the id 'id2' from the data in d
    }
   else
   {
	    alert('Wrong file format, file can not be uploaded!');
		document.getElementById('myexcel').value='';
		 return;
   }
     
     if (ext.trim()=="csv"||ext.trim()=="xlsx") {

     	//filelist
     }     

 }
//  var tr = document.createElement('TR');
//		  document.getElementById('fileArea').appendChild(tr);




</script>

<script type="text/javascript">
var i=1;
	 function addmorefiles1() 
   //fucntion is called when addmorefiles()
 {


 var tr = document.createElement('TR');
 //creates element 'tr'
		       tr.innerHTML='<td><Input type="file" style="width:300px" name="myexcel'+i+'" id="myexcel'+i+'"    class="form-control" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" onchange="setRequired(this)"></td>';
           //to table row the table data is inserted from the .csv file

		  document.getElementById('fileArea').appendChild(tr);
      //document is called by id 'fileArea' and is appended to table row

  document.getElementById('numberoffiles').value=i;
  //document is called by id 'numberoffiles' and is appended with value of i



 i++;

 }
 function delete_current_file(filename,stntypename)
 //function is called when a specific file is to be deleted

 {
var xhttp = new XMLHttpRequest();//new Http request is created
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
   
$("#previous_files").load(location.href + " #previous_files");

    }
  };
  xhttp.open("GET","addnew.php?deletefile="+filename+"&stntypename="+stntypename, true);
  xhttp.send();
// window.location.href="addnew.php?deletefile="+filename+"&stntypename="+stntypename;
 }

</script>

</head>
<body>

<br><br>
  <div class="panel panel-primary" style="width:90%;margin: 0 auto;"  >
         <div class="panel-heading" style="background-color:#4A7BDF;color:white"><center>
         <b style="font-size:15px;font-family: arial">Add/Edit Station</b></center></div>
  <div class="panel-body">
    

    <div class="container-fluid">
		<div data-wizard-init>
		  <ul class="steps">
			<li data-step="1">Step-1</li>
			<li data-step="2" class="active">Step-2</li>
			<li data-step="3">Step-3</li>
		

		  </ul>
	</div></div>
			
			<div data-step="2">
	
			  
			  <center>
<form action='addnewfinalstep.php' enctype="multipart/form-data"  method="post" class="myform" name="form2" id="form2">
  <!-- data is posted into addnewfinalstep.php by method POST -->

    <table style="width:100%;" >
<tr>

<?php


if(isset($_GET['stntypename']))
  //if stntypename is set
{
$stntypename=   $_GET['stntypename'];
//is set to variable $stntypename when their is input

$_SESSION["stntypename"]=$stntypename;
       // var selectedText = filedtype.options[filedtype.selectedIndex].innerHTML;
     $i=0;
     $stnrows;
     if (isset($_SESSION['edit_stn_name'])) {
      // if $_SESSION['edit_stn_name'] is set

      $stn=$_SESSION['edit_stn_name'];
      //is set to variable $stn when their is input for the session

      $stnName = preg_replace('/\s+/', '_', $stn);
      //replace symbols and space with '_' and is set to $stnName

     // echo $stnName;
   $table=str_replace(' ', '_',  $stntypename);
   //$table is updated with replacing ' ' with '_' in $stntypename
 $stn_result_rows=  pg_query("select * from \"$table\" where \"Station_Full_Name\"='$stn'");
 //selects everything from table "$table" with a matching condition

 $stnrows=pg_fetch_array($stn_result_rows);
 //$stn_result_rows is fetched into array into the variable $stnrows

 $_SESSION["vartopostforimg"]=$stnrows[str_replace(" ", "_",$row[0])];
 echo $_SESSION["vartopostforimg"];
 
 $temp11=str_replace(" ", "_",  $stn);
if (isset($_GET['deletefile'])) {
  //if deletefile has a input
	$filename=$_GET['deletefile'];
  //$filename is updated with the input data of deletefile

if(isset($temp11))
// if $temp11 is set 
{
	$mytable=strtolower($temp11);
	if (pg_num_rows(pg_query("SELECT relname FROM pg_class WHERE relname = '$mytable'"))>0 ){
    //if number of rows for the query in which we select relname from the table "pg_class"
pg_query("delete  FROM $temp11 where \"FileName\"='$filename'");
//delete from table "$temp11" with matchcing FileName
	}

}

}

 
     }

      
       $sql_query="SELECT \"StationField\",\"FieldType\",\"ComboxValues\",\"Required\" FROM \"DefineStations\" WHERE \"StationTypeName\"='$stntypename'";
       //selects the required feild from the table "DefineStations" with the condition on "StationTypeName"
  $result_set=pg_query($sql_query);
  if(pg_num_rows($result_set)>0)
    //if the number of rows of the result in variable $result_set > 0
  {
    ?>
         <div class="content">
 <div class="alert alert-info" style="font-family:Arial;">
  <b>Fill The Station Details!</b>
</div>
</div>
    <?php
        while($row=pg_fetch_row($result_set))
          //while $result_set is fetched into a array to $row_types
    { 
$stationfiled=$row[0];
$filedtype=$row[1];
$i++;

if ($filedtype==='Multi Line') {
//if $filledtype is 'Multi Line'

?>

<td style='padding:5px'>
<label><?php echo $row[0]; ?></label></td>
<td style='padding:5px'><textarea 
  class='form-control' placeholder='<?php echo "Please Enter ".$row[0]; ?>' value='<?php  if(isset($stnrows[str_replace(" ", "_",$row[0])])){ echo $stnrows[str_replace(" ", "_",$row[0])];} ?>' name='<?php echo str_replace(" ", "_",$row[0]); ?>' <?php  if(isset($row[3])) { if (trim($row[3]==='Yes')) {
   echo 'Required'; }}?> ></textarea></td>
<?php
}
if ($filedtype==='Text')  {

?>
<td style='padding:5px'><label><?php echo $row[0]; ?></label></td><td style='padding:5px'><input type='text' class='form-control' placeholder='<?php echo "Please Enter ".$row[0]; ?>' style='height: 26px' name='<?php echo str_replace(" ", "_",$row[0]); ?>' value='<?php  if(isset($stnrows[str_replace(" ", "_",$row[0])])){ echo $stnrows[str_replace(" ", "_",$row[0])];} else if((isset($_SESSION["addstationError"])) && $row[0]==="Station Shef Code"){ echo $_SESSION["addstationError"];$_SESSION["addstationError"]="";}?>'<?php if (isset($_SESSION["edit_stn_name"])&&trim($row[0])=="Station Shef Code") echo'readonly '; ?><?php  if(isset($row[3])) { if (trim($row[3]==='Yes')) { echo 'Required'; }}?> /></td>
<?php
}
if($filedtype==='Number')
{
?>

<td style='padding:5px'><label><?php echo $row[0]; ?></label></td><td style='padding:5px'><input type='number' class='form-control'  step="any" title="Only Number!" placeholder='<?php echo "Please Enter ".$row[0]; ?>' style='height: 26px' name='<?php echo str_replace(" ", "_",$row[0]); ?>' value='<?php  if(isset($stnrows[str_replace(" ", "_",$row[0])])){ echo $stnrows[str_replace(" ", "_",$row[0])];} ?>'  <?php  if(isset($row[3])) { if (trim($row[3]==='Yes')) {
   echo 'Required'; }}?> ></td>

<?php
}
if($filedtype==='Single-Select')
{
  
?>
<td style='padding:5px'><label><?php echo $row[0]; ?></label></td><td style='padding:5px'> 
  <select name='<?php echo str_replace(" ", "_",$row[0]); ?>' id='<?php echo str_replace(" ", "_",$row[0]); ?>' class="dropdown form-control" onchange="GetSelectedTextValue(this)"  <?php  if(isset($row[3])) { if (trim($row[3]==='Yes')) {
   echo 'Required'; }}?> >
     <option value="" disabled selected>Select your option</option>
     
<?php
$temp=$row[2];

$values=explode(",", $temp);
//$values are being updated by splitting the $temp with ','

for($i=0;$i<count($values);$i++)
{

?>
<option value="<?php echo $values[$i]; ?>" <?php if(isset($stnrows[str_replace(" ", "_",$row[0])])){ if($stnrows[str_replace(" ", "_",$row[0])]==$values[$i]) echo 'selected'; }?>><?php echo $values[$i]; ?></option>

<?php
}
?>
</select>
</td>
<?php

}
if ($i==3) {
?>
</tr><tr>
<?php
$i=0;
}
 }
  ?>
</tr><tr> <td><input type="hidden" name="stntypetable" value='<?php echo $stntypename;?>'></td>
  </tr> </table><br><br>

  <?php
}
$photos;
if(isset($stnrows['Images']))
{

}
?>

<div>
<table>

<tr>
<td>
<label>Import Rate File :</label>&nbsp;&nbsp;&nbsp;
</td>
<td>
	<table id="fileArea" style="width: 400px">	
	<tr><td style="padding: 5px"><b>Choose File from System</b></td><td style="padding: 5px"><b>Add more</b></td></tr>
	<tr><td>	
<Input type="file" style="width:300px" name="myexcel0" id="myexcel0"     class="form-control" accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" onchange="setRequired(this)">
<!-- Accepts .csv file and also different format of the uploading file is set -->
</td>
<td>
<input type="hidden" name="numberoffiles" id="numberoffiles" value="0">

<img  name="morefiles" src="images/morefiles.png" style="width:20px;height:20px;margin-left: 25px" title="More.." onclick="addmorefiles1()"/>
</td>
</tr>
</table>	
<p id='id2'></p>

</td>

</tr>
<tr>
<td>
<strong> Previous :</strong>
</td>
<td>
<p >
<div id='previous_files'>

<?php
$resultset1;

if(isset($temp11))
{
	$mytable=strtolower($temp11);
	if (pg_num_rows(pg_query("SELECT relname FROM pg_class WHERE relname = '$mytable'"))>0 ){

$resultset1=pg_query("SELECT distinct \"FileName\"  FROM $temp11");

	}

}
if(isset($resultset1))
{
if(pg_num_rows($resultset1)>0)
{
		echo "<table style='width:400px' id='filelist' ><tr><td><b>File Name</b></td><td><b>Delete</b></td></tr>";

	 while($row=pg_fetch_row($resultset1))
    {
  ?><tr><td><?php echo $row[0];?></td><td style="padding-left: 10px;padding-bottom: 5px"><a data-toggle="tooltip" title="Delete!" href="javascript:delete_current_file('<?php echo $row[0]; ?>','<?php echo "$stntypename";?>')"><img src="b_drop.png" align="DELETE" /></a></td></tr>
  <?php
    }
   	echo "</table>";

}

}
else 
{
	 echo 'Data not Found.';
}

?> </div></p>

</td>
</tr>
</table>
</div>
<div class="row" style="width:98%">
<table style="float:left;">
<tr>
<td>
<label style="float:left;"><b>Upload Image </b></label>
<label style="float:left;font-weight:3;"> (Max Size 10Mb)</label></td>
</tr>
</table>
</div>
<br>
<div class="row">
<div id="photo_area" style="overflow-x: scroll;overflow-y: scroll;width:98%">


<table style="float:left">	
<tr id="photo_area_img">
<td>
<img src="<?php if(isset($photos[0])){if($photos[0]!=''){echo uploaddir.$photos[0];}else { echo 'noimage.gif';}}else { echo 'noimage.gif';}?>" name="image"   id="image0"  style="width: 130px;height: 150px">
</td>
	</tr>
<tr id="photo_area_uploader">
<td>
  <input type="hidden" name="MAX_FILE_SIZE" value="10000000">
	<input type="file" name="stationImageinput"  accept="image/*" style="width: 150px;" onchange='uploadimage(this)'>
	<!--<input name="stationImageinput" type="file" id="stationImage" onchange='uploadimage(this)'/>-->
	 
	</td>
	</tr>

	</table>
<input type="hidden" name="numberofphoto" id="numberofphoto" value="1">

</div></div>
<br>
<center>
<table style="width:21%;margin-left:3%">
<tr>
<td colspan='4' style="padding-left:15%"> 
<label> 

Importable Data Type

</label>

</td>
</tr>
<tr>
<td> <input type="checkbox" name="SHEFF" VALUE="SHEFF" <?php if(isset($stnrows['SHEFF'])){if($stnrows['SHEFF']=='true') echo 'checked';}?>> SHEF   </input></td>
<td> <input type="checkbox" name="CSV" VALUE="CSV" <?php if(isset($stnrows['CSV'])){if($stnrows['CSV']=='true') echo 'checked';}?>> CSV   </input></td>
<td> <input type="checkbox" name="XML" VALUE="XML" <?php if(isset($stnrows['XML'])){if($stnrows['XML']=='true') echo 'checked';}?>> XML   </input></td>
</tr>
</table>
</center>
<br>
<br>
<?php
}
if(isset($stnrows['Images']))
{
for($i=1;$i<count($photos)-1;$i++)
{
	
		?>
	<script>
var i=1;

		var photo_area_img=document.getElementById('photo_area_img');
		var photo_area_uploader=document.getElementById('photo_area_uploader');
		photo_area_img.innerHTML+="<td style='padding=20px'><img id='image"+i+"' src='<?php if(isset($photos[$i]))echo uploaddir.$photos[$i]?>' name='image' style='width: 150px;height: 200px'></td>";

		       var td = document.createElement('TD');
		       td.innerHTML="<input type='file' accept='image/*'' name='photos_"+i+"' style='width: 150px;' onchange='preview_image(event)'>";

		   photo_area_uploader.appendChild(td);
		  document.getElementById('numberofphoto').value=i; 
	      i++;
	</script>
	  <?php
}
}

?>
<button type="button" name="previous" onclick=" window.history.back();" class="btn btn-default" >Previous</button>
<button type="submit" name="next"  class="btn btn-primary">Next</button> 
<button type="button" name="cancel" class="btn btn-danger" onclick="window.location.href='\\HydrometV2\\stations.php#stationtypes'">Cancel</button>
</form>

</center>
			</div>
			
    </div>
	

  


</body>
</html>
