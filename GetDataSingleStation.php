<?php
include("includes/link.php");
								include("includes/header.php");

include_once 'database.php';


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

function OnUserSelect()
{
	
	var eID = document.getElementById("idStn"); 
	var dayVal = eID.options[eID.selectedIndex].value;
	 var daytxt = eID.options[eID.selectedIndex].text;
	
	  window.location.href='GraphMultiple.php?select1='+dayVal;
       
    }

  function GetData()
    {
    var stn = document.getElementById("Sname").value; 

if (stn=="") {
alert('Please Search and Select Station!');
}
 else if(document.getElementById("Sname").value.trim()=="")
 {
  alert('Please Search and Select Station!');
 }
  else{
         window.location.href='GetDataSingleStation.php?Sname='+stn;
         }
     }

       </script>
</head>
<body>
<form name="frmUser" method="post">
	

	 <div class="container">
        <div class="jumbotron">
            <div class="container">
                <div class="panel-group">

                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <center>
                                Select Station Name | Station Shef Code
                            </center>
                        </div>
                        <div class="panel-body">
                       
                        <div class="form-group "> 
<table style ="width: 50%">
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
 </div>

                             <?php

if(isset($_GET['Sname']))
{ 
            $data=trim($_GET['Sname']);
         $dataU=strtoupper($data);        
         $dataL=strtolower($data);
         
 
   //  $row_count=pg_num_rows($result_set);
    // $row_user=pg_fetch_array($result_set);
    // echo $row_user['StationName'];
    

     ?>
     <div class="form-group">
	 <select id="idStn" style="height: 500px" class="form-control" multiple="" onchange="OnUserSelect()">
                           <option value="" disabled selected>Please Select </option>

 <?php 
  $result_stn=pg_query("select \"StationType\" from \"tblStationType\"");
 if(pg_num_rows($result_stn)>0)
 {
 while($row_user=pg_fetch_array($result_stn))
 {
    // $sql_query= "select \"StationName\" from \"tblStation\" where \"StationName\" like '%" .$data."%' or \"StationName\" like '%".$dataU."%' or \"StationName\" like '%".$dataL."%' ";
             $sql_query="select \"Station_Full_Name\",\"Station_Shef_Code\" from \"" . str_replace(' ','_', $row_user['StationType']) ."\" where \"Station_Shef_Code\" like '%".$data."%' or \"Station_Shef_Code\" like '%" . $dataU . "%' or \"Station_Shef_Code\" like '%" . $dataL . "%' or \"Station_Full_Name\" like '%".$data."%' or \"Station_Full_Name\" like '%" . $dataU . "%' or \"Station_Full_Name\" like '%" . $dataL . "%' ";

	 $result_set=pg_query($sql_query);
                       if(pg_num_rows($result_set)>0) 
                       {

                       
      while ($data1=pg_fetch_row($result_set)) 
 {
  ?>
<option value='<?php echo $data1[1]?>'> <?php echo $data1[0]." | ".$data1[1]?> </option>
<?php

 }}}
?>
</select>
  </div> 
  <?php

}
else
{
  ?>

  <h3> Data Not Found !</h3>
  <?php 
}
}
?>

     
                        </div>
                    </div>




                </div>
            </div>
    </div>
        </div>
       
        </form>
</body>
</html>
