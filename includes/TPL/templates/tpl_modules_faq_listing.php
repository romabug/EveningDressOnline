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
<table border="0" width="100%" cellspacing="2" cellpadding="0">
<?php if ( ($listing_split->number_of_rows > 0) && ( (PREV_NEXT_FAQ_BAR_LOCATION == '1') || (PREV_NEXT_FAQ_BAR_LOCATION == '3') ) ) {
?>
  <tr>
    <td class="pageresults"><?php echo $listing_split->display_count(TEXT_DISPLAY_NUMBER_OF_FAQS); ?></td>
    <td class="pageresults" align="right"><?php echo TEXT_RESULT_PAGE . ' ' . $listing_split->display_links(MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params(array('page', 'info', 'x', 'y', 'main_page'))); ?></td>
  </tr>
<?php
}
?>
  <tr class="centerboxheading">
    <td colspan="2">
<?php
  require($template->get_template_dir('tpl_faq_list_box_content.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/tpl_faq_list_box_content.php');
?>
    </td>
  </tr>
  
<?php if ($_GET['faqs_id']) { ?>
  <tr class="centerboxheading">
    <td colspan="2" class="centerboxheading">
<?php
        $display_faqs_name = '<a href="' . zen_href_link(zen_get_info_faq_page($listing->fields['faqs_id']), 'fcPath=' . $fcPath . '&faqs_id=' . $_GET['faqs_id']) . '"> ' . $current_faq_name . '</a>';
        echo $display_faqs_name;
?>
    </td>
  </tr>
  <tr>
    <td colspan="2" class="plainbox-description">
<?php
        $display_faqs_description = stripslashes(zen_trunc_string($current_faq_description, 150, '<a href="' . zen_href_link(zen_get_info_faq_page($listing->fields['faqs_id']), 'faqs_id=' . $_GET['faqs_id']) . '"> ' . MORE_INFO_TEXT . '</a>'));
        echo $display_faqs_description;
?>
    </td>
  </tr>
<?php } ?>
<?php if ( ($listing_split->number_of_rows > 0) && ((PREV_NEXT_FAQ_BAR_LOCATION == '2') || (PREV_NEXT_FAQ_BAR_LOCATION == '3')) ) {
?>
  <tr>
    <td class="pageresults"><?php echo $listing_split->display_count(TEXT_DISPLAY_NUMBER_OF_FAQS); ?></td>
    <td class="pageresults" align="right"><?php echo TEXT_RESULT_PAGE . ' ' . $listing_split->display_links(MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></td>
  </tr>
<?php
  }
?>
</table>
