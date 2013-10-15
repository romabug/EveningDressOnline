<?php
/**
 * Page Template
 *
 * Loaded by main_page=index<br />
 * Displays category/sub-category listing<br />
 * Uses tpl_index_category_row.php to render individual items
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_index_categories.php 4678 2006-10-05 21:02:50Z ajeh $
 */

if(!$this_is_home_page){
	echo '<div class="minframe fl">';
	require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/categories.php'));
	require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/'.$template_dir.'/customers_say.php'));
	require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/'.$template_dir.'/popular_searches.php'));
	require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/'.$template_dir.'/subscribe.php'));
	require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/'.$template_dir.'/trustful.php'));

	echo '</div>';
}
?>


<div class="right_big_con margin_t">
<div class="midframe fl">
<?php
require(DIR_WS_MODULES . 'sideboxes/'.$template_dir.'/flash_sidebox.php');
if(!$this_is_home_page && $categories_displayTypes == 1){
// categories_description
if ($current_categories_description != '') {
?>
<div id="categoryDescription" class="right_small_con_1">
<strong class="cname"><?php echo zen_get_category_name($current_category_id,$_SESSION['languages_id']); ?></strong>
<?php echo $current_categories_description;  ?></div>
<?php
   require($template->get_template_dir('tpl_modules_in_category_row.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_in_category_row.php');
  }
}
if ($categories_displayTypes != 3){
	if(!$this_is_home_page && $categories_displayTypes == 2){
	// categories_description
	if ($current_categories_description != '') {
	?>
	<div id="categoryDescription" class="right_small_con_1">
	<strong class="cname"><?php echo zen_get_category_name($current_category_id,$_SESSION['languages_id']); ?></strong>
	<?php echo $current_categories_description;  ?></div>
	<?php } // categories_description ?>
	<!-- BOF: Display grid of available sub-categories, if any -->
	<?php
		if(zen_has_category_subcategories($current_category_id)){
			$recommended_products_subcategories = array();
			zen_get_subcategories(&$recommended_products_subcategories,$current_category_id);
			$recommended_products_subcategories_str = implode(' or pt.categories_id = ',$recommended_products_subcategories);
			$suffix_sql = ' AND ( pt.categories_id ='.$recommended_products_subcategories_str.')';
		}else{
			$suffix_sql = ' AND pt.categories_id = \''.$current_category_id.'\'';
		}
	
		$recommended_products_sql = "SELECT p.`products_id`,p.`products_quantity`,p.`product_is_wholesale`,pd.`products_name`, p.`products_image`, p.`products_price`,p.`products_price_retail`,p.`products_price_sample` FROM featured f, products p, products_to_categories pt, products_description pd
	WHERE p.products_id=f.products_id AND p.`products_status` = 1 AND pt.products_id=p.products_id AND pd.products_id=f.products_id".$suffix_sql;
	
		$recommended_products = $db->Execute($recommended_products_sql);
		
		if($recommended_products->RecordCount()>0){
			while (!$recommended_products->EOF){
				$recommended_products_items[] = $recommended_products->fields;
				$recommended_products_id_con[]	= $recommended_products->fields['products_id'];
				$recommended_products_images_con[]	= '"'.(zen_not_null($recommended_products->fields['products_image']) ? $recommended_products->fields['products_image'] : PRODUCTS_IMAGE_NO_IMAGE ).'"';
				$recommended_products_source_price_con[]	= '"'.$currencies->display_price($recommended_products->fields['products_price_retail'],zen_get_tax_rate($product_check->fields['products_tax_class_id'])).'"';
				$recommended_products_price_con[]	= '"'.$currencies->display_price(($recommended_products->fields['products_price'] == 0 ? $recommended_products->fields['products_price_sample']: $recommended_products->fields['products_price']),zen_get_tax_rate($product_check->fields['products_tax_class_id'])).'"';
				$recommended_products_sub_name_con[]	= '"'.zen_clipped_string(addslashes(zen_output_string($recommended_products->fields['products_name'])),' ',18).'"';
				$recommended_products_name_con[]	= '"'.zen_output_string($recommended_products->fields['products_name']).'"';
	
	      $sold_out_s = ($recommended_products->fields['products_quantity'] <= 0)? 1 : 0 ;
	      $almost_sold_out_s = ( 0 < $recommended_products->fields['products_quantity'] and $recommended_products->fields['products_quantity'] <10)? 1 : 0;
	      $product_count_s = 0;
	      $sale_item_s = $recommended_products->fields['product_is_wholesale)'];
				$recommended_products_flg_con[] = '"'.$sold_out_s.'#'.$almost_sold_out_s.'#'.$product_count_s.'#'.$sale_item_s.'"';
				$recommended_products->MoveNext();
			}
			$recommended_products_id = implode(",", $recommended_products_id_con);
			$recommended_products_images = implode(",", $recommended_products_images_con);
			$recommended_products_source_price = implode(",", $recommended_products_source_price_con);
			$recommended_products_price = implode(",", $recommended_products_price_con);
			$recommended_products_sub_name = implode(",", $recommended_products_sub_name_con);
			$recommended_products_name = implode(",", $recommended_products_name_con);
			$recommended_products_flg = implode(",",$recommended_products_flg_con);
		}
		$recommended_display_num = ( count($recommended_products_items) > 4) ? count($recommended_products_items) : 4 ;
		if($recommended_products->RecordCount()>0){
	?>
		<div id="category_recommended" class="allborder right_small_con margin_t relative">
			<div class="pad_10px">
				<h2>Recommended products<span id="recent_flashPage" class="pad_text gray"></span></h2>
					<span title="Back" id="recent_flashPrev" class="recent_flash_prev"></span>
					<span title="Next" id="recent_flashNext" class="recent_flash_next"></span>
				<ul class="margin_t mid_flash_width" id="recent_flash">
		<?php for($i=0; $i<$recommended_display_num ; $i++){ ?>
				<li id="li<?php echo $i; ?>">
				<div class="relative m_w_90 center">
				    <?php if ($recommended_products_items[$i]['products_quantity'] <= 0) {?>
						<span style="display:block;" id="sold_out_s<?php echo $i;?>" class="sold_out_s"></span>
						<?php }else{ ?>
		        <span style="display:none;" id="sold_out_s<?php echo $i;?>" class="sold_out_s"></span>
		        <?php } ?>
						<span style="display: none;" id="product_count_s<?php echo $i;?>" class="product_count_s">0</span>
						<?php if ($recommended_products_items[$i]['product_is_wholesale'] == 1) {?>
						<span style="display: block;" id="sale_item_s<?php echo $i;?>" class="sale_item_s"></span>
						<?php }else{ ?>
		        <span style="display: none;" id="sale_item_s<?php echo $i;?>" class="sale_item_s"></span>
		        <?php if ($recommended_products_items[$i]['products_quantity'] < 10 and $recommended_products_items[$i]['products_quantity'] >0 ) {?>
						<span style="display:block;" id="almost_sold_out_s<?php echo $i;?>" class="almost_sold_out_s"></span>
						<?php }else{ ?>
		        <span style="display: none;" id="almost_sold_out_s<?php echo $i;?>" class="almost_sold_out_s"></span>
						<?php } ?>
						<?php } ?>
				<a id="cell_link<?php echo $i ?>" class="ih" href="<?php echo zen_href_link(zen_get_info_page($recommended_products_items[$i]['products_id']), 'products_id=' . $recommended_products_items[$i]['products_id']); ?>"><?php echo zen_image_OLD(DIR_WS_IMAGES.$recommended_products_items[$i]['products_image'],SEO_COMMON_KEYWORDS.' '.$recommended_products_name_con[$i],85,85,'id="cell_img'.$i.'"');?></a>
				</div>
				<p><span id="cell_name<?php echo $i; ?>">
				<a id="cell_name_link<?php echo $i ?>" href="<?php echo zen_href_link(zen_get_info_page($recommended_products_items[$i]['products_id']), 'products_id=' . $recommended_products_items[$i]['products_id']); ?>"><?php echo zen_clipped_string($recommended_products_items[$i]['products_name'],' ',20); ?></a></span>
				<br/><del id="cell_source_price<?php echo $i; ?>"><?php echo $currencies->display_price($recommended_products_items[$i]['products_price_retail'],zen_get_tax_rate($recommended_products_items[$i]['products_id'])) ?></del>
				<br/><strong id="cell_price<?php echo $i; ?>" class="red"><?php echo $currencies->display_price(($recommended_products_items[$i]['products_price'] == 0 ? $recommended_products_items[$i]['products_price_sample']: $recommended_products_items[$i]['products_price']),zen_get_tax_rate($recommended_products_items[$i]['products_id'])) ?></strong>
				</p>
				</li>
		<?php } ?>
				</ul>
			</div>
		</div>
		<script>
			var productTotal = <?php echo count($recommended_products_items);?>;
			var productCurrent = 0;
			
			var productID = new Array();
			var productIMG = new Array();
			var productSourcePrice  = new Array();
			var productPrice  = new Array();
			var productSubName  = new Array();
			var productName  = new Array();
			var productFlg  = new Array();
				
			var imgURL = baseURL+'images/';
			var linkURL = baseURL+"index.php?main_page=product_info&products_id=";
			
			productID = [<?php echo $recommended_products_id; ?>];
			productIMG = [<?php echo $recommended_products_images; ?>];
			
			productPrice = [<?php echo $recommended_products_price; ?>];
			productSourcePrice = [<?php echo $recommended_products_source_price ?>];
			productSubName = [<?php echo $recommended_products_sub_name; ?>];
			productName = [<?php echo $recommended_products_name; ?>];
			productFlg = [<?php echo $recommended_products_flg; ?>];
			page_go('recent_flash','4', 0, productTotal);
		</script>
	<?php
	  }
	}
}
if (PRODUCT_LIST_CATEGORY_ROW_STATUS == 0) {
    // do nothing
  } else {
    // display subcategories
/**
 * require the code to display the sub-categories-grid, if any exist
 */
 if($this_is_home_page){
   require($template->get_template_dir('tpl_modules_featured_category_row.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_featured_category_row.php');
	 }
  }
?>
<!-- EOF: Display grid of available sub-categories -->
</div>
<?php if (!$this_is_home_page) {?>
<?php if ($categories_displayTypes != 3){ ?>
<div class="therightframe fr">
<?php } ?>
<?php
	$index_categories_banner_query = "select categories_banner_1_img,categories_banner_2_img,categories_banner_1_link,categories_banner_2_link from ".TABLE_CATEGORIES." where categories_id = '".$current_category_id."'";
	$index_categories_banner = $db->Execute($index_categories_banner_query);
	if ($index_categories_banner->RecordCount()>0){
		$index_categories_banner_1_img = $index_categories_banner->fields['categories_banner_1_img'];
		$index_categories_banner_2_img = $index_categories_banner->fields['categories_banner_2_img'];
		$index_categories_banner_1_link = $index_categories_banner->fields['categories_banner_1_link'];
		$index_categories_banner_2_link = $index_categories_banner->fields['categories_banner_2_link'];
	}
?>
<?php if ($index_categories_banner_1_img != '') {?>
	<div class="allborder right_small_con margin_t" style="overflow: hidden; width: 207px;">
	<a href="<?php echo $index_categories_banner_1_link; ?>"><?php echo zen_image(DIR_WS_IMAGES.$index_categories_banner_1_img,''); ?></a></div>
<?php }?>

<?php 
  if ($index_categories_banner_2_img != '') {  
	  if($categories_displayTypes == 1 || $recommended_products->RecordCount()>0){ ?>
			<div class="allborder right_small_con margin_t" style="overflow: hidden; width: 207px;">
			<a href="<?php echo $index_categories_banner_2_link; ?>"><?php echo zen_image(DIR_WS_IMAGES.$index_categories_banner_2_img,''); ?></a></div>
<?php
    }
  }
  ?>
<?php
if (!$this_is_home_page && $categories_displayTypes == 1) {
  if(zen_has_category_subcategories($current_category_id)){
    $topSelling_subcategories = array();
    zen_get_subcategories(&$topSelling_subcategories,$current_category_id);
    $topSelling_subcategories_str = implode(' or pt.categories_id = ',$topSelling_subcategories);
    $suffix_sql = ' AND ( pt.categories_id ='.$topSelling_subcategories_str.')';
  }else{
    $suffix_sql = ' AND pt.categories_id = \''.$current_category_id.'\'';
  }
  $topSellingQuery = "SELECT p.`products_id`,p.`products_image`, pd.`products_name` 
                      FROM products p, products_description pd,products_to_categories pt
                      WHERE p.`products_status` = 1 AND pt.products_id=p.products_id AND pd.products_id=p.products_id ".$suffix_sql ."
                      ORDER BY p.`products_ordered` DESC LIMIT 5";
  $topSelling = $db->Execute($topSellingQuery);
?>
<?php if ($topSelling->RecordCount()>0) {?>
<div class="allborder pad_10px margin_t">
<h2 class="red">Top Selling in <?php echo zen_get_categories_name($current_category_id); ?></h2>
<ul class="top_selling">
<?php while (!$topSelling->EOF){ ?>
    <li>
  <a title="<?php echo $topSelling->fields['products_name']; ?>" href="<?php echo zen_href_link(zen_get_info_page($topSelling->fields['products_id']),'products_id='.$topSelling->fields['products_id']) ?>"><?php echo zen_image_OLD(DIR_WS_IMAGES.$topSelling->fields['products_image'],$topSelling->fields['products_name'],42,42,'class="fl"'); ?></a>
  <span><a title="<?php echo $topSelling->fields['products_name']; ?>" href="<?php echo zen_href_link(zen_get_info_page($topSelling->fields['products_id']),'products_id='.$topSelling->fields['products_id']) ?>"><?php echo substr($topSelling->fields['products_name'],0,16).(strlen($topSelling->fields['products_name']) > 16 ? '...': ''); ?></a><br/>
    <strong class="red"><?php echo $currencies->display_price((zen_get_products_base_price($topSelling->fields['products_id']) == 0 ? zen_get_products_sample_price($topSelling->fields['products_id']) : zen_get_products_base_price($topSelling->fields['products_id'])),zen_get_tax_rate($topSelling->fields['products_id'])) ?></strong>
  </span>
</li>
  <?php 
    $topSelling->MoveNext();
    }
    ?>
</ul>
</div>
<?php }
} ?>
<?php if ($categories_displayTypes != 3){ ?>
</div>
<?php } ?>
<div class="clear"></div>
<?php } ?>
<?php
if (!$this_is_home_page && $categories_displayTypes != 1) {
require($template->get_template_dir('tpl_modules_product_listing.php', DIR_WS_TEMPLATE, $current_page_base,'templates'). '/' . 'tpl_modules_product_listing.php');
}
//if (COLUMN_RIGHT_STATUS == 0 || (CUSTOMERS_APPROVAL == '1' and $_SESSION['customer_id'] == '') || (CUSTOMERS_APPROVAL_AUTHORIZATION == 1 && CUSTOMERS_AUTHORIZATION_COLUMN_RIGHT_OFF == 'true' && $_SESSION['customers_authorization'] != 0)) {
if (COLUMN_RIGHT_STATUS == 0 || (CUSTOMERS_APPROVAL == '1' and $_SESSION['customer_id'] == '') || (CUSTOMERS_APPROVAL_AUTHORIZATION == 1 && CUSTOMERS_AUTHORIZATION_COLUMN_RIGHT_OFF == 'true' and ($_SESSION['customers_authorization'] != 0 or $_SESSION['customer_id'] == '')) || !$this_is_home_page) {
  // global disable of column_right
  	 $flag_disable_right = true;
}
if (!isset($flag_disable_right) || !$flag_disable_right) {
?>
<div class="therightframe fr"><?php require(DIR_WS_MODULES . zen_get_module_directory('column_right.php')); ?></div>
<?php
}
?>
</div>

<?php
if($this_is_home_page){
 require($template->get_template_dir('tpl_modules_layer_switch.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_layer_switch.php');
 require($template->get_template_dir('tpl_modules_Shopping_category_row.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_Shopping_category_row.php');
}
?>
<?php
if (!$this_is_home_page) {
	echo '<div class="right_big_con margin_t">';
	?>
<!--bof-banner #5 display -->
<?php
	if (SHOW_BANNERS_GROUP_SET5 != '' && $banner = zen_banner_exists('dynamic', SHOW_BANNERS_GROUP_SET5)) {
    if ($banner->RecordCount() > 0) {
?>
<div class="right_big_con margin_t"><center><?php echo zen_display_banner('static', $banner); ?></center></div>
<?php
    }
  }
?>
<!--eof-banner #5 display -->

<?php	
	echo '</div>';
	echo '<div class="right_big_con margin_t">';
	require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/'.$template_dir.'/related_categories.php'));
	require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/'.$template_dir.'/search_feedback.php'));
	echo '</div>';
	if ($current_bottom_categories_description != ''){
    echo '<div class="right_big_con margin_t allborder"><div class="pad_10px">';
    echo '<h3 class="border_b line_30px">More Info About '.zen_get_category_name($current_category_id,$_SESSION['languages_id']).'</h3>';
		echo $current_bottom_categories_description;
		echo '</div></div>';
	}
	echo '</div>';
}
?>
