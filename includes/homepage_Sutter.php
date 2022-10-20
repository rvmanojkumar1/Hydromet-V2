<script src="./js/moment.js" type="text/javascript"></script>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>



  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/dygraph/1.0.1/dygraph-combined.js"></script>
 
<script src="./js/dygraph-extra.js"></script>

   <!-- =====================Graph ===============================-->

<link rel="stylesheet" type="text/css" href="/Sutter/assets/Control.FullScreen.css">
<script type="text/javascript" src="/Sutter/assets/Control.FullScreen.js"></script>
   
 


<link rel="stylesheet" type="text/css" href="/Sutter/assets/css/MyTable.css"> 



  <!--<link rel="stylesheet" href="MarkerCluster.css"/>
 <link rel="stylesheet" href="MarkerCluster.Default.css"/>-->
 
  <!--<script src="leaflet.markercluster.js"></script>-->
  
  <!--markerCluster start-->
  <link rel="stylesheet" type="text/css" href="js/leaflet/leaflet.css" />
    <link rel="stylesheet" type="text/css" href="http://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/0.4.0/MarkerCluster.css" />
    <link rel="stylesheet" type="text/css" href="http://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/0.4.0/MarkerCluster.Default.css" />

    <!--<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js'></script>-->
    <script type='text/javascript' src="js/leaflet/leaflet.js"></script>
    <script type='text/javascript' src='http://cdnjs.cloudflare.com/ajax/libs/leaflet.markercluster/1.4.1/leaflet.markercluster.js'></script>
  
  <!--markerCluster start-->
  
<style type="text/css">

    .fullscreen-icon { 
      background-image: url("/Sutter/assets/images/expand.png");
       }
    
  </style>


<style type="text/css">
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
   </style>



<?php

if (!isset($_GET['sensor'])) {
 

pg_query("update \"tblStationLocation\" set \"CurrentValue\"=''");
updatecurrentValues("Stage");
}
else
{
  pg_query("update \"tblStationLocation\" set \"CurrentValue\"=''");
  

  updatecurrentValues(trim($_GET['sensor']));
  
}
?>

<?php
 $settings=pg_fetch_array(pg_query("select \"DateFormat\",\"DecimalPlaces\" from \"tblLogo\"")); 

// for all stations $result=pg_query("select DISTINCT \"CurrentValue\",lat,lon,\"StationShefCode\",\"AlarmFlag\" from \"tblStationLocation\"");

// for specific station 

 $result=pg_query("select DISTINCT \"CurrentValue\",lat,lon,\"StationShefCode\",\"AlarmFlag\" from \"tblStationLocation\", \"tblCompany2Station\" where \"StationShefCode\" = \"Station\" and \"Company\" = 'Sutter'");



$output=[];
$data=[];
while ($row=pg_fetch_array($result)) {
// echo json_encode($row)."<br>";
$output[]=number_format(floatval($row[0]),$settings[1])."#".$row[1]."#".$row[2]."#".$row[3]."#".$row[4];
  $tem=table(trim($row[3]));
  $data[]=$tem;

if (trim($row[0])!="") {
  }
else{
 //   $output[]=$row[0]."#".$row[1]."#".$row[2]."#".$row[3]."#".$row[4];
  // $tem=table(trim($row[3]));
}


}


$z=0;


?>
  

    <script type="text/javascript">
        var googleStreets, googleHybrid,openstreet;
