
<script type="text/javascript">
  
var table= document.getElementById('myTable');
var th= table.getElementsByTagName('th');

var stations="";
var tr=table.getElementsByTagName('tr');
for (var i = 1; i < tr.length; i++) {


stations+=tr[i].getElementsByTagName('td')[0].getElementsByTagName('a')[0].innerHTML+",";

}

var sensors="";
var capacity="";
var change_sensor="";
var time="";
for (var j = 2; j < th.length; j++) 
{
  try
  {
  var temp=th[j].getElementsByTagName('a')[0].innerHTML;
var sensor=new Array();
if(temp.toLowerCase().includes('change'))
{
  sensor=temp.split('(');
sensors+=sensor[0]+",";

  time=parseInt(sensor[1]);
  if (sensor[1].replace(/[^a-zA-Z ]/g, "").toLowerCase().trim()=="hr") {
 time+=" hours";
}
else if(sensor[1].replace(/[^a-zA-Z ]/g, "").toLowerCase().trim()=="min")
{
 time+=" minutes";
}
else
{
   time+=" "+sensor[1].replace(/[^a-zA-Z ]/g, "").toLowerCase();

}
}
else if(temp.toLowerCase().includes('%'))
{
sensors+=temp+",";

}
else
{
     sensor=temp.split('(');
sensors+=sensor[0]+",";
}


}catch(ex)
{
 try
  {
  temp=th[j].getElementsByTagName('label')[0].innerHTML;
   sensor=temp.split('(');
capacity+=sensor[0]+",";
}catch(exx)
{

}
}
}

    document.cookie = "stations ="+stations;
    document.cookie = "sensors ="+sensors;
    document.cookie = "capacity ="+capacity;
        document.cookie = "time ="+time;



</script>
<?php   
include_once 'database.php';
$cookie_name = "user";
$cookie_value = "zeeshan";
setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/");

$stations =$_COOKIE['stations'];
$sensors = $_COOKIE['sensors'];
$capacity=$_COOKIE['capacity'];
$time=$_COOKIE['time'];
            $FY = trim(date('Y'));
            $FY = str_replace('20', '',$FY);
            $FM =  trim(date('m'));
            $FD = trim(date('d'));
            $DateTime = new DateTime();
                         $DateTime->modify("-$time");

            $m = $DateTime->format("i");
            $h = $DateTime->format("H");

   //echo $stations."<br>";
$capacity=explode(",", $capacity);
$change_sensor=explode(",", $change_sensor);

$stations=explode(",", $stations);
 //echo $sensors."<br>";
 $sensors=explode(",", $sensors);
 $list=array();
