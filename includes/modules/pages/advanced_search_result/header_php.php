<?php
/**
 * Header code file for the Advanced Search Results page
 *
 * @package page
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: header_php.php 7160 2007-10-02 08:46:34Z drbyte $
 * @edited for whole word search: 2008-05-09 15:32:00 Nirmal Natarajan
 */

// This should be first line of the script:
$zco_notifier->notify('NOTIFY_HEADER_START_ADVANCED_SEARCH_RESULTS');

if (!defined('KEYWORD_FORMAT_STRING')) define('KEYWORD_FORMAT_STRING','keywords');

require(DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));
$error = false;
$missing_one_input = false;

  /*------------------------------------------------------*/
  $productsort = array();
  $nsort = array('Bestselling','Item Name','Price(Low to high)','Price(High to low)','New Arrival');
  
  for ($i=1; $i<6; $i++) {
     $productsort[] = array('id' => sprintf('%2d', $i), 'text' =>$nsort[$i-1]  );
  }
  $pagesize = array();
  $pagesize[] = array('id'=>24,'text'=>24);
  $pagesize[] = array('id'=>36,'text'=>36);
  $pagesize[] = array('id'=>48,'text'=>48);
  
  if(isset($_GET['productsort']) && (int)$_GET['productsort'] > 0){
    switch ($_GET['productsort']){
      case 2:
        $product_sort = " order by pd.products_name ";
        break;
      case 3:
        $product_sort = " order by p.products_price";
        break;
      case 4:
        $product_sort = " order by p.products_price DESC";
        break;
      case 5:
        $product_sort = " order by p.products_date_added DESC";
        break;
      default:
        $product_sort = " order by p.products_ordered DESC";
    }
  }
  
  //print_r($_SERVER['QUERY_STRING']);
  $display = isset($_GET['display'])? $_GET['display']: '1';
  $listTypes = isset($_GET['listtypes']) ? $_GET['listtypes'] : 1;
  if(isset($display)){
	   switch ($display){
	    case '2':
	      $displayOrder = ' and p.`product_is_wholesale` = 1';  
	      break;
	    case '3':
	      $displayOrder = ' and p.`product_is_always_free_shipping` = 1';
	      break;
	    default:
	      $displayOrder = '';
	   }
  }  
  /*------------------------------------------------------*/
  if (isset($_GET['min_price']) && isset($_GET['max_price'])){
  	$pricefilter = " and p.`products_price` >= ".$_GET['min_price'] ." and p.`products_price` <= " . $_GET['max_price'];
  }
  
$_GET['keyword'] = trim($_GET['keyword']);

