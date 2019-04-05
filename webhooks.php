<?php // callback.php

require "vendor/autoload.php";
require_once('vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');


function post_dest($emp_code,$location,$remark){
	$len_lo = urlencode($location);
	$remark_len = urlencode($remark);
	$curl = curl_init();

	curl_setopt_array($curl, array(
	CURLOPT_URL => "https://webexternal.nok.co.th/boardlinebot/api/Dest?emp_code={$emp_code}&location={$len_lo}&remark={$remark_len}",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "POST",
	CURLOPT_POSTFIELDS => "emp_code=160039&location=osp1&remark=&undefined=",
	CURLOPT_HTTPHEADER => array(
		"Content-Type: application/x-www-form-urlencoded",
		"Postman-Token: 6a58649a-49b1-4e23-9010-e920bd1f387f",
		"cache-control: no-cache"
	),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);
	return $response;
}


$access_token = 'Wi2qUPlazMv6/shh9XJ1r0SeXRmfVyqxbTJgSqazLM+5DjrvqLBuF9rNVogQXqfe11rMbXxYFdx+5Ul9Ue/xgCM39ET/gMOST9AaEoGCDbEn34K8TdX1onpoWIoMBJygd8YJ/lxhdBNzfgIRPMh7AwdB04t89/1O/w1cDnyilFU=';

// Get POST body content
$content = file_get_contents('php://input');
// Parse JSON
$events = json_decode($content, true);
// Validate parsed JSON data
if (!is_null($events['events'])) {
	// Loop through each event
	foreach ($events['events'] as $event) {
		// Reply only when message sent is in 'text' format
		if ($event['type'] == 'message' && $event['message']['type'] == 'text') {
			
			
			// Get text sent
			$text = $event['message']['text'];

			// $all_len = strlen($text);

			// $location = substr($text,7,$all_len);

			// $emp_code = substr($text,0,6);

			// $text = "Empcode = {$emp_code} , Location = {$location}";
			
			$data_list = explode(" ",$text);

			$remark = "";

			for ($i=2; $i <= count($data_list) ; $i++) { 
				
				$remark .= "{$data_list[$i]} ";
			}

			

			

			// $url = 'https://webexternal.nok.co.th/boardlinebot/api/Dest';
			// $post_data = array('emp_code' => $data_list[0], 'location' => $data_list[1],'remark' => $remark);

			// $options = array(
			// 	'http' => array(
			// 		//'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
			// 		'method'  => 'POST',
			// 		'content' => http_build_query($post_data)
			// 	)
			// );
			

			// $context  = stream_context_create($options);
			// $result = file_get_contents($url, false, $context);


			// if ($result !== "Complete") { /* Handle error */ 
				// $text = $result;
			// }else{
			if($data_list[0] == "ShowAll"){
				if($data_list[1] == "IT"){
					$text = " show all IT ! ";
				}else if($data_list[1] == "WEB"){
					$text = " show all WEB ! ";
				}else if($data_list[1] == "QIM"){
					$text = " show all QIM ! ";
				}else if($data_list[1] == "SMART"){
					$text = " show all SMART ! ";
				}else if($data_list[1] == "BCS"){
					$text = " show all BCS ! ";
				}
				$return_cul = "Complete";
			}else{
				$text = "Empcode = {$data_list[0]} , Location = {$data_list[1]} Remark = {$remark} :D";
				$return_cul = post_dest($data_list[0],$data_list[1],$remark);
			}
			
			// }


			// Get replyToken
			$replyToken = $event['replyToken'];

			// Build message to reply back
			if(trim($return_cul) == "Complete"){
				$messages = [
					'type' => 'text',
					'text' => "{$text}"
				];
			}else{
				$messages = [
					'type' => 'text',
					'text' => "Can't insert."
				];
			}
			// Make a POST Request to Messaging API to reply to sender
			$url = 'https://api.line.me/v2/bot/message/reply';
			$data = [
				'replyToken' => $replyToken,
				'messages' => [$messages],
			];
			$post = json_encode($data);
			$headers = array('Content-Type: application/json', 'Authorization: Bearer ' . $access_token);

			$ch = curl_init($url);
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
			$result = curl_exec($ch);
			curl_close($ch);

			echo $result . "\r\n";

		
			

		}
	}
}
echo "OK";
