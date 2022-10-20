<?php
  //include ('database.php');
  session_start();
  include_once 'includes/editCompany.php';

  $company=$_SESSION["company"];
?>
<!DOCTYPE php>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Hydromet</title>
        <meta name="viewport" content="initial-scale=1,maximum-scale=1,user-scalable=no" />

        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin=""/>
        <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>

        <script src="https://unpkg.com/esri-leaflet@3.0.2/dist/esri-leaflet.js" integrity="sha512-myckXhaJsP7Q7MZva03Tfme/MSF5a6HC2xryjAM4FxPLHGqlh5VALCbywHnzs2uPoF/4G/QVXyYDDSkp5nPfig==" crossorigin=""></script>

        <link rel="stylesheet" href="./custom/bootstrap.min.css" />
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
        <link rel="stylesheet" href="./assets/leaflet-v1.6.0/leaflet.css"/>
        <link rel="stylesheet" type="text/css" href="./assets/leaflet-v1.6.0/0.4.0MarkerCluster.css" />
        <link rel="stylesheet" type="text/css" href="./assets/leaflet-v1.6.0/0.4.0MarkerCluster.Default.css" />
        <script src="./assets/leaflet-v1.6.0/leaflet.js"></script>
        <script src="./assets/leaflet-v1.6.0/leaflet-kmz.js"></script>
        <script src="./assets/leaflet-v1.6.0/2.4.1esri-leaflet.js"></script>
        <script type='text/javascript' src='./assets/leaflet-v1.6.0/1.4.1leaflet.markercluster.js'></script>

        <?php
            include("includes/link.php");
        ?>
        <style>
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
            .sidenav1 {
                height: 90vh;
                width: fit-content;
                padding: inherit;
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
                margin-bottom: 10px;
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

            #radarinfo
            {
                display:none;
                position:absolute;
                background-color: #ffffff;
                top: 12%;
                left: 1%;
                width: 20%;
                height: 28%;
                z-index: 99999;
                border: 2px solid #00000033;
                box-shadow: 1px 2px #00000026;
                padding: 1%;
            }
            #qpfinfo
            {
                display:none;
                position:absolute;
                background-color: #ffffff;
                top: 12%;
                left: 1%;
                width: 20%;
                height: 28%;
                z-index: 99999;
                border: 2px solid #00000033;
                box-shadow: 1px 2px #00000026;
                padding: 1%;
            }
            #droughtinfo
            {
                display:none;
                position:absolute;
                background-color: #ffffff;
                top: 12%;
                left: 1%;
                width: 25%;
                height: 30%;
                z-index: 99999;
                border: 2px solid #00000033;
                box-shadow: 1px 2px #00000026;
                padding: 1%;
            }
            #hurricaneinfo
            {
                display:none;
                position:absolute;
                background-color: #ffffff;
                top: 12%;
                left: 1%;
                width: 20%;
                height: 28%;
                z-index: 99999;
                border: 2px solid #00000033;
                box-shadow: 1px 2px #00000026;
                padding: 1%;
            }
        </style>

        <script>
            var markerClusters=null;
            var marker=[];
            var markerOptions={};
            var nexrad = new L.tileLayer.wms("https://mesonet.agron.iastate.edu/cgi-bin/wms/nexrad/n0r.cgi", {
                layers: 'nexrad-n0r',
                format: 'image/png',
                transparent: true,
                opacity:0.5,
                attribution: "Weather data &copy; 2015 IEM Nexrad"
            });

            var droughtsdata=L.tileLayer.wms("http://ndmc-001.unl.edu:8080/cgi-bin/mapserv.exe", {
                map:'/ms4w/apps/usdm/service/usdm_current_wms.map',
                layers: 'usdm_current',
                format: 'image/png',
                transparent: true,
                opacity:0.5
            });

            
            
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
                hours = hours ? hours : 12;

                if(minutes<'10'){
                    if(minutes=='0'){
                    minutes='00';
                    }
                    else{
                    minutes='0'+minutes;
                    }
                }
                var strTime = hours + ':' + minutes + ' ' + ampm;
                return strTime;
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
                var sensor=$("#sensors_list option:selected").val();
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
                        console.log(date_format);

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
                            table+="<td>"+moment(data[x].replace(/"/g ,"").trim(),['YYYY-MM-DD h:m A']).format("YYYY-MM-DD h:mm A")+"</td>";
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
                xhttp.open("GET", "includes/gotograph.php?lat="+temp3[0].trim()+"&lon="+temp3[1].trim()+"&sensor="+sensor, true);
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
            
            var company="<?php echo $company;?>";
            $(document).ready(function(){
                var markersnew = L.markerClusterGroup();

                var mark = {
                    "url": "./controller/MapData/GetData.php",
                    "method": "POST",
                    "timeout": 0,
                    "headers": {
                        "Content-Type": "application/json"
                    },
                    "data": JSON.stringify({
                        "sensor": "Stage",
                        "company": company
                    }),
                };

                $.ajax(mark).done(function (response) {
                    console.log(response);
                    console.log(response['data'][0]['Font']);

                    console.log(response['data'].length);

                    // var markersnew = L.markerClusterGroup();

                    for(var r=0;r<response['data'].length;r++){
                        markerOptions = {
                            icon: new L.DivIcon({
                                className: 'my-div-icon',
                                html: '<b class="c_val" style="font-size: 12px;border:solid;padding:2px;border-width: thin;border-bottom: 2px solid;border-right: 2px solid;color:'+response['data'][r]['Font']+';background-color:'+response['data'][r]['color']+';border-color:black">'+response['data'][r]['currentvalue']+'</b>'
                            })
                        };
                        marker[r] = L.marker([response['data'][r]['lat'],response['data'][r]['lon']],markerOptions).bindPopup(response['data'][r]['table'], {maxWidth : 560});

                        markersnew.addLayer(marker[r]);

                        marker[r].on('mouseover',function() {
                            this.openPopup();
                        });
                        marker[r].on('click',function() {
                            plotGraph("marker",this);
                        });
                        marker[r].on('mouseout', function () {
                            this.closePopup();
                        });       
                    }
                    map.addLayer(markersnew);
                });

                $("#SensorValuesChange").hide();
                $("#SensorValuesChangelabel").hide();
                $("#RainLegend").hide();
                $("#Loop").hide();
                $("#legendRadar").hide();
                $("#qpflegend").hide();
                $("#droughtslegend").hide();
                // $("#HurricaneSub").hide();
                $("#HurricaneLegend").hide();

                var qpf = L.kmzLayer().addTo(map);
  
                var hurricanelayer=L.kmzLayer().addTo(map);
                
                $('#Radar').click(function(){
                    var checked = $(this).is(':checked');
                    if (checked) {
                        $("#Loop").show();
                        $("#legendRadar").show();
                        time=formatDate(new Date);
                        document.getElementById("radarTime").innerHTML="<b>"+time+"</b>";
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

                $('#QPF').click(function(){
                    var checked = $(this).is(':checked');
                    if (checked) {
                        qpf.load('/HydrometV2/Layers/QPF_Layer_Download/qpf24.kmz');
                        // qpf.setStyle({opacity: 0.1});
                        map.addLayer(qpf);
                        $("#qpflegend").show();
                        $("#qpfTime").show();
                        fetchfile("/HydrometV2/Layers/QPF_Layer_Download/qpfdownloadtime.txt");
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
                        // $("#HurricaneSub").show();

                        hurricanelayer.load('/HydrometV2/Layers/Hurricane_Layer_Download/Hurricane.kmz');
                        map.addLayer(hurricanelayer);
                        
                    }
                    else{
                        $("#HurricaneLegend").hide();
                        // $("#HurricaneSub").hide();

                        map.removeLayer(hurricanelayer);
                        
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
                        $("#RainLegend").hide();
                        // $("#loading_pop").modal({backdrop: false});
                    }
                    for(var q=0;q<marker.length;q++){

                        markersnew.removeLayer(marker[q]);

                    }
                    
                    marker=[];

                    var mark = {
                        "url": "./controller/MapData/GetData.php",
                        "method": "POST",
                        "timeout": 0,
                        "headers": {
                            "Content-Type": "application/json"
                        },
                        "data": JSON.stringify({
                            "sensor": sensor,
                            "company": company
                        }),
                    };

                    $.ajax(mark).done(function (response) {
                        console.log(response);
                        console.log(response['data'][0]['Font']);

                        console.log(response['data'].length);

                        for(var d=0;d<response['data'].length;d++){

                            markerOptions = {
                                icon: new L.DivIcon({
                                    className: 'my-div-icon',
                                    html: '<b class="c_val" style="font-size: 12px;border:solid;padding:2px;border-width: thin;border-bottom: 2px solid;border-right: 2px solid;color:'+response['data'][d]['Font']+';background-color:'+response['data'][d]['color']+';border-color:black">'+response['data'][d]['currentvalue']+'</b>'
                                })
                            };
                            marker[d] = L.marker([response['data'][d]['lat'],response['data'][d]['lon']],markerOptions).bindPopup(response['data'][d]['table'], {maxWidth : 560});

                            markersnew.addLayer(marker[d]);

                            marker[d].on('mouseover',function() {
                                this.openPopup();
                            });
                            marker[d].on('click',function() {
                                plotGraph("marker",this);
                            });
                            marker[d].on('mouseout', function () {
                                this.closePopup();
                            });       
                        }
                        map.addLayer(markersnew);
                    });

                    console.log("-2075");
                    console.log(marker);
                });

                $("#SensorValuesChange").change(function(){
                    // var output=[];
                    // var data=[];
                    console.log("-2082");
                    console.log(marker);

                    // debugger;

                    $("#RainLegend").show();
                    sensor=$("#sensors_list option:selected").val();
                    difference=$("#SensorValuesChange option:selected").val();

                    for(var q=0;q<marker.length;q++){

                        markersnew.removeLayer(marker[q]);

                    }

                    marker=[];

                    var data = JSON.stringify({
                        "sensor": sensor,
                        "company": company,
                        "time": difference
                    });

                    var xhr = new XMLHttpRequest();
                    xhr.withCredentials = true;

                    xhr.open("POST", "./controller/MapData/GetData.php");
                    xhr.setRequestHeader("Content-Type", "application/json");

                    xhr.send(data);

                    xhr.addEventListener("readystatechange", function() {
                        if(this.readyState === 4) {
                            console.log("2114");
                            console.log(this.responseText);

                            var response = JSON.parse(this.responseText);

                            console.log("2124");
                            console.log(this.responseText);

                            for(var d=0;d<response['data'].length;d++){
                                // debugger;   
                                markerOptions = {
                                    icon: new L.DivIcon({
                                        className: 'my-div-icon',
                                        html: '<b class="c_val" style="font-size: 12px;border:solid;padding:2px;border-width: thin;border-bottom: 2px solid;border-right: 2px solid;color:'+response['data'][d]['Font']+';background-color:'+response['data'][d]['color']+';border-color:black">'+response['data'][d]['currentvalue']+'</b>'
                                    })
                                };
                                marker[d] = L.marker([response['data'][d]['lat'],response['data'][d]['lon']],markerOptions).bindPopup(response['data'][d]['table'], {maxWidth : 560});

                                markersnew.addLayer(marker[d]);

                                marker[d].on('mouseover',function() {
                                    this.openPopup();
                                });
                                marker[d].on('click',function() {
                                    plotGraph("marker",this);
                                });
                                marker[d].on('mouseout', function () {
                                    this.closePopup();
                                });       
                            }
                            map.addLayer(markersnew);
                        }
                    });
                });
            });
            
        </script>
    </head>
    <body>
        <?php
            include 'includes/header.php';
        ?>

        <div class="container">
            <div class="modal fade" id="loading_pop" role="dialog">
            <div class="modal-dialog" style="width:283px;padding-top:200px">
                <div class="">
                <div class="modal-body"><center>
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
                    <label id="RadarContainer" name="Radar" class="btn btn-default layer-list-item active" style="width: 90%;background-color: #fff;border:none;box-shadow: none;">
                    <input id="Radar" class="pull-right" type="checkbox"> <span class="btn-text pull-left"><b>Current radar &nbsp;</b></span>
                    </label>&nbsp;
                    <i class="fa fa-info-circle" id="radarinfobox" style="font-size:17px"></i>
                    <ul id="Loop" style="padding-left: 15px;list-style: none;margin-bottom: 0px;">
                    <li>
                        <label id="RadarContainer" name="RadarLoop" class="btn btn-default layer-list-item active" style="width: 90%;background-color: #fff;border:none;box-shadow: none;">
                        <input id="RadarLoop" class="pull-right" type="checkbox"> <span class="btn-text pull-left"><b>Radar Loop</b></span>
                        </label>
                    </li>
                    </ul>
                    <label id="RadarContainer" name="Radar" class="btn btn-default layer-list-item active" style="width: 90%;background-color: #fff;border:none;box-shadow: none;">
                    <input id="QPF" class="pull-right" type="checkbox"> <span class="btn-text pull-left"><b>QPF (24 hrs) &nbsp;</b></span>
                    </label>&nbsp;&nbsp;<i class="fa fa-info-circle" id="qpfinfobox" style="font-size:17px"></i><br><span class="datadate" id="qpfTime"></span>
                    <label id="RadarContainer" name="Radar" class="btn btn-default layer-list-item active" style="width: 90%;background-color: #fff;border:none;box-shadow: none;">
                    <input id="Hurricanes" class="pull-right" type="checkbox"> <span class="btn-text pull-left"><b>Hurricanes &nbsp;</b></span>
                    </label>&nbsp;
                    <i class="fa fa-info-circle" id="hurricaneinfobox" style="font-size:17px"></i>
                    <label id="RadarContainer" name="Radar" class="btn btn-default layer-list-item active" style="width: 90%;background-color: #fff;border:none;box-shadow: none;">
                    <input id="droughts" class="pull-right" type="checkbox"> <span class="btn-text pull-left"><b>Droughts &nbsp;</b></span>
                    </label>&nbsp;
                    <i class="fa fa-info-circle" id="droughtinfobox" style="font-size:17px"></i>
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
                        <div id="radarinfo">
                            <b>Current radar:</b><br><br> Toggle this button to add and remove radar imagery from the map.  The radar information is provided by Iowa Environmental Mesonet at Iowa State University.  The radar images are updated every 5 minutes.
                        </div>
                        <div id="qpfinfo">
                            <b>QPF: </b><br><br> Toggle this button to add and remove radar imagery from the map. The QPF data is provided by NOAA National Centers for Environment Information. The QPF images are updated every 24 hours.
                        </div>
                        <div id="droughtinfo">
                            <b>Drought: </b><br><br> Toggle this button to add and remove soil moisture information from the map.  The Shallow Soil Moisture overlay displays the estimated relative moisture content (%) of the upper 10cm of soil.  Data is from the National Aeronautics and Space Administration (NASA).  The overlay is updated daily from the NLDAS-NOAH Land Surface  model.
                        </div>
                        <div id="hurricaneinfo">
                            <b>Hurricane: </b><br><br>Toggle this button to add and remove radar imagery from the map. The QPF data is provided by NOAA National Centers for Environment Information. The Hurricane images are updated every 24 hours.
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
            var layer=L.esri.basemapLayer('Topographic').addTo(map);
            var layerLabels;
            var googleStreets = L.tileLayer('http://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
                maxZoom: 20,
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
            });

            L.control.scale({ position: 'bottomleft' }).addTo(map);
            markerClusters =L.markerClusterGroup({maxClusterRadius: 40});
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

            $('#radarinfobox').hover(function(){
                $('#radarinfo').show();
            },function(){
                $('#radarinfo').hide();
            });

            $('#qpfinfobox').hover(function(){
                $('#qpfinfo').show();
            },function(){
                $('#qpfinfo').hide();
            });

            $('#droughtinfobox').hover(function(){
                $('#droughtinfo').show();
            },function(){
                $('#droughtinfo').hide();
            });

            $('#hurricaneinfobox').hover(function(){
                $('#hurricaneinfo').show();
            },function(){
                $('#hurricaneinfo').hide();
            });
        </script>

    </body>
    <script src="./custom/bootstrap.min.js"></script>
</html>