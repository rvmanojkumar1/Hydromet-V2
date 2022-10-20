<?php
include_once 'database.php';
if (isset($_POST)) {
	$file_data=$_POST['text_data'];
	$file_data = json_decode($file_data, true);
	$station=$_POST['stnname'];
	$stationname="graph-".$station;
	$sensor=$_POST['sensor'];
	for($j=0;$j<count($file_data);$j++)
	{
		if((strpos($file_data[$j][0], $stationname))!==false)
		{	
			$i=0;
			while($i<count($file_data[$j]))
			{
				$sname=$file_data[$j][0];
				$param=$file_data[$j][1];
				$value1=$file_data[$j][2];
				$value2=$file_data[$j][3];
				$value2=rtrim($value2,"\r");
				if($value2!==null){
					$output=$sname.",".$param.",".$value1.",".$value2;
				}else{
					$output=$sname.",".$param.",".$value1;
				}
				$i++;
			}
			if($param==$sensor){
				if(((strpos($value1,">"))!==false)&&((strpos($value2, ">"))!==false)){
					$value1=str_replace(">", "", $value1);
					$value2=str_replace(">", "", $value2);
					if($value2!==null){
						$val=$value1.",".$value2;
					}
					else{
						$val=$value1;
					}
				}
				else if(((strpos($value1,"<"))!==false)&&((strpos($value2, "<"))!==false)){
					$value1=str_replace("<", "", $value1);
					$value2=str_replace("<", "", $value2);
					if($value2!==null){
						$val=$value1.','.$value2;
					}
					else{
						$val=$value1;
					}
				}
			}
			else
			{

			}
		}
	}
	
	echo json_encode($sensor);
}
?>