if ( (isset($_GET['keyword']) && (empty($_GET['keyword']) || $_GET['keyword']==HEADER_SEARCH_DEFAULT_TEXT || $_GET['keyword'] == KEYWORD_FORMAT_STRING ) ) &&
(isset($_GET['dfrom']) && (empty($_GET['dfrom']) || ($_GET['dfrom'] == DOB_FORMAT_STRING))) &&
(isset($_GET['dto']) && (empty($_GET['dto']) || ($_GET['dto'] == DOB_FORMAT_STRING))) &&
(isset($_GET['pfrom']) && !is_numeric($_GET['pfrom'])) &&
(isset($_GET['pto']) && !is_numeric($_GET['pto'])) ) {
  $error = true;
  $missing_one_input = true;
  $messageStack->add_session('search', ERROR_AT_LEAST_ONE_INPUT);
} else {
  $dfrom = '';
  $dto = '';
  $pfrom = '';
  $pto = '';
  $keywords = '';

  if (isset($_GET['dfrom'])) {
    $dfrom = (($_GET['dfrom'] == DOB_FORMAT_STRING) ? '' : $_GET['dfrom']);
  }

  if (isset($_GET['dto'])) {
    $dto = (($_GET['dto'] == DOB_FORMAT_STRING) ? '' : $_GET['dto']);
  }

  if (isset($_GET['pfrom'])) {
    $pfrom = $_GET['pfrom'];
  }

  if (isset($_GET['pto'])) {
    $pto = $_GET['pto'];
  }

  if (isset($_GET['keyword']) && $_GET['keyword'] != HEADER_SEARCH_DEFAULT_TEXT  && $_GET['keyword'] != KEYWORD_FORMAT_STRING) {
    $keywords = $_GET['keyword'];
  }

  $date_check_error = false;
  if (zen_not_null($dfrom)) {
    if (!zen_checkdate($dfrom, DOB_FORMAT_STRING, $dfrom_array)) {
      $error = true;
      $date_check_error = true;

      $messageStack->add_session('search', ERROR_INVALID_FROM_DATE);
    }
  }

  if (zen_not_null($dto)) {
    if (!zen_checkdate($dto, DOB_FORMAT_STRING, $dto_array)) {
      $error = true;
      $date_check_error = true;

      $messageStack->add_session('search', ERROR_INVALID_TO_DATE);
    }
  }

  if (($date_check_error == false) && zen_not_null($dfrom) && zen_not_null($dto)) {
    if (mktime(0, 0, 0, $dfrom_array[1], $dfrom_array[2], $dfrom_array[0]) > mktime(0, 0, 0, $dto_array[1], $dto_array[2], $dto_array[0])) {
      $error = true;

      $messageStack->add_session('search', ERROR_TO_DATE_LESS_THAN_FROM_DATE);
    }
  }

  $price_check_error = false;
  if (zen_not_null($pfrom)) {
    if (!settype($pfrom, 'float')) {
      $error = true;
      $price_check_error = true;

      $messageStack->add_session('search', ERROR_PRICE_FROM_MUST_BE_NUM);
    }
  }

  if (zen_not_null($pto)) {
    if (!settype($pto, 'float')) {
      $error = true;
      $price_check_error = true;

      $messageStack->add_session('search', ERROR_PRICE_TO_MUST_BE_NUM);
    }
  }

  if (($price_check_error == false) && is_float($pfrom) && is_float($pto)) {
    if ($pfrom >= $pto) {
      $error = true;

      $messageStack->add_session('search', ERROR_PRICE_TO_LESS_THAN_PRICE_FROM);
    }
  }

  if (zen_not_null($keywords)) {
    if (!zen_parse_search_string($keywords, $search_keywords)) {
      $error = true;

      $messageStack->add_session('search', ERROR_INVALID_KEYWORDS);
    }
  }
}

if (empty($dfrom) && empty($dto) && empty($pfrom) && empty($pto) && empty($keywords)) {
  $error = true;
  // redundant should be able to remove this
  if (!$missing_one_input) {
    $messageStack->add_session('search', ERROR_AT_LEAST_ONE_INPUT);
  }
}

if ($error == true) {

  zen_redirect(zen_href_link(FILENAME_ADVANCED_SEARCH, zen_get_all_get_params(), 'NONSSL', true, false));
}


$define_list = array('PRODUCT_LIST_MODEL' => PRODUCT_LIST_MODEL,
                     'PRODUCT_LIST_NAME' => PRODUCT_LIST_NAME,
                     'PRODUCT_LIST_MANUFACTURER' => PRODUCT_LIST_MANUFACTURER,
                     'PRODUCT_LIST_PRICE' => PRODUCT_LIST_PRICE,
                     'PRODUCT_LIST_QUANTITY' => PRODUCT_LIST_QUANTITY,
                     'PRODUCT_LIST_WEIGHT' => PRODUCT_LIST_WEIGHT,
                     'PRODUCT_LIST_IMAGE' => PRODUCT_LIST_IMAGE);

asort($define_list);

$column_list = array();
reset($define_list);
while (list($column, $value) = each($define_list)) {
  if ($value) $column_list[] = $column;
}

$select_column_list = '';

for ($col=0, $n=sizeof($column_list); $col<$n; $col++) {
  if (($column_list[$col] == 'PRODUCT_LIST_NAME') || ($column_list[$col] == 'PRODUCT_LIST_PRICE')) {
    continue;
  }

  if (zen_not_null($select_column_list)) {
    $select_column_list .= ', ';
  }

  switch ($column_list[$col]) {
    case 'PRODUCT_LIST_MODEL':
    $select_column_list .= 'p.products_model';
    break;
    case 'PRODUCT_LIST_MANUFACTURER':
    $select_column_list .= 'm.manufacturers_name';
    break;
    case 'PRODUCT_LIST_QUANTITY':
    $select_column_list .= 'p.products_quantity';
    break;
    case 'PRODUCT_LIST_IMAGE':
    $select_column_list .= 'p.products_image';
    break;
    case 'PRODUCT_LIST_WEIGHT':
    $select_column_list .= 'p.products_weight';
    break;
  }
}
/*
// always add quantity regardless of whether or not it is in the listing for add to cart buttons
if (PRODUCT_LIST_QUANTITY < 1) {
  $select_column_list .= ', p.products_quantity ';
}
*/