var lat_G=0,lon_G=0;

   var sensor="Stage";
   var marker=[];
            var color="";
              var Fcolor="";

         obj={};
      var text_data=new Array();
      var count=0;
      var markerClusters=null;
      var colors=new Array();
      var Fcolors=new Array();
      var timeStart = new Date(); //Date format YY-MM-DD TIME
     timeStart.setMinutes(timeStart.getMinutes()-90);//120 is the number of minutes to be substracted from the current date
      //window.alert(timeStart);


   function updatevalues(textdata,data_sensors,output)
  {
    // console.log(data_sensors);

    Fcolors=[];
    colors=[];

    // console.log(textdata);



  var data_sensor=new Array();

      // for (i=0;i<textdata.length;i++)
      // {
      //    console.log(textdata[i]);
        
      // }   
      count=0;
      for (i=0;i<data_sensors.length;i++)
      {
        //window.alert(data_sensors[i]);
        if(data_sensors[i]==null || data_sensors[i]=="" )
      {
       
        continue;
      
      }
       data_sensor[count++]=data_sensors[i].replace(/<[^>]+>/g, ',');
      

      }


      
   station_sensor=new Array();
      for(i=0;i<data_sensor.length;i++)
      {
          // console.log(data_sensor[i]);
        // for(j=0;j<data_sensor[i].length;j++)
        station_sensor[i]=data_sensor[i].split(',');
         // console.log(station_sensor[i]);
    //  window.alert(station_sensor[i]);
      }
      for(i=0;i<station_sensor.length;i++)
      {

            for(c=17;c<station_sensor[i].length-8;c=c+8)
            {

                  if(sensor.toLowerCase()==station_sensor[i][c+2].toLowerCase())
                  {
                    //window.alert(station_sensor[i][8]);
                    var timeEnd = new Date(station_sensor[i][c]);
                    var diff = (timeEnd - timeStart) / 60000; //dividing by seconds and milliseconds

                    var minutes = diff % 60;
                    // console.log(minutes+"------"+station_sensor[i][1]);
                    var hours = Math.abs((diff - minutes) / 60);


                    if(diff<0)
                    {
                      colors[i]="grey";
                      Fcolors[i]="white";
                      // console.log(colors[i]);
                      // console.log(station_sensor[i][c+2]+"----"+diff+"------"+station_sensor[i][1]);

                    }
                    else
                    {
                      colors[i]="color";
                      // console.log(colors[i]);
                      // console.log(diff+"------"+station_sensor[i][1]);
                    }
                  }      
                    
                    // console.log(diff+"------"+station_sensor[i][1]);

                    
            }
            if(!colors[i])
            {
              // colors[i]="grey";
              // console.log(station_sensor[i][17]);
              var timeEnd = new Date(station_sensor[i][17]);
                    var diff = (timeEnd - timeStart) / 60000; //dividing by seconds and milliseconds

                    var minutes = diff % 60;
                    // console.log(minutes+"------"+station_sensor[i][1]);
                    var hours = Math.abs((diff - minutes) / 60);


                    if(diff<0)
                    {
                      colors[i]="grey";
                      Fcolors[i]="white";
                      // console.log(colors[i]);
                      // console.log(station_sensor[i][c+2]+"----"+diff+"------"+station_sensor[i][1]);

                    }
                    else
                    {
                      colors[i]="color";
                      // console.log(colors[i]);
                      // console.log(diff+"------"+station_sensor[i][1]);
                    }

             
                   
            }

            

        for(j=0;j<textdata.length;j++)
        {

          // console.log(colors[i]);

          if(colors[i]=="color")
          {
           // window.alert(textdata[j][0]);
           // window.alert(station_sensor[i][1])
            if(textdata[j][0]==station_sensor[i][1])
          {
            
            for(k=21;k<station_sensor[i].length;k=k+8)
            {
              // console.log(i+"  "+station_sensor[i][k-2]+"  "+textdata[j][1]);
              if(station_sensor[i][k-2].toLowerCase() == textdata[j][1].toLowerCase() && sensor.toLowerCase()== station_sensor[i][k-2].toLowerCase()  )
                //document.w(station_sensor[i][k-2]);
              {
                // console.log(i+"  "+station_sensor[i][k-2]+"  "+textdata[j][0]);
                // console.log(station_sensor[i][k-2]);

                  if(station_sensor[i][k] <= textdata[j][2] )
                  {
          //  window.alert(station_sensor[i][k]);
                    // console.log(textdata[j][0]+"   yellow   "+station_sensor[i][k]);
                      colors[i]="green";
                      Fcolors[i]="white";
                      //window.alert(sensore_sensor[i][k]);
                  }
                  else if(station_sensor[i][k] > textdata[j][2] && station_sensor[i][k] <= textdata[j][3])
                  {
                      colors[i]="yellow";
                      Fcolors[i]="grey";
                    // console.log(textdata[j][0]+"   red  "+station_sensor[i][k]);
                  }
          else if(station_sensor[i][k] > textdata[j][3] && station_sensor[i][k] <= textdata[j][4])
          {
                      colors[i]="orange";
                      Fcolors[i]="white";
          }
            
			else{
             colors[i]="red";
             Fcolors[i]="white";
                    // console.log(textdata[j][0]+"  orange "+station_sensor[i][k]);
              }
                   
                  break;
                  // return;
              }

             
              
            }
            
            // break;
          }
          }
          
         
        }

               // console.log(colors[i]+"------------"+station_sensor[i][1]);
              if(colors[i]=="color" )
              {
                 colors[i]="green";
                 Fcolors[i]="white";//for the values doen't follows v1,v2 and v3.
                  // console.log(colors[i]+"------------"+station_sensor[i][1]);
              }
        // console.log(obj[i]);
      //  window.alert(Fcolors);
        console.log(colors[i]+"-----"+i);
      }
          // console.log(marker.length);
           for (var i = 0; i < marker.length; i++) 
           {
              if (marker[i] != undefined)
              {
                    map.removeLayer(marker[i]); 
                    markerClusters.removeLayer(marker[i]);
              }
           }
     
    // if(markercluster!=null)
 // else
//markerClusters =L.markerClusterGroup();
             
  
       var color_count=0;
          
            for (var i = 0; i < output.length; i++) {

            icon_data=[];
            icon_sensor=[];
            console.log(color_count+"-----"+colors[color_count]+"-----"+i);
                // console.log(i+"----data_seinsors----"+data_sensors[i]);


                // console.log(i+"--------"+"data_sensor"+data_sensor[i]);

                if(data_sensors[i]==null || data_sensors[i]=="" )
                {
                
                  // data_sensors[i]
                  continue;
                   
                }

                


              // if(!colors[i] )
              // {

              //   colors[i]="green";//for the values doen't follows v1,v2 and v3.
              //   // console.log(colors[i]+"------------"+i);

              // }

                // if(data_sensor[i]==null || data_sensor[i]=="" )
                // {
                
                //   // data_sensors[i]
                //   continue;
                
                // }
              // console.log(colors[i]+"-------"+i);

              var lat_lon=output[i].split("#");

              // console.log(lat_lon[3]);
              // console.log(colors[i]+"------------"+i+"-----"+lat_lon[3]+data_sensors[i]);
          
 var lat=lat_lon[1].split(" ");

   var lon=lat_lon[2].split(" ");
   try
   {
      lat_G=ConvertDMSToDD(lat[0], lat[1], lat[2], lat[3].toUpperCase());
      lon_G= ConvertDMSToDD(lon[0], lon[1], lon[2], lon[3].toUpperCase());
        }catch(exx)
        {
          lat_G=lat_lon[1];
          lon_G=lat_lon[2];
        }
        var markerOptions={};

       // console.log(lat_lon);
       if(lat_lon[0] == "0.00")
       {
        icon_data=data_sensors[i].replace(/<[^>]+>/g, ',');
        icon_sensor=icon_data.split(',');
        // console.log(icon_sensor);
      // window.alert(icon_sensor);

        for(k=0;k<icon_sensor.length;k++)
        { 
          //window.alert(icon_sensor[k]);
          if(icon_sensor[k]=="Stage")
          {

            
            // console.log(icon_sensor[k+2]+"Stage");
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

                // for(j=0;i<icon_sensor[].length;j++)
                // {
                //   console.log(icon_sensor[j]);
                // }

                  // console.log()

                 
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

          // console.log(i+"data_sensors"+data_sensors[i]);
    

      marker[i] = L.marker([lat_G,lon_G],markerOptions).bindPopup(data_sensors[i], {
          maxWidth : 560});
        this.markerClusters.addLayer(marker[i]);

//        markerClusters.addLayer(marker[i]);
    
      marker[i].on('mouseover',function() {
                this.openPopup();
               // var Popup = L.Popup().setLatLng(e.latlng).setContent('Popup').openOn(map);
        });
            
            marker[i].on('click',function() {
              // console.log(ev);
                plotGraph("marker",this);
        });
        marker[i].on('mouseout', function () {
              this.closePopup();
            });         
            
    }
         // map.removeLayer(markerClusters);

              map.addLayer(markerClusters);
        // alert(markerClusters)
      
     
  }
  
//   console.log(count);
//   for (i=0;i<textdata.length;i++)
// {
// console.log(text_data[i]);

// }
   <!--my code start-->
   //this.markerCluster = new MarkerCluster(this.map,[]);
  // var markers = new L.MarkerClusterGroup();

//markers.addLayer(L.marker([9.64222777777778,-121.08971666666666]));
// add more markers here...

//map.addLayer(markers);
  <!--my code end-->
 
 
    function setMarkers(output,data)
    {
    
    // console.log(output);

  
  $.ajax({
    url:'./COLOR.txt',
    success: function (respon){
   
    obj=respon.split('\n'); 
   
    for(var i=0;i<obj.length;i++)
    {
      text_data[i]=obj[i].split(',');
      count++;
    
    }
    updatevalues(text_data,data,output);

     // $('#loading_pop').modal('hide');
    }

    
  });

      

    }     function showSattellite() {
       
               map.removeLayer(googleHybrid);
               map.removeLayer(googleStreets);
                map.removeLayer(openstreet);

               googleHybrid.addTo(map);
$(".c_val").css("border-color","gray");

/*hydrometstations_wms = L.tileLayer.wms("http://64.30.125.108:8045/geoserver/cite/wms", {
                   layers: 'cite:tblStationLocation',
                   format: 'image/png',
                   styles: 'cite:Hydromet',
                   transparent: true
               });
               hydrometstations_wms.addTo(map);*/
             
           }
           function showStreetmap() {
               map.removeLayer(googleHybrid);
               map.removeLayer(googleStreets);
                map.removeLayer(openstreet);

               googleStreets.addTo(map);
$(".c_val").css("border-color","black");

/*hydrometstations_wms = L.tileLayer.wms("http://64.30.125.108:8045/geoserver/cite/wms", {
                   layers: 'cite:tblStationLocation',
                   format: 'image/png',
                   styles: 'cite:Hydromet',
                   transparent: true
               });
               hydrometstations_wms.addTo(map);*/
           }

          function showOpenStreetMap()
          {
  map.removeLayer(googleHybrid);
               map.removeLayer(googleStreets);
                map.removeLayer(openstreet);

                openstreet.addTo(map);
                $(".c_val").css("border-color","black");

              /*  hydrometstations_wms = L.tileLayer.wms("http://64.30.125.108:8045/geoserver/cite/wms", {
                   layers: 'cite:tblStationLocation',
                   format: 'image/png',
                   styles: 'cite:Hydromet',
                   transparent: true
               });
               hydrometstations_wms.addTo(map);*/
          }
           $(document).ready(function () {



              $.ajax({
    url:'./lat_lon_zoom.txt',
    success: function (respon){
   
    obj=respon.split('\n'); 
   
    for(var i=0;i<obj.length;i++)
    {
      text_data[i]=obj[i].split(':');
      // console.log(text_data[i][1]);
    
    }

    
    var check=<?php echo json_encode($check); ?>;
          
          map = L.map('map', {
fullscreenControl: true,
fullscreenControlOptions: {
position: 'topleft'
}
}).setView([text_data[0][1],text_data[1][1]], text_data[2][1]); 
    L.control.scale({ position: 'bottomleft' }).addTo(map);

    
    googleHybrid = L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {
                  subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
              });


              googleStreets = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
                  maxZoom: 20,
                  subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
              });

              googleStreets.addTo(map);

       openstreet= L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
   attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
});
     markerClusters =L.markerClusterGroup({maxClusterRadius: 40
});

     var output=<?php echo json_encode($output);?>;
var data=<?php echo json_encode($data);?>;



              
       setMarkers(output,data); 

    }

    
  });


        
 



