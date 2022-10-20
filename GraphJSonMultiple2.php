

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
ini_set('max_execution_time', 0); 
ini_set('memory_limit', '-1');

if (isset($_GET["PARAMS"]))
{

      $tempParam = trim($_GET["PARAMS"]);
          
$PARAMS=explode(';' ,$tempParam);
  //$stationlist=trim($_GET['station']);
 $noresult='';

            $tempstation=trim($_GET['station']);
$stationlist=explode(';' ,$tempstation.";");


function graph($i,$station)
{

       
//echo "Staion inside function".$station;


   $array_v='';


           $FY = trim($_GET["FY"]);
            $FY = substr($FY,-2);
            $FM = trim($_GET["FM"]);
            $FD = trim($_GET["FD"]);
            $TY = trim($_GET["TY"]);
            $TY = substr($TY,-2);
            $TM = trim($_GET["TM"]);
            $TD = trim($_GET["TD"]);
   
    $tempParam = trim($_GET["PARAMS"]);
          
$PARAMS=explode(';' ,$tempParam);

               $DateTime = new DateTime();
   $h2 = date('H');  
   $m2=date('m');
            if (isset($_GET['hours2'])) {
      
            $hours=$_GET['hours2'];
                
             $DateTime->modify("-$hours hours");

            }
             $m = date('m');
              $h = $DateTime->format("H");

            
           
			
          //   echo "$h  $h2 $m";

 //echo $DateTime->format("H:i:s");

//$i=0;
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
 
 
			 
   $result=  pg_query("SELECT \"SHEF\",\"SensorType\"  FROM \"SensorValues\" where  \"Sensor\" = '$PARAMS[$i]' and \"StationFullName\"='$stn_name'");
    
   $sensorrow=pg_fetch_array($result);
   $valuecol="Value";
    if(trim($sensorrow['SensorType'])=='Virtual')
    {
   $valuecol="VirtualValue";
    }
    else
    {
   $valuecol="Value";
    }

      
 
   $PARAMS=trim($sensorrow['SHEF']);
   if($PARAMS=="")
	   return;

          $result_set=  pg_query("SELECT \"HydroMetParamsTypeId\" FROM \"tblHydroMetParamsType\" where 
          	\"HydroMetShefCode\" = '$PARAMS'");
          $row=pg_fetch_array($result_set);
$PARAMSID=$row['HydroMetParamsTypeId'];
    $result_table=  pg_query("SELECT * FROM \"tblAllTables\" where \"TableName\" like '%".$station."%'");
    if (isset($result_table)) {

      $stn_id=  pg_query("SELECT \"StationId\" FROM \"tblStation\" where \"StationName\"='$station'");
$id_row=pg_fetch_array($stn_id);
$s_id= $id_row['StationId'];

  while ($tablerows=pg_fetch_array($result_table)) {
 
$table="'".$tablerows['TableName']."'";
//echo "$table";
  if (!isset($_GET['hours'])) {
                   $result_set2=       pg_query("select \"Year\", \"Month\", \"Day\", \"ReadingId\",  \"Hour\", \"Minute\", \"Second\", \"HydroMetShefCode\", \"$valuecol\" from \"$table\" a, \"tblHydroMetParamsType\" b   where b.\"HydroMetParamsTypeId\" = a.\"HydroMetParamsTypeId\" and ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY,$FM,$FD) AND ($TY,$TM,$TD))  and a.\"HydroMetParamsTypeId\"='$PARAMSID' and a.\"StationId\"= '$s_id' and a.\"Flag\"= '1'  order by \"HydroMetShefCode\", \"Year\", \"Month\", \"Day\", \"Hour\", \"Minute\", \"Second\"");

                 }
                 else
                 {
                   $sql_query="select \"Year\", \"Month\", \"Day\",\"ReadingId\", \"Hour\", \"Minute\", \"Second\",  \"HydroMetShefCode\", \"$valuecol\" from \"$table\" a, \"tblHydroMetParamsType\" b where b.\"HydroMetParamsTypeId\"= a.\"HydroMetParamsTypeId\" and (('20'||\"Year\"::text ||'-'|| \"Month\"::text ||'-'|| \"Day\" ::text ||' '|| \"Hour\"::text || ':' || \"Minute\" ::text || ':' || \"Second\")::timestamp  BETWEEN ('20$FY-$FM-$FD $h:$m:0') AND ('20$TY-$TM-$TD $h2:$m2:0')) and a.\"HydroMetParamsTypeId\"='$PARAMSID' and a.\"StationId\"= '$s_id' and a.\"Flag\"= '1' order by \"HydroMetShefCode\", \"Year\", \"Month\", \"Day\", \"Hour\", \"Minute\", \"Second\"";
 $result_set2=      pg_query($sql_query);
                 
                       
                 }
              
if (pg_num_rows($result_set2)>0) {

$i=0;

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
                   $Value=$rows[$valuecol];
                   $a= date($dates);
   
 
   $array_v .=   $a.",".$Value.",";

}


}
   }   

   

   
}
global $noresult;
if ($array_v=="") {
//$noresult="No Data Sensor"+$PARAMS[$i]+"at Station "+$station+" , ";
}

return $array_v;
}

