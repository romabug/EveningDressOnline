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
$order_by = " order by c.sort_order, cd.faq_categories_name ";
  $faq_categories_tab_query = "select c.faq_categories_id, cd.faq_categories_name from " .
                          TABLE_FAQ_CATEGORIES . " c, " . TABLE_FAQ_CATEGORIES_DESCRIPTION . " cd
                          where c.faq_categories_id=cd.faq_categories_id and c.parent_id= '0' and cd.language_id='" . $_SESSION['languages_id'] . "' and c.faq_categories_status='1'" .
                          $order_by;
  $faq_categories_tab = $db->Execute($faq_categories_tab_query);
  while (!$faq_categories_tab->EOF) {
   // currently selected faq_category
    if ((int)$fcPath == $faq_categories_tab->fields['faq_categories_id']) {
      $new_style = 'faq_category-top';
      $faq_categories_tab_current = '<span class="product_category-subs-selected">' . $faq_categories_tab->fields['faq_categories_name'] . '</span>';
    } else {
      $new_style = 'faq_category-top';
      $faq_categories_tab_current = $faq_categories_tab->fields['faq_categories_name'];
    }
    // create link to top level faq_category
    $link = '<a class="' . $new_style . '" href="' . zen_href_link(FILENAME_FAQS, 'fcPath=' . (int)$faq_categories_tab->fields['faq_categories_id']) . '">' . $faq_categories_tab_current . '</a> ';
    echo $link;
    $faq_categories_tab->MoveNext();
  }
?>