for ($i=0; $i <count($stations)-1 ; $i++)
 { 
$table="'tblStation_$stations[$i]_$FY'";



for ($j=0; $j <count($sensors)-1 ; $j++) { 

if (strpos($sensors[$j], "Change")||strpos($sensors[$j], "change")) {
  $change=str_replace("Change", "", $sensors[$j]);
  $sensor_id=getSensorId($stations[$i],$change);

$sql="select  ('20'||\"Year\"::text ||'-'||\"Month\"::text ||'-'|| \"Day\" ::text ||' '||\"Hour\"::text || ':' || \"Minute\" ::text || ':' ||\"Second\")::timestamp  as t,\"Value\" from \"$table\" where \"HydroMetParamsTypeId\"=$sensor_id and ('20'||\"Year\"::text ||'-'|| \"Month\"::text ||'-'|| \"Day\" ::text ||' '|| \"Hour\"::text || ':' || \"Minute\" ::text || ':' || \"Second\")::timestamp < ('20$FY-$FM-$FD $h:$m:0') order by t desc limit 1";
//echo("<br><br><br>".$sql);

 $result=pg_query($sql);
 $result=pg_fetch_array($result);
 $current=$result[1];
$sql="select  ('20'||\"Year\"::text ||'-'||\"Month\"::text ||'-'|| \"Day\" ::text ||' '||\"Hour\"::text || ':' || \"Minute\" ::text || ':' ||\"Second\")::timestamp  as t,\"Value\" from \"$table\" where \"HydroMetParamsTypeId\"=$sensor_id order by t desc limit 1";
 $result=pg_query($sql);
 $result=pg_fetch_array($result);
$change_val=$result[1];
 $current= $current-$change_val;
 $key= getStationName(trim($stations[$i]));
if (array_key_exists($key,$list))
{
//$list[$key]=$list[$key].",". $current;
$t=explode(',', $list[$key]);
 $d="";
  if (trim($t[0])=="")
   {
   $d.=$result[0];
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
$list[$key]=$result[0].",". $current;
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

$sql="select  ('20'||\"Year\"::text ||'-'||\"Month\"::text ||'-'|| \"Day\" ::text ||' '||\"Hour\"::text || ':' || \"Minute\" ::text || ':' ||\"Second\")::timestamp  as t,\"Value\" from \"$table\" where \"HydroMetParamsTypeId\"=$sensor_id order by t desc limit 1";
//echo("<br>$stations[$i],$stn<br><br>".$sql);

 $result=pg_query($sql);
 $result=pg_fetch_array($result);
$capacity_val= getCapacityValue($stn[1],$stations[$i]);
$cal_val=$result[1]*100;
$cal_val=$cal_val/$capacity_val;
 $key= getStationName(trim($stations[$i]));
if (array_key_exists($key,$list))
{

 $t=explode(',', $list[$key]);
 $d="";
  if (trim($t[0])=="")
   {
   $d.=$result[0];
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
$list[$key]=$result[0].",".$cal_val."%";

}
}
else
{
$sensor_id=getSensorId($stations[$i],$sensors[$j]);

$sql="select  ('20'||\"Year\"::text ||'-'||\"Month\"::text ||'-'|| \"Day\" ::text ||' '||\"Hour\"::text || ':' || \"Minute\" ::text || ':' ||\"Second\")::timestamp  as t,\"Value\" from \"$table\" where \"HydroMetParamsTypeId\"=$sensor_id order by t desc limit 1";
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
   $d.=$result[0];
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
$list[$key]=$result[0].",".$result[1];
//echo "<br>$result[0],$result[1]";

}
}

}



for ($j=0; $j <count($capacity)-1; $j++) { 
   $key= getStationName(trim($stations[$i]));
   $value=getCapacityValue($capacity[$j],trim($stations[$i]));
 //  echo "<br>capacity $value $key";
   if (trim($value)=="") {
$value='N/A';   
}
 if (array_key_exists($key,$list))
{
  $list[$key]=$list[$key].",".$value;
}
 else
 {
$list[$key]=$result[0].",".$value;
}
}




}
//foreach ($list as $key => $value) {
//echo "<br>key : $key value : $value";
//}

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

<script type="text/javascript">
var list=<?php echo json_encode($list); ?>;
var data=new Array();
for(xxx in list)
{

data.push(xxx);
temp=list[xxx].split(',');
for (var i = 0; i < temp.length; i++) {
  
data.push( temp[i]);
  }

}
function check(d)
{
  var c=false;
for (var i = 0; i < data.length; i++) {
if (data[i]==d)
{
c=true;
}
}
return c;
}
var station="";
var z=0;
for (var i = 1; i < tr.length; i++) {

td=tr[i].getElementsByTagName('td');
for (var j = 0; j < td.length; j++) {
try
{
td[j].getElementsByTagName('a')[0].innerHTML=data[z];
}catch(ex)
{

}
z++;
//alert(station);
}

}
<?php if (!isset($_GET['dashboard'])) 
{ 
  ?>
  //alert("ok");
window.location.href=window.location.href+"?dashboard=true";
<?php }?>
//setTimeout(function(){
  // window.location.reload(1);
//}, 5000);
</script>