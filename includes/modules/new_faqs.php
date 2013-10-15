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
  $title = sprintf(TABLE_HEADING_NEW_FAQS, strftime('%B'));
// display limits
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
  if ( (!isset($new_faqs_faq_category_id)) || ($new_faqs_faq_category_id == '0') ) {
    $new_faqs_query = "select p.*
                           from " . TABLE_FAQS . " p
                           where p.faqs_status = '1' " . $display_limit;
  } else {
    $new_faqs_query = "select distinct p.faqs_id, p.faqs_image, p.faqs_date_added
                           from " . TABLE_FAQS . " p, " . TABLE_FAQS_TO_FAQ_CATEGORIES . " p2c, " .
                              TABLE_FAQ_CATEGORIES . " c
                           where p.faqs_id = p2c.faqs_id
                           and p2c.faq_categories_id = c.faq_categories_id
                           and c.parent_id = '" . (int)$new_faqs_faq_category_id . "'
                           and p.faqs_status = '1' " . $display_limit;
  }
  $new_faqs = $db->ExecuteRandomMulti($new_faqs_query, MAX_DISPLAY_NEW_FAQS);
  $row = 0;
  $col = 0;
  $list_box_contents = '';
  $num_faqs_count = $new_faqs->RecordCount();
// show only when 1 or more
  if ($num_faqs_count > 0) {
    if ($num_faqs_count < SHOW_FAQ_INFO_COLUMNS_NEW_FAQS) {
      $col_width = 100/$num_faqs_count;
    } else {
      $col_width = 100/SHOW_FAQ_INFO_COLUMNS_NEW_FAQS;
    }
    while (!$new_faqs->EOF) {
      $new_faqs->fields['faqs_name'] = zen_get_faqs_name($new_faqs->fields['faqs_id']);
      $list_box_contents[$row][$col] = array('align' => 'center',
                                             'params' => 'class="smallText" width="' . $col_width . '%" valign="top"',
                                             'text' => '<a href="' . zen_href_link(zen_get_info_faq_page($new_faqs->fields['faqs_id']), 'faqs_id=' . $new_faqs->fields['faqs_id']) . '">' . zen_image(DIR_WS_IMAGES . $new_faqs->fields['faqs_image'], $new_faqs->fields['faqs_name'], IMAGE_FAQ_NEW_WIDTH, IMAGE_FAQ_NEW_HEIGHT) . '</a><br /><a href="' . zen_href_link(zen_get_info_faq_page($new_faqs->fields['faqs_id']), 'faqs_id=' . $new_faqs->fields['faqs_id']) . '">' . $new_faqs->fields['faqs_name'] . '</a>');
      $col ++;
      if ($col > (SHOW_FAQ_INFO_COLUMNS_NEW_FAQS - 1)) {
        $col = 0;
        $row ++;
      }
      $new_faqs->MoveNextRandom();
    }
    if ($new_faqs->RecordCount() > 0) {
      if (isset($new_faqs_faq_category_id)) {
        $faq_category_title = zen_get_faq_categories_name((int)$new_faqs_faq_category_id);
        $title = sprintf(TABLE_HEADING_NEW_FAQS, strftime('%B')) . ($faq_category_title != '' ? ' - ' . $faq_category_title : '' );
      } else {
        $title = sprintf(TABLE_HEADING_NEW_FAQS, strftime('%B'));
      }
      require($template->get_template_dir('tpl_modules_whats_new.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_whats_new.php');
    }
  }
?>