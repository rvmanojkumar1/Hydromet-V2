

<!-- Meta -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
<meta name="description" content="">
<meta name="author" content="">
<meta name="keywords" content="MediaCenter, Template, eCommerce">
<meta name="robots" content="all">
<title>Hydromet</title>

<!-- Bootstrap Core CSS -->
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<link rel="stylesheet" href="assets/sweetalert2.min.css">


<!-- Customizable CSS -->
<link rel="stylesheet" href="assets/css/main.css">
<link rel="stylesheet" href="assets/css/blue.css">
<link rel="stylesheet" href="assets/css/custom.css">
<link rel="stylesheet" href="assets/css/owl.carousel.css">
<link rel="stylesheet" href="assets/css/owl.transitions.css">
<link rel="stylesheet" href="assets/css/animate.min.css">
<link rel="stylesheet" href="assets/css/rateit.css">
<link rel="stylesheet" href="assets/css/bootstrap-select.min.css">
 <link rel="stylesheet" href="header.css">
   

<!-- Icons/Glyphs -->
<link rel="stylesheet" href="assets/css/font-awesome.css">

<!-- Fonts -->
<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,400italic,600,600italic,700,700italic,800' rel='stylesheet' type='text/css'>
<link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>               


<!-- ============================================== HEADER ================================= -->
<header class="header-style-1"> 
  <div class="top-bar animate-dropdown">
  <!-- ============================================== logo================================= -->
  <div class="col-md-3 col-sm-3 logo"> <a href="index.php"> <img src="Raindrop-web.png" alt="logo" height="120" width="120">
  <span style="font-family: 'Open Sans', sans-serif;font-size: 30px;color:#33ccff;line-height: 25px;-webkit-transitio: all 0.2s linear 0s;-moz-transition: all 0.2s linear 0s;-o-transition: all 0.2s linear 0s;transition: all 0.2s linear 0s;font-weight:bold;
  letter-spacing:0.5px;"> </span></a> </div>
  <!-- ============================================== /logo================================= -->
  <!-- ================side menu top my account,wishlist login ,register==================== -->
   <div class=" col-md-9 col-sm-9 header-top-inner">
  <div class="cnt-account">
    
          <ul class="list-unstyled">
      
            
            
    
      
      



      <li><a href="register.php"><i class="icon fa fa-user"></i>Register</a></li>
            <li><a href="login.php"><i class="icon fa fa-lock"></i>Login</a></li>
  <br>
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
    <div>
      <div class="yamm navbar navbar-default" role="navigation">
        <div class="navbar-header">
       <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button"> 
       <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
        </div>
        <div class="nav-bg-class">
          <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
            <div class="nav-outer">
              <ul class="nav navbar-nav" style="active:background-color:red;">
        
                <li class="dropdown" > <a href="index.php"><img src="assets/images/map.png" height="20">Map</a> </li>
        <li class="dropdown"> <a href="graph.php"><img src="assets/images/graph.png" height="20">Graph</a> </li>
        <li class="dropdown"> <a href="Selectquery.php"><img src="assets/images/queryIcon.png" height="20">Station Query</a> </li>
        <li class="dropdown"> <a href="dashboard.php"><img src="assets/images/dashboard.png" height="20"> Dashboard</a> </li>
        <li class="dropdown"> <a href="#"><img src="assets/images/report1.png" height="20">Report</a> </li>
      <li class="dropdown"> <a href="contact.php"><img src="assets/images/cont.png" height="20">Contact</a> </li>
        <li class="dropdown"> <a href="template_dashboard.php"><img src="assets/images/template.png" height="20">Template</a> </li>
        
        
                
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
  <!--// main headerclose is close here  --> <br>
<link rel="stylesheet" href="assets/jquery-ui.css">

<script type="text/javascript" src="assets/jquery.js"></script>
<script type="text/javascript" src="assets/jquery-ui.js"></script>
<script type="text/javascript">
$(function() 
{
 $("#stn_id").autocomplete({

  source: 'autocompelete.php'
 });
});
</script>



