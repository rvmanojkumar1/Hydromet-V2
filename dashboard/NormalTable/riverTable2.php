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
<style type="text/css">
  @media only screen and (max-width: 630px) {
    #tablediv{
      overflow-x: scroll;
    }
  }
   ::-webkit-scrollbar  {
      width: 5px;
    }

    /* Track */
    ::-webkit-scrollbar-track {
      background: #f1f1f1; 
    }
     
    /* Handle */
    ::-webkit-scrollbar-thumb {
      background: #888; 
    }

    /* Handle on hover */
    ::-webkit-scrollbar-thumb:hover {
      background: #555; 
    }

</style>
<script type="text/javascript">
  function wordInString(s, word){
  return new RegExp( '\\b' + word + '\\b', 'i').test(s);
}
  function getsensorcolor(station,sensor,value){
    var color;
    var text_data=new Array();
    var textlist=$.ajax({
      'url':'../../COLOR.txt',
      dataType: "json",
      async: false,
      success: function (data) {
      // nothing needed here
      }
    }) .responseText ;
    //console.log(textlist);
    textlist=textlist.split('\n'); 
    //alert("hello");
    for(var i=0;i<textlist.length;i++)
    {
                
      text_data[i]=textlist[i].split(',');
               
    }
    var textd=new Array();
    var j=0;
    for(i=0;i<text_data.length;i++){
      if(text_data[i]!=null){
        textd[j]=text_data[i];
        j++;
      }
    }
    for(i=0;i<textd.length;i++){
      
      var check=wordInString(textd[i][0],station);
        
      if(check==true){
        for(j=0;j<textd[i].length;j++){
          if(textd[i][1]==sensor){
            
            var m=2;
            var v;
            var lens = textd[i].length;
                  
            value=parseFloat(value);
                  
            while(m < lens){
              if(textd[i][m]=='>'){
                if((m+4)!=(lens-1)){
                          
                  if((value > textd[i][m+1])&&(value < textd[i][m+6])){
                    v=m;
                    break;
                  }
                }
                else{
                  if(value > textd[i][m+1]){
                    v=m;
                    break;
                          
                  }
                }
              }
              else if(textd[i][m]=='<'){
                if(m==2){
                  if(value < textd[i][m+1]){
                    v=m;
                    break;
                  }
                }
                else{
                  if((m+4)!=(lens-1)){
                    if((value < textd[i][m+1])&&(value > textd[i][m-6])){
                      v=m;
                      break;
                    }
                  }
                  else{
                    if(value<=textd[i][m+1]){
                      v=m;
                      break;
                    }
                  }
                }
              }
                      
              else if(textd[i][m]=='>='){
                if((m+4)!=(lens-1)){
                      
                  if((value>=textd[i][m+1])&&(value<=textd[i][m+6])){
                    v=m;
                    break;
                  }
                }
                else{
                  if(value>=textd[i][m+1]){
                    v=m;
                    break;
                        
                  }
                }
              }
              else if(textd[i][m]=='<='){
                if(m==2){
                  if(value<=textd[i][m+1]){
                    v=m;
                    break;
                  }
                }
                else{
                  if((m+4)!=(lens-1)){
                    if((value<=textd[i][m+1])&&(value>=textd[i][m-6])){
                      v=m;
                      break;
                    }
                  }
                  else{
                    if(value<=textd[i][m+1]){
                      v=m;
                      break;
                    }
                  }
                }
              }
              m=m+5;
            }
            
            if(textd[i][v]=='>'){
              if((v+4)!=(lens-1)){
                        
                if((value > textd[i][v+1])&&(value < textd[i][v+6])){
                  color=textd[i][v+2];
                                 
                }
              }
              else{
                if(value > textd[i][v+1]){
                  color=textd[i][v+2];       
                }
              }
            }
            else if(textd[i][v]=='<'){
              if(v==2){
                if(value < textd[i][v+1]){
                  color=textd[i][v+2];        
                }
              }
              else{
                if((v+4)!=(lens-1)){
                  if((value < textd[i][v+1])&&(value > textd[i][v-6])){
                    color=textd[i][v+2];        
                  }
                }
                else{
                  if(value < textd[i][v+1]){
                    color=textd[i][v+2];
                  }
                }
              }
            }
            else if(textd[i][v]=='>='){
              if((v+4)!=(lens-1)){
                    
                if((value>=textd[i][v+1])&&(value<=textd[i][v+6])){
                  color=textd[i][v+2];       
                }
              }
              else{
                if(value>=textd[i][v+1]){
                  color=textd[i][v+2];
                }
              }
            }
            else if(textd[i][v]=='<='){
              if(v==2){
                if(value<=textd[i][v+1]){
                  color=textd[i][v+2];        
                }
              }
              else{
                if((v+4)!=(lens-1)){
                  if((value<=textd[i][v+1])&&(value>=textd[i][v-6])){
                    color=textd[i][v+2];
                  }
                }
                else{
                  if(value<=textd[i][v+1]){
                    color=textd[i][v+2];      
                  }
                }
              }
            }
            if(color=="yellow"){
              color="black";
            }
          }
        }
      }
    }
    return color;
  }
