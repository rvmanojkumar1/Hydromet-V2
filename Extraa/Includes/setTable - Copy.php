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
   $settings=pg_fetch_array(pg_query("select \"DateFormat\",\"DecimalPlaces\" from \"tblLogo\"")); 
            

    $result_table=  pg_query("SELECT * FROM \"tblAllTables\" where \"TableName\" like '%".$station."_1%' or  \"TableName\" like '%".$station."_2%'");
    if (isset($result_table)) {
     
  while ($tablerows=pg_fetch_array($result_table)) {
$table="'".$tablerows['TableName']."'";

        //$sql_query= "select * from ((select distinct on (t1.\"HydroMetParamsTypeId\") t1.\"HydroMetParamsTypeId\"::text,\"HydroMetShefCode\",('20'||\"Year\"::text ||'-'||\"Month\"::text ||'-'|| \"Day\" ::text ||' '||\"Hour\"::text || ':'|| \"Minute\" ::text || ':'||\"Second\")::timestamp as t,\"Value\" from \"$table\" t1 join \"tblHydroMetParamsType\" t2 on  t1.\"HydroMetParamsTypeId\"= t2.\"HydroMetParamsTypeId\" order by t1.\"HydroMetParamsTypeId\" ,t desc) union (select distinct on (t1.\"HydroMetParamsTypeId\") t1.\"HydroMetParamsTypeId\"||'V'::text,\"HydroMetShefCode\",('20'||\"Year\"::text ||'-'||\"Month\"::text ||'-'|| \"Day\" ::text ||' '||\"Hour\"::text || ':'|| \"Minute\" ::text || ':'||\"Second\")::timestamp as t,\"VirtualValue\" as \"Value\" from \"$table\" t1 join \"tblHydroMetParamsType\" t2 on  t1.\"HydroMetParamsTypeId\"= t2.\"HydroMetParamsTypeId\" where sensortype='Virtual' order by t1.\"HydroMetParamsTypeId\" ,t desc)) x";
		    $sql_query= "select * from ((select distinct on (t1.\"HydroMetParamsTypeId\") t1.\"HydroMetParamsTypeId\"::text,\"HydroMetShefCode\",('20'||\"Year\"::text ||'-'||\"Month\"::text ||'-'|| \"Day\" ::text ||' '||\"Hour\"::text || ':'|| \"Minute\" ::text || ':'||\"Second\")::timestamp as t,\"Value\" from \"$table\" t1 join \"tblHydroMetParamsType\" t2 on  t1.\"HydroMetParamsTypeId\"= t2.\"HydroMetParamsTypeId\" order by t1.\"HydroMetParamsTypeId\" ,t desc) union (select distinct on (t1.\"HydroMetParamsTypeId\") t1.\"HydroMetParamsTypeId\"||'V'::text,\"HydroMetShefCode\",('20'||\"Year\"::text ||'-'||\"Month\"::text ||'-'|| \"Day\" ::text ||' '||\"Hour\"::text || ':'|| \"Minute\" ::text || ':'||\"Second\")::timestamp as t,\"VirtualValue\" as \"Value\" from \"$table\" t1 join \"tblHydroMetParamsType\" t2 on  t1.\"HydroMetParamsTypeId\"= t2.\"HydroMetParamsTypeId\" where sensortype='Virtual' order by t1.\"HydroMetParamsTypeId\" ,t desc)) x";
          }
}
  $result_set2= pg_query($sql_query);  
 // echo "<br><br>$sql_query";  
$stn_name=getStationName(trim($station));
  $html_table="<label>$stn_name</label><br><table class='table-responsive table-hover' style='width:100%;'><thead><tr><th class='pop_th'>Date</th><th class='pop_th'>Sensor</th><th class='pop_th'>Value</th></tr></thead><tbody>";         
if (pg_num_rows($result_set2)>0) 
{
   

while ($rows=pg_fetch_array($result_set2))
 {
      $date = strtotime(trim($rows[2]));
                         $date=date(trim($settings[0]), $date); 
                          $sensor="";//echo number_format(floatval($rows[3]),$settings[1]);
                         if (strpos($rows[0],'V')=== false) 
                         {
                $sensor=getSensorShef($stn_name,$rows[1],'Real');

                        }
                       else
                       {
                        $sensor=getSensorShef($stn_name,$rows[1],'Virtual');

                        }
                        if (trim($sensor)=="") 
                        $sensor=$rows[1];
                     
       $html_table.="<tr><td>$date</td><td>$sensor</td><td>".number_format(floatval($rows[3]),$settings[1])."</td></tr>";            

}
$html_table.="</tbody></table>";
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