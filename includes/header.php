<?php
include_once 'database.php';
session_start();
$username="guest";

if ($_SESSION['username']==null) {
$_SESSION['username']=$username;
echo "<script>window.location.href='index.php';</script>";
}
$result_set= pg_query("select \"logo\",\"ApplicationName\" from \"tblLogo\" where \"Id\"='101'");
//$result_set is set by the result of the query, in t=which the logo,ApplicationName are being selected from the table "tblLogo" where Id = "101"

$row=pg_fetch_array($result_set);
//$result_set is set into the array into the variable $row



?>
<script type="text/javascript">
  function redirect(argument) {
    window.location.href=argument;
   
  }
</script>
<link rel="stylesheet" href="/HydrometV2/assets/css/bootstrap.min.css">
<link rel="stylesheet" href="/HydrometV2/assets/css/main.css">
<link rel="stylesheet" href="/HydrometV2/assets/css/blue.css">
<link rel="stylesheet" href="/HydrometV2/assets/css/custom.css">
<link rel="stylesheet" href="/HydrometV2/assets/css/owl.carousel.css">
<link rel="stylesheet" href="/HydrometV2/assets/css/owl.transitions.css">
<link rel="stylesheet" href="/HydrometV2/assets/css/animate.min.css">
<link rel="stylesheet" href="/HydrometV2/assets/css/rateit.css">
<link rel="stylesheet" href="/HydrometV2/assets/css/bootstrap-select.min.css">
 <link rel="stylesheet" href="/HydrometV2/header.css">
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
<style>

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


.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f1f1f1;

    min-width: 230px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content label {
    color: gray;
    padding: 12px 16px;
      font-size: 15px;
    text-decoration: none;
    display: block;
}

.dropdown-content label:hover {background-color: #e54e4b;
color: white;}

.dropdown:hover .dropdown-content {
    display: block;
  position:absolute;
   z-index:1000;
}
.spancss{
  font-family: Open Sans, sans-serif;font-size: 20px;color:#33ccff;-webkit-transitio: all 0.2s linear 0s;-moz-transition: all 0.2s linear 0s;-o-transition: all 0.2s linear 0s;transition: all 0.2s linear 0s;letter-spacing:0.5px;
}


</style>
<!-- ============================================== HEADER ================================= -->
<header class="header-style-1"> 

  <div class="top-bar animate-dropdown">
  <!-- ============================================== logo================================= -->
  <div class="col-md-9 col-sm-9 logo"> <a href="/HydrometV2/index.php"> <img src="/HydrometV2/<?php echo $row['logo'];?>" alt="logo" height="120" width="120">
 </a> 

 <a href="/HydrometV2/index.php"><span class="spancss"><?php echo $row['ApplicationName'];?></span></a>
 </div>
  <!-- ============================================== /logo================================= -->
  <!-- ================side menu top my account,wishlist login ,register====================-->
   <div class=" col-md-3 col-sm-3 header-top-inner">
   
  <div class="cnt-account">
		
          <ul class="list-unstyled">
		  
            
            
		
			
			
<?php if((!isset($_SESSION['username']))||($_SESSION['username']==$username)) { 
 
    ?>



			<li><a href="/HydrometV2/register.php"><i class="icon fa fa-user"></i>Register</a></li>
      <!-- The register is linked to the register.php page -->
            <li><a href="/HydrometV2/login.php"><i class="icon fa fa-lock"></i>Login</a></li>
            <!-- The log in is linked to the login.php page -->
	<br>
			<?php
      
       }
			
else{			
 
			?>
			
			<li><a href="/HydrometV2/logout.php"><i class="icon fa fa-lock"></i>Log Out</a></li>
      <!-- The log out is linked to the logout.php page -->
					<?php  
 echo "<div  style='color:yellow;' align='right'> Welcome: "."<span>".$_SESSION["username"]."</span>"."</div>"; 
?>
<?php 
} ?>
          </ul>
        </div>
        <div class="clearfix"></div>
      </div>
    <div class="container">
    </div>
  </div>
 <!-- ================side menu top my account,wishlist login ,register==================== -->

      
  <!-- /.main-header --> 
    <!--drop down menu home clothing contavt menu --> 
  <div class="header-nav animate-dropdown">
    <div>
      <div class="yamm navbar navbar-default" role="navigation">
        <div class="navbar-header">
       <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button"> 
       <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        </div>
        <div class="nav-bg-class">
          <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
            <div class="nav-outer">
              <ul class="nav navbar-nav">
				
                <li class="dropdown" > <a href="/HydrometV2/index.php" class="head_a" ><img src="/HydrometV2/assets/images/map.png" height="20">Map</a> </li>
                <!-- The map dropdown is linked to the /HydrometV2/index.php.php page -->

				<li class="dropdown"> <a href="/HydrometV2/graph.php"  class="head_a" ><img src="/HydrometV2/assets/images/graph.png" height="20">Graph</a> </li>
          <!-- The Graph dropdown is linked to the /HydrometV2/graph.php.php page -->

				<li class="dropdown"> <a href="/HydrometV2/Selectquery.php"  class="head_a" ><img src="/HydrometV2/assets/images/queryIcon.png" height="20">Station Query</a> </li>
        <!-- The Station Query dropdown is linked to the /HydrometV2/Selectquery.php page -->

				<li class="dropdown" ><a href="#"  class="head_a" ><img src="/HydrometV2/assets/images/dashboard.png" height="20"> Dashboard</a> <div class="dropdown-content">
          <!-- The Dashboard dropdown is linked to the open a dropdown -->

    <label onclick="redirect('/HydrometV2/dashboard/NormalTable/river.php')" class="head_a">River</label>
    <label onclick="redirect('/HydrometV2/dashboard/SymbolTable/river-symboltable.php')" class="head_a">River-SymbolTable</label>
          <!-- The River dropdown is linked to the /HydrometV2/dashboard/river.php page -->
        <label onclick="redirect('/HydrometV2/dashboard/NormalTable/Reservoir.php')" class="head_a">Reservoir</label>
        <label onclick="redirect('/HydrometV2/dashboard/SymbolTable/Reservoir-symboltable.php')" class="head_a">Reservoir-SymbolTable</label>
          <!-- The Reservoir dropdown is linked to the /HydrometV2/dashboard/Reservoir.php page -->
  
  </div> 
        </li>

       
				<li class="dropdown"> <a href="/HydrometV2/report1.php?report_type=Climate"  class="head_a" ><img src="/HydrometV2/assets/images/report1.png" height="20">Report</a> <div class="dropdown-content">
        </li>
        <!-- The Report dropdown is linked to the /HydrometV2/report.php?report_type=Climate page -->
				
				<?php 
        $checkusername=$_SESSION['username'];
        $usertype=pg_query("select \"UserType\" from \"tblloginandregister\" where \"Username\"='$checkusername'");
$row1=pg_fetch_array($usertype);
$usertype1=$row1["UserType"];

        if(!isset($_SESSION['username']) || $_SESSION['username']==$username ||$usertype1=="Normal"){
				
				}
				else{
					?>
					<li class="dropdown"><a href="/HydrometV2/stations.php#stationtypes" class="head_a"><img src="/HydrometV2/assets/images/admin.png" height="20">Go To admin</a>
</li>
<?php
				}
?>				
				
				
				
				
				
				
		<!--	<li class="dropdown"> <a href="contact.php"  class="head_a" ><img src="assets/images/cont.png" height="20">Contact</a> </li>
        <li class="dropdown"> <a href="template_dashboard.php"  class="head_a"><img src="assets/images/template.png" height="20">Template</a> </li>-->
				
      
                
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