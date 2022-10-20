<?php
include_once('database.php'); 
//include_once database.php";
include_once('adminHeader.php');
session_start();

 if (isset($_SESSION["StationType"])&&isset($_GET['edit_id'])) {
 $erow="";

    $stnname=   $_SESSION["StationType"];
    $eid=$_GET['edit_id'];
    $sql_query="SELECT \"StationField\",\"FieldType\",\"ComboxValues\" FROM \"DefineStations\" where \"StationTypeName\"='$stnname' and \"StationField\"='$eid'";
    $result_set=pg_query($sql_query);
$erow=pg_fetch_array($result_set) ;
$_SESSION["keyfield"]= $erow['StationField'];

}
else
{
  $_SESSION["keyfield"]="";
}

if (isset($_GET['addnew'])=="addnew")
 {
  $_SESSION["StationType"]="";
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
    
        pg_query("insert into \"DefineStations\"(\"StationTypeName\",\"StationField\",\"FieldType\") values('$tblname','Station Full Name','Text')");


}
  $sql_query="SELECT * FROM \"tblStationType\" where \"StationType\"='$tblname'";
  $result_set=pg_query($sql_query);
  if(pg_num_rows($result_set)==0)
  {
pg_query("insert into \"tblStationType\"(\"StationType\") values('$tblname')");
}
$_SESSION["StationType"] = $tblname;
    
}


if(isset($_GET['delete_id']))
{
    $StationType=   $_SESSION['StationType'];
    $id= $_GET['delete_id'];
    $sql_query="DELETE FROM \"DefineStations\" WHERE \"StationTypeName\"='$StationType' and \"StationField\"='$id'";
    pg_query($sql_query);
pg_query("ALTER TABLE \"".str_replace(' ', '_',$StationType)."\" DROP COLUMN \"".str_replace(' ', '_',$id)."\"");
    header("Location: $_SERVER[PHP_SELF]");
}
if (isset($_GET['fieldname']))
 {
$StationType=   $_SESSION["StationType"];
 $fieldname=    $_GET['fieldname'];
 $fieldtype=    $_GET['fieldtype'];

$sql_query="SELECT * FROM \"DefineStations\" where \"StationTypeName\"='$StationType' and \"StationField\"='$fieldname'";
    $result_set=pg_query($sql_query);
    if(pg_num_rows($result_set)==0)
    {
    

 if (isset($_GET['comboboxvalues'])) {
     $comboboxvalues=   $_GET['comboboxvalues'];
    pg_query("insert into \"DefineStations\"(\"StationTypeName\",\"StationField\",\"FieldType\",\"ComboxValues\") values('$StationType','$fieldname','$fieldtype','$comboboxvalues')");
pg_query("alter table \"".str_replace(' ', '_',$StationType)."\"add \"".str_replace(' ', '_',$fieldname)."\" text");
 }
 else{
    pg_query("insert into \"DefineStations\"(\"StationTypeName\",\"StationField\",\"FieldType\") values('$StationType','$fieldname','$fieldtype')");
 pg_query("alter table \"".str_replace(' ', '_',$StationType)."\"add \"".str_replace(' ', '_',$fieldname)."\" text");

 echo "$StationType";
 }
}
else
{
 if (isset($_GET['comboboxvalues'])) 
 {
   $data=$_SESSION["keyfield"];
    $comboboxvalues= $_GET['comboboxvalues'];

   pg_query("update \"DefineStations\" set \"StationField\"='$fieldname',\"FieldType\"='$fieldtype',\"ComboxValues\"='$comboboxvalues' where \"StationTypeName\"='$StationType' and \"StationField\"='$data'");

//pg_query("alter table \"".str_replace(' ', '_',$StationType)."\" RENAME COLUMN \"".str_replace(' ', '_',$data)."\" to \"".str_replace(' ', '_',$fieldname)."\" text");
 }
 else{
  $data=$_SESSION["keyfield"];

   pg_query("update \"DefineStations\" set \"StationField\"='$fieldname',\"FieldType\"='$fieldtype' where \"StationTypeName\"='$StationType' and \"StationField\"='$data'");
  //pg_query("alter table \"".str_replace(' ', '_',$StationType)."\" RENAME COLUMN \"".str_replace(' ', '_',$data)."\" to \"".str_replace(' ', '_',$fieldname)."\" text");

 }
}
}

?>


<!DOCTYPE html>
<html>
<head>

<script type="text/javascript">

