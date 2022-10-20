<?php
session_start();
include_once 'database.php';
include_once 'editCompany.php';

$company=$_SESSION["company"];

if($company=='Hydromet'){
  $result=pg_query("select \"StationShefCode\",\"CurrentValue\" from \"tblStationLocation\"");
}
else{
  $result=pg_query("select \"StationShefCode\",\"CurrentValue\" from \"tblStationLocation\", \"tblCompany2Station\" where \"StationShefCode\" = \"Station\" and \"Company\" = '$company' order by \"StationShefCode\"");
  
}

//we select "StationShefCode" and "currentValue" from the table "tblStationLocation" and upadate the output into the variable $result

$data=[];
while ($row=pg_fetch_array($result)) {
//while the $result is fetched into the array into the $row the loop continues
if($row[1]!=""){
	$tem=table(trim($row[0]));
	$data[]=$tem;
}
}
echo json_encode($data);

  function table($station)
{
  
  $settings=pg_fetch_array(pg_query("select \"DateFormat\",\"DecimalPlaces\" from \"tblLogo\"")); 
//From the query we selects date format and also the number of decimal places for the value

  $sql= pg_query("SELECT * FROM \"station_sensor_type\" ");
//select all from table "station_sensor_type"
  
  if (isset($sql))
    //if $sql have data
  {
  while ($tablerows = pg_fetch_array($sql))
    //while the $sql is fetched into the array into the $tablerows the loop continues
    {
    $table1 = "'" . $tablerows['StationId'] . "'";
    $sensor_id = "'" . $tablerows['HydroMetParamsTypeId'] . "'";
    $sql_query1 = "SELECT \"StationName\" FROM \"tblStation\" where \"StationId\"=$table1 and \"StationName\"='$station' ";
    //different station names are selected from table "tblStation" matching the conditions like matching stationID and StationName
    $result_set3 = pg_query($sql_query1);
    
    if (pg_num_rows($result_set3) > 0)
      //if the number of rows for the $result_set3 variable are > 0 
      {       
       
      while ($rows = pg_fetch_array($result_set3))
        //while the $result_set3 is fetched into the array into the $rows the loop continues
        {
        
          $station = $rows['StationName'];
        }
         $sql_query_station = "select * from \"tblStationLocation\" where \"StationShefCode\"='$station' ";
           // echo $sql_query_station."<br>" ;

            $result_set_station = pg_query($sql_query_station);

      if (pg_num_rows($result_set_station) > 0)
        //if the number of rows for the $result_set_station variable are > 0 
      {       
       
      while ($rows = pg_fetch_array($result_set_station))
        //while the $result_set_station is fetched into the array into the $rows the loop continues
        {
        
          $station = $rows['StationFullName'];
           // echo $station."<br>" ;
        }
      }
           // $sql_query = "SELECT t1.\"HydroMetParamsName\",s.\"Value\" FROM \"station_sensor_type\" s INNER JOIN \"tblHydroMetParamsType\" t1 on t1.\"HydroMetParamsTypeId\"=s.\"HydroMetParamsTypeId\" where \"StationId\"=$table1 ";

//In the following the query we select the time stamp from the various tables and with a condition given below

           $sql_query = " SELECT distinct sv.\"Sensor\",sst.\"Value\",sst.\"VirtualValue\",sv.\"SensorType\"
           ,sv.\"Units\",('20'||\"Year\"::text ||'-'||\"Month\"::text ||'-'|| \"Day\" ::text ||' '||\"Hour\"::text || ':'|| \"Minute\" ::text || ':'||\"Second\")::timestamp as t

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




           
           $html_table="<label>$station</label><br><table class='table-responsive table-hover' style='width:100%;'><thead><tr><th class='pop_th'>Date</th><th class='pop_th'>Sensor</th><th class='pop_th'>Value</th></tr></thead><tbody>";
          $result_sensor = pg_query($sql_query);
     
          if (pg_num_rows($result_sensor) > 0)
            //if the number of rows for the $result_sensor variable are > 0
          {
            
            while ($rows = pg_fetch_array($result_sensor))
              //while the $result_sensor is fetched into the array into the $rows the loop continues
            {


                     $date =strtotime(trim($rows[5]));

                        

                        $date=date(trim($settings[0]),$date);

                       
                        

                         $sensor="";
                        if (strpos($rows[3],'V')=== false) 
                        {
                          
                            $sensor=number_format(floatval($rows['Value']),2);
                       }
                      else
                      {
                       
                        $sensor=number_format(floatval($rows['VirtualValue']),2);
                        // $rows['VirtualValue'];

                       }
                       if (trim($sensor)=="") 
                       $sensor=number_format(floatval($rows['Value']),2);
            
                     if($rows['Units']!=""){
                $html_table.="<tr><td>".$date."</td><td>".$rows['Sensor']." "."(".$rows['Units'].")"."</td><td>".$sensor."</td></tr>";
              }
              else{
                $html_table.="<tr><td>".$date."</td><td>".$rows['Sensor']."</td><td>".$sensor."</td></tr>";
              }

             
              
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
//sensor are selected from the table "SensorValues" with a condition where the column stationfullName = selected station name and Shef = sensore code and sensortype = type and are set to variable "result"

$row=pg_fetch_array($result);
//In the row data is set in the form of array by fetching "result" data as array

$name=$row[0];

return $name;
//return $name data
}

function getStationName($Name)
//function is called to update the station name of the $name

{
  $stn_name="";
  $stn_types_set=pg_query("select \"StationType\" from \"tblStationType\"");
  //From the query we select StationType form the table "tblStationType"
while ($row_types=pg_fetch_array($stn_types_set)) {
  //while the $stn_types_set is fetched into the array into the $row_types the loop continues

$table=str_replace(" ", "_", $row_types[0]);
 $stn_set= pg_query("select \"Station_Full_Name\" from \"$table\" where  \"Station_Shef_Code\"='$Name'");
 //All the stationFullName is selected from the table of different StationTypes and are sent to variable $stn_set
 if (pg_num_rows($stn_set)>0) {
   # code...
 $row=pg_fetch_array($stn_set);
$stn_name=$row[0];
 }

}

 return $stn_name;
 //returns $stn_name
} 

?>