
<?php
								include("includes/link.php");
							
								include("includes/adminheader.php");

								include_once 'database.php';
       if (isset($_GET['session_request'])) {
        if(trim($_GET['session_request'])=='1')
        {
$_SESSION["stat"]=array();
$_SESSION["stat2"]=array();
$_SESSION["stat3"]=array();


        }
        
       }
  if (isset($_POST['deleteAll'])) {
    pg_query("delete from  \"tblTemplate\" where \"TemplateName\"='Reservoir'");
pg_query("delete from  \"tblTemplate\" where \"TemplateName\"='River'");
pg_query("delete from  \"tblTemplate\" where \"TemplateName\"='Precipitation'");

 echo "<script>alert('Template information has been saved successfully!');</script>";

  }
       

								if (isset($_POST['station_names'])) {
$station=$_POST['station_names'];

		 foreach($station as $stn)  
            { 
            	$stn_data=explode("|", $stn);
            	$stn_data[0]=trim($stn_data[0]);
            	$stn_data[1]=trim($stn_data[1]);

     try
     {
            if(pg_num_rows(  pg_query("Select \"Station_Full_Name\" from \"tblTemplate\" where \"Station_Full_Name\"='$stn_data[0]' and \"Station_Shef_Code\"='$stn_data[1]' and \"TemplateName\"='Reservoir'"))==0)
            {
pg_query("insert into \"tblTemplate\" (\"Station_Full_Name\",\"Station_Shef_Code\",\"TemplateName\") values('$stn_data[0]','$stn_data[1]','Reservoir')");
}
             }
             catch(Exception $ex)
     {
     	
     }
 }
$_SESSION["stat"]=array();
$_SESSION["stat2"]=array();
$_SESSION["stat3"]=array();



								}



								if (isset($_POST['station_names2'])) {
$station=$_POST['station_names2'];

		 foreach($station as $stn)  
            { 
            	$stn_data=explode("|", $stn);
            	$stn_data[0]=trim($stn_data[0]);
            	$stn_data[1]=trim($stn_data[1]);

     try
     {
            if(pg_num_rows(  pg_query("Select \"Station_Full_Name\" from \"tblTemplate\" where \"Station_Full_Name\"='$stn_data[0]' and \"Station_Shef_Code\"='$stn_data[1]' and \"TemplateName\"='River'"))==0)
            {
pg_query("insert into \"tblTemplate\" (\"Station_Full_Name\",\"Station_Shef_Code\",\"TemplateName\") values('$stn_data[0]','$stn_data[1]','River')");
}
             }
             catch(Exception $ex)
     {
     	
     }
 }
 $_SESSION["stat"]=array();
$_SESSION["stat2"]=array();
$_SESSION["stat3"]=array();



								}


								if (isset($_POST['station_names3'])) {
$station=$_POST['station_names3'];

		 foreach($station as $stn)  
            { 
            	$stn_data=explode("|", $stn);
            	$stn_data[0]=trim($stn_data[0]);
            	$stn_data[1]=trim($stn_data[1]);

     try
     {
            if(pg_num_rows(  pg_query("Select \"Station_Full_Name\" from \"tblTemplate\" where \"Station_Full_Name\"='$stn_data[0]' and \"Station_Shef_Code\"='$stn_data[1]' and \"TemplateName\"='Precipitation'"))==0)
            {
pg_query("insert into \"tblTemplate\" (\"Station_Full_Name\",\"Station_Shef_Code\",\"TemplateName\") values('$stn_data[0]','$stn_data[1]','Precipitation')");
}
             }
             catch(Exception $ex)
     {
     	
     }
 }
 $_SESSION["stat"]=array();
$_SESSION["stat2"]=array();
$_SESSION["stat3"]=array();

				}


							?>
             

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script> 
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js" type="text/javascript"></script> 

 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstra.css">

 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous" />
<link rel="stylesheet" href="styles.css" type="text/css" />

