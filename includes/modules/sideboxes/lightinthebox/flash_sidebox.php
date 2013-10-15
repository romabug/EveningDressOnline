<?php
/**
 * flash sidebox - allows a sidebox with a flash file to be added to your site
 *
 * @package templateSystem
 * @copyright 2007 Kuroi Web Design (sidebox)
 *@copyright 2008 David Collins (Flash content)
  * @copyright Portions Copyright 2003-2007 Zen Cart Development Team
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: flash_sidebox.php 2008-03-13 David $
  * @version $Id: blank_sidebox.php 2007-05-26 kuroi $
 */

  // test if box should display

	require($template->get_template_dir('tpl_flash_sidebox.php',DIR_WS_TEMPLATE, $current_page_base,'sideboxes'). '/tpl_flash_sidebox.php');
	$title =  false;
	$title_link = false;
	require($template->get_template_dir('tpl_box_flash_single.php', DIR_WS_TEMPLATE, $current_page_base,'common') . '/tpl_box_flash_single.php');
?>