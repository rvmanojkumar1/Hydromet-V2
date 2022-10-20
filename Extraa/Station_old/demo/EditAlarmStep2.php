	<?php
								include("includes/link.php");
							?>

							<?php
								include("includes/adminheader.php");
							?>
<?php
include_once 'database.php';

  //$st="";

if(isset($_GET['select1']))
{
    $str=$_GET['select1'];
   
$Str1=array();
    $Str1=explode("|", $str);

   $_SESSION['StationName']=$Str1[0];
   $_SESSION['stn_shefcode']=$Str1[1];

}
 if(isset($_SESSION['AlarmType']))
  {
 $st=$_SESSION['AlarmType'];
 
 
}

$Result_Senser="select \"AlarmType\",\"Station_Full_Name\",\"MinVal\",\"MaxVal\",\"RateMin\",\"RateMax\",\"ID\",\"Time\",\"Type\" from \"tblAlarm2Sensor\" where \"AlarmType\"='$st' ";
$Sensors1=pg_query($Result_Senser);
$SensorArray=pg_fetch_array($Sensors1);
$ss= $SensorArray['ID'];
$_SESSION['ID']=$SensorArray['ID'];



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
  


    <style type="text/css">
     
      .sidebar-nav {
        padding: 9px 0;
      }

      [data-wizard-init] {
        margin: auto;
        width: 90%;
      }

      *{
        font-family: arial;
      }
    </style>
</head>
<body>
<br><br>
<div class="panel panel-primary" style="width:90%;margin: 0 auto;"  >
         <div class="panel-heading" style="background-color:#4A7BDF;color:white"><center><b style="font-size:15px;font-family: arial">Edit Alarm</b></center></div>
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
            <form action='EditAlarmStep3.php' name="EditForm" method="POST">
              <div align="center"><h4><b>Search Station</b> </h4>
                      
              
                      <div class="input-group">
                         <div class="form-inline ">
                                        <center>        <table style="margin: 0 auto;">
                             <tr>
                             <td>
                               <input  name="SearchA"  id="Search1" required  value=' 
                               <?php 
                               if(isset($_GET['select1']))
                               {
                                 $str1=trim($_GET['select1']);                                 
                                 $Str11=array();
                                $Str11=explode("|", $str1);

                           
                             echo $Str11[0];
                                }                         

                              else
                              {
                                if(isset($_SESSION['AlarmType']))
  {
 $st=trim($_SESSION['AlarmType']);
   $s= "select \"Station_Full_Name\" from \"tblAlarm2Sensor\" where \"AlarmType\"='$st' ";
 $result=pg_query($s);
 $s1=pg_fetch_array($result);

 echo trim($s1['Station_Full_Name']);
}
                              
                          }
                                ?>' type="textbox" placeholder="Type Station Name" class="form-control" style="width: 300px"/>  
                             </td>
                            
                                 <td style="padding: 5px">
                                <input  class="btn  btn-primary" type="button"  value="Search" id="addressSearch"   onclick="SendStation()" />
                                 </td>
                             </tr>
                         </table></center>

                           
                              </div>
 
                               
                         </div>
                         </div>
                      
                       

                    <!-- select Sensors-->
                    
                        
                   
                    <div align="center">
                    <table>
                      <tr>
                        <td>
                        <div class="form-group">
                         <center> <label><b> Select Sensors</b></label></center>
                        </div>

                         </td>
                      </tr>
                      <tr>
                        
                        <td>
                        <div class="form-group">
                        <?php 

$ds_sensor="select \"SensorName\" from \"tblHydrometSensor\" where \"Id\"='$ss' ";
$ds_sensorResult=pg_query($ds_sensor);
$dsSensor=pg_fetch_array($ds_sensorResult);
$selected_sensor="";
 if(isset($_SESSION['AlarmType']))
  {
 $st=trim($_SESSION['AlarmType']);
 $temp=pg_query("select \"SensorName\" from \"tblAlarm2Sensor\" where \"AlarmType\"='$st'");
$selected_sensor=pg_fetch_array($temp);
  }


                       ?>
                        <select style="width: 300px" name="SensorE" class="form-control" required>
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

<option value='<?php echo $row[0]?>' <?php if (trim($selected_sensor[0])===trim($row[0])) {
  
  echo 'selected';}?> > <?php echo $row[0]?>  </option>
