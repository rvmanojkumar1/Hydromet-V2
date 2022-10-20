<!DOCTYPE php>

<head>
              <?php
                include("includes/link.php");
              ?>


</head>

<body class="cnt-home">  
              <?php
                include("includes/adminheader.php");
              ?>

    
  <div class="body-content outer-top-xs" id="top-banner-and-menu">
  <div class="container-fluid">
    <div class="row"> 

     <div class="col-xs-12 col-sm-12 col-md-12 sidebar"> 
   <div style="height:100%">
  <?php

include_once 'database.php';
ini_set('max_execution_time', 0); 
 ini_set('memory_limit', '-1');

if(isset($_GET['station']))
{
  $var1=$_GET['station'];
  $_SESSION['SName']=$var1;

}
?>
<?php
$check=false;
if(isset($_POST['hide']))
{
 $checkedValue=$_POST['hide'];
  $checkedValue=explode("_", $checkedValue);
$table="'".$_GET['tablename']."'";
for ($i=0; $i <count($checkedValue) ; $i++) { 
   if (trim($checkedValue[$i])!='') {
   
  $sql_query="update \"$table\" set \"Flag\"='1' WHERE \"ReadingId\"='".trim($checkedValue[$i])."'";
  pg_query($sql_query);
}
}
$check=true;

echo '<script>$("#body2").load(location.href + " #body2");</script>';
}
?>
<?php

