<?php
include_once('./inc/conn.php');
include_once('./inc/shopify.php');

/**
 * ===================================
 *    Creating Shopify Variables
 * ===================================
 */
$shopify = new Shopify();


$parameters = $_GET;
$shop_url = $parameters['shop'];
/**
 * ===================================
 *     Checking The Shopify Store
 * ===================================
 */

 include_once('./inc/check_token.php');

 $products = $shopify->rest_api("/admin/api/2021-04/products.json", array(), 'GET');

$products = json_decode($products['body'], true);
print_r($products);
