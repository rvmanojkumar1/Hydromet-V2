

   <script type="text/javascript" src="http://cdn.leafletjs.com/leaflet/v0.7.7/leaflet.js"></script>
    <script type="text/javascript" src="http://maps.google.com/maps/api/js?v=3.2&sensor=false"></script>
    <script type="text/javascript" src="http://matchingnotes.com/javascripts/leaflet-google.js"></script>   
     <script src="//cdnjs.cloudflare.com/ajax/libs/dygraph/2.0.0/dygraph.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/dygraph/2.0.0/dygraph.min.css" />
    <script src="js/underscore-min.js"></script>

    <link href="Styles/FontStyle.css" rel="stylesheet" type="text/css" />
    <!--<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css" />-->
    <script type="text/javascript" src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script type="text/javascript" src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="Scripts/jstree.min.js" type="text/javascript"></script>
    
   <!-- =====================Graph ===============================-->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script> 
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    
    <script src="Scripts/jquery.canvasjs.min.js"></script>
   
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.2/dist/leaflet.css" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous" />
    <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script src="Scripts/bootstrap-tour.js" type="text/javascript"></script>
    <link href="Styles/bootstrap-tour.css" rel="stylesheet" type="text/css" />
    <link href="js/L.Control.Sidebar.css" rel="stylesheet" type="text/css" />
    <script src="js/L.Control.Sidebar.js" type="text/javascript"></script>
    <link href="js/leaflet-control-boxzoom.css" rel="stylesheet" type="text/css" />
    <script src="js/leaflet-control-boxzoom.js" type="text/javascript"></script>
    <link href="js/Leaflet.NavBar.css" rel="stylesheet" type="text/css" />
    <script src="js/Leaflet.NavBar.js" type="text/javascript"></script>
    <link href="js/L.Control.Pan.css" rel="stylesheet" type="text/css" />
    <link href="js/L.Control.Pan.ie.css" rel="stylesheet" type="text/css" />
    <script src="js/L.Control.Pan.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="Content/Site.css" />
    <script type="text/javascript">
        var googleStreets, googleHybrid, gwl_wms, soil_wms, aquifer_wms, watershed_wms, gp_wms, state_wms, map;

       function comingsoon()
       {
alert('Coming Soon!');
       }

           function showSattellite() {
       
               map.removeLayer(googleHybrid);
               map.removeLayer(googleStreets);

               googleHybrid.addTo(map);
           }
           function showStreetmap() {
               map.removeLayer(googleHybrid);
               map.removeLayer(googleStreets);

               googleStreets.addTo(map);
           }

           function zoomtoindia() {
               map.setView([22.00, 77.00], 5);
           }

           function onclickaquifer(checked) {
               if (checked)
                   aquifer_wms.addTo(map);
               else
                   map.removeLayer(aquifer_wms);
           }

           function onclickgwl(checked) {
               if (checked)
                   gwl_wms.addTo(map);
               else
                   map.removeLayer(gwl_wms);
           }
           function onclicksoil(checked) {
               if (checked)
                   soil_wms.addTo(map);
               else
                   map.removeLayer(soil_wms);
           }

           function onclickwatershed(checked) {
               if (checked)
                   watershed_wms.addTo(map);
               else
                   map.removeLayer(watershed_wms);
           }

           function onclickgp(checked) {
               if (checked)
                   gp_wms.addTo(map);
               else
                   map.removeLayer(gp_wms);
           }
           $(document).ready(function () {
                 map = L.map('map').setView([39.32, -90.36], 4);
            //   var map = L.map('map').setView([25.00, 77.00], 5);
               L.control.scale({ position: 'bottomleft' }).addTo(map);
               //L.control.navbar({ position: 'bottomright' }).addTo(map);
               //L.Control.boxzoom({ position: 'topleft' }).addTo(map);
               //L.Control.Zoom({ position: 'topright' }).addTo(map);
               googleHybrid = L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {
                   subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
               });
               //google hybrid domain for adding a layer over the leaflet map


               googleStreets = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
                   maxZoom: 20,
                   subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
               });
               //google hybrid domain for adding a street layer over the leaflet map


               // diferent layers are being called from the different address to show the required types of map over the map

               googleStreets.addTo(map);
               aquifer_wms = L.tileLayer.wms("http://182.18.163.226:8085/geoserver/cite/wms", {
                   layers: 'cite:GP_Aquifer',
                   format: 'image/png',
                   styles: 'cite:AquiferStyle',
                   transparent: true
               });

               hydrometstations_wms = L.tileLayer.wms("http://182.18.163.226:8085/geoserver/cite/wms", {
                   layers: 'cite:tblStation',
                   format: 'image/png',
                   styles: 'cite:HydroMetStyle',
                   transparent: true
               });
               hydrometstations_wms.addTo(map);

               gwl_wms = L.tileLayer.wms("http://182.18.163.226:8085/geoserver/cite/gwc/service/wms", {
                   layers: 'cite:tblGroundwaterLevels',
                   format: 'image/png',
                   transparent: true
               });
               soil_wms = L.tileLayer.wms("http://182.18.163.226:8085/geoserver/cite/wms", {
                   layers: 'cite:GP_Soil',
                   format: 'image/png',
                   transparent: true
               });
               watershed_wms = L.tileLayer.wms("http://182.18.163.226:8085/geoserver/cite/wms", {
                   layers: 'cite:GP_Watershed',
                   format: 'image/png',
                   transparent: true
               });
               gp_wms = L.tileLayer.wms("http://182.18.163.226:8085/geoserver/cite/wms", {
                   layers: 'cite:All_States_GP',
                   format: 'image/png',
                   transparent: true
               });

                state_wms = L.tileLayer.wms("http://182.18.163.226:8085/geoserver/cite/wms", {
                    layers: 'cite:India_States',
                    format: 'image/png',
                    styles: 'tblstates_style',
                    transparent: true
                });
                state_wms.addTo(map);


               map.on('click', function (e) {
                   
                   //onpan();
                   //    alert("Lat, Lon : " + e.latlng.lat + ", " + e.latlng.lng)
               });


           });
       </script> 
 
  <script type="text/javascript">
    
    $('.tree-toggle').click(function () {
  $(this).parent().children('ul.tree').toggle(200);
});


  </script>

