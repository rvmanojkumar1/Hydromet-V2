	<?php
								include("includes/link.php");
						       include_once 'database.php';
								include("includes/adminheader.php");
							?>
							
<script  src="js/jquery.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script> 
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js" type="text/javascript"></script> 

 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstra.css">

 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous" />
<link rel="stylesheet" href="styles.css" type="text/css" />
							<center>
 <br><br>
 <?php
 
if (isset($_GET["delete_id"])) {
$delete_id= $_GET["delete_id"]; 

pg_query("delete from \"tblCompany\" where \"Name\"='$delete_id'");
pg_query("delete from \"tblCompany2Station\" where \"Company\"='$delete_id'");

}
 ?>
  <div class="panel panel-primary" style="width:95%"  >
         <div class="panel-heading" style="background-color:#4A7BDF;color:white"><b style="font-size:15px;">Company List</b></div>
  <div class="panel-body">
  <?php
$result=pg_query("SELECT \"Name\", phone_no, email, address FROM \"tblCompany\"");


   ?>
   <div style="max-height: 100%;overflow: auto;">
<table class="table table-responsive table-bordered table-hover">
<thead>
<tr>
	<th colspan="6">
		<input style="float: right;" class="btn btn-primary" type="button" name="Add" value="Add Company" id="addnew">
	</th>
</tr>
	<tr>
<th style="background-color:#539CCC;color:white;">Name</th>
<th style="background-color:#539CCC;color:white;">Phone no</th>

<th style="background-color:#539CCC;color:white;">Email</th>
<th style="background-color:#539CCC;color:white;">Address</th>

<th colspan="2" style="background-color:#539CCC;color:white;text-align:center">Action</th>
	</tr>
</thead>
<?php 
if (pg_num_rows($result)>0) {
	# code...

while ($row=pg_fetch_array($result)) {

	?>
	<tr>
<td><?php echo $row[0]; ?></td>
<td><?php echo $row[1]; ?></td>
<td><?php echo $row[2]; ?></td>
<td><?php echo $row[3]; ?></td>



  <td align="center" style="width:40px"><a data-toggle="tooltip" title="Edit!" href="javascript:edt_id('<?php echo $row['0']; ?>')"><img src="b_edit.png" align="EDIT" /></a></td>
            <td align="center" style="width:40px"><a data-toggle="tooltip" title="Detete!" href="javascript:delete_id('<?php echo $row['0']; ?>')"><img src="b_drop.png" align="DELETE" /></a></td>
            </tr>

	<?php
}
}
else
{
	echo "<tr><td>No Data Found!</td></tr>";
}
?>

</table>
</div>
  </div>
  </div>
  </center>

  <script type="text/javascript">
	function delete_id(id)
{
	if(confirm('Do you want to delete?'))
	{

		window.location.href='Company.php?delete_id='+id;
	}
}
	function edt_id(id)
{
	
		window.location.href='\\HydrometV2\\Station\\demo\\AddCompany.php?edt_id='+id;
	
}
$(document).ready(function(){
    $("#addnew").click(function(){

window.open("\\HydrometV2\\Station\\demo\\AddCompany.php","_self");
    });


});
</script>
<?php 
if (isset($_GET['Message'])) {

echo "<script>alert('Company Saved successfully!');</script>";
}

?>