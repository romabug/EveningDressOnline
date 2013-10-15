<?php
/**
 * Header code file for the customer's Account-Edit page
 *
 * @package page
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: header_php.php 4825 2006-10-23 22:25:11Z drbyte $
 */
// This should be first line of the script:
$zco_notifier->notify('NOTIFY_HEADER_START_ACCOUNT_EDIT');

if (!$_SESSION['customer_id']) {
  $_SESSION['navigation']->set_snapshot();
  zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'SSL'));
}

require(DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));
$switchbox = 'email_information';
if(isset($_POST['action'])){
	switch ($_POST['action']){
		case 'email_information':
				  $gender = zen_db_prepare_input($_POST['gender']);
				  $firstname = zen_db_prepare_input($_POST['firstname']);
				  $lastname = zen_db_prepare_input($_POST['lastname']);
				  $describes = zen_db_prepare_input($_POST['customers_describes']);
				  $customers_company = zen_db_prepare_input($_POST['customers_company']);
				  $street_address = zen_db_prepare_input($_POST['street_address']); 
				  $suburb = zen_db_prepare_input($_POST['suburb']); 
				  $city = zen_db_prepare_input($_POST['city']); 
				  $zone_country_id = zen_db_prepare_input($_POST['zone_country_id']); 
				  $state = zen_db_prepare_input($_POST['state']); 
				  $postcode = zen_db_prepare_input($_POST['postcode']); 
				  $customers_telephone = zen_db_prepare_input($_POST['customers_telephone']); 
				  $zone_id = zen_db_prepare_input($_POST['zone_id']); 
				  $customers_fax = zen_db_prepare_input($_POST['customers_fax']);
				  $email_format = zen_db_prepare_input($_POST['email_format']);
				  $error = false;
				  if ($error == false) {
				    //update phpBB with new email address
				    $old_addr_check=$db->Execute("select customers_email_address from ".TABLE_CUSTOMERS." where customers_id='".(int)$_SESSION['customer_id']."'");				
				    $sql_data_array = array(array('fieldName'=>'customers_gender', 'value'=>$gender, 'type'=>'string'),
				    												array('fieldName'=>'customers_firstname', 'value'=>$firstname, 'type'=>'string'),
				                            array('fieldName'=>'customers_lastname', 'value'=>$lastname, 'type'=>'string'),
				                            array('fieldName'=>'customers_describes', 'value'=>$describes, 'type'=>'string'),
				                            array('fieldName'=>'customers_fax', 'value'=>$customers_fax, 'type'=>'string'),
				                            array('fieldName'=>'customers_email_format', 'value'=>$email_format, 'type'=>'string'),
				                            array('fieldName'=>'customers_telephone', 'value'=>$customers_telephone, 'type'=>'string')
				    );
				
				    $where_clause = "customers_id = :customersID";
				    $where_clause = $db->bindVars($where_clause, ':customersID', $_SESSION['customer_id'], 'integer');
				    $db->perform(TABLE_CUSTOMERS, $sql_data_array, 'update', $where_clause);
				
				    $sql = "UPDATE " . TABLE_CUSTOMERS_INFO . "
				            SET    customers_info_date_account_last_modified = now()
				            WHERE  customers_info_id = :customersID";
				
				    $sql = $db->bindVars($sql, ':customersID', $_SESSION['customer_id'], 'integer');
				
				    $db->Execute($sql);
				
				    $where_clause = "customers_id = :customersID AND address_book_id = :customerDefaultAddressID";
				    $where_clause = $db->bindVars($where_clause, ':customersID', $_SESSION['customer_id'], 'integer');
				    $where_clause = $db->bindVars($where_clause, ':customerDefaultAddressID', $_SESSION['customer_default_address_id'], 'integer');
				    $sql_data_array = array(array('fieldName'=>'entry_gender', 'value'=>$gender, 'type'=>'string'),
				    												array('fieldName'=>'entry_firstname', 'value'=>$firstname, 'type'=>'string'),
				    												array('fieldName'=>'entry_company', 'value'=>$customers_company, 'type'=>'string'),
				    												array('fieldName'=>'entry_lastname', 'value'=>$lastname, 'type'=>'string'),
				    												array('fieldName'=>'entry_company', 'value'=>$customers_company, 'type'=>'string'),
				    												array('fieldName'=>'entry_postcode', 'value'=>$postcode, 'type'=>'string'),
				    												array('fieldName'=>'entry_state', 'value'=>$state, 'type'=>'string'),
				    												array('fieldName'=>'entry_country_id', 'value'=>$zone_country_id, 'type'=>'integer'),
				    												array('fieldName'=>'entry_zone_id', 'value'=>$zone_id, 'type'=>'integer'),				    												
				    												array('fieldName'=>'entry_city', 'value'=>$city, 'type'=>'string'),
				    												array('fieldName'=>'entry_suburb', 'value'=>$suburb, 'type'=>'string'),
				    												array('fieldName'=>'entry_street_address', 'value'=>$street_address, 'type'=>'string'));
				
				    $db->perform(TABLE_ADDRESS_BOOK, $sql_data_array, 'update', $where_clause);
				    				
				    $zco_notifier->notify('NOTIFY_HEADER_ACCOUNT_EDIT_UPDATES_COMPLETE');
				
				    // reset the session variables
				    $_SESSION['customer_first_name'] = $firstname;
				
				    $messageStack->add('email_information', SUCCESS_ACCOUNT_UPDATED, 'success');
				

				  }
			break;
	  case 'email_edit':
	  			$switchbox = 'email_edit';			
				  $password_current = zen_db_prepare_input($_POST['existing_password']);
				  $email_address = zen_db_prepare_input($_POST['email']);	
				  $error = false;
				  
			    $check_customer_query = "SELECT customers_password
			                             FROM   " . TABLE_CUSTOMERS . "
			                             WHERE  customers_id = :customersID";
			    $check_customer_query = $db->bindVars($check_customer_query, ':customersID',$_SESSION['customer_id'], 'integer');
			    $check_customer = $db->Execute($check_customer_query);			    
  			  if (zen_validate_password($password_current, $check_customer->fields['customers_password'])) {
					  $check_email_query = "SELECT count(*) AS total
					                        FROM   " . TABLE_CUSTOMERS . "
					                        WHERE  customers_email_address = :emailAddress
					                        AND    customers_id != :customersID";
					
					  $check_email_query = $db->bindVars($check_email_query, ':emailAddress', $email_address, 'string');
					  $check_email_query = $db->bindVars($check_email_query, ':customersID', $_SESSION['customer_id'], 'integer');
					  $check_email = $db->Execute($check_email_query);
					
					// BEGIN newsletter_subscribe mod 1/2
					  if(defined('NEWSONLY_SUBSCRIPTION_ENABLED') &&
					     (NEWSONLY_SUBSCRIPTION_ENABLED=='true')) {
					// dmcl1 -- check for email address already in subscribers table
					    $check_subscribers_query = "select count(*) as total 
						                            from   " . TABLE_SUBSCRIBERS . "
													where  email_address = :emailAddress
													and    customers_id != :customersID";
							$check_subscribers_query = $db->bindVars($check_subscribers_query, ':emailAddress', $email_address, 'string');
							$check_subscribers_query = $db->bindVars($check_subscribers_query, ':customersID', $_SESSION['customer_id'], 'integer');
					    $check_subscribers = $db->Execute($check_subscribers_query);
					    $check_email->fields['total'] += $check_subscribers->fields['total'];
					  }
					// END newsletter_subscribe mod 1/2
					
					  if ($check_email->fields['total'] > 0) {
					    $error = true;
					    $messageStack->add('email_edit', ENTRY_EMAIL_ADDRESS_ERROR_EXISTS);
					  }
					
					  if ($error == false) {
					    //update phpBB with new email address
					    $old_addr_check=$db->Execute("select customers_email_address from ".TABLE_CUSTOMERS." where customers_id='".(int)$_SESSION['customer_id']."'");
	
					    $sql_data_array = array(array('fieldName'=>'customers_email_address', 'value'=>$email_address, 'type'=>'string'));
				
					    $where_clause = "customers_id = :customersID";
					    $where_clause = $db->bindVars($where_clause, ':customersID', $_SESSION['customer_id'], 'integer');
					    $db->perform(TABLE_CUSTOMERS, $sql_data_array, 'update', $where_clause);					
					    $sql = "UPDATE " . TABLE_CUSTOMERS_INFO . "
					            SET    customers_info_date_account_last_modified = now()
					            WHERE  customers_info_id = :customersID";
					
					    $sql = $db->bindVars($sql, ':customersID', $_SESSION['customer_id'], 'integer');
					
					    $db->Execute($sql);
					
							// BEGIN newsletter_subscribe mod 2/2
							// dmcl1 -- update SUBSCRIBERS table
								if(defined('NEWSONLY_SUBSCRIPTION_ENABLED') &&
								   (NEWSONLY_SUBSCRIPTION_ENABLED=='true')) {
								   	
								  $sql = "UPDATE " . TABLE_SUBSCRIBERS . " SET
							              email_address = :emailAddress,
							              email_format = :emailFormat
							              WHERE customers_id = :customersID";  
							         
								  $sql = $db->bindVars($sql, ':emailAddress', $email_address, 'string');
								  $sql = $db->bindVars($sql, ':emailFormat', $email_format, 'string');
								  $sql = $db->bindVars($sql, ':customersID', $_SESSION['customer_id'], 'integer');
							 
							      $db->Execute($sql);
							   }
							// END newsletter_subscribe mod 2/2
					
					    $zco_notifier->notify('NOTIFY_HEADER_ACCOUNT_EDIT_UPDATES_COMPLETE');
					
					    // reset the session variables
					
					    $messageStack->add('email_edit', SUCCESS_ACCOUNT_UPDATED, 'success');
					  }
				  }else {
				      $error = true;
				      $messageStack->add('email_edit', ERROR_CURRENT_PASSWORD_NOT_MATCHING);
				  }
			break;
	  case 'password_edit':
	  			$switchbox = 'password_edit';
					$password_current = zen_db_prepare_input($_POST['existing_password_1']);
				  $new_password = zen_db_prepare_input($_POST['password']);	
				  $error = false;
			    $check_customer_query = "SELECT customers_password
			                             FROM   " . TABLE_CUSTOMERS . "
			                             WHERE  customers_id = :customersID";
			    $check_customer_query = $db->bindVars($check_customer_query, ':customersID',$_SESSION['customer_id'], 'integer');
			    $check_customer = $db->Execute($check_customer_query);			    
  			  if (zen_validate_password($password_current, $check_customer->fields['customers_password'])) {			  		
					  if ($error == false) {
					    $sql_data_array = array(array('fieldName'=>'customers_password', 'value'=>zen_encrypt_password($new_password), 'type'=>'string'));
				
					    $where_clause = "customers_id = :customersID";
					    $where_clause = $db->bindVars($where_clause, ':customersID', $_SESSION['customer_id'], 'integer');
					    $db->perform(TABLE_CUSTOMERS, $sql_data_array, 'update', $where_clause);					
					    $sql = "UPDATE " . TABLE_CUSTOMERS_INFO . "
					            SET    customers_info_date_account_last_modified = now()
					            WHERE  customers_info_id = :customersID";
					
					    $sql = $db->bindVars($sql, ':customersID', $_SESSION['customer_id'], 'integer');
					
					    $db->Execute($sql);					
					    $zco_notifier->notify('NOTIFY_HEADER_ACCOUNT_EDIT_UPDATES_COMPLETE');
					    // reset the session variables
					    $messageStack->add('password_edit', SUCCESS_ACCOUNT_UPDATED, 'success');
					  }
				  }else {
				      $error = true;
				      $messageStack->add('password_edit', ERROR_CURRENT_PASSWORD_NOT_MATCHING);
				  }
			break;
	}
}
//  $email_address = zen_db_prepare_input($_POST['email_address']);

