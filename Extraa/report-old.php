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

            var selected = $("#SensorList option:selected");
        var params = "";
        selected.each(function () {
            params +=$(this).val() + ";";
        });
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
 
 
 else {
 	    	var type=$("#type_of_report").val();


        
          var station = document.getElementById("Sname").value;
          if (type=="Daily") {
            var Ids = [];
            var Names = [];
            var i = 0;
            var yearFrom;
            var monthFrom;
            var dayFrom;
          

            var currentdate = new Date();
            var jsFromDate =document.getElementById("EditStartDate").value;
             //EditStartDate.GetDate();
             jsFromDate=new Date(jsFromDate);

            if (jsFromDate =="Invalid Date") {
                 
                yearFrom = currentdate.getFullYear();

                monthFrom = currentdate.getMonth() + 1;
                dayFrom = currentdate.getDate();
                //  alert('Please select From date');
             
            }
            else {
                yearFrom = jsFromDate.getFullYear(); // where getFullYear returns the year (four digits)
                 monthFrom = jsFromDate.getMonth()+1; // where getMonth returns the month (from 0-11)
                 dayFrom = jsFromDate.getDate();   // where getDate returns the day of the month (from 1-31)
            }
         
           
            
           // var params = document.getElementById("SensorList").value;
          

          
          
              window.location.href= 'report.php?FY=' + yearFrom + "&FM=" + monthFrom + "&FD=" + dayFrom + "&PARAMS=" + params+"&station="+station+"&type=Daily&report_type="+typereport;
             } else if (type=="Monthly")
         {

           var yearFrom=$("#years option:selected").val();
            var monthFrom=$("#months option:selected").val();
              window.location.href= 'report.php?FY=' + yearFrom + "&FM=" + monthFrom + "&PARAMS=" + params+"&station="+station+"&type=Monthly&report_type="+typereport;
         }
         else if (type=="Annual")
         {

           var yearFrom=$("#Annual_years option:selected").val();
              window.location.href= 'report.php?FY=' + yearFrom + "&PARAMS=" + params+"&station="+station+"&type=Annual&report_type="+typereport;
         }
         }
         
           }
                </script>
               
   <style type="text/css">
   	.pad
   	{
   		padding: 5px;
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.0.0-alpha.1/jspdf.plugin.autotable.min.js"></script>

 <script>
    function demoFromHTML() {
        var doc = new jsPDF('p', 'pt','a4');
 
 




doc.addHTML($('#myTable_div')[0], 15, 15, {
      'background': '#fff',
    }, function() {
      doc.save('report.pdf');
   });
 
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
  <script type="text/javascript">





$(document).ready(function()
  {
    $("#Sname").on('change',function(){
      GetData();
    });
  });

    function GetData()
    {
 var stn=document.getElementById('Sname').value;
  var val=$("#report_type").val();
  var type_of_report=$("#type_of_report").val();
         window.location.href='report.php?station='+stn+"&report_type="+val+"&type="+type_of_report;
       
     }

  
   </script>
   <form>
   <br><center>
   <div style="width: 98%">
   <div class="row" >

<div class="col-md-2" > 
   <select class="form-control" id="report_type">
  <option value="Climate" <?php if (isset($_GET['report_type'])) {
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
  } ?>>River</option>
    <option value="Custom" <?php if (isset($_GET['report_type'])) {
  if(trim($_GET['report_type'])=="Custom") echo "selected";
  } ?>>Custom</option>
  </select>
  </div>

<div class="col-md-2" > 
   <select class="form-control" id="type_of_report">
  <option value="Daily" <?php if (isset($_GET['type'])) {
  if(trim($_GET['type'])=="Daily") echo "selected";
  } ?>>Daily Summary</option>
  <option value="Monthly" <?php if (isset($_GET['type'])) {
  if(trim($_GET['type'])=="Monthly") echo "selected";
  } ?>>Monthly Summary</option>
  <option value="Annual" <?php if (isset($_GET['type'])) {
  if(trim($_GET['type'])=="Annual") echo "selected";
  } ?>>Annual Summary</option>
  <option value="Graph" <?php if (isset($_GET['type'])) {
  if(trim($_GET['type'])=="Graph") echo "selected";
  } ?>>Graph</option>
  </select>
  </div>

 

	<div class="col-md-2" >  <input type="text" id="Sname" name="StationName" class="form-control" required   value='<?php 
if(isset($_GET['station']))
{

	echo $_GET['station'];
}

	?>' placeholder="Station Name"> 

  </div>

		<div class="col-md-2"  > 
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
	
	
		<div class="col-md-2" >  
		<table id="daily_table">
			<tr>
			<td class="pad">
		
 <label >Date</label>
<?php if (isset($_GET['FY'])&&isset($_GET['FM'])&&isset($_GET['FD'])) {
    
      $da= strtotime( $_GET['FY'].'/'.$_GET['FM'].'/'.$_GET['FD']);
  
    } ?>
    
    	</td>
    	<td>
		 <input type="date" name="EditStartDate" id="EditStartDate" class="form-control" required value="<?php if(isset($da)) { echo date('Y-m-d',$da);} ?>" onChange="emptyHours()">
</td></tr></table> 

	<table id="month_table" style="display: none">
	<tr>
		<td>
			<select class="form-control" id="months">
			<option value="1" <?php selected("FM","1"); ?> >January</option>
			<option value="2" <?php selected("FM","2"); ?>>February</option>
			<option value="3" <?php selected("FM","3"); ?>>March</option>
			<option value="4" <?php selected("FM","4"); ?>>April</option>
			<option value="5" <?php selected("FM","5"); ?>>May</option>
			<option value="6" <?php selected("FM","6"); ?>>June</option>
			<option value="7" <?php selected("FM","7"); ?>>July</option>
			<option value="8" <?php selected("FM","8"); ?>>August</option>
			<option value="9" <?php selected("FM","9"); ?>>September</option>
			<option value="10" <?php selected("FM","10"); ?>>October</option>
			<option value="11" <?php selected("FM","11"); ?>>November</option>
		   <option value="12" <?php selected("FM","12"); ?>>December</option>

			</select>
			<?php function selected($key,$value)
			{
				if (isset($_GET["$key"])) {
					if (trim($_GET["$key"])==trim($value)) {
						echo ("selected");
					}
					
				}
				} ?>
		</td>
		<td>
			
			<select class="form-control" id="years">
			<option value="2017" <?php selected("FY","2017"); ?>>2017</option>
			<option value="2018" <?php selected("FY","2018"); ?>>2018</option>
			<option value="2019" <?php selected("FY","2019"); ?>>2019</option>
			<option value="2020" <?php selected("FY","2020"); ?>>2020</option>
			<option value="2021" <?php selected("FY","2021"); ?>>2021</option>
			<option value="2022" <?php selected("FY","2022"); ?>>2022</option>
			<option value="2023" <?php selected("FY","2023"); ?>>2023</option>
			<option value="2024" <?php selected("FY","2024"); ?>>2024</option>
			<option value="2025" <?php selected("FY","2025"); ?>>2025</option>
			<option value="2026" <?php selected("FY","2026"); ?>>2026</option>
			<option value="2027" <?php selected("FY","2027"); ?>>2027</option>
		    <option value="2028" <?php selected("FY","2028"); ?>>2028</option>

			</select>
		</td>
	</tr>
	</table>

  <table id="Annual_table" style="display: none">
  <tr>
    <td>
      
      <select class="form-control" id="Annual_years">
      <option value="2017" <?php selected("FY","2017"); ?>>2017</option>
      <option value="2018" <?php selected("FY","2018"); ?>>2018</option>
      <option value="2019" <?php selected("FY","2019"); ?>>2019</option>
      <option value="2020" <?php selected("FY","2020"); ?>>2020</option>
      <option value="2021" <?php selected("FY","2021"); ?>>2021</option>
      <option value="2022" <?php selected("FY","2022"); ?>>2022</option>
      <option value="2023" <?php selected("FY","2023"); ?>>2023</option>
      <option value="2024" <?php selected("FY","2024"); ?>>2024</option>
      <option value="2025" <?php selected("FY","2025"); ?>>2025</option>
      <option value="2026" <?php selected("FY","2026"); ?>>2026</option>
      <option value="2027" <?php selected("FY","2027"); ?>>2027</option>
      <option value="2028" <?php selected("FY","2028"); ?>>2028</option>

      </select>
    </td>
  </tr>
  </table>
		 </div>
	
		<div class="col-md-1" > 
		<table><tr><td style="padding-top: 3px" >
		<input type="button"  onclick="PlotGraph()" title="get report!" class="btn btn-sm btn-primary" name="btnPlot" value="Get"> 
		</td>
<td class="pad" >
<img   src="assets/images/excel.png"  style="width: 25;height: 25;display: none;" id="btnExport" title="export to excel!" onclick="tablesToExcel(['myTable','cal_table_header','cal_table'],['first','second'],'report.xls')" >
</td>
<td class="pad">
<img  src="assets/images/pdf.png" id="exporttopdf" style="width: 25;height: 25;display: none;" onclick="demoFromHTML()" title="export to pdf!" >
</td>
</tr>
</table>
 <!--<a   class="btn btn-sm btn-info" name="btnExportToCvs" href="javascript:window.location.href='exportcsv2.php'">Export</a>-->
    </div>


		</div>
</div>
</center>

</form>




<?php


if (isset($_GET["PARAMS"]))
{
 

      $tempParam = trim($_GET["PARAMS"]);
          
$PARAMS=explode(';' ,$tempParam);
  $station=getStationShef(trim($_GET['station']));
$coun_sen=0;
$Climate_table="";
function graph($vertualsensors,$realsensors,$v_sensor_names,$r_sensor_names)
{
 $settings=pg_fetch_array(pg_query("select \"DateFormat\",\"DecimalPlaces\" from \"tblLogo\""));
   $setting=$settings[1];
global $coun_sen,$Climate_table;

   $array_v='';
$export_Header="Date";

           $FY = trim($_GET["FY"]);
            $FY = str_replace('20', '',$FY);
            $FM = trim($_GET["FM"]);
            $FD = trim($_GET["FD"]);
          
            $station=getStationShef(trim($_GET['station']));



           
    

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
  

    $result_set=  pg_query("SELECT \"HydroMetParamsTypeId\" FROM \"tblHydroMetParamsType\" where 
            \"HydroMetShefCode\" = '$paramsshefVirtual[$i]'");
          $row=pg_fetch_array($result_set);
$HydroMetShefCodeCoditionVirtual.=" a.\"HydroMetParamsTypeId\"=''$row[0]'' or";
}
}

$HydroMetShefCodeCoditionVirtual=rtrim($HydroMetShefCodeCoditionVirtual ,'or');
$HydroMetShefCodeCodition=rtrim($HydroMetShefCodeCodition ,'or');



    $result_table=  pg_query("SELECT * FROM \"tblAllTables\" where \"TableName\" like '%".$station."_$FY%'");
    if (isset($result_table)) {

      $stn_id=  pg_query("SELECT \"StationId\" FROM \"tblStation\" where \"StationName\"='$station'");
$id_row=pg_fetch_array($stn_id);
$s_id= $id_row['StationId'];

                     

  while ($tablerows=pg_fetch_array($result_table)) {

$table="'".$tablerows['TableName']."'";

$type="hour";

         if ($_GET['type']=="Daily") {

        $type="hour";
               
           $sql_queryReal ="SELECT * FROM crosstab ('SELECT  (''20''||\"Year\"::text ||''-''||\"Month\"::text ||''-''|| \"Day\" ::text ||'' ''||\"Hour\"::text || '':'' || \"Minute\" ::text || 
'':'' ||\"Second\")::timestamp  as t,\"HydroMetParamsTypeId\", \"Value\" FROM \"'$table'\" a where
    ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY,$FM,$FD) AND ($FY,$FM,$FD))  and a.\"StationId\"=$s_id and a.\"Flag\"= ''1'' and ($HydroMetShefCodeCodition)  order by 1 desc'
   ,'SELECT distinct \"HydroMetParamsTypeId\" FROM \"'$table'\" as a where ($HydroMetShefCodeCodition) and a.\"Flag\"= ''1'''
   ) AS final_result(t timestamp";

for ($i=0; $i <count($paramsshef) ; $i++) { 
  if (trim($paramsshef[$i])!="") 
  {
  $sql_queryReal .=",\"".$paramsshef[$i]."\" double precision";

}

}
$sql_queryReal.=")";
             
                       $sql_queryVirtual ="SELECT * FROM crosstab ('SELECT  (''20''||\"Year\"::text ||''-''||\"Month\"::text ||''-''|| \"Day\" ::text ||'' ''||\"Hour\"::text || '':'' || \"Minute\" ::text || 
'':'' ||\"Second\")::timestamp  as t,\"HydroMetParamsTypeId\", \"VirtualValue\" FROM \"'$table'\" a where
    ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY,$FM,$FD) AND ($FY,$FM,$FD))  and a.sensortype=''Virtual'' and a.\"Flag\"= ''1'' and a.\"StationId\"=$s_id and ($HydroMetShefCodeCoditionVirtual)   order by 1 desc'
   ,'SELECT distinct \"HydroMetParamsTypeId\" FROM \"'$table'\" as a where a.sensortype=''Virtual'' and ($HydroMetShefCodeCoditionVirtual) and a.\"Flag\"= ''1'''
   ) AS final_result(t timestamp";

for ($i=0; $i <count($paramsshefVirtual) ; $i++) { 
  if (trim($paramsshefVirtual[$i])!="") 
  {
  $sql_queryVirtual .=",\"".$paramsshefVirtual[$i]."V\" double precision";

}
}
$sql_queryVirtual.=")";
               
           
      

           } 
           else if($_GET['type']=="Monthly"){
$type="day";
           $sql_queryReal ="SELECT * FROM crosstab ('SELECT  (''20''||\"Year\"::text ||''-''||\"Month\"::text ||''-''|| \"Day\" ::text ||'' ''||\"Hour\"::text || '':'' || \"Minute\" ::text || 
'':'' ||\"Second\")::timestamp  as t,\"HydroMetParamsTypeId\", \"Value\" FROM \"'$table'\" a where
    (\"Year\"=$FY and \"Month\"=$FM)   and a.\"StationId\"=$s_id and a.\"Flag\"= ''1'' and ($HydroMetShefCodeCodition)  order by 1 desc'
   ,'SELECT distinct \"HydroMetParamsTypeId\" FROM \"'$table'\" as a where ($HydroMetShefCodeCodition) and a.\"Flag\"= ''1'''
   ) AS final_result(t timestamp";

for ($i=0; $i <count($paramsshef) ; $i++) { 
  if (trim($paramsshef[$i])!="") 
  {
  $sql_queryReal .=",\"".$paramsshef[$i]."\" double precision";

}

}
$sql_queryReal.=")";
//echo "$sql_query";
             
                       $sql_queryVirtual ="SELECT * FROM crosstab ('SELECT  (''20''||\"Year\"::text ||''-''||\"Month\"::text ||''-''|| \"Day\" ::text ||'' ''||\"Hour\"::text || '':'' || \"Minute\" ::text || 
'':'' ||\"Second\")::timestamp  as t,\"HydroMetParamsTypeId\", \"VirtualValue\" FROM \"'$table'\" a where
    (\"Year\"=$FY and \"Month\"=$FM)  and a.sensortype=''Virtual'' and a.\"Flag\"= ''1'' and a.\"StationId\"=$s_id and ($HydroMetShefCodeCoditionVirtual)   order by 1 desc'
   ,'SELECT distinct \"HydroMetParamsTypeId\" FROM \"'$table'\" as a where a.sensortype=''Virtual'' and ($HydroMetShefCodeCoditionVirtual) and a.\"Flag\"= ''1'''
   ) AS final_result(t timestamp";

for ($i=0; $i <count($paramsshefVirtual) ; $i++) { 
  if (trim($paramsshefVirtual[$i])!="") 
  {
  $sql_queryVirtual .=",\"".$paramsshefVirtual[$i]."V\" double precision";

}
}
$sql_queryVirtual.=")";
           } 
           else
           {
            $type="month";
           $sql_queryReal ="SELECT * FROM crosstab ('SELECT  (''20''||\"Year\"::text ||''-''||\"Month\"::text ||''-''|| \"Day\" ::text ||'' ''||\"Hour\"::text || '':'' || \"Minute\" ::text || 
'':'' ||\"Second\")::timestamp  as t,\"HydroMetParamsTypeId\", \"Value\" FROM \"'$table'\" a where
    (\"Year\"=$FY)   and a.\"StationId\"=$s_id and a.\"Flag\"= ''1'' and ($HydroMetShefCodeCodition)  order by 1 desc'
   ,'SELECT distinct \"HydroMetParamsTypeId\" FROM \"'$table'\" as a where ($HydroMetShefCodeCodition) and a.\"Flag\"= ''1'''
   ) AS final_result(t timestamp";

for ($i=0; $i <count($paramsshef) ; $i++) { 
  if (trim($paramsshef[$i])!="") 
  {
  $sql_queryReal .=",\"".$paramsshef[$i]."\" double precision";

}

}
$sql_queryReal.=")";
//echo "$sql_query";
             
                       $sql_queryVirtual ="SELECT * FROM crosstab ('SELECT  (''20''||\"Year\"::text ||''-''||\"Month\"::text ||''-''|| \"Day\" ::text ||'' ''||\"Hour\"::text || '':'' || \"Minute\" ::text || 
'':'' ||\"Second\")::timestamp  as t,\"HydroMetParamsTypeId\", \"VirtualValue\" FROM \"'$table'\" a where
    (\"Year\"=$FY)  and a.sensortype=''Virtual'' and a.\"Flag\"= ''1'' and a.\"StationId\"=$s_id and ($HydroMetShefCodeCoditionVirtual)   order by 1 desc'
   ,'SELECT distinct \"HydroMetParamsTypeId\" FROM \"'$table'\" as a where a.sensortype=''Virtual'' and ($HydroMetShefCodeCoditionVirtual) and a.\"Flag\"= ''1'''
   ) AS final_result(t timestamp";

for ($i=0; $i <count($paramsshefVirtual) ; $i++) { 
  if (trim($paramsshefVirtual[$i])!="") 
  {
  $sql_queryVirtual .=",\"".$paramsshefVirtual[$i]."V\" double precision";

}
}
$sql_queryVirtual.=")";
           }   
                
 if ($_GET['report_type']=="Reservoir"||$_GET['report_type']=="River") {
  

 if (trim($HydroMetShefCodeCoditionVirtual)!="") {
$sql_query="select date_trunc('$type', t1.t) as t";

for ($i=0; $i <count($paramsshef)-1 ; $i++) { 
  if (trim($paramsshef[$i])!="") 
  {
  $sql_query .=",avg(t1.\"".$paramsshef[$i]."\") as \"".$paramsshef[$i]."\"" ;
  $sql_query .=",max(t1.\"".$paramsshef[$i]."\") as \"".$paramsshef[$i]."\"" ;
    $sql_query .=",min(t1.\"".$paramsshef[$i]."\") as \"".$paramsshef[$i]."\"" ;

}
}
for ($i=0; $i <count($paramsshefVirtual)-1 ; $i++) { 
  if (trim($paramsshefVirtual[$i])!="") {
  $sql_query .=",avg(t2.\"".$paramsshefVirtual[$i]."V\") as \"".$paramsshefVirtual[$i]."V\"";
  $sql_query .=",max(t2.\"".$paramsshefVirtual[$i]."V\") as \"".$paramsshefVirtual[$i]."V\"";
    $sql_query .=",min(t2.\"".$paramsshefVirtual[$i]."V\") as \"".$paramsshefVirtual[$i]."V\"";

}
}
if ($_GET['report_type']=="River") {
  $SHEF=getSensorShef($_GET['station'],'Discharge');
      $sql_query .=",avg(\"$SHEF\") as \"Total\"" ;

}

$sql_query=rtrim($sql_query,",");

$sql_query.=" from (".$sql_queryReal.") t1 FULL OUTER JOIN (".$sql_queryVirtual.") t2 on t1.t=t2.t group by 1  order by 1 ";

}
 else{
$sql_query="select date_trunc('$type', t) as t";

for ($i=0; $i <count($paramsshef)-1 ; $i++) { 
  if (trim($paramsshef[$i])!="") 
  {
  $sql_query .=",avg(\"".$paramsshef[$i]."\") as \"".$paramsshef[$i]."\"" ;
    $sql_query .=",max(\"".$paramsshef[$i]."\") as \"".$paramsshef[$i]."\"" ;
    $sql_query .=",min(\"".$paramsshef[$i]."\") as \"".$paramsshef[$i]."\"" ;

}
}
if ($_GET['report_type']=="River") {
  $SHEF=getSensorShef($_GET['station'],'Discharge');
      $sql_query .=",avg(\"$SHEF\") as \"Total\"" ;

}

  $sql_query.=" from ( ".$sql_queryReal.") t1 group by 1 order by 1";
}

if (trim($HydroMetShefCodeCodition)=='') {
$sql_query="select date_trunc('$type', t) as t";

	for ($i=0; $i <count($paramsshefVirtual)-1 ; $i++) { 
  if (trim($paramsshefVirtual[$i])!="") 
  {
  $sql_query .=",avg(\"".$paramsshefVirtual[$i]."V\") as \"".$paramsshefVirtual[$i]."V\"";
    $sql_query .=",max(\"".$paramsshefVirtual[$i]."V\") as \"".$paramsshefVirtual[$i]."V\"";
    $sql_query .=",min(\"".$paramsshefVirtual[$i]."V\") as \"".$paramsshefVirtual[$i]."V\"";

}
}
if ($_GET['report_type']=="River") {
  $SHEF=getSensorShef($_GET['station'],'Discharge');
      $sql_query .=",avg(\"$SHEF\") as \"Total\"" ;

}
  $sql_query.=" from ( ".$sql_queryVirtual.") t1 group by 1 order by 1";


}

 }
 else if ($_GET['report_type']=="Rain") {
   # code...
  $sql_query="select date_trunc('$type', t1.t) as t";
  if (trim($HydroMetShefCodeCoditionVirtual)=="") {
    $sql_query .=",sum(\"".$paramsshef[0]."\") as \"".$paramsshef[0]."\"" ;
      $sql_query.=" from ( ".$sql_queryReal.") t1 group by 1 order by 1";

  }
else
{
  $sql_query .=",sum(\"".$paramsshefVirtual[0]."V\") as \"".$paramsshefVirtual[0]."V\"";
  $sql_query.=" from ( ".$sql_queryVirtual.") t1 group by 1 order by 1";

}

 }
  else if (trim($_GET['report_type'])=="Climate") {
  $sql_query="select date_trunc('$type', t1.t) as t";

 $sensors_c=trim($_GET["PARAMS"]);

if(checkSensor($sensors_c,"Solar Radiation"))
{
  $colname=trim(getSensorShef($_GET['station'],"Solar Radiation"));
    $sql_query .=",sum(\"". $colname."\") as \"". $colname."\"" ;
}
if(checkSensor($sensors_c,"Wind Speed"))
{
  $colname=trim(getSensorShef($_GET['station'],"Wind Speed"));
    $sql_query .=",avg(\"". $colname."\") as \"". $colname."\"" ;
        $sql_query .=",max(\"". $colname."\") as \"". $colname."\"" ;
}
if(checkSensor($sensors_c,"Wind Direction"))
{
      $colname=trim(getSensorShef($_GET['station'],"Wind Direction"));
    $sql_query .=",sum(\"". $colname."\") as \"". $colname."\"" ;
}
if(checkSensor($sensors_c,"Air Temperature"))
{
      $colname=trim(getSensorShef($_GET['station'],"Air Temperature"));
    $sql_query .=",avg(\"". $colname."\") as \"". $colname."\"" ;
  }
  if(checkSensor($sensors_c,"Soil Temperature"))
{
      $colname=trim(getSensorShef($_GET['station'],"Soil Temperature"));
    $sql_query .=",avg(\"". $colname."\") as \"". $colname."\"" ;
  }
  if(checkSensor($sensors_c,"Relative Humidity"))
{
    $colname=trim(getSensorShef($_GET['station'],"Relative Humidity"));
    $sql_query .=",avg(\"". $colname."\") as \"". $colname."\"" ;
  }
  if(checkSensor($sensors_c,"Dew Point"))
{
    $colname=trim(getSensorShef($_GET['station'],"Dew Point"));
    $sql_query .=",sum(\"". $colname."\") as \"". $colname."\"" ;
  }
  if(checkSensor($sensors_c,"Wet Bulb"))
{
    $colname=trim(getSensorShef($_GET['station'],"Wet Bulb"));
    $sql_query .=",sum(\"". $colname."\") as \"". $colname."\"" ;
}
if(checkSensor($sensors_c,"Barometric Pressure"))
{
        $colname=trim(getSensorShef($_GET['station'],"Barometric Pressure"));
    $sql_query .=",sum(\"". $colname."\") as \"". $colname."\"" ;

        $sql_query .=",sum(\"". $colname."\") as \"Total\"" ;
}
 if (trim($HydroMetShefCodeCoditionVirtual)!="") {

    $sql_query.=" from (".$sql_queryReal.") t1 FULL OUTER JOIN (".$sql_queryVirtual.") t2 on t1.t=t2.t group by 1  order by 1 ";

  }
  else
  {
      $sql_query.=" from ( ".$sql_queryReal.") t1 group by 1 order by 1";

     //echo  $sql_query; 
  }
 
}
else if (trim($_GET['report_type'])=="Custom") {
  //$sql_query="select date_trunc('$type', t1.t) as t";
$sql_query="select t1.t";

for ($i=0; $i <count($paramsshef); $i++) { 
if (trim($paramsshef[$i])!="") {
  $sql_query.=",t1.\"$paramsshef[$i]\"";
}
}

   if (trim($HydroMetShefCodeCoditionVirtual)!="") {




for ($i=0; $i <count($paramsshefVirtual); $i++) { 
if (trim($paramsshefVirtual[$i])!="") {
  
 $sql_query.=",t2.\"$paramsshefVirtual[$i]V\"";
  
}
}
    $sql_query.="from  (".$sql_queryReal.") t1 FULL OUTER JOIN (".$sql_queryVirtual.")  t2 on t1.t=t2.t   order by 1 ";

  }
  else
  {

      $sql_query.=" from ( ".$sql_queryReal.") t1  order by 1";

    
  }
  //echo  $sql_query; 
}

$sen_list="";
  $result_set2= pg_query($sql_query); 

  
    
  

 
  $_SESSION['query']=$sql_query;
 // echo "<br><br>$sql_query"; 
  if (pg_num_rows($result_set2)==0) 
  {
$array_v="<label style='color:red;'>No data Found!</label>";
  }

if (pg_num_rows($result_set2)>0) 
{
 $array_v='<thead><tr><th align="center">Date</th>';

  $header_row="<tr><th></th>";
 $type=$_GET['type'];
if($_GET['report_type']!="Custom")
{
                      if($type=="Monthly")
                      {
 $array_v='<thead><tr><th align="center">Day of Month</th>';

                      }
                      else if($type=="Daily")
                      {
 $array_v='<thead><tr><th align="center">Hour of Day</th>';
                      }
                      else if ($type=="Annual") {
 $array_v='<thead><tr><th align="center">Month</th>';

                      }
      }
if ($_GET['report_type']=="Climate") {
 $sensors_c=trim($_GET["PARAMS"]);

if(checkSensor( $sensors_c,"Solar Radiation"))
{
       $Climate_table.='<th align="center">Solar Radiation</th>';
 $header_row.="<th></th>";
  $coun_sen++;
}
if(checkSensor( $sensors_c,"Wind Speed"))
{
     $Climate_table.='<th align="center" colspan="2">Wind Speed</th>';
  $header_row.="<th align='center'>Avg</th><th align='center'>Max</th>";
  $coun_sen++;
  $coun_sen++;
}
if(checkSensor( $sensors_c,"Wind Direction"))
{
     $Climate_table.='<th align="center">Wind Direction</th>';
   $header_row.="<th>Degree</th>";$coun_sen++;
 }
 if(checkSensor( $sensors_c,"Air Temperature"))
{
     $Climate_table.='<th align="center">Air Temperature</th>';
       $header_row.="<th>Avg</th>";$coun_sen++;
     }
     if(checkSensor( $sensors_c,"Soil Temperature"))
{
      $Climate_table.='<th align="center">Soil Temperature</th>';
       $header_row.="<th>Avg</th>";$coun_sen++;
     }
     if(checkSensor($sensors_c,"Relative Humidity"))
{
       $Climate_table.='<th align="center">Relative Humidity</th>';
        $header_row.="<th>Avg %</th>";$coun_sen++;
      }
      if(checkSensor($sensors_c,"Dew Point"))
{
        $Climate_table.='<th align="center">Dew Point</th>';
          $header_row.="<th>Degree</th>";$coun_sen++;
        }
        if(checkSensor($sensors_c,"Wet Bulb"))
{
         $Climate_table.='<th align="center">Wet Bulb</th>';
          $header_row.="<th></th>";$coun_sen++;
        }
        if(checkSensor($sensors_c,"Barometric Pressure"))
{
          $Climate_table.='<th align="center">Barometric Pressure</th>';
           $header_row.="<th></th>";$coun_sen++;
      
                    $Climate_table.='<th align="center">Total Precipitation</th>';
                    $header_row.="<th></th>";
                    $coun_sen++;
                  }

$array_v.=$Climate_table.'</tr>'.$header_row."</tr>";
$Climate_table=$Climate_table.'</tr>'.$header_row."</tr>";
}
else if (trim($_GET['report_type'])=="Custom") {


for ($i=0; $i <count($paramsshef); $i++) { 
if (trim($paramsshef[$i])!="") {
  $sen_name=getSensorName(trim($paramsshef[$i]),"Real",trim($_GET['station']));
     $array_v.="<th align='center'>$sen_name</th>";

}
}

   if (trim($HydroMetShefCodeCoditionVirtual)!="") {




for ($i=0; $i <count($paramsshefVirtual); $i++) { 
if (trim($paramsshefVirtual[$i])!="") {
   $sen_name=getSensorName(trim($paramsshefVirtual[$i]),"Virtual",trim($_GET['station']));
     $array_v.="<th align='center'>$sen_name</th>";

  
}
}
}

 
 

  }
else
{

$HydroMetShefCodeCodition_temp=str_replace("''", "'", $HydroMetShefCodeCodition);
$row_c_ds_r=pg_query("SELECT distinct \"HydroMetParamsTypeId\" FROM \"$table\" as a where ($HydroMetShefCodeCodition_temp) and a.\"Flag\"= '1'");

$tem_ds=pg_query("SELECT distinct \"HydroMetParamsTypeId\" FROM \"$table\" as a where ($HydroMetShefCodeCodition_temp) and a.\"Flag\"= '1'");
while ($h_id=pg_fetch_array($tem_ds)) 
{
$shef=pg_fetch_array(pg_query("select \"HydroMetShefCode\" from \"tblHydroMetParamsType\" where \"HydroMetParamsTypeId\"='$h_id[0]'"));

$row=pg_fetch_array(pg_query("select \"Sensor\" from \"SensorValues\" where \"StationFullName\"='$stn_name' and \"SHEF\"='$shef[0]' and \"SensorType\"='Real'"));


 if ($_GET['report_type']=="Reservoir"||$_GET['report_type']=="River") {

 $array_v.='<th colspan="3" align="center">'.$row[0].'</th>';
 $header_row.="<th align='center'>Avg</th><th align='center'>Max</th><th align='center'>Min</th>";
}
 else if ($_GET['report_type']=="Rain") {
   $array_v.='<th align="center">Total Precipitation</th>';

}
}


$HydroMetShefCodeCoditionVirtual_temp=str_replace("''", "'", $HydroMetShefCodeCoditionVirtual);
if (trim($HydroMetShefCodeCoditionVirtual)!="") {
  # code...

$row_c_ds_v=pg_query("SELECT distinct \"HydroMetParamsTypeId\" FROM \"$table\" as a where a.sensortype='Virtual' and ($HydroMetShefCodeCoditionVirtual_temp) and a.\"Flag\"= '1'");


$tem_ds=pg_query("SELECT distinct \"HydroMetParamsTypeId\" FROM \"$table\" as a where a.sensortype='Virtual' and ($HydroMetShefCodeCoditionVirtual_temp) and a.\"Flag\"= '1'");

while ($h_id=pg_fetch_array($tem_ds)) {
$shef=pg_fetch_array(pg_query("select \"HydroMetShefCode\" from \"tblHydroMetParamsType\" where \"HydroMetParamsTypeId\"='$h_id[0]'"));

$row=pg_fetch_array(pg_query("select \"Sensor\" from \"SensorValues\" where \"StationFullName\"='$stn_name' and \"SHEF\"='$shef[0]' and \"SensorType\"='Virtual'"));
 if ($_GET['report_type']=="Reservoir"||$_GET['report_type']=="River") {

 $array_v.='<th colspan="3" align="center">'.$row[0].'</th>';
  $header_row.="<th align='center'>Avg</th><th align='center'>Max</th><th align='center'>Min</th>";
}
 else if ($_GET['report_type']=="Rain") {
 $array_v.='<th align="center">Total Precipitation</th>';

 }
  $export_Header.=",".$row[0];

}
}

if ($_GET['report_type']=="River") {
  //$SHEF=getSensorShef($_GET['station'],'Discharge');
     // $sql_query .=",avg(\"$SHEF\") as \"Total\"" ;
  $array_v.="<th align='center'>Discharge</th>";
  $header_row.="<th align='center'>Total</th>";

}
 if ($_GET['report_type']=="Reservoir"||$_GET['report_type']=="River") {

$array_v.='</tr>'.$header_row."</tr>";

}
}
  $array_v.='</thead><tbody>';  

 $_SESSION["header"]=$export_Header;
while ($rows=pg_fetch_array($result_set2)) {
     
                  
                   
                   $a= $rows['t'];
                    if (trim($a)!="") {
if($_GET['report_type']!="Custom")
{
                      $date = strtotime($a);

                      if($type=="Monthly")
                      {
    $date=date('d', $date);

                      }
                      else if($type=="Daily")
                      {
    $date=date('h A', $date);
                      }
                      else if ($type=="Annual") {
                            $date=date('m', $date);

                      }
                    }
                    else
                      $date=$a;
   $array_v.='<tr><td>'.$date."</td>";
   $row_count=1;
$table="'".$tablerows['TableName']."'";


   for ($i=0; $i <pg_num_rows($row_c_ds_r); $i++) { 
  if ($_GET['report_type']=="Reservoir"||$_GET['report_type']=="River") {

   $array_v.='<td>'.number_format(floatval($rows[$row_count]),$setting).'</td>';
  $row_count++;
   $array_v.='<td>'.number_format(floatval($rows[$row_count]),$setting).'</td>';
  $row_count++;
    $array_v.='<td>'.number_format(floatval($rows[$row_count]),$setting).'</td>';
  $row_count++;
}
 else if ($_GET['report_type']=="Rain") {
 $array_v.='<td>'.number_format(floatval($rows[$row_count]),$setting).'</td>';
  $row_count++;
 }
}

if (trim($HydroMetShefCodeCoditionVirtual)!="") {

   for ($i=0; $i <pg_num_rows($row_c_ds_v); $i++) { 
     if ($_GET['report_type']=="Reservoir"||$_GET['report_type']=="River") {

  $array_v.='<td>'.number_format(floatval($rows[$row_count]),$setting).'</td>';
  $row_count++;
   $array_v.='<td>'.number_format(floatval($rows[$row_count]),$setting).'</td>';
  $row_count++;
     $array_v.='<td>'.number_format(floatval($rows[$row_count]),$setting).'</td>';
  $row_count++;
}
 else if ($_GET['report_type']=="Rain") {
  $array_v.='<td>'.number_format(floatval($rows[$row_count]),$setting).'</td>';
  $row_count++;
 }
}
    }  

if ($_GET['report_type']=="River") {
   if($type=="Monthly")
                      {
  $dis=floatval($rows[$row_count])*24*3600;

                      }
                      else if($type=="Daily")
                      {
  $dis=floatval($rows[$row_count])*3600;
                      }
                      else if ($type=="Annual") {
                      $mont=month(trim($date));
  $dis=floatval($rows[$row_count])*24*$mont*3600;

                      }
 $array_v.='<td>'.number_format($dis,$setting).'</td>';
  $row_count++;

}            

if ($_GET['report_type']=="Climate") 
{
  for ($i=0; $i <$coun_sen; $i++) { 
    # code...

 $array_v.='<td>'.number_format(floatval($rows[$row_count]),$setting).'</td>';
  $row_count++;
  }
}
else if (trim($_GET['report_type'])=="Custom") {
 $sensor=explode(";", trim($_GET["PARAMS"]));
 for ($i=0; $i <count($sensor)-1 ; $i++) { 
   $array_v.='<td>'.number_format(floatval($rows[$row_count]),$setting).'</td>';
  $row_count++;
 }}     
$array_v.='</tr>';
}
}

}
     



   
}
}
$array_v.="</tbody>";
echo "<input type='hidden' id='round_val' value='$setting'>";
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
/*	Number.prototype.round = function(p) {
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
  header_table+="<th align='center'>Total</th>";
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



$("#exporttopdf").css("display","");

$("#btnExport").css("display","");

});


  
window.onload=function(){
hideshow();
};


function hideshow()
{


  var val=$("#type_of_report").val();

if (val.trim()=="Monthly") {
        $("#month_table").css("display","");
        $("#daily_table").attr("value", "dd-mm-yyyy");
        $("#daily_table").css("display","none");
        $("#Annual_table").css("display","none");
   $("#details").html(val+" Summary for "+$("#months option:selected").text()+" "+$("#years option:selected").text());
      }
      else if(val.trim()=="Daily")
      {
                $("#Annual_table").css("display","none");

        $("#month_table").css("display","none");
        $("#daily_table").css("display","");

        $("#details").html(val+" Summary for "+$("#EditStartDate").val());
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




   