/*hydrometstations_wms = L.tileLayer.wms("http://64.30.125.108:8045/geoserver/cite/wms", {
                   layers: 'cite:tblStationLocation',
                   format: 'image/png',
                   styles: 'cite:Hydromet',
                   transparent: true
               });
               hydrometstations_wms.addTo(map);*/
              // var z=0;
 /*    for (var i = 0; i < output.length; i++) {
                  var lat_lon=output[i].split("#");
 var xhttp=new XMLHttpRequest();

 xhttp.onreadystatechange=function()
               {


               if (xhttp.readyState==4&&xhttp.status==200) 
               {
                data[z]=this.responseText;
                alert(this.responseText);
                z++;
        }
             };
             var stn=lat_lon[3];
             xhttp.open("GET","includes/getLastData.php?stn="+stn,true);
             xhttp.send();
              }*/
      

             /*   map.on('click', function (e) {

            plotGraph("map",e);



           });*/

 $("#list_of_map_view").change(function(e){

      var latlon=$("#list_of_map_view option:selected").val();

  var lat_lon=latlon.split("#");
      // console.log(lat_lon);
      
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
map.setView([lat_G,lon_G], 10);
                  
               });

 

  $("#list_of_stns").change(function(e){
                 
      var latlon=$("#list_of_stns option:selected").val();

  

      var lat_lon=latlon.split("#");
      // console.log(lat_lon);
       // alert(lat_lon);
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

      
map.setView([lat_G,lon_G], 13);
                   plotGraph("dropdown",e);
               });

    });

