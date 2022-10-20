
<?php
								include("includes/link.php");

							?>
								<?php
								include("includes/header.php");
								include_once 'database.php';

$all_sensor=array();
$all_shef=array();
$count=0;
$count2=array();
                    $t_row;
                                        $s_row;

							?>
<br>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script> 
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js" type="text/javascript"></script> 
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>



 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous" />

           <link rel="stylesheet" href="assets/jquery-ui.css">

    <script type="text/javascript" src="assets/jquery.js"></script>
<script type="text/javascript" src="assets/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="/HydrometV2/assets/css/MyTable.css"> 

<script type="text/javascript">
$(function() 
{
 $( "#stn_id" ).autocomplete({

  source: 'autocompelete.php'
 });
});


</script>
<form style="
   
    overflow-x: hidden;
">
<label style="font-size: 30px;margin-left: 25px">Real-Time Event /Hourly Data</label>
<p style="margin-left: 25px">Enter Station name or Station Shef Code</p>
<div class="row" style="margin-left: 25px">
<div class="col-md-4">

	<input type="text" name="stn_id" id="stn_id" class="form-control" value="<?php if (isset($_GET['stn_id'])) {
    echo $_GET['stn_id'];
    # code...
  } ?>" required />
<input type="hidden" name="sensortype" id="hiddensensor" value="Real">
	</div>
	<div class="col-md-4">
	<input type="submit" name="" value="Get Data" class="btn btn-primary">
</div>

</div>

<script type="text/javascript">
 

 function PlotGraph(params,station) {
 
 
   var yearFrom;
            var monthFrom;
            var dayFrom;
            var yearTo;
            var monthTo;
            var dayTo;
			var hours=24;
                
                var days=1; // Days you want to subtract
var date = new Date();
var last = new Date(date.getTime() - (days * 24 * 60 * 60 * 1000));
var dayFrom =last.getDate();
var monthFrom=last.getMonth()+1;
var yearFrom=last.getFullYear();

                var currentdate = new Date();

                yearTo = currentdate.getFullYear();
                monthTo = currentdate.getMonth() + 1;
                dayTo = currentdate.getDate();
     
             // window.location.href= 'Graph.php?FY=' + yearFrom + "&FM=" + monthFrom + "&FD=" + dayFrom + '&TY=' + yearTo + "&TM=" + monthTo + "&TD=" + dayTo + "&PARAMS=" + params+"&hours="+hours+"&station="+station+"&hours2="+hours2;

          window.location.href= 'Graph.php?FY=' + yearFrom + "&FM=" + monthFrom + "&FD=" + dayFrom + '&TY=' + yearTo + "&TM=" + monthTo + "&TD=" + dayTo + "&PARAMS=" + params+"&hours="+hours+"&station="+station+"&hours2="+24;
  
  
}

</script>


<?php
$Y=date('Y');
$M=date('m');
$D=date('d');
$hours=24;
    $DateTime = new DateTime();
