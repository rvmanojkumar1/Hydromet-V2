
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
include_once('database.php'); 
//include_once database.php";

//session_start();

 if (isset($_SESSION["StationType"])&&isset($_GET['edit_id'])) {
 $erow="";

    $stnname=   $_SESSION["StationType"];
    $eid=$_GET['edit_id'];
    $sql_query="SELECT \"StationField\",\"FieldType\",\"ComboxValues\",\"id\" FROM \"DefineStations\" where \"StationTypeName\"='$stnname' and \"StationField\"='$eid'";
    $result_set=pg_query($sql_query);
$erow=pg_fetch_array($result_set);
$_SESSION["keyfield"]= $erow['id'];

}


if (isset($_GET['addnew'])=="addnew")
 {
  $_SESSION["StationType"]="";
}

if (isset($_GET['stntype']))
 {
    $tblname=trim($_GET['stntype']);
    $tblname=str_replace(" ", "_",$tblname);
    pg_query("create table if not exists \"$tblname\"(\"Station_Full_Name\" text,\"Station_Shef_Code\" TEXT,\"SHEFF\" TEXT,\"CSV\" TEXT,\"XML\" TEXT,\"Images\" TEXT,\"Latitude\" text,\"Longitude\" text)");
    $sql_query="SELECT * FROM \"DefineStations\" where \"StationTypeName\"='$tblname' and \"StationField\"='Station Full Name'";
    $result_set=pg_query($sql_query);

    if(pg_num_rows($result_set)==0)
    {
    
        pg_query("insert into \"DefineStations\"(\"StationTypeName\",\"StationField\",\"FieldType\",\"Required\") values('$tblname','Station Full Name','Text','Yes')");


}
 $sql_query="SELECT * FROM \"DefineStations\" where \"StationTypeName\"='$tblname' and \"StationField\"='Station Shef Code'";
    $result_s=pg_query($sql_query);

    if(pg_num_rows($result_s)==0)
    {
    
        pg_query("insert into \"DefineStations\"(\"StationTypeName\",\"StationField\",\"FieldType\",\"Required\") values('$tblname','Station Shef Code','Text','Yes')");


}

 $sql_query="SELECT * FROM \"DefineStations\" where \"StationTypeName\"='$tblname' and \"StationField\"='Latitude'";
    $result_s=pg_query($sql_query);

    if(pg_num_rows($result_s)==0)
    {
    
        pg_query("insert into \"DefineStations\"(\"StationTypeName\",\"StationField\",\"FieldType\",\"Required\") values('$tblname','Latitude','Text','Yes')");


}
 $sql_query="SELECT * FROM \"DefineStations\" where \"StationTypeName\"='$tblname' and \"StationField\"='Longitude'";
    $result_s=pg_query($sql_query);

    if(pg_num_rows($result_s)==0)
    {
    
        pg_query("insert into \"DefineStations\"(\"StationTypeName\",\"StationField\",\"FieldType\",\"Required\") values('$tblname','Longitude','Text','Yes')");


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
   // header("Location: $_SERVER[PHP_SELF]");
}


?>
<html lang="en">
<head>
<script type="text/javascript">
 
function edt_id(id)
{
    
    window.location.href='newStation.php?edit_id='+id;

    
}

function delete_id(id)
{
    if(confirm('Do you want to delete?'))
    {
        window.location.href='newStation.php?delete_id='+id;
    }
}

 

</script>

<script type="text/javascript">

function press()
{
  if (event.keyCode ==13)
  {
 var str=document.getElementById('comboboxvalues').value+',';
 document.getElementById('comboboxvalues').value=str;
}
}

 function GetSelectedTextValue(filedtype) {
       // var selectedText = filedtype.options[filedtype.selectedIndex].innerHTML;
        var selectedValue = filedtype.value;
       

//document.getElementById("conboboxplaceholder").innerHTML="<textarea name="comboboxvalues" />";
if (selectedValue=="Single-Select"||selectedValue=="Multi-Select") {
        document.getElementById("conboboxplaceholder").innerHTML="<label>values</label><textarea placeholder='values'  onkeydown = 'press()' style='width: 400px' name='comboboxvalues' id='comboboxvalues' class='form-control' />"; 
       }
       else
       {
         document.getElementById("conboboxplaceholder").innerHTML="";
       }
    }

    function addnewfield()
    {
      var selectedText = document.getElementById("fieldtype1").options[document.getElementById("fieldtype1").selectedIndex].innerHTML;
     var field=document.getElementById("fieldname").value;
    // var comboboxvalues=document.getElementById("comboboxvalues").value;
    var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
     
 $('#body').load();
     // document.getElementById("demo").innerHTML = this.responseText;
    }
  };
 // newStation.php?fieldname=f1&fieldtype=Single-Select&comboboxvalues=qq%0D%0Aww%0D%0Aw%0D%0A%0D%0Aw%0D%0Aw%0D%0Aw%0D%0A&filed=
  xhttp.open("GET", "newStation.php?fieldname="+field+"&fieldtype="+selectedText+"", true);
  xhttp.send();

                  
     //  window.location.replace(ui.tab.hash);
    
  

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

    <title>New Station Type</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <!-- Optional Bootstrap theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

    <script src="js/jquery-1.8.2.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="../dist/jquery.wizard1.js"></script>


  
    <link href="../dist/jquery.wizard.css" rel="stylesheet">
    <style type="text/css">
  
      .sidebar-nav {
        padding: 9px 0;
      }

	  [data-wizard-init] {
		margin: auto;
		width: 90%;
	  }
    </style>
