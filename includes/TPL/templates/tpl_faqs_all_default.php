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
// $Id: faq_manager.php 001 2005-03-27 dave@open-operations.com
//
?>

<div class="minframe fl">
<?php
 require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/'.$template_dir.'/box_contact_us.php'));
 require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/faq_categories_css.php'));
?>
</div>
<?php if ($current_faq_category_id != 0){ ?>
<div class="fl midframe flow margin_t" style="padding-left: 10px;">
<?php }else{ ?>
<div class="bg_box_gray margin_t right_big_con">
<?php } ?>
<h2 class="border_b"><?php echo HEADING_TITLE; ?></h2>

<?php
	$faqs_all_array = array();
	if($current_faq_category_id != 0){
  $faqs_all_query_raw = "select f.*, fd.*, fcd.faq_categories_name from " . TABLE_FAQS . " f, " . TABLE_FAQS_DESCRIPTION . " fd, " . TABLE_FAQ_CATEGORIES_DESCRIPTION . " fcd, " . TABLE_FAQ_CATEGORIES . " fc " .
                        "where f.faqs_status = '1' and f.faqs_id = fd.faqs_id and fd.language_id = '" . (int)$_SESSION['languages_id'] . "' and f.master_faq_categories_id = fcd.faq_categories_id and f.master_faq_categories_id = fc.faq_categories_id and fc.faq_categories_status='1' and fc.faq_categories_id = '".$current_faq_category_id."'";
	}else{
  $faqs_all_query_raw = "select f.*, fd.*, fcd.faq_categories_name from " . TABLE_FAQS . " f, " . TABLE_FAQS_DESCRIPTION . " fd, " . TABLE_FAQ_CATEGORIES_DESCRIPTION . " fcd, " . TABLE_FAQ_CATEGORIES . " fc " .
                        "where f.faqs_status = '1' and f.faqs_id = fd.faqs_id and fd.language_id = '" . (int)$_SESSION['languages_id'] . "' and f.master_faq_categories_id = fcd.faq_categories_id and f.master_faq_categories_id = fc.faq_categories_id and fc.faq_categories_status='1' order by fc.sort_order, f.faqs_sort_order";
	}
  $faqs_all_split = new splitPageResults($faqs_all_query_raw,MAX_DISPLAY_FAQS_ALL);
  if (($faqs_all_split->number_of_rows > 0) && ((PREV_NEXT_FAQ_BAR_LOCATION == '1') || (PREV_NEXT_FAQ_BAR_LOCATION == '3'))) {
?>

<?php
  }
?>
<?php
	if($current_faq_category_id != 0){
		require(DIR_WS_MODULES . zen_get_module_directory(FILENAME_FAQS_ALL_LISTING));
	}else{
		require(DIR_WS_MODULES . zen_get_module_directory(FILENAME_FAQS_TWOROW_LISTING));
	}
?>

<?php
  if ($faqs_all_split->number_of_rows > 0) {
?>
  <div class="clear">
    <span class="fl"><?php echo $faqs_all_split->display_count(TEXT_DISPLAY_NUMBER_OF_FAQS_ALL); ?></span>
    <span id="faq_pages" class="fr"><?php echo TEXT_RESULT_PAGE . ' ' . $faqs_all_split->display_links(MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params(array('page', 'info', 'x', 'y', 'main_page'))); ?></span>
  </div>
<?php
  }
?>
</div>
<?php if ($current_faq_category_id != 0){ ?>
<div class="therightframe fr margin_t">
<?php
 require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/ezpages.php'));
 require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/'.$template_dir.'/customers_say.php'));
?>
</div>
<?php } ?>