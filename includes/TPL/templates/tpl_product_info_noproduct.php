<?php
/**
 * Page Template
 *
 * Displays simple "product not found" message if the selected product's details cannot be located in the database
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_product_info_noproduct.php 2578 2005-12-15 19:31:34Z drbyte $
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

<div id="productInfoNoProductMainContent" class="content"><?php echo TEXT_PRODUCT_NOT_FOUND; ?></div>

<div class="pad_10px fl"><?php zen_back_link() . zen_image_button(BUTTON_IMAGE_CONTINUE, BUTTON_CONTINUE_ALT) . '</a>'; ?></div>

<?php
//// bof: missing
$show_display_category = $db->Execute(SQL_SHOW_PRODUCT_INFO_MISSING);

while (!$show_display_category->EOF) {
?>

<?php
  if ($show_display_category->fields['configuration_key'] == 'SHOW_PRODUCT_INFO_MISSING_FEATURED_PRODUCTS') {
/**
 * display the featured product center box
 */
    include(DIR_WS_MODULES . zen_get_module_directory(FILENAME_FEATURED_PRODUCTS_MODULE));
  }
?>

<?php
  if ($show_display_category->fields['configuration_key'] == 'SHOW_PRODUCT_INFO_MISSING_SPECIALS_PRODUCTS') {
/**
 * display the special product center box
 */
    include(DIR_WS_MODULES . zen_get_module_directory(FILENAME_SPECIALS_INDEX));
  }
?>

<?php
  if ($show_display_category->fields['configuration_key'] == 'SHOW_PRODUCT_INFO_MISSING_NEW_PRODUCTS') {
/**
 * display the new product center box
 */
    include(DIR_WS_MODULES . zen_get_module_directory(FILENAME_NEW_PRODUCTS));
  }
?>

<?php
  if ($show_display_category->fields['configuration_key'] == 'SHOW_PRODUCT_INFO_MISSING_UPCOMING') {
/**
 * display the upcoming product center box
 */
    include(DIR_WS_MODULES . zen_get_module_directory(FILENAME_UPCOMING_PRODUCTS));
  }
?>
<?php
  $show_display_category->MoveNext();
} //// eof: missing
?>
</div>