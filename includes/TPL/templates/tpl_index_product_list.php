<?php
/**
 * Page Template
 *
 * Loaded by main_page=index<br />
 * Displays product-listing when a particular category/subcategory is selected for browsing
 *
 * @package templateSystem
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_index_product_list.php 6009 2007-03-13 23:56:45Z ajeh $
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
<?php if ($current_categories_description != '') {?>
<div id="indexProductListCatDescription" class="content"><?php echo $current_categories_description;  ?></div>
<?php } // categories_description ?>
<?php
/**
 * require the code for listing products
 */
 require($template->get_template_dir('tpl_modules_product_listing.php', DIR_WS_TEMPLATE, $current_page_base,'templates'). '/' . 'tpl_modules_product_listing.php');
?>


<?php
//// bof: categories error
if ($error_categories==true) {
  // verify lost category and reset category
  $check_category = $db->Execute("select categories_id from " . TABLE_CATEGORIES . " where categories_id='" . $cPath . "'");
  if ($check_category->RecordCount() == 0) {
    $new_products_category_id = '0';
    $cPath= '';
    echo 'no products';
  }
?>

<?php } //// eof: categories error ?>
</div>
<?php
if (!$this_is_home_page) {
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
  echo '<div class="right_big_con margin_t">';
	require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/'.$template_dir.'/related_categories.php'));
	require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/'.$template_dir.'/search_feedback.php'));
	echo '</div>';
 if ($current_bottom_categories_description != ''){
    echo '<div class="right_big_con margin_t allborder"><div class="pad_10px">';
    echo '<h3 class="line_1em">More Info About '.zen_get_category_name($current_category_id,$_SESSION['languages_id']).'</h3>';
    echo $current_bottom_categories_description;
    echo '</div></div>';
  }
}
?>