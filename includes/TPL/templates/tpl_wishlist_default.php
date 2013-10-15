<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=wishlist.<br />
 * Displays conditions page.
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_wishlist_default.php  v1.3 $
 */
	
?>
<?php if(!isset($_GET['letter'])){ ?>
<div class="minframe fl">
<?php
 //require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/box_contact_us.php'));
 require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/ezpages.php'));
 require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/'.$template_dir.'/subscribe.php'));
?>
</div>
<div class="right_big_con margin_t" >
<div id="wishlistMainContent">
<?php
/**
 * require the html_define for the wishlist page
 */
  require($define_page);
?>
</div>

<ul class="center allborder g_t_c margin_t" style="width: 600px; font-size: 13px; padding-bottom: 8px; letter-spacing: 2px;">
<div style="border-bottom: 1px solid rgb(221, 221, 221); height: 8px; margin-bottom: 8px;" class="gray_bg"></div>
<?php
// display productTagList
foreach(range('a', 'z') as $letter) {
    echo '<a target="_top" class="blue b_" href="' . HTTP_SERVER.DIR_WS_CATALOG.'wishlist/'.strtoupper($letter).'/" >'.strtoupper($letter).'</a>  ';
}
echo '<a target="_top" class="blue b_" href="' . HTTP_SERVER.DIR_WS_CATALOG.'wishlist/0-9/" >0-9</a> ';
?> 
</ul>
<?php }else{ ?>
<br class="clear" />
<div class="margin_t">
<ul class="letter_1px g_t_c big line_30px">
<?php
// display productTagList
foreach(range('a', 'z') as $letter) {
    echo '<a href="' . HTTP_SERVER.DIR_WS_CATALOG.'producttags/'.strtoupper($letter).'/" >'.strtoupper($letter).'</a> | ';
}
echo '<a href="' . HTTP_SERVER.DIR_WS_CATALOG.'producttags/0-9/" >0-9</a> ';
?> 
</ul>
<?php
	$producttags_split_sql = "select p.`products_id`,pd.`products_name` from ".TABLE_PRODUCTS." p,".TABLE_PRODUCTS_DESCRIPTION." pd where p.`products_id` = pd.`products_id` AND LEFT(pd.`products_name`,1) LIKE '".strtolower($_GET['letter'])."'";
	//print_r($producttags_split_sql);
	$producttags_split = new splitPageResults($producttags_split_sql, PRODCUTTAGS_LIST_PAGE_SIZE, 'p.products_id', 'page');
	$zco_notifier->notify('NOTIFY_MODULE_PRODUCT_LISTING_RESULTCOUNT', $producttags_split->number_of_rows);
	$producttags = $db->Execute($producttags_split->sql_query);
	//echo $producttags->RecordCount();
?>
<ul class="a_z_grid">
<?php
	if($producttags->RecordCount() > 0){
		while (!$producttags->EOF){
			echo '<li><a href="'.zen_href_link(zen_get_info_page($producttags->fields['products_id']),'cPath=' .zen_get_generated_category_path_rev($_GET['cPath']). '&products_id=' .$producttags->fields['products_id']).'" >'.$producttags->fields['products_name'].'</a>'; 
			$producttags->MoveNext();
		}	
	}else{
		zen_redirect(zen_href_link(FILENAME_DEFINE_PAGE_NOT_FOUND));
	}
?>
</ul>
<?php //print_r(zen_get_all_get_params(array('page', 'info', 'x', 'y'))); ?>
<?php if (($producttags_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3')) ) {
?>
<div class="pages"><?php echo TEXT_RESULT_PAGE . ' ' . $producttags_split->no_current_display_links(200, zen_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></div>
<?php
  }
?>
<div class="clear margine_t"> </div>
<ul class="letter_1px g_t_c big line_30px">
<?php
// display productTagList
foreach(range('a', 'z') as $letter) {
    echo '<a href="' . HTTP_SERVER.DIR_WS_CATALOG.'wishlist/'.strtoupper($letter).'/" >'.strtoupper($letter).'</a> | ';
}
echo '<a href="' . HTTP_SERVER.DIR_WS_CATALOG.'producttags/0-9/" >0-9</a> ';
?> 
</ul>
<?php } ?>

</div>
