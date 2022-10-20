
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

ini_set('max_execution_time', 0); 
ini_set('memory_limit', '-1');

      $tempParam = "AirTemp;RainTip;SnowH2O;";
          
$PARAMS=explode(';' ,$tempParam);
  //$stationlist=trim($_GET['station']);
 $noresult='';

            $tempstation="BRHYS;";

$stationlist=explode(';' ,$tempstation);

    function graph($i)
{

       



   $array_v='';

             $FY ='17';
            $FY = str_replace('20', '',$FY);
            $FM ='4';
            $FD = '28';
            $TY = '17';
            $TY = str_replace('20', '',$TY);
            $TM = '4';
            $TD = '29';
       
      $tempParam = "AirTemp;RainTip;SnowH2O";
            $station="BRHYS";
$PARAMS=explode(';' ,$tempParam);


         $DateTime = new DateTime();
   $h2 = date('H');  
            if (isset($_GET['hours'])) {
      
            $hours=$_GET['hours'];
                
             $DateTime->modify("-$hours hours");

            }
             $m = date('i');
                   // $s = date('s');
              $h = $DateTime->format("H");


             $result=  pg_query("SELECT \"MinVal\",\"MaxVal\" FROM \"tblAlarm2Sensor\" where 
            \"SensorName\" = '$PARAMS[$i]' and \"Station_Full_Name\"='$station'");
             $sensorrow=pg_fetch_array($result);
            global $Minval;
            global $MaxVal;
             if (isset($sensorrow)) {
             $Minval=(float) trim($sensorrow['MinVal']);
             $MaxVal=(float) trim($sensorrow['MaxVal']);
             }
          //   echo "$h  $h2 $m";

 //echo $DateTime->format("H:i:s");

//$i=0;
          
       
          

          $result_set=  pg_query("SELECT \"HydroMetParamsTypeId\" FROM \"tblHydroMetParamsType\" where 
            \"HydroMetParamsName\" = '$PARAMS[$i]'");
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
                   $result_set2=       pg_query("select \"Year\", \"Month\", \"Day\", \"ReadingId\",  \"Hour\", \"Minute\", \"Second\", \"HydroMetParamsName\", \"Value\" from \"$table\" a, \"tblHydroMetParamsType\" b   where b.\"HydroMetParamsTypeId\" = a.\"HydroMetParamsTypeId\" and ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY,$FM,$FD) AND ($TY,$TM,$TD))  and a.\"HydroMetParamsTypeId\"='$PARAMSID' and a.\"StationId\"= '$s_id'  order by \"HydroMetParamsName\", \"Year\", \"Month\", \"Day\", \"Hour\", \"Minute\", \"Second\"");

                 }
                 else
                 {


                        $result_set2=      pg_query("
SELECT T.\"Year\", T.\"Month\", T.\"Day\", T.\"ReadingId\", T.\"Hour\", T.\"Minute\", T.\"Second\", T.\"HydroMetParamsName\", T.\"Value\" FROM (select \"Year\", \"Month\", \"Day\", \"ReadingId\",  \"Hour\", \"Minute\", \"Second\", \"HydroMetParamsName\", \"Value\" from \"$table\" a, \"tblHydroMetParamsType\" b   where b.\"HydroMetParamsTypeId\" = a.\"HydroMetParamsTypeId\" and ((\"Year\" ,\"Month\", \"Day\",\"Hour\") BETWEEN ($FY,$FM,$FD,1) AND ($TY,$TM,$TD,$h2)) and a.\"HydroMetParamsTypeId\"='$PARAMSID' and a.\"StationId\"= '$s_id'  order by \"HydroMetParamsName\", \"Year\", \"Month\", \"Day\", \"Hour\", \"Minute\", \"Second\") T where \"Day\"='$FD' and \"Hour\"<='$h' or \"Day\"!='$FD'"
);
                 }
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
  // echo " $array_v";
}
   }   

   

   
}
return $array_v;
}

echo "$noresult";


$arrayv=array();
$m=0;
for ($j=0; $j <count($stationlist)-1; $j++) { 


for ($i=0; $i <count($PARAMS)-1 ; $i++) { 

$temp= graph($i,$stationlist[$j]);
$arrayv[$m]=$temp;
$m++;

//var_dump($arrayv);
//echo "$m ,$stationlist[$j]";

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
    document.getElementById('jqxSplitter').innerHTML+='  <div style="width:100%;height:30px;background-color:#539CCC"><b style="color:white">Sensor '+param[i]+' at Station '+stn[j]+'</b><p style="float:right"><a   title="Download!" id="downloadgraph'+n+'"><img src="Images/download.png"></a><a style="margin-left:3px" title="Full Screen!"  data-toggle="modal" data-target="#myModal'+n+'"><img src="fullscreen.png"></a></p></div><br><div style="width: 100%;height: 200px;overflow-y: scroll;margin: 0 auto" id="graph'+n+'" name="graph'+n+'"></div><br> ';

document.getElementById('D_img').innerHTML+='<img id="img'+n+'" style="width:1px;height:1px">';

document.body.innerHTML+='<div class="modal fade" data-backdrop="false"  id="myModal'+n+'" role="dialog" style="background-color: white" > <div style="width:100%;height:30px;background-color:#539CCC"><b style="color:white">Sensor '+param[i]+' at Station '+stn[j]+'</b>    <button type="button" style="float: right;" class="close" data-dismiss="modal">&times;</button></div> <div style="width: 95%;height: 105%;overflow-y: scroll;" id="graph2'+n+'" name="graph2'+n+'"></div></div>';

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

 function myGraph(graphdiv,graphdiv2,z,pausecontent) {

    try {
     // var tem = '<?php //echo json_encode($arrayv); ?>';

    //alert(tem);
var resultArray= pausecontent[z].replace('"');//'<?php //echo str_replace('"', '', $arrayv[$z++]); ?>';

var Minval='<?php echo $Minval;?>';
var MaxVal='<?php echo $MaxVal;?>';
var res=resultArray.split(",");  

var ress='"Date,Value,Min,Max\n"';

for (var i = 0; i <res.length -1; i=i+2)
 { 
      ress+='"'+new Date(res[i])+","+res[i+1]+','+Minval+','+MaxVal+'\n"';

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
    g.resetZoom();
  
Dygraph.Export.asPNG(g, img2, options);
window.location.href = img2.src.replace('image/png','image/octet-stream');

});
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

<body>
<div class="container">
<div id='jqxSplitter'>

<br>




</div>
<div id="D_img"></div>
</div>

  </body>


