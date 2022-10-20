<?php
    ini_set('max_execution_time', '-1');
	header('Acess-Control-Allow-Orgin: *');
	header('Content-Type: application/json');
	header('Access-Control-Allow-Methods: POST');
	header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

	include_once '../../Config/database.php';
	include_once '../../Model/MapData.php';
	
	$database = new database();
    $db = $database->connect();

	// $objModel = new MapData($db);
	$objModel = new MapData($db);

    $data = json_decode(file_get_contents('php://input'), true);

	$post['sensor']=isset($data['sensor']) ? $data['sensor'] : "";

	$post['company']=isset($data['company']) ? $data['company'] : "c 1";

	$post['time']=isset($data['time']) ? $data['time'] : "";

	// print_r($post);
	$objModel->post_data = $post;
	
	$respersonal=array(false,'','');

	if($post['time']==''){
		// print_r("Hello");
		$respersonal = $objModel->getMapData();
	}
	else{
		// print_r("hey");
		$respersonal = $objModel->getMapRainfallData();
	}
	
	// print_r($respersonal);

	$objModel->getApiResponse($respersonal);

?>