<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>
  <script type="text/javascript">
  	function station_delete_id(id)
  	{
 document.getElementById("station_table").deleteRow(id);
  	}
  	function getData()
  	{
  		var name=document.getElementById("SearchStation1").value;
      if (name.trim()=="") {
                alert("Please enter some text to search!");

        return;

      }
  		window.location.href='GetDataTemplate.php?SearchStation1='+name;
  	}
  		function getData2()
  	{
  		var name=document.getElementById("SearchStation2").value;
       if (name.trim()=="") {
                alert("Please enter some text to search!");

        return;

      }
  		window.location.href='GetDataTemplate2.php?SearchStation1='+name;
  	}
  	function station_delete_id2(id)
  	{

 document.getElementById("station_table2").deleteRow(id);
  	}

  	function getData3()
  	{
  		var name=document.getElementById("SearchStation3").value;
       if (name.trim()=="") {
        alert("Please enter some text to search!");
        return;

      }
  		window.location.href='GetDataTemplate3.php?SearchStation1='+name;
  	}
  	function station_delete_id3(id)
  	{

 document.getElementById("station_table3").deleteRow(id);
  	}
	function myClick2()
  	{

  	document.getElementById('li_river').click();
  }
  function myClick3()
  	{

  	document.getElementById('li_Precipitation').click();
  }
  </script>
  <br>
  <br>
  <center>
    <div class="panel panel-primary" style="width:90%"  >
         <div class="panel-heading" style="background-color:#4A7BDF;color:white"><b style="font-size:15px;">Tempates</b></div>
  <div class="panel-body">
  <form  method="POST">
							<div class="container">


  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#Reservoir">Reservoir</a></li>
    <li ><a id="li_river" data-toggle="tab" href="#River">River</a></li>
    <li><a id="li_Precipitation"  data-toggle="tab" href="#Precipitation">Precipitation</a></li>
  </ul>

  <div class="tab-content">
    <div id="Reservoir" class="tab-pane fade in active">
     <center>
      <h4><b>Search And Select Stations</b></h4>

      <Input name='SearchStation1' id="SearchStation1" style="width: 50%;" class="form-control" placeholder="Station  Name">
       <br>
      <button class="btn btn-info" type="button" onclick="getData();">Search</button>
      <br> <br>
      <?php
$result_set =pg_query("select \"Station_Full_Name\",\"Station_Shef_Code\" from \"tblTemplate\" where \"TemplateName\"='Reservoir'");

      ?>
<table class="table table-responsive table-hover" id="station_table" style="width: 50%;" >
	<tr>
		<th colspan="3"  style="background-color:#539CCC;color:white;text-align: center;">Selected Station</th>
	</tr>
      <?php
  

  $temp=array();
   

  $z=0;
  if (pg_num_rows($result_set)>0) {
 
$tem="";
while ($row=pg_fetch_array($result_set)) {

  $tem="".$row['Station_Full_Name'];
$tem.=" | ".$row['Station_Shef_Code'];
  $temp[$z]=$tem;
  $z++;

  $tem="";
}
$_SESSION["stat"]=$temp;

    }

       if (isset($_POST['Stations']) || pg_num_rows($result_set)>0) 
       {

  $checkbox1=$_SESSION["stat"];
  if (isset($_POST['Stations'])) 
  {
     $checkbox1=  array_merge ($checkbox1, $_POST['Stations']);
   }
  
 
     $checkbox1=array_unique($checkbox1);
  
          $_SESSION["stat"]= $checkbox1;

       $i=0;
         foreach($checkbox1 as $chk1)  
   { 
   	$i++;
   	?>
  
  <tr>
  <td style="width: 50px"><?php echo "$i"; ?></td>
		<td><input type="hidden"  name="station_names[]" value="<?php echo "$chk1"; ?>" ><?php echo "$chk1"; ?></td>
		<td style="width: 50px"><a data-toggle="tooltip" title="Delete!" href="javascript:station_delete_id('<?php echo $i; ?>')"><img src="b_drop.png" align="DELETE" /></a></button></td>
	</tr>
	 	<?php
   }
       }

      ?>
     </table>
 </center>
    </div>

    <div id="River" class="tab-pane fade">
     <center>
      <h4><b>Search And Select Stations</b></h4>

   
      <Input name='SearchStation2' id="SearchStation2" style="width: 50%;" class="form-control" placeholder="Station  Name">
       <br>
      <button class="btn btn-info" type="button" onclick="getData2();">Search</button>
      <br> <br>
           <?php
$result_set =pg_query("select \"Station_Full_Name\",\"Station_Shef_Code\" from \"tblTemplate\" where \"TemplateName\"='River'");

      ?>
