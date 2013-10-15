<?php
 
/**
 * product_info header_php.php 
 *
 * @package page
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: header_php.php 6963 2007-09-08 02:36:34Z drbyte $
 */

  // This should be first line of the script:
  $zco_notifier->notify('NOTIFY_HEADER_START_PRODUCT_INFO');

  require(DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));
  if ($_POST['action']){
    if (REVIEWS_APPROVAL == '1') {
      $review_status = '0';
    } else {
      $review_status = '1';
    }
  	$sql_data_array =array();
    $sql_data_array2 =array(); 	
  	$customer_id = isset($_SESSION['customer_id']) ? $_SESSION['customer_id']:'';
  	$reviews_rating = $_POST['product_score'];
  	$customer_name = isset($_SESSION['customer_id']) ? zen_get_customer_name($_SESSION['customer_id']):$_POST['customer_name'];
  	$customer_email = isset($_SESSION['customer_id']) ? zen_get_customer_email($_SESSION['customer_id']):$_POST['customer_email'];
    $review_title = $_POST['review_title'];
    $review_content = $_POST['review_content'];
    $sql = "INSERT INTO " . TABLE_REVIEWS . " (products_id, customers_id, customers_name, customers_email, reviews_rating, date_added, status)
            VALUES (:productsID, :customersID, :customersName, :customersEmail, :rating, now(), " . $review_status . ")";


    $sql = $db->bindVars($sql, ':productsID', $_GET['products_id'], 'integer');
    $sql = $db->bindVars($sql, ':customersID', $customer_id, 'integer');
    $sql = $db->bindVars($sql, ':customersName', $customer_name, 'string');
    $sql = $db->bindVars($sql, ':customersEmail', $customer_email, 'string');
    $sql = $db->bindVars($sql, ':rating', $reviews_rating, 'string');
    
    $db->Execute($sql);
    $insert_id = $db->insert_ID();
    $sql = "INSERT INTO " . TABLE_REVIEWS_DESCRIPTION . " (reviews_id, languages_id, reviews_text, reviews_title)
            VALUES (:insertID, :languagesID, :reviewText, :reviews_title)";

    $sql = $db->bindVars($sql, ':insertID', $insert_id, 'integer');
    $sql = $db->bindVars($sql, ':languagesID', $_SESSION['languages_id'], 'integer');
    $sql = $db->bindVars($sql, ':reviewText', $review_content, 'string');
    $sql = $db->bindVars($sql, ':reviews_title', $review_title, 'string');

    $db->Execute($sql);
    
  	$messageStack->add('reviews',TEXT_WRITE_REVIEW_SUCCESS,'success');
  	unset($_POST);
  }
  // if specified product_id is disabled or doesn't exist, ensure that metatags and breadcrumbs don't share inappropriate information
  $sql = "select count(*) as total
          from " . TABLE_PRODUCTS . " p, " .
                   TABLE_PRODUCTS_DESCRIPTION . " pd
          where    p.products_status = '1'
          and      p.products_id = '" . (int)$_GET['products_id'] . "'
          and      pd.products_id = p.products_id
          and      pd.language_id = '" . (int)$_SESSION['languages_id'] . "'";
  $res = $db->Execute($sql);
  if ( $res->fields['total'] < 1 ) {
    unset($_GET['products_id']);
    unset($breadcrumb->_trail[sizeof($breadcrumb->_trail)-1]['title']);
    header('HTTP/1.1 404 Not Found');
  }

  // ensure navigation snapshot in case must-be-logged-in-for-price is enabled
  if (!$_SESSION['customer_id']) {
    $_SESSION['navigation']->set_snapshot();
  }

  /*
   * This is Payment Info Popup
   */
  $paymentInfoString = '<dl class="dl_dot pad_10px">';
  $file_extension = '.php';
  $key_value = $db->Execute("select configuration_value
                               from " . TABLE_CONFIGURATION . "
                               where configuration_key = 'MODULE_PAYMENT_INSTALLED'");
  $paymentArray = explode(';',$key_value->fields['configuration_value']);
  $module_directory = DIR_WS_MODULES . 'payment/';
	$directory_array = array();
	if ($dir = @dir($module_directory)) {
	  while ($file = $dir->read()) {
	    if (!is_dir($module_directory . $file)) {
	      if (substr($file, strrpos($file, '.')) == $file_extension) {
	        $directory_array[] = $file;
	      }
	    }
	  }
	    sort($directory_array);
	    $dir->close();
	  }
	  $paymentNum = count($directory_array);
	  for($i=0 ; $i<$paymentNum; $i++) {
	  	if(in_array($directory_array[$i],$paymentArray)){
		  	$file = $directory_array[$i];
	      include(DIR_WS_LANGUAGES . $_SESSION['language'] . '/modules/payment/' . $file);
	      include($module_directory . $file);
	      $class = substr($file, 0, strrpos($file, '.'));
	      if (zen_class_exists($class)) {
	        $module = new $class;
	        $paymentInfoString .= '<dt>'.$module->title.'</dt>';
	      }
	  	}
	  }
    $paymentInfoString .= '</dl>';
/*
 * This is Shipping Cost Program
 */
  $num_zones = 3;
  $countriesIds = array();
  $countriesStr1 = array();
  $countriesStr2 = array();
  $countriesId = $db->Execute("SELECT countries_id,countries_iso_code_2 FROM ". TABLE_COUNTRIES);
  if ($countriesId->RecordCount()>0){
    while (!$countriesId->EOF){
      $countriesIds[$countriesId->fields['countries_iso_code_2']] = $countriesId->fields['countries_id'];
      $countriesId->MoveNext();
    }
  }
  function codeToId(&$code, $key){
    global $countriesIds;
    $code = $countriesIds[$code];
  }
  for ($i = 1; $i <= $num_zones; $i++) {
     $countries_table = constant('MODULE_SHIPPING_STANDARD_COUNTRIES_' . $i);
     $cost_table = constant('MODULE_SHIPPING_STANDARD_COST_' . $i);
     $countries_table = strtoupper(str_replace(' ', '', $countries_table));
     $country_zones = split("[,]", $countries_table);
     if ($country_zones[0] != '00'){
        array_walk($country_zones,'codeToId');
     }
     if ($countries_table !=''){
        $countriesStr1[$i]= implode(',',$country_zones).'|'.$cost_table;
     }
  }
  
  for ($i = 1; $i <= $num_zones; $i++) {
     $countries_table = constant('MODULE_SHIPPING_EXPEDITED_COUNTRIES_' . $i);
     $cost_table = constant('MODULE_SHIPPING_EXPEDITED_COST_' . $i);
     $countries_table = strtoupper(str_replace(' ', '', $countries_table));
     $country_zones = split("[,]", $countries_table);
     if ($country_zones[0] != '00'){
        array_walk($country_zones,'codeToId');
     }
     if ($countries_table !=''){
        $countriesStr2[$i]= implode(',',$country_zones).'|'.$cost_table;
     }
  }
  $standard = (implode('-',$countriesStr1));
	$standardSkip = constant('MODULE_SHIPPING_STANDARD_SKIPPED');
	$standardSkipArray = explode(',',$standardSkip);
	array_walk($standardSkipArray,'codeToId');
	$standardSkipStr = implode(',',$standardSkipArray);
  $expedited = (implode('-',$countriesStr2));
  $expeditedSkip =constant('MODULE_SHIPPING_EXPEDITED_SKIPPED');
	$expeditedSkipArray = explode(',',$expeditedSkip);
	array_walk($expeditedSkipArray,'codeToId');
	$expeditedSkipStr = implode(',',$expeditedSkipArray);
/*
 * End Shipping Cost 
 */
  require(DIR_WS_CLASSES . 'order.php');
	$order = new order;
	$selected_country = $order->delivery['country']['id'];
    
	  // This should be last line of the script:
  $zco_notifier->notify('NOTIFY_HEADER_END_PRODUCT_INFO');
?>