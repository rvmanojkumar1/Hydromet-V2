<?php

$SENSORS=explode(";",$_GET["sensors"]);
include_once "database.php"; 



  

$data=''; 
if (isset($_GET["stations"])) {
 $data=trim($_GET["stations"]);
}
$stn_type='';
if (isset($_GET["stn_type"])) {
 $stn_type=trim($_GET["stn_type"]);
}


   $stn_name='';
    
$datatemp=explode(";",  $data);
$result=array();
    for ($i=0; $i <count($datatemp) ; $i++) { 
 
         $data1=$datatemp[$i];
         $dataU=strtoupper($data1);        
         $dataL=strtolower($data1);

         $sql_query="select \"Station_Full_Name\" from \"$stn_type\" where \"Station_Shef_Code\"='$data1' or \"Station_Shef_Code\" = '$dataU' or \"Station_Shef_Code\"='$dataL' or \"Station_Full_Name\"='$data1' or \"Station_Full_Name\"='$dataU' or \"Station_Full_Name\"='$dataL'";
         $result_set=pg_query($sql_query);
                       if(pg_num_rows($result_set)>0) 
                       {
                       
while ($data1=pg_fetch_row($result_set)) 
 {
  $stn_name=$data1[0];
for ($x=0; $x <count($SENSORS) ; $x++) { 

$sql_query1="SELECT \"SHEF\" FROM \"SensorValues\" where \"StationFullName\"='$stn_name' and \"Sensor\"='$SENSORS[$x]' order by \"Sensor\"";


 
  $result_set1=pg_query($sql_query1);

  if(pg_num_rows($result_set1)>0)
  {
        while($row=pg_fetch_row($result_set1))
    {

$result[]=$row[0]."-".$datatemp[$i];

    }
}

}



 }
}
  }
     // $result=array_unique($result,SORT_REGULAR);

  echo json_encode($result);
    ?>
      

