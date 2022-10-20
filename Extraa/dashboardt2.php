

              <?php
              include_once 'includes/header.php';

                include_once("includes/link.php");
include_once 'database.php';
 $n=0;


?>
<script type="text/javascript" src="http://static.fusioncharts.com/code/latest/fusioncharts.js"></script>
<script type="text/javascript" src="http://static.fusioncharts.com/code/latest/themes/fusioncharts.theme.fint.js?cacheBust=56"></script>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script> 
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js" type="text/javascript"></script> 

 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstra.css">

 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/
    bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous" />

   <!-- =====================Graph ===============================-->
<script src="//cdnjs.cloudflare.com/ajax/libs/dygraph/2.1.0/dygraph.min.js"></script>
<link rel="stylesheet" src="//cdnjs.cloudflare.com/ajax/libs/dygraph/2.1.0/dygraph.min.css" />

    <script src="http://dygraphs.com/1.0.1/dygraph-combined.js"></script>
 
<script src="http://cavorite.com/labs/js/dygraphs-export/dygraph-extra.js"></script>
    <script src="js/underscore-min.js"></script>
    
    <style type="text/css">
    th{
      background-color:#539CCC;color:white;font-size: 13px;
    }

    </style>
  <style type="text/css">
.dygraph-legend {
  background: transparent !important;
  left: 80px !important;
width: 90% !important;
 display: inline !important;

}
.dygraph-title{
  font-size: 15;

}
  .modal {
  width: 100%;
  height: 98%;
  margin: 0;
  padding: 0;
}
.modal-dialog {
  width: 100%;
  height: 98%;
  margin: 0;
  padding: 0;
}

.modal-body {
  height: 98%;
  width: 100%;
  min-height: 100%;
  border-radius: 0;
}


</style>
    <script type="text/javascript">
       function hide(id)
       {
        var e=document.getElementsByName(id+"Radio")[0];

        if (e.checked) {
 document.getElementById(id+"VirtualTable").style.display = "none";
 document.getElementById(id+"RealTable").style.display="";

}
else
{

document.getElementById(id+"RealTable").style.display="none";
 document.getElementById(id+"VirtualTable").style.display = "";
                       

}
       }


    </script>
    <?php
    $allcsv_files=array();
$gauge_values=array();


