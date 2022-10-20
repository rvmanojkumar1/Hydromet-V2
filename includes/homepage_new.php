<?php
  //include ('database.php');
  session_start();
  include_once 'includes/editCompany.php';

  $company=$_SESSION["company"];
?>
<!DOCTYPE php>
<html>
<head>
  <?php
    include("includes/link.php");
  ?>
  
  <link rel="stylesheet" href="./custom/bootstrap.min.css" />
  <!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous" />-->
   <link rel="stylesheet" href="./custom/bootstrap-theme.min.css" />
  <link rel="stylesheet" href="./assets/jquery-ui-latest.min.css">
  <link rel="stylesheet" type="text/css" href="assets/Control.FullScreen.css">
  <script type="text/javascript" src="./assets/Control.FullScreen.js"></script>

  <link rel="stylesheet" type="text/css" href="./assets/css/MyTable.css">
  <script type="text/javascript" src="./assets/jquery-3.6.0.min.js"></script>
  <script type="text/javascript" src="./assets/jquery-ui-latest.min.js"></script>
  <script src="./js/momentv2.17.1.js"></script>
  <script src="./custom/dygraph-combined.js"></script>
 
<script src="./js/dygraph-extra.js"></script>
  <!-- Load Leaflet from CDN -->
  <link rel="stylesheet" href="./assets/leaflet-v1.6.0/leaflet.css"/>
  <link rel="stylesheet" type="text/css" href="./assets/leaflet-v1.6.0/0.4.0MarkerCluster.css" />
<link rel="stylesheet" type="text/css" href="./assets/leaflet-v1.6.0/0.4.0MarkerCluster.Default.css" />
  <script src="./assets/leaflet-v1.6.0/leaflet.js"></script>
  <script src="./assets/leaflet-v1.6.0/leaflet-kmz.js"></script>
  <script src="./assets/leaflet-v1.6.0/2.4.1esri-leaflet.js"></script>
  <script type='text/javascript' src='./assets/leaflet-v1.6.0/1.4.1leaflet.markercluster.js'></script>
  <!-- <link rel="stylesheet" href="https://unpkg.com/leaflet@1.6.0/dist/leaflet.css" /> -->
    <!-- <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script> -->
</head>
<style>
 .leaflet-interactive{
 	stroke-opacity: 0.4 !important;
    fill-opacity: 0.4 !important;
 }
 .col-md-2{
    height: 90vh;
    width: fit-content;
    overflow-y: auto;
 }
  #legendRadar {
    position: absolute;
    bottom: 60px;
    left: 1px;
    z-index: 400;
    background: white;
    padding: 10px;
  }
  #HurricaneLegend{
    position: absolute;
    bottom: 80px;
    left: 1px;
    z-index: 400;
    background: white;
    padding: 10px; 
  }
  #qpflegend{
    position: absolute;
    bottom: 60px;
    left: 1px;
    z-index: 400;
    background: white;
    padding: 10px;
  }
  #droughtslegend{
    position: absolute;
    bottom: 100px;
    left: 1px;
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
  #Hurricane-subs{
    padding: 0px;
    margin-top: 2px;
    margin-bottom: 2px;
  }
  #Hurricane-sub{
    padding: 0px;
    margin-top: 2px;
    margin-bottom: 2px;
  }
  #RadarContainer:hover{
    color: #055696;
    transition: transform .2s;
  }
</style>
<?php

  if (!isset($_GET['sensor'])) {
    pg_query("update \"tblStationLocation\" set \"CurrentValue\"=''");
    updatecurrentValues("Stage");
  }
  else
  {
    echo $_GET['sensor'];
    pg_query("update \"tblStationLocation\" set \"CurrentValue\"=''");
    updatecurrentValues(trim($_GET['sensor']));
  }

  $settings=pg_fetch_array(pg_query("select \"DateFormat\",\"DecimalPlaces\" from \"tblLogo\"")); 
  if($company=='Hydromet'){
    $result=pg_query("select DISTINCT \"CurrentValue\",\"lat\",\"lon\",\"StationShefCode\",\"AlarmFlag\" from \"tblStationLocation\"");
  }
  else{
    $result=pg_query("select DISTINCT \"CurrentValue\",\"lat\",\"lon\",\"StationShefCode\",\"AlarmFlag\" from \"tblStationLocation\", \"tblCompany2Station\" where \"StationShefCode\" = \"Station\" and \"Company\" = '$company'");
  }

  $output=[];
  $data=[];
  while ($row=pg_fetch_array($result)) {
    $output[]=number_format(floatval($row[0]),$settings[1])."#".$row[1]."#".$row[2]."#".$row[3]."#".$row[4];
    $tem=table(trim($row[3]));
    $data[]=$tem;
    if (trim($row[0])!="") {
    }
    else{
    }
  }
  $z=0;
