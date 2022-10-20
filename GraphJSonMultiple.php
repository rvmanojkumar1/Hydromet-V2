


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
$min_max_list=array();
      $tempParam = trim($_GET["PARAMS"]);
          
$PARAMS=explode(';' ,$tempParam);
  $station=getStationShef(trim($_GET['station']));
  $Minval=0.0;
  $MaxVal=0.0;
function graph($vertualsensors,$realsensors,$v_sensor_names,$r_sensor_names)
{
  global $min_max_list;
  $array_v='';
  $array_v='"Date';
  $export_Header="Date";
  $FY = trim($_GET["FY"]);
  $FY = substr($FY,-2);
  $FM = trim($_GET["FM"]);
  $FD = trim($_GET["FD"]);
  $TY = trim($_GET["TY"]);
  $TY = substr($TY,-2);
  $TM = trim($_GET["TM"]);
  $TD = trim($_GET["TD"]);
  //  $tempParam = trim($_GET["PARAMS"]);
  $station=getStationShef(trim($_GET['station']));
  $DateTime = new DateTime();
  $h2 = date('H');  
  $m2=date('m');
  // if (isset($_GET['hours2'])) 
  // {
  //   $hours=$_GET['hours2'];
  //   $DateTime->modify("-$hours hours");
  //   $FY = trim($DateTime->format("Y"));
    $FY = substr($FY,-2);
    // $FM = trim($DateTime->format("m"));
    // $FD = trim($DateTime->format("d"));
    // $TY = trim(date('Y'));
    $TY = substr($TY,-2);
  //   $TM =  trim(date('m'));
  //   $TD = trim(date('d'));
  // }
    $m = date('m');
    $h = $DateTime->format("H");
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
  for ($i=0; $i <count($paramsshef); $i++) 
  { 
    if (trim($paramsshef[$i])!="")
    {
      $result_set=  pg_query("SELECT \"HydroMetParamsTypeId\" FROM \"tblHydroMetParamsType\" where \"HydroMetShefCode\" = '$paramsshef[$i]'");
      $row=pg_fetch_array($result_set);
      $HydroMetShefCodeCodition.=" a.\"HydroMetParamsTypeId\"=''$row[0]'' or";
    }
  }
  $paramsshefVirtual=explode(";", $vertualsensors);
  $HydroMetShefCodeCoditionVirtual='';
  for ($i=0; $i <count($paramsshefVirtual); $i++) { 
    if (trim($paramsshefVirtual[$i])!="") {
      $result_set=  pg_query("SELECT \"HydroMetParamsTypeId\" FROM \"tblHydroMetParamsType\" where \"HydroMetShefCode\" = '$paramsshefVirtual[$i]'");
      $row=pg_fetch_array($result_set);
      $HydroMetShefCodeCoditionVirtual.=" a.\"HydroMetParamsTypeId\"=''$row[0]'' or";
    }
  }
  $HydroMetShefCodeCoditionVirtual=rtrim($HydroMetShefCodeCoditionVirtual ,'or');
  $HydroMetShefCodeCodition=rtrim($HydroMetShefCodeCodition ,'or');
  $result_table=  pg_query("SELECT * FROM \"tblAllTables\" where \"TableName\" like '%".$station."_1%' or  \"TableName\" like '%".$station."_2%'");
  if (isset($result_table)) {
    $stn_id=  pg_query("SELECT \"StationId\" FROM \"tblStation\" where \"StationName\"='$station'");
    $id_row=pg_fetch_array($stn_id);
    $s_id= $id_row['StationId'];
    $SQL_MAX_MIN='';
    while ($tablerows=pg_fetch_array($result_table)) {
      $SQL_MAX_MIN='select ';
      $table="'".$tablerows['TableName']."'";
      if (!isset($_GET['hours'])) {
        $sql_queryReal ="SELECT * FROM crosstab ('SELECT  (''20''||\"Year\"::text ||''-''||\"Month\"::text ||''-''|| \"Day\" ::text ||'' ''||\"Hour\"::text || '':'' || \"Minute\" ::text || '':'' ||\"Second\")::timestamp  as t,\"HydroMetParamsTypeId\", \"Value\" FROM \"'$table'\" a where ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY,$FM,$FD) AND ($TY,$TM,$TD))  and a.\"StationId\"=$s_id and a.\"Flag\"= ''1'' and ($HydroMetShefCodeCodition)   order by 1 desc','SELECT distinct \"HydroMetParamsTypeId\" FROM \"'$table'\" as a where ($HydroMetShefCodeCodition) and a.\"Flag\"= ''1''') AS final_result(t timestamp";
        for ($i=0; $i <count($paramsshef) ; $i++)
        { 
          if (trim($paramsshef[$i])!="") 
          {
            $sql_queryReal .=",\"".$paramsshef[$i]."\" double precision";
            $SQL_MAX_MIN.="max(\"".$paramsshef[$i]."\"),";
            //$SQL_MAX_MIN.="min(\"".$paramsshef[$i]."\"),";
          }
        }
        $sql_queryReal.=")";
        //echo "$sql_query";     
        $sql_queryVirtual ="SELECT * FROM crosstab ('SELECT  (''20''||\"Year\"::text ||''-''||\"Month\"::text ||''-''|| \"Day\" ::text ||'' ''||\"Hour\"::text || '':'' || \"Minute\" ::text ||'':'' ||\"Second\")::timestamp  as t,\"HydroMetParamsTypeId\", \"VirtualValue\" FROM \"'$table'\" a where ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY,$FM,$FD) AND ($TY,$TM,$TD))  and a.sensortype=''Virtual'' and a.\"Flag\"= ''1'' and a.\"StationId\"=$s_id and ($HydroMetShefCodeCoditionVirtual)   order by 1 desc','SELECT distinct \"HydroMetParamsTypeId\" FROM \"'$table'\" as a where a.sensortype=''Virtual'' and ($HydroMetShefCodeCoditionVirtual) and a.\"Flag\"= ''1''') AS final_result(t timestamp";

        for ($i=0; $i <count($paramsshefVirtual) ; $i++) { 
          if (trim($paramsshefVirtual[$i])!="") 
          {
            $sql_queryVirtual .=",\"".$paramsshefVirtual[$i]."V\" double precision";
            $SQL_MAX_MIN.="max(\"".$paramsshefVirtual[$i]."V\"),";
            //$SQL_MAX_MIN.="min(\"".$paramsshefVirtual[$i]."V\"),";
          }
        }
        $sql_queryVirtual.=")";
      }
      else
      {
        $sql_queryReal="SELECT * FROM crosstab ('SELECT  (''20''||\"Year\"::text ||''-''|| \"Month\"::text ||''-''|| \"Day\" ::text ||'' ''|| \"Hour\"::text || '':'' || \"Minute\" ::text ||'':'' ||\"Second\")::timestamp  as t,\"HydroMetParamsTypeId\", \"Value\" FROM  \"'$table'\" a where ((''20''||\"Year\"::text ||''-''|| \"Month\"::text ||''-''|| \"Day\" ::text ||'' ''|| \"Hour\"::text || '':'' || \"Minute\" ::text || '':'' || \"Second\")::timestamp  BETWEEN (''20$FY-$FM-$FD $h:$m:0'') AND (''20$TY-$TM-$TD $h2:$m2:0'')) and a.\"StationId\"=$s_id and a.\"Flag\"= ''1'' and ($HydroMetShefCodeCodition)   order by 1 desc','SELECT distinct \"HydroMetParamsTypeId\" FROM \"'$table'\" as a where ($HydroMetShefCodeCodition) and a.\"Flag\"= ''1''') AS final_result(t timestamp";
        for ($i=0; $i <count($paramsshef) ; $i++)
        { 
          if (trim($paramsshef[$i])!="") 
          {
            $sql_queryReal .=",\"".$paramsshef[$i]."\" double precision";
            $SQL_MAX_MIN.="max(\"".$paramsshef[$i]."\"),";
            //$SQL_MAX_MIN.="min(\"".$paramsshef[$i]."\"),";
          }
        }
        $sql_queryReal.=")";
        $sql_queryVirtual="SELECT * FROM crosstab ('SELECT  (''20''||\"Year\"::text ||''-''|| \"Month\"::text ||''-''|| \"Day\" ::text ||'' ''|| \"Hour\"::text || '':'' || \"Minute\" ::text ||'':'' ||\"Second\")::timestamp  as t,\"HydroMetParamsTypeId\", \"VirtualValue\" FROM  \"'$table'\" a where ((''20''||\"Year\"::text ||''-''|| \"Month\"::text ||''-''|| \"Day\" ::text ||'' ''|| \"Hour\"::text || '':'' || \"Minute\" ::text || '':'' || \"Second\")::timestamp  BETWEEN (''20$FY-$FM-$FD $h:$m:0'') AND (''20$TY-$TM-$TD $h2:$m2:0'')) and a.sensortype=''Virtual'' and a.\"Flag\"= ''1'' and a.\"StationId\"=$s_id and ($HydroMetShefCodeCoditionVirtual)   order by 1 desc','SELECT distinct \"HydroMetParamsTypeId\" FROM \"'$table'\" as a where a.sensortype=''Virtual'' and ($HydroMetShefCodeCoditionVirtual) and a.\"Flag\"= ''1''') AS final_result(t timestamp";
        for ($i=0; $i <count($paramsshefVirtual) ; $i++) { 
          if (trim($paramsshefVirtual[$i])!="") 
          {
            $sql_queryVirtual .=",\"".$paramsshefVirtual[$i]."V\" double precision";
            $SQL_MAX_MIN.="max(\"".$paramsshefVirtual[$i]."V\"),";
            //$SQL_MAX_MIN.="min(\"".$paramsshefVirtual[$i]."V\"),";
          }
        }
        $sql_queryVirtual.=")";
      }
 
      if (trim($HydroMetShefCodeCoditionVirtual)!="")
      {
        $sql_query="select t1.t";
        for ($i=0; $i <count($paramsshef)-1 ; $i++)
        { 
          if (trim($paramsshef[$i])!="") 
            $sql_query .=",t1.\"".$paramsshef[$i]."\"" ;
        }
        for ($i=0; $i <count($paramsshefVirtual)-1 ; $i++)
        { 
          if (trim($paramsshefVirtual[$i])!="") 
            $sql_query .=",t2.\"".$paramsshefVirtual[$i]."V\"";
        }

        $sql_query=rtrim($sql_query,",");

        $sql_query.=" from (".$sql_queryReal.") t1 FULL OUTER JOIN (".$sql_queryVirtual.") t2 on t1.t=t2.t order by t1.t desc ";

      }
      else
      {
        $sql_query=$sql_queryReal;
      }
      if (trim($HydroMetShefCodeCodition)=='')
      {
        $sql_query=$sql_queryVirtual;
      }
      $SQL_MAX_MIN=rtrim($SQL_MAX_MIN,",");
      $SQL_MAX_MIN.= " from ($sql_query) x";
      //echo "$SQL_MAX_MIN<br><br>";
      $min_max_temp=pg_query($SQL_MAX_MIN);
      $min_max_set=pg_fetch_array($min_max_temp);

      $result_set2= pg_query($sql_query);  
      $_SESSION['query']=$sql_query;
      // echo "<br><br>$sql_query";           
      if (pg_num_rows($result_set2)>0) 
      {
        $min_max_count=0;
        $HydroMetShefCodeCodition_temp=str_replace("''", "'", $HydroMetShefCodeCodition);
        $row_c_ds_r=pg_query("SELECT distinct \"HydroMetParamsTypeId\" FROM \"$table\" as a where ($HydroMetShefCodeCodition_temp) and a.\"Flag\"= '1'");
        $tem_ds=pg_query("SELECT distinct \"HydroMetParamsTypeId\" FROM \"$table\" as a where ($HydroMetShefCodeCodition_temp) and a.\"Flag\"= '1'");
        while ($h_id=pg_fetch_array($tem_ds)) 
        {
          $shef=pg_fetch_array(pg_query("select \"HydroMetShefCode\" from \"tblHydroMetParamsType\" where \"HydroMetParamsTypeId\"='$h_id[0]'"));
          $row=pg_fetch_array(pg_query("select \"Sensor\" from \"SensorValues\" where \"StationFullName\"='$stn_name' and \"SHEF\"='$shef[0]' and \"SensorType\"='Real'"));
          $min_max_list[$row[0].""]=$min_max_set[$min_max_count];
          $min_max_count++;
          //$min_max_list[$row[0]."_Min"]=$min_max_set[$min_max_count];
          //$min_max_count++;
          $array_v.=','.$row[0];
          $export_Header.=",".$row[0];
        }
        $HydroMetShefCodeCoditionVirtual_temp=str_replace("''", "'", $HydroMetShefCodeCoditionVirtual);
        if (trim($HydroMetShefCodeCoditionVirtual)!="") 
        {
          $row_c_ds_v=pg_query("SELECT distinct \"HydroMetParamsTypeId\" FROM \"$table\" as a where a.sensortype='Virtual' and ($HydroMetShefCodeCoditionVirtual_temp) and a.\"Flag\"= '1'");
          $tem_ds=pg_query("SELECT distinct \"HydroMetParamsTypeId\" FROM \"$table\" as a where a.sensortype='Virtual' and ($HydroMetShefCodeCoditionVirtual_temp) and a.\"Flag\"= '1'");
          while ($h_id=pg_fetch_array($tem_ds))
          {
            $shef=pg_fetch_array(pg_query("select \"HydroMetShefCode\" from \"tblHydroMetParamsType\" where \"HydroMetParamsTypeId\"='$h_id[0]'"));

            $row=pg_fetch_array(pg_query("select \"Sensor\" from \"SensorValues\" where \"StationFullName\"='$stn_name' and \"SHEF\"='$shef[0]' and \"SensorType\"='Virtual'"));
            $min_max_list[$row[0].""]=$min_max_set[$min_max_count];
            $min_max_count++;
            //$min_max_list[$row[0]."_Min"]=$min_max_set[$min_max_count];
            //$min_max_count++;
            $array_v.=','.$row[0];
            $export_Header.=",".$row[0];
          }
        }
        $array_v.= "\n".'"';
        $_SESSION["header"]=$export_Header;
        while($rows=pg_fetch_array($result_set2))
        {
          $a= $rows['t'];
          if (trim($a)!="")
          {
            $array_v.='"'.$a;
            $row_count=1;
            $table="'".$tablerows['TableName']."'";
            for ($i=0; $i <pg_num_rows($row_c_ds_r); $i++) 
            {
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
$stn_name='';
$data=getStationShef(trim($_GET['station']));
$dataU=strtoupper($data);        
$dataL=strtolower($data);
$result_stn=pg_query("select \"StationType\" from \"tblStationType\"");
if(pg_num_rows($result_stn)>0)
{
  while($row_user=pg_fetch_array($result_stn))
  {
    $sql_query="select \"Station_Full_Name\" from \"" . str_replace(' ','_', $row_user['StationType']) ."\" where \"Station_Shef_Code\"='$data' or \"Station_Shef_Code\" = '$dataU' or \"Station_Shef_Code\"='$dataL' or \"Station_Full_Name\"='$data' or \"Station_Full_Name\"='$dataU' or \"Station_Full_Name\"='$dataL'";

    $result_set=pg_query($sql_query);
    if(pg_num_rows($result_set)>0) 
    {                 
      while ($data1=pg_fetch_row($result_set)) 
      {
        $stn_name=$data1[0];
      }
    }
  }
}
$realsensors='';
$vertualsensors='';
$v_sensor_names="";
$r_sensor_names="";
for ($i=0; $i < count($PARAMS) ; $i++) 
{ 
  $row=pg_fetch_array(pg_query("select \"SensorType\",\"SHEF\",\"Sensor\" from \"SensorValues\" where \"StationFullName\"='$stn_name' and \"Sensor\"='$PARAMS[$i]'"));
  if ($row[0]=="Real")
  {
    $realsensors.=$row[1].";";
    $r_sensor_names.=$row[2].";";
  }
  else
  {
    $vertualsensors.=$row[1].";";
    $v_sensor_names.=$row[2].";";
  }
}
$temp= graph($vertualsensors,$realsensors,$v_sensor_names,$r_sensor_names);
$yaxis_list=array();
if (isset($_GET['check'])) {
foreach ($min_max_list as $key => $value) 
{
  $x=str_replace(" ", "_",$key);
  if (isset( $_GET[$x])) 
{
$yaxis_list[]=$key; 

}
}
}
else
{
if (count($min_max_list)>1) {
  # code...
$max=0;


foreach ($min_max_list as $key => $value) 
{



 if ($max<$value) 
 {
   $max=$value;
 }
}
$max=$max/2;
foreach ($min_max_list as $key => $value) 
{

if ($value>$max)
{
$yaxis_list[]=$key;
}
}

 }
}
}


?>

<script >
   var text_data=new Array();
function zoomIn(event)
{

 var w= document.getElementById('graph1');
 w.style.zoom="200%";

}
var min_max_list;
 var yaxis_list;
  var data;
window.onload=function()
{
  var stnname=document.getElementById("Sname").value;
var sdate=document.getElementById("EditStartDate").value;
$.ajax({
        url:'./COLORV2.txt',
        success: function (respon){
        
            obj=respon.split('\n'); 
            //alert("hello");
            for(var i=0;i<obj.length;i++)
            {
                if(((obj[i].includes("graph"))==true)&&(obj[i]!="")){
                    text_data[i]=obj[i].split(',');
                    console.log(text_data[i]);
                    console.log(i);
                }
            }
            updategraph(text_data,stnname);
        }

    
    });

data=<?php echo json_encode(str_replace('"', '', $temp));?>;

yaxis_list=<?php echo json_encode($yaxis_list);?>;
                  min_max_list=<?php echo json_encode($min_max_list);?>;
            //alert(min_max_list[0]);
<?php if(count($min_max_list)>0) { ?>;

  document.getElementById('myGraph').style.display="";
<?php }?>

 var op= {
                     legend: 'always',
                     drawPoints: true, 
                     connectSeparatedPoints: true,
                  showRangeSelector: true,
                      xlabel: "Hours/Date",
                        pointSize: 2,
                     <?php if (isset($yaxis_list[0])) { echo "\"".$yaxis_list[0]."\" ";}else echo "\" \" ";?>: 
                     {
                       axis : {  }
                     }
                       ,
                        <?php if(count($yaxis_list)>=2) { for ($i = 1; $i < count($yaxis_list); $i++) {
                        ?>
                       <?php echo "\"".$yaxis_list[$i]."\" ";?>:  {
                       axis :  <?php  echo "'".$yaxis_list[$i-1]."'";?>
                     },
                     <?php } } ?> 
                    
                 };

    myGraph('graph1','graph21',1,data,op);  


       
}
function updategraph(text_data,stnname){
    console.log(text_data);
    console.log(stnname);
    var sens=$('#SensorList').val();
    console.log(sens);
    var textd=new Array();
    var j=0;
    for(i=0;i<text_data.length;i++){
      if(text_data[i]!=null){
        textd[j]=text_data[i];
        j++;
      }

    }
    console.log(textd);
    var d=JSON.stringify(textd);
    console.log(d);
    //console.log(stnname);
    $.ajax({
        url:'graphMarkerMultiple.php',
        method: 'POST',
        data: {'text_data': d,'stnname': stnname,'sensor': sens},
        success: function (respon){
            console.log(respon);
            // respon=respon.replace('"','');
            // respon=respon.replace('"','');
            // res=respon.split(',');
            // setColor(res);
        }
    });
  }
 function myGraph(graphdiv,graphdiv2,z,ress,op) {
    try {
try{

var g = new Dygraph(document.getElementById(graphdiv),ress,op);




 try{
var id1=z;
var id2="#downloadgraph"+id1;
var id3="img"+id1;


$(id2).click(function(){

   var img2 = document.getElementById(id3);
// These are the default options
var options = {
    //Texts displayed below the chart's x-axis and to the left of the y-axis 
    titleFont: "bold 18px serif",
    titleFontColor: "White",

    //Texts displayed below the chart's x-axis and to the left of the y-axis 
    axisLabelFont: "bold 14px serif",
    axisLabelFontColor: "White",

    // Texts for the axis ticks
    labelFont: "normal 12px serif",
    labelFontColor: "White",

    // Text for the chart legend
    legendFont: "bold 12px serif",
    legendFontColor: "White",

    legendHeight: 20    // Height of the legend area
}; 
   // g.resetZoom();
  
Dygraph.Export.asPNG(g, img2, options);

document.getElementById('downloadgraph1').href=img2.src;

//window.location.href = img2.src.replace('image/png','image/octet-stream');

});
}catch(exxxx)
{}


              g.dyOptions(labelsUTC = TRUE);

               }catch(ex1) {}

try{



 var g2=  new Dygraph(document.getElementById(graphdiv2),
ress , op
           );

              g2.dyOptions(labelsUTC = TRUE); }catch(ex1) {
              }
    g2.resize(1400, 600);

             
    }

  catch(ex)
    {
 document.getElementById(graphdiv).style="float:left";
       document.getElementById(graphdiv).innerHTML='No Data Found!';       
    }
    
     }    


</script>
<style type="text/css">
  
  .dygraph-legend {
  background: transparent !important;
  left: 80px !important;
width: 80% !important;
}
</style>
<script type="text/javascript">

  function changeGraph()
  {
   
  var url=window.location.href;
  var temp=url.split('&check');
  url =temp[0]+"&check=1";


  try
    {
  for(var v in min_max_list)
  {
   

if (document.getElementById(v.replace(/ /g,"_")).checked==true) 
{
url+="&"+v.replace(" ","_")+"=1"
}
}
  }catch(x){}

window.location.href=url;
  
  }

function onSelected1()
{
  debugger
       var selected2 = $("#rightside option:selected");
        var right = "";

        selected2.each(function () {
            right +=$(this).val() + ";";
        });
  var ar=right.split(";");


    var selected = $("#leftside option:selected");
        var left = "";
        selected.each(function () {
          var ch=false;
          var v=$(this).val();
         for(var i=0;i<(ar.length)-1;i++)
          {

           if (v.trim()==ar[i].trim()) 
            {
            ch=true;
            }
            
          }
    if (ch) {

              $(this).removeAttr('selected');

                }
          else
            {
            left +=$(left).val() + ";";

            }

        });
        changegarph2();
        $('#leftside').trigger('chosen:updated');

              $("#leftside").trigger("change");

//changegarph2();

}
function onSelected2()
{
  debugger
   var selected2 = $("#leftside  option:selected");
        var right = "";

        selected2.each(function () {
            right +=$(this).val() + ";";
        });
  var ar=right.split(";");


    var selected = $("#rightside option:selected");
         left = "";
        selected.each(function () {
          var ch=false;
          var v=$(this).val();
         for(var i=0;i<(ar.length)-1;i++)
          {

           if (v.trim()==ar[i].trim()) 
            {
            ch=true;
            }
            
          }
    if (ch) {

              $(this).removeAttr('selected');

                }
          else
            {
            left +=$(left).val() + ";";

            }

        });
        changegarph2();
        $('#rightside').trigger('chosen:updated');
              $("#rightside").trigger("change");

}

function changegarph2()
{
  //alert("kk");
   var selected2 = $("#rightside option:selected");
        var right = "";

        selected2.each(function () {
            right +=$(this).val() + ";";
        });
          var ar=right.split(";");

  var url=window.location.href;
  var temp=url.split('&check');
  url =temp[0]+"&check=1";
try
{
 for(var i=0;i<(ar.length)-1;i++)
          {
    url+="&"+ar[i].replace(" ","_")+"=1"
 }   
  }catch(x){}
//alert(url);
window.location.href=url;
}
</script>
<div id="myGraph" style="display: none;">
<div style="margin-left: 2%">
<!--<p>Graph shows selected sensors rigth to left!</p>-->
<table>
<tr><td >Left Side Sensors</td><td>Right Side Sensors</td> </tr>
  <tr>
    <td style="padding:5px">

<select id="leftside" class="selectpicker" multiple=""  onchange="onSelected2()" >
<?php
foreach ($min_max_list as $key => $value) 
{
  ?>
  <option value="<?php echo $key;?>"  <?php $ch=false; for ($i=0; $i <count($yaxis_list) ; $i++) { 
 if (trim($yaxis_list[$i])==trim($key)) {
$ch=true;
 }
 
} if (!$ch)  echo "selected"; ?>  ><?php echo trim($key);?></option>
  <?php
}
?>
</select>
</td>
<td style="padding:5px">
<select id="rightside" class="selectpicker" multiple="" onchange="onSelected1()">
<?php
foreach ($min_max_list as $key => $value) 
{
  ?>
  <option value="<?php echo $key;?>"  <?php for ($i=0; $i <count($yaxis_list) ; $i++) { 
 if (trim($yaxis_list[$i])==trim($key)) {
 echo "selected";
 }
} ?> ><?php echo trim($key);?></option>
  <?php
}




?>
</select>

   </td>
 <td style="padding: 5px">
       <p style="float:right"><a   title="Download!" id="downloadgraph1" download="GraphImage.png"><img src="StationImages/downloadicon.png"></a> <a style="margin-left:3px" title="Full Screen!"  data-toggle="modal" data-target="#myModal1"><img src="fullscreen.png"></a></p>
 </td>
  </tr>
</table>
<!--
<?php
//foreach ($min_max_list as $key => $value) 
//{
?>
<input type="checkbox" id="<?php //echo str_replace(" ", "_", $key) ;?>" value="<?php // echo $key;?>" <?php //for ($i=0; $i <count($yaxis_list) ; $i++) { 
// if (trim($yaxis_list[$i])==trim($key)) {
 //echo "checked";
// }
//} ?>  ><label><?php echo " ".$key;?></label>
<?php
//}?>-->

</div>
<center>

<br>
<div style="width: 98%;height: 60%;" id="graph1" name="graph1"><center><img src="StationImages/waitingIcon.gif"></center>
</div>
<br> 
</center>
<img id="img1" style="width:1px;height:1px">
      </div>

<div class="modal fade" data-backdrop="false"  id="myModal1" role="dialog" style="background-color: white" > 
  <div style="width:100%;height:30px;background-color:#539CCC">
    <b style="color:white"> Sensors  at Station </b>   
 <button type="button" style="float: right;" class="close" data-dismiss="modal">&times;</button>
</div> 
<div style="width: 98%;height: 90%;overflow: hidden; 
 " id="graph21" name="graph21"></div></div>

    <link rel="stylesheet" href="assets/jquery-ui.css">

    <script type="text/javascript" src="assets/jquery.js"></script>
<script type="text/javascript" src="assets/jquery-ui.js"></script>
<script type="text/javascript">
$(function() 
{
 $( "#Sname" ).autocomplete({
  source: 'autocompelete.php',
   close: function( event, ui ) {  GetData(); }
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