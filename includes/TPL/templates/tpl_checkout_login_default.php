<?php
/**                  
 * Page Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_login_default.php 5926 2007-02-28 18:15:39Z drbyte $
 */
 
?>
<ul id="projects">
  <li class="li1"><a href="<?php echo zen_href_link(FILENAME_SHOPPING_CART,'','SSL') ?>"><span>Your Shopping Cart</span></a></li>
  <li class="current2"><span>Account Login</span></li> 
  <li class="li3"><span>Address Book</span></li>
  <li class="li4"><span>Billing, Shipping &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></li> 
  <li class="li5"><span>Order Complete</span></li>
</ul>
<div class="ck_w center">
<h2 class="line_30px"><?php echo HEADING_TITLE; ?></h2>
<?php if ($messageStack->size('login') > 0) echo $messageStack->output('login'); ?>
<!--BOF normal login-->
<?php
  //if ($_SESSION['cart']->count_contents() > 0) {
    //echo '<div class="pad_10px">'.TEXT_VISITORS_CART.'</div>';
  //}
?>
<?php echo zen_draw_form('login', zen_href_link(FILENAME_LOGIN, 'action=process', 'SSL'),'post','id="logins" onsubmit="return(fmChk(this))"'); ?>
<div class="fl ck_w_m allborder">
<div class="check_box_tit black pad_1em"><?php echo HEADING_RETURNING_CUSTOMER; ?></div>
<div class="pad_10px">
<p>
If you have an account with
<br/>
<?php echo STORE_NAME; ?>, please Login.
</p>
<ul>
<li class="margin_t">
<?php echo ENTRY_EMAIL_ADDRESS; ?>
<br />
<?php echo zen_draw_input_field('email_address', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_email_address', '40') . ' id="login-email-address" class="input_box" chkName="email address" chkRule="nnull/min6/eml" size = "41" maxlength= "96"'); ?>
</li>
<li class="margin_t">
<?php echo ENTRY_PASSWORD; ?>
<br />
<?php echo zen_draw_password_field('password', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_password') . ' chkrule="nnull/min5" chkname="password" id="login-password" class="input_box"'); ?>
</li>
<li class="line_60px">
Forgot your <?php echo '<a href="' . zen_href_link(FILENAME_PASSWORD_FORGOTTEN, '', 'SSL') . '"  class="red u">' . TEXT_PASSWORD_FORGOTTEN . '</a>'; ?>
</li>
<li class="margin_t">
<?php echo zen_draw_hidden_field('securityToken', $_SESSION['securityToken']); ?>
<div class="g_t_r"><?php echo zen_image_submit(BUTTON_IMAGE_CONTINUE, BUTTON_CONTINUE_ALT); ?></div>
</li>
</ul>
<br class="clear" />
 <?php
  // ** GOOGLE CHECKOUT **
    include(DIR_WS_MODULES . 'show_google_components.php');  
  // ** END GOOGLE CHECKOUT **
 ?>
</div>
</div>
<?php echo '</form>'; ?>
<?php echo zen_draw_form('create_account', zen_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL'), 'post', 'id="create_account" onsubmit="return(fmChk(this))"') . zen_draw_hidden_field('action', 'process') . zen_draw_hidden_field('email_pref_html', 'email_format'); ?>
<div class="fr ck_w_m allborder">
<div class="check_box_tit black pad_1em"><?php echo HEADING_NEW_CUSTOMER; ?></div>
<div class="pad_10px">
<ul>
<?php echo TEXT_NEW_CUSTOMER_INTRODUCTION; ?>
<?php echo FORM_REQUIRED_INFORMATION; ?>
</ul>
<?php require($template->get_template_dir('tpl_modules_create_account.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_create_account.php'); ?>
<div class="margin_t"><?php echo zen_image_submit('button_create_account', BUTTON_SUBMIT_ALT); ?></div>
</div>
<br class="clear"/>
</div>
<?php echo '</form>'; ?>
<!--EOF normal login-->

</div>
<script>
 initForm('logins');
 initForm('create_account');
</script>