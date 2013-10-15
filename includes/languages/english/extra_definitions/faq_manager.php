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
define('BOX_HEADING_FAQ_CATEGORIES_CSS', 'Knowledgebase');
define('FAQ_CATEGORIES_CSS_SEARCH_TEXT','Search your questions?');

define('BOX_HEADING_FAQ_CATEGORIES', 'FAQ Categories');
define('BOX_HEADING_WHATS_NEW', 'New FAQs');
define('FAQ_CATEGORIES_BOX_HEADING_WHATS_NEW', 'New FAQs ...');
define('BOX_HEADING_FEATURED_FAQS', 'Featured');
define('FAQ_CATEGORIES_BOX_HEADING_FEATURED_FAQS', 'Featured FAQs ...');
define('TEXT_NO_FEATURED_FAQS', 'More featured faqs will be added soon. Please check back later.');
define('TEXT_NO_ALL_FAQS', 'More Help will be added soon. Please check back later.');
define('FAQ_CATEGORIES_BOX_HEADING_FAQS_ALL', 'All FAQs ...');
define('FAQ_CATEGORIES_BOX_HEADING_SPECIALS','Specials ...');
define('BOX_REVIEWS_WRITE_REVIEW', 'Write a review on this faq.');
define('BOX_REVIEWS_NO_REVIEWS', 'There are currently no faq reviews.');
define('BOX_MANUFACTURER_INFO_OTHER_FAQS', 'Other faqs');
define('BOX_TELL_A_FRIEND_TEXT', 'Tell someone you know about this faq.');
define('JS_REVIEW_RATING', '* You must rate the faq for your review.');
define('FAQ_CATEGORY_COMPANY', 'Company Details');
define('FAQ_CATEGORY_PERSONAL', 'Your Personal Details');
define('FAQ_CATEGORY_ADDRESS', 'Your Address');
define('FAQ_CATEGORY_CONTACT', 'Your Contact Information');
define('FAQ_CATEGORY_OPTIONS', 'Options');
define('FAQ_CATEGORY_PASSWORD', 'Your Password');
define('FAQ_CATEGORY_LOGIN', 'Login');
define('TEXT_DISPLAY_NUMBER_OF_FAQS', 'Displaying <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> faqs)');
define('TEXT_DISPLAY_NUMBER_OF_FAQS_NEW', 'Displaying <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> new faqs)');
define('TEXT_DISPLAY_NUMBER_OF_FAQS_FEATURED_FAQS', 'Displaying <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> featured faqs)');
define('TEXT_DISPLAY_NUMBER_OF_FAQS_ALL', 'Displaying <strong>%d</strong> to <strong>%d</strong> (of <strong>%d</strong> faqs)');
define('TEXT_SORT_FAQS', 'Sort faqs ');
define('TEXT_NO_FAQ_REVIEWS', 'There are currently no faq reviews.');
define('TEXT_NO_NEW_FAQS', 'More new faqs will be added soon. Please check back later.');
define('WARNING_DOWNLOAD_DIRECTORY_NON_EXISTENT', 'Warning: The downloadable faqs directory does not exist: ' . DIR_FS_DOWNLOAD . '. Downloadable faqs will not work until this directory is valid.');
define('REDEEMED_RESTRICTIONS', ' [FAQ-Faq Category restrictions apply]');
define('TEXT_INVALID_COUPON_FAQ', 'This coupon code is not valid for any faq currently in your cart');
  define('FAQS_ORDER_QTY_TEXT_IN_CART','Quantity in Cart: ');
  define('FAQS_ORDER_QTY_TEXT','Add to Cart: ');
  define('FAQ_PRICE_DISCOUNT_PREFIX','Save:&nbsp;');
  define('FAQ_PRICE_DISCOUNT_PERCENTAGE','% off');
  define('FAQ_PRICE_DISCOUNT_AMOUNT','&nbsp;off');
  define('FAQ_PRICE_SALE','Sale:&nbsp;');