$all_design_count=array();
if (isset($_SESSION["username"])) {

$Dashboard_list= array();
$table_list='';//array();
    $username=trim($_SESSION["username"]);
    $sql="select distinct  \"Dashboard\"from \"DefineDashboard\" where \"Users\" like '%$username%'";

    $ds=pg_query($sql);
    ?>
<br>

<ul class="nav nav-tabs" style="width:98%;margin: 1%;">
<?php
if (pg_num_rows($ds)>0) {
$p=0;
while ($row= pg_fetch_array($ds)) {



?>
    <li <?php if ($p==0) echo 'class="active"';  $p++;?> onClick="refresh()" ><a data-toggle="tab" href="#<?php echo str_replace(' ', '_', $row["Dashboard"]);?>" ><?php echo $row["Dashboard"];?></a></li>
    <?php

  }
    }
    ?>
  </ul>

  <div class="tab-content" style="width:98%;margin: 1%;">
  <?php
 $ds_m=pg_query($sql);
 $data=array();
  if (pg_num_rows($ds)>0) 
  {
$p=0;

while ($row=pg_fetch_array($ds_m)) 
{

?>
  <div id="<?php echo str_replace(' ', '_', $row["Dashboard"]);?>" class='tab-pane fade <?php if ($p==0) echo "in active";$p++;?>'>
<?php
         $sql="select \"Station_Full_Name\",\"Sensors\",\"ID\",\"Dashboard\",\"no_of_records\",\"Capacity\",\"CapacityType\",\"DashboardType\",\"design_code\" from \"DefineDashboard\" where \"Users\" like '%$username%' and \"Dashboard\"='$row[0]' order by \"ID\"";

         $z=0;
          $ds=pg_query($sql);
while ($row_Dashboard= pg_fetch_array($ds)) 
{
  

      

        

            $PARAMS = explode(";", $row_Dashboard["Sensors"]);
            $Allstations=explode(";",$row_Dashboard["Station_Full_Name"]);
$all_sql_queries=array();
$all_sql_queries2=array();
$all_sql_queries_for_fields=array();
       for ($i_stn=0; $i_stn <count($Allstations)-1 ; $i_stn++) 
       { 
      
      $station=trim($Allstations[$i_stn]);
 $stn_type_set=pg_query("SELECT \"StationType\" FROM \"tblStationType\"");
 $stn_name="";
 if(pg_num_rows($stn_type_set)>0)
 {
    while($table_name=pg_fetch_array($stn_type_set))
    {
      $tbl=$table_name['StationType'];
     $stn_set=pg_query("SELECT \"Station_Full_Name\" FROM \"$tbl\" where \"Station_Shef_Code\"='$station'");
      if(pg_num_rows($stn_set)>0)
 {
   $name=pg_fetch_array($stn_set);
     $stn_name=$name['Station_Full_Name'];
 }
    }
 }
$CapacityType=$row_Dashboard['CapacityType'];

$realsensors='';
$vertualsensors='';
$sensortype='';
$valuecol='';
$v_sensor_names="";
$r_sensor_names="";
for ($i=0; $i < count($PARAMS) ; $i++) 
{ 

$row=pg_fetch_array(pg_query("select \"SensorType\",\"SHEF\",\"Sensor\" from \"SensorValues\" where \"StationFullName\"='$stn_name' and \"Sensor\"='$PARAMS[$i]'"));

if ($row[0]=="Real") {
 $realsensors.=$row[1].";";
$r_sensor_names.=$row[2].";";
}else
{
  $vertualsensors.=$row[1].";";
  $v_sensor_names.=$row[2].";";
}

}




$paramsshef=explode(";", $realsensors);
$HydroMetShefCodeCodition='';
$limit=$row_Dashboard['no_of_records'];
for ($i=0; $i <count($paramsshef)-1; $i++) { 

    $result_set=  pg_query("SELECT \"HydroMetParamsTypeId\" FROM \"tblHydroMetParamsType\" where 
            \"HydroMetShefCode\" = '$paramsshef[$i]'");
          $row=pg_fetch_array($result_set);
$HydroMetShefCodeCodition.=" a.\"HydroMetParamsTypeId\"=''$row[0]'' or";
}

$paramsshefVirtual=explode(";", $vertualsensors);
$HydroMetShefCodeCoditionVirtual='';
for ($i=0; $i <count($paramsshefVirtual)-1; $i++) { 
if (trim($paramsshefVirtual[$i])!="") {
  # code...

    $result_set=  pg_query("SELECT \"HydroMetParamsTypeId\" FROM \"tblHydroMetParamsType\" where 
            \"HydroMetShefCode\" = '$paramsshefVirtual[$i]'");
          $row=pg_fetch_array($result_set);
$HydroMetShefCodeCoditionVirtual.=" a.\"HydroMetParamsTypeId\"=''$row[0]'' or";

}



}

$Capacity=explode(";",$row_Dashboard['Capacity']);

$realsensors2="";
$r_sensor_names2="";
$vertualsensors2="";
$v_sensor_names2="";
if (trim($CapacityType)=="Sensors")
{
for ($i=0; $i < count($Capacity)-1 ; $i++) 
{ 

$row=pg_fetch_array(pg_query("select \"SensorType\",\"SHEF\",\"Sensor\" from \"SensorValues\" where \"StationFullName\"='$stn_name' and \"Sensor\"='$Capacity[$i]'"));

if ($row[0]=="Real") {
 $realsensors2.=$row[1].";";
$r_sensor_names2.=$row[2].";";
}else
{
  $vertualsensors2.=$row[1].";";
  $v_sensor_names2.=$row[2].";";
}

}


$paramsshef2=explode(";", $realsensors2);
$HydroMetShefCodeCodition2='';
for ($i=0; $i <count($paramsshef2)-1; $i++) { 

    $result_set=  pg_query("SELECT \"HydroMetParamsTypeId\" FROM \"tblHydroMetParamsType\" where 
            \"HydroMetShefCode\" = '$paramsshef2[$i]'");
          $row=pg_fetch_array($result_set);
$HydroMetShefCodeCodition2.=" a.\"HydroMetParamsTypeId\"=''$row[0]'' or";

}

$paramsshefVirtual2=explode(";", $vertualsensors2);
$HydroMetShefCodeCoditionVirtual2='';
for ($i=0; $i <count($paramsshefVirtual2)-1; $i++) { 
if (trim($paramsshefVirtual2[$i])!="") {
  # code...

    $result_set=  pg_query("SELECT \"HydroMetParamsTypeId\" FROM \"tblHydroMetParamsType\" where 
            \"HydroMetShefCode\" = '$paramsshefVirtual2[$i]'");
          $row=pg_fetch_array($result_set);
$HydroMetShefCodeCoditionVirtual2.=" a.\"HydroMetParamsTypeId\"=''$row[0]'' or";

}
}
$HydroMetShefCodeCoditionVirtual2=rtrim($HydroMetShefCodeCoditionVirtual2 ,'or');
$HydroMetShefCodeCodition2=rtrim($HydroMetShefCodeCodition2 ,'or');

}

$HydroMetShefCodeCoditionVirtual=rtrim($HydroMetShefCodeCoditionVirtual ,'or');
$HydroMetShefCodeCodition=rtrim($HydroMetShefCodeCodition ,'or');

$year=date("y");

$DashboardType=$row_Dashboard['DashboardType'];
    $result_table=  pg_query("SELECT * FROM \"tblAllTables\" where \"TableName\" like '%".$station."_$year%'");
    if (pg_num_rows($result_table)==0) {
      $year=$year-1;
       $result_table=  pg_query("SELECT * FROM \"tblAllTables\" where \"TableName\" like '%".$station."_$year%'");
    }

    if (isset($result_table)) {

      $stn_id=  pg_query("SELECT \"StationId\" FROM \"tblStation\" where \"StationName\"='$station'");
$id_row=pg_fetch_array($stn_id);
$s_id= $id_row['StationId'];

  while ($tablerows=pg_fetch_array($result_table)) {
 
$table="'".$tablerows['TableName']."'";
/*if (trim($HydroMetShefCodeCodition)!="") {

 $tem=pg_query("SELECT distinct \"HydroMetParamsTypeId\", \"StationId\" FROM \"$table\" a where
    a.\"StationId\"=$s_id and a.\"Flag\"= '1' and (".str_replace("''", "'", $HydroMetShefCodeCodition).")   order by 1 desc");
 $limit_real=pg_num_rows($tem);
// $limit_real=($limit_real*$row_Dashboard['no_of_records']);

}*/


   //$sql_queryReal="SELECT  (''20''||\"Year\"::text ||''-''||\"Month\"::text ||''-''|| \"Day\" ::text ||'' ''||\"Hour\"::text || '':'' || \"Minute\" ::text || '':'' ||\"Second\")::timestamp  as t,\"HydroMetParamsTypeId\"::text as \"HydroMetParamsTypeId\", \"Value\",\"StationId\" FROM \"'$table'\" a where a.\"StationId\"=$s_id and a.\"Flag\"= ''1'' and ($HydroMetShefCodeCodition)   order by 1 desc limit $limit_real";
 //$sql_queryVirtual ="SELECT  (''20''||\"Year\"::text ||''-''||\"Month\"::text ||''-''|| \"Day\" ::text ||'' ''||\"Hour\"::text || '':'' || \"Minute\" ::text || '':'' ||\"Second\")::timestamp  as t,\"HydroMetParamsTypeId\"::text ||''V'' as \"HydroMetParamsTypeId\", \"VirtualValue\",\"StationId\" FROM \"'$table'\" a where a.sensortype=''Virtual'' and a.\"Flag\"= ''1'' and a.\"StationId\"=$s_id and ($HydroMetShefCodeCoditionVirtual)   order by 1 desc limit $limit_virtual";

//echo $sql_queryReal."<br><br>";
$sql_queryReal='';
$sql_queryVirtual='';
if (trim($HydroMetShefCodeCodition)!="") {

$HydroMetShefCodeCodition=explode("or", $HydroMetShefCodeCodition);

for ($i=0; $i <count($HydroMetShefCodeCodition);$i++) { 
 


$sql_queryReal.="(SELECT  (''20''||\"Year\"::text ||''-''||\"Month\"::text ||''-''|| \"Day\" ::text ||'' ''||\"Hour\"::text || '':'' || \"Minute\" ::text || '':'' ||\"Second\")::timestamp  as t,\"HydroMetParamsTypeId\"::text as \"HydroMetParamsTypeId\", \"Value\",\"StationId\" FROM \"'$table'\" a where a.\"StationId\"=$s_id and a.\"Flag\"= ''1'' and ($HydroMetShefCodeCodition[$i])   order by 1 desc limit $limit) union all "; 
}
}
if (trim($HydroMetShefCodeCoditionVirtual)!="") {

$HydroMetShefCodeCoditionVirtual=explode("or", $HydroMetShefCodeCoditionVirtual);

for ($i=0; $i <count($HydroMetShefCodeCoditionVirtual) ; $i++) { 
$sql_queryVirtual .="(SELECT  (''20''||\"Year\"::text ||''-''||\"Month\"::text ||''-''|| \"Day\" ::text ||'' ''||\"Hour\"::text || '':'' || \"Minute\" ::text || '':'' ||\"Second\")::timestamp  as t,\"HydroMetParamsTypeId\"::text ||''V'' as \"HydroMetParamsTypeId\", \"VirtualValue\" as \"Value\",\"StationId\" FROM \"'$table'\" a where a.sensortype=''Virtual'' and a.\"Flag\"= ''1'' and a.\"StationId\"=$s_id and ($HydroMetShefCodeCoditionVirtual[$i])   order by 1 desc limit $limit) union all ";
}
}
if (trim(rtrim($sql_queryReal,"union all"))!="") {
  # code...

$sql_queryReal="select * from (".rtrim($sql_queryReal,"union all").") s1";
}
if (trim(rtrim($sql_queryVirtual,"union all"))!="") {

$sql_queryVirtual="select * from (".rtrim($sql_queryVirtual,"union all").") s2";
}
if (trim($CapacityType)=="Sensors")
 {
 

   /*$sql_queryReal2="SELECT  (''20''||\"Year\"::text ||''-''||\"Month\"::text ||''-''|| \"Day\" ::text ||'' ''||\"Hour\"::text || '':'' || \"Minute\" ::text || 
'':'' ||\"Second\")::timestamp  as t,\"HydroMetParamsTypeId\"::text as \"HydroMetParamsTypeId\", \"Value\",\"StationId\" FROM \"'$table'\" a where
    a.\"StationId\"=$s_id and a.\"Flag\"= ''1'' and ($HydroMetShefCodeCodition2)   order by 1 desc limit $limit";
 $sql_queryVirtual2 ="SELECT  (''20''||\"Year\"::text ||''-''||\"Month\"::text ||''-''|| \"Day\" ::text ||'' ''||\"Hour\"::text || '':'' || \"Minute\" ::text || 
'':'' ||\"Second\")::timestamp  as t,\"HydroMetParamsTypeId\"::text||''V'' as \"HydroMetParamsTypeId\", \"VirtualValue\",\"StationId\" FROM \"'$table'\" a where a.sensortype=''Virtual'' and a.\"Flag\"= ''1'' and a.\"StationId\"=$s_id and ($HydroMetShefCodeCoditionVirtual2)   order by 1 desc limit $limit";*/

$sql_queryReal2='';
$sql_queryVirtual2='';
if (trim($HydroMetShefCodeCodition2)!="") {

$HydroMetShefCodeCodition2=explode("or", $HydroMetShefCodeCodition2);

for ($i=0; $i <count($HydroMetShefCodeCodition2);$i++) { 
 

$sql_queryReal2.="(SELECT  (''20''||\"Year\"::text ||''-''||\"Month\"::text ||''-''|| \"Day\" ::text ||'' ''||\"Hour\"::text || '':'' || \"Minute\" ::text || '':'' ||\"Second\")::timestamp  as t,\"HydroMetParamsTypeId\"::text as \"HydroMetParamsTypeId\", \"Value\",\"StationId\" FROM \"'$table'\" a where a.\"StationId\"=$s_id and a.\"Flag\"= ''1'' and ($HydroMetShefCodeCodition2[$i])   order by 1 desc limit $limit) union all "; 
}
}
if (trim($HydroMetShefCodeCoditionVirtual2)!="") {

$HydroMetShefCodeCoditionVirtual2=explode("or", $HydroMetShefCodeCoditionVirtual2);

for ($i=0; $i <count($HydroMetShefCodeCoditionVirtual2) ; $i++) { 
$sql_queryVirtual2 .="(SELECT  (''20''||\"Year\"::text ||''-''||\"Month\"::text ||''-''|| \"Day\" ::text ||'' ''||\"Hour\"::text || '':'' || \"Minute\" ::text || '':'' ||\"Second\")::timestamp  as t,\"HydroMetParamsTypeId\"::text ||''V'' as \"HydroMetParamsTypeId\", \"VirtualValue\" as \"Value\",\"StationId\" FROM \"'$table'\" a where a.sensortype=''Virtual'' and a.\"Flag\"= ''1'' and a.\"StationId\"=$s_id and ($HydroMetShefCodeCoditionVirtual2[$i])   order by 1 desc limit $limit) union all ";
}
}
if (trim(rtrim($sql_queryReal2,"union all"))!="") {

$sql_queryReal2="select * from (".rtrim($sql_queryReal2,"union all").") s11";
//echo $sql_queryReal2;
}
if (trim(rtrim($sql_queryVirtual2,"union all"))!="") {

$sql_queryVirtual2="select * from (".rtrim($sql_queryVirtual2,"union all").") s22";
//echo $sql_queryVirtual2;
}

if ($sql_queryReal2!="select * from ()") {
$all_sql_queries2[]=$sql_queryReal2;
}
if ($sql_queryVirtual2!="select * from ()") {
$all_sql_queries2[]=$sql_queryVirtual2;
}
}

if ($sql_queryReal!="select * from ()") {
$all_sql_queries[]=$sql_queryReal;
}
if ($sql_queryVirtual!="select * from ()") {
$all_sql_queries[]=$sql_queryVirtual;
}



if (trim($CapacityType)=="Fileds") 
{
$fields_table='select ';
for ($i_fields=0; $i_fields <count($Capacity)-1 ; $i_fields++) { 
  $fields_table.="\"".str_replace(" ", "_", $Capacity[$i_fields])."\",";
}
$fields_table=rtrim($fields_table,",");
$fields_table.="from \"$DashboardType\" where \"Station_Shef_Code\"='$station'";
  $all_sql_queries_for_fields[$station]=$fields_table;

}

?>



 

  <?php

  $z++;

  }

    }



}
$sql_query="SELECT * FROM crosstab('";
$sql_query_temp="select  rank() OVER (ORDER BY t,\"StationId\")::int AS rn,t,\"StationId\",\"HydroMetParamsTypeId\",\"Value\"  from (";
for ($i=0; $i <count($all_sql_queries) ; $i++) { 
//  echo "<br>".$all_sql_queries[$i];
  if (trim($all_sql_queries[$i])!="") {
    # code...

  $sql_query_temp.="(".$all_sql_queries[$i].") union all";
  }
}
$sql_query_temp=rtrim($sql_query_temp, "union all");
$sql_query_temp.=") x";


$sql_query.=$sql_query_temp."','select distinct \"HydroMetParamsTypeId\" from ($sql_query_temp ) x2') AS final_result(rn int,t timestamp,\"StationId\" int";
$col_query="select distinct \"HydroMetParamsTypeId\" from ( ".str_replace("''", "'", $sql_query_temp).") x2";
$col_set= pg_query($col_query);
while ($cols=pg_fetch_array($col_set)) {
  $sql_query.=",\"".$cols[0]."\" text";
}
  $sql_query.=") order by 1 desc";


$col_query2='';
if (trim($CapacityType)=="Sensors") 
{
$sql_query2="SELECT * FROM crosstab('";
$sql_query_temp2="select  rank() OVER (ORDER BY t,\"StationId\")::int AS rn,t,\"StationId\",\"HydroMetParamsTypeId\",\"Value\"  from (";
for ($i=0; $i <count($all_sql_queries2) ; $i++) { 
//  echo "<br>".$all_sql_queries[$i];
    if (trim($all_sql_queries2[$i])!="") {

  $sql_query_temp2.="(".$all_sql_queries2[$i].") union all";
}
}
$sql_query_temp2=rtrim($sql_query_temp2, "union all");
$sql_query_temp2.=") x";


$sql_query2.=$sql_query_temp2."','select distinct \"HydroMetParamsTypeId\" from ($sql_query_temp2 ) x2') AS final_result(rn int,t timestamp,\"StationId\" int";
$col_query2="select distinct \"HydroMetParamsTypeId\" from ( ".str_replace("''", "'", $sql_query_temp2).") x2";
$col_set= pg_query($col_query2);
while ($cols=pg_fetch_array($col_set)) {
  $sql_query2.=",\"".$cols[0]."\" text";
}
  $sql_query2.=")";

$sql_query_sensors="select t1.rn,t1.t,t1.\"StationId\"";

$col_set= pg_query($col_query);
while ($cols=pg_fetch_array($col_set)) {
  $sql_query_sensors.=",t1.\"".$cols[0]."\"";
}

$col_set= pg_query($col_query2);
while ($cols=pg_fetch_array($col_set)) {
  $sql_query_sensors.=",t2.\"".$cols[0]."\"";
}
$sql_query_sensors.=" from (".$sql_query.")  t1 FULL OUTER JOIN (".$sql_query2.") t2 on t1.t=t2.t and t1.\"StationId\"=t2.\"StationId\" order by 1 desc";
}


//echo "$sql_query2";
//echo "$sql_query_sensors";
$stn_conditions='';

$temp_stn_con=explode(";",$row_Dashboard['Station_Full_Name']);

for ($i=0; $i <count($temp_stn_con)-1 ; $i++) { 
  $stn_conditions.="\"StationFullName\"='$temp_stn_con[$i]' or";
}
$stn_conditions=rtrim($stn_conditions,"or");
//echo $stn_conditions;

?>
<?php
$sensor_list=array();
 $table_design='<br>';
$table_design.='<table class="table table-responsive table-hover" style="margin-left:15px" border="1">';
$table_design.='<thead>';
$table_design.='<tr>';
$table_design.='<th style="text-align: center;height: 30px" colspan=';
 $col_set=pg_query($col_query); $table_design.= (pg_num_rows($col_set)+3);
 $table_design.='>Current Values</th><th style="text-align: center;" colspan=';

 if (trim($CapacityType)=='Sensors') 
{ 
  $col_set=pg_query($col_query2); 
$table_design.= (pg_num_rows($col_set));
}
else $table_design.= (count($Capacity)-1);
$table_design.='>Capacity</th></tr>';
$table_design.='<tr><th>Station Code</th><th>Station Name</th> <th>Date & Time</th>';

 $col_set=pg_query($col_query);
  while ($cols=pg_fetch_array($col_set)) {
    $ch=false;
    if (strpos($cols[0], "V")) {
$ch=true;    }
    $temp=intval(str_replace("V", "", $cols[0]));
      $sen_name_set=pg_query("SELECT  \"HydroMetShefCode\"  FROM \"tblHydroMetParamsType\" where \"HydroMetParamsTypeId\"=$temp");
$sen_shef=pg_fetch_array($sen_name_set);
 if ($ch) {
 $sen_name= getSensorName($sen_shef[0],$row_Dashboard['DashboardType'],"Virtual",$stn_conditions);
   $table_design.= "<th>$sen_name ($sen_shef[0])</th>";

   }else
   {
     $sen_name= getSensorName($sen_shef[0],$row_Dashboard['DashboardType'],"Real",$stn_conditions);

$table_design.= "<th>$sen_name ($sen_shef[0])</th>";
}
$sensor_list[]=$sen_shef[0];
}
if (trim($CapacityType)=="Fileds") 
{
for ($i_col_h=0; $i_col_h <count($Capacity)-1 ; $i_col_h++) { 

 $table_design.= "<th>$Capacity[$i_col_h]</th>";
}
}
if (trim($CapacityType)=="Sensors") 
{
  $col_set=pg_query($col_query2);

  while ($cols=pg_fetch_array($col_set)) {
     $ch=false;
    if (strpos($cols[0], "V")) {
$ch=true;    
}
        $temp=intval(str_replace("V", "", $cols[0]));

      $sen_name_set=pg_query("SELECT  \"HydroMetShefCode\"  FROM \"tblHydroMetParamsType\" where \"HydroMetParamsTypeId\"=$temp");
$sen_shef=pg_fetch_array($sen_name_set);
  if ($ch) {
 $sen_name= getSensorName($sen_shef[0],$row_Dashboard['DashboardType'],"Virtual",$stn_conditions);
   $table_design.= "<th>$sen_name ($sen_shef[0])</th>";

   }else
   {
     $sen_name= getSensorName($sen_shef[0],$row_Dashboard['DashboardType'],"Real",$stn_conditions);

$table_design.= "<th>$sen_name ($sen_shef[0])</th>";
}
$sensor_list[]=$sen_shef[0];

}
  }
   



$table_design.='</tr>';
$table_design.='</thead>';



if (trim($CapacityType)=='Sensors') 
{
  $current_set=pg_query($sql_query_sensors);
 // echo $sql_query_sensors;
}
else
{
 $current_set=pg_query($sql_query); 

}

while ($current_values=pg_fetch_array($current_set)) {


$table_design.="<tr>";

 $table_design.='<td>';

  $STN_KEY='';
$stn_name_set=pg_query("SELECT  \"StationName\"  FROM \"tblStation\" where \"StationId\"= $current_values[2]");
$stn_names=pg_fetch_array($stn_name_set);
$STN_KEY=$stn_names[0];
   $table_design.= $STN_KEY;
     
   $table_design.='</td>';
    $table_design.='<td>';
  $STN_KEY='';
$stn_name_set=pg_query("SELECT  \"StationName\"  FROM \"tblStation\" where \"StationId\"= $current_values[2]");
$stn_names=pg_fetch_array($stn_name_set);
$STN_KEY=$stn_names[0];
$stn_name=getStationName($row_Dashboard['DashboardType'],$STN_KEY);
   $table_design.= $stn_name;
     
   $table_design.='</td>';
    $table_design.="<td> $current_values[1]</td>";

  $col_set=pg_query($col_query);
  $row_count=3;
  while ($cols=pg_fetch_array($col_set)) {

    $table_design.= "<td>".$current_values[$row_count]." </td>";
    $row_count++;
  };


if (trim($CapacityType)=="Fileds") 
{
  $Capacity_col_set=pg_query($all_sql_queries_for_fields[$STN_KEY]);
  $no_of_fileds=pg_num_fields($Capacity_col_set);

  while ($Capacity_cols=pg_fetch_array($Capacity_col_set))
   {
    for($i_no=0;$i_no<$no_of_fileds; $i_no++)
     { 
    
   $table_design.= "<td>".$Capacity_cols[$i_no]." </td>";
 }
  }
}
if (trim($CapacityType)=="Sensors") 
{


  


      $col_set=pg_query($col_query2);
  while ($cols=pg_fetch_array($col_set)) {
      $table_design.= "<td>".$current_values[$row_count]." </td>";
    $row_count++;
}

}



$table_design.='</tr>';


}
 $table_design.='</table>';
 $table_list.=$table_design."###";
?>
<center>
<div id="<?php echo $row_Dashboard['Dashboard'].'design';?>" style="max-width: 100%;overflow: auto;margin-left:1% ">

  <?php
  //echo $row_Dashboard['Dashboard'];
  $table_draw= str_replace("  ", " ", $row_Dashboard['design_code']);

$table_draw= str_replace("min-height: 10%", "max-height: 500px;min-height: 300px;max-width:100%;overflow:auto", $table_draw);

$table_draw= str_replace("height: 400px", "height:500px;overflow-y:auto", $table_draw);
$table_draw= str_replace("width: 600px", "width:75%;overflow-x:auto", $table_draw);
$table_draw= str_replace("height: 200px", "height:300px;overflow-y:auto", $table_draw);
$table_draw= str_replace("width: 200px", "width:25%;overflow-x:auto", $table_draw);
$table_draw= str_replace("width: 400px", "width:50%;overflow-x:auto", $table_draw);

$table_draw= str_replace(";border: 1px solid #aaaaaa;padding: 10px", "", $table_draw);
$table_draw= str_replace(";border: 1px solid #aaaaaa", "", $table_draw);


$table_draw= str_replace("src=\"assets/images/gauge_icon.jpg\"", "src=\"StationImages/waitingIcon.gif\"", $table_draw);
$table_draw= str_replace(
"src=\"assets/images/line_graph.png\"", "src=\"StationImages/waitingIcon.gif\"", $table_draw);
$table_draw= str_replace("src=\"assets/images/table.png\"", "src=\"StationImages/waitingIcon.gif\"", $table_draw);




   echo  "<center>$table_draw</center>";?>
</div>
</center>
<?php
 $graph_stn_set;
if (trim($CapacityType)=="Sensors") 
{
  $graph_stn_set=pg_query("select count(\"StationId\"),\"StationId\" from  (  ".$sql_query_sensors." ) g group by \"StationId\"") ;

  
}
else
{

 $graph_stn_set=pg_query("select count(\"StationId\"),\"StationId\" from  (  ".$sql_query." ) g group by \"StationId\"") ;


}
$all_design_count[]=pg_num_rows($graph_stn_set);
while ($stn_row=pg_fetch_array($graph_stn_set))
 {
$stn_id=$stn_row["StationId"];
  $STN_KEY='';
$stn_name_set=pg_query("SELECT  \"StationName\"  FROM \"tblStation\" where \"StationId\"= $stn_id");
$stn_names=pg_fetch_array($stn_name_set);
$STN_KEY=$stn_names[0];

$sql_graph='';
if (trim($CapacityType)=="Sensors") 
{
  $sql_graph="select * from (  ".$sql_query_sensors." ) g where \"StationId\"=$stn_id" ;
  
}
else
{
    $sql_graph="select * from (  ".$sql_query." ) g where \"StationId\"=$stn_id" ;
}
$csv_file='Date';

  $col_set=pg_query($col_query);
  while ($cols=pg_fetch_array($col_set)) {
 $ch=false;
    if (strpos($cols[0], "V")) {
$ch=true;    }
    $temp=intval(str_replace("V", "", $cols[0]));
      $sen_name_set=pg_query("SELECT  \"HydroMetShefCode\"  FROM \"tblHydroMetParamsType\" where \"HydroMetParamsTypeId\"=$temp");
$sen_shef=pg_fetch_array($sen_name_set);
 if ($ch) {
 $sen_name= getSensorName($sen_shef[0],$row_Dashboard['DashboardType'],"Virtual",$stn_conditions);
 $csv_file.=",".$sen_name;

   }else
   {
     $sen_name= getSensorName($sen_shef[0],$row_Dashboard['DashboardType'],"Real",$stn_conditions);

 $csv_file.=",".$sen_name;
}
  }

  if (trim($CapacityType)=="Sensors") 
{


  


      $col_set=pg_query($col_query2);
  while ($cols=pg_fetch_array($col_set)) {

         $ch=false;
    if (strpos($cols[0], "V")) {
$ch=true;    
}
        $temp=intval(str_replace("V", "", $cols[0]));

      $sen_name_set=pg_query("SELECT  \"HydroMetShefCode\"  FROM \"tblHydroMetParamsType\" where \"HydroMetParamsTypeId\"=$temp");
$sen_shef=pg_fetch_array($sen_name_set);
  if ($ch) {
 $sen_name= getSensorName($sen_shef[0],$row_Dashboard['DashboardType'],"Virtual",$stn_conditions);
         $csv_file.=",".$sen_name." (Capacity)";


   }else
   {

     $sen_name= getSensorName($sen_shef[0],$row_Dashboard['DashboardType'],"Real",$stn_conditions);
         $csv_file.=",".$sen_name." (Capacity)";

}
}

}

if (trim($CapacityType)=="Fileds") 
{
for ($i_col_h=0; $i_col_h <count($Capacity)-1 ; $i_col_h++) { 
   $csv_file.=",".$Capacity[$i_col_h]." (Capacity)";
 
}


}





$csv_file.="\n";

$csv_set=pg_query($sql_graph);

while ($csv_row=pg_fetch_array($csv_set)) 
{

                       $csv_file.='"'.$csv_row[1];

$col_set=pg_query($col_query);
  $row_count=3;
  while ($cols=pg_fetch_array($col_set)) {

    $csv_file.=",".$csv_row[$row_count];
    $row_count++;
  }

 if (trim($CapacityType)=="Sensors") 
{

      $col_set=pg_query($col_query2);
  while ($cols=pg_fetch_array($col_set)) {
     $csv_file.=",".$csv_row[$row_count];
        $row_count++;
}



}

if (trim($CapacityType)=="Fileds") 
{
  $Capacity_col_set=pg_query($all_sql_queries_for_fields[$STN_KEY]);
  $no_of_fileds=pg_num_fields($Capacity_col_set);
  while ($Capacity_cols=pg_fetch_array($Capacity_col_set))
   {
    for($i_no=0;$i_no<$no_of_fileds; $i_no++)
     { 
         $csv_file.=",".$Capacity_cols[$i_no];

 }
  }
}



$csv_file.="\n";

}
//$stn_name_set=pg_query("SELECT  \"StationName\"  FROM \"tblStation\" where \"StationId\"= $stn_id");
//$stn_names=pg_fetch_array($stn_name_set);
//$STN_KEY=$stn_names[0];
//$stn_name=getStationName($row_Dashboard['DashboardType'],$STN_KEY);
//echo "<br><br><br>$csv_file";

 //echo '<br><div style="width:100%;height:30px;background-color:#539CCC"><b style="color:white;float:left">Sensors at Station '.$stn_name.' </b><p style="float:right"><a   title="Download!" id="downloadgraph'.$n.'"><img src="StationImages/downloadicon.png"></a> <a style="margin-left:3px;" title="Full Screen!" data-toggle="modal" data-target="#myModal'.$n.'"><img src="fullscreen.png"></a></p></div><br><div style="width: 100%;max-height: 300px;overflow-y: scroll;margin: 0 auto" id="graph'.$n.'" name="graph'.$n.'"><center><img src="StationImages/waitingIcon.gif"></center></div><br> ';


//echo '<img id="img'.$n.'" style="width:1px;height:1px">';

//echo '<div class="modal fade" data-backdrop="false"  id="myModal'.$n.'" role="dialog" style="background-color: white" > <div style="width:100%;height:30px;background-color:#539CCC"><b style="color:white">Sensors at Station '.$stn_name.'</b>    <button type="button" style="float: right;" class="close" data-dismiss="modal">&times;</button></div> <div style="width: 98%;height: 100%;overflow-y: scroll;" id="graph2'.$n.'" name="graph2'.$n.'"></div></div>';
$n++;
$allcsv_files[$STN_KEY]=$csv_file;
}
?>



<?php
$Dashboard_list[]=$row_Dashboard['Dashboard'];
}

if (trim($CapacityType)=="Sensors") 
{
  //$sql_guage="select * from (  ".str_replace('limit '.$limit, 'limit 1', $sql_query_sensors) ." ) g " ;
$sql_guage="select * from (  ".$sql_query_sensors." ) g " ;
      //echo "$sql_guage";

}
else
{
    //$sql_guage="select * from (  ".str_replace('limit '.$limit, 'limit 1', $sql_query)." ) g ";
  $sql_guage="select * from (  ".$sql_query." ) g ";
    // echo "$sql_guage";
}

$sql_guage_set=pg_query($sql_guage);


$field_count=pg_num_fields($sql_guage_set);

while ($guage_row=pg_fetch_array($sql_guage_set)) 
{
  $i=0;

$stn=$guage_row['StationId'];
$stn_name_set=pg_query("SELECT  \"StationName\"  FROM \"tblStation\" where \"StationId\"= $stn");
$stn_names=pg_fetch_array($stn_name_set);
$STN_KEY=$stn_names[0];

  for ($id_c=3;$id_c<$field_count;$id_c++)
   {
   if (trim($guage_row[$id_c])!="") {
  
      $key=$sensor_list[$i];
      if (!array_key_exists($key."_".$STN_KEY,$temp_keys)) {
      $gauge_values[$key."-".$STN_KEY]=$guage_row[$id_c];

}
  }

    $i=$i+1;

}
     

  
  
}



?></div>
<?php 
 }  
 }

 }



  
