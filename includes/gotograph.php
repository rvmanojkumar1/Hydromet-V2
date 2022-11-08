<?php
include ('database.php');
//include database, for connecting to the PostGres Database

$stn_name;
if (isset($_GET['lat'])&&isset($_GET['lat'])) {
  # code...
  //if lat and lat are given as input

$lat=$_GET['lat'];
$lon=$_GET['lon'];
//Given lat is taken into variable $lat and
//Given lon is taken into variable $lon

$sql="SELECT \"StationFullName\" FROM \"tblStationLocation\" ORDER BY ST_Distance(geom,ST_GeomFromText('POINT($lon $lat)', 4326))";
//we select StationFullName from the table "tblStationLocation" order by the point of longitude and latitude given

$result=pg_query("$sql");
//the result of the above query is saved into $result

$row=pg_fetch_array($result);
//The result data in the $result is fetched into array and is saved into the variable $row

//echo $row[0];
$stn_name=$row[0];

//echo $stn_name."<br>";

}
// echo $_GET['stn'];

if (isset($_GET['stn'])) {
  # code...
  $stn_name=trim($_GET['stn']);
}
$stn_sensors="";
$sql="select \"Sensor\" from \"SensorValues\" where \"StationFullName\"='$stn_name' and \"StationTypeName\"!=''";
//sensor is selected from the table "SensorValues" which match the condition of StationFullName

$result=pg_query("$sql");
//$result is stored with the result of $sql query above

while ($row=pg_fetch_array($result)) {
  //while the $result is fetched into the array into the $row the $stn_sensor is concatinated with the ';' for each loop
	$stn_sensors.=trim($row[0]).";";
}
//echo $stn_sensors;

ini_set('max_execution_time', 0); 
ini_set('memory_limit', '-1');


$min_max_list=array();
      $tempParam = trim($stn_sensors);
    $stn_name_main=  $stn_name;
    //$stn_sensors are saved into $tempParam and $stn_name are saved into $stn_name_main

       //$stn_name_main="SF1";   
$PARAMS=explode(';' ,$tempParam);
//$tempParam are splitted with respect to the ';'

  $station=getStationShef($stn_name_main);
  //$station is updated with StationShef of the $stn_name_main

  //echo $PARAMS;
  $Minval=0.0;
  $MaxVal=0.0;