function edt_id(id)
{
    
    window.location.href='newStation.php?edit_id='+id;

    
}

function delete_id(id)
{
    if(confirm('Are You Sure You want to delete?'))
    {
        window.location.href='newStation.php?delete_id='+id;
    }
}
</script>

<script type="text/javascript">

 function GetSelectedTextValue(filedtype) {
       // var selectedText = filedtype.options[filedtype.selectedIndex].innerHTML;
        var selectedValue = filedtype.value;
       

//document.getElementById("conboboxplaceholder").innerHTML="<textarea name="comboboxvalues" />";
if (selectedValue=="Single-Select"||selectedValue=="Multi-Select") {
        document.getElementById("conboboxplaceholder").innerHTML="<label>values</label><textarea placeholder='values' name='comboboxvalues' id='comboboxvalues' class='form-control' />"; 
       }
       else
       {
         document.getElementById("conboboxplaceholder").innerHTML="";
       }
    }
function next()
{
    //  document.getElementById("two").style.visibility = "visible";
// document.getElementById("one").style.visibility = "visible";
 //document.getElementById("stn").style.visibility = "hidden";
// window.location.href='definestations.php?station_name='+stn_name;

}
function clear()
{

 document.getElementById("fieldname").value="";
document.getElementById("comboboxvalues").value="";
    var elements = document.getElementById("fieldtype1").options;

    for(var i = 0; i < elements.length; i++){
      elements[i].selected = false;
    }
     
    //header("Location: stations.php");
}
</script>

    <title></title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <!-- Optional Bootstrap theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">

    <!-- Include SmartWizard CSS -->
    <link href="../dist/css/smart_wizard.css" rel="stylesheet" type="text/css" />
    
    <!-- Optional SmartWizard theme -->
    <link href="../dist/css/smart_wizard_theme_circles.css" rel="stylesheet" type="text/css" />
    <link href="../dist/css/smart_wizard_theme_arrows.css" rel="stylesheet" type="text/css" />
    <link href="../dist/css/smart_wizard_theme_dots.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
    <div class="container">
        
        <form class="form-inline">
             <div class="form-group">
              <label >Choose Theme:</label>
              <select id="theme_selector" class="form-control">
                    <option value="default">default</option>
                    <option value="arrows">arrows</option>
                    <option value="circles">circles</option>
                    <option value="dots">dots</option>
              </select>
            </div>           
            
            <label>External Buttons:</label>
            <div class="btn-group navbar-btn" role="group">
                <button class="btn btn-default" id="prev-btn" type="button">Go Previous</button>
                <button class="btn btn-default" id="next-btn" type="button">Go Next</button>
                <button class="btn btn-danger" id="reset-btn" type="button">Reset Wizard</button>
            </div>
        </form>

        <br />
        
        <!-- SmartWizard html -->
        <div id="smartwizard">
            <ul>
                <li><a href="#step-1">Step 1<br /></a></li>
                <li><a href="#step-2">Step 2<br /></a></li>
                <li><a href="#step-3">Step 3<br /></a></li>
                <li><a href="#step-4">Step 4<br /></a></li>
            </ul>
            
            <div>
                <div id="step-1" class="">
                 


<div  id="stn">
      <center>
                      <div class="content">
                                         <div class="alert alert-info" style="font-family:Arial;">
 <p><b> Please Enter Station Type</b></p>
</div>
</div>
    

<label>Station Type Name</label>
<form action="newStation.php">
<input type="text" name="stntype" style="width:300px" placeholder="Station Type Name" value="<?php if (isset($_SESSION['StationType'])) { echo $_SESSION['StationType']; }?>" class="form-control" Required  oninvalid="this.setCustomValidity('Please Enter Station type Name!')" oninput="setCustomValidity('')"/> 
<br>
<button class="btn btn-primary" type="submit" onClick="next()">Next</button>
</form>
<center>
</div>

                       </div>
                <div id="step-2" class="">
                  
                    <div>
                       <div class="col-sm-12">
    <center>
        <br>
    
              <div class="content">
                                         <div class="alert alert-info" style="font-family:Arial;">
 <p><b>Define Station Type Field</b></p>
