<?php
/**
 * Page to let customer change their shipping address(ship to)
 *
 * @package page
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: header_php.php 4793 2006-10-20 05:25:20Z ajeh $
 */

// This should be first line of the script:
$zco_notifier->notify('NOTIFY_HEADER_START_CHECKOUT_SHIPPING_ADDRESS');
require(DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));

// if there is nothing in the customers cart, redirect them to the shopping cart page
if ($_SESSION['cart']->count_contents() <= 0) {
  zen_redirect(zen_href_link(FILENAME_SHOPPING_CART));
}

// if the customer is not logged on, redirect them to the login page
  if (!isset($_SESSION['customer_id'])) {
    $_SESSION['navigation']->set_snapshot();
    zen_redirect(zen_href_link(FILENAME_CHECKOUT_LOGIN, '', 'SSL'));
  } else {
    // validate customer
    if (zen_get_customer_validate_session($_SESSION['customer_id']) == false) {
      $_SESSION['navigation']->set_snapshot(array('mode' => 'SSL', 'page' => FILENAME_CHECKOUT_SHIPPING));
      zen_redirect(zen_href_link(FILENAME_CHECKOUT_LOGIN, '', 'SSL'));
    }
  }
  
/**
 * Address deletes
 */
  
if (isset($_POST['address']) || $_POST['address'] != 0 ){
	$_SESSION['sendto'] = $_POST['address'];
	zen_redirect(zen_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
}
  
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
  $sql = "DELETE FROM " . TABLE_ADDRESS_BOOK . "
          WHERE  address_book_id = :delete 
          AND    customers_id = :customersID";

  $sql = $db->bindVars($sql, ':customersID', $_SESSION['customer_id'], 'integer');
  $sql = $db->bindVars($sql, ':delete', $_GET['delete'], 'integer');
  $db->Execute($sql);
  $zco_notifier->notify('NOTIFY_HEADER_ADDRESS_BOOK_DELETION_DONE');
  $messageStack->add_session('checkout_address', SUCCESS_ADDRESS_BOOK_ENTRY_DELETED, 'success');
  zen_redirect(zen_href_link(FILENAME_CHECKOUT_SHIPPING_ADDRESS, '', 'SSL'));
}


/**
 * Set some defaults
 */
  $process = false;
  $zone_name = '';
  $entry_state_has_zones = '';
  $error_state_input = false;
  $state = '';
  $zone_id = 0;
  $error = false;
/**
 * Process new/update actions
 */
  
