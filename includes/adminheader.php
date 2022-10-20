<?php
include_once 'database.php';
session_start();
//session starts
$username=$_SESSION["username"];
if ($username==null||$username==''||$username=='guest') {
    echo ("<script>location.href='/HydrometV2/Login.php'</script>");
    // echo $usernamenew;
  }

$result_set= pg_query("select \"logo\",\"ApplicationName\" from \"tblLogo\" where \"Id\"='101'");
//$result_set is set by the result of the query, in t=which the logo,ApplicationName are being selected from the table "tblLogo" where Id = "101"
$row=pg_fetch_array($result_set);
//$result_set is set into the array into the variable $row
?>
<style type="text/css">
@media only screen 
  and (min-device-width: 302px) 
  and (max-device-width: 480px)
  and (-webkit-min-device-pixel-ratio: 2) {
    .logo a span{
      font-size: 10px;
    }
    .logo a img{
      width:100px;
      height: 100px;

    }
}
@media only screen 
  and (min-device-width: 200px) 
  and (max-device-width: 301px)
  and (-webkit-min-device-pixel-ratio: 2) {
    .logo a span{
      font-size: 9px;
    }
    .logo a img{
      width:90px;
      height: 90px;

    }
}


.spancss{
  font-family: Open Sans, sans-serif;font-size: 20px;color:#33ccff;-webkit-transitio: all 0.2s linear 0s;-moz-transition: all 0.2s linear 0s;-o-transition: all 0.2s linear 0s;transition: all 0.2s linear 0s;letter-spacing:0.5px;
}

  .head_a
  {
  text-transform: capitalize;
  }
  .dropdown
   {
    font-size: 10;
  }
  .dropdown:hover{
 background-color: #e54e4b;
  }
  .top-bar{
    background: #231f20!important;
  }
</style>


<!-- ============================================== HEADER ================================= -->
<header class="header-style-1"> 
  <div class="top-bar animate-dropdown">
  <!-- ============================================== logo================================= -->
  <!--<div class="col-md-9 col-sm-9 logo"> <a href="/HydrometV2/index.php"> <img src="<?php //echo $row['logo'];?>" alt="logo" height="120" width="120">
  <span style="font-family: 'Open Sans', sans-serif;font-size: 30px;color:#66ffff;line-height: 25px;-webkit-transitio: all 0.2s linear 0s;-moz-transition: all 0.2s linear 0s;-o-transition: all 0.2s linear 0s;transition: all 0.2s linear 0s;font-weight:bold;
  letter-spacing:0.5px;margin-left: 2%;"><?php //echo $row['ApplicationName'];?></span></a> </div>-->
  <div class="col-md-9 col-sm-9 logo"> <a href="/HydrometV2/index.php"> <img src="/HydrometV2/<?php echo $row['logo'];?>" alt="logo" height="120" width="120">
 </a> 

 <a href="/HydrometV2/index.php"><span class="spancss"><?php echo $row['ApplicationName'];?></span></a>
 </div>
  <!-- ============================================== /logo================================= -->
  <!-- ================side menu top my account,wishlist login ,register==================== -->
   <div class=" col-md-3 col-sm-3 header-top-inner">
  <div class="cnt-account">
		
          <ul class="list-unstyled">
		  
            
            
		
			
			
<?php if(!isset($_SESSION['username']) || strtolower(trim($_SESSION['username']))!="admin") { ?>



			<li><a href="register.php"><i class="icon fa fa-user"></i>Register</a></li>.
      <!-- The register is linked to the register.php page -->
            <li><a href="login.php"><i class="icon fa fa-lock"></i>Login</a></li>
            <!-- The log in is linked to the login.php page -->
	<br>
			<?php }
			
else{			

			?>
			
			<li><a href="logout.php"><i class="icon fa fa-lock"></i>Log Out</a></li>
      <!-- The log out is linked to the logout.php page -->
					<?php  
 echo "<div  style='color:yellow;' align='right'> Welcome: "."<span>".$_SESSION["username"]."</span>"."</div>"; 
?>
<?php } ?>
          </ul>
        </div>
        <div class="clearfix"></div>
      </div>
    <div class="container">
    </div>
  </div>
 <!-- ================side menu top my account,wishlist login ,register==================== -->

      <!-- /.row --> 
      
    </div>
    <!-- /.container --> 
    
  </div>
  <!-- /.main-header --> 
    <!--drop down menu home clothing contavt menu --> 
  <div class="header-nav animate-dropdown">
    <div ">
      <div class="yamm navbar navbar-default" role="navigation">
        <div class="navbar-header">
       <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button"> 
       <span class="sr-only">Toggle navigation</span><span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        </div>
        <div class="nav-bg-class">
          <div class="collapse navbar-collapse" id="mc-horizontal-menu-collapse">
 <ul class="nav navbar-nav">
               <!-- <li class="active dropdown yamm-fw"> <a href="stations.php">Home</a> </li>-->
         <li class="dropdown">  <a href="stations.php" class="head_a"><img src="assets/images/stationmanagement.png" height="20">Stations</a> </li>
                <!-- The Stations dropdown is linked to the stations.php page -->

				<li class="dropdown"><a href="sensors.php" class="head_a"><img src="assets/images/settings.png" height="20"/>Sensor</a> </li>
        <!-- The Sensor dropdown is linked to the Sensors.php page -->

				<li class="dropdown"><a href="alarm.php" class="head_a"><img src="assets/images/alarm.png" height="20"/>Alarm</a> </li>
                        <!-- The Alarm dropdown is linked to the Alarm page -->

				<li class="dropdown"><a href="NewRegistration.php" class="head_a"><img src="assets/images/users.png" height="20"/>Users</a> </li>
                        <!-- The Users dropdown is linked to the NewRegistration.php page -->

				<li class="dropdown"><a href="logomanager.php" class="head_a"><img src="assets/images/logomanager.png" height="20"/>Logo</a> </li>
                        <!-- The Logo dropdown is linked to the logomanager.php page -->

			<li class="dropdown"><a href="StationErrorLog.php" class="head_a"><img src="assets/images/Errorlog.png" height="20"/>Error log</a> </li>
				                <!-- The Error Log dropdown is linked to the StationErrorLog.php page -->

       <!--   <li class="dropdown"> <a href="templete_settings.php?session_request=1" class="head_a"><img src="assets/images/template.png" height="20"/>Templates</a> </li>-->
         <li class="dropdown"> <a href="EditValues.php?session_request=1" class="head_a"><img src="assets/images/edit.png" height="20"/>Edit Values</a> </li>
                         <!-- The Edit Values dropdown is linked to the EditValues.php page -->

        <!-- <li class="dropdown"> <a href="admindashboard.php?session_request=1" class="head_a"><img src="assets/images/dashboard.png" height="20"/>Dashboard</a> </li>
-->
           <li class="dropdown"> <a href="Company.php?session_request=1" class="head_a"><img src="assets/images/company.png" height="20"/>Company</a> </li>
                           <!-- The Company dropdown is linked to the Company.php?session_request=1 page -->
              </ul>
              <!-- /.navbar-nav -->
            <!-- /.nav-outer --> 
          </div>
          <!-- /.navbar-collapse --> 
          
        </div>
       
      </div>
      <!-- /.navbar-default --> 
    </div>
    <!-- /.container-class --> 
    
  </div>
  <!--///////drop down menu home clothing contavt menu --> 

</header>
  <!--// main headerclose is close here  --> 