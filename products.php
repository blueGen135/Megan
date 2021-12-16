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

 if($_SERVER['REQUEST_METHOD'] =='POST'){
     if($_POST['action_type'] == 'delete' && isset($_POST['delete_id'])){
         $pid = explode("/", $_POST['delete_id']);
       $delete = $shopify->rest_api("/admin/api/2021-04/products/".end($delete_id).".json", array(), 'DELETE');
       $delete = json_decode($delete['body'], true);
    }
    if($_POST['action_type'] == 'update' && isset($_POST['update_id'])){
      $pid = explode("/", $_POST['update_id']);

      $update_data = array(
          "product" => array(
            "id" => end($pid),
            "title"=> $_POST['update_name']
          )
      );
      $update = $shopify->rest_api("/admin/api/2021-04/products/".end($pid).".json", $update_data, 'PUT');
      $update = json_decode($update['body'], true);
   }
   if($_POST['action_type'] == 'create' && isset($_POST['product_title']) && isset($_POST['product_desc'])){
     $product_data = array(
       "product" =>array(
         "title" => $_POST['product_title'],
         "body_html" => $_POST['product_desc']
       )
     );
     $create_product = $shopify->rest_api('/admin/api/2021-04/products.json', $product_data, "POST");
   }
 }


//Get Product data using REST API
// $products = $shopify->rest_api("/admin/api/2021-04/products.json", array(), 'GET');
// $products = json_decode($products['body'], true);

//Getting data using RGAPHQL

$gpl_query = array("query" => "{
  products(first: 10){
    edges {
      node {
        id
        title
        images(first: 1) {
          edges {
            node {
              originalSrc
            }
          }
        }
        status
      }
    }
  }
}");

$products = $shopify->graphql($gpl_query);
$products = json_decode($products['body'],true);
$products_edges = $products["data"]["products"];
?>
<?php include_once('header.php') ?>
<section>

  <aside>
    <h2>Create new product</h2>
  </aside>
  <article>
  <div class="card">
    <form class="" action="" method="post">
      <input type="hidden" name="action_type" value="create">
        <div class="row">
          <label for="productTitle">Product Title</label>
          <input type="text" name="product_title" id="productTitle">
        </div>

        <div class="row">
          <label for="product_desc">Description</label>
          <textarea name="product_desc" id="product_desc"></textarea>
          </div>
          <div class="row">
            <button type="submit" name="submit">Submit</button>
          </div>
    </form>
  </div>
</article>

</section>
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
          //getting data using graphql
          foreach ($products_edges as $edges) {
            foreach ($edges as $node) {
                foreach ($node as $key => $value) {
                  $image = count($value['images']['edges']) > 0 ? $value['images']['edges'][0]['node']['originalSrc'] : '';
            ?>
              <tr>
                <td> <img src="<?=$image?>" width="40px" height="40px"></td>
                <td>
                    <form class="row side-elements" method="post">
                        <input type="hidden" name="update_id" value="<?=$value['id']?>">
                        <input type="text" name="update_name" value="<?=$value['title']?>">
                        <input type="hidden" name="action_type" value="update">
                        <button type="submit" class="secondary icon-checkmark"></button></td>
                    </form>
                </td>
                <td><?=$value['status']?></td>
                <td>
                  <form class="" method="post">
                    <input type="hidden" name="delete_id" value="<?=$value['id']?>">
                      <input type="hidden" name="action_type" value="delete">
                    <button type="submit" class="secondary icon-trash"></button></td>
                  </form>
                  </tr>
            <?php
          }
            }
          }
       ?>


      <?php
        // foreach ($products as  $product) {
        //   foreach ($product as $key => $value) {
        //     $image = count($value['images']) > 0 ? $value['images'][0]['src'] : '';
      ?>
        <!-- <tr>
          <td> <img src="<?=$image?>" width="40px" height="40px"></td>
          <td>
              <form class="row side-elements" method="post">
                  <input type="hidden" name="update_id" value="<?=$value['id']?>">
                  <input type="text" name="update_name" value="<?=$value['title']?>">
                  <input type="hidden" name="action_type" value="update">
                  <button type="submit" class="secondary icon-checkmark"></button></td>
              </form>
          </td>
          <td><?=$value['status']?></td>
          <td>
            <form class="" method="post">
              <input type="hidden" name="delete_id" value="<?=$value['id']?>">
                <input type="hidden" name="action_type" value="delete">
              <button type="submit" class="secondary icon-trash"></button></td>
            </form>
            </tr> -->
      <?php
    // }
    //     }
       ?>
    </tbody>
  </table>
</section>
<?php include_once('footer.php') ?>
