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
  class faqs {
    var $modules, $selected_module;

// class constructor
    function faqs($module = '') {
    }

    function get_faqs_in_faq_category($zf_faq_category_id, $zf_recurse=true, $zf_faq_ids_only=false) {
      global $db;
      $za_faqs_array = array();
      // get top level faqs
      $zp_faqs_query = "select ptc.*, pd.faqs_name
                            from " . TABLE_FAQS_TO_FAQ_CATEGORIES . " ptc
                            left join " . TABLE_FAQS_DESCRIPTION . " pd
                            on ptc.faqs_id = pd.faqs_id
                            and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'
                            where ptc.faq_categories_id='" . $zf_faq_category_id . "'
                            order by pd.faqs_name";

      $zp_faqs = $db->Execute($zp_faqs_query);
      while (!$zp_faqs->EOF) {
        if ($zf_faq_ids_only) {
          $za_faqs_array[] = $zp_faqs->fields['faqs_id'];
        } else {
          $za_faqs_array[] = array('id' => $zp_faqs->fields['faqs_id'],
                                       'text' => $zp_faqs->fields['faqs_name']);
        }
        $zp_faqs->MoveNext();
      }
      if ($zf_recurse) {
        $zp_faq_categories_query = "select faq_categories_id from " . TABLE_FAQ_CATEGORIES . "
                                where parent_id = '"   . $zf_faq_category_id . "'";
        $zp_faq_categories = $db->Execute($zp_faq_categories_query);
        while (!$zp_faq_categories->EOF) {
          $za_sub_faqs_array = $this->get_faqs_in_faq_category($zp_faq_categories->fields['faq_categories_id'], true, $zf_faq_ids_only);
          $za_faqs_array = array_merge($za_faqs_array, $za_sub_faqs_array);
          $zp_faq_categories->MoveNext();
        }
      }
      return $za_faqs_array;
    }

    function faqs_name($zf_faq_id) {
      global $db;
      $zp_faq_name_query = "select faqs_name from " . TABLE_FAQS_DESCRIPTION . "
                                where language_id = '" . $_SESSION['languages_id'] . "'
                                and faqs_id = '" . (int)$zf_faq_id . "'";
      $zp_faq_name = $db->Execute($zp_faq_name_query);
      $zp_faq_name = $zp_faq_name->fields['faqs_name'];
      return $zp_faq_name;
    }

    function get_admin_handler($type) {
	    return $this->get_handler($type) . '.php';
	  }

	  function get_handler($type) {
      global $db;

      $sql = "select type_handler from " . TABLE_FAQ_TYPES . " where type_id = '" . $type . "'";
      $handler = $db->Execute($sql);
	    return $handler->fields['type_handler'];
	  }

	  function get_allow_add_to_cart($zf_faq_id) {
	    global $db;

      $sql = "select faqs_type from " . TABLE_FAQS . " where faqs_id='" . $zf_faq_id . "'";
      $type_lookup = $db->Execute($sql);

      $sql = "select allow_add_to_cart from " . TABLE_FAQ_TYPES . " where type_id = '" . $type_lookup->fields['faqs_type'] . "'";
      $allow_add_to_cart = $db->Execute($sql);

	    return $allow_add_to_cart->fields['allow_add_to_cart'];
	  }

  }
?>