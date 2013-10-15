<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                     plainBox                 |
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
echo zen_draw_form('form123', zen_href_link(FILENAME_FAQS_SUBMIT, '', 'SSL'), 'post', 'enctype="multipart/form-data" onSubmit="javascript: return check_form();"');
echo zen_draw_hidden_field('action', 'process'); 
echo zen_draw_hidden_field('required','sEmail,fullname,faqs_name,faqs_category,faqs_description');
echo '<input type="hidden" value="" name="additional"/>';
if ($messageStack->size('submit_success') > 0) $messageStack->output('submit_success');
?>

<table  width="100%" border="0" cellspacing="2" cellpadding="2" align="center">
    <?php if (HEADING_DESCRIPTION) { ?>
      <tr>
        <td class="main"><?php echo HEADING_DESCRIPTION; ?></td>
      </tr>
     <?php } ?>
     <?php if ($messageStack->size('submit_faq') > 0) { ?>
      <tr>
        <td><?php echo $messageStack->output('submit_faq'); ?></td>
      </tr>
      <tr>
        <td><?php echo zen_draw_separator('pixel_trans.gif', '100%', '10'); ?></td>
      </tr>
    <?php } ?>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="plainBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="2" cellpadding="2">
                            <tr>
                <td width="20%"><?php echo ENTRY_FAQS_CONTACT_NAME . '&nbsp;' . (zen_not_null(ENTRY_FAQS_CONTACT_NAME_TEXT) ? '<span class="red">' . ENTRY_FAQS_NAME_TEXT . '</span>': ''); ?></td>
                <td><?php echo zen_draw_input_field('fullname', $name ,' class="input_box"'); ?></td>
              </tr>
			                <tr>
                <td><?php echo ENTRY_FAQS_CONTACT_MAIL . '&nbsp;' . (zen_not_null(ENTRY_FAQS_CONTACT_MAIL_TEXT) ? '<span class="red">' . ENTRY_FAQS_NAME_TEXT . '</span>': ''); ?></td>
                <td><?php echo zen_draw_input_field('sEmail', $email,' class="input_box"'); ?></td>
              </tr>
              <tr>
              	<td></td>
              	<td><?php echo FORM_REQUIRED_INFORMATION; ?></td>
              </tr>
			  <tr>
                <td><?php echo ENTRY_FAQS_NAME . '&nbsp;' . (zen_not_null(ENTRY_FAQS_NAME_TEXT) ? '<span class="red">' . ENTRY_FAQS_NAME_TEXT . '</span>': ''); ?></td>
                <td><?php echo zen_draw_input_field('faqs_name','',' class="input_box"'); ?></td>
              </tr>
              <tr>
                <td><?php echo ENTRY_FAQS_CATEGORY. '&nbsp;' . (zen_not_null(ENTRY_FAQS_NAME_TEXT) ? '<span class="red">' . ENTRY_FAQS_NAME_TEXT . '</span>': ''); ?></td>
                <td>
<?php
    echo zen_draw_pull_down_menu('faqs_category', zen_get_faq_category_tree(), $current_faq_category_id);
    if (zen_not_null(ENTRY_FAQS_CATEGORY_TEXT)) echo '&nbsp;<span class="inputRequirement">' . ENTRY_FAQS_CATEGORY_TEXT;
?>
                </td>
              </tr>
              <tr>
                <td valign="top"><?php echo ENTRY_FAQS_DESCRIPTION. '&nbsp;' . (zen_not_null(ENTRY_FAQS_DESCRIPTION_TEXT) ? '<span class="red">' . ENTRY_FAQS_DESCRIPTION_TEXT . '</span>': ''); ?></td>
                <td><?php echo zen_draw_textarea_field('faqs_description', 25, 5,'',' class="textarea1"') ; ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td><table border="0" width="100%" cellspacing="1" cellpadding="2" class="infoBox">
          <tr class="infoBoxContents">
            <td><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr>
                <td width="10"><?php echo zen_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
                <td align="right"><?php echo zen_image_submit(BUTTON_IMAGE_SUBMIT, IMAGE_BUTTON_SUBMIT); ?></td>
                <td width="10"><?php echo zen_draw_separator('pixel_trans.gif', '10', '1'); ?></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></form>