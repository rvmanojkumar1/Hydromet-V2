<?php   
include_once '../../database.php';
$stations =$_POST['stations'];
$sensors_list =explode(",", $_POST['sensors']);
$capacity_list=explode(",",$_POST['capacity']);
$time_list=explode(",",$_POST['time']);
            $FY = trim(date('Y'));
            $FY = substr($FY,-2); 
            $DateTime = new DateTime();
              $settings=pg_fetch_array(pg_query("select \"DateFormat\",\"DecimalPlaces\" from \"tblLogo\""));
   $setting=$settings[1];          


$stations=explode("#", $stations);

$n=0;
$time_temp="";
 $list=array();
 $c=0;
 for ($i=0; $i<1 ; $i++)
 { 
 $sensors=explode("#", $sensors_list[$i]);

for ($j=0; $j <count($sensors)-1 ; $j++) { 

if (strpos($sensors[$j], "Change")||strpos($sensors[$j], "change")){
  $c++;
}
}
}
for ($i=0; $i <count($stations) ; $i++)
 { 
$table="'tblStation_$stations[$i]_$FY'";

 $sensors=explode("#", $sensors_list[$i]);

$capacity=explode("#", $capacity_list[$i]);
$time=explode("#", $time_list[$i]);

$k=0;
for ($j=0; $j <count($sensors)-1 ; $j++) { 

  if (strpos($sensors[$j], "Change")||strpos($sensors[$j], "change")) 
  {
    
    $change=str_replace("Change", "", $sensors[$j]);
    $sensor_id=getSensorId($stations[$i],$change);


     // $DateTime = new DateTime();
     //  $DateTime->modify("-$time[$k]");

     //   $FY = $DateTime->format("Y");
     //          $FY = substr($FY,-2);

     //      $FM =  $DateTime->format("m");
     //          $FD = $DateTime->format("d");
     //          $m = $DateTime->format("i");
     //          $h = $DateTime->format("H");
    if ($time_temp!=="")
    {
      if($time_temp!==$sensors[$j]) 
        $n++;
    }
    $time_temp=$sensors[$j];

    $sensor_type=getSensorType($stations[$i],$change);
    $sql="";
    if (trim($sensor_type)=="Real") 
    {


      $sql="select  ('20'||\"Year\"::text ||'-'||\"Month\"::text ||'-'|| \"Day\" ::text ||' '||\"Hour\"::text || ':' || \"Minute\" ::text || ':' ||\"Second\")::timestamp  as t,\"Value\" from \"$table\" where \"HydroMetParamsTypeId\"=$sensor_id order by t desc limit 1";

    }
    else{

      $sql="select  ('20'||\"Year\"::text ||'-'||\"Month\"::text ||'-'|| \"Day\" ::text ||' '||\"Hour\"::text || ':' || \"Minute\" ::text || ':' ||\"Second\")::timestamp  as t,\"VirtualValue\" from \"$table\" where \"HydroMetParamsTypeId\"=$sensor_id order by t desc limit 1";

    }


    $result=pg_query($sql);
    $result=pg_fetch_array($result);
    $change_val=$result[1];
    
    $d=$result[0];
    $DateTime = new DateTime($d);
    $DateTime->modify("-$time[$k]");
    $FY = $DateTime->format("Y");
    $FY = substr($FY,-2);
    //echo '<script>console.log("'$time_temp'"); </script>';
    $FM =  $DateTime->format("m");
    $FD = $DateTime->format("d");
    $m = $DateTime->format("i");
    $h = $DateTime->format("H");
    $k++;

    $sql="";
    if (trim($sensor_type)=="Real") 
    {
      $sql="select  ('2020'||\"Year\"::text ||'-'||\"Month\"::text ||'-'|| \"Day\" ::text ||' '||\"Hour\"::text || ':' || \"Minute\" ::text || ':' ||\"Second\")::timestamp  as t,\"Value\" from \"$table\" where \"HydroMetParamsTypeId\"=$sensor_id and ('20'||\"Year\"::text ||'-'|| \"Month\"::text ||'-'|| \"Day\" ::text ||' '|| \"Hour\"::text || ':' || \"Minute\" ::text || ':' || \"Second\")::timestamp <= ('20$FY-$FM-$FD $h:$m:0') order by t desc limit 1";
    }
    else{
      $sql="select  ('20'||\"Year\"::text ||'-'||\"Month\"::text ||'-'|| \"Day\" ::text ||' '||\"Hour\"::text || ':' || \"Minute\" ::text || ':' ||\"Second\")::timestamp  as t,\"VirtualValue\" from \"$table\" where \"HydroMetParamsTypeId\"=$sensor_id and ('20'||\"Year\"::text ||'-'|| \"Month\"::text ||'-'|| \"Day\" ::text ||' '|| \"Hour\"::text || ':' || \"Minute\" ::text || ':' || \"Second\")::timestamp <= ('20$FY-$FM-$FD $h:$m:0') order by t desc limit 1";
    }



    //echo("<br><br>$sensors[$j]<br>".$sql);

    $result=pg_query($sql);
    $result=pg_fetch_array($result);
    $current=$result[1];
    $current=$change_val-$current;
    $key= getStationName(trim($stations[$i]));

    if (array_key_exists($key,$list))
    {
    //$list[$key]=$list[$key].",". $current;
    $t=explode(',', $list[$key]);
    $d="";
    if (trim($t[0])==="")
    {
      $date = strtotime(trim($result[0]));
      $date2=date(trim($settings[0]), $date);              
      $d.= $date2;
      for ($p=1; $p <count($t) ; $p++) 
      { 
        $d.=",".$t[$z];

      }
      $list[$key]=$d.",". $current;
    }
    else
    {
      $list[$key]=$list[$key].",". $current;
    }
  }
  else
  {
     $date = strtotime(trim($result[0]));
                           
     $date2= date(trim($settings[0]), $date);

  $list[$key]=$date2.",". $current;
}
}
else if(strpos($sensors[$j], '%'))
{
  $stn= str_replace("%", "",  $sensors[$j]);
    $stn= str_replace("of", "",  $stn);
        $stn= str_replace(")", "",  $stn);

$stn=trim($stn);
$stn=explode("(", $stn);

//echo "<br>$stations[$i],$stn[0]";
$sensor_id=getSensorId($stations[$i],$stn[0]);
$sensor_type=getSensorType($stations[$i],$stn[0]);
$sql="";
if (trim($sensor_type)=="Real") {

$sql="select  ('20'||\"Year\"::text ||'-'||\"Month\"::text ||'-'|| \"Day\" ::text ||' '||\"Hour\"::text || ':' || \"Minute\" ::text || ':' ||\"Second\")::timestamp  as t,\"Value\" from \"$table\" where \"HydroMetParamsTypeId\"=$sensor_id order by t desc limit 1";
}
else{
$sql="select  ('20'||\"Year\"::text ||'-'||\"Month\"::text ||'-'|| \"Day\" ::text ||' '||\"Hour\"::text || ':' || \"Minute\" ::text || ':' ||\"Second\")::timestamp  as t,\"VirtualValue\" from \"$table\" where \"HydroMetParamsTypeId\"=$sensor_id order by t desc limit 1";}

//echo("<br>$stations[$i],$stn[0]<br><br>".$sql);


 $result=pg_query($sql);
 $result=pg_fetch_array($result);
$capacity_val= getCapacityValue($stn[1],$stations[$i]);
$cal_val=$result[1]*100;
$cal_val=$cal_val/$capacity_val;
$cal_val=number_format($cal_val,$setting,'.','');
//$cal_val=number_format((float)$cal_val, 2, '.', '');
 $key= getStationName(trim($stations[$i]));
if (array_key_exists($key,$list))
{

 $t=explode(',', $list[$key]);
 $d="";
  if (trim($t[0])=="")
   {
    $date = strtotime(trim($result[0]));
          $date2=date(trim($settings[0]), $date);              
   $d.= $date2;
    for ($p=1; $p <count($t) ; $p++) 
    { 
$d.=",".$t[$z];

    }
    $list[$key]=$d.",".$cal_val."%";
  }
  else
  {
$list[$key]=$list[$key].",".$cal_val."%";
}

}
else
{
  $date = strtotime(trim($result[0]));
                         
   $date2= date(trim($settings[0]), $date);

$list[$key]=$date2.",".$cal_val."%";

}
}
else
{
$sensor_id=getSensorId($stations[$i],$sensors[$j]);
$sensor_type=getSensorType($stations[$i],$sensors[$j]);
$sql="";
if (trim($sensor_type)=="Real") {

$sql="select  ('20'||\"Year\"::text ||'-'||\"Month\"::text ||'-'|| \"Day\" ::text ||' '||\"Hour\"::text || ':' || \"Minute\" ::text || ':' ||\"Second\")::timestamp  as t,\"Value\",\"AlarmFlag\" from \"$table\" where \"HydroMetParamsTypeId\"=$sensor_id order by t desc limit 1";
}
else{
$sql="select  ('20'||\"Year\"::text ||'-'||\"Month\"::text ||'-'|| \"Day\" ::text ||' '||\"Hour\"::text || ':' || \"Minute\" ::text || ':' ||\"Second\")::timestamp  as t,\"VirtualValue\",\"AlarmFlag\" from \"$table\" where \"HydroMetParamsTypeId\"=$sensor_id order by t desc limit 1";}
//echo("<br>$stations[$i],$sensors[$j]<br><br>".$sql);

 $result=pg_query($sql);
 $result=pg_fetch_array($result);
 $key= getStationName(trim($stations[$i]));
if (array_key_exists($key,$list))
{
  $t=explode(',', $list[$key]);
 $d="";
  if (trim($t[0])=="")
   {
      $date = strtotime(trim($result[0]));
          $date2=date(trim($settings[0]), $date);              
   $d.= $date2;
    for ($p=1; $p <count($t) ; $p++) 
    { 
$d.=",".$t[$z];

    }
    $list[$key]=$d.",".$result[1];
  }
  else
  {
$list[$key]=$list[$key].",".$result[1];
}
}
else
{
   $date = strtotime(trim($result[0]));
                         
   $date2= date(trim($settings[0]), $date);
    //$date2= date_format($date,trim($settings[0]));
$list[$key]=$date2.",".$result[1];
//echo "<br>$result[0],$result[1]";

}

if (trim($sensor_type)=="Real")
$list[$key]=$list[$key]."#".$result[2];

}

}



for ($j=0; $j <count($capacity)-1; $j++) { 
   $key= getStationName(trim($stations[$i]));
   $value=getCapacityValue($capacity[$j],trim($stations[$i]));

   if (trim($value)=="") {
$value='N/A';   
}
 if (array_key_exists($key,$list))
{
  $list[$key]=$list[$key].",".$value;
}
 else
 {
    $date = strtotime(trim($result[0]));
                         
   $date2= date(trim($settings[0]), $date);
$list[$key]=$date2.",".$value;
}
}

echo json_encode($list);
//echo json_encode("okkkkkkkkkkkkk");

}



