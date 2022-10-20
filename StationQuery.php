<?php
								include("includes/link.php");
							?>
								<?php
								include("includes/header.php");
								include_once 'database.php';

                      date_default_timezone_set('Asia/Kolkata'); 
							?>
<br>

<form action="StationQuery.php">
<label style="font-size: 30px;margin-left: 25px">Real-Time Event /Hourly Data</label>
<p style="margin-left: 25px">Enter Station name or Station Shef Code</p>
<div class="row" style="margin-left: 25px">
<div class="col-md-4">
	<input type="text" name="stn_id" class="form-control" required />
	</div>
	<div class="col-md-4">
	<input type="submit" name="" value="Get Data" class="btn btn-default">
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
                
                var currentdate = new Date();

                yearFrom = currentdate.getFullYear();
                monthFrom = currentdate.getMonth() + 1;
                dayFrom = currentdate.getDate()-7;

                yearTo = currentdate.getFullYear();
                monthTo = currentdate.getMonth() + 1;
                dayTo = currentdate.getDate();
     
          //    window.location.href= 'Graph.php?FY=' + yearFrom + "&FM=" + monthFrom + "&FD=" + dayFrom + '&TY=' + yearTo + "&TM=" + monthTo + "&TD=" + dayTo + "&PARAMS=" + params+"&hours="+hours+"&station="+station+"&hours2="+hours2;

           window.location.href= 'Graph.php?FY=' + yearFrom + "&FM=" + monthFrom + "&FD=" + dayFrom + '&TY=' + yearTo + "&TM=" + monthTo + "&TD=" + dayTo + "&PARAMS=" + params+"&station="+station;
  
  
}
</script>


<?php

