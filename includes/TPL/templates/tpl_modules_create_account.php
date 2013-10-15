<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=create_account.<br />
 * Displays Create Account form.
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_modules_create_account.php 4822 2006-10-23 11:11:36Z drbyte $
 */

$bestYouArray = array();
$bestYouArray[] = array("id" => "-1", "text" => "Please select--");
$bestYouArray[] = array("id" => "1", "text" => "Auction Seller");
$bestYouArray[] = array("id" => "2", "text" => "Wholesaler");
$bestYouArray[] = array("id" => "3", "text" => "Offline Retailer");
$bestYouArray[] = array("id" => "4", "text" => "Online Retailer");
$bestYouArray[] = array("id" => "5", "text" => "Dropshipper");
$bestYouArray[] = array("id" => "6", "text" => "End-user");
$bestYouArray[] = array("id" => "7", "text" => "Others");

$howKnowArray = array();
$howKnowArray[] = array("id" => "0", "text" => "Please select---");
$howKnowArray[] = array("id" => "1", "text" => "Your Friends");
$howKnowArray[] = array("id" => "2", "text" => "Search Engine");
$howKnowArray[] = array("id" => "3", "text" => "Forums or Blogs");
$howKnowArray[] = array("id" => "4", "text" => "Other Websites");
?>
<ul>
<li class="margin_t">
<?php echo ENTRY_EMAIL_ADDRESS . (zen_not_null(ENTRY_EMAIL_ADDRESS_TEXT) ? '<span class="red">' . ENTRY_EMAIL_ADDRESS_TEXT . '</span>': ''); ?><br/>
<?php echo zen_draw_input_field('email_address', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_email_address', '40') . ' id="login-email-address1" class="input_box" type="text" chkrule="nnull/min6/eml" chkname="email address" maxlength="96" size="41" value=""'); ?>
</li>
<li class="margin_t">
<?php echo ENTRY_PASSWORD; ?><br />
<?php echo zen_draw_password_field('password', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_password', '20') . ' id="login-password1" class="input_box" chkrule="nnull/min5" chkname="password" maxlength="40" size="41" value=""'); ?>
</li>
<li class="margin_t">
<?php echo ENTRY_PASSWORD_CONFIRMATION . (zen_not_null(ENTRY_PASSWORD_CONFIRMATION_TEXT) ? '<span class="red">' . ENTRY_PASSWORD_CONFIRMATION_TEXT . '</span>': ''); ?><br />
<?php echo zen_draw_password_field('confirmation', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_password', '20') . 'class="input_box" chkrule="nnull/cpwd/#login-password1" chkname="password Confirmation" maxlength="40" size="41" value=""') ?>
</li>


<!-- 以下删除选择用户类型  -->
<?
 /*
<li class="margin_t">
<?php echo ENTRY_WHICH_BEST_YOU; ?><br />
<?php echo zen_draw_pull_down_menu('describes',$bestYouArray,'',' chkname="Which one describes you the best?" chkrule="isselect" style="width: 120px;"'); ?>
</li> 
  */
?>
 
 <!-- 这里删除了公司名称输入-->
 
 
<li class="margin_t">
<?php echo ENTRY_HOW_DID_YOU_KNOW; ?><br />
<?php echo zen_draw_pull_down_menu('how_know_web',$howKnowArray , '' , ' style="width: 120px;"'); ?>
</li>

 

<!-- 以下被增加 checked="checked"-->

<li class="margin_t">
<input type="checkbox"  checked="checked" chkname="You must agree to our Terms of Use" chkrule="ischeck" value="1" name="privacy_conditions"/>
  Please agree to our
<a class="red u" target="_blank" href="<?php echo zen_href_link(FILENAME_PRIVACY); ?>">Terms and Conditions</a>
</li>

<?php
  if (CUSTOMERS_REFERRAL_STATUS == 2) {
?>
<fieldset>

<legend><?php echo TABLE_HEADING_REFERRAL_DETAILS; ?></legend>
<label class="inputLabel" for="customers_referral"><?php echo ENTRY_CUSTOMERS_REFERRAL; ?></label>
<?php echo zen_draw_input_field('customers_referral', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_referral', '15') . ' id="customers_referral"'); ?>
<br class="clear" />
</fieldset>
<?php } ?>
</ul>
