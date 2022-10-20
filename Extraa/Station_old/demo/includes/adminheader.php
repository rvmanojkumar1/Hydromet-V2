
<?php
include_once 'database.php';
session_start();
$result_set= pg_query("select \"logo\",\"ApplicationName\" from \"tblLogo\" where \"Id\"='101'");
$row=pg_fetch_array($result_set);

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
  .header-style-1 .header-nav .navbar-default .navbar-collapse .navbar-nav > li > a {
    background: none repeat scroll 0 0 rgba(0, 0, 0, 0);
    color: #FFFFFF;
    font-family: 'Open Sans', sans-serif;
    font-size: 13px;
    line-height: 20px;
    padding: 11px 15px;
    text-transform: uppercase;
    -webkit-transitio: all 0.2s linear 0s;
    -moz-transition: all 0.2s linear 0s;
    -o-transition: all 0.2s linear 0s;
    transition: all 0.2s linear 0s;
    font-weight: normal;
    letter-spacing: 0.5px;
    border-right: 1px solid rgba(255,255,255,0.1);
}
</style>

<!-- ============================================== HEADER ================================= -->
<header class="header-style-1" style="background: #000080"> 
  <div class="top-bar animate-dropdown">
  <!-- ============================================== logo================================= -->
  <!--<div class="col-md-3 col-sm-3 logo"> <a href="..\..\index.php"> <img src="/HydrometV2/<?php //echo $row['logo'];?>" alt="logo" height="120" width="120"></div><div class="col-md-6 col-sm-6">
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



			<li><a href="register.php"><i class="icon fa fa-user"></i>Register</a></li>
            <li><a href="login.php"><i class="icon fa fa-lock"></i>Login</a></li>
	<br>
			<?php }
			
else{			

			?>
			
			<li><a href="/HydrometV2/login.php"><i class="icon fa fa-lock"></i>Log Out</a></li>
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
    <div >
      <div class="yamm navbar navbar-default" role="navigation">
        <div class="navbar-header">
       <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button"> 
       <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        </div>
        <div class="nav-bg-class">
          <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
            <div class="nav-outer">
          <ul class="nav navbar-nav">
              
                <li class="dropdown"> <a href="/HydrometV2/stations.php" class="head_a"><img src="assets/images/stationmanagement.png" height="20" ="hi">&nbsp Stations</a> </li>
				<li class="dropdown"> <a href="/HydrometV2/sensors.php" class="head_a"><img src="assets/images/settings.png" height="20" >&nbsp  Sensor</a> </li>
				<li class="dropdown"> <a href="/HydrometV2/alarm.php" class="head_a"><img src="assets/images/alarm.png" height="20">&nbsp Alarm</a> </li>
				<li class="dropdown"> <a href="/HydrometV2/NewRegistration.php" class="head_a"><img src="assets/images/users.png" height="20">&nbsp Users</a> </li>
				<li class="dropdown"> <a href="/HydrometV2/logomanager.php" class="head_a"><img src="assets/images/logomanager.png" height="20">&nbsp Logo</a> </li>
			<li class="dropdown"> <a href="/HydrometV2/StationErrorLog.php" class="head_a"><img src="assets/images/Errorlog.png" height="20">&nbsp Error log</a> </li>
				
         <li class="dropdown"> <a href="/HydrometV2/EditValues.php?session_request=1" class="head_a"><img src="images/edit.png" height="20"/>Edit Values</a> </li>
      <!--  <li class="dropdown"> <a href="/HydrometV2/admindashboard.php?session_request=1" class="head_a"><img src="assets/images/dashboard.png" height="20"/>Dashboard</a> </li>
      -->
         <li class="dropdown"> <a href="/HydrometV2/Company.php?session_request=1" class="head_a"><img src="assets/images/company.png" height="20"/>Company</a> </li>
              </ul>
              <!-- /.navbar-nav -->
              <div class="clearfix"></div>
            </div>
            <!-- /.nav-outer --> 
          </div>
          <!-- /.navbar-collapse --> 
          
        </div>
        <!-- /.nav-bg-class --> 
      </div>
      <!-- /.navbar-default --> 
    </div>
    <!-- /.container-class --> 
    
  </div>
  <!--///////drop down menu home clothing contavt menu --> 

</header>
  <!--// main headerclose is close here  --> 