$Y=date('Y');
$M='11';//date('m');
$D='13';//date('d');
$temp=str_split($Y);
$Y=$temp[2].$temp[3];
$h=date('h');
$h2=$h-12;
if (isset($_GET['stn_id'])) {
$station=$_GET['stn_id'];
$stn_name='';
$r_stn_name;
  $dataU=strtoupper($station);        

$r=pg_query("select \"StationType\" from \"tblStationType\"");
 if (isset($r)) {
while ($row=pg_fetch_array($r)) {


$table=$row['StationType'];
$r_stn_name=pg_query("select \"Station_Full_Name\" from \"$table\"  WHERE \"Station_Shef_Code\" like '%".$station."%'");


if (pg_num_rows($r_stn_name)) {

	$r2=pg_fetch_array($r_stn_name);
	$stn_name=$r2['Station_Full_Name'];
}
}
    
  }

if ($stn_name=='') {
$stn_name=$station;
}
echo "$stn_name";

$result_sensor1=pg_query("select \"Sensor\" from \"SensorValues\" where \"StationFullName\" like '$stn_name'");
if(pg_num_rows($result_sensor1)>0)
{
  echo "<table style='width:20%;float:right'>";
while ($sensor_row=pg_fetch_array($result_sensor1)) {
     ?><th><a href="javascript:PlotGraph('<?php echo $sensor_row[0];?>','<?php echo $station;?>')"><?php echo $sensor_row[0]; ?></a></th>

     <?php

}
  echo "</table>";
}
?>
<div style="overflow:scroll;height: 500px;width: 100%">
  <table align="center" style="width:95%" class="table table-responsive">
<tr>
    <th style="background-color:#539CCC;color:white;text-align:center;font-size: 13px">Year</th>
     
    <th  style="background-color:#539CCC;color:white;text-align:center;font-size: 13px">Month</th>
  <th  style="background-color:#539CCC;color:white;text-align:center;font-size: 13px">Day</th>
    <th  style="background-color:#539CCC;color:white;text-align:center;font-size: 13px">Hour</th>
  <th  style="background-color:#539CCC;color:white;text-align:center;font-size: 13px">Minute</th>
      <th  style="background-color:#539CCC;color:white;text-align:center;font-size: 13px">Second</th>
  <th  style="background-color:#539CCC;color:white;text-align:center;font-size: 13px">Sensor</th>
   
    <th  style="background-color:#539CCC;color:white;text-align:center;font-size: 13px">Value</th>

    </tr>
<?php
$result_sensor=pg_query("select \"SHEF\" from \"SensorValues\" where \"StationFullName\" like '$stn_name'");
if(pg_num_rows($result_sensor)>0)
{
while ($sensor_row=pg_fetch_array($result_sensor)) {
	$p=$sensor_row['SHEF'];
$result_prams=pg_query("select \"HydroMetParamsTypeId\" from \"tblHydroMetParamsType\" where \"HydroMetShefCode\"='$p'");
$param_row=pg_fetch_array($result_prams);
$PARAMS=$param_row['HydroMetParamsTypeId'];

 $result_table=  pg_query("SELECT * FROM \"tblAllTables\"  WHERE \"TableName\" like '%".$station."%'");
    if (isset($result_table)) {

      $stn_id=  pg_query("SELECT \"StationId\" FROM \"tblStation\" where \"StationName\"='$station'");
$id_row=pg_fetch_array($stn_id);
$s_id= $id_row['StationId'];
  while ($tablerows=pg_fetch_array($result_table)) {
     
$table="'".$tablerows['TableName']."'" ;
 $result_set=       pg_query("SELECT T.\"Year\", T.\"Month\", T.\"Day\", T.\"ReadingId\", T.\"Hour\", T.\"Minute\", T.\"Second\", T.\"HydroMetShefCode\", T.\"Value\" FROM (select \"Year\", \"Month\", \"Day\", \"ReadingId\",  \"Hour\", \"Minute\", \"Second\", \"HydroMetShefCode\", \"Value\" from \"$table\" a, \"tblHydroMetParamsType\" b   where b.\"HydroMetParamsTypeId\" = a.\"HydroMetParamsTypeId\" and ((\"Year\" ,\"Month\", \"Day\",\"Hour\") BETWEEN ($Y,$M,$D,$h2) AND ($Y,$M,$D,$h)) and a.\"HydroMetParamsTypeId\"='$PARAMS' and a.\"StationId\"= '$s_id'  order by \"HydroMetShefCode\", \"Year\", \"Month\", \"Day\", \"Hour\", \"Minute\", \"Second\") T where \"Day\"='$D' and \"Hour\"<='$h'");

 
}
}
?>

<?php
if (isset($result_set)) {
 $temp=array();
if(pg_num_rows($result_set)>0)
  {

        while($row=pg_fetch_row($result_set))
    {
     array_push($temp,array("$row[0]$row[1]$row[2]$row[3]$row[4]$row[5]$row[6]"=>"$row[8]"));

    ?>
            <tr>
            <td style="text-align:center;font-size: 13px;height: 14px"><?php echo $row[0]; ?></td>
        <td style="text-align:center;font-size: 13px;height: 14px"><?php echo $row[1]; ?></td>
            <td style="text-align:center;font-size: 13px;height: 14px"><?php echo $row[2]; ?></td>
               
                    <td style="text-align:center;font-size: 13px;height: 14px"><?php echo $row[4]; ?></td>
                        <td style="text-align:center;font-size: 13px;height: 14px"><?php echo $row[5]; ?></td>
                            <td style="text-align:center;font-size: 13px;height: 14px"><?php echo $row[6]; ?></td>
                                <td style="text-align:center;font-size: 13px;height: 14px"><?php echo $row[7]; ?></td>
                                  
 <td style="text-align:center;font-size: 13px;height: 14px"><?php echo $row[8]; ?></td>

            </tr>
        <?php
    }
  }
//var_dump($temp);
//echo "value of :".$temp[0]['17111369282000'];
}}

}
}

?>
</table>
</div>
</form>