if (isset($_POST['action']) && (($_POST['action'] == 'createShipping') || ($_POST['action'] == 'update'))) {
    $process = true;  
    $gender = zen_db_prepare_input($_POST['gender']);
    $firstname = zen_db_prepare_input($_POST['firstname']);
    $lastname = zen_db_prepare_input($_POST['lastname']);
    $street_address = zen_db_prepare_input($_POST['street_address']);
    $suburb = zen_db_prepare_input($_POST['suburb']);
    $postcode = zen_db_prepare_input($_POST['postcode']);
    $phone = zen_db_prepare_input($_POST['phone']);
    $city = zen_db_prepare_input($_POST['city']);
    $state = zen_db_prepare_input($_POST['state']);
    
    if (isset($_POST['zone_id'])) {
      $zone_id = zen_db_prepare_input($_POST['zone_id']);
    } else {
      $zone_id = false;
    }
    //if not
    $country = zen_db_prepare_input($_POST['zone_country_id']);
    /**
     * error checking when updating or adding an entry
     */
    $check_query = "SELECT count(*) AS total
                    FROM " . TABLE_ZONES . "
                    WHERE zone_country_id = :zoneCountryID";
    $check_query = $db->bindVars($check_query, ':zoneCountryID', $country, 'integer');
    $check = $db->Execute($check_query);
    $entry_state_has_zones = ($check->fields['total'] > 0);
    if ($entry_state_has_zones == true) {
      $zone_query = "SELECT distinct zone_id, zone_name, zone_code
                     FROM " . TABLE_ZONES . "
                     WHERE zone_country_id = :zoneCountryID
                     AND " . 
                     ((trim($state) != '' && $zone_id == 0) ? "(upper(zone_name) like ':zoneState%' OR upper(zone_code) like '%:zoneState%') OR " : "") .
                    "zone_id = :zoneID
                     ORDER BY zone_code ASC, zone_name";

      $zone_query = $db->bindVars($zone_query, ':zoneCountryID', $country, 'integer');
      $zone_query = $db->bindVars($zone_query, ':zoneState', strtoupper($state), 'noquotestring');
      $zone_query = $db->bindVars($zone_query, ':zoneID', $zone_id, 'integer');
      $zone = $db->Execute($zone_query);

      //look for an exact match on zone ISO code
      $found_exact_iso_match = ($zone->RecordCount() == 1);
      if ($zone->RecordCount() > 1) {
        while (!$zone->EOF && !$found_exact_iso_match) {
          if (strtoupper($zone->fields['zone_code']) == strtoupper($state) ) {
            $found_exact_iso_match = true;
            continue;
          }
          $zone->MoveNext();
        }
      }
      
    } else {
      if (strlen($state) < ENTRY_STATE_MIN_LENGTH) {
        $error = true;
        $error_state_input = true;
        $messageStack->add('addressbook', ENTRY_STATE_ERROR);
      }
    }


    if ($error == false) {
        $sql_data_array= array(array('fieldName'=>'entry_gender', 'value'=>$gender, 'type'=>'enum:m|f'),
                               array('fieldName'=>'entry_firstname', 'value'=>$firstname, 'type'=>'string'),
                               array('fieldName'=>'entry_lastname', 'value'=>$lastname, 'type'=>'string'),
                               array('fieldName'=>'entry_street_address', 'value'=>$street_address, 'type'=>'string'),
                               array('fieldName'=>'entry_suburb', 'value'=>$suburb, 'type'=>'string'),
                               array('fieldName'=>'entry_postcode', 'value'=>$postcode, 'type'=>'string'),
                               array('fieldName'=>'entry_phone', 'value'=>$phone, 'type'=>'string'),
                               array('fieldName'=>'entry_city', 'value'=>$city, 'type'=>'string'),
                               array('fieldName'=>'entry_country_id', 'value'=>$country, 'type'=>'integer'));
  
        if ($zone_id > 0) {
          $sql_data_array[] = array('fieldName'=>'entry_zone_id', 'value'=>$zone_id, 'type'=>'integer');
          $sql_data_array[] = array('fieldName'=>'entry_state', 'value'=>'', 'type'=>'string');
        } else {
          $sql_data_array[] = array('fieldName'=>'entry_zone_id', 'value'=>'0', 'type'=>'integer');
          $sql_data_array[] = array('fieldName'=>'entry_state', 'value'=>$state, 'type'=>'string');
        }

    if ($_POST['action'] == 'update') {
      $where_clause = "address_book_id = :edit and customers_id = :customersID";
      $where_clause = $db->bindVars($where_clause, ':customersID', $_SESSION['customer_id'], 'integer');
      $where_clause = $db->bindVars($where_clause, ':edit', $_POST['edit'], 'integer');
      print_r($where_clause);
      $db->perform(TABLE_ADDRESS_BOOK, $sql_data_array, 'update', $where_clause);

      $zco_notifier->notify('NOTIFY_MODULE_ADDRESS_BOOK_UPDATED_ADDRESS_BOOK_RECORD', array_merge(array('address_book_id' => $_GET['edit'], 'customers_id' => $_SESSION['customer_id']), $sql_data_array));

      // re-register session variables
      if ( (isset($_POST['primary']) && ($_POST['primary'] == 'on')) || ($_GET['edit'] == $_SESSION['customer_default_address_id']) ) {
        $_SESSION['customer_first_name'] = $firstname;
        $_SESSION['customer_country_id'] = $country;
        $_SESSION['customer_zone_id'] = (($zone_id > 0) ? (int)$zone_id : '0');
        $_SESSION['customer_default_address_id'] = (int)$_POST['edit'];

        $sql_data_array = array(array('fieldName'=>'customers_firstname', 'value'=>$firstname, 'type'=>'string'),
                                array('fieldName'=>'customers_lastname', 'value'=>$lastname, 'type'=>'string'),
                                array('fieldName'=>'customers_default_address_id', 'value'=>$_POST['edit'], 'type'=>'integer'));

        $sql_data_array[] = array('fieldName'=>'customers_gender', 'value'=>$gender, 'type'=>'enum:m|f');
        $where_clause = "customers_id = :customersID";
        $where_clause = $db->bindVars($where_clause, ':customersID', $_SESSION['customer_id'], 'integer');
        $db->perform(TABLE_CUSTOMERS, $sql_data_array, 'update', $where_clause);
        $zco_notifier->notify('NOTIFY_MODULE_ADDRESS_BOOK_UPDATED_CUSTOMER_RECORD', array_merge(array('customers_id' => $_SESSION['customer_id']), $sql_data_array));
      }
    } else {

      $sql_data_array[] = array('fieldName'=>'customers_id', 'value'=>$_SESSION['customer_id'], 'type'=>'integer');
      $db->perform(TABLE_ADDRESS_BOOK, $sql_data_array);

      $new_address_book_id = $db->Insert_ID();
      $zco_notifier->notify('NOTIFY_MODULE_ADDRESS_BOOK_ADDED_ADDRESS_BOOK_RECORD', array_merge(array('address_id' => $new_address_book_id), $sql_data_array));


      // reregister session variables
      /* if (isset($_POST['primary']) && ($_POST['primary'] == 'on')) {
          $_SESSION['customer_first_name'] = $firstname;
          $_SESSION['customer_country_id'] = $country;
          $_SESSION['customer_zone_id'] = (($zone_id > 0) ? (int)$zone_id : '0');
          //if (isset($_POST['primary']) && ($_POST['primary'] == 'on')) 
          $_SESSION['customer_default_address_id'] = $new_address_book_id;
  
          $sql_data_array = array(array('fieldName'=>'customers_firstname', 'value'=>$firstname, 'type'=>'string'),
                                  array('fieldName'=>'customers_lastname', 'value'=>$lastname, 'type'=>'string'));
  
          if (ACCOUNT_GENDER == 'true') $sql_data_array[] = array('fieldName'=>'customers_gender', 'value'=>$gender, 'type'=>'string');
          //if (isset($_POST['primary']) && ($_POST['primary'] == 'on')) 
          $sql_data_array[] = array('fieldName'=>'customers_default_address_id', 'value'=>$new_address_book_id, 'type'=>'integer');
  
          $where_clause = "customers_id = :customersID";
          $where_clause = $db->bindVars($where_clause, ':customersID', $_SESSION['customer_id'], 'integer');
          $db->perform(TABLE_CUSTOMERS, $sql_data_array, 'update', $where_clause);
          $zco_notifier->notify('NOTIFY_MODULE_ADDRESS_BOOK_UPDATED_PRIMARY_CUSTOMER_RECORD', array_merge(array('address_id' => $new_address_book_id, 'customers_id' => $_SESSION['customer_id']), $sql_data_array));
      }*/
    }

    $messageStack->add('checkout_address', SUCCESS_ADDRESS_BOOK_ENTRY_UPDATED, 'success');
    $_SESSION['sendto'] = $new_address_book_id;
    zen_redirect(zen_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
  }
}


require(DIR_WS_CLASSES . 'order.php');
$order = new order;

// if the order contains only virtual products, forward the customer to the billing page as
// a shipping address is not needed
if ($order->content_type == 'virtual') {
  $_SESSION['shipping'] = false;
  $_SESSION['sendto'] = false;
  zen_redirect(zen_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
}

$addressType = "shipto";
require(DIR_WS_MODULES . zen_get_module_directory('checkout_new_address'));

// if no shipping destination address was selected, use their own address as default
if (!$_SESSION['sendto']) {
  $_SESSION['sendto'] = $_SESSION['customer_default_address_id'];
}

$breadcrumb->add(NAVBAR_TITLE_1, zen_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'));
$breadcrumb->add(NAVBAR_TITLE_2);
$addresses_count = zen_count_customer_address_book_entries();

// This should be last line of the script:
$zco_notifier->notify('NOTIFY_HEADER_END_CHECKOUT_SHIPPING_ADDRESS');
?>