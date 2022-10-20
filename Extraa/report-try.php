<!DOCTYPE html> 


  <?php
                include("includes/link.php");
              ?>

              <?php
                include("includes/header.php");
                
              ?>
<?php
include_once 'database.php';


if(isset($_POST['chekedstn']))
{
  $stnnames='';
  $checkbox1=$_POST['chekedstn'];
  foreach($checkbox1 as $chk1)  
   { 
    $stnnames.=$chk1.";";

   }

   //echo "<script>window.location.href='report.php?select1='+$stnnames<script>";
 
  // header("Location : report.php?select1=$stnnames");
}
?>


<link rel="stylesheet" type="text/css" href="/HydrometV2/assets/css/MyTable.css"> 

<style type="text/css">
  @media(min-width:992px) and (max-width: 1020px){
 .bootstrap-select:not([class*=col-]):not([class*=form-control]):not(.input-group-btn) {
    width: 150px !important;
}
}
@media(min-width:1021px) and (max-width: 1225px){
 .bootstrap-select:not([class*=col-]):not([class*=form-control]):not(.input-group-btn) {
    width: 180px !important;
}
}
  <?php 

if ($_GET["report_type"]=="Rain") {
  ?>
 table 
  {
    min-width: 20%;
  }
  <?php
}
else
{
  ?>
  table 
  {
    min-width: 60%;
  }
  <?php
}
?>
</style>
 
   <script type="text/javascript">


   function PlotGraph() {
        //debugger;
        
        var selected = $("#SensorList option:selected");
        var params = "";
        selected.each(function () {
            params +=$(this).val() + ";";
        });
        var station = document.getElementById("Sname").value;
        var typereport=$("#report_type").val();

       if(document.getElementById("Sname").value.trim()=="")
       {
        alert('Please Search and Select Station!');
        return;
       }
       else if (document.getElementById("SensorList").value.trim()=="") {
        alert('Please Select Sensor!');
        return;
       }
       else if (document.getElementById("EditStartDate").value.trim()==""){
        alert('Please enter Start Date');
        return;
       }
       else if(document.getElementById("EditEndDate").value.trim()=="")
       {
        //debugger;
        var yearFrom;
        var monthFrom;
        var dayFrom;
        var yearTo;
        var monthTo;
        var dayTo;
        var currentdate = new Date();
        var frdate = document.getElementById("EditStartDate").value.trim();
        var parts =frdate.split('-');
        var frdate = new Date(parts[0], parts[1] - 1, parts[2]);
        var currentdate = new Date();
        
        yearFrom = frdate.getFullYear();
        monthFrom = frdate.getMonth() + 1;
        dayFrom = frdate.getDate()+1;

        yearTo = currentdate.getFullYear();
        monthTo = currentdate.getMonth() + 1;
        dayTo = currentdate.getDate()+1;

        
                
        window.location.href= 'report.php?FY=' + yearFrom + "&FM=" + monthFrom + "&FD=" + dayFrom + '&TY=' + yearTo + "&TM=" + monthTo + "&TD=" + dayTo + "&PARAMS=" + params + "&station=" + station +"&report_type="+typereport;
      }

      else{
        //debugger;
        var yearFrom;
        var monthFrom;
        var dayFrom;
        var yearTo;
        var monthTo;
        var dayTo;
        var frdate = document.getElementById("EditStartDate").value.trim();
        var endate = document.getElementById("EditEndDate").value.trim();
        var parts =frdate.split('-');
        var parts2 =endate.split('-');
        var frdate = new Date(parts[0], parts[1] - 1, parts[2]);
        var endate = new Date(parts2[0], parts2[1] - 1, parts2[2]);
        
        
        
        //alert(frdate);
        
        yearFrom = frdate.getFullYear();
        monthFrom = frdate.getMonth() + 1;
        dayFrom = frdate.getDate();
        //alert(dayFrom);
        yearTo = endate.getFullYear();
        monthTo = endate.getMonth() + 1;
        dayTo = endate.getDate();

        
                
        window.location.href= 'report.php?FY=' + yearFrom + "&FM=" + monthFrom + "&FD=" + dayFrom + '&TY=' + yearTo + "&TM=" + monthTo + "&TD=" + dayTo + "&PARAMS=" + params + "&station=" + station +"&report_type="+typereport;
      }


     
           }
                </script>
               
   <style type="text/css">
    #btnExport
    {
      padding: 5px;
      /*margin-top: 5px;*/
      display: none;
    }
    #exporttopdf{
      padding: 5px;
      /*margin-top: 5px;*/
      display: none;
    }
    .span1
    {
      color: red;
      

    }
    hr {
    display: block;
    height: 1px;
    border: 0;
    border-top: 1px solid #ccc;
    margin: 1em 0;
    padding: 0;
}

   </style>


  
      <script>


$('.selectpicker').selectpicker({
  style: 'btn-info',
  size: 4
});



</script>

   <link rel="stylesheet" href="assets/jquery-ui.css">

    <script type="text/javascript" src="assets/jquery.js"></script>
<script type="text/javascript" src="assets/jquery-ui.js"></script>


    



 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/i18n/defaults-*.min.js"></script>




<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

      
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>

 
 <script type="text/javascript">
 var type="";
 $(document).ready(function(){
type=$("#report_type").val();
 });
$(function() 
{
 $( "#Sname" ).autocomplete({
  source: '<?php if(trim($_GET["report_type"])=="Custom") echo "autocompelete.php"; else echo "autocompeleteByType.php"; ?>?type='+type,
   close: function( event, ui ) { GetData(); }
 });
 //GetData();
});


</script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.0.0-alpha.1/jspdf.plugin.autotable.min.js"></script> -->

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.22/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>

 <script>
  function demoFromHTML()
  {
    // var doc = new jsPDF('p', 'pt','letter');
    // doc.addHTML($('#customtable')[0], 15, 15, {
    //   'background': '#fff',
    // }, function() {
    //   doc.save('report.pdf');
    //     });
    var sTable = document.getElementById('customtable').innerHTML;

        var style = "<style>";
        style = style + "table {width: 100%;font: 17px Calibri;}";
        style = style + "table, th, td {border: solid 1px #DDD; border-collapse: collapse;";
        style = style + "padding: 2px 3px;text-align: center;}";
        style = style + "</style>";

        // CREATE A WINDOW OBJECT.
        var win = window.open('', '', 'height=700,width=700');

        win.document.write('<html><head>');  // <title> FOR PDF HEADER.
        win.document.write(style);          // ADD STYLE INSIDE THE HEAD TAG.
        win.document.write('</head>');
        win.document.write('<body>');
        win.document.write(sTable);         // THE TABLE CONTENTS INSIDE THE BODY TAG.
        win.document.write('</body></html>');

        win.document.close();   // CLOSE THE CURRENT WINDOW.

        win.print();    // PRINT THE CONTENTS.
    } 


    $(document).ready(function(){

      if ( $('[type="date"]').prop('type') != 'date' ) {
    $('[type="date"]').datepicker();
}

      $("#type_of_report").change(function(){
      var val=$("#type_of_report").val();

    
if (val.trim()=="Monthly") {
        $("#month_table").css("display","");
        $("#daily_table").attr("value", "dd-mm-yyyy");
        $("#daily_table").css("display","none");
        $("#Annual_table").css("display","none");

        //$("#details").html(val+" Summary for "+$("#months option:selected").text()+" "+$("#years option:selected").text());
      }
      else if(val.trim()=="Daily")
      {
                $("#Annual_table").css("display","none");

        $("#month_table").css("display","none");
        $("#daily_table").css("display","");

        //$("#details").html(val+" Summary for "+$("#EditStartDate").val());
      }
      else if(val.trim()=="Annual")
      {
       $("#month_table").css("display","none");
        $("#daily_table").attr("value", "dd-mm-yyyy");
        $("#daily_table").css("display","none");
        $("#Annual_table").css("display","");

        //$("#details").html(val+" Summary for "+$("#EditStartDate").val());
      }
      else
      {
window.location.href="GraphMultiple2.php";

      }

      });


$("#report_type").change(function()
  {
    var val=$("#report_type").val();

       window.location.href="report.php?report_type="+val;


  
  });

    });
