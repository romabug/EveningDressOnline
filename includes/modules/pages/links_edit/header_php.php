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
//  $Id: links_manager.php 2004-11-19 dave@open-operations.com
//
if (ALLOW_LINKS_SUBMISSION == 'false') {
    zen_redirect(zen_href_link(FILENAME_NO_LINKS, '', 'SSL'));
}
  if (!$_SESSION['customer_id']) {
    $_SESSION['navigation']->set_snapshot();
    zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

   $links_id = $_GET['links_id'];

  
  require(DIR_WS_MODULES . 'require_languages.php');
  require(DIR_WS_FUNCTIONS . 'links.php');
  $process = false;
  if (isset($_POST['action']) && ($_POST['action'] == 'process')) {
    $process = true;
    $links_title = zen_db_prepare_input($_POST['links_title']);
    $links_url = zen_db_prepare_input($_POST['links_url']);
    $links_category = zen_db_prepare_input($_POST['links_category']);
    $links_description = zen_db_prepare_input($_POST['links_description']);
    $links_image = zen_db_prepare_input($_POST['links_image']);
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
      if($links_image == 'http://') {
        $links_image = '';
      }
      // default values
      $links_last_modified = 'now()'; 
      $sql_data_array = array('links_url' => $links_url,
                              'links_image_url' => $links_image,
                              'links_contact_name' => $links_contact_name,
                              'links_contact_email' => $links_contact_email,
                              'links_reciprocal_url' => $links_reciprocal_url, 
                              'links_last_modified' => $links_last_modified);
      zen_db_perform(TABLE_LINKS, $sql_data_array, 'update', "links_id = '" . $links_id . "'");

      $categories = $db->Execute("select link_categories_id from " . TABLE_LINK_CATEGORIES_DESCRIPTION . " where link_categories_name = '" . $links_category . "' and language_id = '" . (int)$_SESSION['languages_id'] . "' ");
      $link_categories_id = $categories->fields['link_categories_id'];

	  $sql_data_array = array('link_categories_id' => $link_categories_id);
      zen_db_perform(TABLE_LINKS_TO_LINK_CATEGORIES, $sql_data_array, 'update', "links_id = '" . $links_id . "'");

      $language_id = (int)$_SESSION['languages_id'];
      $sql_data_array = array('language_id' => $language_id, 
                              'links_title' => $links_title,
                              'links_description' => $links_description);
      zen_db_perform(TABLE_LINKS_DESCRIPTION, $sql_data_array, 'update', "links_id = '" . $links_id . "'");

      $messageStack->add_session('submit_link', SUCCESS_LINK_UPDATED, 'success');
      zen_redirect(zen_href_link(FILENAME_LINKS, 'lPath=' . $link_categories_id));
    }
  }
 

   $link = $db->Execute("select *
                    from   " . TABLE_LINKS . "
                    where  links_id = '" . (int)$_GET['links_id'] . "'");

   $linkd = $db->Execute("select *
                    from   " . TABLE_LINKS_DESCRIPTION . "
                    where  links_id = '" . (int)$_GET['links_id'] . "'");
 
    if($_SESSION['customer_id']) {
      $check_customer = $db->Execute("select customers_id, customers_firstname, customers_lastname, customers_password, customers_email_address, customers_default_address_id from " . TABLE_CUSTOMERS . " where customers_id = '" . $_SESSION['customer_id'] . "'");
      $email= $check_customer->fields['customers_email_address'];
      $name= $check_customer->fields['customers_firstname'] . ' ' . $check_customer->fields['customers_lastname'];
  }
  $breadcrumb->add(NAVBAR_TITLE);
  $_SESSION['navigation']->remove_current_page();
?>