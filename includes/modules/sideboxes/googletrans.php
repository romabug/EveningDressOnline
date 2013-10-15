<?php

/**

 * information sidebox - displays list of general info links, as defined in this file

 *

 * @package templateSystem

 * @copyright Copyright 2003-2006 Zen Cart Development Team

 * @copyright Portions Copyright 2003 osCommerce

 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0

 * @version $Id: information.php 4132 2006-08-14 00:36:39Z drbyte $

 */
require($template->get_template_dir('tpl_googletran.php',DIR_WS_TEMPLATE, $current_page_base,'sideboxes'). '/tpl_googletran.php');
  $title = false;

  $title_link = false;
  require($template->get_template_dir($column_box_default, DIR_WS_TEMPLATE, $current_page_base,'common') . '/' . $column_box_default);

?>

