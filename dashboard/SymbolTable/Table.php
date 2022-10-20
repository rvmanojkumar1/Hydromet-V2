<style type="text/css">
	th{
		background-color:#539CCC;
		text-align: center;
		color:white;
		/*text-align:center;*/
		/*font-size: 13px;*/
	}
	th,td{
		padding: 5px!important;
	}
	td{
		font-size: 15px;
	}
	/*#content-desktop {display: block;}
	#content-mobile {display: none;}*/
  .icons{
    font-size: 30px!important;
      padding: 25px 10px!important;
  }
	@media screen and (max-width: 768px) {

		.icons{
      font-size: 25px!important;
      padding: 30px 0px!important;
    }

	}
	.row {
	    margin-right: 0!important;
	    margin-left: 0!important;
	}
	
	#myTable{
		margin-bottom: 30px;
	}
</style>

<?php   
  	
  	function getdata($stations,$sensorname)
  {
  	include_once '../../database.php';
    //echo $sensorname;
    //echo strpos($sensorname, 'we');
    $FY = trim(date('Y'));
    $FY = substr($FY,-2); 
    $DateTime = new DateTime();
    $settings=pg_fetch_array(pg_query("select \"DateFormat\",\"DecimalPlaces\" from \"tblLogo\""));
    $setting=$settings[1];          
    $stations=trim($stations);
    $stationshef=getStationShef($stations);
    
    $table="'tblStation_".$stationshef."_$FY'";
    //$d="";
    if (strpos($sensorname, "Change")!==false) 
    {
      
      $time=explode("(", $sensorname);
      $changesensor=trim(str_replace("Change", "", $time[0]));
      $time=rtrim($time[1],")");
      if(strpos($time, "hr")){
        $time=str_replace("hr", "",$time);
        $time=$time." hours";
      }
      if(strpos($time, "min")){
        $time=str_replace("min", "",$time);
        $time=$time." minutes";
      }
      $sensor_id=getSensorId($stationshef,$changesensor);
      $sensor_type=getSensorType($stationshef,$changesensor);
      $sqlunit=pg_query("SELECT \"Units\" FROM \"SensorValues\" WHERE \"StationFullName\"='$stations' AND \"Sensor\"='$changesensor'");
      $unitresult=pg_fetch_array($sqlunit);
      $units=$unitresult[0];
      $sql="";
      if (trim($sensor_type)=="Real") {

        $sql="select  ('20'||\"Year\"::text ||'-'||\"Month\"::text ||'-'|| \"Day\" ::text ||' '||\"Hour\"::text || ':' || \"Minute\" ::text || ':' ||\"Second\")::timestamp  as t,\"Value\" from \"$table\" where \"HydroMetParamsTypeId\"=$sensor_id order by t desc limit 1";
      }
      else{
        $sql="select  ('20'||\"Year\"::text ||'-'||\"Month\"::text ||'-'|| \"Day\" ::text ||' '||\"Hour\"::text || ':' || \"Minute\" ::text || ':' ||\"Second\")::timestamp  as t,\"VirtualValue\" from \"$table\" where \"HydroMetParamsTypeId\"=$sensor_id order by t desc limit 1";
      }
      $result=pg_query($sql);
      $result=pg_fetch_array($result);
      $current=$result[1];
      
      $d=$result[0];
      $DateTime = new DateTime($d);
      $DateTime->modify("-$time");
      $FY = $DateTime->format("Y");
      $FY = substr($FY,-2);
      
      $FM =  $DateTime->format("m");
      $FD = $DateTime->format("d");
      $m = $DateTime->format("i");
      $h = $DateTime->format("H");

      $sql="";
      if (trim($sensor_type)=="Real") 
      {
        $sql="select  ('2020'||\"Year\"::text ||'-'||\"Month\"::text ||'-'|| \"Day\" ::text ||' '||\"Hour\"::text || ':' || \"Minute\" ::text || ':' ||\"Second\")::timestamp  as t,\"Value\" from \"$table\" where \"HydroMetParamsTypeId\"=$sensor_id and ('20'||\"Year\"::text ||'-'|| \"Month\"::text ||'-'|| \"Day\" ::text ||' '|| \"Hour\"::text || ':' || \"Minute\" ::text || ':' || \"Second\")::timestamp <= ('20$FY-$FM-$FD $h:$m:0') order by t desc limit 1";
      }
      else{
        $sql="select  ('20'||\"Year\"::text ||'-'||\"Month\"::text ||'-'|| \"Day\" ::text ||' '||\"Hour\"::text || ':' || \"Minute\" ::text || ':' ||\"Second\")::timestamp  as t,\"VirtualValue\" from \"$table\" where \"HydroMetParamsTypeId\"=$sensor_id and ('20'||\"Year\"::text ||'-'|| \"Month\"::text ||'-'|| \"Day\" ::text ||' '|| \"Hour\"::text || ':' || \"Minute\" ::text || ':' || \"Second\")::timestamp <= ('20$FY-$FM-$FD $h:$m:0') order by t desc limit 1";
      }

      $result=pg_query($sql);
      $result=pg_fetch_array($result);
      $prechange_value=$result[1];
      $prechange_val=$current-$prechange_value;
      
      if($prechange_value<$current){
        $text="greater";
      }
      else if($prechange_value>$current){
        $text="lesser";
      }
      else{
        $text="normal";
      }
      $color="green";
      $resultset=$d.",".$prechange_val.",".$units.",".$text.",".$color;
      
      return $resultset;

    }
    else if(strpos($sensorname, "%")!==false)
    {
      $stn= str_replace("%", "",  $sensorname);
      $stn= str_replace("of", "",  $stn);
      $stn= str_replace(")", "",  $stn);

      $stn=trim($stn);
      $stn=explode("(", $stn);

      
      $sensor_id=getSensorId($stationshef,$stn[0]);
      $sensor_type=getSensorType($stationshef,$stn[0]);
      $sqlunit=pg_query("SELECT \"Units\" FROM \"SensorValues\" WHERE \"StationFullName\"='$stations' AND \"Sensor\"='$stn[0]'");
      $unitresult=pg_fetch_array($sqlunit);
      $units=$unitresult[0];
      $sql="";
      if (trim($sensor_type)=="Real") {

        $sql="select  ('20'||\"Year\"::text ||'-'||\"Month\"::text ||'-'|| \"Day\" ::text ||' '||\"Hour\"::text || ':' || \"Minute\" ::text || ':' ||\"Second\")::timestamp  as t,\"Value\" from \"$table\" where \"HydroMetParamsTypeId\"=$sensor_id order by t desc limit 1";
      }
      else{
        $sql="select  ('20'||\"Year\"::text ||'-'||\"Month\"::text ||'-'|| \"Day\" ::text ||' '||\"Hour\"::text || ':' || \"Minute\" ::text || ':' ||\"Second\")::timestamp  as t,\"VirtualValue\" from \"$table\" where \"HydroMetParamsTypeId\"=$sensor_id order by t desc limit 1";
      }

      $result=pg_query($sql);
      $result=pg_fetch_array($result);
     
      $capacity_val= getCapacityValue($stn[1],$stationshef);
      $cal_val=$result[1]*100;
      $cal_val=$cal_val/$capacity_val;
      $cal_val=number_format($cal_val,$setting,'.','');

      $d=$result[0];
      $DateTime = new DateTime($d);
      $DateTime->modify("-1 hours");
      $FY = $DateTime->format("Y");
      $FY = substr($FY,-2);
      
      $FM =  $DateTime->format("m");
      $FD = $DateTime->format("d");
      $m = $DateTime->format("i");
      $h = $DateTime->format("H");

      $sql="";
      if (trim($sensor_type)=="Real") 
      {
        $sql="select  ('2020'||\"Year\"::text ||'-'||\"Month\"::text ||'-'|| \"Day\" ::text ||' '||\"Hour\"::text || ':' || \"Minute\" ::text || ':' ||\"Second\")::timestamp  as t,\"Value\" from \"$table\" where \"HydroMetParamsTypeId\"=$sensor_id and ('20'||\"Year\"::text ||'-'|| \"Month\"::text ||'-'|| \"Day\" ::text ||' '|| \"Hour\"::text || ':' || \"Minute\" ::text || ':' || \"Second\")::timestamp <= ('20$FY-$FM-$FD $h:$m:0') order by t desc limit 1";
      }
      else{
        $sql="select  ('20'||\"Year\"::text ||'-'||\"Month\"::text ||'-'|| \"Day\" ::text ||' '||\"Hour\"::text || ':' || \"Minute\" ::text || ':' ||\"Second\")::timestamp  as t,\"VirtualValue\" from \"$table\" where \"HydroMetParamsTypeId\"=$sensor_id and ('20'||\"Year\"::text ||'-'|| \"Month\"::text ||'-'|| \"Day\" ::text ||' '|| \"Hour\"::text || ':' || \"Minute\" ::text || ':' || \"Second\")::timestamp <= ('20$FY-$FM-$FD $h:$m:0') order by t desc limit 1";
      }
      $result=pg_query($sql);
      $result=pg_fetch_array($result);
      
      $capacity_val= getCapacityValue($stn[1],$stationshef);
      $last_val=$result[1]*100;
      $last_val=$last_val/$capacity_val;
      $last_val=number_format($last_val,$setting,'.','');
      if($last_val<$cal_val){
        $text="greater";
      }
      else if($last_val>$cal_val){
        $text="lesser";
      }
      else{
        $text="normal";
      }
      $color="green";
      $resultset=$d.",".$cal_val.",".$units.",".$text.",".$color;
      return $resultset;
    }
    else if(strpos($sensorname, "c-")!==false){

      $sens= trim(str_replace("c-", "",  $sensorname));
      $value=getCapacityValue($sens,trim($stationshef));
      if($value==""){
        $value='N/A';
      }
      $date=strtotime(trim($result[0]));
      $date2= date(trim($settings[0]), $date);
      $text="normal";
      $color="green";
      $resultset=$date2.",".$value.","."".",".$text.",".$color;
      return $resultset;

    }
    else
    {
      
      $sensor_id=getSensorId($stationshef,$sensorname);
      $sensor_type=getSensorType($stationshef,$sensorname);
      $sqlunit=pg_query("SELECT \"Units\" FROM \"SensorValues\" WHERE \"StationFullName\"='$stations' AND \"Sensor\"='$sensorname'");
      $unitresult=pg_fetch_array($sqlunit);
      $units=$unitresult[0];
      $sql="";
      if (trim($sensor_type)=="Real") {

        $sql="select  ('20'||\"Year\"::text ||'-'||\"Month\"::text ||'-'|| \"Day\" ::text ||' '||\"Hour\"::text || ':' || \"Minute\" ::text || ':' ||\"Second\")::timestamp  as t,\"Value\" from \"$table\" where \"HydroMetParamsTypeId\"=$sensor_id order by t desc limit 1";

      }
      else{
        $sql="select  ('20'||\"Year\"::text ||'-'||\"Month\"::text ||'-'|| \"Day\" ::text ||' '||\"Hour\"::text || ':' || \"Minute\" ::text || ':' ||\"Second\")::timestamp  as t,\"VirtualValue\" from \"$table\" where \"HydroMetParamsTypeId\"=$sensor_id order by t desc limit 1";

      }

      $result=pg_query($sql);
      $result=pg_fetch_array($result);

      $value=$result[1];
          
      $d=$result[0];
      
      $DateTime = new DateTime($d);
      $DateTime->modify("-1 hours");
      $FY = $DateTime->format("Y");
      $FY = substr($FY,-2);
      
      $FM =  $DateTime->format("m");
      $FD = $DateTime->format("d");
      $m = $DateTime->format("i");
      $h = $DateTime->format("H");
      $datevalue=date(trim($settings[0]), strtotime($d));

      $sql="";
      if (trim($sensor_type)=="Real") 
      {
        $sql="select  ('2020'||\"Year\"::text ||'-'||\"Month\"::text ||'-'|| \"Day\" ::text ||' '||\"Hour\"::text || ':' || \"Minute\" ::text || ':' ||\"Second\")::timestamp  as t,\"Value\" from \"$table\" where \"HydroMetParamsTypeId\"=$sensor_id and ('20'||\"Year\"::text ||'-'|| \"Month\"::text ||'-'|| \"Day\" ::text ||' '|| \"Hour\"::text || ':' || \"Minute\" ::text || ':' || \"Second\")::timestamp <= ('20$FY-$FM-$FD $h:$m:0') order by t desc limit 1";
      }
      else{
        $sql="select  ('20'||\"Year\"::text ||'-'||\"Month\"::text ||'-'|| \"Day\" ::text ||' '||\"Hour\"::text || ':' || \"Minute\" ::text || ':' ||\"Second\")::timestamp  as t,\"VirtualValue\" from \"$table\" where \"HydroMetParamsTypeId\"=$sensor_id and ('20'||\"Year\"::text ||'-'|| \"Month\"::text ||'-'|| \"Day\" ::text ||' '|| \"Hour\"::text || ':' || \"Minute\" ::text || ':' || \"Second\")::timestamp <= ('20$FY-$FM-$FD $h:$m:0') order by t desc limit 1";
      }
      
      $result=pg_query($sql);
      $result=pg_fetch_array($result);
      $last_value=$result[1];

      if($last_value<$value){
        $text="greater";
      }
      else if($last_value>$value){
        $text="lesser";
      }
      else{
        $text="normal";
      }
      $color=getColor($stationshef,$sensorname,$value);
      //$datevalue=date(trim($settings[0]), $d);
      //echo $settings[0];
      $resultset=$datevalue.",".$value.",".$units.",".$text.",".$color;
      return $resultset;

    }    
  }

  function getColor($stationshef,$sensor,$Value)
  {
    $value=$Value;
    //echo $value."<br>";
    $sensor_name=trim($sensor);
    //echo $sensor_name."<br>";
    $stn_name=getStationName(trim($stationshef));
    //echo $stn_name."<br>";
    $myfile = file_get_contents("../../COLOR.txt", "r");
    // echo $myfile;
    $color=explode(PHP_EOL, $myfile);
    $colordata=array();
    foreach($color as $d){
      $d = explode(',', $d);
      $colordata[]=$d;
    }
    $colors="color";
    // print_r($colordata);
    for($i=0;$i<count($colordata);$i++){
      if($stn_name==$colordata[$i][0]){
        if($sensor_name==$colordata[$i][1]){

          $m=2;
          $v;
          $lens = count($colordata[$i]);
          while($m < $lens){
                        
              if($colordata[$i][$m]=='>'){
                if(($m+4)!=($lens-1)){          
                  if(($value > $colordata[$i][$m+1])&&($value < $colordata[$i][$m+6])){
                    $v=$m;
                    break;
                  }
                }else{
                  if($value > $colordata[$i][$m+1]){
                    $v=$m;
                    break;
                        
                  }
                }
              }
              else if($colordata[$i][$m]=='<'){
                if($m==2){
                  if($value < $colordata[$i][$m+1]){
                    $v=$m;
                    break;
                  }
                }
                else{
                  if(($m+4)!=($lens-1)){
                    if(($value < $colordata[$i][$m+1])&&($value > $colordata[$i][$m-6])){
                      $v=$m;
                      break;
                    }
                  }else{
                    if($value<=$colordata[$i][$m+1]){
                      $v=$m;
                      break;
                    }
                  }
                }
              }
              else if($colordata[$i][$m]=='>='){
                if(($m+4)!=($lens-1)){
                            
                  if(($value>=$colordata[$i][$m+1])&&($value<=$colordata[$i][$m+6])){
                    $v=$m;
                    break;
                  }
                }else{
                  if($value>=$colordata[$i][$m+1]){
                    $v=$m;
                    break;
                          
                  }
                }
              }
              else if($colordata[$i][$m]=='<='){
                if($m==2){
                  if($value<=$colordata[$i][$m+1]){
                    $v=$m;
                    break;
                  }
                }
                else{
                  if(($m+4)!=($lens-1)){
                    if(($value<=$colordata[$i][$m+1])&&($value>=$colordata[$i][$m-6])){
                      $v=$m;
                      break;
                    }
                  }else{
                    if($value<=$colordata[$i][$m+1]){
                      $v=$m;
                      break;
                    }
                  }
                }
              }
              $m=$m+5;
            }
            if($colordata[$i][$v]=='>'){
              if(($v+4)!=($lens-1)){          
                if(($value > $colordata[$i][$v+1])&&($value < $colordata[$i][$v+6])){
                  $colors=$colordata[$i][$v+2];
                }
              }else{
                if($value > $colordata[$i][$v+1]){
                  $colors=$colordata[$i][$v+2]; 
                }
              }
            }
            else if($colordata[$i][$v]=='<'){
              if($v==2){
                if($value < $colordata[$i][$v+1]){
                  $colors=$colordata[$i][$v+2];
                }
              }
              else{
                if(($v+4)!=($lens-1)){
                  if(($value < $colordata[$i][$v+1])&&($value > $colordata[$i][$v-6])){
                    $colors=$colordata[$i][$v+2];
                  }
                }else{
                  if($value<=$colordata[$i][$v+1]){
                    $colors=$colordata[$i][$v+2];
                  }
                }
              }
            }
            else if($colordata[$i][$v]=='>='){
              if(($v+4)!=($lens-1)){
                            
                if(($value>=$colordata[$i][$v+1])&&($value<=$colordata[$i][$v+6])){
                  $colors=$colordata[$i][$v+2];
                }
              }else{
                if($value>=$colordata[$i][$v+1]){
                  $colors=$colordata[$i][$v+2];      
                }
              }
            }
            else if($colordata[$i][$v]=='<='){
              if($v==2){
                if($value<=$colordata[$i][$v+1]){
                  $colors=$colordata[$i][$v+2];
                }
              }
              else{
                if(($v+4)!=($lens-1)){
                  if(($value<=$colordata[$i][$v+1])&&($value>=$colordata[$i][$v-6])){
                    $colors=$colordata[$i][$v+2];
                  }
                }else{
                  if($value<=$colordata[$i][$v+1]){
                    $colors=$colordata[$i][$v+2];
                  }
                }
              }
            }
            
        }
      }
    }
    if($colors=="color"){
      $colors="green";
    }
    if($colors=="yellow"){
    	$colors="black";
    }
    // echo $colors;
    return $colors;
  }

  	function getSensorType($stn_name,$sensor_name)
  	{
	    $sensor_name=trim($sensor_name);
	    $stn_name=getStationName(trim($stn_name));
	    $shef_set= pg_query("select \"SensorType\" from \"SensorValues\" where \"StationFullName\"='$stn_name' and \"Sensor\"='$sensor_name'");
	    $row=pg_fetch_array($shef_set);

	    return $row[0];
  	}
  	function getSensorId($stn_name,$sensor_name)
  	{
	    $sensor_name=trim($sensor_name);
	    $stn_name=getStationName(trim($stn_name));
	    $shef_set= pg_query("select \"SHEF\" from \"SensorValues\" where \"StationFullName\"='$stn_name' and \"Sensor\"='$sensor_name'");
	    $row=pg_fetch_array($shef_set);
	    $Shef=$row[0];
	    $id_set= pg_query("select \"HydroMetParamsTypeId\" from \"tblHydroMetParamsType\" where \"HydroMetShefCode\"='$Shef'");

	    $row=pg_fetch_array($id_set);
	    return $row[0];
  	}

  	function getStationName($shef)
  	{
	    $stn_name="";
	    $stn_types_set=pg_query("select \"StationType\" from \"tblStationType\"");
	    while ($row_types=pg_fetch_array($stn_types_set)) {
	    	$table=str_replace(" ", "_", $row_types[0]);
	      	$stn_set= pg_query("select \"Station_Full_Name\" from \"$table\" where \"Station_Shef_Code\"='$shef'");
	      	if (pg_num_rows($stn_set)>0) {
	     
	        	$row=pg_fetch_array($stn_set);
	        	$stn_name=$row[0];
	      	}

	    }

	    return $stn_name;
  	}
  	function getStationShef($station)
  	{
    	$stn_shef="";
    	$station=trim($station);
    	$stn_types_set=pg_query("select \"StationType\" from \"tblStationType\"");
    	while ($row_types=pg_fetch_array($stn_types_set)) {
      		$table=str_replace(" ", "_", $row_types[0]);
      		$stn_set= pg_query("select \"Station_Shef_Code\" from \"$table\" where \"Station_Full_Name\"='$station'");
      		if (pg_num_rows($stn_set)>0) {
        		$row=pg_fetch_array($stn_set);
        		$stn_shef=$row[0];
      		}

    	}

    	return $stn_shef;
  	}
  	function getStationTypeName($shef)
  	{
	    $stn_type="";
	    $stn_types_set=pg_query("select \"StationType\" from \"tblStationType\"");
	    while ($row_types=pg_fetch_array($stn_types_set)) {
		    $table=str_replace(" ", "_", $row_types[0]);
		    $stn_set= pg_query("select \"Station_Full_Name\" from \"$table\" where \"Station_Shef_Code\"='$shef'");
	    	if (pg_num_rows($stn_set)>0) {
        		$row=pg_fetch_array($stn_set);
        		$stn_type=$row_types[0];
      		}

    	}
    	return $stn_type;
  	}

  	function getCapacityValue($col_name,$stn_shef)
  	{
	    $table=str_replace(" ", "_", trim(getStationTypeName($stn_shef))) ;
	    $col_name=getColumnName($table,trim($col_name));
	    $col_name=str_replace(" ", "_", trim( $col_name));
	    $sql="select \"$col_name\" from  \"$table\" where \"Station_Shef_Code\"='$stn_shef'";
    
    	$row= pg_fetch_array(pg_query($sql));

    	return $row[0];
  	}

  	function getColumnName($stntype,$data)
  	{
    	$stntype=str_replace(" ", "_",trim($stntype));
    	$sql="select \"StationField\" from  \"DefineStations\" where \"StationField\" like '%$data%'";
    
    	$row= pg_fetch_array(pg_query($sql));

    	return $row[0];
  	}
