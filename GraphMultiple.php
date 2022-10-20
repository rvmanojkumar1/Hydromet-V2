<?php
include("includes/link.php");

?>

              <?php
include("includes/header.php");

?>
<?php
include_once 'database.php';

if (isset($_POST['chekedstn'])) {
    $stnnames  = '';
    $checkbox1 = $_POST['chekedstn'];
    foreach ($checkbox1 as $chk1) {
        $stnnames .= $chk1 . ";";
    }
    
    $_SESSION['SName'] = $stnnames;
    
    // echo "<script>window.location.href='GraphMultiple.php?select1='+$stnnames<script>";
    // header("Location : GraphMultiple.php?select1=$stnnames");
    
}

?>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>


<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
    
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.js"></script>
 
<script type="text/javascript">
     $(document).ready(function(){

     var e=document.getElementById("SensorList");
     console.log(e);

  // e.innerHTML="";


  
});
/*
function PlotGraph_sensor() {
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
	//  alert();
   var yearFrom;
            var monthFrom;
            var dayFrom;
            var yearTo;
            var monthTo;
            var dayTo;
                var hours=document.getElementById("hours").value.trim();
                var hours2=hours;
                var sd=0;
                sd=Math.floor( hours/24);

                hours=hours%24;

                var currentdate = new Date();
             var date = new Date();
var last = new Date(date.getTime() - (sd * 24 * 60 * 60 * 1000));
                yearFrom = last.getFullYear();
                monthFrom = last.getMonth() + 1;
               dayFrom = last.getDate();

                yearTo = currentdate.getFullYear();
                monthTo = currentdate.getMonth() + 1;
                dayTo = currentdate.getDate();
                    var params = document.getElementById("SensorList").value;
                     
                var station = document.getElementById("Sname").value;
				
				if(monthFrom.length==1){monthFrom="0"+monthFrom;}
				var strdate = yearFrom + "/" + monthFrom + "/" + dayFrom;

                    console.log(strdate);

                    var enddate = yearTo + "/" + monthTo + "/" + dayTo;

                    var start = moment(strdate).format('YYYY-MM-DD');

                    var end = moment(enddate).format('YYYY-MM-DD');
                    console.log(end);
                    document.getElementById('EditStartDate').value = start;
                    document.getElementById('EditEndDate').value = end;
           //   window.location.href= 'Graph.php?FY=' + yearFrom + "&FM=" + monthFrom + "&FD=" + dayFrom + '&TY=' + yearTo + "&TM=" + monthTo + "&TD=" + dayTo + "&PARAMS=" + params+"&hours="+hours+"&station="+station+"&hours2="+hours2;
  
 }
  else if (document.getElementById("EditEndDate").value.trim()==""&&document.getElementById("EditEndDate").value.trim()==""&&document.getElementById("hours").value.trim()=="") {
  
                var yearFrom;
                var monthFrom;
                var dayFrom;
                var yearTo;
                var monthTo;
                var dayTo;
                var hours=24;
                 var hours2=hours;
                var sd=0;
                sd=Math.floor( hours/24);

                hours=hours%24;

                var currentdate = new Date();

               var date = new Date();
var last = new Date(date.getTime() - (sd * 24 * 60 * 60 * 1000));
                yearFrom = last.getFullYear();
                monthFrom = last.getMonth() + 1;
               dayFrom = last.getDate();

                yearTo = currentdate.getFullYear();
                monthTo = currentdate.getMonth() + 1;
                dayTo = currentdate.getDate();
                    var params = document.getElementById("SensorList").value;
     
                var station = document.getElementById("Sname").value;
				
				if(monthFrom.length==1){monthFrom="0"+monthFrom;}
        
          if(monthTo.length==1){monthTo="0"+monthTo;}


        
       if(hours==0){hours=24;}
                $("#hours").val(hours);
               
        
				var strdate = yearFrom + "/" + monthFrom + "/" + dayFrom;

                    console.log(strdate);

                    var enddate = yearTo + "/" + monthTo + "/" + dayTo;

                    var start = moment(strdate).format('YYYY-MM-DD');

                    var end = moment(enddate).format('YYYY-MM-DD');
                    console.log(end);
                    document.getElementById('EditStartDate').value = start;
                    document.getElementById('EditEndDate').value = end;
            //  window.location.href= 'Graph.php?FY=' + yearFrom + "&FM=" + monthFrom + "&FD=" + dayFrom + '&TY=' + yearTo + "&TM=" + monthTo + "&TD=" + dayTo + "&PARAMS=" + params+"&station="+station+"&hours2="+hours2+"&hours="+hours;



 }
 else if (document.getElementById("EditEndDate").value.trim()!=""&&document.getElementById("EditEndDate").value.trim()!=""&&document.getElementById("hours").value.trim()=="" ){

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
            var params = document.getElementById("SensorList").value;
          
          var station = document.getElementById("Sname").value;

          if(monthFrom.length==1){monthFrom="0"+monthFrom;}
			
				
				if(monthTo.length==1){monthTo="0"+monthTo;}
				
				


        var strdate = yearFrom + "/" + monthFrom + "/" + dayFrom;

                    console.log(strdate);

                    var enddate = yearTo + "/" + monthTo + "/" + dayTo;

                    var start = moment(strdate).format('YYYY-MM-DD');

                    var end = moment(enddate).format('YYYY-MM-DD');
                    console.log(end);
                    document.getElementById('EditStartDate').value = start;
                    document.getElementById('EditEndDate').value = end;
          
             // window.location.href= 'Graph.php?FY=' + yearFrom + "&FM=" + monthFrom + "&FD=" + dayFrom + '&TY=' + yearTo + "&TM=" + monthTo + "&TD=" + dayTo + "&PARAMS=" + params+"&station="+station;
             }
           } */
               
