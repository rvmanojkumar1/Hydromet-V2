
<?php
								include("includes/link.php");
							?>

							<?php
								include("includes/header.php");
							?>
<?php
include_once 'database.php';
error_reporting(0);
if(isset($_GET['select1']))
{
	$var1=$_GET['select1'];
	$_SESSION['SNameM']=$var1;

}
if(isset($_POST['chekedstn']))
{
  $stnnames='';
  $checkbox1=$_POST['chekedstn'];
  foreach($checkbox1 as $chk1)  
   { 
    $stnnames.=$chk1.";";

   }
   $_SESSION['SNameM']=$stnnames;
   //echo "<script>window.location.href='GraphMultiple.php?select1='+$stnnames<script>";
 
  // header("Location : GraphMultiple.php?select1=$stnnames");
}
?>


  <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>


<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">

      
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>


   <script type="text/javascript">


 	 function PlotGraph() {

            var selected = $("#SensorList option:selected");
        var params = "";
        selected.each(function () {
            params +=$(this).val() + ";";
        });
     
  
 	 	//alert('ok');
 if(document.getElementById("Sname").value.trim()=="")
 {
  alert('Please Search and Select Station!');
  return;
 }
 else if (document.getElementById("SensorList").value.trim()=="") {
  alert('Please Select Sensor!');
  return;
 }
  else if (document.getElementById("hours").value.trim()!="") {
   var yearFrom;
            var monthFrom;
            var dayFrom;
            var yearTo;
            var monthTo;
            var dayTo;
              var currentdate = new Date();
    var hours=document.getElementById("hours").value.trim();
                var hours2=hours;
                var sd=0;
                sd=Math.floor( hours/24);
                hours=hours%24;
                
              
               var date = new Date();
var last = new Date(date.getTime() - (sd * 24 * 60 * 60 * 1000));
                yearFrom = last.getFullYear();
                monthFrom = last.getMonth() + 1;
               dayFrom = last.getDate();

                yearTo = currentdate.getFullYear();
                monthTo = currentdate.getMonth() + 1;
                dayTo = currentdate.getDate();
                   // var params = document.getElementById("SensorList").value;

           
                var station = document.getElementById("Sname").value;
              window.location.href= 'GraphMultiple2.php?FY=' + yearFrom + "&FM=" + monthFrom + "&FD=" + dayFrom + '&TY=' + yearTo + "&TM=" + monthTo + "&TD=" + dayTo + "&PARAMS=" + params+"&hours="+hours+"&station="+station+"&hours2="+hours2;
  
 }
  else if (document.getElementById("EditEndDate").value.trim()==""&&document.getElementById("EditEndDate").value.trim()==""&&document.getElementById("hours").value.trim()=="") {
      var yearFrom;
            var monthFrom;
            var dayFrom;
            var yearTo;
            var monthTo;
            var dayTo;
              var currentdate = new Date();
  var hours=24;
var hours2=hours;
 var sd=0;
 sd=Math.floor(hours/24);

 hours=hours%24;
              
               var date = new Date();
var last = new Date(date.getTime() - (sd * 24 * 60 * 60 * 1000));
                yearFrom = last.getFullYear();
                monthFrom = last.getMonth() + 1;
               dayFrom = last.getDate();

                yearTo = currentdate.getFullYear();
                monthTo = currentdate.getMonth() + 1;
                dayTo = currentdate.getDate();
                   // var params = document.getElementById("SensorList").value;

           
                var station = document.getElementById("Sname").value;
              window.location.href= 'GraphMultiple2.php?FY=' + yearFrom + "&FM=" + monthFrom + "&FD=" + dayFrom + '&TY=' + yearTo + "&TM=" + monthTo + "&TD=" + dayTo + "&PARAMS=" + params+"&station="+station+"&hours2="+hours2+"&hours="+hours;
 }
 else if (document.getElementById("EditEndDate").value.trim()!=""&&document.getElementById("EditEndDate").value.trim()!=""&&document.getElementById("hours").value.trim()==""){

            var Ids = [];
            var Names = [];
            var i = 0;
            var yearFrom;
            var monthFrom;
            var dayFrom;
            var yearTo;
            var monthTo;
            var dayTo;

            var currentdate = new Date();
            
            var jsFromDate =document.getElementById("EditStartDate").value;
             //EditStartDate.GetDate();
             jsFromDate=new Date(jsFromDate);
	
            if (jsFromDate =="") {
                 
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
            var jsToDate = document.getElementById("EditEndDate").value;
               jsToDate=new Date(jsToDate);
            if (jsToDate == null) {

                yearTo = currentdate.getFullYear();
                monthTo = currentdate.getMonth() + 1;
                dayTo = currentdate.getDate();
              //  alert('Please select To date');
               // return;
            }
            else {
                 yearTo = jsToDate.getFullYear(); // where getFullYear returns the year (four digits)
                 monthTo = jsToDate.getMonth()+1; // where getMonth returns the month (from 0-11)
                dayTo = jsToDate.getDate();   // where getDate returns the day of the month (from 1-31)
            }
           // var params = document.getElementById("SensorList").value;
          
          var station = document.getElementById("Sname").value;

          
          
              window.location.href= 'GraphMultiple2.php?FY=' + yearFrom + "&FM=" + monthFrom + "&FD=" + dayFrom + '&TY=' + yearTo + "&TM=" + monthTo + "&TD=" + dayTo + "&PARAMS=" + params+"&station="+station;
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

   <script type="text/javascript">
   	function GetData()
   	{
   	var stn = document.getElementById("Sname").value; 

if (stn=="") {
alert('Please Search and Select Station!');
}
 else if(document.getElementById("Sname").value.trim()=="")
 {
  alert('Please Search and Select Station!');
 }
  else{
         window.location.href='GetDataMultiple.php?Sname='+stn;
         }
     }

   function exportToCSV()
     {
   if(document.getElementById("Sname").value.trim()=="")
 {
  alert('Please Search and Select Station!');
  return;
 }
 else if (document.getElementById("SensorList").value.trim()=="") {
  alert('Please Select Sensor!');
  return;
 }
  else if (document.getElementById("EditStartDate").value.trim()==""&&document.getElementById("EditEndDate").value.trim()==""&&document.getElementById("hours").value.trim()!="") {
   var yearFrom;
            var monthFrom;
            var dayFrom;
            var yearTo;
            var monthTo;
            var dayTo;
              var currentdate = new Date();

                yearFrom = currentdate.getFullYear();
                monthFrom = currentdate.getMonth() + 1;
                dayFrom = currentdate.getDate();

                yearTo = currentdate.getFullYear();
                monthTo = currentdate.getMonth() + 1;
                dayTo = currentdate.getDate();
                    var params = document.getElementById("SensorList").value;
             var hours=document.getElementById("hours").value.trim();
                var station = document.getElementById("Sname").value;
              window.location.href= 'GraphMultiple2.php?FY=' + yearFrom + "&FM=" + monthFrom + "&FD=" + dayFrom + '&TY=' + yearTo + "&TM=" + monthTo + "&TD=" + dayTo + "&PARAMS=" + params+"&hours="+hours+"&station="+station+"&csv=yes";
  
 }
  else if (document.getElementById("EditEndDate").value.trim()==""&&document.getElementById("EditEndDate").value.trim()==""&&document.getElementById("hours").value.trim()=="") {
     alert('Please Select Date or Hours!');
 }
 else if (document.getElementById("EditEndDate").value.trim()!=""&&document.getElementById("EditEndDate").value.trim()!=""&&(document.getElementById("hours").value.trim()=="" || document.getElementById("hours").value.trim()!="") ){

            var Ids = [];
            var Names = [];
            var i = 0;
            var yearFrom;
            var monthFrom;
            var dayFrom;
            var yearTo;
            var monthTo;
            var dayTo;

            var currentdate = new Date();
            
            var jsFromDate =document.getElementById("EditStartDate").value;
             //EditStartDate.GetDate();
             jsFromDate=new Date(jsFromDate);
  
            if (jsFromDate =="") {
                 
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
            var jsToDate = document.getElementById("EditEndDate").value;
               jsToDate=new Date(jsToDate);
            if (jsToDate == null) {

                yearTo = currentdate.getFullYear();
                monthTo = currentdate.getMonth() + 1;
                dayTo = currentdate.getDate();
              //  alert('Please select To date');
               // return;
            }
            else {
                 yearTo = jsToDate.getFullYear(); // where getFullYear returns the year (four digits)
                 monthTo = jsToDate.getMonth()+1; // where getMonth returns the month (from 0-11)
                dayTo = jsToDate.getDate();   // where getDate returns the day of the month (from 1-31)
            }
           // var params = document.getElementById("SensorList").value;
          
          var station = document.getElementById("Sname").value;

          
          
              window.location.href= 'GraphMultiple.php?FY=' + yearFrom + "&FM=" + monthFrom + "&FD=" + dayFrom + '&TY=' + yearTo + "&TM=" + monthTo + "&TD=" + dayTo + "&PARAMS=" + params+"&station="+station+"&csv=yes";
             }
           }
   </script>
   <script type="text/javascript">
     function resetb()
     {

      document.getElementById('EditStartDate').value="";
       document.getElementById('EditEndDate').value="";
       document.getElementById('hours').value="";
      
    }
     

   </script>
   <script>
function val() {
d = document.getElementById("type_of_report").value;
if (d.trim()=="Daily") {
  window.location.href='report.php';
}
if (d.trim()=="Monthly") {
  window.location.href='report.php';
}
if (d.trim()=="Annual") {
  window.location.href='report.php';
}
if (d.trim()=="Graph") {
  window.location.href='GraphMultiple2.php';
}

}
$('.selectpicker').selectpicker({
  style: 'btn-info',
  size: 4
});

function emptyHours()
{
  document.getElementById('hours').value="";
}
</script>
<style type="text/css">
  td{
    padding-left: 5px;
  }
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.0.0-alpha.1/jspdf.plugin.autotable.min.js"></script>
<script>
   function demoFromHTML() {
        var doc = new jsPDF('p', 'pt','a4');
 
 




doc.addHTML($('#jqxSplitter')[0], 15, 15, {
      'background': '#fff',
    }, function() {
      doc.save('report.pdf');
   });
 
    } 
    </script>
<script type="text/javascript">
 function getSensors(){
    window.location.href="GraphMultiple2.php?station="+$("#Sname").val();
  }

</script>
   

   <form>
   <br>
   <table style="width: 90%;margin-left: 1%">
	<tr>

	<!-- Search Station-->
	<td >


<select class="form-control" id="type_of_report" onchange="val()">
  <option value="Daily">Daily Summary</option>
  <option value="Monthly">Monthly Summary</option>
  <option value="Annual">Annual Summary</option>

  <option value="Graph" selected >Graph</option>
  </select>
    </td>

	<td>  <input type="text" id="Sname" onchange="getSensors()"  name="StationName" class="form-control" required  value='<?php 
if(isset($_GET['station']))
{

	echo $_GET['station'];
}

	?>' placeholder="Search Station"> 

  </td>
<!-- 	<td  > <input type="button" name="Search" value="Search" class="btn btn-sm btn-info"  onclick="GetData()"> </td>

-->
	

<td>
	
<?php
 
$stns=explode(";", $_GET['station']);
  $sql_temp=' where ';
for ($i=0; $i <count($stns) ; $i++)
 { 

    $stn_name='';
     $data=trim($stns[$i]);
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
  $sql_temp.=" \"StationFullName\"='$stn_name' or";
 }
}
}
}



}
 $sql_temp=rtrim($sql_temp,"or");
   $sql_query1="SELECT distinct \"Sensor\" FROM \"SensorValues\" $sql_temp  order by \"Sensor\"";
