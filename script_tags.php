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
 if($_SERVER['REQUEST_METHOD'] == 'POST'){
   if($_POST['action_type'] == 'create_script'){
     $scriptTags_data = array(
        "script_tag" => array(
          "event" => "onload",
          "src" => " https://67dc-106-196-89-202.ngrok.io/megan/scripts/megan.js"
        )
     );
     $create_script = $shopify->rest_api("/admin/api/2021-04/script_tags.json", $scriptTags_data, 'POST');
     $create_script = json_decode($create_script['body'], true);
     print_r($create_script);
   }
 }

 $scriptTags = $shopify->rest_api("/admin/api/2021-04/script_tags.json", array(), 'GET');
 $scriptTags = json_decode($scriptTags['body'], true);
?>

<?php include_once('header.php') ?>
<section>

    <aside>
      <h2>Install Script Tags</h2>
    </aside>
    <article>
    <div class="card">
      <form class="" action="" method="post">
        <input type="hidden" name="action_type" value="create_script">
        <button type="submit">Create Script Tag</button>
      </form>
    </div>
    </article>

</section>

<?php include_once('footer.php') ?>
