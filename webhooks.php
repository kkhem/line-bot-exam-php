<?php // callback.php

require "vendor/autoload.php";
require_once('vendor/linecorp/line-bot-sdk/line-bot-sdk-tiny/LINEBotTiny.php');

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
				$text = "Empcode = {$data_list[0]} , Location = {$data_list[1]} Remark = {$remark} :D";

			// }


			// Get replyToken
			$replyToken = $event['replyToken'];

			// Build message to reply back
			$messages = [
				'type' => 'text',
				'text' => $text
			];

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