?>
</div>


<?php

function getSensorName($shef,$stntype,$type,$stn_conditions)
{
 $sensor_set= pg_query("select \"Sensor\" from \"SensorValues\" where \"SHEF\"='$shef' and \"StationTypeName\"='$stntype' and \"SensorType\"='$type' and ($stn_conditions)");

 $row=pg_fetch_array($sensor_set);

return $row[0];
}

function getStationName($table,$shef)
{
 $stn_set= pg_query("select \"Station_Full_Name\" from \"$table\" where \"Station_Shef_Code\"='$shef'");
 $row=pg_fetch_array($stn_set);
 return $row[0];
}

?>


<script type="text/javascript">
var g= new Array();

var e=document.getElementsByName("table_img");
var e2=document.getElementsByName("graph_img");
var e3=document.getElementsByName("gauge_img");
  var z=0;

var g_w=new Array();
var g_h=new Array();
var mapping_graph={};
var mapping_gauge={};
 $(document).ready(function() {

var json='<?php echo $table_list;?>';
var table_design=json.split('###');

l1=e.length;

for (var i = 0; i <l1 ; i++) {
 
try
{


var x = e[0].parentElement.id;
document.getElementById(x).innerHTML=table_design[i];
}catch(ex){}
}
 var pausecontent = new Array();
    <?php foreach ($allcsv_files as $key => $value) {    ?>

        pausecontent['<?php echo $key;?>']='<?php echo json_encode($value);?>';
    <?php } ?>
var grapharr=new Array();

l2=e2.length;
for (var i = 0; i <l2 ; i++) {
 
try
{
var x = e2[i].parentElement.id;
var xx=document.getElementById(x);
var lab= xx.getElementsByTagName('label');
var t=lab[0].id.split('_');
var temp="";
for(var j=0;j<t.length-1;j++)
{
  temp+=t[j]+"_";
}
temp=temp.slice(0, -1);
mapping_graph[x]=temp;
var h=document.getElementById(x).style.height;
var w=parseInt(document.getElementById(x).style.width);

if (h.trim()=="") 
{
  h=document.getElementById(x).style.minHeight;
  h = h.slice(0, -2); 
}
else
{
h=h.slice(0, -2);
}
if (w+"".trim()=="NaN") {
   w=parseInt(document.getElementById(x).style.maxWidth);

    // w = w.slice(0, -1); 
}

     w=w*14.2;
g_h.push(h);
g_w.push(w);
grapharr.push(x);

}catch(ex){}
}
l3=e3.length;
 var gauge_arr=new Array();
for (var i = 0; i <l3 ; i++) {
 
try
{
var x = e3[i].parentElement.id;
var xx=document.getElementById(x);

var lab= xx.getElementsByTagName('label');
var t=lab[0].id.split('_');

var temp="";
for(var j=0;j<t.length-1;j++)
{
  temp+=t[j]+"_";
}
temp=temp.slice(0, -1);
mapping_gauge[x]=temp;

gauge_arr.push(x);
}catch(exx){}
}


 for(d in mapping_graph)
 {
try
{
if (pausecontent[mapping_graph[d]]!='"Date"'||pausecontent[mapping_graph[d]]!=null||pausecontent[mapping_graph[d]]!='undefined') {
    myGraph(d,pausecontent[mapping_graph[d]],mapping_graph[d]);  
  }
}catch(ex)
{

}
}
gaugechart(gauge_arr,mapping_gauge);

}); 

