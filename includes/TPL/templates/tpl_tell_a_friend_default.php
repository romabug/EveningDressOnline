<?php
/**
 * Page Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_tell_a_friend_default.php 5927 2007-02-28 18:32:34Z drbyte $
 */
   $column_box_default ='tpl_box_default_left.php';
?>
<div class="minframe fl">
<?php
 //require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/box_contact_us.php'));
 require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/ezpages.php'));
 
// 取消了搜索记录   require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/'.$template_dir.'/popular_searches.php'));

 require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/'.$template_dir.'/customers_say.php'));

?>
</div>
<div class="right_big_con margin_t">
<?php echo zen_draw_form('email_friend', zen_href_link(FILENAME_TELL_A_FRIEND, 'action=process&products_id=' . $_GET['products_id'])); ?>
<h2 class="border_b line_30px pad_l_10px">Tell A Friends</h2>
<?php if ($messageStack->size('friend') > 0) echo $messageStack->output('friend'); ?>

<!--
<div class="pad_10px gray_bg"><?php echo EMAIL_ADVISORY_INCLUDED_WARNING . str_replace('-----', '', EMAIL_ADVISORY); ?></div>  -->

<fieldset class="dark_border margin_t">
<legend><b><?php echo sprintf(HEADING_TITLE, $product_info->fields['products_name']); ?></b></legend>
<div class=""><?php echo FORM_REQUIRED_INFORMATION; ?></div>
<br class="clear" />

<label class="inputLabel" for="from-name"><?php echo FORM_FIELD_CUSTOMER_NAME. '&nbsp;<span class="red">' . ENTRY_FIRST_NAME_TEXT . '</span>'; ?></label>
<?php echo '<br/>'.zen_draw_input_field('from_name','','id="from-name" class="l_input"') ; ?>
<br class="clear" />

<label class="inputLabel" for="from-email-address"><?php echo FORM_FIELD_CUSTOMER_EMAIL. '&nbsp;<span class="red">' . ENTRY_EMAIL_ADDRESS_TEXT . '</span>'; ?></label>
<?php echo '<br/>'.zen_draw_input_field('from_email_address','','id="from-email-address" class="l_input"') ; ?>
<br class="clear" />

<label class="inputLabel" for="to-name"><?php echo FORM_FIELD_FRIEND_NAME . '&nbsp;<span class="red">' . ENTRY_FIRST_NAME_TEXT . '</span>'; ?></label>
<?php echo '<br/>'.zen_draw_input_field('to_name', '', 'id="to-name" class="l_input"'); ?>
<br class="clear" />

<label class="inputLabel" for="to-email-address"><?php echo FORM_FIELD_FRIEND_EMAIL. '&nbsp;<span class="red">' . ENTRY_EMAIL_ADDRESS_TEXT . '</span>'; ?></label>
<?php echo '<br/>'.zen_draw_input_field('to_email_address', $_GET['to_email_address'], 'id="to-email-address" class="l_input"') ; ?>
<br class="clear" />

<label for="email-message"><?php echo FORM_TITLE_FRIEND_MESSAGE; ?></label>
<?php echo '<br/>'.zen_draw_textarea_field('message', 30, 5, '', 'id="email-message" class="textarea1"'); ?>
<br class="clear" />
</fieldset>

<div class="pad_10px fl"><?php echo '<a href="' . zen_href_link(zen_get_info_page($_GET['products_id']), 'products_id=' . $_GET['products_id']) . '">' . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a>'; ?></div>
<div class="pad_10px fr"><?php echo zen_image_submit(BUTTON_IMAGE_SEND, BUTTON_SEND_ALT); ?></div>
<br class="clear" />



</form>
</div>