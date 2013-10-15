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
  class faq_category_tree {
    function zen_faq_category_tree($faq_type = "all") {
      global $db, $fcPath, $fcPath_array;
      if ($faq_type != 'all') {
        $sql = "select type_master_type from " . TABLE_FAQ_TYPES . "
                where type_master_type = '" . $faq_type . "'";
        $master_type_result = $db->Execute($sql);
        $master_type = $master_type_result->fields['type_master_type'];
      }
      $this->tree = array();
      if ($faq_type == 'all') {
        $faq_categories_query = "select c.faq_categories_id, cd.faq_categories_name, c.parent_id
                             from " . TABLE_FAQ_CATEGORIES . " c, " . TABLE_FAQ_CATEGORIES_DESCRIPTION . " cd
                             where c.parent_id = '0'
                             and c.faq_categories_id = cd.faq_categories_id
                             and cd.language_id='" . (int)$_SESSION['languages_id'] . "'
                             and c.faq_categories_status= '1'
                             order by sort_order, cd.faq_categories_name limit 8";
      } else {
        $faq_categories_query = "select ptc.faq_category_id as faq_categories_id, cd.faq_categories_name, c.parent_id
                             from " . TABLE_FAQ_CATEGORIES . " c, " . TABLE_FAQ_CATEGORIES_DESCRIPTION . " cd, " . TABLE_FAQ_TYPES_TO_FAQ_CATEGORY . " ptc
                             where c.parent_id = '0'
                             and ptc.faq_category_id = cd.faq_categories_id
                             and ptc.faq_type_id = '" . $master_type . "'
                             and c.faq_categories_id = ptc.faq_category_id
                             and cd.language_id='" . (int)$_SESSION['languages_id'] ."'
                             and c.faq_categories_status= '1'
                             order by sort_order, cd.faq_categories_name";
      }
      $faq_categories = $db->Execute($faq_categories_query, '', true, 150);
      while (!$faq_categories->EOF)  {
        $this->tree[$faq_categories->fields['faq_categories_id']] = array('name' => $faq_categories->fields['faq_categories_name'],
                                                    'parent' => $faq_categories->fields['parent_id'],
                                                    'level' => 0,
                                                    'path' => $faq_categories->fields['faq_categories_id'],
                                                    'next_id' => false);

        if (isset($faq_parent_id)) {
          $this->tree[$faq_parent_id]['next_id'] = $faq_categories->fields['faq_categories_id'];
        }
        $faq_parent_id = $faq_categories->fields['faq_categories_id'];
        if (!isset($first_element)) {
          $first_element = $faq_categories->fields['faq_categories_id'];
        }
        $faq_categories->MoveNext();
      }
      if (zen_not_null($fcPath)) {
        $new_path = '';
        reset($fcPath_array);
        while (list($key, $value) = each($fcPath_array)) {
          unset($faq_parent_id);
          unset($first_id);
      if ($faq_type == 'all') {
          $faq_categories_query = "select c.faq_categories_id, cd.faq_categories_name, c.parent_id
                               from " . TABLE_FAQ_CATEGORIES . " c, " . TABLE_FAQ_CATEGORIES_DESCRIPTION . " cd
                               where c.parent_id = '" . (int)$value . "'
                               and c.faq_categories_id = cd.faq_categories_id
                               and cd.language_id='" . (int)$_SESSION['languages_id'] . "'
                               and c.faq_categories_status= '1'
                               order by sort_order, cd.faq_categories_name";
     } else {
        $faq_categories_query = "select ptc.faq_category_id as faq_categories_id, cd.faq_categories_name, c.parent_id
                             from " . TABLE_FAQ_CATEGORIES . " c, " . TABLE_FAQ_CATEGORIES_DESCRIPTION . " cd, " . TABLE_FAQ_TYPES_TO_FAQ_CATEGORY . " ptc
                             where c.parent_id = '" . (int)$value . "'
                             and ptc.faq_category_id = cd.faq_categories_id
                             and ptc.faq_type_id = '" . $master_type . "'
                             and c.faq_categories_id = ptc.faq_category_id
                             and cd.language_id='" . (int)$_SESSION['languages_id'] ."'
                             and c.faq_categories_status= '1'
                             order by sort_order, cd.faq_categories_name";
     }
          $rows = $db->Execute($faq_categories_query);
          if ($rows->RecordCount()>0) {
            $new_path .= $value;
            while (!$rows->EOF) {
              $this->tree[$rows->fields['faq_categories_id']] = array('name' => $rows->fields['faq_categories_name'],
                                                   'parent' => $rows->fields['parent_id'],
                                                   'level' => $key+1,
                                                   'path' => $new_path . '_' . $rows->fields['faq_categories_id'],
                                                   'next_id' => false);
              if (isset($faq_parent_id)) {
                $this->tree[$faq_parent_id]['next_id'] = $rows->fields['faq_categories_id'];
              }
              $faq_parent_id = $rows->fields['faq_categories_id'];
              if (!isset($first_id)) {
                $first_id = $rows->fields['faq_categories_id'];
              }
              $last_id = $rows->fields['faq_categories_id'];
            $rows->MoveNext();
            }
            $this->tree[$last_id]['next_id'] = $this->tree[$value]['next_id'];
            $this->tree[$value]['next_id'] = $first_id;
            $new_path .= '_';
          } else {
            break;
         }
       }
     }
     $row = 0;
     return $this->zen_show_faq_category($first_element, $row);
    }
    function zen_show_faq_category($counter,$ii) {
      global $fcPath_array;
      $this->faq_categories_string = "";
      for ($i=0; $i<$this->tree[$counter]['level']; $i++) {
        if ($this->tree[$counter]['parent'] != 0) {
          $this->faq_categories_string .= FAQ_CATEGORIES_SUBFAQ_CATEGORIES_INDENT;
        }
      }
      if ($this->tree[$counter]['parent'] == 0) {
        $fcPath_new = 'fcPath=' . $counter;
        $this->box_faq_categories_array[$ii]['top'] = 'true';
      } else {
        $this->box_faq_categories_array[$ii]['top'] = 'false';
        $fcPath_new = 'fcPath=' . $this->tree[$counter]['path'];
        $this->faq_categories_string .= FAQ_CATEGORIES_SEPARATOR_SUBS;
      }
      $this->box_faq_categories_array[$ii]['path'] = $fcPath_new;
      if (isset($fcPath_array) && in_array($counter, $fcPath_array)) {
        $this->box_faq_categories_array[$ii]['current'] = true;
      }
// display faq_category name
      $this->box_faq_categories_array[$ii]['name'] = $this->faq_categories_string . $this->tree[$counter]['name'];
      if (zen_has_faq_category_subfaq_categories($counter)) {
        $this->box_faq_categories_array[$ii]['has_sub_cat'] = true;
      }
      if (SHOW_COUNTS == 'true') {
        $faqs_in_faq_category = zen_count_faqs_in_faq_category($counter);
        if ($faqs_in_faq_category > 0) {
          $this->box_faq_categories_array[$ii]['count'] = $faqs_in_faq_category;
        }
      }
      if ($this->tree[$counter]['next_id'] != false) {
        $ii++;
        $this->zen_show_faq_category($this->tree[$counter]['next_id'], $ii);
      }
      return $this->box_faq_categories_array;
    }

    
    function zen_faq_category_css_tree($faq_type = "all") {
      global $db, $fcPath, $fcPath_array;
      if ($faq_type != 'all') {
        $sql = "select type_master_type from " . TABLE_FAQ_TYPES . "
                where type_master_type = '" . $faq_type . "'";
        $master_type_result = $db->Execute($sql);
        $master_type = $master_type_result->fields['type_master_type'];
      }
      $this->tree = array();
      if ($faq_type == 'all') {
        $faq_categories_query = "select c.faq_categories_id, cd.faq_categories_name, c.parent_id
                             from " . TABLE_FAQ_CATEGORIES . " c, " . TABLE_FAQ_CATEGORIES_DESCRIPTION . " cd
                             where c.parent_id = '0'
                             and c.faq_categories_id = cd.faq_categories_id
                             and cd.language_id='" . (int)$_SESSION['languages_id'] . "'
                             and c.faq_categories_status= '1'
                             order by sort_order, cd.faq_categories_name";
      } else {
        $faq_categories_query = "select ptc.faq_category_id as faq_categories_id, cd.faq_categories_name, c.parent_id
                             from " . TABLE_FAQ_CATEGORIES . " c, " . TABLE_FAQ_CATEGORIES_DESCRIPTION . " cd, " . TABLE_FAQ_TYPES_TO_FAQ_CATEGORY . " ptc
                             where c.parent_id = '0'
                             and ptc.faq_category_id = cd.faq_categories_id
                             and ptc.faq_type_id = '" . $master_type . "'
                             and c.faq_categories_id = ptc.faq_category_id
                             and cd.language_id='" . (int)$_SESSION['languages_id'] ."'
                             and c.faq_categories_status= '1'
                             order by sort_order, cd.faq_categories_name";
      }
      $faq_categories = $db->Execute($faq_categories_query, '', true, 150);
      while (!$faq_categories->EOF)  {
        $this->tree[$faq_categories->fields['faq_categories_id']] = array('name' => $faq_categories->fields['faq_categories_name'],
                                                    'parent' => $faq_categories->fields['parent_id'],
                                                    'level' => 0,
                                                    'path' => $faq_categories->fields['faq_categories_id'],
        																						'id' =>$faq_categories->fields['faq_categories_id'],
                                                    'next_id' => false);

        if (isset($faq_parent_id)) {
          $this->tree[$faq_parent_id]['next_id'] = $faq_categories->fields['faq_categories_id'];
        }
        $faq_parent_id = $faq_categories->fields['faq_categories_id'];
        if (!isset($first_element)) {
          $first_element = $faq_categories->fields['faq_categories_id'];
        }
        $faq_categories->MoveNext();
      }
     $row = 0;
     return $this->zen_show_faq_category_css($first_element, $row);
    }
    
  function zen_show_faq_category_css($counter,$ii) {
      global $fcPath_array;
      $this->faq_categories_string = "";
      for ($i=0; $i<$this->tree[$counter]['level']; $i++) {
        if ($this->tree[$counter]['parent'] != 0) {
          $this->faq_categories_string .= FAQ_CATEGORIES_SUBFAQ_CATEGORIES_INDENT;
        }
      }
      $fcPath_new = 'fcPath=' . $counter;
      $this->box_faq_categories_array[$ii]['top'] = 'true';
      $this->box_faq_categories_array[$ii]['path'] = $fcPath_new;
      $this->box_faq_categories_array[$ii]['id'] = $this->tree[$counter]['id'];
// display faq_category name
      $this->box_faq_categories_array[$ii]['name'] = $this->faq_categories_string . $this->tree[$counter]['name'];
//      if (SHOW_COUNTS == 'true') {
//        $faqs_in_faq_category = zen_count_faqs_in_faq_category($counter);
//        if ($faqs_in_faq_category > 0) {
//          $this->box_faq_categories_array[$ii]['count'] = $faqs_in_faq_category;
//        }
//      }
      if ($this->tree[$counter]['next_id'] != false) {
        $ii++;
        $this->zen_show_faq_category_css($this->tree[$counter]['next_id'], $ii);
      }
      return $this->box_faq_categories_array;
    }
  
  }
?>