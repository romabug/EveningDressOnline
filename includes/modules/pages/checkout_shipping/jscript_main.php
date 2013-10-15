<?php
	
?>
<script language="javascript" type="text/javascript"><!--
var subTotal =<?php echo $showTotal;?>;
var shippingPrice = 0;
var coupon = 0;
var discount_group_price = <?php echo $groupPricing;?>;
var promo_discount = 0;
var symbolLeft='<?php echo $currencies->display_symbol_left($_SESSION['currency']);?>';
var symbolRight='';
var insurancePrice=<?php echo '1.99';?>;
var discount_Price = 0;
var ot_categories_discount_price = 0;
var total = 0.00;

function formatC(s){
	s = s + '';
    if(/[^0-9\.]/.test(s)) return "invalid value";
	s=s.replace(/^(\d*)$/,"$1.");
	s=(s+"00").replace(/(\d*\.\d\d)\d*/,"$1");
	s=s.replace(".",",");
	var re=/(\d)(\d{3},)/;
	while(re.test(s)) s=s.replace(re,"$1,$2");
	s=s.replace(/,(\d\d)$/,".$1");
	return symbolLeft + ' ' +s.replace(/^\./,"0.") + symbolRight;
}


function showExplain(obj){
  var arr = document.getElementsByName("spBox");
  for(i=0;i<arr.length;i++){
    arr[i].style.display='none';
  }
  if(obj.checked){
    obj.parentNode.getElementsByTagName("span")[0].style.display='block';
  }
  else{
    hide(obj.parentNode.getElementsByTagName("span")[0]);
  }
  priceCalculate();
}
function priceCalculate(){
  
  var shipping = document.getElementsByName("shipping");
  var payment = document.getElementsByName("payment");
  var insurance = $("insurance_checked");
  var shippingPrice,shippingPrice,rule,price;
  if(shipping.length==0) shippingPrice = 0;
  if(payment.length ==0) paymentPrice = 0;
  
  if(shipping.length==1){
    var coun = document.getElementById("coun0");
    if(coun != null){
      coun.style.display='block';
    }
  }else if(shipping.length==2){
    
    if(shipping[0].getAttribute("type")!='hidden'){
      
    
      if(shipping[0].checked){
        var coun = document.getElementById("coun0");
        if(coun != null){
          coun.style.display='block';
        }
        var coun1 = document.getElementById("coun1");
        if(coun1 != null){
          coun1.style.display='none';
        }
        
      }else{
        
        var coun = document.getElementById("coun0");
        if(coun != null){
          coun.style.display='none';
        }
        var coun1 = document.getElementById("coun1");
        if(coun1 != null){
          coun1.style.display='block';
        }
      }
    }
  }else if(shipping.length==3){
    if(shipping[0].checked){
        var coun = document.getElementById("coun0");
        if(coun != null){
          coun.style.display='block';
        }
        var coun1 = document.getElementById("coun1");
        if(coun1 != null){
          coun1.style.display='none';
        }
        
        
    }else if(shipping[1].checked){
        
        var coun = document.getElementById("coun0");
        if(coun != null){
          coun.style.display='none';
        }
        var coun1 = document.getElementById("coun1");
        if(coun1 != null){
          coun1.style.display='block';
        }
    }else{
        var coun = document.getElementById("coun0");
        if(coun != null){
          coun.style.display='none';
        }
        var coun1 = document.getElementById("coun1");
        if(coun1 != null){
          coun1.style.display='none';
        }
    }
  }
  
  for(i=0;i<shipping.length;i++){
    
    if(shipping[i].checked){
      
      
      if(shipping[i].value=="airmail_airmail" || shipping[i].value=="hkpost_hkpost"){
        insurance.checked= false;
        hide("add_insurance");
      }else{
        show("add_insurance");
      }
      rule = shipping[i].getAttribute("rule");
          price = shipping[i].getAttribute("price");
          calculate(rule, price);
      break;
    } 
  }
  for(i=0;i<payment.length;i++){
    if(payment[i].checked){
      rule = payment[i].getAttribute("rule");
          price = payment[i].getAttribute("price");
          calculate(rule, price);
      break;
    }
  }
  if(insurance.checked){
    rule = insurance.getAttribute("rule");
        price = insurance.getAttribute("price");
        calculate(rule, price);
  }
  else{
    rule = insurance.getAttribute("rule");
        calculate(rule, 0);
  }
  
  showPrice();
}
function calculate(rule, price){
  switch(rule){
    case "sale":
                discount_Price = (parseFloat(subTotal)-parseFloat(coupon)-parseFloat(discount_group_price)-parseFloat(promo_discount)) * (parseFloat(price)/100);
                break;
    case "sale_p": if(price=="" || price==0) {break;} else{ discount_Price = parseFloat(price); break;}
    
    case "shipping":
                shippingPrice = price;
                break;
    case "insurance":    
                insurancePrice = price;
                break;
  }
}

function showPrice(){
  total = parseFloat(subTotal) + parseFloat(shippingPrice) - parseFloat(discount_Price) - parseFloat(coupon)-parseFloat(discount_group_price)-parseFloat(promo_discount) + parseFloat(insurancePrice);
  showOnePrice("discount_Price",discount_Price,"- ");
  showOnePrice("coupon_Price",coupon,"- "); 
  showOnePrice("promo_discount",promo_discount,"- ");
  showOnePrice("ot-group-pricing",discount_group_price,"- ");
  showOnePrice("Total_Saving",(parseFloat(discount_Price) + parseFloat(coupon)+parseFloat(discount_group_price)+parseFloat(promo_discount)),"- ");
  showOnePrice("ot-shipping",shippingPrice,"");  
  showOnePrice("ot_insurance",insurancePrice,"");
  showOnePrice("ot-total",total,"");
}

function showOnePrice(obj,_price,sp){
  var o1 = $(obj);
  if(_price <= 0){
    if(o1 != null && o1.parentNode != null ){
      hide(o1.parentNode);
    }
  }
  else{
    if(o1 != null && o1.parentNode != null ){
      show(o1.parentNode);
      o1.innerHTML= sp + formatC(_price);
    }
  } 
}

function removeCoupon(frm){
  if(confirm('Are you sure deleting this coupon?')){
    var ipt=document.createElement("INPUT"); 
    ipt.type="hidden";
    ipt.id="dc_redeem_code";
    ipt.name="dc_redeem_code";
    ipt.value="REMOVE";
    frm.appendChild(ipt); 
    frm.submit();
  }
}

function init(){
  var shipping = document.getElementsByName("shipping");
  if(shipping == null || shipping.length == 0){
    show('no_shipping');    
    hide('insurance_lab');
    $('btn_place').disabled = true;
    $('btn_place').src = '<?php echo $template->get_template_dir('btn_place_gray.gif', DIR_WS_TEMPLATE, $current_page_base,'images'). '/btn_place_gray.gif';?>';
  }
  else{
    shipping[0].checked = true;
  } 
    priceCalculate();
}
function check(fm){
  if(fm.display_coupon.checked == true){
    if(fm.dc_redeem_code.value.trim() == ''){
      alert("Coupon code information is required");
      return false;
    }
  }
  return true;
  
}
//--></script>