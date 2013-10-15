<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=shopping_cart.<br />
 * Displays shopping-cart contents
 *
 * @package templateSystem
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_shopping_cart_default.php 5554 2007-01-07 02:45:29Z drbyte $
 */
?>
<div class="right_big_con">
<!-- bof  breadcrumb -->
<?php if (DEFINE_BREADCRUMB_STATUS == '1' || (DEFINE_BREADCRUMB_STATUS == '2' && !$this_is_home_page) ) { ?>
    <div class="fl product_title margin_t pad_1em"><?php echo $breadcrumb->trail(BREAD_CRUMBS_SEPARATOR); ?></div>
<?php } ?>
<!-- eof breadcrumb -->
</div>
<div class="right_big_con">
	<ul id="projects">
    <li class="current1"><span>Your Shopping Cart</span></li>
    <li class="li2"><span>Account Login</span></li>
    <li class="li3"><span>Address Book</span></li>
    <li class="li4"><span>Billing, Shipping &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></li>
    <li class="li5"><span>Order Complete</span></li>
  </ul>
</div>
<?php
  if ($flagHasCartContents) {
?>
<div class="right_big_con allborder">

<div class="check_box_tit black pad_1em"><?php echo HEADING_TITLE; ?></div>
<div class="pad_10px check_box_con">
<?php if ($messageStack->size('shopping_cart') > 0) echo $messageStack->output('shopping_cart'); ?>

<?php echo zen_draw_form('cart_quantity', zen_href_link(FILENAME_SHOPPING_CART, 'action=update_product','SSL'),'post',' id="cart_quantity"'); ?>

<?php if (!empty($totalsDisplay)) { ?>
  <div class="cartTotalsDisplay important"><?php //echo $totalsDisplay; ?></div>
<?php } ?>

<?php  if ($flagAnyOutOfStock) { ?>

<?php    if (STOCK_ALLOW_CHECKOUT == 'true') {  ?>

<div class="messageStackError"><?php echo OUT_OF_STOCK_CAN_CHECKOUT; ?></div>

<?php    } else { ?>
<div class="messageStackError"><?php echo OUT_OF_STOCK_CANT_CHECKOUT; ?></div>

<?php    } //endif STOCK_ALLOW_CHECKOUT ?>
<?php  } //endif flagAnyOutOfStock ?>
<ul><?php echo zen_image($template->get_template_dir('continue_shop.gif', DIR_WS_TEMPLATE, $current_page_base,'images/button'). '/' . 'continue_shop.gif','','','',' border="0" class="hand" onclick="back(-1)"'); ?></ul>
<ul class="margin_t gray_bg fl">
     <li class="w1 in_1em"><strong><?php echo TABLE_HEADING_ITEM_NAME; ?></strong></li>
     <li class="w2"><strong><?php echo TABLE_HEADING_PRODUCTS_NAME; ?></strong></li>
     <li class="w3"><strong><?php echo TABLE_HEADING_QUANTITY; ?></strong></li>
     <li class="w5"><strong><?php echo TABLE_HEADING_PRICE; ?></strong></li>
     <li class="w5"><strong><?php echo TABLE_HEADING_DELETE; ?></strong></li>
</ul>
         <!-- Loop through all products /-->
<?php
  foreach ($productArray as $product) {
?>
     <ul class="fl margin_t border_b">
     	 <?php echo zen_draw_hidden_field('products_id[]',$product['id']);?>
       <li class="w1">
       <a href="<?php echo $product['linkProductsName']; ?>" class="ih"><?php echo $product['productsImage']; ?></a>
       </li>
       <li class="w2">
       <a href="<?php echo $product['linkProductsName']; ?>" class="u"><?php echo $product['productsName'] . '<span class="alert bold">' . $product['flagStockCheck'] . '</span>'; ?></a>

<?php
  echo '<br class="clear" />';
  echo $product['attributeHiddenField'];
  if ($product['showfreeicon']){
     echo '<div class="bulksale_free_shipping"></div>';
  }
  if (isset($product['attributes']) && is_array($product['attributes'])) {
  echo '<div class="cartAttribsList">';
  echo '<ul>';
    reset($product['attributes']);
    foreach ($product['attributes'] as $option => $value) {
      echo '<li class="blue clear">'.$value['products_options_name'] . TEXT_OPTION_DIVIDER . nl2br($value['products_options_values_name']).'</li>'; 
    }
  echo '</ul>';
  echo '</div>';
  }

?>
       </li>
       <li class="w3">
			<?php
          echo $product['quantityField'] ;
      ?>
      <div style="display: none;"><a onclick="$('cart_quantity').submit();return false;" href="javascript:void(0);">Update</a>|<a href="<?php echo $_SERVER['REQUEST_URI']?>">Cancel</a></div>
       </li>
       <li class="w5"><strong class="red"><?php echo $product['productsPrice']; ?></strong></li>
       <li class="w5">
       <?php if ($product['buttonDelete']) {?>
       <a href="<?php echo zen_href_link(FILENAME_SHOPPING_CART, 'action=remove_product&product_id=' . $product['id']); ?>"><?php echo zen_image($template->get_template_dir(ICON_IMAGE_TRASH, DIR_WS_TEMPLATE, $current_page_base,'images/button'). '/' . ICON_IMAGE_TRASH, ICON_TRASH_ALT); ?></a>
			 <?php } ?>
			 </li>
      </ul>
<?php
  } // end foreach ($productArray as $product)
?>
       <!-- Finished loop through all products /-->
<div class="clear margin_t g_t_l black b" style="padding-left: 532px;"><?php echo SUB_TITLE_SUB_TOTAL; ?><span class="red big"><?php echo $cartShowTotal; ?></span></div>
<br class="clear" />

<!--bof shopping cart buttons-->
<ul class="margin_t"><?php echo zen_image($template->get_template_dir('continue_shop.gif', DIR_WS_TEMPLATE, $current_page_base,'images/button'). '/' . 'continue_shop.gif','','','',' border="0" class="hand fl" onclick="back(-1)"'); ?>
<li class="g_t_c" style="padding-left: 380px;"><?php echo '<a href="' . zen_href_link(FILENAME_CHECKOUT_SHIPPING_ADDRESS, '', 'SSL') . '" class="buttonCheakout"></a><br/>'; ?>

<!-- * BEGIN GOOGLE CHECKOUT * -->
 <?php
  // ** GOOGLE CHECKOUT **
    include(DIR_WS_MODULES . 'show_google_components.php');  
  // ** END GOOGLE CHECKOUT **
 ?>
<!-- * END GOOGLE CHECKOUT * -->
<!-- ** BEGIN PAYPAL EXPRESS CHECKOUT ** -->
<?php  // the tpl_ec_button template only displays EC option if cart contents >0 and value >0
if (defined('MODULE_PAYMENT_PAYPALWPP_STATUS') && MODULE_PAYMENT_PAYPALWPP_STATUS == 'True') {
  include(DIR_FS_CATALOG . DIR_WS_MODULES . 'payment/paypal/tpl_ec_button.php');
}
?>
<!-- ** END PAYPAL EXPRESS CHECKOUT ** -->
</li>
</ul>
<!--eof shopping cart buttons-->
<?php echo '</form>'; ?>

<hr class="clear"/>
<span class="line_120"><?php echo TEXT_INFORMATION; ?></span>
<h4 class="dark_bg margin_t bg_car"><a onclick="toggle('shipping_estimator_frm');" class="red u" href="javascript:void(0);"><?php echo CART_SHIPPING_OPTIONS; ?></a></h4>
<iframe width="98%" scrolling="no" height="300" frameborder="0" src="<?php echo zen_href_link(FILENAME_SHIPPING_ESTIMATOR); ?>" style="display: none;" id="shipping_estimator_frm"></iframe>

</div>
</div>
<?php
  } else {
?>
<div class="right_big_con allborder">
	<div class="check_box_tit black pad_1em">Your Shopping Cart</div>
	<div class="pad_10px check_box_con">
     <h3 class="g_t_c margin_t"><?php echo TEXT_CART_EMPTY; ?></h3>
     <p class="g_t_c">To continue shopping,please <a class="u" href="./">click here</a>.</p>
  </div>
</div>
<?php
  }
?>

<?php
  require(DIR_WS_MODULES.zen_get_module_directory('sideboxes/recently_viewed.php'));
?>
