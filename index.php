<?php
include('header.php');
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

/**
 * ===================================
 *     Display store info
 * ===================================
 */
// $access_scopes = $shopify->rest_api("/admin/oauth/access_scopes.json", array(), 'GET');
// $scopes = json_decode($access_scopes['body'], true);


?>
<?php include('header.php') ?>


<article>
  <div class="card">
    Card
  </div>
</article>


<?php 
include('footer.php');
?>