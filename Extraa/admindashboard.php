<?php
	include_once("includes/adminheader.php");
include_once("includes/link.php");
include_once 'database.php';
if (isset($_GET['inserted'])) {
  if(trim($_GET['inserted'])=='1')
  {
echo "<script>alert('Dashboard has been Saved!');</script>";
  }
}

if (isset($_GET['delete'])) {
 $ID=$_GET['delete'];
 pg_query("delete from \"DefineDashboard\" where \"Dashboard\"='$ID'");
}
?>

<style type="text/css">
	#th {
		background-color:#539CCC;
		color:white;
		
	}
    #th2 {
    background-color:#539CCC;
    color:white;
    
  }
  .myHover:hover{
    background-color: #F5F4F4;
  }

</style>
<script type="text/javascript">
function serach_stn_type() {

  var input, filter, table, tr, td, i;
  input = document.getElementById("serach_stn_type");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[1];
   
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";

 

      } else {
        tr[i].style.display = "none";
      }
    }

    }
  try
{

     var innerTable= document.getElementsByClassName("Dashboard_details");
  // alert(innerTable+" "+z);
  for (var i = 0; i < innerTable.length; i++) {
   

      innerTable[i].style.display="none";
        }
    }catch(e)
    {

    }
}
function serach_dashboard() {


  var input, filter, table, tr, td, i;
  input = document.getElementById("serach_dashboard");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[2];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    } 
  }

    try
{

     var innerTable= document.getElementsByClassName("Dashboard_details");
  // alert(innerTable+" "+z);
  for (var i = 0; i < innerTable.length; i++) {
   

      innerTable[i].style.display="none";
        }
    }catch(e)
    {

    }
}
function serach_user() {

  var input, filter, table, tr, td, i;
  input = document.getElementById("serach_user");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[4];
   
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";

 

      } else {
        tr[i].style.display = "none";
      }
    }

    }
  try
{

     var innerTable= document.getElementsByClassName("Dashboard_details");
  // alert(innerTable+" "+z);
  for (var i = 0; i < innerTable.length; i++) {
   

      innerTable[i].style.display="none";
        }
    }catch(e)
    {

    }
}
function addnew()
{
	window.location.href="adddashboard.php";
}

function serach_stn() {

  var input, filter, table, tr, td, i;
  input = document.getElementById("serach_stn");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[3];
   
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";

 

      } else {
        tr[i].style.display = "none";
      }
    }

    }
  try
{

     var innerTable= document.getElementsByClassName("Dashboard_details");
  // alert(innerTable+" "+z);
  for (var i = 0; i < innerTable.length; i++) {
   

      innerTable[i].style.display="none";
        }
    }catch(e)
    {

    }
}
</script>
 <script type="text/javascript">
   function delete_id(id)
   {
   if (confirm("Do you want to delete?")) {
window.location.href="admindashboard.php?delete="+id;
}
   }
   function edit_id(id)
   {

window.location.href="adddashboard.php?edit="+id;
   }

 </script>
<br><br>
<center>
<div class="panel panel-primary" style="width:98%"  >
         <div class="panel-heading" style="background-color:#4A7BDF;color:white"><center><b style="font-size:15px;">List of Dashbords</b></center></div>
  <div class="table-responsive" style="overflow: auto;">
<table id="myTable" style="width: 100%;" class="table  table-striped" border="1">
<tr>
<th></th>
<th><input type="text" onkeyup="serach_stn_type()" placeholder="Search" name="serach_stn_type" id="serach_stn_type"></th>
<th><input type="text" onkeyup="serach_dashboard()" placeholder="Search" name="serach_dashboard" id="serach_dashboard"></th>
<th>
  <input type="text" onkeyup="serach_stn()" placeholder="Search" name="serach_stn" id="serach_stn">
</th>
<th>
	<input type="text" onkeyup="serach_user()" placeholder="Search" name="serach_user" id="serach_user">
</th>

<th colspan="2"><button type="button" onclick="addnew()" class="btn btn-primary" style="float: right;">Add Dashboard</button></th>	

</tr>

<tr id="th">
<th></th>
<th>Dashboard Type</th>

<th>Dashboard Name</th>
<th>Stations</th>
<th>Users</th>
<th colspan="2">Actions</th>
</tr>
<?php
$sql="select distinct on (\"Dashboard\") \"Dashboard\",\"Users\",\"ID\",\"DashboardType\",\"Station_Full_Name\",\"Sensors\",\"Capacity\",\"no_of_records\" from \"DefineDashboard\"";

$result=pg_query($sql);
$i=1;
while ($row=pg_fetch_array($result)) {
	?>
	<tr class="myHover">
<td style="text-align: center;"><img title="see more details..." id='<?php echo "expand$i";?>' src="assets/images/expandDown.png" onclick="expand('<?php echo $i; ?>')"> </td>
<td><?php echo $row['DashboardType']; ?></td>

<td><?php echo $row['Dashboard']; ?></td>
<td>
<?php echo $row['Station_Full_Name']; ?>
</td>

<td style="height: 50px;overflow-y:scroll;width: 100%">

<?php echo $row['Users']; ?>

</td>

            <td align="center" style="width:55px"><a data-toggle="tooltip" title="Edit!" href="javascript:edit_id('<?php echo $row["Dashboard"]; ?>')"><img src="b_edit.png" align="EDIT" /></a></td>
            <td align="center" style="width:55px"><a data-toggle="tooltip" title="Delete!" href="javascript:delete_id('<?php echo $row["Dashboard"]; ?>')"><img src="b_drop.png" align="DELETE" /></a>
            </td>
    
	</tr>


<tr id="<?php echo 'Dashboard_details'.$i; ?>" class="Dashboard_details" style="display: none;">
<td></td>
<td colspan="4">
  <table class="table" >
  <tr id="th2">
    <th>Sensors</th> <th>Capacity</th> <th>No of Records</th> 
  </tr>


    <tr class="myHover <?php echo 'innerTable'.$i; ?>" > 
<td style="height: 50px;overflow-y:scroll;">

<?php echo $row['Sensors']; ?>

</td><td style="height: 50px;overflow-y:scroll;">

<?php echo $row['Capacity']; ?>

</td>
<td style="height: 50px;overflow-y:scroll;">

<?php echo $row['no_of_records']; ?>

</td>


    </tr>

  
  </table>

</td>
<td></td><td></td>

<tr>


	<?php
	
$i++;

	}
?>



</table>
</div>
</div>
</div></center>



<script type="text/javascript">
  function expand(i)
  {
    var e=document.getElementById("Dashboard_details"+i);
    var innerTable= document.getElementsByClassName("innerTable"+i);
  if (e.style.display=="none") {
    e.style.display="";
    for (var j = 0; j < innerTable.length; j++) {
      innerTable[j].style.display="";
      document.getElementById("expand"+i).src="assets/images/expandUp.png" ;
    }
 
    
    }
    else{
         e.style.display="none";
          for (var j = 0; j < innerTable.length; j++) {
      innerTable[j].style.display="none";
            document.getElementById("expand"+i).src="assets/images/expandDown.png" ;

    }
    }
  }

</script>