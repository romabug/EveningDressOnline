<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=checkout_shipping.<br />
 * Displays allowed shipping modules for selection by customer.
 *
 * @package templateSystem
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_checkout_shipping_default.php 6964 2007-09-09 14:22:44Z ajeh $
 */
  
?>
<?php echo $payment_modules->javascript_validation(); ?>
<style type="text/css">
<!--
.STYLE1 {color: #990000}
-->
</style>

<ul id="projects">
  <li class="li1"><a href="<?php echo zen_href_link(FILENAME_SHOPPING_CART,'','SSL') ?>"><span>Your Shopping Cart</span></a></li>
  <li class="li2"><span>Account Login</span></li>
  <li class="li3"><a href="<?php echo zen_href_link(FILENAME_CHECKOUT_SHIPPING_ADDRESS,'','SSL') ?>"><span>Address Book</span></a></li>
  <li class="current4"><span>Billing, Shipping &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></li> 
  <li class="li5"><span>Order Complete</span></li>
</ul>
<div class="ck_w center ">
<?php if ($messageStack->size('checkout_shipping') > 0) echo $messageStack->output('checkout_shipping'); ?>
<?php if ($messageStack->size('redemptions') > 0) echo $messageStack->output('redemptions'); ?>
<?php if ($messageStack->size('checkout') > 0) echo $messageStack->output('checkout'); ?>
<?php if ($messageStack->size('checkout_payment') > 0) echo $messageStack->output('checkout_payment'); ?>
<div class="margin_t allborder">
<div class="check_box_tit black pad_1em ">Please Select Payment Method</div>
<?php
echo zen_draw_form('shipping_method', zen_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'),'post','onsubmit="return check(this)" id="shipping_method"');
echo zen_draw_hidden_field('payment','');
?>

<div class="show pad_10px">
<h4 class="dark_bg margin_t bg_in red"><div class="fl halfwidth"><?php echo TITLE_SHIPPING_ADDRESS; ?></div><?php echo TABLE_HEADING_BILLING_ADDRESS; ?></h4>
<ul class="pad_l_28px clear margin_t black">
	<li class="fl halfwidth">
		<div style="width:300px;">
		<ul>
		<?php
		  $sendToArray = zen_get_address_fields($_SESSION['customer_id'],$_SESSION['sendto']);
		  		  
		  echo '<b>'.$sendToArray['firstname'].' '.$sendToArray['lastname'].'</b>';
		  $sendToArrayFiltered = filterName($sendToArray);
		  $format_id = zen_get_address_format_id($sendToArrayFiltered['country_id']);
		  echo zen_address_format($format_id, $sendToArrayFiltered, true, ' ', '<br />');
		// 不显示电话  echo '<br/>Phone: '.$sendToArray['phone'];
		  ?>
		<?php if ($displayAddressEdit) { ?>
	    <ul class="pad_l_90px margin_t"><?php echo '<a href="' . $editShippingButtonLink . '">' . zen_image($template->get_template_dir('btn_change.gif', DIR_WS_TEMPLATE, $current_page_base,'images/button'). '/btn_change.gif','','','',' border="0"') . '</a>'; ?></ul>
    <?php } ?>
		<div class="margin_t big_ gray"><?php echo TEXT_CHOOSE_SHIPPING_DESTINATION; ?></div>
		</div>
	</li>
	<?php
	 // ** BEGIN PAYPAL EXPRESS CHECKOUT **
	if (!$payment_modules->in_special_checkout()) {
	 // ** END PAYPAL EXPRESS CHECKOUT ** ?>
	<li>
		<div id="checkoutBillto" class="margin_t big_">
		<ul>
    <?php
      $billToArray = zen_get_address_fields($_SESSION['customer_id'],$_SESSION['billto']);
      echo '<b>'.$billToArray['firstname'].' '.$billToArray['lastname'].'</b>';
      $billToArrayFiltered = filterName($billToArray);
      $format_id_bill = zen_get_address_format_id($billToArrayFiltered['country_id']);
      echo zen_address_format($format_id_bill, $billToArrayFiltered, true, ' ', '<br />');
       // 不显示电话   echo '<br/>Phone: '.$billToArray['phone'];
      ?>
		</ul>
		<?php if (MAX_ADDRESS_BOOK_ENTRIES >= 2) { ?>
	    <ul class="pad_l_90px margin_t"><?php echo '<a href="' . zen_href_link(FILENAME_ADDRESS_BOOK_PROCESS, 'url=checkout_shipping&edit='.$_SESSION['billto'], 'SSL') . '">' . zen_image($template->get_template_dir('btn_edit.gif', DIR_WS_TEMPLATE, $current_page_base,'images/button'). '/btn_edit.gif','','','',' border="0"').'</a>'; ?></ul>
    <?php } ?>
		</div>
		<br class="clearBoth" />
	</li>
	<?php
	 // ** BEGIN PAYPAL EXPRESS CHECKOUT **
	  }
	// ** END PAYPAL EXPRESS CHECKOUT ** ?>
<br class="clear" />
</ul>


<?php
  if (zen_count_shipping_modules() > 0) {
?>
<br class="clear" />
<h4 class="dark_bg margin_t bg_car red"><?php echo TABLE_HEADING_SHIPPING_METHOD; ?></h4>
<div class="big_ pad_l_28px margin_t">
<?php
    if (sizeof($quotes) > 1 && sizeof($quotes[0]) > 1) {
?>
<ul class="clear"><?php echo TEXT_CHOOSE_SHIPPING_METHOD; ?></ul>
<?php
    } elseif ($free_shipping == false) {
?>
<ul class="clear"><?php echo TEXT_ENTER_SHIPPING_INFORMATION; ?></ul>
<?php
    }
?>
<?php
    if ($free_shipping == true) {
?>
<div id="freeShip" class="margin_t" ><?php echo FREE_SHIPPING_TITLE; ?>&nbsp;<?php echo $quotes[$i]['icon']; ?></div>
<div id="defaultSelected"><?php echo sprintf(FREE_SHIPPING_DESCRIPTION, $currencies->format(MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER)) . zen_draw_hidden_field('shipping', 'free_free'); ?></div>
<?php
    } else {
      $radio_buttons = 0;
      for ($i=0, $n=sizeof($quotes); $i<$n; $i++) {

      if ($quotes[$i]['module'] != '') { // Standard
?>

<ul>
<?php
  if (isset($quotes[$i]['error'])) {
?>
    <div><?php echo $quotes[$i]['error']; ?></div>
<?php
  } else {
     for ($j=0, $n2=sizeof($quotes[$i]['methods']); $j<$n2; $j++) {
// set the radio button to be checked if it is the method chosen
     $checked = (($quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id'] == $_SESSION['shipping']['id']) ? true : false);
?>
<?php echo zen_draw_radio_field('shipping', $quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id'], $checked, 'id="ship-'.$quotes[$i]['id'] . '-' . $quotes[$i]['methods'][$j]['id'].'" onclick="priceCalculate();" rule="shipping" price="'.$quotes[$i]['methods'][$j]['cost'].'"'); ?>
<label for="ship-<?php echo $quotes[$i]['id'] . '-' . $quotes[$i]['methods'][$j]['id']; ?>" class="checkboxLabel" >
<strong class="black"><?php echo $quotes[$i]['module']; ?></strong>&nbsp;
<span class="black">......................................................................................................</span>
<span class="black">
<?php
  if ( ($n > 1) || ($n2 > 1) ) {
    echo $currencies->format(zen_add_tax($quotes[$i]['methods'][$j]['cost'], (isset($quotes[$i]['tax']) ? $quotes[$i]['tax'] : 0))); 
  } else {
    echo $currencies->format(zen_add_tax($quotes[$i]['methods'][$j]['cost'], $quotes[$i]['tax'])) . zen_draw_hidden_field('shipping', $quotes[$i]['id'] . '_' . $quotes[$i]['methods'][$j]['id']); 
  } 
  ?>
</span>
</label>
<ul class="pad_l_28px"><?php print_r($quotes[$i]['description']); ?></ul>
<?php
        $radio_buttons++;
      }
    }
?>
</ul>
<?php
    }
// eof: field set
  }
  }
?>
 
 
</div>
<div id="Shipping_Methods_content" style="display: none;" class="pad_l_28px big_ margin_t"> 
    <ul class="clear">    
      <li style="width: 106px;" class="fl"><span class="b black">Processing Time = </span></li><li class="fl">From the time we received your order to the time we start to packaging your order. One or two days to <br/>get your order looked at, your payment confirmed, and to make sure the shipping address is correct.<br/>
        <span class="b black">Minimum time: 1-2 business days.</span><br/>
      We do not process your order on Sunday or holidays. Allow an additional 1 to 2 business days for weekend orders.
      </li>
  </ul>
     <ul class="clear">
        <li style="width: 106px;" class="fl g_t_r"><span class="b black">Packaging Time = </span></li>
        <li class="fl">After your order is processed, we send it to the warehouse. If the product is still in stock, it will be shipped in a<br/> day or two. You will be notified if your order are not in stock.
        <span class="b black">Minimum time: 1-2 business days</span>
      </li>
     </ul>
       <ul class="clear">
        <li style="width: 106px;" class="fl g_t_r"><span class="b black">Shipping Time = </span></li>
        <li class="fl">The time it takes for the shipping company to drive or fly your package to you.<br/>
        <span class="b black">Standard Shipping:</span> Most shipped packages are delivered within 5-7 business days from the day they are shipped.<br/>
        <span class="b black">Expedited Shipping:</span> Most shipped package are delivered within 2-4 business days from the day they are shipped.
      </li>
     </ul>
       <ul class="border_b pad_bottom">
   
    </ul>
</div>
<?php
  } else {
?>
<h2><?php echo TITLE_NO_SHIPPING_AVAILABLE; ?></h2>
<div class="important"><?php echo TEXT_NO_SHIPPING_AVAILABLE; ?></div>
<?php
  }
?> 

<?php 
/* 
 * Up shipping
 * merger shipping & payment
 * Down payment
 */ ?>

<?php
  if (DISPLAY_CONDITIONS_ON_CHECKOUT == 'true') {
?>
<fieldset>
<legend><b><?php echo TABLE_HEADING_CONDITIONS; ?></b></legend>
<div><?php echo TEXT_CONDITIONS_DESCRIPTION;?></div>
<?php echo  zen_draw_checkbox_field('conditions', '1', false, 'id="conditions"');?>
<label class="checkboxLabel" for="conditions"><?php echo TEXT_CONDITIONS_CONFIRM; ?></label>
</fieldset>
<?php
  }
?>



<div>
<?php // ** BEGIN PAYPAL EXPRESS CHECKOUT **
      if (!$payment_modules->in_special_checkout()) {
      // ** END PAYPAL EXPRESS CHECKOUT ** ?>
<h4 class="dark_bg margin_t bg_cart red"><div class="check_order_w"><?php echo TABLE_HEADING_PAYMENT_METHOD; ?></div></h4>
<div class="pad_l_28px big_ margin_t">
<?php
  if (SHOW_ACCEPTED_CREDIT_CARDS != '0') {
?>

<?php
    if (SHOW_ACCEPTED_CREDIT_CARDS == '1') {
      echo TEXT_ACCEPTED_CREDIT_CARDS . zen_get_cc_enabled();
    }
    if (SHOW_ACCEPTED_CREDIT_CARDS == '2') {
      echo TEXT_ACCEPTED_CREDIT_CARDS . zen_get_cc_enabled('IMAGE_');
    }
?>

<?php } ?>

<?php
  foreach($payment_modules->modules as $pm_code => $pm) {
    if(substr($pm, 0, strrpos($pm, '.')) == 'googlecheckout') {
      unset($payment_modules->modules[$pm_code]);
    }
  }
  $selection = $payment_modules->selection();
  if (sizeof($selection) > 1) {
  ?>
	<p class="important"><?php echo TEXT_SELECT_PAYMENT_METHOD; ?></p>
	<?php
  } elseif (sizeof($selection) == 0) {
  ?>
	<p class="important"><?php echo Free_of_charge; ?></p>

<?php
  }
?>

<?php
  $radio_buttons = 0;
  $n=sizeof($selection);
  for ($i=0; $i<$n; $i++) {
  	echo '<li class="margin_t">';
    if (sizeof($selection) > 1) {
      if (empty($selection[$i]['noradio'])) {
        echo zen_draw_radio_field('payment', $selection[$i]['id'], ($selection[$i]['id'] == $_SESSION['payment'] ? true : false), 'id="'.$selection[$i]['id'].'"  onclick="showExplain(this)"');
			}
    } else {
      echo zen_draw_hidden_field('payment', $selection[$i]['id']);
    }
?>
		<label for="<?php echo $selection[$i]['id']; ?>" ><?php echo $selection[$i]['module']; ?></label>
		<div class="pad_l_28px">
      <span style="display: none;" name="spBox" id="spBox" class="allborder pad_10px">
        <ul>
          <?php echo $selection[$i]['info']; ?>
        </ul>
      </span>
    </div>
            
<?php
    if (defined('MODULE_ORDER_TOTAL_COD_STATUS') && MODULE_ORDER_TOTAL_COD_STATUS == 'true' and $selection[$i]['id'] == 'cod') {
?>
      <div class="alert"><?php echo TEXT_INFO_COD_FEES; ?></div>
<?php
    } else {
      // echo 'WRONG ' . $selection[$i]['id'];
?>
<?php
    }
?>

<?php
    if (isset($selection[$i]['error'])) {
?>
    <div><?php echo $selection[$i]['error']; ?></div>

<?php
    } elseif (isset($selection[$i]['fields']) && is_array($selection[$i]['fields'])) {
?>

<div class="ccinfo">
<?php
      for ($j=0, $n2=sizeof($selection[$i]['fields']); $j<$n2; $j++) {
?>
<ul class="margin_t">
<label <?php echo (isset($selection[$i]['fields'][$j]['tag']) ? 'for="'.$selection[$i]['fields'][$j]['tag'] . '" ' : ''); ?>><?php echo $selection[$i]['fields'][$j]['title']; ?></label><br/><?php echo $selection[$i]['fields'][$j]['field']; ?><br/>
</ul>
<?php
      }
?>
</div>
<?php
    }
    $radio_buttons++;
    echo '</li>';
  }
  unset($n);
?>




<?php
  //Discount Coupon -Start   删除在此页出现的优惠卷选项
 
  //Discount Coupon -END
?>





</div>
<h4 class="dark_bg margin_t bg_cart red"><div class="check_order_w">Order Review:</div></h4>
<div class="pad_l_28px margin_t big_">
<table border="0" width="100%" cellspacing="0" cellpadding="0" class="check_tb black">
   <tr class="black">
	   <th scope="col" class="in_1em" width="80"><?php echo TABLE_HEADING_PRODUCTS; ?></th>
	   <th scope="col"></th>
	   <th scope="col" width="80"><?php echo TABLE_HEADING_QUANTITY; ?></th>
			<?php
			  // If there are tax groups, display the tax columns for price breakdown
			  if (sizeof($order->info['tax_groups']) > 1) {
			?>
			   <th scope="col"><?php echo HEADING_TAX; ?></th>
			<?php	}?>
	   <th scope="col" width="80"><?php echo TABLE_HEADING_TOTAL; ?></th>
   </tr>
<?php // now loop thru all products to display quantity and price ?>
<?php for ($i=0, $n=sizeof($order->products); $i<$n; $i++) { ?>
        <tr class="<?php echo $order->products[$i]['rowClass']; ?>">
          <td><?php echo zen_image(DIR_WS_IMAGES.$order->products[$i]['image'],$order->products[$i]['name'],85,85); ?></td>
          <td><?php echo $order->products[$i]['name']; ?>
          <?php  echo $stock_check[$i]; ?>

<?php // if there are attributes, loop thru them and display one per line
    if (isset($order->products[$i]['attributes']) && sizeof($order->products[$i]['attributes']) > 0 ) {
    echo '<ul class="cartAttribsList">';
      for ($j=0, $n2=sizeof($order->products[$i]['attributes']); $j<$n2; $j++) {
?>
      <li class="blue clear"><?php echo $order->products[$i]['attributes'][$j]['option'] . ': ' . nl2br(zen_output_string_protected($order->products[$i]['attributes'][$j]['value'])); ?></li>
<?php
      } // end loop
      echo '</ul>';
    } // endif attribute-info
?>
        </td>
        <td class="b"><?php echo $order->products[$i]['qty']; ?></td>

<?php // display tax info if exists ?>
<?php if (sizeof($order->info['tax_groups']) > 1)  { ?>
        <td class="cartTotalDisplay">
          <?php echo zen_display_tax_value($order->products[$i]['tax']); ?>%</td>
<?php    }  // endif tax info display  ?>
        <td class="b">
          <?php echo $currencies->display_price($order->products[$i]['final_price'], $order->products[$i]['tax'], $order->products[$i]['qty']);
          if ($order->products[$i]['onetime_charges'] != 0 ) echo '<br /> ' . $currencies->display_price($order->products[$i]['onetime_charges'], $order->products[$i]['tax'], 1);
?>
        </td>
      </tr>
<?php  }  // end for loopthru all products ?>
</table>
<div class="editCart">To edit your cart, <a href="<?php echo zen_href_link(FILENAME_SHOPPING_CART,'','SSL') ?>" class="u">click here.</a></div>
</div>
<?php // ** BEGIN PAYPAL EXPRESS CHECKOUT **
      } else {
        ?><input type="hidden" name="payment" value="<?php echo $_SESSION['payment']; ?>" /><?php
      }
      // ** END PAYPAL EXPRESS CHECKOUT ** ?>

 <!--  这里删除 订单说明 ORDER COMMENTS 输入框-->
  
  
  <ul class="g_t_r" style="width:660px;">
  <?php
  if (MODULE_ORDER_TOTAL_INSTALLED) {
    $order_totals = $order_total_modules->process();
    echo '<table class="big black" width="500" align="right">';
    //echo $order_total_modules->output(true);
    echo '<tr><td class="g_t_r" colspan="2"><div class="g_t_c" style="margin-left: 320px;">';
  
 //-------下面是需要被 更的换按钮
 
 // echo zen_draw_hidden_field('place_order','place_order');
//    echo '<input type="image" id="btn_place" class="place" title=" Place your Order" alt="Place your Order" src="'.$template->get_template_dir('btn_place.gif', DIR_WS_TEMPLATE, $current_page_base,'images'). '/btn_place.gif" />';
 //   echo '</div></td></tr>';
	
 echo zen_draw_hidden_field('place_order','place_order');
  echo '<input type="image" id="btn_place" class="place" title=" Place your Order" alt="Place your Order" src="'.$template->get_template_dir('btn_place.gif', DIR_WS_TEMPLATE, $current_page_base,'images'). '/btn_place.gif" />';
  echo '</div></td></tr>';
	
	
 // 一下为新设置的 订单确认按钮
 
 
	
	
    echo '<tr><td class="g_t_r big_ gray" colspan="2">Every order you place with us is safe & secure.</td></tr>';
    echo '</table>';
  }
?>
  <br class="clear"/>
  </ul>
</div>


<div class="clear"></div>
</div>
<?php echo '</form>'; ?>
</div>
</div>





