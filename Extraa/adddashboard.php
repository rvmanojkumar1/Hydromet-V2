




<?php
	include_once("includes/adminheader.php");
	
include_once("includes/link.php");
include_once 'database.php';
?>

 <script type='text/javascript' src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type='text/javascript' src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<script type="text/javascript">
	
function search()
{
	
 
var stn=document.getElementById('Stations').value;
var stn_type=document.getElementById('dashboard_type').options[document.getElementById('dashboard_type').selectedIndex].value;
 //document.getElementById("list").value="Select Sensors";
//document.getElementById("list_of_capacity").value="Capacity";
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     var e=document.getElementById("sen_tab");
     e.innerHTML="";
     var capacity_e=document.getElementById("Capacity_table_1");
     capacity_e.innerHTML="";
var json = this.responseText;

var parsed = JSON.parse(json);

var list = [];

for(var x in parsed){
  list.push(parsed[x]);
}


     for (var i = 0; i <list.length; i++) {
     
var tr=document.createElement('tr');
   var td = document.createElement('td');

    var td2 = document.createElement('td');

var tr_cap=document.createElement('tr');
 var td_cap = document.createElement('td');

    var td2_cap = document.createElement('td'); 

var checkbox = document.createElement('input');
checkbox.type = "checkbox";
checkbox.name = "List[]";
checkbox.value = list[i];

var checkbox_cap = document.createElement('input');
checkbox_cap.type = "checkbox";
checkbox_cap.name = "list_of_capacity_sen[]";
checkbox_cap.value = list[i];

var label = document.createElement('label')
label.htmlFor = "id";
label.appendChild(document.createTextNode(list[i]+" "));

var label_cap = document.createElement('label')
label_cap.htmlFor = "id2";
label_cap.appendChild(document.createTextNode(list[i]+" "));

td.appendChild(checkbox);
td2.appendChild(label);

td_cap.appendChild(checkbox_cap);
td2_cap.appendChild(label_cap);

tr_cap.appendChild(td_cap);
tr_cap.appendChild(td2_cap);

    tr.appendChild(td);
     tr.appendChild(td2);


     e.appendChild(tr);
    capacity_e.appendChild(tr_cap);

        }

       capacity_e.style.display="none";

    }
  };
 // alert("getSensors.php?Stations="+stn+"&stn_type="+stn_type);
  xhttp.open("GET", "getSensors.php?Stations="+stn+"&stn_type="+stn_type, true);
  xhttp.send();



}

function selectType()
{
	var stn=document.getElementById('dashboard_type').options[document.getElementById('dashboard_type').selectedIndex].value;

  var xhttp2 = new XMLHttpRequest();
  xhttp2.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
var data = this.responseText;

var json=JSON.parse(data);
var list=[];
for(var x in json)
{
	list.push(json[x]);

}
	var e=document.getElementById("Capacity_table_2");
e.innerHTML="";
for (var i = 0; i < list.length; i++) {

	var tr=document.createElement("tr");
	var td=document.createElement("td");
		var td2=document.createElement("td");

		var checkbox =document.createElement("input");
		checkbox.type="checkbox";
checkbox.name="list_of_capacity_field[]"
checkbox.value=list[i];
var label=document.createElement("label");
label.appendChild(document.createTextNode(list[i]+" "));

td.appendChild(checkbox);
td2.appendChild(label);
tr.appendChild(td);
tr.appendChild(td2);

e.appendChild(tr);


}

    }
  };
  xhttp2.open("GET", "getStationType.php?Stations="+stn, true);
  xhttp2.send();

  getStations();
  //search();	
}


function getStations()
{
var stn=document.getElementById('dashboard_type').options[document.getElementById('dashboard_type').selectedIndex].value;

  var xhttp2 = new XMLHttpRequest();
  xhttp2.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
var data = this.responseText;

var json=JSON.parse(data);
var list=[];
for(var x in json)
{
	list.push(json[x]);

}
	var e=document.getElementById("stn_tab");
e.innerHTML="";
for (var i = 0; i < list.length; i++) {

	var tr=document.createElement("tr");
	var td=document.createElement("td");
		var td2=document.createElement("td");

		var checkbox =document.createElement("input");
		checkbox.type="checkbox";
checkbox.name="stn_list[]"
checkbox.value=list[i];
var label=document.createElement("label");
label.appendChild(document.createTextNode(list[i]+" "));

td.appendChild(checkbox);
td2.appendChild(label);
tr.appendChild(td);
tr.appendChild(td2);

e.appendChild(tr);


}

    }
  };
  xhttp2.open("GET", "getStationforDashboard.php?Stations="+stn, true);
  xhttp2.send();
}
</script>




