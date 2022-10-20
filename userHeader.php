<?php
include_once 'database.php';
session_start();
$result_set= pg_query("select \"logo\",\"ApplicationName\" from \"tblLogo\" where \"Id\"='101'");
$row=pg_fetch_array($result_set);

?>

<html>
	<head>
    
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
		<title></title>
		<link rel="stylesheet" href="css/style.css" type="text/css" />
 <?php
   include ('includes/link.php');
   ?>
		

		
		
		
		
		
		
		
		
		<style>
.header {
    list-style-type: ;
    margin: 0;
    padding: 0;


}

li a {
    display: block;
    color: #000;
    padding: 4px 12px;
    text-decoration: none;
}

/* Change the link color on hover */
 li a:hover {
    background-color: ;
    color: white;
}
 li a:active{
background-color:;
    color: ;
}


</style>
	</head>
	<body>

		<div class="header" >
			<div id="tophead" style="background-color:#005ce6;">


            <img src="<?php echo $row['logo'];?>" width="110" height="110" style="float:left;margin:5px"  alt="logo"/>      
              <span style="float:left;margin:25px;color:#000  width:1510px; height:1510px"><?php echo $row['ApplicationName'];?></span> 
<p style="float:right;margin:25px;color:#000">
<label ><?php if(isset($_SESSION['username'])) {
 echo "Welcome ".$_SESSION['username'];
} ?></label><a href="Login.php" style="margin-left:5px;color:#000">Log-out</a>
</p>
            </div>

			
			
			
		</div> 
		


<!-- ============================================== HEADER ================================= -->
<header class="header-style-1"> 
 

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
                <li class="active dropdown yamm-fw"> <a href="index.php">Home</a> </li>
				<li class="dropdown"> <a href="Index.php"><img src="images/map.png" height="20">&nbsp Map</a> </li>
                <li class="dropdown"> <a href="Graph.php"><img src="images/graph.png" height="20">&nbsp Graph</a> </li>
				
               <li class="dropdown" > <a href="#"><img src="images/alarm.png" height="20">&nbsp Alarm</a> </li>
			   <li class="dropdown"> <a href="dashboard.php"><img src="images/dashboard.png" height="20">&nbsp Dashboard</a> </li>
			   <li class="dropdown"> <a href="#"><img src="images/report.png" height="20">&nbsp Report</a> </li>
			   <li class="dropdown"> <a href="#" ><img src="images/contact.png" height="20">&nbsp Contact</a> </li>
           
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
		

                            

	
	</body>
</html>