</script>
<script src="//cdn.rawgit.com/rainabba/jquery-table2excel/1.1.0/dist/jquery.table2excel.min.js"></script>
<script type="text/javascript">
  function exportTableToExcel(){
    $("#customtable").table2excel({
    exclude: ".excludeThisClass",
    name: "report",
    filename: "report.xls", // do include extension
    preserveColors: true // set to true if you want background colors and font colors preserved
});
}
</script>
  <script type="text/javascript">
    function emptyHours()
{
  document.getElementById('EditStartDate').value="";
}

function getSensors()
{

var stn=document.getElementById('Sname').value;

var selected_sensor=<?php if (isset($_GET["PARAMS"])){ echo json_encode(trim($_GET["PARAMS"]));}else { echo json_encode(""); } ?>;
  var xhttp2 = new XMLHttpRequest();
  xhttp2.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
var data = this.responseText;
var json=JSON.parse(data);
var list=[];
for(var x in json)
{
  list.push(json[x]);

}
  var e=document.getElementById("SensorList");
  e.innerHTML="";
   var x = document.createElement("OPTION");
    x.setAttribute("value", "");
    var t = document.createTextNode("Sensor");
    x.appendChild(t);
    x.disabled=true;
    x.selected=true;
    e.appendChild(x);

for (var i = 0; i < list.length; i++) {


    var x = document.createElement("OPTION");
    x.setAttribute("value", list[i]);
    var t = document.createTextNode(list[i]);

    x.appendChild(t);
    if (selected_sensor==list[i]) 
    {
         x.selected=true; 
    }
    e.appendChild(x);



}

    }
  };
  xhttp2.open("GET", "getSensorsforGraph.php?station="+stn, true);
  xhttp2.send();
}




$(document).ready(function()
  {
    $("#Sname").on('change',function(){
      //GetData();
    });
  });

    function GetData()
    {
      var stn=document.getElementById('Sname').value;
      var val=$("#report_type").val();
      var type_of_report=$("#type_of_report").val();
      window.location.href='report.php?station='+stn+"&report_type="+val;//"&type="+type_of_report;
       
     }

  
   </script>
   <form>
   <br><center>
   <div style="width: 98%">
   <div class="row" >

