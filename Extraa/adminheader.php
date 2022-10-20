


<!-- ============================================== HEADER ================================= -->
<header class="header-style-1"> 
 <div class="col-md-3 col-sm-3 logo"> <a href="/HydrometV2/index.php"> <img src="<?php echo $row['logo'];?>" alt="logo" height="120" width="120">
  <span style="font-family: 'Open Sans', sans-serif;font-size: 40px;color:#66ffff;line-height: 25px;-webkit-transitio: all 0.2s linear 0s;-moz-transition: all 0.2s linear 0s;-o-transition: all 0.2s linear 0s;transition: all 0.2s linear 0s;font-weight:bold;
  letter-spacing:0.5px;"><?php echo $row['ApplicationName'];?></span></a> </div>
  <!-- ============================================== /logo================================= -->
  <!-- ================side menu top my account,wishlist login ,register==================== -->
   <div class=" col-md-9 col-sm-9 header-top-inner">
  <div class="cnt-account">
		
          <ul class="list-unstyled">
		  
            
            
		
			
			
<?php if(!isset($_SESSION['username'])) { ?>



			<li><a href="/HydrometV2/register.php"><i class="icon fa fa-user"></i>Register</a></li>
            <li><a href="/HydrometV2/login.php"><i class="icon fa fa-lock"></i>Login</a></li>
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
    <div class="container-fluid">
      <div class="yamm navbar navbar-default" role="navigation">
        <div class="navbar-header">
       <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button"> 
       <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        </div>
        <div class="nav-bg-class">
          <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
            <div class="nav-outer">
              <ul class="nav navbar-nav">
                <li class="active dropdown yamm-fw"> <a href="/HydrometV2/stations.php">Home</a> </li>
                <li class="dropdown"> <a href="/HydrometV2/stations.php"><img src="assets/images/stationmanagement.png" height="20" ="hi">&nbsp Stations</a> </li>
				<li class="dropdown"> <a href="/HydrometV2/sensors.php"><img src="assets/images/settings.png" height="20" >&nbsp  Sensor</a> </li>
				<li class="dropdown"> <a href="/HydrometV2/alarm.php"><img src="assets/images/alarm.png" height="20">&nbsp Alarm</a> </li>
				<li class="dropdown"> <a href="/HydrometV2/NewRegistration.php"><img src="assets/images/users.png" height="20">&nbsp Users</a> </li>
				<li class="dropdown"> <a href="/HydrometV2/logomanager.php"><img src="assets/images/logomanager.png" height="20">&nbsp Logo</a> </li>
			<li class="dropdown"> <a href="/HydrometV2/StationErrorLog.php"><img src="assets/images/Errorlog.png" height="20">&nbsp Error log</a> </li>
				
        
       
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