function refresh()
{
  for (var i = 0; i < g.length; i++) {

try{
   g[i].resize(g_w[i],g_h[i]);
 }catch(ex){


 }
   // alert (g_w[i]+","+g_h[i]+"  "+g[i]);
 }
  }



function myGraph(graphdiv,resultArray,stn) {
 var option={
                         
              
           
                      xlabel: "Hours/Date",
    ylabel: "Values",
    legend:"follow",
      drawPoints: true,
        showRangeSelector: true,
        title:"Sensors at Station "+stn
                        };
    try 
    {
try
{
 g[z]=  new Dygraph(document.getElementById(graphdiv),
resultArray , option
           );



                z++;

              //g[z].dyOptions(labelsUTC = TRUE);

               }catch(ex1) {

               }


             
    }

  catch(ex)
    {
      document.getElementById(graphdiv).style="float:left";
       document.getElementById(graphdiv).innerHTML='No Data Found! - in '+stn;

    }
    if (resultArray=="undefined"||resultArray==null) {
       document.getElementById(graphdiv).style="float:left";
       document.getElementById(graphdiv).innerHTML='No Data Found! - in '+stn;
    }
     }    

</script>

<script type="text/javascript">
function gaugechart(gauge_arr,mapping_gauge)
{
var gauge_sen_stn=<?php echo json_encode($gauge_values);?>;
  for (var i in mapping_gauge) {
 
  var data =i;
  var value=gauge_sen_stn[mapping_gauge[i]];
    var fusioncharts = new FusionCharts({
    type: 'angulargauge',
    renderAt: data,
    width: '300',
    height: '250',
    dataFormat: 'json',
    dataSource: {
        "chart": {
            "caption": mapping_gauge[i],
            "subcaption": "",
            "plotToolText": "Current Score: $value",
            "theme": "fint",
            "chartBottomMargin": "50",
            "showValue": "1"


        },
        "colorRange": {
            "color": [{
                "minValue": "0",
                "maxValue": "4.5",
                "code": "#e44a00"
            }, {
                "minValue": "4.5",
                "maxValue": "7.5",
                "code": "#f8bd19"
            }, {
                "minValue": "7.5",
                "maxValue": "10",
                "code": "#6baa01"
            }]
        },
        "dials": {
            "dial": [{
                "value":  value
            }]
        }     
    }
}
);
    fusioncharts.render();
   
      }
}
</script>


