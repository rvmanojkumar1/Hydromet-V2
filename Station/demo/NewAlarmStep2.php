	<?php
								include("includes/link.php");
							?>

							<?php
								include("includes/adminheader.php");
							?>

<?php
include_once 'database.php';

if(isset($_GET['alarmname']))
{
    $var1=$_GET['alarmname'];
    $_SESSION["alarmname"]=$var1;
}
if(isset($_GET['select1']))
{
    $str=$_GET['select1'];
   
$Str1=array();
    $Str1=explode("|", $str);

    $_SESSION['StationName']=$Str1[0];
   $_SESSION['stn_shefcode']=$Str1[1];

}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>jQuery Wizard ByGiro Plugin demo</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js/jquery-1.8.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="../dist/jquery.wizard3.js"></script>


    <link href="../dist/jquery.wizard.css" rel="stylesheet">
  

<script type="text/javascript">
    
</script>
    <style type="text/css">
     
      .sidebar-nav {
        padding: 9px 0;
      }

      [data-wizard-init] {
        margin: auto;
        width: 90%;
      }
    </style>
</head>
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
          <div class="steps-content">
            <div data-step="2">
            <form action='NewAlarmStep3.php' name="form1">
              <div align="center"><h4><b>Search Station </b></h4>
                     

              
                      <div class="input-group" align="center" >
                         <div class="form-inline">
                       <center>  <table style="margin: 0 auto;">
                             <tr>
                             <td>
                               <input  style="width: 300px;" name="SearchStation1"  required="" id="SearchStation" value='<?php if(isset($_GET['select1'])){
                                 $str=$_GET['select1'];  $Str1=explode("|", $str);echo $Str1[0];
                                } ?>' type="textbox" placeholder="Type Station Name" class="form-control" />  
                             </td>
                            
                                 <td style="padding: 5px">
                                <input  class="btn  btn-primary" type="button"  value="Search" id="addressSearch"   onclick="SendStation()" />
                                 </td>
                             </tr>
                         </table>
                           </center>
                                </div>
                               
                         </div>
                         </div>
                      
                       

                    <!-- select Sensors-->
                    
                        
                   
                    <div align="center">
                    <table>
                      <tr>
                        <td>
                        <div class="form-group">
                       <center>    <label><b> Select Sensors</b></label></center> 
                        </div>

                         </td>
                      </tr>
                      <tr>
                        
                        <td>
                        <div class="form-group">
                        <select name="Sensor1" style="width: 300px;" required="" class="form-control">
                           <option value="" disabled selected>Please Select Sensors</option>
     <?php 
       //$sql_query1="select \"Sensor\",\"ID\" from \"SensorValues\"";
	   	          $sql_query1="select \"SensorName\" from \"tblHydrometSensor\"";

  $result_set1=pg_query($sql_query1);
  if(pg_num_rows($result_set1)>0)
  {
        while($row=pg_fetch_row($result_set1))
    {

?>

<option value='<?php echo $row[0]?>'> <?php echo $row[0]?> </option>
<?php

    }
}
    ?>
    </select>
  </div>
                        </td>
                      </tr>
                      </table>
                      </div>
                         <!-- end select Sensors-->
                    <!--SELECT TYPE-->
                    <div align="center">
                        <table>
                            <tr>
                        <td>
                          <div class="form-group">
                       <center>  <label> <b>Select type</b></label></center> 

                        </td>
                      </tr>
                      <tr>
                      <td>
                      <div class="form-group">
                        <select class="form-control" style="width: 300px;" id='Option' required="" name="type">
                        <option value="1" disabled selected>Please select type</option>
                          <option value="Threshold_Value">Threshold Value</option>
                          <option value="Rate_of_Change">Rate of Change</option>
                        </select>
                      </div>
					  </td>
                      </tr>
                      
                        </table>
                    </div>
					</div>
                    <!--ENDSELECT TYPE-->
                    <!-- Threshold value-->
                      <div id="tblthreshold" class="tblthreshold box">

                                                 <table style="width: 100%;" >
                                               <tr>
                                                   <td colspan="6">
                                                  <center>
                                                         <label style="margin: 0 auto;"><b>Set Threshold Values</b></label>
                                                   
                                                   </center>
                                                   </td>
                                               </tr>
                                               <tr>
                                                     <td> <label style="font-size:medium; font-weight:300 ;">Threshold Value (Min)</label> </td>
                                                <td> <label style="font-size:medium; font-weight:300 ;">Threshold Value (Max) </label></td>
                                                <td><label style="font-size:medium; font-weight:300 ;">Threshold Percentage (Min) </label></td>
                                                <td><label style="font-size:medium; font-weight:300 ;"> Threshold Percentage (Max)</label></td>
                                         
                                               </tr>
                                               <tr>
                                                 <td>
                                                          <div class="form-group">
                     <input type="number" step="any" style="height: 30px" name="txtmin" ID="T1" class="form-control"   oninvalid="this.setCustomValidity('Please Enter Value!')" oninput="setCustomValidity('')" placeholder="Threshold Value (Min)"/>
                </div>
                                                      </td>
                                                      <td>
                                                          <div class="form-group" style="">
                     <input type="number" step="any" style="height: 30px" name="ThresholdValueMax" ID="T2" class="form-control"  oninvalid="this.setCustomValidity('Please Enter Value!')" oninput="setCustomValidity('')" placeholder="Threshold Value (Max)"/>
                </div>
                                                      </td>
                                                       <td>
                                                          <div class="form-group">
                     <input type="number" step="any" style="height: 30px" ID="T3" name="ThresholdPercentageMin" class="form-control"   oninvalid="this.setCustomValidity('Please Enter Value!')" oninput="setCustomValidity('')" placeholder="Threshold Percentage "/>
                </div>
                                                      </td>
                                                        <td>
                                                          <div class="form-group" style="">
                     <input type="number" step="any" style="height: 30px" ID="T4" name="ThresholdPercentageMax" class="form-control"  oninvalid="this.setCustomValidity('Please Enter Value!')" oninput="setCustomValidity('')" placeholder="Threshold Percentage (Max)"/>
                </div>
                                                      </td>
                                                    
                                               </tr>
                                           </table>
 </div>
                     <!--end  Threshold value-->
                      <!--Rate Of Change-->

                    <div id="tblRate" class="tblRate box"  >
                      <table  style="width: 100%; align-content: center;">
                                                    <tr>
                                                        <td colspan="6">
                                                        <center>
                                                            <label><b>Set Rate of Changes</b></label></center>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                       <td> <label style="font-size:medium; font-weight:300 ;">Threshold Value (Min)</label> </td>
                                                <td> <label style="font-size:medium; font-weight:300 ;">Threshold Value (Max) </label></td> 
                                                <td><label style="font-size:medium; font-weight:300 ; padding:5%;">Threshold Percentage (Min) </label></td>
                                                <td><label style="font-size:medium; font-weight:300 ; padding: 5%;"> Threshold Percentage (Max)</label></td>
                                                <td><label style="font-size:medium; font-weight:300 ;">Time (Minute) </label></td>
                                                    </tr>
                                                    <tr>
                                                      <td>
                                                          <div class="form-group">
                     <input type="number" step="any" style="height: 30px" name="ROIMin" id="D1" class="form-control"   oninvalid="this.setCustomValidity('Please Enter Value!')" oninput="setCustomValidity('')" placeholder="Threshold Value (Min)"/>
                </div>
                                                      </td>
                                                      <td>
                                                          <div class="form-group" style="">
                     <input type="number" step="any" style="height: 30px" name="ROIMax" id="D2" class="form-control"   oninvalid="this.setCustomValidity('Please Enter Value!')" oninput="setCustomValidity('')" placeholder="Threshold Value (Max)"/>
                </div>
                                                      </td>
                                                       <td>
                                                          <div class="form-group">
                     <input type="number" step="any" style="height: 30px" name="ROIPMin" id="D3" class="form-control"   oninvalid="this.setCustomValidity('Please Enter Value!')" oninput="setCustomValidity('')" placeholder="Threshold Percentage "/>
                </div>
                                                      </td>
                                                        <td>
                                                          <div class="form-group" style="">
                     <input type="number" step="any" style="height: 30px" name="ROIPMax" id="D4" class="form-control"   oninvalid="this.setCustomValidity('Please Enter Value!')" oninput="setCustomValidity('')" placeholder="Threshold Percentage (Max)"/>
                </div>
                                                      </td>
                                                      
                                                        <td>
                                                          <div class="form-group">
                     <input type="number" step="any" style="height: 30px" name="ROITime" id="D5" class="form-control"   oninvalid="this.setCustomValidity('Please Enter Value!')" oninput="setCustomValidity('')" placeholder="Time in Minute"/>
                </div>
                                                      </td>

                                                    </tr>

                                                </table>
                                                </div>
                     <!-- End Rate Of Change-->
             
 
<div>
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
</div>
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
    function SendStation()
    {
        var stn = document.getElementById("SearchStation").value; 
         window.location.href='GetData.php?SearchStation1='+stn;

    }

</script>
  <script>$(document).ready(function() {
        $("select").change(function() {
            $(this).find("option:selected").each(function() {
                if ($(this).attr("value") == "Rate_of_Change") {
                    $(".box").not(".tblRate").hide();
                     $("#D1").attr('required', true);
                     $("#D2").attr('required', true);
                     $("#D3").attr('required', true);
                     $("#D4").attr('required', true);
                     $("#D5").attr('required', true);

                    $(".tblRate").show();
                    $(".box").not(".tblRate").val("");
                } 

                else if ($(this).attr("value") == "Threshold_Value") {
                    $(".box").not(".tblthreshold").hide();
                    $("#T1").attr('required', true);
                     $("#T2").attr('required', true);
                     $("#T3").attr('required', true);
                     $("#T4").attr('required', true);
                     $(".tblthreshold").show();
                    $(".box").not(".tblthreshold").val("");
                }

                else {
                    $(".box").hide();
                }
            });
        }).change();
    });
</script>

</body>
</html>
