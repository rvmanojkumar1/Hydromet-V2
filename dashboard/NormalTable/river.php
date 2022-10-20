
<!DOCTYPE php>
<html>
<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="HandheldFriendly" content="true">
<head>
	<?php
		// include("link.php");
	?>
</head>
<style type=text/css>
@media screen and (max-width: 1060px) {
    #primary { width:67%; }
    #secondary { width:30%; margin-left:3%;}  
}
/* Tabled Portrait */
@media screen and (max-width: 768px) {
    #primary { width:100%; }
    #secondary { width:100%; margin:0; border:none; }
}
.child{
	overflow-x: hidden;
}
</style>
<div class="parent">
	<div class="child">  
							<?php
								include "riverTable1.php";
							?>
   	</div>
   	<div class="child">  
							<?php
								include "riverTable2.php";
							?>
   	</div>
</div>
<script>
setInterval(function() {
    $("#child").load(location.href,"");
}, 60*1000);
</script>
</html>