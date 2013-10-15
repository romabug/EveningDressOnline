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
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
    <td class="main">&nbsp;</td>
  </tr>
  <tr>
    <td class="plainBox"><?php echo TEXT_FAQ_NOT_FOUND; ?></td>
  </tr>
  <tr>
    <td align="right"><?php zen_back_link() . zen_image_button(BUTTON_IMAGE_CONTINUE, BUTTON_CONTINUE_ALT) . '</a>'; ?></td>
  </tr>
</table>
<?php
//// bof: missing
$show_display_faq_category = $db->Execute(SQL_SHOW_FAQ_INFO_MISSING);
while (!$show_display_faq_category->EOF) {
?>
<?php
  if ($show_display_faq_category->fields['configuration_key'] == 'SHOW_FAQ_INFO_MISSING_FEATURED_FAQS') {
    include(DIR_WS_MODULES . zen_get_module_directory(FILENAME_FEATURED_FAQS_MODULE));
  }
?>
<?php
  if ($show_display_faq_category->fields['configuration_key'] == 'SHOW_FAQ_INFO_MISSING_SPECIALS_FAQS') {
    include(DIR_WS_MODULES . zen_get_module_directory(FILENAME_SPECIALS_INDEX));
  }
?>
<?php
  if ($show_display_faq_category->fields['configuration_key'] == 'SHOW_FAQ_INFO_MISSING_NEW_FAQS') {
    require(DIR_WS_MODULES . zen_get_module_directory(FILENAME_NEW_FAQS));
  }
?>
<?php
  if ($show_display_faq_category->fields['configuration_key'] == 'SHOW_FAQ_INFO_MISSING_UPCOMING') {
    include(DIR_WS_MODULES . zen_get_module_directory(FILENAME_UPCOMING_FAQS));
  }
?>
<?php
  $show_display_faq_category->MoveNext();
} //// eof: missing
?>