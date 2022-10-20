
								<?php
								include("includes/link.php");
							?>
   	
<?php
								include("includes/adminheader.php");
							?>
<?php
include_once 'database.php';
if(isset($_GET['edit_id']))
{
	$sql_query="SELECT * FROM \"tblHydrometSensor\" WHERE \"Id\"=".$_GET['edit_id'];
	$result_set=pg_query($sql_query);
	$fetched_row=pg_fetch_array($result_set);
}
if(isset($_POST['update']))
{
	// variables for input data
	$SensorName = $_POST['SensorName'];
	$id = '';//$_POST['id'];

	$Desc = $_POST['Desc'];
	// variables for input data
	
	// sql query for update data into database
	$sql_query = "UPDATE \"tblHydrometSensor\" SET \"SensorName\"='$SensorName',\"Description\"='$Desc' WHERE \"Id\"=".$_POST['editId'];
	// sql query for update data into database
	
	// sql query execution function
	if(pg_query($sql_query))
	{
	
	echo "<script>alert('Sensor has been updated Successfully!');window.location.href='sensors.php';
</script>";
  }
		


	else
	{
		?>
		<script type="text/javascript">
		alert('Error occured while Updating Sensor');
		</script>
		<?php
		
	}
	// sql query execution function
  }

?>

<script>
function cancel1()
{	
var r = confirm("Do you want to cancel?");
if (r == true) {
			window.location.href='sensors.php';
}


}


var YOUR_MESSAGE_STRING_CONST = "Your confirm message?";
      $('#btnDelete').on('click', function(e){
    		confirmDialog(YOUR_MESSAGE_STRING_CONST, function(){
    			//My code to delete
    		});
    	});

        function confirmDialog(message, onConfirm){
    	    var fClose = function(){
    			modal.modal("hide");
    	    };
    	    var modal = $("#confirmModal");
    	    modal.modal("show");
    	    $("#confirmMessage").empty().append(message);
    	    $("#confirmOk").one('click', onConfirm);
    	    $("#confirmOk").one('click', fClose);
    	    $("#confirmCancel").one("click", fClose);
        }
</script>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Hydromet Sensor Management</title>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script> 
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js" type="text/javascript"></script> 
<link rel="stylesheet" type="text/css" href="~/Content/bootstrap.min.css" media="screen" />
    <script src="~/Scripts/jquery-1.10.2.min.js" type="text/javascript"></script>
    <script src="~/Scripts/bootstrap.js" type="text/javascript"></script>
    <script src="~/Scripts/bootbox.js" type="text/javascript"></script>

    <script src="~/Scripts/digimango.messagebox.js" type="text/javascript"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"/>

 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous" />
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>
<body>
<center>
  <br> 
  <div class="panel panel-primary" style="width:90%"  >
         <div class="panel-heading" style="background-color:#4A7BDF;color:white"><b style="font-size:20px">Edit Sensors</b></div>
  <div class="panel-body">
<div id="body">
	<div id="content">
    <form method="post">
    <table align="center" style="margin: 0 auto;width: 300px" class="w3-table-all">
    <tr>
    <td><input type="text" pattern="[a-zA-Z0-9\s]+" name="SensorName" class="form-control" placeholder="Sensor Name" value="<?php echo $fetched_row['SensorName']; ?>" required /></td>
   
   </tr>
  
   <!-- <tr>
    <td><input type="number" name="id" class="form-control" placeholder="id" value="<?php //echo $fetched_row['id']; ?>" required /></td>
    </tr>-->
    <tr>
    <td><input type="text" class="form-control" name="Desc" placeholder="Description" value="<?php if(isset($fetched_row['Description'])) echo $fetched_row['Description']; ?>" /></td>
    </tr>
    <tr>
    <td>
    <input type="hidden" name="editId" value="<?php if(isset($_GET['edit_id']))
{ echo $_GET['edit_id'];} ?>">
        <input type="hidden" name="update" value="update">

	<button type="submit" class="btn btn-primary" data-toggle="modal" id="btnalert" name="update"><strong>UPDATE</strong></button>
  
        <button type="button" onClick="cancel1()" class="btn btn-danger" id="btnDelete" name="cancel" formnovalidate><strong>Cancel</strong></button>
    </td>
    </tr>
    </table>
    </form>
    </div>
</div>
</div>
</div>
</div>
</center>

<div class="container">
  
  <!-- Trigger the modal with a button -->
  

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog" style="margin:12%;">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title" style="color:red; text-align:center;">Alert</h4>
        </div>
        <div class="modal-body">
          <p style="color:green;">Record Updated</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  
</div>

<!-- confirm modal -->
<!-- Modal dialog -->
	
    <!-- Modal confirm -->
	<div class="modal" id="confirmModal" style="display: none; z-index: 1050;">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body" id="confirmMessage">
				<P>Do you want to cancel?</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" id="confirmOk">Ok</button>
		        	<button type="button" class="btn btn-default" id="confirmCancel">Cancel</button>
		        </div>
			</div>
		</div>
	</div>
</body>
</html>