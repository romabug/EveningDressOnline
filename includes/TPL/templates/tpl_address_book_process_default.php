<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=address_book_process.<br />
 * Allows customer to add a new address book entry
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_address_book_process_default.php 2949 2006-02-03 01:09:07Z birdbrain $
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
<?php if ($messageStack->size('addressbook') > 0) echo $messageStack->output('addressbook'); ?> 
<div class="margin_t allborder">
<div class="check_box_tit black pad_1em"><?php echo HEADING_TITLE; ?></div>
<?php
  if (isset($_GET['delete'])) {
?>
<div class="alert"><?php echo DELETE_ADDRESS_DESCRIPTION; ?></div>
<address><?php echo zen_address_label($_SESSION['customer_id'], $_GET['delete'], true, ' ', '<br />'); ?></address>
<br class="clear" />
<div class="pad_10px fr"><?php echo '<a href="' . zen_href_link(FILENAME_ADDRESS_BOOK_PROCESS, 'delete=' . $_GET['delete'] . '&action=deleteconfirm', 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_DELETE, BUTTON_DELETE_ALT) . '</a>'; ?></div>
<div class="pad_10px fl"><?php echo '<a href="' . zen_href_link(FILENAME_ADDRESS_BOOK, '', 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a>'; ?></div>
<?php
  } else {
	/**
	 * Used to display address book entry form
	 */
  require($template->get_template_dir('tpl_modules_address_book_details.php', DIR_WS_TEMPLATE, $current_page_base,'templates'). '/' . 'tpl_modules_address_book_details.php');
  ?>



<?php
  if (isset($_GET['delete'])){
?>
<div class="pad_10px fr"><?php echo zen_draw_hidden_field('action', 'process') . zen_image_submit(BUTTON_IMAGE_SUBMIT, BUTTON_SUBMIT_ALT); ?></div>
<?php
    }
  }
?>

</div>
</div>