$min=date('i');
$h=date('H');
$DateTime=$DateTime->modify("-$hours Hours");
$DF=$DateTime->format('d');
$MF=$DateTime->format('m');
$h2=$DateTime->format("H");
$YF=$DateTime->format("Y");
$min2=$DateTime->format("i");
//echo "   $DF $MF $YF $h2 $min2  and   $D $M $Y $h $min";
if (isset($_GET['stn_id'])) {
  $stn_type_name='';
$station=trim($_GET['stn_id']);
$stn_name='';
$r_stn_name;
  $dataU=strtoupper($station);        
//echo "$h $h2";
$r=pg_query("select \"StationType\" from \"tblStationType\"");
 if (isset($r)) {
while ($row=pg_fetch_array($r)) {


$table=str_replace(" ", "_", $row['StationType']);
$r_stn_name=pg_query("select \"Station_Full_Name\" from \"$table\"  WHERE \"Station_Shef_Code\"= '$station' or \"Station_Shef_Code\"= '$dataU'");


if (pg_num_rows($r_stn_name)>0) {
$stn_type_name=$row['StationType'];
	$r2=pg_fetch_array($r_stn_name);
	$stn_name=$r2['Station_Full_Name'];
}
}
    
  }

if ($stn_name=='') {
$stn_name=$station;
}


$stn_shef='';
$r=pg_query("select \"StationType\" from \"tblStationType\"");

if (isset($r)) {
while ($row=pg_fetch_array($r)) {


$table=$row['StationType'];
$r_stn_name=pg_query("select \"Station_Shef_Code\" from \"$table\"  WHERE \"Station_Full_Name\"='$station' or \"Station_Full_Name\"='$dataU'");

if (pg_num_rows($r_stn_name)>0) {
$stn_type_name=$row['StationType'];
 $r2=pg_fetch_array($r_stn_name);
  $stn_shef=$r2['Station_Shef_Code'];
}
}
    
  

}

if ($stn_shef!='') {
  $station=$stn_shef;
}
echo "<br><p style='margin-left: 5%'><img src='assets/images/stationIcon.png' style='width:25px;height:25px'> <b>    $stn_name  /  $station</b></p>";

echo "<p style='margin-left: 5%'>Query Executed ".date("D M j G:i:s T Y")."</p>";



if ($stn_type_name!='') {
$stn_data_query='select ';
//echo "Stn type name $stn_type_name";
$stn_type_ds=pg_query("select \"StationField\" from \"DefineStations\" where \"StationTypeName\"='$stn_type_name'");
while ($st_row=pg_fetch_array($stn_type_ds)) {

 // echo $st_row['StationField'];

  $stn_data_query.="\"".str_replace(" ","_",$st_row['StationField'])."\",";
}
$stn_data_query= trim($stn_data_query,",");
$stn_data_query.=" from \"".str_replace(" ", "_",$stn_type_name)."\" where \"Station_Full_Name\"='$stn_name' and \"Station_Shef_Code\"='$station'";

//echo $stn_data_query;
$x=0;
$stn_data_row=pg_fetch_array(pg_query($stn_data_query));
$stn_type_ds=pg_query("select \"StationField\" from \"DefineStations\" where \"StationTypeName\"='$stn_type_name'");
echo "<table style='width:90%;margin-left:5%'><tr>";
while ($st_row=pg_fetch_array($stn_type_ds)) {

  echo "<td><label>".str_replace("_", " ",$st_row[0])."</label></td><td>  ". $stn_data_row[str_replace(" ", "_", $st_row[0])]."   </td>";

$x++;
if ($x%4==0) {
  echo "</tr>";
}
}
echo "</table>";
}
?>
<script type="text/javascript">
    document.getElementById("hiddensensor").disabled=true;

</script>
<br>
<div style="min-width: 70%;max-height: 100%;margin-left:5%;margin-left:2%";>
<center>
<div class="row">
<div class='row'>
<div class='col-md-12'>
<table align='center' style='max-width:98%;min-width:60%;' class='table'>
<tr>
<td colspan="2">
<label>Provisional data, subject to change.
Select a sensor type for a plot of data.
</label>
<td>
</tr>

</table>


</div></div>
  
<?php

$dataU=strtoupper($station);

 $temp=array();
$temp_Y=str_split($Y);
$temp_YEAR=$temp_Y[2]."".$temp_Y[3];
 pg_query("CREATE EXTENSION if not exists tablefunc");
 $result_table=  pg_query("SELECT * FROM \"tblAllTables\"  WHERE \"TableName\" like '%".$station."_1%' or \"TableName\" like '%".$dataU."_1%' or  \"TableName\" like '%".$station."_2%' or \"TableName\" like '%".$dataU."_2%'");


    if (isset($result_table)) {

      $stn_id=  pg_query("SELECT \"StationId\" FROM \"tblStation\" where \"StationName\"='$station' or \"StationName\"='$dataU'");
$id_row=pg_fetch_array($stn_id);
$s_id= $id_row['StationId'];
  while ($tablerows=pg_fetch_array($result_table)) {
     
$table="'".$tablerows['TableName']."'" ;




$t_row;


 

 /* $temp_real=pg_query("select count(x) as x from    (select count(\"HydroMetParamsTypeId\") as x from \"$table\" group by \"HydroMetParamsTypeId\") as t");
$t_row=pg_fetch_array($temp_real);*/

$sql_query_real="SELECT * FROM crosstab ('SELECT  (''20''||\"Year\"::text ||''-''|| \"Month\"::text ||''-''|| \"Day\" ::text ||'' ''|| \"Hour\"::text || '':'' || \"Minute\" ::text || 
'':'' ||\"Second\")::timestamp  as t,\"HydroMetParamsTypeId\", \"Value\" FROM  \"'$table'\" a where ((''20''||\"Year\"::text ||''-''|| \"Month\"::text ||''-''|| \"Day\" ::text ||'' ''|| \"Hour\"::text || '':'' || \"Minute\" ::text || '':'' || \"Second\")::timestamp  BETWEEN (''$YF-$MF-$DF $h2:$min2:0'') AND (''$Y-$M-$D $h:$min:0'')) and a.\"StationId\"=$s_id  order by 1 desc'
   ,'SELECT distinct \"HydroMetParamsTypeId\" FROM \"'$table'\"'
   ) AS final_result(t timestamp";


$col_set=pg_query("SELECT distinct \"HydroMetParamsTypeId\" FROM \"$table\"");

      while ($cols=pg_fetch_array($col_set)) { 
        $sql_query_real.=",\"".$cols[0]."\" double precision";
      }
$sql_query_real.=")";



/* $temp_virtual=pg_query("select count(x) as x from    (select count(\"HydroMetParamsTypeId\") as x from \"$table\" where \"sensortype\"='Virtual' group by \"HydroMetParamsTypeId\") as t");

$t_row=pg_fetch_array($temp_virtual);*/
$sql_query_virtual="SELECT * FROM crosstab ('SELECT  (''20''||\"Year\"::text ||''-''||\"Month\"::text ||''-''|| \"Day\" ::text ||'' ''||\"Hour\"::text || '':'' || \"Minute\" ::text || 
'':'' ||\"Second\")::timestamp  as t,\"HydroMetParamsTypeId\", \"VirtualValue\" FROM \"'$table'\" a where
   ((''20''||\"Year\"::text ||''-''|| \"Month\"::text ||''-''|| \"Day\" ::text ||'' ''|| \"Hour\"::text || '':'' || \"Minute\" ::text || '':'' || \"Second\")::timestamp  BETWEEN (''$YF-$MF-$DF $h2:$min2:0'') AND (''$Y-$M-$D $h:$min:0'')) and a.\"StationId\"=$s_id and  \"sensortype\"=''Virtual''  order by 1 desc'
   ,'SELECT distinct \"HydroMetParamsTypeId\" FROM \"'$table'\" where \"sensortype\"=''Virtual'''
   ) AS final_result(t timestamp";

$col_set=pg_query("SELECT distinct \"HydroMetParamsTypeId\" FROM \"$table\" where \"sensortype\"='Virtual'");


      while ($cols=pg_fetch_array($col_set)) { 
        $sql_query_virtual.=",\"".$cols[0]."\" double precision";
      }

$sql_query_virtual.=")";


 
$sql_query="select t1.t";

$col_set=pg_query("select  \"SHEF\",\"SensorType\" FROM \"SensorValues\" where (\"StationFullName\"= '$stn_name')");
while ($cols=pg_fetch_array($col_set)) 
{

$col=pg_fetch_array(pg_query("SELECT  \"HydroMetParamsTypeId\"   FROM \"tblHydroMetParamsType\" where  \"HydroMetShefCode\"='$cols[0]'"));



if (trim($cols[1])=='Real') 
{
  if(pg_num_rows(pg_query("select distinct \"HydroMetParamsTypeId\" FROM  \"$table\" a where (('20'||\"Year\"::text ||'-'|| \"Month\"::text ||'-'|| \"Day\" ::text ||' '|| \"Hour\"::text || ':' || \"Minute\" ::text || ':'|| \"Second\")::timestamp  BETWEEN ('$YF-$MF-$DF $h2:$min2:0') AND ('$Y-$M-$D $h:$min:0')) and a.\"StationId\"=$s_id  and \"HydroMetParamsTypeId\"=$col[0] order by 1 desc"))>0)
{
   $sql_query .=",t1.\"$col[0]\"" ;
 }
  }
  else
  {
     if(pg_num_rows(pg_query("select distinct \"HydroMetParamsTypeId\" FROM  \"$table\" a where (('20'||\"Year\"::text ||'-'|| \"Month\"::text ||'-'|| \"Day\" ::text ||' '|| \"Hour\"::text || ':' || \"Minute\" ::text || ':'|| \"Second\")::timestamp  BETWEEN ('$YF-$MF-$DF $h2:$min2:0') AND ('$Y-$M-$D $h:$min:0')) and a.\"StationId\"=$s_id  and \"HydroMetParamsTypeId\"=$col[0] and \"sensortype\"='Virtual' order by 1 desc"))>0)
{
    $sql_query .=",t2.\"$col[0]\"";
  }
  }


}


$sql_query=rtrim($sql_query,",");

$sql_query.=" from (".$sql_query_real.") t1 FULL OUTER JOIN (".$sql_query_virtual.") t2 on t1.t=t2.t order by t1.t desc";

if(pg_num_rows(pg_query("SELECT distinct \"HydroMetParamsTypeId\" FROM \"$table\" where \"sensortype\"='Virtual'"))<=0)
{
  $sql_query="select t1.t";

$col_set=pg_query("select \"SHEF\",\"SensorType\" FROM \"SensorValues\" where (\"StationFullName\"= '$stn_name')");
while ($cols=pg_fetch_array($col_set)) 
{

$col=pg_fetch_array(pg_query("SELECT  \"HydroMetParamsTypeId\"   FROM \"tblHydroMetParamsType\" where  \"HydroMetShefCode\"='$cols[0]'"));

if (trim($cols[1])=='Real') 
{
    if(pg_num_rows(pg_query("select distinct \"HydroMetParamsTypeId\" FROM  \"$table\" a where (('20'||\"Year\"::text ||'-'|| \"Month\"::text ||'-'|| \"Day\" ::text ||' '|| \"Hour\"::text || ':' || \"Minute\" ::text || ':'|| \"Second\")::timestamp  BETWEEN ('$YF-$MF-$DF $h2:$min2:0') AND ('$Y-$M-$D $h:$min:0')) and a.\"StationId\"=$s_id  and \"HydroMetParamsTypeId\"=$col[0] order by 1 desc"))>0)
{
   $sql_query .=",t1.\"$col[0]\"" ;
 }
  }
  
}

  $sql_query.=" from (".$sql_query_real." ) t1";
}

//echo $sql_query;
 $result_set=pg_query($sql_query);

 
}

}




$z=0;


?>

<!-- <div class="col-md-12" style="overflow:scroll;height: 600px;"> -->
<!--<div class="col-md-12" style="overflow-y:scroll;height: 600px;"> -->
<table align="center" id="myTable" style="max-width:99%;min-width:50%" class=" table-responsive table-bordered">
<tr>
    <th style="background-color:#539CCC;color:white;text-align:center;font-size: 16px;width:350px">Date / Time</th>
     
   
 <!-- <th  style="background-color:#539CCC;color:white;text-align:center;font-size: 13px">Sensor</th>-->
  <?php  


 $result_sensor1=(pg_query("select \"Sensor\",\"Units\",\"SensorType\",\"SHEF\" from \"SensorValues\" where (\"StationFullName\"= '$stn_name')"));

// echo("select \"Sensor\",\"Units\",\"SensorType\",\"SHEF\" from \"SensorValues\" where (\"StationFullName\"= '$stn_name')")."<br>";

while ($sensor_row=pg_fetch_array($result_sensor1)) 
{
  // print_r(json_encode($sensor_row));
  $sql="";
  if (trim($sensor_row[2])=="Real") {
    # code...
 $col=pg_fetch_array(pg_query("SELECT  \"HydroMetParamsTypeId\"   FROM \"tblHydroMetParamsType\" where  \"HydroMetShefCode\"='$sensor_row[3]'"));
  $sql=("select distinct \"HydroMetParamsTypeId\" FROM  \"$table\" a where (('20'||\"Year\"::text ||'-'|| \"Month\"::text ||'-'|| \"Day\" ::text ||' '|| \"Hour\"::text || ':' || \"Minute\" ::text || ':'|| \"Second\")::timestamp  BETWEEN ('$YF-$MF-$DF $h2:$min2:0') AND ('$Y-$M-$D $h:$min:0')) and a.\"StationId\"=$s_id  and \"HydroMetParamsTypeId\"=$col[0] order by 1 desc");
 }
 else
 {
  $col=pg_fetch_array(pg_query("SELECT  \"HydroMetParamsTypeId\"   FROM \"tblHydroMetParamsType\" where  \"HydroMetShefCode\"='$sensor_row[3]'"));
  $sql="select distinct \"HydroMetParamsTypeId\" FROM  \"$table\" a where (('20'||\"Year\"::text ||'-'|| \"Month\"::text ||'-'|| \"Day\" ::text ||' '|| \"Hour\"::text || ':' || \"Minute\" ::text || ':'|| \"Second\")::timestamp  BETWEEN ('$YF-$MF-$DF $h2:$min2:0') AND ('$Y-$M-$D $h:$min:0')) and a.\"StationId\"=$s_id  and \"HydroMetParamsTypeId\"=$col[0]  and \"sensortype\"='Virtual' order by 1 desc";
 }
 //echo "<br><br>$sql";
// echo pg_num_rows(pg_query($sql));
 //if(pg_num_rows(pg_query($sql))>0) if you don't want Battery(v) use this condition 
  if(pg_num_rows(pg_query($sql))>=0)
{

     ?>
   
     <th style="background-color:#539CCC;color:white;text-align:center;font-size: 13px;"><a style="color:white" href="javascript:PlotGraph
      ('<?php
       if (isset($sensor_row[0]))
        echo $sensor_row[0];?>',
      '<?php if (isset($sensor_row[0])){ echo $stn_name;}?>')">
      <?php 
      if (isset($sensor_row[0])){
       echo $sensor_row[0];if ($sensor_row[1]!="") echo" (".$sensor_row[1].")";}else{
        echo "$sen[0]";
     }?></a></th>
     

 
     
 <?php  
 } 
   }

  

?>
    </tr>
<?php

if (isset($result_set)) {


if(pg_num_rows($result_set)>0)
  {
  
  $settings=pg_fetch_array(pg_query("select \"DateFormat\",\"DecimalPlaces\" from \"tblLogo\""));  
        while($row=pg_fetch_row($result_set))
    {

 $row_count=1;

    ?>
            <tr>
            <td style="text-align:center;font-size: 13px;height: 14px;width:350px">
                          <?php if (isset($row[0])){ if (trim($row[0])!="icon.png")
                          {
                             $date = strtotime(trim($row[0]));
                         echo date(trim($settings[0]), $date); }}?></td>
                               
    <?php 
 

 $result_sensor1=pg_query("select \"Sensor\",\"Units\" from \"SensorValues\" where (\"StationFullName\"= '$stn_name')");



$sensor_row=pg_num_rows(($result_sensor1));

       for ($i=0; $i <$sensor_row; $i++) { 
    ?>                                
 <td style="text-align:center;font-size: 13px;height: 14px;"><?php if (isset($row[$row_count])){ echo number_format(floatval($row[$row_count]),$settings[1]);?>
 </td>

   
 <?php
 }
 $row_count++;
}




 ?>
  </tr>
        <?php

        

    
  }

    echo "</table></div>";
  


  }else {

    echo "<tr><td>No Data Found in Last 12 Hours!</td></tr></table></div>";

}

}



}

?>
</center>
</div>

</div>
</form>
