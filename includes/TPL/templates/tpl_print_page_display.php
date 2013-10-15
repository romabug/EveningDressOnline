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
?>
 


<br class="clear" />
<div class="margin_t allborder fl" style="padding: 2px 0pt;width:758px;">
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
    <div class="fr black">
      <div class="fl pad_product line_180">
        <!--bof Product Name-->
        <h1 style="font-size: 16px;"><?php echo $products_name; ?></h1>
        <!--eof Product Name-->
        <ul class="pad_10px">
          <li>item#<?php echo $products_model; ?></li>
          <div class="hr_d"></div>
        <!--bof Product Price block -->
        <li class="big margin_t"> Retail Price: <del>
          <?php
// base price
  if ($show_onetime_charges_description == 'true') {
    $one_time = '<span >' . TEXT_ONETIME_CHARGE_SYMBOL . TEXT_ONETIME_CHARGE_DESCRIPTION . '</span><br />';
  } else {
    $one_time = '';
  }
  echo $one_time . ((zen_has_product_attributes_values((int)$_GET['products_id']) and $flag_show_product_info_starting_at == 1) ? TEXT_BASE_PRICE : '') . $currencies->display_price(zen_get_products_retail_price((int)$_GET['products_id']),zen_get_tax_rate($product_info->fields['products_tax_class_id']));
?>
          </del> </li>
        <h3 class="relative">Retail Price:
          <div id="t_p"><ul><li><a class="one u b_" href="javascript:void(0)"><?php echo $currencies->display_symbol_left($_SESSION['currency']);?><!--[if IE 7]><!--></a><!--<![endif]--><!--[if lte IE 6]><table><tr><td><![endif]--><div>
        <?php
          reset($currencies->currencies);
         while (list($key, $value) = each($currencies->currencies)) { 
          if($key != $_SESSION['currency']){  ?>
          <a class="b_ big_" href="<?php echo $_SERVER['REQUEST_URI'];?>?currency=<?php echo $key; ?>"><?php echo $value['symbol_left']; ?></a>
        <?php }} ?>
        <!--[if lte IE 6.5]><IFRAME src="javascript:void(0)"></IFRAME><![endif]--></div><!--[if lte IE 6]></td></tr></table></a><![endif]--></li></ul></div>
          <span id="products_price_unit" class="red" style="padding-left:50px;"><?php echo number_format((zen_get_products_base_price((int)$_GET['products_id']) == 0 ? zen_get_products_sample_price((int)$_GET['products_id']) : zen_get_products_base_price((int)$_GET['products_id'])), 2, '.', '');?></span></h3>
        <!--eof Product Price block -->
        <li class="big">Start from: <?php echo $products_quantity_order_min;?> Unit(s)</li>
        <!--bof free ship icon  -->
        <?php if(zen_get_product_is_always_free_shipping($products_id_current) && $flag_show_product_info_free_shipping) { ?>
        <div id="freeShippingIcon"><?php echo TEXT_PRODUCT_FREE_SHIPPING_ICON; ?></div>
        <?php } ?>
        <!--eof free ship icon  -->
        </ul>
        <!--bof Quantity Discounts table -->
        <?php
          if ($products_discount_type != 0) { ?>
        <?php
        /**
         * display the products quantity discount
         */
         require($template->get_template_dir('tpl_modules_products_quantity_discounts.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_products_quantity_discounts.php'); ?>
        <?php
          }
        ?>
        <!--eof Quantity Discounts table -->
      </div>
    </div>
</div>
<br class="clear" />
<div class="margin_t fl maxwidth">
<div id="product_main_con" class="fl black">
<div>
  <!--bof Product description -->
  
     <div><h2 class="red"><br><br>This Page is under a Testing,  Sorry for the inconnence<br><br> </h2></div>
	   
	 
  <?php if ($products_description != '') { ?>
    <div><h2 class="blue"> </h2></div>
    <div id="Item_Description_Spc" class="pad_10px pad_l_28px big"><?php echo stripslashes($products_description); ?></div>
  <?php } ?>
  <!--eof Product description -->

</div>


<br class="clear" />
<!--bof Product details list  -->
<div><h2 class="blue">Details list: </h2></div>
<?php if ( (($flag_show_product_info_model == 1 and $products_model != '') or ($flag_show_product_info_weight == 1 and $products_weight !=0) or ($flag_show_product_info_quantity == 1) or ($flag_show_product_info_manufacturer == 1 and !empty($manufacturers_name))) ) { ?>
<ul class="pad_10px pad_l_28px big">
  <?php echo (($flag_show_product_info_model == 1 and $products_model !='') ? '<li>' . TEXT_PRODUCT_MODEL . $products_model . '</li>' : '') . "\n"; ?> <?php echo (($flag_show_product_info_weight == 1 and $products_weight !=0) ? '<li>' . TEXT_PRODUCT_WEIGHT .  $products_weight . TEXT_PRODUCT_WEIGHT_UNIT . '</li>'  : '') . "\n"; ?> <?php echo (($flag_show_product_info_quantity == 1) ? '<li>' . $products_quantity . TEXT_PRODUCT_QUANTITY . '</li>'  : '') . "\n"; ?> <?php echo (($flag_show_product_info_manufacturer == 1 and !empty($manufacturers_name)) ? '<li>' . TEXT_PRODUCT_MANUFACTURER . $manufacturers_name . '</li>' : '') . "\n"; ?>
</ul>
<br class="clear" />
<?php
  }
?>
<!--eof Product details list -->
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
<br class="clear"/>
<div id="product_print" class="g_t_r pad_bottom">
  <a title="Print" href="javascript:window.print();">
  <img border="0" alt="wholesale Print" title="wholesale Print " src="includes/templates/<?php echo $template_dir; ?>/images/button/btn_print_product.gif"/></a>
  </div>
</div>

</div>
<!--bof Form close-->
</form>
<!--bof Form close 打印页修改 关键词 描述 以下调出 PPP1 PPP2 PPP3 并输出-->

<br class="clear"/>
<div class="hr_d"></div>

 Relevant Content: <br>

 <li> <?php echo ( $ppp1  )?> </li>
 <li> <?php // echo ( $ppp2  )?></li>
 <li> <?php echo ( $ppp3  )?></li>
