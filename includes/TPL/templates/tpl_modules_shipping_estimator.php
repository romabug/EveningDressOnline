<?php
/**
 * Module Template - for shipping-estimator display
 *
 * @package templateSystem
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_modules_shipping_estimator.php 5853 2007-02-20 05:49:48Z drbyte $
 */
?>
<div id="shippingEstimator" class="pad_10px">
<?php echo zen_draw_form('estimator', zen_href_link($show_in, '', 'NONSSL'), 'post','target="_self"'); ?>
<?php echo zen_draw_hidden_field('scid', $selected_shipping['id']); ?>
<?php
  if($_SESSION['cart']->count_contents()) {
    if ($_SESSION['customer_id']) {
?>
<?php if (!empty($totalsDisplay)) { ?>
<div><?php echo $totalsDisplay; ?></div>
<?php } ?>

<?php
    // only display addresses if more than 1
      if ($addresses->RecordCount() > 1){
?>
<label class="pad_r_5px" for="seAddressPulldown"><strong><?php echo CART_SHIPPING_METHOD_ADDRESS; ?></strong></label>
<?php echo zen_draw_pull_down_menu('address_id', $addresses_array, $selected_address, 'onchange="return shipincart_submit();" name="seAddressPulldown"'); ?>
<?php
      }
?>
<div class="pad_r_5px fl" id="seShipTo"><strong><?php echo CART_SHIPPING_METHOD_TO; ?></strong></div>
<ul class="fl"><?php echo zen_address_format($order->delivery['format_id'], $order->delivery, 1, ' ', '<br />'); ?></ul>
<br class="clear" />
<?php
    } else {
?>
<?php if (!empty($totalsDisplay)) { ?>
<div><?php echo $totalsDisplay; ?></div>
<?php } ?>
<?php
      if($_SESSION['cart']->get_content_type() != 'virtual'){
?>
<br/>
<div><?php echo ESTIMATOR_SHIPPING_TO; ?>
<?php echo zen_get_country_list('zone_country_id', $selected_country, 'id="country" onchange="return shipincart_submit();" class="select3"'); ?>
</div>
<?php
      }
    }
    if($_SESSION['cart']->get_content_type() == 'virtual'){
?>
<?php echo CART_SHIPPING_METHOD_FREE_TEXT .  ' ' . CART_SHIPPING_METHOD_ALL_DOWNLOADS; ?>
<?php
    }elseif ($free_shipping==1) {
?>
<?php echo sprintf(FREE_SHIPPING_DESCRIPTION, $currencies->format(MODULE_ORDER_TOTAL_SHIPPING_FREE_SHIPPING_OVER)); ?>
<?php
    }else{
?>
<table width="490"  cellpadding="0" cellspacing ="0" class="allborder in_1em margin_t">
     <tr>
       <th scope="col" class="gray_bg" align="left"><?php echo CART_SHIPPING_METHOD_TEXT; ?></th>
       <th scope="col" class="gray_bg" align="left"><?php echo CART_SHIPPING_METHOD_RATES; ?></th>
       <th scope="col" class="gray_bg" align="left"><?php echo CART_SHIPPING_METHOD_TOTAL_COST; ?></th>
     </tr>
<?php
      $estimatorNum=sizeof($quotes);
      for ($i=0;$i<$estimatorNum; $i++) {
        if(sizeof($quotes[$i]['methods'])==1){
          // simple shipping method
          $thisquoteid = $quotes[$i]['id'].'_'.$quotes[$i]['methods'][0]['id'];
?>
     <tr class="<?php echo $extra; ?>">
<?php
          if($quotes[$i]['error']){
?>
         <td colspan="2"><?php echo $quotes[$i]['module']; ?>&nbsp;(<?php echo $quotes[$i]['error']; ?>)</td>
       </tr>
<?php
          }else{
            if($selected_shipping['id'] == $thisquoteid){
?>
         <td class="border_b"><?php echo $quotes[$i]['module']; ?>&nbsp;<?php //echo $quotes[$i]['methods'][0]['title']; ?></td>
         <td class="border_b"><?php echo $currencies->format(zen_add_tax($quotes[$i]['methods'][0]['cost'], $quotes[$i]['tax'])); ?></td>
         <td class="border_b"><?php echo $currencies->format($_SESSION['cart']->show_total()+zen_add_tax($quotes[$i]['methods'][0]['cost'], $quotes[$i]['tax'])); ?></td>
       </tr>
<?php
            }else{
?>
          <td class="border_b"><?php echo $quotes[$i]['module']; ?>&nbsp;<?php //echo $quotes[$i]['methods'][0]['title']; ?></td>
          <td class="border_b"><?php echo $currencies->format(zen_add_tax($quotes[$i]['methods'][0]['cost'], $quotes[$i]['tax'])); ?></td>
          <td class="border_b"><?php echo $currencies->format($_SESSION['cart']->show_total()+zen_add_tax($quotes[$i]['methods'][0]['cost'], $quotes[$i]['tax'])); ?></td>
       </tr>
<?php
            }
          }
        } else {
          // shipping method with sub methods (multipickup)
          for ($j=0, $n2=sizeof($quotes[$i]['methods']); $j<$n2; $j++) {
            $thisquoteid = $quotes[$i]['id'].'_'.$quotes[$i]['methods'][$j]['id'];
?>
    <tr class="<?php echo $extra; ?>">
<?php
            if($quotes[$i]['error']){
?>
         <td colspan="2" class="border_b"><?php echo $quotes[$i]['module']; ?>&nbsp;(<?php echo $quotes[$i]['error']; ?>)</td>
       </tr>
<?php
            }else{
              if($selected_shipping['id'] == $thisquoteid){
?>
         <td class="border_b"><?php echo $quotes[$i]['module']; ?>&nbsp;(<?php echo $quotes[$i]['methods'][$j]['title']; ?>)</td>
         <td class="border_b"><?php echo $currencies->format(zen_add_tax($quotes[$i]['methods'][$j]['cost'], $quotes[$i]['tax'])); ?></td>
       </tr>
<?php
              }else{
?>
        <td><?php echo $quotes[$i]['module']; ?>&nbsp;<?php //echo $quotes[$i]['methods'][$j]['title']; ?></td>
        <td class="border_b"><?php echo $currencies->format(zen_add_tax($quotes[$i]['methods'][$j]['cost'], $quotes[$i]['tax'])); ?></td>
      </tr>
<?php
              }
            }
          }
        }
      }
?>
</table>
<?php
   }
  }
?>
</form>
</div>