<?php
/**
 * main_product_image module
 *
 * @package templateSystem
 * @copyright Copyright 2005-2006 breakmyzencart.com
 * @copyright Portions Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: main_product_image.php,v 1.2 2006/04/11 22:00:55 tim Exp $
 */
 
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
if(is_int(strrpos($products_image, ','))){
  $temp_products_images = split ( ',', $products_image );
  $temp_products_imagesNum = count($temp_products_images);
  for($i = 0;$i < $temp_products_imagesNum; $i++){
    $products_image_extension[$i] = substr($temp_products_images[$i], strrpos($temp_products_images[$i], '.'));
    $products_image_base[$i] = substr($temp_products_images[$i], 0, strrpos($temp_products_images[$i], '.'));
    $products_image_small[$i] = DIR_WS_IMAGES .$products_image_base[$i] . $products_image_extension[$i];
    $products_image_medium[$i] = DIR_WS_IMAGES .substr_replace($products_image_base[$i],'l/',0,2). $products_image_extension[$i];
    $products_image_large[$i]  = DIR_WS_IMAGES .substr_replace($products_image_base[$i],'v/',0,2).  $products_image_extension[$i];
    }
  //rsort($products_image_small);
  //rsort($products_image_medium);
  //rsort($products_image_large);
}else{
  $products_image_extension = substr($products_image, strrpos($products_image, '.'));
  $products_image_base = substr($products_image, 0, strrpos($products_image, '.'));
  $products_image_medium = DIR_WS_IMAGES . substr_replace($products_image_base,'l/',0,2). $products_image_extension;
  $products_image_large  = DIR_WS_IMAGES . substr_replace($products_image_base,'v/',0,2).  $products_image_extension;

  
}
  /*
    echo
    'Base ' . $products_image_base . ' - ' . $products_image_extension . '<br>' .
    'Medium ' . $products_image_medium . '<br><br>' .
    'Large ' . $products_image_large . '<br><br>';
  */
// to be built into a single variable string
?>