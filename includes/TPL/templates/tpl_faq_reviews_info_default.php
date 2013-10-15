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
<table  width="100%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <td class="pageHeading" valign="top"><h1><?php echo $faqs_name; ?><br /></h1></td>
    <td align="center" valign="top" class="smallText">
      <?php
        if (zen_not_null($faqs_image)) {
          require(DIR_WS_MODULES . 'pages/' . $current_page_base . '/main_template_vars_images.php');
        }
       $the_button = $link;
        $faqs_link = '<br />';
     ?>
    </td>
  </tr>
  <tr>
    <td class="main" colspan="2"><?php echo zen_draw_separator(DIR_WS_TEMPLATE_IMAGES . OTHER_IMAGE_SILVER_SEPARATOR, '100%', '1'); ?></td>
  </tr>
  <tr>
    <td colspan="2" align="left" class="smallText">
<?php // later make link only show when more than 1 ?>
      <?php echo '<a href="' . zen_href_link(zen_get_info_faq_page($_GET['faqs_id']), zen_get_all_get_params()) . '">' . TEXT_FAQ_INFO . '</a>'; ?><?php echo ($reviews_counter > 1 ? '&nbsp;|&nbsp;' . '<a href="' . zen_href_link(FILENAME_FAQ_REVIEWS, zen_get_all_get_params()) . '">' . TEXT_REVIEW_ADDITIONAL . '</a>' : ''); ?>
    </td>
  </tr>
  <tr>
    <td class="main"><span class="greetUser"><?php echo sprintf(TEXT_REVIEW_BY, zen_output_string_protected($review_info->fields['customers_name'])); ?></span></td>
    <td class="smallText" align="right"><?php echo sprintf(TEXT_REVIEW_DATE_ADDED, zen_date_short($review_info->fields['date_added'])); ?></td>
  </tr>
  <tr>
    <td valign="top" class="main" colspan="2"><?php echo zen_break_string(nl2br(zen_output_string_protected(stripslashes($review_info->fields['reviews_text']))), 60, '-<br />') . '<br /><br /><i>' . sprintf(TEXT_REVIEW_RATING, zen_image(DIR_WS_TEMPLATE_IMAGES . 'stars_' . $review_info->fields['reviews_rating'] . '.gif', sprintf(TEXT_OF_5_STARS, $review_info->fields['reviews_rating'])), sprintf(TEXT_OF_5_STARS, $review_info->fields['reviews_rating'])) . '</i>'; ?></td>
  </tr>
  <tr>
    <td class="main" colspan="2"><?php echo zen_draw_separator(DIR_WS_TEMPLATE_IMAGES . OTHER_IMAGE_SILVER_SEPARATOR, '100%', '1'); ?></td>
  </tr>
  <tr>
    <td class="main"><?php echo zen_back_link() . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a>'; ?></td>
    <td class="main" align="right"><?php echo '<a href="' . zen_href_link(FILENAME_FAQ_REVIEWS_WRITE, zen_get_all_get_params(array('reviews_id'))) . '">' . zen_image_button(BUTTON_IMAGE_WRITE_REVIEW, BUTTON_WRITE_REVIEW_ALT) . '</a>'; ?></td>
  </tr>
</table>