// always add quantity regardless of whether or not it is in the listing for add to cart buttons
if (PRODUCT_LIST_QUANTITY < 1) {
  if (empty($select_column_list)) {
    $select_column_list .= ' p.products_quantity ';
  } else  {
    $select_column_list .= ', p.products_quantity ';
  }
}

if (zen_not_null($select_column_list)) {
  $select_column_list .= ', ';
}

// Notifier Point
$zco_notifier->notify('NOTIFY_SEARCH_COLUMNLIST_STRING');


//  $select_str = "select distinct " . $select_column_list . " m.manufacturers_id, p.products_id, pd.products_name, p.products_price, p.products_tax_class_id, IF(s.status = 1, s.specials_new_products_price, NULL) as specials_new_products_price, IF(s.status = 1, s.specials_new_products_price, p.products_price) as final_price ";
$select_str = "SELECT DISTINCT " . $select_column_list .
              " m.manufacturers_id, p.products_id, pd.products_name, p.products_price, p.product_is_wholesale, p.product_is_always_free_shipping,p.products_quantity_order_min, p.products_tax_class_id, p.products_price_sorter, p.products_qty_box_status, p.master_categories_id ";

if ((DISPLAY_PRICE_WITH_TAX == 'true') && ((isset($_GET['pfrom']) && zen_not_null($_GET['pfrom'])) || (isset($_GET['pto']) && zen_not_null($_GET['pto'])))) {
  $select_str .= ", SUM(tr.tax_rate) AS tax_rate ";
}

// Notifier Point
$zco_notifier->notify('NOTIFY_SEARCH_SELECT_STRING');


//  $from_str = "from " . TABLE_PRODUCTS . " p left join " . TABLE_MANUFACTURERS . " m using(manufacturers_id), " . TABLE_PRODUCTS_DESCRIPTION . " pd left join " . TABLE_SPECIALS . " s on p.products_id = s.products_id, " . TABLE_CATEGORIES . " c, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c";
$from_str = "FROM (" . TABLE_PRODUCTS . " p
             LEFT JOIN " . TABLE_MANUFACTURERS . " m
             USING(manufacturers_id), " . TABLE_PRODUCTS_DESCRIPTION . " pd, " . TABLE_CATEGORIES . " c, " . TABLE_PRODUCTS_TO_CATEGORIES . " p2c )
             LEFT JOIN " . TABLE_META_TAGS_PRODUCTS_DESCRIPTION . " mtpd
             ON mtpd.products_id= p2c.products_id
             AND mtpd.language_id = :languagesID";

$from_str = $db->bindVars($from_str, ':languagesID', $_SESSION['languages_id'], 'integer');

if ((DISPLAY_PRICE_WITH_TAX == 'true') && ((isset($_GET['pfrom']) && zen_not_null($_GET['pfrom'])) || (isset($_GET['pto']) && zen_not_null($_GET['pto'])))) {
  if (!$_SESSION['customer_country_id']) {
    $_SESSION['customer_country_id'] = STORE_COUNTRY;
    $_SESSION['customer_zone_id'] = STORE_ZONE;
  }
  $from_str .= " LEFT JOIN " . TABLE_TAX_RATES . " tr
                 ON p.products_tax_class_id = tr.tax_class_id
                 LEFT JOIN " . TABLE_ZONES_TO_GEO_ZONES . " gz
                 ON tr.tax_zone_id = gz.geo_zone_id
                 AND (gz.zone_country_id IS null OR gz.zone_country_id = 0 OR gz.zone_country_id = :zoneCountryID)
                 AND (gz.zone_id IS null OR gz.zone_id = 0 OR gz.zone_id = :zoneID)";

  $from_str = $db->bindVars($from_str, ':zoneCountryID', $_SESSION['customer_country_id'], 'integer');
  $from_str = $db->bindVars($from_str, ':zoneID', $_SESSION['customer_zone_id'], 'integer');
}

// Notifier Point
$zco_notifier->notify('NOTIFY_SEARCH_FROM_STRING');

$where_str = " WHERE (p.products_status = 1
               AND p.products_id = pd.products_id
               AND pd.language_id = :languagesID
               AND p.products_id = p2c.products_id
               AND p2c.categories_id = c.categories_id ".$displayOrder.$pricefilter;
