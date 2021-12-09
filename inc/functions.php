<?php 

function validateHmac($params, $secret) {
    $hmac = $params['hmac'];
    unset($params['hmac']);
    ksort($params);
  
    $computedHmac = hash_hmac('sha256', http_build_query($params), $secret);
  
    return hash_equals($hmac, $computedHmac);
  }

function getAccessToken($shop, $apiKey, $secret, $code) {
  $query = array(
  	'client_id' => $apiKey,
  	'client_secret' => $secret,
  	'code' => $code
  );

  // Build access token URL
  $access_token_url = "https://{$shop}/admin/oauth/access_token";

  // Configure curl client and execute request
  $curl = curl_init();
  $curlOptions = array(
      CURLOPT_URL => $access_token_url,
    CURLOPT_POST => TRUE,
    CURLOPT_POSTFIELDS => http_build_query($query),
    CURLOPT_RETURNTRANSFER => TRUE,
    CURLOPT_SSL_VERIFYPEER => FALSE,
    CURLOPT_SSL_VERIFYHOST => FALSE
  );
  curl_setopt_array($curl, $curlOptions);
  $jsonResponse = json_decode(curl_exec($curl), true);
  curl_close($curl);
  return $jsonResponse["access_token"];
}


?>