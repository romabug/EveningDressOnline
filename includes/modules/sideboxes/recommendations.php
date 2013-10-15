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

  $recommendations_query = "SELECT p.`products_id` FROM products p ORDER BY p.`products_ordered` DESC,p.`products_quantity` DESC LIMIT 6";
  $recommendations = $db->Execute($recommendations_query);
  $recommendationsArray = array();
  if ($recommendations->RecordCount()>0){
  	while (!$recommendations->EOF){
  		$recommendationsArray[] = $recommendations->fields['products_id'];
  		$recommendations->MoveNext();
  	}
  }
	$title_link = false;
	require($template->get_template_dir('tpl_recommendations.php',DIR_WS_TEMPLATE, $current_page_base,'sideboxes'). '/tpl_recommendations.php');
	$title =  BOX_HEADING_RECENTLY_VIEWED;
	require($template->get_template_dir('tpl_recommendations.php', DIR_WS_TEMPLATE, $current_page_base,'common') . '/tpl_recommendations.php');
?>