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
<?php
if ($show_welcome == 'true') {
?>
  <tr>
    <td class="pageHeading"><h1><?php echo HEADING_TITLE; ?></h1></td>
  </tr>
  <tr>
    <td class="greetUser"><?php echo zen_customer_greeting(); ?></td>
  </tr>
<?php if (TEXT_MAIN) { ?>
  <tr>
    <td class="main"><?php echo TEXT_MAIN; ?></td>
  </tr>
<?php } ?>
<?php if (TEXT_INFORMATION) { ?>
  <tr>
    <td class="plainBox"><?php echo TEXT_INFORMATION; ?></td>
  </tr>
<?php } ?>
<?php if (DEFINE_MAIN_PAGE_STATUS == '1') { ?>
  <tr>
    <td class="plainBox"><?php require($define_main_page); ?><br /></td>
  </tr>
<?php } ?>

<?php } else { ?>
  <tr>
    <td class="breadCrumb" colspan="2"><?php echo $breadcrumb->trail(BREAD_CRUMBS_SEPARATOR); ?></td>
  </tr>
  <tr>
    <td class="pageHeading"><h1><?php echo $breadcrumb->last(); ?></h1></td>
  </tr>
<?php } ?>
</table><br />
<table border="0" width="100%" cellspacing="2" cellpadding="2">
<?php
// faq_categories_description
    if ($current_faq_categories_description != '') {
?>
  <tr>
    <td colspan="4">
      <table border="0" width="100%" cellspacing="2" cellpadding="2" class="categoriesdescription">
        <tr class="categoriesdescription">
          <td class="categoriesdescription"><?php echo $current_faq_categories_description;  ?></td>
        </tr>
      </table>
    </td>
  </tr>
<?php } // faq_categories_description ?>
<tr>
<?php
  require(DIR_WS_MODULES . 'pages/faq/faq_category_row.php');
?>
</tr>
</table>
<?php
$show_display_faq_category = $db->Execute(SQL_SHOW_FAQ_INFO_FAQ_CATEGORY);
while (!$show_display_faq_category->EOF) {
  // //  echo 'I found ' . zen_get_module_directory(FILENAME_UPCOMING_FAQS);
?>
<?php if ($show_display_faq_category->fields['configuration_key'] == 'SHOW_FAQ_INFO_FAQ_CATEGORY_FEATURED_FAQS') { ?>
<?php include(DIR_WS_MODULES . zen_get_module_directory(FILENAME_FEATURED_FAQS_MODULE)); ?><?php } ?>
<?php if ($show_display_faq_category->fields['configuration_key'] == 'SHOW_FAQ_INFO_FAQ_CATEGORY_SPECIALS_FAQS') { ?>
<?php include(DIR_WS_MODULES . zen_get_module_directory(FILENAME_SPECIALS_INDEX)); ?><?php } ?>
<?php if ($show_display_faq_category->fields['configuration_key'] == 'SHOW_FAQ_INFO_FAQ_CATEGORY_NEW_FAQS') { ?>
<?php require(DIR_WS_MODULES . zen_get_module_directory(FILENAME_NEW_FAQS)); ?><?php } ?>
<?php if ($show_display_faq_category->fields['configuration_key'] == 'SHOW_FAQ_INFO_FAQ_CATEGORY_UPCOMING') { ?>
<?php include(DIR_WS_MODULES . zen_get_module_directory(FILENAME_UPCOMING_FAQS)); ?><?php } ?>
<?php
  $show_display_faq_category->MoveNext();
} // !EOF
?>