function ConvertDMSToDD(degrees, minutes, seconds, direction) {   
    var dd = Number(degrees) + Number(minutes)/60 + Number(seconds)/(60*60);

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
 };
 var stn=$("#graphHeader").text();
xhttp.open("GET","includes/LatLonfromStationName.php?stn="+stn,true);
 xhttp.send();
}
               function plotGraph(graph_from,e)
               {

$('#myModal').modal('show');
$("#graph_div").css("display","");
$("#graph").html('<center><img src="/Sutter/StationImages/waitingIcon.gif"></center>');
               
                     var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {

//alert(this.responseText);
      var json = this.responseText;
var ress = JSON.parse(json);
//console.log(ress);

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
// console.log(data);
for(var x in data)
{




  if(isvaliddate(data[x]))
  {
table+="</tr><td>"+moment(data[x].replace(/"/g ,"").trim(),['YYYY-MM-DD h:m A']).format(date_format)+"</td>";

  }
  else
  {

table+="<td>"+data[x].toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",")+"</td>";
  }
}
}
 document.getElementById("graph_data").innerHTML=table;
 document.getElementById("graph_data").getElementsByTagName("tr")[0].style=" background-color:#539CCC;color:white";
        try
{
var g2=  new Dygraph(document.getElementById("graph"),
json , {
legend : "follow",
showRangeSelector: true,  
xlabel: 'Hours/Date',
ylabel: 'Values', 
drawPoints: true, 
connectSeparatedPoints: true,
                        
                        }
           );
//g2.resize(600,400);
 // alert(g2);

}catch(ex)
{

document.getElementById("graph").innerHTML = "No Data Found!";
}

    }
  };
  if (graph_from=="map") {
  //  alert("includes/gotograph.php?lat="+e.latlng.lat+"&lon="+e.latlng.lng);
  xhttp.open("GET", "includes/gotograph.php?lat="+e.latlng.lat+"&lon="+e.latlng.lng, true);
}
if (graph_from=="marker") 
{
    
 var temp= e.getLatLng();
   temp=temp+"";
 var temp2=temp.substring(0, temp.length - 1).split("(");

 var temp3=temp2[1].split(",");

    xhttp.open("GET", "includes/gotograph.php?lat="+temp3[0]+"&lon="+temp3[1], true);

}
if (graph_from=="dropdown") {
  var stn=$("#list_of_stns option:selected").text();

    xhttp.open("GET", "includes/gotograph.php?stn="+stn, true);

}
if (graph_from=="button") {
    var stn=$("#graphHeader").text();

    xhttp.open("GET", "includes/gotograph.php?stn="+stn, true);
  }
  xhttp.send();



 if (graph_from=="map"||graph_from=="marker") {
                     var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      document.getElementById("graphHeader").innerHTML =this.responseText;
       }};
