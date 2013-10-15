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
<table border="0" width="100%" cellspacing="2" cellpadding="2">
<?php if (DEFINE_BREADCRUMB_STATUS == '1' || DEFINE_BREADCRUMB_STATUS == '2' ) { ?>
  <tr>
    <td class="breadCrumb" colspan="2"><?php echo $breadcrumb->trail(BREAD_CRUMBS_SEPARATOR); ?></td>
  </tr>
<?php } ?>
  <tr>
    <td class="pageHeading" colspan="2"><h1><?php echo HEADING_TITLE; ?></h1></td>
  </tr>
<?php
// display order dropdown
  $disp_order_default = FAQ_FEATURED_LIST_SORT_DEFAULT;
  include(DIR_WS_MODULES . 'listing_display_order.php');
?>
<?php
  $featured_faqs_array = array();
  $featured_faqs_query_raw = "select p.*, pd.* from " . TABLE_FAQS . " p, " . TABLE_FAQS_DESCRIPTION . " pd
                                  left join " . TABLE_FEATURED_FAQS . " f on p.faqs_id = f.faqs_id
                                  where p.faqs_status = '1' and p.faqs_id = f.faqs_id and f.status = '1'
                                  and p.faqs_id = pd.faqs_id and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'" . $order_by;
  $featured_faqs_split = new splitPageResults($featured_faqs_query_raw, MAX_DISPLAY_FAQS_FEATURED_FAQS);
  if (($featured_faqs_split->number_of_rows > 0) && ((PREV_NEXT_FAQ_BAR_LOCATION == '1') || (PREV_NEXT_FAQ_BAR_LOCATION == '3'))) {
?>
  <tr>
    <td class="pageresults"><?php echo $featured_faqs_split->display_count(TEXT_DISPLAY_NUMBER_OF_FAQS_FEATURED_FAQS); ?></td>
    <td align="right" class="pageresults"><?php echo TEXT_RESULT_PAGE . ' ' . $featured_faqs_split->display_links(MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params(array('page', 'info', 'x', 'y', 'main_page'))); ?></td>
  </tr>
<?php
  }
?>
  <tr>
    <td class="main" colspan="2"><?php include(DIR_WS_MODULES . zen_get_module_directory(FILENAME_FEATURED_FAQS_LISTING)); ?></td>
  </tr>
<?php
  if (($featured_faqs_split->number_of_rows > 0) && ((PREV_NEXT_FAQ_BAR_LOCATION == '2') || (PREV_NEXT_FAQ_BAR_LOCATION == '3'))) {
?>
  <tr>
    <td class="pageresults"><?php echo $featured_faqs_split->display_count(TEXT_DISPLAY_NUMBER_OF_FAQS_FEATURED_FAQS); ?></td>
    <td align="right" class="pageresults"><?php echo TEXT_RESULT_PAGE . ' ' . $featured_faqs_split->display_links(MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params(array('page', 'info', 'x', 'y', 'main_page'))); ?></td>
  </tr>
<?php
  }
?>
</table>