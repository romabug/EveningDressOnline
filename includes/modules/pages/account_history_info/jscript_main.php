<?php
/**
 * jscript_main
 *
 * @package page
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: jscript_main.php 4942 2006-11-17 06:21:37Z ajeh $
 */
?>
<script language="javascript" type="text/javascript"><!--

function couponpopupWindow(url) {
  window.open(url,'couponpopupWindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=450,height=320,screenX=150,screenY=150,top=150,left=150')
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
