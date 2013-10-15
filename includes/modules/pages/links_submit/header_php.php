<?php
/**
 * Links Submit Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_links_submit_default.php 3.4.0 3/27/2008 Clyde Jones $
 */
  require(DIR_WS_MODULES . 'require_languages.php');
  require(DIR_WS_FUNCTIONS . 'links.php');
  
  require(DIR_WS_CLASSES . 'upload.php');
  
if (REGISTERED_LINK == 'true'){
  if (!$_SESSION['customer_id']) {
    $_SESSION['navigation']->set_snapshot();
    zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'SSL'));
  }
}

  $process = false;
  if (isset($_GET['action']) && ($_GET['action'] == 'send')) {
    $process = true;
    $links_title = zen_db_prepare_input($_POST['links_title']);
    $links_url = zen_db_prepare_input($_POST['links_url']);
    $links_category = zen_db_prepare_input($_POST['links_category']);
    $links_description = zen_db_prepare_input($_POST['links_description']);
    $links_image = zen_db_prepare_input($_POST['links_image_url']);
    $links_contact_name = zen_db_prepare_input($_POST['links_contact_name']);
    $links_contact_email = zen_db_prepare_input($_POST['links_contact_email']);
if (SUBMIT_LINK_REQUIRE_RECIPROCAL == 'true') {
    $links_reciprocal_url = zen_db_prepare_input($_POST['links_reciprocal_url']);
}
    $error = false;
    if (strlen($links_title) < ENTRY_LINKS_TITLE_MIN_LENGTH) {
      $error = true;
      $messageStack->add('submit_link', ENTRY_LINKS_TITLE_ERROR);
    }
    if (strlen($links_url) < ENTRY_LINKS_URL_MIN_LENGTH) {
      $error = true;
      $messageStack->add('submit_link', ENTRY_LINKS_URL_ERROR);
    }
    if (strlen($links_description) < ENTRY_LINKS_DESCRIPTION_MIN_LENGTH) {
      $error = true;
      $messageStack->add('submit_link', ENTRY_LINKS_DESCRIPTION_ERROR);
    }
    if (strlen($links_contact_name) < ENTRY_LINKS_CONTACT_NAME_MIN_LENGTH) {
      $error = true;
      $messageStack->add('submit_link', ENTRY_LINKS_CONTACT_NAME_ERROR);
    }
    if (strlen($links_contact_email) < ENTRY_EMAIL_ADDRESS_MIN_LENGTH) {
      $error = true;
      $messageStack->add('submit_link', ENTRY_EMAIL_ADDRESS_ERROR);
    } elseif (zen_validate_email($links_contact_email) == false) {
      $error = true;
      $messageStack->add('submit_link', ENTRY_EMAIL_ADDRESS_CHECK_ERROR);
    }
if (SUBMIT_LINK_REQUIRE_RECIPROCAL == 'true') {
    if (strlen($links_reciprocal_url) < ENTRY_LINKS_URL_MIN_LENGTH) {
      $error = true;
      $messageStack->add('submit_link', ENTRY_LINKS_RECIPROCAL_URL_ERROR);
    }
}

    if ($error == false) {
		  
      // default values
      $links_date_added = 'now()';
      $links_status = '1'; // Pending approval
      $sql_data_array = array('links_url' => $links_url,
                              'links_contact_name' => $links_contact_name,
                              'links_contact_email' => $links_contact_email,
                              'links_reciprocal_url' => $links_reciprocal_url, 
                              'links_date_added' => $links_date_added, 
                              'links_status' => $links_status);
      zen_db_perform(TABLE_LINKS, $sql_data_array);
      $links_id = zen_db_insert_id();
		 
// Upload an image when form field is filled in by user		 
       if ($links_image = new upload('links_image_url')) {
          $links_image->set_destination(DIR_WS_IMAGES . LINK_IMAGE_DIRECTORY);
          if ($links_image->parse() && $links_image->save()) {
            $links_image_name = LINK_IMAGE_DIRECTORY . $links_image->filename;
          }
           if ($links_image->filename != '') {
            $db->Execute("update " . TABLE_LINKS . "
                          set links_image_url = '" . $links_image_name . "'
                          where links_id = '" . (int)$links_id . "'");
		  }else { // Use default image if form field is left blank
		             $links_image_name = LINK_IMAGE_DIRECTORY . DEFAULT_LINK_IMAGE;
             $db->Execute("update " . TABLE_LINKS . "
                         set links_image_url = '" . $links_image_name . "'
                          where links_id = '" . (int)$links_id . "'");
				$messageStack->add_session('header', WARNING_DEFAULT_FILE_UPLOADED, 'success');			  
           }
		}
	  	  
      $categories = $db->Execute("select link_categories_id from " . TABLE_LINK_CATEGORIES_DESCRIPTION . " where link_categories_name = '" . $links_category . "' and language_id = '" . (int)$_SESSION['languages_id'] . "' ");
      $link_categories_id = $categories->fields['link_categories_id'];
      $db->Execute("insert into " . TABLE_LINKS_TO_LINK_CATEGORIES . " (links_id, link_categories_id) values ('" . (int)$links_id . "', '" . (int)$link_categories_id . "')");
      $language_id = (int)$_SESSION['languages_id'];
      $sql_data_array = array('links_id' => $links_id, 
                              'language_id' => $language_id, 
                              'links_title' => $links_title,
                              'links_description' => $links_description);
      zen_db_perform(TABLE_LINKS_DESCRIPTION, $sql_data_array);

// build the message content
      $name = $links_contact_name;
      $email_text = sprintf(EMAIL_GREET_NONE, $name);
      $email_text .= EMAIL_WELCOME;
      $email_text .= EMAIL_TEXT . EMAIL_CONTACT . EMAIL_WARNING;
	  $email_store_text = EMAIL_OWNER_TEXT . $links_title . "\n\n" . $links_url . "\n\n" . $links_description;
// Prepare HTML-portion of message
      $html_msg['EMAIL_GREETING'] = str_replace('\n','',$email_text);
	  $html_msg['EMAIL_WELCOME'] = str_replace('\n','',EMAIL_WELCOME);
      $html_msg['EMAIL_MESSAGE_HTML'] =  str_replace('\n','',EMAIL_TEXT);
      $html_msg['CONTACT_US_OFFICE_FROM'] = OFFICE_FROM . ' ' . $name . '<br />' . OFFICE_EMAIL . '(' . $links_contact_email . ')';
      $html_msg['EXTRA_INFO'] = $extra_info['HTML'];

      zen_mail($name, $links_contact_email, EMAIL_SUBJECT, $email_text, STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, $html_msg, 'Link Exchange');

      zen_mail(STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, EMAIL_OWNER_SUBJECT, $email_store_text, $name, $links_contact_email, $html_msg, 'Link Exchange');
	  
      zen_redirect(zen_href_link(FILENAME_LINKS_SUBMIT, 'action=success'));
    }
}
  // links breadcrumb
    if($_SESSION['customer_id']) {
      $check_customer = $db->Execute("select customers_id, customers_firstname, customers_lastname, customers_password, customers_email_address, customers_default_address_id from " . TABLE_CUSTOMERS . " where customers_id = '" . $_SESSION['customer_id'] . "'");
      $email= $check_customer->fields['customers_email_address'];
      $name= $check_customer->fields['customers_firstname'] . ' ' . $check_customer->fields['customers_lastname'];
  }
  
  // include template specific file name defines
$define_page = zen_get_file_directory(DIR_WS_LANGUAGES . $_SESSION['language'] . '/html_includes/', FILENAME_DEFINE_LINKS_SUBMIT, 'false');
  
  $breadcrumb->add(NAVBAR_TITLE_1, zen_href_link(FILENAME_LINKS, '', 'NONSSL'));
  if (isset($GET['lPath'])) {
    $link_categories_value = $db->Execute("select * from " . TABLE_LINK_CATEGORIES_DESCRIPTION . " where link_categories_id = '" . (int)$GET['lPath'] . "' and language_id = '" . (int)$_SESSION['languages_id'] . "' ");
    $breadcrumb->add($link_categories_value->fields['link_categories_name'], zen_href_link(FILENAME_LINKS, 'lPath=' . $link_categories_value->fields['link_categories_id'], 'NONSSL'));
  } 
  $breadcrumb->add(NAVBAR_TITLE_2);
?>