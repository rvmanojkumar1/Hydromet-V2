
<meta http-equiv="refresh" content="10" />
<br>
<script src="http://dygraphs.com/1.0.1/dygraph-combined.js"></script>
 
<script src="http://cavorite.com/labs/js/dygraphs-export/dygraph-extra.js"></script>


    <link href="Styles/FontStyle.css" rel="stylesheet" type="text/css" />
    <!--<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" />-->
    <script type="text/javascript" src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script type="text/javascript" src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="Scripts/jstree.min.js" type="text/javascript"></script>
    
   <!-- =====================Graph ===============================-->



    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script> 
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
        <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <script src="Scripts/jquery.canvasjs.min.js"></script>
   
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.2/dist/leaflet.css" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous" />
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<?php
include_once("database.php");
$array_v='';

           $FY ='17';
            $FY = str_replace('20', '',$FY);
            $FM ='4';
            $FD = '28';
            $TY = '17';
            $TY = str_replace('20', '',$TY);
            $TM = '4';
            $TD = '28';
            $PARAMS = "AirTemp";
          
            $station="BRHYS";
$h2='10';$h='15';

          $result_set=  pg_query("SELECT \"HydroMetParamsTypeId\" FROM \"tblHydroMetParamsType\" where 
          	\"HydroMetParamsName\" = '$PARAMS'");
          $row=pg_fetch_array($result_set);
$PARAMS=$row['HydroMetParamsTypeId'];


    $result_table=  pg_query("SELECT * FROM \"tblAllTables\" WHERE \"TableName\" like '%".$station."%'");
    if (isset($result_table)) {
      $stn_id=  pg_query("SELECT \"StationId\" FROM \"tblStation\" where \"StationName\"='$station'");
$id_row=pg_fetch_array($stn_id);
$s_id= $id_row['StationId'];
  while ($tablerows=pg_fetch_array($result_table)) {
     
$table="'".$tablerows['TableName']."'";

                        $result_set2=  pg_query("SELECT T.\"Year\", T.\"Month\", T.\"Day\", T.\"ReadingId\", T.\"Hour\", T.\"Minute\", T.\"Second\", T.\"HydroMetParamsName\", T.\"Value\" FROM (select \"Year\", \"Month\", \"Day\", \"ReadingId\",  \"Hour\", \"Minute\", \"Second\", \"HydroMetParamsName\", \"Value\" from \"$table\" a, \"tblHydroMetParamsType\" b   where b.\"HydroMetParamsTypeId\" = a.\"HydroMetParamsTypeId\" and ((\"Year\" ,\"Month\", \"Day\",\"Hour\") BETWEEN ($FY,$FM,$FD,1) AND ($TY,$TM,$TD,$h2)) and a.\"HydroMetParamsTypeId\"='$PARAMS' and a.\"StationId\"= '$s_id'  order by \"HydroMetParamsName\", \"Year\", \"Month\", \"Day\", \"Hour\", \"Minute\", \"Second\") T where \"Day\"='$FD' and \"Hour\"<='$h' or \"Day\"!='$FD'");
                 
               
//and ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY,$FM,$FD) AND ($TY,$TM,$TD)) 
           

if (pg_num_rows($result_set2)>0) {
$i=0;
 // $array_v.= "[";
while ($rows=pg_fetch_array($result_set2)) {
$Day=$rows['Day'];
$Month=$rows['Month'];
if(strlen($rows['Month'])===1)
{
$Month='0'.$rows['Month'];
}
 if(strlen($rows['Day'])===1)
{
  $Day='0'.$rows['Day'];
}                  $dates='20'.$rows['Year'].'/'.$Month.'/'.$Day.' '.$rows['Hour'].':'.$rows['Minute'].':'.$rows['Second'];
                   $Value=$rows['Value'];
                   $a= date($dates);
   
  //  $array_v[$i++] = array(array($a),array($Value )); 

       //    echo "[".$a.",".$Value."]";   
        //$array_v .=   "[".$a.",".$Value."],";   
      $array_v .=   $a.",".$Value.",";

}

 //$array_v.='[2017/2/21 11:0:0,19.86]'."]";
}
   }   
   }  
 

 
