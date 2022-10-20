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
            // diferent layers are being called from the different address to show the required types of map over the map
                 map = L.map('map').setView([39.32, -90.36], 4);
            //   var map = L.map('map').setView([25.00, 77.00], 5);
               L.control.scale({ position: 'bottomleft' }).addTo(map);
               //L.control.navbar({ position: 'bottomright' }).addTo(map);
               //L.Control.boxzoom({ position: 'topleft' }).addTo(map);
               //L.Control.Zoom({ position: 'topright' }).addTo(map);
               googleHybrid = L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {
                   subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
               });


               googleStreets = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
                   maxZoom: 20,
                   subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
               });

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