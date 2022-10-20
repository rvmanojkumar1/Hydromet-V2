	
	
	

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
<script type="text/javascript" src="js/jqueryui.js"></script> 

    <script src="js/bootstrap.min.js"></script>
    <script src="../dist/jquery.wizard3.js"></script>


    <link href="../dist/jquery.wizard.css" rel="stylesheet">
          <?php 
$result_set=pg_query("select \"Station_Full_Name\",\"SensorName\",\"Value\",\"change\",\"description\",\"range\",\"Type\",\"Time\",\"AlarmEmail\",\"Deadband\",\"RangeTo\" from \"tblAlarm2Sensor\" where \"AlarmType\"='$AlarmType' and \"AlarmName\"='$AlarmName'");
//query to select Station_Full_Name, SensorName, Value, Change, Type, Time, Deadband frolm table "tblAlarm2Senor"
$rows=pg_fetch_array($result_set);
//while the $result_set is fetched into the array into the $row the loop continues

                   ?> 

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
    </style>
<script type="text/javascript">
function setrangeoptional(){
  if(document.getElementById("setrangeid").checked){
    document.getElementById("datepicker-13").disabled =false;
  document.getElementById("datepicker-14").disabled =false;
  }
  else{
    document.getElementById("datepicker-13").disabled =true;
  document.getElementById("datepicker-14").disabled =true;
  }
}
function getSensors()
{
var stn=document.getElementById('stn_id').value;

var selected_sensor=<?php if (isset($rows[1])){ echo json_encode(trim($rows[1]));}else { echo json_encode(""); } ?>;
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
    var t = document.createTextNode("Sensor");
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
                   
          

              <br>
                       <center> 
                        <table style="width: 100%;">
                             <tr>
                             <td>
                              <label><b> Station</b></label>
                             </td>
                             <td>
                               <input onchange="getSensors()"   name="SearchStation"  required="" id="stn_id"  type="text" placeholder="Type Station Name" class="form-control" value="<?php echo $rows[0];?>" />  
                             </td>
                        <td>
                       <label><b> Select Sensors</b></label>

                         </td>
                     
                        
                        <td>
                        <select name="Sensors" id="SensorList" required="" class="form-control">
                           <option value="" disabled selected>Please Select Sensors</option>
   
    </select>
                        </td>
                                                <td> 
                                                  <input type="checkbox" id="setrangeid" name="checkboxforrange" value="0" onchange="setrangeoptional()"><b>Range From</b>
                                                </td>
                        <td>
						
              <input type="text"   name="range" disabled id = "datepicker-13" value="<?php echo $rows[5];?>" class="form-control">
             
			  </td>
                         
                  <td> <label><b> Range to</b></label></td>

                        <td>
              <input type="text" name="rangeTo" disabled id = "datepicker-14" value="<?php echo $rows['RangeTo'];?>" class="form-control">
                    
					   </td>
                            </tr>

                       <tr>  
                        <td>

                       <label> <b>Select type</b></label>

                        </td>
                      <td>
                        <select class="form-control"  id='Option'  name="type" required="">
                        <option value="" disabled selected>Please select type</option>
                          <option value="Threshold_Value" <?php if(trim($rows[6])=="Threshold_Value") echo "selected"; ?> >Threshold Value</option>
                          <option value="Rate_of_Change" <?php if(trim($rows[6])=="Rate_of_Change") echo "selected"; ?>>Rate of Change</option>
                        </select>
					  </td>
                            

                                               <td><label class="Threshold_c"><b>Condition</b></label></td>
                                                
                                                       <td>
                     <input type="text" class="Threshold_c form-control" step="any" style="height: 30px" ID="set_change" name="set_change" pattern="[-+()><=]*$"     oninvalid="this.setCustomValidity('Please Enter valid Change!')" oninput="setCustomValidity('')" placeholder="eg.<,>,<= etc" value="<?php if(isset($rows[3])) echo $rows[3]; ?>" required />
                                                      </td>
                                                      <td>
                                                         <label class="Threshold_c"><b>Value</b></label>
                                                      </td>
                                                        <td>
                     <input type="number" class="Threshold_c form-control" step="any" style="height: 30px" ID="Threshold" name="Threshold"   oninvalid="this.setCustomValidity('Please Enter Value!')" oninput="setCustomValidity('')" placeholder="Value"  value="<?php if(isset($rows[2])) echo $rows[2]; ?>" required/>
                                                      </td>
                                                          <td>                       <label><b>Deadband</b></label>
</td>
                             <td>
   <input type="number" id="deadband" step="any" name="deadband" placeholder="Deadband"  value="<?php echo trim($rows[9]);?>"  class="form-control">
                         </td>
                                                     
                                               </tr>
                                               <tr>
                                                  <td>
                                                      <label id="time_label"><b>Span min</b></label>
                                                   </td>
                                                        <td>
                     <input type="number" step="any" style="height: 30px" name="Time" id="Time" class="form-control"   oninvalid="this.setCustomValidity('Please Enter Span min!')" oninput="setCustomValidity('')" placeholder="Span min"  value="<?php if(isset($rows[7])) echo $rows[7]; ?>"/>
                                                      </td>
                                                 <td>
                                                  <label id="alarm_email"><b>Message</b></label>
                                                 </td>
                                                   <td colspan="5">
                                                   <textarea style="width: 100%" id="alarm" name="alarm" class="form-control" required><?php if(isset($rows[8])) echo $rows[8]; ?></textarea>
                                                 </td>
                                           <!--       <td>
                     <label><b> Description</b></label>

                         </td>
                     
                        
                        <td colspan="3">
              <textarea  placeholder="Description"  name="description" required="" class="form-control"> <?php //echo $rows[4];?></textarea>
                        </td>-->
                                               </tr>
                                           </table>
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
   

</script>
 
  <script>$(document).ready(function() {
    $(".Threshold_c").attr("disabled",true);
                 $("#Time").attr("disabled",true);
$("#deadband").attr("disabled",true);
      $("#Option").change(function(){

      var type=  $("#Option option:selected").val();
      if (type.trim()=="Threshold_Value") {
     $("#Time").attr("required",false);
  $("#deadband").attr("required",true);
            $("#Time").attr("disabled",true);
    $(".Threshold_c").attr("disabled",false);
    $("#deadband").attr("disabled",false);

     }
      else{
    $("#Time").attr("required",true);
    $("#deadband").attr("required",false);

$("#deadband").attr("disabled",true);

     $("#Time").attr("disabled",false);
    $(".Threshold_c").attr("disabled",false);
 }
      
      } );
      getSensors();


      var type=  $("#Option option:selected").val();

      if (type.trim()=="Threshold_Value") {
     $("#Time").attr("required",false);

            $("#Time").attr("disabled",true);
    $(".Threshold_c").attr("disabled",false);
     $("#Time").attr("required",false);
  $("#deadband").attr("required",true);
  $("#deadband").attr("disabled",false);
     }
      if(type.trim()=="Rate_of_Change"){
    $("#Time").attr("required",true);

     $("#Time").attr("disabled",false);
    $(".Threshold_c").attr("disabled",false);
      $("#deadband").attr("required",false);

$("#deadband").attr("disabled",true);
 }


    });
</script>
 <script>
        $(function() {
            $( "#datepicker-13" ).datepicker({changeYear: false, dateFormat: 'dd-MM',}).focus(function () {$(".ui-datepicker-year").hide();
            
          });
         
});
      </script>
	  <script>
        $(function() {
            $( "#datepicker-14" ).datepicker({changeYear: false, dateFormat: 'dd-MM',}).focus(function () {$(".ui-datepicker-year").hide();
            
          });
         
});
      </script>
  
</body>
