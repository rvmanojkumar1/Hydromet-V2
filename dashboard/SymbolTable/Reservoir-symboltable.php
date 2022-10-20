
<!DOCTYPE php>
<html>
	<head>
		<?php
			include("link.php");
		?>
	</head>

	<body class="cnt-home" >  
		<?php
			include("../../includes/header.php");
		?>
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script> 
		<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js" type="text/javascript"></script> 
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous" />
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous" />
		<link rel="stylesheet" href="../../assets/jquery-ui.css">
		<script type="text/javascript" src="../../assets/jquery.js"></script>
		<script type="text/javascript" src="../../assets/jquery-ui.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.17.1/moment.js"></script>
		<style type="text/css">
			.child{
				margin-bottom: 40px;
			}
		</style>
		<script>
			function PlotGraph(params,station) {
    var yearFrom;
    var monthFrom;
    var dayFrom;
    var yearTo;
    var monthTo;
    var dayTo;
    var hours=24;
    var hours2=hours;
    hours=hours%24;            
    var days=1; // Days you want to subtract
    var date = new Date();
    var last = new Date(date.getTime() - (days * 24 * 60 * 60 * 1000));
    var dayFrom =last.getDate();
    var monthFrom=last.getMonth()+1;
    var yearFrom=last.getFullYear();
    var currentdate = new Date();
    yearTo = currentdate.getFullYear();
    monthTo = currentdate.getMonth() + 1;
    dayTo = currentdate.getDate();
    window.location.href= '/HydrometV2/Graph.php?FY=' + yearFrom + "&FM=" + monthFrom + "&FD=" + dayFrom + '&TY=' + yearTo + "&TM=" + monthTo + "&TD=" + dayTo + "&PARAMS=" + params+"&hours="+hours+"&station="+station+"&hours2="+hours2;
  }
		</script>
		<script>
function includeHTML() {
  var z, i, elmnt, file, xhttp;
  /*loop through a collection of all HTML elements:*/
  z = document.getElementsByTagName("*");
  for (i = 0; i < z.length; i++) {
    elmnt = z[i];
    /*search for elements with a certain atrribute:*/
    file = elmnt.getAttribute("w3-include-html");
    if (file) {
      /*make an HTTP request using the attribute value as the file name:*/
      xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4) {
          if (this.status == 200) {elmnt.innerHTML = this.responseText;}
          if (this.status == 404) {elmnt.innerHTML = "Page not found.";}
          /*remove the attribute, and call this function once more:*/
          elmnt.removeAttribute("w3-include-html");
          includeHTML();
        }
      }      
      xhttp.open("GET", file, true);
      xhttp.send();
      /*exit the function:*/
      return;
    }
  }
};
</script>

		<?php
			$dir = "../SymbolTable";
			$i = 0; 
		    if ($handle = opendir($dir)) {
		        while (($file = readdir($handle)) !== false){
		            if (!in_array($file, array('.', '..')) && !is_dir($dir.$file)) 
		            {
		                $temp = explode(".",$file);
		                if(($temp[1]=="txt")&&(strpos($temp[0], "ReservoirTable")!==false)){
		                    $i++;
		                }
		            }
		        }
		    }
		    $count_txt=$i;
		?>
		<div class="parent">
			<?php
				for ($z=1; $z <= $count_txt ; $z++) {
					?>
						<div class="child" w3-include-html="Table.php?num=<?php echo $z;?>&name=ReservoirTable"></div>
					<?php
				}
			?>
		</div>
		<script>
includeHTML();
</script>
	</body>
</html>