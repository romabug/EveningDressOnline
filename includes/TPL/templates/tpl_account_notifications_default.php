<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=account_notifications.<br />
 * Allows customer to manage product notifications
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_account_notifications_default.php 3206 2006-03-19 04:04:09Z birdbrain $
 */
?>
<div class="minframe fl">
<?php
 //require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/box_contact_us.php'));
 require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/ezpages.php'));
 require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/'.$template_dir.'/subscribe.php'));
?>
</div>
<div class="right_big_con margin_t">
<?php echo zen_draw_form('account_notifications', zen_href_link(FILENAME_ACCOUNT_NOTIFICATIONS, '', 'SSL')) . zen_draw_hidden_field('action', 'process'); ?>

<h2 class="border_b line_30px"><?php echo HEADING_TITLE; ?></h2>
<br class="clear"/>
<div class="notice"><?php echo MY_NOTIFICATIONS_DESCRIPTION; ?></div>

<fieldset class="dark_border margin_t">
<legend><b><?php echo GLOBAL_NOTIFICATIONS_TITLE; ?></b></legend>

<?php echo zen_draw_checkbox_field('product_global', '1', (($global->fields['global_product_notifications'] == '1') ? true : false), 'id="globalnotify"'); ?>
<label class="checkboxLabel" for="globalnotify"><?php echo GLOBAL_NOTIFICATIONS_DESCRIPTION; ?></label>
<br class="clear" />
</fieldset>

<?php
  if ($flag_global_notifications != '1') {
?>
<fieldset class="dark_border margin_t">
<legend><b><?php echo NOTIFICATIONS_TITLE; ?></b></legend>

<?php
    if ($flag_products_check) {
?>
<div class="notice"><?php echo NOTIFICATIONS_DESCRIPTION; ?></div>
<?php
/**
 * Used to loop thru and display product notifications
 */
  foreach ($notificationsArray as $notifications) { 
?>
<?php echo zen_draw_checkbox_field('notify[]', $notifications['products_id'], true, 'id="notify-' . $notifications['counter'] . '"'); ?>
<label class="checkboxLabel" for="<?php echo 'notify-' . $notifications['counter']; ?>"><?php echo $notifications['products_name']; ?></label>
<br />
<?php
  }
?>
</fieldset>

<div class="pad_10px fr"><?php echo zen_image_submit(BUTTON_IMAGE_UPDATE, BUTTON_UPDATE_ALT); ?></div>
<div class="pad_10px fl"><?php echo '<a href="' . zen_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a>'; ?></div>

<?php
    } else {
?>
<div class="notice"><?php echo NOTIFICATIONS_NON_EXISTING; ?></div>
</fieldset>
<div class="pad_10px fr"><?php echo zen_image_submit(BUTTON_IMAGE_UPDATE, BUTTON_UPDATE_ALT); ?></div>
<div class="pad_10px fl"><?php echo '<a href="' . zen_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT) . '</a>'; ?></div>
<?php
    }
?>

<?php
  }
?>

</form>    
</div>
