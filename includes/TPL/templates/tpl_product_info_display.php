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


<div class="fr">
 
	 

 
<a href="<?php  echo zen_href_link(FILENAME_DEFAULT, 'cPath='. zen_get_products_category_id($_GET['products_id']));?>" / class="b_" title="<?php echo zen_get_category_name(zen_get_products_category_id($_GET['products_id']),$_SESSION['languages_id']);?>">other dresses in the list</a>&nbsp;<span id="recent_flash_smallPage" class="product_title">  

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
require($template->get_template_dir('tpl_product_flash_page.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_product_flash_page.php');


 ?>
<?php } ?>
<!--eof Prev/Next top position-->
<br class="clear" />

<!-- free photography ad -->
<div style="float:right; margin-bottom:-8px;">  <a href="/_p2577.html"><img src="/images/banner/free_photography.gif" ></a>  </div>


<div class="margin_t allborder fl" style="padding: 2px 0px; width:950px;">
  <div class="fl for_gray_bg" style="width:950px;">
    <!--bof Main Product Image -->
    <?php
  if (zen_not_null($products_image)) {
  ?>
    <?php
/**
 * display the main product image
 */
   require($template->get_template_dir('tpl_modules_main_product_image.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_main_product_image.php'); ?>
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
          <li style=" font-size:14px; font-weight:bold">Design No. &nbsp;<?php echo $products_model; ?></li>
	 
		  
		
		  
 
		  
		  
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
		  
		  
		  
		  
        <h3 class="relative"> <span class="red">Online Price:</span> 
          <div id="t_p"><ul><li><a class="one u b_" href="javascript:void(0)"> <?php echo $currencies->display_symbol_left($_SESSION['currency']);?><!--[if IE 7]><!--></a><!--<![endif]--><!--[if lte IE 6]><table><tr><td><![endif]-->
        
        <div>
				 
				<?php
					reset($currencies->currencies);
				 while (list($key, $value) = each($currencies->currencies)) { 
					if($key != $_SESSION['currency']){	?>
        	 <a class="b_ big_" href="<?php echo $_SERVER['REQUEST_URI'];?>?currency=<?php echo $key; ?>"><?php echo $value['symbol_left']; ?></a>
        	 <?php }} ?>
        	 <!--[if lte IE 6.5]><IFRAME src="javascript:void(0)"></IFRAME><![endif]--></div>
        <!--[if lte IE 6]></td></tr></table></a><![endif]--></li></ul></div>
          <span id="products_price_unit" class="red" style="padding-left:85px; "><?php echo number_format((zen_get_products_base_price((int)$_GET['products_id']) == 0 ? zen_get_products_sample_price((int)$_GET['products_id']) : zen_get_products_base_price((int)$_GET['products_id'])), 2, '.', '');?></span></h3>
        <!--eof Product Price block -->
		
		<li style="margin-top:8px;"> </li>
	
		   <li><?php echo '<a href="javascript:popupWindow(\'' . zen_href_link(FILENAME_POPUP_ASK_A_QUESTION, 'products_id='.$_GET['products_id']) . '\')">'.zen_image($template->get_template_dir('ask.gif', DIR_WS_TEMPLATE, $current_page_base,'images/button'). '/' . 'ask.gif','Ask Questions About This Item','','',' class="relative"').'</a>';?> 
		   
 	 
		 
		   <?php //  echo '<a href="javascript:popupWindow(\'' . zen_href_link(FILENAME_POPUP_ASK_A_QUESTION2, 'products_id='.$_GET['products_id']) . '\')">'.zen_image($template->get_template_dir('bargain.gif', DIR_WS_TEMPLATE, $current_page_base,'images/button'). '/' . 'bargain.gif','Bargain And Pay Less','','',' class="relative"').'</a>';?>         
	
   
	 	   	 <a href="/_p1973.html" target="_blank"><img border="0" hspace="0" src="/includes/templates/lightinthebox/images/button/fabric_sample.gif" /></a>           
	
		 
			 </br> &nbsp; <a href="contact_us.html" target="_blank">Q:Are you able to make a dress if i give you a pic? Yes, just Email us.</a>	   
			<!--	 
			  </br> &nbsp; <a href="http://www.google.com/products/seller?zmi=jjshouse.com&sqi=2&rate=1" target="_blank">Q:Why the price is higher than others? You can google their reviews before order it.</a>	  -->
			 
			       </li>
		   
 		    
		
		
           <!--bof free ship icon  -->
        <?php if(zen_get_product_is_always_free_shipping((int)$_GET['products_id'])) { ?>
             <li>This item is: <img border="0" class="g_t_m" src="includes/templates/<?php echo $template_dir; ?>/images/free.gif"/></li>
			 
			 
			 
			 
        <?php }else{
            echo zen_get_freeshipping_same_products($products_name);
        }
        	?>
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
				      $('tmp_tit').innerHTML = '(double-check colour,size,comments then add to cart)';
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
		
	 <li style="margin-top:20px;">
		     <img border="0" src="includes/templates/<?php  echo $template_dir; ?>/images/wedding_accessories.gif" alt="Wedding Accessories" />  
			 
			  <a href="http://wedding-dresses-sydney.com.au/wedding-veil_p699.html" target="_blank"><img border="0" src="includes/templates/<?php  echo $template_dir; ?>/images/match_veil.gif" alt="Match a wedding veil" /></a> 
			  
			  	  <a href="http://wedding-dresses-sydney.com.au/wedding-dresses-gowns-with-sleeves_p2118.html" target="_blank"><img border="0" src="includes/templates/<?php  echo $template_dir; ?>/images/dresses_sleeves.gif"  alt="Wedding Dresses With Sleeves" /></a> 
				  
			    <a href="http://wedding-dresses-sydney.com.au/wedding-dress-gown-bolero_p1322.html" target="_blank"><img border="0"  src="includes/templates/<?php  echo $template_dir; ?>/images/match_bolero.gif"  alt="Match Wedding Bolero"/></a> 
				  <a href="http://wedding-dresses-sydney.com.au/wedding-headpieces_p725.html" target="_blank"><img border="0" src="includes/templates/<?php  echo $template_dir; ?>/images/wedding_headpieces.gif"  alt="Wedding Headpieces" /></a> 
				  
		   <a href="http://customdolls.com.au/" target="_blank"><img border="0"   src="includes/templates/<?php  echo $template_dir; ?>/images/wedding_cake_topper.gif" alt="Custom Made Wedding Cake Topper"/></a> 		
		   
		   </li> 
       
		  
		 
			  
			    
		
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
     <td> 
   
    <br />
    <br />
    1. All are made from the finest quality bridal satins, micro silk, chiffon or taffeta. The hand detailing of our gowns is amazingly beautiful and can involve embroidery, lace applique, hand beading and crystal detailing and more.  
    
  
          <br />
          2. All have full boning and bra cups built into the bodice, all are fully lined and come with petticoat or hoop-skirt.  
   
        
          <br />
          3. All are available in White, Ivory and Champagne, and can be made either laceup corset style or zipup back.  <br/>    
          <?php //  echo $meta_tags_add_neirong;  ?>  
     
       <br>
       &nbsp;</td>
     <td width="170" align="center">    <a href="http://wedding-dresses-sydney.com.au/insurance-for-my-wedding-gown_p1065.html" target="_blank"><img border="0" src="includes/templates/<?php  echo $template_dir; ?>/images/insurance_wedding_dress.gif"/></a> 
		  <br />
		  <a href="http://wedding-dresses-sydney.com.au/page.html?id=45" target="_blank">How does the insurance work?</a>	</td>
   </tr>
 </table>  
  </div>    


</div>
<br class="clear" />
<div class="margin_t fl maxwidth">
<div id="product_main_con" class="fl black">
<!--add tab by tonycai 修改 bof-->
<ul name="pl" id="pl" class="size_tab">
     <li id="size_title01" class="">Description</li>
     <li id="size_title02" class="">Colors &amp; Size chart</li>
     <li id="size_title03" class="">How to measure</li>
	 <li id="size_title04" class="">Return Policy</li>
 </ul>
<div class="size_chart" style="width: 745px; overflow: hidden; padding-top: 15px; float: none; clear: both;">
<div class="kuanjia_box">

<div style="display: none;" id="size_tab01">

<!--bof Product description -->
  <?php if ($products_description != '') { ?>
    <div id="Item_Description_Spc" class="pad_10px pad_l_28px big"><?php echo stripslashes($products_description); ?></div>


&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="http://wedding-dresses-sydney.com.au/wedding%20dresses%20sydney%20%3E-sample-fabric-lace_c838" target="_blank">

<img src="http://www.wedding-dresses-sydney.com.au/images/attributes/lacesamples.jpg" width="403" height="67" border="0" />

</a>
  
    <!--加入的公共描述性的内容 开始 -->	
	  <div id="Item_Description_Spc" class="pad_10px pad_l_28px big">
	    <div>
          <p><strong>Is it for your body-type?</strong>&nbsp; <strong><a href="http://wedding-dresses-sydney.com.au/fitguide.html"  target="_blank" onclick="setTab('clothing',3,6)">See   Dress Styles Guide &gt;&gt;</a><br />
            </strong><br />
          <strong>Tailoring Period: 17-20 working days.</strong>&nbsp; <a href="http://wedding-dresses-sydney.com.au/dressmaking.html" target="_blank" onclick="setTab('clothing',5,6)"><strong>See Dress Making  &gt;&gt;<br />
          </strong></a><br />
Whether you   choose a standard size or give us your custom measurements, We treat each dress with special care and dedication, therefore the time required to make each type of dress differs.  
 
 
</p>
         </div>

  
	  </div>
	
	
	
	<!--加入的公共描述性的内容 结束 -->	
	
  <?php } ?>
  <!--eof Product description -->

</div>

<div style="display: none;" id="size_tab02">
	  <div id="Item_Description_Spc" class="pad_10px pad_l_28px big">

          <h2  class="margin_t blue">Color Chart : </h2>
	     <p  class="margin_t blue"><a href="http://wedding-dresses-sydney.com.au/images/promotions/colorchart.jpg" target="_blank" ><img src="http://www.wedding-dresses-sydney.com.au/images/banner/colorchart.jpg" width="250" height="134" border="0" /></a></p>
		 <br/>
		 
		 	     <h2  class="margin_t blue">Size Chart : </h2>    
	    
	      <p>Many of our dresses can also be tailor made to order   using the measurements you provide us. For tips on how to provide your accurate   measurements, see How to Measure. </p>
	   
	    <div>
          <strong>Standard U.S.   Dress Size          </strong>
          <table width="100%">
            <tbody>
              <tr>
                <td><table width="97%" border="1" align="left" cellpadding="0" cellspacing="0">
                    <tbody>
                      <tr>
                        <td><div align="center">Standard Size</div></td>
                        <td colspan="4"><div align="center">S</div></td>
                        <td colspan="4"><div align="center">M</div></td>
                        <td colspan="4"><div align="center">L</div></td>
                        <td colspan="4"><div align="center">XL</div></td>
                      </tr>
                      <tr>
                        <td><div align="center" class="STYLE9">US Size</div></td>
                        <td colspan="2"><div align="center" class="STYLE9">2</div></td>
                        <td colspan="2"><div align="center" class="STYLE9">4</div></td>
                        <td colspan="2"><div align="center" class="STYLE9">6</div></td>
                        <td colspan="2"><div align="center" class="STYLE9">8</div></td>
                        <td colspan="2"><div align="center" class="STYLE9">10</div></td>
                        <td colspan="2"><div align="center" class="STYLE9">12</div></td>
                        <td colspan="2"><div align="center" class="STYLE9">14</div></td>
                        <td colspan="2"><div align="center" class="STYLE9">16</div></td>
                      </tr>
                      <tr>
                        <td><div align="center">Europe Size</div></td>
                        <td colspan="2">32</td>
                        <td colspan="2">34</td>
                        <td colspan="2">36</td>
                        <td colspan="2">38</td>
                        <td colspan="2">40</td>
                        <td colspan="2">42</td>
                        <td colspan="2">44</td>
                        <td colspan="2">46</td>
                      </tr>
                      <tr>
                        <td><div align="center">Australian Size</div></td>
                        <td colspan="2">6</td>
                        <td colspan="2">8</td>
                        <td colspan="2">10</td>
                        <td colspan="2">12</td>
                        <td colspan="2">14</td>
                        <td colspan="2">16</td>
                        <td colspan="2">18</td>
                        <td colspan="2">20</td>
                      </tr>
                      <tr>
                        <td> <div align="center">&nbsp; </div></td>
                        <td bgcolor="#ececec">inch</td>
                        <td>cm</td>
                        <td bgcolor="#ececec">inch</td>
                        <td>cm</td>
                        <td bgcolor="#ececec">inch</td>
                        <td>cm</td>
                        <td bgcolor="#ececec">inch</td>
                        <td>cm</td>
                        <td bgcolor="#ececec">inch</td>
                        <td>cm</td>
                        <td bgcolor="#ececec">inch</td>
                        <td>cm</td>
                        <td bgcolor="#ececec">inch</td>
                        <td>cm</td>
                        <td bgcolor="#ececec">inch</td>
                        <td>cm</td>
                      </tr>
                      <tr>
                        <td><div align="center">Bust</div></td>
                        <td bgcolor="#ececec">32.50</td>
                        <td>83 </td>
                        <td bgcolor="#ececec">33.50</td>
                        <td>84 </td>
                        <td bgcolor="#ececec">34.50</td>
                        <td>88 </td>
                        <td bgcolor="#ececec">35.50</td>
                        <td>90 </td>
                        <td bgcolor="#ececec">36.50</td>
                        <td>93 </td>
                        <td bgcolor="#ececec">38</td>
                        <td>97 </td>
                        <td bgcolor="#ececec">39.50</td>
                        <td>100 </td>
                        <td bgcolor="#ececec">41</td>
                        <td>104 </td>
                      </tr>
                      <tr>
                        <td><div align="center">Waist</div></td>
                        <td bgcolor="#ececec">25.50</td>
                        <td>65 </td>
                        <td bgcolor="#ececec">26.50</td>
                        <td>68 </td>
                        <td bgcolor="#ececec">27.50</td>
                        <td>70 </td>
                        <td bgcolor="#ececec">28.50</td>
                        <td>72 </td>
                        <td bgcolor="#ececec">29.50</td>
                        <td>75 </td>
                        <td bgcolor="#ececec">31</td>
                        <td>79 </td>
                        <td bgcolor="#ececec">32.50</td>
                        <td>83 </td>
                        <td bgcolor="#ececec">34</td>
                        <td>86 </td>
                      </tr>
                      <tr>
                        <td><div align="center">Hips</div></td>
                        <td bgcolor="#ececec">35.75</td>
                        <td>91 </td>
                        <td bgcolor="#ececec">36.75</td>
                        <td>92 </td>
                        <td bgcolor="#ececec">37.75</td>
                        <td>96 </td>
                        <td bgcolor="#ececec">38.75</td>
                        <td>98 </td>
                        <td bgcolor="#ececec">39.75</td>
                        <td>101 </td>
                        <td bgcolor="#ececec">41.25</td>
                        <td>105 </td>
                        <td bgcolor="#ececec">42.75</td>
                        <td>109 </td>
                        <td bgcolor="#ececec">44.25</td>
                        <td>112 </td>
                      </tr>
                      <tr>
                        <td><div align="center">Hollow to Hem</div></td>
                        <td bgcolor="#ececec">58</td>
                        <td>147 </td>
                        <td bgcolor="#ececec">58</td>
                        <td>147 </td>
                        <td bgcolor="#ececec">59</td>
                        <td>150 </td>
                        <td bgcolor="#ececec">59</td>
                        <td>150 </td>
                        <td bgcolor="#ececec">60</td>
                        <td>152 </td>
                        <td bgcolor="#ececec">60</td>
                        <td>152 </td>
                        <td bgcolor="#ececec">61</td>
                        <td>155 </td>
                        <td bgcolor="#ececec">61</td>
                        <td>155 </td>
                      </tr>
                      <tr>
                        <td><div align="center">Height</div></td>
                        <td bgcolor="#ececec">63</td>
                        <td>160 </td>
                        <td bgcolor="#ececec">65</td>
                        <td>160 </td>
                        <td bgcolor="#ececec">65 </td>
                        <td>165 </td>
                        <td bgcolor="#ececec">65 </td>
                        <td>165 </td>
                        <td bgcolor="#ececec">67 </td>
                        <td>170 </td>
                        <td bgcolor="#ececec">67 </td>
                        <td>170 </td>
                        <td bgcolor="#ececec">69 </td>
                        <td>175</td>
                        <td bgcolor="#ececec">69 </td>
                        <td>175</td>
                      </tr>
                    </tbody>
                </table></td>
              </tr>
            </tbody>
          </table>
        </div>
	    <div></div>
	    <a id="Plus" name="Plus"></a>
        <div><br />
          <strong>Plus Size   Dress Size</strong><br />
        </div>
        <div>
          <table width="100%">
            <tbody>
              <tr>
                <td><table width="97%" border="1" align="left" cellpadding="0" cellspacing="0">
                    <tbody>
                      <tr>
                        <td><div align="center" class="STYLE9">Plus Size (US)</div></td>
                        <td colspan="2"><div align="center" class="STYLE9">14W</div></td>
                        <td colspan="2"><div align="center" class="STYLE9">16W</div></td>
                        <td colspan="2"><div align="center" class="STYLE9">18W</div></td>
                        <td colspan="2"><div align="center" class="STYLE9">20W</div></td>
                        <td colspan="2"><div align="center" class="STYLE9">22W</div></td>
                        <td colspan="2"><div align="center" class="STYLE9">24W</div></td>
                        <td colspan="2"><div align="center" class="STYLE9">26W</div></td>
                      </tr>
                      <tr>
                        <td><div align="center">Europe Size</div></td>
                        <td colspan="2">44</td>
                        <td colspan="2">46</td>
                        <td colspan="2">48</td>
                        <td colspan="2">50</td>
                        <td colspan="2">52</td>
                        <td colspan="2">54</td>
                        <td colspan="2">56</td>
                      </tr>
                      <tr>
                        <td><div align="center">Australian Size</div></td>
                        <td colspan="2">18</td>
                        <td colspan="2">20</td>
                        <td colspan="2">22</td>
                        <td colspan="2">24</td>
                        <td colspan="2">26</td>
                        <td colspan="2">28</td>
                        <td colspan="2">30</td>
                      </tr>
                      <tr></tr>
                      <tr>
                        <td> <div align="center">&nbsp;</div></td>
                        <td bgcolor="#ececec">inch</td>
                        <td>cm</td>
                        <td bgcolor="#ececec">inch</td>
                        <td>cm</td>
                        <td bgcolor="#ececec">inch</td>
                        <td>cm</td>
                        <td bgcolor="#ececec">inch</td>
                        <td>cm</td>
                        <td bgcolor="#ececec">inch</td>
                        <td>cm</td>
                        <td bgcolor="#ececec">inch</td>
                        <td>cm</td>
                        <td bgcolor="#ececec">inch</td>
                        <td>cm</td>
                      </tr>
                      <tr>
                        <td><div align="center">Bust</div></td>
                        <td bgcolor="#ececec">41</td>
                        <td>104 </td>
                        <td bgcolor="#ececec">43</td>
                        <td>109 </td>
                        <td bgcolor="#ececec">45</td>
                        <td>114 </td>
                        <td bgcolor="#ececec">47</td>
                        <td>119 </td>
                        <td bgcolor="#ececec">49</td>
                        <td>124 </td>
                        <td bgcolor="#ececec">51</td>
                        <td>130 </td>
                        <td bgcolor="#ececec">53</td>
                        <td>135 </td>
                      </tr>
                      <tr>
                        <td><div align="center">Waist</div></td>
                        <td bgcolor="#ececec">34</td>
                        <td>86 </td>
                        <td bgcolor="#ececec">36.25</td>
                        <td>92 </td>
                        <td bgcolor="#ececec">38.50</td>
                        <td>98 </td>
                        <td bgcolor="#ececec">40.75</td>
                        <td>104 </td>
                        <td bgcolor="#ececec">43</td>
                        <td>109 </td>
                        <td bgcolor="#ececec">45.25</td>
                        <td>115 </td>
                        <td bgcolor="#ececec">47.50</td>
                        <td>121 </td>
                      </tr>
                      <tr>
                        <td><div align="center">Hips</div></td>
                        <td bgcolor="#ececec">43.50</td>
                        <td>110 </td>
                        <td bgcolor="#ececec">45.50</td>
                        <td>116 </td>
                        <td bgcolor="#ececec">47.50</td>
                        <td>121 </td>
                        <td bgcolor="#ececec">49.50</td>
                        <td>126 </td>
                        <td bgcolor="#ececec">51.50</td>
                        <td>131 </td>
                        <td bgcolor="#ececec">53.50</td>
                        <td>136 </td>
                        <td bgcolor="#ececec">55.50</td>
                        <td>141 </td>
                      </tr>
                      <tr>
                        <td><div align="center">Hollow to Hem</div></td>
                        <td bgcolor="#ececec">61</td>
                        <td>155 </td>
                        <td bgcolor="#ececec">61</td>
                        <td>155 </td>
                        <td bgcolor="#ececec">61</td>
                        <td>155 </td>
                        <td bgcolor="#ececec">61</td>
                        <td>155 </td>
                        <td bgcolor="#ececec">61</td>
                        <td>155 </td>
                        <td bgcolor="#ececec">61</td>
                        <td>155 </td>
                        <td bgcolor="#ececec">61</td>
                        <td>155 </td>
                      </tr>
                      <tr>
                        <td><div align="center">Height</div></td>
                        <td bgcolor="#ececec">69 </td>
                        <td>175 </td>
                        <td bgcolor="#ececec">69 </td>
                        <td>175 </td>
                        <td bgcolor="#ececec">69 </td>
                        <td>175 </td>
                        <td bgcolor="#ececec">69 </td>
                        <td>175 </td>
                        <td bgcolor="#ececec">69 </td>
                        <td>175 </td>
                        <td bgcolor="#ececec">69 </td>
                        <td>175 </td>
                        <td bgcolor="#ececec">69 </td>
                        <td>175 </td>
                      </tr>
                    </tbody>
                </table></td>
              </tr>
            </tbody>
          </table>
        </div>


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
 <br />
 	  <div id="Item_Description_Spc" class="pad_10px pad_l_28px big">
          Please Note: Always get someone else to make the measurements for you: measuring yourself will give inaccurate numbers and could lead to disappointment. Measure with undergarments similar to those you will wear with your dress; do not measure over other clothing. 
	 <br />	  	 <br />	  
        <table width="100%" border="0" cellpadding="0" cellspacing="3" id="measure">
          <tbody>
            <tr>
              <td width="25%"><div align="center">
			  <img border="0" hspace="0" src="/images/attributes/measuring/bust.gif" /> </div></td>
              <td width="25%"><div align="center">
			   <img border="0" hspace="0" src="/images/attributes/measuring/waist.gif" /> </div></td>
              <td width="25%"><div align="center">
			  <img border="0" hspace="0" src="/images/attributes/measuring/hips.gif" /> </div></td>
              <td width="25%"><div align="center">
		 <img border="0" hspace="0" src="/images/attributes/measuring/hollow-hem.gif" /> </div></td>
            </tr>
            <tr>
              <td width="25%"><span class="STYLE9">Bust<br>
              </span> Take the tape around your back and bring it across   the fullest part of your bust. Your arms should be relaxed, down at your sides.   You must wear a bra when taking this measurement.  (not your bra size!) </td>
              <td width="25%" valign="top"><span class="STYLE9">Waist<br>
              </span>This is the smallest part of your waist. Typically it's an inch or so   above your belly button. Also known as the natural waistline. </td>
              <td width="25%" valign="top"><span class="STYLE9">Hips<br>
              </span>This is the widest part of your hips,  Measurement is taken approximately 7-9 inches below the natural waistline. </td>
              <td width="25%" valign="top"><span class="STYLE9">Hollow to Hem<br>
              </span>This is the length from your hollow(just under your   neck,close to collarbone) to floor with <span class="STYLE10">your shoes on</span>. </td>
            </tr>
            <tr>
              <td width="25%">&nbsp;</td>
              <td width="25%" valign="top">&nbsp;</td>
              <td width="25%" valign="top">&nbsp;</td>
              <td width="25%" valign="top">&nbsp;</td>
            </tr>
            <tr>
              <td width="25%"><div align="center"><img border="0" hspace="0" src="/images/attributes/measuring/shoulder-shoulder.gif" /></div></td>
              <td width="25%" valign="top"><div align="center"><img border="0" hspace="0" src="/images/attributes/measuring/shoulder-bust.gif" /></div></td>
              <td width="25%" valign="top"><div align="center"><img border="0" hspace="0" src="/images/attributes/measuring/shoulder-waist.gif" /></div></td>
              <td width="25%" valign="top"><div align="center"><img border="0" hspace="0" src="/images/attributes/measuring/outer-legs.gif" /></div></td>
            </tr>
            <tr>
              <td width="25%" valign="top"><span class="STYLE9">Shoulder to shoulder</span><br>
              The double length of the  scruff from the shoulder.</td>
              <td width="25%" valign="top"><span class="STYLE9">Shoulder to bust</span><br>
                measure from the inside shoulder point to the nipple.<br>
                <br>
                <span class="STYLE9">Nipple to nipple</span><br>
              The length between the nipple points. 
              </td>
              <td width="25%" valign="top"><span class="STYLE9">Shoulder to waist</span><br>
              From the  inside shoulder point to the waist through the nipple.</td>
              <td width="25%" valign="top"><span class="STYLE9">Outer leg</span><br>
              Take measurement from waist  to the floor with  <span class="STYLE10">your shoes on</span>.</td>
            </tr>
          </tbody>
        </table>
		<p>&nbsp; </p>
        <div align="center"><a href="/sizechart.html#pp" target="_blank" class="STYLE12">see video guide: how to measure?</a>  
</div>
        <p>&nbsp; </p>

</div>


</div> 

<div style="display: none;" id="size_tab04">

	  <div id="Item_Description_Spc" class="pad_10px pad_l_28px big">
<p>Returning for replacement and refund</p>
<p>Please contact us first if there is a problem with the dress you received, We don't accept returns without previous notice. </p>
<p>All returns must be sent within 4 days of the shipment being delivered. We only accept dresses in their original condition- unworn, unwashed, unaltered, and undamaged - and must have the tags intact and still attached. Please provide a detailed explanation in the return package.</p>
<p>1.  Quality Issues:</p>
<p>*  If our staff finds that the merchandise is defective as described, you will receive a refund for the purchase price plus shipping and handling fees.<br />
  *  If we find that the merchandise is not defective in any way or has been misused, then the merchandise will be shipped back to you with no refund.</p>
<p>2.  Size Errors:</p>
<p>Please be aware that due to the nature of the handwork required, the finished gown may vary approximately 1&quot; in either direction of specified measurements.</p>
<p>*  All dresses are made or come with margins for altering and tailoring if desired. If the dress size did not arrive in the specification as  you ordered, you can choose to make the adjustments at a local tailor, in which case we will reimburse the tailoring costs as long as the costs does not exceed the original price of the dress by 20%. If the tailoring costs exceed the original price of the dress by 20%, we will reimburse only up to the amount equal to 20% of the dress's original cost.</p>
<p>3.  Color Errors:</p>
<p>If the color of the delivered dress is not what was ordered, you are eligible for a full refund. (This does not apply if the color difference is caused by one's display monitor. Please get a fabric swatch for confirmation before ordering your dress.)<br />
  However, any errors regarding size/color that were made during purchasing of our products will not be eligible for refunds.<br />
</p>
<p>Order Cancellations</p>
<p>All dresses ordered from us can be cancelled within 24 hours free of charge, no questions asked. However, because your dress is a one-off tailor made for your special day, orders cancelled after 24 hours(no more than 48 hours) are subject to a handling fee equaling 25% of the item price. orders cancelled after 48 hours are subject to a handling fee equaling 80% of the item price We thank you in advance for your understanding. <br />
</p>
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
 

<a target="_blank" title="wedding dresses, wedding gowns" href="<?php echo 'print_page_p'.$_GET['products_id'];?>">Write a Review</a></div>

<div id="p_review">
<div class="hr_d"></div>
<!-- BOF Product Reviews -->
<?php
  if ($flag_show_product_info_reviews == 1) {
    // if more than 0 reviews, then show reviews content; otherwise, don't show 
    if ($reviews->RecordCount() > 0 ) { ?>

<h2 class="margin_t blue fl">Product Reviews:  <a href="<?php echo zen_href_link(zen_get_info_page($_GET['products_id']),'products_id=' . $_GET['products_id']).'#review' ?>"><?php echo zen_image($template->get_template_dir('btn_review.gif', DIR_WS_TEMPLATE, $current_page_base,'images/button'). '/btn_review.gif','','','',' class="g_t_m"'); ?></a></h2>
<div class="clear"></div>
<div class="pad_10px pad_l_28px big">
<!--bof Reviews button and count-->

	    <?php while (!$reviews->EOF){	      
	    				$customer_name = substr($reviews->fields['customers_name'],strpos($reviews->fields['customers_name'],' '));
	    				if(!isset($customer_name)){
	    					$customer_name = $reviews->fields['reviews_id'];
	    				}
	    	?>
				<ul class="border_b margin_t pad_bottom">
				<?php for( $i = 0;$i < $reviews->fields['reviews_rating'];$i++){?>
							<span class="star"></span>
				<?php } ?>
				<?php if ( $reviews->fields['reviews_rating']<5){
								for( $i = 0;$i < 5-$reviews->fields['reviews_rating'];$i++){
									echo '<span class="star_gray"></span>';
								}		
							}?>
				&nbsp;<strong><?php // echo $reviews->fields['reviews_title']; ?></strong>, <?php echo zen_date_short($reviews->fields['date_added']);?>  <?php if($reviews->fields['reviews_is_featured']){echo '<span style="font-size: 10px;"> ( <a href="'.zen_href_link(FILENAME_TESTIMONIALS).'" class="u">'.TEXT_PRODUCT_FEATURED_REVIEW.'</a> ) </span>';} ?><div style="" class="gray big"><?php echo $reviews->fields['reviews_text'] ?>   <br/> <br/><?php echo $customer_name; ?></div>
				</ul>
			<?php $reviews->MoveNext();
					} ?>
      </div>
    <?php } else {
    		//no display addBy   5772122@qq.com
    	}?>

<?php } ?>

<!--eof Reviews button and count -->
<h2 class="margin_t blue">&nbsp;</h2> 
<a name="review"></a>
	<div class="pad_bottom pad_l_28px big">
	<p> All the reviews are moderated and will be reviewed within two business days. Inappropriate reviews will not be posted. </p>
	<p>Have any question or inquire for our wedding dresses? Please contact <a target="_blank" class="red u" href="http://wedding-dresses-sydney.com.au/faq.html">Customer Service</a>. </p>
	<ul class="inquiry">	
	<form onsubmit="return(fmChk(this))" method="post" action="<?php echo zen_href_link(zen_get_info_page($_GET['products_id']),'products_id=' . $_GET['products_id']).'#review' ?>" name="post_review" id="post_review">
	<input type="hidden" value="4" id="product_score" name="product_score"/>
	<input type="hidden" value="review" id="action" name="action"/>
	<input type="hidden" value="" id="session_key" name="session_key"/>
	<table width="360" border="0" class="big">
	  <tbody><tr><td colspan="2">
	  <?php if ($messageStack->size('reviews') > 0) echo $messageStack->output('reviews'); ?>
	  <td></tr>
	  <tr><td colspan="2">Indicates required fields<span class="red">*</span></td></tr>
	  <tr><td colspan="2">
		  <table><tbody><tr>
		  <td class="big">Rating: </td>
		  <td>
		  <div onmousedown="rating.startSlide()" onmousemove="rating.doSlide(event)" onmouseout="rating.resetHover()" onclick="rating.setRating(event)" onmouseup="rating.stopSlide()" id="r_RatingBar" style="background: transparent url(includes/templates/lightinthebox/images/icon/unfilled.gif) repeat scroll 0%; width: 75px; cursor: pointer; -moz-background-clip: -moz-initial; -moz-background-origin: -moz-initial; -moz-background-inline-policy: -moz-initial;">
			<div style="background: transparent url(includes/templates/lightinthebox/images/icon/hover.gif) repeat-x scroll 0%; -moz-background-clip: -moz-initial; -moz-background-origin: -moz-initial; -moz-background-inline-policy: -moz-initial; height: 14px; width: 0px;" id="r_Hover">
			<div id="r_Filled" style="background: transparent url(includes/templates/lightinthebox/images/icon/sparkle.gif) repeat-x scroll 0%; overflow: hidden; -moz-background-clip: -moz-initial; -moz-background-origin: -moz-initial; -moz-background-inline-policy: -moz-initial; height: 14px; width: 60px;"></div>
			</div>
		</div>		</td>
		<td><div id="score_title"></div></td>
		</tr></tbody></table>
		<script type="text/javascript">
		var rbi = new BvRatingBar('r_');
		window.rating = rbi;
		</script>
		</td></tr>
	  <tr>
		<td width="110" valign="top">Your Name: <span class="red">*</span></td>
		<td width="250" valign="top">
    <input type="text" chkrule="nnull" chkname="Your Name" class="input_5" value="<?php echo isset($_SESSION['customer_id'])? zen_get_customer_name($_SESSION['customer_id']): '';  ?>" name="customer_name"/>		<div class="big_">Enter your Reviewer Nickname </div></td>
	  </tr>
	     		<?if(isset($_SESSION['customer_id'])){
	     		  //nothing
	     		}else{
	     			?><tr>
						<td width="110" valign="top">Your Email: <span class="red">*</span></td>
						<td width="250" valign="top">
							<input type="text" chkrule="nnull/eml" chkname="Email" class="input_5" value="" name="customer_email"/>		</td>
					  </tr>
					  <?php } ?>
	  	  <tr>
		<td valign="top">Review Title: <span class="red">*</span></td>
		<td valign="top">
<input type="text" chkrule="nnull/max50" chkname="Review Title" class="input_5" value="" name="review_title"/></td>
	  </tr>
	

	  <tr>
		<td colspan="2">
<textarea chkrule="nnull/max10000" chkname="review" class="textarea1 txt_review" name="review_content" id="txt_review" onblur="if(this.value == '') this.className='textarea1 txt_review'" onfocus="this.className='textarea1'"></textarea></td>
	  </tr>
	  <tr>
		<td height="50" align="right" colspan="2"><button id="submint1_review" type="submit"><span id="submint2_review">Submit</span></button></td>
	  </tr>
	</tbody></table>
	</form>
	 </ul>
</div>
<!-- EOF Product Reviews -->
</div>
<!-- BOF Related_categories Search_feedback -->
<?php
	require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/'.$template_dir.'/related_categories.php'));
	require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/'.$template_dir.'/search_feedback.php'));
?>
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
