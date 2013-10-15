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
  $review_query_raw = "select p.*, pd.faqs_name
                   from " . TABLE_FAQS . " p, " . TABLE_FAQS_DESCRIPTION . " pd
                   where p.faqs_id = '" . (int)$_GET['faqs_id'] . "'
                   and p.faqs_status = '1'
                   and p.faqs_id = pd.faqs_id
                   and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'";
  $review = $db->Execute($review_query_raw);
    $faqs_name = $review->fields['faqs_name'];
// set image
//  $faqs_image = $review->fields['faqs_image'];
  if ($review->fields['faqs_image'] == '' and FAQS_IMAGE_NO_IMAGE_STATUS == '1') {
    $faqs_image = FAQS_IMAGE_NO_IMAGE;
  } else {
    $faqs_image = $review->fields['faqs_image'];
  }
  require(DIR_WS_MODULES . 'require_languages.php');
  $breadcrumb->add(NAVBAR_TITLE);
?>