<link rel="stylesheet" href="assets/jquery-ui.css">
<!-- Latest compiled and minified JavaScript -->

<script type="text/javascript" src="assets/jquery.js"></script>
<script type="text/javascript" src="assets/jquery-ui.js"></script>





<br><br>
<style type="text/css">
td
{
	padding: 5px;
}
	#dashbord_table td
	{
		padding: 5px;
	
	}
	#dashbord_table th
	{
		background-color:#539CCC;
		color:white;
	
	}
	#user_table td
	{
		padding: 5px;
		
	}
	#user_table th
	{
		background-color:#539CCC;
		color:white;
	
	}
	 .myHover:hover{
    background-color: #F5F4F4;
  }
</style>

<?php 
if (isset($_GET["edit"])) {

$sql="SELECT \"Station_Full_Name\", \"Dashboard\", \"Sensors\", \"no_of_records\",  \"Users\",\"DashboardType\",\"CapacityType\",\"Capacity\",\"design_code\"
  FROM \"DefineDashboard\" where \"Dashboard\"='".$_GET["edit"]."'";
 $edit_data=pg_fetch_array(pg_query($sql));

}


 ?>
 <center>

<form action="dbDashboard.php" name="myform" id="myform" method="post">
<div class="panel panel-primary" style="width:98%"  >
         <div class="panel-heading" style="background-color:#4A7BDF;color:white"><center><b style="font-size:15px;">Dashboard</b></center></div>
  <div class="panel-body">
  
<table >
	<tr>
		<td><label>Dashboard Type</label></td>
		
		<td>
			<select name="dashboard_type"  id="dashboard_type" class="dropdown form-control" onchange="selectType()" required='true'>
			<option value="" disabled="" selected>Select type</option>
<?php 
$ds=pg_query("select \"StationType\" from \"tblStationType\"");
while ($row=pg_fetch_array($ds))
 {

?><option value='<?php echo $row[0]; ?>' <?php if (isset($edit_data['DashboardType'])) {
 if($row[0]==$edit_data['DashboardType']) echo 'selected'; }?> ><?php echo $row[0]; ?></option>
<?php
}

?>
			 </select>

		</td>
	
	<td><label>Dashboard Name</label></td>
		
		<td><input type="text" value="<?php if (isset($edit_data['Dashboard'])) { echo $edit_data['Dashboard'];}  ?>"  name="dashboard_name" id="dashboard_name" class="form-control" Required></td>

				<td><label>No of record</label></td>
	
<td>
	<input type="number"  name="no_of_record" id="no_of_record"  class="form-control" value="<?php if (isset($edit_data['no_of_records'])) { echo $edit_data['no_of_records'];}  ?>">
</td>
		</tr>
		<tr>
		<td><label>Station</label></td>
		<td>
<input id="Stations" style="width: 250px" data-toggle="modal" type="button" class="dropdown form-control" data-target="#myModalStn"  value="<?php if (isset($edit_data['Station_Full_Name'])) { echo $edit_data['Station_Full_Name'];}  ?>" required />
<input type="hidden" name="Stations" id="StationsH" value="<?php if (isset($edit_data['Station_Full_Name'])) { echo $edit_data['Station_Full_Name'];}  ?>">
</td>
	

		<td><label>Sensors</label></td>
		
	<td> 
<input id="list" style="width: 250px"   data-toggle="modal" type="button" class="dropdown form-control" data-target="#myModal" required value="<?php if (isset($edit_data['Sensors'])) { echo $edit_data['Sensors'];}  ?>" onclick="search()" >

	
<input type="hidden" name="Sensors"  id="SensorsH" value="<?php if (isset($edit_data['Sensors'])) { echo $edit_data['Sensors'];}  ?>">
		</td>


		<td><label>Capacity</label></td>

		<td > 
<input id="list_of_capacity" style="width: 250px"  data-toggle="modal" type="button" class="dropdown form-control" data-target="#myModal2" required value="<?php if (isset($edit_data['Capacity'])) { echo $edit_data['Capacity'];}  ?>" onclick="search()">
<input type="hidden" name="capacity_list" id="list_of_capacityH" value="<?php if (isset($edit_data['Capacity'])) { echo $edit_data['Capacity'];}  ?>">
<input type="hidden" name="capacity_type" id="capacity_type" value="<?php if (isset($edit_data['CapacityType'])) { echo $edit_data['CapacityType'];}  ?>">
	

		</td>		


	</tr>

