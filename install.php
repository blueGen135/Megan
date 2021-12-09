<?php
$api_key = '2478184ff586db088ec01e59fc6da91e';
$_NGROK_URL = 'https://6778-2401-4900-5999-d7a2-edd6-3b5d-9f63-79b5.ngrok.io';
$shop = $_GET['shop'];
$scopes = 'read_products,write_products,read_orders,write_orders,read_script_tags,write_script_tags';
$resirect_uri = $_NGROK_URL. '/megan/generate_token.php';
$nonce = bin2hex(random_bytes(12));
$access_mode = 'per-user';
$oauth_url = $install_url = "https://".$shop."/admin/oauth/authorize?client_id=" . $api_key . "&scope=" . $scopes . "&redirect_uri=" . urlencode($resirect_uri)."&state=".$nonce."&grant_options[]=".$access_mode;
header('Location: '. $oauth_url);

exit();



?>