?>
<script >


window.onload = function () {

 var resultArray= '<?php echo json_encode(str_replace('"', '', $array_v)); ?>';
var res=resultArray.split(",");  

var ress='"Date,Value\n"';

for (var i = 0; i <res.length -1; i=i+2)
 { 
  
    ress+='"'+new Date(res[i])+","+res[i+1]+'\n"';

 }
//ress+='';
//ress=ress.replace('"','');

 var temp=<?php echo $PARAMS; ?>;
var l=["Date",temp];
//ress+='",,2,2\n"';
  
                 try
{



               var g2=  new Dygraph(document.getElementById("graph"),ress , {
                         
              
               showRangeSelector: true,  
            xlabel: "Hours/Date",
    ylabel: "Values",  
              legend: "always",

                        
                        }
           );
  g2.dyOptions(labelsUTC = TRUE);   
  }
  catch(ex)
  {

  }
          
}


</script>
<style type="text/css">
  th{
    margin: 0 auto;
 vertical-align: middle;
text-align: center;

  }
</style>
<div style="width: 95%;height: 45%;overflow-y: scroll;margin: 0 auto" id="graph" name='graph'>
</div>
<br>
<br>
<center>
<div style="width: 95%;height: 50%;overflow-y: scroll;overflow-x: scroll;">
  <table style="width: 100%;" border="1" class="table table-responsive table-hover">
    <tr>
      <th rowspan="2" style="background-color:#F3EFEF">Station Code</th>
      <th rowspan="2" style="background-color:#F3EFEF">Station Name</th>

  
      <th colspan="2" style="background-color:#D9D9D9"><center>Capacity</center></th>
         </tr>
         <tr>
      <th style="background-color:#F3EFEF">Date & Time</th>
      <th style="background-color:#F3EFEF">Precipitation (in)</th>
 
</tr>


   <?php
 $result_table=  pg_query("SELECT * FROM \"tblAllTables\"  WHERE \"TableName\" like '%".$station."%'");
    if (isset($result_table)) {
      $stn_id=  pg_query("SELECT \"StationId\" FROM \"tblStation\" where \"StationName\"='$station'");
$id_row=pg_fetch_array($stn_id);
$s_id= $id_row['StationId'];
  while ($tablerows=pg_fetch_array($result_table)) {

$table="'".$tablerows['TableName']."'";

 $result_set=      pg_query("
SELECT T.\"Year\", T.\"Month\", T.\"Day\", T.\"ReadingId\", T.\"Hour\", T.\"Minute\", T.\"Second\", T.\"HydroMetParamsName\", T.\"Value\" FROM (select \"Year\", \"Month\", \"Day\", \"ReadingId\",  \"Hour\", \"Minute\", \"Second\", \"HydroMetParamsName\", \"Value\" from \"$table\" a, \"tblHydroMetParamsType\" b   where b.\"HydroMetParamsTypeId\" = a.\"HydroMetParamsTypeId\" and ((\"Year\" ,\"Month\", \"Day\",\"Hour\") BETWEEN ($FY,$FM,$FD,1) AND ($TY,$TM,$TD,$h2)) and a.\"HydroMetParamsTypeId\"='$PARAMS' and a.\"StationId\"= '$s_id'  order by \"HydroMetParamsName\", \"Year\", \"Month\", \"Day\", \"Hour\", \"Minute\", \"Second\") T where \"Day\"='$FD' and \"Hour\"<='$h' or \"Day\"!='$FD'");
                 
//$station_result=pg_query("select \"Station_Full_Name\" from \"\");

  if(pg_num_rows($result_set)>0)
  {

        while($row=pg_fetch_row($result_set))
    {
?>
<tr>
<td><?php echo $station?></td>
<td><?php ?></td>
<td><?php echo "$row[0]-$row[1]-$row[3]:$row[4]-$row[5]-$row[6]";?></td>
<td><?php ?></td>

</tr>

<?php

      }
    }
  }
}
  ?>

  </table>
</div>
  </center>


