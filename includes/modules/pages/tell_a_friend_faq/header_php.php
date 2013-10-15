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
// $Id: faq_manager.php 001 2005-03-27 dave@open-operations.com
//
  if (!$_SESSION['customer_id'] && (ALLOW_GUEST_TO_TELL_A_FRIEND == 'false')) {
    $_SESSION['navigation']->set_snapshot();
	$messageStack->add_session('login', 'You must be logged in to send a faq to a friend');
    zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'SSL'));
  }
  $valid_faq = false;
  if (isset($_GET['faqs_id'])) {
    $faq_info_query = "select pd.faqs_name
                           from " . TABLE_FAQS . " p, " . TABLE_FAQS_DESCRIPTION . " pd
                           where p.faqs_status = '1'
                           and p.faqs_id = '" . (int)$_GET['faqs_id'] . "'
                           and p.faqs_id = pd.faqs_id
                           and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'";
    $faq_info = $db->Execute($faq_info_query);
    if ($faq_info->RecordCount() > 0) {
      $valid_faq = true;
    }
  }
  if ($valid_faq == false) {
    zen_redirect(zen_href_link(zen_get_info_faq_page($_GET['faqs_id']), 'faqs_id=' . $_GET['faqs_id']));
  }
  require(DIR_WS_MODULES . 'require_languages.php');
  if (isset($_GET['action']) && ($_GET['action'] == 'process')) {
    $error = false;
    $to_email_address = zen_db_prepare_input($_POST['to_email_address']);
    $to_name = zen_db_prepare_input($_POST['to_name']);
    $from_email_address = zen_db_prepare_input($_POST['from_email_address']);
    $from_name = zen_db_prepare_input($_POST['from_name']);
    $message = zen_db_prepare_input($_POST['message']);
    if (empty($from_name)) {
      $error = true;
      $messageStack->add('friend', ERROR_FROM_NAME);
    }
    if (!zen_validate_email($from_email_address)) {
      $error = true;
      $messageStack->add('friend', ERROR_FROM_ADDRESS);
    }
    if (empty($to_name)) {
      $error = true;
      $messageStack->add('friend', ERROR_TO_NAME);
    }
    if (!zen_validate_email($to_email_address)) {
      $error = true;
      $messageStack->add('friend', ERROR_TO_ADDRESS);
    }
    if ($error == false) {
      $email_subject = sprintf(EMAIL_TEXT_SUBJECT, $from_name, STORE_NAME);
      $email_body = sprintf(EMAIL_TEXT_GREET, $to_name);
	  $email_body .= sprintf(EMAIL_TEXT_INTRO,$from_name, $faq_info->fields['faqs_name'], STORE_NAME) . "\n\n";
	  $html_msg['EMAIL_GREET'] = str_replace('\n','',sprintf(EMAIL_TEXT_GREET, $to_name));
	  $html_msg['EMAIL_INTRO'] = sprintf(EMAIL_TEXT_INTRO,$from_name, $faq_info->fields['faqs_name'], STORE_NAME);
      if (zen_not_null($message)) {
        $email_body .= sprintf(EMAIL_TELL_A_FRIEND_MESSAGE, $from_name)  . "\n\n";
        $email_body .= strip_tags($message) . "\n\n" . EMAIL_SEPARATOR . "\n\n";
        $html_msg['EMAIL_MESSAGE_HTML'] = sprintf(EMAIL_TELL_A_FRIEND_MESSAGE, $from_name).'<br />';
        $html_msg['EMAIL_MESSAGE_HTML'] .= strip_tags($message);
      } else {
        $email_body .= '';
        $html_msg['EMAIL_MESSAGE_HTML'] = '';
      }
      $email_body .= sprintf(EMAIL_TEXT_LINK, zen_href_link(zen_get_info_faq_page($_GET['faqs_id']), 'faqs_id=' . $_GET['faqs_id']), '', false) . "\n\n" .
                     sprintf(EMAIL_TEXT_SIGNATURE, STORE_NAME . "\n" . HTTP_SERVER . DIR_WS_CATALOG . "\n");
      $html_msg['EMAIL_TEXT_HEADER'] = EMAIL_TEXT_HEADER;
      $html_msg['EMAIL_FAQ_LINK'] = sprintf(str_replace('\n\n','<br />',EMAIL_TEXT_LINK), '<a href="'.zen_href_link(FILENAME_FAQ_INFO, 'faqs_id=' . $_GET['faqs_id']).'">'.$faq_info->fields['faqs_name'].'</a>' , '', false);
      $html_msg['EMAIL_TEXT_SIGNATURE'] = sprintf(str_replace('\n','',EMAIL_TEXT_SIGNATURE), '' );
// include disclaimer
      $email_body .= "\n\n" . EMAIL_ADVISORY . "\n\n";
//send the email
      zen_mail($to_name, $to_email_address, $email_subject, $email_body, $from_name, $from_email_address, $html_msg, 'tell_a_friend');
// send additional emails
      if (SEND_EXTRA_TELL_A_FRIEND_EMAILS_TO_STATUS == '1' and SEND_EXTRA_TELL_A_FRIEND_EMAILS_TO !='') {
        if ($_SESSION['customer_id']) {
          $account_query = "select customers_firstname, customers_lastname, customers_email_address
                            from " . TABLE_CUSTOMERS . "
                            where customers_id = '" . (int)$_SESSION['customer_id'] . "'";
          $account = $db->Execute($account_query);
        }
	$extra_info=email_collect_extra_info($from_name,$from_email_address, $account->fields['customers_firstname'] . ' ' . $account->fields['customers_lastname'] , $account->fields['customers_email_address'] );
	$html_msg['EXTRA_INFO'] = $extra_info['HTML'];
    zen_mail('', SEND_EXTRA_TELL_A_FRIEND_EMAILS_TO, SEND_EXTRA_TELL_A_FRIEND_EMAILS_TO_SUBJECT . ' ' . $email_subject,
          $email_body . $extra_info['TEXT'], STORE_NAME, EMAIL_FROM, $html_msg, 'tell_a_friend_extra');
      }
      $messageStack->add_session('header', sprintf(TEXT_EMAIL_SUCCESSFUL_SENT, $faq_info->fields['faqs_name'], zen_output_string_protected($to_name)), 'success');
      zen_redirect(zen_href_link(zen_get_info_faq_page($_GET['faqs_id']), 'faqs_id=' . $_GET['faqs_id']));
    }
  } elseif ($_SESSION['customer_id']) {
    $account_query = "select customers_firstname, customers_lastname, customers_email_address
                      from " . TABLE_CUSTOMERS . "
                      where customers_id = '" . (int)$_SESSION['customer_id'] . "'";
    $account = $db->Execute($account_query);
    $from_name = $account->fields['customers_firstname'] . ' ' . $account->fields['customers_lastname'];
    $from_email_address = $account->fields['customers_email_address'];
  }
  $breadcrumb->add(NAVBAR_TITLE);
?>