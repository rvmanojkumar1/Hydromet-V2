	<?php
								include("includes/link.php");
						
								include("includes/header.php");
							?>



<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script> 
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js" type="text/javascript"></script> 

 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstra.css">

 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous" />
<link rel="stylesheet" href="styles.css" type="text/css" />
<script>
function showUser() {
  
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
  xmlhttp.onreadystatechange=function() {
    if (this.readyState==4 && this.status==200) {
      document.getElementById("graphs").innerHTML=this.responseText;
    }
  }
  xmlhttp.open("POST","getTemplateGraph.php",true);
  xmlhttp.send();
}
</script>
<center>
<br><br>
<div style="width: 98%">
	

<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#Reservoir">Reservoir</a></li>
    <li ><a id="li_river" data-toggle="tab" href="#River">River</a></li>
    <li><a id="li_Precipitation"  data-toggle="tab" href="#Precipitation">Precipitation</a></li>
  </ul>

<div class="tab-content">
  <div id="Reservoir" class="tab-pane fade in active">
<div id="graphs" style="width: 100%;height: 99%">
	<iframe src="getTemplateGraph.php" style="width: 100%;height: 99%"></iframe>
</div>
  </div>
  <div id="River" class="tab-pane fade">
 
    <div id="graphsRiver" style="width: 100%;height: 99%">
  <iframe src="getTemplateRiver.php" style="width: 100%;height: 99%"></iframe>
</div>
  </div>
  <div id="Precipitation" class="tab-pane fade">

    <div id="graphsRiver" style="width: 100%;height: 99%">
  <iframe src="getTemplatePrecipitation.php" style="width: 100%;height: 99%"></iframe>
</div>
  </div>
</div>
</div>
</center>