$account_query = "SELECT customers_gender, customers_firstname, customers_lastname ,c.customers_describes,
                         customers_dob, customers_email_address, customers_telephone,
                         customers_fax, customers_email_format, customers_referral, a.entry_company,
                         a.entry_street_address,a.entry_suburb,a.entry_postcode,a.entry_city,
                         a.entry_state,a.entry_country_id,a.entry_zone_id,a.entry_phone
                        
                  FROM   " . TABLE_CUSTOMERS . " c ,". TABLE_ADDRESS_BOOK." a
                  WHERE  c.customers_id=a.customers_id and c.customers_id = :customersID";

$account_query = $db->bindVars($account_query, ':customersID', $_SESSION['customer_id'], 'integer');
$account = $db->Execute($account_query);
if (ACCOUNT_GENDER == 'true') {
  if (isset($gender)) {
    $male = ($gender == 'm') ? true : false;
  } else {
    $male = ($account->fields['customers_gender'] == 'm') ? true : false;
  }
  $female = !$male;
}
$genderArray = array();
$genderArray[] = array('id'=> '-1','text'=> 'please select ...');
$genderArray[] = array('id'=> 'm','text'=> MALE);
$genderArray[] = array('id'=> 'f','text'=> FEMALE);

$bestYouArray = array();
$bestYouArray[] = array("id" => "-1", "text" => "Please select--");
$bestYouArray[] = array("id" => "1", "text" => "Auction Seller");
$bestYouArray[] = array("id" => "2", "text" => "Wholesaler");
$bestYouArray[] = array("id" => "3", "text" => "Offline Retailer");
$bestYouArray[] = array("id" => "4", "text" => "Online Retailer");
$bestYouArray[] = array("id" => "5", "text" => "Dropshipper");
$bestYouArray[] = array("id" => "6", "text" => "End-user");
$bestYouArray[] = array("id" => "7", "text" => "Others");
 
