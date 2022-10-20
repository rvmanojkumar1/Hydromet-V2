
<!DOCTYPE php>

<head>
							<?php
								include("includes/link.php");
							?>
</head>

<body class="cnt-home" >  
							<?php
								include("includes/header.php");
							?>
   	
	<div class="body-content outer-top-xs" id="top-banner-and-menu">
  <div class="container-fluid">
    <div class="row"> 

     <div class="col-xs-12 col-sm-12 col-md-12 sidebar"> 
	 <div >
	<?php

include_once 'database.php';
ini_set('max_execution_time', 0); 
 ini_set('memory_limit', '-1');

if(isset($_GET['select1']))
{
	$var1=$_GET['select1'];
	$_SESSION['SName']=$var1;

}
?>


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script> 
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js" type="text/javascript"></script> 
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>



 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous" />

           <link rel="stylesheet" href="assets/jquery-ui.css">
       

    <script type="text/javascript" src="assets/jquery.js"></script>
<script type="text/javascript" src="assets/jquery-ui.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.js"></script>
           
 <script type="text/javascript">

$(function() 
{
 $(  "#Sname").autocomplete({
  source: 'autocompelete.php',
   close: function( event, ui ) { getSensors();
    
    }
 });
});

$(document).ready(function(){
      if ( $('[type="date"]').prop('type') != 'date' ) {
    $('[type="date"]').datepicker();
}
  
});
</script>
<script type="text/javascript">
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

</script>
<script type="text/javascript">

