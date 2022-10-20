
	<?php
								include("includes/link.php");
							?>

							<?php
								include("includes/adminheader.php");
							?>
<?php
include_once 'database.php';
?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script> 
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js" type="text/javascript"></script> 
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous" />
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="styles.css" type="text/css" />

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

  function GoBack()
    {
     history.go(-1);
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
<br>
<br>
 <div class="panel panel-primary" style="width:90%;margin-left:75px;"  >
             <?php
    if (isset($_GET['view_id'])) {
    	$id=$_GET['view_id'];
   
     $sql_query="SELECT * FROM \"tblAlarm2Sensor\" where \"AlarmType\"='$id'";
  $result_set=pg_query($sql_query);
  if(pg_num_rows($result_set)>0)
  {
        $row=pg_fetch_array($result_set)
    
    ?>      
  <div class="panel-heading" style="background-color:#4A7BDF;color:white;text-align:center;">
    <b style="font-size:15px;"> Alarm Details</b>
 <!--<a href="alarm.php" style="float:right;line-height:25px;color:#333; border:2px solid #ccc; border-radius:2px; text-decoration:none;padding:3px; font-size:18px;color:#ccc;"><b> X </b></a>-->

           </div>

  <div class="panel-body">
<div id="body">
  <div id="content">
       <table  style="margin-bottom:15px;width: 100%" class="w3-table-all">
<tr>     <th  style="font-size:14px">Alarm Name :</th>
  <td >  <?php echo $id; ?>
 </td>
 <th style="font-size:14px">Station name :</th> <td  style="font-size:14px"><?php echo $row['Station_Full_Name']; ?></td>
 <th style="font-size:14px">Type :</th> <td style="font-size:14px"><?php echo $row['Type']; ?></td>
     <th style="font-size:14px">Time :</th> <td style="font-size:14px"><?php if ($row['Time']=="") {
     echo "0";
     } else {echo $row['Time'];} ?></td>
    </tr>
             
           <tr ><th style="font-size:14px">Minimum Value :</th> <td style="font-size:14px"><?php echo $row['MinVal']; ?></td>
            <th style="font-size:14px">Maximum Value :</th> <td style="font-size:14px"><?php echo $row['MaxVal']; ?></td>
           <th style="font-size:14px">Maximum Rate :</th> <td style="font-size:14px"><?php echo $row['RateMax']; ?></td>
            <th style="font-size:14px">Minimum Rate :</th> <td style="font-size:14px"><?php echo $row['RateMin']; ?></td>
           
            </tr>
        
      <!-- Sample start -->
</table>

 <?php  }
  else
  {
    ?>
        <tr>
        <td colspan="5">No Data Found !</td>
        </tr>
        <?php
  } ?>
  <div style="max-height: 100%;overflow-y: scroll;">
      <table align="center" id="myTable"  class="w3-table-all" style="font-size: 14px">
 <tr style="background-color:#4A7BDF;width:99%">     <th  style="color:white;"  >Users
 </th>  
 <th>   <input type="text" id="myInput" onkeyup="search()" placeholder="Search User">
    </th>
    <th colspan="3" style="background-color:#4A7BDF"></th>
   </tr>
   <tr style="color:#4A7BDF;;"> <th onclick="sortTable(0)">Alarm Type</th>
    <th onclick="sortTable(1)">User</th>
    <th colspan="2" >Communication</th>
 </tr>
  <?php
    $sql_query="SELECT * FROM \"tblAlarmType2User\" where \"AlarmType\"='$id'";
    $result_set=pg_query($sql_query);
  if(pg_num_rows($result_set)>0)
  {
        while ($row=pg_fetch_array($result_set))
        {
    ?>      <tr>
            <td><?php echo $row['AlarmType']; ?></td>
            <td><?php echo $row['Username']; ?></td>
            <td colspan="2"><?php echo $row['communicationway']; ?></td>
           </tr>
        <?php
    }
  }
  else
  {
    ?>
        <tr>
        <td colspan="3">No Data Found !</td>
        </tr> 
        <?php
  } 
} 
  ?>
    </table>
    </div>
    </div>
</div>
    </div>
</div>
  </div>
  </div>
  </div>
   <div align="center">
                  <center>
                    <input type="button" class="btn btn-default" value="Close" onclick="GoBack()"> </button>
                  </center>

                </div>
				<br>

<?php
?>