function PlotGraph() {

    var selected = $("#SensorList option:selected");
    var params = "";
    selected.each(function() {
        params += $(this).val() + ";";
    });



    // alert('ok');

    if (document.getElementById("Sname").value.trim() == "") {
        alert('Please Search and Select Station!');
        return;
    } else if (document.getElementById("SensorList").value.trim() == "") {
        alert('Please Select Sensor!');
        return;
    } else if ((document.getElementById("hours").value.trim()!="")&&(document.getElementById("EditStartDate").value.trim()!="")&&(document.getElementById("EditEndDate").value.trim()!="")) 
    {
      //print  "Fourth if cond";
      var yearFrom;
      var monthFrom;
      var dayFrom;
      var yearTo;
      var monthTo;
      var dayTo;
      var hours=document.getElementById("hours").value.trim();
      var hours2=hours;
      var sd=0;
      sd=Math.floor( hours/24);
      hours=hours%24;
      var currentdate = new Date();
      var date = new Date();
      var last = new Date(date.getTime() - (sd * 24 * 60 * 60 * 1000));
      yearFrom = last.getFullYear();
      monthFrom = last.getMonth() + 1;
      dayFrom = last.getDate();
      yearTo = currentdate.getFullYear();
      monthTo = currentdate.getMonth() + 1;
      dayTo = currentdate.getDate();
      var selected = $("#SensorList option:selected");

        var params = "";
        selected.each(function() {
            params += $(this).val() + ";";
        });
         
      var station = document.getElementById("Sname").value;
      window.location.href= 'GraphMultiple.php?FY=' + yearFrom + "&FM=" + monthFrom + "&FD=" + dayFrom + '&TY=' + yearTo + "&TM=" + monthTo + "&TD=" + dayTo + "&PARAMS=" + params+"&hours="+hours+"&station="+station+"&hours2="+hours2;
    }

        



       
        //    document.getElementById('hours').value=hours2;
        // var  strdate= yearFrom+"/"+monthFrom+"/"+dayFrom;
        // console.log(strdate);

        // var  enddate= yearTo+"/"+monthTo+"/"+dayTo;

        // var start = moment(strdate).format('YYYY-MM-DD');

        //  var end = moment(enddate).format('YYYY-MM-DD');
        //  console.log(end);
        //  document.getElementById('EditStartDate').value=start;
        //   document.getElementById('EditEndDate').value=end;


    else if (document.getElementById("EditStartDate").value.trim()!=""&&document.getElementById("EditEndDate").value.trim()!=""&&document.getElementById("hours").value.trim()=="" )
    {
      //print  "Sixth if cond";
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
      
        yearFrom = jsFromDate.getFullYear(); // where getFullYear returns the year (four digits)
        monthFrom = jsFromDate.getMonth()+1; // where getMonth returns the month (from 0-11)
        dayFrom = jsFromDate.getDate();   // where getDate returns the day of the month (from 1-31)
      
      var jsToDate = document.getElementById("EditEndDate").value;
      jsToDate=new Date(jsToDate);
      
      
        yearTo = jsToDate.getFullYear(); // where getFullYear returns the year (four digits)
        monthTo = jsToDate.getMonth()+1; // where getMonth returns the month (from 0-11)
        dayTo = jsToDate.getDate()+1;   // where getDate returns the day of the month (from 1-31)
      
      var selected = $("#SensorList option:selected");

        var params = "";
        selected.each(function() {
            params += $(this).val() + ";";
        });          
      var station = document.getElementById("Sname").value;
      var hoursdiff = Math.abs(jsFromDate - jsToDate)/36e5;
      window.location.href= 'GraphMultiple.php?FY=' + yearFrom + "&FM=" + monthFrom + "&FD=" + dayFrom + '&TY=' + yearTo + "&TM=" + monthTo + "&TD=" + dayTo + "&PARAMS=" + params+ "&hours=" + hours+"&station="+station+"&hours2="+hoursdiff;
    }
        
        
} 

