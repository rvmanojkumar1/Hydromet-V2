<?php
include_once 'database.php';

// delete condition
if(isset($_GET['delete_id']))
{
	$sql_query="DELETE FROM \"tblhydrometparamstype\" WHERE \"HydroMetParamsTypeId\"=".$_GET['delete_id'];
	pg_query($sql_query);
	header("Location: $_SERVER[PHP_SELF]");
}
// delete condition

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Hydromet Sensor Management</title>
<link rel="stylesheet" href="style.css" type="text/css" />
<script type="text/javascript">
function edt_id(id)
{
	if(confirm('Sure to edit ?'))
	{
		window.location.href='edit_data.php?edit_id='+id;
	}
}
function delete_id(id)
{
	if(confirm('Sure to Delete ?'))
	{
		window.location.href='sensors.php?delete_id='+id;
	}
}
</script>
</head>
<body>
<center>


<?php
include_once 'adminheader.php';
?>
   

<div id="body">
	<div id="content">
    <table align="center">
    <tr>
    <th colspan="5" ><a href="add_data.php" style="float:right">Add New</a></th>
    </tr>
    <th style="background-color:#539CCC;color:white;">Hydromet Sensor Name</th>
    <th style="background-color:#539CCC;color:white">HydroMet Sensor Id</th>
    <th style="background-color:#539CCC;color:white">Description</th>
    <th colspan="2" style="background-color:#539CCC;color:white">Operations</th>
    </tr>
    <?php
	$sql_query="SELECT * FROM tblhydrometparamstype";
	$result_set=pg_query($sql_query);
	if(pg_num_rows($result_set)>0)
	{
        while($row=pg_fetch_row($result_set))
		{
		?>
            <tr>
            <td><?php echo $row[0]; ?></td>
            <td><?php echo $row[1]; ?></td>
            <td><?php echo $row[2]; ?></td>
            <td align="center"><a href="javascript:edt_id('<?php echo $row[1]; ?>')"><img src="b_edit.png" align="EDIT" /></a></td>
            <td align="center"><a href="javascript:delete_id('<?php echo $row[1]; ?>')"><img src="b_drop.png" align="DELETE" /></a></td>
            </tr>
        <?php
		}
	}
	else
	{
		?>
        <tr>
        <td colspan="5">No Data Found !</td>
        </tr>
        <?php
	}
	?>
    </table>
    </div>
</div>
<?php
include_once 'footer.php';

?>
</center>
</body>
</html>