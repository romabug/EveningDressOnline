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











<div class="fr"><a href="<?php echo zen_href_link(FILENAME_DEFAULT, 'cPath='. zen_get_products_category_id($_GET['products_id']));?>" / class="b_" title="<?php echo zen_get_category_name(zen_get_products_category_id($_GET['products_id']),$_SESSION['languages_id']);?>">other dresses in the list</a>&nbsp;<span id="recent_flash_smallPage" class="product_title">

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

		   
<?php echo '<a href="javascript:popupWindow(\'' . zen_href_link(FILENAME_POPUP_ASK_A_QUESTION2, 'products_id='.$_GET['products_id']) . '\')">'.zen_image($template->get_template_dir('ask.gif', DIR_WS_TEMPLATE, $current_page_base,'images/button'). '/' . 'check.gif','Ask Questions About This Item','','',' class="relative"').'</a>';?> 
 	 

	 

	 

		 

 

			 

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

				      $('tmp_tit').innerHTML = 'checking inventory first<br> then add to cart';

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

     <td> 

   

       <p><br />

            <br />

         * The pictures of this dress are authentic and original. <br />

         * The materials used in this dress are of the highest quality, and the workmanship   on the dress will leave you astounded, Absolutely elegant and   beautiful !!<br/>    

         <?php //  echo $meta_tags_add_neirong;  ?>  

         

            <br>

  &nbsp;</p>

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

     <li id="size_title01" class="">Description</li>

     <li id="size_title02" class="">Size Chart</li>

     <li id="size_title03" class="">How to measure</li>

	 <li id="size_title04" class="">Return &amp; Exchange </li>

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



    

		 

 <!--  START SIZE CHART -->

	   

 

 

		 	     <h2  class="margin_t blue">Size Chart : </h2>    
 

 
 
<div  style="margin:10px;">
 
<table border="1" cellspacing="0" cellpadding="0" width="97%" align="left">
          <tbody>
            <tr>
              <td height="22"><div align="center"><font color="#990000" />  Size </font></div></td>
              <td colspan="2"><div align="center"><font color="#990000" />S </font></div></td>
              <td colspan="2"><div align="center"><font color="#990000" />M </font></div></td>
              <td colspan="2"><div align="center"><font color="#990000" />L </font></div></td>
              <td colspan="2"><div align="center"><font color="#990000" />XL </font></div></td>
              <td colspan="2"><div align="center"><font color="#990000" />XXL </font></div></td>
              <td colspan="2"><div align="center"><font color="#990000" />XXXL </font></div></td>
            </tr>
            <tr>
              <td height="22"><div align="center"><font color="#990000" />Australian Size</font></div></td>
              <td colspan="2"><div align="center"><font color="#990000" />8 </font></div></td>
              <td colspan="2"><div align="center"><font color="#990000" />10 </font></div></td>
              <td colspan="2"><div align="center"><font color="#990000" />12 </font></div></td>
              <td colspan="2"><div align="center"><font color="#990000" />14 </font></div></td>
              <td colspan="2"><div align="center"><font color="#990000" />16 </font></div></td>
              <td colspan="2"><div align="center"></div></td>
            </tr>
            <tr>
              <td height="22"><div align="center"></div></td>
              <td bgcolor="#ececec"><div align="center">inch</div></td>
              <td><div align="center">cm</div></td>
              <td bgcolor="#ececec"><div align="center">inch</div></td>
              <td><div align="center">cm</div></td>
              <td bgcolor="#ececec"><div align="center">inch</div></td>
              <td><div align="center">cm</div></td>
              <td bgcolor="#ececec"><div align="center">inch</div></td>
              <td><div align="center">cm</div></td>
              <td bgcolor="#ececec"><div align="center">inch</div></td>
              <td><div align="center">cm</div></td>
              <td bgcolor="#ececec"><div align="center">inch</div></td>
              <td><div align="center">cm</div></td>
            </tr>
            <tr>
              <td height="22"><div align="center">Bust</div></td>
              <td bgcolor="#ececec"><div align="center">31.5</div></td>
              <td><div align="center">80</div></td>
              <td bgcolor="#ececec"><div align="center">33.5</div></td>
              <td><div align="center">85</div></td>
              <td bgcolor="#ececec"><div align="center">35.5</div></td>
              <td><div align="center">90</div></td>
              <td bgcolor="#ececec"><div align="center">37.5</div></td>
              <td><div align="center">95</div></td>
              <td bgcolor="#ececec"><div align="center">39.5</div></td>
              <td><div align="center">100</div></td>
              <td bgcolor="#ececec"><div align="center"></div></td>
              <td><div align="center"></div></td>
            </tr>
            <tr>
              <td height="22"><div align="center">Waist</div></td>
              <td bgcolor="#ececec"><div align="center">25</div></td>
              <td><div align="center">64</div></td>
              <td bgcolor="#ececec"><div align="center">27</div></td>
              <td><div align="center">69</div></td>
              <td bgcolor="#ececec"><div align="center">29</div></td>
              <td><div align="center">74</div></td>
              <td bgcolor="#ececec"><div align="center">31</div></td>
              <td><div align="center">79</div></td>
              <td bgcolor="#ececec"><div align="center">33</div></td>
              <td><div align="center">84</div></td>
              <td bgcolor="#ececec"><div align="center"></div></td>
              <td><div align="center"></div></td>
            </tr>
            <tr>
              <td height="22"><div align="center">Hips</div></td>
              <td bgcolor="#ececec"><div align="center">34</div></td>
              <td><div align="center">87</div></td>
              <td bgcolor="#ececec"><div align="center">36</div></td>
              <td><div align="center">92</div></td>
              <td bgcolor="#ececec"><div align="center">38</div></td>
              <td><div align="center">97</div></td>
              <td bgcolor="#ececec"><div align="center">40</div></td>
              <td><div align="center">102</div></td>
              <td bgcolor="#ececec"><div align="center">42</div></td>
              <td><div align="center">107</div></td>
              <td bgcolor="#ececec"><div align="center"></div></td>
              <td><div align="center"></div></td>
            </tr>
          </tbody>
        </table>
	 
	 </div>
 
     <div style="margin:30px"> &nbsp;</div> 

     <!-- END SIZE CHART -->  

 
  </div>

  </div>







