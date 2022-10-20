<?php
    class MapData{
        private $conn;
        private $table;

        public function __construct($db){
            $this->conn = $db;
        }

        public function getMapData(){
            $sensor = $this->post_data['sensor'];
            $company = $this->post_data['company'];

            $datesetting=$this->getdateformat();

            $numbersetting=$this->getnumberformat();
            
            $query="select DISTINCT a.lat,a.lon,a.\"StationShefCode\",a.\"StationFullName\",a.\"AlarmFlag\",c.\"StationId\",d.\"StationName\" from \"tblStationLocation\" a, \"tblCompany2Station\" b, \"station_sensor_type\" c,\"tblStation\" d where a.\"StationShefCode\" = b.\"Station\" and c.\"StationId\"=d.\"StationId\" and d.\"StationName\"=a.\"StationShefCode\" and b.\"Company\" = '".$company."' order by a.\"StationShefCode\"";

            $locationstation = $this->conn->prepare($query);
            // $locationstation = pg_query($query);

            $locationstation->execute();

            $response=array();

            $getdetails=array();

            if ($locationstation->rowCount() > 0)
            {

                

                while ($rows = $locationstation->fetch(PDO::FETCH_ASSOC)){

                    

                    $statationId=$rows['StationId'];
                    $StationFullName=$rows['StationFullName'];
                    $StationShefcode=$rows['StationShefCode'];
                    $lat=$rows['lat'];
                    $lon=$rows['lon'];

                    $current="SELECT distinct sv.\"Sensor\",sst.\"Value\",sst.\"VirtualValue\",sv.\"SensorType\" ,sv.\"Units\",('20'||\"Year\"::text ||'-'||\"Month\"::text ||'-'|| \"Day\" ::text ||' '||\"Hour\"::text || ':'|| \"Minute\" ::text || ':'||\"Second\")::timestamp as t FROM \"station_sensor_type\" sst, \"tblHydroMetParamsType\" hpt, \"SensorValues\" sv, \"tblStationLocation\" stl, \"tblStation\" st where sst.\"HydroMetParamsTypeId\" = hpt.\"HydroMetParamsTypeId\" and hpt.\"HydroMetShefCode\" = sv.\"SHEF\" and sst.\"StationId\" = ".$statationId." and st.\"StationId\" = ".$statationId." and st.\"StationName\" = stl.\"StationShefCode\" and sv.\"StationFullName\" = stl.\"StationFullName\"";

                    $table = $this->conn->prepare($current);
                    // $table=pg_query($tablequery);
                    $table->execute();

                    if ($table->rowCount() > 0)
                    {
                        // return array(true,'',$locationstation->rowCount());
                        $html_table="<label>$StationFullName</label><br><table class='table-responsive table-hover' style='width:100%;'><thead><tr><th class='pop_th'>Date</th><th class='pop_th'>Sensor</th><th class='pop_th'>Value</th></tr></thead><tbody>";
                        $current="";
                        $color="";
                        // $Sensorvalue="";
                        while ($rowedtable = $table->fetch(PDO::FETCH_ASSOC)){
                            $date=date(trim($datesetting),strtotime(trim($rowedtable['t'])));
                            $checksensor=$rowedtable['Sensor'];

                            if($rowedtable['SensorType']=='Real')
                                $Sensorvalue=number_format(floatval($rowedtable['Value']),2);
                            else
                                $Sensorvalue=number_format(floatval($rowedtable['VirtualValue']),2);

                            if($checksensor==$sensor){
                                $current=$Sensorvalue;
                                $color=$this->getcolor($sensor,$StationFullName,$date,$current);
                            }
                            if($rowedtable['Units']!=""){
                                $html_table.="<tr><td>".$date."</td><td>".$rowedtable['Sensor']." "."(".$rowedtable['Units'].")"."</td><td>".$Sensorvalue."</td></tr>";
                            }
                            else{
                                $html_table.="<tr><td>".$date."</td><td>".$rowedtable['Sensor']."</td><td>".$Sensorvalue."</td></tr>";
                            }
                        }
                        if($current!=""){
                            $getdetails=array("lat"=>$lat,"lon"=>$lon,"color"=>$color,"Font"=>'white',"currentvalue"=>$current,"table"=>$html_table);
                            // array_push($getdetails,array());
                            array_push($response, $getdetails);
                        }
                    }
                    
                }
            }
            else{
                $response="No Station in this company";
            }

            if(count($response)>0){
                // $responded=array("Data"=>$response);
                return array(true,'succ',$response);
            }
            else{
                return array(false,'No Data Found','');
            }

        }

        public function getRaincolor($value){
            $myFile = "../../includes/rain-color.txt";
            
            $lines = file($myFile);//file in to an array
            
            $resultcolor="";

            foreach($lines as $line) 
            {
                $textarray = explode("-",$line);

                $temp=$textarray[0];

                if(floatval($value)<floatval($textarray[0])){
                    $resultcolor=$textarray[1];
                    break;
                }
                else if(floatval($value)>floatval($textarray[0])){
                    $resultcolor=$textarray[1];
                }
            }
            return $resultcolor;      
        }

        public function getMapRainfallData(){
            $sensor = $this->post_data['sensor'];
            $company = $this->post_data['company'];
            $time = $this->post_data['time'];

            $time = str_replace("rain","",$time);

            $datesetting=$this->getdateformat();

            $numbersetting=$this->getnumberformat();

            $query="select DISTINCT a.lat,a.lon,a.\"StationShefCode\",a.\"StationFullName\",a.\"AlarmFlag\",c.\"StationId\",d.\"StationName\" from \"tblStationLocation\" a, \"tblCompany2Station\" b, \"station_sensor_type\" c,\"tblStation\" d where a.\"StationShefCode\" = b.\"Station\" and c.\"StationId\"=d.\"StationId\" and d.\"StationName\"=a.\"StationShefCode\" and b.\"Company\" = '".$company."' order by a.\"StationShefCode\"";

            $locationstation = $this->conn->prepare($query);
            // $locationstation = pg_query($query);

            $locationstation->execute();

            $response=array();

            $getdetails=array();
            $result="";
            $sql_query1="";
            $statationId="";
            $StationFullName="";
            if ($locationstation->rowCount() > 0)
            {
                while ($rows = $locationstation->fetch(PDO::FETCH_ASSOC)){
                    $statationId=$rows['StationId'];
                    $StationFullName=$rows['StationFullName'];
                    $StationShefcode=$rows['StationShefCode'];
                    $lat=$rows['lat'];
                    $lon=$rows['lon'];

                    $result="SELECT \"SHEF\",\"SensorType\" FROM \"SensorValues\" where \"Sensor\"='$sensor' and \"StationFullName\"='$StationFullName'";

                    $Sensorresult = $this->conn->prepare($result);

                    $Sensorresult->execute();

                    if ($Sensorresult->rowCount() > 0)
                    {
                        $rowsensor = $Sensorresult->fetch(PDO::FETCH_ASSOC);

                        $sensorshef=$rowsensor['SHEF'];
                        $SensorType=$rowsensor['SensorType'];
                        $valuecol="Value";

                        $PARAMS=$this->gethydroparamsid($sensorshef);
                        
                        if($SensorType=='Virtual'){
                            $valuecol="VirtualValue";
                        }
                        else{
                            $valuecol="Value";
                        }

                        $sql1="SELECT \"TableName\" as \"Tab\" FROM \"tblAllTables\" WHERE \"StationName\"='".$StationShefcode."' order by 1 desc limit 1";

                        $Tablename = $this->conn->prepare($sql1);

                        $Tablename->execute();

                        if ($Tablename->rowCount() > 0)
                        {
                            $current="";
                            $color="";
                            
                            $rowstablename = $Tablename->fetch(PDO::FETCH_ASSOC);
                            
                            $tabname=$rowstablename['Tab'];

                            if ($valuecol=="Value") {
                                $sql_query="select ('20'||\"Year\"::text ||'-'|| \"Month\"::text ||'-'|| \"Day\" ::text ||' '|| \"Hour\"::text || ':' || \"Minute\" ::text || ':' ||\"Second\")::timestamp as t, \"$valuecol\" from \"'$tabname'\" a, \"tblHydroMetParamsType\" b  where b.\"HydroMetParamsTypeId\" = a.\"HydroMetParamsTypeId\" and a.\"HydroMetParamsTypeId\"='".$PARAMS."' and a.\"StationId\"= '".$statationId."'  and a.\"Flag\"= '1'  order by \"HydroMetShefCode\",t desc limit 1";
                            }
                            else
                            {
                                $sql_query="select ('20'||\"Year\"::text ||'-'|| \"Month\"::text ||'-'|| \"Day\" ::text ||' '|| \"Hour\"::text || ':' || \"Minute\" ::text || ':' ||\"Second\")::timestamp as t, \"$valuecol\" from \"'$tabname'\" a, \"tblHydroMetParamsType\" b where b.\"HydroMetParamsTypeId\" = a.\"HydroMetParamsTypeId\" and a.\"HydroMetParamsTypeId\"='".$PARAMS."' and a.\"StationId\"= '".$statationId."'  and a.\"Flag\"= '1' and SensorType='Virtual'  order by \"HydroMetShefCode\",t desc limit 1";
                            }

                            $firstquery=$this->conn->prepare($sql_query);

                            $firstquery->execute();

                            $currenttime="";
                            $CurrentValue="";

                            if($firstquery->rowCount()>0){
                                $currenttable=$firstquery->fetch(PDO::FETCH_ASSOC);

                                $currenttime=$currenttable['t'];

                                $CurrentValue=$currenttable[$valuecol];
                            }
                                

                            if($time=='Year'){
                                $year=date("Y");
                                $previousdate=date("Y-m-d h:i:s",strtotime('01-01-'.$year));
                                // echo $previousdate;
                                $days=(strtotime($currenttime) - strtotime($previousdate))/60/60/24; 
                                $time=$days*24;
                            }
                            else if($time=='PrevYear'){
                                $d=date("d");
                                $m=date("m");
                                $y=date("Y")-1;
                                $previousdate=date("Y-m-d h:i:s",strtotime($d.'-'.$m.'-'.$y));
                                // echo $table;
                                // echo "<br>";
                                $replace=substr($tabname, -2);
                                $tabname=str_replace($replace, $replace-1, $tabname);
                                $days=(strtotime($currenttime) - strtotime($previousdate))/60/60/24; 
                                $time=$days*24;
                                // echo $table;
                                // echo "<br>";
                                    
                            }
                                
                            $timestamp=strtotime($currenttime);
                            $TmStamp=$timestamp-($time*60*60);
                                
                            $Y = date("Y", $TmStamp);
                            $Y = trim(substr($Y,-2));
                            $m = trim(date("m", $TmStamp));
                            $d = trim(date("d", $TmStamp));
                            $h = trim(date("h", $TmStamp));
                            $i = trim(date("i", $TmStamp));
                                // echo date("Y-m-d h:i", $TmStamp);
                                // echo "<br>";
                                // echo "<br>";
                                
                            if ($valuecol=="Value") {
                                $sql_queryold="select ('20'||\"Year\"::text ||'-'|| \"Month\"::text ||'-'|| \"Day\" ::text ||' '|| \"Hour\"::text || ':' || \"Minute\" ::text || ':' ||\"Second\")::timestamp as \"time\", \"$valuecol\" as \"sensvalue\" from \"'$tabname'\" a, \"tblHydroMetParamsType\" b where b.\"HydroMetParamsTypeId\"= a.\"HydroMetParamsTypeId\" and (('20'||\"Year\"::text ||'-'|| \"Month\"::text ||'-'|| \"Day\" ::text ||' '|| \"Hour\"::text || ':' || \"Minute\" ::text || ':' || \"Second\")::timestamp <= ('20$Y-$m-$d $h:$i:0')) and a.\"HydroMetParamsTypeId\"='".$PARAMS."' and a.\"StationId\"= '".$statationId."' and a.\"Flag\"= '1' order by \"HydroMetShefCode\",\"time\" desc limit 1";
                            }
                            else
                            {
                                $sql_queryold="select ('20'||\"Year\"::text ||'-'|| \"Month\"::text ||'-'|| \"Day\" ::text ||' '|| \"Hour\"::text || ':' || \"Minute\" ::text || ':' ||\"Second\")::timestamp as \"time\", \"$valuecol\" as \"sensvalue\" from \"'$tabname'\" a, \"tblHydroMetParamsType\" b where b.\"HydroMetParamsTypeId\"= a.\"HydroMetParamsTypeId\" and (('20'||\"Year\"::text ||'-'|| \"Month\"::text ||'-'|| \"Day\" ::text ||' '|| \"Hour\"::text || ':' || \"Minute\" ::text || ':' || \"Second\")::timestamp <= ('20$Y-$m-$d $h:$i:0')) and a.\"HydroMetParamsTypeId\"='".$PARAMS."' and a.\"StationId\"= '".$statationId."' and a.\"Flag\"= '1'  and SensorType='Virtual' order by \"HydroMetShefCode\",\"time\" desc limit 1";
                            }
                            $secondquery=$this->conn->prepare($sql_queryold);

                            $secondquery->execute();
                            
                            $oldvalue="";
                            $oldtime="";

                            if($secondquery->rowCount() > 0){
                                $oldtable=$secondquery->fetch(PDO::FETCH_ASSOC);

                                $oldtime=$oldtable['time'];

                                $oldvalue=$oldtable['sensvalue'];

                                    
                            }

                            $current=floatval($CurrentValue)-floatval($oldvalue);

                            $color=$this->getRaincolor($current);
                            
                            $html_table="";

                            $currenttable="SELECT distinct sv.\"Sensor\",sst.\"Value\",sst.\"VirtualValue\",sv.\"SensorType\" ,sv.\"Units\",('20'||\"Year\"::text ||'-'||\"Month\"::text ||'-'|| \"Day\" ::text ||' '||\"Hour\"::text || ':'|| \"Minute\" ::text || ':'||\"Second\")::timestamp as t FROM \"station_sensor_type\" sst, \"tblHydroMetParamsType\" hpt, \"SensorValues\" sv, \"tblStationLocation\" stl, \"tblStation\" st where sst.\"HydroMetParamsTypeId\" = hpt.\"HydroMetParamsTypeId\" and hpt.\"HydroMetShefCode\" = sv.\"SHEF\" and sst.\"StationId\" = '".$statationId."' and st.\"StationId\" = '".$statationId."' and st.\"StationName\" = stl.\"StationShefCode\" and sv.\"StationFullName\" = stl.\"StationFullName\"";

                            $table = $this->conn->prepare($currenttable);
                            // $table=pg_query($tablequery);
                            $table->execute();

                            if ($table->rowCount() > 0)
                            {
                                // return array(true,'',$locationstation->rowCount());
                                $html_table="<label>$StationFullName</label><br><table class='table-responsive table-hover' style='width:100%;'><thead><tr><th class='pop_th'>Date</th><th class='pop_th'>Sensor</th><th class='pop_th'>Value</th></tr></thead><tbody>";
                        
                                while ($rowedtable = $table->fetch(PDO::FETCH_ASSOC)){
                                    $date=date(trim($datesetting),strtotime(trim($rowedtable['t'])));
                                    // $checksensor=$rowedtable['Sensor'];

                                    if($rowedtable['SensorType']=='Real')
                                        $Sensorvalue=number_format(floatval($rowedtable['Value']),2);
                                    else
                                        $Sensorvalue=number_format(floatval($rowedtable['VirtualValue']),2);

                                    // if($checksensor==$sensor){
                                    //     $current=$Sensorvalue;
                                    //     $color=$this->getcolor($sensor,$StationFullName,$date,$current);
                                    // }
                                    if($rowedtable['Units']!=""){
                                        $html_table.="<tr><td>".$date."</td><td>".$rowedtable['Sensor']." "."(".$rowedtable['Units'].")"."</td><td>".$Sensorvalue."</td></tr>";
                                    }
                                    else{
                                        $html_table.="<tr><td>".$date."</td><td>".$rowedtable['Sensor']."</td><td>".$Sensorvalue."</td></tr>";
                                    }
                                }
                            }

                            if($current!=""||$current==0){
                                $getdetails=array("lat"=>$lat,"lon"=>$lon,"color"=>$color,"Font"=>'black',"currentvalue"=>number_format(floatval($current),$numbersetting,'.',''),"table"=>$html_table);
                                // array_push($getdetails,array());
                                array_push($response, $getdetails);
                            }
                        }

                        
                    
                    }

                }
                if(count($response)>0){
                    // $responded=array("Data"=>$response);
                    return array(true,'succ',$response);
                }
                else{
                    return array(false,$tab,'');
                }
                
            }

            // return array(true,'succ',$query);

            // if($current!=""){
            //     $getdetails=array("lat"=>$lat,"lon"=>$lon,"color"=>$color,"Font"=>'black',"currentvalue"=>$current,"table"=>$this->getTablebyId($stationId, $StationFullName, $sensor));
            //     // array_push($getdetails,array());
            //     array_push($response, $getdetails);
            // }
            
            
            
        }

        public function getnumberformat(){
            $stmtquery = "select \"DateFormat\",\"DecimalPlaces\" from \"tblLogo\"";

            $stmtnew = $this->conn->prepare($stmtquery);
                        
            $stmtnew->execute();

            $settings=$stmtnew->fetch(PDO::FETCH_ASSOC);

            return $settings['DecimalPlaces'];
        }
        public function gethydroparamsid($sensorshef){
            $paraId="SELECT \"HydroMetParamsTypeId\" FROM \"tblHydroMetParamsType\" where  \"HydroMetShefCode\" = '$sensorshef'";

            $ParamId = $this->conn->prepare($paraId);

            $ParamId->execute();

            $PARAMS="";

            if($ParamId->rowCount()>0){
                $getParamId = $ParamId->fetch(PDO::FETCH_ASSOC);

                $PARAMS=$getParamId['HydroMetParamsTypeId'];
            }

            return $PARAMS;
        }
        public function getcolor($sensor,$StationFullName,$date,$current){
            $myFile = "../../COLOR.txt";
            $lines = file($myFile);//file in to an array
            
            // $start=strtotime(date("Y-m-d h:i A"));

            // $end = strtotime(date("Y-m-d h:i A",strtotime($date)));

            // $mins = date("i",round(abs($start - $end) / 60,2));
            date_default_timezone_set('America/Los_Angeles');

            $startdate=date("Y-m-d h:i A");
            $origin = new DateTime($startdate);
            // $origin = new DateTime(date("Y-m-d h:i A",$start));

            $target = new DateTime($date);

            $interval = $origin->diff($target);

            $mins = (($interval->format('%d')*24) + $interval->format('%h'))*60 + $interval->format('%i'); //1440 (difference in minutes)


            $resultcolor="";

            if($mins>60){
                $resultcolor="grey";
            }
            else{
                foreach($lines as $line) 
                {
                    $textarray = explode(",",$line);
                    
                    if($textarray[0]==$StationFullName){
                        if($textarray[1]==$sensor){
                            for($g=5;$g<count($textarray);$g=$g+5){
                                // if($textarray[$g]=='1'){
                                    if($textarray[$g-3]=='<'){
                                        if(floatval($current)<floatval($textarray[$g-2])){
                                            $resultcolor=$textarray[$g-1];
                                            break;
                                        }
                                    }
                                    if($textarray[$g-3]=='<='){
                                        if(floatval($current)<=floatval($textarray[$g-2])){
                                            $resultcolor=$textarray[$g-1];
                                            break;
                                        }
                                    }
                                    if($textarray[$g-3]=='>='){
                                        if(floatval($current)>=floatval($textarray[$g-2])){
                                            $resultcolor=$textarray[$g-1];
                                            break;
                                        }
                                    }
                                    if($textarray[$g-3]=='>'){
                                        if(floatval($current)>floatval($textarray[$g-2])){
                                            $resultcolor=$textarray[$g-1];
                                            break;
                                        }
                                    }
                                // }
                            }
                        }
                    }
                    
                }
            }
            if($resultcolor==""){
                $resultcolor="green";
            }
            return $resultcolor;
        }
        public function getdateformat(){

            $stmtquery = "select \"DateFormat\",\"DecimalPlaces\" from \"tblLogo\"";

            $stmtnew = $this->conn->prepare($stmtquery);
                        
            $stmtnew->execute();

            $settings=$stmtnew->fetch(PDO::FETCH_ASSOC);

            return $settings['DateFormat'];

        }
        public function getApiResponse($res) {
       
            if (count($res) == 2) {
                list($success, $msg) = $res;
                $data = "";
            } else
                list($success, $msg, $data) = $res;
            if ($success) {
                if ($msg == "SUCCESS_ADD") {
                    $msg = "SUCCESS";
                    //http_response_code(201);
                }
                else {
                   // http_response_code(200);
                }
                $this->response = array("success" => "true", "message" => $msg, "data" => $data);
            } else {
                if (is_null($msg) || $msg==""){
                //http_response_code(400);
                }
                else if($msg=="NO_DATA_FOUND"){
                   //http_response_code(404); 
                }
                $this->response = array("success" => "false", "message" => $msg, "data" => '');
            }
            $response = $this->response;
            if (isset($res['total'])) {
                $response['total'] = $res['total'];
            }
            if (isset($res['rights'])) {
                $response['rights'] = $res['rights'];
            }
            if (isset($res['total_new'])) {
                $response['total_new'] = $res['total_new'];
            }
            
             if (isset($res['response_code'])) {
                //http_response_code($res['response_code']);
            }
            //var_dump(http_response_code(404));
            //var_dump(http_response_code());

            // header("Access-Control-Allow-Origin: *");
            // header("Access-Control-Expose-Headers: Content-Type, Content-Length, X-JSON, Tokenid, host, date, cookie, cookie2");
            //header("Access-Control-Expose-Headers: *");
            // header("Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS");
            // header("Access-Control-Allow-Headers: *");
            header('Content-Type: application/json');
            echo json_encode($response);
        }
        
        public function getTablebyId($stationId, $stationFullName, $sensor){
            
            $current="SELECT distinct sv.\"Sensor\",sst.\"Value\",sst.\"VirtualValue\",sv.\"SensorType\" ,sv.\"Units\",('20'||\"Year\"::text ||'-'||\"Month\"::text ||'-'|| \"Day\" ::text ||' '||\"Hour\"::text || ':'|| \"Minute\" ::text || ':'||\"Second\")::timestamp as t FROM \"station_sensor_type\" sst, \"tblHydroMetParamsType\" hpt, \"SensorValues\" sv, \"tblStationLocation\" stl, \"tblStation\" st where sst.\"HydroMetParamsTypeId\" = hpt.\"HydroMetParamsTypeId\" and hpt.\"HydroMetShefCode\" = sv.\"SHEF\" and sst.\"StationId\" = ".$stationId." and st.\"StationId\" = ".$stationId." and st.\"StationName\" = stl.\"StationShefCode\" and sv.\"StationFullName\" = stl.\"StationFullName\"";

            $table = $this->conn->prepare($current);
            
            $table->execute();

            if ($table->rowCount() > 0)
            {
                $datesetting=$this->getdateformat();

                $html_table="<label>$stationFullName</label><br><table class='table-responsive table-hover' style='width:100%;'><thead><tr><th class='pop_th'>Date</th><th class='pop_th'>Sensor</th><th class='pop_th'>Value</th></tr></thead><tbody>";
                $current="";
                $color="";
                while ($rowedtable = $table->fetch(PDO::FETCH_ASSOC)){
                    $date=date(trim($datesetting),strtotime(trim($rowedtable['t'])));
                    $checksensor=$rowedtable['Sensor'];

                    if($rowedtable['SensorType']=='Real')
                        $Sensorvalue=number_format(floatval($rowedtable['Value']),2);
                    else
                        $Sensorvalue=number_format(floatval($rowedtable['VirtualValue']),2);

                    if($checksensor==$sensor){
                        $current=$Sensorvalue;
                        // $color=$this->getRaincolor($sensor,$StationFullName,$date,$current);
                    }
                    if($rowedtable['Units']!=""){
                        $html_table.="<tr><td>".$date."</td><td>".$rowedtable['Sensor']." "."(".$rowedtable['Units'].")"."</td><td>".$Sensorvalue."</td></tr>";
                    }
                    else{
                        $html_table.="<tr><td>".$date."</td><td>".$rowedtable['Sensor']."</td><td>".$Sensorvalue."</td></tr>";
                    }
                }
            }

            return $html_table;
        }
    }
?>