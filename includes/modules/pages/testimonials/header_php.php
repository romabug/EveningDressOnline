<?php
/**
 * testimonials Page
 * 
 * @package page
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: header_php.php 1.3 $
 */

  $_SESSION['navigation']->remove_current_page();

  require(DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));

// include template specific file name defines
  $define_page = zen_get_file_directory(DIR_WS_LANGUAGES . $_SESSION['language'] . '/html_includes/', FILENAME_DEFINE_TESTIMONIALS, 'false');

  require(DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));


// if review must be approved or is disabled, do not show review
$review_status = " AND r.status = 1";
$reviews_query_raw = "SELECT r.reviews_id, left(rd.reviews_text, 100) AS reviews_text, r.reviews_rating, r.date_added, p.products_id, pd.products_name, p.products_image, r.customers_name 
                      FROM " . TABLE_REVIEWS . " r, " . TABLE_REVIEWS_DESCRIPTION . " rd, " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd 
                      WHERE p.products_status = '1' 
                      AND p.products_id = r.products_id 
                      AND r.reviews_id = rd.reviews_id 
                      AND p.products_id = pd.products_id 
                      AND pd.language_id = :languageID AND r.reviews_is_featured = 1
                      AND rd.languages_id = :languageID" . $review_status . " 
                      ORDER BY r.reviews_id DESC";

$reviews_query_raw = $db->bindVars($reviews_query_raw, ':languageID', $_SESSION['languages_id'], 'integer');
$reviews_query_raw = $db->bindVars($reviews_query_raw, ':languageID', $_SESSION['languages_id'], 'integer');


$reviews_split = new splitPageResults($reviews_query_raw, MAX_DISPLAY_NEW_REVIEWS);

$breadcrumb->add(NAVBAR_TITLE);

?>