//echo "$noresult";


$arrayv=array();
$m=0;
for ($j=0; $j <count($stationlist)-1; $j++) { 


for ($i=0; $i <count($PARAMS)-1 ; $i++) { 

$shef=getStationShef($stationlist[$j]);
$temp= graph($i,$shef);
$arrayv[$m]=$temp;
$m++;

//var_dump($arrayv);
//echo "$m ,$stationlist[$j]";

}
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
 w.style.zoom="200%";
// w.width( w.width()*2);
  //var h=  document.getElementById('graph1');
   //h.height( h.height()*2);
}

window.onload=function()
{
      var pausecontent = new Array();
    <?php for($i=0;$i<count($arrayv);$i++){ ?>
        pausecontent.push('<?php echo $arrayv[$i]; ?>');
    <?php } ?>
//alert(pausecontent);
  var num='<?php echo count($PARAMS)-1;?>';
var num2='<?php echo count($stationlist)-1;?>';
  var param = new Array();
    <?php 
for($i=0;$i<count($PARAMS);$i++){ ?>
        param.push('<?php echo $PARAMS[$i]; ?>');
    <?php } ?>
 var stn= new Array();
    <?php for($i=0;$i<count($stationlist);$i++){ ?>
        stn.push('<?php echo $stationlist[$i]; ?>');
    <?php } ?>
    var n=1;
     var n4=0;

for (var j = 0 ; j <num2; j++) {
  

  for (var i = 0; i <num; i++) {
if(pausecontent[n4]!="")
{
  $("#exporttopdf").css("display",""); 
    document.getElementById('jqxSplitter').innerHTML+='  <div style="width:100%;height:30px;background-color:#539CCC"><b style="color:white">Sensor '+param[i]+' at Station '+stn[j]+'</b><p style="float:right"><a   title="Download!" id="downloadgraph'+n+'" download="GraphImage.png"><img src="StationImages/downloadicon.png"></a><a style="margin-left:3px" title="Full Screen!"  data-toggle="modal" data-target="#myModal'+n+'"><img src="fullscreen.png"></a></p></div><br><div style="width: 100%;height: 200px;margin: 0 auto" id="graph'+n+'" name="graph'+n+'"></div><br> ';

document.getElementById('D_img').innerHTML+='<img id="img'+n+'" style="width:1px;height:1px">';

document.getElementById('models_con').innerHTML+='<div class="modal fade" data-backdrop="false"  id="myModal'+n+'" role="dialog" style="background-color: white" > <div style="width:100%;height:30px;background-color:#539CCC"><b style="color:white">Sensor '+param[i]+' at Station '+stn[j]+'</b>    <button type="button" style="float: right;" class="close" data-dismiss="modal">&times;</button></div><center> <div style="width: 95%;height: 105%;overflow-y: scroll;" id="graph2'+n+'" name="graph2'+n+'"></div></center></div>';

    n++;
}
n4++;
}
}
     var n2=1;
     var n3=0;
   
for (var j = 0 ; j <num2; j++) {
   for (var i = 0; i <num; i++) {
  if(pausecontent[n3]!="")
{
    myGraph('graph'+n2,'graph2'+n2,n3,pausecontent);  
    n2++;
  }
    n3++;
}
  }  // myGraph('graph1');  
     
}
var id1=1;
 function myGraph(graphdiv,graphdiv2,z,pausecontent) {

    try {
     // var tem = '<?php //echo json_encode($arrayv); ?>';

    //alert(tem);
var resultArray= pausecontent[z].replace('"');//'<?php //echo str_replace('"', '', $arrayv[$z++]); ?>';


var res=resultArray.split(",");  

var ress='"Date,Value\n"';

for (var i = 0; i <res.length -1; i=i+2)
 { 
      ress+='"'+new Date(res[i])+","+res[i+1]+'\n"';

 }

 
try{



 var g=  new Dygraph(document.getElementById(graphdiv),
ress , {
                         
              
               showRangeSelector: true,
                      xlabel: "Hours/Date",
    ylabel: "Values",
    legend:"always"           
                        
                        }
           );



try{

var id2="downloadgraph"+id1;
var id3="img"+id1;


//$("#"+id2).click(function(){

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
   // g.resetZoom();
  
Dygraph.Export.asPNG(g, img2, options);
document.getElementById(id2).href=img2.src;
id1++;
//});
}catch(exxxx)
{}

              g.dyOptions(labelsUTC = TRUE); }catch(ex1) {}

try{



 var g2=  new Dygraph(document.getElementById(graphdiv2),
ress , {
                         
              
               showRangeSelector: true,
                      xlabel: "Hours/Date",
    ylabel: "Values",
     legend: "follow"             
                        
                        }
           );

              g2.dyOptions(labelsUTC = TRUE); }catch(ex1) {}
    g2.resize(1340, 600);
             
    }

  catch(ex)
    {
 
    }
    
     }    


