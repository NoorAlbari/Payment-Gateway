<?php
function file_get_contents_curl($url) {
	$ch = curl_init();

	curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
	curl_setopt($ch, CURLOPT_HEADER, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);       
	$data = curl_exec($ch);
	curl_close($ch);

	return $data;
}
		
function openURL($url)
{
	$response = file_get_contents_curl($url);
	
	return $response;
}

function dataUrl($url, $data)
{
	$return['data_url']=$url;
	foreach($data as $key => $value)
	{
		if(strpos($return['data_url'], "?") === false)
			$return['data_url'] .= "?$key=".urlencode($value);
		else
			$return['data_url'] .= "&$key=".urlencode($value);
	}
	
	return $return;
}

function calculateHash($hash, $data)
{
	ksort($data);
	
	$not_calculated=array("calculated_hash", "note");
	$data['data']="";
	
	foreach($data as $key => $value)
	{
		if(!in_array($key, $not_calculated) && $key != "data")
			$data['data'] .= $key ."=". $value .";";
	}
	$return['data'] = $data['data'] .= "hash=". $hash .";";
	$return['calculated_hash'] = md5($data['data']);
	
	return $return;	
}

function updatePayment($unique_id, $hash, $payment_id, $processed)
{
	global $gatee;
	
	$gatee_url=$gatee['test'] ? "http://test.gate-e.com" : "https://www.gate-e.com";
	$url="$gatee_url/api/updatepayment.php?unique_id=$unique_id&hash=$hash&payment_id=$payment_id&processed=$processed";
	$response = openURL($url);
	
	// Decode data
	$response=json_decode($response, true);
	
	return $response;
}

function getPayment($unique_id, $hash, $payment_id)
{
	global $gatee;
	
	$gatee_url=$gatee['test'] ? "http://test.gate-e.com" : "https://www.gate-e.com";
	$url="$gatee_url/api/getpayment.php?unique_id=$unique_id&hash=$hash&payment_id=$payment_id";
	$response = openURL($url);
	
	// Decode data
	$response=json_decode($response, true);
	
	return $response;
}

?>