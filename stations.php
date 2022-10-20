
<!DOCTYPE php>

<head>
							<?php
								include("includes/link.php");
               
							?>
              <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
                <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.4/sweetalert2.css">
                <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.4/sweetalert2.min.css">
                 <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

              <script type="text/javascript" 
                src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.4/sweetalert2.js">

              </script>
              <script type="text/javascript" 
                src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.4/sweetalert2.min.js">
                
              </script>
             
            <script>
function Openm()
{
  $("#btnModel").click();
}
</script>
            
 

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
if (isset($_GET['check']))
 {


echo "<script type='text/javascript'>
$(document).ready(function(){
$('#myModal').modal('show');
});
</script>";

echo "<script>


   


alert('Station details saved successfully!');

 </script>";

}
if(isset($_GET['delete_id']))
{
  $id=$_GET['delete_id'];
	$sql_query="DELETE FROM \"tblStationType\" WHERE \"StationType\"='$id'";
	pg_query($sql_query);
   $dtable=str_replace(' ', '_',$id);
    $sql_query="drop table \"$dtable\"";
  pg_query($sql_query);
  $sql_query="DELETE FROM \"DefineStations\" WHERE \"StationTypeName\"='$id'";
  pg_query($sql_query);
	//header("Location: $_SERVER[PHP_SELF]");
}


if(isset($_GET['station_stntype'])&&isset($_GET['station_stn']))
{
  $stnname=$_GET['station_stn'];
  $stntype=$_GET['station_stntype'];
  $stntypetable=str_replace(' ', '_',$stntype);
  $sql_query="DELETE FROM \"".$stntypetable."\" WHERE \"Station_Full_Name\"='$stnname'";
  pg_query($sql_query);
  $stn_table=str_replace(" ", "_",$stnname );
 pg_query("drop table if exists $stn_table");

 pg_query("DELETE FROM \"SensorValues\" WHERE \"StationFullName\"='$stnname' and \"StationTypeName\"='$stntype'");
  //header("Location: stations.php#stationtypes");
}

?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script> 
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js" type="text/javascript"></script> 
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstra.css">

 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous" />
<link rel="stylesheet" href="styles.css" type="text/css" />
<style type="text/css">
  
  *{
    font-family: arial;
  }
</style>
<script type="text/javascript">
$(document).ready(function() {

    if (location.hash) {
        $("a[href='" + location.hash + "']").tab("show");
    }
    $(document.body).on("click", "a[data-toggle]", function(event) {
        location.hash = this.getAttribute("href");
         //alert("ok");
    });
});
$(window).on("popstate", function() {
    var anchor = location.hash || $("a[data-toggle='tab']").first().attr("href");
    $("a[href='" + anchor + "']").tab("show");
});

function edt_id(id)
{

		window.location.href='\\HydrometV2\\Station\\demo\\newStationstep1.php?stntype='+id;
	
}
function delete_id(id)
{
	if(confirm('Do you want to delete?'))
	{

		window.location.href='stations.php?delete_id='+id;
	}
}
function station_edt_id(stntype,stn)
{
  window.location.href='\\HydrometV2\\Station\\demo\\addnewstep1.php?stntypename='+stntype+'&station_full_name='+stn;

}

function station_delete_id(stntype,stn)
{
 // alert(stntype);
  //alert(stn);
if(confirm('Do you want to delete?'))
  {
window.location.href='stations.php?station_stntype='+stntype+'&station_stn='+stn;
}
}
function definestation()
{
  window.location.href='\\HydrometV2\\Station\\demo\\newStationstep1.php?addnew="addnew"';


}


function addstation()
{
  window.location.href="\\HydrometV2\\Station\\demo\\addnewstep1.php?addstation='addstation'";

}
</script>
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
function search2() {

  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput2");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable2");
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

function search3() {

  var input, filter, table, tr, td, i;
  input = document.getElementById("myInput3");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable2");
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
}

