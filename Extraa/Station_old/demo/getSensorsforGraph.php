     <?php 
    include_once 'database.php';
     $stn_name='';
     $data=trim($_GET['station']);
         $dataU=strtoupper($data);        
         $dataL=strtolower($data);
$result_stn=pg_query("select \"StationType\" from \"tblStationType\"");
 if(pg_num_rows($result_stn)>0)
 {
 while($row_user=pg_fetch_array($result_stn))
 {
   
             $sql_query="select \"Station_Full_Name\" from \"" . str_replace(' ','_', $row_user['StationType']) ."\" where \"Station_Shef_Code\"='$data' or \"Station_Shef_Code\" = '$dataU' or \"Station_Shef_Code\"='$dataL' or \"Station_Full_Name\"='$data' or \"Station_Full_Name\"='$dataU' or \"Station_Full_Name\"='$dataL'";

   $result_set=pg_query($sql_query);
                       if(pg_num_rows($result_set)>0) 
                       {
                       
      while ($data1=pg_fetch_row($result_set)) 
 {
  $stn_name=$data1[0];
 }
}
}
}

            $sql_query1="SELECT \"Sensor\" FROM \"SensorValues\" where \"StationFullName\"='$stn_name' order by \"Sensor\"";


  $result_set1=pg_query($sql_query1);
$output=array();
  if(pg_num_rows($result_set1)>0)
  {
        while($row=pg_fetch_row($result_set1))
    {


$output[]=$row[0];

    }
}

echo json_encode($output);
?>