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
////
// Generate a path to faq_categories
  function zen_get_path_faq($current_faq_category_id = '') {
    global $fcPath_array, $db;
    if (zen_not_null($current_faq_category_id)) {
      $cp_size = sizeof($fcPath_array);
      if ($cp_size == 0) {
        $fcPath_new = $current_faq_category_id;
      } else {
        $fcPath_new = '';
        $last_faq_category_query = "select parent_id
                                from " . TABLE_FAQ_CATEGORIES . "
                                where faq_categories_id = '" . (int)$fcPath_array[($cp_size-1)] . "'";
        $last_faq_category = $db->Execute($last_faq_category_query);
        $current_faq_category_query = "select parent_id
                                   from " . TABLE_FAQ_CATEGORIES . "
                                   where faq_categories_id = '" . (int)$current_faq_category_id . "'";
        $current_faq_category = $db->Execute($current_faq_category_query);
        if ($last_faq_category->fields['parent_id'] == $current_faq_category->fields['parent_id']) {
          for ($i=0; $i<($cp_size-1); $i++) {
            $fcPath_new .= '_' . $fcPath_array[$i];
          }
        } else {
          for ($i=0; $i<$cp_size; $i++) {
            $fcPath_new .= '_' . $fcPath_array[$i];
          }
        }
        $fcPath_new .= '_' . $current_faq_category_id;

        if (substr($fcPath_new, 0, 1) == '_') {
          $fcPath_new = substr($fcPath_new, 1);
        }
      }
    } else {
      $fcPath_new = implode('_', $fcPath_array);
    }
    return 'fcPath=' . $fcPath_new;
  }


////
// Construct a category path to the product
// TABLES: products_to_categories
  function zen_get_faq_path($faqs_id) {
    global $db;
    $fcPath = '';

    $faq_category_query = "select p2c.faq_categories_id
                       from " . TABLE_FAQS . " p, " . TABLE_FAQS_TO_FAQ_CATEGORIES . " p2c
                       where p.faqs_id = '" . (int)$faqs_id . "'
                       and p.faqs_status = '1'
                       and p.faqs_id = p2c.faqs_id limit 1";

    $faq_category = $db->Execute($faq_category_query);

    if ($faq_category->RecordCount() > 0) {

      $faq_categories = array();
      zen_get_parent_faq_categories($faq_categories, $faq_category->fields['faq_categories_id']);

      $faq_categories = array_reverse($faq_categories);

      $fcPath = implode('_', $faq_categories);

      if (zen_not_null($fcPath)) $fcPath .= '_';
      $fcPath .= $faq_category->fields['faq_categories_id'];
    }

    return $fcPath;
  }



  function zen_get_faq_categories_image($what_am_i) {
    global $db;

    $the_faq_categories_image_query= "select faq_categories_image from " . TABLE_FAQ_CATEGORIES . " where faq_categories_id= '" . $what_am_i . "'";
    $the_faqs_faq_category = $db->Execute($the_faq_categories_image_query);

    return $the_faqs_category->fields['faq_categories_image'];
  }
