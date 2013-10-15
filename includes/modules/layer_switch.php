<?php
/**
 * layer_switch at specials_index module
 *
 * @package modules
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: specials_index.php 6424 2007-05-31 05:59:21Z ajeh $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

// initialize vars
//specials
$specials_categories_products_id_list = '';
$specials_list_of_products = '';
$specials_specials_index_query = '';
$specials_display_limit = '';

if ( (($manufacturers_id > 0 && $_GET['filter_id'] == 0) || $_GET['music_genre_id'] > 0 || $_GET['record_company_id'] > 0) || (!isset($new_products_category_id) || $new_products_category_id == '0') ) {
  $specials_index_query = "select p.products_id, p.products_image, pd.products_name, p.master_categories_id
                           from (" . TABLE_PRODUCTS . " p
                           left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id
                           left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id )
                           where p.products_id = s.products_id
                           and p.products_id = pd.products_id
                           and p.products_status = '1' and s.status = 1
                           and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'";
} else {
  // get all products and cPaths in this subcat tree
  $productsInCategory = zen_get_categories_products_list( (($manufacturers_id > 0 && $_GET['filter_id'] > 0) ? zen_get_generated_category_path_rev($_GET['filter_id']) : $cPath), false, true, 0, $display_limit);

  if (is_array($productsInCategory) && sizeof($productsInCategory) > 0) {
    // build products-list string to insert into SQL query
    foreach($productsInCategory as $key => $value) {
      $specials_list_of_products .= $key . ', ';
    }
    $specials_list_of_products = substr($specials_list_of_products, 0, -2); // remove trailing comma
    $specials_index_query = "select distinct p.products_id, p.products_image, pd.products_name, p.master_categories_id
                             from (" . TABLE_PRODUCTS . " p
                             left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id
                             left join " . TABLE_PRODUCTS_DESCRIPTION . " pd on p.products_id = pd.products_id )
                             where p.products_id = s.products_id
                             and p.products_id = pd.products_id
                             and p.products_status = '1' and s.status = '1'
                             and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'
                             and p.products_id in (" . $specials_list_of_products . ")";
  }
}
if ($specials_index_query != '') $specials_index = $db->ExecuteRandomMulti($specials_index_query, '6');

$row = 0;
$col = 0;
$specials_list_box_contents = array();
$specials_title = '';

$num_products_count = ($specials_index_query == '') ? 0 : $specials_index->RecordCount();

// show only when 1 or more
if ($num_products_count > 0) {
  $specials_list_box_contents = array();
  while (!$specials_index->EOF) {
    $products_price = zen_get_products_display_price($specials_index->fields['products_id']);
    if (!isset($productsInCategory[$specials_index->fields['products_id']])) $productsInCategory[$specials_index->fields['products_id']] = zen_get_generated_category_path_rev($specials_index->fields['master_categories_id']);

    $specials_index->fields['products_name'] = strlen(zen_get_products_name($specials_index->fields['products_id'])) > 60 ? substr(zen_get_products_name($specials_index->fields['products_id']),0,60) .'...' :zen_get_products_name($specials_index->fields['products_id']);
    $specials_list_box_contents[$row][$col] = array('params' => '' ,
    'text' => '<div class="relative m_w_90 fl">'.(($specials_index->fields['products_image'] == '' and PRODUCTS_IMAGE_NO_IMAGE_STATUS == 0) ? '' : '<a href="' . zen_href_link(zen_get_info_page($specials_index->fields['products_id']), 'cPath=' . $productsInCategory[$specials_index->fields['products_id']] . '&products_id=' . (int)$specials_index->fields['products_id']) . '" class="ih" >' . zen_image(DIR_WS_IMAGES . $specials_index->fields['products_image'], $specials_index->fields['products_name'], 88, 88,' class="fl"') . '</a>') . '</div><span><a href="' . zen_href_link(zen_get_info_page($specials_index->fields['products_id']), 'cPath=' . $productsInCategory[$specials_index->fields['products_id']] . '&products_id=' . $specials_index->fields['products_id']) . '">' . $specials_index->fields['products_name'] . '</a>' . $products_price.'</span>');

    $col ++;
    if ($col > (SHOW_PRODUCT_INFO_COLUMNS_SPECIALS_PRODUCTS - 1)) {
      $col = 0;
      $row ++;
    }
    $specials_index->MoveNextRandom();
  }

  if ($specials_index->RecordCount() > 0) {
    $specials_title = 'Best Deals';
  }
}

//free

$free_categories_products_id_list = '';
$free_list_of_products = '';
$free_index_query = '';
$free_display_limit = '';

if ( (($manufacturers_id > 0 && $_GET['filter_id'] == 0) || $_GET['music_genre_id'] > 0 || $_GET['record_company_id'] > 0) || (!isset($new_products_category_id) || $new_products_category_id == '0') ) {
  $free_index_query = "select p.products_id, p.products_image, pd.products_name, p.master_categories_id
                           from " . TABLE_PRODUCTS . " p," . TABLE_PRODUCTS_DESCRIPTION . " pd where p.products_id = pd.products_id
                           and p.products_status = '1' and p.product_is_always_free_shipping = '1' and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'";
} else {
  // get all products and cPaths in this subcat tree
  $productsInCategory = zen_get_categories_products_list( (($manufacturers_id > 0 && $_GET['filter_id'] > 0) ? zen_get_generated_category_path_rev($_GET['filter_id']) : $cPath), false, true, 0, $display_limit);

  if (is_array($productsInCategory) && sizeof($productsInCategory) > 0) {
    // build products-list string to insert into SQL query
    foreach($productsInCategory as $key => $value) {
      $free_list_of_products .= $key . ', ';
    }
    $free_list_of_products = substr($free_list_of_products, 0, -2); // remove trailing comma
    $free_index_query = "select distinct p.products_id, p.products_image, pd.products_name, p.master_categories_id
                             from " . TABLE_PRODUCTS . " p , " . TABLE_PRODUCTS_DESCRIPTION . " pd 
                             where p.products_id = pd.products_id and p.products_status = '1' and p.product_is_always_free_shipping = '1'
                             and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'
                             and p.products_id in (" . $free_list_of_products . ")";
  }
}
if ($free_index_query != '') $free_index = $db->ExecuteRandomMulti($free_index_query, '6');

$row = 0;
$col = 0;
$free_list_box_contents = array();
$free_title = '';

$num_products_count = ($free_index_query == '') ? 0 : $free_index->RecordCount();

// show only when 1 or more
if ($num_products_count > 0) {
  $free_list_box_contents = array();
  while (!$free_index->EOF) {
    $products_price = zen_get_products_display_price($free_index->fields['products_id']);
    if (!isset($productsInCategory[$free_index->fields['products_id']])) $productsInCategory[$free_index->fields['products_id']] = zen_get_generated_category_path_rev($free_index->fields['master_categories_id']);

    $free_index->fields['products_name'] = strlen(zen_get_products_name($free_index->fields['products_id']))>60 ? substr(zen_get_products_name($free_index->fields['products_id']),0,60).'...' : zen_get_products_name($free_index->fields['products_id']);
    $free_list_box_contents[$row][$col] = array('params' => '',
    'text' => '<div class="relative m_w_90 fl">'.(($free_index->fields['products_image'] == '' and PRODUCTS_IMAGE_NO_IMAGE_STATUS == 0) ? '' : '<a href="' . zen_href_link(zen_get_info_page($free_index->fields['products_id']), 'cPath=' . $productsInCategory[$free_index->fields['products_id']] . '&products_id=' . (int)$free_index->fields['products_id']) . '" class="ih" >' . zen_image(DIR_WS_IMAGES . $free_index->fields['products_image'], $free_index->fields['products_name'], 88, 88,' class="fl"') . '</a>') . '</div><span><a href="' . zen_href_link(zen_get_info_page($free_index->fields['products_id']), 'cPath=' . $productsInCategory[$free_index->fields['products_id']] . '&products_id=' . $free_index->fields['products_id']) . '">' . $free_index->fields['products_name'] . '</a>' . $products_price.'</span><span class="free_shipping"></span>');

    $col ++;
    if ($col > (SHOW_PRODUCT_INFO_COLUMNS_SPECIALS_PRODUCTS - 1)) {
      $col = 0;
      $row ++;
    }
    $free_index->MoveNextRandom();
  }
}
    $free_title = 'Free Shipping';

// new_products
$categories_products_id_list = '';
$list_of_products = '';
$new_products_query = '';

$display_limit = zen_get_new_date_range();

if ( (($manufacturers_id > 0 && $_GET['filter_id'] == 0) || $_GET['music_genre_id'] > 0 || $_GET['record_company_id'] > 0) || (!isset($new_products_category_id) || $new_products_category_id == '0') ) {
  $new_products_query = "select distinct p.products_id, p.products_image, p.products_tax_class_id, pd.products_name,
                                p.products_date_added, p.products_price, p.products_type, p.master_categories_id
                           from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd
                           where p.products_id = pd.products_id
                           and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'
                           and   p.products_status = 1 " . $display_limit;
} else {
  // get all products and cPaths in this subcat tree
  $productsInCategory = zen_get_categories_products_list( (($manufacturers_id > 0 && $_GET['filter_id'] > 0) ? zen_get_generated_category_path_rev($_GET['filter_id']) : $cPath), false, true, 0, $display_limit);

  if (is_array($productsInCategory) && sizeof($productsInCategory) > 0) {
    // build products-list string to insert into SQL query
    foreach($productsInCategory as $key => $value) {
      $list_of_products .= $key . ', ';
    }
    $list_of_products = substr($list_of_products, 0, -2); // remove trailing comma

    $new_products_query = "select distinct p.products_id, p.products_image, p.products_tax_class_id, pd.products_name,
                                  p.products_date_added, p.products_price, p.products_type, p.master_categories_id
                           from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd
                           where p.products_id = pd.products_id
                           and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'
                           and p.products_id in (" . $list_of_products . ")";
  }
}

if ($new_products_query != '') $new_products = $db->ExecuteRandomMulti($new_products_query, '6');

$row = 0;
$col = 0;
$list_box_contents = array();
$title = '';

$num_products_count = ($new_products_query == '') ? 0 : $new_products->RecordCount();

// show only when 1 or more
if ($num_products_count > 0) {
  while (!$new_products->EOF) {
    $products_price = zen_get_products_display_price($new_products->fields['products_id']);
    if (!isset($productsInCategory[$new_products->fields['products_id']])) $productsInCategory[$new_products->fields['products_id']] = zen_get_generated_category_path_rev($new_products->fields['master_categories_id']);

    $list_box_contents[$row][$col] = array('params' => '',
    'text' => '<div class="relative m_w_90 fl">'.(($new_products->fields['products_image'] == '' and PRODUCTS_IMAGE_NO_IMAGE_STATUS == 0) ? '' : '<a href="' . zen_href_link(zen_get_info_page($new_products->fields['products_id']), 'cPath=' . $productsInCategory[$new_products->fields['products_id']] . '&products_id=' . $new_products->fields['products_id']) . '" class="ih" >' . zen_image(DIR_WS_IMAGES . $new_products->fields['products_image'], $new_products->fields['products_name'], 88, 88,' class="fl"') . '</a>') . '</div><span><a href="' . zen_href_link(zen_get_info_page($new_products->fields['products_id']), 'cPath=' . $productsInCategory[$new_products->fields['products_id']] . '&products_id=' . $new_products->fields['products_id']) . '">' . (strlen($new_products->fields['products_name'])>60 ? substr($new_products->fields['products_name'],0,60).'...':$new_products->fields['products_name']) . '</a>' . $products_price.'</span>');

    $col ++;
    if ($col > (SHOW_PRODUCT_INFO_COLUMNS_NEW_PRODUCTS - 1)) {
      $col = 0;

      $row ++;
    }
    $new_products->MoveNextRandom();
  }
  $zc_show_new_products = true;
}
    $title = 'New Arrivals';
    
?>