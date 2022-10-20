<?php
	include("includes/link.php");

?>
<?php
	include("includes/header.php");
	include_once 'database.php';

  $all_sensor=array();
  $all_shef=array();
  $count=0;
  $count2=array();
  $t_row;
  $s_row;

?>
<br>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script> 
<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js" type="text/javascript"></script> 
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous" />
<link rel="stylesheet" href="assets/jquery-ui.css">
<script type="text/javascript" src="assets/jquery.js"></script>
<script type="text/javascript" src="assets/jquery-ui.js"></script>
<link rel="stylesheet" type="text/css" href="/hydromet/assets/css/MyTable.css"> 
<script type="text/javascript">
  $(function() 
  {
    $( "#stn_id" ).autocomplete({
      source: 'autocompelete.php'
    });
  });
</script>
<form style="overflow-x: hidden;">
  <label style="font-size: 30px;margin-left: 25px">Real-Time Event /Hourly Data</label>
  <p style="margin-left: 25px">Enter Station name or Station Shef Code</p>
  <div class="row" style="margin-left: 25px">
    <div class="col-md-4">

      <input type="text" name="stn_id" id="stn_id" class="form-control" value="<?php if (isset($_GET['stn_id'])) {
        echo $_GET['stn_id'];
        # code...
        } ?>" required />
      <input type="hidden" name="sensortype" id="hiddensensor" value="Real">
	  </div>
  	<div class="col-md-4">
      <input type="submit" name="" value="Get Data" class="btn btn-primary">
    </div>
  </div>

  <script type="text/javascript">

    function PlotGraph(params,station) {
      var yearFrom;
      var monthFrom;
      var dayFrom;
      var yearTo;
      var monthTo;
      var dayTo;
  		var hours=24;
                  
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
       
               // window.location.href= 'Graph.php?FY=' + yearFrom + "&FM=" + monthFrom + "&FD=" + dayFrom + '&TY=' + yearTo + "&TM=" + monthTo + "&TD=" + dayTo + "&PARAMS=" + params+"&hours="+hours+"&station="+station+"&hours2="+hours2;

      window.location.href= 'Graph.php?FY=' + yearFrom + "&FM=" + monthFrom + "&FD=" + dayFrom + '&TY=' + yearTo + "&TM=" + monthTo + "&TD=" + dayTo + "&PARAMS=" + params+"&hours="+hours+"&station="+station+"&hours2="+24;
    
    
    }

  </script>
  <form method="get" id="data" action="addnew.php">
  
  </form>
  <?php
    $Y=date('Y');
    $M=date('m');
    $D=date('d');
    $hours=24*10;
    $DateTime = new DateTime();
    $min=date('i');
    $h=date('H');
    $DateTime=$DateTime->modify("-$hours Hours");
    $DF=$DateTime->format('d');
    $MF=$DateTime->format('m');
    $h2=$DateTime->format("H");
    $YF=$DateTime->format("Y");
    $min2=$DateTime->format("i");
    //echo "   $DF $MF $YF $h2 $min2  and   $D $M $Y $h $min";
    if (isset($_GET['stn_id'])) {
      $stn_type_name='';
      $station=trim($_GET['stn_id']);
      $stn_name='';
      $r_stn_name;
      $dataU=strtoupper($station);        
      //echo "$h $h2";
      $r=pg_query("select \"StationType\" from \"tblStationType\"");
      if (isset($r)) {
        while ($row=pg_fetch_array($r)) {
          $table=str_replace(" ", "_", $row['StationType']);
          $r_stn_name=pg_query("select \"Station_Full_Name\" from \"$table\"  WHERE \"Station_Shef_Code\"= '$station' or \"Station_Shef_Code\"= '$dataU'");

          if (pg_num_rows($r_stn_name)>0) {
            $stn_type_name=$row['StationType'];
	          $r2=pg_fetch_array($r_stn_name);
	          $stn_name=$r2['Station_Full_Name'];
          }
        }
        $stationnameforimage=pg_query("select \"PIC\" from \"tblStationLocation\" WHERE \"StationFullName\"='$station'");   
        //echo $stationnameforimage;
        //echo $station;
        $stationnameforimagearray=pg_fetch_array($stationnameforimage);
        $stationnameforimagereal="Station/demo/".$stationnameforimagearray[0];
        //echo $stationnameforimagereal;
        //echo $stationnameforimagearray[0];
      }

      if ($stn_name=='') {
        $stn_name=$station;
      }

      $stn_shef='';
      $r=pg_query("select \"StationType\" from \"tblStationType\"");

      if (isset($r)) {
        while ($row=pg_fetch_array($r)) {

          $table=$row['StationType'];
          $r_stn_name=pg_query("select \"Station_Shef_Code\" from \"$table\"  WHERE \"Station_Full_Name\"='$station' or \"Station_Full_Name\"='$dataU'");

          if (pg_num_rows($r_stn_name)>0) {
            $stn_type_name=$row['StationType'];
            $r2=pg_fetch_array($r_stn_name);
            $stn_shef=$r2['Station_Shef_Code'];
          }
        }
    
      }

      if ($stn_shef!='') {
        $station=$stn_shef;
      }
      if($stationnameforimagearray[0]==''||$stationnameforimagearray[0]=='Images/StationImages/'){
        echo "<br><p style='margin-left: 5%;margin-bottom:0%;'> <label>$stn_name / $station</label><br/><img src='assets/images/stationIcon.png' style='width:100px;height:100px'></p>";
      }
      else{
        echo "<br><p style='margin-left: 5%;margin-bottom:0%;'> <label>$stn_name / $station</label><br/><img src='$stationnameforimagereal' style='width:100px;height:100px'></p>";
      }

      echo "<p style='margin-left: 5%;margin-bottom:0%;'>Query Executed ".date("D M j G:i:s T Y")."</p>";
      if ($stn_type_name!='') {
        $stn_data_query='select ';
        //echo "Stn type name $stn_type_name";
        $stn_type_ds=pg_query("select \"StationField\" from \"DefineStations\" where \"StationTypeName\"='$stn_type_name'");
        while ($st_row=pg_fetch_array($stn_type_ds)) {

          // echo $st_row['StationField'];

          $stn_data_query.="\"".str_replace(" ","_",$st_row['StationField'])."\",";
        }
        $stn_data_query= trim($stn_data_query,",");
        $stn_data_query.=" from \"".str_replace(" ", "_",$stn_type_name)."\" where \"Station_Full_Name\"='$stn_name' and \"Station_Shef_Code\"='$station'";

        //echo $stn_data_query;
        $x=0;
        $stn_data_row=pg_fetch_array(pg_query($stn_data_query));
        $stn_type_ds=pg_query("select \"StationField\" from \"DefineStations\" where \"StationTypeName\"='$stn_type_name'");
        echo "<table style='width:90%;margin-left:5%'><tr>";
        while ($st_row=pg_fetch_array($stn_type_ds)) {

          echo "<td><label>".str_replace("_", " ",$st_row[0])."</label></td><td>  ". $stn_data_row[str_replace(" ", "_", $st_row[0])]."   </td>";

          $x++;
          if ($x%4==0) {
            echo "</tr>";
          }
        }
        echo "</table>";
      }
   
  ?>
  <script type="text/javascript">
      document.getElementById("hiddensensor").disabled=true;
  </script>
  <br>
  <div style="min-width: auto;max-height:auto;margin-left:5%;margin-left:2%";>
  <center>
  <div class="row">
  <div class='row'>
  <div class='col-md-12'>
  <table align='center' style='max-width:98%;min-width:60%;' class='table'>
  <tr>
  <td colspan="2">
  <label>Provisional data, subject to change.
  Select a sensor type for a plot of data.
  </label>
  <td>
  </tr>

  </table>


  </div></div>
    
  <?php
    $stationfullname=$stn_name;
    $stn_name='';
    $data=getStationShef(trim($stationfullname));
    $dataU=strtoupper($data);        
    $dataL=strtolower($data);
    $result_stn=pg_query("select \"StationType\" from \"tblStationType\"");
    if(pg_num_rows($result_stn)>0)
    {
      while($row_user=pg_fetch_array($result_stn))
      {
    
        $sql_query="select \"Station_Full_Name\" from \"" . str_replace(' ','_', $row_user['StationType']) ."\" where \"Station_Shef_Code\"='$data' or \"Station_Shef_Code\" = '$dataU' or \"Station_Shef_Code\"='$dataL' or \"Station_Full_Name\"='$data' or \"Station_Full_Name\"='$dataU' or \"Station_Full_Name\"='$dataL'";

        $result_set=pg_query($sql_query);
        if(pg_num_rows($result_set)>0) 
        {
                         
          while ($data1=pg_fetch_row($result_set)) 
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
    $PARAMS=array();
    $sql="SELECT \"Sensor\" FROM \"SensorValues\" WHERE \"StationFullName\"='$stn_name' order by 1 asc";
    $sensoreresult=pg_query($sql);
    if(pg_num_rows($sensoreresult)>0) 
        {
                         
          while ($sensoreresultdata=pg_fetch_row($sensoreresult)) 
          {
            array_push($PARAMS,$sensoreresultdata[0]);
          }
        }
        //print_r($PARAMS);
    for ($i=0; $i < count($PARAMS) ; $i++) 
    { 

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
    $sensorCondition='';
    for($i=0;$i<count($PARAMS);$i++){
      if($PARAMS[$i]!=""){
        $sensorCondition.="\"Sensor\"='$PARAMS[$i]' or";
      }
    }
    $sensorCondition=rtrim($sensorCondition ,'or');

    $paramsshef=explode(";", $realsensors);

    $HydroMetShefCodeCodition='';
    $ShefCondition=array();
    for ($i=0; $i <count($paramsshef); $i++) 
    { 
      if (trim($paramsshef[$i])!="")
      {
        $result_set=  pg_query("SELECT \"HydroMetParamsTypeId\" FROM \"tblHydroMetParamsType\" where 
                \"HydroMetShefCode\" = '$paramsshef[$i]'"); 
        $row=pg_fetch_array($result_set);
        array_push($ShefCondition, $row[0]);
      }
    }
    for ($i=0; $i <count($ShefCondition); $i++) 
    { 
      if (trim($ShefCondition[$i])!="") 
      { 
        $HydroMetShefCodeCodition.=" a.\"HydroMetParamsTypeId\"=$ShefCondition[$i] or";       
      }
    }

    $paramsshefVirtual=explode(";", $vertualsensors);
    $HydroMetShefCodeCoditionVirtual='';

    for ($i=0; $i <count($paramsshefVirtual); $i++) 
    { 
      if (trim($paramsshefVirtual[$i])!="")
      {
        $result_set=  pg_query("SELECT \"HydroMetParamsTypeId\" FROM \"tblHydroMetParamsType\" where 
                \"HydroMetShefCode\" = '$paramsshefVirtual[$i]'");
        $row=pg_fetch_array($result_set);
        $HydroMetShefCodeCoditionVirtual.=" a.\"HydroMetParamsTypeId\"=$row[0] or";
      }
    }

    $HydroMetShefCodeCoditionVirtual=rtrim($HydroMetShefCodeCoditionVirtual ,'or');
    $HydroMetShefCodeCodition=rtrim($HydroMetShefCodeCodition ,'or');
    
    $TY = date('Y');
    $TY = substr($TY,-2);
    $TM = date('m');
    $TD = date('d');
    $hours=24*10;
    $DateTime=$DateTime->modify("-$hours Hours");
    $FY = $DateTime->format('Y');
    $FY = substr($FY,-2);
    $FM = $DateTime->format('m');
    $FD = $DateTime->format('d');
    $DateTime = new DateTime();
    $h2 = date('H');  
    $m2=date('m');
    
    //$station=getStationShef(trim($_GET['station']));
    $m = date('m');
    $h = $DateTime->format("H");
    $dataU=strtoupper($station);
    $temp=array();
    $temp_Y=str_split($Y);
    $Y=$DateTime->format("Y");
    $Y=substr($Y, -2);
    $temp_YEAR=$temp_Y[2]."".$temp_Y[3];
    pg_query("CREATE EXTENSION if not exists tablefunc");
    if(($FY<$Y)&&($Y=$TY)){
      $TY1=$FY;
      $TM1='12';
      $TD1='31';
      $FY1=$TY;
      $FM1='1';
      $FD1='1';
    }

    
    $result_table=  pg_query("SELECT * FROM \"tblAllTables\"  WHERE \"TableName\" like '%".$station."_1%' or \"TableName\" like '%".$dataU."_1%' or  \"TableName\" like '%".$station."_2%' or \"TableName\" like '%".$dataU."_2%' order by 1 ASC");
    
    
    if (isset($result_table)) {

      $stn_id=  pg_query("SELECT \"StationId\" FROM \"tblStation\" where \"StationName\"='$station' or \"StationName\"='$dataU'");
      $id_row=pg_fetch_array($stn_id);
      $s_id= $id_row['StationId'];
      $result_set=array();
      $sensor_count=array();
      $i=0;

      while ($tablerows=pg_fetch_array($result_table)) 
      {
        
        $table="'".$tablerows['TableName']."'" ;
        //echo $table;
        if(((strpos($table, $FY))||(strpos($table, $TY)))&&($FY<$Y)&&($TY=$Y))
        {
          

          if(strpos($table, $FY))
          {
            
            $sql_query_real="SELECT * FROM crosstab ('SELECT  (''20''||\"Year\"::text ||''-''|| \"Month\"::text ||''-''|| \"Day\" ::text ||'' ''|| \"Hour\"::text || '':'' || \"Minute\" ::text ||'':'' ||\"Second\")::timestamp  as t,\"HydroMetParamsTypeId\", \"Value\" FROM  \"'$table'\" a where ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY,$FM,$FD) AND ($TY1,$TM1,$TD1)) and a.\"StationId\"=$s_id and ($HydroMetShefCodeCodition) order by 1 ','SELECT distinct \"HydroMetParamsTypeId\" FROM \"'$table'\" as a WHERE ($HydroMetShefCodeCodition)') AS final_result(t timestamp";
            $col_set=pg_query("SELECT distinct \"HydroMetParamsTypeId\" FROM \"$table\" as a WHERE ($HydroMetShefCodeCodition)");
          
            while ($cols=pg_fetch_array($col_set)) { 
              $sql_query_real.=",\"".$cols[0]."\" double precision";
              

            }
            $sql_query_real.=")";

            $sql_query_virtual="SELECT * FROM crosstab ('SELECT  (''20''||\"Year\"::text ||''-''||\"Month\"::text ||''-''|| \"Day\" ::text ||'' ''||\"Hour\"::text || '':'' || \"Minute\" ::text ||'':'' ||\"Second\")::timestamp  as t,\"HydroMetParamsTypeId\", \"VirtualValue\" FROM \"'$table'\" a where ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY,$FM,$FD) AND ($TY1,$TM1,$TD1)) and a.\"StationId\"=$s_id and  \"sensortype\"=''Virtual'' and ($HydroMetShefCodeCoditionVirtual) order by 1','SELECT distinct \"HydroMetParamsTypeId\" FROM \"'$table'\" as a where \"sensortype\"=''Virtual'' AND ($HydroMetShefCodeCoditionVirtual)') AS final_result(t timestamp";

            $col_set=pg_query("SELECT distinct \"HydroMetParamsTypeId\" FROM \"$table\" as a where a.\"sensortype\"='Virtual' AND ($HydroMetShefCodeCoditionVirtual)");
            

            while ($cols=pg_fetch_array($col_set)) { 
              $sql_query_virtual.=",\"".$cols[0]."\" double precision";
            }

            $sql_query_virtual.=")";

            $sql_query="select t2.t";

            $col_set=pg_query("select \"SHEF\",\"SensorType\" FROM \"SensorValues\" where (\"StationFullName\"= '$stn_name') and ($sensorCondition)");
          
            while ($cols=pg_fetch_array($col_set)) 
            {
              $counted=count($PARAMS)-1;
           
              $col=pg_fetch_array(pg_query("SELECT  \"HydroMetParamsTypeId\" FROM \"tblHydroMetParamsType\" where  \"HydroMetShefCode\"='$cols[0]'"));
            
              if (trim($cols[1])=='Real') 
              {
                if(pg_num_rows(pg_query("select distinct \"HydroMetParamsTypeId\" FROM  \"$table\" a where ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY,$FM,$FD) AND ($TY1,$TM1,$TD1)) and a.\"StationId\"=$s_id  and \"HydroMetParamsTypeId\"=$col[0] order by 1 asc"))>0)
                {
                  $sql_query .=",t1.\"$col[0]\"" ;
                  $sensor_count[$i]++;
                
                }
                else{
                  $colum=$col[0];
                }
              }
              else
              {
                if(pg_num_rows(pg_query("select distinct \"HydroMetParamsTypeId\" FROM  \"$table\" a where ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY,$FM,$FD) AND ($TY1,$TM1,$TD1)) and a.\"StationId\"=$s_id  and \"HydroMetParamsTypeId\"=$col[0] and \"sensortype\"='Virtual' order by 1 asc"))>0)
                {
                  $sql_query .=",t2.\"$col[0]\"";
                  $sensor_count[$i]++;
                
                }
                else{
                  $colum=$col[0];
                }
              }
            }
          
            if($sensor_count[$i]!=""){
            
              if($sensor_count[$i]<$counted){
              
                $sql_query.=",NULL as \"$colum\"";
              
              }
             
            }
            $sql_query=rtrim($sql_query,",");
            if($realsensors!=''){
             
              $sql_query.=" from (".$sql_query_real.") t1 FULL OUTER JOIN (".$sql_query_virtual.") t2 on t2.t=t1.t order by t2.t asc";
             
            }
            else{
              $sql_query=$sql_query_virtual." order by 1 desc";
            }
          
            if(pg_num_rows(pg_query("SELECT distinct \"HydroMetParamsTypeId\" FROM \"$table\" as a where a.\"sensortype\"='Virtual' and ($HydroMetShefCodeCoditionVirtual)"))<=0)
            {
              $sql_query="select t1.t";
            
              $col_set=pg_query("select \"SHEF\",\"SensorType\" FROM \"SensorValues\" where (\"StationFullName\"= '$stn_name') and ($sensorCondition)");
              while ($cols=pg_fetch_array($col_set)) 
              {
                $counted=count($PARAMS)-1;
              
                $col=pg_fetch_array(pg_query("SELECT  \"HydroMetParamsTypeId\"   FROM \"tblHydroMetParamsType\" where  \"HydroMetShefCode\"='$cols[0]'"));

                if (trim($cols[1])=='Real') 
                {
                  if(pg_num_rows(pg_query("select distinct \"HydroMetParamsTypeId\" FROM  \"$table\" a where ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY,$FM,$FD) AND ($TY1,$TM1,$TD1)) and a.\"StationId\"=$s_id  and \"HydroMetParamsTypeId\"=$col[0] order by 1 desc"))>0)
                  {
                    $sql_query .=",t1.\"$col[0]\"" ;
                    $sensorcount[$i]++;
                  }
                  else
                  {
                    $colum=$col[0];
                  }
                }
              }
            
              if($sensorcount[$i]!=""){
              
                if($sensorcount[$i]<$counted)
                {
                
                  $sql_query.=",NULL as \"$colum\"";
                
                }
             
              }

              $sql_query.=" from (".$sql_query_real." ) t1 order by 1 desc";
            }
           
            $result_set[$i]=$sql_query;
            
            $i++;
          }
          else if(strpos($table, $TY))
          {
            
            $sql_query_real="SELECT * FROM crosstab ('SELECT  (''20''||\"Year\"::text ||''-''|| \"Month\"::text ||''-''|| \"Day\" ::text ||'' ''|| \"Hour\"::text || '':'' || \"Minute\" ::text ||'':'' ||\"Second\")::timestamp  as t,\"HydroMetParamsTypeId\", \"Value\" FROM  \"'$table'\" a where ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY1,$FM1,$FD1) AND ($TY,$TM,$TD)) and a.\"StationId\"=$s_id and ($HydroMetShefCodeCodition) order by 1 ','SELECT distinct \"HydroMetParamsTypeId\" FROM \"'$table'\" as a WHERE ($HydroMetShefCodeCodition)') AS final_result(t timestamp";
            $col_set=pg_query("SELECT distinct \"HydroMetParamsTypeId\" FROM \"$table\" as a WHERE ($HydroMetShefCodeCodition)");
          
            while ($cols=pg_fetch_array($col_set)) { 
              $sql_query_real.=",\"".$cols[0]."\" double precision";
              
            }
            $sql_query_real.=")";

            $sql_query_virtual="SELECT * FROM crosstab ('SELECT  (''20''||\"Year\"::text ||''-''||\"Month\"::text ||''-''|| \"Day\" ::text ||'' ''||\"Hour\"::text || '':'' || \"Minute\" ::text ||'':'' ||\"Second\")::timestamp  as t,\"HydroMetParamsTypeId\", \"VirtualValue\" FROM \"'$table'\" a where ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY1,$FM1,$FD1) AND ($TY,$TM,$TD)) and a.\"StationId\"=$s_id and  \"sensortype\"=''Virtual'' and ($HydroMetShefCodeCoditionVirtual) order by 1','SELECT distinct \"HydroMetParamsTypeId\" FROM \"'$table'\" as a where \"sensortype\"=''Virtual'' AND ($HydroMetShefCodeCoditionVirtual)') AS final_result(t timestamp";

            $col_set=pg_query("SELECT distinct \"HydroMetParamsTypeId\" FROM \"$table\" as a where a.\"sensortype\"='Virtual' AND ($HydroMetShefCodeCoditionVirtual)");
            

            while ($cols=pg_fetch_array($col_set)) { 
              $sql_query_virtual.=",\"".$cols[0]."\" double precision";
            }

            $sql_query_virtual.=")";

            $sql_query="select t2.t";

            $col_set=pg_query("select \"SHEF\",\"SensorType\" FROM \"SensorValues\" where (\"StationFullName\"= '$stn_name') and ($sensorCondition)");
          
            while ($cols=pg_fetch_array($col_set)) 
            {
              $counted=count($PARAMS)-1;
           
              $col=pg_fetch_array(pg_query("SELECT  \"HydroMetParamsTypeId\" FROM \"tblHydroMetParamsType\" where  \"HydroMetShefCode\"='$cols[0]'"));
            
              if (trim($cols[1])=='Real') 
              {
                if(pg_num_rows(pg_query("select distinct \"HydroMetParamsTypeId\" FROM  \"$table\" a where ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY1,$FM1,$FD1) AND ($TY,$TM,$TD)) and a.\"StationId\"=$s_id  and \"HydroMetParamsTypeId\"=$col[0] order by 1 asc"))>0)
                {
                  $sql_query .=",t1.\"$col[0]\"" ;
                  $sensor_count[$i]++;
                
                }
                else{
                  $colum=$col[0];
                }
              }
              else
              {
                if(pg_num_rows(pg_query("select distinct \"HydroMetParamsTypeId\" FROM  \"$table\" a where ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY1,$FM1,$FD1) AND ($TY,$TM,$TD)) and a.\"StationId\"=$s_id  and \"HydroMetParamsTypeId\"=$col[0] and \"sensortype\"='Virtual' order by 1 asc"))>0)
                {
                  $sql_query .=",t2.\"$col[0]\"";
                  $sensor_count[$i]++;
                
                }
                else{
                  $colum=$col[0];
                }
              }
            }
          
            if($sensor_count[$i]!=""){
            
              if($sensor_count[$i]<$counted){
              
                $sql_query.=",NULL as \"$colum\"";
              
              }
             
            }
            $sql_query=rtrim($sql_query,",");
            if($realsensors!=''){
             
              $sql_query.=" from (".$sql_query_real.") t1 FULL OUTER JOIN (".$sql_query_virtual.") t2 on t2.t=t1.t order by t2.t desc";
             
            }
            else{
              $sql_query=$sql_query_virtual." order by 1 desc";
            }
          
            if(pg_num_rows(pg_query("SELECT distinct \"HydroMetParamsTypeId\" FROM \"$table\" as a where a.\"sensortype\"='Virtual' and ($HydroMetShefCodeCoditionVirtual)"))<=0)
            {
              $sql_query="select t1.t";
            
              $col_set=pg_query("select \"SHEF\",\"SensorType\" FROM \"SensorValues\" where (\"StationFullName\"= '$stn_name') and ($sensorCondition)");
              while ($cols=pg_fetch_array($col_set)) 
              {
                $counted=count($PARAMS)-1;
              
                $col=pg_fetch_array(pg_query("SELECT  \"HydroMetParamsTypeId\"   FROM \"tblHydroMetParamsType\" where  \"HydroMetShefCode\"='$cols[0]'"));

                if (trim($cols[1])=='Real') 
                {
                  if(pg_num_rows(pg_query("select distinct \"HydroMetParamsTypeId\" FROM  \"$table\" a where ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY1,$FM1,$FD1) AND ($TY,$TM,$TD)) and a.\"StationId\"=$s_id  and \"HydroMetParamsTypeId\"=$col[0] order by 1 desc"))>0)
                  {
                    $sql_query .=",t1.\"$col[0]\"" ;
                    $sensorcount[$i]++;
                  }
                  else
                  {
                    $colum=$col[0];
                  }
                }
              }
            
              if($sensorcount[$i]!=""){
              
                if($sensorcount[$i]<$counted)
                {
                
                  $sql_query.=",NULL as \"$colum\"";
                
                }
             
              }

              $sql_query.=" from (".$sql_query_real." ) t1";
            }
           
            $result_set[$i]=$sql_query;
            
            $i++;
          }
        }
        
        else if(((strpos($table, $FY))&&(strpos($table, $TY))&&($FY=$Y)&&($TY=$Y))||((strpos($table, $FY))&&(strpos($table, $TY))&&($FY<$Y)&&($TY<$Y)))
        {

          $sql_query_real="SELECT * FROM crosstab ('SELECT  (''20''||\"Year\"::text ||''-''|| \"Month\"::text ||''-''|| \"Day\" ::text ||'' ''|| \"Hour\"::text || '':'' || \"Minute\" ::text ||'':'' ||\"Second\")::timestamp  as t,\"HydroMetParamsTypeId\", \"Value\" FROM  \"'$table'\" a where ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY,$FM,$FD) AND ($TY,$TM,$TD)) and a.\"StationId\"=$s_id and ($HydroMetShefCodeCodition) order by 1 ','SELECT distinct \"HydroMetParamsTypeId\" FROM \"'$table'\" as a WHERE ($HydroMetShefCodeCodition)') AS final_result(t timestamp";
          $col_set=pg_query("SELECT distinct \"HydroMetParamsTypeId\" FROM \"$table\" as a WHERE ($HydroMetShefCodeCodition)");
        
          while ($cols=pg_fetch_array($col_set)) { 
            $sql_query_real.=",\"".$cols[0]."\" double precision";
            
          }
          $sql_query_real.=")";

          $sql_query_virtual="SELECT * FROM crosstab ('SELECT  (''20''||\"Year\"::text ||''-''||\"Month\"::text ||''-''|| \"Day\" ::text ||'' ''||\"Hour\"::text || '':'' || \"Minute\" ::text ||'':'' ||\"Second\")::timestamp  as t,\"HydroMetParamsTypeId\", \"VirtualValue\" FROM \"'$table'\" a where ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY,$FM,$FD) AND ($TY,$TM,$TD)) and a.\"StationId\"=$s_id and  \"sensortype\"=''Virtual'' and ($HydroMetShefCodeCoditionVirtual) order by 1','SELECT distinct \"HydroMetParamsTypeId\" FROM \"'$table'\" as a where \"sensortype\"=''Virtual'' AND ($HydroMetShefCodeCoditionVirtual)') AS final_result(t timestamp";

          $col_set=pg_query("SELECT distinct \"HydroMetParamsTypeId\" FROM \"$table\" as a where a.\"sensortype\"='Virtual' AND ($HydroMetShefCodeCoditionVirtual)");
          

          while ($cols=pg_fetch_array($col_set)) { 
            $sql_query_virtual.=",\"".$cols[0]."\" double precision";
          }

          $sql_query_virtual.=")";

          $sql_query="select t2.t";

          $col_set=pg_query("select \"SHEF\",\"SensorType\" FROM \"SensorValues\" where (\"StationFullName\"= '$stn_name') and ($sensorCondition)");
        
          while ($cols=pg_fetch_array($col_set)) 
          {
            $counted=count($PARAMS)-1;
         
            $col=pg_fetch_array(pg_query("SELECT  \"HydroMetParamsTypeId\" FROM \"tblHydroMetParamsType\" where  \"HydroMetShefCode\"='$cols[0]'"));
          
            if (trim($cols[1])=='Real') 
            {
              if(pg_num_rows(pg_query("select distinct \"HydroMetParamsTypeId\" FROM  \"$table\" a where ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY,$FM,$FD) AND ($TY,$TM,$TD)) and a.\"StationId\"=$s_id  and \"HydroMetParamsTypeId\"=$col[0] order by 1 asc"))>0)
              {
                $sql_query .=",t1.\"$col[0]\"" ;
                $sensor_count[$i]++;
              
              }
              else{
                $colum=$col[0];
              }
            }
            else
            {
              if(pg_num_rows(pg_query("select distinct \"HydroMetParamsTypeId\" FROM  \"$table\" a where ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY,$FM,$FD) AND ($TY,$TM,$TD)) and a.\"StationId\"=$s_id  and \"HydroMetParamsTypeId\"=$col[0] and \"sensortype\"='Virtual' order by 1 asc"))>0)
              {
                $sql_query .=",t2.\"$col[0]\"";
                $sensor_count[$i]++;
              
              }
              else{
                $colum=$col[0];
              }
            }
          }
        
          if($sensor_count[$i]!=""){
          
            if($sensor_count[$i]<$counted){
            
              $sql_query.=",NULL as \"$colum\"";
            
            }
           
          }
          $sql_query=rtrim($sql_query,",");
          if($realsensors!=''){
           
            $sql_query.=" from (".$sql_query_real.") t1 FULL OUTER JOIN (".$sql_query_virtual.") t2 on t2.t=t1.t order by t2.t desc";
           
          }
          else{
            $sql_query=$sql_query_virtual." order by 1 desc";
          }
        
          if(pg_num_rows(pg_query("SELECT distinct \"HydroMetParamsTypeId\" FROM \"$table\" as a where a.\"sensortype\"='Virtual' and ($HydroMetShefCodeCoditionVirtual)"))<=0)
          {
            $sql_query="select t1.t";
            
            $col_set=pg_query("select \"SHEF\",\"SensorType\" FROM \"SensorValues\" where (\"StationFullName\"= '$stn_name') and ($sensorCondition)");
            
            while ($cols=pg_fetch_array($col_set)) 
            {
              
              $counted=count($PARAMS)-1;
            
              $col=pg_fetch_array(pg_query("SELECT  \"HydroMetParamsTypeId\"   FROM \"tblHydroMetParamsType\" where  \"HydroMetShefCode\"='$cols[0]'"));

              if (trim($cols[1])=='Real') 
              {
                

                if(pg_num_rows(pg_query("select distinct \"HydroMetParamsTypeId\" FROM  \"$table\" a where ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY,$FM,$FD) AND ($TY,$TM,$TD)) and a.\"StationId\"=$s_id  and \"HydroMetParamsTypeId\"=$col[0] order by 1 desc"))>0)
                {
                  $sql_query .=",t1.\"$col[0]\"" ;
                  $sensorcount[$i]++;
                }
                else
                {
                  $colum=$col[0];
                }
              }
            }
          
            if($sensorcount[$i]!=""){
            
              if($sensorcount[$i]<$counted)
              {
              
                $sql_query.=",NULL as \"$colum\"";
              
              }
           
            }

            $sql_query.=" from (".$sql_query_real." ) t1 order by 1 desc";
          }
        
          $result_set[$i]=$sql_query;
          
          $i++;
        }
      }
    }
    $z=0;
    ?>
    <script>
      document.getElementById("btnExport").style.display = 'block';
      document.getElementById("exporttopdf").style.display = 'block';
      
    </script>
    <div class="col-md-12" id="customtable">
      <center><h3 style="margin-left: 1%;"><b><?php echo $_GET['station']; ?></b></h3></center>
    <table align="center" id="tab_customtable" style="max-width:99%;min-width:50%" class=" table-responsive table-bordered">
      <tr>
        <th style="background-color:#539CCC;color:white;text-align:center;font-size: 16px;width:350px;padding:5px;">Date / Time</th>
        <!-- <th  style="background-color:#539CCC;color:white;text-align:center;font-size: 13px">Sensor</th>-->
    <?php
        $result_sensor1=(pg_query("select \"Sensor\",\"Units\",\"SensorType\",\"SHEF\" from \"SensorValues\" where (\"StationFullName\"= '$stn_name') and ($sensorCondition)"));

        // echo("select \"Sensor\",\"Units\",\"SensorType\",\"SHEF\" from \"SensorValues\" where (\"StationFullName\"= '$stn_name') and ($sensorCondition)")."<br>";

        while ($sensor_row=pg_fetch_array($result_sensor1)) 
        {
          // print_r(json_encode($sensor_row));
          $sql="";
          if (trim($sensor_row[2])=="Real") {
      
            $col=pg_fetch_array(pg_query("SELECT  \"HydroMetParamsTypeId\"   FROM \"tblHydroMetParamsType\" where  \"HydroMetShefCode\"='$sensor_row[3]'"));
            $sql=("select distinct \"HydroMetParamsTypeId\" FROM  \"$table\" a where ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY,$FM,$FD) AND ($TY,$TM,$TD)) and a.\"StationId\"=$s_id  and \"HydroMetParamsTypeId\"=$col[0] order by 1 desc");
          }
          else
          {
            $col=pg_fetch_array(pg_query("SELECT  \"HydroMetParamsTypeId\"   FROM \"tblHydroMetParamsType\" where  \"HydroMetShefCode\"='$sensor_row[3]'"));
            $sql="select distinct \"HydroMetParamsTypeId\" FROM  \"$table\" a where ((\"Year\" ,\"Month\", \"Day\") BETWEEN ($FY,$FM,$FD) AND ($TY,$TM,$TD)) and a.\"StationId\"=$s_id  and \"HydroMetParamsTypeId\"=$col[0]  and \"sensortype\"='Virtual' order by 1 desc";
          }
          //echo "<br><br>$sql";
          // echo pg_num_rows(pg_query($sql));
          //if(pg_num_rows(pg_query($sql))>0) if you don't want Battery(v) use this condition 
          if(pg_num_rows(pg_query($sql))>=0)
          {
    ?>
            <th style="background-color:#539CCC;color:white;text-align:center;font-size: 13px;padding:5px;"><a style="color:white" href="javascript:PlotGraph('<?php if (isset($sensor_row[0])) echo $sensor_row[0];?>','<?php if (isset($sensor_row[0])){ echo $stn_name;}?>')"><?php if (isset($sensor_row[0])){echo $sensor_row[0];if ($sensor_row[1]!="") echo" (".$sensor_row[1].")";}else{echo "$sen[0]";}?></a></th>
    <?php
          }
        }
    ?>
      </tr>
    <?php
    $resulted_set="";
    for($i=0;$i<count($result_set);$i++){
      if((pg_num_rows(pg_query($result_set[$i])))>0)
      {
        $resulted_set.="(".$result_set[$i].")"." UNION ALL";
      }
    }
    $resulted_set=rtrim($resulted_set,' UNION ALL ');
    //echo $resulted_set;
    $results=pg_query($resulted_set);
    if (isset($results)) {

      if(pg_num_rows($results)>0)
      {
    
        $settings=pg_fetch_array(pg_query("select \"DateFormat\",\"DecimalPlaces\" from \"tblLogo\""));  
        while($row=pg_fetch_row($results))
        {
          if($row[0]!=""){
          $row_count=1;
    ?>
          <tr>
          <td style="text-align:center;font-size: 13px;height: 14px;width:350px"><?php if (isset($row[0])){ if (trim($row[0])!="icon.png"){$date = strtotime(trim($row[0]));echo date(trim($settings[0]), $date); }}?></td>
                                 
    <?php 
   
          $result_sensor1=pg_query("select \"Sensor\",\"Units\" from \"SensorValues\" where (\"StationFullName\"= '$stn_name') and ($sensorCondition)");
          $sensor_row=pg_num_rows(($result_sensor1));
          //echo $settings[1];
          for ($i=0; $i <$sensor_row; $i++) { 
    ?>                                
            <td style="text-align:center;font-size: 13px;height: 14px;"><?php if (isset($row[$row_count])){ echo number_format(floatval($row[$row_count]),$settings[1]);?></td> 
    <?php
            }
            $row_count=$row_count+1;
          }
    ?>
          </tr>
    <?php    
        }
      }
        echo "</table></div>";
      }
      else{
        echo "<tr><td>No Data Found in Last 12 Hours!</td></tr></table></div>";
      }
    }
  }
  ?>
  </center>
  </div>

  </div>
  </form>
  <?php
  function getSensorName($shef,$type,$stn)
  {
   $sensor_set= pg_query("select \"Sensor\" from \"SensorValues\" where \"SHEF\"='$shef' and \"SensorType\"='$type' and \"StationFullName\"='$stn'");

   $row=pg_fetch_array($sensor_set);

  return $row[0];
  }
  function checkSensor($sensors,$sensor)
  {
    $sensors_c=explode(";", $sensors);

  $result=false;

  for ($i=0; $i <count($sensors_c) ; $i++) 
  { 
  if (trim($sensor)==trim($sensors_c[$i]))
  {

  $result=true;
  }
  }

  return $result;
  }
  function month($month)
  {
    $val=0;
    switch ($month) {
      case "01":
      $val=31;
        break;
        case "02":
       $val=28;
        break;
          case "03":
       $val=31;
        break;
          case "04":
       $val=30;
        break;
          case "05":
       $val=31;
        break;
          case "06":
       $val=30;
        break;
          case "07":
       $val=31;
        break;
          case "08":
       $val=31;
        break;
          case "09":
       $val=30;
        break;
          case "10":
       $val=31;
        break;
          case "11":
       $val=30;
        break;
          case "12":
       $val=31;
        break;
    }
    return $val;
  }
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
  $shef=$row[0]."V";
  }
  return $shef;
  }
 
?>