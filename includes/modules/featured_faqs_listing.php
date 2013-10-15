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
            <td colspan="3"><?php echo zen_draw_separator(DIR_WS_TEMPLATE_IMAGES . OTHER_IMAGE_SILVER_SEPARATOR, '100%', '1'); ?></td>
          </tr>
<?php
  $group_id = zen_get_configuration_key_value('FAQ_LISTS_GROUP_ID');
  if ($featured_faqs_split->number_of_rows > 0) {
    $featured_faqs = $db->Execute($featured_faqs_split->sql_query);
    while (!$featured_faqs->EOF) {
      if (FAQ_FEATURED_LIST_IMAGE != '0') {
        $display_faqs_image = '<a href="' . zen_href_link(zen_get_info_faq_page($featured_faqs->fields['faqs_id']), 'faqs_id=' . $featured_faqs->fields['faqs_id']) . '">' . zen_image(DIR_WS_IMAGES . $featured_faqs->fields['faqs_image'], $featured_faqs->fields['faqs_name'], IMAGE_FEATURED_FAQS_LISTING_WIDTH, IMAGE_FEATURED_FAQS_LISTING_HEIGHT) . '</a>' . str_repeat('<br clear="all" />', substr(FAQ_FEATURED_LIST_IMAGE, 3, 1));
      } else {
        $display_faqs_image = '';
      }
      if (FAQ_FEATURED_LIST_NAME != '0') {
        $display_faqs_name = '<a href="' . zen_href_link(zen_get_info_faq_page($featured_faqs->fields['faqs_id']), 'faqs_id=' . $featured_faqs->fields['faqs_id']) . '"><strong>' . $featured_faqs->fields['faqs_name'] . '</strong></a>' . str_repeat('<br clear="all" />', substr(FAQ_FEATURED_LIST_NAME, 3, 1));
      } else {
        $display_faqs_name = '';
      }
      if (FAQ_FEATURED_LIST_DATE_ADDED != '0' and zen_get_show_faq_switch($featured_faqs->fields['faqs_id'], 'date_added')) {
        $display_faqs_date_added = TEXT_DATE_ADDED . ' ' . zen_date_long($featured_faqs->fields['faqs_date_added']) . str_repeat('<br clear="all" />', substr(FAQ_FEATURED_LIST_DATE_ADDED, 3, 1));
      } else {
        $display_faqs_date_added = '';
      }
        $link = '<a href="' . zen_href_link(zen_get_info_faq_page($featured_faqs->fields['faqs_id']), 'faqs_id=' . $featured_faqs->fields['faqs_id']) . '">' . MORE_INFO_TEXT . '</a>';
        $the_button = $link;
        $faqs_link = '<a href="' . zen_href_link(zen_get_info_faq_page($featured_faqs->fields['faqs_id']), 'faqs_id=' . $featured_faqs->fields['faqs_id']) . '">' . MORE_INFO_TEXT . '</a>';
      if (FAQ_FEATURED_LIST_DESCRIPTION != '0') {
        $disp_text = zen_get_faqs_description($featured_faqs->fields['faqs_id']);
        $disp_text = zen_clean_html($disp_text);
        $display_faqs_description = stripslashes(zen_trunc_string($disp_text, 150, '<a href="' . zen_href_link(zen_get_info_faq_page($featured_faqs->fields['faqs_id']), 'faqs_id=' . $featured_faqs->fields['faqs_id']) . '"> ' . MORE_INFO_TEXT . '</a>'));
      } else {
        $display_faqs_description = '';
      }
?>
          <tr>
            <td width="<?php echo IMAGE_FEATURED_FAQS_LISTING_WIDTH + 10; ?>" valign="top" class="main" align="center">
              <?php
                $disp_sort_order = $db->Execute("select configuration_key, configuration_value from " . TABLE_CONFIGURATION . " where configuration_group_id='" . $group_id . "' and (configuration_value >= 1000 and configuration_value <= 1999) order by LPAD(configuration_value,11,0)");
                while (!$disp_sort_order->EOF) {
                  if ($disp_sort_order->fields['configuration_key'] == 'FAQ_FEATURED_LIST_IMAGE') {
                    echo $display_faqs_image;
                  }
                  if ($disp_sort_order->fields['configuration_key'] == 'FAQ_FEATURED_LIST_NAME') {
                    echo $display_faqs_name;
                  }
                  if ($disp_sort_order->fields['configuration_key'] == 'FAQ_FEATURED_LIST_DATE_ADDED') {
                    echo $display_faqs_date_added;
                  }
                  $disp_sort_order->MoveNext();
                }
              ?>
            </td>
            <td colspan="2" valign="top" class="main">
              <?php
                $disp_sort_order = $db->Execute("select configuration_key, configuration_value from " . TABLE_CONFIGURATION . " where configuration_group_id='" . $group_id . "' and (configuration_value >= 2000 and configuration_value <= 2999) order by LPAD(configuration_value,11,0)");
                while (!$disp_sort_order->EOF) {
                  if ($disp_sort_order->fields['configuration_key'] == 'FAQ_FEATURED_LIST_IMAGE') {
                    echo $display_faqs_image;
                  }
                   if ($disp_sort_order->fields['configuration_key'] == 'FAQ_FEATURED_LIST_NAME') {
                    echo $display_faqs_name;
                  }
                  if ($disp_sort_order->fields['configuration_key'] == 'FAQ_FEATURED_LIST_DATE_ADDED') {
                    echo $display_faqs_date_added;
                  }
                  $disp_sort_order->MoveNext();
                }
              ?>
            </td>
          </tr>
<?php if (FAQ_FEATURED_LIST_DESCRIPTION != 0) { ?>
          <tr>
            <td colspan="3" valign="top" class="main">
              <?php
                echo $display_faqs_description;
              ?>
            </td>
          </tr>
<?php } ?>
          <tr>
            <td colspan="3"><?php echo zen_draw_separator(DIR_WS_TEMPLATE_IMAGES . OTHER_IMAGE_SILVER_SEPARATOR, '100%', '1'); ?></td>
          </tr>
<?php
      $featured_faqs->MoveNext();
    }
  } else {
?>
          <tr>
            <td class="main" colspan="2"><?php echo TEXT_NO_FEATURED_FAQS; ?></td>
          </tr>
<?php
  }
?>
        </table>