<div style="display: none;" id="size_tab03">



       

		

<style type="text/css">

<!--

.STYLE1 {

	color: #0000FF;

	font-weight: bold;

}

-->

</style>

 

 	  <div id="Item_Description_Spc" class="pad_10px pad_l_28px big">
<br />
   
 <font color="#990000" />    Always get someone else to make the measurements for you, measuring yourself will give inaccurate numbers and could lead to disappointment. Measure with undergarments similar to those you will wear with your dress, do not measure over other clothing.   <font> <br />
    <br />
  </p>
</div>
<table id="measure" border="0" cellspacing="4" cellpadding="0" width="90%" align="center">
  <tbody>
    <tr>
      <td width="291"><div align="center"><img border="0" hspace="0" src="http://eveningdressonline.com.au/images/attributes/bust.jpg" /></div></td>
      <td width="291"><div align="center"><img border="0" hspace="0" src="http://eveningdressonline.com.au/images/attributes/waist.jpg" /></div></td>
      <td width="291"><div align="center"><img border="0" hspace="0" src="http://eveningdressonline.com.au/images/attributes/hips.jpg" /></div></td>
    </tr>
    <tr>
      <td width="321">Bust-Not your bra size,Take the tape around your back and bring it across the fullest part of your bust. Your arms should be relaxed, down at your sides. You must wear a bra when taking this measurement.</td>
      <td valign="top" width="321">Waist-This is the smallest part of your waist. Typically it's an inch or so above your belly button. Also known as the natural waistline.</td>
      <td valign="top" width="321">Hips-This is the widest part of your hips, Measurement is taken approximately 7-9 inches below the natural waistline.</td>
    </tr>
  </tbody>
</table>


</div>





</div> 



<div style="display: none;" id="size_tab04">



	  <div id="Item_Description_Spc" class="pad_10px pad_l_28px big">

<!--  Return and exchange -->


 
 <p><strong><font color="#990000" />  Q:What should I do if the dress does not fit me? </font> </strong></p>
 
<font  color="#666666"/>  
<p>We offer exchange service if the dress received doesn't fit, </p>
<p>and buyer should pay for shipping. (includes shipping cost of return &amp; re-delivery)</p>
</font>



<p><strong><font color="#990000" />  Q:Can I return the dress and get refund if I do not like it?  </font></strong></p>

<font  color="#666666"/>  

<p>1.For any reason caused return, buyer should contact us by email within 2 days, and return it within 7 days when received the parcel. Please inform us via phone or email to <a href="mailto:sales@eveningdressonline.com.au">sales@eveningdressonline.com.au</a> if you want to return a dress. then we will send you a authorization number for the return.</p>
<p>2.Print a &quot;Return Authorization Form&quot;. Please fill out all the information and the authorization number we gave you. Ship the paper together with the returned package.</p>
<p>3.The dresses must be returned in original condition. it must be returned in new with all original tags attached. dresses with signs of wear, heavy perfumes or smoke are not acceptable,</p>
<p>4.When we receive your package we will process the return within 3-5 days. </p>
<p>5.Postage is not refundable. </p>
</font>
 
 
 

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