$where_str2 = " WHERE (p.products_status = 1
               AND p.products_id = pd.products_id
               AND pd.language_id = :languagesID
               AND p.products_id = p2c.products_id
               AND p2c.categories_id = c.categories_id ".$displayOrder;
$where_str = $db->bindVars($where_str, ':languagesID', $_SESSION['languages_id'], 'integer');
$where_str2 = $db->bindVars($where_str2, ':languagesID', $_SESSION['languages_id'], 'integer');
// reset previous selection
if (!isset($_GET['inc_subcat'])) {
  $_GET['inc_subcat'] = '0';
}
if (!isset($_GET['search_in_description'])) {
  $_GET['search_in_description'] = '0';
}

if (isset($_GET['categories_id']) && zen_not_null($_GET['categories_id'])) {
  if ($_GET['inc_subcat'] == '1') {
    $subcategories_array = array();
    zen_get_subcategories($subcategories_array, $_GET['categories_id']);
    $where_str .= " AND p2c.products_id = p.products_id
                    AND p2c.products_id = pd.products_id
                    AND (p2c.categories_id = :categoriesID";
    $where_str2 .= " AND p2c.products_id = p.products_id
                    AND p2c.products_id = pd.products_id
                    AND (p2c.categories_id = :categoriesID";
    $where_str = $db->bindVars($where_str, ':categoriesID', $_GET['categories_id'], 'integer');
    $where_str2 = $db->bindVars($where_str2, ':categoriesID', $_GET['categories_id'], 'integer');
    for ($i=0, $n=sizeof($subcategories_array); $i<$n; $i++ ) {
      $where_str .= " OR p2c.categories_id = :categoriesID";
      $where_str2 .= " OR p2c.categories_id = :categoriesID";
      $where_str = $db->bindVars($where_str, ':categoriesID', $subcategories_array[$i], 'integer');
      $where_str2 = $db->bindVars($where_str2, ':categoriesID', $subcategories_array[$i], 'integer');
    }
    $where_str .= ")";
    $where_str2 .= ")";
  } else {
    $where_str .= " AND p2c.products_id = p.products_id
                    AND p2c.products_id = pd.products_id
                    AND pd.language_id = :languagesID
                    AND p2c.categories_id = :categoriesID";
    $where_str2 .= " AND p2c.products_id = p.products_id
                    AND p2c.products_id = pd.products_id
                    AND pd.language_id = :languagesID
                    AND p2c.categories_id = :categoriesID";
    $where_str = $db->bindVars($where_str, ':categoriesID', $_GET['categories_id'], 'integer');
    $where_str2 = $db->bindVars($where_str, ':categoriesID', $_GET['categories_id'], 'integer');
    $where_str = $db->bindVars($where_str, ':languagesID', $_SESSION['languages_id'], 'integer');
    $where_str2 = $db->bindVars($where_str, ':languagesID', $_SESSION['languages_id'], 'integer');
  }
}

if (isset($_GET['manufacturers_id']) && zen_not_null($_GET['manufacturers_id'])) {
  $where_str .= " AND m.manufacturers_id = :manufacturersID";
  $where_str2 .= " AND m.manufacturers_id = :manufacturersID";
  $where_str = $db->bindVars($where_str, ':manufacturersID', $_GET['manufacturers_id'], 'integer');
  $where_str2 = $db->bindVars($where_str2, ':manufacturersID', $_GET['manufacturers_id'], 'integer');
}

if (isset($keywords) && zen_not_null($keywords)) {
  if (zen_parse_search_string(stripslashes($_GET['keyword']), $search_keywords)) {
    $where_str .= " AND (";
    $where_str2 .= " AND (";
    for ($i=0, $n=sizeof($search_keywords); $i<$n; $i++ ) {
      switch ($search_keywords[$i]) {
        case '(':
        case ')':
        case 'and':
        case 'or':
        $where_str .= " " . $search_keywords[$i] . " ";
        $where_str2 .= " " . $search_keywords[$i] . " ";
        break;
        default:
        $where_str .= "(MATCH(pd.products_name) AGAINST ('%:keywords%' IN BOOLEAN MODE)
                                         OR p.products_model
                                         LIKE '%:keywords%'
                                         OR m.manufacturers_name
                                         LIKE '%:keywords%'";
        $where_str2 .= "(MATCH(pd.products_name) AGAINST ('%:keywords%' IN BOOLEAN MODE)
                                         OR p.products_model
                                         LIKE '%:keywords%'
                                         OR m.manufacturers_name
                                         LIKE '%:keywords%'";
        $where_str = $db->bindVars($where_str, ':keywords', $search_keywords[$i], 'noquotestring');
        $where_str2 = $db->bindVars($where_str2, ':keywords', $search_keywords[$i], 'noquotestring');
        // search meta tags
        $where_str .= " OR (mtpd.metatags_keywords
                        LIKE '%:keywords%'
                        AND mtpd.metatags_keywords !='')";
        $where_str2 .= " OR (mtpd.metatags_keywords
                        LIKE '%:keywords%'
                        AND mtpd.metatags_keywords !='')";
        $where_str = $db->bindVars($where_str, ':keywords', $search_keywords[$i], 'noquotestring');
        $where_str2 = $db->bindVars($where_str2, ':keywords', $search_keywords[$i], 'noquotestring');
        $where_str .= " OR (mtpd.metatags_description
                        LIKE '%:keywords%'
                        AND mtpd.metatags_description !='')";
        $where_str2 .= " OR (mtpd.metatags_description
                        LIKE '%:keywords%'
                        AND mtpd.metatags_description !='')";
        $where_str = $db->bindVars($where_str, ':keywords', $search_keywords[$i], 'noquotestring');
        $where_str2 = $db->bindVars($where_str2, ':keywords', $search_keywords[$i], 'noquotestring');
        if (isset($_GET['search_in_description']) && ($_GET['search_in_description'] == '1')) {
          $where_str .= " OR MATCH(pd.products_description) AGAINST ('%:keywords%' IN BOOLEAN MODE)";
          $where_str2 .= " OR MATCH(pd.products_description) AGAINST ('%:keywords%' IN BOOLEAN MODE)";
          $where_str = $db->bindVars($where_str, ':keywords', $search_keywords[$i], 'noquotestring');
          $where_str2 = $db->bindVars($where_str2, ':keywords', $search_keywords[$i], 'noquotestring');
        }
        $where_str .= ')';
        $where_str2 .= ')';
        break;
      }
    }
    $where_str .= " ))";
    $where_str2 .= " ))";
  }
}
if (!isset($keywords) || $keywords == "") {
  $where_str .= ')';
  $where_str2 .= ')';
}

