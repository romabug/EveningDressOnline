<?php
/**
 * categories sidebox - prepares content for the main categories sidebox
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: categories.php 2718 2005-12-28 06:42:39Z drbyte $
 */
		
    $row = 0;
    $priceListArray = array();
    $priceList = array();

// don't build a tree when no categories
    require($template->get_template_dir('tpl_root_categories.php',DIR_WS_TEMPLATE, $current_page_base,'sideboxes'). '/tpl_root_categories.php');

    $title = BOX_HEADING_CATEGORIES_BOX;
		$subtitle = BOX_SUBHEADING_CATEGORIES_BOX;
    $title_link = false;
    
    require($template->get_template_dir('tpl_box_root_categories.php', DIR_WS_TEMPLATE, $current_page_base,'common') . '/tpl_box_root_categories.php');
?>