if (graph_from=="map") {
  xhttp.open("GET", "includes/stationNamefromLatLon.php?lat="+e.latlng.lat+"&lon="+e.latlng.lng, true);
}
if (graph_from=="marker") 
{
  var temp= e.getLatLng();
   temp=temp+"";
 var temp2=temp.substring(0, temp.length - 1).split("(");

 var temp3=temp2[1].split(",");
    xhttp.open("GET", "includes/stationNamefromLatLon.php?lat="+temp3[0]+"&lon="+temp3[1], true);

}


  xhttp.send();
}
if (graph_from=="dropdown") {
    document.getElementById("graphHeader").innerHTML =$("#list_of_stns option:selected").text();
}

//alert("ok");
                      // window.open("includes/gotograph.php?lat="+e.latlng.lat+"&lon="+e.latlng.lng);
           

               }

              function close_graph(){
                document.getElementById("graph").innerHTML = "<center><img src='/Sutter/StationImages/waitingIcon.gif'></center>";


$("#graph_div").css("display","none");

               }

function isvaliddate(str)
{

var ch=false;
 try
{
var temp_date=str.split(" ");
//2018-01-22 13:15:00

 if (temp_date[0].includes("-")&&temp_date[1].includes(":")) 
 {

  ch =true;
 }
  else
  { 
    ch =false;
  }

}catch(ex)
{
ch= false;

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

//  window.location.href="/Sutter/getSensorsforGraph.php?station="+stn;
 httpx.open("GET","/Sutter/getSensorsforGraph.php?station="+stn, true);
httpx.send();
}
function PlotGraph(params,station) {
 
 
   var yearFrom;
            var monthFrom;
            var dayFrom;
            var yearTo;
            var monthTo;
            var dayTo;
                
                var days=6; 
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
$( document ).ready(function() {
  <?php if(isset($_GET['lat_G'])&& isset($_GET['lon_G']))
  {
   ?>
   lat_G=<?php echo json_encode(trim($_GET['lat_G']));?>;
      lon_G=<?php echo json_encode(trim($_GET['lon_G']));?>;
      var stn =<?php echo json_encode(trim($_GET['station']));?>;
var zoom=10;
if (stn=='Select')
     map.setView([lat_G,lon_G], 10);
   alert(stn);

 else
   map.setView([lat_G,lon_G], 13); 
    alert(stn);
   <?php
 }
   ?>
$("#sensors_list").change(function(){
  var output=[];
  var data=[];
 sensor=$("#sensors_list option:selected").val();
$("#loading_pop").modal({backdrop: false});

$.ajax({

  url: 'includes/updateStationLocationCurrentValue.php',
  data:{'sensor':sensor},
  type:'post',

  success: function(result){
 //alert(result);
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
  //alert(result3);

  // console.log("result"+result3);
 $('#loading_pop').modal('hide');
var json=JSON.parse(result3);

for(var x in json)
{
  //if(json[x]!="")
  //{
  data.push(json[x]);
  //}
}

 setMarkers(output,data); 

 // map.removeLayer(markerClusters); 
  
 /*
 map = L.map('map', {
  fullscreenControl: true,
  fullscreenControlOptions: {
    position: 'topleft'
  }
}).setView([39.64222777777778,-121.08971666666666], 10);
           L.control.scale({ position: 'bottomleft' }).addTo(map);
  */ 
 
 }
});

 }
});
//updateMapValue();
 }
});
//updateMapValue();
});

