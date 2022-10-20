<?php
include_once 'database.php';
session_start();

$result_set= pg_query("select \"logo\",\"ApplicationName\" from \"tblLogo\" where \"Id\"='101'");
//Query to select LOGO, ApplicationName from table tblLogo and is updated into variable $result_set
$row=pg_fetch_array($result_set);
//the variable $result_set is fetched into array
?>

<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title></title>
        <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
		<link rel="stylesheet" href="css/style.css" type="text/css" />
		<style>
.header {
    list-style-type: none;
    margin: 0;
    padding: 0;

 
}

li a {
    display: block;
    color: #000;
    padding: 8px 16px;
    text-decoration: none;
}

/* Change the link color on hover */
li :hover {
    
    background-color: #555;
  

}
a :hover{
      color: white;
}
li a:active{
background-color: #0000ff;
    color: white;
}


</style>
	</head>
	<body>
	
		<div class="header" >
			<div id="tophead" style="width: 100%;background-color: white;">


            <img src="<?php echo '/HydrometV2/'.$row['logo'];?>" width="70px" height="90px" style="float:left;margin:5px"  alt="logo"/>      
              <h3 style="float:left;margin:25px;color:#000;font-weight: normal;font-family: arial"><?php echo $row['ApplicationName'];?></h3> 

<p style="float:right;margin:25px;color:#000;">
<b><?php if(isset($_SESSION['username'])) {
 echo "Welcome ".$_SESSION['username'];
} ?></b><a href="/HydrometV2/Login.php" style="margin-left:5px;color:#000">Log-out</a>
<!-- Login page is included -->
</p>

            </div>
           
            <div style="width:100%;margin-top:5px" class="nav-bar">
                <ul id="menu" class="header" style="border: none;margin: 0 auto">
                    <li style="width:17%;background-color:#000;border: none" >
                        <a href="/HydrometV2/stations.php" style="text-transform: none;font-weight: normal;font-size:14px;width: 100%;color: white;"><img src="images/stationmanagement.png" width="23" height="23" /> &nbsp;&nbsp;Stations</a></li>
                    <li style="width:17%;background-color:#000;border: none">
                        <a href="/HydrometV2/sensors.php" style="text-transform: none;font-weight: normal;font-size:14px;width: 100%;color: white;">
                            <img src="images/settings.png" width="23" height="23" /> &nbsp;&nbsp;Sensor
                        </a>
                    </li>
                    <li style="width:17%;background-color:#000;border: none">
                        <a href="/HydrometV2/alarm.php" style="text-transform: none;font-weight: normal;font-size:14px;width: 100%;color: white;
                        ">
                            <img src="images/alarm.png" width="23" height="23" /> &nbsp;&nbsp;Alarm
                        </a>
                    </li>
                    <li style="width:17%;background-color:#000;border: none">
                        <a href="/HydrometV2/NewRegistration.php" style="text-transform: none;font-weight: normal;font-size:14px;width: 100%;color: white;">
                            <img src="images/usermanagement.png" width="30" height="30" /> &nbsp;&nbsp;Users
                        </a>
                    </li>
                    <li style="width:17%;background-color:#000;border: none">
                        <a href="/HydrometV2/logomanager.php" style="text-transform: none;font-weight: normal;font-size:14px;width: 100%;color: white;">
                            <img src="images/logomanager.png" width="23" height="23" /> &nbsp;&nbsp;Logo
                        </a>
                    </li>
                       <li style="width:15%;background-color:#000;border: none">
                        <a href="/HydrometV2/StationErrorLog.php" style=" width: 100%;text-transform: none;font-weight: normal;font-size:14px;color: white;">
                            <img src="images/ErrorLog.png" width="23" height="23" > &nbsp;&nbsp;ErrorLog
                        </a>
                    </li>
                </ul>
            </div>



            <br />

			
		</div> 
		
			 <hr />

                            

	
	</body>
</html>