if(isset($_POST['show']))
{
 $uncheckedValue=$_POST['show'];
  $uncheckedValue=explode("_", $uncheckedValue);
$table="'".$_GET['tablename']."'";
for ($i=0; $i <count($uncheckedValue) ; $i++) { 
  if (trim($uncheckedValue[$i])!='') {
   
  
   $sql_query="update \"$table\" set \"Flag\"='0' WHERE \"ReadingId\"='".trim($uncheckedValue[$i])."'";
  pg_query($sql_query);
}
}
 $check=true;
echo '<script>$("#body2").load(location.href + " #body2");</script>';
}
if ($check) {
echo "<script>alert('Data has been saved!');</script>";
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
 <script type="text/javascript">
$(function() 
{
 $( "#Sname" ).autocomplete({

  source: 'autocompelete2.php'
 });
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


  function searchEnable()
  {
  var e=document.getElementById('search_check');

    if (e.checked==true) {
      document.getElementById('range').disabled=false;
      document.getElementById('myInput').disabled=false;
    }else
    {
        document.getElementById('myInput').value='';
        search();
       document.getElementById('range').disabled=true;
      document.getElementById('myInput').disabled=true;
    }
  }

</script>

   <script type="text/javascript">


   function PlotGraph() {
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
      //var hours=24;
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
          // var hoursdiff = Math.abs(jsFromDate - jsToDate) / 36e5;
              window.location.href= 'EditValues.php?FY=' + yearFrom + "&FM=" + monthFrom + "&FD=" + dayFrom + '&TY=' + yearTo + "&TM=" + monthTo + "&TD=" + dayTo + "&PARAMS=" + params + "&hours=" + hours + "&station=" + station + "&hours2=" + hours2;
  
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
           //var hoursdiff = Math.abs(jsFromDate - jsToDate) / 36e5;
              window.location.href= 'EditValues.php?FY=' + yearFrom + "&FM=" + monthFrom + "&FD=" + dayFrom + '&TY=' + yearTo + "&TM=" + monthTo + "&TD=" + dayTo + "&PARAMS=" + params+"&station="+station+"&hours="+hours+"&hours2="+hours2;



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

          
          var hoursdiff = Math.abs(jsFromDate - jsToDate) / 36e5;
              window.location.href= 'EditValues.php?FY=' + yearFrom + "&FM=" + monthFrom + "&FD=" + dayFrom + '&TY=' + yearTo + "&TM=" + monthTo + "&TD=" + dayTo + "&PARAMS=" + params+ "&hours=" + hours + "&station=" + station +"&hours2="+ hoursdiff;
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

 .td-inline-element{
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
         window.location.href='EditDataStation.php?Sname='+stn;
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
   <script type="text/javascript">
   function emptyHours()
{
  document.getElementById('hours').value="";
}
</script>

<script type="text/javascript">
function search() {

  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");
var range=document.getElementById('range').options[document.getElementById('range').selectedIndex].value;
  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2];
    if (td) {
      if (range=="In") {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
      }
        if (range=='=') {
      if (Number(td.innerHTML) == filter) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
      }
          if (range==">") {
      if (Number(td.innerHTML) > filter) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
      }
          if (range=="<") {
      if (Number(td.innerHTML) < filter) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
      }

          if (range=="<=") {
      if (Number(td.innerHTML) <= filter) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
      }

          if (range==">=") {
      if (Number(td.innerHTML) >= filter) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
      }
    } 
  }
}
</script>


 
  <center>
   <table style="width: 100%;">
  <tr>

  <!-- Search Station-->
  
  <td style="padding-left: 3px;padding-top:10px" class="td-inline-element"> <div class="form-group"> <input placeholder="Search Station" type="text" id="Sname" name="StationName" class="form-control" onchange="getSensors()" required  value='<?php 
  if (isset($_GET['station'])) 
  {
echo $_GET['station']; 
  }


  ?>'> </div>

  </td>
 <!-- <td  class="pad"> <div class="form-group"> <input type="button" name="Search" value="Search Station" class="btn btn-sm btn-info"  onclick="GetData()" style="width: 100%"></div> </td>-->




    <td style="padding-left: 3px;padding-top:10px" class="td-inline-element"> <div class="form-group"> 
    <select  name="SensorList" id="SensorList" onchange="PlotGraph()" class="form-control" required >
 <option value="" disabled selected>Sensor</option>
 
      
    </select>

    </div>
    </td>
  
   

<!-- end Select  Sensor-->
<!--  date select-->

   
    <td style="padding-left: 3px;padding-top:10px" class="td-inline-element"> 
    <div class="form-group">
    <input placeholder="Hours" type="number" id="hours"  name="hours" class="form-control" value="<?php if(isset($_GET['hours2'])) {
  echo $_GET['hours2'];
    } ?>">

     </div>
     </td>
    <td style="padding-left: 3px;padding-top:10px" class="td-inline-element">  <label >From</label>
<?php if (isset($_GET['FY'])&&isset($_GET['FM'])&&isset($_GET['FD'])) {
    
      $da= strtotime( $_GET['FY'].'/'.$_GET['FM'].'/'.$_GET['FD']);
  
    } ?>
    <?php if (isset($_GET['TY'])&&isset($_GET['TM'])&&isset($_GET['TD'])) {
 
      $da2= strtotime( $_GET['TY'].'/'.$_GET['TM'].'/'.$_GET['TD']);
  
    } 

    ?>

    </td>
    <td class="td-inline-element"> <div class="form-group"> <input  type="date" name="EditStartDate" id="EditStartDate" class="form-control" required value="<?php if(isset($da)) { echo date('Y-m-d',$da);} ?>" onChange="emptyHours()"></div></td>
    <td style="padding-left: 3px;padding-top:10px" class="td-inline-element"><label> To</label>  </td>
    <td class="td-inline-element"> <div class="form-group"><input  type="date"  class="form-control" ID="EditEndDate" required value="<?php if(isset($da)) { echo date('Y-m-d',$da2);} ?>" onChange="emptyHours()"></div> </td>
    <td class="td-inline-element" style="padding-left: 8px">
    <div  class="form-group "><input type="button"  onclick="PlotGraph()" class="btn  btn-primary" name="btnPlot" value="Get Data"> </div>
    </td>


    </tr>


  </table>

  </center>
 


  
<div id="body2" >
    
<?php
include_once 'EditJson.php';
?>
      <div id="content" style="overflow-x:auto;">
 <table align="center" border="1" id="myTable"  class="table table-bordered table-striped">
 <!--<thead style="display: block;width: 100%">-->
  <tr>
<th><label>Fillter :</label> <input type="checkbox" id='search_check' onclick="searchEnable()" title="Enable Search!">
<select id='range' onchange="search()" disabled>
  <option value="In">In</option>
  <option value="=">=</option>
    <option value=">">></option>
      <option value="<"><</option>
        <option  value=">=">>=</option>
          <option value="<=" ><=</option>>
           
</select>

  <input type="number" id="myInput" onkeyup="search()" placeholder="Search" disabled></th>
<th></th>
  <th>


  </th>
<th></th>
<th> 
<center>
 <input type="button" class="btn btn-info" name="hideandshow" value="Save" onclick="hideshow('<?php echo str_replace("'", "",  $table);?>')">
</center>
 </th>
  </tr>

<tr >

    <th style="background-color:#539CCC;color:white;text-align:center;font-size: 13px;width: 600px">Date/Time</th>
     
   
  <th  style="background-color:#539CCC;color:white;text-align:center;font-size: 13px;width: 320px">Sensor</th>
    <th  style="background-color:#539CCC;color:white;text-align:center;font-size: 13px;width: 320px">Value</th>
     <th  style="background-color:#539CCC;color:white;text-align:center;font-size: 13px;width: 100px">Edit</th>
 <th  style="background-color:#539CCC;color:white;text-align:center;font-size: 13px;width: 100px">Hide/Show
 
       </th>
    </tr>
<!--   </thead>
   <tbody style="display: block;overflow:auto;max-height: 650px;min-height: 300px;width: 100%">-->
    <?php
 $result_table=  pg_query("SELECT * FROM \"tblAllTables\"  WHERE \"TableName\" like '%".$station."_1%' or  \"TableName\" like '%".$station."_2%' order by \"TableName\"");
    if (isset($result_table)) {
      $stn_id=  pg_query("SELECT \"StationId\" FROM \"tblStation\" where \"StationName\"='$station'");
$id_row=pg_fetch_array($stn_id);
$s_id= $id_row['StationId'];
  while ($tablerows=pg_fetch_array($result_table)) {
     $FD2=(int)$FD-1;
     if($FD2<10){
      $FD2="0".$FD2;
     }     
     $TD2=(int)$TD-1;
     if($TD2<10){
      $TD2="0".$TD2;
     }
$table="'".$tablerows['TableName']."'";

      if (!isset($_GET['hours'])) {
                   $sql_query="select ('20'||\"Year\"::text ||'-'|| \"Month\"::text ||'-'|| \"Day\" ::text ||' '|| \"Hour\"::text || ':' || \"Minute\" ::text || ':' ||\"Second\")::timestamp as t, \"HydroMetShefCode\", \"$valuecol\",\"ReadingId\",\"Flag\" from \"$table\" a, \"tblHydroMetParamsType\" b   where b.\"HydroMetParamsTypeId\" = a.\"HydroMetParamsTypeId\" and ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY,$FM,$FD2) AND ($TY,$TM,$TD2))  and a.\"HydroMetParamsTypeId\"='$PARAMS' and a.\"StationId\"= '$s_id'  order by t asc";
                 
                 }
                 else
                 {
                  $sql_query="select ('20'||\"Year\"::text ||'-'|| \"Month\"::text ||'-'|| \"Day\" ::text ||' '|| \"Hour\"::text || ':' || \"Minute\" ::text || ':' ||\"Second\")::timestamp as t,\"HydroMetShefCode\", \"$valuecol\",\"ReadingId\",\"Flag\" from \"$table\" a, \"tblHydroMetParamsType\" b where b.\"HydroMetParamsTypeId\"
  = a.\"HydroMetParamsTypeId\" and (('20'||\"Year\"::text ||'-'|| \"Month\"::text ||'-'|| \"Day\" ::text ||' '|| \"Hour\"::text || ':' || 
\"Minute\" ::text || ':' || \"Second\")::timestamp  BETWEEN ('20$FY-$FM-$FD2 $h:$m:0') AND ('20$TY-$TM-$TD2 $h2:$m2:0')) and a.\"HydroMetParamsTypeId\"='$PARAMS' and a.\"StationId\"= 
  '$s_id' order by t asc";
                 
                }
                // echo $sql_query;
                // echo "<br/>";
                $result_set= pg_query($sql_query);
?>

<?php

  if(pg_num_rows($result_set)>0)
  {


        while($row=pg_fetch_row($result_set))
    {
    ?>

            <tr>
            <td style="text-align:center;font-size: 13px;height: 14px;width: 600px"><?php echo "$row[0]"; ?></td>
                                <td style="text-align:center;font-size: 13px;height: 14px;width: 320px"><?php echo $row[1]; ?></td>
                                 

                                     

 <td style="text-align:center;font-size: 13px;height: 14px;width: 320px"><?php echo $row[2]; ?></td>

  <td  style="width: 50px;text-align:center;font-size: 13px;height: 14px;width: 100px"><a data-toggle="tooltip" title="Edit!" href="javascript:edt_id('<?php echo $row[3]; ?>','<?php echo  trim($table,"'");?>' )"><img src="b_edit.png" align="EDIT" /></a></td>
 <td style="width: 50px;text-align:center;font-size: 13px;height: 14px;width: 100px;">

<input type="checkbox" class="hideCheckbox" name="hideshow[]"  <?php if ($row[4]=="1"){ echo "checked"; }?> value="<?php echo $row[3];?>">


        </td>
            </tr>
        <?php
    }
  }
else{
  // echo "<tr><td>No Data Found! </td><tr>";
 
}

  }
}


  ?>

 <!-- </tbody>-->
    </table>
    </div>