//die('I SEE ' . $where_str);


$listing_sql = $select_str . $from_str . $where_str . $product_sort;
$listing_sql2 = $select_str . $from_str . $where_str2 . $product_sort;
// Notifier Point
$zco_notifier->notify('NOTIFY_SEARCH_ORDERBY_STRING', $listing_sql);$zco_notifier->notify('NOTIFY_SEARCH_ORDERBY_STRING', $listing_sql2);
$breadcrumb->add(NAVBAR_TITLE_1, zen_href_link(FILENAME_ADVANCED_SEARCH));
$breadcrumb->add(NAVBAR_TITLE_2);


$advanced_search_split = new splitPageResults($listing_sql, (isset($_GET['pagesize']) ? $_GET['pagesize'] : MAX_DISPLAY_PRODUCTS_LISTING ), 'p.products_id', 'page');

if ($advanced_search_split->number_of_rows == 0) {
  $messageStack->add_session('search', TEXT_NO_PRODUCTS, 'caution');
  zen_redirect(zen_href_link(FILENAME_ADVANCED_SEARCH, zen_get_all_get_params('action')));
}

  $advanced_search = $db->Execute($advanced_search_split->sql_query);
  if($advanced_search->RecordCount()>0){
    $row = 0;
    while (!$advanced_search->EOF) {
      if ($advanced_search->fields['products_image'] == '' and PRODUCTS_IMAGE_NO_IMAGE_STATUS == 0) {
        $list_box_contents[$row]['products_image'] = '';
      } else {
        $list_box_contents[$row]['products_image'] = $advanced_search->fields['products_image'] ;
      }
      $list_box_contents[$row]['products_name'] = $advanced_search->fields['products_name'];
      $list_box_contents[$row]['products_description'] = zen_trunc_string(zen_clean_html(stripslashes(zen_get_products_description($advanced_search->fields['products_id'], $_SESSION['languages_id']))), PRODUCT_LIST_DESCRIPTION);
      $list_box_contents[$row]['products_price'] = zen_get_products_base_price($advanced_search->fields['products_id']);
      $list_box_contents[$row]['actual_price'] = $currencies->display_price(zen_get_products_actual_price($advanced_search->fields['products_id']),zen_get_tax_rate($product_check->fields['products_tax_class_id']));
      $list_box_contents[$row]['products_status']=$advanced_search->fields['products_status'];
      if ($advanced_search->fields['product_is_always_free_shipping'] == 0) {
        $list_box_contents[$row]['product_is_always_free_shipping'] = '';
      } else {
        $list_box_contents[$row]['product_is_always_free_shipping'] = '<span class="free_shipping"></span>';
      }
      
      $list_box_contents[$row]['products_quantity_order_min'] = $advanced_search->fields['products_quantity_order_min'];
      $list_box_contents[$row]['products_id'] = $advanced_search->fields['products_id'];
      $list_box_contents[$row]['products_quantity'] = $advanced_search->fields['products_quantity'];
      
      $list_box_contents[$row]['products_price_retail'] = $currencies->display_price($advanced_search->fields['products_price_retail'],zen_get_tax_rate($product_check->fields['products_tax_class_id']));
      $list_box_contents[$row]['products_price_sample'] = $currencies->display_price($advanced_search->fields['products_price_sample'],zen_get_tax_rate($product_check->fields['products_tax_class_id']));
      $list_box_contents[$row]['product_is_wholesale'] = $advanced_search->fields['product_is_wholesale'];
      $list_box_contents[$row]['product_wholesale_min'] = $advanced_search->fields['product_wholesale_min'];
      $advanced_search->MoveNext();
      $row++;
    }
  }
  
  