<table class="table table-responsive table-hover" id="station_table2" style="width: 50%;" >
	<tr>
		<th colspan="3"  style="background-color:#539CCC;color:white;text-align: center;">Selected Station</th>
	</tr>
      <?php
        $temp=array();
   

  $z=0;
  if (pg_num_rows($result_set)>0) {
 
$tem="";
while ($row=pg_fetch_array($result_set)) {

  $tem="".$row['Station_Full_Name'];
$tem.=" | ".$row['Station_Shef_Code'];
  $temp[$z]=$tem;
  $z++;

  $tem="";
}
$_SESSION["stat2"]=$temp;

    }

       if (isset($_POST['Stations2']) || pg_num_rows($result_set)>0) 
       {
    
  

      // echo "<script>myClick2();</script>";	
   

  $checkbox1= $_SESSION["stat2"];
    if (isset($_POST['Stations2'])) {
     $checkbox1=  array_merge ($checkbox1, $_POST['Stations2']);
   }
          $checkbox1=array_unique($checkbox1);

          $_SESSION["stat2"]= $checkbox1;

       $i=0;
         foreach($checkbox1 as $chk1)  
   { 
   	$i++;
   	?>
  
  <tr>
  <td style="width: 50px"><?php echo "$i"; ?></td>
		<td><input type="hidden"  name="station_names2[]" value="<?php echo "$chk1"; ?>" ><?php echo "$chk1"; ?></td>
		<td style="width: 50px"><a data-toggle="tooltip" title="Delete!" href="javascript:station_delete_id2('<?php echo $i; ?>')"><img src="b_drop.png" align="DELETE" /></a></button></td>
	</tr>
	 	<?php
   }
       }
       else {


       }
    

      ?>
     </table>
       </center>
    </div>
    <div id="Precipitation" class="tab-pane fade">
 <center>
      <h4><b>Search And Select Stations</b></h4>

      <Input name='SearchStation3' id="SearchStation3" style="width: 50%;" class="form-control" placeholder="Station  Name">
    <br>
      <button class="btn btn-info" type="button" onclick="getData3();">Search</button>
      <br> <br>
      <?php
$result_set =pg_query("select \"Station_Full_Name\",\"Station_Shef_Code\" from \"tblTemplate\" where \"TemplateName\"='Precipitation'");

      ?>
<table class="table table-responsive table-hover" id="station_table3" style="width: 50%;" >
	<tr>
		<th colspan="3"  style="background-color:#539CCC;color:white;text-align: center;">Selected Station</th>
	</tr>
      <?php
    
        $temp=array();
   

  $z=0;
  if (pg_num_rows($result_set)>0) {
 
$tem="";
while ($row=pg_fetch_array($result_set)) {

  $tem="".$row['Station_Full_Name'];
$tem.=" | ".$row['Station_Shef_Code'];
  $temp[$z]=$tem;
  $z++;

  $tem="";
}
$_SESSION["stat3"]=$temp;

    }

       if (isset($_POST['Stations3']) || pg_num_rows($result_set)>0) 
       {
    
       	      // echo "<script>myClick3();</script>";	

  $checkbox1= $_SESSION["stat3"];
  if (isset($_POST['Stations3'])) {
 
     $checkbox1=  array_merge ( $checkbox1, $_POST['Stations3']);
        # code...
  }
          $checkbox1=array_unique($checkbox1);

          $_SESSION["stat3"]= $checkbox1;
       $i=0;
         foreach($checkbox1 as $chk1)  
   { 
   	$i++;
   	?>
  
  <tr>
  <td style="width: 50px"><?php echo "$i"; ?></td>
		<td><input type="hidden"  name="station_names3[]" value="<?php echo "$chk1"; ?>" ><?php echo "$chk1"; ?></td>
		<td style="width: 50px"><a data-toggle="tooltip" title="Delete!" href="javascript:station_delete_id3('<?php echo $i; ?>')"><img src="b_drop.png" align="DELETE" /></a></button></td>
	</tr>
	 	<?php
   }
       }
       else {


       }
    

      ?>
     </table>


    </div>
  </center>
  </div>

</div>

<center>
<input type="hidden" name="deleteAll" value="1">
<input type="submit" name="" value="Submit" class="btn btn-primary"/>
<br>
</center>
</form>
</div></div>
</center>

            <?php       include("includes/link2.php"); ?>

