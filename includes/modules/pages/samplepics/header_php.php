<?php
/**
 * supplier Page
 * 
 * @package page
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: header_php.php 1.3 $
 */

  $_SESSION['navigation']->remove_current_page();

  require(DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));

// include template specific file name defines  自定义页面需要


  $define_page = zen_get_file_directory(DIR_WS_LANGUAGES . $_SESSION['language'] . '/html_includes/', FILENAME_DEFINE_SAMPLEPICS, 'false');

  $breadcrumb->add(NAVBAR_TITLE);

?>
