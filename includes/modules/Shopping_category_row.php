<?php
/**
 * index category_row.php
 *
 * Prepares the content for displaying a category's sub-category listing in grid format.  
 * Once the data is prepared, it calls the standard tpl_list_box_content template for display.
 *
 * @package page
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: category_row.php 4084 2006-08-06 23:59:36Z drbyte $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

$title = 'Shopping by Categories';

$shopping_categories_query = "select c.categories_id,c.categories_image, cd.categories_name
										 from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd
										 where c.categories_id = cd.categories_id and c.categories_type = 3 
										 and cd.language_id = '" . (int)$_SESSION['languages_id'] . "'
										 order by cd.categories_name, sort_order limit 12";
$shopping_categories = $db->Execute($shopping_categories_query);

$num_categories = $shopping_categories->RecordCount();
$row = 0;
$col = 0;
$list_box_contents = '';
if ($num_categories > 0) {
	reset($shopping_categories->fields);
  while (!$shopping_categories->EOF and !($row == 3)) {
  	$subCatoryString = '';
    if (!$shopping_categories->fields['categories_image']) !$shopping_categories->fields['categories_image'] = 'pixel_trans.gif';
    $cPath_new = zen_get_path($shopping_categories->fields['categories_id']);

    // strip out 0_ from top level cats
    $cPath_new = str_replace('=0_', '=', $cPath_new);

    //    $shopping_categories->fields['products_name'] = zen_get_products_name($shopping_categories->fields['products_id']);
		$subCatoryQuery = 'SELECT c1.`categories_id`, c.`categories_name` FROM categories_description c, categories c1
WHERE c1.categories_id=c.categories_id and parent_id = '.$shopping_categories->fields['categories_id'] .' limit 5';
		$subCatory = $db->Execute($subCatoryQuery);
		while(!$subCatory->EOF){
				$cPath_new = zen_get_path($subCatory->fields['categories_id']);
        $cPath_new = str_replace('=0_', '=', $cPath_new);
				$subCatoryString .= '<a href="'. zen_href_link(FILENAME_DEFAULT, $cPath_new) . '" title="'.SEO_COMMON_KEYWORDS.' '.$subCatory->fields['categories_name'].'">'.zen_clipped_string($subCatory->fields['categories_name']).'</a><br />';
				$subCatory->MoveNext();
		}
		$subCatoryString .= '<a href="' . zen_href_link(FILENAME_DEFAULT, $cPath_new) . '" class="more_product">More wholesale products ></a>';
		
    $list_box_contents[$row][$col] = array('params' => 'class="categoryListBoxContents"',
                                           'text' => '<a href="'. zen_href_link(FILENAME_DEFAULT, $cPath_new) . '"  class="ih fl" title="'.SEO_COMMON_KEYWORDS.' '.$shopping_categories->fields['categories_name'].'">' . zen_image(DIR_WS_IMAGES . $shopping_categories->fields['categories_image'], $shopping_categories->fields['categories_name'], 86, '',' class="fl"') . '</a><div class="block pad_l_90px"><h3><a href="' . zen_href_link(FILENAME_DEFAULT, $cPath_new) . '" title="'.SEO_COMMON_KEYWORDS.' '.$shopping_categories->fields['categories_name'].'">'. $shopping_categories->fields['categories_name'] .'</a></h3>'.$subCatoryString.'</div>');

    $col ++;
    if ($col > (MAX_DISPLAY_CATEGORIES_PER_ROW - 1)) {
      $col = 0;
      $row ++;
    }
    $shopping_categories->MoveNext();
  }
}
?>
