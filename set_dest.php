<?php

$request = new HttpRequest();
$request->setUrl('https://webexternal.nok.co.th/boardlinebot/api/Dest');
$request->setMethod(HTTP_METH_POST);

$request->setQueryData(array(
  'emp_code' => '160039',
  'location' => 'pln',
  'remark' => ''
));

$request->setHeaders(array(
  'cache-control' => 'no-cache',
  'Content-Type' => 'application/x-www-form-urlencoded'
));

$request->setContentType('application/x-www-form-urlencoded');

try {
  $response = $request->send();

  echo $response->getBody();
} catch (HttpException $ex) {
  echo $ex;
}