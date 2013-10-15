<?php
/**
 * unsubscribe header_php.php 
 *
 * @package page
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: header_php.php 3000 2006-02-09 21:11:37Z wilt $
 * modified for newsletter subscribe 20070120 sparrish, notgoddess
 */

// This should be first line of the script:
$zco_notifier->notify('NOTIFY_HEADER_START_UNSUBSCRIBE');

require(DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));

//present the option to unsubscribe, with a confirm button/link
if (isset($_GET['addr'])) {	
  $unsubscribe_address = ereg_replace('[^0-9A-Za-z@._-]', '', $_GET['addr']);

// BEGIN newsletter_subscribe mod 1/3
// ngd::commented out. We want person to enter email here.
//    if ($unsubscribe_address=='') { zen_redirect(zen_href_link(FILENAME_ACCOUNT_NEWSLETTERS)); }
// END newsletter_subscribe mod 1/3

  if ($unsubscribe_address=='')  zen_redirect(zen_href_link(FILENAME_ACCOUNT_NEWSLETTERS));
} else {
  $unsubscribe_address = '';
}

$breadcrumb->add(NAVBAR_TITLE, zen_href_link(FILENAME_UNSUBSCRIBE, '', 'NONSSL'));


// if they clicked on the "confirm unsubscribe" then process it:
if (isset($_GET['action']) && ($_GET['action'] == 'unsubscribe')) {
  $unsubscribe_address = zen_db_prepare_input($_GET['addr']);
  /// Check and see if the email exists in the database, and is subscribed to the newsletter.
  $unsubscribe_count_query = "SELECT 1 
                              FROM " . TABLE_CUSTOMERS . " 
                              WHERE customers_newsletter = '1' 
                              AND customers_email_address = :emailAddress";
  
  $unsubscribe_count_query = $db->bindVars($unsubscribe_count_query, ':emailAddress', $unsubscribe_address, 'string');
  $unsubscribe = $db->Execute($unsubscribe_count_query);

// BEGIN newsletter_subscribe mod 2/3
    if(defined('NEWSONLY_SUBSCRIPTION_ENABLED') &&
       (NEWSONLY_SUBSCRIPTION_ENABLED=='true')) {
      // WEBignite edit start - Remove subscriber - See if there is an associated record
      $subscribers_count_query = "SELECT 1 FROM " . TABLE_SUBSCRIBERS .
        " WHERE email_address = :emailAddress";
      $subscribers_count_query = $db->bindVars($subscribers_count_query, ':emailAddress', $unsubscribe_address, 'string');
      $subscribers = $db->Execute($subscribers_count_query);
      // WEBignite edit end - Remove subscriber

        // WEBignite edit start - added check for record count in subscribers table
      if (($unsubscribe->RecordCount() >0) || ($subscribers->RecordCount() >0)) {
        // WEBignite edit end - Remove subscriber

        // WEBignite edit start - Remove subscriber
        $subscribers_delete_query = "DELETE FROM " . TABLE_SUBSCRIBERS . " WHERE email_address = :emailAddress";
        $subscribers_delete_query = $db->bindVars($subscribers_delete_query, ':emailAddress', $unsubscribe_address, 'string');
        $subscribers_unsubscribe = $db->Execute($subscribers_delete_query);
        // WEBignite edit end - Remove subscriber
    $unsubscribe_query = "UPDATE " . TABLE_CUSTOMERS . " SET customers_newsletter = '0' WHERE customers_email_address = :emailAddress";
    $unsubscribe_query = $db->bindVars($unsubscribe_query, ':emailAddress', $unsubscribe_address, 'string');
    $unsubscribe = $db->Execute($unsubscribe_query);
    $status_display = UNSUBSCRIBE_DONE_TEXT_INFORMATION . $unsubscribe_address;
  } else {
    // If not found, we want to display an error message (This should never occur, unless they try to unsubscribe twice)
    $status_display = UNSUBSCRIBE_ERROR_INFORMATION . $unsubscribe_address;
  }
  } else {
  if ($unsubscribe->RecordCount() >0) {
    $unsubscribe_query = "UPDATE " . TABLE_CUSTOMERS . "
                          SET customers_newsletter = '0'
                          WHERE customers_email_address = :emailAddress";

    $unsubscribe_query = $db->bindVars($unsubscribe_query, ':emailAddress', $unsubscribe_address, 'string');
    $unsubscribe = $db->Execute($unsubscribe_query);
    $status_display = UNSUBSCRIBE_DONE_TEXT_INFORMATION . $unsubscribe_address;
  } else {
    // If not found, we want to display an error message (This should never occur, unless they try to unsubscribe twice)
    $status_display = UNSUBSCRIBE_ERROR_INFORMATION . $unsubscribe_address;
  }
  }
// END newsletter_subscribe mod 2/3
}

// BEGIN newsletter_subscribe mod 3/3
  // add defined page
  $definedpage = zen_get_file_directory(DIR_WS_LANGUAGES . $_SESSION['language'] . '/html_includes/', FILENAME_DEFINE_UNSUBSCRIBE, 'false');
// END newsletter_subscribe mod 3/3

$_SESSION['navigation']->remove_current_page();

// This should be last line of the script:
$zco_notifier->notify('NOTIFY_HEADER_END_UNSUBSCRIBE');
?>