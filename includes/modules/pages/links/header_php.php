<?php
/**
 * Links Submit Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_links_submit_default.php 3.4.0 3/27/2008 Clyde Jones $
 */

  require(DIR_WS_MODULES . 'require_languages.php');
  require(DIR_WS_FUNCTIONS . 'links.php');
// calculate link category path
  if (isset($_GET['lPath'])) {
    $lPath = $_GET['lPath'];
    $current_category_id = $lPath;
    $display_mode = 'links';
  } elseif (isset($_GET['links_id'])) {
    $lPath = zen_get_link_path($GET['links_id']);
  } else {
    $lPath = '';
    $display_mode = 'categories';
  }
  // links breadcrumb
  $link_categories_query = $db->Execute("select link_categories_name from " . TABLE_LINK_CATEGORIES_DESCRIPTION . " where link_categories_id = '" . (int)$lPath . "' and language_id = '" . (int)$_SESSION['languages_id'] . "'");
  if ($display_mode == 'links') {
  $breadcrumb->add(NAVBAR_TITLE, zen_href_link(FILENAME_LINKS, '', 'NONSSL'));
  $breadcrumb->add($link_categories_query->fields['link_categories_name']);
  } else {
  $breadcrumb->add(NAVBAR_TITLE);
  }
// include template specific file name defines
  $define_page = zen_get_file_directory(DIR_WS_LANGUAGES . $_SESSION['language'] . '/html_includes/', FILENAME_DEFINE_LINKS, 'false');
?>