<?php

    }
}
    ?>
    </select>
   
  </div>                       </td>
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
                         <center> <label><b> Select type</b></label></center>

                        </td>
                      </tr>
                      <tr>
                      <td>
                      <div class="form-group">
                        <select class="form-control" style="width: 300px" id='Option' name="typeE" required>
                        <option value="1" disabled selected>Select your Option</option>
                          <option value="Threshold_Value" <?php if (str_replace('_', ' ',$SensorArray['Type'])==='Threshold Value') {
                        
                          echo 'selected';  } ?>>Threshold Value</option>
                          <option value="Rate_of_Change" <?php if (str_replace('_', ' ',$SensorArray['Type'])==='Rate of Change') {
                        
                          echo 'selected';  } ?>>Rate of Change</option>
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
                     <input type="number" step="any" style="height: 30px" name="txtmin1" ID="T1" value='<?php echo $SensorArray['MinVal']; ?>' class="form-control"   oninvalid="this.setCustomValidity('Please Enter Value!')" oninput="setCustomValidity('')" placeholder="Threshold Value (Min)"/>
                </div>
                                                      </td>
                                                      <td>
                                                          <div class="form-group" style="">
                     <input type="number" step="any" style="height: 30px" name="ThresholdValueMax1" ID="T2" value='<?php echo $SensorArray['MaxVal']; ?>' class="form-control"   oninvalid="this.setCustomValidity('Please Enter Value!')" oninput="setCustomValidity('')" placeholder="Threshold Value (Max)"/>
                </div>
                                                      </td>
                                                       <td>
                                                          <div class="form-group">
                     <input type="number" step="any" ID="T3" style="height: 30px" name="ThresholdPercentageMin1" value='<?php echo $SensorArray['RateMin']; ?>' class="form-control"   oninvalid="this.setCustomValidity('Please Enter Value!')" oninput="setCustomValidity('')" placeholder="Threshold Percentage "/>
                </div>
                                                      </td>
                                                        <td>
                                                          <div class="form-group" style="">
                     <input type="number" step="any" ID="T4" style="height: 30px" name="ThresholdPercentageMax1" value='<?php echo $SensorArray['RateMax']; ?>' class="form-control"   oninvalid="this.setCustomValidity('Please Enter Value!')" oninput="setCustomValidity('')" placeholder="Threshold Percentage (Max)"/>
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
                     <input type="number" step="any" style="height: 30px" name="ROIMin1" id="D1" value='<?php echo $SensorArray['MinVal']; ?>' class="form-control"   oninvalid="this.setCustomValidity('Please Enter Value!')" oninput="setCustomValidity('')" placeholder="Threshold Value (Min)"/>
                </div>
                                                      </td>
                                                      <td>
                                                          <div class="form-group" style="">
                     <input type="number" step="any" style="height: 30px" name="ROIMax1" id="D2" value='<?php echo $SensorArray['MaxVal']; ?>' class="form-control"   oninvalid="this.setCustomValidity('Please Enter Value!')" oninput="setCustomValidity('')" placeholder="Threshold Value (Max)"/>
                </div>
                                                      </td>
                                                       <td>
                                                          <div class="form-group">
                     <input type="number" step="any" style="height: 30px" name="ROIPMin1" id="D3" value='<?php echo $SensorArray['RateMin']; ?>' class="form-control"   oninvalid="this.setCustomValidity('Please Enter Value!')" oninput="setCustomValidity('')" placeholder="Threshold Percentage "/>
                </div>
                                                      </td>
                                                        <td>
                                                          <div class="form-group" style="">
                     <input type="number" step="any" style="height: 30px" name="ROIPMax1" id="D4" value='<?php echo $SensorArray['RateMax']; ?>' class="form-control"   oninvalid="this.setCustomValidity('Please Enter Value!')" oninput="setCustomValidity('')" placeholder="Threshold Percentage (Max)"/>
                </div>
                                                      </td>
                                                      
                                                        <td>
                                                          <div class="form-group">
                     <input type="number" step="any" style="height: 30px" name="ROITime1" id="D5" value='<?php echo $SensorArray['Time']; ?>' class="form-control"   oninvalid="this.setCustomValidity('Please Enter Value!')" oninput="setCustomValidity('')" placeholder="Time in Minute"/>
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
        <input onclick="window.history.back();" name="btnNext"  type="button" class="btn btn-default"  value="Previous">     
   
            
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

<script type="text/javascript">
    function pre()
    {
         window.location.href='EditAlarmStep1.php';
    }
    function finish()
    {
		document.EditForm.submit();
       // window.location.href='EditlarmStep3.php'
        
    }
    function SendStation()
    {
        var stn = document.getElementById("Search1").value; 

         window.location.href='EditGetData.php?Search1='+stn;

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
