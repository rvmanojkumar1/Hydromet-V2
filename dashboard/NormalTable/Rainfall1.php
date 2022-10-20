<?php include_once '../../includes/header.php'; ?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script> 
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js" type="text/javascript"></script> 
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>



 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous" />

           <link rel="stylesheet" href="/HydrometV2/assets/jquery-ui.css">

    <script type="text/javascript" src="/HydrometV2/assets/jquery.js"></script>
<script type="text/javascript" src="/HydrometV2/assets/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="/HydrometV2/assets/css/MyTable.css"> 
<br>
<div style="min-width: 70%;max-height: 100%;margin-left:5%;margin-left:2%">
<center>
<div class="row">
<div class='row'>
<div class='col-md-12'>
<table align='center' style='max-width:90%;min-width:60%;' class='table'>
<tr>
<td colspan="2">
<label>Reservoir  Network Template ( Table 1 )
</label>
<td>
</tr>

</table>


</div></div>
  
<div class="col-md-12" style="height: auto;">
<table align="center" id="myTable1" style="max-width:90%;min-width:60%;" class="table-bordered table-responsive">
<tr>
    <th style="background-color:#539CCC;color:white;text-align:center;font-size: 13px;"><a style="color:white" >Station Name</a></th>
    <th style="background-color:#539CCC;color:white;text-align:center;font-size: 13px;"><a style="color:white" >Date/Time</a></th>
     
   
 <!-- <th  style="background-color:#539CCC;color:white;text-align:center;font-size: 13px">Sensor</th>-->
     
     <th style="background-color:#539CCC;color:white;text-align:center;font-size: 13px;"><a style="color:white" >Reservoir Level (ft)</a></th>
          
     <th style="background-color:#539CCC;color:white;text-align:center;font-size: 13px;"><a style="color:white" >Reservoir Storage (cfs)</a></th>
   <th style="background-color:#539CCC;color:white;text-align:center;font-size: 13px;"><a style="color:white" >Reservoir Storage (% of Reservoir Capacity) </a></th>

     <th style="background-color:#539CCC;color:white;text-align:center;font-size: 13px;"><a style="color:white" >Storage Level Change (1 hr)</a></th>

     <th style="background-color:#539CCC;color:white;text-align:center;font-size: 13px;"><a style="color:white" >Storage Level Change (12 hr)</a></th>

     <th style="background-color:#539CCC;color:white;text-align:center;font-size: 13px;"><a style="color:white" >Storage Level Change (24 hr)</a></th>
     
       <th style="background-color:#539CCC;color:white;text-align:center;font-size: 13px;"><label style="color:white" >Spilling Elevation (ft)</label></th>
     <th style="background-color:#539CCC;color:white;text-align:center;font-size: 13px;"><label style="color:white" >Reservoir Capacity (ac-ft)</label></th>

 
     </tr>
      
      <tr>
      <td style="text-align:center;font-size: 13px;height: 14px;"><a>SF2</a></td>
                               
      <td style="text-align:center;font-size: 13px;height: 14px;"><a>2018-02-15 12:15:00</a></td>
                               
                                    
      <td style="text-align:center;font-size: 13px;height: 14px;"><a style="color:green" href="javascript:PlotGraph('Stage','SF2 Little Grass Reservoir')">Stage</a></td>

         <td style="text-align:center;font-size: 13px;height: 14px;"><a style="color:green" href="javascript:PlotGraph('Storage','SF2 Little Grass Reservoir')">Storage</a></td>
                                 
      <td style="text-align:center;font-size: 13px;height: 14px;"><a style="color:green" href="javascript:PlotGraph('Storage','SF2 Little Grass Reservoir')">Storage (% of Reservoir Capacity) </a></td>

      <td style="text-align:center;font-size: 13px;height: 14px;"><a>Storage Change (1 hr)</a></td>

      <td style="text-align:center;font-size: 13px;height: 14px;"><a>Storage Change (12 hr)</a></td>

      <td style="text-align:center;font-size: 13px;height: 14px;"><a>Storage Change (24 hr)</a></td>
   
      <td style="text-align:center;font-size: 13px;height: 14px;"><label>Spilling Elevation (ft)</label></td>
       <td style="text-align:center;font-size: 13px;height: 14px;"><label>Reservoir Capacity (ac-ft) </label></td>                              

    
                                 
   </tr>
                   
    <tr>
      <td style="text-align:center;font-size: 13px;height: 14px;"><a>SF12</a></td>
                               
      <td style="text-align:center;font-size: 13px;height: 14px;"><a>2018-02-15 12:15:00</a></td>
                               
                                    
      <td style="text-align:center;font-size: 13px;height: 14px;"><a style="color:green" href="javascript:PlotGraph('Stage','SF12 Lost Creek Reservoir')">Stage</a></td>

         <td style="text-align:center;font-size: 13px;height: 14px;"><a style="color:green" href="javascript:PlotGraph('Storage','SF12 Lost Creek Reservoir')">Storage</a></td>
                                 
      <td style="text-align:center;font-size: 13px;height: 14px;"><a style="color:green" href="javascript:PlotGraph('Storage','SF12 Lost Creek Reservoir')">Storage (% of Reservoir Capacity) </a></td>
      
      <td style="text-align:center;font-size: 13px;height: 14px;"><a>Storage Change (1 hr)</a></td>

      <td style="text-align:center;font-size: 13px;height: 14px;"><a>Storage Change (12 hr)</a></td>

      <td style="text-align:center;font-size: 13px;height: 14px;"><a>Storage Change (24 hr)</a></td>
   
      <td style="text-align:center;font-size: 13px;height: 14px;"><label>Spilling Elevation (ft)</label></td>
    <td style="text-align:center;font-size: 13px;height: 14px;"><label>Reservoir Capacity (ac-ft)</label></td>                              
                              
    
                                 
   </tr>

     <tr>
      <td style="text-align:center;font-size: 13px;height: 14px;"><a>SF26</a></td>
                               
      <td style="text-align:center;font-size: 13px;height: 14px;"><a>2018-02-15 12:15:00</a></td>
                               
                                    
      <td style="text-align:center;font-size: 13px;height: 14px;"><a style="color:green" href="javascript:PlotGraph('Stage','SF26 Miners Ranch Reservoir')">Stage</a></td>

         <td style="text-align:center;font-size: 13px;height: 14px;"><a style="color:green" href="javascript:PlotGraph('Storage','SF26 Miners Ranch Reservoir')">Storage</a></td>
                                 
      <td style="text-align:center;font-size: 13px;height: 14px;"><a style="color:green" href="javascript:PlotGraph('Storage','SF26 Miners Ranch Reservoir')">Storage (% of Reservoir Capacity) </a></td>

      <td style="text-align:center;font-size: 13px;height: 14px;"><a>Storage Change (1 hr)</a></td>

      <td style="text-align:center;font-size: 13px;height: 14px;"><a>Storage Change (12 hr)</a></td>

      <td style="text-align:center;font-size: 13px;height: 14px;"><a>Storage Change (24 hr)</a></td>
   
      <td style="text-align:center;font-size: 13px;height: 14px;"><label>Spilling Elevation (ft)</label></td>
    <td style="text-align:center;font-size: 13px;height: 14px;"><label>Reservoir Capacity (ac-ft)</label></td>                              
                              
    
                                 
   </tr>
        </table></div></center>
