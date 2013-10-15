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
  $sql = "select count(*) as total
          from " . TABLE_FAQS . " p, " .
                   TABLE_FAQS_DESCRIPTION . " pd
          where    p.faqs_status = '1'
          and      p.faqs_id = '" . (int)$_GET['faqs_id'] . "'
          and      pd.faqs_id = p.faqs_id
          and      pd.language_id = '" . (int)$_SESSION['languages_id'] . "'";


  $res = $db->Execute($sql);

  if ( $res->fields['total'] < 1 ) {

    $tpl_page_body = '/tpl_faq_info_nofaq.php';

  } else {

    $tpl_page_body = '/tpl_faq_info_display.php';

    $sql = "update " . TABLE_FAQS_DESCRIPTION . "
            set        faqs_viewed = faqs_viewed+1
            where      faqs_id = '" . (int)$_GET['faqs_id'] . "'
            and        language_id = '" . (int)$_SESSION['languages_id'] . "'";

    $res = $db->Execute($sql);

    $sql = "select p.*, pd.*
	       from   " . TABLE_FAQS . " p, " . TABLE_FAQS_DESCRIPTION . " pd
           where  p.faqs_status = '1'
           and    p.faqs_id = '" . (int)$_GET['faqs_id'] . "'
           and    pd.faqs_id = p.faqs_id
           and    pd.language_id = '" . (int)$_SESSION['languages_id'] . "'";

    $faq_info = $db->Execute($sql);



// if review must be approved or disabled do not show review
    $review_status = " and r.status = '1'";

    $reviews_query = "select count(*) as count from " . TABLE_FAQ_REVIEWS . " r, "
                                                       . TABLE_FAQ_REVIEWS_DESCRIPTION . " rd
                       where r.faqs_id = '" . (int)$_GET['faqs_id'] . "'
                       and r.reviews_id = rd.reviews_id
                       and rd.languages_id = '" . (int)$_SESSION['languages_id'] . "'" .
                       $review_status;

    $reviews = $db->Execute($reviews_query);

  }

