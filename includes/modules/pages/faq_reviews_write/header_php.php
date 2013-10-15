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
  if (!$_SESSION['customer_id']) {
    $_SESSION['navigation']->set_snapshot();
	$messageStack->add_session('login', 'You must be logged in to write a review');
    zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'SSL'));
  }

  $faq_info_query = "select p.*, pd.faqs_name
                         from " . TABLE_FAQS . " p, " . TABLE_FAQS_DESCRIPTION . " pd
                         where p.faqs_id = '" . (int)$_GET['faqs_id'] . "'
                         and p.faqs_status = '1'
                         and p.faqs_id = pd.faqs_id
                         and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'";

  $faq_info = $db->Execute($faq_info_query);

  if (!$faq_info->RecordCount()) {
    zen_redirect(zen_href_link(FILENAME_FAQ_REVIEWS, zen_get_all_get_params(array('action'))));
  }

  $customer_query = "select customers_firstname, customers_lastname
                     from " . TABLE_CUSTOMERS . "
                     where customers_id = '" . (int)$_SESSION['customer_id'] . "'";


  $customer = $db->Execute($customer_query);

  if (isset($_GET['action']) && ($_GET['action'] == 'process')) {
    $rating = zen_db_prepare_input($_POST['rating']);
    $review_text = zen_db_prepare_input($_POST['review_text']);

    $error = false;
    if (strlen($review_text) < REVIEW_TEXT_MIN_LENGTH) {
      $error = true;

      $messageStack->add('review_text', JS_REVIEW_TEXT);
    }

    if (($rating < 1) || ($rating > 5)) {
      $error = true;

      $messageStack->add('review_text', JS_REVIEW_RATING);
    }

    if ($error == false) {
      if (REVIEWS_APPROVAL == '1') {
        $review_status = '0';
      } else {
        $review_status = '1';
      }

      $sql = "insert into " . TABLE_FAQ_REVIEWS . "
                              (faqs_id, customers_id, customers_name, reviews_rating, date_added, status)
                     values ('" . (int)$_GET['faqs_id'] . "', '" . (int)$_SESSION['customer_id'] . "', '" .
                             zen_db_input($customer->fields['customers_firstname']) . ' ' .
                             zen_db_input($customer->fields['customers_lastname']) . "', '" .
                             zen_db_input($rating) . "', now(), " . zen_db_input($review_status) . ")";

      $rs = $db->Execute($sql);

      $insert_id = $db->Insert_ID();

      $sql = "insert into " . TABLE_FAQ_REVIEWS_DESCRIPTION . "
                          (reviews_id, languages_id, reviews_text)
                     values ('" . (int)$insert_id . "', '" . (int)$_SESSION['languages_id'] . "', '" .
                             zen_db_input($review_text) . "')";

      $db->Execute($sql);

      zen_redirect(zen_href_link(FILENAME_FAQ_REVIEWS, zen_get_all_get_params(array('action'))));
    }
  }



  $faqs_name = $faq_info->fields['faqs_name'];
// set image
//  $faqs_image = $faq_info->fields['faqs_image'];
  if ($faq_info->fields['faqs_image'] == '' and FAQS_IMAGE_NO_IMAGE_STATUS == '1') {
    $faqs_image = FAQS_IMAGE_NO_IMAGE;
  } else {
    $faqs_image = $faq_info->fields['faqs_image'];
  }

  require(DIR_WS_MODULES . 'require_languages.php');
  $breadcrumb->add(NAVBAR_TITLE);
?>