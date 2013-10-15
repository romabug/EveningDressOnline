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
  $listing_split = new splitPageResults($listing_sql, MAX_DISPLAY_FAQS_LISTING, 'p.faqs_id', 'page');

  for ($col=0, $n=sizeof($column_list); $col<$n; $col++) {
    switch ($column_list[$col]) {
      case 'FAQ_LIST_MODEL':
        $lc_text = TABLE_HEADING_MODEL;
        $lc_align = '';
        break;
      case 'FAQ_LIST_NAME':
        $lc_text = TABLE_HEADING_FAQS;
        $lc_align = '';
        break;
    }

    $list_box_contents[0][$col] = array('align' => $lc_align,
                                    'params' => 'class="leftboxheading" nowrap="nowrap"',
                                    'text' => '&nbsp;' . $lc_text . '&nbsp;');
  }

  if ($listing_split->number_of_rows > 0) {
    $rows = 0;
    $listing = $db->Execute($listing_split->sql_query);
    while (!$listing->EOF) {
      $rows++;

      if (($rows/2) == floor($rows/2)) {
        $list_box_contents[$rows] = array('params' => 'class="productListing-even"');
      } else {
        $list_box_contents[$rows] = array('params' => 'class="productListing-odd"');
      }

      $cur_row = sizeof($list_box_contents) - 1;

      for ($col=0, $n=sizeof($column_list); $col<$n; $col++) {
        $lc_align = '';

        switch ($column_list[$col]) {
          case 'FAQ_LIST_MODEL':
            $lc_align = '';
            $lc_text = '&nbsp;' . $listing->fields['faqs_model'] . '&nbsp;';
            break;
          case 'FAQ_LIST_NAME':
            $lc_align = '';
              $lc_text = '&nbsp;<a href="' . zen_href_link(FILENAME_FAQS, 'fcPath=' . $fcPath . '&faqs_id=' . $listing->fields['faqs_id']) . '">' . $listing->fields['faqs_name'] . '</a>&nbsp;';
                                            
 
            break;
        }

        $list_box_contents[$rows][$col] = array('align' => $lc_align,
                                               'params' => 'class="productListing-data"',
                                               'text'  => $lc_text);
      }
      $listing->MoveNext();
    }
    $error_faq_categories==false;
  } else {
    $list_box_contents = array();

    $list_box_contents[0] = array('params' => 'class="productListing-odd"');
    $list_box_contents[0][] = array('params' => 'class="productListing-data"',
                                   'text' => TEXT_NO_FAQS);

    $error_faq_categories = true;
  }

  require($template->get_template_dir('tpl_modules_faq_listing.php', DIR_WS_TEMPLATE, $current_page_base,'templates'). '/' . 'tpl_modules_faq_listing.php');
?>
