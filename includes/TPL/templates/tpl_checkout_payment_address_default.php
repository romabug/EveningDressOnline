<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=checkout_payment_address.<br />
 * Allows customer to change the billing address.
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_checkout_payment_address_default.php 4852 2006-10-28 06:47:45Z drbyte $
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
    <li class="li1"><a href="<?php echo zen_href_link(FILENAME_SHOPPING_CART,'','SSL') ?>"><span>Your Shopping Cart</span></a></li>
    <li class="li2"><a href="<?php echo zen_href_link(FILENAME_CHECKOUT_SHIPPING,'','SSL') ?>"><span>Shipping Method</span></a></li>
    <li class="current3"><span>Payment Method</span></li>
    <li class="li4"><span>Review Order</span></li> 
    <li class="li5"><span>Order Complete</span></li>
  </ul>
</div>
<div class="right_big_con order_layer">

<?php echo zen_draw_form('checkout_address', zen_href_link(FILENAME_CHECKOUT_PAYMENT_ADDRESS, '', 'SSL'), 'post', 'onsubmit="return check_form_optional(checkout_address);"'); ?>

<div class="show">
<h3 class="border_b line_30px"><?php echo HEADING_TITLE; ?></h3>

<?php if ($messageStack->size('checkout_address') > 0) echo $messageStack->output('checkout_address'); ?>

<h4 class="dark_bg margin_t bg_in"><?php echo TITLE_PAYMENT_ADDRESS; ?></h4>

<ul class="pad_10px"><?php echo zen_address_label($_SESSION['customer_id'], $_SESSION['billto'], true, ' ', '<br />'); ?></ul>
<div class="blue_bg pad_10px"><?php echo TEXT_SELECTED_PAYMENT_DESTINATION; ?></div>
<br class="clear" />

<?php
     if ($addresses_count < MAX_ADDRESS_BOOK_ENTRIES) {
?>
<?php
/**
 * require template to collect address details
 */
 require($template->get_template_dir('tpl_modules_checkout_new_address.php', DIR_WS_TEMPLATE, $current_page_base,'templates'). '/' . 'tpl_modules_checkout_new_address.php');
?>
<?php
    }
    if ($addresses_count > 1) {
?>

<fieldset class="margin_t dark_border pad_10px">
<legend><b><?php echo TABLE_HEADING_NEW_PAYMENT_ADDRESS; ?></b></legend>
<?php
      require($template->get_template_dir('tpl_modules_checkout_address_book.php', DIR_WS_TEMPLATE, $current_page_base,'templates'). '/' . 'tpl_modules_checkout_address_book.php');
?>
</fieldset>
<?php
     }
?>

<div class="pad_10px fr g_t_r" style="width:300px;"><?php echo TITLE_CONTINUE_CHECKOUT_PROCEDURE  .' '. TEXT_CONTINUE_CHECKOUT_PROCEDURE; ?></br/>
<?php echo zen_draw_hidden_field('action', 'submit') . zen_image_submit(BUTTON_IMAGE_CONTINUE, BUTTON_CONTINUE_ALT); ?></div>

<?php
  if ($process == true) {
?>
<div class="pad_10px fl"><?php echo '<a href="' . zen_href_link(FILENAME_CHECKOUT_PAYMENT_ADDRESS, '', 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a>'; ?></div>

<?php
  }
?>
</form>
</div>