</table>


<br>
<center>
<h4 style="font-weight: bold;">Select Users for Dashboard</h4>
</center>
<div style="max-height: 500px;overflow:scroll; ">

<table id="user_table" class="table table-responsive">
<tr>
	<th>Select</th>
	<th>Username</th>
	<th>Email</th>
	<th>Organization</th>
	<th>Mobile No.</th>

</tr>
<?php
$sql="select \"Username\",\"Email\",\"organization\",\"mobileno\" from \"tblloginandregister\" order by \"Username\"";

$result=pg_query($sql);

$edit_user_list=array();
if (isset($edit_data["Users"])) {
$edit_user_list=explode(";",trim($edit_data["Users"]));
}

$i=0;
while ($row=pg_fetch_array($result)) {

$check=false;
foreach ($edit_user_list as $user) {
	if (trim($user)==trim($row["Username"])) {
		$check=true;
	}
}
?>
	<tr class="myHover">
		<td><input type="checkbox" name="users[]" onchange="check_users()"  value="<?php if (isset($row["Username"])) echo $row["Username"];?>" <?php if ($check) echo "checked"; ?>></td>
        <td onclick="select('<?php echo $i; ?>')"><?php  echo $row["Username"];?></td>
	    <td onclick="select('<?php echo $i; ?>')"><?php  echo $row["Email"];?></td>
	    <td onclick="select('<?php echo $i; ?>')"><?php  echo $row["organization"];?></td>
	     <td onclick="select('<?php echo $i; ?>')"><?php  echo $row["mobileno"];?></td>	
	</tr>
<?php
$i++;
}
?>
</table>
</div>

 
  <input type="hidden" name="edit" value="<?php if (isset($_GET["edit"])) echo $_GET["edit"]; ?>">
 <input type="hidden" name="design_code" id="design_code" >
  <input type="hidden" name="ids" id="ids" >

<div>
<center>
	<div style="display: none"  id='remove_alert' class="alert alert-danger">
  <strong>Removed!</strong>
</div>
<img id="delete" ondrop="dropRemove(event)" ondragover="allowDrop(event)" src="assets/images/remove.png" style="width: 30px;height:40px;"/>
</center>
<?php
$id_d=pg_fetch_assoc(pg_query("select tag_id from tag_ids"));
 $tem=explode("#", $id_d['tag_id']); 
$div_i=$tem[0];
$img_i=$tem[1];
$row_i=$tem[2];
$div_i++;
$img_i++;
$row_i++;
?>

	<div class="row" style="height: 600px;overflow: auto;" >
		<div  class="col-sm-2" style="height: 600px;overflow: auto;">
		<div id="img_div1"  style="width: 200px;height:200px;border: 1px solid #aaaaaa;padding: 10px;overflow: auto;">
			<img  name="gauge_img" src="assets/images/gauge_icon.jpg" id="<?php echo 'img_1_'.$img_i;?>" style="width: 170px;height: 150px" draggable="true" ondragstart="drag(event)"/>
			</div>
			<div id="img_div2" style="width: 200px;height:200px;border: 1px solid #aaaaaa;padding: 10px;overflow: auto;">
						<img name="graph_img"  src="assets/images/line_graph.png" id="<?php echo 'img_2_'.$img_i;?>" style="width: 170px;height: 150px" draggable="true" ondragstart="drag(event)"/>
</div><div id="img_div3"  style="width: 200px;height:200px;border: 1px solid #aaaaaa;padding: 10px;overflow: auto;">
			<img name="table_img"  src="assets/images/table.png" id="<?php echo 'img_3_'.$img_i;?>" style="width: 170px;height: 150px" draggable="true" ondragstart="drag(event)"/>
			</div>
