	<?php
								include("includes/link.php");
							?>

							<?php
								include("includes/adminheader.php");
							?>
<?php
include_once 'database.php';


if(isset($_POST['SearchA']))
{
	$flag=0;
  $sty=trim($_POST['SearchA']);
  $_SESSION['Station_Full_Name1']=$sty;
  
   $sql_query= "select distinct \"StationType\" from \"tblStationType\"";
     $result_set=pg_query($sql_query);
     if(pg_num_rows($result_set)>0)
     {
         
      while($row_user=pg_fetch_array($result_set))
      {
		  
		    $sql_q1="select \"Station_Full_Name\" from \"" . str_replace(' ','_', $row_user['StationType']) ."\" where \"Station_Full_Name\"='$sty'";
		$resultQ1=pg_query($sql_q1);
	if(pg_num_rows($resultQ1)>0)
     {
		 $flag=1;
	 }
	  
	  }
	 }
	 if($flag==0)
	 {
		 echo "<script>alert('Selected Station does not exists!'); history.go(-1)</script>";
		 return;
	 }
 
}
if(isset($_POST['SensorE']) && isset($_POST['typeE']) )
{
  

  $Option=$_POST['typeE'];
  $_SESSION['typeE']=$Option;

  $Sensor1=$_POST['SensorE'];
  $_SESSION['SensorE']=$Sensor1;


}
if(isset($_POST['txtmin1']) && isset($_POST['ThresholdValueMax1']) && isset($_POST['ThresholdPercentageMin1']) &&  isset($_POST['ThresholdPercentageMax1']) )
{
  $txtmin=$_POST['txtmin1'];
  $_SESSION['txtmin1']=$txtmin;
  
  $ThresholdValueMax=$_POST['ThresholdValueMax1'];
  $_SESSION['ThresholdValueMax1']=$ThresholdValueMax;

  $ThresholdPercentageMin=$_POST['ThresholdPercentageMin1'];
  $_SESSION['ThresholdPercentageMin1']=$ThresholdPercentageMin;

  $ThresholdPercentageMax=$_POST['ThresholdPercentageMax1'];
  $_SESSION['ThresholdPercentageMax1']=$ThresholdPercentageMax;;
  

}
if(isset($_POST['ROIMin1']) && isset($_POST['ROIMax1']) && isset($_POST['ROIPMin1']) && isset($_POST['ROIPMax1']))
{
$_SESSION['ROIMin1']=$_POST['ROIMin1'];
$_SESSION['ROIMax1']=$_POST['ROIMax1'];
$_SESSION['ROIPMin1']=$_POST['ROIPMin1'];
$_SESSION['ROIPMax1']=$_POST['ROIPMax1'];

}
if(isset($_POST['ROITime1']))
{

  $_SESSION['ROITime1']=$_POST['ROITime1'];
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
         <div class="panel-heading" style="background-color:#4A7BDF;color:white"><center><b style="font-size:15px;font-family: arial">Edit Alarm</b></center></div>
  <div class="panel-body">
<div class="container-fluid">
        <div data-wizard-init>
          <ul class="steps">
           
            <li data-step="1"  >Step 1</li>
            <li data-step="2"  >Step 2</li>
           <li data-step="3" class="active" >Step 3</li>
        
            
          </ul>
             </div>
          </div>
          <div class="steps-content" >
           <div data-step="3">
           <form action="EditAddAlarm.php" name="user1">
              <h3 style="margin-left:  6%"> Who & How Get Alarm :</h3>
             
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

$UserQuery="SELECT \"Username\",\"Email\",\"organization\",\"officeno\",\"mobileno\",\"communicationway\" FROM \"tblloginandregister\"";
$UserData=pg_query($UserQuery);
        $st="";
              if(isset($_SESSION['AlarmType']))
  {
  $st=$_SESSION['AlarmType'];

           } 
    


        while ($getdata=pg_fetch_array($UserData)) {
         $DataUser=pg_query("select distinct \"Username\",\"communicationway\" from \"tblAlarmType2User\" where \"AlarmType\"='$st'");
        ?>
        <tr>
          <td>
          <input type="checkbox" name="users[]" value="<?php echo $getdata['Username']; ?>" 
<?php 
while ($d=pg_fetch_array($DataUser)) {

  if(isset($d['Username']))
  {
  
    if(trim($d['Username'])===trim($getdata['Username']))
    { 
      echo 'checked';
    }
  }
}

?>

          > 
            </td>
         
          <td>



          <?php echo $getdata["Username"]; ?>
              
          </td>
            <td><?php echo $getdata["Email"]; ?></td>
            <td><?php echo $getdata["organization"]; ?></td>
            <td><?php echo $getdata["officeno"]; ?></td>
            <td><?php echo $getdata["mobileno"]; ?></td>
            <td>
              <select name='<?php echo $getdata["Username"]; ?>'>
                <option value="Email"> Email </option>
                <option value="SMS">SMS</option>
                <option value="Both">Both</option>
              </select>
            </td>
        </tr>
      
        <?php
      }
    
      ?>
    </table>


         

           
            <div>
    <table style="width: 100%;">
        <tr>
        <td>
        <center>
            
    
             <input onclick="pre()" name="btnNext"  type="button" class="btn btn-default"  value="Previous">
              <input type="submit" name="btnNext"  class="btn btn-success"  value="Finish"  onclick="finish()">
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
			<script type="text/javascript">
    function pre()
    {
         window.location.href='EditAlarmStep2.php';
    }
    function finish()
    {
       document.user1.submit();
        
    }
   

</script>

</body>