<html>
<head>
  <title></title>



<script src="http://dygraphs.com/1.0.1/dygraph-combined.js"></script>
 
<script src="http://cavorite.com/labs/js/dygraphs-export/dygraph-extra.js"></script>

    <link href="Styles/FontStyle.css" rel="stylesheet" type="text/css" />
   
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
 


<?php
ini_set('max_execution_time', 0); 
ini_set('memory_limit', '-1');

if (isset($_GET["PARAMS"]))
{
   $x=1; 
      $tempParam = trim($_GET["PARAMS"]);
          
$PARAMS=explode(';' ,$tempParam);
  //$stationlist=trim($_GET['station']);
 $noresult='';

            $tempstation=trim($_GET['station']);
$stationlist=explode(';' ,$tempstation);
$alarmvalues=array();
function graph($station,$vertualsensors,$realsensors,$v_sensor_names,$r_sensor_names)
{

       

   $array_v='';
   $myarray=array();


           $FY = trim($_GET["FY"]);
            $FY = str_replace('20', '',$FY);
            $FM = trim($_GET["FM"]);
            $FD = trim($_GET["FD"]);
            $TY = trim($_GET["TY"]);
            $TY = str_replace('20', '',$TY);
            $TM = trim($_GET["TM"]);
            $TD = trim($_GET["TD"]);
   
  $paramsshef=explode(';' ,$tempParam);

         $DateTime = new DateTime();
   $h2 = date('H');  
            if (isset($_GET['hours2'])) {
      
            $hours=$_GET['hours2'];
                
             $DateTime->modify("-$hours hours");

             $FY = trim($DateTime->format("Y"));
                 $FY = str_replace('20', '',$FY);
            $FM = trim($DateTime->format("m"));
            $FD = trim($DateTime->format("d"));
            $TY = trim(date('Y'));
               $TY = str_replace('20', '',$TY);
            $TM =  trim(date('m'));
            $TD = trim(date('d'));

            }
             $m = date('i');
              $h = $DateTime->format("H");
           $year = date('Y');  
		          
		   
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
	
 

$paramsshef=explode(";", $realsensors);
$HydroMetShefCodeCodition='';
for ($i=0; $i <count($paramsshef); $i++) { 
if (trim($paramsshef[$i])!="") {

    $result_set=  pg_query("SELECT \"HydroMetParamsTypeId\" FROM \"tblHydroMetParamsType\" where 
            \"HydroMetShefCode\" = '$paramsshef[$i]'");
          $row=pg_fetch_array($result_set);
$HydroMetShefCodeCodition.=" a.\"HydroMetParamsTypeId\"=''$row[0]'' or";
}
}

$paramsshefVirtual=explode(";", $vertualsensors);
$HydroMetShefCodeCoditionVirtual='';
for ($i=0; $i <count($paramsshefVirtual); $i++) { 
if (trim($paramsshefVirtual[$i])!="") {
  # code...

    $result_set=  pg_query("SELECT \"HydroMetParamsTypeId\" FROM \"tblHydroMetParamsType\" where 
            \"HydroMetShefCode\" = '$paramsshefVirtual[$i]'");
          $row=pg_fetch_array($result_set);
$HydroMetShefCodeCoditionVirtual.=" a.\"HydroMetParamsTypeId\"=''$row[0]'' or";
}
}

$HydroMetShefCodeCoditionVirtual=rtrim($HydroMetShefCodeCoditionVirtual ,'or');
$HydroMetShefCodeCodition=rtrim($HydroMetShefCodeCodition ,'or');




    $result_table=  pg_query("SELECT \"TableName\" FROM \"tblAllTables\" where \"TableName\" like '%".$station."_1%' or  \"TableName\" like '%".$station."_2%'");
    if (isset($result_table)) {

      $stn_id=  pg_query("SELECT \"StationId\" FROM \"tblStation\" where \"StationName\"='$station'");
$id_row=pg_fetch_array($stn_id);
$s_id= $id_row['StationId'];
$mykey=0;
  while ($tablerows=pg_fetch_array($result_table)) {
 
$table="'".$tablerows['TableName']."'";

  if (!isset($_GET['hours'])) {

         
               
           $sql_queryReal ="SELECT * FROM crosstab ('SELECT  (''20''||\"Year\"::text ||''-''||\"Month\"::text ||''-''|| \"Day\" ::text ||'' ''||\"Hour\"::text || '':'' || \"Minute\" ::text || 
'':'' ||\"Second\")::timestamp  as t,\"HydroMetParamsTypeId\", \"Value\" FROM \"'$table'\" a where
    ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY,$FM,$FD) AND ($TY,$TM,$TD))  and a.\"StationId\"=$s_id and a.\"Flag\"= ''1'' and ($HydroMetShefCodeCodition)   order by 1 desc'
   ,'SELECT distinct \"HydroMetParamsTypeId\" FROM \"'$table'\" as a where ($HydroMetShefCodeCodition) and a.\"Flag\"= ''1'''
   ) AS final_result(t timestamp";

for ($i=0; $i <count($paramsshef) ; $i++) { 
  if (trim($paramsshef[$i])!="") 
  $sql_queryReal .=",\"".$paramsshef[$i]."\" double precision";
}
$sql_queryReal.=")";
//echo "$sql_query";
             
                       $sql_queryVirtual ="SELECT * FROM crosstab ('SELECT  (''20''||\"Year\"::text ||''-''||\"Month\"::text ||''-''|| \"Day\" ::text ||'' ''||\"Hour\"::text || '':'' || \"Minute\" ::text || 
'':'' ||\"Second\")::timestamp  as t,\"HydroMetParamsTypeId\", \"VirtualValue\" FROM \"'$table'\" a where
    ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY,$FM,$FD) AND ($TY,$TM,$TD))  and a.sensortype=''Virtual'' and a.\"Flag\"= ''1'' and a.\"StationId\"=$s_id and ($HydroMetShefCodeCoditionVirtual)   order by 1 desc'
   ,'SELECT distinct \"HydroMetParamsTypeId\" FROM \"'$table'\" as a where a.sensortype=''Virtual'' and ($HydroMetShefCodeCoditionVirtual) and a.\"Flag\"= ''1'''
   ) AS final_result(t timestamp";

for ($i=0; $i <count($paramsshefVirtual) ; $i++) { 
  if (trim($paramsshefVirtual[$i])!="") 
  $sql_queryVirtual .=",\"".$paramsshefVirtual[$i]."\" double precision";
}
$sql_queryVirtual.=")";
               
           
                 

                 }
                 else
                 {
           
                  
                 $sql_queryReal="SELECT * FROM crosstab ('SELECT  (''20''||\"Year\"::text ||''-''|| \"Month\"::text ||''-''|| \"Day\" ::text ||'' ''|| \"Hour\"::text || '':'' || \"Minute\" ::text || 
'':'' ||\"Second\")::timestamp  as t,\"HydroMetParamsTypeId\", \"Value\" FROM  \"'$table'\" a where ((''20''||\"Year\"::text ||''-''|| \"Month\"::text ||''-''|| \"Day\" ::text ||'' ''|| \"Hour\"::text || '':'' || \"Minute\" ::text || '':'' || \"Second\")::timestamp  BETWEEN (''20$FY-$FM-$FD $h:$m:0'') AND (''20$TY-$TM-$TD $h2:$m2:0'')) and a.\"StationId\"=$s_id and a.\"Flag\"= ''1'' and ($HydroMetShefCodeCodition)   order by 1 desc'
   ,'SELECT distinct \"HydroMetParamsTypeId\" FROM \"'$table'\" as a where ($HydroMetShefCodeCodition) and a.\"Flag\"= ''1'''
   ) AS final_result(t timestamp";


for ($i=0; $i <count($paramsshef) ; $i++) { 
  if (trim($paramsshef[$i])!="") 
  $sql_queryReal .=",\"".$paramsshef[$i]."\" double precision";
}
$sql_queryReal.=")";


           $sql_queryVirtual="SELECT * FROM crosstab ('SELECT  (''20''||\"Year\"::text ||''-''|| \"Month\"::text ||''-''|| \"Day\" ::text ||'' ''|| \"Hour\"::text || '':'' || \"Minute\" ::text || 
'':'' ||\"Second\")::timestamp  as t,\"HydroMetParamsTypeId\", \"VirtualValue\" FROM  \"'$table'\" a where ((''20''||\"Year\"::text ||''-''|| \"Month\"::text ||''-''|| \"Day\" ::text ||'' ''|| \"Hour\"::text || '':'' || \"Minute\" ::text || '':'' || \"Second\")::timestamp  BETWEEN (''20$FY-$FM-$FD $h:$m:0'') AND (''20$TY-$TM-$TD $h2:$m2:0'')) and a.sensortype=''Virtual'' and a.\"Flag\"= ''1'' and a.\"StationId\"=$s_id and ($HydroMetShefCodeCoditionVirtual)   order by 1 desc'
   ,'SELECT distinct \"HydroMetParamsTypeId\" FROM \"'$table'\" as a where a.sensortype=''Virtual'' and ($HydroMetShefCodeCoditionVirtual) and a.\"Flag\"= ''1'''
   ) AS final_result(t timestamp";


for ($i=0; $i <count($paramsshefVirtual) ; $i++) { 
  if (trim($paramsshefVirtual[$i])!="") 
  $sql_queryVirtual .=",\"".$paramsshefVirtual[$i]."\" double precision";
}
$sql_queryVirtual.=")";



}
 
 if (trim($HydroMetShefCodeCoditionVirtual)!="") {
$sql_query="select t1.t";

for ($i=0; $i <count($paramsshef)-1 ; $i++) { 
  if (trim($paramsshef[$i])!="") 
  $sql_query .=",t1.\"".$paramsshef[$i]."\"" ;
}
for ($i=0; $i <count($paramsshefVirtual)-1 ; $i++) { 
  if (trim($paramsshefVirtual[$i])!="") 
  $sql_query .=",t2.\"".$paramsshefVirtual[$i]."\"";
}

$sql_query=rtrim($sql_query,",");

$sql_query.=" from (".$sql_queryReal.") t1 FULL OUTER JOIN (".$sql_queryVirtual.") t2 on t1.t=t2.t order by t1.t desc";

}
else{
  $sql_query=$sql_queryReal;
}
  
  if (trim($HydroMetShefCodeCodition)=='') {
$sql_query=$sql_queryVirtual;
}  
  //echo "$sql_query<br><br><br>";
  $result_set2= pg_query($sql_query);    