// if DOB field has database default setting, show blank:
$dob = ($dob == '0001-01-01 00:00:00') ? '' : $dob;

$customers_referral = $account->fields['customers_referral'];

if (isset($customers_email_format)) {
  $email_pref_html = (($customers_email_format == 'HTML') ? true : false);
  $email_pref_none = (($customers_email_format == 'NONE') ? true : false);
  $email_pref_optout = (($customers_email_format == 'OUT')  ? true : false);
  $email_pref_text = (($email_pref_html || $email_pref_none || $email_pref_out) ? false : true);  // if not in any of the others, assume TEXT
} else {
  $email_pref_html = (($account->fields['customers_email_format'] == 'HTML') ? true : false);
  $email_pref_none = (($account->fields['customers_email_format'] == 'NONE') ? true : false);
  $email_pref_optout = (($account->fields['customers_email_format'] == 'OUT')  ? true : false);
  $email_pref_text = (($email_pref_html || $email_pref_none || $email_pref_out) ? false : true);  // if not in any of the others, assume TEXT
}

$breadcrumb->add(NAVBAR_TITLE_1, zen_href_link(FILENAME_ACCOUNT, '', 'SSL'));
$breadcrumb->add(NAVBAR_TITLE_2);

// This should be last line of the script:
$zco_notifier->notify('NOTIFY_HEADER_END_ACCOUNT_EDIT');
?>