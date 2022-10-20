	<?php
								include("includes/link.php");
						       include_once 'database.php';
								include("includes/adminheader.php");
							?>
							<script  src="js/jquery.js"></script>

<style type="text/css">
	td
	{
		padding: 5px;
	}
</style>
<body>
 <center>
 <br><br>
  <div class="panel panel-primary" style="width:95%"  >
         <div class="panel-heading" style="background-color:#4A7BDF;color:white"><b style="font-size:15px;">Add Company</b></div>
  <div class="panel-body">

  <?php
  $row_edit;
  if(isset($_GET["edt_id"]))
  {
  $edt_id =$_GET["edt_id"];

  $result=pg_query(" SELECT \"Name\", \"phone_no\", \"email\", \"address\"
  FROM \"tblCompany\" where \"Name\"='$edt_id' ");
  //Inserts data into table "tblCompany"
  $row_edit=pg_fetch_array($result);
 //fetches result of $result into array

  }
  ?>
	<form action="companydb.php" method="post">
    <!-- sends data into the "companydb.php" by method POST -->
		<table style="width: 90%">
			<tr>
			<td><label>Name</label> </td>
						<td><input type="text" placeholder="Name" name="company_name" class="form-control" value="<?php if(isset( $row_edit[0])) { echo  $row_edit[0]; }; ?>" required> </td>
            <!-- fetchs result of the array $row_edit first element -->

			
			<td><label>Phone No</label> </td>
						<td><input type="number" placeholder="Phone no" name="company_phone_no" class="form-control"  value="<?php if(isset( $row_edit[1])) { echo  $row_edit[1]; }  ?>" required> </td>
            <!-- fetchs result of the array $row_edit second element -->
			</tr>
			<tr>
			<td><label>Email</label> </td>
						<td><input type="email" placeholder="Email" name="company_email" class="form-control"  value="<?php if(isset( $row_edit[2])) { echo  $row_edit[2]; }  ?>" required> </td>
            <!-- fetchs result of the array $row_edit third element -->
			
			<td>
			<label>Address</label> </td>
						<td><textarea name="company_address" placeholder="Address" class="form-control" ><?php if(isset( $row_edit[3])) { echo  trim($row_edit[3]); }  ?></textarea></td>
            <!-- fetchs result of the array $row_edit fourth element -->

			</tr>
		</table>


<br>
<h4><b>Select Stations for Company</b></h4>
<div style="max-height: 400px;overflow: auto;">
   <table  id="myTable" style="width:90%" class="table table-responsive table-hover">
<tr>
    <th  style="background-color:#539CCC;color:white;">Select</th>

        <th onclick="sortTable(0);" style="background-color:#539CCC;color:white;">Station Name</th>

    <th onclick="sortTable(1);"  style="background-color:#539CCC;color:white;">Station Type</th>
     


    </tr>
    <?php


	$sql_query="SELECT \"StationType\" FROM \"tblStationType\"";
  //different station type is taken from the table tblStationType

    $tables=pg_query($sql_query);

 

	if(pg_num_rows($tables)>0)
    //if the number of rows of the result in variable $result_val > 0
	{

        while($rowtable=pg_fetch_row($tables))
          //while $tables is fetched into a array to $rowtable
		{
        $tblname=str_replace(" ", "_",$rowtable[0]);
        //replace " " with "_" in $row_types and sent to $table
        try
        {


  $result_set=pg_query("select \"Station_Full_Name\",\"Station_Shef_Code\" FROM \"".$tblname."\"");
    //we select "Station_shef_code" from table stationtype with matching the condition

            while($row=pg_fetch_row($result_set))
              //while $result_set is fetched into a array to $row
    {
		?>
            <tr>
            <td>
        <center>    <input type="checkbox" name="station_list[]" value="<?php echo $row[1]; ?>"
<?php 
 if(isset($_GET["edt_id"]))
  //if edt_id is set
  {
  $edt_id =$_GET["edt_id"];
  //the data is set to variable $edt_id

  $result=pg_query("SELECT  \"Station\" FROM \"tblCompany2Station\" where \"Company\"='$edt_id' ");
  //station names are selectetd from the "tblStationLocation" with matching conditionto Company

  while($row_edit=pg_fetch_array($result))
    //while $result is fetched into a array to $row_edit

  {
  	if (trim($row_edit[0])==trim($row[1])) {
echo "checked";
  	}
  }
  }
?>

        ></center></td>
            <td><?php echo $row[0]; ?></td>
            <td><?php echo $rowtable[0]; ?></td>
      
            </tr>
        <?php

		}
}catch(Exception $e)
        {
          
        }

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
		<br>
		<input type="submit" name="submit" class="btn btn-primary"/>
		<input type="button" id="cancel" class="btn btn-danger" value="Cancel">
	</form>
</div>
</div>
</center>
</body>

<script type="text/javascript">
	$(document).ready(function(){ 
$("#cancel").click(function() {
	window.open("/HydrometV2/Company.php","_SELF");
} );
	} );

</script>