</div>

</div>
</form>

<?php include_once '../../database.php';
  $set=pg_fetch_array(pg_query("select \"DateFormat\",\"DecimalPlaces\" from \"tblLogo\""));  
$DecilPlace=$set[1];
$dat_fmat=$set[0];
?>
<script type="text/javascript">
 

 function PlotGraph(params,station) {
 
 
   var yearFrom;
            var monthFrom;
            var dayFrom;
            var yearTo;
            var monthTo;
            var dayTo;
      var hours=24;
      var hours2=hours;
      hours=hours%24;
                
                var days=1; // Days you want to subtract
var date = new Date();
var last = new Date(date.getTime() - (days * 24 * 60 * 60 * 1000));
var dayFrom =last.getDate();
var monthFrom=last.getMonth()+1;
var yearFrom=last.getFullYear();

                var currentdate = new Date();

                yearTo = currentdate.getFullYear();
                monthTo = currentdate.getMonth() + 1;
                dayTo = currentdate.getDate();
     
       

           window.location.href= '/HydrometV2/Graph.php?FY=' + yearFrom + "&FM=" + monthFrom + "&FD=" + dayFrom + '&TY=' + yearTo + "&TM=" + monthTo + "&TD=" + dayTo + "&PARAMS=" + params+"&hours="+hours+"&station="+station+"&hours2="+hours2;
  
  
}

</script>
<form method="post" id="data" action="TemplateGetData.php">
  
</form>
<script type="text/javascript">

