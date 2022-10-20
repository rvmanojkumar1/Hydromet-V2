<?php
  	include ('database.php');
  	session_start();
  	include_once 'includes/editCompany.php';

  	$company=$_SESSION["company"];
?>
<!DOCTYPE html>
<html>
	<head>
	  	<?php
	    	include("includes/link.php");
	  	?>
	  
	  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous" />
	  	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous" />
	  	<link rel="stylesheet" href="assets/jquery-ui.css">
	  	<link rel="stylesheet" type="text/css" href="/hydromet/assets/Control.FullScreen.css">
	  	<script type="text/javascript" src="/hydromet/assets/Control.FullScreen.js"></script>

	  	<link rel="stylesheet" type="text/css" href="/hydromet/assets/css/MyTable.css">
	  	<script type="text/javascript" src="assets/jquery.js"></script>
	  	<script type="text/javascript" src="assets/jquery-ui.js"></script>
	  	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.js"></script>
	  	<script src="//cdnjs.cloudflare.com/ajax/libs/dygraph/1.0.1/dygraph-combined.js"></script>
	 
	  	<script src="./js/dygraph-extra.js"></script>
	    
	    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css"
	    integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
	    crossorigin=""/>
	    <link rel="stylesheet" type="text/css" href="http://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/0.4.0/MarkerCluster.css" />
	  	<link rel="stylesheet" type="text/css" href="http://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/0.4.0/MarkerCluster.Default.css" />
	    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"
	    integrity="sha512-gZwIG9x3wUXg2hdXF6+rVkLF/0Vi9U8D2Ntg4Ga5I5BZpVkVxlJWbSQtXPSiUTtC0TjtGOmxa1AJPuV0CPthew=="
	    crossorigin=""></script>

	    <script src="https://unpkg.com/esri-leaflet@2.4.1/dist/esri-leaflet.js"
	    integrity="sha512-xY2smLIHKirD03vHKDJ2u4pqeHA7OQZZ27EjtqmuhDguxiUvdsOuXMwkg16PQrm9cgTmXtoxA6kwr8KBy3cdcw=="
	    crossorigin=""></script>
	    <script type='text/javascript' src='http://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.4.1/leaflet.markercluster.js'></script>

	    <script type="text/javascript">
	    	var nexrad = new L.tileLayer.wms("https://mesonet.agron.iastate.edu/cgi-bin/wms/nexrad/n0r.cgi", {
	            layers: 'nexrad-n0r',
	            format: 'image/png',
	            transparent: true,
	            attribution: "Weather data &copy; 2015 IEM Nexrad"
        	});
  
  			var qpf=L.esri.dynamicMapLayer({
	    		url: 'https://idpgis.ncep.noaa.gov/arcgis/rest/services/NWS_Forecasts_Guidance_Warnings/wpc_qpf/MapServer/1',
			    layer: [1],
			    opacity: 0.7,
			    useCors: false
			});


  			var Hurricane=L.esri.dynamicMapLayer({
	    		url: 'https://idpgis.ncep.noaa.gov/arcgis/rest/services/NWS_Forecasts_Guidance_Warnings/NHC_E_Pac_trop_cyclones/MapServer',
	    		opacity: 0.7,
	    		useCors: false
	  		});

  			var droughtsdata=L.tileLayer.wms("http://ndmc-001.unl.edu:8080/cgi-bin/mapserv.exe", {
	            map:'/ms4w/apps/usdm/service/usdm_current_wms.map',
	            layers: 'usdm_current',
	            format: 'image/png',
	            transparent: true,
	        });

	        $(document).ready(function(){
	        	$("#SensorValuesChange").hide();
			    $("#SensorValuesChangelabel").hide();
			    $("#RainLegend").hide();
			    $("#Loop").hide();
			    $("#legendRadar").hide();
			    $("#qpflegend").hide();
			    $("#droughtslegend").hide();

			    $("#sensors_list").change(function(){
				    sensor=$("#sensors_list option:selected").val();
				    if(sensor=='Rainfall Annual'||sensor=='Rain'){
				      	$("#SensorValuesChange").show();
				      	$("#SensorValuesChangelabel").show();
				    }
				    else{
				      	$("#SensorValuesChange").hide();
				      	$("#SensorValuesChangelabel").hide();
				    }
				});

			    $("#SensorValuesChange").change(function(){
			    	$("#RainLegend").show();
			    });

			    $('#Radar').click(function(){
      				var checked = $(this).is(':checked');

			      	if (checked) {
				        $("#Loop").show();
				        $("#legendRadar").show();
				        map.addLayer(nexrad);
			      	}
      				else{
				        $("#Loop").hide();
				        $("#legendRadar").hide();

				        $("#RadarLoop"). prop("checked", false);
				        for(var j=0;j<11;j++){
				          	map.removeLayer(tileSources[j]);
				        }
        				map.removeLayer(nexrad);    
      				}
    			});
			    function sleep(ms) {
			    	return new Promise(resolve => setTimeout(resolve, ms));
			    }
    			
    			var urlTemplate = 'https://mesonet.agron.iastate.edu/cache/tile.py/1.0.0/nexrad-n0q-{timestamp}/{z}/{x}/{y}.png';

    			var timestamps = ['900913-m50m', '900913-m45m', '900913-m40m', '900913-m35m', '900913-m30m', '900913-m25m', '900913-m20m', '900913-m15m', '900913-m10m', '900913-m05m', '900913'];
    
    			var tileSources = [];
    
			    for (var i = 0; i < timestamps.length; i++) {
			      	var url=urlTemplate.replace('{timestamp}', timestamps[i]);
			      	var tileSource = L.tileLayer(''+url+'');
			      	tileSources.push(tileSource);
			    }
    			
    			$('#RadarLoop').click(function(){
      				var checked = $(this).is(':checked');
			      	if (checked) {
			        	layer();
			      	}
			      	else{
			        	map.removeLayer(temp);    
			      	}
			    });
    			async function layer(){

      				for (var i = 0; i < tileSources.length; i++) {

				        var check_value=$('#RadarLoop').is(":checked");
				        var checkradarvalue=$('#Radar').is(":checked");
				        console.log(check_value);
				        
				        if(check_value){  
					        map.removeLayer(nexrad);
					        if((checkradarvalue==false)){
					            for(var j=0;j<11;j++){
					            	map.removeLayer(tileSources[j]);
					            }
					            break;
					        }
					        map.addLayer(tileSources[i]);
					        await sleep(400);
					        if(i>1){
					            if(i%2==0){
					              	tileSources.push(tileSources[i-1]);
					              	tileSources.push(tileSources[i-2]);
					              	map.removeLayer(tileSources[i-1]);
					              	map.removeLayer(tileSources[i-2]);
					            }
					        }
					    }
	        			else if((checkradarvalue==false)) {
	          				for(var j=0;j<11;j++){
	            				map.removeLayer(tileSources[j]);
	          				}
	          				tileSources.splice(11,tileSources.length-1);
	          				map.removeLayer(nexrad);
	          				break;
	        			}
	        			else if((check_value==false)) {
	          				for(var j=0;j<11;j++){
	            				map.removeLayer(tileSources[j]);
	          				}
	          				tileSources.splice(11,tileSources.length-1);
	          				map.addLayer(nexrad);
	          				break;
	        			}
        
      				}
    			}

    			$('#QPF').click(function(){
      				var checked = $(this).is(':checked');
      				if (checked) {
        				$("#qpflegend").show();
        				map.addLayer(qpf);
      				}
        			else{
          				$("#qpflegend").hide();
          				map.removeLayer(qpf);    
      				}
    			});
  
    			$('#Hurricanes').click(function(){
      				var checked = $(this).is(':checked');
      				if (checked) {
        				map.addLayer(Hurricane);
      				}
        			else{
          				map.removeLayer(Hurricane);    
      				}
    			});
    
    			$('#droughts').click(function(){
      				var checked = $(this).is(':checked');
      				if (checked) {
        				$("#droughtslegend").show();
        				map.addLayer(droughtsdata);
      				}
        			else{
          				$("#droughtslegend").hide();
				        map.removeLayer(droughtsdata);    
				    }
    			});


	        });
	    </script>

	    <style>
		  #legendRadar {
		    position: absolute;
		    bottom: 60px;
		    left: 16px;
		    z-index: 400;
		    background: white;
		    padding: 10px;
		  }
		  #qpflegend{
		    position: absolute;
		    bottom: 60px;
		    left: 16px;
		    z-index: 400;
		    background: white;
		    padding: 10px;
		  }
		  #droughtslegend{
		    position: absolute;
		    bottom: 100px;
		    left: 16px;
		    z-index: 400;
		    background: white;
		    padding: 10px;
		  }
		  /*#basemaps {
		    margin-bottom: 5px;
		  }*/
		  .sidenav1 {
		    height: 90vh;
		    width: fit-content;
		    padding: inherit;
		    /*position: fixed;*/
		    z-index: 1;
		    
		    left: 0;
		    background-color: #fff;
		    overflow-x: hidden;
		    padding-top: 20px;
		    border-right: 1px solid #00000063;
		    box-shadow: 0 0 5px rgba(0,0,0,.5);
		  }
		  @media only screen and (max-device-width: 840px)
		  {
		    .col-md-10 {
		      padding-left: 0px!important;
		      padding-right: 0px;
		    }
		    #map {
		      height: 85vh;
		    }
		  }

		  .sidenav1 a {
		    padding: 6px 8px 6px 16px;
		    text-decoration: none;
		    font-size: 25px;
		    color: #818181;
		    display: block;
		  }

		  .sidenav1 a:hover {
		    color: #f1f1f1;
		  }

		  .main {
		    margin-left: 160px; /* Same as the width of the sidenav */
		    font-size: 28px; /* Increased text to enable scrolling */
		    padding: 0px 10px;
		  }
		  
		  #map { 
		    position: relative; 
		    /*top:20vh;
		    bottom:0; 
		    right:0; */
		    /*left:1.22vw; */
		    height: 95vh; 
		    border-left: 1px solid #00000063;
		  }
		  @media screen and (max-height: 450px) {
		    .sidenav1 {padding-top: 15px;}
		    .sidenav1 a {font-size: 18px;}
		  }
		  .fullscreen-icon { 
		    background-image: url("/Hydromet/assets/images/expand.png");
		  }
		  #graph_data td{
		    font-size: 13px;
		    padding: 1px 1px 1px 3px;
		  }
		  .leaflet-popup{
		   min-width: 480;
		  }
		  .pop_th
		  {
		    background-color:#539CCC;
		    color:white;
		  }
		  .leaflet-popup{
		    cursor:pointer;
		  }
		  .leaflet-popup{
		    shadow:hidden;
		  }
		  .legend-heading {
		    font-size: 11px;
		    margin-bottom: 3px;
		    font-weight: bold;
		    font-family: Verdana,Geneva,Arial,Helvetica,sans-serif;
		    color: #055696;
		  }
		  #RainLegend .legend, #RainLegendYear .legend {
		    width: 36px;
		    text-align: center;
		    display: inline-block;
		  }
		  .legend {
		    color: #000;
		    background-color: #fff;
		    border-radius: 3px;
		    padding: 0 2px 0 2px;
		    border: 1px solid #aaa;
		    font-weight: bold;
		    font-size: 10px;
		    font-family: Verdana;
		  }
		  
		  .label1
		  {
		   color: #c8c9ce;
		   margin: 10px;
		  }
		  option
		  {
		    color: blue;
		  }
		  select
		  {
		    background-color:#4e4e52;
		    color: #4e4e52;
		  }
		  .dygraph-legend {
		    background: transparent !important;
		    left: 80px !important;
		    width: 80% !important;
		  }
		  .layer-buttons {
		    margin-bottom: 15px;
		    border: 1px solid #eee;
		    border-left: 2px solid #eee;
		  }
		  .btn-group, .btn-group-vertical {
		    position: relative;
		    display: inline-block;
		    vertical-align: middle;
		  }
		  .btn-group>.btn:first-child:not(:last-child):not(.dropdown-toggle) {
		    border-top-right-radius: 0;
		    border-bottom-right-radius: 0;
		  }
		  .pull-left {
		    float: left !important;
		  }
		  .layer-buttons .btn .glyphicon {
		    color: #ddd;
		  }
		  .pull-right {
		    float: right !important;
		  }
		  #RadarContainer{
		    padding: 0px;
		    margin-top: 10px;
		  }
		  #RadarContainer:hover{
		    color: #055696;
		    transition: transform .2s;
		  }
		</style>
	</head>
	
