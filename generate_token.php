<?php 
include_once('./inc/conn.php');
include_once('./inc/functions.php');
$api_key = '2478184ff586db088ec01e59fc6da91e';
$shared_secret = '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';
$params = $_GET; // Retrieve all request parameters
$hmac = $_GET['hmac']; // Retrieve HMAC request parameter
$shop =  $params['shop'];

$validHmac = validateHmac($params, $shared_secret);
if($validHmac){
  $accessToken = getAccessToken($params['shop'], $api_key, $shared_secret, $params['code']);
  $query = "INSERT INTO shops(`shop_url`, `access_token`, `hmac`, `install_date`) VALUES ('{$shop}','{$accessToken}','{$hmac}', NOW()) ON DUPLICATE KEY UPDATE `access_token` = '{$accessToken}', `hmac` = '{$hmac}' ";
  if($conn->query($query)){
    echo "<script>top.window.location = 'https://".$shop."/admin/apps' </script>";
  //  header("Location: https://".$shop."/admin/apps");
   exit;
  }
}else{
  echo "This request is NOT from Shopify!";
}


?>