//updateMapValue();
setInterval(function(){
  location.reload();
},5*60*1000);
$("#base_layer").change(function(){
  var value=$("#base_layer option:selected").val();

  if (value=="Google Satellite") {
showSattellite(); 
  }
  else if(value=="Open Street Map")
  {
showOpenStreetMap();
  }else {
    showStreetmap();
  }
});
});


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
 
  <script type="text/javascript">
    
    $('.tree-toggle').click(function () {
  $(this).parent().children('ul.tree').toggle(200);
});


  </script>

<script type="text/javascript">
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
<style type="text/css">
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
</style>


<div class="container">
  
  
 
  
  <!-- Modal -->
  <div class="modal fade" id="loading_pop" role="dialog">
    <div class="modal-dialog" style="width:283px;padding-top:200px">
    
      <!-- Modal content-->
      <div class="">
       
        <div class="modal-body"><center>
          <img src="/Sutter/StationImages/waitingIcon.gif"></center>
        </div>
        
      </div>
      
    </div>
  </div>
  
 
</div>
 
<script>
$(document).ready(function(){

    $("#myBtn2").click(function(){
        $("#loading_pop").modal({backdrop: false});
    });
   
});
</script>


  <div class="body-content outer-top-xs" id="top-banner-and-menu">
  <div class="container-fluid">
    <div class="row" style="background-color: #4e4e52;"> 

     <div class="col-md-2 sidebar" style="padding-right: 5px; padding-left: 5px;background-color: #4e4e52;"> 
        
 <!-- ================================== TOP NAVIGATION ================================== -->
    <div class="side-menu animate-dropdown outer-bottom-xs">
         
          <nav class="yamm megamenu-horizontal" role="navigation">
       


        </div>
        <!-- /.side-menu --> 