</head>
<body>
  <br>
      <div class="panel panel-primary" style="width:90%;margin: 0 auto;"  >
         <div class="panel-heading" style="background-color:#4A7BDF;color:white"> 
         <center><b style="font-size:15px"> Add/Edit Station type</b></center></div>
  <div class="panel-body">

    <div data-wizard-init>
      <ul class="steps">
      <li data-step="1" class="disable">Step 1</li>
      <li data-step="2" class="active">Step 2</li>
 
    

      </ul></div>
      <br>
		
			 
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
        <form action="newfield.php">
    <label style="font-weight: bold;">Field Name</label>
    <input type="text" name="fieldname" style="height: 30px;width: 400px" id="fieldname" class="form-control" placeholder="Field Name" value="<?php if(isset($erow['FieldType'])) echo $erow['StationField'];?>" Required  oninvalid="this.setCustomValidity('Please Enter Filed Name!')" oninput="setCustomValidity('')" >
        <label style="font-weight: bold;">Field Type</label>
    
  <select name="fieldtype" id="fieldtype1" class="dropdown form-control" style="height: 30px;width: 400px" onchange="GetSelectedTextValue(this)" Required  oninvalid="this.setCustomValidity('Please Select Type!')" oninput="setCustomValidity('')">
     <option value="" disabled selected>Select your option</option>
<option value="Text" <?php if(isset($erow['FieldType'])){ if($erow['FieldType']=='Text') echo 'selected';}?>>Text</option>
<option value="Number" <?php if(isset($erow['FieldType'])){ if($erow['FieldType']=='Number') echo 'selected'; }?>>Number</option>
<option value="Multi Line" <?php if(isset($erow['FieldType'])){ if($erow['FieldType']=='Multi Line') echo 'selected'; }?>>Multi Line</option>
<option value="Single-Select" <?php if(isset($erow['FieldType'])){ if($erow['FieldType']=='Single-Select') echo 'selected';} ?>>Single-Select</option>
<option value="Multi-Select" <?php if(isset($erow['FieldType'])){ if($erow['FieldType']=='Multi-Select') echo 'selected'; }?>>Multi-Select</option>
  </select>
  <br>
  <p id="conboboxplaceholder"></p>

  <input type="checkbox" name="filedrequire" id="filedrequire" value="Yes"> Is Required?
  <br>
   <br>

  <button name="filed" class="btn btn-primary" type="submit" >Save</button>
  <button name="cancel" class="btn btn-danger" type="reset" onClick="clear()" formnovalidate>Clear</button>
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
    <table align="center" style="width:90%;" class="w3-table-all">
    
    <th style="background-color:#539CCC;color:white;">Field Name</th>
    <th style="background-color:#539CCC;color:white">Field Type</th>
 <th style="background-color:#539CCC;color:white">Required</th>
    <th style="background-color:#539CCC;color:white">Values</th>
    <th colspan="2" style="background-color:#539CCC;color:white">Operations</th>
    </tr>
    <?php
   if (isset($_SESSION["StationType"])) {

 
    $stnname=   $_SESSION["StationType"];
    $sql_query="SELECT \"StationField\",\"FieldType\",\"ComboxValues\",\"Required\" FROM \"DefineStations\" where \"StationTypeName\"='$stnname'";
    $result_set=pg_query($sql_query);
    if(pg_num_rows($result_set)>0)
    {
        while($row=pg_fetch_row($result_set))
        {
        ?>
            <tr>
            <td><?php echo $row[0]; ?></td>
            <td><?php echo $row[1]; ?></td>
             <td><?php if (trim($row[3])==='') {
              
             echo 'No'; }else { echo $row[3];} ?></td>
            <td><?php echo $row[2]; ?></td>
            <td align="center" style="width:50px"><?php if($row[0]==='Station Full Name' || $row[0]==='Station Shef Code'  || $row[0]==='Latitude' || $row[0]==='Longitute'){} else { ?><a href="javascript:edt_id('<?php echo $row[0]; ?>')"><img src="b_edit.png" align="EDIT" /></a> <?php } ?></td>
            <td align="center" style="width:50px"><?php if($row[0]==='Station Full Name' || $row[0]==='Station Shef Code' || $row[0]==='Latitude' || $row[0]==='Longitute'){} else { ?><a href="javascript:delete_id('<?php echo $row[0]; ?>')"><img src="b_drop.png" align="DELETE" /></a><?php } ?></td>
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
    <br>
    <br>
    <br>
<button type="button" onclick="previous()" class="btn btn-default">Previous</button>
<button type="button" onclick="finish()" class="btn btn-success" >Finish</button>
<button type="button" onclick="cancel()" class="btn btn-danger" >Cancel</button>
</center>
    </div>
    </div>
  </div>
  </div>
</div>
		

</body>
</html>
<script type="text/javascript">
 function previous()
 {
 window.location.href='newStationstep1.php';
 }

function finish()
{
alert("Station Type has been created successfully!");
 window.location.href="/HydrometV2/stations.php";
}

 function cancel()
    {
       window.location.href="/HydrometV2/stations.php";
    }
</script>



	</div>
	</div>
	</div>
	</div>
	</div>
	
	
	

							
</body>
</html>