<div class="col-md-2" style="margin-top: 5px;" > 
   <select class="form-control" id="report_type">
  <!--<option value="Climate" <?php if (isset($_GET['report_type'])) {
  if(trim($_GET['report_type'])=="Climate") echo "selected";
  } ?>>Climate</option>
  <option value="Rain" <?php if (isset($_GET['report_type'])) {
  if(trim($_GET['report_type'])=="Rain") echo "selected";
  } ?>>Rain</option>

  <option value="Reservoir" <?php if (isset($_GET['report_type'])) {
  if(trim($_GET['report_type'])=="Reservoir") echo "selected";
  } ?>>Reservoir</option>
   <option value="River" <?php if (isset($_GET['report_type'])) {
  if(trim($_GET['report_type'])=="River") echo "selected";
  } ?>>River</option> -->
    <option value="Custom" <?php if (isset($_GET['report_type'])) {
  if(trim($_GET['report_type'])=="Custom") echo "selected";
  } ?>>Custom</option>
  </select>
  </div>



 
  <?php
    if($_GET['report_type']=='Custom'){
  ?>
  <div class="col-md-2" style="margin-top: 5px;" >  <input type="text" id="Sname"  placeholder="Station Name" name="StationName" class="form-control" required onchange="getSensors()" value='<?php 
 if (isset($_GET['station'])) 
 {
echo $_GET['station']; 
$_SESSION['SName']=$_GET['station']; 
}


 ?>'> 

  </div>

    <div class="col-md-2" style="margin-top: 5px;" > 
<?php      $stn_name='';
     $data=trim($_GET['station']);
         $dataU=strtoupper($data);        
         $dataL=strtolower($data);
$result_stn=pg_query("select \"StationType\" from \"tblStationType\"");
 if(pg_num_rows($result_stn)>0)
 {
 while($row_user=pg_fetch_array($result_stn))
 {
    // $sql_query= "select \"StationName\" from \"tblStation\" where \"StationName\" like '%" .$data."%' or \"StationName\" like '%".$dataU."%' or \"StationName\" like '%".$dataL."%' ";
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
    $sql_query1="SELECT \"Sensor\" FROM \"SensorValues\" where \"StationFullName\"='$stn_name' order by \"Sensor\"";

 
  ?>

     <select name="SensorList"  id="SensorList" <?php if (isset($_GET['report_type'])) {
      if (trim($_GET['report_type'])=="Rain") {
      echo "class='form-control'";
     }
  else
     {
      echo "class='selectpicker' multiple=''";
    }

     } else echo "class='selectpicker' multiple=''";
 ?>>

     <?php 
  

 
  $result_set1=pg_query($sql_query1);

  if(pg_num_rows($result_set1)>0)
  {
        while($row=pg_fetch_row($result_set1))
    {

?>

<option value='<?php echo $row[0]?>' <?php if (isset($_GET['PARAMS'])) 
{
$temp=explode(';', trim($_GET['PARAMS']));
for ($i=0; $i <count($temp) ; $i++) { 
  # code...

 if ($temp[$i]===trim($row[0])) 

{ echo 'selected';}} }?> > <?php echo $row[0]?> </option>
<?php

    }
}
    ?>
      
    </select>

    </div>
    <?php

      if (isset($_GET['FY']) && isset($_GET['FM']) && isset($_GET['FD'])) {
          $da = strtotime($_GET['FY'] . '/' . $_GET['FM'] . '/' . $_GET['FD']);
      }
      ?>
         <?php

      if (isset($_GET['TY']) && isset($_GET['TM']) && isset($_GET['TD'])) {
          $da2 = strtotime($_GET['TY'] . '/' . $_GET['TM'] . '/' . $_GET['TD']);
      }
    ?>
    <div class="col-md-2" style="margin-top: 5px; margin-left: 15px">
      <td class="td-inline-element" style="padding-left: 3px"> <div class="form-group"> <input style="width: 100%" type="date" name="EditStartDate" id="EditStartDate" class="form-control" required value="<?php if(isset($da)) { echo date('Y-m-d',$da);} ?>"></div></td>
    </div>
  
    <div class="col-md-2" style="margin-top: 5px;">  
      <td><input style="width: 100%" type="date" name="EditEndDate" id="EditEndDate" class="form-control" required value="<?php if(isset($da)) { echo date('Y-m-d',$da2);} ?>" ></td>
    </div>
  
    <div class="col-md-1" style="margin-top: 3px;" > 
      <table>
        <tr>
          <td style="padding-top: 3px" >
            <input type="button"  onclick="PlotGraph()" title="get report!" class="btn btn-sm btn-primary" name="btnPlot" value="Get"> 
          </td>
          <td class="pad" id="pad">
            <img src="assets/images/excel.png" id="btnExport" title="export to excel!" onclick="javascript:exportTableToExcel();" >
          </td>
          <td class="pad" id="pad">
            <img  src="assets/images/pdf.png" id="exporttopdf" onclick="demoFromHTML()" title="export to pdf!" >
          </td>
        </tr>
      </table>
 <!--<a   class="btn btn-sm btn-info" name="btnExportToCvs" href="javascript:window.location.href='exportcsv2.php'">Export</a>-->
    </div>


    </div>
    <?php
  }else{?>

    <?php
  }?>
</div>
</center>

</form>




<?php

$report_type=trim($_GET['report_type']);
//echo $report_type;
if (isset($_GET["PARAMS"]))
{
 

      $tempParam = trim($_GET["PARAMS"]);
          
$PARAMS=explode(';' ,$tempParam);
  $station=getStationShef(trim($_GET['station']));
$coun_sen=0;
$Climate_table="";
if($report_type=='Custom'){
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
  $sensorCondition='';
  for($i=0;$i<count($PARAMS);$i++){
    if($PARAMS[$i]!=""){
      $sensorCondition.="\"Sensor\"='$PARAMS[$i]' or";
    }
  }
  $sensorCondition=rtrim($sensorCondition ,'or');

  $paramsshef=explode(";", $realsensors);

  $HydroMetShefCodeCodition='';
  $ShefCondition=array();
  for ($i=0; $i <count($paramsshef); $i++) 
  { 
    if (trim($paramsshef[$i])!="")
    {
      $result_set=  pg_query("SELECT \"HydroMetParamsTypeId\" FROM \"tblHydroMetParamsType\" where 
              \"HydroMetShefCode\" = '$paramsshef[$i]'"); 
      $row=pg_fetch_array($result_set);
      array_push($ShefCondition, $row[0]);
    }
  }
  for ($i=0; $i <count($ShefCondition); $i++) 
  { 
    if (trim($ShefCondition[$i])!="") 
    { 
      $HydroMetShefCodeCodition.=" a.\"HydroMetParamsTypeId\"=$ShefCondition[$i] or";       
    }
  }

  $paramsshefVirtual=explode(";", $vertualsensors);
  $HydroMetShefCodeCoditionVirtual='';

  for ($i=0; $i <count($paramsshefVirtual); $i++) 
  { 
    if (trim($paramsshefVirtual[$i])!="")
    {
      $result_set=  pg_query("SELECT \"HydroMetParamsTypeId\" FROM \"tblHydroMetParamsType\" where 
              \"HydroMetShefCode\" = '$paramsshefVirtual[$i]'");
      $row=pg_fetch_array($result_set);
      $HydroMetShefCodeCoditionVirtual.=" a.\"HydroMetParamsTypeId\"=$row[0] or";
    }
  }

  $HydroMetShefCodeCoditionVirtual=rtrim($HydroMetShefCodeCoditionVirtual ,'or');
  $HydroMetShefCodeCodition=rtrim($HydroMetShefCodeCodition ,'or');
  
  $FY = trim($_GET["FY"]);
  $FY = substr($FY,-2);
  $FM = trim($_GET["FM"]);
  $FD = trim($_GET["FD"]);
  $TY = trim($_GET["TY"]);
  $TY = substr($TY,-2);
  $TM = trim($_GET["TM"]);
  $TD = trim($_GET["TD"]);
  $DateTime = new DateTime();
  $h2 = date('H');  
  $m2=date('m');
  
  //$station=getStationShef(trim($_GET['station']));
  $m = date('m');
  $h = $DateTime->format("H");
  $dataU=strtoupper($station);
  $temp=array();
  $temp_Y=str_split($Y);
  $Y=$DateTime->format("Y");
  $Y=substr($Y, -2);
  $temp_YEAR=$temp_Y[2]."".$temp_Y[3];
  pg_query("CREATE EXTENSION if not exists tablefunc");
  if(($FY<$Y)&&($Y=$TY)){
    $TY1=$FY;
    $TM1='12';
    $TD1='31';
    $FY1=$TY;
    $FM1='1';
    $FD1='1';
  }

  
  $result_table=  pg_query("SELECT * FROM \"tblAllTables\"  WHERE \"TableName\" like '%".$station."_1%' or \"TableName\" like '%".$dataU."_1%' or  \"TableName\" like '%".$station."_2%' or \"TableName\" like '%".$dataU."_2%' order by 1 ASC");
  
  
  if (isset($result_table)) {

    $stn_id=  pg_query("SELECT \"StationId\" FROM \"tblStation\" where \"StationName\"='$station' or \"StationName\"='$dataU'");
    $id_row=pg_fetch_array($stn_id);
    $s_id= $id_row['StationId'];
    $result_set=array();
    $sensor_count=array();
    $i=0;

    while ($tablerows=pg_fetch_array($result_table)) 
    {
      
      $table="'".$tablerows['TableName']."'" ;
      //echo $table;
      if(((strpos($table, $FY))||(strpos($table, $TY)))&&($FY<$Y)&&($TY=$Y))
      {
        

        if(strpos($table, $FY))
        {
          
          $sql_query_real="SELECT * FROM crosstab ('SELECT  (''20''||\"Year\"::text ||''-''|| \"Month\"::text ||''-''|| \"Day\" ::text ||'' ''|| \"Hour\"::text || '':'' || \"Minute\" ::text ||'':'' ||\"Second\")::timestamp  as t,\"HydroMetParamsTypeId\", \"Value\" FROM  \"'$table'\" a where ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY,$FM,$FD) AND ($TY1,$TM1,$TD1)) and a.\"StationId\"=$s_id and ($HydroMetShefCodeCodition) order by 1 ','SELECT distinct \"HydroMetParamsTypeId\" FROM \"'$table'\" as a WHERE ($HydroMetShefCodeCodition)') AS final_result(t timestamp";
          $col_set=pg_query("SELECT distinct \"HydroMetParamsTypeId\" FROM \"$table\" as a WHERE ($HydroMetShefCodeCodition)");
        
          while ($cols=pg_fetch_array($col_set)) { 
            $sql_query_real.=",\"".$cols[0]."\" double precision";
          }
          $sql_query_real.=")";

          $sql_query_virtual="SELECT * FROM crosstab ('SELECT  (''20''||\"Year\"::text ||''-''||\"Month\"::text ||''-''|| \"Day\" ::text ||'' ''||\"Hour\"::text || '':'' || \"Minute\" ::text ||'':'' ||\"Second\")::timestamp  as t,\"HydroMetParamsTypeId\", \"VirtualValue\" FROM \"'$table'\" a where ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY,$FM,$FD) AND ($TY1,$TM1,$TD1)) and a.\"StationId\"=$s_id and  \"sensortype\"=''Virtual'' and ($HydroMetShefCodeCoditionVirtual) order by 1','SELECT distinct \"HydroMetParamsTypeId\" FROM \"'$table'\" as a where \"sensortype\"=''Virtual'' AND ($HydroMetShefCodeCoditionVirtual)') AS final_result(t timestamp";

          $col_set=pg_query("SELECT distinct \"HydroMetParamsTypeId\" FROM \"$table\" as a where a.\"sensortype\"='Virtual' AND ($HydroMetShefCodeCoditionVirtual)");
          

          while ($cols=pg_fetch_array($col_set)) { 
            $sql_query_virtual.=",\"".$cols[0]."\" double precision";
          }

          $sql_query_virtual.=")";

          $sql_query="select t2.t";

          $col_set=pg_query("select \"SHEF\",\"SensorType\" FROM \"SensorValues\" where (\"StationFullName\"= '$stn_name') and ($sensorCondition)");
        
          while ($cols=pg_fetch_array($col_set)) 
          {
            $counted=count($PARAMS)-1;
         
            $col=pg_fetch_array(pg_query("SELECT  \"HydroMetParamsTypeId\" FROM \"tblHydroMetParamsType\" where  \"HydroMetShefCode\"='$cols[0]'"));
          
            if (trim($cols[1])=='Real') 
            {
              if(pg_num_rows(pg_query("select distinct \"HydroMetParamsTypeId\" FROM  \"$table\" a where ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY,$FM,$FD) AND ($TY1,$TM1,$TD1)) and a.\"StationId\"=$s_id  and \"HydroMetParamsTypeId\"=$col[0] order by 1 asc"))>0)
              {
                $sql_query .=",t1.\"$col[0]\"" ;
                $sensor_count[$i]++;
              
              }
              else{
                $colum=$col[0];
              }
            }
            else
            {
              if(pg_num_rows(pg_query("select distinct \"HydroMetParamsTypeId\" FROM  \"$table\" a where ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY,$FM,$FD) AND ($TY1,$TM1,$TD1)) and a.\"StationId\"=$s_id  and \"HydroMetParamsTypeId\"=$col[0] and \"sensortype\"='Virtual' order by 1 asc"))>0)
              {
                $sql_query .=",t2.\"$col[0]\"";
                $sensor_count[$i]++;
              
              }
              else{
                $colum=$col[0];
              }
            }
          }
        
          if($sensor_count[$i]!=""){
          
            if($sensor_count[$i]<$counted){
            
              $sql_query.=",NULL as \"$colum\"";
            
            }
           
          }
          $sql_query=rtrim($sql_query,",");
          if($realsensors!=''){
           
            $sql_query.=" from (".$sql_query_real.") t1 FULL OUTER JOIN (".$sql_query_virtual.") t2 on t2.t=t1.t order by t2.t asc";
           
          }
          else{
            $sql_query=$sql_query_virtual;
          }
        
          if(pg_num_rows(pg_query("SELECT distinct \"HydroMetParamsTypeId\" FROM \"$table\" as a where a.\"sensortype\"='Virtual' and ($HydroMetShefCodeCoditionVirtual)"))<=0)
          {
            $sql_query="select t1.t";
          
            $col_set=pg_query("select \"SHEF\",\"SensorType\" FROM \"SensorValues\" where (\"StationFullName\"= '$stn_name') and ($sensorCondition)");
            while ($cols=pg_fetch_array($col_set)) 
            {
              $counted=count($PARAMS)-1;
            
              $col=pg_fetch_array(pg_query("SELECT  \"HydroMetParamsTypeId\"   FROM \"tblHydroMetParamsType\" where  \"HydroMetShefCode\"='$cols[0]'"));

              if (trim($cols[1])=='Real') 
              {
                if(pg_num_rows(pg_query("select distinct \"HydroMetParamsTypeId\" FROM  \"$table\" a where ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY,$FM,$FD) AND ($TY1,$TM1,$TD1)) and a.\"StationId\"=$s_id  and \"HydroMetParamsTypeId\"=$col[0] order by 1 desc"))>0)
                {
                  $sql_query .=",t1.\"$col[0]\"" ;
                  $sensorcount[$i]++;
                }
                else
                {
                  $colum=$col[0];
                }
              }
            }
          
            if($sensorcount[$i]!=""){
            
              if($sensorcount[$i]<$counted)
              {
              
                $sql_query.=",NULL as \"$colum\"";
              
              }
           
            }

            $sql_query.=" from (".$sql_query_real." ) t1";
          }
         
          $result_set[$i]=$sql_query;
          
          $i++;
        }
        else if(strpos($table, $TY))
        {
          
          $sql_query_real="SELECT * FROM crosstab ('SELECT  (''20''||\"Year\"::text ||''-''|| \"Month\"::text ||''-''|| \"Day\" ::text ||'' ''|| \"Hour\"::text || '':'' || \"Minute\" ::text ||'':'' ||\"Second\")::timestamp  as t,\"HydroMetParamsTypeId\", \"Value\" FROM  \"'$table'\" a where ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY1,$FM1,$FD1) AND ($TY,$TM,$TD)) and a.\"StationId\"=$s_id and ($HydroMetShefCodeCodition) order by 1 ','SELECT distinct \"HydroMetParamsTypeId\" FROM \"'$table'\" as a WHERE ($HydroMetShefCodeCodition)') AS final_result(t timestamp";
          $col_set=pg_query("SELECT distinct \"HydroMetParamsTypeId\" FROM \"$table\" as a WHERE ($HydroMetShefCodeCodition)");
        
          while ($cols=pg_fetch_array($col_set)) { 
            $sql_query_real.=",\"".$cols[0]."\" double precision";
          }
          $sql_query_real.=")";

          $sql_query_virtual="SELECT * FROM crosstab ('SELECT  (''20''||\"Year\"::text ||''-''||\"Month\"::text ||''-''|| \"Day\" ::text ||'' ''||\"Hour\"::text || '':'' || \"Minute\" ::text ||'':'' ||\"Second\")::timestamp  as t,\"HydroMetParamsTypeId\", \"VirtualValue\" FROM \"'$table'\" a where ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY1,$FM1,$FD1) AND ($TY,$TM,$TD)) and a.\"StationId\"=$s_id and  \"sensortype\"=''Virtual'' and ($HydroMetShefCodeCoditionVirtual) order by 1','SELECT distinct \"HydroMetParamsTypeId\" FROM \"'$table'\" as a where \"sensortype\"=''Virtual'' AND ($HydroMetShefCodeCoditionVirtual)') AS final_result(t timestamp";

          $col_set=pg_query("SELECT distinct \"HydroMetParamsTypeId\" FROM \"$table\" as a where a.\"sensortype\"='Virtual' AND ($HydroMetShefCodeCoditionVirtual)");
          

          while ($cols=pg_fetch_array($col_set)) { 
            $sql_query_virtual.=",\"".$cols[0]."\" double precision";
          }

          $sql_query_virtual.=")";

          $sql_query="select t2.t";

          $col_set=pg_query("select \"SHEF\",\"SensorType\" FROM \"SensorValues\" where (\"StationFullName\"= '$stn_name') and ($sensorCondition)");
        
          while ($cols=pg_fetch_array($col_set)) 
          {
            $counted=count($PARAMS)-1;
         
            $col=pg_fetch_array(pg_query("SELECT  \"HydroMetParamsTypeId\" FROM \"tblHydroMetParamsType\" where  \"HydroMetShefCode\"='$cols[0]'"));
          
            if (trim($cols[1])=='Real') 
            {
              if(pg_num_rows(pg_query("select distinct \"HydroMetParamsTypeId\" FROM  \"$table\" a where ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY1,$FM1,$FD1) AND ($TY,$TM,$TD)) and a.\"StationId\"=$s_id  and \"HydroMetParamsTypeId\"=$col[0] order by 1 asc"))>0)
              {
                $sql_query .=",t1.\"$col[0]\"" ;
                $sensor_count[$i]++;
              
              }
              else{
                $colum=$col[0];
              }
            }
            else
            {
              if(pg_num_rows(pg_query("select distinct \"HydroMetParamsTypeId\" FROM  \"$table\" a where ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY1,$FM1,$FD1) AND ($TY,$TM,$TD)) and a.\"StationId\"=$s_id  and \"HydroMetParamsTypeId\"=$col[0] and \"sensortype\"='Virtual' order by 1 asc"))>0)
              {
                $sql_query .=",t2.\"$col[0]\"";
                $sensor_count[$i]++;
              
              }
              else{
                $colum=$col[0];
              }
            }
          }
        
          if($sensor_count[$i]!=""){
          
            if($sensor_count[$i]<$counted){
            
              $sql_query.=",NULL as \"$colum\"";
            
            }
           
          }
          $sql_query=rtrim($sql_query,",");
          if($realsensors!=''){
           
            $sql_query.=" from (".$sql_query_real.") t1 FULL OUTER JOIN (".$sql_query_virtual.") t2 on t2.t=t1.t order by t2.t asc";
           
          }
          else{
            $sql_query=$sql_query_virtual;
          }
        
          if(pg_num_rows(pg_query("SELECT distinct \"HydroMetParamsTypeId\" FROM \"$table\" as a where a.\"sensortype\"='Virtual' and ($HydroMetShefCodeCoditionVirtual)"))<=0)
          {
            $sql_query="select t1.t";
          
            $col_set=pg_query("select \"SHEF\",\"SensorType\" FROM \"SensorValues\" where (\"StationFullName\"= '$stn_name') and ($sensorCondition)");
            while ($cols=pg_fetch_array($col_set)) 
            {
              $counted=count($PARAMS)-1;
            
              $col=pg_fetch_array(pg_query("SELECT  \"HydroMetParamsTypeId\"   FROM \"tblHydroMetParamsType\" where  \"HydroMetShefCode\"='$cols[0]'"));

              if (trim($cols[1])=='Real') 
              {
                if(pg_num_rows(pg_query("select distinct \"HydroMetParamsTypeId\" FROM  \"$table\" a where ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY1,$FM1,$FD1) AND ($TY,$TM,$TD)) and a.\"StationId\"=$s_id  and \"HydroMetParamsTypeId\"=$col[0] order by 1 desc"))>0)
                {
                  $sql_query .=",t1.\"$col[0]\"" ;
                  $sensorcount[$i]++;
                }
                else
                {
                  $colum=$col[0];
                }
              }
            }
          
            if($sensorcount[$i]!=""){
            
              if($sensorcount[$i]<$counted)
              {
              
                $sql_query.=",NULL as \"$colum\"";
              
              }
           
            }

            $sql_query.=" from (".$sql_query_real." ) t1";
          }
         
          $result_set[$i]=$sql_query;
          
          $i++;
        }
      }
      
      else if(((strpos($table, $FY))&&(strpos($table, $TY))&&($FY=$Y)&&($TY=$Y))||((strpos($table, $FY))&&(strpos($table, $TY))&&($FY<$Y)&&($TY<$Y)))
      {

        $sql_query_real="SELECT * FROM crosstab ('SELECT  (''20''||\"Year\"::text ||''-''|| \"Month\"::text ||''-''|| \"Day\" ::text ||'' ''|| \"Hour\"::text || '':'' || \"Minute\" ::text ||'':'' ||\"Second\")::timestamp  as t,\"HydroMetParamsTypeId\", \"Value\" FROM  \"'$table'\" a where ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY,$FM,$FD) AND ($TY,$TM,$TD)) and a.\"StationId\"=$s_id and ($HydroMetShefCodeCodition) order by 1 ','SELECT distinct \"HydroMetParamsTypeId\" FROM \"'$table'\" as a WHERE ($HydroMetShefCodeCodition)') AS final_result(t timestamp";
        $col_set=pg_query("SELECT distinct \"HydroMetParamsTypeId\" FROM \"$table\" as a WHERE ($HydroMetShefCodeCodition)");
      
        while ($cols=pg_fetch_array($col_set)) { 
          $sql_query_real.=",\"".$cols[0]."\" double precision";
        }
        $sql_query_real.=")";

        $sql_query_virtual="SELECT * FROM crosstab ('SELECT  (''20''||\"Year\"::text ||''-''||\"Month\"::text ||''-''|| \"Day\" ::text ||'' ''||\"Hour\"::text || '':'' || \"Minute\" ::text ||'':'' ||\"Second\")::timestamp  as t,\"HydroMetParamsTypeId\", \"VirtualValue\" FROM \"'$table'\" a where ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY,$FM,$FD) AND ($TY,$TM,$TD)) and a.\"StationId\"=$s_id and  \"sensortype\"=''Virtual'' and ($HydroMetShefCodeCoditionVirtual) order by 1','SELECT distinct \"HydroMetParamsTypeId\" FROM \"'$table'\" as a where \"sensortype\"=''Virtual'' AND ($HydroMetShefCodeCoditionVirtual)') AS final_result(t timestamp";

        $col_set=pg_query("SELECT distinct \"HydroMetParamsTypeId\" FROM \"$table\" as a where a.\"sensortype\"='Virtual' AND ($HydroMetShefCodeCoditionVirtual)");
        

        while ($cols=pg_fetch_array($col_set)) { 
          $sql_query_virtual.=",\"".$cols[0]."\" double precision";
        }

        $sql_query_virtual.=")";

        $sql_query="select t2.t";

        $col_set=pg_query("select \"SHEF\",\"SensorType\" FROM \"SensorValues\" where (\"StationFullName\"= '$stn_name') and ($sensorCondition)");
      
        while ($cols=pg_fetch_array($col_set)) 
        {
          $counted=count($PARAMS)-1;
       
          $col=pg_fetch_array(pg_query("SELECT  \"HydroMetParamsTypeId\" FROM \"tblHydroMetParamsType\" where  \"HydroMetShefCode\"='$cols[0]'"));
        
          if (trim($cols[1])=='Real') 
          {
            if(pg_num_rows(pg_query("select distinct \"HydroMetParamsTypeId\" FROM  \"$table\" a where ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY,$FM,$FD) AND ($TY,$TM,$TD)) and a.\"StationId\"=$s_id  and \"HydroMetParamsTypeId\"=$col[0] order by 1 asc"))>0)
            {
              $sql_query .=",t1.\"$col[0]\"" ;
              $sensor_count[$i]++;
            
            }
            else{
              $colum=$col[0];
            }
          }
          else
          {
            if(pg_num_rows(pg_query("select distinct \"HydroMetParamsTypeId\" FROM  \"$table\" a where ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY,$FM,$FD) AND ($TY,$TM,$TD)) and a.\"StationId\"=$s_id  and \"HydroMetParamsTypeId\"=$col[0] and \"sensortype\"='Virtual' order by 1 asc"))>0)
            {
              $sql_query .=",t2.\"$col[0]\"";
              $sensor_count[$i]++;
            
            }
            else{
              $colum=$col[0];
            }
          }
        }
      
        if($sensor_count[$i]!=""){
        
          if($sensor_count[$i]<$counted){
          
            $sql_query.=",NULL as \"$colum\"";
          
          }
         
        }
        $sql_query=rtrim($sql_query,",");
        if($realsensors!=''){
         
          $sql_query.=" from (".$sql_query_real.") t1 FULL OUTER JOIN (".$sql_query_virtual.") t2 on t2.t=t1.t order by t2.t asc";
         
        }
        else{
          $sql_query=$sql_query_virtual;
        }
      
        if(pg_num_rows(pg_query("SELECT distinct \"HydroMetParamsTypeId\" FROM \"$table\" as a where a.\"sensortype\"='Virtual' and ($HydroMetShefCodeCoditionVirtual)"))<=0)
        {
          $sql_query="select t1.t";
        
          $col_set=pg_query("select \"SHEF\",\"SensorType\" FROM \"SensorValues\" where (\"StationFullName\"= '$stn_name') and ($sensorCondition)");
          while ($cols=pg_fetch_array($col_set)) 
          {
            $counted=count($PARAMS)-1;
          
            $col=pg_fetch_array(pg_query("SELECT  \"HydroMetParamsTypeId\"   FROM \"tblHydroMetParamsType\" where  \"HydroMetShefCode\"='$cols[0]'"));

            if (trim($cols[1])=='Real') 
            {
              if(pg_num_rows(pg_query("select distinct \"HydroMetParamsTypeId\" FROM  \"$table\" a where ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY,$FM,$FD) AND ($TY,$TM,$TD)) and a.\"StationId\"=$s_id  and \"HydroMetParamsTypeId\"=$col[0] order by 1 desc"))>0)
              {
                $sql_query .=",t1.\"$col[0]\"" ;
                $sensorcount[$i]++;
              }
              else
              {
                $colum=$col[0];
              }
            }
          }
        
          if($sensorcount[$i]!=""){
          
            if($sensorcount[$i]<$counted)
            {
            
              $sql_query.=",NULL as \"$colum\"";
            
            }
         
          }

          $sql_query.=" from (".$sql_query_real." ) t1";
        }
      
        $result_set[$i]=$sql_query;
      
        $i++;
      }
    }
  }
  $z=0;
?>
  <script>
    document.getElementById("btnExport").style.display = 'block';
    document.getElementById("exporttopdf").style.display = 'block';
    
  </script>
  <div class="col-md-12" id="customtable">
    <center><h3 style="margin-left: 1%;"><b><?php echo $_GET['station']; ?></b></h3></center>
  <table align="center" id="tab_customtable" style="max-width:99%;min-width:50%" class=" table-responsive table-bordered">
    <tr>
      <th style="background-color:#539CCC;color:white;text-align:center;font-size: 16px;width:350px">Date / Time</th>
      <!-- <th  style="background-color:#539CCC;color:white;text-align:center;font-size: 13px">Sensor</th>-->
<?php
      $result_sensor1=(pg_query("select \"Sensor\",\"Units\",\"SensorType\",\"SHEF\" from \"SensorValues\" where (\"StationFullName\"= '$stn_name') and ($sensorCondition)"));

      // echo("select \"Sensor\",\"Units\",\"SensorType\",\"SHEF\" from \"SensorValues\" where (\"StationFullName\"= '$stn_name') and ($sensorCondition)")."<br>";

      while ($sensor_row=pg_fetch_array($result_sensor1)) 
      {
        // print_r(json_encode($sensor_row));
        $sql="";
        if (trim($sensor_row[2])=="Real") {
    
          $col=pg_fetch_array(pg_query("SELECT  \"HydroMetParamsTypeId\"   FROM \"tblHydroMetParamsType\" where  \"HydroMetShefCode\"='$sensor_row[3]'"));
          $sql=("select distinct \"HydroMetParamsTypeId\" FROM  \"$table\" a where ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY,$FM,$FD) AND ($TY,$TM,$TD)) and a.\"StationId\"=$s_id  and \"HydroMetParamsTypeId\"=$col[0] order by 1 desc");
        }
        else
        {
          $col=pg_fetch_array(pg_query("SELECT  \"HydroMetParamsTypeId\"   FROM \"tblHydroMetParamsType\" where  \"HydroMetShefCode\"='$sensor_row[3]'"));
          $sql="select distinct \"HydroMetParamsTypeId\" FROM  \"$table\" a where ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY,$FM,$FD) AND ($TY,$TM,$TD)) and a.\"StationId\"=$s_id  and \"HydroMetParamsTypeId\"=$col[0]  and \"sensortype\"='Virtual' order by 1 desc";
        }
        //echo "<br><br>$sql";
        // echo pg_num_rows(pg_query($sql));
        //if(pg_num_rows(pg_query($sql))>0) if you don't want Battery(v) use this condition 
        if(pg_num_rows(pg_query($sql))>=0)
        {
?>
          <th style="background-color:#539CCC;color:white;text-align:center;font-size: 13px;"><?php if (isset($sensor_row[0])){echo $sensor_row[0];if ($sensor_row[1]!="") echo" (".$sensor_row[1].")";}else{echo "$sen[0]";}?></th>
<?php
        }
      }
?>
    </tr>
<?php
$resulted_set="";
  for($i=0;$i<count($result_set);$i++){
    if((pg_num_rows(pg_query($result_set[$i])))>0)
    {
      $resulted_set.="(".$result_set[$i].")"." UNION ALL";
    }
  }
  $resulted_set=rtrim($resulted_set,' UNION ALL ');
  //echo $resulted_set;
  $results=pg_query($resulted_set);
  if (isset($results)) {

    if(pg_num_rows($results)>0)
    {
  
      $settings=pg_fetch_array(pg_query("select \"DateFormat\",\"DecimalPlaces\" from \"tblLogo\""));  
      while($row=pg_fetch_row($results))
      {
        if($row[0]!=""){
        $row_count=1;
?>
        <tr>
        <td style="text-align:center;font-size: 13px;height: 14px;width:350px"><?php if (isset($row[0])){ if (trim($row[0])!="icon.png"){$date = strtotime(trim($row[0]));echo date(trim($settings[0]), $date); }}?></td>
                               
<?php 
 
        $result_sensor1=pg_query("select \"Sensor\",\"Units\" from \"SensorValues\" where (\"StationFullName\"= '$stn_name') and ($sensorCondition)");
        $sensor_row=pg_num_rows(($result_sensor1));
        //echo $settings[1];
        for ($i=0; $i <$sensor_row; $i++) { 
?>                                
          <td style="text-align:center;font-size: 13px;height: 14px;"><?php if (isset($row[$row_count])){ echo number_format(floatval($row[$row_count]),$settings[1]);?></td> 
<?php
          }
          $row_count=$row_count+1;
        }
?>
        </tr>
<?php    
      }
    }
      echo "</table></div>";
    }
    else{
      echo "<tr><td>No Data Found in Last 12 Hours!</td></tr></table></div>";
    }
  }
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

}
$temp= graph($vertualsensors,$realsensors,$v_sensor_names,$r_sensor_names);

?>


<script type="text/javascript">
  
  $(document).ready(function(){
var data=<?php echo json_encode($temp);?>;
$("#myTable").html(data);


  });





</script>





<style type="text/css">
  
  #myTable th{
background-color:#539CCC;
color:white;
  }
    #cal_table th{
background-color:#539CCC;
color:white;
  }
</style>
<center>
<div id="myTable_div">
<div id="information">
<h3 style="margin-left: 1%;"><b><?php echo $_GET['station']; ?></b></h3>
<p id="details" style="font-weight: bold;margin-left: 1%;"></p>
</div>


<div>
<table id='myTable'  ng-repeat-end="" class="table-bordered table-hover" style="margin-left: 1%"   >
  
</table>
</div>
<div id="cal_table_div">
<?php if(trim($_GET['report_type'])!="Custom")
{?>
<h4 id="cal_table_header" style="font-weight: bold;margin-left: 1%"><?php echo $_GET['type'];?>  Statistics
</h4>
<?php }?>
<table id="cal_table" style="margin-left: 1%"   class="table-bordered table-hover" >
  
</table>
</div>

 </div>
</center>
<br><br>
<?php
function getSensorName($shef,$type,$stn)
{
 $sensor_set= pg_query("select \"Sensor\" from \"SensorValues\" where \"SHEF\"='$shef' and \"SensorType\"='$type' and \"StationFullName\"='$stn'");

 $row=pg_fetch_array($sensor_set);

return $row[0];
}
function checkSensor($sensors,$sensor)
{
  $sensors_c=explode(";", $sensors);

$result=false;

for ($i=0; $i <count($sensors_c) ; $i++) 
{ 
if (trim($sensor)==trim($sensors_c[$i]))
{

$result=true;
}
}

return $result;
}
function month($month)
{
  $val=0;
  switch ($month) {
    case "01":
    $val=31;
      break;
      case "02":
     $val=28;
      break;
        case "03":
     $val=31;
      break;
        case "04":
     $val=30;
      break;
        case "05":
     $val=31;
      break;
        case "06":
     $val=30;
      break;
        case "07":
     $val=31;
      break;
        case "08":
     $val=31;
      break;
        case "09":
     $val=30;
      break;
        case "10":
     $val=31;
      break;
        case "11":
     $val=30;
      break;
        case "12":
     $val=31;
      break;
  }
  return $val;
}
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
  

function getSensorShef($stn_name,$sensor)
{

$result=pg_query("SELECT  \"SHEF\",\"SensorType\" FROM \"SensorValues\" where \"StationFullName\"='$stn_name' and \"Sensor\"='$sensor'");
$row=pg_fetch_array($result);
$shef=$row[0];
if (trim($row[1])=="Real") {
$shef=$row[0];
}
else
{
$shef=$row[0]."V";
}
return $shef;
}
?>


<script type="text/javascript">
/*  Number.prototype.round = function(p) {
  p = p || 10;
  return parseFloat( this.toFixed(p) );
};*/
$(document).ready(function(){


var len=$('#myTable tr')[0].getElementsByTagName("th").length;
var data=[len];
var min=[],max=[],total=[];
var z=0;

 for (var i = 1; i < ((len-1)*3)+1; i=i+1) {
var x=0;
data[z]=0;
total[z]=0;

$('#myTable tr').each(function() {
  try{


    if (!this.rowIndex) return; 
var val=this.cells[i].innerHTML;
//var val2=this.cells[i+1].innerHTML;


   if (val.trim()!==""&&val !== "undefined") {
    val=val.replace(/,/g,''); 
    val= parseFloat(val);
    //val2= parseFloat(val2);
    //alert(val);
   if (!isNaN(val)) {
if (x==0) 
{
  min[z]=val;
  max[z]=val;
  x++;
}
total[z]+=val;
       data[z]  += val;
      // alert(val2);
       if (min[z]>val)
        {

min[z]=val;
        }

           if (max[z]<val)
        {
max[z]=val;
        }
   }
   }
}catch(ee){}
//alert(val);
});

z++;
 }


var report_type=<?php echo json_encode($_GET['report_type']); ?>;
var type=<?php echo json_encode($_GET['type']); ?>;
var setting=document.getElementById("round_val").value;

var table="<thead><tr><td ></td>";

var header_table="<tr><td></td>";
if (report_type=="Climate") 
{
    
var Climate_table=<?php echo json_encode($Climate_table); ?>;
var coun_sen=<?php echo json_encode($coun_sen); ?>;

 table+=Climate_table;
 condition=coun_sen;
}
else
{
 if(report_type=='River')
 {
  len=len-1;
  }
 for (var i = 1; i < len; i++) {
  //alert($('#myTable tr')[0].getElementsByTagName("th")[i].innerHTML);
if (report_type=='Reservoir'||report_type=='River') {

  table+="<th colspan='3' align='center'>"+$('#myTable tr')[0].getElementsByTagName("th")[i].innerHTML+"</th>";

  header_table+="<th align='center'>Avg</th><th align='center'>Max</th><th align='center'>Min</th>";

  }
   else if(report_type=='Rain')
 {
  table+="<th  align='center'>"+$('#myTable tr')[0].getElementsByTagName("th")[i].innerHTML+"</th>";
 }
 

 }

 if(report_type=='River')
 {
  table+="<th  align='center'>"+$('#myTable tr')[0].getElementsByTagName("th")[len].innerHTML+"</th>";
  header_table+="<th align='center'>Arce ft.</th>";
 }
 var condition=1;
 if (report_type=='Reservoir'||report_type=='River') {

 table+="</tr>"+header_table;
 condition=(len-1)*3;
  if(report_type=='River')
 {
  condition++;
 }
// alert(table);
}
//alert(table);

 }
    table+="</tr></thead><tbody><tr><th>AVG</th>";

  var tr_len=$('#myTable tr').length;
  //alert(table);

  tr_len=tr_len-2;
  var z=0;
 for (var i = 0; i < condition; i++) {
  var avg=(data[i]/tr_len);
if (z==i&&(report_type=="Reservoir"||report_type=="River")) {
table+="<td>"+avg.toFixed(setting).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+"</td>";
z=z+3;
}
else if (i==condition-1&&(report_type=="Rain"||report_type=="River")) 
{
  table+="<td>"+avg.toFixed(setting).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+"</td>";

}
else if (report_type=="Climate") 
{

if (type=="Daily") 
{
  if (i!=0&&i!=3&&i!=condition-1)
  {

table+="<td>"+avg.toFixed(setting).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+"</td>";
}
else
  table+="<td style='background-color:#F2F2F5'></td>";

}
else{
table+="<td>"+avg.toFixed(setting).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+"</td>";
}

}
 else
{
table+="<td style='background-color:#F2F2F5'></td>";

}

 }
 table+="</tr><tr><th>Max</th>";
 z=1;
 for (var i = 0; i < condition; i++) {
if (i==z&&(report_type=="Reservoir"||report_type=="River")) {
  table+="<td>"+max[i].toFixed(setting).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+"</td>";
  z=z+3;

  }
else if (i==condition-1&&(report_type=="Rain"||report_type=="River")) 
{
  table+="<td>"+max[i].toFixed(setting).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+"</td>";

}
else if (report_type=="Climate") 
{
  if (type=="Daily") 
{
if (i==4||i==5||i==6||i==2)
table+="<td>"+max[i].toFixed(setting).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+"</td>";
else
  table+="<td style='background-color:#F2F2F5'></td>";
}
else{
 if(i!=3)
table+="<td>"+max[i].toFixed(setting).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+"</td>";
else
  table+="<td style='background-color:#F2F2F5'></td>";
}
}
else
{
table+="<td style='background-color:#F2F2F5'></td>";

}

 }
table+="</tr><tr><th>Min</th>";
 z=2;
 for (var i = 0; i < condition; i++) {
if (i==z&&(report_type=="Reservoir"||report_type=="River")) 
{
  table+="<td>"+min[i].toFixed(setting).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+"</td>";
    z=z+3;

}
else if (i==condition-1&&(report_type=="Rain"||report_type=="River")) 
{
  table+="<td>"+min[i].toFixed(setting).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+"</td>";

}
else if (report_type=="Climate") 
{
  if (type=="Daily") 
{
if (i==4||i==5||i==6)
table+="<td>"+min[i].toFixed(setting).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+"</td>";
else
  table+="<td style='background-color:#F2F2F5'></td>";
}
else{
 if(i!=3)
table+="<td>"+min[i].toFixed(setting).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+"</td>";
else
  table+="<td style='background-color:#F2F2F5'></td>";
}
}
 else
{
table+="<td style='background-color:#F2F2F5'></td>";

}
 }

if(report_type!="Reservoir")
table+="</tr><tr><th>Total</th>";
 
 for (var i = 0; i < condition; i++) {
  if (report_type=="River"&&i==condition-1) 
{

  table+="<td>"+total[i].toFixed(setting).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+"</td>";

}
else if (report_type=="Rain")
 {
    table+="<td>"+total[i].toFixed(setting).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+"</td>";

 }
 else if (report_type=="Climate") 
 {

  if (i==0||i==condition-1)
    table+="<td>"+total[i].toFixed(setting).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+"</td>";
else
    table+="<td style='background-color:#F2F2F5'></td>";

 }
else
{
  if(report_type!="Reservoir")
  table+="<td style='background-color:#F2F2F5'></td>";

}
 }



 table+="</tbody></tr>";
  if(report_type!='Custom')
 {
 $("#cal_table").html(table);

}



//$("#exporttopdf").css("display","");

//$("#btnExport").css("display","");

});


  
window.onload=function(){
hideshow();
};


function hideshow()
{


  var val=$("#type_of_report").val();


      if(val.trim()=="Daily")
      {
        $("#Annual_table").css("display","none");

        $("#month_table").css("display","none");
        $("#daily_table").css("display","");

        $("#details").html(val+" Summary for "+$("#EditStartDate").val());
      }
      else if (val.trim()=="Monthly") {
        $("#month_table").css("display","");
        $("#daily_table").attr("value", "dd-mm-yyyy");
        $("#daily_table").css("display","none");
        $("#Annual_table").css("display","none");
        $("#details").html(val+" Summary for "+$("#months option:selected").text()+" "+$("#years option:selected").text());
      }
      else if(val.trim()=="Annual")
      {
       $("#month_table").css("display","none");
        $("#daily_table").attr("value", "dd-mm-yyyy");
        $("#daily_table").css("display","none");
        $("#Annual_table").css("display","");

   $("#details").html(val+" Summary for "+$("#Annual_years option:selected").text());      
 }
      else
      {
window.location.href="GraphMultiple2.php";

      }

}
</script>







<style type="text/css">
  th {
    text-align:center;
}
</style>

<script type="text/javascript">
  var tablesToExcel = (function () {
    var uri = 'data:application/vnd.ms-excel;base64,'
    , template = '<html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40"><head><!--[if gte mso 9]><xml><x:ExcelWorkbook><x:ExcelWorksheets>'
    , templateend = '</x:ExcelWorksheets></x:ExcelWorkbook></xml><![endif]--></head>'
    , body = '<body>'
    , tablevar = '<table>{table'
    , tablevarend = '}</table>'
    , bodyend = '</body></html>'
    , worksheet = '<x:ExcelWorksheet><x:Name>'
    , worksheetend = '</x:Name><x:WorksheetOptions><x:DisplayGridlines/></x:WorksheetOptions></x:ExcelWorksheet>'
    , worksheetvar = '{worksheet'
    , worksheetvarend = '}'
    , base64 = function (s) { return window.btoa(unescape(encodeURIComponent(s))) }
    , format = function (s, c) { return s.replace(/{(\w+)}/g, function (m, p) { return c[p]; }) }
    , wstemplate = ''
    , tabletemplate = '';

    return function (table, name, filename) {
        var tables = table;

        for (var i = 0; i < tables.length; ++i) {
            wstemplate += worksheet + worksheetvar + i + worksheetvarend + worksheetend;
            tabletemplate += tablevar + i + tablevarend;
        }

        var allTemplate = template + wstemplate + templateend;
        var allWorksheet = body + tabletemplate + bodyend;
        var allOfIt = allTemplate + allWorksheet;

        var ctx = {};
        for (var j = 0; j < tables.length; ++j) {
            ctx['worksheet' + j] = name[j];
        }

        for (var k = 0; k < tables.length; ++k) {
            var exceltable;
            if (!tables[k].nodeType) exceltable = document.getElementById(tables[k]);
            ctx['table' + k] = exceltable.innerHTML;
        }


        window.location.href = uri + base64(format(allOfIt, ctx));

    }
})();

</script>

<script type="text/javascript">
$(document).ready(function(){
  var report_type=<?php echo json_encode($_GET['report_type']); ?>;
   if (report_type!="Custom") 
 {
setWidth();
}
  });

  function setWidth()
  {
    var e_t=document.getElementById("myTable");

var e_tr= e_t.getElementsByTagName("tr");

for (var j = 0; j < 1;j++) 
{

  e_tr[j].getElementsByTagName("th")[0].width=100;

}

for (var j = 2; j < e_tr.length;j++) 
{

  e_tr[j].getElementsByTagName("td")[0].width=100;
}


   e_t=document.getElementById("cal_table");

 e_tr= e_t.getElementsByTagName("tr");

for (var j = 0; j < 1;j++) 
{

  e_tr[j].getElementsByTagName("td")[0].width=100;
}
for (var j = 2; j < e_tr.length;j++) 
{

  e_tr[j].getElementsByTagName("th")[0].width=100;

}



}
 

</script>