<?php

 
$emp_code = $_GET['emp_code'];
$location = $_GET['location'];
$remark = $_GET['remark'];

$curl = curl_init();

curl_setopt_array($curl, array(
CURLOPT_URL => "https://webexternal.nok.co.th/boardlinebot/api/Dest?emp_code={$emp_code}&location={$location}&remark={$remark}",
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

if ($err) {
echo "cURL Error #:" . $err;
} else {
echo $response;
}

?>