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
    require($template->get_template_dir('tpl_categories.php',DIR_WS_TEMPLATE, $current_page_base,'sideboxes'). '/tpl_categories.php');

    $title = BOX_HEADING_CATEGORIES_BOX;
		$subtitle = BOX_SUBHEADING_CATEGORIES_BOX;
    $title_link = false;
    
/*
 * priceList  four part
 */
	    if(zen_has_category_subcategories($current_category_id)){
		    $priceListQuery_sql = '';
			  $priceListQueryArray = array();
			  zen_get_subcategories(&$product_in_categoriesArray,$current_category_id);
			  $priceListQuery_sql = implode(' or p2c.categories_id =',$product_in_categoriesArray);
			  $priceListQuery_sql = '( p2c.categories_id = '.$priceListQuery_sql.')';
	    }else{
	    	$priceListQuery_sql = 'p2c.categories_id = ' . (int)$current_category_id;
	    }
	    $priceListQuery = "SELECT p.`products_price`,p2c.`categories_id` FROM products p,products_to_categories p2c WHERE p2c.products_id=p.products_id AND ". $priceListQuery_sql ." order by products_price";    
	    $priceListArray = $db->Execute($priceListQuery);
	    
	    while (!$priceListArray->EOF){
	    	$priceList[] = $priceListArray->fields['products_price'];
	    	$priceListArray->MoveNext();
	    }
	    $priceListOutString = '';
	    $totalNum = sizeof($priceList);
	    if ($totalNum <= 5){
	      $priceListRowNum = 1;
	    }elseif ( 5 < $totalNum and $totalNum <= 15){
	      $priceListRowNum = 2;   
	    }elseif (15 < $totalNum and $totalNum <= 25){
	      $priceListRowNum = 3;
	    }elseif (25 < $totalNum and $totalNum <= 35){
	      $priceListRowNum = 4;
	    }elseif ($totalNum >= 35){
	      $priceListRowNum = 5;
	    }
	    for ($i=0; $i<$priceListRowNum; $i++){
	     $priceListOutString .= '<li>';
	     $priceListOutString .= '<a href="'.zen_href_link(FILENAME_DEFAULT, 'cPath='.$current_category_id.'&min_price='.floor($priceList[sizeof($priceList)*$i/$priceListRowNum])).'&max_price='.floor($priceList[sizeof($priceList)*($i+1)/$priceListRowNum-1]).'">';
	     $priceListOutString .= $currencies->display_price($priceList[sizeof($priceList)*$i/$priceListRowNum],zen_get_tax_rate($_GET['products_tax_class_id'])).' - '.$currencies->display_price($priceList[sizeof($priceList)*($i+1)/$priceListRowNum-1],zen_get_tax_rate($_GET['products_tax_class_id']));   	
	     $priceListOutString .= '</a>';
	     $priceListOutString .= '</li>';
	    }
			unset($priceListQuery,$priceListQuery_sql);
    require($template->get_template_dir('tpl_box_categories.php', DIR_WS_TEMPLATE, $current_page_base,'common') . '/tpl_box_categories.php');
?>