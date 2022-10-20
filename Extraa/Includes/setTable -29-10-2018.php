<?php
include_once 'database.php';
$result=pg_query("select \"StationShefCode\",\"CurrentValue\" from \"tblStationLocation\"");

$data=[];
while ($row=pg_fetch_array($result)) {

if($row[1]!=""){
	$tem=table(trim($row[0]));
	$data[]=$tem;
}
}
echo json_encode($data);

  function table($station)
{
  
 

  $sql= pg_query("SELECT * FROM \"station_sensor_type\" ");

  
  if (isset($sql))
  {
  while ($tablerows = pg_fetch_array($sql))
    {
    $table1 = "'" . $tablerows['StationId'] . "'";
    $sensor_id = "'" . $tablerows['HydroMetParamsTypeId'] . "'";
    $sql_query1 = "SELECT \"StationName\" FROM \"tblStation\" where \"StationId\"=$table1 and \"StationName\"='$station' ";

    $result_set3 = pg_query($sql_query1);
    
    if (pg_num_rows($result_set3) > 0)
      {       
       
      while ($rows = pg_fetch_array($result_set3))
        {
        
          $station = $rows['StationName'];
        }
           // $sql_query = "SELECT t1.\"HydroMetParamsName\",s.\"Value\" FROM \"station_sensor_type\" s INNER JOIN \"tblHydroMetParamsType\" t1 on t1.\"HydroMetParamsTypeId\"=s.\"HydroMetParamsTypeId\" where \"StationId\"=$table1 ";

           $sql_query = " SELECT distinct sv.\"Sensor\",sst.\"Value\",sst.\"VirtualValue\",sv.\"SensorType\", sv.\"SensorType\"

FROM 
\"station_sensor_type\" sst,
\"tblHydroMetParamsType\" hpt,
\"SensorValues\" sv,
\"tblStationLocation\" stl,
\"tblStation\" st
where 
sst.\"HydroMetParamsTypeId\" = hpt.\"HydroMetParamsTypeId\" and 
hpt.\"HydroMetShefCode\" = sv.\"SHEF\" and
sst.\"StationId\" = $table1 and
st.\"StationId\" = $table1 and
st.\"StationName\" = stl.\"StationShefCode\" and 
sv.\"StationFullName\" = stl.\"StationFullName\"";




           
           $html_table="<label>$station</label><br><table class='table-responsive table-hover' style='width:100%;'><thead><tr><th class='pop_th'>Sensor</th><th class='pop_th'>Value</th></tr></thead><tbody>";
          $result_sensor = pg_query($sql_query);
     
          if (pg_num_rows($result_sensor) > 0)
          {
            
            while ($rows = pg_fetch_array($result_sensor))
            {


                         $sensor="";
                        if (strpos($rows[4],'V')=== false) 
                        {
                          
                            $sensor=$rows['Value'];
                       }
                      else
                      {
                       
                        $sensor=$rows['VirtualValue'];

                       }
                       if (trim($sensor)=="") 
                       $sensor=$rows['Value'];
            

                $html_table.="<tr><td>".$rows['Sensor']."</td><td>".$sensor."</td></tr>";
             
              
            } 
          } 
          $html_table.="</tbody></table>";
      }
    }
  }
  


return  $html_table;

}
function getSensorShef($stn_name,$sensor,$type)
{

$result=pg_query("SELECT \"Sensor\"  FROM \"SensorValues\" where \"StationFullName\"='$stn_name' and \"SHEF\"='$sensor' and \"SensorType\"='$type'");
$row=pg_fetch_array($result);
$name=$row[0];

return $name;
}

function getStationName($Name)

{
  $stn_name="";
  $stn_types_set=pg_query("select \"StationType\" from \"tblStationType\"");
while ($row_types=pg_fetch_array($stn_types_set)) {
$table=str_replace(" ", "_", $row_types[0]);
 $stn_set= pg_query("select \"Station_Full_Name\" from \"$table\" where  \"Station_Shef_Code\"='$Name'");
 if (pg_num_rows($stn_set)>0) {
   # code...
 $row=pg_fetch_array($stn_set);
$stn_name=$row[0];
 }

}

 return $stn_name;
} 

?>