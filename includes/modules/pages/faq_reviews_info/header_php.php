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
  if (isset($_GET['reviews_id']) && zen_not_null($_GET['reviews_id']) && isset($_GET['faqs_id']) && zen_not_null($_GET['faqs_id'])) {
// count reviews for additional link
// if review must be approved or disabled do not show review
    $review_status = " and r.status = '1'";
    $reviews_count_query = "select count(*) as count from " . TABLE_FAQ_REVIEWS . " r, "
                                                       . TABLE_FAQ_REVIEWS_DESCRIPTION . " rd
                       where r.faqs_id = '" . (int)$_GET['faqs_id'] . "'
                       and r.reviews_id = rd.reviews_id
                       and rd.languages_id = '" . (int)$_SESSION['languages_id'] . "'" .
                       $review_status;
    $reviews_count = $db->Execute($reviews_count_query);
    $reviews_counter = $reviews_count->fields['count'];
// if review must be approved or disabled do not show review
    $review_status = " and r.status = '1'";
    $review_info_check_query = "select count(*) as total
                           from " . TABLE_FAQ_REVIEWS . " r, " . TABLE_FAQ_REVIEWS_DESCRIPTION . " rd
                           where r.reviews_id = '" . (int)$_GET['reviews_id'] . "'
                           and r.faqs_id = '" . (int)$_GET['faqs_id'] . "'
                           and r.reviews_id = rd.reviews_id
                           and rd.languages_id = '" . (int)$_SESSION['languages_id'] . "'" .
                           $review_status;
    $review_info_check = $db->Execute($review_info_check_query);
    if ($review_info_check->fields['total'] < 1) {
      zen_redirect(zen_href_link(FILENAME_FAQ_REVIEWS, zen_get_all_get_params(array('reviews_id'))));
    }
  } else {
    zen_redirect(zen_href_link(FILENAME_FAQ_REVIEWS, zen_get_all_get_params(array('reviews_id'))));
  }
  $sql = "update " . TABLE_FAQ_REVIEWS . "
          set reviews_read = reviews_read+1
          where reviews_id = '" . (int)$_GET['reviews_id'] . "'";
  $db->Execute($sql);
  $review_info_query = "select rd.reviews_text, r.reviews_rating, r.reviews_id, r.customers_name,
                          r.date_added, r.reviews_read, p.*, pd.faqs_name
                   from " . TABLE_FAQ_REVIEWS . " r, " . TABLE_FAQ_REVIEWS_DESCRIPTION . " rd, "
                          . TABLE_FAQS . " p, " . TABLE_FAQS_DESCRIPTION . " pd
                   where r.reviews_id = '" . (int)$_GET['reviews_id'] . "'
                   and r.reviews_id = rd.reviews_id
                   and rd.languages_id = '" . (int)$_SESSION['languages_id'] . "'
                   and r.faqs_id = p.faqs_id
                   and p.faqs_status = '1'
                   and p.faqs_id = pd.faqs_id
                   and pd.language_id = '". (int)$_SESSION['languages_id'] . "'" .
                   $review_status;
  $review_info = $db->Execute($review_info_query);
  $faqs_name = $review_info->fields['faqs_name'];
// set image
//  $faqs_image = $review_info->fields['faqs_image'];
  if ($review_info->fields['faqs_image'] == '' and FAQS_IMAGE_NO_IMAGE_STATUS == '1') {
    $faqs_image = FAQS_IMAGE_NO_IMAGE;
  } else {
    $faqs_image = $review_info->fields['faqs_image'];
  }
  require(DIR_WS_MODULES . 'require_languages.php');
  $breadcrumb->add(NAVBAR_TITLE);
?>