if (pg_num_rows($result_set2)>0) 
{

 $array_v='"Date';
  
 
      


$HydroMetShefCodeCodition=str_replace("''", "'", $HydroMetShefCodeCodition);
$row_c_ds_r=pg_query("SELECT distinct \"HydroMetParamsTypeId\" FROM \"$table\" as a where ($HydroMetShefCodeCodition) and a.\"Flag\"= '1'");

$tem_ds=pg_query("SELECT distinct \"HydroMetParamsTypeId\" FROM \"$table\" as a where ($HydroMetShefCodeCodition) and a.\"Flag\"= '1'");
while ($h_id=pg_fetch_array($tem_ds)) {
$shef=pg_fetch_array(pg_query("select \"HydroMetShefCode\" from \"tblHydroMetParamsType\" where \"HydroMetParamsTypeId\"='$h_id[0]'"));

$row=pg_fetch_array(pg_query("select \"Sensor\" from \"SensorValues\" where \"StationFullName\"='$stn_name' and \"SHEF\"='$shef[0]' and \"SensorType\"='Real'"));

 $array_v.=','.$row[0];
}


$HydroMetShefCodeCoditionVirtual=str_replace("''", "'", $HydroMetShefCodeCoditionVirtual);
if (trim($HydroMetShefCodeCoditionVirtual)!="") {
  # code...

$row_c_ds_v=pg_query("SELECT distinct \"HydroMetParamsTypeId\" FROM \"$table\" as a where a.sensortype='Virtual' and ($HydroMetShefCodeCoditionVirtual) and a.\"Flag\"= '1'");


$tem_ds=pg_query("SELECT distinct \"HydroMetParamsTypeId\" FROM \"$table\" as a where a.sensortype='Virtual' and ($HydroMetShefCodeCoditionVirtual) and a.\"Flag\"= '1'");

while ($h_id=pg_fetch_array($tem_ds)) {
$shef=pg_fetch_array(pg_query("select \"HydroMetShefCode\" from \"tblHydroMetParamsType\" where \"HydroMetParamsTypeId\"='$h_id[0]'"));

$row=pg_fetch_array(pg_query("select \"Sensor\" from \"SensorValues\" where \"StationFullName\"='$stn_name' and \"SHEF\"='$shef[0]' and \"SensorType\"='Virtual'"));
 $array_v.=','.$row[0];
}
}
 $array_v.= "\n".'"';  
 while ($rows=pg_fetch_array($result_set2)) {
     
                   
                   $a= $rows['t'];
                   if (trim( $a)!="") {
                    
   $array_v.='"'.$a;
   $row_count=1;
  for ($i=0; $i <pg_num_rows($row_c_ds_r); $i++) { 
 

   $array_v.=','.$rows[$row_count];
  $row_count++;
}

if (trim($HydroMetShefCodeCoditionVirtual)!="") {

   for ($i=0; $i <pg_num_rows($row_c_ds_v); $i++) { 
  $array_v.=','.$rows[$row_count];
  $row_count++;
}
    } 
                      
$array_v.="\n".'"';
}
}

}

}                     
}



