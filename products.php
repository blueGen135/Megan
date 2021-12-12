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

 if($_SERVER['REQUEST_METHOD'] =='POST' && isset($_POST['delete_id'])){
   $delete = $shopify->rest_api("/admin/api/2021-04/products".$_POST['delete_id'].".json", array(), 'DELETE');
   $delete = json_decode($delete['body'], true);
 }

$products = $shopify->rest_api("/admin/api/2021-04/products.json", array(), 'GET');
$products = json_decode($products['body'], true);
?>
<?php include_once('header.php') ?>
<section>
  <table>
    <thead>
      <tr>
        <th colspan="2">Product</th>
        <th>Status</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
        foreach ($products as  $product) {
          foreach ($product as $key => $value) {
            $image = count($value['images']) > 0 ? $value['images'][0]['src'] : '';
      ?>
        <tr>
          <td> <img src="<?=$image?>" width="40px" height="40px"></td>
          <td><?=$value['title']?></td>
          <td><?=$value['status']?></td>
          <td>
            <form class="" method="post">
              <input type="hidden" name="delete_id" value="<?=$value['id']?>">
              <button type="submit" class="secondary icon-trash"></button></td>
            </tr>
            </form>
      <?php }
        }
       ?>
    </tbody>
  </table>
</section>
<?php include_once('footer.php') ?>
