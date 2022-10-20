
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



?>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script> 
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js" type="text/javascript"></script> 
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<link rel="stylesheet" type="text/css" href="bootstrap/css/boottrap.css">

 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous" />

	<style type="text/css">
  
 b *{
    font-family: arial;
  }
</style>
	    <script type="text/javascript">
        function ShowImagePreview(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#profile_pic').prop('src', e.target.result)
                        .width(130)
                        .height(150);
                };
                reader.readAsDataURL(input.files[0]);
                }
            }

            function cancel()
            {
if(confirm('Are You Sure You want to Cancel ?'))
	{
 window.location.href='stations.php';
	}

            }

          function sub_date(){
              alert("heelo world!");
            }

</script>

<br> <br>
  <div class="panel panel-primary" style="width:90%;margin: 0 auto;"  >
         <div class="panel-heading" style="background-color:#4A7BDF;color:white"><center><b style="font-size:15px;font-family: arial;">Logo Managemet</b></center></div>
  <div class="panel-body">
<div class="container">

  <ul class="nav nav-tabs" id="myTab">
    <li class="active"><a data-toggle="tab" href="#logo"><b>Application Logo</b></a></li>
    <li><a data-toggle="tab" href="#name"><b>Application Name</b></a></li>
      <li><a data-toggle="tab" href="#dateformat"><b>Date Format</b></a></li>
      <li><a data-toggle="tab" href="#decimalplaces"><b>Decimal Places</b></a></li>

  </ul>

  <div class="tab-content">
    <div id="logo" class="tab-pane fade in active">

<div class="col-sm-12">
<center>
             <div class="form-group">
<br>
<form action="logomanager.php" enctype="multipart/form-data" method="post">
             <img  Style="width:130px;height:150px;background-color:gainsboro;" id="profile_pic" Class="img-thumbnail" src="blankImage.png"/>
     
          <input type="file"  name="pic" id="pic" required onChange="ShowImagePreview(this);" Style="width:130px;"/>  
          <br>

          <?php
if(isset($_FILES['pic']))
{
$uploaddir = '/Images/';
$uploadfile =  basename($_FILES['pic']['name']);

echo "<p>";

if (move_uploaded_file($_FILES['pic']['tmp_name'], $uploadfile)) {
  echo "File is valid, and was successfully uploaded.\n";
} else {
   echo "Upload failed";
}
$f=basename($_FILES['pic']['name']);
$result=	pg_query("update \"tblLogo\" set \"logo\"='$f' where \"Id\"='101'");

if ($result) {
echo "<script>alert('logo has been upadated successfully!');window.location.href='logomanager.php'</script>";

 // header("Location: logomanager.php");
}


}


           ?>
           <br>
<input type="submit" name="submit" class="btn btn-primary" value="submit"/>
<input type="button" name="Cancel" onclick="cancel()" class="btn btn-danger" value="Cancel"/>
</form>
            </div></center>

       </div>
       </div>
    <div id="name" class="tab-pane fade">
<div class="col-sm-12">
<center>

<form action="logomanager.php" method="post">
<br>
<label>Application Name</label><br>
<input type="text" name="Appname" id="Appname" placeholder="Enter Application Name" required class="form-control" style="width:300px" /><br>
<?php 

if (isset($_POST['Appname'])) {

$name=$_POST['Appname'];
$result=pg_query("update \"tblLogo\" set \"ApplicationName\"='$name' where \"Id\"='101'");
if ($result) {
	echo "<script>alert('Application Name has been Updated Successfully!');window.location.href='logomanager.php'</script>";

	 // header("Location: logomanager.php");
	}
}
?>
<br>
<input type="submit" name="submit" class="btn btn-primary"  value="submit"/>
<input type="button" name="Cancel" onclick="cancel()" class="btn btn-danger" value="Cancel"/>

</form>

</center>
</div>
 </div>

   <div id="dateformat" class="tab-pane fade">
<div class="col-sm-12">
<center>
<form action="logomanager.php" method="post">
<br>
<select id="date_format" name="date_format" class="form-control" style="width:300px" required>
 
  <option value="Y-m-d h:i A">YYYY-MM-DD 12 Hours</option>
  <option value="m-d-Y h:i A">MM-DD-YYYY 12 Hours</option>
<option value="d-m-Y h:i A">DD-MM-YYYY 12 Hours</option>
  <option value="Y-m-d H:i">YYYY-MM-DD 24 Hours</option>
   <option value="m-d-Y H:i">MM-DD-YYYY 24 Hours</option>-->
<option value="d-m-Y H:i">DD-MM-YYYY 24 Hours</option>
</select>
<br>
<input type="submit"  class="btn btn-primary"  value="submit"/>

<input type="button" name="Cancel" onclick="cancel()" class="btn btn-danger" value="Cancel"/>
</form>
<?php 

if (isset($_POST['date_format'])) {

$name=$_POST['date_format'];
$result=pg_query("update \"tblLogo\" set \"DateFormat\"='$name' where \"Id\"='101'");
if ($result) {
  echo "<script>alert('Date Format has been Updated Successfully!');window.location.href='logomanager.php'</script>";

   // header("Location: logomanager.php");
  }
}
?>
</center>
</div>
 </div>

   <div id="decimalplaces" class="tab-pane fade">
<div class="col-sm-12">
<center>
<form action="logomanager.php" method="post">
<br>
<input type="number" placeholder="Decimal Places" name="decimal" required class="form-control" style="width:300px">
<br>
<input type="submit"  class="btn btn-primary"  value="submit"/>

<input type="button" name="Cancel" onclick="cancel()" class="btn btn-danger" value="Cancel"/>
</form>
<?php 

if (isset($_POST['decimal'])) {

$name=$_POST['decimal'];
$result=pg_query("update \"tblLogo\" set \"DecimalPlaces\"='$name' where \"Id\"='101'");
if ($result) {
  echo "<script>alert('Decimal Places has been Updated Successfully!');window.location.href='logomanager.php'</script>";

   // header("Location: logomanager.php");
  }
}
?>
</center>
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
	
	
	

							<?php
								//include("includes/footer.php");
							?>
							<?php
							//	include("includes/link2.php");
							?>
</body>
</html>