$advanced_search_split2 = new splitPageResults($listing_sql2, (isset($_GET['pagesize']) ? $_GET['pagesize'] : MAX_DISPLAY_PRODUCTS_LISTING ), 'p.products_id', 'page');
$advanced_search2 = $db->Execute($advanced_search_split2->sql_query);
  if($advanced_search2->RecordCount()>0){
    $row = 0;
    while (!$advanced_search2->EOF) {
      if ($advanced_search2->fields['products_image'] == '' and PRODUCTS_IMAGE_NO_IMAGE_STATUS == 0) {
        $list_box_contents2[$row]['products_image'] = '';
      } else {
        $list_box_contents2[$row]['products_image'] = $advanced_search2->fields['products_image'] ;
      }
      $list_box_contents2[$row]['products_name'] = $advanced_search2->fields['products_name'];
      $list_box_contents2[$row]['products_description'] = zen_trunc_string(zen_clean_html(stripslashes(zen_get_products_description($advanced_search2->fields['products_id'], $_SESSION['languages_id']))), PRODUCT_LIST_DESCRIPTION);
      $list_box_contents2[$row]['products_price'] = zen_get_products_base_price($advanced_search2->fields['products_id']);
      $list_box_contents2[$row]['actual_price'] = $currencies->display_price(zen_get_products_actual_price($advanced_search2->fields['products_id']),zen_get_tax_rate($product_check->fields['products_tax_class_id']));
      $list_box_contents2[$row]['products_status']=$advanced_search2->fields['products_status'];
      if ($advanced_search2->fields['product_is_always_free_shipping'] == 0) {
        $list_box_contents2[$row]['product_is_always_free_shipping'] = '';
      } else {
        $list_box_contents2[$row]['product_is_always_free_shipping'] = '<span class="free_shipping"></span>';
      }
      
      $list_box_contents2[$row]['products_quantity_order_min'] = $advanced_search2->fields['products_quantity_order_min'];
      $list_box_contents2[$row]['products_id'] = $advanced_search2->fields['products_id'];
      $list_box_contents2[$row]['products_quantity'] = $advanced_search2->fields['products_quantity'];
      
      $list_box_contents2[$row]['products_price_retail'] = $currencies->display_price($advanced_search2->fields['products_price_retail'],zen_get_tax_rate($product_check->fields['products_tax_class_id']));
      $list_box_contents2[$row]['products_price_sample'] = $currencies->display_price($advanced_search2->fields['products_price_sample'],zen_get_tax_rate($product_check->fields['products_tax_class_id']));
      $list_box_contents2[$row]['product_is_wholesale'] = $advanced_search2->fields['product_is_wholesale'];
      $list_box_contents2[$row]['product_wholesale_min'] = $advanced_search2->fields['product_wholesale_min'];
      $advanced_search2->MoveNext();
      $row++;
    }
  }


// This should be last line of the script:
$zco_notifier->notify('NOTIFY_HEADER_END_ADVANCED_SEARCH_RESULTS', $keywords);
//EOF