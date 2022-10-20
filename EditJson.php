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


 
<style type="text/css">
  
  paging-nav {
  text-align: right;
   padding-top: 2px;
}

.paging-nav a {

  margin: auto 1px;

  text-decoration: none;

  display: inline-block;

  padding: 1px 7px;

  background: #91b9e6;

  color: white;

  border-radius: 3px;

}

.paging-nav .selected-page {

  background: #187ed5;

  font-weight: bold;

}

</style>
 
<?php

if (isset($_GET["PARAMS"]))
{



           $FY = trim($_GET["FY"]);
           // $FY = str_replace('20', '',$FY);
            $FM = trim($_GET["FM"]);
            $FD = trim($_GET["FD"]);
            $TY = trim($_GET["TY"]);
            //$TY = str_replace('20', '',$TY);
            $TM = trim($_GET["TM"]);
            $TD = trim($_GET["TD"]);
            $PARAMS =trim($_GET["PARAMS"]);
            $station=getStationShef(trim($_GET['station']));
            if ($station=="") {
$station=trim($_GET['station']);
            }
  $array_v='"Date,'.$PARAMS."\n".'"';
           
         $DateTime = new DateTime();
   $h2 = date('H');  
   $m2=date('i');
            if (isset($_GET['hours2'])) {
      
            $hours=$_GET['hours2'];
                
             $DateTime->modify("-$hours hours");

               $FY = trim($DateTime->format("Y"));
                 $FY = substr($FY,-2);
            $FM = trim($DateTime->format("m"));
            $FD = trim($DateTime->format("d"));
            $TY = trim(date('Y'));
               $TY = substr($TY,-2);
            $TM =  trim(date('m'));
            $TD = trim(date('d'));

            }
             $m = $DateTime->format("i");
              $h = $DateTime->format("H");

           
        
	
            //echo "$FY $FM $FD  $h $m  and   $TY $TM $TD  $h2 $m2";

 //echo $DateTime->format("H:i:s");
?>


<?php
 // echo "<script>alert('$PARAMS');</script>";
// echo "SELECT \"StationType\" FROM \"tblStationType\"";
 $stn_type_set=pg_query("SELECT \"StationType\" FROM \"tblStationType\"");
 $stn_name="";
 if(pg_num_rows($stn_type_set)>0)
 {
	  while($table_name=pg_fetch_array($stn_type_set))
	  {
		  $tbl=$table_name['StationType'];
		  //echo 
	   $stn_set=pg_query("SELECT \"Station_Full_Name\" FROM \"$tbl\" where \"Station_Shef_Code\"='$station'");
	    if(pg_num_rows($stn_set)>0)
 {
	 $name=pg_fetch_array($stn_set);
	   $stn_name=$name['Station_Full_Name'];
 }
	  }
 }
 
 /* $result=  pg_query("SELECT \"MinVal\",\"MaxVal\" FROM \"tblAlarm2Sensor\" where 
            \"SensorName\" = '$PARAMS' and \"Station_Full_Name\"='$stn_name'");
		
             $sensorrow=pg_fetch_array($result);
             if (isset($sensorrow)) {
             $Minval=(float) trim($sensorrow['MinVal']);
             $MaxVal=(float) trim($sensorrow['MaxVal']);
             }
 */
   $result=  pg_query("SELECT \"SHEF\",\"SensorType\" FROM \"SensorValues\" where \"Sensor\" = '$PARAMS' and \"StationFullName\"='$stn_name'");
			
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
   
   
 $Interval='';
   $interval_ds=pg_fetch_array(pg_query("SELECT \"Interval\" FROM \"SensorValues\" where \"StationFullName\"='$stn_name' and \"SHEF\"='$PARAMS'"));
$Interval= $interval_ds[0];

          $result_set=  pg_query("SELECT \"HydroMetParamsTypeId\" FROM \"tblHydroMetParamsType\" where 	\"HydroMetShefCode\" = '$PARAMS'");

          $row=pg_fetch_array($result_set);
$PARAMS=$row['HydroMetParamsTypeId'];
    $result_table=  pg_query("SELECT * FROM \"tblAllTables\" where \"TableName\" like '%".$station."_1%' or  \"TableName\" like '%".$station."_2%'");
    if (isset($result_table)) {
      $stn_id=  pg_query("SELECT \"StationId\" FROM \"tblStation\" where \"StationName\"='$station'");
$id_row=pg_fetch_array($stn_id);
$s_id= $id_row['StationId'];
  while ($tablerows=pg_fetch_array($result_table)) {
    

$table="'".$tablerows['TableName']."'";

  if (!isset($_GET['hours'])) {
    if ($valuecol=="Value") {
      
// echo "select ('20'||\"Year\"::text ||'-'|| \"Month\"::text ||'-'|| \"Day\" ::text ||' '|| \"Hour\"::text || ':' || \"Minute\" ::text || ':' ||\"Second\")::timestamp as t, \"HydroMetShefCode\", \"$valuecol\" from \"$table\" a, \"tblHydroMetParamsType\" b   where b.\"HydroMetParamsTypeId\" = a.\"HydroMetParamsTypeId\" and ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY,$FM,$FD) AND ($TY,$TM,$TD))  and a.\"HydroMetParamsTypeId\"='$PARAMS' and a.\"StationId\"= '$s_id'  and a.\"Flag\"= '1'  order by \"HydroMetShefCode\",t";
 
    $sql_query="select ('20'||\"Year\"::text ||'-'|| \"Month\"::text ||'-'|| \"Day\" ::text ||' '|| \"Hour\"::text || ':' || \"Minute\" ::text || ':' ||\"Second\")::timestamp as t, \"HydroMetShefCode\", \"$valuecol\" from \"$table\" a, \"tblHydroMetParamsType\" b   where b.\"HydroMetParamsTypeId\" = a.\"HydroMetParamsTypeId\" and ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY,$FM,$FD) AND ($TY,$TM,$TD))  and a.\"HydroMetParamsTypeId\"='$PARAMS' and a.\"StationId\"= '$s_id'  and a.\"Flag\"= '1'  order by \"HydroMetShefCode\",t";
       }else
       {
          $sql_query="select ('20'||\"Year\"::text ||'-'|| \"Month\"::text ||'-'|| \"Day\" ::text ||' '|| \"Hour\"::text || ':' || \"Minute\" ::text || ':' ||\"Second\")::timestamp as t, \"HydroMetShefCode\", \"$valuecol\" from \"$table\" a, \"tblHydroMetParamsType\" b   where b.\"HydroMetParamsTypeId\" = a.\"HydroMetParamsTypeId\" and ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY,$FM,$FD) AND ($TY,$TM,$TD))  and a.\"HydroMetParamsTypeId\"='$PARAMS' and a.\"StationId\"= '$s_id'  and a.\"Flag\"= '1' and SensorType='Virtual'  order by \"HydroMetShefCode\",t";
       }
              // echo "<br><br> $sql_query";
        $result_set2=       pg_query($sql_query);



                 }
                 else
                 {
 if ($valuecol=="Value") {
                            $sql_query="select ('20'||\"Year\"::text ||'-'|| \"Month\"::text ||'-'|| \"Day\" ::text ||' '|| \"Hour\"::text || ':' || \"Minute\" ::text || ':' ||\"Second\")::timestamp as t, \"$valuecol\" from \"$table\" a, \"tblHydroMetParamsType\" b where b.\"HydroMetParamsTypeId\"= a.\"HydroMetParamsTypeId\" and (('20'||\"Year\"::text ||'-'|| \"Month\"::text ||'-'|| \"Day\" ::text ||' '|| \"Hour\"::text || ':' || \"Minute\" ::text || ':' || \"Second\")::timestamp  BETWEEN ('20$FY-$FM-$FD $h:$m:0') AND ('20$TY-$TM-$TD $h2:$m2:0')) and a.\"HydroMetParamsTypeId\"='$PARAMS' and a.\"StationId\"= '$s_id' and a.\"Flag\"= '1' order by \"HydroMetShefCode\",t";
                             }else
                             {
                               $sql_query="select ('20'||\"Year\"::text ||'-'|| \"Month\"::text ||'-'|| \"Day\" ::text ||' '|| \"Hour\"::text || ':' || \"Minute\" ::text || ':' ||\"Second\")::timestamp as t, \"$valuecol\" from \"$table\" a, \"tblHydroMetParamsType\" b where b.\"HydroMetParamsTypeId\"= a.\"HydroMetParamsTypeId\" and (('20'||\"Year\"::text ||'-'|| \"Month\"::text ||'-'|| \"Day\" ::text ||' '|| \"Hour\"::text || ':' || \"Minute\" ::text || ':' || \"Second\")::timestamp  BETWEEN ('20$FY-$FM-$FD $h:$m:0') AND ('20$TY-$TM-$TD $h2:$m2:0')) and a.\"HydroMetParamsTypeId\"='$PARAMS' and a.\"StationId\"= '$s_id' and a.\"Flag\"= '1'  and SensorType='Virtual' order by \"HydroMetShefCode\",t";
                             }
                           
                               $result_set2= pg_query($sql_query);



                 }
               
$file_interval_ds=pg_fetch_array(pg_query("select distinct \"Interval\" from \"$table\" where \"HydroMetParamsTypeId\"='$PARAMS'"));
        $Interval_array=explode("+", $file_interval_ds['Interval']); 
$DivInt='';
$temp_int=trim($Interval);

if($Interval_array[0]=="DIN")
{

$DivInt=$Interval/$Interval_array[1];
$Interval=$Interval_array[1];
if (is_double($DivInt)) {
$DivInt=intval($DivInt);
$DivInt+=1;
}


$DivInt=$DivInt-1;
}
if($Interval_array[0]=="DIH")
{
  $DivInt=$Interval/($Interval_array[1]*60);
$Interval=$Interval_array[1]*60;

}
if (pg_num_rows($result_set2)>0) {
$i=0;
 $temp_date;
 $z=0;
 $temp_array_v='';
 $temp_X='';
  $settings=pg_fetch_array(pg_query("select \"DateFormat\",\"DecimalPlaces\" from \"tblLogo\"")); 

while ($rows=pg_fetch_array($result_set2)) {

                   $Value=$rows[$valuecol];
                   $a= $rows['t'];

               if ($i==0) {
                   $temp_date=$a;
                    $i++; 
                   } 
  
                   if ($temp_int!='') {
        
if (trim($temp_date)==trim($a)) {
 $array_v.='"'.$a.','.$Value."\n".'"';
$temp_X.=trim($a);
$z=0;
 $temp_array_v='';

       }
       else
       {

 
        if ($z>=$DivInt) {

    $temp_array_v=str_replace('"'.$a.',,,'."\n".'"', '',$temp_array_v);
    $array_v.= $temp_array_v; 
    if (strpos($temp_X, $temp_date)===false) 
    $array_v.='"'.$temp_date.',,,'."\n".'"';

    $z=0;
    $array_v.='"'.$a.','.$Value."\n".'"';
    $temp_X.=trim($a);

    $temp_date=strtotime($temp_date);
    $temp_date=date('Y-m-d H:i:s',strtotime("+$Interval minutes",$temp_date));
    $array_v=str_replace('"'.$a.',,,'."\n".'"', '',$array_v);
    $temp_array_v='';
    }
    else
    {
    if (strpos($temp_X, $temp_date)===false) 
    $temp_array_v.='"'.$temp_date.',,,'."\n".'"';


     $array_v.='"'.$a.','.$Value."\n".'"';
     $temp_X.=trim($a);
     
     $array_v=str_replace('"'.$a.',,,'."\n".'"', '',$array_v);
     $temp_date=strtotime($temp_date);
     $temp_date=date('Y-m-d H:i:s',strtotime("+$Interval minutes",$temp_date));
    $z++;


    }
  
   
   }
       $temp_date=strtotime($temp_date);


 $temp_date=date('Y-m-d H:i:s',strtotime("+$Interval minutes",$temp_date));
                   }else
                   {
                     $array_v.='"'.$a.','.$Value."\n".'"';
$temp_X.=trim($a);
                 }
}
}
else
{

//echo "<script type='text/javascript'>
//alert('No Data Found!');
//</script>";
}

   } 
   }     
?>






<script >



window.onload = function () {


 var ress= '<?php echo json_encode(str_replace('"', '', $array_v)); ?>';
 try
{
var g2=  new Dygraph(document.getElementById("graph"),
ress , {
legend : "always",
showRangeSelector: true,  
xlabel: 'Hours/Date',
ylabel: 'Values', 
drawPoints: true, 
strokeWidth: 1.0
                        
                        }
           );

  try{

$("#downloadgraph").click(function(){
{
   var img2 = document.getElementById('img');
// These are the default options
var options = {
    //Texts displayed below the chart's x-axis and to the left of the y-axis 
    titleFont: "bold 18px serif",
    titleFontColor: "white",

    //Texts displayed below the chart's x-axis and to the left of the y-axis 
    axisLabelFont: "bold 14px serif",
    axisLabelFontColor: "white",

    // Texts for the axis ticks
    labelFont: "normal 12px serif",
    labelFontColor: "white",

    // Text for the chart legend
    legendFont: "bold 12px serif",
    legendFontColor: "white",

    legendHeight: 20    // Height of the legend area
}; 
  //  g2.resetZoom();
  
Dygraph.Export.asPNG(g2, img2, options);

document.getElementById('downloadgraph').href=img2.src;
//alert(img2.src);
//window.location.href = img2.src.replace('image/png','image/octet-stream');

}
});
}catch(exxxx)
{}
            g2.dyOptions(labelsUTC = TRUE);



            }catch(ex1)
            {

            }
  
       $(document).ready(function () {
       
       try
{

 var g=  new Dygraph(document.getElementById("graph22"),

ress , {
                         
                legend: 'always',  
                showRangeSelector: true,
                xlabel: 'Hours/Date',
                ylabel: 'Values',
                drawPoints: true         
                   
                        }
           );

                g.dyOptions(labelsUTC = TRUE);

   

         
            }catch(ex)
            {

            }

        g.resize(1300,580);


    });
     

        }     
function print()
{
  CallPrint('imgdiv');
}
function CallPrint(strid)
{
    var prtContent = document.getElementById(strid);
    var WinPrint =
   window.open('','','letf=30,top=30,width=1000,height=900,toolbar=1,scrollbars=3,sta­tus=3');
    WinPrint.document.write(prtContent.innerHTML);
    WinPrint.document.close();
    WinPrint.focus();
    WinPrint.print();
    WinPrint.close();
    prtContent.innerHTML=strOldOne;
 

}
</script>

<style type="text/css">
.dygraph-legend {
  background: transparent !important;
  left: 80px !important;
width: 80% !important;
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


@media (min-width: 480px) { 

.head-table{
  width: 800px;
}
.head-sensor{
  width: 400px;
}
}
@media (max-width: 480px) { 

.head-table{
  width: 200px !important;
 /* display: inline-block !important;*/
}
.head-sensor{
  width: 150px !important;
}
}
</style>

</head>
<body>
<!--<div id='jqxSplitter'>
<table style="float: right;margin-right: 7%;position: relative;top:-20px;">
  <tr>
     <td style="padding: 17px">
      <input type="checkbox" id="table_ckeck" onchange="showHideTable()">Table

<a   title="Download!"  id="downloadgraph" download="GraphImage.png"><img src="StationImages/downloadicon.png"/></a>    </td>    <td style="padding: 5px">
 <a  title="Full Screen!" data-toggle="modal" data-target="#myModal"><img src="fullscreen.png"></a>
   </td>
  </tr>
</table>
 <div id="imgdiv"><img id="img" style="visibility: hidden;width: 1px;height: 1px">


 </div>
<div style="width: 95%;height: 50%;margin-top: 3%;" id="graph" name='graph'>
<center>
<img src="StationImages/waitingIcon.gif">

</center>
</div>
<br>-->

 
<div id="body2" style="margin: 0 auto;">
  <div id="content">
 <table align="center" border="1" id="tableData" style="display: none"  class="table table-bordered table-striped">
 <thead style="display: block;width: 100%">
<tr >
    <th style="background-color:#539CCC;color:white;text-align:center;font-size: 13px;" class="head-table">Date/Time</th>
     
   
  <!-- <th  style="background-color:#539CCC;color:white;text-align:center;font-size: 13px;width: 400px">Sensor</th> -->
    <th  style="background-color:#539CCC;color:white;text-align:center;font-size: 13px;"
    class="head-sensor"
    ><?php echo $_GET["PARAMS"]; ?></th>
    
    </tr>
   </thead>
   <tbody style="display: block;overflow:auto;max-height: 650px;min-height: 300px;width: 100%">
    <?php
 $result_table=  pg_query("SELECT * FROM \"tblAllTables\" where \"TableName\" like '%".$station."_1%' or  \"TableName\" like '%".$station."_2%'");
    if (isset($result_table)) {
      $stn_id=  pg_query("SELECT \"StationId\" FROM \"tblStation\" where \"StationName\"='$station'");
$id_row=pg_fetch_array($stn_id);
$s_id= $id_row['StationId'];
  while ($tablerows=pg_fetch_array($result_table)) {
     
$table="'".$tablerows['TableName']."'";

 // $start=0;
 //$end=20;
 //if (isset($_GET['end'])) {
//$end+=$_GET['end'];
 //}
 //echo $_GET['end'];


      if (!isset($_GET['hours'])) {
    if ($valuecol=="Value") {
      
 
    $sql_query="select ('20'||\"Year\"::text ||'-'|| \"Month\"::text ||'-'|| \"Day\" ::text ||' '|| \"Hour\"::text || ':' || \"Minute\" ::text || ':' ||\"Second\")::timestamp as t, \"HydroMetShefCode\", \"$valuecol\" from \"$table\" a, \"tblHydroMetParamsType\" b   where b.\"HydroMetParamsTypeId\" = a.\"HydroMetParamsTypeId\" and ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY,$FM,$FD) AND ($TY,$TM,$TD))  and a.\"HydroMetParamsTypeId\"='$PARAMS' and a.\"StationId\"= '$s_id'  and a.\"Flag\"= '1'  order by \"HydroMetShefCode\",t";
       }else
       {
          $sql_query="select ('20'||\"Year\"::text ||'-'|| \"Month\"::text ||'-'|| \"Day\" ::text ||' '|| \"Hour\"::text || ':' || \"Minute\" ::text || ':' ||\"Second\")::timestamp as t, \"HydroMetShefCode\", \"$valuecol\" from \"$table\" a, \"tblHydroMetParamsType\" b   where b.\"HydroMetParamsTypeId\" = a.\"HydroMetParamsTypeId\" and ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY,$FM,$FD) AND ($TY,$TM,$TD))  and a.\"HydroMetParamsTypeId\"='$PARAMS' and a.\"StationId\"= '$s_id'  and a.\"Flag\"= '1' and SensorType='Virtual'  order by \"HydroMetShefCode\",t";
       }
               
        $result_set=       pg_query($sql_query);



                 }
                 else
                 {
 if ($valuecol=="Value") {
                               $sql_query="select ('20'||\"Year\"::text ||'-'|| \"Month\"::text ||'-'|| \"Day\" ::text ||' '|| \"Hour\"::text || ':' || \"Minute\" ::text || ':' ||\"Second\")::timestamp as t, \"$valuecol\" from \"$table\" a, \"tblHydroMetParamsType\" b where b.\"HydroMetParamsTypeId\"= a.\"HydroMetParamsTypeId\" and (('20'||\"Year\"::text ||'-'|| \"Month\"::text ||'-'|| \"Day\" ::text ||' '|| \"Hour\"::text || ':' || \"Minute\" ::text || ':' || \"Second\")::timestamp  BETWEEN ('20$FY-$FM-$FD $h:$m:0') AND ('20$TY-$TM-$TD $h2:$m2:0')) and a.\"HydroMetParamsTypeId\"='$PARAMS' and a.\"StationId\"= '$s_id' and a.\"Flag\"= '1' order by \"HydroMetShefCode\",t";
                             }else
                             {
                               $sql_query="select ('20'||\"Year\"::text ||'-'|| \"Month\"::text ||'-'|| \"Day\" ::text ||' '|| \"Hour\"::text || ':' || \"Minute\" ::text || ':' ||\"Second\")::timestamp as t, \"$valuecol\" from \"$table\" a, \"tblHydroMetParamsType\" b where b.\"HydroMetParamsTypeId\"= a.\"HydroMetParamsTypeId\" and (('20'||\"Year\"::text ||'-'|| \"Month\"::text ||'-'|| \"Day\" ::text ||' '|| \"Hour\"::text || ':' || \"Minute\" ::text || ':' || \"Second\")::timestamp  BETWEEN ('20$FY-$FM-$FD $h:$m:0') AND ('20$TY-$TM-$TD $h2:$m2:0')) and a.\"HydroMetParamsTypeId\"='$PARAMS' and a.\"StationId\"= '$s_id' and a.\"Flag\"= '1'  and SensorType='Virtual' order by \"HydroMetShefCode\",t";
                             }
                           
                               $result_set= pg_query($sql_query);



                 }

  if(pg_num_rows($result_set)>0)
  {


        while($row=pg_fetch_row($result_set))
    {
    ?>
            <tr>
            <td style="text-align:center;font-size: 13px;height: 14px;" class="head-table"><?php     $date = strtotime(trim($row[0]));
                         echo date(trim($settings[0]), $date); ?></td>
                                <!-- <td style="text-align:center;font-size: 13px;height: 14px;width: 400px"><?php echo $row[1]; ?></td> -->
                                 


 <td style="text-align:center;font-size: 13px;height: 14px;" class="head-sensor"><?php echo number_format(floatval($row[1]),trim($settings[1])); ?></td>

  
            </tr>
        <?php
    }
  }
else{
  // echo "<tr><td>No Data Found! </td><tr>";
 
}

  }
}

}
  ?>

  </tbody>
    </table>
    </div>


</div>
</div>
 <?php 
 if (isset($result_set)) {
 $result_set3=array();
 $csv=0;
 $result_table=  pg_query("SELECT * FROM \"tblAllTables\" where \"TableName\" like '%".$station."_1%' or  \"TableName\" like '%".$station."_2%'");
    if (isset($result_table)) {
      $stn_id=  pg_query("SELECT \"StationId\" FROM \"tblStation\" where \"StationName\"='$station'");
$id_row=pg_fetch_array($stn_id);
$s_id= $id_row['StationId'];
  while ($tablerows=pg_fetch_array($result_table)) {
     
$table="'".$tablerows['TableName']."'";


if (!isset($_GET['hours'])) {
    if ($valuecol=="Value") {
      

   $result_set3[$csv]="select ('20'||\"Year\"::text ||'-'|| \"Month\"::text ||'-'|| \"Day\" ::text ||' '|| \"Hour\"::text || ':' || \"Minute\" ::text || ':' ||\"Second\")::timestamp as t, \"HydroMetShefCode\", \"$valuecol\" from \"$table\" a, \"tblHydroMetParamsType\" b   where b.\"HydroMetParamsTypeId\" = a.\"HydroMetParamsTypeId\" and ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY,$FM,$FD) AND ($TY,$TM,$TD))  and a.\"HydroMetParamsTypeId\"='$PARAMS' and a.\"StationId\"= '$s_id'  and a.\"Flag\"= '1'  order by \"HydroMetShefCode\",t";

  
       }else
       {
         $result_set3[$csv]="select ('20'||\"Year\"::text ||'-'|| \"Month\"::text ||'-'|| \"Day\" ::text ||' '|| \"Hour\"::text || ':' || \"Minute\" ::text || ':' ||\"Second\")::timestamp as t, \"HydroMetShefCode\", \"$valuecol\" from \"$table\" a, \"tblHydroMetParamsType\" b   where b.\"HydroMetParamsTypeId\" = a.\"HydroMetParamsTypeId\" and ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY,$FM,$FD) AND ($TY,$TM,$TD))  and a.\"HydroMetParamsTypeId\"='$PARAMS' and a.\"StationId\"= '$s_id'  and a.\"Flag\"= '1' and SensorType='Virtual'  order by \"HydroMetShefCode\",t";
       }
               



                 }
                 else
                 {
 if ($valuecol=="Value") {
                              $result_set3[$csv]="select ('20'||\"Year\"::text ||'-'|| \"Month\"::text ||'-'|| \"Day\" ::text ||' '|| \"Hour\"::text || ':' || \"Minute\" ::text || ':' ||\"Second\")::timestamp as t, \"$valuecol\" from \"$table\" a, \"tblHydroMetParamsType\" b where b.\"HydroMetParamsTypeId\"= a.\"HydroMetParamsTypeId\" and (('20'||\"Year\"::text ||'-'|| \"Month\"::text ||'-'|| \"Day\" ::text ||' '|| \"Hour\"::text || ':' || \"Minute\" ::text || ':' || \"Second\")::timestamp  BETWEEN ('20$FY-$FM-$FD $h:$m:0') AND ('20$TY-$TM-$TD $h2:$m2:0')) and a.\"HydroMetParamsTypeId\"='$PARAMS' and a.\"StationId\"= '$s_id' and a.\"Flag\"= '1' order by \"HydroMetShefCode\",t";
                             }else
                             {
                             $result_set3[$csv]="select ('20'||\"Year\"::text ||'-'|| \"Month\"::text ||'-'|| \"Day\" ::text ||' '|| \"Hour\"::text || ':' || \"Minute\" ::text || ':' ||\"Second\")::timestamp as t, \"$valuecol\" from \"$table\" a, \"tblHydroMetParamsType\" b where b.\"HydroMetParamsTypeId\"= a.\"HydroMetParamsTypeId\" and (('20'||\"Year\"::text ||'-'|| \"Month\"::text ||'-'|| \"Day\" ::text ||' '|| \"Hour\"::text || ':' || \"Minute\" ::text || ':' || \"Second\")::timestamp  BETWEEN ('20$FY-$FM-$FD $h:$m:0') AND ('20$TY-$TM-$TD $h2:$m2:0')) and a.\"HydroMetParamsTypeId\"='$PARAMS' and a.\"StationId\"= '$s_id' and a.\"Flag\"= '1'  and SensorType='Virtual' order by \"HydroMetShefCode\",t";
                             }
                           
                            



                 }



                 $csv++;

 


  }
}
 $_SESSION['result_set3']=$result_set3;
//echo "<script>window.location.href='exportcsv.php'</script>";
 }
 ?>


<!-- Modal -->
  <div class="modal fade"  id="myModal" role="dialog" style="background-color: white" >
  <div style="width:100%;height:30px;background-color:#539CCC">
   <button type="button" style="float: right;" class="close" data-dismiss="modal">&times;</button>
</div>

   
    

               <div style="width:100%!important;height: 100%;overflow-y: hidden; overflow-x: hidden;" id="graph22" name='graph22'>

    
    </div>
  </div>

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
}



include_once "MyAlert.php";
  myConfirm('Do you want to delete!');  ?>
</body>
</html>


 <!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script> 
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
        <script type="text/javascript" src="assets/paging.js"></script>  <script type="text/javascript">
            $(document).ready(function() {
                $('#tableData').paging({limit:20});
            });
        </script>
        <script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-36251023-1']);
  _gaq.push(['_setDomainName', 'jqueryscript.net']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>-->
<script type="text/javascript">
  
 function showHideTable()
  {
var check= document.getElementById('table_ckeck');

if (check.checked) 
{
document.getElementById('tableData').style.display="";

}
else
{
  document.getElementById('tableData').style.display="none";

  }
}
</script>