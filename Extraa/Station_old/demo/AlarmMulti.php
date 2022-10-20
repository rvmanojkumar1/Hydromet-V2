	<?php
								include("includes/link.php");
							?>

							<?php
								include("includes/adminheader.php");
							?>

<?php
include_once 'database.php';
$AlarmType="";
$AlarmName="";
if(isset($_GET['AlarmType']))
  //if AlarmType is set
{
    $AlarmType=$_GET['AlarmType'];
    $AlarmName=$_GET['alarm_name'];
   // $_SESSION["AlarmType"]=$AlarmType;
}

?>
<!DOCTYPE html>
    <title>jQuery Wizard ByGiro Plugin demo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="">

  
<link rel="stylesheet" href="js/jquery-ui.css">

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery-ui.js"></script> 

    <script src="js/bootstrap.min.js"></script>
    <script src="../dist/jquery.wizard3.js"></script>


    <link href="../dist/jquery.wizard.css" rel="stylesheet">

    <script type="text/javascript">
$(function() 
{
 $( "#stn_id" ).autocomplete({

  source: 'autocompelete.php'
 });
});
</script>

    <style type="text/css">
     
      .sidebar-nav {
        padding: 9px 0;
      }

      [data-wizard-init] {
        margin: auto;
        width: 90%;
      }
      td{
        padding: 5px;
      }
      th
      {
       background-color:#539CCC;
       color:white;
      }
    </style>
