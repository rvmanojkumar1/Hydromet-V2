<?php
	session_start();

	include_once 'database.php';
	include_once 'editcompany.php';


	$company=$_SESSION["company"];
	$sensor=$_GET['sensor'];
	$timediff=$_GET['time'];
	$time = str_replace("rain","",$timediff);
	if(($time=='Month')||($time=='Year')||($time=='PrevYear')){
		if($time=='Month'){
			$month=date('d');
			$time=($month*24);
		}
		else if($time=='Year'){
			// $days=date("z")+1;
			// echo $days;
			// echo "<br>";
			// $time=($days*24);
		}
		else if($time=='PrevYear'){

		}
	}
	// echo $company;
	// echo '<br>';
	// echo $sensor;
	// echo '<br>';
	// echo $time;
	// echo '<br>';
	$output=[];
	$settings=pg_fetch_array(pg_query("select \"DateFormat\",\"DecimalPlaces\" from \"tblLogo\""));

	$sql=pg_query("SELECT \"Station\" FROM \"tblCompany2Station\" WHERE \"Company\"='$company' order by \"Station\"");
	// echo "SELECT \"Station\" FROM \"tblCompany2Station\" WHERE \"Company\"='$company' order by \"Station\"";
	// echo "<br>";
	// echo "<br>";
	while($name=pg_fetch_array($sql)){

		$StationFullName=getstationfullname($name[0]);
		$result=pg_query("SELECT \"SHEF\",\"SensorType\" FROM \"SensorValues\" where \"Sensor\"='$sensor' and \"StationFullName\"='$StationFullName'");
		// echo "SELECT \"SHEF\",\"SensorType\" FROM \"SensorValues\" where \"Sensor\"='$sensor' and \"StationFullName\"='$StationFullName'";
		// echo "<br>";
		// echo "<br>";
		if(pg_num_rows($result)>0){
			$sensorrow=pg_fetch_array($result);
			$sensorshef=$sensorrow['SHEF'];
			
			// echo $sensorshef;
			// echo "<br>";
			// echo "<br>";
			$result_set=pg_fetch_array(pg_query("SELECT \"HydroMetParamsTypeId\" FROM \"tblHydroMetParamsType\" where  \"HydroMetShefCode\" = '$sensorshef'"));
			$PARAMS=$result_set['HydroMetParamsTypeId'];
			// echo $PARAMS;
			// echo "<br>";
			// echo "<br>";
	   		$valuecol="Value";

	    	if(trim($sensorrow['SensorType'])=='Virtual')
	    	{
	   			$valuecol="VirtualValue";
	    	}
	    	else
	    	{
	   			$valuecol="Value";
	    	}
	    	// echo $valuecol;
	    	// echo "<br>";
	    	// echo "<br>";
			$StationShefCode=$name[0];
			
			$sql1=pg_query("SELECT \"TableName\" FROM \"tblAllTables\" WHERE \"StationName\"='$StationShefCode' order by 1 desc limit 1");
			// echo "SELECT \"TableName\" FROM \"tblAllTables\" WHERE \"StationName\"='$StationShefCode' order by 1 desc";
			// echo "<br>";
			// echo "<br>";
			if (pg_num_rows($sql1)>0) {
				$stn_id=pg_query("SELECT \"StationId\" FROM \"tblStation\" where \"StationName\"='$StationShefCode'");
				// echo "SELECT \"StationId\" FROM \"tblStation\" where \"StationName\"='$StationShefCode'";
				// echo "<br>";
				// echo "<br>";
				$id_row=pg_fetch_array($stn_id);
				$s_id= $id_row['StationId'];
				// echo $s_id;
				// echo "<br>";
				// echo "<br>";
				while($tname=pg_fetch_array($sql1)){
					$table=$tname['TableName'];
					if ($valuecol=="Value") {
      
 
    					$sql_query="select ('20'||\"Year\"::text ||'-'|| \"Month\"::text ||'-'|| \"Day\" ::text ||' '|| \"Hour\"::text || ':' || \"Minute\" ::text || ':' ||\"Second\")::timestamp as t, \"$valuecol\" from \"'$table'\" a, \"tblHydroMetParamsType\" b  where b.\"HydroMetParamsTypeId\" = a.\"HydroMetParamsTypeId\" and a.\"HydroMetParamsTypeId\"='$PARAMS' and a.\"StationId\"= '$s_id'  and a.\"Flag\"= '1'  order by \"HydroMetShefCode\",t desc limit 1";
       				}
       				else
       				{

          				$sql_query="select ('20'||\"Year\"::text ||'-'|| \"Month\"::text ||'-'|| \"Day\" ::text ||' '|| \"Hour\"::text || ':' || \"Minute\" ::text || ':' ||\"Second\")::timestamp as t, \"$valuecol\" from \"'$table'\" a, \"tblHydroMetParamsType\" b where b.\"HydroMetParamsTypeId\" = a.\"HydroMetParamsTypeId\" and a.\"HydroMetParamsTypeId\"='$PARAMS' and a.\"StationId\"= '$s_id'  and a.\"Flag\"= '1' and SensorType='Virtual'  order by \"HydroMetShefCode\",t desc limit 1";
       				}
       				// echo $sql_query;
       				// echo "<br>";
       				// echo "<br>";
       				$query=pg_fetch_array(pg_query($sql_query));
       				$current=$query['t'];
       				if($time=='Year'){
       					$year=date("Y");
       					$previousdate=date("Y-m-d h:i:s",strtotime('01-01-'.$year));
       					// echo $previousdate;
       					$days=(strtotime($current) - strtotime($previousdate))/60/60/24; 
       					$time=$days*24;
       				}
       				if($time=='PrevYear'){
       					$d=date("d");
       					$m=date("m");
       					$y=date("Y")-1;
       					$previousdate=date("Y-m-d h:i:s",strtotime($d.'-'.$m.'-'.$y));
       					// echo $table;
       					// echo "<br>";
       					$replace=substr($table, -2);
       					$table=str_replace($replace, $replace-1, $table);
       					$days=(strtotime($current) - strtotime($previousdate))/60/60/24; 
       					$time=$days*24;
       					// echo $table;
       					// echo "<br>";
       					
       				}
       				// echo $current;
       				// echo "<br>";
       				$CurrentValue=$query[1];
       				$timestamp=strtotime($current);
       				$TmStamp=$timestamp-($time*60*60);
       				// echo date("Y-m-d h:i:s", $TmStamp);;
       				// echo "<br>";

       				$Y = date("Y", $TmStamp);
       				$Y = substr($Y,-2);
       				$m = date("m", $TmStamp);
       				$d = date("d", $TmStamp);
       				$h = date("h", $TmStamp);
       				$i = date("i", $TmStamp);
       				// echo date("Y-m-d h:i", $TmStamp);
       				// echo "<br>";
       				// echo "<br>";
       				
       				if ($valuecol=="Value") {
                        $sql_query1="select ('20'||\"Year\"::text ||'-'|| \"Month\"::text ||'-'|| \"Day\" ::text ||' '|| \"Hour\"::text || ':' || \"Minute\" ::text || ':' ||\"Second\")::timestamp as t, \"$valuecol\" from \"'$table'\" a, \"tblHydroMetParamsType\" b where b.\"HydroMetParamsTypeId\"= a.\"HydroMetParamsTypeId\" and (('20'||\"Year\"::text ||'-'|| \"Month\"::text ||'-'|| \"Day\" ::text ||' '|| \"Hour\"::text || ':' || \"Minute\" ::text || ':' || \"Second\")::timestamp <= ('20$Y-$m-$d $h:$i:0')) and a.\"HydroMetParamsTypeId\"='$PARAMS' and a.\"StationId\"= '$s_id' and a.\"Flag\"= '1' order by \"HydroMetShefCode\",t desc limit 1";
                    }else
                    {
                        $sql_query1="select ('20'||\"Year\"::text ||'-'|| \"Month\"::text ||'-'|| \"Day\" ::text ||' '|| \"Hour\"::text || ':' || \"Minute\" ::text || ':' ||\"Second\")::timestamp as t, \"$valuecol\" from \"'$table'\" a, \"tblHydroMetParamsType\" b where b.\"HydroMetParamsTypeId\"= a.\"HydroMetParamsTypeId\" and (('20'||\"Year\"::text ||'-'|| \"Month\"::text ||'-'|| \"Day\" ::text ||' '|| \"Hour\"::text || ':' || \"Minute\" ::text || ':' || \"Second\")::timestamp <= ('20$Y-$m-$d $h:$i:0')) and a.\"HydroMetParamsTypeId\"='$PARAMS' and a.\"StationId\"= '$s_id' and a.\"Flag\"= '1'  and SensorType='Virtual' order by \"HydroMetShefCode\",t desc limit 1";
                    }
                    // echo $sql_query1;
                    // echo "<br>";
                    // echo "<br>";
                    $outputresult=pg_fetch_array(pg_query($sql_query1));
                    $preValue=$outputresult[1];
                    // $outputresult=pg_query($sql_query1);
					// $sum=0;
					// while($ro=pg_fetch_array($outputresult)){
					// 	$sum=$sum+$ro[1];
					// }
					$sum=$CurrentValue-$preValue;
                    // echo $sql_query1;
                    // echo "<br>";
                    
				}
				if($company=='Hydromet'){

 					$result1=pg_query("SELECT \"CurrentValue\",\"lat\",\"lon\",\"StationShefCode\",\"AlarmFlag\" from \"tblStationLocation\"");
				}
				else{

					$result1=pg_query("SELECT DISTINCT \"CurrentValue\",lat,lon,\"StationShefCode\",\"AlarmFlag\" from \"tblStationLocation\", \"tblCompany2Station\" where \"StationShefCode\" = \"Station\" and \"Company\" = '$company' and \"StationShefCode\"='$StationShefCode' order by \"StationShefCode\"");
				}
					// echo "SELECT DISTINCT \"CurrentValue\",lat,lon,\"StationShefCode\",\"AlarmFlag\" from \"tblStationLocation\", \"tblCompany2Station\" where \"StationShefCode\" = \"Station\" and \"Company\" = '$company' and \"StationShefCode\"='$StationShefCode' order by \"StationShefCode\"";
					// echo "<br>";
					// echo "<br>";
					
					if(pg_num_rows($result1)>0){
						
						while ($out=pg_fetch_array($result1)) {
							// echo "Hello";
							// echo $out[1];
							// echo "<br>";
							// echo "<br>";
							// echo $out[2];
							// echo "<br>";
							// echo "<br>";
							// echo $out[3];
							// echo "<br>";
							// echo "<br>";
							// echo $out[4];
							// echo "<br>";
							// echo "<br>";
							// if($temp==""){
								$output[]=number_format(floatval($sum),$settings[1],'.','')."#".$out[1]."#".$out[2]."#".$out[3]."#".$out[4];
								$temp=$out[4];
							// }
							// else if($temp==$out[4]){

							// }
							

						}
					}
			}
			
		}
	}
	echo json_encode($output);
	
?>
<?php
	function getstationfullname($Name)
	{
  		$stn_name="";
  		$stn_types_set=pg_query("select \"StationType\" from \"tblStationType\"");
		while ($row_types=pg_fetch_array($stn_types_set)) {
			$table=str_replace(" ", "_", $row_types[0]);
 			$stn_set= pg_query("select \"Station_Full_Name\" from \"$table\" where \"Station_Shef_Code\"='$Name'");
 			if (pg_num_rows($stn_set)>0) {

 				$row=pg_fetch_array($stn_set);
				$stn_name=$row[0];
 			}
		}
 		return $stn_name;
	}
?>
