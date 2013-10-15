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
  if (!isset($_GET['main_page']) || !zen_not_null($_GET['main_page'])) $_GET['main_page'] = 'index';
  if (!isset($_GET['disp_order'])) {
    $_GET['disp_order'] = $disp_order_default;
    $disp_order = $disp_order_default;
  } else {
    $disp_order = $_GET['disp_order'];
  }
echo zen_draw_form('sorter', zen_href_link($_GET['main_page']), 'get');
echo zen_draw_hidden_field('main_page', $_GET['main_page']);

// NOTE: to remove a sort order option add an HTML comment around the option to be removed
?>
<?php if (FAQ_ALL_DISPLAY_SORT_ORDER != '0') { ?>
  <tr>
    <td class="main" align="right" colspan="2"><?php echo TEXT_INFO_SORT_BY; ?>
    <select name="disp_order" onChange="this.form.submit();">
    <option value="1" <?php echo ($disp_order == '1' ? 'selected="selected"' : ''); ?>><?php echo TEXT_INFO_SORT_BY_FAQS_NAME; ?></option>
    <option value="2" <?php echo ($disp_order == '2' ? 'selected="selected"' : ''); ?>><?php echo TEXT_INFO_SORT_BY_FAQS_NAME_DESC; ?></option>
	<option value="3" <?php echo ($disp_order == '3' ? 'selected="selected"' : ''); ?>><?php echo TEXT_INFO_SORT_BY_FAQS_CATEGORY; ?></option>
	<option value="4" <?php echo ($disp_order == '4' ? 'selected="selected"' : ''); ?>><?php echo TEXT_INFO_SORT_BY_FAQS_ADMIN_SORT; ?></option>
    <option value="6" <?php echo ($disp_order == '6' ? 'selected="selected"' : ''); ?>><?php echo TEXT_INFO_SORT_BY_FAQS_DATE_DESC; ?></option>
    <option value="7" <?php echo ($disp_order == '7' ? 'selected="selected"' : ''); ?>><?php echo TEXT_INFO_SORT_BY_FAQS_DATE; ?></option>
    </select></td>
  </tr></form>
<?php 
  $disp_order = $_GET['disp_order']; 
 } 

  switch (true) {
    case ($disp_order == 1):
      $order_by = " order by fd.faqs_name";
      break;
    case ($disp_order == 2):
      $order_by = " order by fd.faqs_name DESC";
      break;
	case ($disp_order == 3):
      $order_by = " order by fc.sort_order, f.faqs_sort_order";
      break;
	case ($disp_order == 4):
      $order_by = " order by f.faqs_sort_order";
      break;
    case ($disp_order == 6):
      $order_by = " order by f.faqs_date_added DESC, fd.faqs_name";
      break;
    case ($disp_order == 7):
      $order_by = " order by f.faqs_date_added, fd.faqs_name";
      break;
    default:
      $order_by = " order by f.faqs_sort_order";
      break;
  }
?>