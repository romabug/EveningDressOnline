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
<div class="margin_t">
<?php

  $group_id = zen_get_configuration_key_value('FAQ_LISTS_GROUP_ID_ALL');
  if ($faqs_all_split->number_of_rows > 0) {
    $faqs_all = $db->Execute($faqs_all_split->sql_query);
		$category_displayed = '';
    while (!$faqs_all->EOF) {
      $fcPath= zen_get_faq_path($faqs_all->fields['faqs_id']);
		  if (FAQ_ALL_DISPLAY_CATEGORY != '0' && $category_displayed != $faqs_all->fields['faq_categories_name']) {
		   $category_displayed = $faqs_all->fields['faq_categories_name'];
		  	echo '<h3>' . $category_displayed . '</h3>';
		  }
	    echo '<div class="margin_t">';
		  if (FAQ_ALL_LIST_NAME != '0') {
        $display_faqs_name = '<a class="u" href="' . zen_href_link(zen_get_info_faq_page($faqs_all->fields['faqs_id']), 'fcPath=' . $fcPath . '&faqs_id=' . $faqs_all->fields['faqs_id']) . '">' . $faqs_all->fields['faqs_name'] . '</a>' . str_repeat('<br clear="all" />', substr(FAQ_ALL_LIST_NAME, 3, 1));
      } else {
        $display_faqs_name = '';
      }
        $link = '<a href="' . zen_href_link(zen_get_info_faq_page($faqs_all->fields['faqs_id']), 'fcPath=' . $fcPath . '&faqs_id=' . $faqs_all->fields['faqs_id']) . '">' . MORE_INFO_TEXT . '</a>';
        $the_button = $link;
        $faqs_link = '<a href="' . zen_href_link(zen_get_info_faq_page($faqs_all->fields['faqs_id']), 'fcPath=' . $fcPath . '&faqs_id=' . $faqs_all->fields['faqs_id']) . '">' . MORE_INFO_TEXT . '</a>';
      if (FAQ_ALL_LIST_DESCRIPTION != '0') {
        $disp_text = zen_get_faqs_description($faqs_all->fields['faqs_id']);
        $disp_text = zen_clean_html($disp_text);
        $display_faqs_description = stripslashes(zen_trunc_string($disp_text, 150, '<a href="' . zen_href_link(zen_get_info_faq_page($faqs_all->fields['faqs_id']), 'fcPath=' . $fcPath . '&faqs_id=' . $faqs_all->fields['faqs_id']) . '"> ' . MORE_INFO_TEXT . '</a>'));
      } else {
        $display_faqs_description = '';
      }
       echo '<h4 class="margin_t bg_help">'.$display_faqs_name.'</h4>';
			 if (FAQ_ALL_LIST_DESCRIPTION != 0 && ($current_faq_category_id != 0)) { 
					echo '<ul>'.$display_faqs_description.'</ul>';
				}
			echo '</div>';
      $faqs_all->MoveNext();
    }
  } else {
		echo '<div class="error_box">'.TEXT_NO_ALL_FAQS.'</div>'; 
  }
?> 
</div>
<br class="clear"/>
<div class="pad_10px fr"><?php echo '<a href="' . zen_href_link(FILENAME_FAQS_SUBMIT, '', 'NONSSL') . '">' . zen_image_button(BUTTON_IMAGE_SUBMIT_FAQ, BUTTON_SUBMIT_FAQ_ALT) . '</a>'; ?></div>



