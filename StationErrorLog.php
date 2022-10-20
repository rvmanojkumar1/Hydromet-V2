
<!DOCTYPE php>

<head>
							<?php
								include("includes/link.php");
							?>
</head>

<body class="cnt-home">  
							<?php
								include("includes/adminheader.php");
							?>
   	
	<div class="body-content outer-top-xs" id="top-banner-and-menu">
  <div class="container-fluid">
    <div class="row"> 

     <div class="col-xs-12 col-sm-12 col-md-12 sidebar"> 
	 <div style="height:100%">

	 
	 
	 <?php

include_once 'database.php';

// delete condition
if(isset($_GET['delete_id']))
{
  $deleteid=$_GET['delete_id'];
	$sql_query="DELETE FROM \"tblStationErrror\" WHERE \"Station_Shef_Code\"='$deleteid'";
	pg_query($sql_query);

}

?>


<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Station Error Log</title>
<style type="text/css">
  
  *{
    font-family: arial;
  }
</style>


<script>
function search() {

  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    } 
  }
}
</script>
<script>
function sortTable(n) {

  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("myTable");

  switching = true;
  //Set the sorting direction to ascending:
  dir = "asc"; 
  /*Make a loop that will continue until
  no switching has been done:*/
  while (switching) {

    //start by saying: no switching is done:
    switching = false;
    rows = table.getElementsByTagName("tr");

    /*Loop through all table rows (except the
    first, which contains table headers):*/
    for (i = 2; i < (rows.length - 1); i++) {

      //start by saying there should be no switching:
      shouldSwitch = false;
      /*Get the two elements you want to compare,
      one from current row and one from the next:*/
      x = rows[i].getElementsByTagName("td")[n];
      y = rows[i + 1].getElementsByTagName("td")[n];
    
      /*check if the two rows should switch place,
      based on the direction, asc or desc:*/
      if (dir == "asc") {
        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      } else if (dir == "desc") {
        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
          //if so, mark as a switch and break the loop:
          shouldSwitch= true;
          break;
        }
      }
    }
    if (shouldSwitch) {
      /*If a switch has been marked, make the switch
      and mark that a switch has been done:*/
      rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
      switching = true;
      //Each time a switch is done, increase this count by 1:
      switchcount ++; 
    } else {
      /*If no switching has been done AND the direction is "asc",
      set the direction to "desc" and run the while loop again.*/
      if (switchcount == 0 && dir == "asc") {
        dir = "desc";
        switching = true;
      }
    }
  }
}
</script>
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>

<script type="text/javascript">
  
function add(id)
{
   window.location.href='/HydrometV2/Station/demo/addnewstep1.php?addstationError='+id;

}
function delete_id(id)
{
  if(confirm('Do you want to delete?'))
  {
    window.location.href='StationErrorLog.php?delete_id='+id;
  }
}
</script>
</head>
<br>
<center>


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script> 
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js" type="text/javascript"></script> 

 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstap.css">

 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous" />
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="styles.css" type="text/css" />
  <br> 
  <div class="panel panel-primary" style="width:90%"  >
         <div class="panel-heading" style="background-color:#4A7BDF;color:white"><b style="font-size:15px;">List of Stations</b></div>
  <div class="panel-body">
<div id="body">
	<div id="content">
  <div style="max-height: 100%;overflow-y: scroll;">
    <table align="center" border="2" id="myTable" class="w3-table-all">
    <tr>
     <th>
     <input type="text" id="myInput" onkeyup="search()" placeholder="Search Station">
    </th>
    </tr>
       <tr>
    <th onclick="sortTable(0)" style="background-color:#539CCC;color:white;text-align: center;">Station Name</th>
  
    <th colspan="2" style="background-color:#539CCC;color:white;text-align: center;">Actions</th>
    </tr>
    <?php
      $sql_query="SELECT * FROM \"tblStationErrror\"";
  $result_set=pg_query($sql_query);
  if(pg_num_rows($result_set)>0)
  {


        while($row=pg_fetch_row($result_set))
    {
      deleteStn(trim($row[0]));
    }
  }
	$sql_query="SELECT * FROM \"tblStationErrror\"";
	$result_set=pg_query($sql_query);
	if(pg_num_rows($result_set)>0)
	{


        while($row=pg_fetch_row($result_set))
		{
		?>
            <tr>
            
            <td ><?php echo $row[0]; ?></td>
           
          
            <td  style="width: 50px"><a data-toggle="tooltip" title="Add Station!" href="javascript:add('<?php echo $row[0]; ?>')"><img src="add_icon.png" align="add" /></a></td>
            <td  style="width: 50px"><a data-toggle="tooltip" title="Delete!" href="javascript:delete_id('<?php echo $row[0]; ?>')"><img src="b_drop.png" align="DELETE" /></a></td>
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
    </table></div>
    </div>
</div>

</center>

  </div>
</div>
</div>

	 
	 
	 
	 
	 
	
	</div>
	</div>
	</div>
	</div>
	</div>
	
	
	

							<?php
								//include("includes/footer.php");
							?>
							
</body>
</html>
<?php 

function deleteStn($shef)
{


  $sql_query="SELECT \"StationType\" FROM \"tblStationType\"";
    $tables=pg_query($sql_query);



  if(pg_num_rows($tables)>0)
  {

        while($rowtable=pg_fetch_row($tables))
    {
        $tblname=str_replace(" ", "_",$rowtable[0]);

          $result_set=pg_query("select \"Station_Full_Name\" FROM \"".$tblname."\" WHERE \"Station_Shef_Code\"='$shef'");
if (pg_num_rows($result_set)>0) 
{
    $sql_query="DELETE FROM \"tblStationErrror\" WHERE \"Station_Shef_Code\"='$shef'";
  pg_query($sql_query);
}
       
    
      }
 }

}

?>