?>

     <select name="SensorList"  onchange="PlotGraph()" id="SensorList" class="selectpicker" multiple="">

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

{ echo 'selected';}} } ?> > <?php echo $row[0]?> </option>
<?php

    }
}
    ?>
			
		</select>
	
		
</td>


<td>
	
        <input placeholder="Hours" style="width:90%"  type="number" id="hours" name="hours" class="form-control"  value="<?php if(isset($_GET['hours2'])) {
  echo $_GET['hours2'];
    } ?>">


    </td>
		<td>  <label >From</label>
<?php if (isset($_GET['FY'])&&isset($_GET['FM'])&&isset($_GET['FD'])) {
    
      $da= strtotime( $_GET['FY'].'/'.$_GET['FM'].'/'.$_GET['FD']);
  
    } ?>
    <?php if (isset($_GET['TY'])&&isset($_GET['TM'])&&isset($_GET['TD'])) {
 
      $da2= strtotime( $_GET['TY'].'/'.$_GET['TM'].'/'.$_GET['TD']);
  
    } ?>

    </td>
		<td > <input type="date" name="EditStartDate" id="EditStartDate" class="form-control" required value="<?php if(isset($da)) { echo date('Y-m-d',$da);} ?>" onChange="emptyHours()"></td>
		<td ><label> To</label>  </td>
		<td ><input type="date"  class="form-control" ID="EditEndDate" required value="<?php if(isset($da)) { echo date('Y-m-d',$da2);} ?>" onChange="emptyHours()"> </td>
		<td>
		<input type="button"  onclick="PlotGraph()" class="btn btn-sm btn-info" name="btnPlot" value="Get">
		</td>
 


<!--  end date select-->
	</tr>
</table>
</form>

<?php
include_once 'GraphJSonMultiple2.php';
?>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/i18n/defaults-*.min.js"></script>

<style type="text/css">
  td
  {
    padding-left: 5px;
  }
</style>
