<?php


if (isset($_GET['data'])){

	date_default_timezone_set('Europe/London');
	$now = date('Y-m-d h:i:s');
	$reports = "Conversions";

	if (isset($_GET['data'])){
		$data = explode("|",$_GET['data']);
		if ($data[0]=="<click_id>"){
			//exit;
		}
	} else {
		exit;
	}
	$affid = $data[0];
		
	$lead = array (		                        
		'click_id' => $data[0],
		'token_1' => $data[1],		
		'token_2' => $data[2],
		'payout' => $data[3],
		'country' => $data[4],
		'os' => $data[5],
		'traffic_type' => $data[6],
		'connection_type' => $data[7],
		'carrier' => $data[8],
		'conversion_date' => $now,
		'currency_symbol' => '$'                        
	);
	
	$tanggal = date('Y-m-d', strtotime('today'));
	
	$filename = "temp/".$reports."-".$tanggal.".json";

	if (file_exists($filename)) {
		$json = @file_get_contents($filename);		
		$results = json_decode($json,true);
	} else {
		$results['success'] = true;
	}
	$results['conversions']['conversion'][] = $lead ;
	file_put_contents($filename,json_encode($results),LOCK_EX);
	
	echo "Success";
	exit;
}