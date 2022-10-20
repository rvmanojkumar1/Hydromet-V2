

<form method="post" id="data" action="TemplateGetData.php">
  
</form>
<script type="text/javascript">
var table= document.getElementById('myTable');
var th= table.getElementsByTagName('th');

var stations="";
var sensor_array=new Array();
var tr=table.getElementsByTagName('tr');
for (var i = 1; i < tr.length; i++) {


stations+=tr[i].getElementsByTagName('td')[0].getElementsByTagName('a')[0].innerHTML+"#";

}



var sensors="";
var capacity="";
var change_sensor="";
var time="";
var time_list=new Array();
var capacity_list=new Array();
var sensors_list=new Array();

for (var j = 1; j < tr.length; j++) 
{

  var td=tr[j].getElementsByTagName('td');

  for (var i = 2; i <td.length; i++) {

  try
  {
  var temp=td[i].getElementsByTagName('a')[0].innerHTML;
var sensor=new Array();
if(temp.toLowerCase().includes('change'))
{
  sensor=temp.split('(');
sensors+=sensor[0]+"#";

  time=parseInt(sensor[1]);
  if (sensor[1].replace(/[^a-zA-Z ]/g, "").toLowerCase().trim()=="hr") {
 time+=" hours";
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
  temp=td[i].getElementsByTagName('label')[0].innerHTML;
   sensor=temp.split('(');
capacity+=sensor[0]+"#";
}catch(exx)
{

}
}
}
capacity_list[j-1]=capacity;
sensors_list[j-1]=sensors;
time_list[j-1]=time;
capacity="";
sensors="";
time="";
}

document.getElementById("data").innerHTML="<input type='hidden' name='stations' value='"+stations+"'><input type='hidden' name='sensors' value='"+sensors_list+"'><input type='hidden' name='capacity' value='"+capacity_list+"'><input type='hidden' name='time' value='"+time_list+"'>";


</script>
<script type="text/javascript" src="assets/jquery.js"></script>
<script>
function sendRequest()
{
  $.ajax({
                   type: 'POST',
                   
                    url: $("form").attr("action"),
                    data: $("form").serialize(),
                 
 
                   success: function (res_data, textStatus, xhr) {
                    var list;

res_data = res_data.replace(/}{/g,',');
  

 
list=JSON.parse(res_data);

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
for (var i = 1; i < tr.length; i++) {

td=tr[i].getElementsByTagName('td');
for (var j = 0; j < td.length; j++) {
  var d=data[z];
  
  var d_a=d.split("#");
if (!isNaN(d_a[0])) 
{
  d=Number(d_a[0]).toFixed(2)
}
try
{
if (!isNaN(d_a[1]))
 {
  if (d_a[1]=="11")
  td[j].getElementsByTagName('a')[0].style.color="red";
else
    td[j].getElementsByTagName('a')[0].style.color="green";

 }
 
 // alert(parseInt(data[z]));
td[j].getElementsByTagName('a')[0].innerHTML=d;
}catch(ex)
{
  try
  {
td[j].getElementsByTagName('label')[0].innerHTML=d;
}catch(ee){}
}
z++;
//alert(station);
}

}

                   },
                   error: function (XMLHttpRequest, textStatus, errorThrown) {
                     
                    alert(textStatus);
                   }


               });
     
}
sendRequest();
     setTimeout(sendRequest, 1000);



</script>