return $array_v;
}






$arrayv=array();
$m=0;

$tempParam = trim($_GET["PARAMS"]);
          
$PARAMS=explode(';' ,$tempParam);


for ($j=0; $j <count($stationlist)-1; $j++) 
{ 
 $stn_name=trim($stationlist[$j]);

$realsensors='';
$vertualsensors='';

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


$temp= graph($stn_name,$vertualsensors,$realsensors,$v_sensor_names,$r_sensor_names);
$arrayv[$m]=$temp;


$m++;

}


}

?>
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>
<script >

function zoomIn(event)
{
  //alert(event);

 var w= document.getElementById('graph1');

 
}

window.onload=function()
{
      var pausecontent = new Array();
    <?php for($i=0;$i<count($arrayv);$i++){ ?>
        pausecontent.push('<?php echo json_encode(str_replace('"', '', $arrayv[$i]));?>');
    <?php } ?>
//alert(pausecontent);
var num2='<?php echo count($stationlist)-1;?>';
  
   

 var stn= new Array();
    <?php for($i=0;$i<count($stationlist);$i++){ ?>
        stn.push('<?php echo $stationlist[$i]; ?>');
    <?php } ?>

    var n=1;
     var n4=0;

for (var j = 0 ; j <num2; j++) {
if(pausecontent[n4]!=='"Date"')
{

    document.getElementById('jqxSplitter').innerHTML+='<br><div style="width:100%;height:30px;background-color:#539CCC"><b style="color:white;float:left">Sensors at Station '+stn[j]+'</b><p style="float:right"><a   title="Download!" id="downloadgraph'+n+'" download="GraphImage.png"><img src="StationImages/downloadicon.png"></a> <a style="margin-left:3px;" title="Full Screen!" data-toggle="modal" data-target="#myModal'+n+'"><img src="fullscreen.png"></a></p></div><br><div style="width: 100%;height: 300px;margin: 0 auto" id="graph'+n+'" name="graph'+n+'"><center><img src="StationImages/waitingIcon.gif"></center></div><br> ';


document.getElementById('D_img').innerHTML+='<img id="img'+n+'" style="width:1px;height:1px">';

document.body.innerHTML+='<div class="modal fade" data-backdrop="false"  id="myModal'+n+'" role="dialog" style="background-color: white" > <div style="width:100%;height:30px;background-color:#539CCC"><b style="color:white">Sensors at Station '+stn[j]+'</b>    <button type="button" style="float: right;" class="close" data-dismiss="modal">&times;</button></div> <div style="width: 98%;height: 100%;overflow-y: scroll;" id="graph2'+n+'" name="graph2'+n+'"></div></div>';
}
    n++;n4++;



}
     var n2=1;
 
   
  for (var i = 0; i <pausecontent.length ; i++) {
 
if (pausecontent[i]!='"Date"') {
    myGraph('graph'+n2,'graph2'+n2,i,pausecontent[i]);  
    n2++;
  
   }
}
       
}

 function myGraph(graphdiv,graphdiv2,z,resultArray) {

    try 
    {
try
{
var g=  new Dygraph(document.getElementById(graphdiv),
resultArray , {
                         
              
           
                      xlabel: "Hours/Date",
    ylabel: "Values",
    legend:"always",
      drawPoints: true,
        showRangeSelector: true,
                     connectSeparatedPoints: true,

                        
                        }
           );

            
try{
var id1=z+1;
var id2="#downloadgraph"+id1;
var id3="img"+id1;


$(id2).click(function(){

   var img2 = document.getElementById(id3);
// These are the default options
var options = {
    //Texts displayed below the chart's x-axis and to the left of the y-axis 
    titleFont: "bold 18px serif",
    titleFontColor: "black",

    //Texts displayed below the chart's x-axis and to the left of the y-axis 
    axisLabelFont: "bold 14px serif",
    axisLabelFontColor: "black",

    // Texts for the axis ticks
    labelFont: "normal 12px serif",
    labelFontColor: "black",

    // Text for the chart legend
    legendFont: "bold 12px serif",
    legendFontColor: "black",

    legendHeight: 20    // Height of the legend area
}; 
    //g.resetZoom();
  
Dygraph.Export.asPNG(g, img2, options);
document.getElementById('downloadgraph'+id1).href=img2.src;

//window.location.href = img2.src.replace('image/png','image/octet-stream');

});
}catch(exxxx)
{}


              g.dyOptions(labelsUTC = TRUE);


               }catch(ex1) {}

try{



 var g2=  new Dygraph(document.getElementById(graphdiv2),
resultArray , {
                         
              
               showRangeSelector: true,
                      xlabel: "Hours/Date",
    ylabel: "Values",
      drawPoints: true,
     legend: "always",             
                            connectSeparatedPoints: true,
                 
                        }
           );

              g2.dyOptions(labelsUTC = TRUE); }catch(ex1) {}
    g2.resize(1500, 700);
             
    }

  catch(ex)
    {
      document.getElementById(graphdiv).style="float:left";
       document.getElementById(graphdiv).innerHTML='No Data Found!';

    }
    
     }    


</script>
<script type="text/javascript">
  $(document).ready(function(){
      if ( $('[type="date"]').prop('type') != 'date' ) {

    $('[type="date"]').datepicker();

}
});
</script>
<style type="text/css">
  
  .dygraph-legend {
  background: transparent !important;
    left: 80px !important;
 width: 80% !important;
}
</style>
</head>
<body>
<center>
<div id='jqxSplitter' style="width: 98%">


</div>
<div id="D_img"></div>
</center>
</body>
</html>