<div id="col_div2"  style="width: 200px;height:200px;border: 1px solid #aaaaaa;padding: 10px;overflow: auto;">
<div id="<?php echo 'col_2_'.$div_i;?>" class="col-sm-4" style="height: 200px;border: 1px solid #aaaaaa;padding: 10px;width: 400px;" draggable="true" ondragstart="drag(event)"> 
<img style="height: 150px;width: 150px;float:left;" src="assets/images/twoH.png"/>
</div>
</div>
<div id="col_div1"  style="width: 200px;height:200px;border: 1px solid #aaaaaa;padding: 10px;overflow: auto;">
<div id="<?php echo 'col_1_'.$div_i;?>" class="col-sm-2"  style="height: 200px;border: 1px solid #aaaaaa;padding: 10px;width: 200px" draggable="true" ondragstart="drag(event)"> 
<img style="height: 150px;width: 150px;float:left;" src="assets/images/one.png"/>

</div>
</div>
<div id="col_div3" style="width: 200px;height:200px;border: 1px solid #aaaaaa;padding: 10px;overflow: auto;">
<div id="<?php echo 'col_3_'.$div_i;?>" class="col-sm-6"  style="height: 200px;border: 1px solid #aaaaaa;padding: 10px;width: 600px" draggable="true" ondragstart="drag(event)">
<img style="height: 150px;width: 150px;float:left;" src="assets/images/threeH.png"/>

 </div>
</div>
<div id="col_div4"  style="width: 200px;height:200px;border: 1px solid #aaaaaa;padding: 10px;overflow: auto;">
<div id="<?php echo 'col_4_'.$div_i;?>" class="col-sm-4" style="height: 400px;border: 1px solid #aaaaaa;padding: 10px;width: 400px;" draggable="true" ondragstart="drag(event)">
<img style="height: 150px;width: 150px;float:left;" src="assets/images/four.png"/>

 </div>
</div>
<div id="col_div5"  style="width: 200px;height:200px;border: 1px solid #aaaaaa;padding: 10px;overflow: auto;">
<div id="<?php echo 'col_5_'.$div_i;?>" class="col-sm-6"  style="height: 400px;border: 1px solid #aaaaaa;padding: 10px;width: 200px" draggable="true" ondragstart="drag(event)"> 
<img style="height: 150px;width: 150px;float:left;" src="assets/images/twoV.png"/>

</div>
</div>
<div id="col_div6"  style="width: 200px;height:200px;border: 1px solid #aaaaaa;padding: 10px;overflow: auto;">
<div id="<?php echo 'col_6_'.$div_i;?>" class="col-sm-6"  style="height: 400px;border: 1px solid #aaaaaa;padding: 10px;width: 600px" draggable="true" ondragstart="drag(event)"> 
<img style="height: 150px;width: 150px;float:left;" src="assets/images/two_three.png"/>

</div>
</div>
<div id="row_div"  style="width: 200px;height:200px;border: 1px solid #aaaaaa;padding: 10px;overflow: auto;">
<div id="<?php echo 'row_'.$row_i;?>" class="row"  style="min-height: 10%;border: 1px solid #aaaaaa;" draggable="true" ondragstart="drag(event)"> 
<img style="margin-left: 20px;height: 150px;width: 150px;float:left;" src="assets/images/row.png"/>

</div>
</div>
		</div>
<div class="col-sm-8"  style="margin-right: 2%;margin-left: 4%;height: 100%;overflow:auto; border: 1px solid #aaaaaa;width: 830px;">
<div  id="dashboard_design" ondrop="drop(event)" ondragover="allowDrop(event)" style="height: 300%;width: 830px;">
		<?php if (isset($edit_data['design_code'])) {
			echo $edit_data['design_code'];
		} ?>
</div>
		</div>
		<div  class="col-sm-2">

		<div class="col-sm-12"  ondrop="drop(event)" ondragover="allowDrop(event)" id="stn_link_list" style="max-height: 300px;overflow: auto;"></div>
		<div class="col-sm-12"  ondrop="drop(event)" ondragover="allowDrop(event)" id="sen_link_list" style="max-height: 300px;overflow: auto;"></div>

</div>
	</div>

</div>

<br>


<input type="Submit" onclick="getDashboardDesign()"  id="submit_btn" disabled value="Submit"  class="btn btn-primary"/>
<input type="button"  value="Cancel" onclick="cancelSubmit()" class="btn btn-danger"/>
</div>
</div>

</form>
</center>
<script>
var div_i='<?php echo $div_i;?>';
var row_i='<?php echo $row_i;?>';
var img_i='<?php echo $img_i;?>';



