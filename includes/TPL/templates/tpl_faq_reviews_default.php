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
      ?>
    </td>
  </tr>
  <tr>
    <td class="main" colspan="2"><?php echo zen_draw_separator(DIR_WS_TEMPLATE_IMAGES . OTHER_IMAGE_SILVER_SEPARATOR, '100%', '1'); ?></td>
  </tr>
<?php
  $review_status = " and r.status = '1'";
  $reviews_query_raw = "select r.reviews_id, left(rd.reviews_text, 100) as reviews_text,
                               r.reviews_rating, r.date_added, r.customers_name
                        from " . TABLE_FAQ_REVIEWS . " r, " . TABLE_FAQ_REVIEWS_DESCRIPTION . " rd
                        where r.faqs_id = '" . (int)$_GET['faqs_id'] . "'
                        and r.reviews_id = rd.reviews_id
                        and rd.languages_id = '" . (int)$_SESSION['languages_id'] . "'" .
                        $review_status . "
                        order by r.reviews_id desc";
  $reviews_split = new splitPageResults($reviews_query_raw, MAX_DISPLAY_NEW_REVIEWS);
  if ($reviews_split->number_of_rows > 0) {
    if ((PREV_NEXT_FAQ_BAR_LOCATION == '1') || (PREV_NEXT_FAQ_BAR_LOCATION == '3')) {
?>
  <tr>
    <td class="pageresults"><?php echo $reviews_split->display_count(TEXT_DISPLAY_NUMBER_OF_REVIEWS); ?></td>
    <td align="right" class="pageresults"><?php echo TEXT_RESULT_PAGE . ' ' . $reviews_split->display_links(MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params(array('page', 'info', 'main_page'))); ?></td>
  </tr>
  <tr>
    <td class="main" colspan="2"><?php echo zen_draw_separator(DIR_WS_TEMPLATE_IMAGES . OTHER_IMAGE_SILVER_SEPARATOR, '100%', '1'); ?></td>
  </tr>
<?php
    }
    $reviews = $db->Execute($reviews_split->sql_query);
    while (!$reviews->EOF) {
?>
  <tr>
    <td colspan="2" align="left" class="smallText">
      <?php echo '<a href="' . zen_href_link(zen_get_info_faq_page($_GET['faqs_id']), zen_get_all_get_params()) . '">' . TEXT_FAQ_INFO . '</a>'; ?>&nbsp;|&nbsp;<?php echo '<a href="' . zen_href_link(FILENAME_FAQ_REVIEWS_INFO, 'faqs_id=' . (int)$_GET['faqs_id'] . '&reviews_id=' . $reviews->fields['reviews_id']) . '">' . TEXT_READ_REVIEW . '</a>'; ?>
    </td>
  </tr>
  <tr>
    <td class="main"><span class="greetUser"><?php echo sprintf(TEXT_REVIEW_BY, zen_output_string_protected($reviews->fields['customers_name'])); ?><span></td>
    <td class="smallText" align="right"><?php echo sprintf(TEXT_REVIEW_DATE_ADDED, zen_date_short($reviews->fields['date_added'])); ?></td>
  </tr>
  <tr>
    <td valign="top" class="main" colspan="2"><?php echo zen_break_string(zen_output_string_protected(stripslashes($reviews->fields['reviews_text'])), 60, '-<br />') . ((strlen($reviews->fields['reviews_text']) >= 100) ? '..' : '') . '<br /><br /><i>' . sprintf(TEXT_REVIEW_RATING, zen_image(DIR_WS_TEMPLATE_IMAGES . 'stars_' . $reviews->fields['reviews_rating'] . '.gif', sprintf(TEXT_OF_5_STARS, $reviews->fields['reviews_rating'])), sprintf(TEXT_OF_5_STARS, $reviews->fields['reviews_rating'])) . '</i>'; ?></td>
  </tr>
  <tr>
    <td class="main" colspan="2"><?php echo zen_draw_separator(DIR_WS_TEMPLATE_IMAGES . OTHER_IMAGE_SILVER_SEPARATOR, '100%', '1'); ?></td>
  </tr>
<?php
      $reviews->MoveNext();
    }
?>
<?php
  } else {
?>
  <tr>
    <td align="left" class="smallText" colspan="2">
      <?php echo '<a href="' . zen_href_link(zen_get_info_faq_page($_GET['faqs_id']), zen_get_all_get_params()) . '">' . TEXT_FAQ_INFO . '</a>'; ?>
    </td>
  </tr>
  <tr>
    <td class="plainBox" colspan="2"><?php echo TEXT_NO_FAQ_REVIEWS . (REVIEWS_APPROVAL == '1' ? '<br />' . TEXT_APPROVAL_REQUIRED: ''); ?></td>
  </tr>
<?php
  }
  if (($reviews_split->number_of_rows > 0) && ((PREV_NEXT_FAQ_BAR_LOCATION == '2') || (PREV_NEXT_FAQ_BAR_LOCATION == '3'))) {
?>
  <tr>
    <td class="pageresults"><?php echo $reviews_split->display_count(TEXT_DISPLAY_NUMBER_OF_REVIEWS); ?></td>
    <td align="right" class="pageresults"><?php echo TEXT_RESULT_PAGE . ' ' . $reviews_split->display_links(MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params(array('page', 'info', 'main_page'))); ?></td>
  </tr>
<?php
  }
?>
  <tr>
    <td class="main" colspan="2"><?php echo zen_draw_separator(DIR_WS_TEMPLATE_IMAGES . OTHER_IMAGE_SILVER_SEPARATOR, '100%', '1'); ?></td>
  </tr>
  <tr>
    <td class="main"><?php echo '<a href="' . zen_href_link(zen_get_info_faq_page($_GET['faqs_id']), zen_get_all_get_params()) . '">' . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a>'; ?></td>
    <td class="main" align="right"><?php echo '<a href="' . zen_href_link(FILENAME_FAQ_REVIEWS_WRITE, zen_get_all_get_params()) . '">' . zen_image_button(BUTTON_IMAGE_WRITE_REVIEW, BUTTON_WRITE_REVIEW_ALT) . '</a>'; ?></td>
  </tr>
</table>