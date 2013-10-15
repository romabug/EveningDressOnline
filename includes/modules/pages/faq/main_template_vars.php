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
  if ($faq_category_depth == 'nested')
    {
    $sql = "select cd.faq_categories_name, c.faq_categories_image
            from   " . TABLE_FAQ_CATEGORIES . " c, " .
                       TABLE_FAQ_CATEGORIES_DESCRIPTION . " cd
            where      c.faq_categories_id = '" . (int)$current_faq_category_id . "'
            and        cd.faq_categories_id = '" . (int)$current_faq_category_id . "'
            and        cd.language_id = '" . (int)$_SESSION['languages_id'] . "'
            and        c.faq_categories_status= '1'";

    $faq_category = $db->Execute($sql);

    if (isset($fcPath) && strpos($fcPath, '_'))
    {
// check to see if there are deeper faq_categories within the current faq_category
      $faq_category_links = array_reverse($fcPath_array);
      $n = count($faq_category_links);
      for($i=0; $i<$n; $i++)
      {
        $sql = "select count(*) as total
                from   " . TABLE_FAQ_CATEGORIES . " c, " . TABLE_FAQ_CATEGORIES_DESCRIPTION . " cd
                where      c.parent_id = '" . (int)$faq_category_links[$i] . "'
                and        c.faq_categories_id = cd.faq_categories_id
                and        cd.language_id = '" . (int)$_SESSION['languages_id'] . "'
                and        c.faq_categories_status= '1'";

        $faq_categories = $db->Execute($sql);

        if ($faq_categories->fields['total'] < 1)
        {
        // do nothing, go through the loop
        } else {
          $faq_categories_query = "select c.faq_categories_id, cd.faq_categories_name, c.faq_categories_image, c.parent_id
                  from   " . TABLE_FAQ_CATEGORIES . " c, " . TABLE_FAQ_CATEGORIES_DESCRIPTION . " cd
                  where      c.parent_id = '" . (int)$faq_category_links[$i] . "'
                  and        c.faq_categories_id = cd.faq_categories_id
                  and        cd.language_id = '" . (int)$_SESSION['languages_id'] . "'
                  and        c.faq_categories_status= '1'
                  order by   sort_order, cd.faq_categories_name";

          break; // we've found the deepest faq_category the customer is in
        }
      }
    } else {
      $faq_categories_query = "select c.faq_categories_id, cd.faq_categories_name, cd.faq_categories_description, c.faq_categories_image, c.parent_id
                           from   " . TABLE_FAQ_CATEGORIES . " c, " . TABLE_FAQ_CATEGORIES_DESCRIPTION . " cd
                           where      c.parent_id = '" . (int)$current_faq_category_id . "'
                           and        c.faq_categories_id = cd.faq_categories_id
                           and        cd.language_id = '" . (int)$_SESSION['languages_id'] . "'
                           and        c.faq_categories_status= '1'
                           order by   sort_order, cd.faq_categories_name";
    }
    $faq_categories = $db->Execute($faq_categories_query);
    $number_of_faq_categories = $faq_categories->RecordCount();
    $new_faqs_faq_category_id = $current_faq_category_id;

/////////////////////////////////////////////////////////////////////////////////////////////////////
    $tpl_page_body = 'tpl_index_faq_categories.php';
/////////////////////////////////////////////////////////////////////////////////////////////////////


  } elseif ($faq_category_depth == 'faqs' || zen_check_url_get_terms()) {
    if (SHOW_FAQ_INFO_ALL_FAQS == '1') {
      // set a faq_category filter
      $new_faqs_faq_category_id = $fcPath;
    } else {
      // do not set the faq_category
    }
// create column list
    $define_list = array('FAQ_LIST_MODEL' => FAQ_LIST_MODEL,
                         'FAQ_LIST_NAME' => FAQ_LIST_NAME);
    asort($define_list);
    $column_list = array();
    reset($define_list);
    while (list($key, $value) = each($define_list))
    {
      if ($value > 0) $column_list[] = $key;
    }

    $select_column_list = '';

    for ($i=0, $n=sizeof($column_list); $i<$n; $i++)
    {
      switch ($column_list[$i])
      {
        case 'FAQ_LIST_MODEL':
          $select_column_list .= 'p.faqs_model, ';
          break;
        case 'FAQ_LIST_NAME':
          $select_column_list .= 'pd.faqs_name, ';
          break;
      }
    }
// add the faq filters for other faq types here
//
if (isset($_GET['typefilter'])) {
//die('here1');
  require(DIR_WS_INCLUDES . 'index_filters/' . $_GET['typefilter'] . '_filter.php');
} else {
  require(DIR_WS_INCLUDES . 'index_filters/faq_default_filter.php');
}
//die('here2');


////////////////////////////////////////////////////////////////////////////////////////////////////////////
  $tpl_page_body = 'tpl_index_faq_list.php';
////////////////////////////////////////////////////////////////////////////////////////////////////////////
  } else {
////////////////////////////////////////////////////////////////////////////////////////////////////////////
    $tpl_page_body = 'tpl_faq_default.php';
////////////////////////////////////////////////////////////////////////////////////////////////////////////
  }

// faq_categories_description
    $sql = "select faq_categories_description from " . TABLE_FAQ_CATEGORIES_DESCRIPTION . "
            where faq_categories_id= '" . $current_faq_category_id . "'
            and language_id = '" . (int)$_SESSION['languages_id'] . "'";

    $faq_categories_description_lookup= $db->Execute($sql);

    $current_faq_categories_description = $faq_categories_description_lookup->fields['faq_categories_description'];


if ($_GET['faqs_id']) {
    $sql = "select faqs_description, faqs_name from " . TABLE_FAQS_DESCRIPTION . "
            where faqs_id= '" . $_GET['faqs_id'] . "'
            and language_id = '" . (int)$_SESSION['languages_id'] . "'";
    $faq_description_lookup= $db->Execute($sql);
    $current_faq_description = $faq_description_lookup->fields['faqs_description'];
	$current_faq_name = $faq_description_lookup->fields['faqs_name'];
      $fcPath= zen_get_faq_path($_GET['faqs_id']);
}
  require($template->get_template_dir($tpl_page_body, DIR_WS_TEMPLATE, $current_page_base,'templates'). '/' . $tpl_page_body);
?>