function remove(id) {
    var elem = document.getElementById(id);
    return elem.parentNode.removeChild(elem);
}
function dropRemove(ev)
{
	  ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    //alert(data);
    remove(data);
    $("#remove_alert").fadeTo(2000, 500).slideUp(500, function(){
    $("#remove_alert").slideUp(500);
});
}
function allowDrop(ev) {
    ev.preventDefault();


}

function drag(ev) {

    ev.dataTransfer.setData("text", ev.target.id);

}

function drop(ev) {

    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
var x=document.getElementById(data);
var hh = x.getElementsByTagName('img')[0];

var list=data.split("_");
if (list[0]!='img'&&list[list.length-1]!='0') {
	x.removeChild(hh);

}
//alert(data);

if (list[0]=="col"&&list[1]==2) 
{
		div_i++;

	document.getElementById("col_div2").innerHTML='<div id="col_2_'+div_i+'" class="col-sm-4" style="height: 200px;border: 1px solid #aaaaaa;padding: 10px;width: 400px;" draggable="true" ondragstart="drag(event)"><img style="height: 150px;width: 150px;float:left;" src="assets/images/twoH.png"/> </div>';

}
if (list[0]=="col"&&list[1]==1) 
{
		div_i++;

	document.getElementById("col_div1").innerHTML='<div id="col_1_'+div_i+'" class="col-sm-4" style="height: 200px;border: 1px solid #aaaaaa;padding: 10px;width: 200px;" draggable="true" ondragstart="drag(event)"><img style="height: 150px;width: 150px;float:left;" src="assets/images/one.png"/> </div>';

}
if (list[0]=="col"&&list[1]==3) 
{
		div_i++;

	document.getElementById("col_div3").innerHTML='<div id="col_3_'+div_i+'" class="col-sm-4" style="height: 200px;border: 1px solid #aaaaaa;padding: 10px;width: 600px;" draggable="true" ondragstart="drag(event)"><img style="height: 150px;width: 150px;float:left;" src="assets/images/threeH.png"/> </div>';

}
if (list[0]=="col"&&list[1]==4) 
{
		div_i++;

	document.getElementById("col_div4").innerHTML='<div id="col_4_'+div_i+'" class="col-sm-4" style="height: 400px;border: 1px solid #aaaaaa;padding: 10px;width: 400px;" draggable="true" ondragstart="drag(event)"><img style="height: 150px;width: 150px;float:left;" src="assets/images/four.png"/> </div>';

}
if (list[0]=="col"&&list[1]==5) 
{
		div_i++;

	document.getElementById("col_div5").innerHTML='<div id="col_5_'+div_i+'" class="col-sm-6"  style="height: 400px;border: 1px solid #aaaaaa;padding: 10px;width: 200px" draggable="true" ondragstart="drag(event)"> <img style="height: 150px;width: 150px;float:left;" src="assets/images/twoV.png"/> </div>';

}
if (list[0]=="col"&&list[1]==6) 
{
		div_i++;

	document.getElementById("col_div6").innerHTML='<div id="col_6_'+div_i+'" class="col-sm-6"  style="height: 400px;border: 1px solid #aaaaaa;padding: 10px;width: 600px" draggable="true" ondragstart="drag(event)"> <img style="height: 150px;width: 150px;float:left;" src="assets/images/two_three.png"/> </div>';

}


if (list[0]=="row") 
{
		row_i++;

	document.getElementById("row_div").innerHTML='<div id="row_'+row_i+'" class="row"  style="min-height: 10%;border: 1px solid #aaaaaa;" draggable="true" ondragstart="drag(event)"> <img style="margin-left: 20px;height: 150px;width: 150px;float:left;" src="assets/images/row.png"/></div>';

}
if (list[0]=="img"&&list[1]==1) 
{
		img_i++;

	document.getElementById("img_div1").innerHTML='<img name="gauge_img" src="assets/images/gauge_icon.jpg" id="img_1_'+img_i+'" style="width: 170px;height: 150px" draggable="true" ondragstart="drag(event)"/>';

}
if (list[0]=="img"&&list[1]==2) 
{
		img_i++;

	document.getElementById("img_div2").innerHTML='<img  name="graph_img" src="assets/images/line_graph.png" id="img_2_'+img_i+'" style="width: 170px;height: 150px" draggable="true" ondragstart="drag(event)"/>';

}
if (list[0]=="img"&&list[1]==3) 
{
		img_i++;

	document.getElementById("img_div3").innerHTML='<img name="table_img" src="assets/images/table.png" id="img_3_'+img_i+'" style="width: 170px;height: 150px" draggable="true" ondragstart="drag(event)"/>';

}
if(ev.target.tagName!='IMG')
{
    ev.target.appendChild(x);
}

}

	function getDashboardDesign()
	{
var e= document.getElementById("dashboard_design");
var ids=div_i+"#"+img_i+"#"+row_i;
//alert(ids);
document.getElementById("ids").value=ids;
//alert(ids);
document.getElementById("design_code").value=''+e.innerHTML;
if (e.innerHTML=="") {
	return;
}

	}
