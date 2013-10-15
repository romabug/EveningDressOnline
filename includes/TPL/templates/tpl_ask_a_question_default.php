<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// |  Ask a question page.  Note that this uses the email settings from   |
// |  the contact_us page; there are no separate settings.                | 
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
//
 $column_box_default ='tpl_box_default_left.php';
?>
<div class="minframe fl">
<?php
 //require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/box_contact_us.php'));
 require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/ezpages.php'));
 require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/'.$template_dir.'/subscribe.php'));
?>
</div>
<div class="right_big_con">

<?php echo zen_draw_form('ask_a_question', zen_href_link(FILENAME_ASK_A_QUESTION, 'action=send&products_id=' . $_GET['products_id'])); ?>

<h2 class="border_b line_30px"><?php echo HEADING_TITLE . $product_info->fields['products_name']; ?></h2>


<?php
  if (isset($_GET['action']) && ($_GET['action'] == 'success')) {
?>
<div class="success_box"><?php echo TEXT_SUCCESS; ?></div>

<div class="buttonRow"><?php echo zen_back_link() . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a>'; ?></div>

<?php
  } else {
?>

<?php echo '<a href="' . zen_href_link(zen_get_info_page($_GET['products_id']), 'products_id=' . $_GET['products_id']) . '" class="fr margin_t">' . zen_image(DIR_WS_IMAGES . $product_info->fields['products_image'], $product_info->fields['products_name'], 85, 85) . '</a>'; ?>
<div id="contactUsNoticeContent" class="content">
<?php
/**
 * require html_define for the contact_us page.  
 */
  require($define_page);
?>
</div>
<br class="clear"/>
<?php if ($messageStack->size('contact') > 0) echo $messageStack->output('contact'); ?>

<fieldset id="contactUsForm" class="pad_10px margin_t dark_border">
<legend><b><?php echo FORM_TITLE; ?></b></legend>
<div class="alert"><?php echo FORM_REQUIRED_INFORMATION; ?></div>
<br class="clear" />

<?php
// show dropdown if set
    if (CONTACT_US_LIST !=''){
?>
<label class="inputLabel" for="send-to"><?php echo SEND_TO_TEXT; ?></label>
<?php echo '<br/>'.zen_draw_pull_down_menu('send_to',  $send_to_array, 'id=\"send-to\"') . '<span class="alert">' . ENTRY_REQUIRED_SYMBOL . '</span>'; ?>
<br class="clear" />
<?php
    }
?>

<label class="inputLabel" for="contactname"><?php echo ENTRY_NAME; ?></label>
<?php echo '<br/>'.zen_draw_input_field('contactname', $name, ' size="40" id="contactname" class="input_box"') . '<span class="alert">' . ENTRY_REQUIRED_SYMBOL . '</span>'; ?>
<br class="clear" />

<label class="inputLabel" for="email-address"><?php echo ENTRY_EMAIL; ?></label>
<?php echo '<br/>'.zen_draw_input_field('email', ($error ? $_POST['email'] : $email), ' size="40" id="email-address" class="input_box"') . '<span class="alert">' . ENTRY_REQUIRED_SYMBOL . '</span>'; ?>
<br class="clear" />

<label for="enquiry"><?php echo ENTRY_ENQUIRY . '<span class="alert">' . ENTRY_REQUIRED_SYMBOL . '</span>'; ?></label>
<?php echo '<br/>'.zen_draw_textarea_field('enquiry', '30', '7', '', 'id="enquiry" class="textarea1"'); ?>

</fieldset>

<div class="pad_10px fr"><?php echo zen_image_submit(BUTTON_IMAGE_SEND, BUTTON_SEND_ALT); ?></div>
<?php
  }
?>
</form>
</div>

