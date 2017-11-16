<?php
$input = $_POST["text1"];

$result = Analyze($input);

if(count($result)>2){
  echo "にゃーん";
}else{
  echo $input;
}

function Analyze($raw)
{
  $apiUrl = 'https://api.apigw.smt.docomo.ne.jp/truetext/v1/sensitivecheck?APIKEY=';
  $apiKey = '************************************************************************';
  $endPointUrl = $apiUrl.$apiKey;
  $text = urlencode($raw);


  $base_url = $endPointUrl;

  $data = "text=".$text;

  $header = ["content-type","application/x-www-form-urlencoded"];

  $curl = curl_init();

  curl_setopt($curl, CURLOPT_URL, $base_url);
  curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST'); // post
  curl_setopt($curl, CURLOPT_POSTFIELDS, $data); // jsonデータを送信
  curl_setopt($curl, CURLOPT_HTTPHEADER, $header); // リクエストにヘッダーを含める
  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_HEADER, true);

  $response = curl_exec($curl);

  $header_size = curl_getinfo($curl, CURLINFO_HEADER_SIZE);
  $header = substr($response, 0, $header_size);
  $body = substr($response, $header_size);
  $result = json_decode($body, true);

  curl_close($curl);

  return $result;
}
?>