</script>

 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/i18n/defaults-*.min.js"></script>
<?php
if (isset($_GET["edit"])) {
	?>
	<script type="text/javascript">
	 $(document).ready(function() {
var stn_link_list=document.getElementById('stn_link_list');
	 	stn_link_list.innerHTML="<h3>Link to graph</h3><br>";

	 	var stn_list=document.getElementById('Stations').value;
var stns=stn_list.split(";");
for(var i=0;i<stns.length;i++)
{
 	stn_link_list.innerHTML+="<label  id='"+stns[i]+"_0' style='float;left;' draggable='true' ondragstart='drag(event)' >"+stns[i]+"</label><br><br>";
}
		var list=document.getElementById("list").value;
 var xhttp = new XMLHttpRequest();
	 var stns=document.getElementById("Stations").value;
	 	 var stntype=document.getElementById("Stations").value;
var stn_type=document.getElementById('dashboard_type').options[document.getElementById('dashboard_type').selectedIndex].value;
	 	 var sensors=list;
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
var data = this.responseText;
var json = this.responseText;

var parsed = JSON.parse(json);

//var list = [];
var e=document.getElementById('sen_link_list');
e.innerHTML="<h3>Link to gauge</h3><br>";
for(var x in parsed){
 // list.push(parsed[x]);

e.innerHTML+="<label  id='"+parsed[x]+"_0' style='float;left;' draggable='true' ondragstart='drag(event)' >"+parsed[x]+"</label><br><br>";

}}};



  xhttp.open("GET", "getSensorwithStation.php?stations="+stns+"&sensors="+sensors+"&stn_type="+stn_type, true);
  xhttp.send();	});
	</script>
	<?php
}
?>
<?php
/*if (isset($_GET["edit"])) {

echo "<script>selectType();</script>";
$sql="SELECT \"Station_Full_Name\", \"Sensors\", \"Hours\", \"Days\",\"Capacity\",\"CapacityType\"
  FROM \"DefineDashboard\" where \"Dashboard\"='".$_GET["edit"]."'";
 $result_edit= pg_query($sql);
 while($edit_data=pg_fetch_array($result_edit))
 {
 	?>
 	<script type="text/javascript">
 	document.getElementById("submit_btn").disabled=false;
 	document.getElementById("user_div").style.display="";
  var table =document.getElementById('dashbord_table');
	table.style.display="";
table.innerHTML+="<tr class='myHover'><td><?php echo $edit_data["Station_Full_Name"]; ?> <input type='hidden' name='Stations[]' value='<?php echo $edit_data["Station_Full_Name"]; ?>'/></td><td><?php echo $edit_data["Sensors"]; ?><input type='hidden' name='Sensors[]' value='<?php echo $edit_data["Sensors"]; ?>'/></td><td><?php echo $edit_data["Hours"]; ?> <input type='hidden' name='Hours[]' value='<?php echo $edit_data["Hours"]; ?>'/></td><td><?php echo $edit_data["Days"]; ?> <input type='hidden' name='Days[]' value='<?php echo $edit_data["Days"]; ?>'/></td><td><?php echo $edit_data["Capacity"]; ?> <input type='hidden' name='capacity_list[]' value='<?php echo $edit_data["Capacity"]; ?>'/> <input type='hidden' name='capacity_type[]' value='<?php echo $edit_data["CapacityType"]; ?>'/></td><td align='center' style='width:55px'><a data-toggle='tooltip' title='Delete!' onclick='deleteRow(this)'><img src='b_drop.png' align='DELETE' /></a></td></tr>";

 	</script>
 	<?php
 }

}*/
?>

<script type="text/javascript">
	
	function select(i)
	{
var e=document.getElementsByName("users[]")[i];
if (e.checked) {
	e.checked=false;
}
else
{
	e.checked=true;
	}
	check_users();
}