?>
<script>
  var latitude;
  var longitude;
  var zoom;



  var nexrad = new L.tileLayer.wms("https://mesonet.agron.iastate.edu/cgi-bin/wms/nexrad/n0r.cgi", {
            layers: 'nexrad-n0r',
            format: 'image/png',
            transparent: true,
            opacity:0.5,
            attribution: "Weather data &copy; 2015 IEM Nexrad"
        });
  
 /* var qpf=L.esri.dynamicMapLayer({
    url: 'https://idpgis.ncep.noaa.gov/arcgis/rest/services/NWS_Forecasts_Guidance_Warnings/wpc_qpf/MapServer/1',
    //layer: [1],
    opacity: 0.7,
    useCors: false
  });
  
  
    
  // map.addLayer(qpf);
  // map.removeLayer(qpf);


  var Hurricane=L.esri.dynamicMapLayer({
    url: 'https://idpgis.ncep.noaa.gov/arcgis/rest/services/NWS_Forecasts_Guidance_Warnings/NHC_E_Pac_trop_cyclones/MapServer',
    opacity: 0.7,
    useCors: false
  });*/

  function checknumber(ex){
    if(ex<10){
            var numfi="0"+String(ex);
          }
          else{
            var numfi=String(ex);
          }
          return numfi;
  }
  function formatDate(date){
  var date=new Date();
  var hours = date.getHours();
  var minutes = date.getMinutes();
  var ampm = hours >= 12 ? 'pm' : 'am';
  hours = hours % 12;
  hours = hours ? hours : 12; // the hour '0' should be '12'

  if(minutes<'10'){
    if(minutes=='0'){
      minutes='00';
    }
    else{
      minutes='0'+minutes;
    }
  }
  // minutes = minutes < '10' ? '0'+minutes : minutes;
  var strTime = hours + ':' + minutes + ' ' + ampm;
  return strTime;
  }
  var droughtsdata=L.tileLayer.wms("http://ndmc-001.unl.edu:8080/cgi-bin/mapserv.exe", {
            map:'/ms4w/apps/usdm/service/usdm_current_wms.map',
            layers: 'usdm_current',
            format: 'image/png',
            transparent: true,
            opacity:0.5
            // attribution: "Weather data &copy; 2015 IEM Nexrad"
        });
  $(document).ready(function(){
    $("#SensorValuesChange").hide();
    $("#SensorValuesChangelabel").hide();
    $("#RainLegend").hide();
    $("#Loop").hide();
    $("#legendRadar").hide();
    $("#qpflegend").hide();
    $("#droughtslegend").hide();
    $("#HurricaneSub").hide();
    $("#HurricaneLegend").hide();
    var output=[];
    var data=[];
    sensor=$("#sensors_list option:selected").val();
    if(sensor=='Rainfall Annual'||sensor=='Rain'){
      $("#SensorValuesChange").show();
      $("#SensorValuesChangelabel").show();
    }
    else{
      $("#SensorValuesChange").hide();
      $("#SensorValuesChangelabel").hide();
      $("#RainLegend").hide();
    }
    $("#loading_pop").modal({backdrop: false});

    /*$.ajax({
      url: 'includes/updateStationLocationCurrentValue.php',
      data:{'sensor':'Stage'},
      type:'post',
      success: function(result){
        $.ajax({
          url: 'includes/setMarkers.php',
          type:'post',
          success: function(result2){
            var json=JSON.parse(result2);
            for(var x in json)
            {      
              output.push(json[x]);
            }
            $.ajax({
              url: 'includes/setTable.php',
              type:'post',
              success: function(result3){
                $('#loading_pop').modal('hide');
                var json=JSON.parse(result3);
                for(var x in json)
                {
                  data.push(json[x]);
                }
                // debugger;
                console.log("-1434");
                setMarkers(output,data);
              }
            });
          }
        });
      }
    });*/
    <?php 

    $output=setMarker(); 
   $data=setTable();
    UpdatestationLocation();
    if(isset($output)&&isset($data)){
    echo ' output='.$output.';
      data='.$data.';
    ';
  }
    ?>
    $.ajax({
              url: 'includes/dummy.txt',
              type:'head',
              success: function(result3){
                $('#loading_pop').modal('hide');
               
                setMarkers(output,data);
              }
            });
    
    $('#Radar').click(function(){
      var checked = $(this).is(':checked');

      if (checked) {
        $("#Loop").show();
        $("#legendRadar").show();
        time=formatDate(new Date);
        document.getElementById("radarTime").innerHTML="<b>"+time+"</b>";
        // debugger;
        map.addLayer(nexrad);
      }
      else{
        $("#Loop").hide();
        $("#legendRadar").hide();

        $("#RadarLoop").prop("checked", false);
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
      // console.log(url)
      var tileSource = L.tileLayer(''+url+'',{opacity:0.4});
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
    	var time=formatDate(new Date);
			var a=time.split(":");
			var b=a[1].split(" ");
			var h=parseInt(a[0]);
			var m=parseInt(b[0]);
			var ap=b[1];
			var sd,oh;
			if(m>50)
			{
          	m=m-50;
          	var ex=m;
          	sd=ex;
            oh=h;
          }
          else{
          	var ex=m+10;
          		sd=ex;
          	   h=h-1;
          	   oh=h;
          }
          var c=0;

      for (var i = 0; i < tileSources.length; i++) {
        var check_value=$('#RadarLoop').is(":checked");
        var checkradarvalue=$('#Radar').is(":checked");
        // console.log(check_value);
        
        if(check_value){  
          map.removeLayer(nexrad);
          if((checkradarvalue==false)){
            for(var j=0;j<11;j++){
              map.removeLayer(tileSources[j]);
            }
            break;
          }
         
          map.addLayer(tileSources[i]);



         document.getElementById("radarTime").innerHTML="<b>"+h+":"+checknumber(ex)+" "+ap+"</b>"; 
         
          if(ex<60){
          	ex=ex+5;
          	c=c+5;
          
          	if(ex>=60){
          		ex=ex-60;
              
          		h=h+1;
          	}
          	if(c==50){
          		ex=sd;
          		h=oh;
          		c=0;
          	}
          }
         await sleep(400);
      		
          if(i>0){
          	
          	 map.removeLayer(tileSources[i-1]);
          }
         if(i==10){
         	
          	map.removeLayer(tileSources[i]);
          	
          	i=0;
          }
         /* if(i>1){
            if(i%2==0){
              tileSources.push(tileSources[i-1]);
              tileSources.push(tileSources[i-2]);
              map.removeLayer(tileSources[i-1]);
              map.removeLayer(tileSources[i-2]);
            }
          }*/
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
          time=formatDate(new Date);
        document.getElementById("radarTime").innerHTML="<b>"+time+"</b>";
          break;
        }
        
      }
    }
    //initialization
    function fetchfile(url) {
        try {
            var txtFile=new XMLHttpRequest();

            txtFile.open("GET", url, true);  
         txtFile.onreadystatechange = function()   
         {  
              if (txtFile.readyState === 4)   
              {   
                   if (txtFile.status === 200)   
                   {    
                    document.getElementById("qpfTime").innerHTML="<small>Last Updated on</small><b> "+txtFile.responseText+"</b>";
                
                   }  
              }  
         }  
         txtFile.send(null)  

        } catch(er) {
            return er.message;
        }
    }
    
    var qpf = L.kmzLayer().addTo(map);
  
    var EP1FP=L.kmzLayer().addTo(map);
    var EP1FT=L.kmzLayer().addTo(map);
    var EP1FC=L.kmzLayer().addTo(map);

    var EP2FP=L.kmzLayer().addTo(map);
    var EP2FT=L.kmzLayer().addTo(map);
    var EP2FC=L.kmzLayer().addTo(map);

    var EP3FP=L.kmzLayer().addTo(map);
    var EP3FT=L.kmzLayer().addTo(map);
    var EP3FC=L.kmzLayer().addTo(map);

    var EP4FP=L.kmzLayer().addTo(map);
    var EP4FT=L.kmzLayer().addTo(map);
    var EP4FC=L.kmzLayer().addTo(map);

    var EP5FP=L.kmzLayer().addTo(map);
    var EP5FT=L.kmzLayer().addTo(map);
    var EP5FC=L.kmzLayer().addTo(map);

    var AT1FP=L.kmzLayer().addTo(map);
    var AT1FT=L.kmzLayer().addTo(map);
    var AT1FC=L.kmzLayer().addTo(map);

    var AT2FP=L.kmzLayer().addTo(map);
    var AT2FT=L.kmzLayer().addTo(map);
    var AT2FC=L.kmzLayer().addTo(map);

    var AT3FP=L.kmzLayer().addTo(map);
    var AT3FT=L.kmzLayer().addTo(map);
    var AT3FC=L.kmzLayer().addTo(map);

    var AT4FP=L.kmzLayer().addTo(map);
    var AT4FT=L.kmzLayer().addTo(map);
    var AT4FC=L.kmzLayer().addTo(map);

    var AT5FP=L.kmzLayer().addTo(map);
    var AT5FT=L.kmzLayer().addTo(map);
    var AT5FC=L.kmzLayer().addTo(map);
      
    var PW34KT=L.kmzLayer().addTo(map);
    var PW50KT=L.kmzLayer().addTo(map);
    var PW64KT=L.kmzLayer().addTo(map);

    $('#QPF').click(function(){
      var checked = $(this).is(':checked');
      if (checked) {
      	
    	qpf.load('/HydrometV2/Layers/QPF_Layer_Download/qpf24.kmz');
   		 map.addLayer(qpf);
   	    $("#qpflegend").show();
           $("#qpfTime").show();
          fetchfile("/HydrometV2/Layers/QPF_Layer_Download/qpfdownloadtime.txt");
      
        
        // $("#QPFsubs").show();
       // map.addLayer(qpf);
      }
        else{
        	map.removeLayer(qpf);
          $("#qpflegend").hide();
          // $("#QPFsubs").hide();
          $("#qpfTime").hide();
          document.getElementById("qpfTime").innerHTML="";
      }
    });
    

    $('#Hurricanes').click(function(){
      var checked = $(this).is(':checked');
      if (checked) {
        $("#HurricaneLegend").show();
        $("#HurricaneSub").show();

        EP1FP.load('/HydrometV2/Layers/Hurricane_Layer_Download/EasternPacific/Pacific_EP1FP.kmz');
        map.addLayer(EP1FP);
        EP1FT.load('/HydrometV2/Layers/Hurricane_Layer_Download/EasternPacific/Pacific_EP1FT.kmz');
        map.addLayer(EP1FT);
        EP1FC.load('/HydrometV2/Layers/Hurricane_Layer_Download/EasternPacific/Pacific_EP1FC.kmz');
        map.addLayer(EP1FC);
        EP2FP.load('/HydrometV2/Layers/Hurricane_Layer_Download/EasternPacific/Pacific_EP2FP.kmz');
        map.addLayer(EP2FP);
        EP2FT.load('/HydrometV2/Layers/Hurricane_Layer_Download/EasternPacific/Pacific_EP2FT.kmz');
        map.addLayer(EP2FT);
        EP2FC.load('/HydrometV2/Layers/Hurricane_Layer_Download/EasternPacific/Pacific_EP2FC.kmz');
        map.addLayer(EP2FC);
        EP3FP.load('/HydrometV2/Layers/Hurricane_Layer_Download/EasternPacific/Pacific_EP3FP.kmz');
        map.addLayer(EP3FP);
        EP3FT.load('/HydrometV2/Layers/Hurricane_Layer_Download/EasternPacific/Pacific_EP3FT.kmz');
        map.addLayer(EP3FT);
        EP3FC.load('/HydrometV2/Layers/Hurricane_Layer_Download/EasternPacific/Pacific_EP3FC.kmz');
        map.addLayer(EP3FC);
        EP4FP.load('/HydrometV2/Layers/Hurricane_Layer_Download/EasternPacific/Pacific_EP4FP.kmz');
        map.addLayer(EP4FP);
        EP4FT.load('/HydrometV2/Layers/Hurricane_Layer_Download/EasternPacific/Pacific_EP4FT.kmz');
        map.addLayer(EP4FT);
        EP4FC.load('/HydrometV2/Layers/Hurricane_Layer_Download/EasternPacific/Pacific_EP4FC.kmz');
        map.addLayer(EP4FC);
        EP5FP.load('/HydrometV2/Layers/Hurricane_Layer_Download/EasternPacific/Pacific_EP5FP.kmz');
        map.addLayer(EP5FP);
        EP5FT.load('/HydrometV2/Layers/Hurricane_Layer_Download/EasternPacific/Pacific_EP5FT.kmz');
        map.addLayer(EP5FT);
        EP5FC.load('/HydrometV2/Layers/Hurricane_Layer_Download/EasternPacific/Pacific_EP5FC.kmz');
        map.addLayer(EP5FC);

        AT1FP.load('/HydrometV2/Layers/Hurricane_Layer_Download/Atlantic/Atlantic_AT1FP.kmz');
        map.addLayer(AT1FP);
        AT1FT.load('/HydrometV2/Layers/Hurricane_Layer_Download/Atlantic/Atlantic_AT1FT.kmz');
        map.addLayer(AT1FT);
        AT1FC.load('/HydrometV2/Layers/Hurricane_Layer_Download/Atlantic/Atlantic_AT1FC.kmz');
        map.addLayer(AT1FC);
        AT2FP.load('/HydrometV2/Layers/Hurricane_Layer_Download/Atlantic/Atlantic_AT2FP.kmz');
        map.addLayer(AT2FP);
        AT2FT.load('/HydrometV2/Layers/Hurricane_Layer_Download/Atlantic/Atlantic_AT2FT.kmz');
        map.addLayer(AT2FT);
        AT2FC.load('/HydrometV2/Layers/Hurricane_Layer_Download/Atlantic/Atlantic_AT2FC.kmz');
        map.addLayer(AT2FC);
        AT3FP.load('/HydrometV2/Layers/Hurricane_Layer_Download/Atlantic/Atlantic_AT3FP.kmz');
        map.addLayer(AT3FP);
        AT3FT.load('/HydrometV2/Layers/Hurricane_Layer_Download/Atlantic/Atlantic_AT3FT.kmz');
        map.addLayer(AT3FT);
        AT3FC.load('/HydrometV2/Layers/Hurricane_Layer_Download/Atlantic/Atlantic_AT3FC.kmz');
        map.addLayer(AT3FC);
        AT4FP.load('/HydrometV2/Layers/Hurricane_Layer_Download/Atlantic/Atlantic_AT4FP.kmz');
        map.addLayer(AT4FP);
        AT4FT.load('/HydrometV2/Layers/Hurricane_Layer_Download/Atlantic/Atlantic_AT4FT.kmz');
        map.addLayer(AT4FT);
        AT4FC.load('/HydrometV2/Layers/Hurricane_Layer_Download/Atlantic/Atlantic_AT4FC.kmz');
        map.addLayer(AT4FC);
        AT5FP.load('/HydrometV2/Layers/Hurricane_Layer_Download/Atlantic/Atlantic_AT5FP.kmz');
        map.addLayer(AT5FP);
        AT5FT.load('/HydrometV2/Layers/Hurricane_Layer_Download/Atlantic/Atlantic_AT5FT.kmz');
        map.addLayer(AT5FT);
        AT5FC.load('/HydrometV2/Layers/Hurricane_Layer_Download/Atlantic/Atlantic_AT5FC.kmz');
        map.addLayer(AT5FC);

        
        $("#EP").prop("checked", true);

        $("#EP1").prop("checked", true);
        $("#EP1FP").prop("checked", true);
        $("#EP1FT").prop("checked", true);
        $("#EP1FC").prop("checked", true);

        $("#EP2").prop("checked", true);
        $("#EP2FP").prop("checked", true);
        $("#EP2FT").prop("checked", true);
        $("#EP2FC").prop("checked", true);

        $("#EP3").prop("checked", true);
        $("#EP3FP").prop("checked", true);
        $("#EP3FT").prop("checked", true);
        $("#EP3FC").prop("checked", true);

        $("#EP4").prop("checked", true);
        $("#EP4FP").prop("checked", true);
        $("#EP4FT").prop("checked", true);
        $("#EP4FC").prop("checked", true);

        $("#EP5").prop("checked", true);
        $("#EP5FP").prop("checked", true);
        $("#EP5FT").prop("checked", true);
        $("#EP5FC").prop("checked", true);
        
        $("#AT").prop("checked", true);

        $("#AT1").prop("checked", true);
        $("#AT1FP").prop("checked", true);
        $("#AT1FT").prop("checked", true);
        $("#AT1FC").prop("checked", true);

        $("#AT2").prop("checked", true);
        $("#AT2FP").prop("checked", true);
        $("#AT2FT").prop("checked", true);
        $("#AT2FC").prop("checked", true);

        $("#AT3").prop("checked", true);
        $("#AT3FP").prop("checked", true);
        $("#AT3FT").prop("checked", true);
        $("#AT3FC").prop("checked", true);

        $("#AT4").prop("checked", true);
        $("#AT4FP").prop("checked", true);
        $("#AT4FT").prop("checked", true);
        $("#AT4FC").prop("checked", true);

        $("#AT5").prop("checked", true);
        $("#AT5FP").prop("checked", true);
        $("#AT5FT").prop("checked", true);
        $("#AT5FC").prop("checked", true);
        
      }
      else{
        $("#HurricaneLegend").hide();
        $("#HurricaneSub").hide();

        map.removeLayer(EP1FP);
        map.removeLayer(EP1FT);
        map.removeLayer(EP1FC);

        map.removeLayer(EP2FP);
        map.removeLayer(EP2FT);
        map.removeLayer(EP2FC);

        map.removeLayer(EP3FP);
        map.removeLayer(EP3FT);
        map.removeLayer(EP3FC);

        map.removeLayer(EP4FP);
        map.removeLayer(EP4FT);
        map.removeLayer(EP4FC);

        map.removeLayer(EP5FP);
        map.removeLayer(EP5FT);
        map.removeLayer(EP5FC);

        map.removeLayer(AT5FC);
        map.removeLayer(AT5FT);
        map.removeLayer(AT5FP);

        map.removeLayer(AT4FC);
        map.removeLayer(AT4FT);
        map.removeLayer(AT4FP);

        map.removeLayer(AT3FC);
        map.removeLayer(AT3FT);
        map.removeLayer(AT3FP);

        map.removeLayer(AT2FC);
        map.removeLayer(AT2FT);
        map.removeLayer(AT2FP);

        map.removeLayer(AT1FC);
        map.removeLayer(AT1FT);
        map.removeLayer(AT1FP);
        
        
        
        $("#EP").prop("checked", false);

        $("#EP1").prop("checked", false);
        $("#EP1FP").prop("checked", false);
        $("#EP1FT").prop("checked", false);
        $("#EP1FC").prop("checked", false);

        $("#EP2").prop("checked", false);
        $("#EP2FP").prop("checked", false);
        $("#EP2FT").prop("checked", false);
        $("#EP2FC").prop("checked", false);

        $("#EP3").prop("checked", false);
        $("#EP3FP").prop("checked", false);
        $("#EP3FT").prop("checked", false);
        $("#EP3FC").prop("checked", false);

        $("#EP4").prop("checked", false);
        $("#EP4FP").prop("checked", false);
        $("#EP4FT").prop("checked", false);
        $("#EP4FC").prop("checked", false);

        $("#EP5").prop("checked", false);
        $("#EP5FP").prop("checked", false);
        $("#EP5FT").prop("checked", false);
        $("#EP5FC").prop("checked", false);
        
        $("#AT").prop("checked", false);

        $("#AT1").prop("checked", false);
        $("#AT1FP").prop("checked", false);
        $("#AT1FT").prop("checked", false);
        $("#AT1FC").prop("checked", false);

        $("#AT2").prop("checked", false);
        $("#AT2FP").prop("checked", false);
        $("#AT2FT").prop("checked", false);
        $("#AT2FC").prop("checked", false);

        $("#AT3").prop("checked", false);
        $("#AT3FP").prop("checked", false);
        $("#AT3FT").prop("checked", false);
        $("#AT3FC").prop("checked", false);

        $("#AT4").prop("checked", false);
        $("#AT4FP").prop("checked", false);
        $("#AT4FT").prop("checked", false);
        $("#AT4FC").prop("checked", false);

        $("#AT5").prop("checked", false);
        $("#AT5FP").prop("checked", false);
        $("#AT5FT").prop("checked", false);
        $("#AT5FC").prop("checked", false);
        
      }
    });
    
    $("#PW34KT").click(function(){
      var checked=$(this).is(':checked');
      if(checked){
        $("#PW50KT").prop("checked",false);
        $("#PW64KT").prop("checked",false);
        PW34KT.load('/HydrometV2/Layers/Hurricane_Layer_Download/Atlantic/PW34KT.kmz');
        map.addLayer(PW34KT);
        PW50KT.removeLayer(map);
        PW64KT.removeLayer(map);
      }
      else{
        PW34KT.removeLayer(map);
      }
    });
    $("#PW50KT").click(function(){
      var checked=$(this).is(':checked');
      if(checked){
        $("#PW34KT").prop("checked",false);
        $("#PW64KT").prop("checked",false);
        PW50KT.load('/HydrometV2/Layers/Hurricane_Layer_Download/Atlantic/PW50KT.kmz');
        map.addLayer(PW50KT);
        PW34KT.removeLayer(map);
        PW64KT.removeLayer(map);
      }
      else{
        PW50KT.removeLayer(map);
      }
    });
    $("#PW64KT").click(function(){
      var checked=$(this).is(':checked');
      if(checked){
        $("#PW34KT").prop("checked",false);
        $("#PW50KT").prop("checked",false);
        PW64KT.load('/HydrometV2/Layers/Hurricane_Layer_Download/Atlantic/PW64KT.kmz');
        map.addLayer(PW64KT);
        PW34KT.removeLayer(map);
        PW50KT.removeLayer(map);
      }
      else{
        PW64KT.removeLayer(map);
      }
    });

    $('#EP').click(function(){
      var checked=$(this).is(':checked');
      if(checked){
        EP1FP.load('/HydrometV2/Layers/Hurricane_Layer_Download/EasternPacific/Pacific_EP1FP.kmz');
        map.addLayer(EP1FP);
        EP1FT.load('/HydrometV2/Layers/Hurricane_Layer_Download/EasternPacific/Pacific_EP1FT.kmz');
        map.addLayer(EP1FT);
        EP1FC.load('/HydrometV2/Layers/Hurricane_Layer_Download/EasternPacific/Pacific_EP1FC.kmz');
        map.addLayer(EP1FC);
        EP2FP.load('/HydrometV2/Layers/Hurricane_Layer_Download/EasternPacific/Pacific_EP2FP.kmz');
        map.addLayer(EP2FP);
        EP2FT.load('/HydrometV2/Layers/Hurricane_Layer_Download/EasternPacific/Pacific_EP2FT.kmz');
        map.addLayer(EP2FT);
        EP2FC.load('/HydrometV2/Layers/Hurricane_Layer_Download/EasternPacific/Pacific_EP2FC.kmz');
        map.addLayer(EP2FC);
        EP3FP.load('/HydrometV2/Layers/Hurricane_Layer_Download/EasternPacific/Pacific_EP3FP.kmz');
        map.addLayer(EP3FP);
        EP3FT.load('/HydrometV2/Layers/Hurricane_Layer_Download/EasternPacific/Pacific_EP3FT.kmz');
        map.addLayer(EP3FT);
        EP3FC.load('/HydrometV2/Layers/Hurricane_Layer_Download/EasternPacific/Pacific_EP3FC.kmz');
        map.addLayer(EP3FC);
        EP4FP.load('/HydrometV2/Layers/Hurricane_Layer_Download/EasternPacific/Pacific_EP4FP.kmz');
        map.addLayer(EP4FP);
        EP4FT.load('/HydrometV2/Layers/Hurricane_Layer_Download/EasternPacific/Pacific_EP4FT.kmz');
        map.addLayer(EP4FT);
        EP4FC.load('/HydrometV2/Layers/Hurricane_Layer_Download/EasternPacific/Pacific_EP4FC.kmz');
        map.addLayer(EP4FC);
        EP5FP.load('/HydrometV2/Layers/Hurricane_Layer_Download/EasternPacific/Pacific_EP5FP.kmz');
        map.addLayer(EP5FP);
        EP5FT.load('/HydrometV2/Layers/Hurricane_Layer_Download/EasternPacific/Pacific_EP5FT.kmz');
        map.addLayer(EP5FT);
        EP5FC.load('/HydrometV2/Layers/Hurricane_Layer_Download/EasternPacific/Pacific_EP5FC.kmz');
        map.addLayer(EP5FC);

        $("#EP1").prop("checked", true);
        $("#EP1FP").prop("checked", true);
        $("#EP1FT").prop("checked", true);
        $("#EP1FC").prop("checked", true);

        $("#EP2").prop("checked", true);
        $("#EP2FP").prop("checked", true);
        $("#EP2FT").prop("checked", true);
        $("#EP2FC").prop("checked", true);

        $("#EP3").prop("checked", true);
        $("#EP3FP").prop("checked", true);
        $("#EP3FT").prop("checked", true);
        $("#EP3FC").prop("checked", true);

        $("#EP4").prop("checked", true);
        $("#EP4FP").prop("checked", true);
        $("#EP4FT").prop("checked", true);
        $("#EP4FC").prop("checked", true);

        $("#EP5").prop("checked", true);
        $("#EP5FP").prop("checked", true);
        $("#EP5FT").prop("checked", true);
        $("#EP5FC").prop("checked", true);

      }
      else{
        map.removeLayer(EP1FP);
        map.removeLayer(EP1FT);
        map.removeLayer(EP1FC);

        map.removeLayer(EP2FP);
        map.removeLayer(EP2FT);
        map.removeLayer(EP2FC);

        map.removeLayer(EP3FP);
        map.removeLayer(EP3FT);
        map.removeLayer(EP3FC);

        map.removeLayer(EP4FP);
        map.removeLayer(EP4FT);
        map.removeLayer(EP4FC);

        map.removeLayer(EP5FP);
        map.removeLayer(EP5FT);
        map.removeLayer(EP5FC);

        $("#EP1").prop("checked", false);
        $("#EP1FP").prop("checked", false);
        $("#EP1FT").prop("checked", false);
        $("#EP1FC").prop("checked", false);

        $("#EP2").prop("checked", false);
        $("#EP2FP").prop("checked", false);
        $("#EP2FT").prop("checked", false);
        $("#EP2FC").prop("checked", false);

        $("#EP3").prop("checked", false);
        $("#EP3FP").prop("checked", false);
        $("#EP3FT").prop("checked", false);
        $("#EP3FC").prop("checked", false);

        $("#EP4").prop("checked", false);
        $("#EP4FP").prop("checked", false);
        $("#EP4FT").prop("checked", false);
        $("#EP4FC").prop("checked", false);

        $("#EP5").prop("checked", false);
        $("#EP5FP").prop("checked", false);
        $("#EP5FT").prop("checked", false);
        $("#EP5FC").prop("checked", false);
      }
    });

    $('#EP1').click(function(){
      var checked=$(this).is(':checked');
      if(checked){

        EP1FP.load('/HydrometV2/Layers/Hurricane_Layer_Download/EasternPacific/Pacific_EP1FP.kmz');
        map.addLayer(EP1FP);
        EP1FT.load('/HydrometV2/Layers/Hurricane_Layer_Download/EasternPacific/Pacific_EP1FT.kmz');
        map.addLayer(EP1FT);
        EP1FC.load('/HydrometV2/Layers/Hurricane_Layer_Download/EasternPacific/Pacific_EP1FC.kmz');
        map.addLayer(EP1FC);

        $("#EP1FP").prop("checked", true);
        $("#EP1FT").prop("checked", true);
        $("#EP1FC").prop("checked", true);

      }
      else{
        map.removeLayer(EP1FP);
        map.removeLayer(EP1FT);
        map.removeLayer(EP1FC);

        $("#EP1FP").prop("checked", false);
        $("#EP1FT").prop("checked", false);
        $("#EP1FC").prop("checked", false);

      }
    });

    $('#EP1FP').click(function(){
      var checked=$(this).is(':checked');
      if(checked){
        EP1FP.load('/HydrometV2/Layers/Hurricane_Layer_Download/EasternPacific/Pacific_EP1FP.kmz');
        map.addLayer(EP1FP);
      }
      else{
        map.removeLayer(EP1FP);
      }
    });

    $('#EP1FT').click(function(){
      var checked=$(this).is(':checked');
      if(checked){
        EP1FT.load('/HydrometV2/Layers/Hurricane_Layer_Download/EasternPacific/Pacific_EP1FT.kmz');
        map.addLayer(EP1FT);
      }
      else{
        map.removeLayer(EP1FT);
      }
    });

    $('#EP1FC').click(function(){
      var checked=$(this).is(':checked');
      if(checked){
        EP1FC.load('/HydrometV2/Layers/Hurricane_Layer_Download/EasternPacific/Pacific_EP1FC.kmz');
        map.addLayer(EP1FC);
      }
      else{
        map.removeLayer(EP1FC);
      }
    });

    $('#EP2').click(function(){
      var checked=$(this).is(':checked');
      if(checked){
        EP2FP.load('/HydrometV2/Layers/Hurricane_Layer_Download/EasternPacific/Pacific_EP2FP.kmz');
        map.addLayer(EP2FP);
        EP2FT.load('/HydrometV2/Layers/Hurricane_Layer_Download/EasternPacific/Pacific_EP2FT.kmz');
        map.addLayer(EP2FT);
        EP2FC.load('/HydrometV2/Layers/Hurricane_Layer_Download/EasternPacific/Pacific_EP2FC.kmz');
        map.addLayer(EP2FC);

        $("#EP2FP").prop("checked", true);
        $("#EP2FT").prop("checked", true);
        $("#EP2FC").prop("checked", true);
      }
      else{
        map.removeLayer(EP2FP);
        map.removeLayer(EP2FT);
        map.removeLayer(EP2FC);

        $("#EP2FP").prop("checked", false);
        $("#EP2FT").prop("checked", false);
        $("#EP2FC").prop("checked", false);
      }
    });

    $('#EP2FP').click(function(){
      var checked=$(this).is(':checked');
      if(checked){
        EP2FP.load('/HydrometV2/Layers/Hurricane_Layer_Download/EasternPacific/Pacific_EP2FP.kmz');
        map.addLayer(EP2FP);
      }
      else{
        map.removeLayer(EP2FP);
      }
    });

    $('#EP2FT').click(function(){
      var checked=$(this).is(':checked');
      if(checked){
        EP2FT.load('/HydrometV2/Layers/Hurricane_Layer_Download/EasternPacific/Pacific_EP2FT.kmz');
        map.addLayer(EP2FT);
      }
      else{
        map.removeLayer(EP2FT);
      }
    });

    $('#EP2FC').click(function(){
      var checked=$(this).is(':checked');
      if(checked){
        EP2FC.load('/HydrometV2/Layers/Hurricane_Layer_Download/EasternPacific/Pacific_EP2FC.kmz');
        map.addLayer(EP2FC);
      }
      else{
        map.removeLayer(EP2FC);
      }
    });

    $('#EP3').click(function(){
      var checked=$(this).is(':checked');
      if(checked){
        EP3FP.load('/HydrometV2/Layers/Hurricane_Layer_Download/EasternPacific/Pacific_EP3FP.kmz');
        map.addLayer(EP3FP);
        EP3FT.load('/HydrometV2/Layers/Hurricane_Layer_Download/EasternPacific/Pacific_EP3FT.kmz');
        map.addLayer(EP3FT);
        EP3FC.load('/HydrometV2/Layers/Hurricane_Layer_Download/EasternPacific/Pacific_EP3FC.kmz');
        map.addLayer(EP3FC);

        $("#EP3FP").prop("checked", true);
        $("#EP3FT").prop("checked", true);
        $("#EP3FC").prop("checked", true);
      }
      else{
        map.removeLayer(EP3FP);
        map.removeLayer(EP3FT);
        map.removeLayer(EP3FC);

        $("#EP3FP").prop("checked", false);
        $("#EP3FT").prop("checked", false);
        $("#EP3FC").prop("checked", false);
      }
    });

    $('#EP3FP').click(function(){
      var checked=$(this).is(':checked');
      if(checked){
        EP3FP.load('/HydrometV2/Layers/Hurricane_Layer_Download/EasternPacific/Pacific_EP3FP.kmz');
        map.addLayer(EP3FP);
      }
      else{
        map.removeLayer(EP3FP);
      }
    });

    $('#EP3FT').click(function(){
      var checked=$(this).is(':checked');
      if(checked){
        EP3FT.load('/HydrometV2/Layers/Hurricane_Layer_Download/EasternPacific/Pacific_EP3FT.kmz');
        map.addLayer(EP3FT);
      }
      else{
        map.removeLayer(EP3FT);
      }
    });

    $('#EP3FC').click(function(){
      var checked=$(this).is(':checked');
      if(checked){
        EP3FC.load('/HydrometV2/Layers/Hurricane_Layer_Download/EasternPacific/Pacific_EP3FC.kmz');
        map.addLayer(EP3FC);
      }
      else{
        map.removeLayer(EP3FC);
      }
    });

    $('#EP4').click(function(){
      var checked=$(this).is(':checked');
      if(checked){
        EP4FP.load('/HydrometV2/Layers/Hurricane_Layer_Download/EasternPacific/Pacific_EP4FP.kmz');
        map.addLayer(EP4FP);
        EP4FT.load('/HydrometV2/Layers/Hurricane_Layer_Download/EasternPacific/Pacific_EP4FT.kmz');
        map.addLayer(EP4FT);
        EP4FC.load('/HydrometV2/Layers/Hurricane_Layer_Download/EasternPacific/Pacific_EP4FC.kmz');
        map.addLayer(EP4FC);

        $("#EP4FP").prop("checked", true);
        $("#EP4FT").prop("checked", true);
        $("#EP4FC").prop("checked", true);
      }
      else{
        map.removeLayer(EP4FP);
        map.removeLayer(EP4FT);
        map.removeLayer(EP4FC);

        $("#EP4FP").prop("checked", false);
        $("#EP4FT").prop("checked", false);
        $("#EP4FC").prop("checked", false);
      }
    });

    $('#EP4FP').click(function(){
      var checked=$(this).is(':checked');
      if(checked){
        EP4FP.load('/HydrometV2/Layers/Hurricane_Layer_Download/EasternPacific/Pacific_EP4FP.kmz');
        map.addLayer(EP4FP);
      }
      else{
        map.removeLayer(EP4FP);
      }
    });

    $('#EP4FT').click(function(){
      var checked=$(this).is(':checked');
      if(checked){
        EP4FT.load('/HydrometV2/Layers/Hurricane_Layer_Download/EasternPacific/Pacific_EP4FT.kmz');
        map.addLayer(EP4FT);
      }
      else{
        map.removeLayer(EP4FT);
      }
    });

    $('#EP4FC').click(function(){
      var checked=$(this).is(':checked');
      if(checked){
        EP4FC.load('/HydrometV2/Layers/Hurricane_Layer_Download/EasternPacific/Pacific_EP4FC.kmz');
        map.addLayer(EP4FC);
      }
      else{
        map.removeLayer(EP4FC);
      }
    });

    $('#EP5').click(function(){
      var checked=$(this).is(':checked');
      if(checked){
        EP5FP.load('/HydrometV2/Layers/Hurricane_Layer_Download/EasternPacific/Pacific_EP5FP.kmz');
        map.addLayer(EP5FP);
        EP5FT.load('/HydrometV2/Layers/Hurricane_Layer_Download/EasternPacific/Pacific_EP5FT.kmz');
        map.addLayer(EP5FT);
        EP5FC.load('/HydrometV2/Layers/Hurricane_Layer_Download/EasternPacific/Pacific_EP5FC.kmz');
        map.addLayer(EP5FC);

        $("#EP5FP").prop("checked", true);
        $("#EP5FT").prop("checked", true);
        $("#EP5FC").prop("checked", true);
      }
      else{
        map.removeLayer(EP5FP);
        map.removeLayer(EP5FT);
        map.removeLayer(EP5FC);

        $("#EP5FP").prop("checked", false);
        $("#EP5FT").prop("checked", false);
        $("#EP5FC").prop("checked", false);
      }
    });

    $('#EP5FP').click(function(){
      var checked=$(this).is(':checked');
      if(checked){
        EP5FP.load('/HydrometV2/Layers/Hurricane_Layer_Download/EasternPacific/Pacific_EP5FP.kmz');
        map.addLayer(EP5FP);
      }
      else{
        map.removeLayer(EP5FP);
      }
    });

    $('#EP5FT').click(function(){
      var checked=$(this).is(':checked');
      if(checked){
        EP5FT.load('/HydrometV2/Layers/Hurricane_Layer_Download/EasternPacific/Pacific_EP5FT.kmz');
        map.addLayer(EP5FT);
      }
      else{
        map.removeLayer(EP5FT);
      }
    });

    $('#EP5FC').click(function(){
      var checked=$(this).is(':checked');
      if(checked){
        EP5FC.load('/HydrometV2/Layers/Hurricane_Layer_Download/EasternPacific/Pacific_EP5FC.kmz');
        map.addLayer(EP5FC);
      }
      else{
        map.removeLayer(EP5FC);
      }
    });

    $('#AT').click(function(){
      var checked=$(this).is(':checked');
      if(checked){
        AT1FP.load('/HydrometV2/Layers/Hurricane_Layer_Download/Atlantic/Atlantic_AT1FP.kmz');
        map.addLayer(AT1FP);
        AT1FT.load('/HydrometV2/Layers/Hurricane_Layer_Download/Atlantic/Atlantic_AT1FT.kmz');
        map.addLayer(AT1FT);
        AT1FC.load('/HydrometV2/Layers/Hurricane_Layer_Download/Atlantic/Atlantic_AT1FC.kmz');
        map.addLayer(AT1FC);
        AT2FP.load('/HydrometV2/Layers/Hurricane_Layer_Download/Atlantic/Atlantic_AT2FP.kmz');
        map.addLayer(AT2FP);
        AT2FT.load('/HydrometV2/Layers/Hurricane_Layer_Download/Atlantic/Atlantic_AT2FT.kmz');
        map.addLayer(AT2FT);
        AT2FC.load('/HydrometV2/Layers/Hurricane_Layer_Download/Atlantic/Atlantic_AT2FC.kmz');
        map.addLayer(AT2FC);
        AT3FP.load('/HydrometV2/Layers/Hurricane_Layer_Download/Atlantic/Atlantic_AT3FP.kmz');
        map.addLayer(AT3FP);
        AT3FT.load('/HydrometV2/Layers/Hurricane_Layer_Download/Atlantic/Atlantic_AT3FT.kmz');
        map.addLayer(AT3FT);
        AT3FC.load('/HydrometV2/Layers/Hurricane_Layer_Download/Atlantic/Atlantic_AT3FC.kmz');
        map.addLayer(AT3FC);
        AT4FP.load('/HydrometV2/Layers/Hurricane_Layer_Download/Atlantic/Atlantic_AT4FP.kmz');
        map.addLayer(AT4FP);
        AT4FT.load('/HydrometV2/Layers/Hurricane_Layer_Download/Atlantic/Atlantic_AT4FT.kmz');
        map.addLayer(AT4FT);
        AT4FC.load('/HydrometV2/Layers/Hurricane_Layer_Download/Atlantic/Atlantic_AT4FC.kmz');
        map.addLayer(AT4FC);
        AT5FP.load('/HydrometV2/Layers/Hurricane_Layer_Download/Atlantic/Atlantic_AT5FP.kmz');
        map.addLayer(AT5FP);
        AT5FT.load('/HydrometV2/Layers/Hurricane_Layer_Download/Atlantic/Atlantic_AT5FT.kmz');
        map.addLayer(AT5FT);
        AT5FC.load('/HydrometV2/Layers/Hurricane_Layer_Download/Atlantic/Atlantic_AT5FC.kmz');
        map.addLayer(AT5FC);

        $("#AT1").prop("checked", true);
        $("#AT1FP").prop("checked", true);
        $("#AT1FT").prop("checked", true);
        $("#AT1FC").prop("checked", true);

        $("#AT2").prop("checked", true);
        $("#AT2FP").prop("checked", true);
        $("#AT2FT").prop("checked", true);
        $("#AT2FC").prop("checked", true);

        $("#AT3").prop("checked", true);
        $("#AT3FP").prop("checked", true);
        $("#AT3FT").prop("checked", true);
        $("#AT3FC").prop("checked", true);

        $("#AT4").prop("checked", true);
        $("#AT4FP").prop("checked", true);
        $("#AT4FT").prop("checked", true);
        $("#AT4FC").prop("checked", true);

        $("#AT5").prop("checked", true);
        $("#AT5FP").prop("checked", true);
        $("#AT5FT").prop("checked", true);
        $("#AT5FC").prop("checked", true);
      }
      else{
        map.removeLayer(AT5FC);
        map.removeLayer(AT5FT);
        map.removeLayer(AT5FP);

        map.removeLayer(AT4FC);
        map.removeLayer(AT4FT);
        map.removeLayer(AT4FP);

        map.removeLayer(AT3FC);
        map.removeLayer(AT3FT);
        map.removeLayer(AT3FP);

        map.removeLayer(AT2FC);
        map.removeLayer(AT2FT);
        map.removeLayer(AT2FP);

        map.removeLayer(AT1FC);
        map.removeLayer(AT1FT);
        map.removeLayer(AT1FP);

        $("#AT1").prop("checked", false);
        $("#AT1FP").prop("checked", false);
        $("#AT1FT").prop("checked", false);
        $("#AT1FC").prop("checked", false);

        $("#AT2").prop("checked", false);
        $("#AT2FP").prop("checked", false);
        $("#AT2FT").prop("checked", false);
        $("#AT2FC").prop("checked", false);

        $("#AT3").prop("checked", false);
        $("#AT3FP").prop("checked", false);
        $("#AT3FT").prop("checked", false);
        $("#AT3FC").prop("checked", false);

        $("#AT4").prop("checked", false);
        $("#AT4FP").prop("checked", false);
        $("#AT4FT").prop("checked", false);
        $("#AT4FC").prop("checked", false);

        $("#AT5").prop("checked", false);
        $("#AT5FP").prop("checked", false);
        $("#AT5FT").prop("checked", false);
        $("#AT5FC").prop("checked", false);
      }
    });
    
    $('#AT1').click(function(){
      var checked=$(this).is(':checked');
      if(checked){
        AT1FP.load('/HydrometV2/Layers/Hurricane_Layer_Download/Atlantic/Atlantic_AT1FP.kmz');
        map.addLayer(AT1FP);
        AT1FT.load('/HydrometV2/Layers/Hurricane_Layer_Download/Atlantic/Atlantic_AT1FT.kmz');
        map.addLayer(AT1FT);
        AT1FC.load('/HydrometV2/Layers/Hurricane_Layer_Download/Atlantic/Atlantic_AT1FC.kmz');
        map.addLayer(AT1FC);

        $("#AT1FP").prop("checked", true);
        $("#AT1FT").prop("checked", true);
        $("#AT1FC").prop("checked", true);
      }
      else{
        map.removeLayer(AT1FC);
        map.removeLayer(AT1FT);
        map.removeLayer(AT1FP);

        $("#AT1FP").prop("checked", false);
        $("#AT1FT").prop("checked", false);
        $("#AT1FC").prop("checked", false);
      }
    });

    $('#AT1FP').click(function(){
      var checked=$(this).is(':checked');
      if(checked){
        AT1FP.load('/HydrometV2/Layers/Hurricane_Layer_Download/Atlantic/Atlantic_AT1FP.kmz');
        map.addLayer(AT1FP);
      }
      else{
        map.removeLayer(AT1FP);
      }
    });

    $('#AT1FT').click(function(){
      var checked=$(this).is(':checked');
      if(checked){
        AT1FT.load('/HydrometV2/Layers/Hurricane_Layer_Download/Atlantic/Atlantic_AT1FT.kmz');
        map.addLayer(AT1FT);
      }
      else{
        map.removeLayer(AT1FT);
      }
    });

    $('#AT1FC').click(function(){
      var checked=$(this).is(':checked');
      if(checked){
        AT1FC.load('/HydrometV2/Layers/Hurricane_Layer_Download/Atlantic/Atlantic_AT1FC.kmz');
        map.addLayer(AT1FC);
      }
      else{
        map.removeLayer(AT1FC);
      }
    });

    $('#AT2').click(function(){
      var checked=$(this).is(':checked');
      if(checked){
        AT2FP.load('/HydrometV2/Layers/Hurricane_Layer_Download/Atlantic/Atlantic_AT2FP.kmz');
        map.addLayer(AT2FP);
        AT2FT.load('/HydrometV2/Layers/Hurricane_Layer_Download/Atlantic/Atlantic_AT2FT.kmz');
        map.addLayer(AT2FT);
        AT2FC.load('/HydrometV2/Layers/Hurricane_Layer_Download/Atlantic/Atlantic_AT2FC.kmz');
        map.addLayer(AT2FC);

        $("#AT2FP").prop("checked", true);
        $("#AT2FT").prop("checked", true);
        $("#AT2FC").prop("checked", true);
      }
      else{
        map.removeLayer(AT2FC);
        map.removeLayer(AT2FT);
        map.removeLayer(AT2FP);

        $("#AT2FP").prop("checked", false);
        $("#AT2FT").prop("checked", false);
        $("#AT2FC").prop("checked", false);

      }
    });

    $('#AT2FP').click(function(){
      var checked=$(this).is(':checked');
      if(checked){
        AT2FP.load('/HydrometV2/Layers/Hurricane_Layer_Download/Atlantic/Atlantic_AT2FP.kmz');
        map.addLayer(AT2FP);
      }
      else{
        map.removeLayer(AT2FP);
      }
    });

    $('#AT2FT').click(function(){
      var checked=$(this).is(':checked');
      if(checked){
        AT2FT.load('/HydrometV2/Layers/Hurricane_Layer_Download/Atlantic/Atlantic_AT2FT.kmz');
        map.addLayer(AT2FT);
      }
      else{
        map.removeLayer(AT2FT);
      }
    });

    $('#AT2FC').click(function(){
      var checked=$(this).is(':checked');
      if(checked){
        AT2FC.load('/HydrometV2/Layers/Hurricane_Layer_Download/Atlantic/Atlantic_AT2FC.kmz');
        map.addLayer(AT2FC);
      }
      else{
        map.removeLayer(AT2FC);
      }
    });

    $('#AT3').click(function(){
      var checked=$(this).is(':checked');
      if(checked){
        AT3FP.load('/HydrometV2/Layers/Hurricane_Layer_Download/Atlantic/Atlantic_AT3FP.kmz');
        map.addLayer(AT3FP);
        AT3FT.load('/HydrometV2/Layers/Hurricane_Layer_Download/Atlantic/Atlantic_AT3FT.kmz');
        map.addLayer(AT3FT);
        AT3FC.load('/HydrometV2/Layers/Hurricane_Layer_Download/Atlantic/Atlantic_AT3FC.kmz');
        map.addLayer(AT3FC);

        $("#AT3FP").prop("checked", true);
        $("#AT3FT").prop("checked", true);
        $("#AT3FC").prop("checked", true);
      }
      else{
        map.removeLayer(AT3FC);
        map.removeLayer(AT3FT);
        map.removeLayer(AT3FP);

        $("#AT3FP").prop("checked", false);
        $("#AT3FT").prop("checked", false);
        $("#AT3FC").prop("checked", false);
      }
    });

    $('#AT3FP').click(function(){
      var checked=$(this).is(':checked');
      if(checked){
        AT3FP.load('/HydrometV2/Layers/Hurricane_Layer_Download/Atlantic/Atlantic_AT3FP.kmz');
        map.addLayer(AT3FP);
      }
      else{
        map.removeLayer(AT3FP);
      }
    });

    $('#AT3FT').click(function(){
      var checked=$(this).is(':checked');
      if(checked){
        AT3FT.load('/HydrometV2/Layers/Hurricane_Layer_Download/Atlantic/Atlantic_AT3FT.kmz');
        map.addLayer(AT3FT);
      }
      else{
        map.removeLayer(AT3FT);
      }
    });

    $('#AT3FC').click(function(){
      var checked=$(this).is(':checked');
      if(checked){
        AT3FC.load('/HydrometV2/Layers/Hurricane_Layer_Download/Atlantic/Atlantic_AT3FC.kmz');
        map.addLayer(AT3FC);
      }
      else{
        map.removeLayer(AT3FC);
      }
    });

    $('#AT4').click(function(){
      var checked=$(this).is(':checked');
      if(checked){
        AT4FP.load('/HydrometV2/Layers/Hurricane_Layer_Download/Atlantic/Atlantic_AT4FP.kmz');
        map.addLayer(AT4FP);
        AT4FT.load('/HydrometV2/Layers/Hurricane_Layer_Download/Atlantic/Atlantic_AT4FT.kmz');
        map.addLayer(AT4FT);
        AT4FC.load('/HydrometV2/Layers/Hurricane_Layer_Download/Atlantic/Atlantic_AT4FC.kmz');
        map.addLayer(AT4FC);

        $("#AT4FP").prop("checked", true);
        $("#AT4FT").prop("checked", true);
        $("#AT4FC").prop("checked", true);
      }
      else{
        map.removeLayer(AT4FC);
        map.removeLayer(AT4FT);
        map.removeLayer(AT4FP);

        $("#AT4FP").prop("checked", false);
        $("#AT4FT").prop("checked", false);
        $("#AT4FC").prop("checked", false);
      }
    });

    $('#AT4FP').click(function(){
      var checked=$(this).is(':checked');
      if(checked){
        AT4FP.load('/HydrometV2/Layers/Hurricane_Layer_Download/Atlantic/Atlantic_AT4FP.kmz');
        map.addLayer(AT4FP);
      }
      else{
        map.removeLayer(AT4FP);
      }
    });

    $('#AT4FT').click(function(){
      var checked=$(this).is(':checked');
      if(checked){
        AT4FT.load('/HydrometV2/Layers/Hurricane_Layer_Download/Atlantic/Atlantic_AT4FT.kmz');
        map.addLayer(AT4FT);
      }
      else{
        map.removeLayer(AT4FT);
      }
    });

    $('#AT4FC').click(function(){
      var checked=$(this).is(':checked');
      if(checked){
        AT4FC.load('/HydrometV2/Layers/Hurricane_Layer_Download/Atlantic/Atlantic_AT4FC.kmz');
        map.addLayer(AT4FC);
      }
      else{
        map.removeLayer(AT4FC);
      }
    });

    $('#AT5').click(function(){
      var checked=$(this).is(':checked');
      if(checked){
        AT5FP.load('/HydrometV2/Layers/Hurricane_Layer_Download/Atlantic/Atlantic_AT5FP.kmz');
        map.addLayer(AT5FP);
        AT5FT.load('/HydrometV2/Layers/Hurricane_Layer_Download/Atlantic/Atlantic_AT5FT.kmz');
        map.addLayer(AT5FT);
        AT5FC.load('/HydrometV2/Layers/Hurricane_Layer_Download/Atlantic/Atlantic_AT5FC.kmz');
        map.addLayer(AT5FC);

        $("#AT5FP").prop("checked", true);
        $("#AT5FT").prop("checked", true);
        $("#AT5FC").prop("checked", true);
      }
      else{
        map.removeLayer(AT5FC);
        map.removeLayer(AT5FT);
        map.removeLayer(AT5FP);

        $("#AT5FP").prop("checked", false);
        $("#AT5FT").prop("checked", false);
        $("#AT5FC").prop("checked", false);
      }
    });

    $('#AT5FP').click(function(){
      var checked=$(this).is(':checked');
      if(checked){
        AT5FP.load('/HydrometV2/Layers/Hurricane_Layer_Download/Atlantic/Atlantic_AT5FP.kmz');
        map.addLayer(AT5FP);
      }
      else{
        map.removeLayer(AT5FP);
      }
    });

    $('#AT5FT').click(function(){
      var checked=$(this).is(':checked');
      if(checked){
        AT5FT.load('/HydrometV2/Layers/Hurricane_Layer_Download/Atlantic/Atlantic_AT5FT.kmz');
        map.addLayer(AT5FT);
      }
      else{
        map.removeLayer(AT5FT);
      }
    });

    $('#AT5FC').click(function(){
      var checked=$(this).is(':checked');
      if(checked){
        AT5FC.load('/HydrometV2/Layers/Hurricane_Layer_Download/Atlantic/Atlantic_AT5FC.kmz');
        map.addLayer(AT5FC);
      }
      else{
        map.removeLayer(AT5FC);
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
    $.ajax({
      url:'./lat_lon_zoom.txt',
      success: function (respon){
        obj=respon.split('\n'); 
        for(var i=0;i<obj.length;i++)
        {
          text_data[i]=obj[i].split(':');
        }
        var check=<?php echo json_encode($check); ?>;
           
        latitude=text_data[0][1];
        latitude=text_data[1][1];
        zoom=text_data[2][1];

        L.control.scale({ position: 'bottomleft' }).addTo(map);
        var layer = L.esri.basemapLayer('Topographic').addTo(map);
        markerClusters =L.markerClusterGroup({maxClusterRadius: 40});
        // var output=<?php echo json_encode($output);?>;
        // var data=<?php echo json_encode($data);?>;
        // console.log("-495");
        // setMarkers(output,data); 
      }
    });
    $("#list_of_stns").change(function(e){           
      var latlon=$("#list_of_stns option:selected").val();
      var lat_lon=latlon.split("#");
      var space=" ";
      if (lat_lon[0].indexOf(space) >=0) {
        var lat=lat_lon[0].split(" ");
        var lon=lat_lon[1].split(" ");
        try
        {
          lat_G=ConvertDMSToDD(lat[0], lat[1], lat[2], lat[3].toUpperCase());
          lon_G= ConvertDMSToDD(lon[0], lon[1], lon[2], lon[3].toUpperCase());
        }catch(exx)
        {
          lat_G=lat_lon[1];
          lon_G=lat_lon[2];
        }
      }
      else
      {
        lat_G=lat_lon[0];
        lon_G=lat_lon[1];
      }
      map.setView([lat_G,lon_G], 13);//on click on th e marker, the zoom is set
      plotGraph("dropdown",e);
    });

    $("#sensors_list").change(function(){
      var output=[];
      var data=[];
      sensor=$("#sensors_list option:selected").val();
      if(sensor=='Rainfall Annual'||sensor=='Rain'){
        $("#SensorValuesChange").show();
        $("#SensorValuesChangelabel").show();
      }
      else{
        $("#SensorValuesChange").hide();
        $("#SensorValuesChangelabel").hide();
      }
      $("#loading_pop").modal({backdrop: false});
      $.ajax({
        url: 'includes/updateStationLocationCurrentValue.php',
        data:{'sensor':sensor},
        type:'post',
        success: function(result){
          $.ajax({
            url: 'includes/setMarkers.php',
            type:'post',
            success: function(result2){
              var json=JSON.parse(result2);
              for(var x in json)
              {      
                output.push(json[x]);
              }
              $.ajax({
                url: 'includes/setTable.php',
                type:'post',
                success: function(result3){
                  $('#loading_pop').modal('hide');
                  var json=JSON.parse(result3);
                  for(var x in json)
                  {
                    data.push(json[x]);
                  }
                  setMarkers(output,data);
                }
              });
            }
          });
        }
      });
    });
    $("#SensorValuesChange").change(function(){
      var output=[];
      var data=[];
      $("#RainLegend").show();
      sensor=$("#sensors_list option:selected").val();
      difference=$("#SensorValuesChange option:selected").val();
      $("#loading_pop").modal({backdrop: false});

      $.ajax({
      //the marker value is updated with the current values by using method post
        url: 'includes/updateStationLocationCurrentValue.php',
        data:{'sensor':sensor},
        type:'post',

        success: function(result){
        //alert(result);
          $.ajax({
          //Marker is set by using the method post
            url: 'includes/setMarkersChange.php',
            data:{'sensor':sensor,'time':difference},
            type:'GET',

            success: function(result2){
             
              var json=JSON.parse(result2);
              //variable json is parsed from the result2
              for(var x in json)
              {
          
                output.push(json[x]);
                // output is pushed with json data
              }

              $.ajax({
                //the table style is set using setTable.php by using the POST method
                url: 'includes/setTable.php',
                type:'post',

                success: function(result3){
                  //alert(result3);

                  // console.log("result"+result3);
                  $('#loading_pop').modal('hide');
                  var json=JSON.parse(result3);
                  //variable json is parsed with the result3
                  for(var x in json)
                  {
            
                    data.push(json[x]);
                    //json is pushed into the data variable
                  }
                  console.log("-1731");
                  console.log(output);
                  setMarkersChange(output,data);

                  //function setMarker is been called by sending output and data as inputs
                }
              });
            }
          });
        }
      });
      /*var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
       // Typical action to be performed when the document is ready:
       var xht=new XMLHttpRequest();
       xht.onreadystatechange = function() {
    if (xht.readyState == 4 && xht.status == 200) {
        var json=xht.responseJSON;
              //variable json is parsed from the result2
              for(var x in json)
              {
          
                output.push(json[x]);
                // output is pushed with json data
              }
              var xh=new XMLHttpRequest();
       xht.onreadystatechange = function() {
    if (xh.readyState == 4 && xh.status == 200) {
      $('#loading_pop').modal('hide');
                  var json=xh.responseJSON;
                  //variable json is parsed with the result3
                  for(var x in json)
                  {
            
                    data.push(json[x]);
                    //json is pushed into the data variable
                  }
                  console.log("-1731");
                  console.log(output);
                  setMarkersChange(output,data);
}};
  xh.open("POST", "includes/setTable.php", true);
x.send();
    }};
    xht.open("GET","includes/setMarkersChange.php?sensor="+sensor+"&difference="+difference,true);
    xht.send();
    }};
xhttp.open("POST", "includes/updateStationLocationCurrentValue.php", true);
xhttp.send("sensor="+sensor);*/
    });
    
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
      }
      else {
        return false; 
      } 
    });
    $("#myBtn2").click(function(){
      $("#loading_pop").modal({backdrop: false});
    });
  });
  var lat_G=0,lon_G=0;
  var sensor="Stage";
  var marker=[];
  var color="";
  var Fcolor="";

  obj={};
  var text_data=new Array();
  var color_text=new Array();
  var count=0;
  var markerClusters=null;
  var colors=new Array();
  var Fcolors=new Array();
  var timeStart = new Date(); 
  var test=1;
  timeStart.setMinutes(timeStart.getMinutes()-60);

  function updatevalues(textdata,data_sensors,output)
  {
    // debugger;
    test++;
    Fcolors=[];
    colors=[];
    var data_sensor=new Array();
    count=0;
    for (i=0;i<data_sensors.length;i++)
    { 
      if(data_sensors[i]==null || data_sensors[i]=="" )
      {
        continue;
      }
      data_sensor[count++]=data_sensors[i].replace(/<[^>]+>/g, ',');
    }
    station_sensor=new Array();
    for(i=0;i<data_sensor.length;i++)
    {
      station_sensor[i]=data_sensor[i].split(',');
    }
    for(i=0;i<station_sensor.length;i++)
    {
      for(c=17;c<station_sensor[i].length-8;c=c+8)
      {
        if(sensor.toLowerCase()==station_sensor[i][c+2].toLowerCase())
        {
          var timeEnd = new Date(station_sensor[i][c]);
          var diff = (timeEnd - timeStart) / 60000;
          var minutes = diff % 60;
          var hours = Math.abs((diff - minutes) / 60);
          if(diff<0)
          {
            colors[i]="grey";
            Fcolors[i]="white";
          }
          else
          {
            colors[i]="color";
          }
        }
      }
      if(!colors[i])
      {
        var timeEnd = new Date(station_sensor[i][17]);
        var diff = (timeEnd - timeStart) / 60000; //dividing by seconds and milliseconds
        var minutes = diff % 60;
        var hours = Math.abs((diff - minutes) / 60);
        if(diff<0)
        {
          colors[i]="grey";
          Fcolors[i]="white";
        }
        else
        {
          colors[i]="color";
        }
      }
      for(j=0;j<textdata.length;j++)
      {
        if(colors[i]=="color")
        {
          if(textdata[j][0]==station_sensor[i][1])
          {
            for(k=21;k<station_sensor[i].length;k=k+8)
              {
                if((station_sensor[i][k-2].toLowerCase() == textdata[j][1].toLowerCase() && sensor.toLowerCase()== station_sensor[i][k-2].toLowerCase() )||(station_sensor[i][k-2].toLowerCase().includes(textdata[j][1].toLowerCase()) && station_sensor[i][k-2].toLowerCase().includes(sensor.toLowerCase())))
                {
                  var m=2;
                  var v;
                  var lens = textdata[j].length;
                  station_sensor[i][k]=parseFloat(station_sensor[i][k]);
                  
                  while(m < lens){
                    if(textdata[j][m]=='>'){
                      if((m+4)!=(lens-1)){      
                        if((station_sensor[i][k] > textdata[j][m+1])&&(station_sensor[i][k] < textdata[j][m+6])){
                          v=m;
                          break;
                        }
                      }
                      else{
                        if(station_sensor[i][k] > textdata[j][m+1]){
                          v=m;
                          break;  
                        }
                      }
                    }
                    else if(textdata[j][m]=='<'){
                      if(m==2){
                        if(station_sensor[i][k] < textdata[j][m+1]){
                          v=m;
                          break;
                        }
                      }
                      else{
                        if((m+4)!=(lens-1)){
                          if((station_sensor[i][k] < textdata[j][m+1])&&(station_sensor[i][k] > textdata[j][m-6]))
                          {
                            v=m;
                            break;
                          }
                        }
                        else{
                          if(station_sensor[i][k]<=textdata[j][m+1]){
                            v=m;
                            break;
                          }
                        }
                      }
                    }
                    else if(textdata[j][m]=='>='){
                      if((m+4)!=(lens-1)){   
                        if((station_sensor[i][k]>=textdata[j][m+1])&&(station_sensor[i][k]<=textdata[j][m+6])){
                          v=m;
                          break;
                        }
                      }
                      else{
                        if(station_sensor[i][k]>=textdata[j][m+1]){
                          v=m;
                          break;
                        }
                      }
                    }
                    else if(textdata[j][m]=='<='){
                      if(m==2){
                        if(station_sensor[i][k]<=textdata[j][m+1]){
                          v=m;
                          break;
                        }
                      }
                      else{
                        if((m+4)!=(lens-1)){
                          if((station_sensor[i][k]<=textdata[j][m+1])&&(station_sensor[i][k]>=textdata[j][m-6])){
                            v=m;
                            break;
                          }
                        }
                        else{
                          if(station_sensor[i][k]<=textdata[j][m+1]){
                            v=m;
                            break;
                          }
                        }
                      }
                    }
                    m=m+5;
                  }
                  if(textdata[j][v]=='>'){
                    if((v+4)!=(lens-1)){    
                      if((station_sensor[i][k] > textdata[j][v+1])&&(station_sensor[i][k] < textdata[j][v+6])){
                        colors[i]=textdata[j][v+2];
                        Fcolors[i]="white";
                      }
                    }
                    else{
                      if(station_sensor[i][k] > textdata[j][v+1]){
                        colors[i]=textdata[j][v+2];
                        Fcolors[i]="white";   
                      }
                    }
                  }
                  else if(textdata[j][v]=='<'){
                    if(v==2){
                      if(station_sensor[i][k] < textdata[j][v+1]){
                        colors[i]=textdata[j][v+2];
                        Fcolors[i]="white";
                      }
                    }
                    else{
                      if((v+4)!=(lens-1)){
                        if((station_sensor[i][k] < textdata[j][v+1])&&(station_sensor[i][k] > textdata[j][v-6])){
                          colors[i]=textdata[j][v+2];
                          Fcolors[i]="white";
                        }
                      }
                      else{
                        if(station_sensor[i][k] < textdata[j][v+1]){
                          colors[i]=textdata[j][v+2];
                          Fcolors[i]="white";   
                        }
                      }
                    }
                  }
                  else if(textdata[j][v]=='>='){
                    if((v+4)!=(lens-1)){  
                      if((station_sensor[i][k]>=textdata[j][v+1])&&(station_sensor[i][k]<=textdata[j][v+6])){
                        colors[i]=textdata[j][v+2];
                        Fcolors[i]="white";
                      }
                    }
                    else{
                      if(station_sensor[i][k]>=textdata[j][v+1]){
                        colors[i]=textdata[j][v+2];
                        Fcolors[i]="white";   
                      }
                    }
                  }
                  else if(textdata[j][v]=='<='){
                    if(v==2){
                      if(station_sensor[i][k]<=textdata[j][v+1]){
                        colors[i]=textdata[j][v+2];
                        Fcolors[i]="white";
                      }
                    }
                    else{
                      if((v+4)!=(lens-1)){
                        if((station_sensor[i][k]<=textdata[j][v+1])&&(station_sensor[i][k]>=textdata[j][v-6])){
                          colors[i]=textdata[j][v+2];
                          Fcolors[i]="white";
                        }
                      }
                      else{
                        if(station_sensor[i][k]<=textdata[j][v+1]){
                          colors[i]=textdata[j][v+2];
                          Fcolors[i]="white";   
                        }
                      }
                    }
                  }
                  if(colors[i]=="yellow"){
                    Fcolors[i]="black";
                  }
                  break;
                }
              }
            }
          }
        }
        if(colors[i]=="color" )
        {
          colors[i]="green";
          Fcolors[i]="white";//for the values doen't follows v1,v2 and v3.
        }
      }
      for (var i = 0; i < marker.length; i++) 
      {
        if (marker[i] != undefined)
        {
          map.removeLayer(marker[i]);
          markerClusters.removeLayer(marker[i]);
        }
      }
      var color_count=0;
      for (var i = 0; i < output.length; i++) {
      icon_data=[];
      icon_sensor=[];
      if(data_sensors[i]==null || data_sensors[i]=="" )
      {
        continue;
      }
      var lat_lon=output[i].split("#");
      var lat=lat_lon[1].split(" ");
      var lon=lat_lon[2].split(" ");
      try
      {
        lat_G=ConvertDMSToDD(lat[0], lat[1], lat[2], lat[3].toUpperCase());
        lon_G= ConvertDMSToDD(lon[0], lon[1], lon[2], lon[3].toUpperCase());
      }
      catch(exx)
      {
        lat_G=lat_lon[1];
        lon_G=lat_lon[2];
      }
      var markerOptions={};
      if(lat_lon[0] == "0.00")
      {
        icon_data=data_sensors[i].replace(/<[^>]+>/g, ',');
        icon_sensor=icon_data.split(',');
        for(k=0;k<icon_sensor.length;k++)
        { 
          if(icon_sensor[k]=="Stage")
          {
            markerOptions = {
              icon: new L.DivIcon({
                className: 'my-div-icon',
                html: '<b class="c_val" style="font-size: 12px;border:solid;padding:2px;border-width: thin;border-bottom: 2px solid;border-right: 2px solid;color:'+Fcolors[color_count]+';background-color:'+colors[color_count]+';border-color:black">'+icon_sensor[k+2]+'</b>'
              })
            };
            break;
          } 
          else
          {
            markerOptions = {
              icon: new L.DivIcon({
                className: 'my-div-icon',
                html: '<b class="c_val" style="font-size: 12px;border:solid;padding:2px;border-width: thin;border-bottom: 2px solid;border-right: 2px solid;color:'+Fcolors[color_count]+';background-color:'+colors[color_count]+';border-color:black">'+lat_lon[0]+'</b>'
              })
            };          
          }
        }
      }
      else
      {
        markerOptions = {
          icon: new L.DivIcon({
            className: 'my-div-icon',
            html: '<b class="c_val" style="font-size: 12px;border:solid;padding:2px;border-width: thin;border-bottom: 2px solid;border-right: 2px solid;color:'+Fcolors[color_count]+';background-color:'+colors[color_count]+';border-color:black">'+lat_lon[0]+'</b>'
          })
        };
      }                 
      color_count=color_count+1;
      marker[i] = L.marker([lat_G,lon_G],markerOptions).bindPopup(data_sensors[i], {maxWidth : 560});
      this.markerClusters.addLayer(marker[i]);

      marker[i].on('mouseover',function() {
        this.openPopup();
      });
      marker[i].on('click',function() {
        plotGraph("marker",this);
      });
      marker[i].on('mouseout', function () {
        this.closePopup();
      });                 
    }
    map.addLayer(markerClusters);
  }

  function setMarkers(output,data)
  {
    $.ajax({
      url:'./COLOR.txt',
      success: function (respon){
        obj=respon.split('\n');         
        for(var i=0;i<obj.length;i++)
        {
          if(obj[i]!=""){
            text_data[i]=obj[i].split(',');
            count++;
          }
        }
        updatevalues(text_data,data,output);
      }
    });
  }
  function updatevalueschange(textdata,data_sensors,output)
  {
    
    test++;
    Fcolors=[];
    colors=[];
    var data_sensor=new Array();
    var check=new Array();
    count=0;
    for (i=0;i<data_sensors.length;i++)
    { 
      if(data_sensors[i]==null || data_sensors[i]=="" )
      {
        continue;
      }
      data_sensor[count++]=data_sensors[i].replace(/<[^>]+>/g, ',');
    }
    station_sensor=new Array();
    for(i=0;i<data_sensor.length;i++)
    {
      station_sensor[i]=data_sensor[i].split(',');
    }
    for(i=0;i<output.length;i++)
    {
      check[i]=output[i].split('#');
    }
    for(i=0;i<station_sensor.length;i++)
    {
      if(!colors[i])
      {
        var timeEnd = new Date(station_sensor[i][17]);
        var diff = (timeEnd - timeStart) / 60000; //dividing by seconds and milliseconds
        var minutes = diff % 60;
        var hours = Math.abs((diff - minutes) / 60);
        if(diff<0)
        {
          colors[i]="color";
        }
        else
        {
          colors[i]="color";
        }
      }
      for(j=0;j<textdata.length;j++)
      {
        if(colors[i]=="color")
        {
          // debugger;
          console.log("check");
          console.log(check[i][0]);
          console.log(textdata[j][0]);
          console.log(check[i][0]>textdata[j][0]);
          if(parseFloat(check[i][0])<parseFloat(textdata[0][0]))
          {
            colors[i]=textdata[0][1];
            Fcolors[i]="black";
            break;
          }
          else if(parseFloat(check[i][0])>=parseFloat(textdata[textdata.length-1][0]))
          {
            colors[i]=textdata[textdata.length-1][1];
            Fcolors[i]="white";
            break;
          }
          else if((parseFloat(check[i][0])>=parseFloat(textdata[j][0]))&&(parseFloat(check[i][0])<parseFloat(textdata[j+1][0])))
          {
            colors[i]=textdata[j][1];
            Fcolors[i]="black";
          }
        }
        if(colors[i]=="#fff"||colors[i]=="fff"){
          Fcolors[i]="black";
        }
      }
        if(colors[i]=="color" )
        {
          colors[i]="green";
          Fcolors[i]="white";
        }
      }
      for (var i = 0; i < marker.length; i++) 
      {
        if (marker[i] != undefined)
        {
          map.removeLayer(marker[i]);
          markerClusters.removeLayer(marker[i]);
        }
      }
      var color_count=0;
      for (var i = 0; i < output.length; i++) {
      icon_data=[];
      icon_sensor=[];
      if(data_sensors[i]==null || data_sensors[i]=="" )
      {
        continue;
      }
      var lat_lon=output[i].split("#");
      var lat=lat_lon[1].split(" ");
      var lon=lat_lon[2].split(" ");
      try
      {
        lat_G=ConvertDMSToDD(lat[0], lat[1], lat[2], lat[3].toUpperCase());
        lon_G= ConvertDMSToDD(lon[0], lon[1], lon[2], lon[3].toUpperCase());
      }
      catch(exx)
      {
        lat_G=lat_lon[1];
        lon_G=lat_lon[2];
      }
      var markerOptions={};
      if(lat_lon[0] == "0.00")
      {
        icon_data=data_sensors[i].replace(/<[^>]+>/g, ',');
        icon_sensor=icon_data.split(',');
        for(k=0;k<icon_sensor.length;k++)
        { 
          if(icon_sensor[k]=="Stage")
          {
            markerOptions = {
              icon: new L.DivIcon({
                className: 'my-div-icon',
                html: '<b class="c_val" style="font-size: 12px;border:solid;padding:2px;border-width: thin;border-bottom: 2px solid;border-right: 2px solid;color:'+Fcolors[color_count]+';background-color:'+colors[color_count]+';border-color:black">'+icon_sensor[k+2]+'</b>'
              })
            };
            break;
          } 
          else
          {
            markerOptions = {
              icon: new L.DivIcon({
                className: 'my-div-icon',
                html: '<b class="c_val" style="font-size: 12px;border:solid;padding:2px;border-width: thin;border-bottom: 2px solid;border-right: 2px solid;color:'+Fcolors[color_count]+';background-color:'+colors[color_count]+';border-color:black">'+lat_lon[0]+'</b>'
              })
            };          
          }
        }
      }
      else
      {
        markerOptions = {
          icon: new L.DivIcon({
            className: 'my-div-icon',
            html: '<b class="c_val" style="font-size: 12px;border:solid;padding:2px;border-width: thin;border-bottom: 2px solid;border-right: 2px solid;color:'+Fcolors[color_count]+';background-color:'+colors[color_count]+';border-color:black">'+lat_lon[0]+'</b>'
          })
        };
      }                 
      color_count=color_count+1;
      marker[i] = L.marker([lat_G,lon_G],markerOptions).bindPopup(data_sensors[i], {maxWidth : 560});
      this.markerClusters.addLayer(marker[i]);

      marker[i].on('mouseover',function() {
        this.openPopup();
      });
      marker[i].on('click',function() {
        plotGraph("marker",this);
      });
      marker[i].on('mouseout', function () {
        this.closePopup();
      });                 
    }
    map.addLayer(markerClusters); 
  }
  function setMarkersChange(out,data)
  {
    $.ajax({
      url:'includes/rain-color.txt',
      success: function (respon){
        line=respon.split('\n');         
        for(var i=0;i<line.length;i++)
        {
          if(line[i]!=""){
            color_text[i]=line[i].split('-');
            count++;
          }
        }
       debugger;

        updatevalueschange(color_text,data,out);
      }
    });
  }
  function ConvertDMSToDD(degrees, minutes, seconds, direction) {   
    var dd = Number(degrees) + Number(minutes)/60 + Number(seconds)/(60*60);
    //sum of hours+minutes+seconds os done to send as input

    if (direction == "S" || direction == "W") {
        dd = dd * -1;
    } // Don't do anything for N or E
    return dd;
  }
  function refresh_map(e)
  {
  
    $("#graph_data").text("");
    plotGraph("button",e);
  }
  function zoomOnSite()
  {
    var xhttp=new XMLHttpRequest();
    xhttp.onreadystatechange=function()
    {
      if (this.readyState==4 && this.status==200) 
      {
        var latlon=this.responseText;
        var lat_lon=latlon.split("#");
        var lat=lat_lon[0].split(" ");
        var lon=lat_lon[1].split(" ");
        try
        {
          lat_G=   ConvertDMSToDD(lat[0], lat[1], lat[2], lat[3].toUpperCase());
          lon_G= ConvertDMSToDD(lon[0], lon[1], lon[2], lon[3].toUpperCase())
        }catch(exx)
        {
          lat_G=lat_lon[1];
          lon_G=lat_lon[2];
        }
        map.setView([lat_G,lon_G], 13);
      }
    };//function close
    var stn=$("#graphHeader").text();
    xhttp.open("GET","includes/LatLonfromStationName.php?stn="+stn,true);
    xhttp.send();
  }

  function exportTableToCSV($table) {

    var $rows = $table.find('tr:has(td)'),          
    tmpColDelim = String.fromCharCode(11),
    tmpRowDelim = String.fromCharCode(0), 
    colDelim = ',',
    rowDelim = '\r\n',
    csv =  $rows.map(function (i, row) {
      var $row = $(row),
      $cols = $row.find('td');
      return $cols.map(function (j, col) {
        var $col = $(col),
        text = $col.text();
        return text.replace(/"|,/g, ''); // escape double quotes
      }).get().join(tmpColDelim);
    }).get().join(tmpRowDelim)
    .split(tmpRowDelim).join(rowDelim)
    .split(tmpColDelim).join(colDelim);
    return csv;
  }
  function plotGraph(graph_from,e)
  {
    $('#myModal').modal('show');
    $("#graph_div").css("display","");
    $("#graph").html('<center><img src=""></center>');
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        var json = this.responseText;
        var ress = JSON.parse(json);
        json=ress.replace(/"/g ,"");
        if ('"Date"'==this.responseText) {
          document.getElementById("graph").innerHTML = "No Data Found!";
        }

        var date_format=document.getElementById("date_format").value;
        date_format=date_format.trim().replace("d-m-Y H:i" ,"DD-MM-YYYY H:mm");
        date_format=date_format.trim().replace("m-d-Y H:i" ,"MM-DD-YYYY H:mm");
        date_format=date_format.trim().replace("Y-m-d H:i" ,"YYYY-MM-DD H:mm");

        date_format=date_format.trim().replace("d-m-Y h:i A" ,"DD-MM-YYYY h:mm A");
        date_format=date_format.trim().replace("m-d-Y h:i A" ,"MM-DD-YYYY h:mm A");
        date_format=date_format.trim().replace("Y-m-d h:i A" ,"YYYY-MM-DD h:mm A");
        var table="";
        var data_all=ress.split("\n\"");
        for(var n in data_all)
        {

          table+="<tr>";
          var data=data_all[n].split(",");
          for(var x in data)
          {

            if(isvaliddate(data[x]))
            {
              table+="<td>"+moment(data[x].replace(/"/g ,"").trim(),['YYYY-MM-DD h:m A']).format(date_format)+"</td>";
            }
            else
            {

              table+="<td>"+data[x].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+"</td>";
            }
        
        
          }
        }
        document.getElementById("graph_data").innerHTML=table;
        document.getElementById("graph_data").getElementsByTagName("tr")[0].style=" background-color:#539CCC;color:white;font-size:13px;padding:1px;";
        var selectedsen=document.getElementById('sensors_list').value;
        var d= document.getElementById('graph_data');
        var ro=d.rows;
        var arrayforindex=[];
        for (var i = 0; i < ro[0].cells.length; i++) {
  
          var str = ro[0].cells[i].innerHTML;
          if(str=="Date" || str==selectedsen){
          }
          else{
            arrayforindex.push(i);
          }

        }
        if(selectedsen!="select"){
          for(var p=0; p<d.rows.length; p++)
          {

            var subtraindex=0;
            for(index=0;index<arrayforindex.length;index++){
              d.rows[p].deleteCell(arrayforindex[index]-subtraindex);
    
              subtraindex=subtraindex+1;
            }
          } 
        }
        var textdata = $.ajax({
          'url':'./COLOR.txt',
          dataType: "json",
          async: false,
          success: function (data) {
          }
        }) .responseText ;
        
        textdata=textdata.split('\n');
        var graph_text=new Array();
        for(var i=0;i<textdata.length;i++){
          
          graph_text[i]=textdata[i].split(',');
          
        }
        var textd=new Array();
        var j=0;
        for(i=0;i<graph_text.length;i++){
          if(graph_text[i]!=null){
            textd[j]=graph_text[i];
            j++;
          }

        }
        var sens=document.getElementById("sensors_list").value;
        var head=$("#graphHeader").text();
        var d=JSON.stringify(textd);
        var limit = $.ajax({
          'url':'./graphmarker.php',
          'method': 'POST',
          'data': {'text_data': d,'stnname': head,'sensor': sens},
          global: false,
          async:false,
          'success': function (data){
             
            return data;
                  
          }
        }).responseText;
          
        var valued=limit.split(',');
        colored=new Array();
        valed=new Array();
        textgraph=new Array();
        leng=(valued.length/3);
        for(i=0;i<(2*leng);i++)
        {
          
          if(i>((2*leng)/2)-1){
            valued[i]=valued[i].replace('"',"");
            colored.push(valued[i]);
          }
          else{
            valued[i]=valued[i].replace('"',"");
            valed.push(valued[i]);
          }
        }
        for(i=(2*leng);i<valued.length;i++){
          if(valued[i]!=null){
            valued[i]=valued[i].replace(/(?:\\[rn]|[\r\n]+)+/g,"");
            valued[i]=valued[i].replace('"',"");
            textgraph.push(valued[i]);
          }
          else{
            valued[i]="";
            textgraph.push(valued[i]);
          }
        }
        
        var args = [$('#graph_data')];
        var jsoncsv=exportTableToCSV.apply(this,args);
        //the data is exported to csv file

        //console.log(args);
        //console.log(json);
        
        var dateOffset=(24*60*60*1000) * 6; //6 days
        var myDate = new Date();
        myDate.setTime(myDate.getTime() - dateOffset);
        var wid = document.getElementById("graph").offsetWidth;
        //alert(wid);
        // debugger
        try
        {
          var g2=  new Dygraph(document.getElementById("graph"),
          jsoncsv , {
            legend : "follow",
            showRangeSelector: true,  
            xlabel: 'Hours/Date',
            ylabel: sens, 
            drawPoints: true, 
            connectSeparatedPoints: true,
            underlayCallback: function(canvas, area, g) {
          
              var splitDate = new Date(myDate);
              for(var i=0;i<valed.length;i++){
                var coords = g.toDomCoords(splitDate, valed[i]);
                var splitX = coords[0];
                var splitY = coords[1];
                canvas.fillStyle = colored[i];
                canvas.font = '15px "Helvetica Neue",Helvetica,Arial,sans-serif';
                canvas.fillText(textgraph[i], (wid-70), splitY+15,60);
                canvas.fillRect(55, splitY, 2*wid, 2);
              }
          
            }                  
          });
          //the library is called with using the Dygraph library

          //g2.resize(600,400);
        }catch(ex)
          //when the try statement fails
        {

          document.getElementById("graph").innerHTML = "No Data Found!";
          //shows no data found
        }

      }
    };
    if (graph_from=="map") {
      //if the graph_from element is 'map'

      //  alert("includes/gotograph.php?lat="+e.latlng.lat+"&lon="+e.latlng.lng);
      xhttp.open("GET", "includes/gotograph.php?lat="+e.latlng.lat+"&lon="+e.latlng.lng, true);
      //data gets from 'gotograph.php' by sending the input lat and lon, and when the lat and lon is selected
    }
    if (graph_from=="marker") 
      //if the graph_from element is 'marker'
    {
          
      var temp= e.getLatLng();
      temp=temp+"";
      var temp2=temp.substring(0, temp.length - 1).split("(");
      //temp is splitted with '(' and is updated to temp2

      var temp3=temp2[1].split(",");
      //temp2 is splitted with ',' and is updated to temp3
      console.log("clicked");
      console.log(temp3[0]);
      console.log(temp3[1]);
      console.log(sensor);
      xhttp.open("GET", "includes/gotograph.php?lat="+temp3[0]+"&lon="+temp3[1]+"&sensor="+sensor, true);
      //data gets from 'gotograph.php' by sending the input temp3 and sensor, and when the lat and lon along with the sensor is selected
    }
    if (graph_from=="dropdown") {
      //if graph_from element is 'dropdown'

      var stn=$("#list_of_stns option:selected").text();
      //variable stn is updated with the station selected

      xhttp.open("GET", "includes/gotograph.php?stn="+stn, true);
      //The data in called by GET from the gotograph.php by sending the input station
    }
    if (graph_from=="button") {
      //if the graph_from element is 'button'
      var stn=$("#graphHeader").text();
      //variable stn is updated with the data from the ID #graphHeader

      xhttp.open("GET", "includes/gotograph.php?stn="+stn, true);
      //The data is called by GET from the gotograph.php by sending the input station
    }
    xhttp.send();
    //request is sent


    if (graph_from=="map"||graph_from=="marker") {
      //if the graph_from is equal to element 'map' or 'marker'

      var xhttp = new XMLHttpRequest();
                        // new HttpRequeset is set
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("graphHeader").innerHTML =this.responseText;
        }
      };
      if (graph_from=="map") {
        //if the graph_from element is 'map'
        xhttp.open("GET", "includes/stationNamefromLatLon.php?lat="+e.latlng.lat+"&lon="+e.latlng.lng, true);
           //data gets from 'gotograph.php' by sending the input lat and lon, and when the lat and lon is selected
      }
      if (graph_from=="marker") 
      {
        //if the graph_from element is 'marker'

        var temp= e.getLatLng();
        temp=temp+"";
        var temp2=temp.substring(0, temp.length - 1).split("(");
        //temp is splitted with '(' and is updated to temp2

        var temp3=temp2[1].split(",");
        //temp2 is splitted with ',' and is updated to temp3

        xhttp.open("GET", "includes/stationNamefromLatLon.php?lat="+temp3[0]+"&lon="+temp3[1], true);
        //data gets from 'gotograph.php' by sending the input temp3 and sensor, and when the lat and lon along with the sensor is selected

      }


      xhttp.send(); //request is sent
    }
    if (graph_from=="dropdown") {
      //if the graph_from element is 'button'
      document.getElementById("graphHeader").innerHTML =$("#list_of_stns option:selected").text();
    }
    //alert("ok");
    // window.open("includes/gotograph.php?lat="+e.latlng.lat+"&lon="+e.latlng.lng);
  }
  function close_graph(){
    document.getElementById("graph").innerHTML = "<center><img src='./StationImages/waitingIcon.gif'></center>";
    $("#graph_div").css("display","none");
  }

  function isvaliddate(str)
  {

    var ch=false;
    try
    {
      var temp_date=str.split(" ");
      if (temp_date[0].includes("-")&&temp_date[1].includes(":")) 
      {
        ch =true;
      }
      else
      { 
        ch =false;
      }
    }
    catch(ex)
    {
      ch=false;
    }
    return ch;
  }
  function popUp()
  {
    $("#graph_div").css("display","none");
    var httpx= new XMLHttpRequest();
    httpx.onreadystatechange = function() { 
      if (this.readyState == 4 && this.status == 200) 
      {
        var temp=this.responseText;
        var json=JSON.parse(temp);
        var sensors="";
        for(var v in json)
        {
          sensors+=json[v]+";"; 
        }
        PlotGraph(sensors,$("#graphHeader").text());
      }
    };
    var stn=$("#graphHeader").text();
    httpx.open("GET","/hydromet/getSensorsforGraph.php?station="+stn, true);
    httpx.send();
  }
  function PlotGraph(params,station) {
    var yearFrom;
    var monthFrom;
    var dayFrom;
    var yearTo;
    var monthTo;
    var dayTo;
                
    var days=6; //difference for the number of days 
    var date = new Date();
    var last = new Date(date.getTime() - (days * 24 * 60 * 60 * 1000));
    var dayFrom =last.getDate();
    var monthFrom=last.getMonth()+1;
    var yearFrom=last.getFullYear();
    var currentdate = new Date();
    yearTo = currentdate.getFullYear();
    monthTo = currentdate.getMonth() + 1;
    dayTo = currentdate.getDate();
    window.open('GraphMultiple.php?FY=' + yearFrom + "&FM=" + monthFrom + "&FD=" + dayFrom + '&TY=' + yearTo + "&TM=" + monthTo + "&TD=" + dayTo + "&PARAMS=" + params+"&station="+station,"_blank", 'toolbar=0,location=0,menubar=0');
  }
  function updateMapValue()
  {
    var sensor=$("#sensors_list option:selected").val();
    var base_layer,mapview,station;
    base_layer=$("#base_layer option:selected").val();
    mapview=$("#list_of_map_view option:selected").text();
    station=$("#list_of_stns option:selected").text();
    if (lat_G!=0)
    {
      window.location.href="index.php?baselayer="+base_layer+"&mapview="+mapview+"&station="+station+"&sensor="+sensor+"&lat_G="+lat_G+"&lon_G="+lon_G;
    }
    else
    {
      window.location.href="index.php?baselayer="+base_layer+"&mapview="+mapview+"&station="+station+"&sensor="+sensor;
    }
  }
</script>
<body>
  <?php
    include 'includes/header.php';
  ?>
  <div class="container">
    <!-- Modal -->
    <div class="modal fade" id="loading_pop" role="dialog">
      <div class="modal-dialog" style="width:283px;padding-top:200px">
      <!-- div is divided by using the class modal-dialog with applying the required style-->
        <!-- Modal content-->
        <div class="">
          <div class="modal-body"><center>
            <!-- The div an image is loaded in the center--> 
            <img src="./StationImages/waitingIcon.gif"></center>
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
            <!-- <br> -->
            <label id="RadarContainer" name="Radar" class="btn btn-default layer-list-item active" style="width: 100%;background-color: #fff;border:none;box-shadow: none;">
              <input id="Radar" class="pull-right" type="checkbox"> <span class="btn-text pull-left"><b>Current radar</b></span>
            </label>
            <ul id="Loop" style="padding-left: 15px;list-style: none;margin-bottom: 0px;">
              <li>
                <label id="RadarContainer" name="RadarLoop" class="btn btn-default layer-list-item active" style="width: 100%;background-color: #fff;border:none;box-shadow: none;">
                  <input id="RadarLoop" class="pull-right" type="checkbox"> <span class="btn-text pull-left"><b>Radar Loop</b></span>
                </label>
              </li>
            </ul>
            <!-- <br> -->
            <label id="RadarContainer" name="Radar" class="btn btn-default layer-list-item active" style="width: 100%;background-color: #fff;border:none;box-shadow: none;">
              <input id="QPF" class="pull-right" type="checkbox"> <span class="btn-text pull-left"><b>QPF (24 hrs)</b></span>
            </label><br><span class="datadate" id="qpfTime"></span>
            <!-- <ul id="QPFsubs" style="padding-left: 15px;list-style: none;">
              <li>
                <label id="RadarContainer" name="Radar" class="btn btn-default layer-list-item active" style="width: 100%;background-color: #fff;border:none;box-shadow: none;">
                  <input id="qpf24" class="pull-right" type="checkbox"> <span class="btn-text pull-left"><b>QPF 24 Hour Day</b></span>
                  
                </label>
              </li>
              <li>
                <label id="RadarContainer" name="Radar" class="btn btn-default layer-list-item active" style="width: 100%;background-color: #fff;border:none;box-shadow: none;">
                  <input id="qpf48" class="pull-right" type="checkbox"> <span class="btn-text pull-left"><b>QPF 48 Hour Day</b></span>
                  
                </label>
              </li>
            </ul> -->
            <!-- <br> -->
            <label id="RadarContainer" name="Radar" class="btn btn-default layer-list-item active" style="width: 100%;background-color: #fff;border:none;box-shadow: none;">
              <input id="Hurricanes" class="pull-right" type="checkbox"> <span class="btn-text pull-left"><b>Hurricanes</b></span>
            </label>
            <div id="HurricaneSub">
               <ul id="Hurricane-sub" style="padding-left: 10px; list-style: none;">
                  <li>
                     <label id="Hurricane-subs" name="Radar" class="btn btn-default layer-list-item active" style="width: 100%;background-color: #fff;border:none;box-shadow: none;">
                    <input id="EP" class="pull-right" type="checkbox"> 
                     <span class="btn-text pull-left"><b>Eastern Pacific</b></span>   
                     </label>
                  </li>
               </ul>
               <ul id="Hurricane-sub" style="padding-left: 15px; list-style: none;">
                  <li>
                     <label id="Hurricane-subs" name="Radar"  class="btn btn-default layer-list-item active" style="width: 100%;background-color: #fff;border:none;box-shadow: none;">
                      <input id="EP1" class="pull-right" type="checkbox"> <span class="btn-text pull-left"><b>EP1</b></span></label>
                  </li>
               </ul>
               <ul id="Hurricane-sub" style="padding-left: 25px; list-style: none;">
                  <li>
                     <label id="Hurricane-subs" name="Radar" class="btn btn-default layer-list-item active" style="width: 100%;background-color: #fff;border:none;box-shadow: none;">
                     <input id="EP1FP" class="pull-right" type="checkbox"> <span class="btn-text pull-left"><b>Forecast Points</b></span>
                     </label>
                  </li>
                  <li>
                     <label id="Hurricane-subs" name="Radar" class="btn btn-default layer-list-item active" style="width: 100%;background-color: #fff;border:none;box-shadow: none;">
                     <input id="EP1FT" class="pull-right"  type="checkbox"> <span class="btn-text pull-left"><b>Forecast Tracks</b></span>
                     </label>
                  </li>
                  <li>
                     <label id="Hurricane-subs" name="Radar" class="btn btn-default layer-list-item active" style="width: 100%;background-color: #fff;border:none;box-shadow: none;">
                     <input id="EP1FC" class="pull-right"  type="checkbox"> <span class="btn-text pull-left"><b>Forecast Cone</b></span>
                     </label>
                  </li>
               </ul>
               <ul id="Hurricane-sub" style="padding-left: 15px; list-style: none;">
                  <li>
                     <label id="Hurricane-subs" name="Radar" class="btn btn-default layer-list-item active" style="width: 100%;background-color: #fff;border:none;box-shadow: none;">
                      <input id="EP2" class="pull-right" type="checkbox"> 
                     <span class="btn-text pull-left"><b>EP2</b></span></label>
                  </li>
               </ul>
               <ul  id="Hurricane-sub" style="padding-left: 25px; list-style: none;">
                  <li>
                     <label id="Hurricane-subs" name="Radar" class="btn btn-default layer-list-item active" style="width: 100%;background-color: #fff;border:none;box-shadow: none;">
                     <input id="EP2FP" class="pull-right"  type="checkbox"> <span class="btn-text pull-left"><b>Forecast Points</b></span>
                     </label>
                  </li>
                  <li>
                     <label id="Hurricane-subs" name="Radar" class="btn btn-default layer-list-item active" style="width: 100%;background-color: #fff;border:none;box-shadow: none;">
                     <input id="EP2FT" class="pull-right"  type="checkbox"> <span class="btn-text pull-left"><b>Forecast Tracks</b></span>
                     </label>
                  </li>
                  <li>
                     <label id="Hurricane-subs" name="Radar" class="btn btn-default layer-list-item active" style="width: 100%;background-color: #fff;border:none;box-shadow: none;">
                     <input id="EP2FC" class="pull-right"  type="checkbox"> <span class="btn-text pull-left"><b>Forecast Cone</b></span>
                     </label>
                  </li>
               </ul>
               <ul  id="Hurricane-sub" style="padding-left: 15px; list-style: none;">
                  <li>
                     <label id="Hurricane-subs" name="Radar" class="btn btn-default layer-list-item active" style="width: 100%;background-color: #fff;border:none;box-shadow: none;">
                      <input id="EP3" class="pull-right" type="checkbox"> 
                     <span class="btn-text pull-left"><b>EP3</b></span></label>
                  </li>
               </ul>
               <ul  id="Hurricane-sub" style="padding-left: 25px; list-style: none;">
                  <li>
                     <label id="Hurricane-subs" name="Radar" class="btn btn-default layer-list-item active" style="width: 100%;background-color: #fff;border:none;box-shadow: none;">
                     <input id="EP3FP" class="pull-right"  type="checkbox"> <span class="btn-text pull-left"><b>Forecast Points</b></span>
                     </label>
                  </li>
                  <li>
                     <label id="Hurricane-subs" name="Radar" class="btn btn-default layer-list-item active" style="width: 100%;background-color: #fff;border:none;box-shadow: none;">
                     <input id="EP3FT" class="pull-right"  type="checkbox"> <span class="btn-text pull-left"><b>Forecast Tracks</b></span>
                     </label>
                  </li>
                  <li>
                     <label id="Hurricane-subs" name="Radar" class="btn btn-default layer-list-item active" style="width: 100%;background-color: #fff;border:none;box-shadow: none;">
                     <input id="EP3FC" class="pull-right"  type="checkbox"> <span class="btn-text pull-left"><b>Forecast Cone</b></span>
                     </label>
                  </li>
               </ul>
               <ul  id="Hurricane-sub" style="padding-left: 15px; list-style: none;">
                  <li>
                     <label id="Hurricane-subs" name="Radar" class="btn btn-default layer-list-item active" style="width: 100%;background-color: #fff;border:none;box-shadow: none;">
                      <input id="EP4" class="pull-right" type="checkbox"> 
                     <span class="btn-text pull-left"><b>EP4</b></span></label>
                  </li>
               </ul>
               <ul  id="Hurricane-sub" style="padding-left: 25px; list-style: none;">
                  <li>
                     <label id="Hurricane-subs" name="Radar" class="btn btn-default layer-list-item active" style="width: 100%;background-color: #fff;border:none;box-shadow: none;">
                     <input id="EP4FP" class="pull-right" type="checkbox"> <span class="btn-text pull-left"><b>Forecast Points</b></span>
                     </label>
                  </li>
                  <li>
                     <label id="Hurricane-subs" name="Radar" class="btn btn-default layer-list-item active" style="width: 100%;background-color: #fff;border:none;box-shadow: none;">
                     <input id="EP4FT" class="pull-right" type="checkbox"> <span class="btn-text pull-left"><b>Forecast Tracks</b></span>
                     </label>
                  </li>
                  <li>
                     <label id="Hurricane-subs" name="Radar" class="btn btn-default layer-list-item active" style="width: 100%;background-color: #fff;border:none;box-shadow: none;">
                     <input id="EP4FC" class="pull-right" type="checkbox"> <span class="btn-text pull-left"><b>Forecast Cone</b></span>
                     </label>
                  </li>
               </ul>
               <ul  id="Hurricane-sub" style="padding-left: 15px; list-style: none;">
                  <li>
                     <label id="Hurricane-subs" name="Radar" class="btn btn-default layer-list-item active" style="width: 100%;background-color: #fff;border:none;box-shadow: none;">
                      <input id="EP5" class="pull-right" type="checkbox"> 
                     <span class="btn-text pull-left"><b>EP5</b></span></label>
                  </li>
               </ul>
               <ul  id="Hurricane-sub" style="padding-left: 25px; list-style: none;">
                  <li>
                     <label id="Hurricane-subs" name="Radar" class="btn btn-default layer-list-item active" style="width: 100%;background-color: #fff;border:none;box-shadow: none;">
                     <input id="EP5FP" class="pull-right" type="checkbox"> <span class="btn-text pull-left"><b>Forecast Points</b></span>
                     </label>
                  </li>
                  <li>
                     <label id="Hurricane-subs" name="Radar" class="btn btn-default layer-list-item active" style="width: 100%;background-color: #fff;border:none;box-shadow: none;">
                     <input id="EP5FT" class="pull-right" type="checkbox"> <span class="btn-text pull-left"><b>Forecast Tracks</b></span>
                     </label>
                  </li>
                  <li>
                     <label id="Hurricane-subs" name="Radar" class="btn btn-default layer-list-item active" style="width: 100%;background-color: #fff;border:none;box-shadow: none;">
                     <input id="EP5FC" class="pull-right" type="checkbox"> <span class="btn-text pull-left"><b>Forecast Cone</b></span>
                     </label>
                  </li>
               </ul>
               <ul id="Hurricane-sub" style="padding-left: 10px; list-style: none;">
                  <li>
                     <label id="Hurricane-subs" name="Radar" class="btn btn-default layer-list-item active" style="width: 100%;background-color: #fff;border:none;box-shadow: none;">
                      <input id="AT" class="pull-right" type="checkbox"> 
                     <span class="btn-text pull-left"><b>Atlantic</b></span>   
                     </label>
                  </li>
               </ul>
               <ul id="Hurricane-sub" style="padding-left: 15px; list-style: none;">
                  <li>
                     <label id="Hurricane-subs" name="Radar"  class="btn btn-default layer-list-item active" style="width: 100%;background-color: #fff;border:none;box-shadow: none;">
                      <input id="AT1" class="pull-right" type="checkbox"> 
                     <span class="btn-text pull-left"><b>AT1</b></span></label>
                  </li>
               </ul>
               <ul id="Hurricane-sub" style="padding-left: 25px; list-style: none;">
                  <li>
                     <label id="Hurricane-subs" name="Radar" class="btn btn-default layer-list-item active" style="width: 100%;background-color: #fff;border:none;box-shadow: none;">
                     <input id="AT1FP" class="pull-right" type="checkbox"> <span class="btn-text pull-left"><b>Forecast Points</b></span>
                     </label>
                  </li>
                  <li>
                     <label id="Hurricane-subs" name="Radar" class="btn btn-default layer-list-item active" style="width: 100%;background-color: #fff;border:none;box-shadow: none;">
                     <input id="AT1FT" class="pull-right"  type="checkbox"> <span class="btn-text pull-left"><b>Forecast Tracks</b></span>
                     </label>
                  </li>
                  <li>
                     <label id="Hurricane-subs" name="Radar" class="btn btn-default layer-list-item active" style="width: 100%;background-color: #fff;border:none;box-shadow: none;">
                     <input id="AT1FC" class="pull-right"  type="checkbox"> <span class="btn-text pull-left"><b>Forecast Cone</b></span>
                     </label>
                  </li>
               </ul>
               <ul id="Hurricane-sub" style="padding-left: 15px; list-style: none;">
                  <li>
                     <label id="Hurricane-subs" name="Radar" class="btn btn-default layer-list-item active" style="width: 100%;background-color: #fff;border:none;box-shadow: none;">
                      <input id="AT2" class="pull-right" type="checkbox"> 
                     <span class="btn-text pull-left"><b>AT2</b></span></label>
                  </li>
               </ul>
               <ul  id="Hurricane-sub" style="padding-left: 25px; list-style: none;">
                  <li>
                     <label id="Hurricane-subs" name="Radar" class="btn btn-default layer-list-item active" style="width: 100%;background-color: #fff;border:none;box-shadow: none;">
                     <input id="AT2FP" class="pull-right"  type="checkbox"> <span class="btn-text pull-left"><b>Forecast Points</b></span>
                     </label>
                  </li>
                  <li>
                     <label id="Hurricane-subs" name="Radar" class="btn btn-default layer-list-item active" style="width: 100%;background-color: #fff;border:none;box-shadow: none;">
                     <input id="AT2FT" class="pull-right"  type="checkbox"> <span class="btn-text pull-left"><b>Forecast Tracks</b></span>
                     </label>
                  </li>
                  <li>
                     <label id="Hurricane-subs" name="Radar" class="btn btn-default layer-list-item active" style="width: 100%;background-color: #fff;border:none;box-shadow: none;">
                     <input id="AT2FC" class="pull-right"  type="checkbox"> <span class="btn-text pull-left"><b>Forecast Cone</b></span>
                     </label>
                  </li>
               </ul>
               <ul  id="Hurricane-sub" style="padding-left: 15px; list-style: none;">
                  <li>
                     <label id="Hurricane-subs" name="Radar" class="btn btn-default layer-list-item active" style="width: 100%;background-color: #fff;border:none;box-shadow: none;">
                      <input id="AT3" class="pull-right" type="checkbox"> 
                     <span class="btn-text pull-left"><b>AT3</b></span></label>
                  </li>
               </ul>
               <ul  id="Hurricane-sub" style="padding-left: 25px; list-style: none;">
                  <li>
                     <label id="Hurricane-subs" name="Radar" class="btn btn-default layer-list-item active" style="width: 100%;background-color: #fff;border:none;box-shadow: none;">
                     <input id="AT3FP" class="pull-right"  type="checkbox"> <span class="btn-text pull-left"><b>Forecast Points</b></span>
                     </label>
                  </li>
                  <li>
                     <label id="Hurricane-subs" name="Radar" class="btn btn-default layer-list-item active" style="width: 100%;background-color: #fff;border:none;box-shadow: none;">
                     <input id="AT3FT" class="pull-right"  type="checkbox"> <span class="btn-text pull-left"><b>Forecast Tracks</b></span>
                     </label>
                  </li>
                  <li>
                     <label id="Hurricane-subs" name="Radar" class="btn btn-default layer-list-item active" style="width: 100%;background-color: #fff;border:none;box-shadow: none;">
                     <input id="AT3FC" class="pull-right"  type="checkbox"> <span class="btn-text pull-left"><b>Forecast Cone</b></span>
                     </label>
                  </li>
               </ul>
               <ul  id="Hurricane-sub" style="padding-left: 15px; list-style: none;">
                  <li>
                     <label id="Hurricane-subs" name="Radar" class="btn btn-default layer-list-item active" style="width: 100%;background-color: #fff;border:none;box-shadow: none;">
                      <input id="AT4" class="pull-right" type="checkbox"> 
                     <span class="btn-text pull-left"><b>AT4</b></span></label>
                  </li>
               </ul>
               <ul  id="Hurricane-sub" style="padding-left: 25px; list-style: none;">
                  <li>
                     <label id="Hurricane-subs" name="Radar" class="btn btn-default layer-list-item active" style="width: 100%;background-color: #fff;border:none;box-shadow: none;">
                     <input id="AT4FP" class="pull-right" type="checkbox"> <span class="btn-text pull-left"><b>Forecast Points</b></span>
                     </label>
                  </li>
                  <li>
                     <label id="Hurricane-subs" name="Radar" class="btn btn-default layer-list-item active" style="width: 100%;background-color: #fff;border:none;box-shadow: none;">
                     <input id="AT4FT" class="pull-right" type="checkbox"> <span class="btn-text pull-left"><b>Forecast Tracks</b></span>
                     </label>
                  </li>
                  <li>
                     <label id="Hurricane-subs" name="Radar" class="btn btn-default layer-list-item active" style="width: 100%;background-color: #fff;border:none;box-shadow: none;">
                     <input id="AT4FC" class="pull-right" type="checkbox"> <span class="btn-text pull-left"><b>Forecast Cone</b></span>
                     </label>
                  </li>
               </ul>
               <ul  id="Hurricane-sub" style="padding-left: 15px; list-style: none;">
                  <li>
                     <label id="Hurricane-subs" name="Radar" class="btn btn-default layer-list-item active" style="width: 100%;background-color: #fff;border:none;box-shadow: none;">
                      <input id="AT5" class="pull-right" type="checkbox"> 
                     <span class="btn-text pull-left"><b>AT5</b></span></label>
                  </li>
               </ul>
               <ul id="Hurricane-sub" style="padding-left: 25px; list-style: none;">
                  <li>
                     <label id="Hurricane-subs" name="Radar" class="btn btn-default layer-list-item active" style="width: 100%;background-color: #fff;border:none;box-shadow: none;">
                     <input id="AT5FP" class="pull-right" type="checkbox"> <span class="btn-text pull-left"><b>Forecast Points</b></span>
                     </label>
                  </li>
                  <li>
                     <label id="Hurricane-subs" name="Radar" class="btn btn-default layer-list-item active" style="width: 100%;background-color: #fff;border:none;box-shadow: none;">
                     <input id="AT5FT" class="pull-right" type="checkbox"> <span class="btn-text pull-left"><b>Forecast Tracks</b></span>
                     </label>
                  </li>
                  <li>
                     <label id="Hurricane-subs" name="Radar" class="btn btn-default layer-list-item active" style="width: 100%;background-color: #fff;border:none;box-shadow: none;">
                     <input id="AT5FC" class="pull-right" type="checkbox"> <span class="btn-text pull-left"><b>Forecast Cone</b></span>
                     </label>
                  </li>
               </ul>
               <ul  id="Hurricane-sub" style="padding-left: 10px; list-style: none;">
                  <li>
                     <label id="Hurricane-subs" name="Radar" class="btn btn-default layer-list-item active" style="width: 100%;background-color: #fff;border:none;box-shadow: none;">
                     <span class="btn-text pull-left"><b>Probabilistic Winds</b></span></label>
                  </li>
               </ul>
               <ul  id="Hurricane-sub" style="padding-left: 15px; list-style: none;">
                  <li>
                     <label id="Hurricane-subs" name="Radar" class="btn btn-default layer-list-item active" style="width: 100%;background-color: #fff;border:none;box-shadow: none;">
                     <input id="PW34KT" class="pull-right" type="checkbox"> <span class="btn-text pull-left"><b>34kt</b></span>
                     </label>
                  </li>
                  <li>
                     <label id="Hurricane-subs" name="Radar" class="btn btn-default layer-list-item active" style="width: 100%;background-color: #fff;border:none;box-shadow: none;">
                     <input id="PW50KT" class="pull-right" type="checkbox"> <span class="btn-text pull-left"><b>50kt</b></span>
                     </label>
                  </li>
                  <li>
                     <label id="Hurricane-subs" name="Radar" class="btn btn-default layer-list-item active" style="width: 100%;background-color: #fff;border:none;box-shadow: none;">
                     <input id="PW64KT" class="pull-right" type="checkbox"> <span class="btn-text pull-left"><b>64kt</b></span>
                     </label>
                  </li>
               </ul>
            </div>
            <!-- <ul id="Hurricanes-subs" style="padding-left: 15px;list-style: none;">
              <li>
                <label id="RadarContainer" name="Radar" class="btn btn-default layer-list-item active" style="width: 100%;background-color: #fff;border:none;box-shadow: none;">
                  <input id="2dayHurricanes" class="pull-right" type="checkbox"> <span class="btn-text pull-left"><b>2 Day Probability</b></span>
                  
                </label>
              </li>
              <li>
                <label id="RadarContainer" name="Radar" class="btn btn-default layer-list-item active" style="width: 100%;background-color: #fff;border:none;box-shadow: none;">
                  <input id="5dayHurricanes" class="pull-right" type="checkbox"> <span class="btn-text pull-left"><b>5 Day Probability</b></span>
                  
                </label>
              </li>
            </ul> -->
            <!-- <br> -->
            <label id="RadarContainer" name="Radar" class="btn btn-default layer-list-item active" style="width: 100%;background-color: #fff;border:none;box-shadow: none;">
              <input id="droughts" class="pull-right" type="checkbox"> <span class="btn-text pull-left"><b>Droughts</b></span>
              <!-- 7 -->
            </label>
          </div>
          <br>
          <label id="SensorValuesChangelabel" for="SensorValuesChange" style="float: left;color: #055696;"><b>Precipitation</b></label>
          <br>
          <select class="form-control" id="SensorValuesChange">
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
        <div class="col-md-10" style="padding-right: 0px;padding-left: 0px;">
            <table style="width: 100%;height: 78%;vertical-align: top;">
              <tr>
                <td style="padding: 0px;">
                <div id="map" onload = "JavaScript:AutoRefresh(5000);"></div>
                <div id="legendRadar" class="radarLegend" style="visibility: visible;"><img alt="radar legend" src="Images/radarlegend.jpg"><br><span class="datadate" id="radarTime"></span><br>
                </div>
                <div id="qpflegend" class="qpflegend" style="visibility: visible;"><span style="text-align: center;font-size: 15px;font-family: initial;font-weight: bold;padding-left: inherit;">QPF</span><br><img alt="qpf legend" src="Images/qpflegend.png"><br><span class="datadate" id="qpfTim"></span><br>
                </div>
                <div id="HurricaneLegend" class="HurricaneLegend" style="visibility: visible;"><img alt="Hurricane legend" width="140px" height="100%" src="Images/HurricaneLegend.jpg">
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
                    <!-- popUp is called by calling the function popUp() -->
                    <a href="javascript:refresh_map(this)">
                      <img src="assets\images\refresh.png" style="width: 20;height: 20;"/>Refresh
                    </a>
                      <!-- refresh_map is called when refresh is selscted -->
                    <a href="javascript:zoomOnSite()">
                      <img src="assets\images\zoom.png" style="width: 20;height: 20;"/>Zoom On Site
                    </a>
                      <!-- when zoom is selected function zoomOnSite is called -->
                    <button type="button" class="close" onclick="close_graph()" id="close_g">&times;</button>
                      <!-- on clicking the button "X" it calls the function close_graph -->
                    <h4 style="margin-left: 5%;"  id="graphHeader"></h4>
                    <br>
                    <div id="graph" >
                    <center>
                      <img src="./StationImages/waitingIcon.gif">
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
  <!-- <div class="row" style="margin-right: 0px;">
    
    <div class="col-md-10" style="padding-right: 0px;">
      
    </div>
  </div> -->
      
  
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
    var map = L.map('map').setView([text_data[0][1], text_data[1][1]], text_dataz[2][1]);
    //var map = L.map('map').setView([text_data[0][1], text_data[1][1]], 4);
    var layer = L.esri.basemapLayer('Topographic').addTo(map);
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

      if (
        basemap === 'ShadedRelief' ||
        basemap === 'Oceans' ||
        basemap === 'Gray' ||
        basemap === 'DarkGray' ||
        basemap === 'Terrain'
      ) {
        layerLabels = L.esri.basemapLayer(basemap + 'Labels');
        map.addLayer(layerLabels);
      } else if (basemap.includes('Imagery')) {
        layerLabels = L.esri.basemapLayer('ImageryLabels');
        map.addLayer(layerLabels);
      }
    }
  }
  document
    .querySelector('#basemaps')
    .addEventListener('change', function (e) {
      var basemap = e.target.value;
      setBasemap(basemap);
    });
  /*map.addLayer(qpf);//commented by pradeep
  map.removeLayer(qpf);
  map.addLayer(qpf);
  map.removeLayer(qpf);
  map.addLayer(qpf);
  map.removeLayer(qpf);*/
  </script>