<br>
<label class="label1">Base Layer</label>
<select class="form-control" id="base_layer">
  <option value="Google Street" <?php if (isset($_GET['baselayer'])) {
if(trim($_GET['baselayer'])=="Google Street")
 echo "selected";
}else {  echo "selected";}?> >Google Street</option>
<option value="Google Satellite" <?php if (isset($_GET['baselayer'])) {
if(trim($_GET['baselayer'])=="Google Satellite")
 echo "selected";
}?> >Google Satellite</option>
<option value="Open Street Map"  <?php if (isset($_GET['baselayer'])) {
if(trim($_GET['baselayer'])=="Open Street Map")
 echo "selected";
}?> >Open Street Map</option>

</select>

<!--<label  class="label1">Map view</label>

<?php
$sql="SELECT  \"StationType\"
  FROM \"tblStationType\"";
$area_list=array();
$result=pg_query($sql);
while ($row=pg_fetch_array($result)) {

$sql="SELECT  \"River_System\",\"Latitude\",\"Longitude\"
  FROM \"$row[0]\" where \"River_System\"!='' and \"Latitude\"!=''";
//echo "<br><br>$sql";
$result_set=pg_query($sql);
if (!isset($result_set)) {
$sql="SELECT  \"Hydrologic_Area\",\"Latitude\",\"Longitude\"
  FROM \"$row[0]\" where \"River_System\"!='' and \"Latitude\"!=''";
//echo "<br><br>$sql";
$result_set=pg_query($sql);
}
while ($row_map_view=pg_fetch_array($result_set)) {
if (trim($row_map_view[0])!=""&&trim($row_map_view[1])!="") {
//$key=str_replace(" ", "_", $row_map_view[1]."#".$row_map_view[2]);
//echo "<br><br>$key";
$area_list[$row_map_view[1]."#".$row_map_view[2]]=$row_map_view[0];
}
}
}
?>
<select class="form-control" id="list_of_map_view">
<option disabled selected>Select</option>
<?php
$area_list=array_unique($area_list);
foreach ($area_list as $key => $value) {

?>

<option value="<?php echo $key; ?>"  <?php if (isset($_GET['mapview'])) {
if(trim($_GET['mapview'])=="$value")
 echo "selected";
}?> ><?php echo $value; ?></option>
<?php } ?>
</select>-->

<label  class="label1">Station</label>
<select class="form-control" id="list_of_stns" >
<option disabled selected>Select</option>

<?php


// Use this query for all copmpanies $sql="SELECT DISTINCT \"StationFullName\",lat,lon from \"tblStationLocation\" order by \"StationFullName\"";
// Use thismouse query for perticular company 
$sql="SELECT DISTINCT \"StationFullName\",lat,lon from \"tblStationLocation\", \"tblCompany2Station\" where \"Station\" = \"StationShefCode\" and \"Company\" = 'Sutter' order by \"StationFullName\"";



//echo "$sql";
$result_set=pg_query($sql);
//echo "$result";
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
<label  class="label1">Sensor</label>
<select  class="form-control" id="sensors_list">
  
<option disabled selected>Select</option>

<?php

// for all companies $sql="Select distinct \"Sensor\" as \"SensorName\" from \"SensorValues\" order by \"Sensor\"";

// for specific company 
$sql="Select distinct sv.\"Sensor\" as \"SensorName\" from \"SensorValues\" sv, \"tblCompany2Station\" c2s, \"tblStationLocation\" sl where sv.\"StationFullName\" = sl.\"StationFullName\" and c2s.\"Station\" = sl.\"StationShefCode\" and c2s.\"Company\" = 'Sutter' order by \"Sensor\"";




$result_set=pg_query($sql);
while ($row=pg_fetch_array($result_set)) {
?>
<option value="<?php echo $row[0];?>" <?php if (isset($_GET['sensor'])) {
if(trim($_GET['sensor'])==trim($row[0]))
 echo "selected";
}

  ?> ><?php echo $row[0]; ?></option>
<?php
}