<script type="text/javascript">
  //The following shows the visible, odd or even, active of the elements of data over the each marker

$( document ).ready(function() {
$('#cssmenu ul ul li:odd').addClass('odd');
$('#cssmenu ul ul li:even').addClass('even');
$('#cssmenu > ul > li > a').click(function() {
  $('#cssmenu li').removeClass('active');
  $(this).closest('li').addClass('active'); 
  var checkElement = $(this).next();
  if((checkElement.is('ul')) && (checkElement.is(':visible'))) {
    $(this).closest('li').removeClass('active');
    checkElement.slideUp('normal');
  }
  if((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
    $('#cssmenu ul ul:visible').slideUp('normal');
    checkElement.slideDown('normal');
  }
  if($(this).closest('li').find('ul').children().length == 0) {
    return true;
  } else {
    return false; 
  } 
});
});
</script>

<!--homepage section start -->
				  <!--homepage leftone section start -->
  <div class="body-content outer-top-xs" id="top-banner-and-menu">
  <div class="container-fluid">
    <div class="row"> 

     <div class="col-xs-12 col-sm-12 col-md-2 sidebar"> 
        
 <!-- ================================== TOP NAVIGATION ================================== -->
        <div class="side-menu animate-dropdown outer-bottom-xs">
         
          <nav class="yamm megamenu-horizontal" role="navigation">
            <ul class="nav">
			
           <li class="dropdown menu-item">
			
			<li  data-toggle="collapse" data-target="" class="dropdown-toggle" style="background:#4d0026;">
                  <a href="#"><i class="fa fa-map-marker " style="color:white;"></i>&nbsp;&nbsp;<b style="color:white;"> Base Layer</b><span class="arrow"></span></a>
                </li>
          <!-- Different Base layers are shown and are sent as inputs to get the output in the front end -->

                <li data-toggle="" data-target="#service" class="collapsed">
                  <a href="#" onclick="showStreetmap();">&nbsp;&nbsp;&nbsp;<i class="glyphicon glyphicon-forward"> </i> <i class="fa fa-car fa-lg"></i>&nbsp;&nbsp;Google Street<span class=""></span></a>
                </li>  
            <!-- Google Street is Different Map View as shown and is sent as input to show the output in the front end over the map -->

                <li data-toggle="collapse" data-target="#new" class="collapsed">
                  <a href="#" onclick="showSattellite();">&nbsp;&nbsp;&nbsp;<i class="glyphicon glyphicon-forward"> </i> <i class="fa fa-globe fa-lg"></i>&nbsp;&nbsp;Google Satellite<span class=""></span></a>
                </li>
              <!-- Google Satellite is Different Map View as shown and is sent as input to show the output in the front end over the map -->

		 <li data-toggle="collapse" data-target="#new" class="collapsed">
                  <a href="#" onclick="comingsoon()">&nbsp;&nbsp;&nbsp;<i class="glyphicon glyphicon-forward"> </i> <i class="fa fa-flag "></i>&nbsp;&nbsp;Open Street Map <span class=""></span></a>
                </li>
				 <!-- Open Street Map is Different Map View as shown and is sent as input to show the output in the front end over the map -->

 <li  data-toggle="collapse" data-target="" class="dropdown-toggle" style="background:#4d0026;">
                  <a href="#"><i class="glyphicon glyphicon-tent"style="color:white;"></i>&nbsp;&nbsp; <b style="color:white;"> Type of Stations</b> <span class="arrow"></span></a>
                </li>
				
				
				
                <li data-toggle="" data-target="#service" class="collapsed">
                  <a href="#" onclick="comingsoon()">&nbsp;&nbsp;&nbsp;<i class="glyphicon glyphicon-forward"> </i> <i class=" 	glyphicon glyphicon-cloud"></i>&nbsp;&nbsp; Hydrological<span class=""></span></a>
                </li>  
            

                <li data-toggle="collapse" data-target="#new" class="collapsed">
                  <a href="#" onclick="comingsoon()">&nbsp;&nbsp;&nbsp;<i class="glyphicon glyphicon-forward"> </i> <i class="fa fa-globe fa-lg"></i>&nbsp;&nbsp;Metrological<span class=""></span></a>
                </li>
             
	 <li  data-toggle="collapse" data-target="" class="dropdown-toggle" style="background:#4d0026;">
                  <a href="#"><i class="fa fa-users" style="color:white;">&nbsp;&nbsp;</i><b style="color:white;"> Administrative Boundary</b> <span class="arrow"></span></a>
                </li>
				
				
				
                <li data-toggle="" data-target="#service" class="collapsed">
                  <a href="#" onclick="comingsoon()">&nbsp;&nbsp;&nbsp;<i class="glyphicon glyphicon-forward"> </i> <i class="glyphicon glyphicon-user"></i>&nbsp;&nbsp;Admin1 <span class=""></span></a>
                </li>  
            

                <li data-toggle="" data-target="#new" class="">
                  <a href="#" onclick="comingsoon()">&nbsp;&nbsp;&nbsp;<i class="glyphicon glyphicon-forward"> </i> <i class="glyphicon glyphicon-user"></i>&nbsp;&nbsp; Admin2 <span class=""></span></a>
                </li>
             
			 
			   <li data-toggle="collapse" data-target="#new" class="collapsed">
                  <a href="#" onclick="comingsoon()">&nbsp;&nbsp;&nbsp;<i class="glyphicon glyphicon-forward"> </i> <i class="glyphicon glyphicon-user"></i>&nbsp;&nbsp; Admin3 <span class=""></span></a>
                </li>
				
				  <li data-toggle="collapse" data-target="#new" class="collapsed">
                  <a href="#" onclick="comingsoon()">&nbsp;&nbsp;&nbsp;<i class="glyphicon glyphicon-forward"> </i> <i class="glyphicon glyphicon-user"></i>&nbsp;&nbsp; Admin4 <span class=""></span></a>
                </li>      
				
				
				
				
				</ul>
                <!-- /.dropdown-menu --> </li>
              <!-- /.menu-item -->
              
            
           
            <!-- /.nav --> 
          </nav>
          <!-- /.megamenu-horizontal --> 
        </div>
        <!-- /.side-menu --> 

    </div>

      

  <!-- =============================== CONTENTpage ================================== -->
      <div class="col-xs-12	  col-sm-12 col-md-10 homebanner-holder"> 
   
 
 <div id="map" style="width:100%; height:80%;"></div> 
   
   
</div>   <!-- =========================right side colom div ============================================== --> 


</div>
	 </div>
	
	
	</div>