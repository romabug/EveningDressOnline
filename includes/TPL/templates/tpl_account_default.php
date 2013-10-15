<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=account.<br />
 * Displays previous orders and options to change various Customer Account settings
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_account_default.php 4086 2006-08-07 02:06:18Z ajeh $
 */
?>
<div class="minframe fl">
<?php
 require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/'.$template_dir.'/box_contact_us.php'));
?>
<div class="bg_box_gray margin_t allborder clear">
<h3 class="in_1em line_30px">My Account</h3>
	<div class="pad_10px pad_t">
	<ul class="red_arrow_list">
	<li><a class="red b" href="<?php echo zen_href_link(FILENAME_ACCOUNT,'','SSL');?>">View Orders</a></li>
	<li><a href="<?php echo zen_href_link(FILENAME_ACCOUNT_EDIT,'','SSL');?>">Account Settings</a></li>
	<li><a href="<?php echo zen_href_link(FILENAME_MANAGER_ADDRESS,'','SSL');?>">Manage Address Book</a></li>
	</ul>
	</div>
</div>
<?
 require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/'.$template_dir.'/account_order_search.php'));
?>
<div class="bg_box_gray margin_t allborder clear">
	<h3 class="in_1em line_30px">Need help</h3>
		<span class="pad_10px pad_t block">If you have questions or need help with your account, you may <a class="u" href="<?php echo zen_href_link(FILENAME_FAQS,'','SSL') ?>">contact us</a> to assist you.	</span>
</div>
</div>
<div class="right_big_con margin_t line_30px">
<h2><?php echo HEADING_TITLE; ?></h2>
<?php if ($messageStack->size('account') > 0) echo $messageStack->output('account'); ?>
<h4 class="border_b in_1em"><?php echo OVERVIEW_PREVIOUS_ORDERS; ?></h4>
<table width="100%" border="0" cellpadding="0" cellspacing="0" id="prevOrders" class="table_orders margin_t">
<tr >
    <th class="gray_bg" width="150" height="33" ><?php echo TABLE_HEADING_ORDER_NUMBER; ?></th>
    <th class="gray_bg" width="150"><?php echo TABLE_HEADING_DATE; ?></th>
    <th class="gray_bg" width="205"><?php echo TABLE_HEADING_SHIPPED_TO; ?></th>
    <th class="gray_bg" width="150"><?php echo TABLE_HEADING_STATUS; ?></th>
    <th class="gray_bg" width="100"><?php echo TABLE_HEADING_TOTAL; ?></th>
  </tr>
<?php
$orders_split = new splitPageResults($orders_query, MAX_DISPLAY_PRODUCTS_LISTING, 'o.order_no', 'page');
$zco_notifier->notify('NOTIFY_MODULE_PRODUCT_LISTING_RESULTCOUNT', $listing_split->number_of_rows);
$orders = $db->Execute($orders_split->sql_query);
if ($orders->RecordCount() > 0) {
	while(!$orders->EOF){
	  if (zen_not_null($orders->fields['delivery_name'])) {
    $order_name = $orders->fields['delivery_name'];
    $order_country = $orders->fields['delivery_country'];
	  } else {
	  $order_name = $orders->fields['billing_name'];
	  $order_country = $orders->fields['billing_country'];
	  }
?>
  <tr>
    <td><?php echo '<a href="' . zen_href_link(FILENAME_ACCOUNT_HISTORY_INFO, 'order_id=' . $orders->fields['orders_id'], 'SSL') . '"> ' . TEXT_NUMBER_SYMBOL . zen_get_order_no($orders->fields['orders_id']). '</a>'; ?></td>
    <td><?php echo zen_date_short($orders->fields['date_purchased']); ?></td>
    <td><?php echo zen_output_string_protected($order_name) . '<br />' . $order_country; ?></td>
    <td><?php echo $orders->fields['orders_status_name']; ?></td>
    <td><?php echo $orders->fields['order_total']; ?></td>
  </tr>
<?php
  $orders->MoveNext();
  }
} 
?>
</table>
<br class="clear"/>
<?php if ( ($orders_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3')) ) {
?>
<div class="pagebar margin_t g_t_c gray_bg"><?php echo TEXT_RESULT_PAGE . ' ' . $orders_split->display_links(MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></div>
<?php
  }
?>

<?php
// only show when there is a GV balance
  if ($customer_has_gv_balance ) {
?>
<div id="sendSpendWrapper">
<?php require($template->get_template_dir('tpl_modules_send_or_spend.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_send_or_spend.php'); ?>
</div>
<?php
  }
?>
<div class="clear" ></div>
</div>
<?php require(DIR_WS_MODULES.zen_get_module_directory('sideboxes/recommendations.php')); ?>