// bof: previous next
if (FAQ_INFO_PREVIOUS_NEXT != 0) {
// calculate the previous and next
  if ($prev_next_list=='') {

    // sort order
    switch(FAQ_INFO_PREVIOUS_NEXT_SORT) {
      case (0):
        $prev_next_order= ' order by LPAD(p.faqs_id,11,"0")';
        break;
      case (1):
        $prev_next_order= " order by pd.faqs_name";
        break;
      case (2):
        $prev_next_order= " order by pd.faqs_name";
        break;
      case (3):
        $prev_next_order= " order by pd.faqs_name";
        break;
      case (4):
        $prev_next_order= " order by pd.faqs_name";
        break;
      case (5):
        $prev_next_order= " order by pd.faqs_name";
        break;
      case (6):
        $prev_next_order= ' order by LPAD(p.faqs_sort_order,11,"0"), pd.faqs_name';
        break;
      default:
        $prev_next_order= " order by pd.faqs_name";
        break;
    }

    if (!$current_faq_category_id) {
      $sql = "SELECT faq_categories_id
              from   " . TABLE_FAQS_TO_FAQ_CATEGORIES . "
              where  faqs_id ='" .  (int)$_GET['faqs_id']
              . "'";

      $fcPath_row = $db->Execute($sql);
      $current_faq_category_id = $fcPath_row->fields['faq_categories_id'];
    }

    $sql = "select p.*, pd.faqs_name
            from   " . TABLE_FAQS . " p, "
                     . TABLE_FAQS_DESCRIPTION . " pd, "
                     . TABLE_FAQS_TO_FAQ_CATEGORIES . " ptc
            where  p.faqs_status = '1' and p.faqs_id = pd.faqs_id and pd.language_id= '" . $_SESSION['languages_id'] . "' and p.faqs_id = ptc.faqs_id and ptc.faq_categories_id = '" . $current_faq_category_id . "'" .
            $prev_next_order
            ;

    $faqs_ids = $db->Execute($sql);
  }

  while (!$faqs_ids->EOF) {
    $id_array[] = $faqs_ids->fields['faqs_id'];
    $faqs_ids->MoveNext();
  }

// if invalid faq id skip
  if (is_array($id_array)) {
    reset ($id_array);
    $counter = 0;
    while (list($key, $value) = each ($id_array)) {
      if ($value == (int)$_GET['faqs_id']) {
        $position = $counter;
        if ($key == 0) {
          $previous = -1; // it was the first to be found
        } else {
          $previous = $id_array[$key - 1];
        }
        if ($id_array[$key + 1]) {
          $next_item = $id_array[$key + 1];
        } else {
          $next_item = $id_array[0];
        }
      }
      $last = $value;
      $counter++;
    }

    if ($previous == -1) $previous = $last;

    $sql = "select faq_categories_name
            from   " . TABLE_FAQ_CATEGORIES_DESCRIPTION . "
            where  faq_categories_id = $current_faq_category_id AND language_id = '" . $_SESSION['languages_id']
            . "'";

    $faq_category_name_row = $db->Execute($sql);
  } // if is_array

// previous_next button and faq image settings
// include faqs_image status 0 = off 1= on
// 0 = button only 1= button and faq image 2= faq image only
  $previous_button = zen_image_button(BUTTON_IMAGE_OO_PREVIOUS, BUTTON_PREVIOUS_ALT);
  $next_item_button = zen_image_button(BUTTON_IMAGE_OO_NEXT, BUTTON_NEXT_ALT);
  $previous_image = zen_get_faqs_image($previous, PREVIOUS_NEXT_IMAGE_WIDTH, PREVIOUS_NEXT_IMAGE_HEIGHT) . '<br />';
  $next_item_image = zen_get_faqs_image($next_item, PREVIOUS_NEXT_IMAGE_WIDTH, PREVIOUS_NEXT_IMAGE_HEIGHT) . '<br />';
  if (SHOW_FAQ_PREVIOUS_NEXT_STATUS == 0) {
    $previous_image = '';
    $next_item_image = '';
  } else {
    if (SHOW_FAQ_PREVIOUS_NEXT_IMAGES >= 1) {
      if (SHOW_FAQ_PREVIOUS_NEXT_IMAGES == 2) {
        $previous_button = '';
        $next_item_button = '';
      }
      if ($previous == $next_item) {
        $previous_image = '';
        $next_item_image = '';
      }
    } else {
      $previous_image = '';
      $next_item_image = '';
    }
  }
}
// eof: previous next

  $faqs_name = $faq_info->fields['faqs_name'];
  $faqs_description = $faq_info->fields['faqs_description'];
  $faqs_answer = $faq_info->fields['faqs_answer'];

  if ($faq_info->fields['faqs_image'] == '' and FAQS_IMAGE_NO_IMAGE_STATUS == '1') {
    $faqs_image = FAQS_IMAGE_NO_IMAGE;
  } else {
    $faqs_image = $faq_info->fields['faqs_image'];
  }
  $faqs_url = $faq_info->fields['faqs_url'];
  $faqs_date_added = $faq_info->fields['faqs_date_added'];
  $module_show_faq_categories = FAQ_INFO_FAQ_CATEGORIES;
  $module_next_previous = FAQ_INFO_PREVIOUS_NEXT;

  $faqs_id_current = (int)$_GET['faqs_id'];
  if (is_dir(DIR_WS_TEMPLATE . $current_page_base . '/extra_main_template_vars')) {
    if ($za_dir = @dir(DIR_WS_TEMPLATE . $current_page_base. '/extra_main_template_vars')) {
      while ($zv_file = $za_dir->read()) {
        if (strstr($zv_file, '*.php') ) {
          require(DIR_WS_TEMPLATE . $current_page_base . '/extra_main_template_vars/' . $zv_file);
        }
      }
    }
  }

  require($template->get_template_dir($tpl_page_body,DIR_WS_TEMPLATE, $current_page_base,'templates'). $tpl_page_body);
?>
