<?php

include("includes/link.php");
								include("includes/header.php");
								include_once 'database.php';
								include_once 'includes/editCompany.php';
								session_start();
								$companies=$_SESSION["company"];
?>

<!DOCTYPE html>
<html> 
<head>
<script src="js/jquery-1.8.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script> 
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title></title>
  <meta charset="utf-8" />
  <script type="text/javascript">

 function GetSelectedTextValue(idStn) {
       // var selectedText = idStn.options[idStn.selectedIndex].innerHTML;
        var selectedValue = idStn.value;


   
}



  function GetData()
    {
    var stn1 = document.getElementById("Sname").value; 

if (stn1=="") {
alert('Please Search and Select Station!');
}
 else if(document.getElementById("Sname").value.trim()=="")
 {
  alert('Please Search and Select Station!');
 }
  else{
         window.location.href='GetDataSingleGraphMultiSensor.php?Sname='+stn1;
         }
     }



       </script>
</head>
<body>

  

   <div class="container">
        <div class="jumbotron">
            <div class="container">
                <div class="panel-group">

                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <center>
                                Select Station Name
                            </center>
                        </div>
                        <div class="panel-body">

<center>
             
<table style="width: 50%;">
  <tr>
    <td>
      
    
                        <input placeholder="Search Station" type="text" id="Sname" name="StationName" class="form-control" required  value=' <?php 
if(isset($_GET['Sname']))
{

  echo $_GET['Sname'];
}

  ?>'> </td>
  <td style="margin-left: 5px;">
 <input type="button" name="Search" value="Search" class="btn btn-sm btn-info"  onclick="GetData()">
 </td>
  </tr>
</table>

</center>

                             <?php

if(isset($_GET['Sname']))
{ 
            $data=trim($_GET['Sname']);
         $dataU=strtoupper($data);        
         $dataL=strtolower($data);
     
 

     $row_count=pg_num_rows($result_set);
    $row_user=pg_fetch_array($result_set);
    echo $row_user['StationName'];
    

     ?>
<div>
<form method="post" action="SingleGraphMultiSensor.php">
  <table align="center" class="table" style="width:70%">
    <tr>
    
 
     <th style="background-color:#539CCC;color:white;">Select</th>
    <th style="background-color:#539CCC;color:white;">Station Name | Station Shef Code</th>
  
    </tr>
    <?php
$username=trim($_SESSION['username']);

$result=pg_query("select \"organization\" from \"tblloginandregister\" where \"Username\"='$username'");
 $row=pg_fetch_array($result);
$company=$row[0];

 $result_stn=pg_query("select \"StationType\" from \"tblStationType\"");
 if(pg_num_rows($result_stn)>0)
 {
 while($row_user=pg_fetch_array($result_stn))
 {
	//$sql_query= "select \"StationFullName\" from \"tblStation\" where \"StationName\" like '%" .$data."%' or \"StationName\" like '%".$dataU."%' or \"StationName\" like '%".$dataL."%' ";
	if($companies=='Hydromet'){
	$sql_query="select \"StationFullName\",\"StationShefCode\" from \"tblStationLocation\" where (\"StationShefCode\" like '%".$data."%' or \"StationShefCode\" like '%" . $dataU . "%' or \"StationShefCode\" like '%" . $dataL . "%' or \"StationFullName\" like '%".$data."%' or \"StationFullName\" like '%" . $dataU . "%' or \"StationFullName\" like '%" . $dataL . "%')";
    }else{
	$sql_query="select \"Station_Full_Name\",\"Station_Shef_Code\" from \"" . str_replace(' ','_', $row_user['StationType']) ."\" join \"tblCompany2Station\" on \"Station_Full_Name\"= \"Station\" where (\"Station_Shef_Code\" like '%".$data."%' or \"Station_Shef_Code\" like '%" . $dataU . "%' or \"Station_Shef_Code\" like '%" . $dataL . "%' or \"Station_Full_Name\" like '%".$data."%' or \"Station_Full_Name\" like '%" . $dataU . "%' or \"Station_Full_Name\" like '%" . $dataL . "%') and  \"Company\"='$company'";
	}
	
	//$sqlquery="select s.\"StationShefCode\",c.\"StationFullName\" from \"tblStationLocation\" s,\"sensorValues\" c where (s.\"StationShefCode\" or c.\"StationFullName\"=.\"StationFullName\") and (\"StationShefCode\" like '%".$data."%' or \"StationShefCode\" like '%" . $dataU . "%' or \"StationShefCode\" like '%" . $dataL . "%' or \"StationFullName\" like '%".$data."%' or \"StationFullName\" like '%" . $dataU . "%' or \"StationFullName\" like '%" . $dataL . "%')";
	 $result_set=pg_query($sql_query);
 }
	 
    if(pg_num_rows($result_set)>0)
    {
        while($row=pg_fetch_row($result_set))
        {
      

              
        ?>
            <tr>
                <td><input type="checkbox" name="chekedstn[]" value="<?php echo $row[1]; ?>"/></td>
            <td><?php echo $row[0]." | ".$row[1]; ?></td>
           
           
           </tr>
        <?php
         
    }}
 }
    else
    {
        ?>
        <tr>
        <td colspan="5">No Data Found !</td>
        </tr>
        <?php
    }
    ?>
    </table>
  <center>  <button type="submit"  class="btn btn-info" id="stn" name="stn">Submit</button></center>
</form>
</div>



  <?php



}
?>

     
                        </div>
                    </div>




                </div>
            </div>
    </div>
        </div>
       
   
</body>
</html>
