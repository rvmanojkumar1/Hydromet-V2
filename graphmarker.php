<?php
include_once 'database.php';
if (isset($_POST)) {
	$file_data=$_POST['text_data'];

	$file_data = json_decode($file_data, true);
	
	$station=$_POST['stnname'];
	// $stationname="graph-".$station;
	$sensor=$_POST['sensor'];
	$result="";
	$col=array();
	$val=array();
	$text=array();
	for($k=0;$k<count($file_data);$k++)
	{
		if((strpos($file_data[$k][0], $station))!==false)
		{	
			$test=$file_data[$k];
			$m=5;
			if($file_data[$k][1]==$sensor){

				while($m<count($file_data[$k])){
					//$test=$m;
					if($file_data[$k][$m]==1){
						$test=$m;
						array_push($col, $file_data[$k][$m-1]);					
						array_push($val, $file_data[$k][$m-2]);					
						array_push($text, $file_data[$k][$m+1]);					
					}
					$m=$m+5;
				}
			}
		}
	}
	if((count($col)==count($val))&&(count($val)==count($text))){
		//$test=$col[0];
		for($i=0;$i<count($val);$i++){
			$result=$result.",".$val[$i];
		}
		for($i=0;$i<count($col);$i++){
			$result=$result.",".$col[$i];
		}
		for($i=0;$i<count($text);$i++){
			$result=$result.",".$text[$i];
		}
	}
	//$test=1;
	$result=ltrim($result,",");
	echo json_encode($result);
}
?>