<body>
	<?php
	    include 'includes/header.php';
	?>
	<div class="container">
    	<div class="modal fade" id="loading_pop" role="dialog">
      		<div class="modal-dialog" style="width:283px;padding-top:200px">
      		<!-- div is divided by using the class modal-dialog with applying the required style-->
        	<!-- Modal content-->
        		<div class="">
          			<div class="modal-body"><center>
            <!-- The div an image is loaded in the center--> 
            			<img src="/Hydromet/StationImages/waitingIcon.gif"></center>
          			</div>
        		</div>
      		</div>
    	</div>
  	</div>
  	<div class="body-content outer-top-xs" id="top-banner-and-menu">
    	<div class="container-fluid">
	      	<div class="row">
	        	<div class="col-md-2 sidebar" style="padding-left: 10px;">
	          		<div class="side-menu animate-dropdown outer-bottom-xs">
	            		<nav class="yamm megamenu-horizontal" role="navigation"></nav>
	          		</div>
	          		<br>
			        <label for="basemaps" style="float: left;color: #055696;"><b>Base Map</b></label>
			        <br>
	          		<select id="basemaps" class="form-control">
			            <option value="Topographic">Topographic</option>
			            <option value="Streets">Streets</option>
			            <option value="NationalGeographic">National Geographic</option>
			            <option value="Oceans">Oceans</option>
			            <option value="Gray">Gray</option>
			            <option value="DarkGray">Dark Gray</option>
			            <option value="Imagery">Imagery</option>
			            <option value="ImageryClarity">Imagery (Clarity)</option>
			            <option value="ImageryFirefly">Imagery (Firefly)</option>
			            <option value="ShadedRelief">Shaded Relief</option>
			            <option value="Physical">Physical</option>
			            <option value="googleStreets">Google Streets</option>
	          		</select>  
	          		<br>    
		        	<label for="list_of_stns" style="float: left;color: #055696;"><b>Station</b></label>
		          	<br>
	          		<select class="form-control" id="list_of_stns">
	            		<option disabled selected>Select</option>

		            	<?php
		              		if($company=='Hydromet'){
		                		$sql="SELECT DISTINCT \"StationFullName\",\"lat\",\"lon\" from \"tblStationLocation\" order by \"StationFullName\"";
		              		}
		              		else{

		                		$sql="SELECT DISTINCT \"StationFullName\",lat,lon from \"tblStationLocation\", \"tblCompany2Station\" where \"Station\" = \"StationShefCode\" and \"Company\" = '$company' order by \"StationFullName\"";
		              		}

		              		$result_set=pg_query($sql);
		              		
		              		while ($row_stn=pg_fetch_array($result_set)) {
		              		?>
		                
		                		<option value="<?php echo $row_stn[1]."#".$row_stn[2]; ?>" <?php if (isset($_GET['station'])) {
		                  		if(trim($_GET['station'])==trim($row_stn[0]))
		                    		echo "selected";
		                  		}?> ><?php echo $row_stn[0]; ?></option>
		                	<?php
		              		}
		            	?>
	          		</select>
	          		<br>
	          		<label for="sensors_list" style="float: left;color: #055696;"><b>Sensors</b></label>
	          		<br>
	          		<select  class="form-control" id="sensors_list">
			            <!-- list of different sensor are shown in this column -->
			            <option disabled selected>select</option>
			            <?php
			              	if($company=='Hydromet'){
			                	$sql="Select distinct \"Sensor\" as \"SensorName\" from \"SensorValues\" order by \"Sensor\"";
			              	}
			              	else{
			                	$sql="Select distinct sv.\"Sensor\" as \"SensorName\" from \"SensorValues\" sv, \"tblCompany2Station\" c2s, \"tblStationLocation\" sl where sv.\"StationFullName\" = sl.\"StationFullName\" and c2s.\"Station\" = sl.\"StationShefCode\" and c2s.\"Company\" = '$company' order by \"Sensor\"";
			              	}
			              	$result_set=pg_query($sql);
			              	while ($row=pg_fetch_array($result_set)) {
				              	?>
				                	<option value="<?php echo $row[0];?>" <?php if (isset($_GET['sensor'])) {
				                	if(trim($_GET['sensor'])==trim($row[0]))
				                    	echo "selected";
				                  	}
				                  	else{
				                    	if($row[0]=='Stage'){
				                      		echo "selected";
				                    	}
				                  	}
				                	?>><?php echo $row[0]; ?></option>
				                <?php
			              	}
	            		?>
	          		</select>
	          		<br>
	          		<label for="maplayer" style="float: left;color: #055696;"><b>Map Layer</b></label>
	          		<br>
	          		<div class="">
		            	<label id="RadarContainer" name="Radar" class="btn btn-default layer-list-item active" style="width: 100%;background-color: #fff;border:none;box-shadow: none;">
		              		<input id="Radar" class="pull-right" type="checkbox" autocomplete="off"> <span class="btn-text pull-left"><b>Current radar</b></span>
		            	</label>
		            	<ul id="Loop" style="padding-left: 15px;list-style: none;margin-bottom: 0px;">
			              	<li>
			                	<label id="RadarContainer" name="RadarLoop" class="btn btn-default layer-list-item active" style="width: 100%;background-color: #fff;border:none;box-shadow: none;">
			                  		<input id="RadarLoop" class="pull-right" type="checkbox" autocomplete="off"> <span class="btn-text pull-left"><b>Radar Loop</b></span>
			                	</label>
			              	</li>
		            	</ul>
		            	<label id="RadarContainer" name="Radar" class="btn btn-default layer-list-item active" style="width: 100%;background-color: #fff;border:none;box-shadow: none;">
		              		<input id="QPF" class="pull-right" type="checkbox" autocomplete="off"> <span class="btn-text pull-left"><b>QPF</b></span>
		            	</label>
		            	<label id="RadarContainer" name="Radar" class="btn btn-default layer-list-item active" style="width: 100%;background-color: #fff;border:none;box-shadow: none;">
		              		<input id="Hurricanes" class="pull-right" type="checkbox" autocomplete="off"> <span class="btn-text pull-left"><b>Hurricanes</b></span>
		            	</label>
		            	<label id="RadarContainer" name="Radar" class="btn btn-default layer-list-item active" style="width: 100%;background-color: #fff;border:none;box-shadow: none;">
		              		<input id="droughts" class="pull-right" type="checkbox" autocomplete="off"> <span class="btn-text pull-left"><b>Droughts</b></span>
		              	</label>
		          	</div>
		          	<br>
		          	<label id="SensorValuesChangelabel" for="SensorValuesChange" style="float: left;color: #055696;"><b>Precipitation</b></label>
			        <select class="form-control" id="SensorValuesChange" style="width: 220px;height: 31px">
			            <option disabled>select</option>
			            <option value="rain" selected>Rainfall - most recent</option>
			            <option value="rain1">Rainfall - past hour</option>
			            <option value="rain2">Rainfall - past 2 hours</option>
			            <option value="rain3">Rainfall - past 3 hours</option>
			            <option value="rain6">Rainfall - past 6 hours</option>
			            <option value="rain12">Rainfall - past 12 hours</option>
			            <option value="rain24">Rainfall - past 24 hours</option>
			            <option value="rain48">Rainfall - past 48 hours</option>
			            <option value="rain72">Rainfall - past 3 days</option>
			            <option value="rain96">Rainfall - past 4 days</option>
			            <option value="rain120">Rainfall - past 5 days</option>
			            <option value="rain168">Rainfall - past week</option>
			            <option value="rain336">Rainfall - past 2 weeks</option>
			            <option value="rain720">Rainfall - past 30 days</option>
			            <option value="rainMonth">Rainfall - this month</option>
			            <option value="rainYear">Rainfall - this year</option>
			            <option value="rainPrevYear">Rainfall - previous year</option>
			        </select> 
		        	<br>
			        <div id="RainLegend" class="legend-container" style="display: block;">
			            <div class="legend-heading"><span class="LegendType"><b>Rainfall Change</b></span>(inches)</div>
			            <?php
			            	$file = fopen("includes/rain-color.txt", "r");
			              	$filedata = array();

			              	while (!feof($file)) {
			                	$filedata[] = fgets($file);
			              	}

			              	fclose($file);
			              	for($o=0;$o<count($filedata);$o++){
			                	$splitdata=explode("-", $filedata[$o]);
			                	?>
			                  		<span class="legend" style="background-color: <?php echo $splitdata[1]; ?>"><?php echo $splitdata[0]; ?></span>
			                	<?php
			              	}
			            ?>
			            <br> <br>
			        </div>
		        	<input type='hidden' id='date_format' value=''>
		    	</div>
		        <div class="col-md-10" style="padding-right: 0px;">
		            <table style="width: 100%;height: 78%;vertical-align: top;">
		              	<tr>
			                <td style="padding: 0px;">
			                <div id="map" onload = "JavaScript:AutoRefresh(5000);"></div>
			                <div id="legendRadar" class="radarLegend" style="visibility: visible;"><img alt="radar legend" src="Images/radarlegend.jpg"><br><span class="datadate" id="radarTime"></span><br>
			                </div>
			                <div id="qpflegend" class="qpflegend" style="visibility: visible;"><span style="text-align: center;font-size: 15px;font-family: initial;font-weight: bold;padding-left: inherit;">QPF</span><br><img alt="qpf legend" src="Images/qpflegend.png"><br><span class="datadate" id="qpfTime"></span><br>
			                </div>
			                <div id="droughtslegend" class="droughtlegend" style="visibility: visible;"><span style="text-align: center;font-size: 15px;font-family: initial;font-weight: bold;padding-left: inherit;padding-bottom: inherit;">Current Droughts Data</span><br><img alt="qpf legend" src="Images/drought.png"><br>
			                </div>
			                <div id="loading_div">
			                </div>
			                </td>
			                <td style="width: 1;vertical-align: top;background-color: white;height: 78%;padding: 0px;">
			                  	<div id="graph_div" style="display: none;overflow-y: scroll;height: 100%;margin-top: 5px;border-left: 2px solid;">
				                    <a href="javascript:popUp()">
				                      	<img src="assets\images\popup.png" style="width: 20;height: 20;" />Pop Up
				                    </a>

				                    <a href="javascript:refresh_map(this)">
				                      	<img src="assets\images\refresh.png" style="width: 20;height: 20;"/>Refresh
				                    </a>

				                    <a href="javascript:zoomOnSite()">
				                      	<img src="assets\images\zoom.png" style="width: 20;height: 20;"/>Zoom On Site
				                    </a>

				                    <button type="button" class="close" onclick="close_graph()" id="close_g">&times;</button>

				                    <h4 style="margin-left: 5%;"  id="graphHeader"></h4>
				                    <br>
			                    	<div id="graph" >
			                    		<center>
			                      			<img src="/Hydromet/StationImages/waitingIcon.gif">
			                    		</center>
			                  		</div>
			                  		<br>
			                  		<table id="graph_data" style="width: 100%;" class="table table-bordered"></table>
			                  	</div>
			                </td>
		              	</tr>
		            </table>
		        </div>
	      	</div>
    	</div>
  	</div>
  	<script>
    	var text_dataz=[];
    	var text_data=[];
    	var latlong = $.ajax({
          	'url':'./lat_lon_zoom.txt',
        	global: false,
          	async:false,
          	'success': function (data){
            	obj=data.split('\n'); 
            	for(var i=0;i<obj.length;i++)
            	{
              		text_data[i]=obj[i].split(':');
            	}
            	dataz=text_data[0][1]+'#'+text_data[1][1]+'#'+text_data[2][1];
            	return dataz;      
          	}
        }).responseText;

    	output=latlong.split('\n');
    	for(var i=0;i<obj.length;i++)
    	{
      		text_dataz[i]=output[i].split(':');
    	}
    	// var map = L.map('map').setView([text_data[0][1], text_data[1][1]], text_dataz[2][1]);
    	var map = L.map('map').setView([text_data[0][1], text_data[1][1]], 4);
    	var layer = L.esri.basemapLayer('Topographic').addTo(map);
    	L.control.scale({ position: 'bottomleft' }).addTo(map);
        // var layer = L.esri.basemapLayer('Topographic').addTo(map);
        markerClusters =L.markerClusterGroup({maxClusterRadius: 40});
    	var layerLabels;
    	var googleStreets = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
        	maxZoom: 20,
          	subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
        });
    	function setBasemap (basemap) {
    		if (layer) {
	      		map.removeLayer(layer);
	    	}
	    	if(googleStreets){
	      		map.removeLayer(googleStreets);
	    	}
	    	if(basemap==='googleStreets'){
	      		googleStreets.addTo(map);
	    	}
	    	else{
	      		layer = L.esri.basemapLayer(basemap);

	      		map.addLayer(layer);

	      		if (layerLabels) {
		        	map.removeLayer(layerLabels);
		      	}

		      	if (basemap === 'ShadedRelief' || basemap === 'Oceans' || basemap === 'Gray' || basemap === 'DarkGray' || basemap === 'Terrain') {
		        	
		        	layerLabels = L.esri.basemapLayer(basemap + 'Labels');
		        	map.addLayer(layerLabels);
		      	} 
		      	else if (basemap.includes('Imagery')) {
		        	layerLabels = L.esri.basemapLayer('ImageryLabels');
		        	map.addLayer(layerLabels);
		      	}
	    	}
	    }
    	document.querySelector('#basemaps').addEventListener('change', function (e) {
        	var basemap = e.target.value;
        	setBasemap(basemap);
      	});
    	

    	
  </script>
</body>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script> 
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js" type="text/javascript"></script> 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</html>