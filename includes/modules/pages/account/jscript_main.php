<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |   
// | http://www.zen-cart.com/index.php                                    |   
// |                                                                      |   
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
// $Id: jscript_main.php 1105 2005-04-04 22:05:35Z birdbrain $
//
?>
<script language="javascript"  type="text/javascript"><!--
function rowOverEffect(object) {
  if (object.className == 'moduleRow') object.className = 'moduleRowOver';
}

function rowOutEffect(object) {
  if (object.className == 'moduleRowOver') object.className = 'moduleRow';
}
//--></script> 
<script language="javascript"  type="text/javascript"><!--
function openCheckWindow(id, carrier)
{
  switch(carrier)
  {
    case 'EMS':window.open("http://www.ems.com.cn/qcgzOutQueryAction.do?reqCode=gotoSearchE");break;
    case 'DHL':window.open("http://track.dhl-usa.com/TrackByNbr.asp?ShipmentNumber="+id);break;
    case 'UPS':window.open("http://www.ups.com/WebTracking/track?loc=en_US&WT.svl=PNRO_L1");break;
  }
  return false;
}
function check_search_orders(frm){
  var re=/\d/ig;
  if(re.test($('order_id').value)){
    return true;
  }
  else{
    alert('Your order code is invalid!');
    $('order_id').focus();
    return false;
  }
}
function check_papay(){
  return confirm('The order status shall be updated from pending to apropos status in 48 hours after you placed and paid your order. If you pay again for this order via the button below, it will be updated to a new order. are you continue?');
}
//--></script> 
