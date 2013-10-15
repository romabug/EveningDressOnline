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
?>
<?php
$faqs_image_extention = substr($faqs_image, strrpos($faqs_image, '.'));
$faqs_image_base = ereg_replace($faqs_image_extention, '', $faqs_image);
$faqs_image_medium = $faqs_image_base . IMAGE_SUFFIX_MEDIUM . $faqs_image_extention;
$faqs_image_large = $faqs_image_base . IMAGE_SUFFIX_LARGE . $faqs_image_extention;

// check for a medium image else use small
if (!file_exists(DIR_WS_IMAGES . 'medium/' . $faqs_image_medium)) {
  $faqs_image_medium = DIR_WS_IMAGES . $faqs_image;
} else {
  $faqs_image_medium = DIR_WS_IMAGES . 'medium/' . $faqs_image_medium;
}
// check for a large image else use medium else use small
if (!file_exists(DIR_WS_IMAGES . 'large/' . $faqs_image_large)) {
  if (!file_exists(DIR_WS_IMAGES . 'medium/' . $faqs_image_medium)) {
    $faqs_image_large = DIR_WS_IMAGES . $faqs_image;
  } else {
    $faqs_image_large = DIR_WS_IMAGES . 'medium/' . $faqs_image_medium;
  }
} else {
  $faqs_image_large = DIR_WS_IMAGES . 'large/' . $faqs_image_large;
}
/*
echo
'Base ' . $faqs_image_base . ' - ' . $faqs_image_extention . '<br>' .
'Medium ' . $faqs_image_medium . '<br><br>' .
'Large ' . $faqs_image_large . '<br><br>';
*/
// to be built into a single variable string

?>
<script language="javascript" type="text/javascript"><!--
document.write('<?php echo '<a href="javascript:popupWindow(\\\'' . zen_href_link(FILENAME_POPUP_IMAGE, 'pID=' . $_GET['faqs_id']) . '\\\')">' . zen_image($faqs_image_medium, addslashes($faqs_name), MEDIUM_IMAGE_WIDTH, MEDIUM_IMAGE_HEIGHT, 'hspace="5" vspace="5"') . '<br />' . TEXT_CLICK_TO_ENLARGE . '</a>'; ?>');
//--></script>
<noscript>
<?php
  echo '<a href="' . zen_href_link($faqs_image_large) . '" target="_blank">' . zen_image($faqs_image_medium, $faqs_name, MEDIUM_IMAGE_WIDTH, MEDIUM_IMAGE_HEIGHT, 'hspace="5" vspace="5"') . '<br />' . TEXT_CLICK_TO_ENLARGE . '</a>';
?>
</noscript>