function graph($vertualsensors,$realsensors,$v_sensor_names,$r_sensor_names)
{
  //this function is called to plot the graph when clicked over the marker

	//echo $vertualsensors;
	//echo $realsensors;
	//echo $v_sensor_names;
	//echo $r_sensor_names;
	//exit;
global $min_max_list;
       
global $stn_name_main;


   $array_v='';
 $array_v='Date';


          
          //  $tempParam = trim($_GET["PARAMS"]);
            $station=getStationShef(trim($stn_name_main));

        $DateTime = new DateTime();
 
          //$DateTime is declared with the current date

            $day=12;//number of days of data required
                
             $DateTime->modify("-$day days");
             //$DateTime is modified by subtracted the day specified into the variable $day

             $FY = trim($DateTime->format("Y"));//$FY = from year 
                 $FY = substr($FY,-2);
            $FM = trim($DateTime->format("m"));//$FM = from month
            $FD = trim($DateTime->format("d"));//$FD = from Day
            $TY = trim(date('Y'));//$TY = to Year
               $TY = substr($TY,-2);
            $TM =  trim(date('m'));//$TM = to Month
            $TD = trim(date('d'));//$TD = to day

            
   

           
    

        $stn_type_set=pg_query("SELECT \"StationType\" FROM \"tblStationType\"");
        // StypeType is selected from the table "tblStationType" and updated into the $stn_type_set
 $stn_name="";
 if(pg_num_rows($stn_type_set)>0)
 //if the $stn_type_set contain number of rows > 0
 {
      while($table_name=pg_fetch_array($stn_type_set))
      // while $stn_type_set is fetched into the rows into $table_name the loop goes on
      {
          $tbl=$table_name['StationType'];
       $stn_set=pg_query("SELECT \"Station_Full_Name\" FROM \"$tbl\" where \"Station_Shef_Code\"='$station'");
       //Stattion_Full_name is selected from the each table "StationType" where the condition is matching, Station_shef_code = Station is inserted into the variable $stn_set

        if(pg_num_rows($stn_set)>0)
          //if $stn_set have rows more than 0

 {
     $name=pg_fetch_array($stn_set);
     //$stn_set is fetched into the rows into $name
       $stn_name=$name['Station_Full_Name'];
 }
      }
 }
 

 


$paramsshef=explode(";", $realsensors);
//realsensors data is split with ';' and is inserted into paramsshef

//echo $realsensors;
//exit;
$HydroMetShefCodeCodition='';
for ($i=0; $i <count($paramsshef); $i++) { 
//for the count of number of elements in $paramsshef the loop continues

//echo count($paramsshef);
//exit;

if (trim($paramsshef[$i])!="") {
	
    $result_set=  pg_query("SELECT \"HydroMetTypeId\" FROM \"tblHydroMetParamsType\" where 
            \"HydroMetShefCode\" = '$paramsshef[$i]'");
    //the result from selecting HydroMetParamsTypeId from the table "tblHydroMetParamsType" matching the condition "HydroMetShefCode" is sent to variable $result_set

          $row=pg_fetch_array($result_set);
          // $result_set is fetched into array and is updated into the variable $row

		  //echo $result_set;
		 
$HydroMetShefCodeCodition.=" a.\"HydroMetParamsTypeId\"=''$row[0]'' or";
}
}

$paramsshefVirtual=explode(";", $vertualsensors);
//virtualsensors data is split with ';' and is inserted into paramsshefVirtual

//echo count($paramsshefVirtual);
//exit;
$HydroMetShefCodeCoditionVirtual='';
for ($i=0; $i <count($paramsshefVirtual); $i++) { 
  //for the count of number of elements in $paramsshefVirtual the loop continues

if (trim($paramsshefVirtual[$i])!="") {
  

    $result_set=  pg_query("SELECT \"HydroMetParamsTypeId\" FROM \"tblHydroMetParamsType\" where 
            \"HydroMetShefCode\" = '$paramsshefVirtual[$i]'");
    //the result from selecting HydroMetParamsTypeId from the table "tblHydroMetParamsType" matching the condition "HydroMetShefCode" is sent to variable $result_set

          $row=pg_fetch_array($result_set);
          // $result_set is fetched into array and is updated into the variable $row

		  //echo $row;
		  //exit;
$HydroMetShefCodeCoditionVirtual.=" a.\"HydroMetParamsTypeId\"=''$row[0]'' or";
}
}
//echo $HydroMetShefCodeCoditionVirtual;
//exit;

$HydroMetShefCodeCoditionVirtual=rtrim($HydroMetShefCodeCoditionVirtual ,'or');
$HydroMetShefCodeCodition=rtrim($HydroMetShefCodeCodition ,'or');



    $result_table=  pg_query("SELECT * FROM \"tblAllTables\" where \"TableName\" like '%".$station."_1%' or  \"TableName\" like '%".$station."_2%'");
    //select from table "tblAllTables" matching the condition where "TableName" is like $station and is sent to $result_table

    if (isset($result_table)) {
      $stn_id=  pg_query("SELECT \"StationId\" FROM \"tblStation\" where \"StationName\"='$station'");
      //select stationID from the table "tblStation" matching condition StationName = $station is updated to $stn_id

$id_row=pg_fetch_array($stn_id);
//$stn_id is fetched into Array into variable $id_row 

$s_id= $id_row['StationId'];
$SQL_MAX_MIN='';
  while ($tablerows=pg_fetch_array($result_table)) {
 $SQL_MAX_MIN='select ';
$table="'".$tablerows['TableName']."'";
//$table = TableName
        
               
           $sql_queryReal ="SELECT * FROM crosstab ('SELECT  (''20''||\"Year\"::text ||''-''||\"Month\"::text ||''-''|| \"Day\" ::text ||'' ''||\"Hour\"::text || '':'' || \"Minute\" ::text || 
'':'' ||\"Second\")::timestamp  as t,\"HydroMetParamsTypeId\", \"Value\" FROM \"'$table'\" a where
    ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY,$FM,$FD) AND ($TY,$TM,$TD))  and a.\"StationId\"=$s_id and a.\"Flag\"= ''1'' and ($HydroMetShefCodeCodition)   order by 1 desc'
   ,'SELECT distinct \"HydroMetParamsTypeId\" FROM \"'$table'\" as a where ($HydroMetShefCodeCodition) and a.\"Flag\"= ''1'''
   ) AS final_result(t timestamp";
//in $sql_queryReal the data is collected from the timestamp;
for ($i=0; $i <count($paramsshef) ; $i++) { 
  if (trim($paramsshef[$i])!="") 
    //if paramsshef[$i] is not equal to null
  {
  $sql_queryReal .=",\"".$paramsshef[$i]."\" double precision";
$SQL_MAX_MIN.="max(\"".$paramsshef[$i]."\"),";// we get the maximum value
//$SQL_MAX_MIN.="min(\"".$paramsshef[$i]."\"),";
}

}
$sql_queryReal.=")";
//echo "$sql_query";
             
                       $sql_queryVirtual ="SELECT * FROM crosstab ('SELECT  (''20''||\"Year\"::text ||''-''||\"Month\"::text ||''-''|| \"Day\" ::text ||'' ''||\"Hour\"::text || '':'' || \"Minute\" ::text || 
'':'' ||\"Second\")::timestamp  as t,\"HydroMetParamsTypeId\", \"VirtualValue\" FROM \"'$table'\" a where
    ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY,$FM,$FD) AND ($TY,$TM,$TD))  and a.sensortype=''Virtual'' and a.\"Flag\"= ''1'' and a.\"StationId\"=$s_id and ($HydroMetShefCodeCoditionVirtual)   order by 1 desc'
   ,'SELECT distinct \"HydroMetParamsTypeId\" FROM \"'$table'\" as a where a.sensortype=''Virtual'' and ($HydroMetShefCodeCoditionVirtual) and a.\"Flag\"= ''1'''
   ) AS final_result(t timestamp";
   //in $sql_queryVirtual the data is collected from the timestamp;

   //echo $sql_queryVirtual;
//exit;
for ($i=0; $i <count($paramsshefVirtual) ; $i++) { 
  if (trim($paramsshefVirtual[$i])!="") 
  {
  $sql_queryVirtual .=",\"".$paramsshefVirtual[$i]."V\" double precision";
  $SQL_MAX_MIN.="max(\"".$paramsshefVirtual[$i]."V\"),";//we get the maximum value
//$SQL_MAX_MIN.="min(\"".$paramsshefVirtual[$i]."V\"),";
}
}
$sql_queryVirtual.=")";
               
           
                 

                 
                
 
 if (trim($HydroMetShefCodeCoditionVirtual)!="") {
$sql_query="select t1.t";//select t1.t and is selected 

for ($i=0; $i <count($paramsshef)-1 ; $i++) { 
  if (trim($paramsshef[$i])!="") 
  $sql_query .=",t1.\"".$paramsshef[$i]."\"" ;// t1 is concatineted with $paramshef
}
for ($i=0; $i <count($paramsshefVirtual)-1 ; $i++) { 
  if (trim($paramsshefVirtual[$i])!="") 
  $sql_query .=",t2.\"".$paramsshefVirtual[$i]."V\"";//t2 is concatineted with $paramshefVirtual
}

$sql_query=rtrim($sql_query,",");
// Split $sql_query with ','

$sql_query.=" from (".$sql_queryReal.") t1 FULL OUTER JOIN (".$sql_queryVirtual.") t2 on t1.t=t2.t order by t1.t desc ";
//we join $sql_queryReal (t1) with the Outer Join $sql_queryVirtual (t2) when t1=t2
//echo $sql_query;

}
 else{
  $sql_query=$sql_queryReal;
  //default 
}
if (trim($HydroMetShefCodeCodition)=='') {
  //if $HydroMetShefCodeCondtion is Null
$sql_query=$sql_queryVirtual;
}
$SQL_MAX_MIN=rtrim($SQL_MAX_MIN,",");
//we Split $SQL_MIN_MIN with ',' and update it to same variable

 $SQL_MAX_MIN.= " from ($sql_query) x";
//echo "$SQL_MAX_MIN<br><br>";

$min_max_temp=pg_query($SQL_MAX_MIN);
$min_max_set=pg_fetch_array($min_max_temp);
//$min_max_temp result is fetched into $min_max_set

  $result_set2= pg_query($sql_query);  
  // echo $sql_query;
  // echo "<br>";          
if (pg_num_rows($result_set2)>0)
//if $result_set2 fetched into array rows are greater than 0 
{

  
  if($array_v=='Date') 
  {
    $min_max_count=0;

    $HydroMetShefCodeCodition_temp=str_replace("''", "'", $HydroMetShefCodeCodition);
    //replacing "''" with " " in $hydroMetShefCodeCondtion

    $row_c_ds_r=pg_query("SELECT distinct \"HydroMetParamsTypeId\" FROM \"$table\" as a where ($HydroMetShefCodeCodition_temp) and a.\"Flag\"= '1'");
    //select HydroMetParamsTypeId from the station Type with condition given

    $tem_ds=pg_query("SELECT distinct \"HydroMetParamsTypeId\" FROM \"$table\" as a where ($HydroMetShefCodeCodition_temp) and a.\"Flag\"= '1'");
    //select HydroMetParamsTypeId from the station Type with condition given

    while ($h_id=pg_fetch_array($tem_ds)) 
    {
      $shef=pg_fetch_array(pg_query("select \"HydroMetShefCode\" from \"tblHydroMetParamsType\" where \"HydroMetParamsTypeId\"='$h_id[0]'"));
      //select HydroMetParamsTypeId from the station Type with condition given and are fetched into array

      $row=pg_fetch_array(pg_query("select \"Sensor\" from \"SensorValues\" where \"StationFullName\"='$stn_name' and \"SHEF\"='$shef[0]' and \"SensorType\"='Real'"));
      //select HydroMetParamsTypeId from the station Type with condition given and are fetched into array

      $min_max_list[$row[0].""]=$min_max_set[$min_max_count];
      $min_max_count++;


      $array_v.=','.$row[0];
      //Concatinate ',' with $row[0];

      //echo $array_v;
      //exit;
    }


    $HydroMetShefCodeCoditionVirtual_temp=str_replace("''", "'", $HydroMetShefCodeCoditionVirtual);
    //replacing "''" with " " in $hydroMetShefCodeCondtionVirtual

    if (trim($HydroMetShefCodeCoditionVirtual)!="") {
    //if $HydroMetShefCodeCoditionVirtual is not NULL

    # code...

      $row_c_ds_v=pg_query("SELECT distinct \"HydroMetParamsTypeId\" FROM \"$table\" as a where a.sensortype='Virtual' and ($HydroMetShefCodeCoditionVirtual_temp) and a.\"Flag\"= '1'");
      //select HydroMetParamsTypeId from the station Type with condition given as sensortype='Virtual'

      $tem_ds=pg_query("SELECT distinct \"HydroMetParamsTypeId\" FROM \"$table\" as a where a.sensortype='Virtual' and ($HydroMetShefCodeCoditionVirtual_temp) and a.\"Flag\"= '1'");
      //select HydroMetParamsTypeId from the station Type with condition given as sensortype='Virtual'

      while ($h_id=pg_fetch_array($tem_ds)) {
        $shef=pg_fetch_array(pg_query("select \"HydroMetShefCode\" from \"tblHydroMetParamsType\" where \"HydroMetParamsTypeId\"='$h_id[0]'"));
        //select HydroMetParamsTypeId from the station Type with condition given and are fetched into array

        $row=pg_fetch_array(pg_query("select \"Sensor\" from \"SensorValues\" where \"StationFullName\"='$stn_name' and \"SHEF\"='$shef[0]' and \"SensorType\"='Virtual'"));
        //select HydroMetParamsTypeId from the station Type with condition given and are fetched into array

        $min_max_list[$row[0].""]=$min_max_set[$min_max_count];
        $min_max_count++;
        //$min_max_list[$row[0]."_Min"]=$min_max_set[$min_max_count];
        //$min_max_count++;
        $array_v.=','.$row[0];

      }
    }

    $array_v.= "\n".'"';
  }
      
   
  //concatinate \n to the array_v 

  $settings=pg_fetch_array(pg_query("select \"DateFormat\",\"DecimalPlaces\" from \"tblLogo\"")); 
  //Date format is set into the settings

  while ($rows=pg_fetch_array($result_set2)) {
     
      //while $result_set2 is fetched into array into $row th loop continue
                   
                   $a= $rows['t'];
                    if (trim($a)!="") {
                      $date = strtotime(trim($a));
                         $a= date('Y-m-d h:i A', $date);
  
   $array_v.='"'.$a;
   //concatinate array_v with $a

   $row_count=1;
$table="'".$tablerows['TableName']."'";
//concatinate Table name to $table


   for ($i=0; $i <pg_num_rows($row_c_ds_r); $i++) { 
    //for $row_c_ds_r having number of rows the loop continue
 
 if (trim($rows[$row_count])!="") 
  //if $row[$row_count] not equal to NUll
   $array_v.=','.round($rows[$row_count],$settings[1]);
 else
   $array_v.=','.$rows[$row_count];
  $row_count++;
}

if (trim($HydroMetShefCodeCoditionVirtual)!="") {
  //if $HydroMetShefCodeCoditionVirtual not equal to NUll

   for ($i=0; $i <pg_num_rows($row_c_ds_v); $i++) { 
 if (trim($rows[$row_count])!="") 
   $array_v.=','.round($rows[$row_count],$settings[1]);
 //concatinate ',' with round($rows[$row_count]) and with settings
 else
   $array_v.=','.$rows[$row_count];
 //concatinate ',' with round($rows[$row_count])
  $row_count++;
}
    }                  
$array_v.="\n";
//concatinate '\n' with $array_v
}
}

}
     



   
}
}

