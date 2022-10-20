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
if(isset($_POST['AlarmType']))
{
    $AlarmType=$_POST['AlarmType'];
    $AlarmName=$_POST['alarm_name'];
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
</html>
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
            <li data-step="2">Step 2</li>
            
            <li data-step="3" class="active">Step 3</li>
        
            
          </ul>
             </div>
          
          <div class="steps-content">
           <div data-step="3">
           <form action="AddAlarm.php" method="post" name="user1">
              <h3 style="margin-left:  6%;font-family: arial"> Who & How Get Alarm :</h3>
              <?php 
$UserQuery="SELECT \"Username\",\"Email\",\"organization\",\"officeno\",\"mobileno\",\"communicationway\" FROM \"tblloginandregister\"";
$UserData=pg_query($UserQuery);


$user_list_query="select \"Username\",\"communicationway\" from 
\"tblAlarmType2User\" where \"AlarmType\"='$AlarmType' and \"AlarmName\"='$AlarmName'";

?>
 <table class="table table-hover" style="width: 90%;margin: 0 auto;">
        <tr>
            <td></td>
            <td>User Name</td>
            <td>Email</td>
            <td>Organization</td>
            <td>Office No.</td>
            <td>Mobile No.</td>
            <td>Communication Way</td>
        </tr>
        <?php
        while ($getdata=pg_fetch_array($UserData)) {
          
        $com_way="";
        ?>
        <tr>
          <td><input type="checkbox" class="checkboxes" name="users[]"

<?PHP $user_list_set= pg_query($user_list_query);
while ($row=pg_fetch_array($user_list_set)) 
{
  if (trim($getdata["Username"])==trim($row[0])) {
    echo "checked";
     $com_way=$row[1];
  }
}
?>
           value="<?php echo $getdata["Username"]; ?>"  /></td>
         
          <td>



          <?php echo $getdata["Username"]; ?>
              
          </td>
            <td><?php echo $getdata["Email"]; ?></td>
            <td><?php echo $getdata["organization"]; ?></td>
            <td><?php echo $getdata["officeno"]; ?></td>
            <td><?php echo $getdata["mobileno"]; ?></td>
            <td>
              <select name='<?php echo $getdata["Username"]; ?>'>
                <option value="Email" <?php if($com_way=="Email") echo "selected"; ?>> Email </option>
                <option value="SMS"  <?php if($com_way=="SMS") echo "selected"; ?>>SMS</option>
                <option value="Both"  <?php if($com_way=="Both") echo "selected"; ?>>Both</option>
              </select>
            </td>
        </tr>
        <?php
      }

   // echo  "change".$_POST['set_change'];
      ?>
    </table>
  
 <input type="hidden" value="<?php echo $AlarmType; ?>" name="AlarmType">
                      <input type="hidden" value="<?php echo $AlarmName; ?>" name="alarm_name">
           <?php if (trim($AlarmType)=="single") {
            ?>
 <input type="hidden" value="<?php echo $_POST['SearchStation']; ?>" name="SearchStation">
                      <input type="hidden" value="<?php echo $_POST['Sensors']; ?>" name="Sensors">
 <input type="hidden" value="<?php echo $_POST['type']; ?>" name="type">
 <input type="hidden" value="<?php  echo $_POST['set_change']; ?>" name="set_change">
                      <input type="hidden" value="<?php echo $_POST['Threshold']; ?>" name="Threshold">
                      <input type="hidden" value="<?php if (isset($_POST['Time'])) {
 echo $_POST['Time'];}?>" name="Time">
     <input type="hidden" value="<?php if (isset($_POST['deadband'])) {
 echo $_POST['deadband'];}?>" name="deadband">
<?php }
else
{
//echo $_POST['stations'];
?>
<input type="hidden" value="<?php echo  htmlentities(serialize($_POST['stations'])); ?>" name="SearchStation">
                      <input type="hidden" value="<?php echo  htmlentities(serialize($_POST['sensorslist'])); ?>" name="Sensors">
 <input type="hidden" value="<?php echo  htmlentities(serialize($_POST['types'])); ?>" name="type">
 <input type="hidden" value="<?php  echo  htmlentities(serialize($_POST['change'])); ?>" name="set_change">
                      <input type="hidden" value="<?php echo  htmlentities(serialize($_POST['value'])); ?>" name="Threshold">
                      <input type="hidden" value="<?php if (isset($_POST['times'])) {
 echo  htmlentities(serialize($_POST['times']));}?>" name="Time">
 

<?php

}





?>
           <!-- <input type="hidden" value="<?php //echo $_POST['description']; ?>" name="description">-->
 <input type="hidden" value="<?php echo $_POST['range']; ?>" name="range">
 <input type="hidden" value="<?php echo $_POST['rangeTo']; ?>" name="rangeTo">

            <input type="hidden" value="<?php echo $_POST['alarm']; ?>" name="alarm">
            <div>
    <table style="width: 100%;">
        <tr>
        <td>
        <center>
             
    
             <input onclick="window.history.back();"   type="button" class="btn btn-default"  value="Previous">
              <input type="submit" id="finish" disabled name="btnNext"  class="btn btn-success"  value="Finish"  onclick="finish(); warn();"/>
			  
              <a href="alarm.php" class="btn btn-danger">Cancel </a>
         </center>
        </td>
        </tr>
    </table>
    </div>
            </form>
</div>
            </div>
            </div>
			<script type="text/javascript">
           function warn(){			
			alert("Alaram created sucessfully");
	  document.write("Alaram created sucessfully");
		   }		
    function pre()
    {
         window.location.href='HydrometV2/AlarmSingle.php';
    }
   function finish()
    {
       document.user1.submit();
            }
 $(document).ready(function(){
  $(".checkboxes").change(function(){
    var ch=0;
$(".checkboxes:checked").each(function()
{
ch++;
});
if (ch!=0) {
$("#finish").attr("disabled",false);

}
else
{
  $("#finish").attr("disabled",true);

}
});


 var che=0;
$(".checkboxes:checked").each(function()
{
che++;
});
if (che!=0) {
$("#finish").attr("disabled",false);

}
else
{
  $("#finish").attr("disabled",true);

}


   });

</script>
</body>