define('FAQS_PRICE_IS_FREE_TEXT','It\'s Free!');
define('FAQS_PRICE_IS_CALL_FOR_PRICE_TEXT','Call for Price');
  define('FAQS_QUANTITY_MIN_TEXT_LISTING','Min:');
  define('FAQS_QUANTITY_UNIT_TEXT_LISTING','Units:');
  define('FAQS_QUANTITY_IN_CART_LISTING','In cart:');
  define('FAQS_QUANTITY_ADD_ADDITIONAL_LISTING','Add Additional:');
  define('FAQS_QUANTITY_MAX_TEXT_LISTING','Max:');
  define('TEXT_FAQS_MIX_OFF','*Mixed OFF');
  define('TEXT_FAQS_MIX_ON','*Mixed ON');
  define('TEXT_FAQS_MIX_OFF_SHOPPING_CART','*Mixed Options Values is OFF');
  define('TEXT_FAQS_MIX_ON_SHOPPING_CART','*Mixed Option Values is ON');
  define('ERROR_FAQ','FAQ: ');
  define('ERROR_FAQ_QUANTITY_MIN',' ... Minimum Quantity errors - ');
  define('ERROR_FAQ_QUANTITY_UNITS',' ... Quantity Units errors - ');
  define('ERROR_FAQ_OPTION_SELECTION',' ... Invalid Option Values Selected ');
  define('ERROR_FAQ_QUANTITY_ORDERED','You ordered a total of: ');
  define('ERROR_FAQ_QUANTITY_MAX',' ... Maximum Quantity errors - ');
  define('ERROR_FAQ_QUANTITY_MIN_SHOPPING_CART',' ... Minimum Quantity errors - ');
  define('ERROR_FAQ_QUANTITY_UNITS_SHOPPING_CART',' ... Quantity Units errors - ');
  define('ERROR_FAQ_QUANTITY_MAX_SHOPPING_CART',' ... Maximum Quantity errors - ');
define('TABLE_HEADING_FEATURED_FAQS','Featured FAQs');
define('TABLE_HEADING_NEW_FAQS', 'New FAQs For %s');
define('TABLE_HEADING_UPCOMING_FAQS', 'Upcoming FAQs');
define('META_TAG_FAQS_PRICE_IS_FREE_TEXT','It\'s Free!');
define('TEXT_INFO_SORT_BY_FAQS_NAME', 'FAQ Name');
define('TEXT_INFO_SORT_BY_FAQS_NAME_DESC', 'FAQ Name - desc');
define('TEXT_INFO_SORT_BY_FAQS_CATEGORY', 'Category');
define('TEXT_INFO_SORT_BY_FAQS_ADMIN_SORT', 'Store defined order');
define('TEXT_INFO_SORT_BY_FAQS_PRICE', 'Price - low to high');
define('TEXT_INFO_SORT_BY_FAQS_PRICE_DESC', 'Price - high to low');
define('TEXT_INFO_SORT_BY_FAQS_MODEL', 'Model');
define('TEXT_INFO_SORT_BY_FAQS_DATE_DESC', 'Date Added - New to Old');
define('TEXT_INFO_SORT_BY_FAQS_DATE', 'Date Added - Old to New');
define('TEXT_INFO_SORT_BY_FAQS_SORT_ORDER', 'Default Display');
define('SQL_SHOW_FAQ_INFO_FAQ_CATEGORY', "select configuration_key, configuration_value from " . TABLE_CONFIGURATION . " where configuration_key RLIKE 'SHOW_FAQ_INFO_FAQ_CATEGORY' and configuration_value > 0 order by configuration_value");
define('SQL_SHOW_FAQ_INFO_MAIN',"select configuration_key, configuration_value from " . TABLE_CONFIGURATION . " where configuration_key RLIKE 'SHOW_FAQ_INFO_MAIN' and configuration_value > 0 order by configuration_value");
define('SQL_SHOW_FAQ_INFO_MISSING',"select configuration_key, configuration_value from " . TABLE_CONFIGURATION  . " where configuration_key RLIKE 'SHOW_FAQ_INFO_MISSING' and configuration_value > 0 order by configuration_value");
define('SQL_SHOW_FAQ_INFO_LISTING_BELOW',"select configuration_key, configuration_value from " . TABLE_CONFIGURATION . " where configuration_key RLIKE 'SHOW_FAQ_INFO_LISTING_BELOW' and configuration_value > 0 order by configuration_value");
define('BUTTON_RETURN_TO_OO_LIST_ALT', 'Return To List');
define('BUTTON_IMAGE_SUBMIT_FAQ', 'button_ask_a_question.gif');
define('BUTTON_SUBMIT_FAQ_ALT', 'Ask a Question');
?>