return $array_v;

}



$arrayv=array();

   $stn_name='';
     $data=getStationShef(trim($stn_name_main));
     // shefcode from the $stn_name_main is obtained into the $data

         $dataU=strtoupper($data);//data to upper case
         $dataL=strtolower($data);//data to lower case

$result_stn=pg_query("select \"StationType\" from \"tblStationType\"");
//StationType from table "tblStationType" is sent to $result_stn

 if(pg_num_rows($result_stn)>0)
 //if number of rows in $result_stn is > 0
 {
 while($row_user=pg_fetch_array($result_stn))
  //while $result_stn is fetched into the array in the variable $row_user
 {
  
             $sql_query="select \"Station_Full_Name\" from \"" . str_replace(' ','_', $row_user['StationType']) ."\" where \"Station_Shef_Code\"='$data' or \"Station_Shef_Code\" = '$dataU' or \"Station_Shef_Code\"='$dataL' or \"Station_Full_Name\"='$data' or \"Station_Full_Name\"='$dataU' or \"Station_Full_Name\"='$dataL'";
             //station_Full_Name is selected from the StationType where Station_shef_code or Station_FUll_Name is same like $data

   $result_set=pg_query($sql_query);
                       if(pg_num_rows($result_set)>0) 
                        //if number of rows in $result_set > 0
                       {
                       
      while ($data1=pg_fetch_row($result_set)) 
        //while $result_set is fetched into the array in the variable $data1
 {
  $stn_name=$data1[0];
 }
}
}
}

