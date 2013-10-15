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
var min_quantity = <?php echo zen_get_products_quantity_order_min($_GET['products_id']);?>;

var discount = new Array();
<?php $jsPrice = $currencies->noSymbolDisplayPrice((zen_get_products_base_price($_GET['products_id']) == 0 ? zen_get_products_sample_price($_GET['products_id']) : zen_get_products_base_price($_GET['products_id'])),zen_get_tax_rate($_GET['products_id'])) ?>
discount[0] ="<?php echo zen_get_products_quantity_order_min($_GET['products_id']);?>-<?php echo $jsPrice; ?>-<?php echo zen_get_product_is_always_free_shipping((int)$_GET['products_id'])?1:0;?>-0";
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

function in_array(needle, haystack){
    var type = typeof needle;
    if(type == 'string' || type =='number'){
        for(var i in haystack){
            if(haystack[i] == needle){
                return true;
              }
        }
    }
    return false;
}
function is_array(array){
   if(typeof array == 'object' && typeof array.sort == 'function' && typeof array.length == 'number'){
      return true;
   }else{
      return false;
   }
}
function changePrice(){
  var qty = $('cart_quantity').value;
  var tmp ;
  for(var i=discount.length-1;i>=0;i--){
    tmp = discount[i].split("-");
    if(qty >= parseInt(tmp[0])){
      $('products_price_unit').innerHTML= formatC(tmp[1], false);
      $('products_price_all').innerHTML= '&nbsp;' + formatC(parseInt(qty)*parseFloat(tmp[1])) + ' ';
      if(parseInt(tmp[2]) > 0){
        $('shipping_rule').innerHTML = ("+ " + formatC(parseFloat(tmp[3])) + " Free Shipping ");
      }
      else{
        $('shipping_rule').innerHTML = ("+ Shipping Cost");
      }
      break;
    }else{
      $('products_price_unit').innerHTML= formatC(tmp[1], false);
    }
  }
}
function changeShippingCost(){
  var standardArray = new Array();
  var expeditedArray = new Array();
  var standardSkipArray = new Array();
  var expeditedSkipArray = new Array();
  var tmpa;
  var tmpb;
  var country_ida;
  var country_idb;
  var tmpCosta;
  var tmpCostb;
  var costa;
  var costb;
  var weight = <?php echo zen_get_products_weight($_GET['products_id']); ?>;
	var productsprice = <?php echo $jsPrice; ?>;
  var standardSkip = '<?php echo $standardSkipStr; ?>';
  var standard = '<?php echo $standard; ?>';
  var expeditedSkip = '<?php echo $expeditedSkipStr; ?>';
	var expedited = '<?php echo $expedited; ?>';
  var country = $('country_id').value;
  var qty = $('shippingCostQty').value;
	var units = ' kg';
	var maxweight =<?php echo SHIPPING_MAX_WEIGHT;?>;
	
  standardSkipArray = standardSkip.split(',');
	expeditedSkipArray = expeditedSkip.split(',');

  standardArray = standard.split('-');
  expeditedArray = expedited.split('-');
	
	$('weight').innerHTML = parseInt(qty)*parseFloat(weight)+units;
  
	
	
	if(qty == '' || qty == 0 || country == '-1' ||  maxweight <= parseInt(qty)*parseFloat(weight)){
		if(maxweight <= parseInt(qty)*parseFloat(weight)){
			alert('Has exceeded the weight limit, please re-enter');
			return false;
		}else{
			alert('Please Input Qty. Or Select Country');
			return false;
		}
  }else{
		if(in_array(country,standardSkipArray) || country == standardSkipArray){
			 $('standard').innerHTML = 'sorry,The countries do not provide transportation';
		}else{
			/* Standard Shipping Cost - Start */
			Outer:
				for(var i=0;i<3;i++){
					tmpa = standardArray[i].split('|');
					country_ida = tmpa[0].split(',');
					if(in_array(country,country_ida)){
						tmpCosta = tmpa[1].split(',');
					Inner:
						for(var i=0,n=tmpCosta.length; i < n; i++){
							costa = tmpCosta[i].split(':');
							if(parseInt(qty)*parseFloat(weight) <= parseFloat(costa[0])){
								if(costa[1].indexOf('%') == -1){
									$('standard').innerHTML = formatC(parseFloat(costa[1]));
								}else{
									
									$('standard').innerHTML = formatC((parseFloat(costa[1])/100) * parseFloat(productsprice));
								}
								break Inner;
							}
						}
					break Outer;
				}//end if
					
				if (in_array('00',country_ida)) {
					 tmpCosta = tmpa[1].split(',');
				InnerTwo:
					 for(var i=0,n=tmpCosta.length; i < n; i++){
						 costa = tmpCosta[i].split(':');
						 if(parseInt(qty)*parseFloat(weight)  <= parseFloat(costa[0])){
							 if(costa[1].indexOf('%') == -1){
									$('standard').innerHTML = formatC(parseFloat(costa[1]));
							 }else{
									$('standard').innerHTML = formatC((parseFloat(costa[1])/100) * parseFloat(productsprice));
							 }
						 break InnerTwo;
						 }
					 }
					break Outer;
				}//end if
				}/* Standard Shipping Cost - End */
		}
	
		if(in_array(country,expeditedSkipArray) || country == expeditedSkipArray){
			$('express').innerHTML = 'sorry,The countries do not provide transportation';
		}else{
			/* Express Shipping Cost - Start */
			OuterTwo:  
				for(var i=0;i<3;i++){
					tmpb = expeditedArray[i].split('|');
					country_idb = tmpb[0].split(',');
					if(in_array(country,country_idb)){
						tmpCostb = tmpb[1].split(',');
					InnerThree:
						for(var i=0,n=tmpCostb.length; i < n; i++){
							costb = tmpCostb[i].split(':');
							if(parseInt(qty)*parseFloat(weight)  <= parseFloat(costb[0])){
								if(costb[1].indexOf('%') == -1){
									$('express').innerHTML = formatC(parseFloat(costb[1]));
								}else{
									$('express').innerHTML = formatC((parseFloat(costb[1])/100) * parseFloat(productsprice));
								}
							break InnerThree;
							}
						}
						break OuterTwo;
					}//end if
					
					if (in_array('00',country_idb)) {
					 tmpCostb = tmpb[1].split(',');
					InnerFour:
					 for(var i=0,n=tmpCostb.length; i < n; i++){
						 costb = tmpCostb[i].split(':');
						 if(parseInt(qty) * parseFloat(weight) <= parseFloat(costb[0])){
							 if(costb[1].indexOf('%') == -1){
								 $('express').innerHTML = formatC(parseFloat(costb[1]));
							 }else{
								 $('express').innerHTML = formatC((parseFloat(costb[1])/100) * parseFloat(productsprice));
							 }
						 break InnerFour;
						 }
					 }
					break OuterTwo;
				}//end if
				}/* Express Shipping Cost - End */
		}
  }
}


