<?php
/**
 * Page Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_password_forgotten_default.php 3712 2006-06-05 20:54:13Z drbyte $
 */
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
<?php echo zen_draw_form('password_forgotten', zen_href_link(FILENAME_PASSWORD_FORGOTTEN, 'action=process', 'SSL')); ?>

<?php if ($messageStack->size('password_forgotten') > 0) echo $messageStack->output('password_forgotten'); ?>

<fieldset class="margin_t pad_10px">    
<legend><b><?php echo HEADING_TITLE; ?></b></legend>

<div id="passwordForgottenMainContent" class="content"><?php echo TEXT_MAIN; ?></div>

<div class="alert forward"><?php echo FORM_REQUIRED_INFORMATION; ?></div>
<br class="clear"/>
<label for="email-address"><?php echo ENTRY_EMAIL_ADDRESS; ?></label>
<?php echo '<br/>'.zen_draw_input_field('email_address', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_email_address', '40') . ' id="email-address" class="l_input"') . '&nbsp;' . (zen_not_null(ENTRY_EMAIL_ADDRESS_TEXT) ? '<span class="alert">' . ENTRY_EMAIL_ADDRESS_TEXT . '</span>': ''); ?>
<br class="clear" />
</fieldset>

<div class="pad_10px fr"><?php echo zen_image_submit(BUTTON_IMAGE_SUBMIT, BUTTON_SUBMIT_ALT); ?></div> 

</form>
</div>