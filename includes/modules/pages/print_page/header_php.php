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
  //print_page
  // This should be first line of the script:
  $zco_notifier->notify('NOTIFY_HEADER_START_PRINT_PAGE');

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
    $sql = "INSERT INTO " . TABLE_REVIEWS . " (products_id, customers_id, customers_name, reviews_rating, date_added, status)
            VALUES (:productsID, :customersID, :customersName, :rating, now(), " . $review_status . ")";


    $sql = $db->bindVars($sql, ':productsID', $_GET['products_id'], 'integer');
    $sql = $db->bindVars($sql, ':customersID', $customer_id, 'integer');
    $sql = $db->bindVars($sql, ':customersName', $customer_name, 'string');
    $sql = $db->bindVars($sql, ':rating', $rating, 'string');
    
    $db->Execute($sql);

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
  $flag_disable_header = TRUE;
  $flag_disable_footer = TRUE;
  // This should be last line of the script:
  $zco_notifier->notify('NOTIFY_HEADER_END_PRINT_PAGE');
?>