<?php
								include("includes/link.php");
							?>

							<?php
								include("includes/header.php");
							?>
<?php
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
  
    window.location.href='dashboard.php?select='+dayVal;
       
    }
       </script>
</head>
<body>
<br>
<br>
<form name="frmUser" method="post">
  

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
                             <?php

if(isset($_GET['Sname']))
{ 
            $data=trim($_GET['Sname']);
         $dataU=strtoupper($data);        
         $dataL=strtolower($data);
         echo $dataL;      
 
    $sql_query= "select \"StationName\" from \"tblStation\" where \"StationName\" like '%" .$data."%' or \"StationName\" like '%".$dataU."%' or \"StationName\" like '%".$dataL."%' ";
     $result_set=pg_query($sql_query);
     ?>
     <div class="form-group">

 <?php 
                       if(pg_num_rows($result_set)>0) 
                       {
      
?>
                        <select id="idStn" class="form-control" multiple="" onchange="OnUserSelect()">
                           <option value="" disabled selected>Please Select </option>
    <?php                        
      while ($data=pg_fetch_row($result_set)) 
 {
  ?>
<option value='<?php echo $data[0]?>'> <?php echo $data[0]?> </option>
<?php

    }
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