</script>
 <script type="text/javascript">
 

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
    debugger;
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

				// var from_date=yearFrom+"-0"+monthFrom+"-"+dayFrom;
				// var from_date=dayFrom+"-0"+monthFrom+"-"+yearFrom;

				
				if(monthTo.length==1){monthTo="0"+monthTo;}

				// var to_date=yearTo+"-0"+monthTo+"-"+dayTo;
				//  var to_date=dayTo+"-0"+monthTo+"-"+yearTo;

				
                var strdate = yearFrom + "/" + monthFrom + "/" + dayFrom;

        console.log(strdate);

        var enddate = yearTo + "/" + monthTo + "/" + dayTo;

        var start = moment(strdate).format('YYYY-MM-DD');

        var end = moment(enddate).format('YYYY-MM-DD');
        console.log(end);
        document.getElementById('EditStartDate').value = start;
        document.getElementById('EditEndDate').value = end;
				
				if(hours==0){hours=24;}
                $("#hours").val(hours);
				$("#EditStartDate").val(start);
				$("#EditEndDate").val(end);
             window.location.href= 'Graph.php?FY=' + yearFrom + "&FM=" + monthFrom + "&FD=" + dayFrom + '&TY=' + yearTo + "&TM=" + monthTo + "&TD=" + dayTo + "&PARAMS=" + params+"&hours="+hours+"&station="+station+"&hours2="+hours2;
  
 }
  else if (document.getElementById("EditEndDate").value.trim()==""&&document.getElementById("EditEndDate").value.trim()==""&&document.getElementById("hours").value.trim()=="") {
    debugger;
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
                var strdate = yearFrom + "/" + monthFrom + "/" + dayFrom;

                    console.log(strdate);

                    var enddate = yearTo + "/" + monthTo + "/" + dayTo;

                    var start = moment(strdate).format('YYYY-MM-DD');

                    var end = moment(enddate).format('YYYY-MM-DD');
                    console.log(end);
                    document.getElementById('EditStartDate').value = start;
                    document.getElementById('EditEndDate').value = end;
        
        if(hours==0){hours=24;}
        $("#hours").val(hours);
        $("#EditStartDate").val(start);
        $("#EditEndDate").val(end);
            window.location.href= 'Graph.php?FY=' + yearFrom + "&FM=" + monthFrom + "&FD=" + dayFrom + '&TY=' + yearTo + "&TM=" + monthTo + "&TD=" + dayTo + "&PARAMS=" + params+"&station="+station+"&hours2="+hours2+"&hours="+hours;



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
          var from_date=dayFrom+"-0"+monthFrom+"-"+yearFrom;

				
if(monthTo.length==1){monthTo="0"+monthTo;}

// var to_date=yearTo+"-0"+monthTo+"-"+dayTo;
 var to_date=dayTo+"-0"+monthTo+"-"+yearTo;
				
				
				
				if(hours==0){hours=24;}
                $("#hours").val(hours);
				$("#EditStartDate").val(from_date);
				$("#EditEndDate").val(to_date);
          window.location.href= 'Graph.php?FY=' + yearFrom + "&FM=" + monthFrom + "&FD=" + dayFrom + '&TY=' + yearTo + "&TM=" + monthTo + "&TD=" + dayTo + "&PARAMS=" + params+"&hours="+hours+"&station="+station+"&hours2="+hours2;
             // window.location.href= 'Graph.php?FY=' + yearFrom + "&FM=" + monthFrom + "&FD=" + dayFrom + '&TY=' + yearTo + "&TM=" + monthTo + "&TD=" + dayTo + "&PARAMS=" + params+"&station="+station;
             }
           }
                </script>  

  <script type="text/javascript">


 	 function PlotGraph() {
 	 	//alert('ok');
		debugger;
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
                var hours=document.getElementById("hours").value.trim();
                var hours2=EditEndDate-EditStartDate/1000*60*60;
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
              window.location.href= 'Graph.php?FY=' + yearFrom + "&FM=" + monthFrom + "&FD=" + dayFrom + '&TY=' + yearTo + "&TM=" + monthTo + "&TD=" + dayTo + "&PARAMS=" + params+"&hours="+hours+"&station="+station+"&hours2="+hours2;
  
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
				
				
      				window.location.href= 'Graph.php?FY=' + yearFrom + "&FM=" + monthFrom + "&FD=" + dayFrom + '&TY=' + yearTo + "&TM=" + monthTo + "&TD=" + dayTo + "&PARAMS=" + params+"&station="+station+"&hours2="+hours2+"&hours="+hours;



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
			//var hours2=diff_hours();
             var hours2=24*60*60*1000;
				var hours2=EditEndDate-EditStartDate/1000*60*60;
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

          
                  window.location.href= 'Graph.php?FY=' + yearFrom + "&FM=" + monthFrom + "&FD=" + dayFrom + '&TY=' + yearTo + "&TM=" + monthTo + "&TD=" + dayTo + "&PARAMS=" + params+"&hours="+hours+"&station="+station+"&hours2="+hours2;   
             // window.location.href= 'Graph.php?FY=' + yearFrom + "&FM=" + monthFrom + "&FD=" + dayFrom + '&TY=' + yearTo + "&TM=" + monthTo + "&TD=" + dayTo + "&PARAMS=" + params+"&station="+station;
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
         window.location.href='graphData.php?Sname='+stn;
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
  else if (document.getElementById("hours").value.trim()!="") {
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
            // var hours=document.getElementById("hours").value.trim();
                var station = document.getElementById("Sname").value;
                window.location.href= 'Graph.php?FY=' + yearFrom + "&FM=" + monthFrom + "&FD=" + dayFrom + '&TY=' + yearTo + "&TM=" + monthTo + "&TD=" + dayTo + "&PARAMS=" + params+"&hours="+hours+"&station="+station+"&csv=yes&hours2="+hours2;
  
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
                window.location.href= 'Graph.php?FY=' + yearFrom + "&FM=" + monthFrom + "&FD=" + dayFrom + '&TY=' + yearTo + "&TM=" + monthTo + "&TD=" + dayTo + "&PARAMS=" + params+"&hours="+hours+"&station="+station+"&hours2="+hours2;

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
			 var hours=24;
                var hours2=hours;

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

          window.location.href= 'Graph.php?FY=' + yearFrom + "&FM=" + monthFrom + "&FD=" + dayFrom + '&TY=' + yearTo + "&TM=" + monthTo + "&TD=" + dayTo + "&PARAMS=" + params+"&hours="+hours+"&station="+station+"&hours2="+hours2;
             // window.location.href= 'Graph.php?FY=' + yearFrom + "&FM=" + monthFrom + "&FD=" + dayFrom + '&TY=' + yearTo + "&TM=" + monthTo + "&TD=" + dayTo + "&PARAMS=" + params+"&station="+station+"&csv=yes";
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
	 //function diff_hours(EditEndDate, EditStartDate) 
    // {
     // document.getElementById('hours2').value="hours2";
 // var diff =(EditEndDate.getTime() - EditStartDate.getTime()) / 1000*60*60;
 // diff /= (60 * 60*24*1000);
 // return Math.abs(Math.round(diff));
  
     //}
			

   </script>
<script>
function val(selectObject) {
d = selectObject.value;
if (d.trim()=="multiple") {
  window.location.href='GraphMultiple2.php';
}

if (d.trim()=="multiple2") {
  window.location.href='SingleGraphMultiSensor.php';
}
if (d.trim()=="single") {
  window.location.href='Graph.php';
}
if (d.trim()=="multiple3") {
  window.location.href='GraphMultiple.php';
}
}

function emptyHours()
{
  //document.getElementById('hours').value="";
  if(hours=="")
  var diff =(EditEndDate.getTime() - EditStartDate.getTime()) / 1000;
  diff /= (60 * 60);
  return Math.abs(Math.round(diff));
 else
	 hours=hours*60*60*1000;
}

</script>


 
 

  
<form class="mobilemargintop">

<!-- <!.. this is only visible for desktop and large desktop..> -->


  <table >
 
 <tr>
 <td style="padding-left: 3px"> <div class="form-group">  <select  id="selectgraph" onchange="val(this)" class="form-control">
    <option value="single" selected="">Single Station/Sensor</option>
     <option value="multiple3">Single Station / Multiple Sensor</option>

    <!-- <optiononchange="val(this)" value="multiple">Multiple Station/Sensor</option>-->
<option value="multiple2">Multiple Station/Sensor</option>

  </select></div>
  </td>

 <td class="pad"> <div class="form-group"> <input placeholder="Search Station" type="text" id="Sname" name="StationName" class="form-control" onchange="getSensors()" required  value='<?php 
 if (isset($_GET['station'])) 
 {
echo $_GET['station']; 
$_SESSION['SName']=$_GET['station']; 
}


 ?>'> </div>

 </td>

   <td class="pad"> <div class="form-group"> <select style="width:  100%" name="SensorList" id="SensorList" onchange="PlotGraph_sensor()" class="form-control" required >
<option value="" disabled selected>Sensor</option>
   
     
   </select>

   </div>
   </td>
 
 

  
   <td style="padding-left: 3px"> <div class="form-group">
   <input placeholder="Hours" type="number" id="hours" style="width: 90%" name="hours" class="form-control" value="<?php if(isset($_GET['hours2'])) {
 echo $_GET['hours2'];
   } ?>">

    </div></td>
   <td>  <label >From</label>
<?php if (isset($_GET['FY'])&&isset($_GET['FM'])&&isset($_GET['FD'])) {
   
     $da= strtotime( $_GET['FY'].'/'.$_GET['FM'].'/'.$_GET['FD']);
 
   } ?>
   <?php if (isset($_GET['TY'])&&isset($_GET['TM'])&&isset($_GET['TD'])) {

     $da2= strtotime( $_GET['TY'].'/'.$_GET['TM'].'/'.$_GET['TD']);
 
   } 

//echo date('Y-n-j')."  AND  ".$da;
   ?>

   </td>
   <td style="padding-left: 3px"> <div class="form-group"> <input style="width: 100%" type="date" name="EditStartDate" id="EditStartDate" class="form-control" required value="<?php if(isset($da)) { echo date('Y-m-d',$da);} ?>" onChange="emptyHours()"></div></td>
   <td style="padding-left: 3px"><label> To</label>  </td>
   <td style="padding-left: 3px"> <div class="form-group"><input style="width: 100%" type="date"  class="form-control" ID="EditEndDate" required value="<?php if(isset($da)) { echo date('Y-m-d',$da2);} ?>" onChange="emptyHours()"></div> </td>
   <td class="pad">
   <div  class="form-group "><input type="button"  onclick="PlotGraph()" class="btn btn-sm btn-primary" name="btnPlot" value="Plot"> </div>
   </td>
   <td class="pad">
   <div class="form-group"> <a   class="btn btn-sm btn-primary" name="btnExportToCvs" href="javascript:window.location.href='exportcsv.php'">Export</a></div>
   </td>



 </tr>
</table>

  </form>
 
  <script type="text/javascript">
  getSensors();
 
  </script>
<?php
include_once 'GraphJSon.php';
?>
<!--<input type="button" value="Next" onclick="next('<?php echo $start; ?>','<?php echo $end; ?>')">
	-->

	
	
	</div>
	</div>
	</div>
	</div>
	</div>
	
	
	

							<?php
							//	include("includes/footer.php");
							?>
							<?php
								//include("includes/link2.php");
							?>


</body>
</html>