function addrow()
{


        var params = document.getElementById("list").value;    
var stn=document.getElementById("Stations").value;
var hours=document.getElementById("hours").value;
var from=document.getElementById("days").value;
var capacity_list=document.getElementById("list_of_capacity").value;
var capacity_type='';
var capacity_sen=document.getElementById("capacity_sen");
	var capacity_field=document.getElementById("capacity_field");

	if (capacity_sen.checked) 
	{
		capacity_type=capacity_sen.value;
	}
	 else{
capacity_type=capacity_field.value;
	}
	

 if (stn.trim()=="")
 {
alert("Please Enter Station Name!");

 }
 else if (params.trim()=="Select Sensors")
 {
alert("Please Select Sensors!");

 }
  else if (from.trim()==""&&hours.trim()=="")
 {

alert("Please Enter Hours or Days!");
 }
 else if (capacity_list.trim()=="Capacity") {
alert("Please Select capacity columns!");
 }
else
{

	document.getElementById("user_div").style.display="";
        var table =document.getElementById("dashbord_table");

	table.style.display="";
table.innerHTML+="<tr class='myHover'><td>"+stn+" <input type='hidden' name='Stations[]' value='"+stn+"'/></td><td>"+params+" <input type='hidden' name='Sensors[]' value='"+params+"'/></td><td>"+hours+" <input type='hidden' name='Hours[]' value='"+hours+"'/></td><td>"+from+" <input type='hidden' name='Days[]' value='"+from+"'/></td><td>"+capacity_list+" <input type='hidden' name='capacity_list[]' value='"+capacity_list+"'/><input type='hidden' name='capacity_type[]' value='"+capacity_type+"'/></td><td align='center' style='width:55px'><a data-toggle='tooltip' title='Delete!' onclick='deleteRow(this)'><img src='b_drop.png' align='DELETE' /></a></td></tr>";
document.getElementById("list").value="Sensor";    
document.getElementById("Stations").value="";
document.getElementById("hours").value="";
document.getElementById("days").value="";
}
}
function deleteRow(row)
{
  
    var i=row.parentNode.parentNode.rowIndex;
  
    document.getElementById('dashbord_table').deleteRow(i);
}
function setStn()
{
	

	var stn_link_list=document.getElementById('stn_link_list');
	 	stn_link_list.innerHTML="<h3>Link to graph</h3><br>";

	var e=document.getElementsByName("stn_list[]");
var list='';
  for (var i = 0; i < e.length; i++) {
  	if (e[i].checked) {
 	list+=e[i].value+";";

 	stn_link_list.innerHTML+="<label  name='stn_lab'  id='"+e[i].value+"_0' style='float;left;' draggable='true' ondragstart='drag(event)' >"+e[i].value+"</label><br><br>";
 	}
 }
 if(list.trim()!="")
 {
document.getElementById("Stations").value=list;	
document.getElementById("StationsH").value=list;	
}
else
{
document.getElementById("Stations").value="";	
document.getElementById("StationsH").value="";		
}
check_users();
}
function setSensor()
{
 var e=document.getElementsByName("List[]");
var list='';
  for (var i = 0; i < e.length; i++) {
  	if (e[i].checked) {
 	list+=e[i].value+";";
 	}
 }
 if(list.trim()!="")
 {
document.getElementById("list").value=list;	
document.getElementById("SensorsH").value=list;	
}
else
{
document.getElementById("list").value="";
document.getElementById("SensorsH").value="";	

}

check_users();
sensorlinklist(list);
}

function cancelSubmit()
{
	window.location.href="admindashboard.php";
}
 function check_users()
 {
 	 var e=document.getElementsByName("users[]");
 	 var stn=document.getElementById("Stations").value;
 	 var capacity=document.getElementById("list_of_capacity").value;
 	 var Sensor=document.getElementById("list").value;
var check=false;
if(stn.trim()=="")
{

check=false;
}
else if (capacity.trim()=="") 
{
check=false;
}
else if (Sensor.trim()=="")
 {
 	check=false;
 }

 else
 {
 				


  for (var i = 0; i < e.length; i++) {
  	if (e[i].checked) {
 check=true;
 	}
 }
 }

 	if (check) {

 				document.getElementById("submit_btn").disabled=false;
}
 else{
 	 				document.getElementById("submit_btn").disabled=true;

 }
}