</div>
</body>
 



<script type="text/javascript">

function edt_id(id,table)
{ 
   
// alert('<?php //echo ($_GET["PARAMS"]) ?>');

 var FY= <?php if (isset($_GET['FY'])) echo($_GET["FY"])?>;
 var FM=<?php if (isset($_GET['FM'])) echo($_GET["FM"])?>;
 var FD=<?php if (isset($_GET['FD'])) echo($_GET["FD"])?>;
 var TY=<?php if (isset($_GET['TY'])) echo($_GET["TY"])?>;
var TM= <?php if (isset($_GET['TM'])) echo($_GET["TM"])?>;
var TD=<?php if  (isset($_GET['TD'])) echo($_GET["TD"])?>;  
  var hours2=<?php if (isset($_GET['hours2'])) echo($_GET["hours2"]); else echo 0;?>;   
  if (hours2==0) {
  window.location.href='edit_station_data.php?edit_id='+id+"&tablename=" + table+"&FY="+FY+ "&FM="+FM+"&FD="+FD+"&TY="+TY+"&TM="+TM+"&TD="+TD+"&PARAMS=<?php echo ($_GET['PARAMS']) ?>"+"&Station=<?php echo ($_GET['station'])?>&hours2="+hours2; 
  }
   else
   {
     window.location.href='edit_station_data.php?edit_id='+id+"&tablename=" + table+"&FY="+FY+ "&FM="+FM+"&FD="+FD+"&TY="+TY+"&TM="+TM+"&TD="+TD+"&PARAMS=<?php echo ($_GET['PARAMS']) ?>"+"&Station=<?php echo ($_GET['station']) ?>&hours2="+hours2; 
   }
}
 function hideshow(table)
{
 var FY= <?php if (isset($_GET['FY'])) echo($_GET["FY"])?>;
 var FM=<?php if (isset($_GET['FM'])) echo($_GET["FM"])?>;
 var FD=<?php if (isset($_GET['FD'])) echo($_GET["FD"])?>;
 var TY=<?php if (isset($_GET['TY'])) echo($_GET["TY"])?>;
var TM= <?php if (isset($_GET['TM'])) echo($_GET["TM"])?>;
var TD=<?php if  (isset($_GET['TD'])) echo($_GET["TD"])?>;
<?php if(isset($_GET['hours2'])) echo 'var hours2='.$_GET["hours2"].";"; else echo 'var hours2='."'';"; ?>;
<?php if(isset($_GET['hours'])) echo 'var hours='.$_GET["hours"].";";  else  echo 'var hours2='."'';"; ?>;
var checkedValue=''; 
var uncheckedValue='';
var inputElements = document.getElementsByClassName('hideCheckbox');
for(var i=0; inputElements[i]; ++i){
      if(inputElements[i].checked){
           checkedValue+= inputElements[i].value+"_";
      }
      else
      {
        uncheckedValue+=inputElements[i].value+"_";
      }
}

//alert(checkedValue);
//alert(uncheckedValue);

// window.location.href='EditValues.php?FY='+FY+ "&FM="+FM+"&FD="+FD+"&TY="+TY+"&TM="+TM+"&TD="+TD+"&PARAMS=<?php //echo ($_GET['PARAMS'])?>"+"&station=<?php //echo ($_GET['station']) ?>&show="+uncheckedValue+"&hide="+checkedValue+"&tablename="+table;
  var url ='';
if (hours2!=""&&hours!="") {
   url = 'EditValues.php?FY='+FY+ "&FM="+FM+"&FD="+FD+"&TY="+TY+"&TM="+TM+"&TD="+TD+"&PARAMS=<?php echo ($_GET['PARAMS']) ?>"+"&station=<?php echo ($_GET['station']) ?>&tablename="+table+"&hours2="+hours2+"&hours="+hours;
}
else
{
   url = 'EditValues.php?FY='+FY+ "&FM="+FM+"&FD="+FD+"&TY="+TY+"&TM="+TM+"&TD="+TD+"&PARAMS=<?php echo ($_GET['PARAMS']) ?>"+"&station=<?php echo ($_GET['station']) ?>&tablename="+table+"&hours2="+hours2+"&hours="+hours;
}
//&show="+uncheckedValue+"&hide="+checkedValue
var form = $('<form action="' + url + '" method="post">' +
  '<input type="hidden" name="show" value="' + uncheckedValue + '" />' +
   '<input type="hidden" name="hide" value="' + checkedValue + '" />' +
  '</form>');
$('body').append(form);
form.submit();
}
function hide(id,table)
{


 /*$( function() {
    $( "#dialog-confirm" ).dialog({
      resizable: false,
      height: "auto",
      width: 400,
      modal: true,
      buttons: {
        "Delete": function() {
  window.location.href='Graph.php?FY='+FY+ "&FM="+FM+"&FD="+FD+"&TY="+TY+"&TM="+TM+"&TD="+TD+"&PARAMS=<?php //echo ($_GET['PARAMS']) ?>"+"&station=<?php //echo ($_GET['station']) ?>&delete_id="+id+"&tablename="+table;        },
        Cancel: function() {
          $( this ).dialog( "close" );
        }
      }
    });
  } );*/

 // window.location.href='EditValues.php?FY='+FY+ "&FM="+FM+"&FD="+FD+"&TY="+TY+"&TM="+TM+"&TD="+TD+"&PARAMS=<?php //echo ($_GET['PARAMS']) ?>"+"&station=<?php //echo ($_GET['station']) ?>&hide="+id+"&tablename="+table;
  
}
getSensors();

</script>
