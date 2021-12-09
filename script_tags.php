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

 $scriptTags = $shopify->rest_api("/admin/api/2021-04/script_tags.json", array(), 'GET');

$scriptTags = json_decode($scriptTags['body'], true);
print_r($scriptTags);