function readOnlyOnFocusOut()
{

var hours=document.getElementById("hours");

var days=document.getElementById("days");

if (hours.value.trim()=="") 
{
days.readOnly=false;
}
if (days.value.trim()=="") 
{
hours.readOnly=false;	
}
}
function readOnlyOnFocusHours()
{

var days=document.getElementById("days");

if (days.value.trim()=="") {
days.readOnly=true;	
}
}

function readOnlyOnFocusDays()
{

var hours=document.getElementById("hours");

if (hours.value.trim()=="") {
hours.readOnly=true;	
}
}
function capacity_r()
{
	var capacity_sen=document.getElementById("capacity_sen");
	var capacity_field=document.getElementById("capacity_field");

	if (capacity_sen.checked) 
	{
document.getElementById("Capacity_table_1").style.display="";
document.getElementById("Capacity_table_2").style.display="none";
	}
	else
	{
document.getElementById("Capacity_table_1").style.display="none";
document.getElementById("Capacity_table_2").style.display="";
	}
}

function setCapacity()
{
	var capacity_sen=document.getElementById("capacity_sen");
	var capacity_field=document.getElementById("capacity_field");
	var capacity_type=''
var e;
	if (capacity_sen.checked) 
	{
	e=document.getElementsByName("list_of_capacity_sen[]");
	capacity_type='Sensors';
	}
else
{
	e=document.getElementsByName("list_of_capacity_field[]");
capacity_type='Fileds';
}
var list='';
  for (var i = 0; i < e.length; i++) {
  	if (e[i].checked) {
 	list+=e[i].value+";";
 	}
 }
 if(list.trim()!="")
 {
document.getElementById("list_of_capacity").value=list;	
document.getElementById("list_of_capacityH").value=list;	
document.getElementById("capacity_type").value=capacity_type;	
}
else
{
document.getElementById("list_of_capacity").value="";	
document.getElementById("list_of_capacityH").value="";	

document.getElementById("capacity_type").value=capacity_type;		
}

check_users();

}

function sensorlinklist(list)
{
	
	 var xhttp = new XMLHttpRequest();
	 var stns=document.getElementById("Stations").value;
	 	 var stntype=document.getElementById("Stations").value;
var stn_type=document.getElementById('dashboard_type').options[document.getElementById('dashboard_type').selectedIndex].value;
	 	 var sensors=list;
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
var data = this.responseText;
var json = this.responseText;

var parsed = JSON.parse(json);

//var list = [];
var e=document.getElementById('sen_link_list');
e.innerHTML="<h3>Link to gauge</h3><br>";
for(var x in parsed){
 // list.push(parsed[x]);

e.innerHTML+="<label   id='"+parsed[x]+"_0' style='float;left;' draggable='true' ondragstart='drag(event)' >"+parsed[x]+"</label><br><br>";

}}};



  xhttp.open("GET", "getSensorwithStation.php?stations="+stns+"&sensors="+sensors+"&stn_type="+stn_type, true);
  xhttp.send();
}


</script>


<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Sensors</h4>
        </div>
        <div class="modal-body">
                <div style="max-height: 500px;overflow:scroll; ">

       <table class="table table-responsive table-hover"  style="width:50%" id='sen_tab'>
       
       </table>
       </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="setSensor()" data-dismiss="modal">Ok</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>


<div class="modal fade" id="myModal2" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Capacity</h4>
        </div>
        <div class="modal-body">
         <input type="radio" name="capacity" id="capacity_field" value="Field" onclick="capacity_r()" checked>Station Fields
        <input type="radio" name="capacity" id="capacity_sen" value="Sensor"  onclick="capacity_r()">Sensors
       
          <div style="max-height: 500px;overflow:scroll; ">

       <table class="table table-responsive table-hover" style="width:50%;" id='Capacity_table_1'>
       
       </table>
  
        <table class="table table-responsive table-hover" style="width:50%;" id='Capacity_table_2'>
      
       </table>
       </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="setCapacity()" data-dismiss="modal">Ok</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>


  <div class="modal fade" id="myModalStn" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Stations</h4>
        </div>
        <div class="modal-body">
        <div style="max-height: 500px;overflow:scroll; ">
       <table class="table table-responsive table-hover" style="width:50%display:block;" id='stn_tab'>
       
       </table>
       </div>
        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="setStn()" data-dismiss="modal">Ok</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
<?php
if (isset($_GET["edit"])) {

?>
<script>
	document.getElementById("submit_btn").disabled=false;
selectType();
</script>
<?php
}
?>

