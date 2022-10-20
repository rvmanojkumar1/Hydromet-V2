<?php
include_once 'database.php';
include_once 'adminheader.php';
session_start();
 
 if (isset($_SESSION["StationType"])&&isset($_GET['edit_id'])) {
 $erow="";

    $stnname= $_SESSION["StationType"];
    $eid=$_GET['edit_id'];
  $sql_query="SELECT \"StationField\",\"FieldType\",\"ComboxValues\" FROM \"DefineStations\" where \"StationTypeName\"='$stnname' and \"StationField\"='$eid'";
  $result_set=pg_query($sql_query);
$erow=pg_fetch_array($result_set) ;


}
 



if (isset($_GET['stntype']))
 {
  $tblname=$_GET['stntype'];
  $tblname=str_replace(" ", "_",$tblname);
  pg_query("create table if not exists \"$tblname\"(\"Station_Full_Name\" text)");
  $sql_query="SELECT * FROM \"DefineStations\" where \"StationTypeName\"='$tblname' and \"StationField\"='Station Full Name'";
  $result_set=pg_query($sql_query);
  if(pg_num_rows($result_set)==0)
  {
  
    pg_query("insert into \"DefineStations\"(\"StationTypeName\",\"StationField\",\"FieldType\") values('$tblname','Statation Full Name','Text')");


}
pg_query("insert into \"tblStationType\"(\"StationType\") values('$tblname')");
$_SESSION["StationType"] = $tblname;
//= $tblname;
  
}
if(isset($_GET['delete_id']))
{
  $StationType= $_SESSION['StationType'];
  $id= $_GET['delete_id'];
  $sql_query="DELETE FROM \"DefineStations\" WHERE \"StationTypeName\"='$StationType' and \"StationField\"='$id'";
  pg_query($sql_query);

  //header("Location: $_SERVER[PHP_SELF]");
}
if (isset($_GET['fieldname']))
 {
$StationType= $_SESSION["StationType"];
 $fieldname=  $_GET['fieldname'];
 $fieldtype=  $_GET['fieldtype'];

$sql_query="SELECT * FROM \"DefineStations\" where \"StationTypeName\"='$StationType' and \"StationField\"='$fieldname'";
  $result_set=pg_query($sql_query);
  if(pg_num_rows($result_set)==0)
  {
  

 if (isset($_GET['comboboxvalues'])) {
   $comboboxvalues= $_GET['comboboxvalues'];
    pg_query("insert into \"DefineStations\"(\"StationTypeName\",\"StationField\",\"FieldType\",\"ComboxValues\") values('$StationType','$fieldname','$fieldtype','$comboboxvalues')");

 }
 else{
  pg_query("insert into \"DefineStations\"(\"StationTypeName\",\"StationField\",\"FieldType\") values('$StationType','$fieldname','$fieldtype')");
 }
}
}
?>


<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script> 
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js" type="text/javascript"></script> 

<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.css">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous" />
 



<link rel="stylesheet" href="style.css" type="text/css" />
<script type="text/javascript">

function edt_id(id)
{
  
  window.location.href='definestation.php?edit_id='+id;

  
}

function delete_id(id)
{
  if(confirm('Do you want to delete?'))
  {
    window.location.href='definestation.php?delete_id='+id;
  }
}
</script>

<script type="text/javascript">
 document.write(<?php if($erow['FieldType']=='Single-Select'||$erow['FieldType']=='Multi-Select') ?>) 
{

        document.getElementById("conboboxplaceholder").innerHTML="<label>values</label><textarea placeholder='values' name='comboboxvalues' class='form-control' />"; 
       } else
       {
         document.getElementById("conboboxplaceholder").innerHTML="";
       }
 function GetSelectedTextValue(filedtype) {
       // var selectedText = filedtype.options[filedtype.selectedIndex].innerHTML;
        var selectedValue = filedtype.value;
       

//document.getElementById("conboboxplaceholder").innerHTML="<textarea name="comboboxvalues" />";
if (selectedValue=="Single-Select"||selectedValue=="Multi-Select") {
        document.getElementById("conboboxplaceholder").innerHTML="<label>values</label><textarea placeholder='values' name='comboboxvalues' class='form-control' />"; 
       }
       else
       {
         document.getElementById("conboboxplaceholder").innerHTML="";
       }
    }
