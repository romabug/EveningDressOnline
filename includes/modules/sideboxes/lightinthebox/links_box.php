<?php
/**
 * Links Box
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_links_box.php 3.4.0 3/27/2008 Clyde Jones $
 */
  $links_query= ("SELECT l.links_id,ld.links_title,l.links_url
                  FROM " . TABLE_LINKS . " AS l Inner Join ".TABLE_LINKS_DESCRIPTION . " AS ld ON l.links_id = ld.links_id 
                  WHERE ld.language_id = '" . (int)$_SESSION['languages_id'] . "'");
  $links = $db->Execute($links_query);
  if ($links->RecordCount()>0) {
    $number_of_rows = $links->RecordCount()+1;
    $links_array = array();
    if ($_GET['links_title'] == '' ) {
    } else {
      $links_array[] = array('id' => '', 'text' => PULL_DOWN_LINKS_MANAGER);
    }
    while (!$links->EOF) {
      //$link_name = ((strlen($links->fields['links_title']) > MAX_DISPLAY_LINK_NAME_LEN) ? substr($links->fields['links_title'], 0, MAX_DISPLAY_LINK_NAME_LEN) . '..' : $links->fields['links_title']);
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
    require($template->get_template_dir('tpl_bottom_link.php', DIR_WS_TEMPLATE, $current_page_base,'common') . '/tpl_bottom_link.php');
  }
?>