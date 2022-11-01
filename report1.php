<!DOCTYPE html>
<html>
	<head>
		<?php
	        include("includes/link.php");
	    ?>
	    <?php
	        include("includes/header.php");  
	        include_once 'includes/database.php';          
	    ?>
	    <link rel="stylesheet" type="text/css" href="/HydrometV2/assets/css/MyTable.css"> 
		<link rel="stylesheet" href="assets/jquery-ui.css">

		<script type="text/javascript" src="assets/jquery.js"></script>
		<script type="text/javascript" src="assets/jquery-ui.js"></script>

		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/i18n/defaults-*.min.js"></script>
		<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.3.2/css/bootstrap.min.css">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
		<script src="js/jquery.table2excel.js"></script>
	<style type="text/css">
			#btnExport
		    {
		      padding: 5px;
		      /*margin-top: 5px;*/
		      display: none;
		    }
		    #exporttopdf{
		      padding: 5px;
		      /*margin-top: 5px;*/
		      display: none;
		    }
	</style>
		<script type="text/javascript">
			$(document).ready(function(){
				$("button").removeAttr("title");
      			if ( $('[type="date"]').prop('type') != 'date' ) {
      		  		$('[type="date"]').datepicker();
      			}

      			$("#type_of_report").change(function(){
	      			var val=$("#type_of_report").val();

					if (val.trim()=="Monthly") {
				        $("#month_table").css("display","");
				        $("#daily_table").attr("value", "dd-mm-yyyy");
				        $("#daily_table").css("display","none");
				        $("#Annual_table").css("display","none");
				    }
			      	else if(val.trim()=="Daily")
			      	{
	            	    $("#Annual_table").css("display","none");

	        			$("#month_table").css("display","none");
	        			$("#daily_table").css("display","");
	    			}
				    else if(val.trim()=="Annual")
	      			{
	      				$("#month_table").css("display","none");
				        $("#daily_table").attr("value", "dd-mm-yyyy");
				        $("#daily_table").css("display","none");
				        $("#Annual_table").css("display","");
					}
    			});

			type=$("#report_type").val();
    		});
    		$(document).ready(function()
  			{
    			$("#Sname").on('change',function(){
      				// GetData();
    			});
			});
			function emptystation(){
    			// document.getElementById('Sname').value="";
    			var val=$("#report_type").val();
    			var type_of_report=$("#type_of_report").val();
    			window.location.href="report1.php?report_type="+val+"&type="+type_of_report;

    		}
    		function demoFromHTML()
		  	{
		  		var sTable = document.getElementById('customtable').innerHTML;

		        var style = "<style>";
		        style = style + "table {width: 100%;font: 17px Calibri;}";
		        style = style + "table, th, td {border: solid 1px #DDD; border-collapse: collapse;";
		        style = style + "padding: 2px 3px;text-align: center;}";
		        style = style + "</style>";

		        // CREATE A WINDOW OBJECT.
		        var win = window.open('', '', 'height=700,width=700');

		        win.document.write('<html><head>');  // <title> FOR PDF HEADER.
		        win.document.write(style);          // ADD STYLE INSIDE THE HEAD TAG.
		        win.document.write('</head>');
		        win.document.write('<body>');
		        win.document.write(sTable);         // THE TABLE CONTENTS INSIDE THE BODY TAG.
		        win.document.write('</body></html>');

		        win.document.close();   // CLOSE THE CURRENT WINDOW.

		        win.print();    // PRINT THE CONTENTS.
		   }
		   function exportTableToExcel(){
			    var filename = $("#type_of_report").val();
			    if(filename=='Daily'){
               filename=filename+"-report "+$("#EditStartDate").val();
            }
			else if(filename=='Monthly'){
               filename=filename+"-report "+$("#months").val()+"-"+$("#years").val();
            }
			else if(filename=='Annual'){
               filename=filename+"-report "+$("#Annual_years").val();
            }
			    $("#table").table2excel({
				    exclude: ".excludeThisClass",
				    name: filename,
				    filename: filename+".xls", // do include extension
				    preserveColors: true // set to true if you want background colors and font colors preserved
				});
			}
    		function changepage(reportvalue){
    			if(reportvalue=='Climate'){
    				window.location.href="report1.php?report_type="+reportvalue;
    			}
    			else if(reportvalue=='Custom'){
    				window.location.href="report.php?report_type="+reportvalue;
    			}
    		}
  			function GetData()
  			{
    			var stn=document.getElementById('Sname').value;
    			var val=$("#report_type").val();
    			var type_of_report=$("#type_of_report").val();
    			// if(type_of_report=)
            var presentdate=new Date();
            var FY=presentdate.getFullYear();
            var FM=presentdate.getMonth()+1;
            var FD=presentdate.getDate()
            if(type_of_report=='Daily'){
               window.location.href='report1.php?station='+stn+"&report_type="+val+"&type="+type_of_report+"&FY="+FY+"&FM="+FM+"&FD="+FD;
            }
			else if(type_of_report=='Monthly'){
               window.location.href='report1.php?station='+stn+"&report_type="+val+"&type="+type_of_report+"&FY="+FY+"&FM="+FM;
            }
			else if(type_of_report=='Annual'){
               window.location.href='report1.php?station='+stn+"&report_type="+val+"&type="+type_of_report+"&FY="+FY;
            }
    			     
  			}

    		$(function() 
			{
				$( "#Sname" ).autocomplete({
				  	source: '<?php if(trim($_GET["report_type"])=="Custom") echo "autocompelete.php"; else echo "autocompeleteByType.php"; ?>?type='+type,
				   	close: function( event, ui ) { GetData(); }
			 	});
			});
			function PlotGraph() 
			{

	            var selected = $("#SensorList option:selected");
	        	var params = "";
		        	selected.each(function () {
		            params +=$(this).val() + ";";
		        });
	            var typereport=$("#report_type").val();

				if(document.getElementById("Sname").value.trim()=="")
				{
					alert('Please Search and Select Station!');
					return;
				}
				else if (document.getElementById("SensorList").value.trim()=="") {
					alert('Please Select Sensor!');
					return;
				}
				
				else 
				{
				    var type=$("#type_of_report").val();
				    var station = document.getElementById("Sname").value;
				    if (type=="Daily") {
				        var Ids = [];
				        var Names = [];
				        var i = 0;
				        var yearFrom;
				        var monthFrom;
				        var dayFrom;
				        var currentdate = new Date();
				        var jsFromDate =document.getElementById("EditStartDate").value;
				        jsFromDate=jsFromDate.replace("-","/");
				        jsFromDate=new Date(jsFromDate);
				   
				        if (jsFromDate =="Invalid Date")
						{  
				            yearFrom = currentdate.getFullYear();
				            monthFrom = currentdate.getMonth() + 1;
				            dayFrom = currentdate.getDate();
				        }
				        else 
				        {
				            yearFrom = jsFromDate.getFullYear(); // where getFullYear returns the year (four digits)
				            monthFrom = jsFromDate.getMonth()+1; // where getMonth returns the month (from 0-11)
				            dayFrom = jsFromDate.getDate();
				             // where getDate returns the day of the month (from 1-31)
				        }
				        window.location.href= 'report1.php?FY=' + yearFrom + "&FM=" + monthFrom + "&FD=" + dayFrom + "&PARAMS=" + params+"&station="+station+"&type=Daily&report_type="+typereport;
				    }
				    else if (type=="Monthly")
				    {
				        var yearFrom=$("#years option:selected").val();
				        var monthFrom=$("#months option:selected").val();
				        window.location.href= 'report1.php?FY=' + yearFrom + "&FM=" + monthFrom + "&PARAMS=" + params+"&station="+station+"&type=Monthly&report_type="+typereport;
				    }
				    else if (type=="Annual")
				    {
				        var yearFrom=$("#Annual_years option:selected").val();
				        window.location.href= 'report1.php?FY=' + yearFrom + "&PARAMS=" + params+"&station="+station+"&type=Annual&report_type="+typereport;
				    }
				} 
			}
		</script>
	</head>
	<body>
		<form>
			<br>
	   		<center>
	   			<div style="width: 98%">
	   				<div class="row" >
						<div class="col-md-2" > 
	   						<select class="form-control" id="report_type" onchange="changepage(this.value);">
	  							<option value="Climate" <?php if (isset($_GET['report_type'])) {
	  								if(trim($_GET['report_type'])=="Climate") echo "selected";
	  								} ?>>Climate
	  							</option>
	  							<!-- <option value="Rain" <?php //if (isset($_GET['report_type'])) {
	  								// if(trim($_GET['report_type'])=="Rain") echo "selected";
	  								//} ?>>Rain
	  							</option>
	  							<option value="Reservoir" <?php //if (isset($_GET['report_type'])) {
								  	//if(trim($_GET['report_type'])=="Reservoir") echo "selected";
								  	//} ?>>Reservoir
								  </option>
	   							<option value="River" <?php // if (isset($_GET['report_type'])) {
								  	//if(trim($_GET['report_type'])=="River") echo "selected";
								  //	} ?>>River
								</option> -->
	    						<option value="Custom" <?php if (isset($_GET['report_type'])) {
								  	if(trim($_GET['report_type'])=="Custom") echo "selected";
								  	} ?>>Custom
								</option>
	  						</select>
	  					</div>
						<div class="col-md-2" > 
							<select class="form-control" id="type_of_report" onchange="emptystation()">
								<option value="Daily" <?php if (isset($_GET['type'])) {
									if(trim($_GET['type'])=="Daily") echo "selected";
									} ?>>Daily Summary
								</option>
								<option value="Monthly" <?php if (isset($_GET['type'])) {
									if(trim($_GET['type'])=="Monthly") echo "selected";
									} ?>>Monthly Summary
								</option>
								<option value="Annual" <?php if (isset($_GET['type'])) {
									if(trim($_GET['type'])=="Annual") echo "selected";
									} ?>>Annual Summary
								</option>
							</select>
						</div>
						<div class="col-md-2" >
							<input type="text" id="Sname" name="StationName" class="form-control" required  value='<?php 
								if(isset($_GET['station']))
								{
									echo $_GET['station'];
								}

							?>' placeholder="Station Name"> 
	  					</div>
	    				<div class="col-md-2"> 
							<?php
							    $stn_name='';
	     						$data=trim($_GET['station']);
	         					$dataU=strtoupper($data);        
	         					$dataL=strtolower($data);
								$result_stn=pg_query("select \"StationType\" from \"tblStationType\"");
								if(pg_num_rows($result_stn)>0)
								{
									while($row_user=pg_fetch_array($result_stn))
									{
								        $sql_querys="select \"Station_Full_Name\" from \"" . str_replace(' ','_', $row_user['StationType']) ."\" where \"Station_Shef_Code\"='$data' or \"Station_Shef_Code\" = '$dataU' or \"Station_Shef_Code\"='$dataL' or \"Station_Full_Name\"='$data' or \"Station_Full_Name\"='$dataU' or \"Station_Full_Name\"='$dataL'";
								   		$result_seted=pg_query($sql_querys);
								        if(pg_num_rows($result_seted)>0) 
								        {
								      		while ($data1=pg_fetch_row($result_seted)) 
								 			{
								  				$stn_name=$data1[0];
								 			}
										}
									}
								}
								if($_GET['type']=="Daily"){
									$myfile = file_get_contents("climate-daily.txt", "r");
								}
								else if($_GET['type']=="Monthly"){
									// echo "monthly";
									$myfile = file_get_contents("climate-monthly.txt", "r");
								}
								else if($_GET['type']=="Annual"){
									$myfile = file_get_contents("climate-annual.txt", "r");
								}
								
								if($_GET['type']=="Annual"){
									$textdata=explode(PHP_EOL, $myfile);
									$txtdata=array();
									foreach($textdata as $d){
								      $d = explode('-', $d);
								      $txtdata[]=$d;
								    }
								    $sensornames=array();
								    $from_month=$txtdata[0][0];
								    for($k=1;$k<count($txtdata);$k++){
								    	for($l=0;$l<count($txtdata[$k]);$l++){
								    		$sensnames=explode(",", $txtdata[$k][0]);
								    		array_push($sensornames, trim($sensnames[0]));
								    		break;
								    	}
								    }
								}
								else{
									$textdata=explode(PHP_EOL, $myfile);
									$txtdata=array();
									foreach($textdata as $d){
								      $d = explode('-', $d);
								      $txtdata[]=$d;
								    }

								    $sensornames=array();
								    for($k=0;$k<count($txtdata);$k++){
								    	for($l=0;$l<count($txtdata[$k]);$l++){
								    		$sensnames=explode(",", $txtdata[$k][0]);
								    		array_push($sensornames, trim($sensnames[0]));
								    		break;
								    	}
								    }
								}
								
								$sql_query1="SELECT \"Sensor\" FROM \"SensorValues\" where \"StationFullName\"='$stn_name' order by \"Sensor\" desc";
								$result_set1=pg_query($sql_query1);
								$testvalue=array();
									if(pg_num_rows($result_set1)>0)
									{	
									    while($row=pg_fetch_row($result_set1))
									    {
											for($k=0;$k<count($sensornames);$k++){
												if($row[0]==$sensornames[$k]){
													$test=1;
													break;
												}
												else{
													$test=0;
												}
											}
											array_push($testvalue, $test);
										}
									}
							?>
	     					<select name="SensorList"  id="SensorList" 
	     						<?php 
	     							if (isset($_GET['report_type'])) {
			      						if (trim($_GET['report_type'])=="Rain") {
			      							echo "class='form-control'";
			     						}
			  							else
			     						{
			      							echo "class='selectpicker' multiple=''";
			    						}
		     						} 
		     						else 
		     							echo "class='selectpicker' multiple=''";
	 							?>>
	    						<?php 
									$result_set1=pg_query($sql_query1);
									$tempparams=explode(';', trim($_GET['PARAMS']));

									for ($g=0; $g <count($tempparams) ; $g++) {
										if(($tempparams[$g]=='Annual Rainfall')||($tempparams[$g]=='Rainfall Annual')||($tempparams[$g]=='Rain')){
									    		$temp_position=$g;
									    	}
									}
									
									if(pg_num_rows($result_set1)>0)
									{
										$k=0;
									    while($row=pg_fetch_row($result_set1))
									    {
											?>
											<option value='<?php echo $row[0]?>' 
												<?php 
													if (isset($_GET['PARAMS'])) 
													{
														$temp=explode(';', trim($_GET['PARAMS']));
														for ($i=0; $i <count($temp) ; $i++) { 
															if ($temp[$i]===trim($row[0])) 

															{ 
																echo 'selected';
															}
														} 
													}
													if($testvalue[$k]==0){
														echo 'disabled';
													}
												?> 
												> 
												<?php echo $row[0]?> 
											</option>
											<?php
											$k++;
										}
									}
	    									?>
	    					</select>
	    				</div>
					    <div class="col-md-2" style="margin-top: -5px;">  
	    					<table id="daily_table">
	      						<tr>
	      							<td class="pad">
										<label >Date</label>
										<?php 
											if (isset($_GET['FY'])&&isset($_GET['FM'])&&isset($_GET['FD'])) {
	    
	      										$da= strtotime( $_GET['FY'].'/'.$_GET['FM'].'/'.$_GET['FD']);
	  										
	    									}
	    								?>
	      							</td>
	      							<td>
	     								<input type="date" name="EditStartDate" id="EditStartDate" class="form-control" required value="<?php if(isset($da)) { echo date('Y-m-d',$da);} ?>" onChange="emptyHours()">
									</td>
								</tr>
							</table> 

							<table id="month_table" style="display: none">
								<tr>
								    <td>
									    <select class="form-control" id="months">
									    	<option value="1" <?php selected("FM","1"); ?> >January</option>
									    	<option value="2" <?php selected("FM","2"); ?>>February</option>
									      	<option value="3" <?php selected("FM","3"); ?>>March</option>
									      	<option value="4" <?php selected("FM","4"); ?>>April</option>
									      	<option value="5" <?php selected("FM","5"); ?>>May</option>
									      	<option value="6" <?php selected("FM","6"); ?>>June</option>
									      	<option value="7" <?php selected("FM","7"); ?>>July</option>
									      	<option value="8" <?php selected("FM","8"); ?>>August</option>
									      	<option value="9" <?php selected("FM","9"); ?>>September</option>
									      	<option value="10" <?php selected("FM","10"); ?>>October</option>
									      	<option value="11" <?php selected("FM","11"); ?>>November</option>
									       	<option value="12" <?php selected("FM","12"); ?>>December</option>
								      	</select>
		      							<?php 
		      								function selected($key,$value)
		      								{
										        if (isset($_GET["$key"])) {
										        	if (trim($_GET["$key"])==trim($value)) {
										            	echo ("selected");
										          	}  
										        }
									        } 
									    ?>
		    						</td>
		    						<td>
		      							<select class="form-control" id="years">
									      	<option value="2017" <?php selected("FY","2017"); ?>>2017</option>
									      	<option value="2018" <?php selected("FY","2018"); ?>>2018</option>
									      	<option value="2019" <?php selected("FY","2019"); ?>>2019</option>
									      	<option value="2020" <?php selected("FY","2020"); ?>>2020</option>
									      	<option value="2021" <?php selected("FY","2021"); ?>>2021</option>
									      	<option value="2022" <?php selected("FY","2022"); ?>>2022</option>
									      	<option value="2023" <?php selected("FY","2023"); ?>>2023</option>
									      	<option value="2024" <?php selected("FY","2024"); ?>>2024</option>
									      	<option value="2025" <?php selected("FY","2025"); ?>>2025</option>
									      	<option value="2026" <?php selected("FY","2026"); ?>>2026</option>
									      	<option value="2027" <?php selected("FY","2027"); ?>>2027</option>
		        							<option value="2028" <?php selected("FY","2028"); ?>>2028</option>
									    </select>
		    						</td>
		  						</tr>
	  						</table>

							<table id="Annual_table" style="display: none">
								<tr>
								    <td>
									    <select class="form-control" id="Annual_years" style="width: 200px;">
										    <option value="2017" <?php selected("FY","2017"); ?>>2017</option>
										    <option value="2018" <?php selected("FY","2018"); ?>>2018</option>
										    <option value="2019" <?php selected("FY","2019"); ?>>2019</option>
										    <option value="2020" <?php selected("FY","2020"); ?>>2020</option>
										    <option value="2021" <?php selected("FY","2021"); ?>>2021</option>
										    <option value="2022" <?php selected("FY","2022"); ?>>2022</option>
										    <option value="2023" <?php selected("FY","2023"); ?>>2023</option>
										    <option value="2024" <?php selected("FY","2024"); ?>>2024</option>
										    <option value="2025" <?php selected("FY","2025"); ?>>2025</option>
										    <option value="2026" <?php selected("FY","2026"); ?>>2026</option>
										    <option value="2027" <?php selected("FY","2027"); ?>>2027</option>
										    <option value="2028" <?php selected("FY","2028"); ?>>2028</option>
									    </select>
								    </td>
								</tr>
							</table>
	     				</div>
	    				<div class="col-md-1" > 
	    					<table>
	    						<tr>
	    							<td style="padding-top: 3px" >
	    								<input type="button"  onclick="PlotGraph()" title="get report!" class="btn btn-sm btn-primary" name="btnPlot" value="Get"> 
	    							</td>
									<td class="pad" id="pad">
            							<img src="assets/images/excel.png" id="btnExport" title="export to excel!" onclick="exportTableToExcel();" >
          							</td>
          							<td class="pad" id="pad">
            							<img  src="assets/images/pdf.png" id="exporttopdf" onclick="demoFromHTML()" title="export to pdf!" >
          							</td>
								</tr>
							</table>
	    				</div>
	    			</div>
				</div>
			</center>
		</form>
		<script type="text/javascript">
			window.onload=function(){
				hideshow();
			};
			function hideshow()
			{
  				var val=$("#type_of_report").val();
				if (val.trim()=="Monthly") {
			        $("#month_table").css("display","");
			        $("#daily_table").attr("value", "dd-mm-yyyy");
			        $("#daily_table").css("display","none");
			        $("#Annual_table").css("display","none");
   					$("#details").html(val+" Summary for "+$("#months option:selected").text()+" "+$("#years option:selected").text());
      			}
			    else if(val.trim()=="Daily")
			    {
                	$("#Annual_table").css("display","none");
			        $("#month_table").css("display","none");
			        $("#daily_table").css("display","");
			        $("#details").html(val+" Summary for "+$("#EditStartDate").val());
      			}
      			else if(val.trim()=="Annual")
      			{
       				$("#month_table").css("display","none");
        			$("#daily_table").attr("value", "dd-mm-yyyy");
        			$("#daily_table").css("display","none");
        			$("#Annual_table").css("display","");
   					$("#details").html(val+" Summary for "+$("#Annual_years option:selected").text());      
 				}
			}
		</script>
	
	<?php
		if (isset($_GET["PARAMS"]))
		{
			$tempParam = trim($_GET["PARAMS"]);
			$PARAMS=explode(';' ,$tempParam);
			
			
			for ($i=0; $i < count($PARAMS) ; $i++) 
			{
				if($PARAMS[$i]!=''){ 
					$row=pg_fetch_array(pg_query("select \"SensorType\",\"SHEF\",\"Sensor\" from \"SensorValues\" where \"StationFullName\"='$stn_name' and \"Sensor\"='$PARAMS[$i]'"));
					if ($row[0]=="Real")
					{
						$realsensors.=$row[1].";";
						
						$r_sensor_names.=$row[2].";";
						
					}
					else
					{
						$vertualsensors.=$row[1].";";
						
					  	$v_sensor_names.=$row[2].";";
					  	
					}
				}
			}
			$station=getStationShef(trim($_GET['station']));
			$stn_type_set=pg_query("SELECT \"StationType\" FROM \"tblStationType\"");
		  	$stn_name="";
		  	if(pg_num_rows($stn_type_set)>0)
		  	{
		    	while($table_name=pg_fetch_array($stn_type_set))
		    	{
		      		$tbl=$table_name['StationType'];
		      		$stn_set=pg_query("SELECT \"Station_Full_Name\" FROM \"$tbl\" where \"Station_Shef_Code\"='$station'");
		      		if(pg_num_rows($stn_set)>0)
		      		{
		        		$name=pg_fetch_array($stn_set);
		        		$stn_name=$name['Station_Full_Name'];
		      		}
		    	}
		  	}
		
			$sensorCondition='';
		  	for($i=0;$i<count($PARAMS);$i++){
		    	if($PARAMS[$i]!=""){
		      		$sensorCondition.="\"Sensor\"='$PARAMS[$i]' or";
		    	}
		  	}

			$paramsshef=explode(";", $realsensors);
		  	$HydroMetShefCodeCodition='';
		  	for ($i=0; $i <count($paramsshef); $i++) { 
		    	if (trim($paramsshef[$i])!="") {
		      		$result_set=  pg_query("SELECT \"HydroMetParamsTypeId\" FROM \"tblHydroMetParamsType\" where \"HydroMetShefCode\" = '$paramsshef[$i]'");
		      		$row=pg_fetch_array($result_set);
		      		$HydroMetShefCodeCodition.=" a.\"HydroMetParamsTypeId\"=$row[0] or";
		    	}
		  	}

		  	$paramsshefVirtual=explode(";", $vertualsensors);
		  	$HydroMetShefCodeCoditionVirtual='';
		  	for ($i=0; $i <count($paramsshefVirtual); $i++) { 
		    	if (trim($paramsshefVirtual[$i])!="") {
		      		$result_set=  pg_query("SELECT \"HydroMetParamsTypeId\" FROM \"tblHydroMetParamsType\" where \"HydroMetShefCode\" = '$paramsshefVirtual[$i]'");
		      		$row=pg_fetch_array($result_set);
		      		$HydroMetShefCodeCoditionVirtual.=" a.\"HydroMetParamsTypeId\"=$row[0] or";
		    	}
		  	}

		  	$HydroMetShefCodeCoditionVirtual=rtrim($HydroMetShefCodeCoditionVirtual ,'or');
		  	$HydroMetShefCodeCodition=rtrim($HydroMetShefCodeCodition ,'or');
		  	$sensorCondition=rtrim($sensorCondition ,'or');
		  	
		  	$settings=pg_fetch_array(pg_query("select \"DateFormat\",\"DecimalPlaces\" from \"tblLogo\""));
			$setting=$settings[1];
			if($_GET['type']=="Daily"){

				$FY = trim($_GET["FY"]);
				$FY = substr($FY, -2);
				
				$FM = trim($_GET["FM"]);
				
				$FD = trim($_GET["FD"]);
				
				$result_table=  pg_query("SELECT * FROM \"tblAllTables\" where \"TableName\" like '%".$station."_$FY%'");
	  			if (isset($result_table)) 
				{
				   	$stn_id=  pg_query("SELECT \"StationId\" FROM \"tblStation\" where \"StationName\"='$station'");
				   	$id_row=pg_fetch_array($stn_id);
				   	$s_id= $id_row['StationId'];
				   	$sensor_count=0;
				   	
				   	while ($tablerows=pg_fetch_array($result_table)) {
				   		$table="'".$tablerows['TableName']."'";
				   		
				   		$sql_query_real="SELECT * FROM crosstab ('SELECT  (''20''||\"Year\"::text ||''-''|| \"Month\"::text ||''-''|| \"Day\" ::text ||'' ''|| \"Hour\"::text || '':'' || \"Minute\" ::text ||'':'' ||\"Second\")::timestamp  as t,\"HydroMetParamsTypeId\", \"Value\" FROM  \"'$table'\" a where ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY,$FM,$FD) AND ($FY,$FM,$FD)) and a.\"StationId\"=$s_id and ($HydroMetShefCodeCodition) order by 1 ','SELECT distinct \"HydroMetParamsTypeId\" FROM \"'$table'\" as a WHERE ($HydroMetShefCodeCodition)') AS final_result(t timestamp";

	        			$col_set=pg_query("SELECT distinct \"HydroMetParamsTypeId\" FROM \"$table\" as a WHERE ($HydroMetShefCodeCodition)");
	      
	        			while ($cols=pg_fetch_array($col_set)) { 
			          		$sql_query_real.=",\"".$cols[0]."\" double precision";
			        	}
				   		$sql_query_real.=")";

				   		$sql_query_virtual="SELECT * FROM crosstab ('SELECT  (''20''||\"Year\"::text ||''-''||\"Month\"::text ||''-''|| \"Day\" ::text ||'' ''||\"Hour\"::text || '':'' || \"Minute\" ::text ||'':'' ||\"Second\")::timestamp  as t,\"HydroMetParamsTypeId\", \"VirtualValue\" FROM \"'$table'\" a where ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY,$FM,$FD) AND ($FY,$FM,$FD)) and a.\"StationId\"=$s_id and  \"sensortype\"=''Virtual'' and ($HydroMetShefCodeCoditionVirtual) order by 1','SELECT distinct \"HydroMetParamsTypeId\" FROM \"'$table'\" as a where \"sensortype\"=''Virtual'' AND ($HydroMetShefCodeCoditionVirtual)') AS final_result(t timestamp";

	        			$col_set=pg_query("SELECT distinct \"HydroMetParamsTypeId\" FROM \"$table\" as a where a.\"sensortype\"='Virtual' AND ($HydroMetShefCodeCoditionVirtual)");

	        			while ($cols=pg_fetch_array($col_set)) { 
	          				$sql_query_virtual.=",\"".$cols[0]."\" double precision";
	        			}
				   		$sql_query_virtual.=")";
				   		$sql_query="select t2.t";
				   		$col_set=pg_query("select \"SHEF\",\"SensorType\" FROM \"SensorValues\" where (\"StationFullName\"= '$stn_name') and ($sensorCondition) order by \"Sensor\" desc");
				   		while ($cols=pg_fetch_array($col_set)) 
	        			{
	          				$counted=count($PARAMS)-1;
	          				$col=pg_fetch_array(pg_query("SELECT  \"HydroMetParamsTypeId\" FROM \"tblHydroMetParamsType\" where  \"HydroMetShefCode\"='$cols[0]'"));
	        
	          				if (trim($cols[1])=='Real') 
	          				{
	            				if(pg_num_rows(pg_query("select distinct \"HydroMetParamsTypeId\" FROM  \"$table\" a where ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY,$FM,$FD) AND ($FY,$FM,$FD)) and a.\"StationId\"=$s_id  and \"HydroMetParamsTypeId\"=$col[0] order by 1 asc"))>0)
	            				{
	              					$sql_query .=",t1.\"$col[0]\"" ;
	              					$sensor_count++;
	            				}
	            				else{
	              					$colum=$col[0];
	            				}
	          				}
	          				else
	          				{
	            				if(pg_num_rows(pg_query("select distinct \"HydroMetParamsTypeId\" FROM  \"$table\" a where ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY,$FM,$FD) AND ($FY,$FM,$FD)) and a.\"StationId\"=$s_id  and \"HydroMetParamsTypeId\"=$col[0] and \"sensortype\"='Virtual' order by 1 asc"))>0)
	            				{
	              					$sql_query .=",t2.\"$col[0]\"";
	              					$sensor_count++;
	            				}
	            				else{
	              					$colum=$col[0];
	            				}
	          				}
	        			}
	        			if($sensor_count!=""){
	        
				        	if($sensor_count<$counted){
				          
				            	$sql_query.=",NULL as \"$colum\"";
				          
				          	}
				        }
				        $sql_query=rtrim($sql_query,",");
	        			if($realsensors!=''){
	         
	          				$sql_query.=" from (".$sql_query_real.") t1 FULL OUTER JOIN (".$sql_query_virtual.") t2 on t2.t=t1.t order by t2.t asc";
	         			}
	        			else{
	          				$sql_query=$sql_query_virtual;
	        			}
	      
	        			if(pg_num_rows(pg_query("SELECT distinct \"HydroMetParamsTypeId\" FROM \"$table\" as a where a.\"sensortype\"='Virtual' and ($HydroMetShefCodeCoditionVirtual)"))<=0)
	        			{
	          				$sql_query="select t1.t";
	        
	          				$col_set=pg_query("select \"SHEF\",\"SensorType\" FROM \"SensorValues\" where (\"StationFullName\"= '$stn_name') and ($sensorCondition) order by \"Sensor\" desc");
	          				while ($cols=pg_fetch_array($col_set)) 
	          				{
	            				$counted=count($PARAMS)-1;
	            				$col=pg_fetch_array(pg_query("SELECT  \"HydroMetParamsTypeId\"   FROM \"tblHydroMetParamsType\" where  \"HydroMetShefCode\"='$cols[0]'"));

	            				if (trim($cols[1])=='Real') 
	            				{
	              					if(pg_num_rows(pg_query("select distinct \"HydroMetParamsTypeId\" FROM  \"$table\" a where ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY,$FM,$FD) AND ($FY,$FM,$FD)) and a.\"StationId\"=$s_id  and \"HydroMetParamsTypeId\"=$col[0] order by 1 desc"))>0)
	              					{
	                					$sql_query .=",t1.\"$col[0]\"" ;
	                					$sensorcount++;
	              					}
	              					else
	              					{
	                					$colum=$col[0];
	              					}
	            				}
	          				}
	        
	          				if($sensorcount!=""){
	          
	            				if($sensorcount<$counted)
	            				{
	            
	              					$sql_query.=",NULL as \"$colum\"";
	            
	            				}
	         
	          				}
	          				$sql_query.=" from (".$sql_query_real." ) t1";
	        			}
	        			$result_set=$sql_query;
	        			//echo $result_set;	
				   	}
				}
				?>
				<script>
				    document.getElementById("btnExport").style.display = 'block';
				    document.getElementById("exporttopdf").style.display = 'block';    
				</script>
				<div class="col-md-12" id="customtable">
					<center>
						<h3><b><?php echo $_GET['station']; ?></b></h3>
						<h4>Daily Report : <b><?php echo getmonthname($_GET['FM'])." ".$_GET['FD'].", ".$_GET['FY']; ?></b></h4>
						<table align="center" style="max-width:99%;min-width:50%" class=" table-responsive table-bordered" id="table">
							<tr>
	      						<th style="background-color:#539CCC;color:white;text-align:center;font-size: 16px;width:350px">Date / Time</th>
								<?php
									$sensororder=array();
	      							$result_sensor1=(pg_query("select \"Sensor\",\"Units\",\"SensorType\",\"SHEF\" from \"SensorValues\" where (\"StationFullName\"= '$stn_name') and ($sensorCondition) order by \"Sensor\" desc"));
	      							$sensor_position=0;
	      							while ($sensor_row=pg_fetch_array($result_sensor1)) 
	      							{
	        							$sql="";
	        							if (trim($sensor_row[2])=="Real")
	        							{
	    
	          								$col=pg_fetch_array(pg_query("SELECT  \"HydroMetParamsTypeId\"   FROM \"tblHydroMetParamsType\" where  \"HydroMetShefCode\"='$sensor_row[3]'"));
	          
	          								$sql=("select distinct \"HydroMetParamsTypeId\" FROM  \"$table\" a where ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY,$FM,$FD) AND ($FY,$FM,$FD)) and a.\"StationId\"=$s_id  and \"HydroMetParamsTypeId\"=$col[0] order by 1 desc");
	        							}
	        							else
	        							{
	          								$col=pg_fetch_array(pg_query("SELECT  \"HydroMetParamsTypeId\"   FROM \"tblHydroMetParamsType\" where  \"HydroMetShefCode\"='$sensor_row[3]'"));
	          								$sql="select distinct \"HydroMetParamsTypeId\" FROM  \"$table\" a where ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY,$FM,$FD) AND ($FY,$FM,$FD)) and a.\"StationId\"=$s_id  and \"HydroMetParamsTypeId\"=$col[0]  and \"sensortype\"='Virtual' order by 1 desc";
	        							}
		        						if(pg_num_rows(pg_query($sql))>=0)
	        							{
	        								if (isset($sensor_row[0])){
	        									if($sensor_row[0]!=''){
			          							if(($sensor_row[0]=='Annual Rainfall')||($sensor_row[0]=='Rain')){
			          								$sens_name=$sensor_row[0];
			          								$postion=$sensor_position;
			          								$symbol=$sensor_row[1];
			          								continue;
			          							}
			          							else{
								?>
	          						<th style="background-color:#539CCC;color:white;text-align:center;font-size: 13px;">
									<?php $sensor_position++;
	          								echo $sensor_row[0];
	          								if ($sensor_row[1]!="") 
	          									echo" (".$sensor_row[1].")";
	          								array_push($sensororder,$sensor_row[0]);
	          						?>
	          						</th>
	          						<?php 			
													}
	          									}
	          								} 
	        							}
	      							}
	      							if($sens_name!=''){
									?>
									<th style="background-color:#539CCC;color:white;text-align:center;font-size: 13px;">
	          						<?php echo $sens_name." (".$symbol.")";array_push($sensororder,$sens_name);?>
	          						</th>
	          						<?php
	          						}
	          						?>
	    					</tr>
	    					<?php
	    						$results=pg_query($result_set);
	    						$array_values[]=array();
	    						if (isset($results)) {

	    							if(pg_num_rows($results)>0)
	    							{
	  									$rowcount=0;
								      	$settings=pg_fetch_array(pg_query("select \"DateFormat\",\"DecimalPlaces\" from \"tblLogo\""));  
								      	while($row=pg_fetch_row($results))
								      	{	
								      		if($rowcount==0){

								      			$tempdate = strtotime(trim($row[0]));
								      			$tdate= date($tempdate);
								      			$Y=date('Y',$tempdate);
								      			$Y=substr($Y, -2);
								      			$M=date('m',$tempdate);
								      			$D=date('d',$tempdate);
								      			$sensshef=getSensorShef($stn_name,$sens_name);
								      			
								      			$col=pg_fetch_array(pg_query("SELECT  \"HydroMetParamsTypeId\"   FROM \"tblHydroMetParamsType\" where  \"HydroMetShefCode\"='$sensshef'"));
	          									
	          									$sql=pg_fetch_array(pg_query("select \"Value\" FROM  \"$table\" a where ((\"Year\" ,\"Month\", \"Day\")<($Y,$M,$D)) and a.\"StationId\"=$s_id and \"HydroMetParamsTypeId\"=$col[0] order by 1 desc"));
								      			
								      			$tempvalue=$sql[0];
								      			$tmp=$tempvalue;
								      			$rowcount=1;
								      		}
								        	if($row[0]!=""){
									        	$row_count=1;
							?>
					        <tr>
					        	<td style="text-align:center;font-size: 13px;height: 14px;width:350px"><?php if (isset($row[0])){ if (trim($row[0])!="icon.png"){$date = strtotime(trim($row[0]));echo date(trim($settings[0]), $date); }}?></td>       
							<?php 
									        	$result_sensor1=pg_query("select \"Sensor\",\"Units\" from \"SensorValues\" where (\"StationFullName\"= '$stn_name') and ($sensorCondition)");
									        	$sensor_row=pg_num_rows(($result_sensor1));

									        	for ($i=0; $i <$sensor_row; $i++)
									        	{ 
									        		
									        		if($postion!=''){
									        			if($postion<$sensor_row){
										        			if((($sensor_row-1)-$postion)==1){
										        				if($i==$postion){
										        				?>
										        					<td style="text-align:center;font-size: 13px;height: 14px;"><?php if (isset($row[$row_count+1])){ echo number_format(floatval($row[$row_count+1]),$settings[1]);}?></td>
												        			<td style="text-align:center;font-size: 13px;height: 14px;"><?php if (isset($row[$row_count])){ echo number_format(floatval($row[$row_count]-$tempvalue),$settings[1]);}?></td>
												        			
										        				<?php
										        					$array_values[$i][]=number_format(floatval($row[$row_count+1]),$settings[1]);
										        					$array_values[$i+1][]=number_format(floatval($row[$row_count]-$tempvalue),$settings[1]);$tempvalue=$row[$row_count];
										        					break;
										        				}
										        			}
										        			else if((($sensor_row-1)-$postion)==2){
										        				if($i==$postion){
										        				?>
										        					<td style="text-align:center;font-size: 13px;height: 14px;"><?php if (isset($row[$row_count+1])){ echo number_format(floatval($row[$row_count+1]),$settings[1]);}?></td>
										        					<td style="text-align:center;font-size: 13px;height: 14px;"><?php if (isset($row[$row_count+2])){ echo number_format(floatval($row[$row_count+2]),$settings[1]);}?></td>
												        			<td style="text-align:center;font-size: 13px;height: 14px;"><?php if (isset($row[$row_count])){ echo number_format(floatval($row[$row_count]-$tempvalue),$settings[1]);}?></td>
												        			
										        				<?php
										        					$array_values[$i][]=number_format(floatval($row[$row_count+1]),$settings[1]);
										        					$array_values[$i+1][]=number_format(floatval($row[$row_count+2]),$settings[1]);
										        					$array_values[$i+2][]=number_format(floatval($row[$row_count]-$tempvalue),$settings[1]);$tempvalue=$row[$row_count];
										        					break;
										        				}
										        			}
										        			else if((($sensor_row-1)-$postion)==3){
										        				if($i==$postion){
										        				?>
										        					<td style="text-align:center;font-size: 13px;height: 14px;"><?php if (isset($row[$row_count+1])){ echo number_format(floatval($row[$row_count+1]),$settings[1]);}?></td>
										        					<td style="text-align:center;font-size: 13px;height: 14px;"><?php if (isset($row[$row_count+2])){ echo number_format(floatval($row[$row_count+2]),$settings[1]);}?></td>
										        					<td style="text-align:center;font-size: 13px;height: 14px;"><?php if (isset($row[$row_count+3])){ echo number_format(floatval($row[$row_count+3]),$settings[1]);}?></td>
												        			<td style="text-align:center;font-size: 13px;height: 14px;"><?php if (isset($row[$row_count])){ echo number_format(floatval($row[$row_count]-$tempvalue),$settings[1]);}?></td>
												        			
										        				<?php
										        					$array_values[$i][]=number_format(floatval($row[$row_count+1]),$settings[1]);
										        					$array_values[$i+1][]=number_format(floatval($row[$row_count+2]),$settings[1]);
										        					$array_values[$i+2][]=number_format(floatval($row[$row_count+3]),$settings[1]);
										        					$array_values[$i+3][]=number_format(floatval($row[$row_count]-$tempvalue),$settings[1]);$tempvalue=$row[$row_count];
										        					break;
										        				}
										        			}
										        			else if((($sensor_row-1)-$postion)==4){
										        				if($i==$postion){
										        				?>
										        					<td style="text-align:center;font-size: 13px;height: 14px;"><?php if (isset($row[$row_count+1])){ echo number_format(floatval($row[$row_count+1]),$settings[1]);}?></td>
										        					<td style="text-align:center;font-size: 13px;height: 14px;"><?php if (isset($row[$row_count+2])){ echo number_format(floatval($row[$row_count+2]),$settings[1]);}?></td>
										        					<td style="text-align:center;font-size: 13px;height: 14px;"><?php if (isset($row[$row_count+3])){ echo number_format(floatval($row[$row_count+3]),$settings[1]);}?></td>
										        					<td style="text-align:center;font-size: 13px;height: 14px;"><?php if (isset($row[$row_count+4])){ echo number_format(floatval($row[$row_count+4]),$settings[1]);}?></td>
												        			<td style="text-align:center;font-size: 13px;height: 14px;"><?php if (isset($row[$row_count])){ echo number_format(floatval($row[$row_count]-$tempvalue),$settings[1]);}?></td>
												        			
										        				<?php
										        					$array_values[$i][]=number_format(floatval($row[$row_count+1]),$settings[1]);
										        					$array_values[$i+1][]=number_format(floatval($row[$row_count+2]),$settings[1]);
										        					$array_values[$i+2][]=number_format(floatval($row[$row_count+3]),$settings[1]);
										        					$array_values[$i+3][]=number_format(floatval($row[$row_count+4]),$settings[1]);
										        					$array_values[$i+4][]=number_format(floatval($row[$row_count]-$tempvalue),$settings[1]);$tempvalue=$row[$row_count];
										        					break;
										        				}
										        			}
										        			else if((($sensor_row-1)-$postion)==5){
										        				if($i==$postion){
										        				?>
										        					<td style="text-align:center;font-size: 13px;height: 14px;"><?php if (isset($row[$row_count+1])){ echo number_format(floatval($row[$row_count+1]),$settings[1]);}?></td>
										        					<td style="text-align:center;font-size: 13px;height: 14px;"><?php if (isset($row[$row_count+2])){ echo number_format(floatval($row[$row_count+2]),$settings[1]);}?></td>
										        					<td style="text-align:center;font-size: 13px;height: 14px;"><?php if (isset($row[$row_count+3])){ echo number_format(floatval($row[$row_count+3]),$settings[1]);}?></td>
										        					<td style="text-align:center;font-size: 13px;height: 14px;"><?php if (isset($row[$row_count+4])){ echo number_format(floatval($row[$row_count+4]),$settings[1]);}?></td>
										        					<td style="text-align:center;font-size: 13px;height: 14px;"><?php if (isset($row[$row_count+5])){ echo number_format(floatval($row[$row_count+5]),$settings[1]);}?></td>
												        			<td style="text-align:center;font-size: 13px;height: 14px;"><?php if (isset($row[$row_count])){ echo number_format(floatval($row[$row_count]-$tempvalue),$settings[1]);}?></td>
												        			
										        				<?php
										        					$array_values[$i][]=number_format(floatval($row[$row_count+1]),$settings[1]);
										        					$array_values[$i+1][]=number_format(floatval($row[$row_count+2]),$settings[1]);
										        					$array_values[$i+2][]=number_format(floatval($row[$row_count+3]),$settings[1]);
										        					$array_values[$i+3][]=number_format(floatval($row[$row_count+4]),$settings[1]);
										        					$array_values[$i+4][]=number_format(floatval($row[$row_count+5]),$settings[1]);
										        					$array_values[$i+5][]=number_format(floatval($row[$row_count]-$tempvalue),$settings[1]);$tempvalue=$row[$row_count];
										        					break;
										        				}
										        			}
										        			
										        		}
									        		}
									        		if($postion!=''){
									 					if($i==$postion){
									 						?>
									 						<td style="text-align:center;font-size: 13px;height: 14px;"><?php if (isset($row[$row_count])){ echo number_format(floatval($row[$row_count]-$tempvalue),$settings[1]);}?></td>
											        			
									        			<?php
									        				$array_values[$i][]=number_format(floatval($row[$row_count]-$tempvalue),$settings[1]);$tempvalue=$row[$row_count];
									        				break;
									 					}
									 					else{

							?>                                
	          					<td style="text-align:center;font-size: 13px;height: 14px;"><?php if (isset($row[$row_count])){ echo number_format(floatval($row[$row_count]),$settings[1]);}?></td> 
							<?php
									$array_values[$i][]=number_format(floatval($row[$row_count]),$settings[1]);
														}
													}
													else{
														?>                                
	          					<td style="text-align:center;font-size: 13px;height: 14px;"><?php if (isset($row[$row_count])){ echo number_format(floatval($row[$row_count]),$settings[1]);}?></td> 
							<?php
									$array_values[$i][]=number_format(floatval($row[$row_count]),$settings[1]);
													}
	        										$row_count=$row_count+1;
	      										}
							?>
	      					</tr>
							<?php    
	    									}
	  									}
									}
									else
									{
	  						?>
	  							<tr><td>No Data Found!</td></tr>
	  						<?php
									}
								}
								
	    					?>
							<th style="background-color:#539CCC;color:white;text-align:center;font-size: 13px;padding: 4px;" colspan="<?php echo $sensor_row+1; ?>">Summary</th>
							<?php
								
								$sumarynames[]=array();

								for($k=0;$k<count($txtdata);$k++){
								  	for($l=0;$l<count($txtdata[$k]);$l++){
								    	$sumarynames[$k]=explode(",", $txtdata[$k][1]);
								    	
								    }
								}
							?>
							<tr>
								<td style="background-color:#539CCC;color:white;text-align:center;font-size: 13px;">Min</td>
							<?php
								for($i=0;$i<count($sensororder);$i++){
									if($sensororder[$i]!=''){
										?>
											<td style="text-align:center;font-size: 13px;height: 14px;"><?php echo min($array_values[$i]); ?></td>
										<?php
									}
								}	
							?>
							</tr>
							<tr>
								<td style="background-color:#539CCC;color:white;text-align:center;font-size: 13px;">Max</td>
							<?php
								for($i=0;$i<count($sensororder);$i++){
									if($sensororder[$i]!=''){
										?>
											<td style="text-align:center;font-size: 13px;height: 14px;"><?php echo max($array_values[$i]); ?></td>
										<?php
									}
								}
							?>
							</tr>
							<tr>
								<td style="background-color:#539CCC;color:white;text-align:center;font-size: 13px;">Avg</td>
							<?php
								for($i=0;$i<count($sensororder);$i++){
									if($sensororder[$i]!=''){
										?>
											<td style="text-align:center;font-size: 13px;height: 14px;"><?php $avg=array_sum($array_values[$i])/count($array_values[$i]); echo number_format(floatval($avg),$settings[1])?></td>
										<?php
									}
								}
							?>
							</tr>
							<?php
								if($sens_name!=''){
							?>
							<tr>
								<td style="background-color:#539CCC;color:white;text-align:center;font-size: 13px;">Total</td>
							<?php
								for($i=0;$i<count($sensororder);$i++){
									if($sensororder[$i]!=''){
										if(($sensororder[$i]=='Annual Rainfall')||($sensororder[$i]=='Rain'))
										{
											?>
												<td style="text-align:center;font-size: 13px;height: 14px;"><?php echo array_sum($array_values[$i]); ?></td>
											<?php
										}
										else{
											?>
												<td style="background-color: #ddd;border: 1px solid white;"></td>
											<?php
										}
									}
								}
							?>
							</tr>
							<?php
								}
							?>
						</table>
					</center>
				</div>
				<?php
			}
			else if($_GET['type']=="Monthly")
			{
				$array_summary[]=array();
				$array_values[][]=array();
				$checkterm[][]=array();
				$FM=trim($_GET['FM']);
				$FY=trim($_GET['FY']);
				$FY=substr($FY, -2);
				$numdays=cal_days_in_month(CAL_GREGORIAN, $FM, $_GET['FY']);

				$Y=date('Y');
				$Y=substr($Y, -2);
				$M=date('m');
				$D=date('d');
				if(($FY==$Y)&&($FM==$M)){
					$numdays=$D;
				}
		
				for($k=1;$k<=$numdays;$k++)
				{
					$FD=$k;
					$result_table=  pg_query("SELECT * FROM \"tblAllTables\" where \"TableName\" like '%".$station."_$FY%'");
		  			if (isset($result_table)) {

					   	$stn_id=  pg_query("SELECT \"StationId\" FROM \"tblStation\" where \"StationName\"='$station'");

					   	$id_row=pg_fetch_array($stn_id);
					   	$s_id= $id_row['StationId'];
					   	$sensor_count=0;
					   	
					   	while ($tablerows=pg_fetch_array($result_table)) {
					   		$table="'".$tablerows['TableName']."'";
					   		if($k==1){
								$sensname=$PARAMS[$temp_position];
								
								$sensshef=getSensorShef($stn_name,$sensname);
								$col=pg_fetch_array(pg_query("SELECT  \"HydroMetParamsTypeId\"   FROM \"tblHydroMetParamsType\" where  \"HydroMetShefCode\"='$sensshef'"));
				          									
				          		$sql=pg_fetch_array(pg_query("select \"Value\" FROM  \"$table\" a where ((\"Year\" ,\"Month\", \"Day\")<($FY,$FM,$FD)) and a.\"StationId\"=$s_id and \"HydroMetParamsTypeId\"=$col[0] order by 1 desc"));
											      		
								$tempvalue=$sql[0];
							}
					   		$sql_query_real="SELECT * FROM crosstab ('SELECT  (''20''||\"Year\"::text ||''-''|| \"Month\"::text ||''-''|| \"Day\" ::text ||'' ''|| \"Hour\"::text || '':'' || \"Minute\" ::text ||'':'' ||\"Second\")::timestamp  as t,\"HydroMetParamsTypeId\", \"Value\" FROM  \"'$table'\" a where ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY,$FM,$FD) AND ($FY,$FM,$FD)) and a.\"StationId\"=$s_id and ($HydroMetShefCodeCodition) order by 1 ','SELECT distinct \"HydroMetParamsTypeId\" FROM \"'$table'\" as a WHERE ($HydroMetShefCodeCodition)') AS final_result(t timestamp";

		        			$col_set=pg_query("SELECT distinct \"HydroMetParamsTypeId\" FROM \"$table\" as a WHERE ($HydroMetShefCodeCodition)");

		        			while ($cols=pg_fetch_array($col_set)) { 
				          		$sql_query_real.=",\"".$cols[0]."\" double precision";
				        	}
					   		$sql_query_real.=")";
					   		
					   		$sql_query_virtual="SELECT * FROM crosstab ('SELECT  (''20''||\"Year\"::text ||''-''||\"Month\"::text ||''-''|| \"Day\" ::text ||'' ''||\"Hour\"::text || '':'' || \"Minute\" ::text ||'':'' ||\"Second\")::timestamp  as t,\"HydroMetParamsTypeId\", \"VirtualValue\" FROM \"'$table'\" a where ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY,$FM,$FD) AND ($FY,$FM,$FD)) and a.\"StationId\"=$s_id and  \"sensortype\"=''Virtual'' and ($HydroMetShefCodeCoditionVirtual) order by 1','SELECT distinct \"HydroMetParamsTypeId\" FROM \"'$table'\" as a where \"sensortype\"=''Virtual'' AND ($HydroMetShefCodeCoditionVirtual)') AS final_result(t timestamp";

		        			$col_set=pg_query("SELECT distinct \"HydroMetParamsTypeId\" FROM \"$table\" as a where a.\"sensortype\"='Virtual' AND ($HydroMetShefCodeCoditionVirtual)");

		        			while ($cols=pg_fetch_array($col_set)) { 
		          				$sql_query_virtual.=",\"".$cols[0]."\" double precision";
		        			}
					   		$sql_query_virtual.=")";

					   		$sql_query="select t2.t";
					   		$col_set=pg_query("select \"SHEF\",\"SensorType\" FROM \"SensorValues\" where (\"StationFullName\"= '$stn_name') and ($sensorCondition) order by \"Sensor\" desc");
					   		while ($cols=pg_fetch_array($col_set)) 
		        			{
		          				$counted=count($PARAMS)-1;
		          				$col=pg_fetch_array(pg_query("SELECT  \"HydroMetParamsTypeId\" FROM \"tblHydroMetParamsType\" where  \"HydroMetShefCode\"='$cols[0]'"));
		        
		          				if (trim($cols[1])=='Real') 
		          				{
		            				if(pg_num_rows(pg_query("select distinct \"HydroMetParamsTypeId\" FROM  \"$table\" a where a.\"StationId\"=$s_id  and \"HydroMetParamsTypeId\"=$col[0] order by 1 asc"))>0)
		            				{
		              					$sql_query .=",t1.\"$col[0]\"" ;
		              					$sensor_count++;
		            				}
		            				else{
		              					$colum=$col[0];
		            				}
		          				}
		          				else
		          				{
		            				if(pg_num_rows(pg_query("select distinct \"HydroMetParamsTypeId\" FROM  \"$table\" a where a.\"StationId\"=$s_id  and \"HydroMetParamsTypeId\"=$col[0] and \"sensortype\"='Virtual' order by 1 asc"))>0)
		            				{
		              					$sql_query .=",t2.\"$col[0]\"";
		              					$sensor_count++;
		            
		            				}
		            				else{
		              					$colum=$col[0];
		            				}
		          				}
		        			}
		        			if($sensor_count!="")
							{
					        	if($sensor_count<$counted){
					          
					            	$sql_query.=",NULL as \"$colum\"";
					          
					          	}
					        }
					        $sql_query=rtrim($sql_query,",");
		        			if($realsensors!=''){
		         
		          				$sql_query.=" from (".$sql_query_real.") t1 FULL OUTER JOIN (".$sql_query_virtual.") t2 on t2.t=t1.t order by t2.t asc";
		         			}
		        			else{
		          				$sql_query=$sql_query_virtual;
		        			}
		      
		        			if(pg_num_rows(pg_query("SELECT distinct \"HydroMetParamsTypeId\" FROM \"$table\" as a where a.\"sensortype\"='Virtual' and ($HydroMetShefCodeCoditionVirtual)"))<=0)
		        			{
		          				$sql_query="select t1.t";
		          				$col_set=pg_query("select \"SHEF\",\"SensorType\" FROM \"SensorValues\" where (\"StationFullName\"= '$stn_name') and ($sensorCondition) order by \"Sensor\" desc");

		          				while ($cols=pg_fetch_array($col_set)) 
		          				{
		            				$counted=count($PARAMS)-1;
		            				$col=pg_fetch_array(pg_query("SELECT  \"HydroMetParamsTypeId\"   FROM \"tblHydroMetParamsType\" where  \"HydroMetShefCode\"='$cols[0]'"));

		            				if (trim($cols[1])=='Real') 
		            				{	
		              					if(pg_num_rows(pg_query("select distinct \"HydroMetParamsTypeId\" FROM  \"$table\" a where a.\"StationId\"=$s_id  and \"HydroMetParamsTypeId\"=$col[0] order by 1 desc"))>0)
		              					{
		                					$sql_query .=",t1.\"$col[0]\"" ;
		                					$sensorcount++;
		              					}
		              					else
		              					{
		                					$colum=$col[0];
		              					}
		            				}
		          				}
		        
		          				if($sensorcount!="")
								{
		            				if($sensorcount<$counted)
		            				{
		              					$sql_query.=",NULL as \"$colum\"";
		            				}
		          				}
		          				$sql_query.=" from (".$sql_query_real." ) t1";
		        			}
		        			$result_set=$sql_query;
					   	}
					}
					$results=pg_query($result_set);
					
     //           echo "<br>";
     //           echo "<br>";
					$pradeep=1;
					while ($row=pg_fetch_row($results)) 
					{
						$row_count=1;
						$c=0;
						$result_sensor1=pg_query("select \"Sensor\",\"Units\" from \"SensorValues\" where (\"StationFullName\"= '$stn_name') and ($sensorCondition)");
						$sensor_row=pg_num_rows($result_sensor1);
						for($i=0;$i<$sensor_row;$i++){
							// echo "hello";
							if($i==$temp_position){
								$checkterm[$k][$c][]=number_format(floatval($row[$row_count]),$settings[1]);
								$c=$c+1;
								
								$array_values[$k][$i][]=number_format(floatval($row[$row_count]),$settings[1])-$tempvalue;

								$tempvalue=number_format(floatval($row[$row_count]),$settings[1]);
								$row_count=$row_count+1;

							}
							else{
								$array_values[$k][$i][]=number_format(floatval($row[$row_count]),$settings[1]);
								$row_count=$row_count+1;
							}

						}	
					}
				}
				// print_r($checkterm);
				
				$sensororder=array();
				?>
				<script>
				    document.getElementById("btnExport").style.display = 'block';
				    document.getElementById("exporttopdf").style.display = 'block';    
				</script>
				<div class="col-md-12" id="customtable">
					<center>
						<h3><b><?php echo $_GET['station']; ?></b></h3>
						<h4>Monthly Report : <b><?php echo getmonthname($_GET['FM']).", ".$_GET['FY']; ?></b></h4>
						<table align="center" style="max-width:99%;min-width:50%" class=" table-responsive table-bordered" id="table">
							<tr>
								<th style="background-color:#539CCC;color:white;text-align:center;font-size: 16px;width:auto;">Date Of Month</th>
								<?php
									$result_sensor1=(pg_query("select \"Sensor\",\"Units\",\"SensorType\",\"SHEF\" from \"SensorValues\" where (\"StationFullName\"= '$stn_name') and ($sensorCondition) order by \"Sensor\" desc"));
									// $sensor_position=0;
									
									while ($sensor_row=pg_fetch_array($result_sensor1)) 
	      							{
	      								for($o=0;$o<count($txtdata);$o++){
	      									if($txtdata[$o][0]==$sensor_row[0]){
	      										$subhead=explode(',', $txtdata[$o][1]);
	      										break;
	      									}
	      								}
	      								$sql="";
	      								if (trim($sensor_row[2])=="Real")
	        							{
	          								$col=pg_fetch_array(pg_query("SELECT  \"HydroMetParamsTypeId\"   FROM \"tblHydroMetParamsType\" where  \"HydroMetShefCode\"='$sensor_row[3]'"));
	          
	          								$sql=("select distinct \"HydroMetParamsTypeId\" FROM  \"$table\" a where ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY,$FM,$FD) AND ($FY,$FM,$FD)) and a.\"StationId\"=$s_id  and \"HydroMetParamsTypeId\"=$col[0] order by 1 desc");
	        							}
	        							else
	        							{
	          								$col=pg_fetch_array(pg_query("SELECT  \"HydroMetParamsTypeId\"   FROM \"tblHydroMetParamsType\" where  \"HydroMetShefCode\"='$sensor_row[3]'"));
	          								$sql="select distinct \"HydroMetParamsTypeId\" FROM  \"$table\" a where ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY,$FM,$FD) AND ($FY,$FM,$FD)) and a.\"StationId\"=$s_id  and \"HydroMetParamsTypeId\"=$col[0]  and \"sensortype\"='Virtual' order by 1 desc";
	        							}
	        							if(pg_num_rows(pg_query($sql))>=0)
	        							{
	        								if (isset($sensor_row[0]))
											{
	        									if($sensor_row[0]!='')
												{
				          							if(($sensor_row[0]=='Rainfall Annual')||($sensor_row[0]=='Rain')){
				          								$sens_name=$sensor_row[0];
				          								$postion=$sensor_position;
				          								$symbol=$sensor_row[1];
				          								$colcount=count($subhead);
				          								continue;
				          							}
				          							else{
				          								?>
				          									<th style="background-color:#539CCC;color:white;text-align:center;font-size: 13px;" colspan="<?php echo count($subhead);?>">
				          										<?php 
				          											$sensor_position++;
							          								echo $sensor_row[0];
							          								if ($sensor_row[1]!="") 
							          									echo" (".$sensor_row[1].")";
							          								array_push($sensororder,$sensor_row[0]);
	          													?>
	          												</th>
				          								<?php
				          							}
				          						}
				          					}
				          				}
	      							}
	      							if($sens_name!='')
									{
	      								?>
	      									<th style="background-color:#539CCC;color:white;text-align:center;font-size: 13px;" colspan="<?php echo $colcount;?>"><?php echo $sens_name." (".$symbol.")";array_push($sensororder,$sens_name);?></th>
	      								<?php
	      							}
								?>
							</tr>
							<tr>
								<th style="background-color:#539CCC;color:white;text-align:center;font-size: 16px;width:auto;"></th>
								<?php
									$result_sensor1=(pg_query("select \"Sensor\",\"Units\",\"SensorType\",\"SHEF\" from \"SensorValues\" where (\"StationFullName\"= '$stn_name') and ($sensorCondition) order by \"Sensor\" desc"));
									$sensor_position=0;
									
									while ($sensor_row=pg_fetch_array($result_sensor1)) 
	      							{
	      								$sql="";
	      								if (trim($sensor_row[2])=="Real")
	        							{
	          								$col=pg_fetch_array(pg_query("SELECT  \"HydroMetParamsTypeId\"   FROM \"tblHydroMetParamsType\" where  \"HydroMetShefCode\"='$sensor_row[3]'"));
	          
	          								$sql=("select distinct \"HydroMetParamsTypeId\" FROM  \"$table\" a where ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY,$FM,$FD) AND ($FY,$FM,$FD)) and a.\"StationId\"=$s_id  and \"HydroMetParamsTypeId\"=$col[0] order by 1 desc");
	        							}
	        							else
	        							{
	          								$col=pg_fetch_array(pg_query("SELECT  \"HydroMetParamsTypeId\"   FROM \"tblHydroMetParamsType\" where  \"HydroMetShefCode\"='$sensor_row[3]'"));
	          								$sql="select distinct \"HydroMetParamsTypeId\" FROM  \"$table\" a where ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY,$FM,$FD) AND ($FY,$FM,$FD)) and a.\"StationId\"=$s_id  and \"HydroMetParamsTypeId\"=$col[0]  and \"sensortype\"='Virtual' order by 1 desc";
	        							}
	        							if(pg_num_rows(pg_query($sql))>=0)
	        							{
	        								for($o=0;$o<count($txtdata);$o++){
	      										if($txtdata[$o][0]==$sensor_row[0]){
	      											$subhead=explode(',', $txtdata[$o][1]);

	      											if (isset($sensor_row[0])){
	        											if($sensor_row[0]!=''){

	        												if(($sensor_row[0]=='Rainfall Annual')||($sensor_row[0]=='Rain')){
	        													$sens_name=$sensor_row[0];
						          								$subth=$subhead;
						          								
						          								continue;
						          							}
						          							else{
						          								for($h=0;$h<count($subhead);$h++){
							          								?>
							          									<th style="background-color:#539CCC;color:white;text-align:center;font-size: 13px;" >
							          										<?php 
							          											echo $subhead[$h];
				          													?>
				          												</th>
							          								<?php
						          								}
						          							}
	        											}
	        										}
	      											break;
	      										}
	      									}
				          				}
	      							}
	      							if($sens_name!=''){
	      								for($h=0;$h<count($subth);$h++){
		      								?>
		      									<th style="background-color:#539CCC;color:white;text-align:center;font-size: 13px;" ><?php echo $subth[$h];?></th>
		      								<?php
	      								}
	      							}
											?>
							</tr>
								<?php
									$result_sensor2=pg_query("select \"Sensor\",\"Units\" from \"SensorValues\" where (\"StationFullName\"= '$stn_name') and ($sensorCondition)");
									$sensor_row_count=pg_num_rows($result_sensor2);
									$PARAMS_Data=array();
									for($f=0;$f<count($PARAMS);$f++){
										if($PARAMS[$f]!=''){
											array_push($PARAMS_Data, $PARAMS[$f]);
										}
									}
									$n=count($PARAMS_Data)-1;
									
									if($temp_position<count($PARAMS_Data)-1){
										if(($n-$temp_position)==1){
											$tp=$PARAMS_Data[$temp_position];
											$PARAMS_Data[$temp_position]=$PARAMS_Data[$n];
											$PARAMS_Data[$n]=$tp;
										}
									}
									
									$str=array();
									for($h=0;$h<$sensor_row_count;$h++){
										if((strpos($PARAMS[$h],"Rainfall Annual")!==false)||(strpos($PARAMS[$h],"Rain")!==false)){
											$check=1;
											array_push($str, $check);
										}
										else{
											$check=0;
											array_push($str, $check);
										}
									}
									
									for($p=1;$p<=$numdays;$p++){
										?>
											<tr>
												<td style="text-align:center;font-size: 13px;height: 14px;"><?php echo $p; ?></td>
												<?php
													$t=0;$e=0;
													for($h=0;$h<$sensor_row_count;$h++){
														$checkmissing=count($array_values[$p][$h]);
														
														for($g=0;$g<count($txtdata);$g++){
															if($str[$h]==0){
																if($txtdata[$g][0]==$PARAMS[$h]){
																	$subs=explode(',', $txtdata[$g][1]);
																	for($d=0;$d<count($subs);$d++){
																		if(trim($subs[$d])=="Min"){
																			$out_min=min($array_values[$p][$h]);
														
																			if($out_min==''){
																				$out_min="-";
																			?>
																				<td style="text-align:center;font-size: 13px;height: 14px;"><?php echo $out_min; ?></td>
																			<?php
																			}
																			else{
																			?>
																				<td style="text-align:center;font-size: 13px;height: 14px;"><?php if($checkmissing<24){ echo number_format(floatval($out_min),$settings[1])."<span class=\"asterisk\">*</span>";}else{echo number_format(floatval($out_min),$settings[1]);} ?></td>
																			<?php
																				if($checkmissing<24){
																					$array_summary[$t][]=number_format(floatval($out_min),$settings[1]);
																					$checksum[$t][]=0;
																				}
																				else{
																					$array_summary[$t][]=number_format(floatval($out_min),$settings[1]);
																					$checksum[$t][]=1;
																				}
																			}
																		}
																		else if(trim($subs[$d])=="Max"){
																			$out_max=max($array_values[$p][$h]);
																			
																			if($out_max==''){
																				$out_max="-";
																			?>
																				<td style="text-align:center;font-size: 13px;height: 14px;"><?php echo $out_max; ?></td>
																			<?php
																			}
																			else{
																			?>
																				<td style="text-align:center;font-size: 13px;height: 14px;"><?php if($checkmissing<24){ echo number_format(floatval($out_max),$settings[1])."<span class=\"asterisk\">*</span>";}else{echo number_format(floatval($out_max),$settings[1]);} ?></td>
																			<?php
																				if($checkmissing<24){
																					$array_summary[$t][]=number_format(floatval($out_max),$settings[1]);
																					$checksum[$t][]=0;
																				}
																				else{
																					$array_summary[$t][]=number_format(floatval($out_max),$settings[1]);
																					$checksum[$t][]=1;
																				}
																			}
																		}
																		else if(trim($subs[$d])=="Avg"){
																			$out_avg=array_sum($array_values[$p][$h])/count($array_values[$p][$h]);
																			//echo $out_avg;
																			
																			if(array_sum($array_values[$p][$h])==''){
																				$out_avg="-";
																			?>
																				<td style="text-align:center;font-size: 13px;height: 14px;"><?php echo $out_avg; ?></td>
																			<?php
																			}
																			else{
																			?>
																				<td style="text-align:center;font-size: 13px;height: 14px;"><?php if($checkmissing<24){ echo number_format(floatval($out_avg),$settings[1])."<span class=\"asterisk\">*</span>";}else{echo number_format(floatval($out_avg),$settings[1]);} ?></td>
																			<?php
																				if($checkmissing<24){
																					$array_summary[$t][]=number_format(floatval($out_avg),$settings[1]);
																					$checksum[$t][]=0;
																				}
																				else{
																					$array_summary[$t][]=number_format(floatval($out_avg),$settings[1]);
																					$checksum[$t][]=1;
																				}
																			}
																		}
																		else if(trim($subs[$d])=="Total"){
																			$out_total=array_sum($array_values[$p][$h]);
																			print_r($array_values[$p][$h]);
																			echo $out_total;
																			if(count($array_values[$p][$h])==0){
                                                            					$out_total="-";
                                                         					?>
                                                            				<td style="text-align:center;font-size: 13px;height: 14px;"><?php echo $out_total; ?></td>
                                                         					<?php

                                                         					}
                                                         						else{
   																			?>
   																				<td style="text-align:center;font-size: 13px;height: 14px;"><?php if($checkmissing<24){ echo number_format(floatval($out_total),$settings[1])."<span class=\"asterisk\">*</span>";}else{echo number_format(floatval($out_total),$settings[1]);} ?></td>
   																			<?php
																				if($checkmissing<24){
																					$array_summary[$t][]=number_format(floatval($out_total),$settings[1]);
																					$checksum[$t][]=0;
																				}
																				else{
																					$array_summary[$t][]=number_format(floatval($out_total),$settings[1]);
																					$checksum[$t][]=1;
																				}
                                                         					}
																		}
																		$t=$t+1;
																		$e=$e+1;
																	}
																}
															}
														}

													}
													for($h=0;$h<$sensor_row_count;$h++)
													{
														for($g=0;$g<count($txtdata);$g++)
														{
															if($str[$h]==1)
															{
																if(($checkterm[$p][0][0]=='')||($checkterm[$p][0][23]=='')){
																	$checkmissingterm=0;
																}
																else{
																	$checkmissingterm=1;
																}
																if($txtdata[$g][0]==$PARAMS[$h]){
																	$subs=explode(',', $txtdata[$g][1]);
																	for($d=0;$d<count($subs);$d++){
																		if(trim($subs[$d])=="Min"){
																			$out_min=min($array_values[$p][$h]);
																			if($out_min==''){
																				$out_min="-";
																			?>
																				<td style="text-align:center;font-size: 13px;height: 14px;"><?php echo $out_min; ?></td>
																			<?php
																			}
																			else{
																			?>
																				<td style="text-align:center;font-size: 13px;height: 14px;">
																					<?php 
																						if($checkmissingterm==0){
																							echo number_format(floatval($out_min),$settings[1])."<span class=\"asterisk\">*</span>";
																						}
																						else{
																							echo number_format(floatval($out_min),$settings[1]);
																						}
																					?>
																				</td>
																			<?php
																				if($checkmissingterm==0){
																					$array_summary[$t][]=number_format(floatval($out_min),$settings[1]);
																					$checksum[$t][]=0;
																				}
																				else{
																					$array_summary[$t][]=number_format(floatval($out_min),$settings[1]);
																					$checksum[$t][]=1;
																				}
																			}
																		}
																		else if(trim($subs[$d])=="Max"){
																			$out_max=max($array_values[$p][$h]);
																			if($out_max==''){
																				$out_max="-";
																			?>
																				<td style="text-align:center;font-size: 13px;height: 14px;"><?php echo $out_max; ?></td>
																			<?php
																			}
																			else{
																			?>
																				<td style="text-align:center;font-size: 13px;height: 14px;"><?php if($checkmissingterm==0){ echo number_format(floatval($out_max),$settings[1])."<span class=\"asterisk\">*</span>";}else{echo number_format(floatval($out_max),$settings[1]);} ?></td>
																			<?php
																				if($checkmissingterm==0){
																					$array_summary[$t][]=number_format(floatval($out_max),$settings[1]);
																					$checksum[$t][]=0;
																				}
																				else{
																					$array_summary[$t][]=number_format(floatval($out_max),$settings[1]);
																					$checksum[$t][]=1;
																				}
																			}
																		}
																		else if(trim($subs[$d])=="Avg"){
																			$out_avg=array_sum($array_values[$p][$h])/count($array_values[$p][$h]);
																			if(array_sum($array_values[$p][$h])==''){
																				$out_avg="-";
																			?>
																				<td style="text-align:center;font-size: 13px;height: 14px;"><?php echo $out_avg; ?></td>
																			<?php
																			}
																			else{
																			?>
																				<td style="text-align:center;font-size: 13px;height: 14px;"><?php if($checkmissingterm==0){ echo number_format(floatval($out_avg),$settings[1])."<span class=\"asterisk\">*</span>";}else{echo number_format(floatval($out_avg),$settings[1]);} ?></td>
																			<?php
																				if($checkmissingterm==0){
																					$array_summary[$t][]=number_format(floatval($out_avg),$settings[1]);
																					$checksum[$t][]=0;
																				}
																				else{
																					$array_summary[$t][]=number_format(floatval($out_avg),$settings[1]);
																					$checksum[$t][]=1;
																				}
																			}
																		}
																		else if(trim($subs[$d])=="Total"){
																			$out_total=array_sum($array_values[$p][$h]);
																			if(count($array_values[$p][$h])==0){
                                                            				$out_total="-";
                                                            				?>
                                                            					<td style="text-align:center;font-size: 13px;height: 14px;"><?php echo $out_total; ?></td>
                                                            				<?php
																		}
																		else{
   																			?>
   																				<td style="text-align:center;font-size: 13px;height: 14px;"><?php if($checkmissingterm==0){ echo number_format(floatval($out_total),$settings[1])."<span class=\"asterisk\">*</span>";}else{echo number_format(floatval($out_total),$settings[1]);} ?></td>
   																			<?php
   																			if($checkmissingterm==0){
   																				$array_summary[$t][]=number_format(floatval($out_total),$settings[1]);
   																				$checksum[$t][]=0;
   																			}
   																			else{
   																				$array_summary[$t][]=number_format(floatval($out_total),$settings[1]);
   																				$checksum[$t][]=1;
   																			}
                                                         }
																		}
																		$t=$t+1;
																	}
																}
															}
														}
														
													}
												?>
											</tr>
										<?php
									}
									// print_r($checksum);
									$diff=$t-$e;
									// echo $t
								?>
								<th style="background-color:#539CCC;color:white;text-align:center;font-size: 13px;padding: 4px;" colspan="<?php echo $t+1; ?>">Summary</th>
								<tr>
									<td style="background-color:#539CCC;color:white;text-align:center;font-size: 13px;">Min</td>
									<?php
										$sn=0;
										for($q=0;$q<count($sensororder);$q++){
											for($v=0;$v<count($txtdata);$v++){
												if($txtdata[$v][0]==$sensororder[$q]){
													$rowsubs=explode(',', $txtdata[$v][1]);
													for($w=0;$w<count($rowsubs);$w++){
														if(trim($rowsubs[$w])=="Min"){
															if(in_array('0', $checksum[$sn])){
																?>
																	<td style="text-align:center;font-size: 13px;height: 14px;"><?php if(min($array_summary[$sn])==''){echo "N/A";}else{echo min($array_summary[$sn])."<span class=\"asterisk\">*</span>";} ?></td>
																<?php
															}
															else{
																?>
																	<td style="text-align:center;font-size: 13px;height: 14px;"><?php if(min($array_summary[$sn])==''){echo "N/A";}else{echo min($array_summary[$sn]);} ?></td>
																<?php
															}
															$sn=$sn+1;
														}
														else{
															?>
																<td style="background-color: #ddd;border: 1px solid white;"></td>
															<?php
															$sn=$sn+1;
														}
													}
												}
											}
										}
									?>
								</tr>
								<tr>
									<td style="background-color:#539CCC;color:white;text-align:center;font-size: 13px;">Max</td>
									<?php
										$sn=0;
										for($q=0;$q<count($sensororder);$q++){
											for($v=0;$v<count($txtdata);$v++){
												if($txtdata[$v][0]==$sensororder[$q]){
													$rowsubs=explode(',', $txtdata[$v][1]);
													for($w=0;$w<count($rowsubs);$w++){
														if(trim($rowsubs[$w])=="Max"){
															if(in_array('0', $checksum[$sn])){
																?>
																	<td style="text-align:center;font-size: 13px;height: 14px;"><?php if(max($array_summary[$sn])==''){echo "N/A";}else{echo max($array_summary[$sn])."<span class=\"asterisk\">*</span>";} ?></td>
																<?php
															}
															else{
																?>
																	<td style="text-align:center;font-size: 13px;height: 14px;"><?php if(min($array_summary[$sn])==''){echo "N/A";}else{echo max($array_summary[$sn]);} ?></td>
																<?php
															}
															$sn=$sn+1;
														}
														else{
															?>
																<td style="background-color: #ddd;border: 1px solid white;"></td>
															<?php
															$sn=$sn+1;
														}
													}
												}
											}
										}
									?>
								</tr>
								<tr>
									<td style="background-color:#539CCC;color:white;text-align:center;font-size: 13px;">Avg</td>
									<?php
										$sn=0;
										for($q=0;$q<count($sensororder);$q++){
											for($v=0;$v<count($txtdata);$v++){
												if($txtdata[$v][0]==$sensororder[$q]){
													$rowsubs=explode(',', $txtdata[$v][1]);
													for($w=0;$w<count($rowsubs);$w++){
														if(trim($rowsubs[$w])=="Avg"){
															if(in_array('0', $checksum[$sn])){
																?>
																	<td style="text-align:center;font-size: 13px;height: 14px;"><?php $outavg=array_sum($array_summary[$sn])/count($array_summary[$sn]);if(array_sum($array_summary[$sn])==''){echo "N/A";}else{echo number_format(floatval($outavg),$settings[1])."<span class=\"asterisk\">*</span>"; }?></td>
																<?php
															}
															else{
																?>
																	<td style="text-align:center;font-size: 13px;height: 14px;"><?php $outavg=array_sum($array_summary[$sn])/count($array_summary[$sn]);if(array_sum($array_summary[$sn])==''){echo "N/A";}else{echo number_format(floatval($outavg),$settings[1]);} ?></td>
																<?php
															}
															$sn=$sn+1;
														}
														else{
															?>
																<td style="background-color: #ddd;border: 1px solid white;"></td>
															<?php
															$sn=$sn+1;
														}
													}
												}
											}
										}
									?>
								</tr>
								<?php
									if($t>$e){
								?>
									<tr>
										<td style="background-color:#539CCC;color:white;text-align:center;font-size: 13px;">Total</td>
										
										<?php
											$sn=0;
											for($q=0;$q<count($sensororder);$q++){
												for($v=0;$v<count($txtdata);$v++){
													if($txtdata[$v][0]==$sensororder[$q]){
														$rowsubs=explode(',', $txtdata[$v][1]);
														for($w=0;$w<count($rowsubs);$w++){
															if(trim($rowsubs[$w])=="Total"){
																if(in_array('0', $checksum[$sn])){
																?>
																	<td style="text-align:center;font-size: 13px;height: 14px;"><?php $outavg=array_sum($array_summary[$sn]);if(array_sum($array_summary[$sn])==''){echo "N/A";}else{echo number_format(floatval($outavg),$settings[1])."<span class=\"asterisk\">*</span>";} ?></td>
																<?php
																}
																else{
																	?>
																		<td style="text-align:center;font-size: 13px;height: 14px;"><?php $outavg=array_sum($array_summary[$sn]);if(array_sum($array_summary[$sn])==''){echo "N/A";}else{echo number_format(floatval($outavg),$settings[1]);} ?></td>
																	<?php
																}
																$sn=$sn+1;
															}
															else{
																?>
																	<td style="background-color: #ddd;border: 1px solid white;"></td>
																<?php
																$sn=$sn+1;
															}
														}
													}
												}
											}
										?>
									</tr>
								<?php
									}
								?>
						</table>
					</center>
				</div>
					
			<?php
			}
			else if($_GET['type']=="Annual")
			{
				$array_summary[]=array();
            $checksum[]=array();
            $checkterm[][]=array();
				$array_values[][]=array();
				$mnum=getmonthnumber($from_month);
				$FM=$mnum;
				$FY=trim($_GET['FY']);
				$FY=$FY-1;
				$fullFY=$FY;
				$FY=substr($FY, -2);
				$month=array();
				$year=array();
				$FulFY=array();
				for($i=0;$i<12;$i++){
					if($FM==12){
				    	array_push($year, $FY);
				    	array_push($month, $FM);
				    	array_push($FulFY, $fullFY);
				    	$fullFY=$fullFY+1;
				    	$FY=$FY+1;
				    	$FM=1;
				    }
				    else{
				    	array_push($year, $FY);
				    	array_push($month, $FM);
				    	array_push($FulFY, $fullFY);
				        $FM=$FM+1;
				    }
				}
				$Y=date('Y');
				$Y=substr($Y, -2);
				$M=date('m');
				for($i=0;$i<count($month);$i++){
					if(($M==$month[$i])&&($Y==$year[$i])){
						$slice=$i;
						break;
					}
				}
				
				if($slice!=''){
					$month=array_slice($month,0,$slice+1);
				}
				for($k=0;$k<count($month);$k++){

					$FY=$year[$k];
					$FM=$month[$k];
					
					$result_table=  pg_query("SELECT * FROM \"tblAllTables\" where \"TableName\" like '%".$station."_$FY%'");
		  			if (isset($result_table)) {

					   	$stn_id=  pg_query("SELECT \"StationId\" FROM \"tblStation\" where \"StationName\"='$station'");

					   	$id_row=pg_fetch_array($stn_id);
					   	$s_id= $id_row['StationId'];
					   	$sensor_count=0;
					   	
					   	while ($tablerows=pg_fetch_array($result_table)) {
					   		$table="'".$tablerows['TableName']."'";
					   		if($k==1){
								$sensname=$PARAMS[$temp_position];
								
								$sensshef=getSensorShef($stn_name,$sensname);
								$col=pg_fetch_array(pg_query("SELECT  \"HydroMetParamsTypeId\"   FROM \"tblHydroMetParamsType\" where  \"HydroMetShefCode\"='$sensshef'"));
				          									
				          		$sql=pg_fetch_array(pg_query("select \"Value\" FROM  \"$table\" a where ((\"Year\" ,\"Month\")<($FY,$FM)) and a.\"StationId\"=$s_id and \"HydroMetParamsTypeId\"=$col[0] order by 1 desc"));
											      			
								$tempvalue=$sql[0];

							}
					   		$sql_query_real="SELECT * FROM crosstab ('SELECT  (''20''||\"Year\"::text ||''-''|| \"Month\"::text ||''-''|| \"Day\" ::text ||'' ''|| \"Hour\"::text || '':'' || \"Minute\" ::text ||'':'' ||\"Second\")::timestamp  as t,\"HydroMetParamsTypeId\", \"Value\" FROM  \"'$table'\" a where ((\"Year\" ,\"Month\") BETWEEN ($FY,$FM) AND ($FY,$FM)) and a.\"StationId\"=$s_id and ($HydroMetShefCodeCodition) order by 1 ','SELECT distinct \"HydroMetParamsTypeId\" FROM \"'$table'\" as a WHERE ($HydroMetShefCodeCodition)') AS final_result(t timestamp";

		        			$col_set=pg_query("SELECT distinct \"HydroMetParamsTypeId\" FROM \"$table\" as a WHERE ($HydroMetShefCodeCodition)");
		      
		        			while ($cols=pg_fetch_array($col_set)) { 
				          		$sql_query_real.=",\"".$cols[0]."\" double precision";
				        	}
					   		$sql_query_real.=")";
					   		
					   		$sql_query_virtual="SELECT * FROM crosstab ('SELECT  (''20''||\"Year\"::text ||''-''||\"Month\"::text ||''-''|| \"Day\" ::text ||'' ''||\"Hour\"::text || '':'' || \"Minute\" ::text ||'':'' ||\"Second\")::timestamp  as t,\"HydroMetParamsTypeId\", \"VirtualValue\" FROM \"'$table'\" a where ((\"Year\" ,\"Month\") BETWEEN ($FY,$FM) AND ($FY,$FM)) and a.\"StationId\"=$s_id and  \"sensortype\"=''Virtual'' and ($HydroMetShefCodeCoditionVirtual) order by 1','SELECT distinct \"HydroMetParamsTypeId\" FROM \"'$table'\" as a where \"sensortype\"=''Virtual'' AND ($HydroMetShefCodeCoditionVirtual)') AS final_result(t timestamp";

		        			$col_set=pg_query("SELECT distinct \"HydroMetParamsTypeId\" FROM \"$table\" as a where a.\"sensortype\"='Virtual' AND ($HydroMetShefCodeCoditionVirtual)");
		        

		        			while ($cols=pg_fetch_array($col_set)) { 
		          				$sql_query_virtual.=",\"".$cols[0]."\" double precision";
		        			}
					   		$sql_query_virtual.=")";

					   		$sql_query="select t2.t";
					   		$col_set=pg_query("select \"SHEF\",\"SensorType\" FROM \"SensorValues\" where (\"StationFullName\"= '$stn_name') and ($sensorCondition) order by \"Sensor\" desc");
					   		while ($cols=pg_fetch_array($col_set)) 
		        			{
		          				$counted=count($PARAMS)-1;
		       
		          				$col=pg_fetch_array(pg_query("SELECT  \"HydroMetParamsTypeId\" FROM \"tblHydroMetParamsType\" where  \"HydroMetShefCode\"='$cols[0]'"));
		        
		          				if (trim($cols[1])=='Real') 
		          				{
		            				if(pg_num_rows(pg_query("select distinct \"HydroMetParamsTypeId\" FROM  \"$table\" a where a.\"StationId\"=$s_id  and \"HydroMetParamsTypeId\"=$col[0] order by 1 asc"))>0)
		            				{
		              					$sql_query .=",t1.\"$col[0]\"" ;
		              					$sensor_count++;
		            
		            				}
		            				else{
		              					$colum=$col[0];
		            				}
		          				}
		          				else
		          				{
		            				if(pg_num_rows(pg_query("select distinct \"HydroMetParamsTypeId\" FROM  \"$table\" a where a.\"StationId\"=$s_id  and \"HydroMetParamsTypeId\"=$col[0] and \"sensortype\"='Virtual' order by 1 asc"))>0)
		            				{
		              					$sql_query .=",t2.\"$col[0]\"";
		              					$sensor_count++;
		            
		            				}
		            				else{
		              					$colum=$col[0];
		            				}
		          				}
		        			}
		        			if($sensor_count!=""){
		        
					        	if($sensor_count<$counted){
					          
					            	$sql_query.=",NULL as \"$colum\"";
					          
					          	}
					         
					        }
					        $sql_query=rtrim($sql_query,",");
		        			if($realsensors!=''){
		         
		          				$sql_query.=" from (".$sql_query_real.") t1 FULL OUTER JOIN (".$sql_query_virtual.") t2 on t2.t=t1.t order by t2.t asc";
		         			}
		        			else{
		          				$sql_query=$sql_query_virtual;
		        			}
		      
		        			if(pg_num_rows(pg_query("SELECT distinct \"HydroMetParamsTypeId\" FROM \"$table\" as a where a.\"sensortype\"='Virtual' and ($HydroMetShefCodeCoditionVirtual)"))<=0)
		        			{
		          				$sql_query="select t1.t";
		        
		          				$col_set=pg_query("select \"SHEF\",\"SensorType\" FROM \"SensorValues\" where (\"StationFullName\"= '$stn_name') and ($sensorCondition) order by \"Sensor\" desc");
		          				while ($cols=pg_fetch_array($col_set)) 
		          				{

		            				$counted=count($PARAMS)-1;
		          
		            				$col=pg_fetch_array(pg_query("SELECT  \"HydroMetParamsTypeId\"   FROM \"tblHydroMetParamsType\" where  \"HydroMetShefCode\"='$cols[0]'"));

		            				if (trim($cols[1])=='Real') 
		            				{	
		            					
		              					if(pg_num_rows(pg_query("select distinct \"HydroMetParamsTypeId\" FROM  \"$table\" a where a.\"StationId\"=$s_id  and \"HydroMetParamsTypeId\"=$col[0] order by 1 desc"))>0)
		              					{
		              						
		                					$sql_query .=",t1.\"$col[0]\"" ;
		                					$sensorcount++;
		              					}
		              					else
		              					{
		                					$colum=$col[0];
		              					}
		            				}
		          				}
		        
		          				if($sensorcount!=""){
		          
		            				if($sensorcount<$counted)
		            				{
		            
		              					$sql_query.=",NULL as \"$colum\"";
		            
		            				}
		         
		          				}

		          				$sql_query.=" from (".$sql_query_real." ) t1";
		        			}
		      
		        			$result_set=$sql_query;
		        			
					   	}
					}
					
					$results=pg_query($result_set);

					while ($row=pg_fetch_row($results)) {
						$row_count=1;
                  $c=0;
						$result_sensor1=pg_query("select \"Sensor\",\"Units\" from \"SensorValues\" where (\"StationFullName\"= '$stn_name') and ($sensorCondition)");
						$sensor_row=pg_num_rows($result_sensor1);
						for($i=0;$i<$sensor_row;$i++){
							// echo "hello";
							if($i==$temp_position){
                        $checkterm[$k][$c][]=number_format(floatval($row[$row_count]),$settings[1]);
                        $c=$c+1;
								$array_values[$k][$i][]=number_format(floatval($row[$row_count]),$settings[1])-$tempvalue;
								$tempvalue=number_format(floatval($row[$row_count]),$settings[1]);
								$row_count=$row_count+1;
							}
							else{
								$array_values[$k][$i][]=number_format(floatval($row[$row_count]),$settings[1]);
								$row_count=$row_count+1;
							}
						}	
					}
				}

				$sensororder=array();
				?>
				<script>
				    document.getElementById("btnExport").style.display = 'block';
				    document.getElementById("exporttopdf").style.display = 'block';    
				</script>
				<div class="col-md-12" id="customtable">
					<center>
                  <?php 
                     $hmonth=$month[count($month)-1];
                     $hyear=$year[count($year)-1];
                     $present=cal_days_in_month(CAL_GREGORIAN, $hmonth, $hyear);
                     $Y=date('Y');
                     $Y=substr($Y, -2);
                     $M=date('m');
                     $D=date('d');
                     if(($hyear==$Y)&&($hmonth==$M)){
                        $present=$D;
                     } 
                     if($present==2){
                        $annotation='nd';
                     }
                     else if($present==3){
                        $annotation='rd';
                     }
                     else{
                        $annotation='th';
                     }
                  ?>
						<h3><b><?php echo $_GET['station']; ?></b></h3>
						<h4>Annual Report : <b><?php echo getmonthname($month[0])." 1st, ".$year[0]." to ".getmonthname($month[count($month)-1])." ".$present.$annotation.", ".$year[count($year)-1]; ?></b></h4>
						<table align="center" style="max-width:99%;min-width:50%" class=" table-responsive table-bordered" id="table">
							<tr>
								<th style="background-color:#539CCC;color:white;text-align:center;font-size: 16px;width:auto;">Month</th>
								<th style="background-color:#539CCC;color:white;text-align:center;font-size: 16px;width:auto;">Year</th>
								<?php
									$result_sensor1=(pg_query("select \"Sensor\",\"Units\",\"SensorType\",\"SHEF\" from \"SensorValues\" where (\"StationFullName\"= '$stn_name') and ($sensorCondition) order by \"Sensor\" desc"));
									// $sensor_position=0;
									
									while ($sensor_row=pg_fetch_array($result_sensor1)) 
	      							{
	      								for($o=0;$o<count($txtdata);$o++){
	      									if($txtdata[$o][0]==$sensor_row[0]){
	      										$subhead=explode(',', $txtdata[$o][1]);
	      										break;
	      									}
	      								}
	      								$sql="";
	      								if (trim($sensor_row[2])=="Real")
	        							  {
	    
	          								$col=pg_fetch_array(pg_query("SELECT  \"HydroMetParamsTypeId\"   FROM \"tblHydroMetParamsType\" where  \"HydroMetShefCode\"='$sensor_row[3]'"));
	          
	          								$sql=("select distinct \"HydroMetParamsTypeId\" FROM  \"$table\" a where ((\"Year\" ,\"Month\") BETWEEN ($FY,$FM) AND ($FY,$FM)) and a.\"StationId\"=$s_id  and \"HydroMetParamsTypeId\"=$col[0] order by 1 desc");
	        							  }
	        							  else
	        							  {
	          								$col=pg_fetch_array(pg_query("SELECT  \"HydroMetParamsTypeId\"   FROM \"tblHydroMetParamsType\" where  \"HydroMetShefCode\"='$sensor_row[3]'"));
	          								$sql="select distinct \"HydroMetParamsTypeId\" FROM  \"$table\" a where ((\"Year\" ,\"Month\") BETWEEN ($FY,$FM) AND ($FY,$FM)) and a.\"StationId\"=$s_id  and \"HydroMetParamsTypeId\"=$col[0]  and \"sensortype\"='Virtual' order by 1 desc";
	        							  }
	        							  if(pg_num_rows(pg_query($sql))>=0)
	        							  {
	        								
	        								   if (isset($sensor_row[0])){
	        									   if($sensor_row[0]!=''){
				          							if(($sensor_row[0]=='Rainfall Annual')||($sensor_row[0]=='Rain')){
				          								$sens_name=$sensor_row[0];
				          								$postion=$sensor_position;
				          								$symbol=$sensor_row[1];
				          								$colcount=count($subhead);
				          								continue;
				          							}
				          							else{
				          								?>
				          									<th style="background-color:#539CCC;color:white;text-align:center;font-size: 13px;" colspan="<?php echo count($subhead);?>">
				          										<?php 
				          											$sensor_position++;
							          								echo $sensor_row[0];
							          								if ($sensor_row[1]!="") 
							          									echo" (".$sensor_row[1].")";
							          								array_push($sensororder,$sensor_row[0]);
	          													?>
	          												</th>
				          								<?php
				          							}
				          						}
				          					}
				          				}
	      							}
	      							if($sens_name!=''){
	      								?>
	      									<th style="background-color:#539CCC;color:white;text-align:center;font-size: 13px;" colspan="<?php echo $colcount;?>"><?php echo $sens_name." (".$symbol.")";array_push($sensororder,$sens_name);?></th>
	      								<?php
	      							}
								?>
							</tr>
							<tr>
								<th style="background-color:#539CCC;color:white;text-align:center;font-size: 16px;width:auto;"></th>
								<th style="background-color:#539CCC;color:white;text-align:center;font-size: 16px;width:auto;"></th>
								<?php
									$result_sensor1=(pg_query("select \"Sensor\",\"Units\",\"SensorType\",\"SHEF\" from \"SensorValues\" where (\"StationFullName\"= '$stn_name') and ($sensorCondition) order by \"Sensor\" desc"));
									$sensor_position=0;
									
									while ($sensor_row=pg_fetch_array($result_sensor1)) 
	      							{
	      								
	      								
	      								$sql="";
	      								if (trim($sensor_row[2])=="Real")
	        							{
	    
	          								$col=pg_fetch_array(pg_query("SELECT  \"HydroMetParamsTypeId\"   FROM \"tblHydroMetParamsType\" where  \"HydroMetShefCode\"='$sensor_row[3]'"));
	          
	          								$sql=("select distinct \"HydroMetParamsTypeId\" FROM  \"$table\" a where ((\"Year\" ,\"Month\") BETWEEN ($FY,$FM) AND ($FY,$FM)) and a.\"StationId\"=$s_id  and \"HydroMetParamsTypeId\"=$col[0] order by 1 desc");
	        							}
	        							else
	        							{
	          								$col=pg_fetch_array(pg_query("SELECT  \"HydroMetParamsTypeId\"   FROM \"tblHydroMetParamsType\" where  \"HydroMetShefCode\"='$sensor_row[3]'"));
	          								$sql="select distinct \"HydroMetParamsTypeId\" FROM  \"$table\" a where ((\"Year\" ,\"Month\") BETWEEN ($FY,$FM) AND ($FY,$FM)) and a.\"StationId\"=$s_id  and \"HydroMetParamsTypeId\"=$col[0]  and \"sensortype\"='Virtual' order by 1 desc";
	        							}
	        							if(pg_num_rows(pg_query($sql))>=0)
	        							{
	        								for($o=0;$o<count($txtdata);$o++){
	      										if($txtdata[$o][0]==$sensor_row[0]){
	      											$subhead=explode(',', $txtdata[$o][1]);
	      											if (isset($sensor_row[0])){
	        											if($sensor_row[0]!=''){
	        												if(($sensor_row[0]=='Rainfall Annual')||($sensor_row[0]=='Rain')){
	        													$sens_name=$sensor_row[0];
						          								$subth=$subhead;
						          								continue;
						          							}
						          							else{
						          								for($h=0;$h<count($subhead);$h++){
							          								?>
							          									<th style="background-color:#539CCC;color:white;text-align:center;font-size: 13px;" >
							          										<?php 
							          											echo $subhead[$h];
				          													?>
				          												</th>
							          								<?php
						          								}
						          							}
	        											}
	        										}
	      											break;
	      										}
	      									}
				          				}
	      							}
	      							if($sens_name!=''){
	      								for($h=0;$h<count($subth);$h++){
		      								?>
		      									<th style="background-color:#539CCC;color:white;text-align:center;font-size: 13px;" ><?php echo $subth[$h];?></th>
		      								<?php
	      								}
	      							}
								?>
							</tr>
								<?php
									$result_sensor2=pg_query("select \"Sensor\",\"Units\" from \"SensorValues\" where (\"StationFullName\"= '$stn_name') and ($sensorCondition)");
									$sensor_row_count=pg_num_rows($result_sensor2);
									$PARAMS_Data=array();
									for($f=0;$f<count($PARAMS);$f++){
										if($PARAMS[$f]!=''){
											array_push($PARAMS_Data, $PARAMS[$f]);
										}
									}
									$n=count($PARAMS_Data)-1;
									
									if($temp_position<count($PARAMS_Data)-1){
										if(($n-$temp_position)==1){
											$tp=$PARAMS_Data[$temp_position];
											$PARAMS_Data[$temp_position]=$PARAMS_Data[$n];
											$PARAMS_Data[$n]=$tp;
										}
									}
									
									$str=array();
									
									for($h=0;$h<$sensor_row_count;$h++){
										if((strpos($PARAMS[$h],"Rainfall Annual")!==false)||(strpos($PARAMS[$h],"Rain")!==false)){
											$check=1;
											array_push($str, $check);
										}
										else{
											$check=0;
											array_push($str, $check);
										}
									}
									
									for($p=0;$p<count($month);$p++){
										?>
											<tr>
												<td style="text-align:center;font-size: 13px;height: 14px;"><?php echo $month[$p]; ?></td>
												<td style="text-align:center;font-size: 13px;height: 14px;"><?php echo $FulFY[$p]; ?></td>
												
												<?php
                                       $numdays=cal_days_in_month(CAL_GREGORIAN, $month[$p], $FulFY[$p]);
                                       $Y=date('Y');
                                       $M=date('m');
                                       $D=date('d');
                                       if(($FulFY[$p]==$Y)&&($month[$p]==$M)){
                                          $numdays=$D;
                                       }
													$t=0;$e=0;
													for($h=0;$h<$sensor_row_count;$h++){
                                          //echo count($array_values[$p][$h]);
                                          $checkmissing=count($array_values[$p][$h])%24;
                                          //echo $checkmissing;
                                          for($g=0;$g<count($txtdata);$g++){
                                             if($str[$h]==0){
                                                if($txtdata[$g][0]==$PARAMS[$h]){
                                                   $subs=explode(',', $txtdata[$g][1]);
                                                   for($d=0;$d<count($subs);$d++){
                                                      if(trim($subs[$d])=="Min"){
                                                         $out_min=min($array_values[$p][$h]);
                                                         
                                                         if($out_min==''){
                                                            $out_min="-";
                                                         ?>
                                                            <td style="text-align:center;font-size: 13px;height: 14px;"><?php echo $out_min; ?></td>
                                                         <?php
                                                         }
                                                         else{
                                                         ?>
                                                            <td style="text-align:center;font-size: 13px;height: 14px;">
                                                               <?php 
                                                                  if($checkmissing==0){ 
                                                                        echo number_format(floatval($out_min),$settings[1]);
                                                                     }
                                                                  else{
                                                                     
                                                                     echo number_format(floatval($out_min),$settings[1])."<span class=\"asterisk\">*</span>";
                                                                  } 
                                                               ?>
                                                                  
                                                            </td>
                                                         <?php
                                                            if($checkmissing==0){
                                                               $array_summary[$t][]=number_format(floatval($out_min),$settings[1]);
                                                               $checksum[$t][]=1;
                                                            }
                                                            else{
                                                               $array_summary[$t][]=number_format(floatval($out_min),$settings[1]);
                                                               $checksum[$t][]=0;
                                                            }
                                                         }
                                                      }
                                                      else if(trim($subs[$d])=="Max"){
                                                         $out_max=max($array_values[$p][$h]);
                                                         
                                                         if($out_max==''){
                                                            $out_max="-";
                                                         ?>
                                                            <td style="text-align:center;font-size: 13px;height: 14px;"><?php echo $out_max; ?></td>
                                                         <?php
                                                         }
                                                         else{
                                                         ?>
                                                            <td style="text-align:center;font-size: 13px;height: 14px;"><?php if($checkmissing==0){ echo number_format(floatval($out_max),$settings[1]);}else{echo number_format(floatval($out_max),$settings[1])."<span class=\"asterisk\">*</span>";} ?></td>
                                                         <?php
                                                            if($checkmissing==0){
                                                               $array_summary[$t][]=number_format(floatval($out_max),$settings[1]);
                                                               $checksum[$t][]=1;
                                                            }
                                                            else{
                                                               $array_summary[$t][]=number_format(floatval($out_max),$settings[1]);
                                                               $checksum[$t][]=0;
                                                            }
                                                         }
                                                      }
                                                      else if(trim($subs[$d])=="Avg"){
                                                         $out_avg=array_sum($array_values[$p][$h])/count($array_values[$p][$h]);
                                                         //echo $out_avg;
                                                         
                                                         if(array_sum($array_values[$p][$h])==''){
                                                            $out_avg="-";
                                                         ?>
                                                            <td style="text-align:center;font-size: 13px;height: 14px;"><?php echo $out_avg; ?></td>
                                                         <?php

                                                         }
                                                         else{
                                                         ?>
                                                            <td style="text-align:center;font-size: 13px;height: 14px;"><?php if($checkmissing==0){ echo number_format(floatval($out_avg),$settings[1]);}else{echo number_format(floatval($out_avg),$settings[1])."<span class=\"asterisk\">*</span>";} ?></td>
                                                         <?php
                                                            if($checkmissing==0){
                                                               $array_summary[$t][]=number_format(floatval($out_avg),$settings[1]);
                                                               $checksum[$t][]=1;
                                                            }
                                                            else{
                                                               $array_summary[$t][]=number_format(floatval($out_avg),$settings[1]);
                                                               $checksum[$t][]=0;
                                                            }
                                                         }
                                                      }

                                                      else if(trim($subs[$d])=="Total"){
                                                      	print_r($subs[$d]);
                                                         $out_total=array_sum($array_values[$p][$h]);
                                                         print_r($array_values[$p][$h]);
                                                         if(count($array_values[$p][$h])==0){
                                                            $out_total="-";
                                                         ?>
                                                            <td style="text-align:center;font-size: 13px;height: 14px;"><?php echo $out_total; ?></td>
                                                         <?php

                                                         }
                                                         else{
                                                            ?>
                                                               <td style="text-align:center;font-size: 13px;height: 14px;"><?php if($checkmissing==0){ echo number_format(floatval($out_total),$settings[1]);}else{echo number_format(floatval($out_total),$settings[1])."<span class=\"asterisk\">*</span>";} ?></td>
                                                            <?php
                                                            if($checkmissing==0){
                                                               $array_summary[$t][]=number_format(floatval($out_total),$settings[1]);
                                                               $checksum[$t][]=1;
                                                            }
                                                            else{
                                                               $array_summary[$t][]=number_format(floatval($out_total),$settings[1]);
                                                               $checksum[$t][]=0;
                                                            }
                                                         }
                                                      }
                                                      $t=$t+1;
                                                      $e=$e+1;
                                                   }
                                                }
                                             }
                                          }

                                       }
													for($h=0;$h<$sensor_row_count;$h++){

														for($g=0;$g<count($txtdata);$g++){
															if($str[$h]==1){
                                                $checkdays=24*$numdays;
                                                
                                                if(($checkterm[$p][0][0]=='')||($checkterm[$p][0][$checkdays-1]=='')){
                                                   $checkmissingterm=0;
                                                }
                                                else{
                                                   $checkmissingterm=1;
                                                }
																if($txtdata[$g][0]==$PARAMS[$h]){
																	$subs=explode(',', $txtdata[$g][1]);
																	for($d=0;$d<count($subs);$d++){
																		if(trim($subs[$d])=="Min"){
																			$out_min=min($array_values[$p][$h]);
																			if($out_min==''){
																				$out_min="-";
																			?>
																				<td style="text-align:center;font-size: 13px;height: 14px;"><?php echo $out_min; ?></td>
																			<?php
																			}
																			else{
                                                            if($checkmissingterm==0){
      																			?>
      																				<td style="text-align:center;font-size: 13px;height: 14px;"><?php echo number_format(floatval($out_min),$settings[1])."<span class=\"asterisk\">*</span>"; ?></td>
      																			<?php
                                                            }
                                                            else{
                                                               ?>
                                                                  <td style="text-align:center;font-size: 13px;height: 14px;"><?php echo number_format(floatval($out_min),$settings[1]); ?></td>
                                                               <?php
                                                            }
																				if($checkmissingterm==0){
                                                               $array_summary[$t][]=number_format(floatval($out_min),$settings[1]);
                                                               $checksum[$t][]=0;
                                                            }
                                                            else{
                                                               $array_summary[$t][]=number_format(floatval($out_min),$settings[1]);
                                                               $checksum[$t][]=1;
                                                            }
																			}
																		}
																		else if(trim($subs[$d])=="Max"){
																			$out_max=max($array_values[$p][$h]);
																			if($out_max==''){
																				$out_max="-";
																			?>
																				<td style="text-align:center;font-size: 13px;height: 14px;"><?php echo $out_max; ?></td>
																			<?php
																			}
																			else{
   																			if($checkmissingterm==0){
                                                               ?>
                                                                  <td style="text-align:center;font-size: 13px;height: 14px;"><?php echo number_format(floatval($out_max),$settings[1])."<span class=\"asterisk\">*</span>"; ?></td>
                                                               <?php
                                                            }
                                                            else{
                                                               ?>
                                                                  <td style="text-align:center;font-size: 13px;height: 14px;"><?php echo number_format(floatval($out_max),$settings[1]); ?></td>
                                                               <?php
                                                            }
                                                            if($checkmissingterm==0){
                                                               $array_summary[$t][]=number_format(floatval($out_max),$settings[1]);
                                                               $checksum[$t][]=0;
                                                            }
                                                            else{
                                                               $array_summary[$t][]=number_format(floatval($out_max),$settings[1]);
                                                               $checksum[$t][]=1;
                                                            }
																			}
																		}
																		else if(trim($subs[$d])=="Avg"){
																			$out_avg=array_sum($array_values[$p][$h])/count($array_values[$p][$h]);
																			if(array_sum($array_values[$p][$h])==''){
																				$out_avg="-";
																			?>
																				<td style="text-align:center;font-size: 13px;height: 14px;"><?php echo $out_avg; ?></td>
																			<?php
																			}
																			else{
                                                            if($checkmissingterm==0){
                                                               ?>
                                                                  <td style="text-align:center;font-size: 13px;height: 14px;"><?php echo number_format(floatval($out_avg),$settings[1])."<span class=\"asterisk\">*</span>"; ?></td>
                                                               <?php
                                                            }
                                                            else{
                                                               ?>
                                                                  <td style="text-align:center;font-size: 13px;height: 14px;"><?php echo number_format(floatval($out_avg),$settings[1]); ?></td>
                                                               <?php
                                                            }
																				if($checkmissingterm==0){
                                                               $array_summary[$t][]=number_format(floatval($out_avg),$settings[1]);
                                                               $checksum[$t][]=0;
                                                            }
                                                            else{
                                                               $array_summary[$t][]=number_format(floatval($out_avg),$settings[1]);
                                                               $checksum[$t][]=1;
                                                            }
																			}
																		}
																		else if(trim($subs[$d])=="Total"){
																			$out_total=array_sum($array_values[$p][$h]);
																		   if(count($array_values[$p][$h])==0){
                                                            $out_total="-";
                                                         ?>
                                                            <td style="text-align:center;font-size: 13px;height: 14px;"><?php echo $out_total; ?></td>
                                                         <?php
                                                         }
                                                         else{
                                                            if($checkmissingterm==0){
                                                               ?>
                                                                  <td style="text-align:center;font-size: 13px;height: 14px;"><?php echo number_format(floatval($out_total),$settings[1])."<span class=\"asterisk\">*</span>"; ?></td>
                                                               <?php
                                                            }
                                                            else{
                                                               ?>
                                                                  <td style="text-align:center;font-size: 13px;height: 14px;"><?php echo number_format(floatval($out_total),$settings[1]); ?></td>
                                                               <?php
                                                            }
                                                            if($checkmissingterm==0){
                                                               $array_summary[$t][]=number_format(floatval($out_total),$settings[1]);
                                                               $checksum[$t][]=0;
                                                            }
                                                            else{
                                                               $array_summary[$t][]=number_format(floatval($out_total),$settings[1]);
                                                               $checksum[$t][]=1;
                                                            }
                                                         }
																		}
																		$t=$t+1;
																	}
																}
															}
														}
														
													}
												?>
											</tr>
										<?php
									}
									// print_r($sensororder);
									$diff=$t-$e;
									// echo $t;
								?>
								<th style="background-color:#539CCC;color:white;text-align:center;font-size: 13px;padding: 4px;" colspan="<?php echo $t+2; ?>">Summary</th>

								<tr>
									<td style="background-color:#539CCC;color:white;text-align:center;font-size: 13px;" colspan="2">Min</td>
									<?php
										$sn=0;
										for($q=0;$q<count($sensororder);$q++){
											for($v=0;$v<count($txtdata);$v++){
												if($txtdata[$v][0]==$sensororder[$q]){
													$rowsubs=explode(',', $txtdata[$v][1]);
													for($w=0;$w<count($rowsubs);$w++){
														if(trim($rowsubs[$w])=="Min"){
															if(in_array('0', $checksum[$sn])){
                                                ?>
                                                   <td style="text-align:center;font-size: 13px;height: 14px;"><?php if(min($array_summary[$sn])==''){echo "N/A";}else{ echo min($array_summary[$sn])."<span class=\"asterisk\">*</span>";}?></td>
                                                <?php
                                             }
                                             else{
                                                ?>
                                                   <td style="text-align:center;font-size: 13px;height: 14px;"><?php if(min($array_summary[$sn])==''){echo "N/A";}else{echo min($array_summary[$sn]);} ?></td>
                                                <?php
                                             }
                                             $sn=$sn+1;
														}
														else{
															?>
																<td style="background-color: #ddd;border: 1px solid white;"></td>
															<?php
															$sn=$sn+1;
														}
													}
												}
											}
										}
									?>
								</tr>
								<tr>
									<td style="background-color:#539CCC;color:white;text-align:center;font-size: 13px;" colspan="2">Max</td>
									<?php
										$sn=0;
										for($q=0;$q<count($sensororder);$q++){
											for($v=0;$v<count($txtdata);$v++){
												if($txtdata[$v][0]==$sensororder[$q]){
													$rowsubs=explode(',', $txtdata[$v][1]);
													for($w=0;$w<count($rowsubs);$w++){
														if(trim($rowsubs[$w])=="Max"){
															if(in_array('0', $checksum[$sn])){
                                                ?>
                                                   <td style="text-align:center;font-size: 13px;height: 14px;"><?php if(max($array_summary[$sn])==''){echo "N/A";}else{echo max($array_summary[$sn])."<span class=\"asterisk\">*</span>";} ?></td>
                                                <?php
                                             }
                                             else{
                                                ?>
                                                   <td style="text-align:center;font-size: 13px;height: 14px;"><?php if(max($array_summary[$sn])==''){echo "N/A";}else{echo max($array_summary[$sn]);}?></td>
                                                <?php
                                             }
                                             $sn=$sn+1;
														}
														else{
															?>
																<td style="background-color: #ddd;border: 1px solid white;"></td>
															<?php
															$sn=$sn+1;
														}
													}
												}
											}
										}
									?>
								</tr>
								<tr>
									<td style="background-color:#539CCC;color:white;text-align:center;font-size: 13px;" colspan="2">Avg</td>
									<?php
										$sn=0;
										for($q=0;$q<count($sensororder);$q++){
											for($v=0;$v<count($txtdata);$v++){
												if($txtdata[$v][0]==$sensororder[$q]){
													$rowsubs=explode(',', $txtdata[$v][1]);
													for($w=0;$w<count($rowsubs);$w++){
														if(trim($rowsubs[$w])=="Avg"){
															if(in_array('0', $checksum[$sn])){
                                                ?>
                                                   <td style="text-align:center;font-size: 13px;height: 14px;"><?php $outavg=array_sum($array_summary[$sn])/count($array_summary[$sn]);if(array_sum($array_summary[$sn])==''){echo "N/A";}else{echo number_format(floatval($outavg),$settings[1])."<span class=\"asterisk\">*</span>";} ?></td>
                                                <?php
                                             }
                                             else{
                                                ?>
                                                   <td style="text-align:center;font-size: 13px;height: 14px;"><?php $outavg=array_sum($array_summary[$sn])/count($array_summary[$sn]);if(array_sum($array_summary[$sn])==''){echo "N/A";}else{echo number_format(floatval($outavg),$settings[1]);} ?></td>
                                                <?php
                                             }
                                             $sn=$sn+1;
														}
														else{
															?>
																<td style="background-color: #ddd;border: 1px solid white;"></td>
															<?php
															$sn=$sn+1;
														}
													}
												}
											}
										}
									?>
								</tr>
								<?php
									if($t>$e){
								?>
									<tr>
										<td style="background-color:#539CCC;color:white;text-align:center;font-size: 13px;" colspan="2">Total</td>
										
										<?php
											$sn=0;
											for($q=0;$q<count($sensororder);$q++){
												for($v=0;$v<count($txtdata);$v++){
													if($txtdata[$v][0]==$sensororder[$q]){
														$rowsubs=explode(',', $txtdata[$v][1]);
														for($w=0;$w<count($rowsubs);$w++){
															if(trim($rowsubs[$w])=="Total"){
																if(in_array('0', $checksum[$sn])){
                                                ?>
                                                   <td style="text-align:center;font-size: 13px;height: 14px;"><?php $outavg=array_sum($array_summary[$sn]);if(array_sum($array_summary[$sn])==''){echo "N/A";}else{echo number_format(floatval($outavg),$settings[1])."<span class=\"asterisk\">*</span>";} ?></td>
                                                <?php
                                                }
                                                else{
                                                   ?>
                                                      <td style="text-align:center;font-size: 13px;height: 14px;"><?php $outavg=array_sum($array_summary[$sn]);if(array_sum($array_summary[$sn])==''){echo "N/A";}else{echo number_format(floatval($outavg),$settings[1]);} ?></td>
                                                   <?php
                                                }
                                                $sn=$sn+1;
															}
															else{
																?>
																	<td style="background-color: #ddd;border: 1px solid white;"></td>
																<?php
																$sn=$sn+1;
															}
														}
													}
												}
											}
										?>
									</tr>
								<?php
									}
								?>
						</table>
					</center>
				</div>
					
				<?php
			}
		}
	?>
	</body>