function getSensorType($stn_name,$sensor_name)
{
   $sensor_name=trim($sensor_name);
  $stn_name=getStationName(trim($stn_name));
 $shef_set= pg_query("select \"SensorType\" from \"SensorValues\" where \"StationFullName\"='$stn_name' and \"Sensor\"='$sensor_name'");



 $row=pg_fetch_array($shef_set);

return $row[0];
  }
 function getSensorId($stn_name,$sensor_name)
{
  $sensor_name=trim($sensor_name);
  $stn_name=getStationName(trim($stn_name));
 $shef_set= pg_query("select \"SHEF\" from \"SensorValues\" where \"StationFullName\"='$stn_name' and \"Sensor\"='$sensor_name'");



 $row=pg_fetch_array($shef_set);
$Shef=$row[0];
$id_set= pg_query("select \"HydroMetParamsTypeId\" from \"tblHydroMetParamsType\" where \"HydroMetShefCode\"='$Shef'");

 $row=pg_fetch_array($id_set);
return $row[0];
}

function getStationName($shef)
{
  $stn_name="";
  $stn_types_set=pg_query("select \"StationType\" from \"tblStationType\"");
while ($row_types=pg_fetch_array($stn_types_set)) {
$table=str_replace(" ", "_", $row_types[0]);
 $stn_set= pg_query("select \"Station_Full_Name\" from \"$table\" where \"Station_Shef_Code\"='$shef'");
 if (pg_num_rows($stn_set)>0) {
   # code...
 $row=pg_fetch_array($stn_set);
$stn_name=$row[0];
 }

}

 return $stn_name;
}
function getStationTypeName($shef)
{
  $stn_type="";
  $stn_types_set=pg_query("select \"StationType\" from \"tblStationType\"");
while ($row_types=pg_fetch_array($stn_types_set)) {
$table=str_replace(" ", "_", $row_types[0]);
 $stn_set= pg_query("select \"Station_Full_Name\" from \"$table\" where \"Station_Shef_Code\"='$shef'");
 if (pg_num_rows($stn_set)>0) {
 $row=pg_fetch_array($stn_set);
$stn_type=$row_types[0];
 }

}
 return $stn_type;
}

function getCapacityValue($col_name,$stn_shef)
{
  $table=str_replace(" ", "_", trim(getStationTypeName($stn_shef))) ;
    $col_name=getColumnName($table,trim($col_name));
 $col_name=str_replace(" ", "_", trim( $col_name));
  $sql="select \"$col_name\" from  \"$table\" where \"Station_Shef_Code\"='$stn_shef'";
 // echo "<br>".$sql;
  $row= pg_fetch_array(pg_query($sql));

  return $row[0];
}

function getColumnName($stntype,$data)
{
  $stntype=str_replace(" ", "_",trim($stntype));
  $sql="select \"StationField\" from  \"DefineStations\" where \"StationField\" like '%$data%'";
 // echo "<br>".$sql;
  $row= pg_fetch_array(pg_query($sql));

  return $row[0];
}
    ?>