</script>
<br>
<div style="margin-right:2%;margin-left:2%";>
<center>
<div class="row">
<div class='row'>
<div class='col-md-12'>
<table align='center' style='max-width:90%;min-width:60%;' class='table'>
<tr>
<td colspan="2">
<label>River Network Template ( Table 2 )
</label>
<td>
</tr>
</table>
</div></div>
  
<div class="col-md-12" id="tablediv" style="height: auto;">
<table align="center" id="myTable2" style="width: auto;" class="table table-bordered table-responsive">
<tr>
    <th style="background-color:#539CCC;color:white;text-align:center;font-size: 13px;"><a style="color:white" >Station Name</a></th>
    <th style="background-color:#539CCC;color:white;text-align:center;font-size: 13px;"><a style="color:white" >Date/Time</a></th>
     
   
 <!-- <th  style="background-color:#539CCC;color:white;text-align:center;font-size: 13px">Sensor</th>-->
     
     <th style="background-color:#539CCC;color:white;text-align:center;font-size: 13px;"><a style="color:white"  >Battery (cfs)</a></th>
          
          <th style="background-color:#539CCC;color:white;text-align:center;font-size: 13px;"><a style="color:white" >Stage (ft)</a></th>
    
     <th style="background-color:#539CCC;color:white;text-align:center;font-size: 13px;"><a style="color:white" >Discharge (cfs)</a></th>
    
     <th style="background-color:#539CCC;color:white;text-align:center;font-size: 13px;"><a style="color:white" >Battery Change (1 hr)</a></th>
     
     <th style="background-color:#539CCC;color:white;text-align:center;font-size: 13px;"><label style="color:white" >Flood Stage (ft)</label></th>
     <th style="background-color:#539CCC;color:white;text-align:center;font-size: 13px;"><label style="color:white" >River System</label></th>
     <th style="background-color:#539CCC;color:white;text-align:center;font-size: 13px;"><label style="color:white" >Operator</label></th>
 
     </tr>
      
      <tr>
      <td style="text-align:center;font-size: 13px;height: 14px;" href="javascript:PlotGraph('Stage','SF1 Upstream Little Grass Reservoir')"><a>SF1</a></td>
      <td style="text-align:center;font-size: 13px;height: 14px;"><a>2018-02-15 12:15:00</a></td>
      <td style="text-align:center;font-size: 13px;height: 14px;"><a style="color:green" href="javascript:PlotGraph('Battery','SF1 Upstream Little Grass Valley Reservoir')" >Battery</a></td>
      <td style="text-align:center;font-size: 13px;height: 14px;"><a style="color:green" href="javascript:PlotGraph('Stage','SF1 Upstream Little Grass Valley Reservoir')" >Stage</a></td>
      <td style="text-align:center;font-size: 13px;height: 14px;"><a style="color:green" href="javascript:PlotGraph('Discharge','SF1 Upstream Little Grass  Valley Reservoir')" >Discharge</a></td>
      <td style="text-align:center;font-size: 13px;height: 14px;"><a>Battery Change (1 hr)</a></td>
      
      <td style="text-align:center;font-size: 13px;height: 14px;"><label>Flood Stage (ft)</label></td>
      <td style="text-align:center;font-size: 13px;height: 14px;"><label>River System</label></td>
      <td style="text-align:center;font-size: 13px;height: 14px;"><label>Operator</label></td>                              
                                     
      </tr>
                   
    <tr>
      <td style="text-align:center;font-size: 13px;height: 14px;" href="javascript:PlotGraph('Stage','SF15 Pinkard Creek')"><a>SF15</a></td>
                               
      <td style="text-align:center;font-size: 13px;height: 14px;"><a>2019-02-15 12:15:00</a></td>
                               
                                    
      <td style="text-align:center;font-size: 13px;height: 14px;"><a style="color:green" href="javascript:PlotGraph('Battery','SF15 Pinkard Creek')">Battery</a></td>
 <td style="text-align:center;font-size: 13px;height: 14px;"><a style="color:green" href="javascript:PlotGraph('Stage','SF15 Pinkard Creek')">Stage</a></td>   
                                 
      <td style="text-align:center;font-size: 13px;height: 14px;"><a style="color:green" href="javascript:PlotGraph('Discharge','SF15 Pinkard Creek')">Discharge</a></td>
      <td style="text-align:center;font-size: 13px;height: 14px;"><a>Battery Change (1 hr)</a></td>
      
      <td style="text-align:center;font-size: 13px;height: 14px;"><label>Flood Stage (ft)</label></td>
      <td style="text-align:center;font-size: 13px;height: 14px;"><label>River System</label></td>
      <td style="text-align:center;font-size: 13px;height: 14px;"><label>Operator</label></td>                              
    
                                 
   </tr>
     <tr>
      <td style="text-align:center;font-size: 13px;height: 14px;" href="javascript:PlotGraph('Stage','SF7 Lost Creek upstream Sly Creek Reservoir')"><a>SF7</a></td>
                               
      <td style="text-align:center;font-size: 13px;height: 14px;"><a>2018-02-15 12:15:00</a></td>
                               
                                    
      <td style="text-align:center;font-size: 13px;height: 14px;"><a style="color:green" href="javascript:PlotGraph('Battery','SF7 Lost Creek upstream Sly Creek Reservoir')">Battery</a></td>
   <td style="text-align:center;font-size: 13px;height: 14px;"><a style="color:green" href="javascript:PlotGraph('Stage','SF7 Lost Creek upstream Sly Creek Reservoir')">Stage</a></td>
                                 
      <td style="text-align:center;font-size: 13px;height: 14px;"><a style="color:green" href="javascript:PlotGraph('Discharge','SF7 Lost Creek upstream Sly Creek Reservoir')">Discharge</a></td>
      <td style="text-align:center;font-size: 13px;height: 14px;"><a>Battery Change (1 hr)</a></td>
      
      <td style="text-align:center;font-size: 13px;height: 14px;"><label>Flood Stage (ft)</label></td>
      <td style="text-align:center;font-size: 13px;height: 14px;"><label>River System</label></td>
      <td style="text-align:center;font-size: 13px;height: 14px;"><label>Operator</label></td>                              
    
                                 
   </tr>
   <tr>
      <td style="text-align:center;font-size: 13px;height: 14px;" href="javascript:PlotGraph('Stage','SF10 Downstream Slate Creek Div')"><a>SF10</a></td>
                               
      <td style="text-align:center;font-size: 13px;height: 14px;"><a>2018-02-15 12:15:00</a></td>
                               
                                    
      <td style="text-align:center;font-size: 13px;height: 14px;"><a style="color:green" href="javascript:PlotGraph('Battery','SF10 Downstream Slate Creek Div')">Battery</a></td>
      
      <td style="text-align:center;font-size: 13px;height: 14px;"><a style="color:green" href="javascript:PlotGraph('Stage','SF10 Downstream Slate Creek Div')">Stage</a></td>
      <td style="text-align:center;font-size: 13px;height: 14px;"><a style="color:green" href="javascript:PlotGraph('Discharge','SF10 Downstream Slate Creek Div')">Discharge</a></td>
      <td style="text-align:center;font-size: 13px;height: 14px;"><a>Battery Change (1 hr)</a></td>
      
      <td style="text-align:center;font-size: 13px;height: 14px;"><label>Flood Stage (ft)</label></td>
      <td style="text-align:center;font-size: 13px;height: 14px;"><label>River System</label></td>
      <td style="text-align:center;font-size: 13px;height: 14px;"><label>Operator</label></td>                              
    
                                 
   </tr>
        </table></div></center>
