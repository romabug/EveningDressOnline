<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
//  Original contrib by Vijay Immanuel for osCommerce, converted to zen by dave@open-operations.com - http://www.open-operations.com
//  $Id: faqs_manager.php 2004-11-19 dave@open-operations.com
//

if (ALLOW_FAQS_SUBMISSION == 'false') {
    $_SESSION['navigation']->remove_current_page();
    zen_redirect(zen_href_link(FILENAME_CONTACT_US, '', 'SSL'));
}
if (UNREGISTERED_FAQS_SUBMIT == 'false') {
  if (!$_SESSION['customer_id']) {
    $_SESSION['navigation']->set_snapshot();
	$messageStack->add_session('login', 'You must be logged in to submit a faq');
    zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'SSL'));
  }
}

  require(DIR_WS_MODULES . 'require_languages.php');
//  require(DIR_WS_FUNCTIONS . 'faqs.php');
  $process = false;
  if (isset($HTTP_POST_VARS['action']) && ($HTTP_POST_VARS['action'] == 'process')) {
    $process = true;
	  $faqs_contact_name = zen_db_prepare_input($HTTP_POST_VARS['fullname']);
	  $faqs_contact_mail = zen_db_prepare_input($HTTP_POST_VARS['sEmail']);
    $faqs_name = zen_db_prepare_input($HTTP_POST_VARS['faqs_name']);
    $faqs_category = zen_db_prepare_input($HTTP_POST_VARS['faqs_category']);
    $faqs_description = zen_db_prepare_input($HTTP_POST_VARS['faqs_description']);
	$faqs_type = '1';

  $process = true;
  $error = false;
    if ($error == false) {
      // default values
      $faqs_date_added = 'now()';
if (FAQ_LIST_LIVE == 'true') {
      $faqs_status = '1'; // Approved
   } else {
       $faqs_status = '2'; // Pending approval
  }  
      $faqs_rating = '0'; 
	  $faqs_owner = $_SESSION['customer_id'];
      $language_id = (int)$_SESSION['languages_id'];

      $sql_data_array = array('faqs_type' => $faqs_type,
                              'faqs_date_added' => $faqs_date_added, 
                              'faqs_status' => $faqs_status,
							  'faqs_image' => $faqs_image,
							  'faqs_date_added' => $faqs_date_added,
                              'master_faq_categories_id' => $faqs_category);
      zen_db_perform(TABLE_FAQS, $sql_data_array);
	  $faqs_id = $db->Insert_ID(); 
	  
      $sql_data_array = array('faqs_id' => $faqs_id, 
	  						  'language_id' => $language_id,
                              'faqs_name' => $faqs_name,
                              'faqs_description' => $faqs_description,
							  'faqs_contact_name' => $faqs_contact_name,
							  'faqs_contact_mail' => $faqs_contact_mail,
							  'faqs_owner' => $faqs_owner);
      zen_db_perform(TABLE_FAQS_DESCRIPTION, $sql_data_array);
	  
	  
      $categories = $db->Execute("select faq_categories_id from " . TABLE_FAQ_CATEGORIES_DESCRIPTION . " where faq_categories_name = '" . $faqs_category . "' and language_id = '" . (int)$_SESSION['languages_id'] . "' ");
      $faq_categories_id = $categories->fields['faq_categories_id'];
      $db->Execute("insert into " . TABLE_FAQS_TO_FAQ_CATEGORIES . " (faqs_id, faq_categories_id) values ('" . (int)$faqs_id . "', '" . (int)$faqs_category . "')");


 $path = "images/faqs/";   //path to your targetfolder
 if (is_uploaded_file($HTTP_POST_FILES['faqs_image']['tmp_name'])) {
 $faq_image_extention = substr($HTTP_POST_FILES['faqs_image']['name'], strrpos($HTTP_POST_FILES['faqs_image']['name'], '.'));
 $res = copy($HTTP_POST_FILES['faqs_image']['tmp_name'], $path . $faqs_id . $faq_image_extention);
 $faqs_image = 'faqs/' . $faqs_id . $faq_image_extention;
}
      $sql_data_array = array('faqs_image' => $faqs_image);
      zen_db_perform(TABLE_FAQS, $sql_data_array, 'update', "faqs_id = '" . $faqs_id . "'");


// build the message content
      $name = $faqs_contact_name;
      $email_text = sprintf(EMAIL_GREET_NONE, $name);
      $html_msg['EMAIL_GREETING'] = str_replace('\n','',$email_text);
      $html_msg['EMAIL_FIRST_NAME'] = $firstname;
      $html_msg['EMAIL_LAST_NAME']  = $lastname;

      // initial welcome
      $email_text .= EMAIL_WELCOME . '<BR />';
      $email_text .= "\n" . $faqs_name . '<BR />';
      $email_text .= "\n" . $faqs_description . '<BR />';
	  $html_msg['EMAIL_WELCOME'] = str_replace('<BR />','',EMAIL_WELCOME);
      // add in regular email welcome text
      
	
if (FAQ_LIST_LIVE == 'true') {  
	  $email_text .= "\n\n" . EMAIL_TEXT_APPROVED . EMAIL_CONTACT . EMAIL_GV_CLOSURE;
	  $html_msg['EMAIL_MESSAGE_HTML']  = str_replace('\n','',EMAIL_TEXT);
   } else {
	  $email_text .= "\n\n" . EMAIL_TEXT . EMAIL_CONTACT . EMAIL_GV_CLOSURE;
	  $html_msg['EMAIL_MESSAGE_HTML']  = str_replace('\n','',EMAIL_TEXT_APPROVED);
  }    
	  
	  
	  $html_msg['EMAIL_CONTACT_OWNER'] = str_replace('\n','',EMAIL_CONTACT);
	  $html_msg['EMAIL_CLOSURE']       = nl2br(EMAIL_GV_CLOSURE);

// include create-account-specific disclaimer
      $email_text .= "\n\n" . sprintf(EMAIL_DISCLAIMER_NEW_CUSTOMER, STORE_OWNER_EMAIL_ADDRESS). "\n\n";
	  $html_msg['EMAIL_DISCLAIMER'] = sprintf(EMAIL_DISCLAIMER_NEW_CUSTOMER, '<a href="mailto:' . STORE_OWNER_EMAIL_ADDRESS . '">'. STORE_OWNER_EMAIL_ADDRESS .' </a>');
// send welcome email
   zen_mail($name, $faqs_contact_mail, EMAIL_SUBJECT, $email_text, STORE_NAME, EMAIL_FROM, $html_msg, 'faqssubmit');
// send additional emails
      if (SEND_FAQ_SUBMIT_EMAILS_TO_EMAILS_TO !='') {
        if ($_SESSION['customer_id']) {
          $account_query = "select customers_firstname, customers_lastname, customers_email_address
                            from " . TABLE_CUSTOMERS . "
                            where customers_id = '" . (int)$_SESSION['customer_id'] . "'";

          $account = $db->Execute($account_query);
        }
	   $extra_info=email_collect_extra_info($name,$email_address, $account->fields['customers_firstname'] . ' ' . $account->fields['customers_lastname'] , $account->fields['customers_email_address'] );
       $html_msg['EXTRA_INFO'] = $extra_info['HTML'];
       zen_mail('', SEND_EXTRA_CREATE_ACCOUNT_EMAILS_TO, SEND_EXTRA_SUBMIT_FAQ_TO_SUBJECT . ' ' . EMAIL_SUBJECT,
             $email_text . $extra_info['HTML'], STORE_NAME, EMAIL_FROM, $html_msg, 'faqssubmit');
      }
      $messageStack->add_session('submit_success',EMAIL_TEXT_APPROVED,'success');
      zen_redirect(zen_href_link(FILENAME_FAQS_SUBMIT, '', 'SSL'));

    }
  }
  // faqs breadcrumb
    if($_SESSION['customer_id']) {
      $check_customer = $db->Execute("select customers_id, customers_firstname, customers_lastname, customers_password, customers_email_address, customers_default_address_id from " . TABLE_CUSTOMERS . " where customers_id = '" . $_SESSION['customer_id'] . "'");
      $email= $check_customer->fields['customers_email_address'];
      $name= $check_customer->fields['customers_firstname'] . ' ' . $check_customer->fields['customers_lastname'];
  }
  
  $breadcrumb->add(NAVBAR_TITLE_1, zen_href_Link(FILENAME_FAQS, '', 'NONSSL'));
  if (isset($HTTP_GET_VARS['lPath'])) {
    $faq_categories_value = $db->Execute("select * from " . TABLE_FAQ_CATEGORIES_DESCRIPTION . " where faq_categories_id = '" . (int)$HTTP_GET_VARS['lPath'] . "' and language_id = '" . (int)$_SESSION['languages_id'] . "' ");
    $breadcrumb->add($faq_categories_value->fields['faq_categories_name'], zen_href_faq(FILENAME_FAQS_SUBMIT, 'lPath=' . $faq_categories_value->fields['faq_categories_id'], 'NONSSL'));
  } 
  $breadcrumb->add(NAVBAR_TITLE_2);
  $_SESSION['navigation']->remove_current_page();
  // include template specific file name defines
 $define_faqs_submit = zen_get_file_directory(DIR_WS_LANGUAGES . $_SESSION['language'] . '/html_includes/', FILENAME_DEFINE_FAQS_SUBMIT, 'false');
 $flag_disable_header = TRUE;
 $flag_disable_footer = TRUE;
 ?>