function next()
{
    document.getElementById("two").style.visibility = "visible";
 document.getElementById("one").style.visibility = "visible";
 document.getElementById("stn").style.visibility = "hidden";
// window.location.href='definestations.php?station_name='+stn_name;

}
function cancel()
{

 window.location.href = 'stations.php';
  //header("Location: stations.php");
}
</script>
 <br> <center>
  <div class="panel panel-primary" style="width:90%"  >
         <div class="panel-heading" style="background-color:#4A7BDF;color:white"><b style="font-size:20px">Edit Station Type</b></div>
  <div class="panel-body">

<div class="col-sm-12" id="stn">
                  <div class="content">
                                         <div class="alert alert-info" style="font-family:Arial;">
  Please Enter Station Type
</div>
</div>
  <div class="col-sm-4"></div>
  <div class="col-sm-4">
<label>Station Type Name</label>
<form action="definestation.php">
<input type="text" name="stntype" placeholder="Station Type Name" value="<?php echo $_SESSION['StationType'] ?>" class="form-control"/> 
<br>
<button class="btn btn-primary" type="submit" onClick="next()">Next</button>
</form>
</div>
</div>


<div class="col-sm-12">
    <center>
      <br>
    
              <div class="content">
                                         <div class="alert alert-info" style="font-family:Arial;">
 Define Station Type Field
</div>
                                     <div>
                                     <div>
        <div class="col-sm-4"></div>
    <div class="col-sm-4" id="one" >
      <form>
    <label>Field Name</label>
    <input type="text" name="fieldname" class="form-control" placeholder="Field Name" value="<?php if(isset($erow['FieldType'])) echo $erow['StationField'];?>" Required  oninvalid="this.setCustomValidity('Please Enter Filed Name!')" oninput="setCustomValidity('')" >
        <label>Field Type</label>
    
  <select name="fieldtype" id="fieldtype1" class="dropdown form-control" style="height:30px" onchange="GetSelectedTextValue(this)" Required  oninvalid="this.setCustomValidity('Please Select Type!')" oninput="setCustomValidity('')">
     <option value="" disabled selected>Select your option</option>
<option value="Text" <?php if($erow['FieldType']=='Text') echo 'selected';?>>Text</option>
<option value="Number" <?php if($erow['FieldType']=='Number') echo 'selected'; ?>>Number</option>
<option value="Single-Select" <?php if($erow['FieldType']=='Single-Select') echo 'selected'; ?>>Single-Select</option>
<option value="Multi-Select" <?php if($erow['FieldType']=='Multi-Select') echo 'selected'; ?>>Multi-Select</option>
  </select>
  <br>
  <p id="conboboxplaceholder"></p>
  <button name="filed" class="btn btn-primary" type="submit">Add</button>
  <button name="cancel" class="btn btn-danger" type="button" onClick="cancel()">Cancel</button>
  <br>
</form>

</div>


  </center>
</div>

<br>
<br>
<div col-sm-12>

  <div id="body">
  <div id="content">
    <div id="two">
    
    <table align="center" style="width:90%;">
    
    <th style="background-color:#539CCC;color:white;">Field Name</th>
    <th style="background-color:#539CCC;color:white">Field Type</th>
    <th style="background-color:#539CCC;color:white">Values</th>
    <th colspan="2" style="background-color:#539CCC;color:white">Operations</th>
    </tr>
    <?php
   if (isset($_SESSION["StationType"])) {
    # code...
 
    $stnname= $_SESSION["StationType"];
  $sql_query="SELECT \"StationField\",\"FieldType\",\"ComboxValues\" FROM \"DefineStations\" where \"StationTypeName\"='$stnname'";
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
            <td align="center"><a href="javascript:edt_id('<?php echo $row[0]; ?>')"><img src="b_edit.png" align="EDIT" /></a></td>
            <td align="center"><a href="javascript:delete_id('<?php echo $row[0]; ?>')"><img src="b_drop.png" align="DELETE" /></a></td>
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
      }
  ?>
    </table>


 











    </div>
    </div>
  </div>
  </div>
</div>
</div>
</center>