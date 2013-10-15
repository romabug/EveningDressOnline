<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=product_info.<br />
 * Displays details of a typical product
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_product_info_display.php 5369 2006-12-23 10:55:52Z drbyte $
 */
 require(DIR_WS_MODULES . '/debug_blocks/product_info_prices.php');
 // 出入METATAGS调用关键字
 
 
 
?>
<?php
// only display when more than 1
  if ($products_found_count > 1) {
?>
<style type="text/css">
<!--
.STYLE9 {
	color: #000000;
	font-weight: bold;
}
.STYLE10 {color: #FF0000}
.STYLE12 {font-weight: bold; font-size: 14px;}
.STYLE14 {color: #B1031E}
-->
</style>





<div class="fr"><a href="<?php echo zen_href_link(FILENAME_DEFAULT, 'cPath='. zen_get_products_category_id($_GET['products_id']));?>" / class="b_" title="<?php echo zen_get_category_name(zen_get_products_category_id($_GET['products_id']),$_SESSION['languages_id']);?>"> </a>&nbsp;<span id="recent_flash_smallPage" class="product_title">
  <?php //echo (PREV_NEXT_PRODUCT); ?>
  <?php //echo ($position+1 . "/" . $counter); ?>
  </span></div>
<?php
  }
?>
<?php if ($messageStack->size('product_info') > 0) echo $messageStack->output('product_info'); ?>
<!--bof Prev/Next top position -->
<?php if (PRODUCT_INFO_PREVIOUS_NEXT == 1 or PRODUCT_INFO_PREVIOUS_NEXT == 3) { ?>
<?php
/**
 * display the product previous/next helper
 */
 // require($template->get_template_dir('tpl_product_flash_page.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_product_flash_page.php');


 ?>
<?php } ?>



<!--eof Prev/Next top position-->
<br class="clear" />


 

<div class="margin_t allborder fl" style="padding: 2px 0px; width:950px;">



  <div class="fl for_gray_bg" style="width:950px;">
    <!--bof Main Product Image -->
    <?php
  if (zen_not_null($products_image)) {
  ?>
   
   <div style="float:left"><img src="/images/v/201202/13298892220.jpg"  /> </div>
   
    <?php
/**
 * display the main product image
 */
 //  require($template->get_template_dir('tpl_modules_main_product_image.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_main_product_image.php'); ?>
    <?php
  }
?>
    <!--eof Main Product Image-->
    <div id="product_info_con" class="fr">
          <!--bof Form start-->
      <?php echo zen_draw_form('cart_quantity_frm', zen_href_link(zen_get_info_page($_GET['products_id']), zen_get_all_get_params(array('action')) . 'action=add_product'), 'post', 'enctype="multipart/form-data"') . "\n"; ?>
      <!--eof Form start-->
      <?php echo zen_draw_hidden_field('products_id',$_GET['products_id']); ?>
      <div class="fl pad_product line_180">
        <!--bof Product Name-->
        <h1 style="font-size: 16px;"><?php echo $products_name; ?></h1>
        <!--eof Product Name-->
        <ul class="pad_10px">
           
	 
		  
		
		  
 
		  
		  
          <div class="hr_d"></div>
        <!--bof Product Price block -->
     
	 
<?php	/*    <li class="big margin_t"> Store Price: <del> 
		
          <?php   以下取消显示商店价格
		  
						// base price
						  if ($show_onetime_charges_description == 'true') {
						    $one_time = '<span >' . TEXT_ONETIME_CHARGE_SYMBOL . TEXT_ONETIME_CHARGE_DESCRIPTION . '</span><br />';
						  } else {
						    $one_time = '';
						  }
						  echo $one_time . ((zen_has_product_attributes_values((int)$_GET['products_id']) and $flag_show_product_info_starting_at == 1) ? TEXT_BASE_PRICE : '') . $currencies->display_price(zen_get_products_retail_price((int)$_GET['products_id']),zen_get_tax_rate($product_info->fields['products_tax_class_id']));
					 	  ?>
					 
           </del> </li>    */ ?>
		  
		  
		  
		  
        <h3 class="relative"> <span class="red"> </span> 
          <div id="t_p"><ul><li><a class="one u b_" href="javascript:void(0)"><!--[if IE 7]><!--></a><!--<![endif]--><!--[if lte IE 6]><table><tr><td><![endif]-->
            <!--[if lte IE 6]></td></tr></table></a><![endif]-->
          </li>
          </ul></div>
        </h3>
        <!--eof Product Price block -->
		
		<li style="margin-top:8px;"> </li>
	
		   <li><?php echo '<a href="javascript:popupWindow(\'' . zen_href_link(FILENAME_POPUP_ASK_A_QUESTION, 'products_id='.$_GET['products_id']) . '\')">'.zen_image($template->get_template_dir('ask.gif', DIR_WS_TEMPLATE, $current_page_base,'images/button'). '/' . 'ask.gif','Ask Questions About This Item','','',' class="relative"').'</a>';?> 
		   
 	 
	 
	 
		 
 
			 
          </li>
		   
 		    
		
		
           <!--bof free ship icon  -->
 
        <!--eof free ship icon  -->
        </ul>
        
        <!--bof Quantity Discounts table -->
				<?php
				  if ($products_discount_type != 0 || $categories_discount_type != 0) { ?>
				<?php
				/**
				 * display the products quantity discount
				 */
				 require($template->get_template_dir('tpl_modules_products_quantity_discounts.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_products_quantity_discounts.php'); ?>
				<?php
				  }
				?>
				<!--eof Quantity Discounts table -->
        <!--bof Attributes Module -->
				<?php
          if ($pr_attr->fields['total'] > 0) {
        ?>
        <?php
        /**
         * display the product atributes
         */
          require($template->get_template_dir('/tpl_modules_attributes.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_attributes.php'); ?>
        <?php
          }
        ?>
        <!--eof Attributes Module -->
        
      </div>
   
      <div class="minframe fr pad_top">
        <ul class="white_bg allborder pad_10px" id="product_price">
          <li><span id="products_price_all" class="red b big"><?php echo zen_get_products_display_final_price((int)$_GET['products_id']);?></span>&nbsp;<span id="shipping_rule">+ 
          Shipping Cost </span></li>
        </ul>
        <a name="show"></a>
        <ul class="g_t_c product_ul_h">
          <?php if ($products_quantity > 0){ ?>
          <strong>Quantity: </strong>
          <input type="text" name="cart_quantity" id="cart_quantity" value="<?php echo $products_quantity_order_min;?>" maxlength="6" style="width:30px"  onkeyup="value=value.replace(/[^\d]/g,'');changePrice();" onbeforepaste="clipboardData.setData('text',clipboardData.getData('text').replace(/[^\d]/g,''));changePrice();"/> <strong>Unit(s)</strong>
          <?php }else{ ?>
          <img border="0" src="includes/templates/<?php echo $template_dir; ?>/images/soldout.gif"/><br/>
          <?php } ?>
        </ul>
        <?php if ($products_quantity > 0){ ?>
        <ul id="selectArea" class="g_t_c product_ul_h relative"></ul>
        <ul class="g_t_c gray" id="tmp_tit"></ul>
				<script type="text/javascript">
				    function showTit(key){
				    (key==0)?$('tit_t').style.display = '':$('tit_t').style.display = 'none';
				  }
				  
				  function nrcr(){
				    this.ini = init;
				    this.arrSel = [];
				      this.checking = checkS;
				      this.strbuy = '<input type="submit" class="buttonAddCart" alt="Add to Cart" title="Add to Cart" />';     
				  }
				  var sel = new nrcr();
				  
				  function init(){
				    var selects = document.getElementsByTagName("SELECT");
				    for(i=0;i<selects.length;i++){
				      if (selects[i].id.substr(0,7) == 'attrib-')
				          this.arrSel.push(selects[i].id);
				    }
				    var len = this.arrSel.length;
				    if(len>0){
				      $('tmp_tit').innerHTML = ' ';
				       for(j=0;j<len;j++){
				          $(this.arrSel[j]).onchange = this.checking;
				      }
				      }
				  }
				  
				  function checkS() {
				    var str = sel.strbuy;
				    var errMsg = '';
				    var pass = true;
				    var t = 0;
				    if(sel.arrSel.length > 0){
				      for(i=0;i<sel.arrSel.length;i++){
				        if($(sel.arrSel[i]).value == ""){
				          (t>0)?errMsg = errMsg + ' and ' + $(sel.arrSel[i]).previousSibling.innerHTML.replace(':',''):errMsg += $(sel.arrSel[i]).previousSibling.innerHTML.replace(':','');          
				          pass = false;
				          t++;
				        }           
				      } 
				    }
				    errMsg = "Please select<br />" + errMsg;  
				    if(!pass)
				      str = '<img src="includes/templates/<?php echo $template_dir; ?>/images/button/car.gif" border="0"  onmouseout=showTit(1) onmouseover=showTit(0); />'+'<div id="tit_t" style="display:none">'+errMsg+'<b></b></div>';
				     $('selectArea').innerHTML = str;
				  }
				     
				  </script>
			    <script>sel.ini();sel.checking();</script>
          <?php } ?>
		  
		  
 <!--    <div class="seal_m_en center"></div>  -->  
		
		
        <ul class="g_t_c">
 	
	 
		  
		 
			  
			    
		
		  <!--加入的 颜色指导说明 -->
		  
        </ul>
      </div>
      </form>
      <script>changePrice();</script>
      <!-- EOF ProductShipping Cart-->
    </div>
<!-- EOF Product Tools-->    </div> 
 
   <div style=" width:700px; margin-left:22px; margin-right:15px; "> 
   <table width="700"   >
   <tr>
     <td > &nbsp;&nbsp;&nbsp;
	 <br> <br> <br>
	 
	 <!--   产品描述上面的  文字描述     -->
	 
       </td>
     </tr>
 </table>  
  </div>    


</div>
<br class="clear" />
<div class="margin_t fl maxwidth">
<div id="product_main_con" class="fl black">
<!--add tab by tonycai 修改 bof-->
<ul name="pl" id="pl" class="size_tab">
     <li id="size_title01" class="">Introduction</li>
     <li id="size_title02" class="">Photographer &amp; Portfolio</li>
     <li id="size_title03" class="">How to get my photos</li>
	 <li id="size_title04" class="">Testimonials</li>
 </ul>
<div class="size_chart" style="width: 745px; overflow: hidden; padding-top: 15px; float: none; clear: both;">
<div class="kuanjia_box">

<div style="display: none;" id="size_tab01">

<!--bof Product description -->
  <?php if ($products_description != '') { ?>
    <div id="Item_Description_Spc" class="pad_10px pad_l_28px big"><?php echo stripslashes($products_description); ?></div>

 
    <!--加入的公共描述性的内容 开始   -->	  
	  <div id="Item_Description_Spc" class="pad_10px pad_l_28px big">
	  
  
	  </div>
	
	
	
	<!--加入的公共描述性的内容 结束 -->	
	
  <?php } ?>
  <!--eof Product description -->

</div>

<div style="display: none;" id="size_tab02">
	  <div id="Item_Description_Spc" class="pad_10px pad_l_28px big">

    
		 
 <!--  PHOTOGRAPHER AND EQUITMENT  -->
	   
 
 <table width="618" border="1">
  <tr>
    <td width="159" height="38"><div align="center" class="STYLE2">Name of photographer </div></td>
    <td width="443"><div align="center">Scofield Cai </div></td>
  </tr>
  <tr>
    <td height="51"><div align="center" class="STYLE2">Equipments for <br>
    wedding occasion </div></td>
    <td><div align="center">
      <p>Primary camera: Nikon D7K + Sigma Lens 17-50mm f/2.8</p>
      <p>Backup camera: Nikon D90 + Nikkor AF-S 85mm f/1.8</p>
    </div></td>
  </tr>
  <tr>
    <td height="51"><div align="center" class="STYLE2">Portfolio </div></td>
    <td><div align="center">
  
        
            <p><a href="http://www.flickr.com/photos/free_photographer_sydney/" target="_blank" class="STYLE3"> click here, see his portfolio </a> </p>
            <!-- Portfolio  -->
     
 
    </div></td>
  </tr>
</table>
<br>
<br>
<table width="618" border="1">
  <tr>
    <td width="159" height="38"><div align="center" class="STYLE2">Name of photographer </div></td>
    <td width="443"><div align="center">Joshua Forted </div></td>
  </tr>
  <tr>
    <td height="51"><div align="center" class="STYLE2">Equipments for <br>
      wedding occasion </div></td>
    <td><div align="center">
      <p>Primary camera: Nikon D700 + Nikkor AF Zoom 24-85mm f/2.8 </p>
      <p>Backup camera: Nikon D60 + Sigma Lens 18-200mm f/3.5-6.3 </p>
    </div></td>
  </tr>
  <tr>
    <td height="55"><div align="center" class="STYLE2">Portfolio </div></td>
    <td><div align="center">  unavailable </div></td>
  </tr>
</table>
<br>
<br>
<table width="618" border="1">
  <tr>
    <td width="159" height="38"><div align="center" class="STYLE2">Name of photographer </div></td>
    <td width="443"><div align="center">Matthew Tim </div></td>
  </tr>
  <tr>
    <td height="51"><div align="center" class="STYLE2">Equipments for <br>
      wedding occasion </div></td>
    <td><div align="center">
      <p>Primary camera: Canon 5D Mark II  + Canon Lens 24-70mm EF f/2.8L </p>
      <p>&nbsp; </p>
    </div></td>
  </tr>
  <tr>
    <td height="57"><div align="center" class="STYLE2">Portfolio </div></td>
    <td><div align="center">  unavailable </div></td>
  </tr>
</table>

	 
      
   <!-- END  PHOTOGRAPHER AND EQUITMENT -->  


</div>  </div>



<div style="display: none;" id="size_tab03">

       
		
<style type="text/css">
<!--
.STYLE1 {
	color: #0000FF;
	font-weight: bold;
}
-->
</style>
 
 <!-- How to get my photos -->
 	  <div id="Item_Description_Spc" class="pad_10px pad_l_28px big">
      
	  

We will send you photos in a CD within 2 weeks after the shooting. 
<br><br>
Includes: <br><br>
1. Unlimited photos taken, and all photographs enhanced and colour adjusted during processing.<br><br>
2. DVD with high resolution copies of the photos.<br><br>
3. low resolution copies optimised for screen viewing and use in your personal web galleries <br><br>



 
        <p>&nbsp; </p>

</div>
 <!-- How to get my photos -->
 
 
 

</div> 

 

<div style="display: none;" id="size_tab04">

	  <div id="Item_Description_Spc" class="pad_10px pad_l_28px big">
  
<!-- Portfolio  -->
 
 
 No Reviews
 
      
 
 <!-- Portfolio  -->
 
 
</div>


</div>    

</div>
</div>
<script type="text/javascript">
function tab_click(id){
	for(var i=1;i<=4;i++){
		if($('size_tab0' + i)){
			if($('size_tab0' + i).innerHTML){
				$('size_title0' + i).className = '';
				$('size_tab0' + i).style.display = 'none';
			}
		}
	}
	$('size_title0' + id).className = 'current';
	$('size_tab0' + id).style.display = 'block';
}
for(var i=1,j=0;i<=4;i++){
	if($('size_tab0' + i)){
		if($('size_tab0' + i).innerHTML){
			if(j==0){
				$('size_title0' + i).className = 'current';
				$('size_tab0' + i).style.display = 'block';
			}
			$('size_title0' + i).onclick = function(event){
				var evt = event?event:window.event;
				var size_title = evt.target?evt.target:evt.srcElement;

				return tab_click(size_title.id.split('0')[1]);
			}
			j++;
		} 
	}else{
		if($('size_title0' + i)){
			$('size_title0' + i).parentNode.removeChild($('size_title0' + i));
		}
	}
}
</script>
<!--add tab by tonycai 修改 bof-->


<div align="center">
  <p><br class="clear" />
    
    
      <!--bof Additional Product Images -->
      <?php
/**
 * display the products additional images
 */
  require($template->get_template_dir('/tpl_modules_additional_images.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_additional_images.php'); ?>
      <!--eof Additional Product Images -->
    
    
      <!--bof Prev/Next bottom position -->
      <?php if (PRODUCT_INFO_PREVIOUS_NEXT == 2 or PRODUCT_INFO_PREVIOUS_NEXT == 3) { ?>
      <?php
/**
 * display the product previous/next helper
 */
	
 require($template->get_template_dir('/tpl_products_next_previous.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_products_next_previous.php'); ?>
      <?php } ?>
      <!--eof Prev/Next bottom position -->
   </p>
 
</div>
<div class="g_t_r pad_bottom">
 

<a target="_blank" title="wedding dresses, wedding gowns" href="<?php echo 'print_page_p'.$_GET['products_id'];?>"></a></div>

<!-- BOF Related_categories Search_feedback -->
 
<!-- EOF Relate_categories Search_feedback -->
</div>
  <div class="mini_frame fr">
    <p>
      <?php // 去掉最近卖出   require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/'.$template_dir.'/recently_sold.php')); ?>
      <?php // 去掉买了还买  require($template->get_template_dir('tpl_modules_also_purchased_products.php', DIR_WS_TEMPLATE, $current_page_base,'templates'). '/' . 'tpl_modules_also_purchased_products.php');?>
      <?php require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/'.$template_dir.'/subscribe.php')); ?>
    </p>
	
	
	
  <!--Start of Zopim Live Chat Script-->
<script type="text/javascript">
window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute('charset','utf-8');
$.src='//cdn.zopim.com/?Mo30cGRZMp0iautWBGhwKUQESrzwjpgI';z.t=+new Date;$.
type='text/javascript';e.parentNode.insertBefore($,e)})(document,'script');
</script>  
<!--End of Zopim Live Chat Script-->   
      
  
    <p>&nbsp;  </p>
  </div>
</div>

<!--bof Form close-->
</form>
<!--bof Form close-->
<br class="clear"/>