?>

</select>
   <input type='hidden' id='date_format' value=''>

    </div>

   

  <!-- =============================== CONTENTpage ================================== -->
  


  
      <div class="col-md-10" style="padding-right: 0; padding-left: 0;"> 
    
    
   <table style="width: 100%;height: 78%;vertical-align: top;">
   <tr><td style="padding: 0px;"><div id="map" style="width:100%; height:100%;"></div>
<div id="loading_div">

</div>
   </td>

<td style="width: 1;vertical-align: top;background-color: white;height: 78%;padding: 0px;">

  <div  id="graph_div" style="display: none;overflow-y: scroll;height: 100%;margin-top: 5px;border-left: 2px solid;">
  <a href="javascript:popUp()"><img src="assets\images\popup.png" style="width: 20;height: 20;" />Pop Up</a>
   <a href="javascript:refresh_map(this)"><img src="assets\images\refresh.png" style="width: 20;height: 20;"/>Refresh</a>
   <a href="javascript:zoomOnSite()"><img src="assets\images\zoom.png" style="width: 20;height: 20;"/>Zoom On Site</a>
  <button type="button" class="close" onclick="close_graph()" id="close_g">&times;</button>

<h4 style="margin-left: 5%;"  id="graphHeader"></h4>
<br>
   <div id="graph" >
         
         <center>
<img src="/Sutter/StationImages/waitingIcon.gif">

</center>
       </div>
<br>

       <table id="graph_data" style="width: 100%;" class="table table-bordered"></table>
      
  </div>
</td>
   </tr></table>
 
 
</div>

   
</div> 


   </div>
  
  
  </div>

 <style type="text/css">
.dygraph-legend {
  background: transparent !important;
  left: 80px !important;
width: 80% !important;
}
</style>

<?php
 function table($station)
{
  
   $settings=pg_fetch_array(pg_query("select \"DateFormat\",\"DecimalPlaces\" from \"tblLogo\"")); 
            
   //echo $station."<br><br>";

  $sql= pg_query("SELECT * FROM \"station_sensor_type\" ");

  
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
           $sql_query_station = "select * from \"tblStationLocation\" where \"StationShefCode\"='$station' ";
            //echo $sql_query_station."<br>" ;

            $result_set_station = pg_query($sql_query_station);

      if (pg_num_rows($result_set_station) > 0)
      {       
       
      while ($rows = pg_fetch_array($result_set_station))
        {
        
          $station = $rows['StationFullName'];
           // echo $station."<br>" ;
        }
      }




           $sql_query = " SELECT distinct sv.\"Sensor\",sst.\"Value\",sst.\"VirtualValue\",sv.\"SensorType\"
           ,('20'||\"Year\"::text ||'-'||\"Month\"::text ||'-'|| \"Day\" ::text ||' '||\"Hour\"::text || ':'|| \"Minute\" ::text || ':'||\"Second\")::timestamp as t
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
                       
                        // $sensor=number_format(floatval($rows['VirtualValue']),2);
                        $sensor=floatval($rows['VirtualValue']);
                        // $rows['VirtualValue'];

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
   # code...
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

// print_r($result);

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
//echo $value1;

if($sensor=='Stage')
{
  pg_query("update \"tblStationLocation\" set \"CurrentValue\"='$value' where \"StationFullName\"='$row_stn[0]'");
}
 else if($sensor=='Reservoir Level')
{
  pg_query("update \"tblStationLocation\" set \"CurrentValue\"='$value' where \"StationFullName\"='$row_stn[0]'");
}
else{
  
  //echo $value2;
  
  if($value2 == 'Virtual'){
    pg_query("update \"tblStationLocation\" set \"CurrentValue\"='$value1' where \"StationFullName\"='$row_stn[0]'");
  }
  else 
  {
    pg_query("update \"tblStationLocation\" set \"CurrentValue\"='$value' where \"StationFullName\"='$row_stn[0]'");
  }
  
  
}

//pg_query("update \"tblStationLocation\" set \"CurrentValue\"='$value' where \"StationFullName\"='$row_stn[0]'");
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




 ?>