</div>
</div>
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
//console.log(dat_fmat);
var DecilPlace=<?php echo json_encode($DecilPlace); ?>;
var table= document.getElementById('myTable2');
var th2= table.getElementsByTagName('th');
var stations="";
var sensor_array=new Array();
var stationname=new Array();
var tr2=table.getElementsByTagName('tr');
for (var i = 1; i < tr2.length; i++) {
 // debugger;
  stations+=tr2[i].getElementsByTagName('td')[0].getElementsByTagName('a')[0].innerHTML+"#";
  stationname.push(tr2[i].getElementsByTagName('td')[0].getElementsByTagName('a')[0].innerHTML);
}
console.log(stationname);
var sensors="";
var capacity="";
var change_sensor="";
var time="";
var number=new Array();
var text_data=new Array();
var textlist=$.ajax({
            'url':'../../COLOR.txt',
            dataType: "json",
            async: false,
            success: function (data) {
            // nothing needed here
          }
        }) .responseText ;
// console.log(textlist);
textlist=textlist.split('\n'); 
            //alert("hello");
            for(var i=0;i<textlist.length;i++)
            {
                
                    text_data[i]=textlist[i].split(',');
               
            }
            var textd=new Array();
    var j=0;
    for(i=0;i<text_data.length;i++){
      if(text_data[i]!=null){
        textd[j]=text_data[i];
        j++;
      }
    }
