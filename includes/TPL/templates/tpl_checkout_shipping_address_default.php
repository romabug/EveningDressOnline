<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=checkout_shipping_adresss.<br />
 * Allows customer to change the shipping address.
 *
 * @package templateSystem   
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_checkout_shipping_address_default.php 4852 2006-10-28 06:47:45Z drbyte $
 */
?>
<ul id="projects">
  <li class="li1"><a href="<?php echo zen_href_link(FILENAME_SHOPPING_CART,'','SSL') ?>"><span>Your Shopping Cart</span></a></li>
  <li class="li2"><span>Account Login</span></li>
  <li class="current3"><span>Address Book</span></li>
  <li class="li4"><span>Billing, Shipping &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></li>  
  <li class="li5"><span>Order Complete</span></li>
</ul>
<div class="ck_w center">
<?php if ($messageStack->size('checkout_address') > 0) echo $messageStack->output('checkout_address'); ?>
<?php if ($messageStack->size('addressbook') > 0) echo $messageStack->output('addressbook'); ?>
<div class="margin_t allborder">
<h3 class="check_box_tit black pad_1em"><?php echo HEADING_TITLE; ?></h3>
<div class="pad_10px big">
<?php
  if (defined('CHECKOUT_SHOPPPING_ADDRESS_DESCRIPTION')){
		echo '<ul>';
	  echo CHECKOUT_SHOPPPING_ADDRESS_DESCRIPTION;
	  if ($addresses_count < MAX_ADDRESS_BOOK_ENTRIES){
		  echo '<a class="red u" href="'.$_SERVER['REQUEST_URI'].'#createShip">'.ENTER_NEW_SHIPPING_TEXT.'</a>';
	  }
	  echo '</ul>';
  }
?>
<?php
  if ($process == false || $error == true) {
	  if ($addresses_count > 0) {
	  ?>
	    <ul class="margin_t pad_10px tt" style="width:688px;">
	    <?php //echo TABLE_HEADING_ADDRESS_BOOK_ENTRIES; ?>
	  <?php
	    require($template->get_template_dir('tpl_modules_checkout_address_book.php', DIR_WS_TEMPLATE, $current_page_base,'templates'). '/' . 'tpl_modules_checkout_address_book.php');
	  ?>
			</ul>
			<style>
		  .tt li {width:300px;padding:0 40px 0 4px; border-bottom:1px dashed #ddd; height:170px;margin-top:8px;color:#000;}
	    </style>
		<?php
	  }
	  echo '<ul class="clear pad_top">';
	  echo '<div>';
	  echo '<h4>'.TITLE_PLEASE_SELECT.'</h4>';
	  echo FORM_SKIP_TO_ADDRESS_TEXT;
	  echo '</div>';
	  echo '<a name="createShip"></a>';
	  echo zen_draw_form('checkout_address', zen_href_link(FILENAME_CHECKOUT_SHIPPING_ADDRESS, '', 'SSL'), 'post', 'onsubmit="return(fmChk(this))" id="checkout_address"');
		echo zen_draw_hidden_field('action', 'createShipping');
		echo zen_draw_hidden_field('address','0');
		echo zen_draw_hidden_field('save','0');
	  if($addresses_count < MAX_ADDRESS_BOOK_ENTRIES) {
		  require($template->get_template_dir('tpl_modules_checkout_new_address.php', DIR_WS_TEMPLATE, $current_page_base,'templates'). '/' . 'tpl_modules_checkout_new_address.php');
		}
  echo '</form>';
	echo '<script>initForm(\'checkout_address\');</script>';
	echo '<br class="clear"/>';
	echo '</ul>';
  }
  if ($process == true) {
?>
  <div class="pad_10px fl"><?php echo '<a href="' . zen_href_link(FILENAME_CHECKOUT_SHIPPING_ADDRESS, '', 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a>'; ?></div>

<?php
  }
?>
</div>
</div>
<br class="clear"/>
</div>