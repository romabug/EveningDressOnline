<?php
/**
 * Header code file for the Address Book page
 *
 * @package page
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: header_php.php 2944 2006-02-02 17:13:18Z wilt $
 */
// This should be first line of the script:
$zco_notifier->notify('NOTIFY_HEADER_START_ADDRESS_BOOK');

if (!$_SESSION['customer_id']) {
  $_SESSION['navigation']->set_snapshot();
  zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'SSL'));
}

if (zen_get_customer_name($_SESSION['customer_id']) == 'New Customer'){
  zen_redirect(zen_href_link(FILENAME_ACCOUNT_EDIT, '', 'SSL'));
}

require(DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));

/**
 * Address deletes
 */
if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
  $sql = "DELETE FROM " . TABLE_ADDRESS_BOOK . "
          WHERE  address_book_id = :delete 
          AND    customers_id = :customersID";

  $sql = $db->bindVars($sql, ':customersID', $_SESSION['customer_id'], 'integer');
  $sql = $db->bindVars($sql, ':delete', $_GET['delete'], 'integer');
  $db->Execute($sql);

  $zco_notifier->notify('NOTIFY_HEADER_ADDRESS_BOOK_DELETION_DONE');

  $messageStack->add_session('manager_address', SUCCESS_ADDRESS_BOOK_ENTRY_DELETED, 'success');

  zen_redirect(zen_href_link(FILENAME_MANAGER_ADDRESS, '', 'SSL'));
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

      if ($found_exact_iso_match) {
        $zone_id = $zone->fields['zone_id'];
        $zone_name = $zone->fields['zone_name'];
      } else {
        $error = true;
        $error_state_input = true;
        $messageStack->add('addressbook', ENTRY_STATE_ERROR_SELECT);
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

    $messageStack->add('manager_address', SUCCESS_ADDRESS_BOOK_ENTRY_UPDATED, 'success');

    zen_redirect(zen_href_link(FILENAME_MANAGER_ADDRESS, '', 'SSL'));
  }
}

if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
  $entry_query = "SELECT entry_gender, entry_company, entry_firstname, entry_lastname,
                         entry_street_address, entry_suburb, entry_postcode, entry_city, entry_phone,
                         entry_state, entry_zone_id, entry_country_id
                  FROM   " . TABLE_ADDRESS_BOOK . "
                  WHERE  customers_id = :customersID
                  AND    address_book_id = :addressBookID";

  $entry_query = $db->bindVars($entry_query, ':customersID', $_SESSION['customer_id'], 'integer');
  $entry_query = $db->bindVars($entry_query, ':addressBookID', $_GET['edit'], 'integer');
  $entry = $db->Execute($entry_query);

  if ($entry->RecordCount()<=0) {
    $messageStack->add('manager_address', ERROR_NONEXISTING_ADDRESS_BOOK_ENTRY);
    zen_redirect(zen_href_link(FILENAME_MANAGER_ADDRESS, '', 'SSL'));
  }
  if (!isset($zone_name) || (int)$zone_name == 0) $zone_name = zen_get_zone_name($entry->fields['entry_country_id'], $entry->fields['entry_zone_id'], $entry->fields['entry_state']);
  if (!isset($zone_id) || (int)$zone_id == 0) $zone_id = $entry->fields['entry_zone_id'];

} elseif (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
  if ($_GET['delete'] == $_SESSION['customer_default_address_id']) {
    $messageStack->add('manager_address', WARNING_PRIMARY_ADDRESS_DELETION, 'warning');
    zen_redirect(zen_href_link(FILENAME_MANAGER_ADDRESS, '', 'SSL'));
  } else {
    $check_query = "SELECT count(*) AS total
                    FROM " . TABLE_ADDRESS_BOOK . "
                    WHERE address_book_id = :addressBookID
                    AND customers_id = :customersID";

    $check_query = $db->bindVars($check_query, ':customersID', $_SESSION['customer_id'], 'integer');
    $check_query = $db->bindVars($check_query, ':addressBookID', $_GET['delete'], 'integer');
    $check = $db->Execute($check_query);

    if ($check->fields['total'] < 1) {
      $messageStack->add('manager_address', ERROR_NONEXISTING_ADDRESS_BOOK_ENTRY);
      zen_redirect(zen_href_link(FILENAME_MANAGER_ADDRESS, '', 'SSL'));
    }
  }
} else {
  $entry_query = "SELECT entry_country_id
                  FROM   " . TABLE_ADDRESS_BOOK . " a, " . TABLE_CUSTOMERS . " c
                  WHERE  a.customers_id = :customersID
                  AND  a.customers_id = c.customers_id
                  AND    a.address_book_id = c.customers_default_address_id";

  $entry_query = $db->bindVars($entry_query, ':customersID', $_SESSION['customer_id'], 'integer');
  $entry = $db->Execute($entry_query);
}



$breadcrumb->add(NAVBAR_TITLE_1, zen_href_link(FILENAME_ACCOUNT, '', 'SSL'));
$breadcrumb->add(NAVBAR_TITLE_2);

$addresses_query = "SELECT address_book_id, entry_firstname as firstname, entry_lastname as lastname,
                           entry_company as company, entry_street_address as street_address,
                           entry_suburb as suburb, entry_city as city, entry_postcode as postcode, entry_phone as phone,
                           entry_state as state, entry_zone_id as zone_id, entry_country_id as country_id
                    FROM   " . TABLE_ADDRESS_BOOK . "
                    WHERE  customers_id = :customersID
                    ORDER BY firstname, lastname";

$addresses_query = $db->bindVars($addresses_query, ':customersID', $_SESSION['customer_id'], 'integer');
$addresses = $db->Execute($addresses_query);

while (!$addresses->EOF) {
  $format_id = zen_get_address_format_id($addresses->fields['country_id']);

  $addressArray[] = array('firstname'=>$addresses->fields['firstname'],
  'lastname'=>$addresses->fields['lastname'],
  'address_book_id'=>$addresses->fields['address_book_id'],
  'format_id'=>$format_id,
  'address'=>$addresses->fields);
  
  $addresses->MoveNext();
}

/*
 * Set flags for template use:
 */
  $selected_country = (isset($_POST['zone_country_id']) && $_POST['zone_country_id'] != '') ? $country : SHOW_CREATE_ACCOUNT_DEFAULT_COUNTRY;
  if ($process == true) $entry->fields['entry_country_id'] = $selected_country; 
  $flag_show_pulldown_states = ((($process == true || $entry_state_has_zones == true) && $zone_name == '') || ACCOUNT_STATE_DRAW_INITIAL_DROPDOWN == 'true' || $error_state_input) ? true : false;
  $state = ($flag_show_pulldown_states) ? $state : $zone_name;
  $state_field_label = ($flag_show_pulldown_states) ? '' : ENTRY_STATE;


$genderArray = array();
$genderArray[] = array('id'=> '-1','text'=> 'please select ...');
$genderArray[] = array('id'=> 'm','text'=> MALE);
$genderArray[] = array('id'=> 'f','text'=> FEMALE);

// This should be last line of the script:
$zco_notifier->notify('NOTIFY_HEADER_END_ADDRESS_BOOK');
?>