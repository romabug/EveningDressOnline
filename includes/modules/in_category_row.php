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

$in_categories_query = "select c.categories_id,c.categories_image, cd.categories_name
										 from " . TABLE_CATEGORIES . " c, " . TABLE_CATEGORIES_DESCRIPTION . " cd
										 where c.categories_id = cd.categories_id 
										 and cd.language_id = '" . (int)$_SESSION['languages_id'] . "' and c.parent_id = '".$current_category_id."'
										 order by cd.categories_name, sort_order";
$in_categories = $db->Execute($in_categories_query);
$num_categories = $in_categories->RecordCount();
$row = 0;
$col = 0;
$list_box_contents = '';
if ($num_categories > 0) {
  if ($num_categories < MAX_DISPLAY_CATEGORIES_PER_ROW || MAX_DISPLAY_CATEGORIES_PER_ROW == 0) {
    $col_width = floor(100/$num_categories);
  } else {
    $col_width = floor(100/MAX_DISPLAY_CATEGORIES_PER_ROW);
  }
  while (!$in_categories->EOF and !($row == 2)) {
  	$subCatoryString = '<dl class="dl_dot">';
    if (!$in_categories->fields['categories_image']) !$in_categories->fields['categories_image'] = 'pixel_trans.gif';
    $cPath_new = zen_get_path($in_categories->fields['categories_id']);

    // strip out 0_ from top level cats
    $cPath_new = str_replace('=0_', '=', $cPath_new);

    //    $in_categories->fields['products_name'] = zen_get_products_name($in_categories->fields['products_id']);
		$subCatoryQuery = 'SELECT c1.`categories_id`, c.`categories_name` FROM categories_description c, categories c1
WHERE c1.categories_id=c.categories_id and parent_id = '.$in_categories->fields['categories_id'] .' limit 5';
		$subCatory = $db->Execute($subCatoryQuery);
		while(!$subCatory->EOF){
				$cPath_new = zen_get_path($subCatory->fields['categories_id']);
        $cPath_new = substr($cPath_new,strrpos($cPath_new,'_')+1);
				$subCatoryString .= '<dt><a href="' . zen_href_link(FILENAME_DEFAULT, 'cPath='.$cPath_new) . '" title="'.SEO_COMMON_KEYWORDS.' '.$subCatory->fields['categories_name'].'">'.$subCatory->fields['categories_name'].'</a></dt>';
				$subCatory->MoveNext();
		}
		$subCatoryString .= '</dl><a href="' . zen_href_link(FILENAME_DEFAULT, 'cPath='.$in_categories->fields['categories_id']) . '" class="more_product"> </a>'; // see all, more product, more products.
		
    $list_box_contents[$row][$col] = array('params' => 'class="categoryListBoxContents"',
                                           'text' => '<div><a href="' . zen_href_link(FILENAME_DEFAULT, 'cPath='.$in_categories->fields['categories_id']) . '" title="'.SEO_COMMON_KEYWORDS.' '.$in_categories->fields['categories_name'].'">' . zen_image(DIR_WS_IMAGES . $in_categories->fields['categories_image'], $in_categories->fields['categories_name'], 148, 148) . '</a></div><h3 class="margin_t line_120 pad_b2"><a href="' . zen_href_link(FILENAME_DEFAULT, 'cPath='.$in_categories->fields['categories_id']) . '" title="'.SEO_COMMON_KEYWORDS.' '.$in_categories->fields['categories_name'].'">'. $in_categories->fields['categories_name'] .'</a></h3>'.$subCatoryString);

    $col ++;
    if ($col > (MAX_DISPLAY_CATEGORIES_PER_ROW -1)) {
      $col = 0;
      $row ++;
    }
    $in_categories->MoveNext();
  }
}
?>
