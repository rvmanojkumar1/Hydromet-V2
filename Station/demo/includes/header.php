


<!-- ============================================== HEADER ================================= -->
<style type="text/css">
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
<header class="header-style-1" style=" background: #000080 !important;"> 
  <div class="top-bar animate-dropdown">
  <!-- ============================================== logo================================= -->
  <div class="col-md-3 col-sm-3 logo"> <a href="index.php"> <img src="assets/images/icon.png" alt="logo" height="120" width="120"></a></div><div class="col-md-6 col-sm-6">
  <span style="
  font-family: 'Open Sans', sans-serif;
  font-size: 40px;
  color:#66ffff;
  line-height: 25px;
  -webkit-transitio: all 0.2s linear 0s;
  -moz-transition: all 0.2s linear 0s;
  -o-transition: all 0.2s linear 0s;
  transition: all 0.2s linear 0s;
  font-weight:bold;
  letter-spacing:0.5px;margin-left: 2%;
 ">Hydromet </span></a> </div>
  <!-- ============================================== /logo================================= -->
  <!-- ================side menu top my account,wishlist login ,register==================== -->
   <div class=" col-md-3 col-sm-3 header-top-inner">
  <div class="cnt-account">
		
          <ul class="list-unstyled">
		  
            
            
		
			
			<?php if(!isset($_SESSION['username'])){ ?>
			
			<li><a href="register.php"><i class="icon fa fa-user"></i>Register</a></li>
            <li><a href="login.php"><i class="icon fa fa-lock"></i>Login</a></li>
	<br>
			<?php }
			
else{			

			?>
			
			<li><a href="HydrometV2/login.php"><i class="icon fa fa-lock"></i>Log Out</a></li>
	
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
                <li class="active dropdown yamm-fw"> <a href="index.php" class="head_a">Home</a> </li>
                <li class="dropdown"> <a href="index.php" class="head_a"><img src="assets/images/map.png" height="20">&nbsp Map</a> </li>
				<li class="dropdown"> <a href="graph.php" class="head_a"><img src="assets/images/graph.png" height="20">&nbsp  Graph</a> </li>
				<li class="dropdown"> <a href="Selectquery.php" class="head_a"><img src="assets/images/queryIcon.png" height="20">&nbsp Station Query</a> </li>
				<li class="dropdown"> <a href="dashboard.php" class="head_a"><img src="assets/images/dashboard.png" height="20">&nbsp Dashboard</a> </li>
				<li class="dropdown"> <a href="report.php?report_type=Climate" class="head_a"><img src="assets/images/report1.png" height="20">&nbsp Report</a> </li>
		
				
        
                
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