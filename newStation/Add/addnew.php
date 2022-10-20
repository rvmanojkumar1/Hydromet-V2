<?php
include_once 'database.php';
include_once 'adminheader.php';
session_start();

if(isset($_GET['delete_id']))
{
  $id=$_GET['delete_id'];
    //$sql_query="DELETE FROM \"tblStationType\" WHERE \"StationType\"='$id'";
//  pg_query($sql_query);
    header("Location: $_SERVER[PHP_SELF]");
}
if(isset($_GET['addstation'])=="addstation")
{


    $_SESSION["stntypename"]="";
}


?>

<!DOCTYPE html>
<html>
<head>
    <title>Smart Wizard - a JavaScript jQuery Step Wizard plugin</title>
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
    <script type="text/javascript">
function cancel()
{
window.location.href='\\HydrometV2\\stations.php'
}
 function stntype()
 {
    var stntypename=document.getElementById("stntypename").value;
window.location.href='addnew.php?stntypename='+stntypename;
 }

</script>
</head>
<body>
    <center>
      <div class="panel panel-primary" style="width:90%"  >
         <div class="panel-heading" style="background-color:#4A7BDF;color:white"><b style="font-size:20px">Add Station</b></div>
  <div class="panel-body">
    <div class="container">
        
        <form name="form1" class="form-inline">
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
<center>

 <div class="content">
                                         <div class="alert alert-info" style="font-family:Arial;">
  <b>In Which Station Type You want to Create Station ?</b>
</div>
</div>

    <from name="form11" action="addnew.php" class="myform">
      
  <select name="stntypename" id="stntypename" style="width:300px" class="dropdown form-control" onChange="stntype()" style="height:35px" Required  oninvalid="this.setCustomValidity('Please Select Station Type!')" oninput="setCustomValidity('')">

     <option value="" disabled selected>Select your option</option>
     <?php 
       $sql_query="SELECT \"StationType\" FROM \"tblStationType\"";
  $result_set=pg_query($sql_query);
  if(pg_num_rows($result_set)>0)
  {
        while($row=pg_fetch_row($result_set))
    {

?>

<option value='<?php echo $row[0]?>' <?php if (isset( $_GET['stntypename']) ){ if($_GET['stntypename']==$row[0]) echo 'selected';}?>><?php echo $row[0]?></option>

<?php

    }
}
    ?>

  

</select>

</form>
  </center>




         </div>              

                <div id="step-2" class="">

   <div>
<center>
<form action='addnew.php' method="post" class="myform" name="form2">
    <table style="width:100%;" >
<tr>

<?php

if(isset($_GET['stntypename']))
{
$stntypename=   $_GET['stntypename'];
$_SESSION["stntypename"]=$stntypename;
       // var selectedText = filedtype.options[filedtype.selectedIndex].innerHTML;
     $i=0;
      
       $sql_query="SELECT \"StationField\" FROM \"DefineStations\" WHERE \"StationTypeName\"='$stntypename'";
  $result_set=pg_query($sql_query);
  if(pg_num_rows($result_set)>0)
  {
    ?>
         <div class="content">

                                         <div class="alert alert-info" style="font-family:Arial;">
  <b>Fill The Station Details!</b>
</div>
</div>
    <?php
        while($row=pg_fetch_row($result_set))
    { 
$stationfiled=$row[0];
$i++;
?>
<td style='padding:5px'><label><?php echo $row[0]; ?></label></td><td style='padding:5px'><input type='text' class='form-control' name='<?php echo str_replace(" ", "_",$row[0]); ?>'/></td>
<?php
if ($i==3) {
?>
</tr><tr>
<?php
$i=0;
}
 }
  ?>
</tr><tr> <td><input type="hidden" name="stntypetable" value='<?php echo $stntypename;?>'></td>
  </tr> </table><br><br>

  <?php
}
}
include_once 'dbaddStation.php';

?>


</form>
</center>
</div>
</div>


                <div id="step-3" class="">
                   
<div id="body">
    <div id="content">
        <center>
            <form name="form3" class="myform" method="post" action="addnew.php">
    <table align="center" class="table" style="width:50%">
    <tr>
    
    </tr>
     <th style="background-color:#539CCC;color:white;">Select</th>
    <th style="background-color:#539CCC;color:white;">Hydromet Sensor Name</th>
    <th style="background-color:#539CCC;color:white">Multi</th>
    <th style="background-color:#539CCC;color:white">Addtion</th>
   
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
                <td><input type="checkbox" name="chekedsensor[]" value="<?php echo $row[1]; ?>"/></td>
            <td><?php echo $row[0]; ?></td>
            <td><input type="text" style="width:50px" value="<?php echo $row[3]; ?>" name="<?php echo str_replace(' ', '_',$row[0]); ?>" ></td>
            <td><input type="text" style="width:50px" value="<?php  echo $row[4]; ?>" name="<?php echo 'A'.str_replace(' ', '_',$row[0]); ?>"></td>
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
</form>
</center>
    </div>
</div>




                         </div>
                <div id="step-4" class="">
                    <h2>Step 4 Content</h2>
                    <div class="panel panel-default">
                        <div class="panel-heading">My Details</div>
                        <table class="table">
                            <tbody>
                                <tr> <th>Name:</th> <td></td> </tr>
                                <tr> <th>Email:</th> <td></td> </tr>
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
            var position;
            // Step show event 
            $("#smartwizard").on("showStep", function(e, anchorObject, stepNumber, stepDirection, stepPosition) {
               //alert("You are on step "+stepNumber+" now");
               position=stepPosition;
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
                                             .on('click', function(){ 


 //document.form11.submit();
  document.form2.submit();
  document.form3.submit();
     });

                                         
                  
                
                  
                         
            var btnCancel = $('<button></button>').text('Cancel')
                                             .addClass('btn btn-danger')
                                             .on('click', function(){ $('#smartwizard').smartWizard("reset"); });                       
            
            
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
</div>
</div>
</center>
</body>

</html>
