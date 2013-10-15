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
  <tr>
    <td class="pageHeading" colspan="2"><h1><?php echo HEADING_TITLE; ?></h1></td>
  </tr>
<?php
// display order dropdown
  $disp_order_default = FAQ_NEW_LIST_SORT_DEFAULT;
  include(DIR_WS_MODULES . 'faq_listing_display_order.php');
?>
<?php
  $faqs_new_array = array();

//define('SHOW_NEW_FAQS_LIMIT','30');
  switch (true) {
    case (SHOW_NEW_FAQS_LIMIT == '0'):
      $display_limit = '';
      break;
    case (SHOW_NEW_FAQS_LIMIT == '1'):
      $display_limit = " and date_format(p.faqs_date_added, '%Y%m') >= date_format(now(), '%Y%m')";
      break;
    case (SHOW_NEW_FAQS_LIMIT == '30'):
      $display_limit = ' and TO_DAYS(NOW()) - TO_DAYS(p.faqs_date_added) <= 30';
      break;
    case (SHOW_NEW_FAQS_LIMIT == '60'):
      $display_limit = ' and TO_DAYS(NOW()) - TO_DAYS(p.faqs_date_added) <= 60';
      break;
    case (SHOW_NEW_FAQS_LIMIT == '90'):
      $display_limit = ' and TO_DAYS(NOW()) - TO_DAYS(p.faqs_date_added) <= 90';
      break;
    case (SHOW_NEW_FAQS_LIMIT == '120'):
      $display_limit = ' and TO_DAYS(NOW()) - TO_DAYS(p.faqs_date_added) <= 120';
      break;
  }

  $faqs_new_query_raw = "select f.*, fd.*, fcd.faq_categories_name from " . TABLE_FAQS . " f, " . TABLE_FAQS_DESCRIPTION . " fd, " . TABLE_FAQ_CATEGORIES_DESCRIPTION . " fcd, " . TABLE_FAQ_CATEGORIES . " fc " .
                        "where f.faqs_status = '1' and f.faqs_id = fd.faqs_id and fd.language_id = '" . (int)$_SESSION['languages_id'] . "' and f.master_faq_categories_id = fcd.faq_categories_id and f.master_faq_categories_id = fc.faq_categories_id and fc.faq_categories_status='1' " .
						$order_by;

  $faqs_new_split = new splitPageResults($faqs_new_query_raw, MAX_DISPLAY_FAQS_NEW);

  if (($faqs_new_split->number_of_rows > 0) && ((PREV_NEXT_FAQ_BAR_LOCATION == '1') || (PREV_NEXT_FAQ_BAR_LOCATION == '3'))) {
?>
  <tr>
    <td class="pageresults"><?php echo $faqs_new_split->display_count(TEXT_DISPLAY_NUMBER_OF_FAQS_NEW); ?></td>
    <td align="right" class="pageresults"><?php echo TEXT_RESULT_PAGE . ' ' . $faqs_new_split->display_links(MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params(array('page', 'info', 'x', 'y', 'main_page'))); ?></td>
  </tr>
<?php
  }
?>
  <tr>
    <td class="main" colspan="2"><?php include(DIR_WS_MODULES . zen_get_module_directory(FILENAME_FAQS_NEW_LISTING)); ?></td>
  </tr>
<?php
  if (($faqs_new_split->number_of_rows > 0) && ((PREV_NEXT_FAQ_BAR_LOCATION == '2') || (PREV_NEXT_FAQ_BAR_LOCATION == '3'))) {
?>
  <tr>
    <td class="pageresults"><?php echo $faqs_new_split->display_count(TEXT_DISPLAY_NUMBER_OF_FAQS_NEW); ?></td>
    <td align="right" class="pageresults"><?php echo TEXT_RESULT_PAGE . ' ' . $faqs_new_split->display_links(MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params(array('page', 'info', 'x', 'y', 'main_page'))); ?></td>
  </tr>
<?php
  }
?>
</table>
