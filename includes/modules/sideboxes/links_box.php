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
//  Original contrib by Vijay Immanuel for osCommerce, converted to zen by dave@open-operations.com - http://www.open-operations.com
//  $Id: links_manager.php 2004-11-19 dave@open-operations.com
//
  $links_query= ("SELECT l.links_id,ld.links_title,l.links_url
                  FROM " . TABLE_LINKS . " links AS l Inner Join ".TABLE_LINKS_DESCRIPTION . " AS ld ON l.links_id = ld.links_id 
                  WHERE ld.language_id = '" . (int)$_SESSION['languages_id'] . "' order by l.links_rating ");
  $links = $db->Execute($links_query);
  if ($links->RecordCount()>0) {
    $number_of_rows = $links->RecordCount()+1;
    $links_array = array();
    if ($_GET['links_title'] == '' ) {
    } else {
      $links_array[] = array('id' => '', 'text' => PULL_DOWN_LINKS_MANAGER);
    }
    while (!$links->EOF) {
      //$link_categories_name = ((strlen($links->fields['links_title']) > MAX_DISPLAY_LINK_NAME_LEN) ? substr($links->fields['links_title'], 0, MAX_DISPLAY_LINK_NAME_LEN) . '..' : $links->fields['links_title']);
      $links_array[] = array('id' => $links->fields['links_id'],
                             'text' => $links->fields['links_title'],
                             'link' => $links->fields['links_url']);
      $links->MoveNext();
    }
      require($template->get_template_dir('tpl_links_select.php',DIR_WS_TEMPLATE, $current_page_base,'sideboxes'). '/tpl_links_select.php');
    $title =  BOX_HEADING_LINK_CATEGORIES;
    $left_corner = false;
    $right_corner = false;
    $right_arrow = false;
    $title_link = false;
    require($template->get_template_dir($column_box_default, DIR_WS_TEMPLATE, $current_page_base,'common') . '/' . $column_box_default);
  }
?>