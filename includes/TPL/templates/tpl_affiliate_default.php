<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=affiliate.<br />
 * Displays conditions page.
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_affiliate_default.php  v1.3 $
 */
?>
<div class="minframe fl">
<?php
 //require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/box_contact_us.php'));
 require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/ezpages.php'));
 require(DIR_WS_MODULES . zen_get_module_directory('sideboxes/'.$template_dir.'/affiliate_login.php'));
?>
</div>
<div class="right_big_con margin_t" >
<h2 class="border_b line_30px pad_l_10px"><?php echo HEADING_TITLE; ?></h2>
<div id="affiliateMainContent" class="content">
<?php
/**
 * require the html_define for the affiliate page
 */
  require($define_page);
?>
<?php if ($messageStack->size('affi') > 0) echo $messageStack->output('affi'); ?>
<a name="join"></a>
<h4 class="border_b margin_t">Join Our Affiliates Program</h4>
<form onsubmit="return(fmChk(this))" action="<?php echo zen_href_link(FILENAME_AFFILIATE); ?>" method="post" name="form1" id="form1">
<input type="hidden" name="action" value="register"/>
<?  ?>
<table width="673" height="209" cellspacing="0" cellpadding="0" border="0" class="pad_l_28px margin_t">
  <tbody><tr>
    <td width="315" height="21" class="b">Your Name: <span class="red">*</span> </td>
    <td width="358" class="b">Comments:</td>
  </tr>
  <tr>
    <td height="26"><input type="text" chkrule="nnull" chkname="Your Name" class="input_5" name="userName"/></td>
    <td valign="top" height="170" rowspan="7">
    <textarea style="height: 170px;" class="textarea1" name="userComments"></textarea></td>
  </tr>
  <tr>
    <td height="21" class="b">Email Address: <span class="red">*</span> </td>
    </tr>
  <tr>
    <td height="26"><input type="text" chkrule="nnull/eml" chkname="Email Address" class="input_5" name="userEmail"/></td>
    </tr>
  <tr>
    <td height="21" class="b">Your websites URL: <span class="red">*</span> </td>
    </tr>
  <tr>
    <td height="26"><input type="text" chkrule="nnull" chkname="Your websites URL" class="input_5" name="userWeb"/></td>
    </tr>
  <tr>
    <td height="21" class="b">Phone Number:</td>
    </tr>
  <tr>
    <td height="26"><input type="text" class="input_5" name="userPhone"/></td>
    </tr>
  <tr>
    <td height="21" align="right" colspan="2">
    <button type="submit"><span>Submit</span></button>
    </td>
    </tr>
</tbody></table>
    <input type="hidden" value="1" name="isSubmitted"/>
</form>
</div>
</div>