<script type="text/javascript">
 

 function PlotGraph(params,station) {
 
 
   var yearFrom;
            var monthFrom;
            var dayFrom;
            var yearTo;
            var monthTo;
            var dayTo;
                
                var days=6; // Days you want to subtract
var date = new Date();
var last = new Date(date.getTime() - (days * 24 * 60 * 60 * 1000));
var dayFrom =last.getDate();
var monthFrom=last.getMonth()+1;
var yearFrom=last.getFullYear();

                var currentdate = new Date();

                yearTo = currentdate.getFullYear();
                monthTo = currentdate.getMonth() + 1;
                dayTo = currentdate.getDate();
     
     

           window.location.href= 'Graph.php?FY=' + yearFrom + "&FM=" + monthFrom + "&FD=" + dayFrom + '&TY=' + yearTo + "&TM=" + monthTo + "&TD=" + dayTo + "&PARAMS=" + params+"&station="+station;
  
  
}

</script>


<br>
<div style="min-width: 70%;max-height: 100%;margin-left:5%;margin-left:2%";>
<center>
<div class="row">
<div class='row'>
<div class='col-md-12'>
<table align='center' style='max-width:98%;min-width:60%;' class='table'>
<tr>
<td colspan="2">
<label>Rainfall  Network Template
</label>
<td>
</tr>

</table>


</div></div>
  
<div class="col-md-12" style="overflow:scroll;height: 600px;">
<table align="center" id="myTable" style="max-width:99%;min-width:50%" class="table table-responsive">
<tr>
    <th style="background-color:#539CCC;color:white;text-align:center;font-size: 13px;"><a style="color:white" >Station Name</a></th>
    <th style="background-color:#539CCC;color:white;text-align:center;font-size: 13px;"><a style="color:white" >Date/Time</a></th>
     

 <th style="background-color:#539CCC;color:white;text-align:center;font-size: 13px;"><a style="color:white"  >Water level Change (1000 hour)</a></th>
     
 

   <th style="background-color:#539CCC;color:white;text-align:center;font-size: 13px;"><label style="color:white" >Flood Stage (ft)</label></th>
   
 

 
     </tr>
      
      <tr>
      <td style="text-align:center;font-size: 13px;height: 14px;"><a>SF1</a></td>
                               
      <td style="text-align:center;font-size: 13px;height: 14px;"><a>2018-02-15 12:15:00</a></td>
                               
                                    
    

      <td style="text-align:center;font-size: 13px;height: 14px;"><a href="javascript:PlotGraph('Water level','SF7')">Water level Change (1000 hour)</a></td>
      <td style="text-align:center;font-size: 13px;height: 14px;"><label>Flood Stage (ft)</label></td>                              
    
                                 
   </tr>
                   
    <tr>
      <td style="text-align:center;font-size: 13px;height: 14px;"><a>SF5</a></td>
                               
      <td style="text-align:center;font-size: 13px;height: 14px;"><a>2018-02-15 12:15:00</a></td>
                               
                                    
      <td style="text-align:center;font-size: 13px;height: 14px;"><a href="javascript:PlotGraph('Water level','SF7')">Water level Change (1000 hour)</a></td>

  
   
      <td style="text-align:center;font-size: 13px;height: 14px;"><label>Flood Stage (ft)</label></td>                              
    
                                 
   </tr>

     <tr>
      <td style="text-align:center;font-size: 13px;height: 14px;"><a>SF7</a></td>
                               
      <td style="text-align:center;font-size: 13px;height: 14px;"><a>2018-02-15 12:15:00</a></td>
                               
                                    


      <td style="text-align:center;font-size: 13px;height: 14px;"><a href="javascript:PlotGraph('Water level','SF7')">Water level Change (1000 hour) </a></td>  
                              
          <td style="text-align:center;font-size: 13px;height: 14px;"><label>Flood Stage (ft)</label></td>

                                 
   </tr>
        </table></div></center>
</div>

</div>
</form>

<?PHP


 include_once 'TEMPLATE.php'; ?>
