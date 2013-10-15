<?php
/**
 * Page Template  
 *
 * Loaded automatically by index.php?main_page=contact_us.<br />
 * Displays contact us page form.
 *
 * @package templateSystem  
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_contact_us_default.php 4272 2006-08-26 03:10:49Z drbyte $
 */

if (!isset($_GET['c']) and $_GET['c'] == ''){
?>
<div class="minframe fl">
<?php
 //require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/box_contact_us.php'));
 require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/ezpages.php'));
 require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/'.$template_dir.'/subscribe.php'));
?>
</div>
<div class="right_big_con">
<?php }else{ ?>
<div>
<?php } ?>
<?php if (DEFINE_CONTACT_US_STATUS >= '1' and DEFINE_CONTACT_US_STATUS <= '2') { ?>
<div id="contactUsNoticeContent" >
<?php if (!isset($_GET['c']) and $_GET['c'] == ''){ ?>
<h1 class="static_h1"><?php echo HEADING_TITLE; ?></h1>
<?php } ?>
<ul class="border_b_d pad_bottom pad_10px">
 We offer 7 days customer services by Email (except for major holidays), all inquiry would be responded within 2 hours.  
</ul>
<div id="popup_ask_a_question" class="pad_10px">
<?php echo zen_draw_form('ask_a_question', zen_href_link(FILENAME_CONTACT_US_FRAME, 'action=send'),'post','onsubmit="return(fmChk(this))"'); ?>
<?php
  if (isset($_GET['action']) && ($_GET['action'] == 'success')) {
?>
<div class="success_box" style="width:440px;"><?php echo TEXT_SUCCESS; ?></div>

<?php
  } else {
?>
<?php if ($messageStack->size('contact') > 0) echo $messageStack->output('contact'); ?>

<fieldset class="pad_10px margin_t dark_border" style="width:400px;">
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

<label class="inputLabel" for="contactname"><?php echo ENTRY_NAME . '<span class="red">' . ENTRY_REQUIRED_SYMBOL . '</span>'; ?></label>
<?php echo '<br/>'.zen_draw_input_field('contactname', $name, ' size="40" id="contactname" class="input_box" chkname="Your Name" chkrule="nnull"'); ?>
<br class="clear" />

<label class="inputLabel" for="email-address"><?php echo ENTRY_EMAIL. '<span class="red">' . ENTRY_REQUIRED_SYMBOL . '</span>'; ?></label>
<?php echo '<br/>'.zen_draw_input_field('email', ($error ? $_POST['email'] : $email), ' size="40" id="email-address" class="input_box" chkname="Email" chkrule="nnull/eml"') ; ?>
<br class="clear" />

<label for="enquiry"><?php echo ENTRY_ENQUIRY . '<span class="red">' . ENTRY_REQUIRED_SYMBOL . '</span>'; ?></label>
<?php echo '<br/>'.zen_draw_textarea_field('enquiry', '30', '7', '', 'id="enquiry" class="textarea1" chkname="review" chkrule="nnull/max1000"'); ?>

</fieldset>

<div class="pad_10px fl g_t_r" style="width:400px;"><?php echo zen_image_submit(BUTTON_IMAGE_SEND, BUTTON_SEND_ALT); ?></div>
<?php
  }
?>
</form>

</div>
 
<?php
/**
 * require html_define for the contact_us page
 */
   //删除一句 对话框下部荣誉的内容   require($define_page);
?>
</div>
<?php } ?>
 
</div>