<?php 
$query = "SELECT * FROM `shops` WHERE `shop_url` = '{$shop_url}' LIMIT 1";
$result = $conn->query($query);
if($result->num_rows < 1){
    header('Location: install.php?shop='. $_GET['shop']);
    exit();
}
$store_data = $result->fetch_assoc();

$shopify->set_url($shop_url);
$shopify->set_access_token($store_data['access_token']);
$shop = $shopify->rest_api("/admin/api/2021-04/shop.json", array(), 'GET');

$response = json_decode($shop['body'], true);

// print_r($response);
if(array_key_exists('errors', $response)){
    header('Location: install.php?shop='. $_GET['shop']);
    exit();
}

?>