////
// validate faqs_id
  function zen_faqs_id_valid($valid_id) {
    global $db;
    $check_valid = $db->Execute("select p.faqs_id
                                 from " . TABLE_FAQS . " p
                                 where faqs_id='" . $valid_id . "' limit 1");
    if ($check_valid->EOF) {
      return false;
    } else {
      return true;
    }
  }
////
// Return a faq's category
// TABLES: faqs_to_categories
  function zen_get_faqs_faq_category_id($faqs_id) {
    global $db;

    $the_faqs_faq_category_query = "select faqs_id, faq_categories_id from " . TABLE_FAQS_TO_FAQ_CATEGORIES . " where faqs_id = '" . (int)$faqs_id . "'" . " order by faqs_id, faq_categories_id";
    $the_faqs_faq_category = $db->Execute($the_faqs_faq_category_query);

    return $the_faqs_faq_category->fields['faq_categories_id'];
  }
  
  
  function zen_get_faqs_faq_category_id2($faqs_id) {
    global $db;

    $the_faqs_faq_category_query = "select faqs_id, faq_categories_id from " . TABLE_FAQS_TO_FAQ_CATEGORIES . " where faqs_id = '" . (int)$_GET['faqs_id'] . "'" . " order by faqs_id, faq_categories_id";
    $the_faqs_faq_category = $db->Execute($the_faqs_faq_category_query);

    return $the_faqs_faq_category->fields['faq_categories_id'];
  }
/**
 * Return a faq's name.
 *
 * @param int The faq id of the faq who's name we want
 * @param int The language id to use. If this is not set then the current language is used
*/
  function zen_get_faqs_name($faq_id, $language = '') {
    global $db;
    if (empty($language)) $language = $_SESSION['languages_id'];
    $faq_query = "select faqs_name
                      from " . TABLE_FAQS_DESCRIPTION . "
                      where faqs_id = '" . (int)$faq_id . "'
                      and language_id = '" . (int)$language . "'";
    $faq = $db->Execute($faq_query);
    return $faq->fields['faqs_name'];
  }

// look up a faqs image and send back the image
  function zen_get_faqs_image($faq_id, $width = SMALL_IMAGE_WIDTH, $height = SMALL_IMAGE_HEIGHT) {
    global $db;
    $sql = "select p.faqs_image from " . TABLE_FAQS . " p  where faqs_id='" . $faq_id . "'";
    $look_up = $db->Execute($sql);
    return zen_image(DIR_WS_IMAGES . $look_up->fields['faqs_image'], zen_get_faqs_name($faq_id), $width, $height, 'hspace="5" vspace="5"');
  }
////
// look up the faq type from faq_id and return an info page name
  function zen_get_info_faq_page($zf_faq_id) {
    global $db;
    $sql = "select faqs_type from " . TABLE_FAQS . " where faqs_id = '" . $zf_faq_id . "'";
    $zp_type = $db->Execute($sql);
    if ($zp_type->RecordCount() == 0) {
      return 'faqs_general_info';
    } else {
      $zp_faq_type = $zp_type->fields['faqs_type'];
      $sql = "select type_handler from " . TABLE_FAQ_TYPES . " where type_id = '" . $zp_faq_type . "'";
      $zp_handler = $db->Execute($sql);
      return $zp_handler->fields['type_handler'] . '_info';
    }
  }

////
// Return the number of faqs in a faq_category
// TABLES: faqs, faqs_to_faq_categories, faq_categories
  function zen_count_faqs_in_faq_category($faq_category_id, $include_inactive = false) {
    global $db;
    $faqs_count = 0;
    if ($include_inactive == true) {
      $faqs_query = "select count(*) as total
                         from " . TABLE_FAQS . " p, " . TABLE_FAQS_TO_FAQ_CATEGORIES . " p2c
                         where p.faqs_id = p2c.faqs_id
                         and p2c.faq_categories_id = '" . (int)$faq_category_id . "'";
    } else {
      $faqs_query = "select count(*) as total
                         from " . TABLE_FAQS . " p, " . TABLE_FAQS_TO_FAQ_CATEGORIES . " p2c
                         where p.faqs_id = p2c.faqs_id
                         and p.faqs_status = '1'
                         and p2c.faq_categories_id = '" . (int)$faq_category_id . "'";
    }
    $faqs = $db->Execute($faqs_query);
    $faqs_count += $faqs->fields['total'];
    $child_faq_categories_query = "select faq_categories_id
                               from " . TABLE_FAQ_CATEGORIES . "
                               where parent_id = '" . (int)$faq_category_id . "'";
    $child_faq_categories = $db->Execute($child_faq_categories_query);
    if ($child_faq_categories->RecordCount() > 0) {
      while (!$child_faq_categories->EOF) {
        $faqs_count += zen_count_faqs_in_faq_category($child_faq_categories->fields['faq_categories_id'], $include_inactive);
        $child_faq_categories->MoveNext();
      }
    }
    return $faqs_count;
  }
////
// Return true if the faq_category has subfaq_categories
// TABLES: faq_categories
  function zen_has_faq_category_subfaq_categories($faq_category_id) {
    global $db;
    $child_faq_category_query = "select count(*) as count
                             from " . TABLE_FAQ_CATEGORIES . "
                             where parent_id = '" . (int)$faq_category_id . "'";
    $child_faq_category = $db->Execute($child_faq_category_query);
    if ($child_faq_category->fields['count'] > 0) {
      return true;
    } else {
      return false;
    }
  }
////
  function zen_get_faq_categories($faq_categories_array = '', $faq_parent_id = '0', $indent = '', $status_setting = '') {
    global $db;
    if (!is_array($faq_categories_array)) $faq_categories_array = array();
    // show based on status
    if ($status_setting != '') {
      $zc_status = " c.faq_categories_status='" . $status_setting . "' and ";
    } else {
      $zc_status = '';
    }
    $faq_categories_query = "select c.faq_categories_id, cd.faq_categories_name, c.faq_categories_status
                         from " . TABLE_FAQ_CATEGORIES . " c, " . TABLE_FAQ_CATEGORIES_DESCRIPTION . " cd
                         where " . $zc_status . "
                         parent_id = '" . (int)$faq_parent_id . "'
                         and c.faq_categories_id = cd.faq_categories_id
                         and cd.language_id = '" . (int)$_SESSION['languages_id'] . "'
                         order by sort_order, cd.faq_categories_name";
    $faq_categories = $db->Execute($faq_categories_query);
    while (!$faq_categories->EOF) {
      $faq_categories_array[] = array('id' => $faq_categories->fields['faq_categories_id'],
                                  'text' => $indent . $faq_categories->fields['faq_categories_name']);
      if ($faq_categories->fields['faq_categories_id'] != $faq_parent_id) {
        $faq_categories_array = zen_get_faq_categories($faq_categories_array, $faq_categories->fields['faq_categories_id'], $indent . '&nbsp;&nbsp;', '1');
      }
      $faq_categories->MoveNext();
    }
    return $faq_categories_array;
  }

////
// Return all subfaq_category IDs
// TABLES: faq_categories
  function zen_get_subfaq_categories(&$subfaq_categories_array, $faq_parent_id = 0) {
    global $db;
    $subfaq_categories_query = "select faq_categories_id
                            from " . TABLE_FAQ_CATEGORIES . "
                            where parent_id = '" . (int)$faq_parent_id . "'";
    $subfaq_categories = $db->Execute($subfaq_categories_query);
    while (!$subfaq_categories->EOF) {
      $subfaq_categories_array[sizeof($subfaq_categories_array)] = $subfaq_categories->fields['faq_categories_id'];
      if ($subfaq_categories->fields['faq_categories_id'] != $faq_parent_id) {
        zen_get_subfaq_categories($subfaq_categories_array, $subfaq_categories->fields['faq_categories_id']);
      }
      $subfaq_categories->MoveNext();
    }
  }
////
// Recursively go through the faq_categories and retreive all parent faq_categories IDs
// TABLES: faq_categories
  function zen_get_parent_faq_categories(&$faq_categories, $faq_categories_id) {
    global $db;
    $parent_faq_categories_query = "select parent_id
                                from " . TABLE_FAQ_CATEGORIES . "
                                where faq_categories_id = '" . (int)$faq_categories_id . "'";
    $parent_faq_categories = $db->Execute($parent_faq_categories_query);
    while (!$parent_faq_categories->EOF) {
      if ($parent_faq_categories->fields['parent_id'] == 0) return true;
      $faq_categories[sizeof($faq_categories)] = $parent_faq_categories->fields['parent_id'];
      if ($parent_faq_categories->fields['parent_id'] != $faq_categories_id) {
        zen_get_parent_faq_categories($faq_categories, $parent_faq_categories->fields['parent_id']);
      }
      $parent_faq_categories->MoveNext();
    }
  }
////
// Parse and secure the fcPath parameter values
  function zen_parse_faq_category_path($fcPath) {
// make sure the faq_category IDs are integers
    $fcPath_array = array_map('zen_string_to_int', explode('_', $fcPath));
// make sure no duplicate faq_category IDs exist which could lock the server in a loop
    $tmp_array = array();
    $n = sizeof($fcPath_array);
    for ($i=0; $i<$n; $i++) {
      if (!in_array($fcPath_array[$i], $tmp_array)) {
        $tmp_array[] = $fcPath_array[$i];
      }
    }
    return $tmp_array;
  }
  function zen_faq_in_faq_category($faq_id, $cat_id) {
    global $db;
    $in_cat=false;
    $faq_category_query_raw = "select faq_categories_id from " . TABLE_FAQS_TO_FAQ_CATEGORIES . "
                           where faqs_id = '" . (int)$faq_id . "'";
    $faq_category = $db->Execute($faq_category_query_raw);
    while (!$faq_category->EOF) {
      if ($faq_category->fields['faq_categories_id'] == $cat_id) $in_cat = true;
      if (!$in_cat) {
        $parent_faq_categories_query = "select parent_id from " . TABLE_FAQ_CATEGORIES . "
                                    where faq_categories_id = '" . $faq_category->fields['faq_categories_id'] . "'";
        $parent_faq_categories = $db->Execute($parent_faq_categories_query);
        while (!$parent_faq_categories->EOF) {
          if (($parent_faq_categories->fields['parent_id'] !=0) ) {
            if (!$in_cat) $in_cat = zen_faq_in_parent_faq_category($faq_id, $cat_id, $parent_faq_categories->fields['parent_id']);
          }
          $parent_faq_categories->MoveNext();
        }
      }
      $faq_category->MoveNext();
    }
    return $in_cat;
  }
  function zen_faq_in_parent_faq_category($faq_id, $cat_id, $parent_cat_id) {
    global $db;
    if ($cat_id == $parent_cat_id) {
      $in_cat = true;
    } else {
      $parent_faq_categories_query = "select parent_id from " . TABLE_FAQ_CATEGORIES . "
                                  where faq_categories_id = '" . $parent_cat_id . "'";
      $parent_faq_categories = $db->Execute($parent_faq_categories_query);
      while (!$parent_faq_categories->EOF) {
        if ($parent_faq_categories->fields['parent_id'] !=0 && !$incat) {
          $in_cat = zen_faq_in_parent_faq_category($faq_id, $cat_id, $parent_faq_categories->fields['parent_id']);
        }
        $parent_faq_categories->MoveNext();
      }
    }
    return $in_cat;
  }
////
// faqs with name pulldown
  function zen_draw_faqs_pull_down($name, $parameters = '', $exclude = '') {
    global $currencies, $db;
    if ($exclude == '') {
      $exclude = array();
    }
    $select_string = '<select name="' . $name . '"';
    if ($parameters) {
      $select_string .= ' ' . $parameters;
    }
    $select_string .= '>';
    $faqs = $db->Execute("select p.*, pd.*
                              from " . TABLE_FAQS . " p, " . TABLE_FAQS_DESCRIPTION . " pd
                              where p.faqs_id = pd.faqs_id
                              and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'
                              order by faqs_name");
    while (!$faqs->EOF) {
      if (!in_array($faqs->fields['faqs_id'], $exclude)) {
        $select_string .= '<option value="' . $faqs->fields['faqs_id'] . '">' . $faqs->fields['faqs_name'] . ' </option>';
      }
      $faqs->MoveNext();
    }
    $select_string .= '</select>';
    return $select_string;
  }
// faq_categories pulldown with faqs
  function zen_draw_faqs_pull_down_faq_categories($name, $parameters = '', $exclude = '') {
    global $db, $currencies;
    if ($exclude == '') {
      $exclude = array();
    }
    $select_string = '<select name="' . $name . '"';
    if ($parameters) {
      $select_string .= ' ' . $parameters;
    }
    $select_string .= '>';
    $faq_categories = $db->Execute("select distinct c.faq_categories_id, cd.faq_categories_name " ."
                                from " . TABLE_FAQ_CATEGORIES . " c, " .
                                         TABLE_FAQ_CATEGORIES_DESCRIPTION . " cd, " .
                                         TABLE_FAQS_TO_FAQ_CATEGORIES . " ptoc " ."
                                where ptoc.faq_categories_id = c.faq_categories_id
                                and c.faq_categories_id = cd.faq_categories_id
                                and cd.language_id = '" . (int)$_SESSION['languages_id'] . "'
                                order by faq_categories_name");
    while (!$faq_categories->EOF) {
      if (!in_array($faq_categories->fields['faq_categories_id'], $exclude)) {
        $select_string .= '<option value="' . $faq_categories->fields['faq_categories_id'] . '">' . $faq_categories->fields['faq_categories_name'] . '</option>';
      }
      $faq_categories->MoveNext();
    }
    $select_string .= '</select>';
    return $select_string;
  }
////
// look up faq_categories faq_type
  function zen_get_faq_types_to_faq_category($lookup) {
    global $db;

    $lookup = str_replace('fcPath=','',$lookup);

    $sql = "select faq_type_id from " . TABLE_FAQ_TYPES_TO_FAQ_CATEGORY . " where faq_category_id='" . $lookup . "' and faq_type_id='3'";
    $look_up = $db->Execute($sql);
    return $look_up->fields['faq_type_id'];
  }
  function zen_get_show_faq_switch($lookup, $field, $suffix= 'SHOW_', $prefix= '_INFO', $field_prefix= '_', $field_suffix='') {
      global $db;
      $sql = "select faqs_type from " . TABLE_FAQS . " where faqs_id='" . $lookup . "'";
      $type_lookup = $db->Execute($sql);

      $sql = "select type_handler from " . TABLE_FAQ_TYPES . " where type_id = '" . $type_lookup->fields['faqs_type'] . "'";
      $show_key = $db->Execute($sql);
      $zv_key = strtoupper($suffix . $show_key->fields['type_handler'] . $prefix . $field_prefix . $field . $field_suffix);
      $sql = "select configuration_key, configuration_value from " . TABLE_FAQ_TYPE_LAYOUT . " where configuration_key='" . $zv_key . "'";
      $zv_key_value = $db->Execute($sql);
      if ($zv_key_value->RecordCount() > 0) {
        return $zv_key_value->fields['configuration_value'];
      } else {
        $sql = "select configuration_key, configuration_value from " . TABLE_CONFIGURATION . " where configuration_key='" . $zv_key . "'";
        $zv_key_value = $db->Execute($sql);
        if ($zv_key_value->RecordCount() > 0) {
          return $zv_key_value->fields['configuration_value'];
        } else {
          return $zv_key_value->fields['configuration_value'];
        }
      }
    }
  function zen_get_faqs_description($faq_id, $language = '') {
    global $db;
    if (empty($language)) $language = $_SESSION['languages_id'];
    $faq_query = "select faqs_description
                      from " . TABLE_FAQS_DESCRIPTION . "
                      where faqs_id = '" . (int)$faq_id . "'
                      and language_id = '" . (int)$language . "'";
    $faq = $db->Execute($faq_query);
    return $faq->fields['faqs_description'];
  }
  
  ///////////////////Derek Buntin Edited
   function zen_get_faq_category_tree($faq_parent_id = '0', $spacing = '', $exclude = '', $faq_category_tree_array = '', $include_itself = false, $faq_category_has_products = false, $limit = false) {
    global $db;

    if ($limit) {
      $limit_count = " limit 1";
    } else {
      $limit_count = '';
    }

    if (!is_array($faq_category_tree_array)) $faq_category_tree_array = array();
    if ( (sizeof($faq_category_tree_array) < 1) && ($exclude != '0') ) $faq_category_tree_array[] = array('id' => '0', 'text' => TEXT_TOP);

    if ($include_itself) {
      $faq_category = $db->Execute("select cd.faq_categories_name
                                from " . TABLE_FAQ_CATEGORIES_DESCRIPTION . " cd
                                where cd.language_id = '" . (int)$_SESSION['languages_id'] . "'
                                and cd.faq_categories_id = '" . (int)$faq_parent_id . "'");

      $faq_category_tree_array[] = array('id' => $faq_parent_id, 'text' => $faq_category->fields['faq_categories_name']);
    }

    $faq_categories = $db->Execute("select c.faq_categories_id, cd.faq_categories_name, c.parent_id
                                from " . TABLE_FAQ_CATEGORIES . " c, " . TABLE_FAQ_CATEGORIES_DESCRIPTION . " cd
                                where c.faq_categories_id = cd.faq_categories_id
                                and cd.language_id = '" . (int)$_SESSION['languages_id'] . "'
                                and c.parent_id = '" . (int)$faq_parent_id . "'
                                order by c.sort_order, cd.faq_categories_name");

    while (!$faq_categories->EOF) {
      if ($faq_category_has_products == true and zen_products_in_faq_category_count($faq_categories->fields['faq_categories_id'], '', false, true) >= 1) {
        $mark = '*';
      } else {
        $mark = '&nbsp;&nbsp;';
      }
      if ($exclude != $faq_categories->fields['faq_categories_id']) $faq_category_tree_array[] = array('id' => $faq_categories->fields['faq_categories_id'], 'text' => $spacing . $faq_categories->fields['faq_categories_name'] . $mark);
      $faq_category_tree_array = zen_get_faq_category_tree($faq_categories->fields['faq_categories_id'], $spacing . '&nbsp;&nbsp;&nbsp;', $exclude, $faq_category_tree_array, '', $faq_category_has_products);
      $faq_categories->MoveNext();
    }

    return $faq_category_tree_array;
  }

	// get faq<li> string in faq_category
	function zen_get_faq_in_category($cat_id){
		global $db,$fcPath,$_GET;;
		$faq_in_category_String = '';
		$faq_in_category_sql = "SELECT f.`faqs_id`, fd.`faqs_name` FROM faqs f, faqs_description fd, faqs_to_faq_categories ft WHERE fd.faqs_id=f.faqs_id AND ft.faqs_id=f.faqs_id AND f.`faqs_status` = 1 AND faq_categories_id = ". $cat_id;
		$faq_in_category = $db->Execute($faq_in_category_sql);
		if ($faq_in_category->RecordCount()>0){
			while (!$faq_in_category->EOF){
				if (isset($_GET['faqs_id'])){
					if ($faq_in_category->fields['faqs_id'] == $_GET['faqs_id']){
						$class= ' class="red"';
					}else{
						$class='';
					}
				}
				$faq_in_category_String .= '<li><a '.$class.' href="'.zen_href_link(zen_get_info_faq_page($faq_in_category->fields['faqs_id']),'fcPath=' . $fcPath . '&faqs_id=' . $faq_in_category->fields['faqs_id']).'" >'.$faq_in_category->fields['faqs_name'].'</a></li>';
				$faq_in_category->MoveNext();
			}
		}
		return $faq_in_category_String;
	} 

function zen_get_faq_id_in_category($cat_id){
    global $db,$fcPath,$_GET;
    $faqArray = array();
    $faq_in_category_String = '';
    $faq_in_category_sql = "SELECT f.`faqs_id` FROM faqs f, faqs_description fd, faqs_to_faq_categories ft WHERE fd.faqs_id=f.faqs_id AND ft.faqs_id=f.faqs_id AND f.`faqs_status` = 1 AND faq_categories_id = ". $cat_id;
    $faq_in_category = $db->Execute($faq_in_category_sql);
    if ($faq_in_category->RecordCount()>0){
      while (!$faq_in_category->EOF){
        $faqArray[] = $faq_in_category->fields['faqs_id'];
        $faq_in_category->MoveNext();
      }
    }
    return in_array($_GET['faqs_id'],$faqArray);
  }
  ?>