function UpdateDates() {

  
debugger
    var selected = $("#SensorList option:selected");

    var params = "";
    selected.each(function() {
        params += $(this).val() + ";";
    });



    // alert('ok');

    if (document.getElementById("Sname").value.trim() == "") {
        alert('Please Search and Select Station!');
        return;
    } else if (document.getElementById("SensorList").value.trim() == "") {
        alert('Please Select Sensor!');
        return;
    } if (document.getElementById("EditStartDate").value.trim() == "" && document.getElementById("EditEndDate").value.trim() == "" && document.getElementById("hours").value.trim() == "") {

        var yearFrom;
        var monthFrom;
        var dayFrom;
        var yearTo;
        var monthTo;
        var dayTo;
        var currentdate = new Date();
        var hours = 24;
        var hours2 = hours;
        var sd = 0;
        sd = Math.floor(hours / 24);

        hours = hours % 24;


        var date = new Date();
        var last = new Date(date.getTime() - (sd * 24 * 60 * 60 * 1000));
        yearFrom = last.getFullYear();
        monthFrom = last.getMonth() + 1;
        dayFrom = last.getDate();

        yearTo = currentdate.getFullYear();
        monthTo = currentdate.getMonth() + 1;
        dayTo = currentdate.getDate();

        // var params = document.getElementById("SensorList").value;

       var selected = $("#SensorList option:selected");

        var params = "";
        selected.each(function() {
            params += $(this).val() + ";";
        });

        var station = document.getElementById("Sname").value;


        // window.location.href= 'GraphMultiple.php?FY=' + yearFrom + "&FM=" + monthFrom + "&FD=" + dayFrom + '&TY=' + yearTo + "&TM=" + monthTo + "&TD=" + dayTo + "&PARAMS=" + params+"&station="+station+"&hours2="+hours2+"&hours="+hours;


        // document.getElementById('EditStartDate').value=currentdate;
        // document.getElementById(' EditEndDate').value=last;
        document.getElementById('hours').value = hours2;
        var strdate = yearFrom + "/" + monthFrom + "/" + dayFrom;
        console.log(strdate);

        var enddate = yearTo + "/" + monthTo + "/" + dayTo;

        var start = moment(strdate).format('YYYY-MM-DD');

        var end = moment(enddate).format('YYYY-MM-DD');
        console.log(end);
        document.getElementById('EditStartDate').value = start;
        document.getElementById('EditEndDate').value = end;


        //  $da = strtotime($_GET['FY'] . '/' . $_GET['FM'] . '/' . $_GET['FD']);

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
@media (max-width: 480px) { 

td{
   min-width:100%;
  
   display:inline-block !important;
 }
 .mobilemargintop{
  margin-top:10px;
}
}
   </style>

<script type="text/javascript">

    function GetData() {
    var stn = document.getElementById('Sname').value;

    window.location.href='GraphMultiple.php?station='+stn;



}

function exportToCSV() {
    if (document.getElementById("Sname").value.trim() == "") {
        alert('Please Search and Select Station!');
        return;
    } else if (document.getElementById("SensorList").value.trim() == "") {
        alert('Please Select Sensor!');
        return;
    } else if (document.getElementById("EditStartDate").value.trim() == "" && document.getElementById("EditEndDate").value.trim() == "" && document.getElementById("hours").value.trim() != "") {
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
        var selected = $("#SensorList option:selected");

        var params = "";
        selected.each(function() {
            params += $(this).val() + ";";
        });
        var hours = document.getElementById("hours").value.trim();
        var station = document.getElementById("Sname").value;
        window.location.href = 'Graph.php?FY=' + yearFrom + "&FM=" + monthFrom + "&FD=" + dayFrom + '&TY=' + yearTo + "&TM=" + monthTo + "&TD=" + dayTo + "&PARAMS=" + params + "&hours=" + hours + "&station=" + station + "&csv=yes";

    } else if (document.getElementById("EditEndDate").value.trim() == "" && document.getElementById("EditEndDate").value.trim() == "" && document.getElementById("hours").value.trim() == "") {
        alert('Please Select Date or Hours!');
    } else if (document.getElementById("EditEndDate").value.trim() != "" && document.getElementById("EditEndDate").value.trim() != "" && (document.getElementById("hours").value.trim() == "" || document.getElementById("hours").value.trim() != "")) {

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

        var jsFromDate = document.getElementById("EditStartDate").value;

        // EditStartDate.GetDate();

        jsFromDate = new Date(jsFromDate);

        if (jsFromDate == "") {

            yearFrom = currentdate.getFullYear();
            monthFrom = currentdate.getMonth() + 1;
            dayFrom = currentdate.getDate();

            //  alert('Please select From date');


        } else {
            yearFrom = jsFromDate.getFullYear(); // where getFullYear returns the year (four digits)
            monthFrom = jsFromDate.getMonth() + 1; // where getMonth returns the month (from 0-11)
            dayFrom = jsFromDate.getDate(); // where getDate returns the day of the month (from 1-31)
        }
        var jsToDate = document.getElementById("EditEndDate").value;
        jsToDate = new Date(jsToDate);
        if (jsToDate == null) {

            yearTo = currentdate.getFullYear();
            monthTo = currentdate.getMonth() + 1;
            dayTo = currentdate.getDate();

            //  alert('Please select To date');
            // return;

        } else {
            yearTo = jsToDate.getFullYear(); // where getFullYear returns the year (four digits)
            monthTo = jsToDate.getMonth() + 1; // where getMonth returns the month (from 0-11)
            dayTo = jsToDate.getDate(); // where getDate returns the day of the month (from 1-31)
        }

        // var params = document.getElementById("SensorList").value;

       var selected = $("#SensorList option:selected");

        var params = "";
        selected.each(function() {
            params += $(this).val() + ";";
        });
        
        var station = document.getElementById("Sname").value;



        window.location.href = 'GraphMultiple.php?FY=' + yearFrom + "&FM=" + monthFrom + "&FD=" + dayFrom + '&TY=' + yearTo + "&TM=" + monthTo + "&TD=" + dayTo + "&PARAMS=" + params + "&station=" + station + "&csv=yes";
    }
} 
</script> 

<script type = "text/javascript" >
    function resetb() {
       
        document.getElementById('EditStartDate').value = "";
        document.getElementById('EditEndDate').value = "";
        var elements = document.getElementById('hours').options;
        for (var i = 0; i < elements.length; i++) {
            elements[i].selected = false;
        }
    }
</script> 

<script>
    function val() {

        d = document.getElementById("selectgraph").value;
        if (d.trim() == "single") {
            window.location.href = 'Graph.php';
        }
        if (d.trim() == "multiple2") {
            window.location.href = 'SingleGraphMultiSensor.php';
        }
        if (d.trim() == "multiple") {
            window.location.href = 'GraphMultiple2.php';
        }
        if (d.trim() == "multiple3") {
            window.location.href = 'GraphMultiple.php';
        }
    }

$('.selectpicker').selectpicker({
    style: 'btn-info',
    size: 4
});

function emptyHours() {
    document.getElementById('hours').value = "";
}
</script>

 <form class="mobilemargintop">

    <table >
        <tr>

  <!-- Search Station-->
        <td >
        <table  >
            <tr>
                <td><div class="form-group">  
                    <select  id="selectgraph" onchange="val()" class="form-control">
                    <option value="single" >Single Station/Sensor</option>
                    <option value="multiple3" selected>Single Station / Multiple Sensor</option>
                <!--  <option value="multiple" >Multiple Station/Sensor</option>-->
                <option value="multiple2">Multiple Station/Sensor</option>
                </select></div> </td>

                <td class="pad"> <div class="form-group"> <input type="text" id="Sname" name="StationName" class="form-control" required  onchange="GetData()" value='<?php

                if (isset($_GET['station'])) {
                echo $_GET['station'];
                }

                ?>' placeholder="Keywords"> </div>

                </td>
            <!--  <td  class="pad"> <div class="form-group"> <input type="button" name="Search" value="Search" class="btn btn-sm btn-info"  onclick="GetData()"></div> </td>-->
            </tr>
        </table>
    </td>
<!-- end Search Station-->
<!-- Select  Sensor-->
    <td>
    <table  >
        <tr>
    
        <td class="pad"> <div class="form-group">
    <?php
    $stn_name   = '';
    $data       = trim($_GET['station']);
    $dataU      = strtoupper($data);
    $dataL      = strtolower($data);
    $result_stn = pg_query("select \"StationType\" from \"tblStationType\"");

    if (pg_num_rows($result_stn) > 0) {
        while ($row_user = pg_fetch_array($result_stn)) {
            
            // $sql_query= "select \"StationName\" from \"tblStation\" where \"StationName\" like '%" .$data."%' or \"StationName\" like '%".$dataU."%' or \"StationName\" like '%".$dataL."%' ";
            
            $sql_query  = "select \"Station_Full_Name\" from \"" . str_replace(' ', '_', $row_user['StationType']) . "\" where \"Station_Shef_Code\"='$data' or \"Station_Shef_Code\" = '$dataU' or \"Station_Shef_Code\"='$dataL' or \"Station_Full_Name\"='$data' or \"Station_Full_Name\"='$dataU' or \"Station_Full_Name\"='$dataL'";
            $result_set = pg_query($sql_query);
            if (pg_num_rows($result_set) > 0) {
                while ($data1 = pg_fetch_row($result_set)) {
                    $stn_name = $data1[0];
                }
            }
        }
    }

    $sql_query1 = "SELECT \"Sensor\" FROM \"SensorValues\" where \"StationFullName\"='$stn_name' order by \"Sensor\"";

    ?>

        <select name="SensorList" id="SensorList" onchange="UpdateDates()" class="selectpicker" multiple="">

    <!--     <select name="SensorList"  id="SensorList" class="selectpicker" multiple=""> -->

        <?php

    // if(isset($_SESSION['SName']))
    // {
    //  $data1=$_SESSION['SName'];
    //  $sql_query1="select distinct \"tblHydrometSensor\".\"SensorName\", \"tblHydrometSensor\".\"Id\"  from \"tblHydrometSensor\"  join \"tblStation_ID_MM_YY\"  on \"tblHydrometSensor\".\"Id\" =\"tblStation_ID_MM_YY\".\"Id\" AND \"tblStation_ID_MM_YY\".\"StationId\" = ( select \"StationId\" from \"tblStation\" Where \"StationName\"='$data1')";
    //  $sql_query1="select distinct \"Sensor\" from \"SensorValues\" where \"StationFullName\"='$data1'";
    // }
    // else
    // {
    // }

    $result_set1 = pg_query($sql_query1);

    if (pg_num_rows($result_set1) > 0) {
        while ($row = pg_fetch_row($result_set1)) {
    ?>

    <option value='<?php
            echo $row[0];
    ?>' <?php
            if (isset($_GET['PARAMS'])) {
                $temp = explode(';', trim($_GET['PARAMS']));
                for ($i = 0; $i < count($temp); $i++) {
                    
                    // code...
                    // echo $temp[$i];
                    
                    if ($temp[$i] === trim($row[0])) {
                        echo 'selected';
                    }
                }
            }
    ?> > <?php
            echo $row[0];
    ?> </option>
    <?php
        }
    }

    ?>
        
        </select>
        </div>
        </td>
    
        </tr>
    </table>
    </td>

<!-- end Select  Sensor-->
<!--  date select-->
<td>
  <table >
    <tr>
   
    <td style="padding-left: 3px">
      <div class="form-group">
        <input placeholder="Hours"  type="number" id="hours" name="hours" class="form-control"  value="<?php

if (isset($_GET['hours2'])) {
    echo $_GET['hours2'];
}
?>">


     </div></td>
    <td>  <label >From</label>
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

    </td>
    <td style="padding-left: 3px"> <div class="form-group"> <input type="date" name="EditStartDate" id="EditStartDate" class="form-control" required value="<?php

if (isset($da)) {
    echo date('Y-m-d', $da);
}
?>" onChange="emptyHours()"></div></td>
    <td style="padding-left: 3px"><label> To</label>  </td>
    <td style="padding-left: 3px"> <div class="form-group"><input type="date"  class="form-control" ID="EditEndDate" required value="<?php

if (isset($da)) {
    echo date('Y-m-d', $da2);
}
?>" onChange="emptyHours()"></div> </td>
    <td class="pad">
    <div  class="form-group"><input type="button"  onclick="PlotGraph()" class="btn btn-sm btn-primary" name="btnPlot" value="Plot"></div>
    </td>
    <td class="pad">
    <div class="form-group"> <a class="btn btn-sm btn-primary" name="btnExportToCvs" href="javascript:window.location.href='exportcsv2.php'">Export</a></div>
    </td>
  <!--  <td class="pad">
    <div class="form-group"> <input type="button"  class="btn btn-sm btn-info" name="btnExportToCvs" value="Export TO CSV " onclick="exportToCSV()"></div>
    </td>-->
 <!-- <td>
    <div class="form-group">
      <input type="button" name="reset" id="reset" class="btn btn-sm btn-info" value="Reset" onclick="resetb()">
    </div>
  </td>-->
  <!--<td class="pad">
    <div class="form-group"> <input type="button"  class="btn btn-sm btn-info" name="btnpdf" value="Expot TO PDF "></div>
    </td>-->

    </tr>


  </table>
</td>
<!--  end date select-->
  </tr>
</table>
</form>

<?php
include_once 'GraphJSonMultiple.php';

?>

 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/i18n/defaults-*.min.js"></script>