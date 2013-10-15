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
//  Original contrib by Vijay Immanuel for osCommerce, converted to zen by dave@open-operations.com - http://www.open-operations.com
//  $Id: links_manager.php 2004-11-19 dave@open-operations.com
//
  switch ($_GET['action']) {
    case 'links':
      require(DIR_WS_FUNCTIONS . 'links.php');
      $links_query = ("select links_url from " . TABLE_LINKS . " where links_id = '" . (int)$_GET['goto'] . "'");
      $link = $db->Execute($links_query);
if ($link->RecordCount() >0) {
        zen_update_links_click_count($_GET['goto']);
        zen_redirect($link->fields['links_url']);
      }
      break;
   }
  zen_redirect(zen_href_link(FILENAME_DEFAULT));
?>