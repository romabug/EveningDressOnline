<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=account_edit.<br />
 * Displays information related to a single specific order
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_account_history_info_default.php 6247 2007-04-21 21:34:47Z wilt $
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
    <span class="pad_10px pad_t block">If you have questions or need help with your account, you may <a class="u" href="<?php echo zen_href_link(FILENAME_FAQS,'','SSL') ?>">contact us</a> to assist you.  </span>
</div>
</div>
<div class="order_layer allborder right_big_con margin_t" id="layer_switch">
<?php if ($messageStack->size('views_order') > 0) echo $messageStack->output('views_order'); ?>
<?php if ($customer_info->RecordCount()>0) {?>
<div evt="click" id="boxswitch" class="">
      <div title="OrderSummary" class="on"><span>Order Summary</span></div>
      <div title="OrderStatus" id="border_left" class="off"><span><?php echo HEADING_ORDER_HISTORY; ?></span></div>
</div>
<div id="OrderSummary" class="show">
<h4 class="dark_bg margin_t bg_in"><?php echo TEXT_ORDER_INFORMATION; ?></h4>
<ul class="pad_l_28px margin_t">
        <strong><?php echo HEADING_ORDER_DATE?></strong> <?php echo zen_date_long($order->info['date_purchased']) ?><br/>
      <strong>Order #: </strong> <?php echo zen_get_order_no($order_id); ?><br/>
      <strong>Order Total: </strong> <?php echo $order->totals[sizeof($order->totals)-1]['text']; ?> 
<?php
/**
 * Used to display any downloads associated with the cutomers account
 */
  if (DOWNLOAD_ENABLED == 'true') require($template->get_template_dir('tpl_modules_downloads.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_downloads.php');
?>  
      </ul>
<br class="clear" />

<h4 class="dark_bg margin_t bg_car">
<div class="halfwidth fl"><?php echo HEADING_DELIVERY_ADDRESS; ?> </div>
<?php echo HEADING_BILLING_ADDRESS; ?>
</h4>
<ul class="pad_l_28px clear margin_t">
<?php
  if ($order->delivery != false) {
?>
<li class="fl halfwidth"><?php echo zen_address_format($order->delivery['format_id'], $order->delivery, 1, ' ', '<br />'); ?></li>
<?php
  }
?><li><?php echo zen_address_format($order->billing['format_id'], $order->billing, 1, ' ', '<br />'); ?></li></ul>
<?php
    if (zen_not_null($order->info['shipping_method'])) {
?>
<h4 class="dark_bg margin_t bg_doc clear"><?php echo HEADING_SHIPPING_METHOD; ?></h4>
<ul class="pad_l_28px margin_t"><?php echo $order->info['shipping_method']; ?></ul>
<?php } else { // temporary just remove these 4 lines ?>
<ul class="error_box"><?php echo TEXT_MISSING_SHIPPING_MISS; ?></ul>
<?php
    }
?>

<h4 class="dark_bg margin_t bg_dollar"><?php echo HEADING_PAYMENT_METHOD; ?></h4>
<ul class="pad_l_28px margin_t"><?php echo $order->info['payment_method']; ?></ul>


<h4 class="dark_bg margin_t bg_cart"><div class="check_order_w">Items Ordered</div>Price</h4>
<ul class="pad_l_28px margin_t">
<?php
  $n= count($order->products);
  for($i=0; $i<$n; $i++) {
  ?>
    <li class="check_order_w"><?php echo '<a href="'.zen_href_link(zen_get_info_page($order->products[$i]['id']),'products_id='.$order->products[$i]['id']).'">'.$order->products[$i]['qty'] . QUANTITY_SUFFIX .$order->products[$i]['name'] .'</a>';?>
    
<?php // if there are attributes, loop thru them and display one per line
    if (isset($order->products[$i]['attributes']) && sizeof($order->products[$i]['attributes']) > 0 ) {
    echo '<ul class="pad_1em">';
      for ($j=0, $n2=sizeof($order->products[$i]['attributes']); $j<$n2; $j++) {
?>
      <li><?php echo $order->products[$i]['attributes'][$j]['option'] . ': ' . nl2br(zen_output_string_protected($order->products[$i]['attributes'][$j]['value'])); ?></li>
<?php
      } // end loop
      echo '</ul>';
    } // endif attribute-info
?>
    </li>
    <li><?php echo $currencies->format(zen_add_tax($order->products[$i]['final_price'], $order->products[$i]['tax']) * $order->products[$i]['qty'], true, $order->info['currency'], $order->info['currency_value']) . ($order->products[$i]['onetime_charges'] != 0 ? '<br />' . $currencies->format(zen_add_tax($order->products[$i]['onetime_charges'], $order->products[$i]['tax']), true, $order->info['currency'], $order->info['currency_value']) : '') ?>    </li>
<?php
  }
  unset($n);
?>
</ul>
<hr class="clear"/>
<div class="g_t_r">
<?php
  $n=sizeof($order->totals);
  for ($i=0; $i<$n; $i++) {
  	if($i+1 == $n){
    echo '<br/><strong>'.$order->totals[$i]['title'].' '.$order->totals[$i]['text'].'</strong>'; 
  	}else {
    echo $order->totals[$i]['title'].' '.$order->totals[$i]['text'].'<br/>'; 
  	}
  }
  unset($n);
?>
</div>
<hr/>
<div class="g_t_r margin_t">
    <a title="Print an Invoice" href="javascript:window.print();">
    <img border="0" alt="wholesale Print an Invoice" title="wholesale Print an Invoice " src="includes/templates/<?php echo $template_dir; ?>/images/button/btn_order.gif"/>    </a>
        </div>








</div>
<div id="OrderStatus" class="hide">
<?php
/**
 * Used to loop thru and display order status information
 */
if (sizeof($statusArray)) {
?>
<table border="0" width="100%" class="table_orders margin_t" cellspacing="0" cellpadding="0">

    <tr class="tableHeading">
        <th width="140" height="33" class="gray_bg"><?php echo TABLE_HEADING_STATUS_DATE; ?></th>
        <th width="120" class="gray_bg"><?php echo TABLE_HEADING_STATUS_ORDER_STATUS; ?></th>
        <th class="gray_bg"><?php echo TABLE_HEADING_STATUS_COMMENTS; ?></th>
       </tr>
<?php
  foreach ($statusArray as $statuses) {
?>
    <tr>
        <td valign="top"><?php echo zen_date_short($statuses['date_added']); ?></td>
        <td valign="top"><?php echo $statuses['orders_status_name']; ?></td>
        <td valign="top"><?php echo (empty($statuses['comments']) ? '&nbsp;' : nl2br(zen_output_string_protected($statuses['comments']))); ?></td> 
     </tr>
<?php
  }
?>
</table>
<?php } ?>
    </div>
<script>layerswich();</script>
<?php } ?>
</div>