</div>
                                     <div>
                                     <div>
            <div class="col-sm-4"></div>
    <div class="col-sm-4" id="one" >
        <form>
    <label>Field Name</label>
    <input type="text" name="fieldname" id="fieldname" class="form-control" placeholder="Field Name" value="<?php if(isset($erow['FieldType'])) echo $erow['StationField'];?>" Required  oninvalid="this.setCustomValidity('Please Enter Filed Name!')" oninput="setCustomValidity('')" >
        <label>Field Type</label>
    
  <select name="fieldtype" id="fieldtype1" class="dropdown form-control" style="height:30px" onchange="GetSelectedTextValue(this)" Required  oninvalid="this.setCustomValidity('Please Select Type!')" oninput="setCustomValidity('')">
     <option value="" disabled selected>Select your option</option>
<option value="Text" <?php if(isset($erow['FieldType'])){ if($erow['FieldType']=='Text') echo 'selected';}?>>Text</option>
<option value="Number" <?php if(isset($erow['FieldType'])){ if($erow['FieldType']=='Number') echo 'selected'; }?>>Number</option>
<option value="Single-Select" <?php if(isset($erow['FieldType'])){ if($erow['FieldType']=='Single-Select') echo 'selected';} ?>>Single-Select</option>
<option value="Multi-Select" <?php if(isset($erow['FieldType'])){ if($erow['FieldType']=='Multi-Select') echo 'selected'; }?>>Multi-Select</option>
  </select>
  <br>
  <p id="conboboxplaceholder"></p>
  <button name="filed" class="btn btn-primary" type="submit">Save</button>
  <button name="cancel" class="btn btn-danger" type="link" onClick="clear()" formnovalidate>Clear</button>
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
        <center>
    <table align="center" style="width:90%;">
    
    <th style="background-color:#539CCC;color:white;">Field Name</th>
    <th style="background-color:#539CCC;color:white">Field Type</th>
    <th style="background-color:#539CCC;color:white">Values</th>
    <th colspan="2" style="background-color:#539CCC;color:white">Operations</th>
    </tr>
    <?php
   if (isset($_SESSION["StationType"])) {
    # code...
 
    $stnname=   $_SESSION["StationType"];
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

</center>












    </div>
    </div>
  </div>
  </div>
</div>

                </div>
                <div id="step-3" class="">




                     </div>
                <div id="step-4" class="">
                    <h2>Step 4 Content</h2>
                    <div class="panel panel-default">
                        <div class="panel-heading">My Details</div>
                        <table class="table">
                            <tbody>
                                <tr> <th>Name:</th> <td>Tim Smith</td> </tr>
                                <tr> <th>Email:</th> <td>example@example.com</td> </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        
    </div>
    
    <!-- Include jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <!-- Include SmartWizard JavaScript source -->
    <script type="text/javascript" src="../dist/js/jquery.smartWizard.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function(){
            
            // Step show event 
            $("#smartwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection, stepPosition) {
               //alert("You are on step "+stepNumber+" now");
               if(stepPosition === 'first'){
                   $("#prev-btn").addClass('disabled');
               }else if(stepPosition === 'final'){
                   $("#next-btn").addClass('disabled');
               }else{
                   $("#prev-btn").removeClass('disabled');
                   $("#next-btn").removeClass('disabled');
               }
            });
            
            // Toolbar extra buttons
            var btnFinish = $('<button></button>').text('Finish')
                                             .addClass('btn btn-info')
                                             .on('click', function(){ alert('Finish Clicked'); });
            var btnCancel = $('<button></button>').text('Cancel')
                                             .addClass('btn btn-danger')
                                             .on('click', function(){ window.location.href='\\HydrometV2\\stations.php'; });                         
            
            
            // Smart Wizard
            $('#smartwizard').smartWizard({ 
                    selected: 0, 
                    theme: 'default',
                    transitionEffect:'fade',
                    showStepURLhash: true,
                    toolbarSettings: {toolbarPosition: 'both',
                                      toolbarExtraButtons: [btnFinish, btnCancel]
                                    }
            });
                                         
            
            // External Button Events
            $("#reset-btn").on("click", function() {
                // Reset wizard
                $('#smartwizard').smartWizard("reset");
                return true;
            });
            
            $("#prev-btn").on("click", function() {
                // Navigate previous
                $('#smartwizard').smartWizard("prev");
                return true;
            });
            
            $("#next-btn").on("click", function() {
                // Navigate next
                $('#smartwizard').smartWizard("next");
                return true;
            });
            
            $("#theme_selector").on("change", function() {
                // Change theme
                $('#smartwizard').smartWizard("theme", $(this).val());
                return true;
            });
            
            // Set selected theme on page refresh
            $("#theme_selector").change();
        });   
    </script>  
</body>
</html>
