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
                     include_once'MyAlert.php';
                          if(isset($_GET['Message'])) {
                       myAlert('Alarm has been created successfully!');
                     echo "<script>$(document).ready(function(){
                     $('#myModal').modal('show');
                     });</script>";
                     }
                     if (isset($_GET['Message1'])) {
                     
                      myAlert('Alarm has been updated successfully!');
                     echo "<script>$(document).ready(function(){
                     $('#myModal').modal('show');
                     });</script>";
                     }
                     if(isset($_GET['delete_id']))
                     {
                     
                       $id=$_GET['delete_id'];
                      $sql_query="DELETE FROM \"tblAlarmType\" WHERE \"AlarmType\"='$id'";
                      pg_query($sql_query);
                       $sql_query="DELETE FROM \"tblAlarmType2User\" WHERE \"AlarmName\"='$id'";
                       pg_query($sql_query);
                       $sql_query="DELETE FROM \"tblAlarm2Sensor\" WHERE \"AlarmName\"='$id'";
                       pg_query($sql_query);
                     }
                     
                     
                     
                     
                     ?>
                  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script> 
                  <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js" type="text/javascript"></script> 
                  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
                  <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstra.css">
                  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous" />
                  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous" />
                  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
                  <link rel="stylesheet" href="styles.css" type="text/css" />
                  <style type="text/css">
                     *{
                     font-family: arial;
                     }
                  </style>
                  <script type="text/javascript">
                     function edt_id(id)
                     {
                      
                         window.location.href='Station/demo/AlarmStep1.php?AlarmName='+id;
                       
                     }
                     function delete_id(id)
                     {
                      
                       if(confirm('Do you want to delete?'))
                       {
                     
                         window.location.href='alarm.php?delete_id='+id;
                       }
                     }
                     function definestation()
                     {
                       window.location.href='\\HydrometV2\\Station\\demo\\alarmstep1.php';
                     
                     
                     }
                     function view_id(id)
                     {
                      
                         window.location.href='alarm_view.php?view_id='+id;
                       
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
                  </script>
                  <script>
                     function search2() {
                     
                       var input, filter, table, tr, td, i;
                       input = document.getElementById("myInput2");
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
                  <script>
                     function search3() {
                     
                       var input, filter, table, tr, td, i;
                       input = document.getElementById("myInput3");
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
                     }
                  </script>
                  <script>
                     function search4() {
                     
                       var input, filter, table, tr, td, i;
                       input = document.getElementById("myInput4");
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
                     }
                     function search5() {
                     
                       var input, filter, table, tr, td, i;
                       input = document.getElementById("myInput5");
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
                     }
                     function search6() {
                     
                       var input, filter, table, tr, td, i;
                       input = document.getElementById("myInput6");
                       filter = input.value.toUpperCase();
                       table = document.getElementById("myTable");
                       tr = table.getElementsByTagName("tr");
                     
                       // Loop through all table rows, and hide those who don't match the search query
                       for (i = 0; i < tr.length; i++) {
                         td = tr[i].getElementsByTagName("td")[5];
                         if (td) {
                           if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                             tr[i].style.display = "";
                           } else {
                             tr[i].style.display = "none";
                           }
                         } 
                       }
                     }
                     function search7() {
                     
                       var input, filter, table, tr, td, i;
                       input = document.getElementById("myInput7");
                       filter = input.value.toUpperCase();
                       table = document.getElementById("myTable");
                       tr = table.getElementsByTagName("tr");
                     
                       // Loop through all table rows, and hide those who don't match the search query
                       for (i = 0; i < tr.length; i++) {
                         td = tr[i].getElementsByTagName("td")[6];
                         if (td) {
                           if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                             tr[i].style.display = "";
                           } else {
                             tr[i].style.display = "none";
                           }
                         } 
                       }
                     }
                     function search8() {
                     
                       var input, filter, table, tr, td, i;
                       input = document.getElementById("myInput8");
                       filter = input.value.toUpperCase();
                       table = document.getElementById("myTable");
                       tr = table.getElementsByTagName("tr");
                     
                       // Loop through all table rows, and hide those who don't match the search query
                       for (i = 0; i < tr.length; i++) {
                         td = tr[i].getElementsByTagName("td")[7];
                         if (td) {
                           if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                             tr[i].style.display = "";
                           } else {
                             tr[i].style.display = "none";
                           }
                         } 
                       }
                     }
                     function search9() {
                     
                       var input, filter, table, tr, td, i;
                       input = document.getElementById("myInput9");
                       filter = input.value.toUpperCase();
                       table = document.getElementById("myTable");
                       tr = table.getElementsByTagName("tr");
                     
                       // Loop through all table rows, and hide those who don't match the search query
                       for (i = 0; i < tr.length; i++) {
                         td = tr[i].getElementsByTagName("td")[8];
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
                  <br><br>
                  <center>
                  <div class="panel panel-primary" style="width:95%"  >
                     <div class="panel-heading" style="background-color:#4A7BDF;color:white"><b style="font-size:15px;">List of Alarm</b></div>
                     <div class="panel-body">
                        <div id="body">
                           <div id="content">
                              <div style="/*max-height: 100%;overflow-y: scroll;*/">
                                 <h4>Single Alarms</h4>
                                 <button style="float:right;" class="btn btn-primary" onClick="definestation()" >Add Alarm</button>
                                 <table align="center" id="myTable" style="width:100%" class="table table-responsive table-bordered table-hover">
                                    <!--   <tr>
                                       <th >   <input type="text" id="myInput" onkeyup="search()" placeholder="Search Alarm">
                                         </th>
                                           <th>
                                       <input type="text" id="myInput2" onkeyup="search2()" placeholder="Search Station">
                                        </th>
                                          <th>
                                         <input type="text" id="myInput3" onkeyup="search3()" placeholder="Search Sensor">
                                           </th>
                                             <th>
                                            <input type="text" id="myInput4" onkeyup="search4()" placeholder="Search Type">
                                       </th>
                                             <th>
                                            <input type="text" id="myInput5" onkeyup="search5()" placeholder="Search Change">
                                       </th>
                                             <th>
                                            <input type="text" id="myInput6" onkeyup="search6()" placeholder="Search Value">
                                       </th>
                                             <th>
                                            <input type="text" id="myInput7" onkeyup="search7()" placeholder="Search Time">
                                       </th>
                                             <th>
                                            <input type="text" id="myInput8" onkeyup="search8()" placeholder="Search User">
                                       </th>
                                       <th colspan="3" ><button style="float:right;" class="btn btn-info" onClick="definestation()" >Add Alarm</a></th>
                                       </tr>-->
                                    <th onclick="sortTable(0)" style="background-color:#539CCC;color:white;text-align:center">Alarm Name</th>
                                    <th  onclick="sortTable(1)" style="background-color:#539CCC;color:white;text-align:center">Station</th>
                                    <th onclick="sortTable(2)" style="background-color:#539CCC;color:white;text-align:center">Sensor</th>
                                    <th onclick="sortTable(3)" style="background-color:#539CCC;color:white;text-align:center">Type</th>
                                    <th onclick="sortTable(3)" style="background-color:#539CCC;color:white;text-align:center">change</th>
                                    <th onclick="sortTable(4)" style="background-color:#539CCC;color:white;text-align:center">Value</th>
                                    <th onclick="sortTable(5)" style="background-color:#539CCC;color:white;text-align:center">Span min</th>
                                    <th onclick="sortTable(7)" style="background-color:#539CCC;color:white;text-align:center">Message  </th>
                                    <th onclick="sortTable(8)" style="background-color:#539CCC;color:white;text-align:center">Date Range </th>
                                    <th onclick="sortTable(2)" style="background-color:#539CCC;color:white;text-align:center">Users</th>
                                    <th colspan="2" style="background-color:#539CCC;color:white;text-align:center;">Operations</th>
                                    </tr>
                                    <?php
                                       $sql_query="SELECT \"AlarmName\",\"Station_Full_Name\",\"SensorName\",\"change\",\"Type\",\"Value\",\"Time\",\"AlarmEmail\",\"range\",\"RangeTo\" FROM \"tblAlarm2Sensor\" where \"AlarmType\"='single'";
                                       $result_set=pg_query($sql_query);
                                       if(pg_num_rows($result_set)>0)
                                       {
                                       
                                             while($row=pg_fetch_array($result_set))
                                         {
                                            $users='';
                                           $AlarmName=$row['AlarmName'];
                                       $result_set_user=pg_query("Select \"Username\" FROM \"tblAlarmType2User\" WHERE \"AlarmName\"='$AlarmName'");
                                       if(pg_num_rows($result_set_user)>0)
                                       {
                                              while($row2=pg_fetch_array($result_set_user))
                                         {
                                       $users.=$row2['Username']." , ";
                                         }
                                       }
                                         ?>
                                    <tr>
                                       <td ><?php echo $row['AlarmName']; ?></td>
                                       <td ><?php echo $row['Station_Full_Name']; ?></td>
                                       <td ><?php echo $row['SensorName']; ?></td>
                                       <td ><?php echo $row['Type']; ?></td>
                                       <td ><?php echo $row['change']; ?></td>
                                       <td><?php echo $row['Value']; ?></td>
                                       <td><?php if (trim($row['Time'])!="0") {  echo $row['Time'];} else { echo "";} ?></td>
                                       <td ><?php echo $row['AlarmEmail']; ?></td>
                                       <td ><?php if(trim($row['range'])!="") echo $row['range']." to ". $row['RangeTo']; ?></td>
                                       <td >
                                          <div style="height: 20px;width: 250px;overflow-y: auto;"><?php echo $users; ?></div>
                                       </td>
                                       <center>
                                          <!-- <td align="center" style="width:40px"><a style="margin-bottom: 3px"data-toggle="tooltip" title="View!" href="javascript:view_id('<?php //echo $row['AlarmName']; ?>')"><img  src="b_view.png" align="EDIT" /></a></td>-->
                                          <td align="center" style="width:40px"><a data-toggle="tooltip" title="Edit!" href="javascript:edt_id('<?php echo $row['AlarmName']; ?>')"><img src="b_edit.png" align="EDIT" /></a></td>
                                          <td align="center" style="width:40px"><a data-toggle="tooltip" title="Detete!" href="javascript:delete_id('<?php echo $row['AlarmName']; ?>')"><img src="b_drop.png" align="DELETE" /></a></td>
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
                                 </table>
                                 <h4>Multiple Alarms</h4>
                                 <table class="table table-responsive table-bordered table-hover"  style="width: 100%;">
                                    <thead>
                                       <tr>
                                          <th onclick="sortTable(0)" style="background-color:#539CCC;color:white;text-align:center">Alarm Name</th>
                                          <th onclick="sortTable(1)" style="background-color:#539CCC;color:white;text-align:center">Station</th>
                                          <th onclick="sortTable(2)" style="background-color:#539CCC;color:white;text-align:center">Sensor</th>
                                          <th onclick="sortTable(3)" style="background-color:#539CCC;color:white;text-align:center">Type</th>
                                          <th onclick="sortTable(4)" style="background-color:#539CCC;color:white;text-align:center">Change  </th>
                                          <th onclick="sortTable(5)" style="background-color:#539CCC;color:white;text-align:center">Value  </th>
                                          <th onclick="sortTable(6)" style="background-color:#539CCC;color:white;text-align:center">Span min  </th>
                                          <th onclick="sortTable(7)" style="background-color:#539CCC;color:white;text-align:center">Message</th>
                                          <th onclick="sortTable(8)" style="background-color:#539CCC;color:white;text-align:center">Date Range </th>
                                          <th onclick="sortTable(9)" style="background-color:#539CCC;color:white;text-align:center">Users</th>
                                          <th colspan="2" style="background-color:#539CCC;color:white;text-align:center">Operation </th>
                                       </tr>
                                    </thead>
                                    <?php
                                       $sql_query="SELECT \"AlarmName\",\"Station_Full_Name\",\"SensorName\",\"change\",\"Type\",\"Value\",\"Time\",\"AlarmEmail\",\"range\",\"RangeTo\" FROM \"tblAlarm2Sensor\" where \"AlarmType\"='multiple'";
                                       //echo $sql_query;
                                       $result_set=pg_query($sql_query);
                                       if(pg_num_rows($result_set)>0)
                                       {
                                       $alarm="";
                                       $row_span=1;
                                             while($row=pg_fetch_array($result_set))
                                         {
                                            $users='';
                                           $AlarmName=$row['AlarmName'];
                                       $result_set_user=pg_query("Select \"Username\" FROM \"tblAlarmType2User\" WHERE \"AlarmName\"='$AlarmName'");
                                       if(pg_num_rows($result_set_user)>0)
                                       {
                                              while($row2=pg_fetch_array($result_set_user))
                                         {
                                       $users.=$row2['Username']." , ";
                                         }
                                       }
                                       $span_set= pg_fetch_array(pg_query("select count(\"AlarmName\") from  \"tblAlarm2Sensor\" where \"AlarmType\"='multiple' and \"AlarmName\"='$AlarmName'"));
                                       
                                       $row_span= $span_set[0];
                                       
                                         ?>
                                    <tr>
                                       <?php if ($alarm!=$row['AlarmName']) { ?> 
                                       <td rowspan="<?php echo $row_span; ?>"  style="vertical-align: middle;" ><?php  echo $row['AlarmName']; ?></td>
                                       <?php } ?>
                                       <td ><?php echo $row['Station_Full_Name']; ?></td>
                                       <td ><?php echo $row['SensorName']; ?></td>
                                       <td ><?php echo $row['Type']; ?></td>
                                       <td ><?php echo $row['change']; ?></td>
                                       <td ><?php echo $row['Value']; ?></td>
                                       <td ><?php if (trim($row['Time'])!="0") { echo $row['Time'];
                                          } else { echo "";}  ?></td>
                                       <?php if ($alarm!=$row['AlarmName']) { ?> 
                                       <td style="vertical-align: middle;" rowspan="<?php echo $row_span; ?>" ><?php  echo $row['AlarmEmail']; ?></td>
                                       <?php } ?>
                                       <?php if ($alarm!=$row['AlarmName']) { ?> 
                                       <td style="vertical-align: middle;" rowspan="<?php echo $row_span; ?>" ><?php if(trim($row['range'])!="")  echo $row['range']." to ".$row['RangeTo']; ?></td>
                                       <?php } ?>
                                       <?php if ($alarm!=$row['AlarmName']) { ?> 
                                       <td style="vertical-align: middle;" rowspan="<?php echo $row_span; ?>" >
                                          <div style="max-height: 200px;width: 250px;overflow-y: auto;"><?php echo $users; ?></div>
                                       </td>
                                       <?php } ?>
                                       <?php if ($alarm!=$row['AlarmName']) {  ?>  <!-- <td rowspan="<?php //echo $row_span; ?>" align="center" style="width:40px"><a style="margin-bottom: 3px"data-toggle="tooltip" title="View!" href="javascript:view_id('<?php //echo $row['AlarmName'];?>')"><img  src="b_view.png" align="EDIT" /></a></td>-->
                                       <td style="vertical-align: middle;" rowspan="<?php echo $row_span; ?>" align="center" style="width:40px"><a data-toggle="tooltip" title="Edit!" href="javascript:edt_id('<?php echo $row['AlarmName']; ?>')"><img src="b_edit.png" align="EDIT" /></a></td>
                                       <td style="vertical-align: middle;" rowspan="<?php echo $row_span; ?>" align="center" style="width:40px"><a data-toggle="tooltip" title="Detete!" href="javascript:delete_id('<?php echo $row['AlarmName']; ?>')"><img src="b_drop.png" align="DELETE" /></a></td>
                                       <?php }?>
                                    </tr>
                                    <?php
                                       $alarm=$row['AlarmName'];
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
</body>
</html>