var time_list=new Array();
var capacity_list=new Array();
var sensors_list=new Array();
var sensornumber=new Array();
var sensorname=new Array();
for (var j = 1; j < tr2.length; j++) 
{
  var td2=tr2[j].getElementsByTagName('td');
  for (var i = 2; i <td2.length; i++) {
  try
  {
  var temp=td2[i].getElementsByTagName('a')[0].innerHTML;
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
     sensor=temp
     for(l=0;l<textd.length;l++){
      
        if(temp==textd[l][1]){
          sensornumber.push(i);
          sensorname.push(temp);
        }
      
     }
     var uniqueNumbers = [];
$.each(sensornumber, function(i, el){
    if($.inArray(el, uniqueNumbers) === -1) uniqueNumbers.push(el);
});
var uniqueNames = [];
$.each(sensorname, function(i, el){
    if($.inArray(el, uniqueNames) === -1) uniqueNames.push(el);
});
sensors+=temp+"#";
}
}catch(ex)
{
 try
  {
  temp=td2[i].getElementsByTagName('label')[0].innerHTML;
   sensor=temp.split( '(');
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
//  console.log("res_dat-259");  
// console.log(res_dat);
//  console.log(uniqueNumbers);
// console.log(uniqueNames);
list=JSON.parse(res_dat);
// console.log(list);
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
for (var i = 1; i < tr2.length; i++) {
td2=tr2[i].getElementsByTagName('td');
for (var j = 0; j < td2.length; j++) {
  var d=data[z];
// console.log(d);
  var d_a=d.split("#");
if (!isNaN(d_a[0])) 
{
  d=Number(d_a[0]).toFixed(DecilPlace).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}
try
{
if (!isNaN(d_a[1]))
 {
  for(k=0;k<sensornumber.length;k++){
    if(j==sensornumber[k]){
      var temp_state=stationname[i-1];
      var temp_sens=sensorname[k];
      break;
    }
  }
  var color=getsensorcolor(temp_state,temp_sens,d);
  // console.log("color-586");
  // console.log(color);
  td2[j].getElementsByTagName('a')[0].style.color=color;
//   if (d_a[1]=="11")
//   td2[j].getElementsByTagName('a')[0].style.color="red";
// else
//     td2[j].getElementsByTagName('a')[0].style.color="green";
 }
 
 // alert(parseInt(data[z]));
td2[j].getElementsByTagName('a')[0].innerHTML=d;
}catch(ex)
{
  try
  {
td2[j].getElementsByTagName('label')[0].innerHTML=d;
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