</script>




<div class="container">

<img  src="assets/images/pdf.png" id="exporttopdf" style="width: 25;height: 25;float: right;display: none;" onclick="demoFromHTML()" title="export to pdf!" >
   <br>

<div id='jqxSplitter'>

<br>




</div>
<div id="D_img"></div>
</div>
<div id="models_con"></div>
<link rel="stylesheet" href="assets/jquery-ui.css">

    <script type="text/javascript" src="assets/jquery.js"></script>
<script type="text/javascript" src="assets/jquery-ui.js"></script>

 <script type="text/javascript">
$(function() 
{
 $( "#Sname" ).autocomplete({
  source: 'autocompelete.php',
   close: function( event, ui ) {  getSensors(); }
 });
});

$(document).ready(function(){
      if ( $('[type="date"]').prop('type') != 'date' ) {
    $('[type="date"]').datepicker();
}
  
});
</script>
 
<?php
 function getStationShef($Name)
{
  $stn_name="";
  $stn_types_set=pg_query("select \"StationType\" from \"tblStationType\"");
while ($row_types=pg_fetch_array($stn_types_set)) {
$table=str_replace(" ", "_", $row_types[0]);
 $stn_set= pg_query("select \"Station_Shef_Code\" from \"$table\" where \"Station_Full_Name\"='$Name'");
 if (pg_num_rows($stn_set)>0) {
   # code...
 $row=pg_fetch_array($stn_set);
$stn_name=$row[0];
 }

}

 return $stn_name;
} ?>