<script type="text/javascript">
function getSensors()
{

var stn=document.getElementById('stn_id').value;

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
  //we call the sensor list by id "Sensor List"
  e.innerHTML="";
   var x = document.createElement("OPTION");
   //we call the data into variable x by creating the element "OPTION"
    x.setAttribute("value", "");
    //attribute x value is set to NUll
    var t = document.createTextNode("Please Select Sensors");
    //Text note is created 
    x.appendChild(t);
    x.disabled=true;
    x.selected=true;
    e.appendChild(x);

for (var i = 0; i < list.length; i++) {


    var x = document.createElement("OPTION");
    //we call the data into variable x by creating the element "OPTION"
    x.setAttribute("value", list[i]);
     //attribute x value is set to list[i]
    var t = document.createTextNode(list[i]);
//Text node is created from the list[i]
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
  //we call the data from the file getsensorsforgraph.php by sending the input station
  xhttp2.send();
}
</script>
<body>
<br>
<br>
<div class="panel panel-primary" style="width:90%;margin: 0 auto;"  >
         <div class="panel-heading" style="background-color:#4A7BDF;color:white"><center><b style="font-size:15px;font-family: arial">Add Alarm</b></center></div>
  <div class="panel-body">
    <div class="container-fluid">
        <div data-wizard-init>
          <ul class="steps">
            <li data-step="1">Step 1</li>
            <li data-step="2" class="active">Step 2</li>
            
            <li data-step="3">Step 3</li>
        
            
          </ul>
          </div>
      
            <form action='alarmusers.php' method="post" name="form1">
                     
<?php
$result_set=pg_query("select \"description\",\"range\",\"AlarmEmail\",\"RangeTo\" from \"tblAlarm2Sensor\" where \"AlarmType\"='$AlarmType' and \"AlarmName\"='$AlarmName'");
// A query to select description, Range, AlarmEmail, RangeTo from the table "tblAlaram2Sensor"
$row=pg_fetch_array($result_set);
////the variable $result_set is fetched into array

?>
              <br>
                       <center> 
                        <table style="width: 100%;">
                             <tr>
                             <td>
                               <label><b> Station</b></label>
                             </td>
                             <td>
                               <input onchange="getSensors()"   name="SearchStation"   id="stn_id"  type="text" placeholder="Type Station Name" class="form-control" />  
                             </td>
                        <td>
                    <label><b> Select Sensors</b></label>

                         </td>
                     
                        
                        <td>
                        <select name="Sensors" id="SensorList"  class="form-control">
   
    </select>
                        </td>
                         
              <td >
                    <label><b>Range from</b></label>

                         </td>
                     
                        
                        <td>
              <input type="date"  name="range" placeholder="Range" value="<?php echo $row[1]; ?>"   class="form-control">
                        </td>
<td >
                    <label><b>Range to</b></label>

                         </td>
                     
                        
                        <td>
                           <input type="date" name="rangeTo" value="<?php echo $row[3];?>"   class="form-control">
                         </td>
             
                               </tr>

                       <tr>  
         <td>
                       <label> <b>Select type</b></label>

                        </td>
                      <td>
                        <select class="form-control"  id='Option'  name="type">
                        <option value="" disabled selected>Please select type</option>
                          <option value="Threshold_Value">Threshold Value</option>
                          <option value="Rate_of_Change">Rate of Change</option>
                        </select>
            </td>
    <td><label class="Threshold_c"><b>Change</b></label></td>
                                                
                                                       <td>
                     <input type="text" class="Threshold_c form-control" step="any" style="height: 30px" ID="set_change" name="set_change" placeholder="eg.<,>,<= etc"   />
                                                      </td>
                                                      <td>
                                                         <label class="Threshold_c"><b>Value </b></label>
                                                      </td>
                                                        <td>
                     <input type="number" class="Threshold_c form-control" step="any" style="height: 30px" ID="Threshold" name="Threshold"  placeholder="Value" />
                                                      </td>
                                                         <td>
                                                      <label id="time_label"><b>Span min</b></label>
                                                   </td>
                                                        <td>
                     <input type="number" step="any" style="height: 30px" name="Time" id="Time" class="form-control"    placeholder="Span min"/>
                                                      </td>
                                                   
                                                       <td>
                                                        <button class="btn btn-primary" type="button" id="addRow">add</button>
                                                      </td>
                                               </tr>

                                             
                                           </table>


 
    <table id="data_table" class="table table-responsive">
    <thead>
    <tr>
      <th>Station</th>
            <th> Sensors</th>

      <th>type</th>
      <th>Change</th>
      <th>Value</th>
      <th>Span min</th>
            <th>Remove</th>

      </tr>
</thead>
    </table>

    <table style="width: 100%"> 
   <!--  <tr>
                                                  <td style="width: 200px">
                      <label><b> Description</b></label>

                         </td>
                     
                        
                        <td>
              <textarea name="description" placeholder="Description" required   class="form-control"> <?php //echo $row[0]; ?></textarea>
                        </td>
                         
                                               </tr>-->
                                                <tr>
                                                 <td style="width: 100px">
                                                  <label id="alarm_email"><b>Message</b></label>
                                                 </td>
                                                   <td>
                                                   <textarea style="width: 100%" id="alarm" name="alarm" class="form-control" required><?php if(isset($row[2])) echo $row[2]; ?></textarea>
                                                 </td>
                                                  
                                               </tr></table>

                     <input type="hidden" value="<?php echo $AlarmType; ?>" name="AlarmType">
                      <input type="hidden" value="<?php echo $AlarmName; ?>" name="alarm_name">

    <table style="width: 100%;">
        <tr>
        <td>
        <center>
            
    
             <input onclick=" window.history.back();" name="btnNext"  type="button" class="btn btn-default"  value="Previous">
              <button type="submit" name="btnNext"  class="btn btn-success">Next</button>
               <a href="../../alarm.php" class="btn btn-danger">Cancel </a>
         </center>
        </td>
        </tr>
    </table>
</form>
</div>
</div>
</div>
<div>
<script type="text/javascript">
    function pre()
    {
         //window.location.href='NewAlarmStep1.php';
         window.histry.back();
    }
    function finish()
    {
		document.form1.submit();
       // window.location.href='NewAlarmStep3.php'
        
    }
   function deleteRow(r) 
   {
    var i = r.parentNode.parentNode.rowIndex;
    document.getElementById("data_table").deleteRow(i);
     }

</script>
 
  <script>
var rowIndex=0;
  $(document).ready(function() {
    $(".Threshold_c").attr("disabled",true);
                 $("#Time").attr("disabled",true);

      $("#Option").change(function(){

      var type=  $("#Option option:selected").val(); 
      //type is the option selected
      if (type.trim()=="Threshold_Value") {
              // $("#Time").attr("required",false);

            $("#Time").attr("disabled",true);
    $(".Threshold_c").attr("disabled",false);



     }
      else{

            //$("#Time").attr("required",true);

     $("#Time").attr("disabled",false);
    $(".Threshold_c").attr("disabled",false);

 }
      
      } );

$("#addRow").click(function(){
var stn=$("#stn_id").val();
//stn is the station id
var sen=$("#SensorList option:selected").val();/
//sen is sensor selected from the sensor list
var type=$("#Option option:selected").val();
//type is the option selected
var change=$("#set_change").val();
//change is the change value inserted
var value=$("#Threshold").val();
//the limit is Threshold value
var time=$("#Time").val();
//time is save to time
var Deadband=$("#Deadband").val();
var isValid=false;
 var regex = /^[-+()><=]*$/;
isValid=regex.test(change);
//if anything is null the following meeage popups
if (stn.trim()=="") 
{
alert("Please Enter Station Name!");
}
else if(sen.trim()=="")
{
alert("Please Select sensor!");

}
else if(type.trim()=="")
{
alert("Please Select type!");

}
else if(change.trim()=="")
{
  alert("Please Enter change");

}
else if(change.trim()!="" && !isValid)
{
  alert("Please enter correct change");

}
else if(value.trim()=="")
{
  alert("Please Enter value!");

}

else
{
  var tr="<tr><td>"+stn+"</td><td>"+sen+"</td><td>"+type+"</td><td>"+change+"</td><td>"+value+"</td><td>"+time+"<input type='hidden' name='stations[]' value='"+stn+"' /><input type='hidden' name='sensorslist[]' value='"+sen+"' /><input type='hidden' name='types[]' value='"+type+"' /><input type='hidden' name='change[]' value='"+change+"' /><input type='hidden' name='value[]' value='"+value+"' /><input type='hidden' name='times[]' value='"+time+"' /> <td>  <a data-toggle='tooltip' title='Delete!' onclick='deleteRow(this)'><img src='b_drop.png' align='DELETE' /></a></td></tr>";


document.getElementById("data_table").innerHTML+=tr;

$("#set_change").val("");
$("#Threshold").val("");
$("#Time").val("");
}
});

    });
</script>

<?php

$result_set=pg_query("select \"Station_Full_Name\",\"SensorName\",\"Value\",\"change\",\"Type\",\"Time\",\"Deadband\" from \"tblAlarm2Sensor\" where \"AlarmType\"='$AlarmType' and \"AlarmName\"='$AlarmName'");
//query to select Station_Full_Name, SensorName, Value, Change, Type, Time, Deadband frolm table "tblAlarm2Senor"
while($row=pg_fetch_array($result_set))
  //while the $result_set is fetched into the array into the $row the loop continues
{
  ?>
  <script type="text/javascript">
 var tr="<tr><td><?php echo $row[0]; ?></td><td><?php echo $row[1]; ?></td><td><?php echo $row[4]; ?></td><td><?php echo $row[3]; ?></td><td><?php echo $row[2]; ?></td><td><?php echo $row[5]; ?><input type='hidden' name='stations[]' value='<?php echo $row[0]; ?>' /><input type='hidden' name='sensorslist[]' value='<?php echo $row[1]; ?>' /><input type='hidden' name='types[]' value='<?php echo $row[4]; ?>' /><input type='hidden' name='change[]' value='<?php echo $row[3]; ?>' /><input type='hidden' name='value[]' value='<?php echo $row[2]; ?>' /><input type='hidden' name='times[]' value='<?php echo $row[5]; ?>' /><td><a data-toggle='tooltip' title='Delete!' onclick='deleteRow(this)'><img src='b_drop.png' align='DELETE' /></a></td></tr>";
 document.getElementById("data_table").innerHTML+=tr;

 </script>
 <?php
}


?>

</body>