$realsensors='';
$vertualsensors='';

$v_sensor_names="";
$r_sensor_names="";
for ($i=0; $i < count($PARAMS) ; $i++) 
{ 

$row=pg_fetch_array(pg_query("select \"SensorType\",\"SHEF\",\"Sensor\" from \"SensorValues\" where \"StationFullName\"='$stn_name' and \"Sensor\"='$PARAMS[$i]'"));
//fetch array by selecting the SensorType, Shef, Sensor from "SensorValues" where the condition stationfullname and sensor are matched and are inserted into $row
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


$temp= graph($vertualsensors,$realsensors,$v_sensor_names,$r_sensor_names);
//The function graph is called into a variable $temp
echo json_encode($temp);
// It is encoded into the $temp

 function getStationShef($Name)
{
  $stn_name="";
  $stn_types_set=pg_query("select \"StationType\" from \"tblStationType\"");
  //select StationType from the table "tblStationType" and the reuslt is set to $stn_types_set
while ($row_types=pg_fetch_array($stn_types_set)) {
  //while $stn_types_set is fetched into a array to $row_types
$table=str_replace(" ", "_", $row_types[0]);
  //replace " " with "_" in $row_types and sent to $table

 $stn_set= pg_query("select \"Station_Shef_Code\" from \"$table\" where \"Station_Full_Name\"='$Name'");
 //we select "Station_shef_code" from table stationtype with matching the condition

 if (pg_num_rows($stn_set)>0) {
  //if the number of rows of the result in variable $stn_set > 0

    //echo "<br><br>select \"Station_Shef_Code\" from \"$table\" where \"Station_Full_Name\"='$Name'";

   # code...
 $row=pg_fetch_array($stn_set);
 //fetch array from $stn_set into the variable $row
$stn_name=$row[0];
 }

}

 return $stn_name;
 //return variable $stn_name
} ?>