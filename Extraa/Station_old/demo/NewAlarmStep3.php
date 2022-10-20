	<?php
								include("includes/link.php");
							?>

							<?php
								include("includes/adminheader.php");
							?>
<?php
include_once 'database.php';


if(isset($_GET['SearchStation1']) && isset($_GET['Sensor1']) && isset($_GET['type']) )
{
  $Search= trim($_GET['SearchStation1']);
  $_SESSION['SearchStation1']=$Search;
   $flag=0;
   $sql_query= "select distinct \"StationType\" from \"tblStationType\"";
     $result_set=pg_query($sql_query);
     if(pg_num_rows($result_set)>0)
     {
         
      while($row_user=pg_fetch_array($result_set))
      {
		  
		    $sql_q1="select \"Station_Full_Name\" from \"" . str_replace(' ','_', $row_user['StationType']) ."\" where \"Station_Full_Name\"='$Search'";
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
	 

  $Option=$_GET['type'];
  $_SESSION['type']=$Option;

  $Sensor1=$_GET['Sensor1'];
  $_SESSION['Sensor1']=$Sensor1;

}
if(isset($_GET['txtmin']) && isset($_GET['ThresholdValueMax']) && isset($_GET['ThresholdPercentageMin']) &&  isset($_GET['ThresholdPercentageMax']) )
{
  $txtmin=$_GET['txtmin'];
  $_SESSION['txtmin']=$txtmin;
  
  $ThresholdValueMax=$_GET['ThresholdValueMax'];
  $_SESSION['ThresholdValueMax']=$ThresholdValueMax;

  $ThresholdPercentageMin=$_GET['ThresholdPercentageMin'];
  $_SESSION['ThresholdPercentageMin']=$ThresholdPercentageMin;

  $ThresholdPercentageMax=$_GET['ThresholdPercentageMax'];
  $_SESSION['ThresholdPercentageMax']=$ThresholdPercentageMax;;
  

}
if(isset($_GET['ROIMin']) && isset($_GET['ROIMax']) && isset($_GET['ROIPMin']) && isset($_GET['ROIPMax']) && isset($_GET['ROITime']))
{
$_SESSION['ROIMin']=$_GET['ROIMin'];
$_SESSION['ROIMax']=$_GET['ROIMax'];
$_SESSION['ROIPMin']=$_GET['ROIPMin'];
$_SESSION['ROIPMax']=$_GET['ROIPMax'];
$_SESSION['ROITime']=$_GET['ROITime'];

}?>
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
           <form action="AddAlarm.php" name="user1">
              <h3 style="margin-left:  6%;font-family: arial"> Who & How Get Alarm :</h3>
              <?php 
$UserQuery="SELECT \"Username\",\"Email\",\"organization\",\"officeno\",\"mobileno\",\"communicationway\" FROM \"tblloginandregister\"";
$UserData=pg_query($UserQuery);

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
          
        
        ?>
        <tr>
          <td><input type="checkbox" name="users[]" value="<?php echo $getdata["Username"]; ?>"  /></td>
         
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
             
    
             <input onclick="window.history.back();" name="btnNext"  type="button" class="btn btn-default"  value="Previous">
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
         window.location.href='NewAlarmStep2.php';
    }
    function finish()
    {
       document.user1.submit();
        
    }
    function SendStation()
    {
        var stn = document.getElementById("SearchStation").value; 
         window.location.href='GetData.php?SearchStation1='+stn;
    }

</script>

</body>