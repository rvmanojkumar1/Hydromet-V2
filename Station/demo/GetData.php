
	<?php
								include("includes/link.php");
							?>

							<?php
								include("includes/adminheader.php");
							?>
<?php
include_once 'database.php';
error_reporting(E_ERROR | E_PARSE);

?>

<!DOCTYPE html>
<html> 
<head>
<script src="js/jquery-1.8.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>	
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
	
	  window.location.href='NewAlarmStep2.php?select1='+dayVal;
       
    }
	  function GoBack()
    {
     history.go(-1);
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
                                Select Station
                            </center>
                        </div>
                        <div class="panel-body">
                             <?php

if(isset($_GET['SearchStation1']))
{
       
  //  $query = $_REQUEST['SearchStation'];
    $sql_query= "select  \"StationTypeName\",\"StationField\" from \"DefineStations\"";
     $result_set=pg_query($sql_query);
     $row_count=pg_num_rows($result_set);
     $row_user=pg_fetch_array($result_set);
     if(pg_num_rows($result_set)>0)
     {
         $data=trim($_GET['SearchStation1']);
      
      // $data="s";
         $dataU=strtoupper($data);
        
         $dataL=strtolower($data);
         echo $data;
           $Result=array();
        $re=array();
          $z=0;
      while($row_user=pg_fetch_array($result_set))
      {
         try
		 {
        $sql_q1="select \"Station_Full_Name\",\"Station_Shef_Code\" from \"" . str_replace(' ','_', $row_user['StationTypeName']) ."\" where \"" . str_replace(' ','_', $row_user['StationField']) ."\" like '%".$data."%' or \"" . str_replace(' ','_', $row_user['StationField']) . "\" like '%" . $dataU . "%' or \"" .  str_replace(' ','_', $row_user['StationField']) ."\" like '%" . $dataL . "%' ";
        $resultQ1=pg_query($sql_q1);
        $np=""; 
      
    
                  while ($temp=pg_fetch_array($resultQ1))
                   {
               
               $np=""; 
             // foreach ($temp as $value) {
                   // $np .=$value." "; 
				   $np.=$temp[0]." | ".$temp[1];

                           
          //  }
                $re[$z]=$np;
 
                   $z++;
 
                  }

		 }
		 catch(Exception $ex)
		 {
		 }
     
     
      }
        $Result= array_unique($re);
     ?>
     <div class="form-group">
                        <select id="idStn" class="form-control" multiple="" onchange="OnUserSelect()">
                           <option value="" disabled selected>Please Select </option>
                           <?php 
 foreach ($Result as $val1) {
                        
?>
     
<option value='<?php echo $val1?>'> <?php echo $val1?> </option>
<?php

    }

    ?>
    </select>
  </div> 
   <?php

    }else
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
				 <div align="center">
                  <center>
                    <input type="button" class="btn btn-default" value="Close" onclick="GoBack()"> </button>
                  </center>

                </div>
            </div>
    </div>
        </div>
       
        </form>
</body>
</html>