<script src="./custom/bootstrap.min.js"></script>
</body>
<?php
  function table($station)
  {
  
    $settings=pg_fetch_array(pg_query("select \"DateFormat\",\"DecimalPlaces\" from \"tblLogo\"")); 
    $sql= pg_query("SELECT * FROM \"station_sensor_type\" order by \"HydroMetParamsTypeId\"");
    if (isset($sql))
    {
      while ($tablerows = pg_fetch_array($sql))
      {
        $table1 = "'" . $tablerows['StationId'] . "'";
        $sensor_id = "'" . $tablerows['HydroMetParamsTypeId'] . "'";
        $sql_query1 = "SELECT \"StationName\" FROM \"tblStation\" where \"StationId\"=$table1 and \"StationName\"='$station' ";
        $result_set3 = pg_query($sql_query1);
    
        if (pg_num_rows($result_set3) > 0)
        {       
          while ($rows = pg_fetch_array($result_set3))
          {
            $station = $rows['StationName'];
          }
          $sql_query_station = "select * from \"tblStationLocation\" where \"StationShefCode\"='$station' order by \"StationFullName\"";
          $result_set_station = pg_query($sql_query_station);

          if (pg_num_rows($result_set_station) > 0)
          {
            while ($rows = pg_fetch_array($result_set_station))
            {
              $station = $rows['StationFullName'];
            }
          }
          $sql_query = " SELECT distinct sv.\"Sensor\",sst.\"Value\",sst.\"VirtualValue\",sv.\"SensorType\",('20'||\"Year\"::text ||'-'||\"Month\"::text ||'-'|| \"Day\" ::text ||' '||\"Hour\"::text || ':'|| \"Minute\" ::text || ':'||\"Second\")::timestamp as t FROM \"station_sensor_type\" sst,\"tblHydroMetParamsType\" hpt,\"SensorValues\" sv,\"tblStationLocation\" stl,\"tblStation\" st where sst.\"HydroMetParamsTypeId\" = hpt.\"HydroMetParamsTypeId\" and hpt.\"HydroMetShefCode\" = sv.\"SHEF\" and sst.\"StationId\" = $table1 and st.\"StationId\" = $table1 and st.\"StationName\" = stl.\"StationShefCode\" and sv.\"StationFullName\" = stl.\"StationFullName\" ";

          $html_table="<label>$station</label><br><table class='table-responsive table-hover' style='width:100%;'><thead><tr><th class='pop_th'>Date</th><th class='pop_th'>Sensor</th><th class='pop_th'>Value</th></tr></thead><tbody>";
          $result_sensor=pg_query($sql_query);

          if (pg_num_rows($result_sensor) > 0)
          {
            while ($rows = pg_fetch_array($result_sensor))
            {
              $date =strtotime(trim($rows[4]));
              $date=date(trim($settings[0]),$date);
              $sensor="";
              if (strpos($rows[3],'V')=== false) 
              {
                $sensor=floatval($rows['Value']);
              }
              else
              {
                $sensor=floatval($rows['VirtualValue']);
              }
              if (trim($sensor)=="") 
                $sensor=floatval($rows['Value']);
              $html_table.="<tr><td>".$date."</td><td>".$rows['Sensor']."</td><td>".$sensor."</td></tr>";
            } 
          } 
          $html_table.="</tbody></table>";
        }
      }
    }
    return  $html_table;
  }
  echo "<script>document.getElementById('date_format').value='$settings[0]'</script>";
 
  function getStationName($Name)
  {
    $stn_name="";
    $stn_types_set=pg_query("select \"StationType\" from \"tblStationType\"");
    while ($row_types=pg_fetch_array($stn_types_set)) {
      $table=str_replace(" ", "_", $row_types[0]);
      $stn_set= pg_query("select \"Station_Full_Name\" from \"$table\" where  \"Station_Shef_Code\"='$Name'");
      if (pg_num_rows($stn_set)>0) {
        $row=pg_fetch_array($stn_set);
        $stn_name=$row[0];
      }
    }
    return $stn_name;
  } 

  function getSensorShef($stn_name,$sensor,$type)
  {
    $result=pg_query("SELECT \"Sensor\"  FROM \"SensorValues\" where \"StationFullName\"='$stn_name' and \"SHEF\"='$sensor' and \"SensorType\"='$type'");
    $row=pg_fetch_array($result);
    $name=$row[0];
    return $name;
  }

  function updatecurrentValues($sensor)
  {
    $year=date("y");
    $result_stn=pg_query("select \"StationFullName\",\"StationShefCode\" from \"tblStationLocation\"");
    while ($row_stn=pg_fetch_array($result_stn))
    {
      $result_sen=pg_query("select \"SHEF\" from \"SensorValues\" WHERE \"Sensor\"='$sensor' and \"StationFullName\"='$row_stn[0]'");
      if (pg_num_rows($result_sen)>0) {
        $row_sen=pg_fetch_array($result_sen);
        $result_sen_id=pg_query("select \"HydroMetParamsTypeId\" from \"tblHydroMetParamsType\" where \"HydroMetShefCode\"='$row_sen[0]'");
        if (pg_num_rows($result_sen_id)>0) {
          $row_sen_id=pg_fetch_array($result_sen_id);
          $tableName="tblStation_$row_stn[1]_$year";
          $result_val=pg_query("SELECT  distinct on (\"HydroMetParamsTypeId\") \"HydroMetParamsTypeId\",\"Year\", \"Month\", \"Day\", \"Hour\", \"Minute\", \"Second\",  \"Value\",  \"Interval\", \"VirtualValue\", sensortype, \"Flag\", \"AlarmFlag\" FROM \"'".$tableName."'\" where \"HydroMetParamsTypeId\"='$row_sen_id[0]'  order by \"HydroMetParamsTypeId\",('20'||\"Year\"::text ||'-'|| \"Month\"::text ||'-'|| \"Day\" ::text ||' '|| \"Hour\"::text || ':' || \"Minute\" ::text || ':' || \"Second\")::timestamp desc");
          if (pg_num_rows($result_val)>0) {
            $row_data=pg_fetch_array($result_val);

            $value=$row_data['Value'];
            $value1=$row_data['VirtualValue'];
            $value2=$row_data['sensortype'];
            if($sensor=='Stage')
            {
              pg_query("update \"tblStationLocation\" set \"CurrentValue\"='$value' where \"StationFullName\"='$row_stn[0]'");
            }
            else if($sensor=='Reservoir Level')
            {
              pg_query("update \"tblStationLocation\" set \"CurrentValue\"='$value' where \"StationFullName\"='$row_stn[0]'");
            }
            else{
              if($value2 == 'Virtual'){
                pg_query("update \"tblStationLocation\" set \"CurrentValue\"='$value1' where \"StationFullName\"='$row_stn[0]'");
              }
              else 
              {
                pg_query("update \"tblStationLocation\" set \"CurrentValue\"='$value' where \"StationFullName\"='$row_stn[0]'");
              }
            }
          }
          else{
            pg_query("update \"tblStationLocation\" set \"CurrentValue\"='' where \"StationFullName\"='$row_stn[0]'");
          }
        }
      }
      else
      {
        pg_query("update \"tblStationLocation\" set \"CurrentValue\"='' where \"StationFullName\"='$row_stn[0]'");
      }
    }
  }
  function setMarker(){
    include_once 'editcompany.php';

$company=$_SESSION["company"];

 $settings=pg_fetch_array(pg_query("select \"DateFormat\",\"DecimalPlaces\" from \"tblLogo\""));
 //From the query it selects date format and also the number of decimal places for the value

 // echo "select \"DateFormat\",\"DecimalPlaces\" from \"tblLogo\"";
 //echo "select \"CurrentValue\",lat,lon,\"StationShefCode\",\"AlarmFlag\" from \"tblStationLocation\"";
//for all stations $result=pg_query("select \"CurrentValue\",lat,lon,\"StationShefCode\",\"AlarmFlag\" from \"tblStationLocation\"");
//for specific station $result=pg_query("select DISTINCT \"CurrentValue\",lat,lon,\"StationShefCode\",\"AlarmFlag\" from \"tblStationLocation\", \"tblCompany2Station\" where \"StationShefCode\" = \"Station\" and \"Company\" = 'Sutter'");
if($company=='Hydromet'){

 $result=pg_query("select \"CurrentValue\",\"lat\",\"lon\",\"StationShefCode\",\"AlarmFlag\" from \"tblStationLocation\"");
}
else{

  $result=pg_query("select DISTINCT \"CurrentValue\",lat,lon,\"StationShefCode\",\"AlarmFlag\" from \"tblStationLocation\", \"tblCompany2Station\" where \"StationShefCode\" = \"Station\" and \"Company\" = '$company' order by \"StationShefCode\"");
}
$output=[];
//This query selects the data of current value along with the shef code with respective to the lat and lon of the station

//echo pg_num_rows($result);
while ($row=pg_fetch_array($result)) {
  // In the condition we fetch the result of $result query into $row as array
  $str.=$row[0]."--";
if($row[0]!=" ")
{
if (trim($row[0])!="") {
  
  $output[]=number_format(floatval($row[0]),$settings[1],'.','')."#".$row[1]."#".$row[2]."#".$row[3]."#".$row[4];
  //The data is set with the setting selected and in row array after each array element '#' is been added like after row[0]#row[1]....
  
}else{
   // $output[]=$row[0]."#".$row[1]."#".$row[2]."#".$row[3]."#".$row[4];
   }
}
}
//echo $str;
return json_encode($output);

  }
  function setTable(){
    include_once 'editCompany.php';

$company=$_SESSION["company"];

if($company=='Hydromet'){
  $result=pg_query("select \"StationShefCode\",\"CurrentValue\" from \"tblStationLocation\"");
}
else{
  $result=pg_query("select \"StationShefCode\",\"CurrentValue\" from \"tblStationLocation\", \"tblCompany2Station\" where \"StationShefCode\" = \"Station\" and \"Company\" = '$company' order by \"StationShefCode\"");
  
}

//we select "StationShefCode" and "currentValue" from the table "tblStationLocation" and upadate the output into the variable $result

$data=[];
while ($row=pg_fetch_array($result)) {
//while the $result is fetched into the array into the $row the loop continues
if($row[1]!=""){
  $tem=table1(trim($row[0]));
  $data[]=$tem;
}
}
return json_encode($data);
}
  function table1($station)
{
  
  $settings=pg_fetch_array(pg_query("select \"DateFormat\",\"DecimalPlaces\" from \"tblLogo\"")); 
//From the query we selects date format and also the number of decimal places for the value

  $sql= pg_query("SELECT * FROM \"station_sensor_type\" ");
//select all from table "station_sensor_type"
  
  if (isset($sql))
    //if $sql have data
  {
  while ($tablerows = pg_fetch_array($sql))
    //while the $sql is fetched into the array into the $tablerows the loop continues
    {
    $table1 = "'" . $tablerows['StationId'] . "'";
    $sensor_id = "'" . $tablerows['HydroMetParamsTypeId'] . "'";
    $sql_query1 = "SELECT \"StationName\" FROM \"tblStation\" where \"StationId\"=$table1 and \"StationName\"='$station' ";
    //different station names are selected from table "tblStation" matching the conditions like matching stationID and StationName
    $result_set3 = pg_query($sql_query1);
    
    if (pg_num_rows($result_set3) > 0)
      //if the number of rows for the $result_set3 variable are > 0 
      {       
       
      while ($rows = pg_fetch_array($result_set3))
        //while the $result_set3 is fetched into the array into the $rows the loop continues
        {
        
          $station = $rows['StationName'];
        }
         $sql_query_station = "select * from \"tblStationLocation\" where \"StationShefCode\"='$station' ";
           // echo $sql_query_station."<br>" ;

            $result_set_station = pg_query($sql_query_station);

      if (pg_num_rows($result_set_station) > 0)
        //if the number of rows for the $result_set_station variable are > 0 
      {       
       
      while ($rows = pg_fetch_array($result_set_station))
        //while the $result_set_station is fetched into the array into the $rows the loop continues
        {
        
          $station = $rows['StationFullName'];
           // echo $station."<br>" ;
        }
      }
           // $sql_query = "SELECT t1.\"HydroMetParamsName\",s.\"Value\" FROM \"station_sensor_type\" s INNER JOIN \"tblHydroMetParamsType\" t1 on t1.\"HydroMetParamsTypeId\"=s.\"HydroMetParamsTypeId\" where \"StationId\"=$table1 ";

//In the following the query we select the time stamp from the various tables and with a condition given below

           $sql_query = " SELECT distinct sv.\"Sensor\",sst.\"Value\",sst.\"VirtualValue\",sv.\"SensorType\"
           ,sv.\"Units\",('20'||\"Year\"::text ||'-'||\"Month\"::text ||'-'|| \"Day\" ::text ||' '||\"Hour\"::text || ':'|| \"Minute\" ::text || ':'||\"Second\")::timestamp as t

FROM 
\"station_sensor_type\" sst,
\"tblHydroMetParamsType\" hpt,
\"SensorValues\" sv,
\"tblStationLocation\" stl,
\"tblStation\" st
where 
sst.\"HydroMetParamsTypeId\" = hpt.\"HydroMetParamsTypeId\" and 
hpt.\"HydroMetShefCode\" = sv.\"SHEF\" and
sst.\"StationId\" = $table1 and
st.\"StationId\" = $table1 and
st.\"StationName\" = stl.\"StationShefCode\" and 
sv.\"StationFullName\" = stl.\"StationFullName\"";




           
           $html_table="<label>$station</label><br><table class='table-responsive table-hover' style='width:100%;'><thead><tr><th class='pop_th'>Date</th><th class='pop_th'>Sensor</th><th class='pop_th'>Value</th></tr></thead><tbody>";
          $result_sensor = pg_query($sql_query);
     
          if (pg_num_rows($result_sensor) > 0)
            //if the number of rows for the $result_sensor variable are > 0
          {
            
            while ($rows = pg_fetch_array($result_sensor))
              //while the $result_sensor is fetched into the array into the $rows the loop continues
            {


                     $date =strtotime(trim($rows[5]));

                        

                        $date=date(trim($settings[0]),$date);

                       
                        

                         $sensor="";
                        if (strpos($rows[3],'V')=== false) 
                        {
                          
                            $sensor=number_format(floatval($rows['Value']),2);
                       }
                      else
                      {
                       
                        $sensor=number_format(floatval($rows['VirtualValue']),2);
                        // $rows['VirtualValue'];

                       }
                       if (trim($sensor)=="") 
                       $sensor=number_format(floatval($rows['Value']),2);
            
                     if($rows['Units']!=""){
                $html_table.="<tr><td>".$date."</td><td>".$rows['Sensor']." "."(".$rows['Units'].")"."</td><td>".$sensor."</td></tr>";
              }
              else{
                $html_table.="<tr><td>".$date."</td><td>".$rows['Sensor']."</td><td>".$sensor."</td></tr>";
              }

             
              
            } 
          } 
          $html_table.="</tbody></table>";
      }
    }
  }
  
return  $html_table;
}

  function UpdatestationLocation(){
    $sensor="Stage";
$year=date("y");

$result_stn=pg_query("select \"StationFullName\",\"StationShefCode\" from \"tblStationLocation\"");
//All the stationFullName and the StationShefCode is selected from the table "tblStationLocation" and are sent to variable $result

  pg_query("update \"tblStationLocation\" set \"CurrentValue\"=''");
  // In the Table "tblStationLocation" all current values are set to ' '

while ($row_stn=pg_fetch_array($result_stn))
  //while the $result_stn is fetched into the array into the $row_stn the loop continues
{

$result_sen=pg_query("select \"SHEF\",\"SensorType\" from \"SensorValues\" WHERE \"Sensor\"='$sensor' and \"StationFullName\"='$row_stn[0]'");
//All the Shef column data is selected from the SensorValues with a condition matching the selected sensor and stationFullName


if (pg_num_rows($result_sen)>0) {
//if the number of rows for the $result_sen variable are > 0 

$row_sen=pg_fetch_array($result_sen);
//From the query we fetch $result_sen into array to variable $row_sen

$valuecol;
if(trim($row_sen[1])=="Real")
  //if $row_sen[1]==Real
  $valuecol="Value";
else
$valuecol="VirtualValue";
$result_sen_id=pg_query("select \"HydroMetParamsTypeId\" from \"tblHydroMetParamsType\" where \"HydroMetShefCode\"='$row_sen[0]'");
//The HydroMetParamsTypeId is been selected from the table "tblHydroMetParamsType" matching the condition "HydroShefCode"= data of $row_sen[0]

//echo "$valuecol";
if (pg_num_rows($result_sen_id)>0) {
  //if the number of rows for the $result_sen_id variable are > 0 


$row_sen_id=pg_fetch_array($result_sen_id);
//From the query we fetch $result_sen_id into array to variable $row_sen_id

$tableName="tblStation_$row_stn[1]_$year";
if($tableName=='tblStation_SF10_18')

{
  //echo "SELECT  distinct on (\"HydroMetParamsTypeId\") \"HydroMetParamsTypeId\",\"Year\", \"Month\", \"Day\", \"Hour\", \"Minute\", \"Second\",  \"Value\",  \"Interval\", \"VirtualValue\", sensortype, \"Flag\", \"AlarmFlag\" FROM \"'".$tableName."'\" where \"HydroMetParamsTypeId\"='$row_sen_id[0]'  order by \"HydroMetParamsTypeId\",('20'||\"Year\"::text ||'-'|| \"Month\"::text ||'-'|| \"Day\" ::text ||' '|| \"Hour\"::text || ':' || \"Minute\" ::text || ':' || \"Second\")::timestamp desc";
}
//In the following the query we select the time stamp from the various tables and with a condition given below

$result_val=pg_query("SELECT  distinct on (\"HydroMetParamsTypeId\") \"HydroMetParamsTypeId\",\"Year\", \"Month\", \"Day\", \"Hour\", \"Minute\", \"Second\",  \"$valuecol\",  \"Interval\", sensortype, \"Flag\", \"AlarmFlag\" FROM \"'".$tableName."'\" where \"HydroMetParamsTypeId\"='$row_sen_id[0]'  order by \"HydroMetParamsTypeId\",('20'||\"Year\"::text ||'-'|| \"Month\"::text ||'-'|| \"Day\" ::text ||' '|| \"Hour\"::text || ':' || \"Minute\" ::text || ':' || \"Second\")::timestamp desc");
//echo pg_num_rows($result_val)."--".$row_stn[0];

if (pg_num_rows($result_val)>0) {
  
$row_data=pg_fetch_array($result_val);
//From the query we fetch $result_val into array to variable $row_data

$value=$row_data[$valuecol];
//$value1=$row_data['VirtualValue'];
//$value2=$row_data['sensortype'];


  pg_query("update \"tblStationLocation\" set \"CurrentValue\"='$value' where \"StationFullName\"='$row_stn[0]'");
  // In the Table "tblStationLocation" all current values are set to $value where the condition stationFullName is matched
}
}
}
else
{
  pg_query("update \"tblStationLocation\" set \"CurrentValue\"='' where \"StationFullName\"='$row_stn[0]'");
  // In the Table "tblStationLocation" all current values are set to ' ' where the condition stationFullName is matched
}

}
return true;

  }
?>

</html>