</html>
<?php
	function getStationShef($Name)
	{
		$stn_name="";
		$stn_types_set=pg_query("select \"StationType\" from \"tblStationType\"");
		while ($row_types=pg_fetch_array($stn_types_set)) {
			$table=str_replace(" ", "_", $row_types[0]);
	 		$stn_set= pg_query("select \"Station_Shef_Code\" from \"$table\" where \"Station_Full_Name\"='$Name'");
	 		if (pg_num_rows($stn_set)>0) {
	   			# code...
	 			$row=pg_fetch_array($stn_set);
				$stn_name=$row[0];
	 		}
		}
	 	return $stn_name;
	} 

	function getSensorShef($stn_name,$sensor)
	{

		$result=pg_query("SELECT  \"SHEF\",\"SensorType\" FROM \"SensorValues\" where \"StationFullName\"='$stn_name' and \"Sensor\"='$sensor'");
		$row=pg_fetch_array($result);
		$shef=$row[0];
		if (trim($row[1])=="Real") {
			$shef=$row[0];
		}
		else
		{
			$shef=$row[0];
		}
		return $shef;
	}
	function getmonthname($number){
		if($number=='1'){
			return 'January';
		}
		else if($number=='2'){
			return 'February';
		}
		else if($number=='3'){
			return 'March';	
		}
		else if($number=='4'){
			return 'April';
		}
		else if($number=='5'){
			return 'May';
		}
		else if($number=='6'){
			return 'June';
		}
		else if($number=='7'){
			return 'July';
		}
		else if($number=='8'){
			return 'August';
		}
		else if($number=='9'){
			return 'September';
		}
		else if($number=='10'){
			return 'October';
		}
		else if($number=='11'){
			return 'November';
		}
		else{
			return 'December';
		}
	}
	function getmonthnumber($name){
		if($name=='January'){
			return '1';
		}
		else if($name=='February'){
			return '2';
		}
		else if($name=='March'){
			return '3';	
		}
		else if($name=='April'){
			return '4';
		}
		else if($name=='May'){
			return '5';
		}
		else if($name=='June'){
			return '6';
		}
		else if($name=='July'){
			return '7';
		}
		else if($name=='August'){
			return '8';
		}
		else if($name=='September'){
			return '9';
		}
		else if($name=='October'){
			return '10';
		}
		else if($name=='November'){
			return '11';
		}
		else{
			return '12';
		}
	}
?>