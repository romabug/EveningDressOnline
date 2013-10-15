<?php
/**
 * best_sellers sidebox - displays selected number of (usu top ten) best selling products
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: best_sellers.php 2718 2005-12-28 06:42:39Z drbyte $
 */

// test if box should display
  if (isset($_COOKIE['recent_viewed']) and $_COOKIE['recent_viewed'] != '') {
    $recent_viewed = explode('_',$_COOKIE['recent_viewed']);
  }else{
  	$recent_viewed = '';
  }
  $show_recently_viewed = (is_array($recent_viewed) && count($recent_viewed) > 0);   
  if ($show_recently_viewed == true) {
		$title_link = false;
		require($template->get_template_dir('tpl_recently_viewed.php',DIR_WS_TEMPLATE, $current_page_base,'sideboxes'). '/tpl_recently_viewed.php');
		$title =  BOX_HEADING_RECENTLY_VIEWED;
		require($template->get_template_dir('tpl_recently_viewed.php', DIR_WS_TEMPLATE, $current_page_base,'common') . '/tpl_recently_viewed.php');
  }
?>