</script>
<script>
function sortTable(n) {

  var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
  table = document.getElementById("myTable2");

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


function sortTable2(n) {

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
<br><br>
<div class="container">
  
  <!-- Trigger the modal with a button -->
  

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog" style="margin-top: 15%;">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        
     
       <center><h4>Station details saved successfully!</h4></center>   
     
        <div class="modal-footer">
        <center>
                    <button type="button" class="btn btn-success" data-dismiss="modal">OK</button>

        </center>
        </div>
      </div>
      
    </div>
  </div>
  
</div>
<div class="container">

  <ul class="nav nav-tabs" id="myTab">
    <li class="active"><a data-toggle="tab" href="#home"><b>Station Types</b></a></li>
    <li><a data-toggle="tab" href="#stationtypes"><b>Stations</b></a></li>
  
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
<br> <center>
  <div class="panel panel-primary" style="width:100%"  >
         <div class="panel-heading" style="background-color:#4A7BDF;color:white"><b style="font-size:15px;">List of Station Types</b></div>
  <div class="panel-body">

<div id="body">
  <div id="content">
  <div style="max-height: 100%;overflow-y: scroll;">
    <table align="center" id="myTable" style="width:90%" class="table table-bordered table-hover table-responsive">
    <tr>
   
       <th>   <input type="text" id="myInput" onkeyup="search()" placeholder="Search Station Type">
    </th>
    <th colspan="2" ><button style="float:right;" class="btn btn-primary" onClick="definestation()" >Add Station Type</button></th>
    </tr>
    <tr>
    <th onclick="sortTable2(0);" style="background-color:#539CCC;color:white;text-align:center">Station Type</th>
     
    <th colspan="2" style="background-color:#539CCC;color:white;text-align:center">Actions</th>


    </tr>
    <?php
  $sql_query="SELECT \"StationType\" FROM \"tblStationType\"";
  $result_set=pg_query($sql_query);
  if(pg_num_rows($result_set)>0)
  {
        while($row=pg_fetch_row($result_set))
    {
    ?>
            <tr>
            <td><?php echo $row[0]; ?></td>
           <center>
            <td style="width:50px;text-align: center;"><a data-toggle="tooltip" title="Edit!" href="javascript:edt_id('<?php echo $row[0]; ?>')"><img src="b_edit.png" align="EDIT" /></a></td>
            <td  style="width:50px;text-align: center;"><a data-toggle="tooltip" title="Delete!" href="javascript:delete_id('<?php echo $row[0]; ?>')"><img src="b_drop.png" align="DELETE" /></a></td>
        </center>
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

    </div>

</div>






       </div>
    <div id="stationtypes" class="tab-pane fade">
      
   
<br> <center>
  <div class="panel panel-primary" style="width:100%"  >
         <div class="panel-heading" style="background-color:#4A7BDF;color:white"><b style="font-size:15px;">List of Stations</b></div>
  <div class="panel-body">

<div id="body">
	<div id="content">
  <div style="max-height: 100%;overflow-y: scroll;">
    <table align="center" border="2" id="myTable2" style="width:90%" class="table table-bordered table-hover table-responsive">
    <tr>
       <th>   <input type="text" id="myInput2" onkeyup="search2()" placeholder="Search Station">
    </th>
       <th>   <input type="text" id="myInput3" onkeyup="search3()" placeholder="Search Station Type">
    </th>
    <th colspan="3" ><button style="float:right;" class="btn btn-primary" onClick="addstation()" >Add Station</button></th>
    </tr>
    <tr>
        <th onclick="sortTable(0);" style="background-color:#539CCC;color:white;text-align:center">Station Name</th>

    <th onclick="sortTable(1);"  style="background-color:#539CCC;color:white;text-align:center">Station Type</th>
     
    <th colspan="2" style="background-color:#539CCC;color:white;text-align:center">Action</th>


    </tr>
    <?php


	$sql_query="SELECT \"StationType\" FROM \"tblStationType\"";
    $tables=pg_query($sql_query);



	if(pg_num_rows($tables)>0)
	{

        while($rowtable=pg_fetch_row($tables))
		{
        $tblname=str_replace(" ", "_",$rowtable[0]);
        try
        {


  $result_set=pg_query("select \"Station_Full_Name\" FROM \"".$tblname."\"");

            while($row=pg_fetch_row($result_set))
    {
		?>
            <tr>
            <td><?php echo $row[0]; ?></td>
            <td><?php echo $rowtable[0]; ?></td>
           <center>
            <td align="center" style="width:55px"><a data-toggle="tooltip" title="Edit!" href="javascript:station_edt_id('<?php echo $rowtable[0]; ?>','<?php echo $row[0]; ?>')"><img src="b_edit.png" align="EDIT" /></a></td>
            <td align="center" style="width:55px"><a data-toggle="tooltip" title="Delete!" href="javascript:station_delete_id('<?php echo $rowtable[0]; ?>','<?php echo $row[0]; ?>')"><img src="b_drop.png" align="DELETE" /></a></td>
        </center>
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
    </table></div>
    </div>



  </div>
  </div>
  </div>
   </div>
 </div>
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	 
	
	</div>
	</div>
	</div>
	</div>
	</div>
	
	
	<div id="dialog-message" title="Process failed.">
<p><span class="ui-icon ui-icon-circle-check"
    style="float: left; margin: 0 7px 50px 0;"></span> </p>
</div>

							<?php
							//	include("includes/footer.php");
							?>
							<?php
							//	include("includes/link2.php");
							?>
</body>
</html>