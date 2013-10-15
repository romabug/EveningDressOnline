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
  $title = TABLE_HEADING_FEATURED_FAQS;
  if ( (!isset($new_faqs_faq_category_id)) || ($new_faqs_faq_category_id == '0') ) {
    $featured_faqs_query = "select distinct p.faqs_id, p.faqs_image, pd.faqs_name
                           from " . TABLE_FAQS . " p
                           left join " . TABLE_FEATURED . " f on p.faqs_id = f.faqs_id
                           left join " . TABLE_FAQS_DESCRIPTION . " pd on p.faqs_id = pd.faqs_id
                           where p.faqs_id = f.faqs_id and p.faqs_id = pd.faqs_id and p.faqs_status = '1' and f.status = '1' and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'";
  } else {
    $featured_faqs_query = "select distinct p.faqs_id, p.faqs_image, pd.faqs_name
                           from " . TABLE_FAQS . " p
                           left join " . TABLE_FEATURED . " f on p.faqs_id = f.faqs_id
                           left join " . TABLE_FAQS_DESCRIPTION . " pd on p.faqs_id = pd.faqs_id, " .
                              TABLE_FAQS_TO_FAQ_CATEGORIES . " p2c, " .
                              TABLE_FAQ_CATEGORIES . " c
                           where p.faqs_id = p2c.faqs_id
                           and p2c.faq_categories_id = c.faq_categories_id
                           and c.parent_id = '" . (int)$new_faqs_faq_category_id . "'
                           and p.faqs_id = f.faqs_id and p.faqs_id = pd.faqs_id and p.faqs_status = '1' and f.status = '1' and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'";
  }
  $featured_faqs = $db->ExecuteRandomMulti($featured_faqs_query, MAX_DISPLAY_SEARCH_RESULTS_FEATURED);
  $row = 0;
  $col = 0;
  $list_box_contents = '';
  $num_faqs_count = $featured_faqs->RecordCount();
// show only when 1 or more
  if ($num_faqs_count > 0) {
    if ($num_faqs_count < SHOW_FAQ_INFO_COLUMNS_FEATURED_FAQS) {
      $col_width = 100/$num_faqs_count;
    } else {
      $col_width = 100/SHOW_FAQ_INFO_COLUMNS_FEATURED_FAQS;
    }
    while (!$featured_faqs->EOF) {
      $list_box_contents[$row][$col] = array('align' => 'center',
                                             'params' => 'class="smallText" width="' . $col_width . '%" valign="top"',
                                             'text' => '<a href="' . zen_href_link(zen_get_info_faq_page($featured_faqs->fields['faqs_id']), 'faqs_id=' . $featured_faqs->fields['faqs_id']) . '">' . zen_image(DIR_WS_IMAGES . $featured_faqs->fields['faqs_image'], $featured_faqs->fields['faqs_name'], IMAGE_FEATURED_FAQS_LISTING_WIDTH, IMAGE_FEATURED_FAQS_LISTING_HEIGHT) . '</a><br /><a href="' . zen_href_link(zen_get_info_faq_page($featured_faqs->fields['faqs_id']), 'faqs_id=' . $featured_faqs->fields['faqs_id']) . '">' . $featured_faqs->fields['faqs_name'] . '</a>');
      $col ++;
      if ($col > (SHOW_FAQ_INFO_COLUMNS_FEATURED_FAQS - 1)) {
        $col = 0;
        $row ++;
      }
      $featured_faqs->MoveNextRandom();
    }
    if ($featured_faqs->RecordCount() > 0) {
      if (isset($new_faqs_faq_category_id)) {
        $faq_category_title = zen_get_faq_categories_name((int)$new_faqs_faq_category_id);
        $title =  $title . ($faq_category_title != '' ? ' - ' . $faq_category_title : '');
      } else {
        $title = TABLE_HEADING_FEATURED_FAQS;
      }
      require($template->get_template_dir('tpl_modules_featured_faqs.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_featured_faqs.php');
    }
  }
?>