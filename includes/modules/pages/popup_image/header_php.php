<?php
/**
 * Pop up Image Header
 *
 * @package page
 * @copyright Copyright 2005-2006 breakmyzencart.com
 * @copyright Portions Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: header_php.php,v 1.4 2006/04/11 22:00:55 tim Exp $
 */
/**
 * Header code file for the product-larger-images popup window
 *
 */

// This should be first line of the script:
  $zco_notifier->notify('NOTIFY_HEADER_START_POPUP_IMAGES_ADDITIONAL');

  $_SESSION['navigation']->remove_current_page();

  $products_values_query = "SELECT pd.products_name, p.products_image
                            FROM " . TABLE_PRODUCTS . " p
                            left join " . TABLE_PRODUCTS_DESCRIPTION . " pd
                            on p.products_id = pd.products_id
                            WHERE p.products_status = 1
                            and p.products_id = :productsID
                            and pd.language_id = :languagesID ";

  $products_values_query = $db->bindVars($products_values_query, ':productsID', $_GET['pID'], 'integer');
  $products_values_query = $db->bindVars($products_values_query, ':languagesID', $_SESSION['languages_id'], 'integer');

  $products_values = $db->Execute($products_values_query);
  $products_image = $products_values->fields['products_image'];

  //auto replace with defined missing image
  if ($products_image == '' and PRODUCTS_IMAGE_NO_IMAGE_STATUS == '1') {
    $products_image = PRODUCTS_IMAGE_NO_IMAGE;
  }
if(is_int(strrpos($products_image, ','))){
  $temp_products_images = split (',', $products_image );
  $temp_products_imagesNum = count($temp_products_images);
  for($i = 0;$i < $temp_products_imagesNum; $i++){
    $products_image_extension[$i] = substr($temp_products_images[$i], strrpos($temp_products_images[$i], '.'));
    $products_image_base[$i] = substr($temp_products_images[$i], 0, strrpos($temp_products_images[$i], '.'));
    $products_image_small[$i] = DIR_WS_IMAGES . $products_image_base[$i] . $products_image_extension[$i];
    $products_image_medium[$i] = DIR_WS_IMAGES .  substr_replace($products_image_base[$i],'l/',0,2). $products_image_extension[$i];
    $products_image_large[$i]  = DIR_WS_IMAGES .  substr_replace($products_image_base[$i],'v/',0,2). $products_image_extension[$i];
  } 
}else{
  $products_image_extension = substr($products_image, strrpos($products_image, '.'));
  $products_image_base = substr($products_image, 0, strrpos($products_image, '.'));
  $products_image_small = DIR_WS_IMAGES . $products_image_base. $products_image_extension;
  $products_image_medium = DIR_WS_IMAGES . substr_replace($products_image_base,'l/',0,2). $products_image_extension;
  $products_image_large = DIR_WS_IMAGES . substr_replace($products_image_base,'v/',0,2).  $products_image_extension;
}
  // This should be last line of the script:
  $zco_notifier->notify('NOTIFY_HEADER_END_POPUP_IMAGES');