var dat_fmat= <?php echo json_encode($dat_fmat); ?>;
var DecilPlace=<?php echo json_encode($DecilPlace); ?>;
var table= document.getElementById('myTable1');
var th1= table.getElementsByTagName('th');
var stations="";
var sensor_array=new Array();
var tr1=table.getElementsByTagName('tr');
for (var i = 1; i < tr1.length; i++) {
 // debugger;
  stations+=tr1[i].getElementsByTagName('td')[0].getElementsByTagName('a')[0].innerHTML+"#";
}
var sensors="";
var capacity="";
var change_sensor="";
var time="";
var time_list=new Array();
var capacity_list=new Array();
var sensors_list=new Array();
for (var j = 1; j < tr1.length; j++) 
{
  var td1=tr1[j].getElementsByTagName('td');
  for (var i = 2; i <td1.length; i++) {
  try
  {
  var temp=td1[i].getElementsByTagName('a')[0].innerHTML;
var sensor=new Array();
if(temp.toLowerCase().includes('change'))
{
  sensor=temp.split('(');
sensors+=sensor[0]+"#";
//console.log(sensors);
  time+=parseInt(sensor[1]);
  //console.log(time);
  if (sensor[1].replace(/[^a-zA-Z ]/g, "").toLowerCase().trim()=="hr") {
 time+="hours";
}
else if(sensor[1].replace(/[^a-zA-Z ]/g, "").toLowerCase().trim()=="min")
{
 time+=" minutes";
}
else
{
   time+=" "+sensor[1].replace(/[^a-zA-Z ]/g, "").toLowerCase();
}
time+="#";
//console.log(time);

}
else if(temp.toLowerCase().includes('%'))
{
sensors+=temp+"#";
}
else
{
     sensor=temp.split('(');
sensors+=sensor[0]+"#";
}
}catch(ex)
{
 try
  {
  temp=td1[i].getElementsByTagName('label')[0].innerHTML;
   sensor=temp.split('(');
capacity+=sensor[0]+"#";
}catch(exx)
{
}
}
}
capacity_list[j-1]=capacity;
sensors_list[j-1]=sensors;
//console.log(time);
time_list[j-1]=time;
capacity="";
sensors="";
//console.log(time);
time="";
}
//console.log(time_list);

document.getElementById("data").innerHTML="<input type='hidden' name='stations' value='"+stations+"'><input type='hidden' name='sensors' value='"+sensors_list+"'><input type='hidden' name='capacity' value='"+capacity_list+"'><input type='hidden' name='time' value='"+time_list+"'>";


</script>
<!--<script type="text/javascript" src="assets/jquery.js"></script>-->
<script>
function sndReqest()
{
  //console.log($("form").serialize());
  $.ajax({
                   type: 'POST',
                   
                    url: $("form").attr("action"),
                    data: $("form").serialize(),
                 
 
                   success: function (res_dat, textStatus, xhr) {
                    var list;
//alert(res_dat);
res_dat = res_dat.replace(/}{/g,',');
  
//console.log(res_dat);
 
list=JSON.parse(res_dat);

 // alert(list);

var data=new Array();
for(var xxx in list)
{

//alert(xxx);
data.push(xxx);
temp=list[xxx].split(',');
for (var i = 0; i < temp.length; i++) {
  
data.push( temp[i]);
  }

}
function check(d)
{
  var c=false;
for (var i = 0; i < data.length; i++) {
if (data[i]==d)
{
c=true;
}
}
return c;
}
var station="";
var z=0;
//console.log(data);
for (var i = 1; i < tr1.length; i++) {

td1=tr1[i].getElementsByTagName('td');
for (var j = 0; j < td1.length; j++) {
  var d=data[z];
//console.log(d_a);
  var d_a=d.split("#");
if (!isNaN(d_a[0])) 
{
  d=Number(d_a[0]).toFixed(DecilPlace).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
try
{
if (!isNaN(d_a[1]))
 {
  if (d_a[1]=="11")
  td1[j].getElementsByTagName('a')[0].style.color="red";
else
    td1[j].getElementsByTagName('a')[0].style.color="green";

 }
 
 // alert(parseInt(data[z]));
td1[j].getElementsByTagName('a')[0].innerHTML=d;
}catch(ex)
{
  try
  {
td1[j].getElementsByTagName('label')[0].innerHTML=d;
}catch(ee){}
}
z++;
//alert(station);
}

}

                   },
                   error: function (XMLHttpRequest, textStatus, errorThrown) {
                     
                    //alert(textStatus);
                   }


               });
     
}


sndReqest();

</script>