?>
<?php
  $num=$_GET['num'];
	$name=$_GET['name'];
  $table_name=explode('Table', $name);
  $table_name=$table_name[0];
	$file = file_get_contents($name.$num.".txt");
	$data = explode(';', $file);
	$array = array();
	$sensors = array();
	foreach($data as $d) {
	    $d = explode(',', $d);
	    $array[] = $d;
	}	
      //print_r($array);
  
	$stations = array_column($array, 0);
	for($i=1;$i<count($array[0]);$i++){
		$sensors[] = array_column($array, $i);
	}
	//print_r($sensors);
?>
<div class="row">
	<div class='row'>
		<div class='col-md-12'>
			<table align='center' style='max-width:90%;min-width:60%;' class='table'>
				<tr>
					<td colspan="2">
						<label><?php echo $table_name;?> Template ( Table <?php echo $num;?> )</label>
					</td>
				</tr>
			</table>
		</div>
	</div>
	<center>
		<div class="row" id="content-desktop">
			<div class="col-md-12">
				<table id="myTable1" class="table-bordered table-responsives" style="max-width:90%;min-width:60%;">
					<!-- <tr>
						 <?php 
							// for($i=0;$i<count($stations);$i++){
							// 	if($stations[$i]!=""){
									?>
										<th>
											<?php // echo $stations[$i];?> 
										</th>
									<?php
							// 	}
							// }
						?>
					</tr> -->
					<?php
						for($i=0;$i<count($sensors);$i++){
							?>
								<!-- <tr> -->
									<?php
										$len=count($sensors[$i]);
										$k=0;
										$temp_date="";
										while($k<$len){
											$result=getdata($stations[$k],$sensors[$i][$k]);
											$resultdata=explode(',', $result);
                      // echo $resultdate;
                      // echo "<br>";
											$resultdate=$resultdata[0];
                      $present=date("Y-m-d h:i A");
                      $check=abs(strtotime($resultdate) - strtotime($present))/(60*60);
                      $check_mins=$check*60;
                      // echo $check_mins;
                      // echo "<br>";
                      if($temp_date==""){
												$temp_date=$resultdate;
											}
											$resultvalue=$resultdata[1];
											$resultunits=$resultdata[2];
											$resulttext=$resultdata[3];
                      if($check_mins>90){
                        $resultcolor="grey";
                      }
                      else{
                        $resultcolor=$resultdata[4];
                      }
											if(strpos($sensors[$i][$k], "c-")!==false){
												$resultdate=$temp_date;
											}
											if($resulttext=="greater"){
												$symbol="fa fa-arrow-up";
											}
											else if($resulttext=="lesser"){
												$symbol="fa fa-arrow-down";
											}
											else if($resulttext=="normal"){
												$symbol="fa fa-circle";
											}
											?>
                      <tr>
  											<td>
                          <center>
    												<div class="row">
    													<div class="col-xs-2">
                                <center>
    														  <i class="<?php echo $symbol;?> icons" style="color: <?php echo $resultcolor; ?>" aria-hidden="true"></i>
                                </center>
    													</div>
    													<div class="col-xs-8" style="text-align: left;">
                                <p><b><?php echo $stations[$k];?></b></p>
    														<a style="color:green" href="javascript:PlotGraph('<?php echo $sensors[$i][$k]; ?>','<?php echo $stations[$k]; ?>')"><p style="color: <?php echo $resultcolor; ?>"><?php echo $sensors[$i][$k]; ?><b> : </b><?php if($resultunits!=""){echo number_format($resultvalue,2)."(".$resultunits.")";}else{echo number_format($resultvalue,2);}?></p></a>
    														<p><?php echo $resultdate; ?></p>
    													</div>
    												</div>
                          </center>
  											</td>
                      </tr>
											<?php
											$k++;
										}
									?>
								<!-- </tr> -->
							<?php
						}
					?>
				</table>
			</div>
		</div>
		<!-- <div class="row" id="content-mobile"> -->
			<!-- <?php
				//for($i=0;$i<count($array)-1;$i++){
					?>
						<div class="col-md-4">
								<table id="myTable" class="table-bordered table-responsives" style="width:90%;min-width:60%;">
									<tr>
										<th>
											<?php //echo $array[$i][0];?>
										</th>
									</tr>
					<?php
					// for($j=1;$j<count($array[$i]);$j++){
					// 	$result=getdata($array[$i][0],$array[$i][$j]);
					// 	$resultdata=explode(',', $result);
					// 	$resultdate=$resultdata[0];
					// 	if($temp_date==""){
					// 		$temp_date=$resultdate;
					// 	}
					// 	$resultvalue=$resultdata[1];
					// 	$resultunits=$resultdata[2];
					// 	$resulttext=$resultdata[3];
					// 	$resultcolor=$resultdata[4];
					// 	if(strpos($sensors[$i][$k], "c-")!==false){
					// 		$resultdate=$temp_date;
					// 	}
					// 	if($resulttext=="greater"){
					// 		$symbol="fa fa-arrow-up";
					// 	}
					// 	else if($resulttext=="lesser"){
					// 		$symbol="fa fa-arrow-down";
					// 	}
					// 	else if($resulttext=="normal"){
					// 		$symbol="fa fa-circle";
					// 	}
						 
					?>		
									<tr>
										<td>
											<div class="row">
													<div class="col-xs-2">
														<i class="<?php //echo $symbol;?> icons" style="color: <?php// echo $resultcolor; ?>" aria-hidden="true"></i>
													</div>
													<div class="col-xs-10">
														<p style="color: <?php //echo $resultcolor; ?>"><?php //echo $array[$i][$j]; ?><b> : </b><?php //if($resultunits!=""){echo $resultvalue."(".$resultunits.")";}else{echo $resultvalue;}?></p>
														<p><?php// echo $resultdate; ?></p>
													</div>
												</div>
										</td>
									</tr>
						<?php
					//}
					?>
					</table>
							</div>
					<?php
				//}
			?>
		</div>
	</center>
</div>
