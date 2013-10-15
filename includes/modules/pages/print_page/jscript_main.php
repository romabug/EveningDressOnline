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
// $Id: jscript_main.php 5444 2006-12-29 06:45:56Z drbyte $
//
?>
<script language="javascript" type="text/javascript"><!--
function popupWindow(url) {
  window.open(url,'popupWindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=no,resizable=yes,copyhistory=no,width=100,height=100,screenX=150,screenY=150,top=150,left=150')
}
function popupWindowPrice(url) {
  window.open(url,'popupWindow','toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=600,height=400,screenX=150,screenY=150,top=150,left=150')
}
//--></script>
<script>
var FRIENDLY_URLS='true';
var symbolLeft='<?php echo $currencies->display_symbol_left($_SESSION['currency']);?>';
var symbolRight='';
var min_quantity=<?php echo zen_get_products_quantity_order_min($_GET['products_id']);?>;
var discount = new Array();
discount[0] ="<?php echo zen_get_products_quantity_order_min($_GET['products_id']);?>-<?php echo number_format((zen_get_products_base_price($_GET['products_id']) == 0 ? zen_get_products_sample_price($_GET['products_id']) : zen_get_products_base_price($_GET['products_id'])),2); ?>-0-0";
function formatC(s, flag){
if(flag == null){
flag =true;
 }
 s = s + '';
 if(/[^0-9\.]/.test(s)) return "invalid value";
 s=s.replace(/^(\d*)$/,"$1.");
 s=(s+"00").replace(/(\d*\.\d\d)\d*/,"$1");
 s=s.replace(".",",");
 var re=/(\d)(\d{3},)/;
 while(re.test(s)) s=s.replace(re,"$1,$2");
 s=s.replace(/,(\d\d)$/,".$1");
 if(flag){
 return symbolLeft + ' ' +s.replace(/^\./,"0.") + symbolRight;
 }
 else{
 return s.replace(/^\./,"0.") + symbolRight;
 }
 return symbolLeft + ' ' +s.replace(/^\./,"0.") + symbolRight;
}
function check_product(frm){
	if($('cart_quantity').value < min_quantity){		
		alert('The Quantity you submitted is invalid.');
		return false;
	}
	return true;
}

function changePrice(){
	var qty = $('cart_quantity').value;
	var tmp ;
	for(var i=discount.length-1;i>=0;i--){
		tmp = discount[i].split("-");
		if(qty >= parseInt(tmp[0])){
			$('products_price_unit').innerHTML= formatC(tmp[1], false);
			$('products_price_all').innerHTML= '&nbsp;' + formatC(parseInt(qty)*parseFloat(tmp[1])) + ' ';
			break;
		}
	}
}


var shipping_info='<h2 class="blue">Payment methods available in wedding-dresses-sydney.com.au:</h2><dl class="dl_dot pad_10px"><dt>PayPal</dt><!--del google checkout<dt>Google Checkout</dt>--><dt>Western Union</dt><dt>Wire Transfer</dt></dl><div>Time of transit varies depending on where you\'re <BR/>located and where your package is coming from.</div>';

var payment_option='<h2 class="blue">Shipping Methods:</h2><div class="margin_t red">When you place an order with wedding-dresses-sydney.com.au, you<BR/>are emailed a confirmation of your order. <BR/>Once your order is shipped, you\'ll receive an email with the tracking information for your order\'s shipment. You can choose whichever method suits you best when you place an order. wedding-dresses-sydney.com.au offers two shipping methods:</div><dl class="dl_dot pad_10px"><dt>Standard shipping: Normally takes 7 to 10 days.</dt><dt>Express Shipping: Normally takes 2 to 4 days</dt></dl> <div  >Time of transit varies depending on where you\'re located and where your package is coming from.</div>';
 
</script>
<style type="text/css">
.png { behavior: url(<?php echo HTTP_SERVER.DIR_WS_CATALOG.DIR_WS_TEMPLATES.$template_dir.'/css/';?>iepngfix.htc) }
</style>