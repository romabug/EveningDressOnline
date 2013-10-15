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
    <td class="breadCrumb" colspan="2"><?php echo $breadcrumb->trail(BREAD_CRUMBS_SEPARATOR); ?></td>
  </tr>
  <tr>
    <td class="pageHeading"><h1><?php echo $breadcrumb->last(); ?></h1></td>
<?php
  if ($do_filter_list) {
  $form = zen_draw_form('filter', zen_href_link(FILENAME_FAQS), 'get') . TEXT_SHOW;
?>
    <td align="right" valign="bottom" class="main"><?php echo $form ?>
<?php
  if (!$getoption_set) {
    echo zen_draw_hidden_field('fcPath', $fcPath);
  } else {
    echo zen_draw_hidden_field($get_option_variable, $_GET[$get_option_variable]);
  }
  if (isset($_GET['typefilter'])) echo zen_draw_hidden_field('typefilter', $_GET['typefilter']);
  echo zen_draw_hidden_field('sort', $_GET['sort']);
  echo zen_draw_hidden_field('main_page', FILENAME_FAQS);
  echo zen_draw_pull_down_menu('filter_id', $options, (isset($_GET['filter_id']) ? $_GET['filter_id'] : ''), 'onchange="this.form.submit()"');
?>
    </form></td>
<?php
  }
?>
  </tr>
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
    <td colspan="2" class="main"><?php include(DIR_WS_MODULES . zen_get_module_directory(FILENAME_FAQ_LISTING)); ?></td>
  </tr>
</table>
<?php
//// bof: faq_categories error
if ($error_faq_categories==true) {
  // verify lost faq_category and reset faq_category
  $check_faq_category = $db->Execute("select faq_categories_id from " . TABLE_FAQ_CATEGORIES . " where faq_categories_id='" . $fcPath . "'");
  if ($check_faq_category->RecordCount() == 0) {
    $new_faqs_faq_category_id = '0';
    $fcPath= '';
  }
?>
<?php
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
} // !EOF
?>
<?php } //// eof: faq_categories error ?>
<?php
//// bof: faq_categories
$show_display_faq_category = $db->Execute(SQL_SHOW_FAQ_INFO_LISTING_BELOW);
if ($error_faq_categories == false and $show_display_faq_category->RecordCount() > 0) {
?>
<?php
  $show_display_faq_category = $db->Execute(SQL_SHOW_FAQ_INFO_LISTING_BELOW);
  while (!$show_display_faq_category->EOF) {
?>
<?php
    if ($show_display_faq_category->fields['configuration_key'] == 'SHOW_FAQ_INFO_LISTING_BELOW_FEATURED_FAQS') {
      include(DIR_WS_MODULES . zen_get_module_directory(FILENAME_FEATURED_FAQS_MODULE));
    }
?>
<?php
    if ($show_display_faq_category->fields['configuration_key'] == 'SHOW_FAQ_INFO_LISTING_BELOW_SPECIALS_FAQS') {
      include(DIR_WS_MODULES . zen_get_module_directory(FILENAME_SPECIALS_INDEX));
    }
?>
<?php
    if ($show_display_faq_category->fields['configuration_key'] == 'SHOW_FAQ_INFO_LISTING_BELOW_NEW_FAQS') {
      require(DIR_WS_MODULES . zen_get_module_directory(FILENAME_NEW_FAQS));
    }
?>
<?php
    if ($show_display_faq_category->fields['configuration_key'] == 'SHOW_FAQ_INFO_LISTING_BELOW_UPCOMING') {
      include(DIR_WS_MODULES . zen_get_module_directory(FILENAME_UPCOMING_FAQS));
    }
?>
<?php
  $show_display_faq_category->MoveNext();
  } // !EOF
?>
<?php
} //// eof: faq_categories
?>