var shipping_info='<h2 class="blue">Payment methods available in <?php echo addcslashes(STORE_NAME,'\''); ?>:</h2><dl class="dl_dot pad_10px">We make paying for your orders easy by providing a range of convenient payment options: <dt>PayPal</dt><!--del google checkout<dt>Google Checkout</dt>--><dt>Western Union</dt><dt>Wire Transfer</dt> For more information on everything you need to know about paying for your order at wedding-dresses-sydney.com.au, check out our How To Pay help section.</dl>';

var payment_option='<h2 class="blue">Shipping Methods:</h2> <div class="margin_t red">When you place an order, you<BR/>are emailed a confirmation of your order. <BR/>Once your order is shipped, you\'ll receive an email with the tracking information for your order\'s shipment. You can choose whichever method suits you best when you place an order. We offers two shipping methods:</div><dl class="dl_dot pad_10px"><dt>Standard shipping: Normally takes 7 to 10 days.</dt><dt>Express Shipping: Normally takes 2 to 4 days</dt></dl><div>Time of transit varies depending on where you\'re located and where your package is coming from.</div>';

</script>
<style type="text/css">
.png {
behavior: url(<?php echo HTTP_SERVER.DIR_WS_CATALOG.DIR_WS_TEMPLATES.$template_dir.'/css/';
?>iepngfix.htc)
}
</style>
